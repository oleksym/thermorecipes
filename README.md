# Installation guide
```
git clone https://github.com/oleksym/thermorecipes.git thermorecipes && cd thermorecipes
composer install
npm install
npm run prod
```
Create .env file (or copy from .env.example) and configure database connection

```
php artisan migrate --step --seed
```
