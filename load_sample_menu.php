<?php
/**
 * Load Sample Menu Items
 * Run this file once to populate the database with sample menu items
 * Access: http://localhost/WDF_PR15-main/load_sample_menu.php
 */

include 'connect.php';

// Sample menu items data
$menu_items = [
    // APPETIZERS
    [
        'item_name' => 'Spring Rolls',
        'description' => 'Crispy golden spring rolls with sweet dipping sauce',
        'price' => 250,
        'category' => 'appetizers',
        'image_url' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=500&h=500&fit=crop'
    ],
    [
        'item_name' => 'Mozzarella Sticks',
        'description' => 'Golden fried mozzarella with marinara sauce',
        'price' => 280,
        'category' => 'appetizers',
        'image_url' => 'https://images.unsplash.com/photo-1539252554453-80ab781e1f0e?w=500&h=500&fit=crop'
    ],
    [
        'item_name' => 'Chicken Wings',
        'description' => 'Spicy buffalo wings with blue cheese dip',
        'price' => 320,
        'category' => 'appetizers',
        'image_url' => 'https://images.unsplash.com/photo-1587780591541-4b4efe1e7482?w=500&h=500&fit=crop'
    ],
    [
        'item_name' => 'Garlic Bread',
        'description' => 'Fresh baked bread with garlic and herbs',
        'price' => 180,
        'category' => 'appetizers',
        'image_url' => 'https://images.unsplash.com/photo-1599599810631-91a7810803d2?w=500&h=500&fit=crop'
    ],
    // MAIN COURSES
    [
        'item_name' => 'Grilled Salmon',
        'description' => 'Fresh salmon fillet with lemon butter sauce and seasonal vegetables',
        'price' => 650,
        'category' => 'mains',
        'image_url' => 'https://images.unsplash.com/photo-1547592166-7aae4d755744?w=500&h=500&fit=crop'
    ],
    [
        'item_name' => 'Spaghetti Carbonara',
        'description' => 'Creamy classic Italian pasta with bacon and parmesan',
        'price' => 480,
        'category' => 'mains',
        'image_url' => 'https://images.unsplash.com/photo-1612874742237-6526221fcf4f?w=500&h=500&fit=crop'
    ],
    [
        'item_name' => 'Grilled Chicken Breast',
        'description' => 'Tender chicken breast with herbs and roasted potatoes',
        'price' => 520,
        'category' => 'mains',
        'image_url' => 'https://images.unsplash.com/photo-1598103442097-8b74394b95c6?w=500&h=500&fit=crop'
    ],
    [
        'item_name' => 'Beef Steak',
        'description' => 'Premium beef steak with mushroom sauce and asparagus',
        'price' => 750,
        'category' => 'mains',
        'image_url' => 'https://images.unsplash.com/photo-1432139555190-58524dae6a55?w=500&h=500&fit=crop'
    ],
    [
        'item_name' => 'Margherita Pizza',
        'description' => 'Classic pizza with tomato, mozzarella, and fresh basil',
        'price' => 450,
        'category' => 'mains',
        'image_url' => 'https://images.unsplash.com/photo-1604068549290-dea0e4a305ca?w=500&h=500&fit=crop'
    ],
    [
        'item_name' => 'Butter Chicken',
        'description' => 'Creamy tomato-based Indian curry with tender chicken',
        'price' => 550,
        'category' => 'mains',
        'image_url' => 'https://images.unsplash.com/photo-1603463692221-c8e8de1e8e47?w=500&h=500&fit=crop'
    ],
    // VEGETARIAN
    [
        'item_name' => 'Veggie Stir Fry',
        'description' => 'Fresh mixed vegetables in a savory Asian sauce',
        'price' => 380,
        'category' => 'vegetarian',
        'image_url' => 'https://images.unsplash.com/photo-1609501676725-7186f017a4b8?w=500&h=500&fit=crop'
    ],
    [
        'item_name' => 'Paneer Tikka',
        'description' => 'Indian cottage cheese chunks marinated and grilled',
        'price' => 420,
        'category' => 'vegetarian',
        'image_url' => 'https://images.unsplash.com/photo-1567188040759-fb8a40f26899?w=500&h=500&fit=crop'
    ],
    [
        'item_name' => 'Mushroom Risotto',
        'description' => 'Creamy arborio rice with wild mushrooms and truffle',
        'price' => 480,
        'category' => 'vegetarian',
        'image_url' => 'https://images.unsplash.com/photo-1612620876100-e0b5dde39f63?w=500&h=500&fit=crop'
    ],
    [
        'item_name' => 'Vegetable Biryani',
        'description' => 'Fragrant basmati rice cooked with fresh vegetables',
        'price' => 400,
        'category' => 'vegetarian',
        'image_url' => 'https://images.unsplash.com/photo-1631045514418-09dc5a4a5f6a?w=500&h=500&fit=crop'
    ],
    // BEVERAGES
    [
        'item_name' => 'Fresh Orange Juice',
        'description' => 'Freshly squeezed orange juice',
        'price' => 150,
        'category' => 'beverages',
        'image_url' => 'https://images.unsplash.com/photo-1600271886742-f049cd451bba?w=500&h=500&fit=crop'
    ],
    [
        'item_name' => 'Iced Tea',
        'description' => 'Refreshing cold iced tea with lemon',
        'price' => 120,
        'category' => 'beverages',
        'image_url' => 'https://images.unsplash.com/photo-1599599810694-a5f9d5a0c2f7?w=500&h=500&fit=crop'
    ],
    [
        'item_name' => 'Coffee',
        'description' => 'Rich aromatic espresso or americano',
        'price' => 180,
        'category' => 'beverages',
        'image_url' => 'https://images.unsplash.com/photo-1559056199-641a0ac8b3f4?w=500&h=500&fit=crop'
    ],
    [
        'item_name' => 'Smoothie Bowl',
        'description' => 'Tropical fruit smoothie with granola and coconut',
        'price' => 320,
        'category' => 'beverages',
        'image_url' => 'https://images.unsplash.com/photo-1590301157890-4810ed352733?w=500&h=500&fit=crop'
    ],
    // DESSERTS
    [
        'item_name' => 'Chocolate Cake',
        'description' => 'Rich and moist chocolate cake with chocolate frosting',
        'price' => 280,
        'category' => 'desserts',
        'image_url' => 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=500&h=500&fit=crop'
    ],
    [
        'item_name' => 'Cheesecake',
        'description' => 'Classic New York style cheesecake with berry topping',
        'price' => 320,
        'category' => 'desserts',
        'image_url' => 'https://images.unsplash.com/photo-1533134242443-742ce8b9a652?w=500&h=500&fit=crop'
    ],
    [
        'item_name' => 'Ice Cream Sundae',
        'description' => 'Vanilla ice cream with chocolate sauce and toppings',
        'price' => 250,
        'category' => 'desserts',
        'image_url' => 'https://images.unsplash.com/photo-1563805042-7684c019e1cb?w=500&h=500&fit=crop'
    ],
    [
        'item_name' => 'Tiramisu',
        'description' => 'Traditional Italian dessert with mascarpone and espresso',
        'price' => 300,
        'category' => 'desserts',
        'image_url' => 'https://images.unsplash.com/photo-1571115177098-24ec42ed204d?w=500&h=500&fit=crop'
    ],
    [
        'item_name' => 'Fruit Salad',
        'description' => 'Fresh seasonal fruits with honey drizzle',
        'price' => 220,
        'category' => 'desserts',
        'image_url' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=500&h=500&fit=crop'
    ]
];

