# 🛒 Laravel Marketplace App

A simple Laravel-based marketplace for posting basic listings (name, description, price, up to 5 images).  
Stack: **Laravel**, **MySQL**, **Vue.js**, and (optional) **Docker**.

---

## 🚀 First-Time Setup

### Fetch files from repository

```
git clone https://github.com/DARTHxMICHAEL/Marketplace
```

### Enable PHP `zip` Extension
If you're using XAMPP (Windows), open your `php.ini` file (e.g. `C:\xampp\php\php.ini`) and make sure this line is **uncommented**:

```ini
;extension=zip => extension=zip
```
### Install PHP Dependencies

```
composer install
```

### Environment Setup

```
cp .env.example .env
php artisan key:generate
```

### Run Database Migrations and Seeder

```
php artisan migrate:fresh --seed
```

### Install JavaScript Dependencies

```
npm install
```

### Create link between storage locations (for photo saving)

```
php artisan storage:link
```

### Launch the Local Development Server

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
