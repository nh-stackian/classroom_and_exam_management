FROM ubuntu:20.04
ENV DEBIAN_FRONTEND=noninteractive
RUN apt update
RUN apt install php -y
RUN apt install composer -y
RUN apt install php-xml -y
RUN apt install php-mysql -y
