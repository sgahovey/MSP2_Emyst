# 📖 User Stories - Application Emyst

## 🔐 1. Authentification et Gestion de Compte

### 1.1 Création de compte

En tant qu'utilisateur non connecté, je veux accéder à la page d'inscription depuis la page d'accueil, afin de créer un compte.

En tant qu'utilisateur non connecté, je veux accéder à la page d'inscription depuis la page de connexion, afin de créer un compte.

En tant qu'utilisateur non connecté, je veux remplir un formulaire d'inscription avec mon nom, mon email, ma taille et mon mot de passe, afin de créer mon compte.

En tant qu'utilisateur non connecté, je veux que mon email soit unique dans le système, afin d'éviter les doublons de compte.

En tant qu'utilisateur non connecté, je veux être automatiquement connecté après mon inscription, afin d'accéder directement à l'application.

En tant qu'utilisateur non connecté, je veux voir un message d'erreur si mon email est déjà utilisé, afin de comprendre pourquoi l'inscription a échoué.

### 1.2 Connexion

En tant qu'utilisateur non connecté, je veux accéder à la page de connexion depuis la page d'accueil, afin de me connecter à mon compte.

En tant qu'utilisateur non connecté, je veux accéder à la page de connexion depuis la page d'inscription, afin de me connecter à mon compte.

En tant qu'utilisateur non connecté, je veux me connecter avec mon email et mon mot de passe, afin d'accéder à mon compte.

En tant qu'utilisateur non connecté, je veux voir mon email pré-rempli si j'ai déjà tenté de me connecter, afin de faciliter ma reconnexion.

En tant qu'utilisateur non connecté, je veux voir un message d'erreur si mes identifiants sont incorrects, afin de comprendre pourquoi la connexion a échoué.

En tant qu'utilisateur non connecté, je veux être redirigé vers la page de connexion si j'essaie d'accéder à une page protégée, afin de garantir la sécurité de mon compte.

### 1.3 Déconnexion

En tant qu'utilisateur connecté, je veux me déconnecter depuis le menu de navigation, afin de sécuriser ma session.

En tant qu'utilisateur connecté, je veux être redirigé vers la page d'accueil après ma déconnexion, afin de confirmer que je suis bien déconnecté.

---

## 👤 2. Gestion du Profil

### 2.1 Visualisation et modification du profil

En tant qu'utilisateur connecté, je veux accéder à la page "Mon Compte" depuis le menu de navigation, afin de voir mon profil.

En tant qu'utilisateur connecté, je veux voir mes informations de profil (nom, email, taille, poids), afin de consulter mes données personnelles.

En tant qu'utilisateur connecté, je veux modifier mon nom dans mon profil, afin de mettre à jour mes informations.

En tant qu'utilisateur connecté, je veux modifier mon email dans mon profil, afin de mettre à jour mon adresse de connexion.

En tant qu'utilisateur connecté, je veux modifier ma taille (en cm) dans mon profil, afin de suivre mon évolution physique.

En tant qu'utilisateur connecté, je veux modifier mon poids (en kg) dans mon profil, afin de suivre mon évolution physique.

En tant qu'utilisateur connecté, je veux voir un message de succès après avoir modifié mon profil, afin de confirmer que les modifications ont été enregistrées.

En tant qu'utilisateur connecté, je veux que mon email reste unique dans le système lors de sa modification, afin d'éviter les conflits.

### 2.2 Modification du mot de passe

En tant qu'utilisateur connecté, je veux accéder à la page de modification du mot de passe depuis mon profil, afin de changer mon mot de passe.

En tant qu'utilisateur connecté, je veux saisir mon nouveau mot de passe deux fois, afin de confirmer que je l'ai bien saisi.

En tant qu'utilisateur connecté, je veux voir un message d'erreur si les deux mots de passe ne correspondent pas, afin d'éviter une erreur de saisie.

En tant qu'utilisateur connecté, je veux voir un message de succès après avoir modifié mon mot de passe, afin de confirmer que la modification a été enregistrée.

En tant qu'utilisateur connecté, je veux être redirigé vers mon profil après avoir modifié mon mot de passe, afin de revenir à la page principale de mon compte.

---

## 🏋️ 3. Gestion des Séances d'Entraînement

### 3.1 Navigation et accès

