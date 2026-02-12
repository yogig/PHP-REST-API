CREATE DATABASE IF NOT EXISTS rest_api_db;
USE rest_api_db;

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    category VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Sample data
INSERT INTO products (name, description, price, category) VALUES
('Laptop', 'High-performance laptop', 999.99, 'Electronics'),
('Smartphone', '5G enabled smartphone', 699.99, 'Electronics'),
('Desk Chair', 'Ergonomic office chair', 299.99, 'Furniture'),
('Coffee Maker', 'Automatic coffee maker', 79.99, 'Appliances'),
('Headphones', 'Noise-cancelling headphones', 199.99, 'Electronics');
