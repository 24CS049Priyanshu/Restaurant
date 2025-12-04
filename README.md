# Restaurant Management System

A full-featured restaurant ordering and management system built with PHP, MySQL, HTML, CSS, and vanilla JavaScript. Designed to run on XAMPP (Apache + MySQL) and includes customer and admin interfaces for browsing menu, placing orders, and managing menu/users/orders.

---

## Quick Summary

- Project path: `d:\xampp\htdocs\WDF_PR15-main`
- Backend: PHP 8+ (procedural PHP files)
- Database: MySQL / MariaDB (`restaurant_db`)
- Frontend: HTML5, CSS3 (`style.css`), JavaScript (`script.js`)
- Sample menu: 23 items (loaded via `sample_menu_items.sql` / `load_sample_menu.php`)

---

## Key Features

- Browse categorized menu with images and add-to-cart
- Persistent client-side cart using `localStorage` + server-side `$_SESSION` backup
- Checkout flow: delivery form, tax calculation (10%), order storage
- Order confirmation page with order details
- User registration and login (passwords hashed with bcrypt)
- Admin panel for managing menu, users, and orders
- Table reservations
- Custom toast notifications for user feedback
- Responsive layout (desktop, tablet, mobile)

---

## File Overview (important files)

- `connect.php` — Database connection (uses fallback to `127.0.0.1:3306` if needed)
- `index.php` — Home / landing page
- `menu.php` — Menu listing and category filtering
- `cart.php` — Cart page (server + client sync)
- `checkout.php` — Checkout form, order insertion logic
- `order_confirmation.php` — Shows order details after checkout
- `login.php` / `register.php` — Customer authentication
- `admin_login.php` — Admin authentication (uses role='admin')
- `dashboard.php`, `manage_menu.php`, `manage_user.php`, `manage_order.php` — Admin pages
- `profile.php` — User profile and order history
- `reservations.php` — Table booking
- `style.css` — Single stylesheet (1100+ lines; responsive + components)
- `script.js` — JS functions: `addToCart`, `updateCartBadge`, `showToast`, etc.
- `sample_menu_items.sql` / `load_sample_menu.php` — Seed menu items
- `create_admin.php` — Helper (provided) for creating an admin account (delete after use)
- `SYSTEM_DOCUMENTATION.html` — Detailed HTML documentation created for PDF conversion

---

## Where credentials are stored

All user accounts are stored in the `users` table of the `restaurant_db` database. Relevant columns include:

- `username` (unique)
- `email` (unique)
- `password` (hashed using `password_hash()` / bcrypt)
- `role` (`customer` or `admin`)

Passwords are stored as hashed strings (bcrypt). The app uses `password_verify()` to validate input passwords.

---

## Create an Admin Account (recommended safe way)

A small helper file `create_admin.php` is included to create an admin account from the browser (do this once and then delete the file):

1. Start XAMPP (Apache and MySQL).
2. Open in your browser:

	`http://localhost/WDF_PR15-main/create_admin.php`

3. Fill the form (username, email, full name, password) and submit.
4. After successful creation, DELETE `create_admin.php` to avoid leaving a backdoor.

Security note: This helper hashes the password with `password_hash(..., PASSWORD_BCRYPT)` before inserting.

---

## Create Admin Account (alternate, direct SQL method)

If you prefer to run commands manually:

1. Generate a bcrypt hash using PHP CLI:

```powershell
php -r "echo password_hash('YourSecurePassword123!', PASSWORD_BCRYPT).PHP_EOL;"
```

2. Copy the generated hash and insert into the database (using phpMyAdmin or MySQL CLI):

```sql
INSERT INTO users (username, email, password, full_name, role, created_at)
VALUES ('admin','admin@example.com','<PASTE_HASH_HERE>','Administrator','admin', NOW());
```

Replace `<PASTE_HASH_HERE>` with the hash string produced by the PHP command.

---

## Setup / Installation (Windows + XAMPP)

1. Install XAMPP and start **Apache** and **MySQL**.
2. Place project files in `d:\xampp\htdocs\WDF_PR15-main` (already present in this workspace).
3. Create the database:
	- Open `http://localhost/phpmyadmin` or use MySQL CLI.
	- Create database named `restaurant_db` (utf8_general_ci recommended).
4. Import schema and sample menu items:
	- Use `sample_menu_items.sql` (or run `load_sample_menu.php`) to create and populate `menu_items`.
5. Edit `connect.php` if your DB credentials differ (username/password/host/database).

Example `connect.php` variables to update if needed:

```php
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'restaurant_db';
```

6. Visit the site:

```
http://localhost/WDF_PR15-main/
```

---

## Running & Testing

- Register a new customer at `register.php` and log in via `login.php`.
- Add items to cart and proceed to `checkout.php` to create an order.
- After checkout, you will be redirected to `order_confirmation.php` showing order ID, items and totals.
- Admins log in using `admin_login.php` and can manage menu/users/orders.

---

## Converting Documentation to PDF

`SYSTEM_DOCUMENTATION.html` is a PDF-ready HTML file. Convert it by:

- Opening in a browser and using Print → Save as PDF.
- Or use `wkhtmltopdf` (if installed):

```powershell
wkhtmltopdf SYSTEM_DOCUMENTATION.html SYSTEM_DOCUMENTATION.pdf
```

---

## Troubleshooting

- "Connection refused" or DB errors: Ensure MySQL is running in XAMPP and `connect.php` credentials are correct.
- CSS not loading: confirm `style.css` exists in the project root and `header.php` links to `style.css` (not `css/style.css`).
- Sessions not persisting: ensure `session_start()` is at the top of pages needing sessions and browser cookies are enabled.
- 404 errors: verify files are in `d:\xampp\htdocs\WDF_PR15-main` and URLs are correct.

If you see PHP errors, temporarily enable error display for debugging (do not leave enabled on production):

```php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
```

---

## Security Notes (important)

- Passwords are hashed via bcrypt. Never store plaintext passwords.
- Use prepared statements to avoid SQL injection (already used throughout the codebase).
- Remove `create_admin.php` after use to avoid leaving an admin creation endpoint.
- Consider enabling HTTPS and restricting access to admin pages by IP or stronger authentication if deploying publicly.

---

## Next Improvements (suggestions)

- Add payment gateway (Stripe/PayPal) integration.
- Add email notifications for orders/reservations.
- Add logging for admin actions and order history details.
- Implement role-based access control checks on each admin page.
- Add automated tests for critical flows (login, checkout).

---

## Where to find further documentation

- `SYSTEM_DOCUMENTATION.html` — full technical documentation (recommended to convert to PDF for offline reading).
- `COMPLETE_GUIDE.md`, `CHECKOUT_SYSTEM.md`, `SETUP_COMPLETE.md` if present — additional guides created during development.

---

## Contact / Support

If you need further help, share the specific error message or a screenshot and I'll help troubleshoot.

---

*Generated on:* December 5, 2025