En tant qu'utilisateur connecté, je veux accéder à la page "Créer une Séance" depuis le menu de navigation, afin de créer une nouvelle séance.

En tant qu'utilisateur connecté, je veux accéder à la page "Historique des séances" depuis le menu de navigation, afin de voir toutes mes séances.

### 3.2 Liste des séances

En tant qu'utilisateur connecté, lorsque je suis sur la page "Historique des séances", je veux voir toutes mes séances d'entraînement, afin d'avoir une vue globale de mon activité.

En tant qu'utilisateur connecté, je veux voir la séance du jour affichée en premier dans la liste, afin de repérer rapidement ma séance actuelle.

En tant qu'utilisateur connecté, je veux voir les séances à venir triées par date croissante, afin de visualiser mon planning futur.

En tant qu'utilisateur connecté, je veux voir les séances passées triées par date décroissante, afin de voir les plus récentes en premier.

En tant qu'utilisateur connecté, je veux voir la séance la plus proche affichée en premier s'il n'y a pas de séance du jour, afin d'avoir toujours la séance pertinente en évidence.

En tant qu'utilisateur connecté, je veux voir un indicateur visuel pour la séance du jour dans le tableau, afin de la repérer facilement.

En tant qu'utilisateur connecté, je veux voir le nombre total de séances dans les indicateurs, afin d'avoir une vue d'ensemble rapide.

En tant qu'utilisateur connecté, je veux voir le temps total d'entraînement dans les indicateurs, afin de connaître mon volume d'activité.

En tant qu'utilisateur connecté, je veux voir la date de ma dernière séance dans les indicateurs, afin de savoir quand j'ai entraîné pour la dernière fois.

En tant qu'utilisateur connecté, je veux voir la date de chaque séance dans le tableau, afin de situer mes entraînements dans le temps.

En tant qu'utilisateur connecté, je veux voir le type de chaque séance dans le tableau, afin d'identifier rapidement le type d'entraînement.

En tant qu'utilisateur connecté, je veux voir la liste des exercices de chaque séance dans le tableau, afin d'avoir un aperçu rapide du contenu.

En tant qu'utilisateur connecté, je veux voir la durée de chaque séance dans le tableau, afin de connaître le temps passé.

En tant qu'utilisateur connecté, je veux voir un message "Aucune séance encore enregistrée" si je n'ai pas encore créé de séance, afin de comprendre que la liste est vide.

### 3.3 Création d'une nouvelle séance

En tant qu'utilisateur connecté, je veux créer une nouvelle séance en cliquant sur "Créer une Séance", afin d'enregistrer un nouvel entraînement.

En tant qu'utilisateur connecté, je veux définir la date d'entraînement de ma séance, afin de planifier ou enregistrer mon entraînement.

En tant qu'utilisateur connecté, je veux voir un message d'erreur si je sélectionne une date antérieure à aujourd'hui, afin d'éviter d'enregistrer une séance dans le passé.

En tant qu'utilisateur connecté, je veux choisir le type de séance parmi les options disponibles (Full body, Haut du corps, Bas du corps, Cardio, Renforcement, Étirements, HIIT, Abdos, Pliométrie), afin de catégoriser mon entraînement.

En tant qu'utilisateur connecté, je veux définir la durée totale de ma séance, afin de suivre le temps passé.

En tant qu'utilisateur connecté, je veux ajouter des exercices à ma séance, afin de détailler le contenu de mon entraînement.

En tant qu'utilisateur connecté, je veux sélectionner un exercice depuis une liste triée par nom, afin de trouver facilement l'exercice souhaité.

En tant qu'utilisateur connecté, je veux définir l'ordre de chaque exercice dans la séance, afin d'organiser ma séquence d'entraînement.

En tant qu'utilisateur connecté, je veux spécifier le nombre de répétitions pour chaque exercice, afin de suivre mes performances.

En tant qu'utilisateur connecté, je veux spécifier la charge (poids en kg) pour chaque exercice, afin de suivre ma progression.

En tant qu'utilisateur connecté, je veux définir la durée de chaque exercice (format HH:MM:SS), afin de suivre le temps passé sur chaque exercice.

En tant qu'utilisateur connecté, je veux ajouter plusieurs exercices à une même séance, afin de créer une séance complète.

