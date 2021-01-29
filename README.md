<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Installation du projet

- exécutez la commande: composer install
- copiez le fichier .env.example et changez le nom en .env
- Créer une base de données (exemple: infini)
- Modifiez le nom du BD, le nom d'utilisateur et le mot de passe dans le fichier ".env"
- exécutez la commande: php artisan passeport: install (--force: si vous avez déjà migré)
- exécutez la commande: php artisan migrate
- démarrer le serveur: php artisan serve
