# Favors 4 Neighbours

## How to install and Run

Clone the project from github. https://github.com/NiamhEgan/Favours4Neighbours.FYP
or unzip the project file and save to your apprpriate folder on your machine such as htdocs 



Restore and Install the database in 'assets\Favours4Neighbours.mysql.sql' first

` mysql -u {user} -p favours4neighbours < ` to create a database

` mysql.exe --defaults-file="C:\Users\Niamh\AppData\Local\Temp\tmpw4r4vsoa.cnf"  --protocol=tcp --host=127.0.0.1 --user=root --port=3306 --default-character-set=utf8 --comments --database=newschema  < "C:\\Users\\Niamh\\Documents\\GitHub\\Favours4Neighbours.FYP\\assets\\Favours4Neighbours.mysql.sql"`


Download Composer from https://getcomposer.org/ 
`composer i` to install required codeigniter packages 

edit .env file database variables to match yours
 
`php spark serve` to run the website.

## Log in details 
Admin log in 
username: admin
password: letmein


Client log in
username: myers
password: letmein

Client log in
username: gerry
password: letmein

## About this project

This application provides a means for people to create jobs that they want done and apply for jobs that they would like to do. it is inteded to be a neighbourhood app where people can create and apply for small jobs that are non contact COVID-19 friendly jobs. 
the job can be created statign the amount of money if any that you are willing to pay to get the job done. 
The user can create jobs they want done and apply for jobs they want to do if they want to. 



# CodeIgniter 4 Application Starter

## What is CodeIgniter?

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible and secure.
More information can be found at the [official site](http://codeigniter.com).

This repository holds a composer-installable app starter.
It has been built from the
[development repository](https://github.com/codeigniter4/CodeIgniter4).

More information about the plans for version 4 can be found in [the announcement](http://forum.codeigniter.com/thread-62615.html) on the forums.

The user guide corresponding to this version of the framework can be found
[here](https://codeigniter4.github.io/userguide/).

## Installation & updates

`composer create-project codeigniter4/appstarter` then `composer update` whenever
there is a new release of the framework.

When updating, check the release notes to see if there are any changes you might need to apply
to your `app` folder. The affected files can be copied or merged from
`vendor/codeigniter4/framework/app`.

## Setup

Copy `env` to `.env` and tailor for your app, specifically the baseURL
and any database settings.

## Important Change with index.php

`index.php` is no longer in the root of the project! It has been moved inside the *public* folder,
for better security and separation of components.

This means that you should configure your web server to "point" to your project's *public* folder, and
not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter *public/...*, as the rest of your logic and the
framework are exposed.

**Please** read the user guide for a better explanation of how CI4 works!

## Repository Management

We use Github issues, in our main repository, to track **BUGS** and to track approved **DEVELOPMENT** work packages.
We use our [forum](http://forum.codeigniter.com) to provide SUPPORT and to discuss
FEATURE REQUESTS.

This repository is a "distribution" one, built by our release preparation script.
Problems with it can be raised on our forum, or as issues in the main repository.

## Server Requirements

PHP version 7.3 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)
- xml (enabled by default - don't turn it off)