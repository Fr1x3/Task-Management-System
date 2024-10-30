# Simple Task Management System API

a simple Restful API implementation using Lumen that allows users to manage tasks.

## Requirements
- PHP >= 8.0
- OpenSSL PHP Extension
- PDO PHP Extension
- PDO PGSQL Extension
- Postgress Database
- composer dependency manager

## How to install this project
1. clone the project.
2. Go into the Task-Management-System folder using cd command
3. Run composer install on your cmd or terminal.
4. Copy the .env.example file to the root folder and rename to .env
5. Open the .env file and change the database connection (DB_Connection) to pgsql, the database name (DB_DATABASE), username (DB_USERNAME), port (DB_PORT) and password (DB_PASSWORD) to match the corresponding field configuration of your postgres database.
6. run php artisan key:generate
7. run php artisan migrate
8. run php artisan db:seed
9. run php -S localhost:8000 -t public

Finally, the api is up and running. Enjoy tinkering with it.
 

