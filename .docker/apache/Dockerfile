FROM httpd:2.4-alpine

COPY "./vhost.conf" "/usr/local/apache2/conf/httpd.custom.conf"

RUN echo "Include /usr/local/apache2/conf/httpd.custom.conf" >> "/usr/local/apache2/conf/httpd.conf"
