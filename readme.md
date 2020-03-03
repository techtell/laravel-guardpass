# Laravel Guard Pass

Laravel Guard Pass is a Laravel package that enables the developer to easily assume any User Identity without the need to know or type user credentials. Once installed, the package enables a route that will display a table with all of the users of the Laravel application. Assuming a User's identity is done by clicking a link. 

This package is designed to enable you to easily switch between users for testing purposes while developing your applicaiton.

### Installation

Laravel Guard Pass requires [Laravel](https://laravel.com/) 5.5+ and PHP 7.1+ to run.

Install by composer

```sh
$ composer install --dev techtell/laravel-guardpass
```

### Usage

Once installed, use the 
```
https://{{your.app}}/guardpass
```
 route in your app to access the Laravel Guard Pass page. You can add/remove columns from the table using the dropdown in the top right corner of the screen. You can also change displayed columns using the url - `{your_app_url}/guardpass/columns:f_name,l_name,user_role`