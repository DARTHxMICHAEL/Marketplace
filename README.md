# 🛒 Laravel Marketplace App

A simple Laravel-based marketplace for posting basic listings (name, description, price, up to 5 images).  
Stack: **Laravel**, **MySQL**, **Vue.js**, and (optional) **Docker**.

---

## 🚀 First-Time Setup (Without Docker)

### 1. Enable PHP `zip` Extension
If you're using XAMPP (Windows), open your `php.ini` file (e.g. `C:\xampp\php\php.ini`) and make sure this line is **uncommented**:

```ini
;extension=zip => extension=zip
```
### 2. Install PHP Dependencies

```
composer install
```

### 3. Environment Setup

```
cp .env.example .env
php artisan key:generate
```

### 4. Run Database Migrations and Seeder

```
php artisan migrate:fresh --seed

```

### 5. Install JavaScript Dependencies

```
npm install
```

### 6. Launch the Local Development Server

```
cd project-location
php artisan serve

cd project-location
npm run dev
```

## 🐳 Docker (Coming Soon)

```
docker-compose up -d --build
```
