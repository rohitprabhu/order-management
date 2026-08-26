# Order Management Backend API (Laravel)

<span style="font-size: 14px;">This Application uses "Laravel 13" as its core framework. It serves product and order management APIs to the frontend application or any third party integrations.</span>

## Laravel Coding Standards Used

-   <span style="font-size: 14px;">Eloquent Relationship between Product, Order & Order Item Entities
-   <span style="font-size: 14px;">API Authentication using Bearer Token
-   <span style="font-size: 14px;">Laravel API Resources used for exposing web services
-   <span style="font-size: 14px;">FormRequests utilized to handle validation for request params
-   <span style="font-size: 14px;">Migrations used for managing database schemas
-   <span style="font-size: 14px;">Database Seeders used to populate database tables

## Application Tools

- <span style="font-size: 14px;">PHP - 8.3
- <span style="font-size: 14px;">COMPOSER - 2.8
- <span style="font-size: 14px;">GIT - 2.43.0
- <span style="font-size: 14px;">GITHUB Account
- <span style="font-size: 14px;">LARAVEL - 13
- <span style="font-size: 14px;">MySQL - 8.0
- <span style="font-size: 14px;">MySQL WORKBENCH (GUI)
- <span style="font-size: 14px;">POSTMAN

## Usage

#### <span style="font-size: 14px;">Install composer dependencies

```
composer install
```
#
#### <span style="font-size: 14px;">Add .env Variables

<span style="font-size: 14px;">Rename the `.env.example` file to `.env` and add your database values. Change driver and port as needed.

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```
#
#### <span style="font-size: 14px;">Run Migrations

```
php artisan migrate
```
#
#### <span style="font-size: 14px;">Seed Database

You can seed the database with products

```
php artisan db:seed
```
#
#### <span style="font-size: 14px;">Run Server

<span style="font-size: 14px;">If you are using artisan to serve, run the following:

```
php artisan serve
```

<span style="font-size: 14px;">Open http://localhost:8000

#
#### <span style="font-size: 14px;">EXPOSED API ENDPOINTS
<span style="font-size: 14px;">Tested API endpoints with "POSTMAN" application. To be able to access the resource you need to first generate an API Key using this endpoint: `GET http://127.0.0.1:8000/client-key`. Once you have the API key, pass it as the "Bearer Token" in Authorization Headers for subsequent API requests.

<span style="font-size: 14px;">The Bearer Token has an expiration limit of 30m after that you will have to re-generate it to make further API calls.
```
Create Order - 
POST http://localhost:8000/api/orders
```

```
Payload - 
{
  "customerEmail": "rohitprabhu10121@gmail.com",
  "items": [
    {
      "productId": "1",
      "quantity": 2
    },
    {
      "productId": "4",
      "quantity": 1
    }
  ],
  "status": "pending"
}
```
```
List Products - 
GET http://localhost:8000/api/products
```
```
List Products (pagination) - 
GET http://localhost:8000/api/products?pageSize=5
```
```
List Products (stock filter) - 
GET http://localhost:8000/api/products?in_stock=0
```
#

#### <span style="font-size: 14px;">PLEASE NOTE

<span style="font-size: 14px;">In this project I have not created any dummy customers. You can use `POST /api/orders` passing in any customer email, I'm treating every customer as a guest user and that's why I have maintained an `is_guest` flag in `orders` table. This flag can be used in the future in case we have customer login flow as part of the Order Management Backend App.
