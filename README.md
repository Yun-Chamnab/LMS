## LMS

### First Run

#### 1. Go to lms_auth folder
###### 1.1  run: composer install
###### 1.2  run: php artisan migrate
###### 1.3  run: php artisan server


#### 2. Go to class_api folder
###### 2.1  run: composer install
###### 2.2  run: php artisan migrate
###### 2.3  run: php artisan server --port 8085


#### 3. Go to exam_api folder
###### 3.1  run: composer install
###### 3.2  run: php artisan migrate
###### 3.3  run: php artisan server --port 8083


#### 4. Go to lms_frontend folder
###### 4.1  run: npm install
###### 4.2  run: npm run serve
