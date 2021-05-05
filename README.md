## Learning management system 

### First Run

#### 1. Go to lms_auth folder
- run: `composer install`
- Setup your application & auth keys with `composer keys` & check `.env`file (automatically done via composer hook)
- run migrations & seeders with `php artisan migrate --seed`
- A default user is created during seeding: `demo@demo.com` / `password`
- To quickly start a dev server run `php artisan serve`
- Generate your api docs with `artisan apidoc:generate`



#### 2. Go to class_api folder
- run: `composer install`
- go to env: `set database_name`
- run: `php artisan migrate`
- run: `php artisan serve --port 8085`


#### 3. Go to exam_api folder
- run: `composer install`
-  go to env: `set database_name`
- run: `php artisan migrte`
- run: `php artisan serve --port 8083`


#### 4. Go to lms_frontend folder
- run: `npm install`
- run: `npm run serve`
