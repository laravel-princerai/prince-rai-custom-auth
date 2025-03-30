# Custom Auth Package for Laravel

## 📌 Introduction

This package provides a custom authentication system for Laravel applications, including login, registration, and logout functionality. It allows you to integrate authentication quickly without rewriting the logic every time.

## 🛠️ Installation

### 1️⃣ **Install via Composer**

Run the following command in your Laravel project:

```sh
composer require prince-rai/custom-auth
```

### 2️⃣ **Publish Package Assets**

After installation, publish the package assets (views, config, migrations) using:

```sh
php artisan vendor:publish --provider="PrinceRai\CustomAuth\CustomAuthServiceProvider"
```

This will copy:

- Views to `resources/views/vendor/custom-auth/`
- Config file to `config/custom-auth.php`

### 3️⃣ **Run Migrations** (if needed)

```sh
php artisan migrate
```

## 🚀 Usage

### **Routes**

The package automatically loads authentication routes. If you need to reference them manually, add these in your `routes/web.php`:

```php
use PrinceRai\CustomAuth\Controllers\LoginController;
use PrinceRai\CustomAuth\Controllers\RegisterController;

Route::middleware(['web'])->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/custom-login', [LoginController::class, 'authLogin'])->name('custom.login');
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('custom.register');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/home', [LoginController::class, 'home'])->name('home');
});
```

### **Views**

After publishing, the authentication views will be in:

```
resources/views/vendor/custom-auth/
```

To modify them, edit files in this directory.

### **Controllers**

The package provides `LoginController` and `RegisterController`. You can extend them in your Laravel app if needed.

## ⚙️ Configuration

The package provides a configuration file at `config/custom-auth.php`. You can modify authentication settings there.

## ❌ Uninstallation

If you need to remove the package, run:

```sh
composer remove prince-rai/custom-auth
```

## 📜 License

This package is open-source and licensed under the [MIT License](LICENSE).
