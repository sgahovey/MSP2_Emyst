# 📋 Fonctionnalités de l'Application Emyst

## 🎯 Vue d'ensemble
Emyst est une application de suivi d'entraînement et de fitness qui permet aux utilisateurs de gérer leurs séances d'entraînement, leurs objectifs et de suivre leurs statistiques.

---

## 🔐 1. Authentification et Gestion de Compte

### 1.1 Création de compte
- **Route** : `/register`
- **Fonctionnalité** : L'utilisateur peut créer un nouveau compte
- **Informations requises** :
  - Email (unique)
  - Nom
  - Mot de passe
- **Comportement** : Après l'inscription, l'utilisateur est automatiquement connecté

### 1.2 Connexion
- **Route** : `/login`
- **Fonctionnalité** : L'utilisateur peut se connecter avec son email et mot de passe
- **Gestion des erreurs** : Affichage des erreurs d'authentification

### 1.3 Déconnexion
- **Route** : `/logout`
- **Fonctionnalité** : L'utilisateur peut se déconnecter de son compte

---

## 👤 2. Gestion du Profil

### 2.1 Visualisation et modification du profil
- **Route** : `/profil`
- **Fonctionnalités** :
  - Visualiser les informations du profil
  - Modifier le nom
  - Modifier l'email
  - Modifier la taille (en cm)
  - Modifier le poids (en kg)
- **Notification** : Message de succès après modification

### 2.2 Modification du mot de passe
- **Route** : `/profil/edit-password`
- **Fonctionnalité** : L'utilisateur peut changer son mot de passe
- **Validation** : Vérification que les deux mots de passe correspondent
- **Notification** : Message de succès ou d'erreur selon le résultat

---

## 🏋️ 3. Gestion des Séances d'Entraînement

### 3.1 Liste des séances
- **Route** : `/seance`
- **Fonctionnalités** :
  - Visualiser toutes ses séances d'entraînement
  - Tri intelligent des séances :
    - **Séance du jour** affichée en premier
    - **Séances à venir** triées par date croissante
    - **Séances passées** triées par date décroissante (plus récentes en premier)
  - Si aucune séance du jour, affichage de la séance la plus proche

### 3.2 Création d'une nouvelle séance
- **Route** : `/seance/new`
- **Fonctionnalités** :
  - Définir la date d'entraînement (ne peut pas être antérieure à aujourd'hui)
  - Choisir le type de séance parmi :
    - Full body
    - Haut du corps
    - Bas du corps
    - Cardio
    - Renforcement
    - Étirements
    - HIIT
    - Abdos
    - Pliométrie
  - Définir la durée de la séance
  - Ajouter des exercices à la séance :
    - Sélectionner un exercice depuis la liste (triée par nom)
    - Définir l'ordre de l'exercice dans la séance
    - Spécifier le nombre de répétitions
    - Spécifier la charge (poids en kg)
    - Définir la durée de l'exercice (format HH:MM:SS)
  - Possibilité d'ajouter plusieurs exercices à une même séance

### 3.3 Visualisation d'une séance
- **Route** : `/seance/{id}`
- **Fonctionnalité** : Visualiser les détails complets d'une séance :
  - Date d'entraînement
  - Type de séance
  - Durée totale
  - Liste des exercices avec leurs détails (ordre, répétitions, charge, durée)

### 3.4 Modification d'une séance
- **Route** : `/seance/{id}/edit`
- **Fonctionnalités** :
  - Modifier la date d'entraînement
  - Modifier le type de séance
  - Modifier la durée
  - Modifier, ajouter ou supprimer des exercices
  - Réorganiser l'ordre des exercices
  - Modifier les paramètres de chaque exercice (répétitions, charge, durée)

### 3.5 Suppression d'une séance
- **Route** : `/seance/{id}` (méthode POST avec token CSRF)
- **Fonctionnalité** : Supprimer une séance et tous ses exercices associés
- **Sécurité** : Protection CSRF pour éviter les suppressions accidentelles

---

## 🎯 4. Gestion des Objectifs

### 4.1 Liste et création d'objectifs
- **Route** : `/objectif`
- **Fonctionnalités** :
  - Visualiser tous ses objectifs
  - Créer un nouvel objectif avec :
    - **Type d'objectif** parmi :
      - Perte de poids
      - Prise de masse
      - Sèche musculaire
      - Amélioration cardio-vasculaire
      - Augmentation de la force
      - Amélioration de l'endurance
      - Amélioration de la vitesse
      - Amélioration de la flexibilité
      - Augmentation de la fréquence des séances
      - Préparation à une compétition
      - Battre un record personnel
    - **Valeur cible** (nombre)
    - **Date limite** pour atteindre l'objectif

### 4.2 Modification d'un objectif
- **Route** : `/objectif?edit={id}`
- **Fonctionnalité** : Modifier un objectif existant (type, valeur cible, date limite)
- **Interface** : Formulaire partagé avec la création (mode édition activé)

