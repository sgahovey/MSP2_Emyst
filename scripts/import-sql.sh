#!/bin/bash

#
# Script pour importer un dump SQL dans MySQL Railway
# 
# Prérequis:
# - Avoir Railway CLI installé: npm i -g @railway/cli
# - Avoir un fichier SQL à importer (ex: dump.sql)
#
# Usage:
#   ./scripts/import-sql.sh dump.sql
#

if [ -z "$1" ]; then
    echo "❌ Erreur: Spécifiez le fichier SQL à importer"
    echo "Usage: ./scripts/import-sql.sh <fichier.sql>"
    exit 1
fi

SQL_FILE="$1"

if [ ! -f "$SQL_FILE" ]; then
    echo "❌ Erreur: Le fichier '$SQL_FILE' n'existe pas"
    exit 1
fi

echo "📦 Import du fichier SQL: $SQL_FILE"
echo ""

# Méthode 1: Via Railway CLI (recommandé)
echo "Méthode 1: Via Railway CLI"
echo "=========================="
echo ""
echo "1. Connectez-vous à Railway:"
echo "   railway login"
echo ""
echo "2. Connectez-vous au service MySQL:"
echo "   railway connect mysql"
echo ""
echo "3. Dans le shell MySQL, exécutez:"
echo "   source $SQL_FILE"
echo ""
echo "   OU directement:"
echo "   mysql < $SQL_FILE"
echo ""

# Méthode 2: Via variables d'environnement et mysql client
echo "Méthode 2: Via variables d'environnement Railway"
echo "=================================================="
echo ""
echo "1. Récupérez les variables MySQL depuis Railway:"
echo "   - MYSQLHOST"
echo "   - MYSQLPORT"
echo "   - MYSQLUSER"
echo "   - MYSQLPASSWORD"
echo "   - MYSQLDATABASE"
echo ""
echo "2. Exécutez:"
echo "   mysql -h \$MYSQLHOST -P \$MYSQLPORT -u \$MYSQLUSER -p\$MYSQLPASSWORD \$MYSQLDATABASE < $SQL_FILE"
echo ""

# Méthode 3: Via Railway Shell
echo "Méthode 3: Via Railway Shell (dans le conteneur Symfony)"
echo "========================================================="
echo ""
echo "1. Ouvrez un shell dans le service Railway:"
echo "   railway shell"
echo ""
echo "2. Installez mysql-client si nécessaire:"
echo "   apt-get update && apt-get install -y default-mysql-client"
echo ""
echo "3. Exécutez l'import avec les variables Railway:"
echo "   mysql -h \$MYSQLHOST -P \$MYSQLPORT -u \$MYSQLUSER -p\$MYSQLPASSWORD \$MYSQLDATABASE < $SQL_FILE"
echo ""

echo "✅ Choisissez la méthode qui vous convient le mieux!"





