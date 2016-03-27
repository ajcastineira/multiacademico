echo "Actualizando Multiacademico"
git reset --hard
git pull --rebase
composer=$1
if [ "$composer" == "composer" ]; then
               echo "Se Actualizara Composer"
               php composer.phar self-update
               php composer.phar update
fi

php bin/console cache:clear --env prod
php bin/console doctrine:schema:update --dump-sql --force
php bin/console doctrine:fixtures:load --append
chmod 755 index.php
chmod 755 web/app.php
chmod 755 web/app_dev.php
chmod 755 update.sh
