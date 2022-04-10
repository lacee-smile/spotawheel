# This is Laszlo Karsai's assesement for Spotawheel
## Technologies:
<ul>
  <li>Laravel 9</li>
  <li>VueJS 3 with TypeScript</li>
  <li>PHP 8.1</li>
  <li>PostgeSQL 12.9</li>
</ul>

## Setup
 - Edit the DB connection environment variables in .env file.
 - Edit the APP_URL in .env file if needed.
 - Run `composer install` in backend folder.
 - Run migration and seed command using `php artisan migrate --seed`
 - Run `php artisan serve`
 - Run `npm install` in frontend folder.
 - Run `npm run serve`

## Functionality
<ul>
  <li>List clients with their latest payment amount and date</li>
  <li>Filter by payment date range</li>
  <li>Export clients and their last payments into CSV</li>
</ul>

### Export usage
This command will result a report from now back 30 days named 'client.csv'.
```php
php artisan export:clients
```
Export options:
 - Change exported file name. Default: 'clients.csv'. Extension is required
     ```php
     php artisan export:client --filename=export.csv
     ```
 - Change the report end date. Default: today. Format should be in Y-m-d format.
    ```php
    php artisan export:client --date=2020-04-01
    ```
 - Change how many days counts before the end date. Default: 30
    ```php
    php artisan export:client --days=100
    ```

## Unit test
```php
php artisan test
```
