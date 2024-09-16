# PHP eCommerce Store

A simple eCommerce web application built using PHP and MySQL with phpMyAdmin for database management.

## Table of Contents

- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Database Setup](#database-setup)
- [File Structure](#file-structure)
- [Usage](#usage)
- [Customization](#customization)
- [Credits](#credits)

---

## Features

- **Product Catalog**: Browse products by category.
- **User Authentication**: Registration and login functionality for customers.
- **Shopping Cart**: Add, update, and remove items from the cart.
- **Checkout System**: Place orders with real-time updates.
- **Admin Panel**: Manage products, categories, and orders.

---

## Requirements

- **Software**:
  - PHP 7.4 or later
  - MySQL 5.7 or later
  - phpMyAdmin
  - Apache Web Server (e.g., XAMPP, WAMP)
  
- **PHP Extensions**:
  - MySQLi
  - cURL
  - Session

---

## Installation

1. **Clone the Repository**:
    ```bash
    git clone https://github.com/your-repo/php-ecommerce-store.git
    ```
2. **Set Up Apache and PHP**:
   - Install and run a local web server environment (e.g., [XAMPP](https://www.apachefriends.org/index.html) or [WAMP](https://www.wampserver.com/en/)).
   - Place the project folder in the `htdocs` or `www` directory, depending on the environment.

3. **Configure PHP Settings**:
   - Ensure PHP is running and the necessary extensions (`mysqli`, `curl`, `session`) are enabled in `php.ini`.

---

## Database Setup

1. **Open phpMyAdmin**:
    - Start your web server (XAMPP, WAMP) and navigate to `http://localhost/phpmyadmin`.

2. **Create the Database**:
    - In phpMyAdmin, create a new database named `ecommerce_store`.

3. **Import the SQL File**:
    - Inside the project folder, locate the `ecommerce_store.sql` file under the `db` directory.
    - Import the `ecommerce_store.sql` file into your newly created database using phpMyAdmin.

4. **Update Database Connection Settings**:
    - Open the `config.php` file in the root of the project.
    - Set your MySQL credentials:

    ```php
    <?php
    $servername = "localhost";
    $username = "root";
    $password = ""; // Default password for XAMPP/WAMP
    $dbname = "ecommerce_store";
    ?>
    ```

---

## File Structure

```plaintext
php-ecommerce-store/
│
├── db/
│   └── ecommerce_store.sql       # SQL file for database structure
├── css/
│   └── style.css                 # Basic CSS for layout and styling
├── js/
│   └── main.js                   # JavaScript for client-side interactions
├── admin/
│   └── admin_dashboard.php       # Admin panel for managing the store
├── includes/
│   ├── config.php                # Database connection settings
│   └── functions.php             # Reusable functions (e.g., cart, login)
├── products/
│   └── product_details.php       # Product details and information
├── cart/
│   └── view_cart.php             # Shopping cart page
├── checkout/
│   └── checkout.php              # Checkout and payment page
├── index.php                     # Home page
├── login.php                     # User login page
└── register.php                  # User registration page
