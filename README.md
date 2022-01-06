## P6_Symfony

Project 6 du "parcours développeur d'application PHP/Symfony" d'Openclassrooms.
Ce projet consite à la création d'un application utilisant les basiques de symfony avec une impmementation Ajax pour un affichage sans rechargement de page'.

Vous pouvez les retrouver ici

![Symfony Insight] Lien direct [Here](https://insight.symfony.com/projects/78b993a9-4cec-4267-b1d6-2f4ae97702d5/analyses/47).

## Table des matières.

1. [Pre required](#Pré-requis)
2. [Installation](#Instalation)
3. [Affichage de l'App](#use)
4. [Fait avec](#Fait-avec)
5. [Auteur](#Auteur)

## Pré requis

Environnement

- _PHP_ (7.4.12)
- _Apache_ (2.4.46)
- _MySQL_ (8.0.22)
- _Composer_ (2.0.9)

## Installation

- Get sources files / Cloner le repository du projet. [Here](https://github.com/Juju075/snowtricks2)
  > Make sure the `www` repository, is at the root of your server, you can also create a virtual host that redirect the visitors to the `www` directory.

_Go with a console to the repository and do thoses commands_

- `composer install`
- `composer update`

- Créer la database.

- Charger le script sql dans phpmyadmin (creation de la base de données et du jeux de donees.)
- http://localhost/phpmyadmin/server_sql.php

Base de données : `snowtricks2`

- snowtricks2.sql (à la racine du projet)

Connexion à la Bdd.

- Creer un fichier config.json
  pour permettre au code de trouver les identifiants
  de connexion a la base de donnees.

{
"host": "localhost",
"dbname": "snowtricks2",
"user": "vos identifiant personnel",
"pass": "votre mot de passe personnel"
}

## use

Lancer dans votre navigateur:
https://127.0.0.1:8000/

- LOGINS de demonstration

  [MEMBRE]

- login : prendre n'importe quel email d'un utilisateur [ROLE USER] dans la bdd (eg: )
- password : identique

## fait avec

- [twig](https://twig.symfony.com/) - génerateur de template

### Auteur

- **Bempime KHEVE** (https://github.com/Juju075/snowtricks2/)
