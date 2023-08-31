# WEB APP DI TEST PER CLOUD CARE

This project is based on Laravel 10 and the mininum PHP version is 8.1 .

## BASIC INSTALLATION
Install and configure
- Apache
- MySQL

Create a new database named **_cisterninotommaso-cloudcare-test_**

Copy **.env** from **.env.example**

If you need you can edit _**DB_USERNAME**_ and _**DB_PASSWORD**_ too.

After this run via terminal:

    composer install  
    php artisan migrate
    php artisan db:seed
	php artisan jwt:secret 
	php artisan serve  

## INSTALLATION WITH DOCKER (Laravel Sail)
Copy **.env** from **.env.docker**.

On your CLI run

    composer install

On your WLS run
    
    sh ./vendor/bin/sail up

## LARAVEL TESTS
On your **.env** you should set the 8000 port on APP_URL like the following line

    APP_URL=http://localhost:8000

Run on your CLI

    php artisan serve

For run all avaiable tests run on an other CLI
    
    php artisan test
