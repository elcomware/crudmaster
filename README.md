# CrudMaster for Laravel 🧠🛠️

[![Latest Version on Packagist](https://img.shields.io/packagist/v/elcomware/crudmaster.svg?style=flat-square)](https://packagist.org/packages/elcomware/crudmaster)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/elcomware/crudmaster/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/elcomware/crudmaster/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/elcomware/crudmaster/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/elcomware/crudmaster/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/elcomware/crudmaster.svg?style=flat-square)](https://packagist.org/packages/elcomware/crudmaster)

---

**CrudMaster** by **Elcomware** is a premium Laravel package that helps you scaffold professional, scalable, and modern CRUD systems in minutes. It supports full-stack development — from clean API endpoints to dynamic frontend-ready scaffolding for **Inertia.js** or **Blade**-based apps.

---

## 🚀 Features

- ⚙️ Instant CRUD generation (Model, Migration, Controller, Request, Policy, Routes)
- 🎨 Supports Blade or Inertia (Vue) UI stacks
- 🧩 JSON API-ready controllers with clean unified response
- 🧱 Custom stub system for flexible scaffolding
- 📂 Auto-register routes, views, and assets
- ✅ Unified response helpers (Success, Error, Validation)
- 🧪 Built-in test support & publishable config/assets
- 📦 Laravel 10+ and 12+ ready

---

## 📦 Installation

```bash
composer require elcomware/crudmaster
```

### 🔧 If using Laravel < 5.5, manually register the service provider:
```php
// config/app.php
'providers' => [
    CrudMaster\CrudMasterServiceProvider::class,
],
```

---

## 📂 Publish Assets

```bash
php artisan vendor:publish --tag=crudmaster-config     # Configuration file
php artisan vendor:publish --tag=crudmaster-views      # Blade views
php artisan vendor:publish --tag=crudmaster-stubs      # Customizable stubs
php artisan vendor:publish --tag=crudmaster-js         # Inertia-compatible JS
```

---

## ⚡ Quick Start

### Generate CRUD for a resource (e.g. `Post`):
```bash
php artisan crudmaster:make Post
```

#### Options:
| Option | Description |
|--------|-------------|
| `--inertia` | Generate Inertia + Vue scaffolding |
| `--api` | API-only controller |
| `--ui=blade` | Choose `blade`, `inertia`, or `none` |
| `--fields=name:string,email:string,age:integer` | Scaffold with fields |
| `--force` | Overwrite existing files |

---

## 🔄 Response System

CrudMaster includes an intelligent response engine:

```php
respond_success($payload, 'Component', ['extra'], 'Done', 'route.name');
respond_error('Something failed', 'redirect.back', ['details']);
respond_info('FYI message...');
respond_validation_failure($errors);
```

🧠 Automatically detects:
- API (returns JSON)
- Inertia (returns Inertia::render)
- Blade (returns view or redirect)

---

## ⚙️ Config (`config/crudmaster.php`)

```php
return [
    'ui' => 'inertia',
    'default_namespace' => 'App\\Http\\Controllers',
    'response_class' => App\\Http\\Responses\\SuccessResponse::class,
    'routes' => [
        'prefix' => 'admin',
        'middleware' => ['web', 'auth'],
    ],
];
```

---

## 🧪 Testing

CrudMaster is ready for automated testing via Pest or PHPUnit.

```bash
php artisan test
```

---

## 📁 Folder Structure Overview

```
src/
├── Commands/
├── Generators/
├── Responses/
├── Stubs/
├── Helpers/
├── CrudMasterServiceProvider.php
```

---

## 📖 License

CrudMaster is open-source software licensed under the [MIT license](LICENSE).

---

## 💬 Support & Contributions

Need help? Found a bug? Want to contribute?
- Submit issues or PRs via [GitHub](https://github.com/elcomware/crudmaster)
- Commercial/custom feature support: hello@elcomware.com

---

> Your CRUD. Your Stack. Your Control — with **CrudMaster** by Elcomware.

---
