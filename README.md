# TEST PER CLOUD CARE

This project is based on Laravel 10.

## BASIC INSTALLATION
Install and configure
- Apache
- MySQL

Create a new database named **_cisterninotommaso-cloudcare-test_**

In **.env** set the following VARIABLE:

    DB_HOST=127.0.0.1  


If you need you can edit _**DB_USERNAME**_ and _**DB_PASSWORD**_ too.

After this run via terminal:

    composer install  
    php artisan migrate
	php artisan jwt:secret 
	php artisan serve  

## INSTALLATION WITH DOCKER
In **.env.example** set the following VARIABLE:

	DB_HOST=cisterninotommaso-cloudcare-test

then run

	bash ./vendor/laravel/sail/bin/sail up
