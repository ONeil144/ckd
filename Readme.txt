Ce projet est une application web développée avec Laravel pour la gestion des patients, des personnels médicaux, des examens, des workflows et bien plus encore.

 --Prérequis

PHP >= 8.1

Composer

MySQL 

Node.js >= 16.x

NPM

-- Installation des dépendances php :

	composer install

--Installer les dépendances front-end (Vite) :

	npm install

--Lancer les migrations :

	php artisan migrate

-- 👤 Créer un utilisateur administrateur manuellement (MySQL):

INSERT INTO users (name, prenom, email, password, role, created_at, updated_at)
VALUES ('Admin', 'Principal', 'admin@example.com', 
        '$2y$12$LViSN.MuQLbAPT8d0ndhk.U0754QPB0kDcHplstNm.B6vtBBmKAe', 
        'administrateur', NOW(), NOW());

NB: 🔐 Le mot de passe par défaut est "admin123". Le hash correspond à password bcrypté.

🚀 Lancer l'application

--Backend (serveur Laravel) :

"php artisan serve"

Accéder à l’application : http://localhost:8000 pour vous connecter

--Frontend (Vite) :

"npm run dev"





