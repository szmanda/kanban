Kanban
================

# Instalation and usage guide

###  Installing Symfony
```shell
curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | sudo -E bash
sudo apt install symfony-cli
sudo add-apt-repository ppa:ondrej/php # if php8.1 package cant be located
sudo apt install php8.1
symfony check:requirements
```
### Installing a sensible version of composer
```shell
sudo apt install php-cli unzip
curl -sS https://getcomposer.org/installer -o /tmp/composer-setup.php
HASH=`curl -sS https://composer.github.io/installer.sig`
php -r "if (hash_file('SHA384', '/tmp/composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
sudo php /tmp/composer-setup.php --install-dir=/usr/bin --filename=composer
```
### Creating an aplication from demo project
```shell
composer create-project symfony/symfony-demo kanban # or use git clone to clone the repository
cd kanban
git config user.email "gituser@email.com"
git config user.name "GitUser"
code . # to open project in VSCode
# installing necessary PHP extensions
sudo apt-get install php8.1-xml
sudo apt-get install php8.1-sqlite3
# installing dependecies with composer
composer update
composer install
# launching the application
symfony server:start --port 8000
# launching the server in the background
symfony server:start -d --port 8000
```

By default the demo app usees a SQLite3 database, this can be changed in `.env` file with the parameter: `DATABASE_URL`.

### Installing Postgresql:
```shell
sudo apt install postgresql postgresql-contrib php8.1-pgsql
# adding new server configuration:
# all databases can be accessed by all users from anywhere:
sudo su
echo "host all all 0.0.0.0/0 md5" >> /etc/postgresql/12/main/pg_hba.conf
exit
# starting the postgresql service
sudo service postgresql start
# check status of the service
sudo service postgresql status
```

```shell
# open postgresql console (on user postgres)
sudo -u postgres psql
```

```sql
CREATE DATABASE kanban;
CREATE USER app WITH ENCRYPTED PASSWORD 'app';
GRANT ALL PRIVILEGES ON DATABASE kanban TO app;
```


Inside  `.env` change parameter: `DATABASE_URL`:

`DATABASE_URL="postgresql://app:app@127.0.0.1:5432/kanban?serverVersion=12.12&charset=utf8"`

After `bin/console doctrine:schema:create`, app should be functional.

### Using symfony cli tools
#### Starting the application
```shell
# make sure postgres service is running
sudo service postgresql status
# see if the database is up to date with the code
bin/console doctrine:schema:update --dump-sql
# launch the application
symfony server:start -d --port 8000
```


```shell
bin/console # help
bin/console doctrine:schema:create # create a schema from .php files
bin/console doctrine:schema:update # after changes to php that need updating database
bin/console cache:clear # sometimes useful
bin/console make # a number of commands usefull to interactively create classes
```


