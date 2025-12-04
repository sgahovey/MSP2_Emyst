# 🚂 Guide de Déploiement Railway - MySQL

Ce guide explique comment configurer MySQL sur Railway pour votre projet Symfony.

## 📋 Prérequis

- Un projet Symfony déployé sur Railway
- Une base MySQL créée sur Railway
- Les variables MySQL Railway disponibles

## 🔧 Configuration DATABASE_URL

### Étape 1: Récupérer les variables MySQL Railway

Dans votre service MySQL Railway, allez dans l'onglet **"Variables"** et notez :

- `MYSQLHOST` = `mysql.railway.internal`
- `MYSQLPORT` = `3306`
- `MYSQLUSER` = `root`
- `MYSQLPASSWORD` = `(votre mot de passe)`
- `MYSQLDATABASE` = `(nom de la base auto-généré)`

### Étape 2: Construire DATABASE_URL

La formule pour construire `DATABASE_URL` est :

```
DATABASE_URL=mysql://MYSQLUSER:MYSQLPASSWORD@MYSQLHOST:MYSQLPORT/MYSQLDATABASE?serverVersion=8.0
```

**Exemple concret :**

Si vous avez :
- `MYSQLHOST` = `mysql.railway.internal`
- `MYSQLPORT` = `3306`
- `MYSQLUSER` = `root`
- `MYSQLPASSWORD` = `abc123XYZ`
- `MYSQLDATABASE` = `railway`

Alors `DATABASE_URL` sera :

```
DATABASE_URL=mysql://root:abc123XYZ@mysql.railway.internal:3306/railway?serverVersion=8.0
```

**⚠️ Important :** Si votre mot de passe contient des caractères spéciaux (comme `@`, `:`, `/`, etc.), ils doivent être encodés en URL. Par exemple, `@` devient `%40`.

### Étape 3: Ajouter DATABASE_URL dans Railway

1. Allez dans votre **service Symfony** (pas le service MySQL)
2. Cliquez sur l'onglet **"Variables"**
3. Cliquez sur **"+ New Variable"**
4. Ajoutez :
   - **Name**: `DATABASE_URL`
   - **Value**: La valeur construite à l'étape 2
5. Cliquez sur **"Add"**

### Étape 4: Vérifier les autres variables

Assurez-vous que ces variables sont également définies dans votre service Symfony :

- ✅ `APP_ENV=prod`
- ✅ `APP_SECRET` (une chaîne aléatoire de 32 caractères)
- ✅ `APP_DEBUG=0`
- ✅ `DATABASE_URL` (celle que vous venez d'ajouter)

## 📥 Import d'un Dump SQL

### Option 1: Via Railway CLI (Recommandé)

1. **Installer Railway CLI :**
   ```bash
   npm i -g @railway/cli
   ```

2. **Se connecter à Railway :**
   ```bash
   railway login
   ```

3. **Lier votre projet :**
   ```bash
   railway link
   ```

4. **Placer votre fichier SQL dans le projet :**
   - Créez un dossier `sql/` à la racine
   - Placez votre dump SQL dedans (ex: `sql/dump.sql`)

5. **Importer via Railway Shell :**
   ```bash
   # Ouvrir un shell dans le service MySQL
   railway connect mysql
   
   # Dans le shell MySQL, exécuter :
   source /path/to/sql/dump.sql
   ```

   OU directement :
   ```bash
   railway run mysql -e "source /app/sql/dump.sql"
   ```

### Option 2: Via SSH dans le conteneur Symfony

1. **Ouvrir un shell Railway :**
   ```bash
   railway shell
   ```

2. **Installer mysql-client :**
   ```bash
   apt-get update && apt-get install -y default-mysql-client
   ```

3. **Importer le dump :**
   ```bash
   mysql -h $MYSQLHOST -P $MYSQLPORT -u $MYSQLUSER -p$MYSQLPASSWORD $MYSQLDATABASE < /app/sql/dump.sql
   ```

### Option 3: Via phpMyAdmin ou TablePlus

1. **Récupérer les credentials depuis Railway :**
   - `MYSQLHOST` (ex: `mysql.railway.internal`)
   - `MYSQLPORT` (ex: `3306`)
   - `MYSQLUSER` (ex: `root`)
   - `MYSQLPASSWORD`
   - `MYSQLDATABASE`

2. **Se connecter avec un client MySQL :**
   - **phpMyAdmin** : Si vous avez un service phpMyAdmin sur Railway
   - **TablePlus** : Client graphique MySQL
   - **DBeaver** : Client SQL gratuit
   - **MySQL Workbench** : Client officiel MySQL

3. **Importer le dump SQL** via l'interface graphique

### Option 4: Via Doctrine Migrations (Recommandé pour la production)

Si vous utilisez Doctrine Migrations, créez une migration depuis votre dump :

```bash
# Localement, avec Docker
docker-compose exec symfony php bin/console doctrine:migrations:diff
docker-compose exec symfony php bin/console doctrine:migrations:migrate

# Puis sur Railway
railway run php bin/console doctrine:migrations:migrate --no-interaction
```

## ✅ Vérification

### Tester la connexion à la base

1. **Via Railway Shell :**
   ```bash
   railway shell
   php bin/console doctrine:query:sql "SELECT 1"
   ```

2. **Vérifier les tables :**
   ```bash
   php bin/console doctrine:query:sql "SHOW TABLES"
   ```

### Vérifier la configuration Doctrine

La configuration Doctrine est déjà correcte dans `config/packages/doctrine.yaml` :

```yaml
doctrine:
    dbal:
        url: '%env(resolve:DATABASE_URL)%'
```

Le `serverVersion=8.0` est spécifié dans `DATABASE_URL`, donc pas besoin de modifier le fichier de configuration.

## 🔍 Résolution de problèmes

### Erreur : "Access denied"

- Vérifiez que `DATABASE_URL` contient le bon mot de passe
- Vérifiez que le mot de passe est correctement encodé (caractères spéciaux)

### Erreur : "Unknown database"

- Vérifiez que `MYSQLDATABASE` dans `DATABASE_URL` correspond au nom réel de la base
- Vérifiez que la base existe dans Railway

### Erreur : "Connection refused"

- Vérifiez que `MYSQLHOST` est bien `mysql.railway.internal` (pour les connexions internes)
- Vérifiez que les deux services (Symfony et MySQL) sont dans le même projet Railway

## 📝 Commandes utiles

```bash
# Voir les variables d'environnement Railway
railway variables

# Ouvrir un shell Railway
railway shell

# Voir les logs
railway logs

# Tester la connexion Doctrine
railway run php bin/console doctrine:query:sql "SELECT 1"
```

## 🎯 Récapitulatif des fichiers

- `scripts/build-database-url.php` : Script pour construire automatiquement DATABASE_URL
- `scripts/import-sql.sh` : Guide pour importer un dump SQL
- `config/packages/doctrine.yaml` : Configuration Doctrine (déjà correcte)
- `railway.json` : Configuration Railway (déjà correcte)

## 📚 Ressources

- [Documentation Railway - Variables d'environnement](https://docs.railway.app/develop/variables)
- [Documentation Railway - Databases](https://docs.railway.app/databases)
- [Documentation Symfony - Doctrine](https://symfony.com/doc/current/doctrine.html)





