# LMS

## First Run

### 1. Go to lms_auth folder run: composer install
#### 1.1. run: php artisan migrate
#### 1.2. run: php artisan server

### 2. Go to class_api folder run: composer install
#### 2.1. run: php artisan migrate
#### 2.2. run: php artisan server --port 8085

### 3. Go to exam_api folder run: composer install
#### 3.1. run: php artisan migrate
#### 3.2. run: php artisan server --port 8083


### 4. Go to lms_frontend folder run: npm install
#### 4.1. run: npm run serve
