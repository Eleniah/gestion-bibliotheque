# Gestion de Bibliothèque

Application web de gestion de bibliothèque développée avec Laravel.  
Projet BTS SIO SLAM — Session 2026 — RIMET Sarah

## Présentation

Application permettant au personnel d'une bibliothèque de gérer les adhérents, les livres, les auteurs et les emprunts via une interface web sécurisée.

## Fonctionnalités

- **Tableau de bord** — statistiques globales (adhérents, livres, emprunts actifs)
- **Gestion des adhérents** — CRUD complet
- **Gestion des livres** — CRUD avec association auteur, code-barres (Picqer)
- **Gestion des auteurs** — CRUD avec association livres
- **Gestion des emprunts** — création, suivi, retours
- **Authentification** — accès sécurisé réservé au personnel

## Stack technique

| Couche | Technologie |
|--------|-------------|
| Framework | Laravel |
| Langage serveur | PHP |
| Base de données | MySQL |
| Interface | Blade + Bootstrap 5 + CSS personnalisé |
| Architecture | MVC |
| Code-barres | Picqer Barcode Generator |

## Application en ligne

🌐 [https://sarah2.projetbtssiotoulon.fr](https://sarah2.projetbtssiotoulon.fr/login)

## Compte de test

| Email | Mot de passe | Rôle |
|-------|-------------|------|
| admin@biblio.test | motdepasse123 | Administrateur |

## Installation en local

```bash
git clone https://github.com/Eleniah/gestion-bibliotheque.git
cd gestion-bibliotheque
composer install
cp .env.example .env
php artisan key:generate
```

Configure le `.env` avec tes infos de base de données puis :

```bash
php artisan migrate
php artisan db:seed
php artisan serve
```

## Documentation

Le cahier des charges, le MCD et le diagramme de classes sont disponibles à ce lien : https://docs.google.com/document/d/1c9N-pa-D-F_QFA0KUvydPpjUH69E0d9Mv1kdjxGawY0/edit?usp=sharing 