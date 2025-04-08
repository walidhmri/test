updated 08/04/2025 by oualid

##  Prérequis

Avant de commencer, assure-toi d’avoir installé :

- [XAMPP](https://www.apachefriends.org/index.html)
- [Composer](https://getcomposer.org/)
- [Git](https://git-scm.com/)
- PHP (version ≥ 8.0, inclus dans XAMPP)

---

##  Étapes pour lancer le projet

### 1. Cloner le dépôt Git
```bash
git clone https://github.com/walidhmri/test.git
cd test
```

### 2. Installer les dépendances PHP
```bash
composer install
```

### 3. Copier le fichier d’environnement
```bash
cp .env.example .env
```

### 4. Générer la clé de l'application
```bash
php artisan key:generate
```

### 5. Créer la base de données

- Ouvre [phpMyAdmin](http://localhost/phpmyadmin)
- Crée une base de données nommée par exemple : `test`

### 6. Configurer les variables d’environnement

Ouvre le fichier `.env` et modifie la section base de données :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=test
DB_USERNAME=root
DB_PASSWORD=
```

### 7. Lancer les migrations
```bash
php artisan migrate --seed
```

### 8. Démarrer le serveur Laravel
```bash
php artisan serve
```

Accède ensuite à : [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

- Si tu rencontres une erreur liée à `vendor`, relance `composer install`.

---

## 🤝 Auteur

Projet cloné depuis : [https://github.com/walidhmri/test](https://github.com/walidhmri/test)
