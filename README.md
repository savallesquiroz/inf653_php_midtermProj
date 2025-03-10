# INF653 PHP Midterm Project - REST API

## 📌 Project Overview
This project is a RESTful API built with PHP and PostgreSQL for managing quotes, authors, and categories. It allows users to create, read, update, and delete records via HTTP requests.

## 📁 Project Structure
```
inf653_php_midtermProj/
│── api/
│   │── quotes/
│   │   ├── index.php  # Routes API requests
│   │   ├── read.php   # Get all quotes
│   │   ├── read_single.php # Get a specific quote
│   │   ├── create.php # Create a new quote
│   │   ├── update.php # Update a quote
│   │   ├── delete.php # Delete a quote
│   │── authors/
│   │── categories/
│── config/
│   ├── Database.php # Database connection class
│── models/
│   ├── Quote.php    # Quote model
│   ├── Author.php   # Author model
│   ├── Category.php # Category model
│── .htaccess # Environment variables (ignored in GitHub)
│── .gitignore  # Specifies files to exclude from Git
│── README.md  # Documentation
```

## 🚀 Setup Instructions
### 1️⃣ Clone the Repository
```sh
git clone https://github.com/yourusername/inf653_php_midtermProj.git
cd inf653_php_midtermProj
```

### 2️⃣ Configure Environment Variables
Create a `.htaccess` file in the root directory and add:
```apache
SetEnv DB_HOST 
SetEnv DB_NAME 
SetEnv DB_USER 
SetEnv DB_PASS 
```
✅ **Make sure `.htaccess` is added to `.gitignore` to avoid exposing credentials.**

### 3️⃣ Start Apache & PostgreSQL in XAMPP
- Open **XAMPP Control Panel**
- **Start Apache**

### 4️⃣ Verify Database Connection
Create a `check_env.php` file:
```php
<?php
echo "DB_NAME: " . getenv('DB_NAME');
?>
```
Run in browser:
```
http://localhost/inf653_php_midtermProj/check_env.php
```
Expected Output:
```
DB_NAME: quotesdb
```

## 🛠️ API Endpoints
| Method | Endpoint              | Description               |
|--------|----------------------|---------------------------|
| GET    | /api/quotes/         | Get all quotes            |
| GET    | /api/quotes/?id=1    | Get a specific quote      |
| POST   | /api/quotes/         | Create a new quote        |
| PUT    | /api/quotes/         | Update an existing quote  |
| DELETE | /api/quotes/         | Delete a quote            |

## 🧪 Testing in Postman
1️⃣ **Open Postman**  
2️⃣ **Test `GET /api/quotes/`**:
   - Method: **GET**
   - URL: `http://localhost/inf653_php_midtermProj/api/quotes/`
   - Expected Response:
     ```json
     { "message": "No Quotes Found" }
     ```

3️⃣ **Test `POST /api/quotes/`**:
   - Method: **POST**
   - URL: `http://localhost/inf653_php_midtermProj/api/quotes/`
   - Body (JSON):
     ```json
     {
         "quote": "The best way to predict the future is to create it.",
         "author_id": 1,
         "category_id": 1
     }
     ```

## 📌 Notes
- Ensure that the database **quotesdb** exists and contains the required tables.
- Restart **Apache** in XAMPP after changing `.htaccess`.
- Database credentials are managed via `.htaccess` and **must not be pushed to GitHub**.

---

**✅ Project Completed by: Steve Alexander Valles Quiroz