---

## 📊 5. Tableau de Bord (Dashboard)

### 5.1 Vue d'ensemble
- **Route** : `/dashboard`
- **Fonctionnalités** :
  - **Statistiques générales** :
    - Nombre total de séances effectuées
    - Total d'heures d'entraînement (arrondi à 1 décimale)
    - Dernière séance effectuée
    - Liste des 5 dernières séances
  
  - **Graphique 1 : Répartition des types de séances**
    - Visualisation de la distribution des différents types de séances
    - Compte le nombre de séances par type
  
  - **Graphique 2 : Volume hebdomadaire**
    - Visualisation du volume d'entraînement par semaine
    - Permet de suivre l'évolution de l'activité sur plusieurs semaines

---

## 📈 6. Statistiques Détaillées

### 6.1 Page de statistiques
- **Route** : `/stats`
- **Fonctionnalités** :

  #### 6.1.1 Filtres disponibles
  - **Période** : Choix entre :
    - Semaine (7 derniers jours)
    - Mois (30 derniers jours) - par défaut
    - Année (12 derniers mois)
  - **Exercice** : Sélection d'un exercice spécifique pour analyser sa progression

  #### 6.1.2 Graphiques de progression par exercice
  - **Volume** : Graphique montrant l'évolution du volume (charge × répétitions) pour l'exercice sélectionné
  - **Durée** : Graphique montrant l'évolution de la durée d'exécution de l'exercice
  - Groupement des données :
    - Par jour pour les périodes semaine/mois
    - Par mois pour la période année

  #### 6.1.3 Graphique de volume hebdomadaire global
  - Visualisation du volume total d'entraînement sur les 12 dernières semaines
  - Permet d'analyser les tendances à long terme

---

## 🏠 7. Page d'Accueil

### 7.1 Page principale
- **Route** : `/`
- **Fonctionnalité** : Page d'accueil avec message de bienvenue "Bienvenue sur Emyst !"

---

## 🔒 8. Sécurité et Contraintes

### 8.1 Protection des données
- Chaque utilisateur ne peut voir et modifier que ses propres données :
  - Ses séances
  - Ses objectifs
  - Son profil
- Les statistiques et le tableau de bord sont filtrés par utilisateur

### 8.2 Validation des données
- **Date de séance** : Ne peut pas être antérieure à la date actuelle
- **Mots de passe** : Vérification de correspondance lors du changement
- **Email** : Unique dans la base de données
- **Token CSRF** : Protection contre les attaques CSRF lors des suppressions

### 8.3 Authentification requise
- La plupart des fonctionnalités nécessitent d'être connecté
- Redirection automatique vers la page de connexion si non authentifié

---

## 📱 9. Structure des Données Utilisateur

### 9.1 Profil utilisateur
- Email (unique)
- Nom
- Taille (cm, optionnel)
- Poids (kg, optionnel)
- Date de création du compte

### 9.2 Séances
- Date d'entraînement
- Type de séance
- Durée totale
- Liste d'exercices avec :
  - Exercice sélectionné
  - Ordre dans la séance
  - Nombre de répétitions
  - Charge (kg)
  - Durée de l'exercice

### 9.3 Objectifs
- Type d'objectif
- Valeur cible
- Date limite

---

## 🎨 10. Interface Utilisateur

### 10.1 Navigation
- Menu de navigation accessible depuis toutes les pages
- Liens vers les principales sections :
  - Accueil
  - Tableau de bord
  - Séances
  - Objectifs
  - Statistiques
  - Profil
  - Connexion/Déconnexion

### 10.2 Expérience utilisateur
- Messages de succès/erreur pour les actions importantes
- Tri intelligent des séances (séance du jour en priorité)
- Formulaires intuitifs avec validation en temps réel
- Graphiques interactifs pour les statistiques

---

## 📝 Résumé des Actions Disponibles

### Actions sans authentification
- ✅ Voir la page d'accueil
- ✅ Créer un compte
- ✅ Se connecter

### Actions nécessitant une authentification
- ✅ Se déconnecter
- ✅ Voir et modifier son profil
- ✅ Changer son mot de passe
- ✅ Voir la liste de ses séances
- ✅ Créer une nouvelle séance
- ✅ Voir les détails d'une séance
- ✅ Modifier une séance
- ✅ Supprimer une séance
- ✅ Voir ses objectifs
- ✅ Créer un objectif
- ✅ Modifier un objectif
- ✅ Voir le tableau de bord avec statistiques
- ✅ Voir les statistiques détaillées avec graphiques
- ✅ Filtrer les statistiques par période et exercice

---

## 🚀 Technologies Utilisées

- **Framework** : Symfony
- **Base de données** : MySQL
- **ORM** : Doctrine
- **Frontend** : Twig, CSS, JavaScript
- **Graphiques** : Chart.js (via les fichiers JS dans public/js/)
- **API** : API Platform (pour les exercices)

---

*Document généré pour le projet MSP2 - Emyst*




