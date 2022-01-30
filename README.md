The system that will administer or manage companies and their employees and clients.

Resources
Use of Notifications
Use of Custom email

Requirements
before starting to run the project , make sure you have mailtrap account in order to check the verification link

Mailtrap
create your .env file
create your database
.env Mailtrap corresponding data and for public storage access , also for queues to be processed
MAIL_MAILER=
MAIL_HOST=
MAIL_PORT=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=
MAIL_FROM_ADDRESS=

FILESYSTEM_DRIVER=public

after run these script
npm install
php artisan migrate:fresh --seed
php artisan storage:link
php artisan serve