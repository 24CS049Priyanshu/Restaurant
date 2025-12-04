-- Sample Menu Items for Restaurant Database
-- Insert these items into your restaurant_db database

-- Make sure the menu_items table exists with proper structure first

-- APPETIZERS
INSERT INTO menu_items (item_name, description, price, category, image_url, availability) VALUES
('Spring Rolls', 'Crispy golden spring rolls with sweet dipping sauce', 250, 'appetizers', 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=500&h=500&fit=crop', 1),
('Mozzarella Sticks', 'Golden fried mozzarella with marinara sauce', 280, 'appetizers', 'https://images.unsplash.com/photo-1539252554453-80ab781e1f0e?w=500&h=500&fit=crop', 1),
('Chicken Wings', 'Spicy buffalo wings with blue cheese dip', 320, 'appetizers', 'https://images.unsplash.com/photo-1587780591541-4b4efe1e7482?w=500&h=500&fit=crop', 1),
('Garlic Bread', 'Fresh baked bread with garlic and herbs', 180, 'appetizers', 'https://images.unsplash.com/photo-1599599810631-91a7810803d2?w=500&h=500&fit=crop', 1),

-- MAIN COURSES
('Grilled Salmon', 'Fresh salmon fillet with lemon butter sauce and seasonal vegetables', 650, 'mains', 'https://images.unsplash.com/photo-1547592166-7aae4d755744?w=500&h=500&fit=crop', 1),
('Spaghetti Carbonara', 'Creamy classic Italian pasta with bacon and parmesan', 480, 'mains', 'https://images.unsplash.com/photo-1612874742237-6526221fcf4f?w=500&h=500&fit=crop', 1),
('Grilled Chicken Breast', 'Tender chicken breast with herbs and roasted potatoes', 520, 'mains', 'https://images.unsplash.com/photo-1598103442097-8b74394b95c6?w=500&h=500&fit=crop', 1),
('Beef Steak', 'Premium beef steak with mushroom sauce and asparagus', 750, 'mains', 'https://images.unsplash.com/photo-1432139555190-58524dae6a55?w=500&h=500&fit=crop', 1),
('Margherita Pizza', 'Classic pizza with tomato, mozzarella, and fresh basil', 450, 'mains', 'https://images.unsplash.com/photo-1604068549290-dea0e4a305ca?w=500&h=500&fit=crop', 1),
('Butter Chicken', 'Creamy tomato-based Indian curry with tender chicken', 550, 'mains', 'https://images.unsplash.com/photo-1603463692221-c8e8de1e8e47?w=500&h=500&fit=crop', 1),

-- VEGETARIAN
('Veggie Stir Fry', 'Fresh mixed vegetables in a savory Asian sauce', 380, 'vegetarian', 'https://images.unsplash.com/photo-1609501676725-7186f017a4b8?w=500&h=500&fit=crop', 1),
('Paneer Tikka', 'Indian cottage cheese chunks marinated and grilled', 420, 'vegetarian', 'https://images.unsplash.com/photo-1567188040759-fb8a40f26899?w=500&h=500&fit=crop', 1),
('Mushroom Risotto', 'Creamy arborio rice with wild mushrooms and truffle', 480, 'vegetarian', 'https://images.unsplash.com/photo-1612620876100-e0b5dde39f63?w=500&h=500&fit=crop', 1),
('Vegetable Biryani', 'Fragrant basmati rice cooked with fresh vegetables', 400, 'vegetarian', 'https://images.unsplash.com/photo-1631045514418-09dc5a4a5f6a?w=500&h=500&fit=crop', 1),

-- BEVERAGES
('Fresh Orange Juice', 'Freshly squeezed orange juice', 150, 'beverages', 'https://images.unsplash.com/photo-1600271886742-f049cd451bba?w=500&h=500&fit=crop', 1),
('Iced Tea', 'Refreshing cold iced tea with lemon', 120, 'beverages', 'https://images.unsplash.com/photo-1599599810694-a5f9d5a0c2f7?w=500&h=500&fit=crop', 1),
('Coffee', 'Rich aromatic espresso or americano', 180, 'beverages', 'https://images.unsplash.com/photo-1559056199-641a0ac8b3f4?w=500&h=500&fit=crop', 1),
('Smoothie Bowl', 'Tropical fruit smoothie with granola and coconut', 320, 'beverages', 'https://images.unsplash.com/photo-1590301157890-4810ed352733?w=500&h=500&fit=crop', 1),

-- DESSERTS
('Chocolate Cake', 'Rich and moist chocolate cake with chocolate frosting', 280, 'desserts', 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=500&h=500&fit=crop', 1),
('Cheesecake', 'Classic New York style cheesecake with berry topping', 320, 'desserts', 'https://images.unsplash.com/photo-1533134242443-742ce8b9a652?w=500&h=500&fit=crop', 1),
('Ice Cream Sundae', 'Vanilla ice cream with chocolate sauce and toppings', 250, 'desserts', 'https://images.unsplash.com/photo-1563805042-7684c019e1cb?w=500&h=500&fit=crop', 1),
('Tiramisu', 'Traditional Italian dessert with mascarpone and espresso', 300, 'desserts', 'https://images.unsplash.com/photo-1571115177098-24ec42ed204d?w=500&h=500&fit=crop', 1),
('Fruit Salad', 'Fresh seasonal fruits with honey drizzle', 220, 'desserts', 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=500&h=500&fit=crop', 1);
