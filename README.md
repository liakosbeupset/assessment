# Assessment

Follow these steps to get the project up and running locally:

### 1. Clone the Repository

```bash
git clone https://github.com/liakosbeupset/assessment.git
cd assessment
```

### 2. Create Your `.env` File

```bash
cp .env.example .env
```

Create your mysql database and update the following database fields in your `.env` file:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_db_username
DB_PASSWORD=your_db_password
```

Otherwise you can go with sqlite database by using:
```dotenv
DB_CONNECTION=sqlite
```


### 3. Install PHP Dependencies

```bash
composer install
```

### 3.1 Optional (if needed)

```bash
php artisan key:generate
```

### 4. Install JS Dependencies

```bash
npm install
```

### 5. Build Frontend Assets

```bash
npm run build
```

### 6. Run Migrations

Make sure your database is created, then run:

```bash
php artisan migrate
```

### 7. Start the Server or visit your server's path in the browser

```bash
php artisan serve
```

### 8. Fetch Data

Initially there is no data in the databse, we just click the Fetch Data button in the index page to fetch data from the public API:

```bash
https://jsonplaceholder.typicode.com/posts
```