En tant qu'utilisateur connecté, je veux être redirigé vers la liste des séances après avoir créé une séance, afin de voir ma nouvelle séance dans la liste.

### 3.4 Visualisation d'une séance

En tant qu'utilisateur connecté, je veux voir les détails complets d'une séance en cliquant dessus, afin de consulter toutes les informations.

En tant qu'utilisateur connecté, je veux voir la date d'entraînement de la séance, afin de situer l'entraînement dans le temps.

En tant qu'utilisateur connecté, je veux voir le type de séance, afin d'identifier le type d'entraînement.

En tant qu'utilisateur connecté, je veux voir la durée totale de la séance, afin de connaître le temps passé.

En tant qu'utilisateur connecté, je veux voir la liste complète des exercices avec leurs détails (ordre, répétitions, charge, durée), afin d'avoir toutes les informations sur l'entraînement.

### 3.5 Modification d'une séance

En tant qu'utilisateur connecté, je veux modifier une séance à venir en cliquant sur le bouton "Modifier", afin de corriger ou ajuster mon planning.

En tant qu'utilisateur connecté, je veux voir le bouton "Modifier" uniquement pour les séances à venir, afin d'éviter de modifier des séances passées.

En tant qu'utilisateur connecté, je veux modifier la date d'entraînement d'une séance, afin de déplacer mon entraînement.

En tant qu'utilisateur connecté, je veux modifier le type de séance, afin de changer la catégorie de l'entraînement.

En tant qu'utilisateur connecté, je veux modifier la durée de la séance, afin de corriger le temps enregistré.

En tant qu'utilisateur connecté, je veux modifier les exercices d'une séance, afin d'ajuster le contenu de l'entraînement.

En tant qu'utilisateur connecté, je veux ajouter de nouveaux exercices à une séance existante, afin d'enrichir mon entraînement.

En tant qu'utilisateur connecté, je veux supprimer des exercices d'une séance existante, afin de simplifier mon entraînement.

En tant qu'utilisateur connecté, je veux réorganiser l'ordre des exercices dans une séance, afin de modifier la séquence d'entraînement.

En tant qu'utilisateur connecté, je veux modifier les paramètres de chaque exercice (répétitions, charge, durée), afin de mettre à jour mes performances.

En tant qu'utilisateur connecté, je veux être redirigé vers la liste des séances après avoir modifié une séance, afin de voir la séance mise à jour.

### 3.6 Suppression d'une séance

En tant qu'utilisateur connecté, je veux supprimer une séance, afin de supprimer un entraînement erroné ou non désiré.

En tant qu'utilisateur connecté, je veux que la suppression d'une séance supprime également tous ses exercices associés, afin de maintenir la cohérence des données.

En tant qu'utilisateur connecté, je veux une protection CSRF lors de la suppression, afin d'éviter les suppressions accidentelles.

---

## 🎯 4. Gestion des Objectifs

### 4.1 Navigation et accès

En tant qu'utilisateur connecté, je veux accéder à la page "Objectifs" depuis le menu de navigation, afin de gérer mes objectifs.

### 4.2 Liste des objectifs

En tant qu'utilisateur connecté, lorsque je suis sur la page "Objectifs", je veux voir tous mes objectifs dans un tableau, afin d'avoir une vue d'ensemble.

En tant qu'utilisateur connecté, je veux voir le type de chaque objectif dans le tableau, afin d'identifier rapidement l'objectif.

En tant qu'utilisateur connecté, je veux voir la valeur cible de chaque objectif dans le tableau, afin de connaître mon objectif quantitatif.

En tant qu'utilisateur connecté, je veux voir l'échéance de chaque objectif dans le tableau, afin de savoir quand je dois atteindre mon objectif.

En tant qu'utilisateur connecté, je veux voir un message "Aucun objectif pour le moment" si je n'ai pas encore créé d'objectif, afin de comprendre que la liste est vide.

En tant qu'utilisateur connecté, je veux voir un graphique de progression par objectif, afin de visualiser mes objectifs de manière graphique.

En tant qu'utilisateur connecté, je veux voir un message "Aucune donnée à afficher" si je n'ai pas d'objectifs, afin de comprendre pourquoi le graphique est vide.

### 4.3 Création d'un objectif

En tant qu'utilisateur connecté, je veux créer un nouvel objectif depuis la page "Objectifs", afin de me fixer un but à atteindre.

