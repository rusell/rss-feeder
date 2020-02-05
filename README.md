## Setup instructions

Please, follow these steps to setup development environment quickly. Open your terminal and do the following:

- Run *composer install*
- Rename .env.dev file to .env
- Open .env file and specify **absolute** path to the database.sqlite file which is located under project's <root_folder
\>/database 
- Run *php artisan key:generate*
- Run *php artisan serve*

Your own local environment should be up and running by now, and serving on *http://localhost"8000*.

Best regards!
