## LMS

### First Run

#### 1. Go to lms_auth folder
###### 1.1  run: `composer install`
- copy `env.example` to `.env`
- Setup your application & auth keys with `composer keys` & check `.env`file (automatically done via composer hook)
- run migrations & seeders with `php artisan migrate --seed`
- A default user is created during seeding: `demo@demo.com` / `password`
- To quickly start a dev server run `.php artisan serve`
- Generate your api docs with `artisan apidoc:generate`



#### 2. Go to class_api folder
###### 2.1  run: `composer install`
- install dependencies
- copy`env.example` to `.env`
- generate key `php artisan key:generate`

###### 2.2  run: `php artisan migrate`
###### 2.3  run: `php artisan serve --port 8085`


#### 3. Go to exam_api folder
###### 3.1  run: `composer install`
(follow 3.1)
###### 3.2  run: `php artisan migrte`
###### 3.3  run: `php artisan serve --port 8083`


#### 4. Go to lms_frontend folder
###### 4.1  run: `npm install`
###### 4.2  run: `npm run serve`
