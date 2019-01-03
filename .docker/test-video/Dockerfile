FROM debian:jessie

RUN apt-get update && apt-get install -y \
    nginx

ADD nginx.conf /etc/nginx/
ADD auth.conf /etc/nginx/sites-available/
ADD upstream.conf /etc/nginx/conf.d/upstream.conf

RUN ln -s /etc/nginx/sites-available/auth.conf /etc/nginx/sites-enabled/auth \
&& rm /etc/nginx/sites-enabled/default

RUN usermod -u 1000 www-data

CMD ["nginx"]

EXPOSE 12080
#EXPOSE 80
#EXPOSE 443
