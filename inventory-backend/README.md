# Instruction

## For data migration run the following command

1. run `composer install`
2. create database `inventory_app`
3. configure the database in .env file
4. run `php artisan migrate --seed`

## Configure the queue in .env file

`QUEUE_CONNECTION=database`

## Configure pusher

`BROADCAST_DRIVER=pusher`

`PUSHER_APP_ID=1772637`

`PUSHER_APP_KEY=4849c110800671baabbf`

`PUSHER_APP_SECRET=0adb18a289b212f64eda`

`PUSHER_APP_CLUSTER=ap1`

## run queue worker

`php artisan queue:work`
