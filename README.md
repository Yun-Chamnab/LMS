## LMS

### First Run

#### 1. Go to lms_auth folder
###### 1.1  run: `composer install`
- run `composer install` to install dependencies (consider using homestead via `vagrant up`)
- copy `env.example` to `.env`
- Setup your application & auth keys with `composer keys` & check `.env`file (automatically done via composer hook)
- run migrations & seeders with `artisan migrate --seed` (within your vm using `vagrant ssh`)
- A default user is created during seeding: `demo@demo.com` / `password`
- To quickly start a dev server run `./artisan serve` (or via `homestead.test` for the vm)
- Also consider running `composer meta` when adding models for better autocompletion (automatically done via composer hook)
- Run included tests with `phpunit` within vagrant's code directory
- Generate your api docs with `artisan apidoc:generate`
###### 1.2  run: `php artisan migrate`
###### 1.3  run: `php artisan serve`


#### 2. Go to class_api folder
###### 2.1  run: `composer install`
###### 2.2  run: `php artisan migrate`
###### 2.3  run: `php artisan serve --port 8085`


#### 3. Go to exam_api folder
###### 3.1  run: `composer install`
###### 3.2  run: `php artisan migrte`
###### 3.3  run: `php artisan serve --port 8083`


#### 4. Go to lms_frontend folder
###### 4.1  run: `npm install`
###### 4.2  run: `npm run serve`
