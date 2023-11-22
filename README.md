# Trivia Project
> This project is an interview project for a Full Stack PHP Web Developer position.

### Required Php & Laravel

- Php : 8.1
- Laravel Framework : 10.32.1

## Installation
> Make sure you have installed the required Php and Laravel versions.

Firstly, download the project and enter the project folder. For Linux users `cd trivia-project`

1 . Install `Composer` dependencies.
```sh
composer install
```

2 . Copy `.env.example` file and create dublicate. Use `cp` command for Linux user.  
```sh
cp .env.example .env
```

3 . The following code will create the necessary tables.
```sh
php artisan migrate
```

4 . To start the localhost server, use the following command.
```sh
php artisan serve
```
