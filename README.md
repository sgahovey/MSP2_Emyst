# Projet Emyst

Application Symfony avec MySQL via Docker.

## 🚀 Démarrage rapide

```bash
docker-compose up -d
```

L'application sera accessible sur : **http://localhost:8000**

## 🔐 Configuration

Pour changer les mots de passe MySQL, créez un fichier `.env` :

```env
MYSQL_ROOT_PASSWORD=VotreMotDePasseRoot
MYSQL_DATABASE=emyst_db
MYSQL_USER=emyst_user
MYSQL_PASSWORD=VotreMotDePasseUser
```

Par défaut (développement uniquement) :
- Base de données : `emyst_db`
- Utilisateur : `emyst_user` / `Emyst_S3cur3_P@ss_2024!`
- Root : `root` / `Emyst_R00t_P@ssw0rd_2024!`

## 📝 Commandes utiles

```bash
# Voir les logs
docker-compose logs -f

# Arrêter
docker-compose down

# Redémarrer
docker-compose restart
```

## 🧪 Tests

### Exécuter les tests unitaires

```bash
# Tous les tests
php bin/phpunit

# Tests unitaires uniquement (entités et enums)
php bin/phpunit tests/Entity tests/Enum

# Tests fonctionnels (contrôleurs)
php bin/phpunit tests/Controller

# Avec affichage détaillé
php bin/phpunit --testdox
```

### Tests disponibles

- **Tests unitaires** (`tests/Entity/`, `tests/Enum/`) : Tests isolés pour les entités et enums
- **Tests fonctionnels** (`tests/Controller/`) : Tests d'intégration pour les contrôleurs

### Intégration GitHub Actions

Les tests sont automatiquement exécutés via GitHub Actions à chaque :
- Push sur les branches `main`, `master`, `develop`, `Devops`
- Pull Request vers ces branches

Le workflow CI (`/.github/workflows/ci.yml`) exécute :
- ✅ Tests unitaires
- ✅ Tests fonctionnels
- ✅ Validation du schéma de base de données
- ✅ Lint PHP
- ✅ Audit de sécurité

Voir le statut des tests sur GitHub : [![CI](https://github.com/VOTRE_USERNAME/VOTRE_REPO/actions/workflows/ci.yml/badge.svg)](https://github.com/VOTRE_USERNAME/VOTRE_REPO/actions/workflows/ci.yml)








