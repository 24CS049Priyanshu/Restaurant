🍽️ Restaurant Management System

A complete restaurant ordering and management web application built using PHP, MySQL, HTML, CSS, and JavaScript, designed to run smoothly on XAMPP (Apache + MySQL).
It includes both customer-facing and admin-facing interfaces for browsing menu items, placing orders, and managing restaurant operations.

📌 Overview

Tech Stack: PHP 8+, MySQL/MariaDB, HTML5, CSS3, JavaScript

Local Server: XAMPP

Database: restaurant_db

UI: Responsive layout (mobile, tablet, desktop)

Features: User accounts, ordering system, reservations, admin CRUD

⭐ Features
🧑‍🍽️ Customer Side

Browse categorized menu with images

Add items to cart (cart saved via localStorage + session backup)

Checkout with delivery details and automated tax calculation (10%)

Order confirmation screen with complete order summary

User registration and login (bcrypt password hashing)

View order history in profile

Table reservation system

Toast notification system for better UX

🔐 Admin Side

Secure admin login (role-based access)

Manage:

Menu items

Orders

Users

Dashboard insights

Edit/delete items and update statuses

Fully responsive admin UI

📁 Important Files & Structure
File	Purpose
connect.php	MySQL database connection file
index.php	Home page
menu.php	Menu with category filter & Add to Cart
cart.php	Cart UI + session sync
checkout.php	Delivery form & order insertion
order_confirmation.php	Displays order details
login.php, register.php	User authentication
admin_login.php	Admin authentication
dashboard.php	Admin dashboard
manage_menu.php	CRUD for menu items
manage_user.php	Manage user accounts
manage_order.php	Manage orders
reservations.php	Table booking
script.js	Frontend JS (cart, toast, UI logic)
style.css	Main stylesheet (1100+ lines)
sample_menu_items.sql	Preloaded sample menu items
SYSTEM_DOCUMENTATION.html	Full system documentation
🔒 User & Admin Authentication

Users stored in users table

Passwords hashed using bcrypt (password_hash())

Login validation uses password_verify()

Roles: customer, admin

🛠️ Creating an Admin Account
Method 1: Simple (Browser-based)

Use the helper file: create_admin.php

Steps:

Start XAMPP (Apache + MySQL)

Visit:

http://localhost/WDF_PR15-main/create_admin.php


Fill the form → submit

Important: Delete create_admin.php afterward for security.

Method 2: Manual (SQL + PHP Hash)

Generate hash:

php -r "echo password_hash('StrongPassword123', PASSWORD_BCRYPT).PHP_EOL;"


Insert into database:

INSERT INTO users (username, email, password, full_name, role, created_at)
VALUES ('admin', 'admin@example.com', '<HASH>', 'Administrator', 'admin', NOW());

🧩 Installation Guide (XAMPP)

Install and start XAMPP → enable Apache and MySQL

Place the project folder into:

htdocs/


Create database:

restaurant_db


Import:

sample_menu_items.sql
or

run load_sample_menu.php

Update credentials in connect.php if required:

$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'restaurant_db';


Visit the site:

http://localhost/WDF_PR15-main/

🧪 Testing the Application

Register or log in

Add menu items to cart

Proceed through checkout

View order details

Test admin login via admin_login.php

📝 Documentation as PDF

Convert SYSTEM_DOCUMENTATION.html to PDF:

Browser:

Open → Print → Save as PDF

Using wkhtmltopdf:
wkhtmltopdf SYSTEM_DOCUMENTATION.html SYSTEM_DOCUMENTATION.pdf

🧯 Troubleshooting
❌ MySQL connection error

Check XAMPP MySQL service

Verify connect.php credentials

❌ CSS not loading

Ensure style.css exists in project root

Check header.php link path

❌ Session issues

Ensure session_start() is at the top of PHP files

Browser cookies must be enabled

❌ PHP errors

Enable temporary debugging:

ini_set('display_errors', 1);
error_reporting(E_ALL);

🔐 Security Recommendations

Keep passwords hashed (bcrypt is already used)

Use prepared statements to prevent SQL injection

Delete create_admin.php after setup

Use HTTPS if deploying publicly

Restrict admin panel access

🚀 Recommended Future Enhancements

Payment gateway (Stripe, Razorpay, PayPal)

Email/SMS notifications

More detailed order analytics

Role-based access control (RBAC)

Automated tests for login, checkout & menu CRUD

📚 Additional Documentation

SYSTEM_DOCUMENTATION.html (primary technical guide)

Any additional .md or guide files included in project
