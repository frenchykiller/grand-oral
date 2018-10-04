FROM alpine:latest

RUN apk update && apk add --no-cache docker

# copy crontabs for root user
COPY crontab /etc/crontabs/root

# start crond with log level 8 in foreground, output to stderr
CMD ["crond", "-f", "-d", "8"]
