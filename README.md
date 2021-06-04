# [Laravel Sanctum Token API Example]


# Getting started

## System Requirements
* PHP 7.3+
* MySQL
* Composer


## Installation

* Clone the repository
```
  git clone https://github.com/soorajlalkg/laravel-sanctum-demo.git
```
* Switch to the repo folder
```
   cd laravel-sanctum-demo
```
* Install all the dependencies using composer
```
    composer install
```
* Copy the example env file and make the required configuration changes in the .env file
```
    cp .env.example .env
```
* Run the database migrations (**Set the database connection in .env before migrating**)
```
    php artisan migrate
```
* Start the local development server
```
    php artisan serve
```
You can now access the server at http://localhost:8000

**command list**
```
    git clone https://github.com/soorajlalkg/laravel-sanctum-demo.git
    cd laravel-sanctum-demo
    composer install
    cp .env.example .env
```    
**Make sure you set the correct database connection information before running the migrations**
```
    php artisan migrate
    php artisan serve
```

The api can be accessed at [http://localhost:8000/api](http://localhost:8000/api).

## API Specification

###### Authorization Type: Bearer Token


EndPoint | Method | Description | Request Body | Token Required |
|---|---|---|---|---|
| /api/register | POST | Create account | {"name":"", "email":"","password":"", "password_confirmation":""} | No | 
| /api/login | POST |Login | {"email":"","password":""} | No | 
| /api/me | GET |Get current user details | | Yes |
| /api/logout | POST |Logout |  | Yes | 
