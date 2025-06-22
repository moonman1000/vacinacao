FROM php:8.2-apache

# Instala a extensão mysqli (necessária para MySQL)
RUN docker-php-ext-install mysqli

# Copia todos os arquivos do seu projeto para a pasta padrão do Apache
COPY . /var/www/html/

# Ativa o mod_rewrite do Apache (necessário se você usa .htaccess)
RUN a2enmod rewrite