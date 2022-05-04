Here's the steps to run the project
1- clone the repository to your localhost
2- run the command composer install to install all the dependencies 
3- run the command php artisan key:generate
4- copy .env.example file to .env
5- create mysql database with name karma_db
6- run php artisan migrate
7- run php artisan db:seed, this will insert 100,000 records into images and users tables in DB
8- run php artisan serve to start the project
9- call the API as below
http://127.0.0.1:8000/api/v1/user/{id}
you have use ids from 1 to 100,000
example:
http://127.0.0.1:8000/api/v1/user/2000

the return response consists of 4 attributes
1- count: the count of returned data (how many records returned by the API)
2- data: array of returned data
3- success: true or false based on if the API found data in DB or not
4- message: result message