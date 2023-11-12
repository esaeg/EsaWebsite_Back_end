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
    `nano .env.example` and save it with *.env*

update the database connection information in the .env file with your database credentials

    DB_DATABASE=esa_website
    DB_USERNAME=root
    DB_PASSWORD=12345678

### 6- Run migrate to install databases

    php artisan migrate

### 7- Run seed to add data to database
    php artisan db:seed

### 8- Generate Key and clear cache

    php artisan key:generate
    php artisan config:cache

### 9- Install all dependencies for dashboard

    php artisan vendor:publish

### 10- Install dashboard and seed

    php artisan dashboard:setup
    php artisan dashboard:seed


### 11- install node models
    npm install

### 12- Compile and minimize scss & js files by vite
    npm run dev

### 13- start laravel server
    php artisan serve

### 14- dashboard login
    http://127.0.0.1:8000/dashboard/login

    email: admin@admin.com
    password: 12345678

### 15- Change permission for these folders and files
    sudo chmod -R 775 storage vendor

### 16- Run config:cache to update the .env file

    php artisan config:cache

## Working on git
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