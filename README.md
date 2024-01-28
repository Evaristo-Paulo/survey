# About IASK

## Survey management system

IASK is an online platform for managing polls, which aims to extract specific data from a certain group of people, in the form of direct questions and answers.


## How to run this project

After configuring the project locally on your machine, run the following commands:

Step 1: php artisan migrate:fresh --seed (To create the database tables and generate the test user)

Step 2: php artisan serves (To start the project)

Step 3 (optional): php artisan queue:work (To start email service)

Step 4 (optional): php artisan schedule:work (To start schedule task service)



## Quick access and credentials

Click [here](http://127.0.0.1:8000/sys/login) to access the login page.

Test email: admin@gmail.com

Password: admin

<a href="http://127.0.0.1:8000/sys/login" target="_blank"><img src="https://github.com/Evaristo-Paulo/survey/blob/main/public/admin/assets/images/img_doc/login_main.png"></a>


## Main features

- Alternative authentication: Using your Gmail account;
- Jobs: To send a survey by email;
- Cron Job: For scheduling tasks (changing the status of survey after they reach their expiration date);
- Broadcast and Events: Real-time update on the frontend;
- Pusher: API for real-time notification;
- And much more.

Dashboard
<a href="http://127.0.0.1:8000/sys/login" target="_blank"><img src="https://github.com/Evaristo-Paulo/survey/blob/main/public/admin/assets/images/img_doc/dash.png"></a>

Website/Page for voting
<a href="http://127.0.0.1:8000/sys/login" target="_blank"><img src="https://github.com/Evaristo-Paulo/survey/blob/main/public/admin/assets/images/img_doc/votacao.png"></a>

## Technologies used

This project was developed using the Laravel Version 9 framework

- PHP/Laravel
- HTML
- JQuery
- MySql


## Important note

Get in touch with me from my [linkedin](https://www.linkedin.com/in/evaristo-paulo), in order to contribute to this or future projects.

Leave a star to give that extra motivation :D
