# ESA Backend

## Installation

### 1- Clone repository:
    git clone git@github.com:esaeg/EsaWebsite_Back_end.git

### 2- Go to the project folder
    cd EsaWebsite_Back_end

### 3- Change to working branch (dev)
    git checkout dev

### 4- Run composer to set up all dependencies
    composer install

### 5- Create .env file from .env.environment file:
    nano .env.example
and save it with *.env*

then, update the database connection information in the .env file with your database credentials

    DB_DATABASE=esa_website
    DB_USERNAME=root
    DB_PASSWORD=12345678

### 6- Run migrate to install databases
    php artisan migrate

### 7- Run seed to add data to database
    php artisan dashboard:seed

just after you see `Seeding PaymentSeeder ...` you can cancel the process by `ctrl + c`

there is a problem ending seeder form dashboard package

### 8- Generate Key and clear cache
    php artisan key:generate
    php artisan config:cache

### 9- install node models
    npm install

### 10- Compile and minimize scss & js files by vite
    npm run dev

### 11- Start laravel server
    php artisan serve

### 12- Dashboard login
    http://127.0.0.1:8000/dashboard/login

    email: admin@admin.com
    password: 12345678

## Working with git
*   Create a new branch from dev branch
    *   git checkout dev
    *   git pull
    *   git checkout -b <branch_name>
*  After finishing your work
    *   git add .
    *   git commit -m "your message"
    *   git push origin <branch_name>
*  Create a pull request from your branch to dev branch
*  After merging your branch to dev branch
    *   git checkout dev
    *   git pull

## Deploying to server

* dev branch will auto deploy to dev server under this domain: https://stage.esaeg.org/