# Cookie World

Cookie World is a website developed for students to buy cookies around the University area. Students can select their preferred shop, view available cookies, check reviews, and locate the shop. The website also includes a "How to Use" section, guiding users through the cookie purchasing process from start to finish. For inquiries, users can easily contact us through the contact form in the "About Us" section. Registered users can save their debit/credit cards for faster checkout.

## Features

- Browse cookies by shop
- View reviews and shop locations
- User profile with saved payment methods
- Contact form for inquiries

## Database Structure

The database for Cookie World contains the following tables:

- `cards`
- `contact_inquiry`
- `cookies`
- `order_items`
- `orders`
- `reviewcookie`
- `users`

## How to Use the Code

Follow the instructions below to create each table using MySQL in XAMPP:

### 1. Cards Table

```sql
CREATE TABLE cards (
    id INT(11) NOT NULL AUTO_INCREMENT,
    user_email VARCHAR(255) NOT NULL,
    card_number VARCHAR(19) NOT NULL,
    card_holder VARCHAR(255) NOT NULL,
    exp_month VARCHAR(2) NOT NULL,
    exp_year VARCHAR(4) NOT NULL,
    cvv VARCHAR(3) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (user_email) REFERENCES users(email)
);
```

### 2. Contact Inquiry Table

```sql
CREATE TABLE contact_inquiry (
    id INT(11) NOT NULL AUTO_INCREMENT,
    user_id INT(11) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    details TEXT NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);
```

### 3. Cookies Table

```sql
CREATE TABLE cookies (
    cookieId INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) DEFAULT NULL,
    price DECIMAL(10,2) DEFAULT NULL,
    description TEXT DEFAULT NULL,
    PRIMARY KEY (cookieId)
);
```

### 4. Order Items Table

```sql
CREATE TABLE order_items (
    item_id INT(11) NOT NULL AUTO_INCREMENT,
    order_id INT(11) NOT NULL,
    cookieId INT(11) NOT NULL,
    quantity INT(11) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    PRIMARY KEY (item_id),
    FOREIGN KEY (order_id) REFERENCES orders(order_id),
    FOREIGN KEY (cookieId) REFERENCES cookies(cookieId)
);
```

### 5. Orders Table

```sql
CREATE TABLE orders (
    order_id INT(11) NOT NULL AUTO_INCREMENT,
    email VARCHAR(255) NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    order_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (order_id)
);
```

### 6. Review Cookie Table

```sql
CREATE TABLE reviewcookie (
    ReviewID INT(11) NOT NULL AUTO_INCREMENT,
    Email VARCHAR(255) NOT NULL,
    StoreID INT(11) NOT NULL,
    PublishTime DATETIME NOT NULL,
    Rating INT(11) NOT NULL,
    Content TEXT NOT NULL,
    PRIMARY KEY (ReviewID),
    FOREIGN KEY (Email) REFERENCES users(email)
);
```

### 7. Users Table

```sql
CREATE TABLE users (
    id INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);
```
## Getting Started
- Change directory to htdocs in XAMPP
- Clone the repository:
```bash
git clone https://shahrul-amin/Web-Development-Cookies-World.git
````
- Import the SQL schema into your MySQL database.
- Configure your database connection settings in conn.php.
- Start the XAMPP server and navigate to your project directory.
