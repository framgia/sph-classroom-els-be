touch /var/log/cron.log
crontab docker/cron/scheduler.txt
service cron start
tail -f /var/log/cron.log
