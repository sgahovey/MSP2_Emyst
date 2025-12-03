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




