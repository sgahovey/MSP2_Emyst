# Guide des Tests Unitaires

## 📋 Vue d'ensemble

Ce projet contient des tests unitaires pour toutes les entités et enums de l'application.

## 🧪 Structure des tests

```
tests/
├── Entity/
│   ├── UserTest.php
│   ├── ObjectifTest.php
│   ├── SeanceTest.php
│   ├── ExerciceTest.php
│   └── SeanceExerciceTest.php
├── Enum/
│   ├── TypeObjectifEnumTest.php
│   └── TypeSeanceEnumTest.php
└── Controller/
    ├── ObjectifControllerTest.php
    ├── SeanceControllerTest.php
    └── TableauBordControllerTest.php
```

## 🚀 Exécution des tests

### Localement

```bash
# Tous les tests
php bin/phpunit

# Tests unitaires uniquement
php bin/phpunit tests/Entity tests/Enum

# Tests fonctionnels uniquement
php bin/phpunit tests/Controller

# Avec affichage détaillé
php bin/phpunit --testdox

# Tests spécifiques
php bin/phpunit tests/Entity/UserTest.php
```

## 🔗 Intégration GitHub Actions

Les tests sont automatiquement exécutés via GitHub Actions à chaque push ou pull request.

### Workflow CI

Le fichier `.github/workflows/ci.yml` configure :
- ✅ Exécution des tests unitaires
- ✅ Exécution des tests fonctionnels
- ✅ Validation du schéma de base de données
- ✅ Lint PHP
- ✅ Audit de sécurité

### Ajouter les tests au dépôt Git

```bash
# Ajouter les fichiers de tests
git add tests/Entity/ tests/Enum/

# Ajouter le workflow mis à jour
git add .github/workflows/ci.yml

# Ajouter la documentation
git add TESTS.md README.md

# Commit
git commit -m "feat: ajout des tests unitaires et intégration GitHub Actions"

# Push
git push origin Devops
```

### Vérifier le statut des tests sur GitHub

1. Allez sur votre dépôt GitHub
2. Cliquez sur l'onglet **Actions**
3. Vous verrez les résultats des tests pour chaque push/PR

### Badge de statut

Pour ajouter un badge de statut dans votre README, remplacez `VOTRE_USERNAME` et `VOTRE_REPO` :

```markdown
[![CI](https://github.com/VOTRE_USERNAME/VOTRE_REPO/actions/workflows/ci.yml/badge.svg)](https://github.com/VOTRE_USERNAME/VOTRE_REPO/actions/workflows/ci.yml)
```

## 📊 Couverture des tests

### Tests unitaires créés

- ✅ **User** : 11 tests (création, getters/setters, relations, sérialisation)
- ✅ **Objectif** : 7 tests (création, getters/setters, relations)
- ✅ **Seance** : 7 tests (création, getters/setters, relations)
- ✅ **Exercice** : 9 tests (création, getters/setters, relations)
- ✅ **SeanceExercice** : 8 tests (création, getters/setters, relations)
- ✅ **TypeObjectifEnum** : 4 tests (cas, valeurs, conversions)
- ✅ **TypeSeanceEnum** : 4 tests (cas, valeurs, conversions)

**Total : 50 tests unitaires**

## 🎯 Bonnes pratiques

1. **Exécutez les tests avant chaque commit**
   ```bash
   php bin/phpunit
   ```

2. **Ajoutez des tests pour chaque nouvelle fonctionnalité**

3. **Maintenez un taux de couverture élevé**

4. **Vérifiez que les tests passent sur GitHub Actions avant de merger**

## 🔧 Dépannage

### Erreur "mbstring extension not available"
Installez l'extension PHP mbstring :
```bash
# Sur Ubuntu/Debian
sudo apt-get install php-mbstring

# Sur Windows (XAMPP/WAMP)
# Activez l'extension dans php.ini
```

### Tests qui échouent sur GitHub Actions
- Vérifiez que toutes les dépendances sont dans `composer.json`
- Vérifiez que le workflow CI est correctement configuré
- Consultez les logs dans l'onglet Actions de GitHub

