
# Get number app (Symfony 5)

## Requirements

* PHP ^7.2.5 with pdo drivers
* MySQL
* Composer
* Symfony 5 CLI (optional)

## Install

To install this application first you need to clone this repository. Then you need to run composer to download other stuff:

``` bash
git clone https://github.com/max-baranikov/get-number.git

cd get-number
composer install
```

Congrats, now you have all the files downloaded! Next you need to configure app to your environment.

## Configure

To make things works you need to set database configuration to your **.env.local** file:

``` ini
# replace by your db_user, db_password and db_name
DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name
```

Fine. Now you need to create your database and execute the migration in the way to get proper tables in your database:

``` shell
php bin/console doctrine:database:create

php bin/console doctrine:migrations:migrate -n
```

## Usage

### Running the web-server

#### Symfony CLI

If you have `symfony` installed on your system just run:

``` shell
symfony serve
```

Your application will be at *http://localhost:8000*

To stop it just press <kbd>Ctrl</kbd> + <kbd>C</kbd> in your terminal window

#### Local web-server

If you want to use your local web-server (i.e. apache), you can make the symlink to the application in your `/html/` folder

``` shell
ln -s $(pwd) /var/www/html/get-number
```

Your application will be at *http://localhost/get-number/public/index.php/*

### API

API implements the followings methods: 

* ```GET api/numbers/ ``` - method to show all the numbers in the DB
* ```DELETE api/numbers/ ``` - method to remove all the numbers from DB
* ```POST api/numbers/add/{id} ``` - method to add new number to db

Response format is `json` and each api response complements with field `status`, which will be either `0 - fail` or `1 - success`

#### Examples

1. Get all the numbers

```http
GET api/numbers/
```

If everything is right, the response will be like this

```json
{
    "numbers":[1,2,3],
    "status":1
}
```

2. Add number 5

```http
POST api/numbers/add/5
```

Response: 

```json
{
    "number": "6",
    "status": 1
}
```

If the specified `number` or `(number+1)` is already in DB, you'll see the following:

```json
{
    "status": 0,
    "msg": "Number already processed"
}
```

3. Remove all numbers

```http
DELETE api/numbers/
```

Response: 

```json
{
    "deleted": 1,
    "status": 1
}
```

Where `deleted` field is the amount of deleted numbers