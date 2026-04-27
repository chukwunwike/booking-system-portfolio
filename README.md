# 📅 Booking System (Laravel + Core PHP Hybrid)

A production-ready service booking application built with **Laravel 12** and a **framework-agnostic Core PHP Booking Engine** using raw PDO. Demonstrates the ability to blend modern framework tooling with vanilla PHP for performance-critical logic.

![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?style=flat-square&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat-square&logo=php&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green?style=flat-square)

---

## ✨ Features

### Core PHP Booking Engine (`App\CorePHP\BookingEngine`)
- **Raw PDO** — No ORM, no Eloquent. Pure SQL with prepared statements.
- **Transaction Locking** — `beginTransaction()` / `commit()` / `rollBack()` to prevent double bookings.
- **Overlap Detection** — SQL-level time-slot collision check before insert.
- **Date Validation** — Vanilla `DateTime::createFromFormat()` sanitization.

### Laravel Integration
- **Breeze Authentication** — Full login/register/password reset flow.
- **Service Catalog** — Dynamic service listing on the homepage.
- **Booking Management** — Authenticated users can create and view bookings.
- **Tailwind CSS** — Modern, responsive UI built with Tailwind and Vite.

---

## 🛠️ Tech Stack

| Layer | Technology |
|-------|-----------|
| Framework | Laravel 12, PHP 8.2+ |
| Core Engine | Raw PDO (framework-agnostic) |
| Auth | Laravel Breeze |
| Database | SQLite (local) / MySQL (prod) |
| Frontend | Blade, Tailwind CSS, Vite |

---

## 🚀 Setup

```bash
git clone https://github.com/chukwunwike/booking-system-portfolio.git
cd booking-system-portfolio
composer install
npm install && npm run build
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

---

## 📂 Architecture

```
app/
├── CorePHP/
│   └── BookingEngine.php      # Pure PHP PDO engine (no framework deps)
├── Http/Controllers/
│   └── BookingController.php  # Laravel controller bridging the engine
├── Models/
│   ├── Booking.php
│   ├── Service.php
│   └── User.php
└── ...
```

---

## 📝 License

Open-source under the [MIT License](LICENSE).
