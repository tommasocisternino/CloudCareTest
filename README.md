# WEB APP DI TEST PER CLOUD CARE

This project is based on Laravel 10.

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
Copy **.env** from **.env.example**

On your WSL run
    
	composer install
    sh ./vendor/bin/sail up

