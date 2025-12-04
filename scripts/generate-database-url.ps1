# Script PowerShell pour générer DATABASE_URL depuis les variables Railway MySQL
# Usage: .\scripts\generate-database-url.ps1

Write-Host "🔧 Générateur DATABASE_URL pour Railway" -ForegroundColor Cyan
Write-Host ""

# Demander les valeurs
$mysqlHost = Read-Host "MYSQLHOST (ex: mysql.railway.internal)"
$mysqlPort = Read-Host "MYSQLPORT (ex: 3306)"
$mysqlUser = Read-Host "MYSQLUSER (ex: root)"
$mysqlPassword = Read-Host "MYSQLPASSWORD" -AsSecureString
$mysqlDatabase = Read-Host "MYSQLDATABASE"

# Convertir le mot de passe sécurisé en texte
$BSTR = [System.Runtime.InteropServices.Marshal]::SecureStringToBSTR($mysqlPassword)
$mysqlPasswordPlain = [System.Runtime.InteropServices.Marshal]::PtrToStringAuto($BSTR)

# Encoder le mot de passe (pour les caractères spéciaux)
$mysqlPasswordEncoded = [System.Web.HttpUtility]::UrlEncode($mysqlPasswordPlain)

# Valeurs par défaut
if ([string]::IsNullOrWhiteSpace($mysqlHost)) { $mysqlHost = "mysql.railway.internal" }
if ([string]::IsNullOrWhiteSpace($mysqlPort)) { $mysqlPort = "3306" }
if ([string]::IsNullOrWhiteSpace($mysqlUser)) { $mysqlUser = "root" }

# Construire DATABASE_URL
$databaseUrl = "mysql://$mysqlUser`:$mysqlPasswordEncoded@$mysqlHost`:$mysqlPort/$mysqlDatabase?serverVersion=8.0"

Write-Host ""
Write-Host "✅ DATABASE_URL généré :" -ForegroundColor Green
Write-Host ""
Write-Host $databaseUrl -ForegroundColor Yellow
Write-Host ""
Write-Host "📋 Copie cette valeur et colle-la dans Railway → Variables → DATABASE_URL" -ForegroundColor Cyan
Write-Host ""

# Copier dans le presse-papier
$databaseUrl | Set-Clipboard
Write-Host "✨ La valeur a été copiée dans le presse-papier !" -ForegroundColor Green





