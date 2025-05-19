php artisan make:model Client -ms
php artisan make:model Product -ms
php artisan make:controller Api/ProductApiController
php artisan make:middleware ClientAuth

modif di bagian migration -> model -> controller -> middleware -> provider

php artisan migrate

php artisan make:filament-resource Client --generate
php artisan make:filament-resource Product --generate

modif di filament admin resource

