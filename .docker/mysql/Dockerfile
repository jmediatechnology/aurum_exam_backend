FROM mysql:8

ARG user="admin"
ARG password="tajemnicuchna"
ARG database="aurum_exam"

ENV MYSQL_USER=$user
ENV MYSQL_PASSWORD=$password
ENV MYSQL_DATABASE=$database
ENV MYSQL_RANDOM_ROOT_PASSWORD="yes"

COPY "./mysql.cnf" "/etc/mysql/conf.d/mysql.custom.cnf"
