# Installation
```bash
composer require wowpack/laravel-currency
```
# Setup
### Setup provider:
Add the provider into the config/app.php file.
```php
\Wowpack\LaravelCurrency\Providers\CurrencyServiceProvider::class
```
### Publish:
Publish configurations and migrations.
```bash
php artisan vendor:publish --provider="Wowpack\LaravelCurrency\Providers\CurrencyServiceProvider"
```
