# snap sms project

##run project
- run docker-compose up -d
- run composer update
- create .env like .env.example
- run php artisan key:generate
- run php artisan migrate --seed in your php container
- project will run on port 4000
###api
- you have api: GET  | /api/sms . it will return stored message data
- you have api: POST | /api/sms. it requires receiver(mobile number for sent message), gateway(use kavenegar or ghasedak) and text (message content)
###panel
- you can login in panel with url /login. if you seed after migrate, you can login with this credentials: email: snap and password:snap
###notice
- because of send message is async, we used redis as message broker.
- I didn't know how to configure supervisor in docker, because of this to run queue:work, I used a cronjob. cronjob  run every one minute. if you need faster, you can run queue:work manually.
