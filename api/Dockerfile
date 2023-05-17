FROM nginx/unit:1.28.0-php8.1

ENV CRM_API_DIR /crm/api

RUN apt update -qq \
 && apt install -qq -y \
    apt-transport-https \
    ca-certificates \
    software-properties-common \
    curl \
    wget \
    zip \
    unzip \
    git \
    jq

RUN cp "${PHP_INI_DIR}/php.ini-production" "${PHP_INI_DIR}/php.ini"

COPY \
    --from=mlocati/php-extension-installer \
    /usr/bin/install-php-extensions \
    /usr/local/bin/

RUN install-php-extensions \
    apcu \
    intl \
    opcache \
    pgsql \
    pdo_pgsql \
    http \
    xdebug
#    curl \
#    gd \
#    igbinary \
#    json \
#    mbstring \
#    mcrypt \
#    memcached \
#    msgpack \
#    mysql \
#    opcache \
#    pcntl \
#    pdo_mysql \
#    redis \
#    soap \
#    sockets \
#    xml \
#    zip

RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' \
  | bash \
 && apt install -y symfony-cli

COPY . ${CRM_API_DIR}
WORKDIR ${CRM_API_DIR}

#RUN apk update \
# && apk add --no-cache \
#    wget
#
#RUN wget -q -O mkcert https://github.com/FiloSottile/mkcert/releases/download/v1.4.4/mkcert-v1.4.4-linux-amd64 \
# && chmod +x mkcert \
# && mv mkcert /usr/local/bin/
# && mkcert -install \
# && mkcert trustclub.dev

VOLUME [ "/var/lib/unit", "${CRM_API_DIR}" ]

EXPOSE 80 443 8000