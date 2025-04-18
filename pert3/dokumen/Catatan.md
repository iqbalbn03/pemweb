
# Tutorial Setup Laravel dan Livewire

## 1. Pertama Konfigurasi Docker Compose

```yml
services:
  pemweb:
    build: ./php
    image: pemweb_php:latest
    container_name: pemweb
    hostname: "pemweb"
    volumes:
      - ./src:/var/www/html
      - ./php/www.conf:/usr/local/etc/php-fpm.d/www.conf
    working_dir: /var/www/html
    depends_on:
      - db_pemweb
      
  db_pemweb:
    image: mariadb:10.2
    container_name: db_pemweb
    restart: unless-stopped
    tty: true
    ports:
      - "13306:3306"
    volumes:
      - ./db/data:/var/lib/mysql
      - ./db/conf.d:/etc/mysql/conf.d:ro
    environment:
      MYSQL_USER: djambred
      MYSQL_PASSWORD: p455w0rd1!.
      MYSQL_ROOT_PASSWORD: p455w0rd
      TZ: Asia/Jakarta
      SERVICE_TAGS: dev
      SERVICE_NAME: mysql_pemweb
      
  nginx_pemweb:
    build: ./nginx
    image: nginx_pemweb:latest
    container_name: nginx_pemweb
    hostname: "nginx_pemweb"
    ports:
      - "80:80"
    volumes:
      - ./src:/var/www/html
      - ./nginx/nginx.conf:/etc/nginx/conf.d/default.conf
    depends_on:
      - pemweb
```

**Command untuk build:**
```bash
docker compose up -d --build
```

## 2. Setup Proyek Laravel

**Masuk ke container:**
```bash
docker exec -it pemweb bash
```

**Buat proyek Laravel:**
```bash
composer create-project --prefer-dist raugadh/fila-starter .
```

**Konfigurasi .env:**
```ini
APP_NAME="PemWeb"
APP_URL=http://localhost
ASSET_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=db_pemweb
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=p455w0rd
```

**Generate key dan setup:**
```bash
php artisan key:generate
php artisan storage:link
```

**Migrasi database:**
```bash
php artisan migrate
php artisan migrate:fresh
```

**Setup shield dan database:**
```bash
php artisan shield:generate --all
php artisan db:seed --force
```

**Inisialisasi proyek:**
```bash
php artisan project:init
```

**Set permission:**
```bash
chmod 777 -R storage/* && chmod 777 -R bootstrap/*
```

## 3. Konfigurasi Livewire

### Struktur Folder

1. **Public Folder:**
   ```
   public/
   ├── front/
   │   ├── css/
   │   ├── images/
   │   │   └── Phone-theme.jpg
   │   ├── js/
   │   └── plugins/
   ```

2. **Resources Folder:**
   ```
   resources/
   ├── views/
   │   ├── components/
   │   │   └── layouts/
   │   │       └── app.blade.php
   │   ├── livewire/
   │   │   └── show-home-page.blade.php
   │   └── welcome.blade.php
   ```

### File App Blade 

```html
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>{{ $title ?? 'PemWeb' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <meta name="description" content="This is meta description">
    <meta name="author" content="Themefisher">
    <link rel="shortcut icon" href="{{ asset('front/images/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('front/images/favicon.png') }}" type="image/x-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- CSS Plugins -->
    <link rel="stylesheet" href="{{ asset('front/plugins/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('front/plugins/font-awesome/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/plugins/font-awesome/brands.css') }}">
    <link rel="stylesheet" href="{{ asset('front/plugins/font-awesome/solid.css') }}">

    <!-- Main Style Sheet -->
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}">
    @livewireStyles
</head>

<body>
    <!-- Navigation -->
    <header class="navigation bg-tertiary">
        <nav class="navbar navbar-expand-xl navbar-light text-center py-3">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img loading="prelaod" decoding="async" class="img-fluid" width="160" src="{{ asset('front/images/logo.png') }}" alt="Wallet">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> 
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav m-auto mb-2 mb-lg-0">
                        <li class="nav-item"> <a wire:navigate class="nav-link" href="{{ route('home') }}">Home</a></li>
                        <li class="nav-item"> <a wire:navigate class="nav-link" href="{{ route('profile') }}">Profile</a></li>
                    </ul>			
                </div>
            </div>
        </nav>
    </header>

    {{ $slot }}

    <footer class="section-sm bg-tertiary">
        <div class="container">
            <div class="container d-flex justify-content-center">
                <a wire:navigate href="{{ route('home') }}"> Copyright 2025</a>
            </div>
        </div>
    </footer>

    <!-- JS Plugins -->
    <script src="{{ asset('front/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('front/plugins/bootstrap/bootstrap.min.js') }}"></script>

    <!-- Main Script -->
    <script src="{{ asset('front/js/script.js') }}"></script>
    @livewireScripts
</body>
</html>
```

### Livewire Component

**ShowHomePage.php:**
```php
<?php

namespace App\Livewire;

use Livewire\Component;

class ShowHomePage extends Component
{
    public function render()
    {
        return view('livewire.show-home-page');
    }
}
```

**show-home-page.blade.php:**
```php
<main>
    <section class="banner bg-tertiary position-relative overflow-hidden">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="block text-center text-lg-start pe-0 pe-xl-5">
                        <h1 class="text-capitalize mb-4">Innovate. Excel. Succeed!</h1>
                        <p class="mb-4">Unlocking Potential, Igniting Excellence</p> 
                        <a type="button" class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#applyLoan">
                            See More<span style="font-size: 14px;" class="ms-2 fas fa-arrow-right"></span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ps-lg-5 text-center">
                        <img loading="lazy" decoding="async" 
                            src="{{ asset('front/images/about-us.png') }}"
                            alt="banner image" class="w-100">
                    </div>
                </div>
            </div>
        </div>
        <!-- SVG shapes -->
    </section>
</main>
```

### Routing

**web.php:**
```php
<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\ShowHomePage;

Route::get('/', ShowHomePage::class)->name('home');
```

## Struktur Lengkap Proyek

```
project/
├── docker-compose.yml
├── src/
│   ├── app/
│   │   ├── Livewire/
│   │   │   └── ShowHomePage.php
│   ├── public/
│   │   ├── front/
│   │   │   ├── css/
│   │   │   ├── images/
│   │   │   ├── js/
│   │   │   └── plugins/
│   ├── resources/
│   │   ├── views/
│   │   │   ├── components/
│   │   │   │   └── layouts/
│   │   │   │       └── app.blade.php
│   │   │   ├── livewire/
│   │   │   │   └── show-home-page.blade.php
│   │   │   └── welcome.blade.php
│   ├── routes/
│   │   └── web.php
```
