# Épreuves & Corrigés - HECM Bohicon

Application web Laravel permettant aux étudiants de déposer et consulter librement les épreuves
et corrigés des années antérieures.

## Étapes d'installation (à faire chez toi, en local)

### 1. Créer le projet Laravel
```bash
composer create-project laravel/laravel epreuves-hecm
cd epreuves-hecm
```

### 2. Configurer la base de données
Dans le fichier `.env`, renseigne tes accès MySQL :
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=epreuves_hecm
DB_USERNAME=root
DB_PASSWORD=
```
Crée la base `epreuves_hecm` dans phpMyAdmin (ou en ligne de commande MySQL).

### 3. Copier les fichiers fournis
Copie chaque fichier de ce dossier vers l'emplacement correspondant dans ton projet Laravel :

| Fichier fourni | Destination dans le projet Laravel |
|---|---|
| `database/migrations/2026_07_02_000000_create_epreuves_table.php` | `database/migrations/` |
| `app/Models/Epreuve.php` | `app/Models/` |
| `app/Http/Controllers/EpreuveController.php` | `app/Http/Controllers/` |
| `routes/web.php` | remplace `routes/web.php` |
| `resources/views/layouts/app.blade.php` | `resources/views/layouts/` |
| `resources/views/epreuves/index.blade.php` | `resources/views/epreuves/` |
| `resources/views/epreuves/create.blade.php` | `resources/views/epreuves/` |

### 4. Lancer les migrations
```bash
php artisan migrate
```

### 5. Lier le stockage public (indispensable pour afficher les PDF)
```bash
php artisan storage:link
```

### 6. Lancer le serveur
```bash
php artisan serve
```
Le site est accessible sur http://127.0.0.1:8000

## Fonctionnement
- **Page d'accueil (`/`)** : recherche et filtre les épreuves/corrigés (filière, niveau, matière, année, type).
- **Page de dépôt (`/ajouter`)** : formulaire libre pour ajouter un PDF (épreuve ou corrigé).
- Aucun compte requis, dépôt et consultation libres, comme demandé.
- Seuls les fichiers PDF sont acceptés (max 10 Mo), pour un minimum de contrôle sans modération humaine.

## Pistes d'évolution possibles
- Ajouter une modération (statut "en attente" avant publication)
- Ajouter un compteur de téléchargements par document
- Ajouter la recherche par mot-clé dans le titre
- Ajouter un système de comptes si tu changes d'avis plus tard
