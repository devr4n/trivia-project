# Trivia Project
> It is a simple project using api from [Open Trivia Database](https://opentdb.com/).
> Simple bootstrap elements are used in the project and unit test is created for test the project.

### Required Php & Laravel

- Php : 8.1
- Laravel Framework : 10

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

### Code Principles
**Avoiding Complexity &  Flexibility**
- This project was designed in a simple and understandable structure by avoiding over-engineering due to its small scale and minimal solutions were used in line with the needs.
- The project can also be developed by using Service Providers. It is not used for simplicity.

**Test Driven Development (TDD)**
- Feature tests were used to test the basic functionality of the project, a user scenario was created.
- To run the test, you can enter the project location and use the `php artisan test` command from the terminal.


**Single Controller**
- Single controller is used in the project. This approach makes the code simpler and easier to manage. More than one controller can be used in big projects.

