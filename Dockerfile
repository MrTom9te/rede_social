FROM php:latest

# Instalar dependências do sistema e extensões PHP
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    libpq-dev \
    libonig-dev \
    libxml2-dev

# Instalar extensões PHP
RUN docker-php-ext-install \
    pdo \
    pdo_pgsql \
    mbstring \
    xml

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar Apache
RUN a2enmod rewrite

# Definir diretório de trabalho
WORKDIR /var/www/html

# Copiar arquivos do projeto
COPY . /var/www/html

# Instalar dependências do Composer
RUN composer install

# Configurar permissões
RUN chown -R www-data:www-data /var/www/html

# Expor porta 80
EXPOSE 80
