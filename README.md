# Web School Management System

Un système de gestion scolaire moderne développé avec Laravel 12.

## Fonctionnalités

### Pour les étudiants
- Inscription et gestion du profil
- Upload et gestion des documents
- Consultation des notes
- Filtrage des notes par semestre
- Téléchargement des attestations
- Communication avec l'administration

### Pour l'administration
- Gestion des comptes étudiants
- Validation des inscriptions
- Vérification des documents
- Gestion des programmes
- Publication des notes
- Génération d'attestations
- Gestion des emplois du temps

## Prérequis

- PHP 8.2 ou supérieur
- Composer
- Node.js et NPM
- MySQL ou PostgreSQL

## Installation

1. Cloner le projet
```bash
git clone <repository-url>
cd web-school-new
```

2. Installer les dépendances PHP
```bash
composer install
```

3. Installer les dépendances JavaScript
```bash
npm install
```

4. Configurer l'environnement
```bash
cp .env.example .env
php artisan key:generate
```

5. Configurer la base de données dans le fichier .env
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=web_school
DB_USERNAME=root
DB_PASSWORD=
```

6. Migrer la base de données
```bash
php artisan migrate
```

7. Créer un lien symbolique pour le stockage
```bash
php artisan storage:link
```

## Démarrage

1. Lancer le serveur de développement
```bash
php artisan serve
```

2. Compiler les assets
```bash
npm run dev
```

## Structure du projet

- `app/Models/` - Modèles de l'application
- `database/migrations/` - Migrations de la base de données
- `routes/` - Routes de l'application
- `resources/views/` - Vues de l'application
- `public/` - Fichiers publics

## Sécurité

- Authentification multi-rôles (étudiant/admin)
- Validation des documents
- Protection contre les attaques CSRF
- Stockage sécurisé des mots de passe

## Contribution

1. Fork le projet
2. Créer une branche pour votre fonctionnalité
3. Commiter vos changements
4. Pousser vers la branche
5. Créer une Pull Request

## License

Ce projet est sous licence MIT.