En tant qu'utilisateur connecté, je veux choisir le type d'objectif parmi les options disponibles (Perte de poids, Prise de masse, Sèche musculaire, Amélioration cardio-vasculaire, Augmentation de la force, Amélioration de l'endurance, Amélioration de la vitesse, Amélioration de la flexibilité, Augmentation de la fréquence des séances, Préparation à une compétition, Battre un record personnel), afin de définir mon objectif.

En tant qu'utilisateur connecté, je veux définir une valeur cible pour mon objectif, afin de quantifier mon but.

En tant qu'utilisateur connecté, je veux définir une date limite pour mon objectif, afin de me donner un délai pour l'atteindre.

En tant qu'utilisateur connecté, je veux voir le formulaire de création d'objectif dans une colonne à droite, afin d'avoir un accès rapide.

En tant qu'utilisateur connecté, je veux être redirigé vers la liste des objectifs après avoir créé un objectif, afin de voir mon nouvel objectif dans la liste.

### 4.4 Modification d'un objectif

En tant qu'utilisateur connecté, je veux modifier un objectif en cliquant sur le bouton "Modifier", afin de mettre à jour mes objectifs.

En tant qu'utilisateur connecté, je veux voir le formulaire passer en mode édition lorsque je clique sur "Modifier", afin de comprendre que je suis en train de modifier.

En tant qu'utilisateur connecté, je veux modifier le type d'objectif, afin de changer la nature de mon objectif.

En tant qu'utilisateur connecté, je veux modifier la valeur cible, afin d'ajuster mon objectif quantitatif.

En tant qu'utilisateur connecté, je veux modifier la date limite, afin de prolonger ou avancer mon échéance.

En tant qu'utilisateur connecté, je veux annuler la modification en cliquant sur "Annuler", afin de revenir à la liste sans modifier.

En tant qu'utilisateur connecté, je veux être redirigé vers la liste des objectifs après avoir modifié un objectif, afin de voir l'objectif mis à jour.

---

## 📊 5. Tableau de Bord (Dashboard)

### 5.1 Navigation et accès

En tant qu'utilisateur connecté, je veux accéder au "Tableau de bord" depuis le menu de navigation, afin de voir mes statistiques générales.

### 5.2 Statistiques générales

En tant qu'utilisateur connecté, lorsque je suis sur le tableau de bord, je veux voir le nombre total de séances effectuées, afin de connaître mon volume d'activité.

En tant qu'utilisateur connecté, je veux voir le total d'heures d'entraînement (arrondi à 1 décimale), afin de connaître le temps total passé à m'entraîner.

En tant qu'utilisateur connecté, je veux voir ma dernière séance effectuée, afin de savoir quand j'ai entraîné pour la dernière fois.

En tant qu'utilisateur connecté, je veux voir la liste des 5 dernières séances, afin d'avoir un aperçu récent de mon activité.

### 5.3 Graphiques

En tant qu'utilisateur connecté, je veux voir un graphique de répartition des types de séances, afin de visualiser la distribution de mes entraînements.

En tant qu'utilisateur connecté, je veux voir le nombre de séances par type dans le graphique, afin de connaître mes préférences d'entraînement.

En tant qu'utilisateur connecté, je veux voir un graphique de volume hebdomadaire, afin de suivre l'évolution de mon activité sur plusieurs semaines.

En tant qu'utilisateur connecté, je veux voir le volume d'entraînement par semaine dans le graphique, afin d'analyser mes tendances d'activité.

---

## 📈 6. Statistiques Détaillées

### 6.1 Navigation et accès

En tant qu'utilisateur connecté, je veux accéder à la page "Statistique" depuis le menu de navigation, afin de voir mes statistiques détaillées.

### 6.2 Filtres

En tant qu'utilisateur connecté, je veux choisir la période d'analyse parmi "Semaine", "Mois" et "Année", afin de filtrer mes statistiques selon la période souhaitée.

En tant qu'utilisateur connecté, je veux que la période "Mois" soit sélectionnée par défaut, afin d'avoir une vue d'ensemble immédiate.

En tant qu'utilisateur connecté, je veux sélectionner un exercice spécifique dans un menu déroulant, afin d'analyser la progression d'un exercice en particulier.

En tant qu'utilisateur connecté, je veux que le premier exercice de la liste soit sélectionné par défaut s'il existe, afin d'avoir des données affichées immédiatement.

### 6.3 Graphiques de progression par exercice

En tant qu'utilisateur connecté, je veux voir un graphique de progression du volume (charge × répétitions) pour l'exercice sélectionné, afin de suivre ma progression en volume.

En tant qu'utilisateur connecté, je veux voir un graphique de progression de la durée pour l'exercice sélectionné, afin de suivre ma progression en temps.

En tant qu'utilisateur connecté, je veux voir les données groupées par jour pour les périodes "Semaine" et "Mois", afin d'avoir une granularité quotidienne.

En tant qu'utilisateur connecté, je veux voir les données groupées par mois pour la période "Année", afin d'avoir une vue d'ensemble mensuelle.

### 6.4 Graphique de volume hebdomadaire global

En tant qu'utilisateur connecté, je veux voir un graphique de volume hebdomadaire global sur les 12 dernières semaines, afin d'analyser mes tendances à long terme.

En tant qu'utilisateur connecté, je veux voir le volume total d'entraînement par semaine dans le graphique, afin de suivre mon évolution hebdomadaire.

---

## 🏠 7. Page d'Accueil

### 7.1 Accès et navigation

En tant qu'utilisateur non connecté, je veux voir la page d'accueil en accédant à l'application, afin de découvrir l'application.

En tant qu'utilisateur non connecté, je veux voir un message de bienvenue "Bienvenue sur Emyst !", afin d'être accueilli sur l'application.

En tant qu'utilisateur non connecté, je veux voir les fonctionnalités principales de l'application (Gérer vos séances, Définissez vos objectifs, Visualisez vos progrès), afin de comprendre ce que l'application peut faire.

En tant qu'utilisateur non connecté, je veux voir un bouton "S'inscrire" sur la page d'accueil, afin de créer un compte.

En tant qu'utilisateur non connecté, je veux voir un bouton "Se connecter" sur la page d'accueil, afin d'accéder à mon compte existant.

---

## 🎨 8. Navigation et Interface

### 8.1 Menu de navigation

En tant qu'utilisateur connecté, je veux voir un menu de navigation (sidebar) sur toutes les pages, afin d'accéder facilement aux différentes sections.

En tant qu'utilisateur connecté, je veux voir le logo et le nom "Emyst" dans le menu, afin d'identifier l'application.

En tant qu'utilisateur connecté, je veux voir un lien "Tableau de bord" dans le menu, afin d'accéder au dashboard.

En tant qu'utilisateur connecté, je veux voir un lien "Créer une Séance" dans le menu, afin d'accéder rapidement à la création de séance.

En tant qu'utilisateur connecté, je veux voir un lien "Historique des séances" dans le menu, afin d'accéder à la liste des séances.

En tant qu'utilisateur connecté, je veux voir un lien "Objectifs" dans le menu, afin d'accéder à la gestion des objectifs.

En tant qu'utilisateur connecté, je veux voir un lien "Statistique" dans le menu, afin d'accéder aux statistiques détaillées.

En tant qu'utilisateur connecté, je veux voir un lien "Mon Compte" dans le menu, afin d'accéder à mon profil.

En tant qu'utilisateur connecté, je veux voir un lien "Déconnexion" dans le menu, afin de me déconnecter facilement.

En tant qu'utilisateur connecté, je veux voir l'élément du menu actif mis en évidence, afin de savoir sur quelle page je me trouve.

### 8.2 Messages et notifications

En tant qu'utilisateur connecté, je veux voir des messages de succès après avoir effectué une action importante, afin de confirmer que l'action a réussi.

En tant qu'utilisateur connecté, je veux voir des messages d'erreur si une action échoue, afin de comprendre ce qui s'est mal passé.

En tant qu'utilisateur connecté, je veux voir des messages d'erreur de validation dans les formulaires, afin de corriger mes erreurs de saisie.

---

## 🔒 9. Sécurité et Protection des Données

### 9.1 Protection des données utilisateur

En tant qu'utilisateur connecté, je veux voir uniquement mes propres séances, afin de préserver ma confidentialité.

En tant qu'utilisateur connecté, je veux voir uniquement mes propres objectifs, afin de préserver ma confidentialité.

En tant qu'utilisateur connecté, je veux voir uniquement mes propres statistiques, afin de préserver ma confidentialité.

En tant qu'utilisateur connecté, je veux modifier uniquement mes propres séances, afin d'éviter les modifications non autorisées.

En tant qu'utilisateur connecté, je veux modifier uniquement mes propres objectifs, afin d'éviter les modifications non autorisées.

En tant qu'utilisateur connecté, je veux modifier uniquement mon propre profil, afin d'éviter les modifications non autorisées.

### 9.2 Validation des données

En tant qu'utilisateur connecté, je veux voir un message d'erreur si j'essaie de créer une séance avec une date passée, afin d'éviter les erreurs de saisie.

En tant qu'utilisateur connecté, je veux voir un message d'erreur si mon email est déjà utilisé lors de l'inscription, afin d'éviter les doublons.

En tant qu'utilisateur connecté, je veux voir un message d'erreur si mon email est déjà utilisé lors de la modification de profil, afin d'éviter les doublons.

En tant qu'utilisateur connecté, je veux voir un message d'erreur si les deux mots de passe ne correspondent pas, afin d'éviter les erreurs de saisie.

### 9.3 Authentification requise

En tant qu'utilisateur non connecté, je veux être redirigé vers la page de connexion si j'essaie d'accéder à une page protégée, afin de garantir la sécurité.

En tant qu'utilisateur non connecté, je veux pouvoir accéder à la page d'accueil sans être connecté, afin de découvrir l'application.

En tant qu'utilisateur non connecté, je veux pouvoir accéder à la page d'inscription sans être connecté, afin de créer un compte.

En tant qu'utilisateur non connecté, je veux pouvoir accéder à la page de connexion sans être connecté, afin de me connecter.

---

## 📱 10. Expérience Utilisateur

### 10.1 Affichage et organisation

En tant qu'utilisateur connecté, je veux voir les séances organisées de manière logique (séance du jour, futures, passées), afin de trouver rapidement l'information recherchée.

En tant qu'utilisateur connecté, je veux voir les exercices triés par nom dans les listes de sélection, afin de trouver facilement un exercice.

En tant qu'utilisateur connecté, je veux voir les données formatées de manière lisible (dates, durées, poids), afin de comprendre facilement les informations.

### 10.2 Graphiques et visualisations

En tant qu'utilisateur connecté, je veux voir des graphiques interactifs pour mes statistiques, afin d'analyser visuellement mes données.

En tant qu'utilisateur connecté, je veux voir des graphiques avec des couleurs distinctes, afin de différencier facilement les éléments.

En tant qu'utilisateur connecté, je veux voir des tooltips sur les graphiques au survol, afin d'obtenir des informations détaillées.

### 10.3 Formulaires

En tant qu'utilisateur connecté, je veux voir des formulaires clairs et bien organisés, afin de remplir facilement les informations.

En tant qu'utilisateur connecté, je veux voir des labels explicites pour chaque champ de formulaire, afin de comprendre ce qui est demandé.

En tant qu'utilisateur connecté, je veux voir des messages d'erreur de validation à côté des champs concernés, afin de corriger facilement mes erreurs.

---

## 📊 Résumé par Catégorie

### Authentification et Gestion de Compte
- **13 user stories** : Création de compte, connexion, déconnexion

### Gestion du Profil
- **9 user stories** : Visualisation, modification, changement de mot de passe

### Gestion des Séances d'Entraînement
- **42 user stories** : Navigation, liste, création, visualisation, modification, suppression

### Gestion des Objectifs
- **18 user stories** : Navigation, liste, création, modification, graphiques

### Tableau de Bord
- **9 user stories** : Navigation, statistiques générales, graphiques

### Statistiques Détaillées
- **12 user stories** : Navigation, filtres, graphiques de progression, volume hebdomadaire

### Page d'Accueil
- **5 user stories** : Accès, navigation, présentation

### Navigation et Interface
- **11 user stories** : Menu de navigation, messages et notifications

### Sécurité et Protection des Données
- **13 user stories** : Protection des données, validation, authentification

### Expérience Utilisateur
- **9 user stories** : Affichage, graphiques, formulaires

---

## 📈 Total des User Stories

**Total : 141 user stories**

---

*Document généré pour le projet MSP2 - Emyst*

