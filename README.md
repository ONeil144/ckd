# 🧠 AI4CKD - Plateforme de Suivi des Patients Atteints de MRC

Ce projet a été réalisé dans le cadre du hackathon **AI4CKD** organisé par l'IFRI/UAC. Il s'agit d'une plateforme web développée en Laravel, permettant aux **professionnels de santé** de personnaliser le suivi des patients atteints de **Maladie Rénale Chronique (MRC)**.

## 🎯 Objectif du projet

Développer une application web ergonomique permettant :
- Aux professionnels de santé de créer et personnaliser des **workflows de suivi patient**,
- D’ajouter et gérer les **examens médicaux** et **traitements** associés,
- À un administrateur de créer et gérer les comptes des professionnels de santé.

## 🚀 Fonctionnalités implémentées

✅ Création et personnalisation de **workflows de suivi patient**  
✅ Gestion des **examens** médicaux  
✅ Gestion des **traitements** prescrits  
✅ Espace **administrateur** pour la création et la gestion des comptes des professionnels de santé  
✅ Authentification sécurisée (professionnels / admin)

## 🧱 Architecture du projet

Le projet suit une architecture MVC Laravel classique avec les modules suivants :
- **Models** : Patient, Workflow, Examen, Traitement, User (admin et médecin)
- **Controllers** : Gestion des workflows, examens, traitements, utilisateurs
- **Middleware** : Protection des routes selon les rôles (admin / médecin)

## 🛠️ Technologies utilisées

| Type             | Outils / Langages                     |
|------------------|---------------------------------------|
| Backend          | PHP (Laravel 11.x)                    |
| Base de données  | MySQL                                 |
| Authentification | Laravel Auth / Middleware             |
| Frontend         | Blade + W3 CSS      |
| Hébergement      | Render / Railway                      |

## ⚙️ Installation locale

```bash
# 1. Cloner le repo
git clone https://github.com/ONeil144/ckd.git
cd ckd

# 2. Installer les dépendances PHP
composer install

# 3. Configurer l'environnement
cp .env.example .env
php artisan key:generate

# 4. Configurer la base de données
# (modifier les variables DB_... dans .env)

# 5. Lancer les migrations
php artisan migrate

# 6. Lancer le serveur
php artisan serve
```

## 👥 Membres du groupe

- BOKO Delys
- FALETI Jospin
- Houndjo Armand Boris
- KASSIFA O. Christ Bienvenu
- WEDJANGNON O'Neil

## 📂 Structure des dossiers clés

```
app/
├── Http/Controllers/
├── Models/
resources/views/
routes/web.php
```

## 🧾 Licence

Projet réalisé dans le cadre pédagogique du hackathon AI4CKD – 2025

