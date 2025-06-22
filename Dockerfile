FROM php:8.2-apache

# Instala a extensão mysqli
RUN docker-php-ext-install mysqli

# Copia os arquivos do projeto para o Apache
COPY . /var/www/html/

# Ativa o mod_rewrite do Apache (se usar .htaccess)
RUN a2enmod rewrite