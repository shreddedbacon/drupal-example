ARG CLI_IMAGE
FROM ${CLI_IMAGE} as cli

FROM amazeeio/php:7.2-fpm

## Add the dev package for ldap (openldap-dev)
## Install the extension ldap and configure it
RUN apk update \
    && apk add --no-cache openldap-dev \
    && docker-php-source extract \
    && docker-php-ext-install ldap \
    && docker-php-ext-configure ldap \
    && docker-php-source delete

COPY --from=cli /app /app
