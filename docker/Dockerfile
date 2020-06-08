FROM whatwedo/symfony4:v2.1

# Install tools
RUN apk add --no-cache bash curl

# Copy app code and install dependencies
WORKDIR /var/www/
USER nginx
RUN git clone -b master --single-branch https://github.com/max-baranikov/get-number.git/ .
RUN composer install --prefer-dist --no-scripts
RUN chmod -R 775 /etc/service

# Set default environment variables
ENV APP_ENV=prod
ENV DATABASE=mysql
ENV DATABASE_USER=root
ENV DATABASE_PASSWORD=''
ENV DATABASE_HOST=127.0.0.1
ENV DATABASE_PORT=3306
ENV DATABASE_NAME=mysql

# At start we run init script inside app directory
CMD init.sh

EXPOSE 9000
EXPOSE 80