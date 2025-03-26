FROM php:8.1-apache

# Copia os arquivos para dentro do container
COPY . /var/www/html/

# Habilita o módulo reescrita (útil pra redirecionamentos se precisar)
RUN a2enmod rewrite
