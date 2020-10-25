## About Carbonator

System configurations
- MySQL  Ver 8.0.22
- PHP 7.3.9
- Apache/2.4.41 (Unix)
- Mac OSX 10.15

- php artisan migrate
- php artisan db:seed

Curl endpoint for testing
---------------------
curl --location --request POST 'http://localhost:8080/api/footprint' \
--header 'Content-Type: application/x-www-form-urlencoded' \
--data-urlencode 'activity=10' \
--data-urlencode 'activityType=miles' \
--data-urlencode 'country=usa' \
--data-urlencode 'fuelType=' \
--data-urlencode 'mode=taxi'

web url
-------------
{{base_url:port}}/footprint


