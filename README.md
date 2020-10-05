## How to install

clone my repository into folder
e.g. /weblog/

```sh
git clone https://github.com/maksimtvg/weblog.git weblog
cd weblog/
git submodule add https://github.com/Laradock/laradock.git
```

####Set up laradock config 
```sh
cd laradock/ & cp env-example .env
```


####Change .env file
``APP_CODE_PATH_HOST = ../../weblog``<br>
``PHP_VERSION=7.3``
 
###How to run
```sh
docker-compose up -d nginx php-fpm workspace
docker-compose exec workspace bash

cp env.example .env
composer install
artisan key:generate
```

Finally, check out http://localhost/parse-log/webserver.log
