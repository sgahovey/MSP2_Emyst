<?php

/**
 * Script pour construire automatiquement DATABASE_URL à partir des variables Railway MySQL
 * 
 * Ce script génère la variable DATABASE_URL en utilisant les variables d'environnement
 * fournies par Railway pour MySQL.
 * 
 * Usage:
 * - Automatique : Railway utilisera ce script si configuré dans railway.json
 * - Manuel : Utiliser pour générer la valeur à copier dans Railway Variables
 */

// Variables Railway MySQL (automatiquement fournies par Railway)
$mysqlHost = $_ENV['MYSQLHOST'] ?? $_SERVER['MYSQLHOST'] ?? null;
$mysqlPort = $_ENV['MYSQLPORT'] ?? $_SERVER['MYSQLPORT'] ?? '3306';
$mysqlUser = $_ENV['MYSQLUSER'] ?? $_SERVER['MYSQLUSER'] ?? null;
$mysqlPassword = $_ENV['MYSQLPASSWORD'] ?? $_SERVER['MYSQLPASSWORD'] ?? null;
$mysqlDatabase = $_ENV['MYSQLDATABASE'] ?? $_SERVER['MYSQLDATABASE'] ?? null;

// Vérification que toutes les variables sont présentes
if (!$mysqlHost || !$mysqlUser || !$mysqlPassword || !$mysqlDatabase) {
    throw new RuntimeException('Variables MySQL Railway manquantes. Vérifiez que MYSQLHOST, MYSQLUSER, MYSQLPASSWORD et MYSQLDATABASE sont définies.');
}

// Encoder le mot de passe (au cas où il contiendrait des caractères spéciaux)
$mysqlPasswordEncoded = rawurlencode($mysqlPassword);

// Construire DATABASE_URL
$databaseUrl = sprintf(
    'mysql://%s:%s@%s:%s/%s?serverVersion=8.0',
    $mysqlUser,
    $mysqlPasswordEncoded,
    $mysqlHost,
    $mysqlPort,
    $mysqlDatabase
);

// Retourner la valeur (peut être utilisée par Symfony ou affichée)
echo $databaseUrl . PHP_EOL;

// Optionnel : Définir la variable d'environnement pour Symfony
putenv("DATABASE_URL=$databaseUrl");
$_ENV['DATABASE_URL'] = $databaseUrl;
$_SERVER['DATABASE_URL'] = $databaseUrl;

return $databaseUrl;





