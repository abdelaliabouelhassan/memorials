<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>



## Project Setup

make sure to have php 8.2 install

and node js version >= 20

and mysql database

### steps

- clone or download the project
- open terminal and Navigate to Project Root
- run **composer install**
- run **npm install**
- create a file name it **.env**
- Locate the .env.example file and copy its contents.
- Paste the copied content into the newly created **.env** file.
- Inside the .env file, locate and update the following database configuration <br>
DB_DATABASE= <br>
DB_USERNAME= <br>
DB_PASSWORD= <br>
- run **php artisan key:generate**
- run **php artisan migrate**

### serve the project

- run **php artisan serve**
- run **npm run dev**



