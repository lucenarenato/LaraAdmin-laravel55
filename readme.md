# Laravel PHP Framework
- "php": ">=7.0.0"
- "laravel/framework": "5.5.*",

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/d/total.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

<p align="center">
  <img src="Captura de tela de 2019-08-03 16-55-54.png">
  <h1 align="center" style="margin-top:5px;">LaraAdmin 1.0</h1>
</p>

## LaraAdmin 1.0
```sh
composer install
php artisan la:install
sudo chmod -R 777 storage/ bootstrap/ database/migrations/
```

## nable Less to CSS (Optional)
If you want to make UI Style Changes you need to generate css files from Less.
```sh
npm install
npm install forever -g
```
forever start node_modules/gulp/bin/gulp.js watch

## Caso precise(opcional)
```sh
php artisan key:generate
php artisan migrate --seed

composer require dwij/laeditor
php artisan la:editor
```

>  Laravel-backup host mailtrap.io

- https://laraadmin.com/docs/1.0

- Renato de O. Lucena - 2019