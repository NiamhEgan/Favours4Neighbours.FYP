# Favors 4 Neighbours

## How to install and Run

Clone the project from github. https://github.com/NiamhEgan/Favours4Neighbours.FYP
or unzip the project file and save to your apprpriate folder on your machine such as htdocs 



Restore and Install the database in 'assets\Favours4Neighbours.mysql.sql' first

eg. you can use the command line if setup for it 

` mysql.exe -u {user} -p favours4neighbours < assets\\Favours4Neighbours.mysql.sql` 

Alt use MySQL workbench to install the database in 'assets\Favours4Neighbours.mysql.sql'

Edit env file database variables to match yours and save as .env

Download Composer from https://getcomposer.org/ 
`composer i` to install required codeigniter packages 
 
 Open the command prompt/termeinal and run 
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
