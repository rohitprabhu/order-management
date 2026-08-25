# Order Management Backend API (Laravel)

This Application is built on Laravel 13. It serves product and order management APIs to the frontend application or any third party integrations.

## Laravel Coding Standards Used

-   Eloquent Relationship between Product, Order & Order Item Entities
-   API Authentication using Bearer Token
-   Laravel API Resources used for exposing web services
-   FormRequests utilized to handle validation for request params
-   Migrations used for managing database schemas
-   Database Seeders used to populate database tables


## Usage

#### Install composer dependencies

```
composer install
```
#
#### Add .env Variables

Rename the `.env.example` file to `.env` and add your database values. Change driver and port as needed.

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```
#
#### Run Migrations

```
php artisan migrate
```
#
#### Seed Database

You can seed the database with products

```
php artisan db:seed
```
#
#### Run Server

If you are using artisan to serve, run the following:

```
php artisan serve
```

Open http://localhost:8000

#
#### EXPOSED API ENDPOINTS
Tested API endpoints with "POSTMAN" application. To be able to access the resource you need to first generate an API Key using `GET http://127.0.0.1:8000/client-key`. Once you have the API key, pass it as the "Bearer Token" in Authorization Headers of subsequent API requests.

The token has an expiration limit of 30m after that you will have to re-generate it.
```
Create Order - 
POST http://127.0.0.1:8000/api/orders
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
GET http://127.0.0.1:8000/api/products
```
```
List Products (pagination) - 
GET http://127.0.0.1:8000/api/products?pageSize=5
```
```
List Products (stock filter) - 
GET http://127.0.0.1:8000/api/products?in_stock=0
```
#

#### PLEASE NOTE

In this project I have not created any dummy customers. You can use `POST /api/orders` passing in any customer email, I'm treating every customer as a guest user and that's why I have maintained an `is_guest` flag in `orders` table. This flag can be used in the future in case we have customer login flow.
