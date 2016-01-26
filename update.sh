echo "Actualizando Multiacademico"
git reset --hard
git pull --rebase
php composer.phar update
php bin/console cache:clear --env prod
php bin/console doctrine:schema:update --dump-sql --force
php bin/console doctrine:fixtures:load --append