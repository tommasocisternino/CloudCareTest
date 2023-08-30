# WEB APP DI TEST PER CLOUD CARE

This project is based on Laravel 10.

## BASIC INSTALLATION
Install and configure
- Apache
- MySQL

Create a new database named **_cisterninotommaso-cloudcare-test_**

Copy **.env** from **.env.example** and set the following VARIABLE:

    DB_HOST=127.0.0.1  


If you need you can edit _**DB_USERNAME**_ and _**DB_PASSWORD**_ too.

After this run via terminal:

    composer install  
    php artisan migrate
    php artisan db:seed
	php artisan jwt:secret 
	php artisan serve  

## INSTALLATION WITH DOCKER
run

	docker-compose up -d
