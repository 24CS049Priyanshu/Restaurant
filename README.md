🍽️ Restaurant Management System
A modern, full-featured restaurant ordering & management platform

PHP • MySQL • HTML • CSS • JavaScript

<p align="center"> <img src="https://img.shields.io/badge/PHP-8+-777BB4?style=for-the-badge&logo=php&logoColor=white"/> <img src="https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql&logoColor=white"/> <img src="https://img.shields.io/badge/JavaScript-Frontend-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black"/> <img src="https://img.shields.io/badge/XAMPP-Localhost-FB7A24?style=for-the-badge&logo=xampp&logoColor=white"/> </p>
✨ About the Project

A complete restaurant management ecosystem featuring customer ordering, cart system, reservations, and a fully-powered admin dashboard.
Runs locally using XAMPP and uses bcrypt-secured authentication.

🚀 Features at a Glance
👨‍🍳 Customer Portal

Browse categorized menu with images

Add items to cart with localStorage persistence

Checkout with delivery details

Automatic tax calculation (10%)

Order confirmation page

Profile + order history

Table reservation system

Beautiful toast notifications

🛠️ Admin Dashboard

Secure admin login

Manage:

Menu items

Users

Orders

Update prices, stock, images

View order statuses

Fully responsive admin interface

🗂️ Project Structure
WDF_PR15-main/
│── index.php
│── menu.php
│── cart.php
│── checkout.php
│── order_confirmation.php
│── connect.php
│── style.css
│── script.js
│── admin/
│    ├── admin_login.php
│    ├── dashboard.php
│    ├── manage_menu.php
│    ├── manage_user.php
│    └── manage_order.php
│── reservations.php
│── sample_menu_items.sql
│── SYSTEM_DOCUMENTATION.html
└── create_admin.php (delete after setup)

🔐 Authentication & Security

✔ Passwords hashed using bcrypt
✔ Login verified using password_verify()
✔ Roles: customer & admin
✔ All DB queries use prepared statements
✔ create_admin.php must be deleted after setup

🔧 Installation (XAMPP)
1️⃣ Start XAMPP → Enable Apache + MySQL
2️⃣ Place folder inside:
htdocs/

3️⃣ Create database:
restaurant_db

4️⃣ Import sample items:

sample_menu_items.sql
OR

Run load_sample_menu.php

5️⃣ Configure database in connect.php:
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'restaurant_db';

6️⃣ Visit the project:
http://localhost/WDF_PR15-main/

👑 Creating an Admin Account
✅ Easy Method (Browser)

Visit:

http://localhost/WDF_PR15-main/create_admin.php


Fill details → Submit →
❗ Delete the file after use.

🧠 Manual Method (SQL)

Generate bcrypt hash:

php -r "echo password_hash('StrongPassword123', PASSWORD_BCRYPT);"


Insert into DB:

INSERT INTO users (username, email, password, full_name, role, created_at)
VALUES ('admin', 'admin@example.com', '<HASH>', 'Administrator', 'admin', NOW());

🧪 Testing the App
Customer

✔ Register/Login
✔ Browse menu
✔ Add to Cart
✔ Checkout
✔ Confirm order

Admin

✔ Login using admin_login.php
✔ Manage menu, users, & orders

📄 Convert Documentation to PDF
Option 1: Browser

Open → Print → Save as PDF

Option 2: wkhtmltopdf
wkhtmltopdf SYSTEM_DOCUMENTATION.html SYSTEM_DOCUMENTATION.pdf

🧯 Troubleshooting
Issue	Solution
❌ MySQL connection failed	Start MySQL + check connect.php credentials
❌ CSS not loading	Ensure correct style.css path
❌ Session not working	Add session_start() at top
❌ PHP errors	Enable debugging temporarily

Debugging:

ini_set('display_errors', 1);
error_reporting(E_ALL);

🔐 Security Tips

Always hash passwords (already implemented)

Delete admin creation file

Avoid deploying without HTTPS

Validate & sanitize user inputs

🚀 Future Enhancements

✨ Payment Gateway Integration (Stripe / PayPal)
✨ Email & SMS notifications
✨ Advanced analytics for orders
✨ Role-based admin permissions
✨ API version (REST/JSON)
