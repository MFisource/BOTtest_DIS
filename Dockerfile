FROM php:8.3-alpine3.19
WORKDIR /app
COPY . .

CMD [ "php", "/app/bot.php" ]
