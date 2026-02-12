# PHP REST API - Product Management

A professional RESTful API built with **pure PHP** (no frameworks) demonstrating clean code architecture and best practices.

## 🚀 Key Features

- ✅ **RESTful Design** - Standard HTTP methods (GET, POST, PUT, DELETE)
- ✅ **MVC Architecture** - Organized code structure
- ✅ **PDO Database** - Secure database interactions with prepared statements
- ✅ **JSON Responses** - Standard API response format
- ✅ **CORS Enabled** - Ready for frontend integration
- ✅ **Clean URLs** - Using .htaccess rewriting

## 🛠️ Tech Stack

- **Backend:** PHP 8.3
- **Database:** MySQL 8.0
- **Architecture:** MVC Pattern
- **Security:** PDO with prepared statements, input sanitization

## 📋 API Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/products` | Get all products |
| GET | `/api/products/{id}` | Get single product |
| POST | `/api/products` | Create new product |
| PUT | `/api/products/{id}` | Update product |
| DELETE | `/api/products/{id}` | Delete product |

## 🎯 Skills Demonstrated

- RESTful API design principles
- Object-oriented PHP programming
- Database design and PDO usage
- Security best practices (prepared statements, input validation)
- MVC design pattern
- Error handling and HTTP status codes


## Requirements
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache with mod_rewrite enabled

## Installation

### 1. Clone the repository
```bash
git clone https://github.com/yogig/php-rest-api-example.git
cd php-rest-api-example
```

### 2. Set up the database
```bash
# Import the database.sql file
mysql -u root -p < database.sql
```

Or use phpMyAdmin:
1. Create a database named `rest_api_db`
2. Import the `database.sql` file

### 3. Configure database connection
Edit `config/Database.php` and update:
```php
private $host = "localhost";
private $db_name = "rest_api_db";
private $username = "root";
private $password = "your_password";
```

### 4. Start the server

**Using PHP Built-in Server:**
```bash
php -S localhost:8000
```

**Using XAMPP/MAMP:**
- Place the folder in `htdocs` or `www` directory
- Access via: `http://localhost/php-rest-api-example/api/products`

## API Endpoints

### Base URL
```
http://localhost:8000/api
```

### 1. Get All Products
```http
GET /api/products
```

**Response:**
```json
{
    "records": [
        {
            "id": "1",
            "name": "Laptop",
            "description": "High-performance laptop",
            "price": "999.99",
            "category": "Electronics",
            "created_at": "2024-01-15 10:30:00"
        }
    ]
}
```

### 2. Get Single Product
```http
GET /api/products/{id}
```

**Example:** `GET /api/products/1`

### 3. Create Product
```http
POST /api/products
Content-Type: application/json

{
    "name": "New Product",
    "description": "Product description",
    "price": 49.99,
    "category": "Category Name"
}
```

### 4. Update Product
```http
PUT /api/products/{id}
Content-Type: application/json

{
    "name": "Updated Product",
    "description": "Updated description",
    "price": 59.99,
    "category": "Updated Category"
}
```

### 5. Delete Product
```http
DELETE /api/products/{id}
```

## Testing the API

### Using cURL

**Get all products:**
```bash
curl http://localhost:8000/api/products
```

**Get single product:**
```bash
curl http://localhost:8000/api/products/1
```

**Create product:**
```bash
curl -X POST http://localhost:8000/api/products \
  -H "Content-Type: application/json" \
  -d '{"name":"Test Product","description":"Test","price":29.99,"category":"Test"}'
```

**Update product:**
```bash
curl -X PUT http://localhost:8000/api/products/1 \
  -H "Content-Type: application/json" \
  -d '{"name":"Updated Product","description":"Updated","price":39.99,"category":"Updated"}'
```

**Delete product:**
```bash
curl -X DELETE http://localhost:8000/api/products/1
```

### Using Postman

1. Download and install [Postman](https://www.postman.com/)
2. Import the included `postman_collection.json` (if provided)
3. Test each endpoint

### Using Browser

For GET requests, simply open:
```
http://localhost:8000/api/products
```

## Project Structure
```
php-rest-api-example/
├── api/
│   └── (symlink to root for clean URLs)
├── config/
│   └── Database.php          # Database configuration
├── models/
│   └── Product.php           # Product model
├── controllers/
│   └── ProductController.php # Product controller
├── .htaccess                 # URL rewriting rules
├── index.php                 # Main entry point
├── database.sql              # Database schema
└── README.md                 # This file
```

## Common Issues

### 1. 404 Errors
- Make sure mod_rewrite is enabled in Apache
- Check if .htaccess is being read

### 2. Database Connection Errors
- Verify database credentials in `config/Database.php`
- Ensure MySQL is running
- Check if database exists

### 3. CORS Issues
- Headers are already set in index.php
- Adjust as needed for your domain

## Next Steps

- Add authentication (JWT tokens)
- Implement pagination
- Add input validation
- Create more models (Users, Orders, etc.)
- Add API documentation (Swagger)

## License

MIT License - feel free to use this for learning or production!

## Contributing

Pull requests are welcome! For major changes, please open an issue first.

## Author

Yogi - [GitHub](https://github.com/yogig)
```

### 8. **`.gitignore`**
```
# IDE
.vscode/
.idea/
*.sublime-project
*.sublime-workspace

# OS
.DS_Store
Thumbs.db

# Logs
*.log

# Config (optional - remove if you want to commit config)
# config/Database.php
