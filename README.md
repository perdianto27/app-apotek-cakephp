# CakePHP

[![Latest Stable Version](https://poser.pugx.org/cakephp/cakephp/v/stable.svg)](https://packagist.org/packages/cakephp/cakephp)
[![License](https://poser.pugx.org/cakephp/cakephp/license.svg)](https://packagist.org/packages/cakephp/cakephp)
[![Bake Status](https://secure.travis-ci.org/cakephp/cakephp.png?branch=master)](https://travis-ci.org/cakephp/cakephp)
[![Code consistency](https://squizlabs.github.io/PHP_CodeSniffer/analysis/cakephp/cakephp/grade.svg)](https://squizlabs.github.io/PHP_CodeSniffer/analysis/cakephp/cakephp/)

CakePHP is a rapid development framework for PHP which uses commonly known design patterns like Active Record, Association Data Mapping, Front Controller and MVC.
Our primary goal is to provide a structured framework that enables PHP users at all levels to rapidly develop robust web applications, without any loss to flexibility.


## PENTING!

1. Design database, ada di file mysqlworkbench-model.mwb, buka pakai mysql workbench'

2. sebelum mulai, import dulu database-nya di file database.sql


## CARA SETUP


1. Download/ clone

2. buka app/config/core.php, sesuaikan nilai Configure::write('base_url','http://localhost/workshop-cake');

3. sesuaikan koneksi database

buka halaman web anda


## CARA BAKE

Via Netbeans

1. install plugin cakephp

2. buat project, pastikan pilih framework cakephp

3. klik kanan project, pilih CAKEPHP, klik run command

4. sesuikan apakah mau build semua, controller,model atau view saja


VIA CONSOLE

buka terminal

ketikan perintah : php app/Console/cake.php -app FOLDER_PROJECT_ANDA bake view all
misalnya : php app/Console/cake.php -app "E:/xampp/htdocs/workshop-cake/app" bake view all

1. bake semua model : php app/Console/cake.php -app "E:/xampp/htdocs/workshop-cake/app" bake model all

2. bake semua controller; php app/Console/cake.php -app "E:/xampp/htdocs/workshop-cake/app" bake controller all

3. bake semua view php app/Console/cake.php -app "E:/xampp/htdocs/workshop-cake/app" bake view all

4. bake spesifik tabel & generate Model, Controller & View: php app/Console/cake.php -app "E:/xampp/htdocs/workshop-cake/app" bake all


ada Pertanyaan? japri atau email ke mznkrg@gmail.com




## Thank you

adminLTE http://adminlte.io/

Gaivo https://gaivo.co.id

Gaivo Systemworks https://gaivo-systemworks.com

Match https://match.co.id/