// Check if menu_items table exists
$check_table = $conn->query("SHOW TABLES LIKE 'menu_items'");
if ($check_table->num_rows == 0) {
    die("<h2>Error: menu_items table does not exist!</h2><p>Please create the table first.</p>");
}

// Insert menu items
$inserted = 0;
$errors = [];

foreach ($menu_items as $item) {
    $stmt = $conn->prepare("INSERT INTO menu_items (item_name, description, price, category, image_url, availability) VALUES (?, ?, ?, ?, ?, 1)");
    
    if (!$stmt) {
        $errors[] = "Prepare error: " . $conn->error;
        continue;
    }
    
    $stmt->bind_param("ssdss", $item['item_name'], $item['description'], $item['price'], $item['category'], $item['image_url']);
    
    if ($stmt->execute()) {
        $inserted++;
    } else {
        $errors[] = "Error inserting {$item['item_name']}: " . $stmt->error;
    }
    
    $stmt->close();
}

// Display results
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Load Sample Menu Items</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .alert { padding: 1rem; margin: 1rem 0; border-radius: 8px; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>
    <div class="container" style="margin-top: 2rem;">
        <h2>Sample Menu Items Loader</h2>
        
        <div class="alert alert-success">
            <strong>Success!</strong> Inserted <strong><?php echo $inserted; ?></strong> menu items into the database.
        </div>
        
        <?php if (!empty($errors)): ?>
            <div class="alert alert-error">
                <strong>Errors:</strong>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <p>
            <a href="menu.php" class="btn btn-primary">View Menu</a>
            <a href="index.php" class="btn btn-primary" style="margin-left: 0.5rem;">Go Home</a>
        </p>
        
        <p style="margin-top: 2rem; color: #666; font-size: 0.9rem;">
            <em>Note: This page loads sample menu items. You can run it once and then delete or rename it if desired.</em>
        </p>
    </div>
</body>
</html>

<?php
$conn->close();
?>
