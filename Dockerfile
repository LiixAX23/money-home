FROM php:8.1-apache

# Instala o driver PDO para MySQL/MariaDB
RUN docker-php-ext-install pdo pdo_mysql

# Copia os arquivos do seu projeto para dentro do container
COPY . /var/www/html/

# Ativa o módulo rewrite do Apache (opcional, mas útil)
RUN a2enmod rewrite

# Corrige permissões
RUN chown -R www-data:www-data /var/www/html
