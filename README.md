<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>



## Configurer le projet localement


- [télécharger le projet ou le cloner depuis github]
- [installer le composer](https://getcomposer.org/download/)
- ouvrez le projet dans votre terminal
- `cd` dans le répertoire du projet - (pour accéder au projet)
- `cd` to core folder - (pour accéder au dossier core) (toutes les commandes ci-dessous seront exécutées dans le dossier core)
- exécutez `composer install` - (pour installer les dépendances)
- créer une base de données sur votre machine locale
- renommer le fichier .env.example en .env
- configurer la base de données dans le fichier .env (DB_DATABASE, DB_USERNAME, DB_PASSWORD)
- exécutez `php artisan key:generate` - (pour générer la clé de l'application)
- exécutez `php artisan migrate` - (pour migrer la base de données, cela créera les tables dans la base de données)
- exécutez `php artisan db:seed` - (pour amorcer la base de données, cela créera un utilisateur aléatoire et des données pour l'application) 
- exécutez `php artisan serve` - (pour démarrer le serveur, cela démarrera le serveur sur http://127.0.0.1:8000 par défaut) ou ouvrez le projet sur votre serveur local (xampp, wamp, etc.)



## accéder au panneau d'administration

- nous avons généré un utilisateur aléatoire avec le seeder (`php artisan db:seed`), vous pouvez accéder au panneau d'administration avec les informations d'identification suivantes :
<br>
mot de passe : `password`
<br>
e-mail : `vérifier la base de données. allez dans la table des utilisateurs et choisissez l'un des e-mails.`

- tous les utilisateurs générés ont le même mot de passe : `password`