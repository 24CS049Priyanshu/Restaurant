<?php
session_start();
include 'connect.php';
include 'header.php'; // renders <head> / nav

$category = isset($_GET['category']) ? $_GET['category'] : 'all';

// Get all categories for filter
$category_sql = "SELECT DISTINCT category FROM menu_items WHERE availability = 1 ORDER BY category";
$category_result = $conn->query($category_sql);
$categories = [];
if ($category_result) {
    while ($cat = $category_result->fetch_assoc()) {
        $categories[] = $cat['category'];
    }
}

// Get menu items based on category
if ($category === 'all') {
    $sql = "SELECT * FROM menu_items WHERE availability = 1 ORDER BY category, item_name";
    $stmt = $conn->prepare($sql);
} else {
    $sql = "SELECT * FROM menu_items WHERE category = ? AND availability = 1 ORDER BY item_name";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("s", $category);
    }
}

if (!$stmt) {
    echo "<div class='container'><p class='alert alert-error'>Database error: " . htmlspecialchars($conn->error) . "</p></div>";
    include 'footer.php';
    exit();
}

$stmt->execute();
$result = $stmt->get_result();
?>

<div class="menu-hero">
    <div class="container">
        <h1>Our Menu</h1>
        <p>Discover our delicious selection of authentic cuisine</p>
    </div>
</div>

<div class="container menu-container">
    <!-- Category Filter -->
    <div class="menu-filters">
        <a href="menu.php?category=all" class="filter-btn <?php echo $category === 'all' ? 'active' : ''; ?>">All Items</a>
        <?php foreach ($categories as $cat): ?>
            <a href="menu.php?category=<?php echo urlencode($cat); ?>" class="filter-btn <?php echo $category === $cat ? 'active' : ''; ?>">
                <?php echo htmlspecialchars(ucfirst($cat)); ?>
            </a>
        <?php endforeach; ?>
    </div>

    <!-- Menu Items Grid -->
    <div class="menu-grid">
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="menu-item">
                    <div class="menu-item-image">
                        <img src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="<?php echo htmlspecialchars($row['item_name']); ?>" loading="lazy">
                        <div class="menu-item-overlay">
                            <button class="btn-add-cart" onclick="addToCart(<?php echo (int)$row['item_id']; ?>, '<?php echo addslashes(htmlspecialchars($row['item_name'])); ?>', <?php echo (float)$row['price']; ?>)">
                                🛒 Add to Cart
                            </button>
                        </div>
                    </div>
                    <div class="menu-item-content">
                        <span class="menu-category"><?php echo htmlspecialchars(ucfirst($row['category'])); ?></span>
                        <h3><?php echo htmlspecialchars($row['item_name']); ?></h3>
                        <p class="menu-description"><?php echo htmlspecialchars($row['description']); ?></p>
                        <div class="menu-item-footer">
                            <span class="price">Rs. <?php echo number_format((float)$row['price'], 2); ?></span>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="no-items">
                <p>No menu items found in this category.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<script src="script.js"></script>

<?php
include 'footer.php';
$stmt->close();
?>