# Exercice 1

Vous devez réaliser un micro site qui permet de :
- gérer des utilisateurs (sans mot de passe)
- gérer des tâches

## Page Accueil
Cette page doit afficher :
- __tous les utilisateurs__ inscrits, avec pour chacun le __nombre de tâches__ qui lui sont assignées,
- un __formulaire__ permettant d'__ajouter un nouvel utilisateur__.

S'il n'y a aucun utilisateur, affichez un message du type "Il n'y a aucun utilisateur".

Chaque __utilisateur__ possède les propriétés suivantes :
- `nom`,
- `prénom`,
- `email` (qui doit être unique),
- `date d'inscription` (date qui doit être automatiquement renseigné lors de son ajout).

Au clic d'un utilisateur, on arrive sur le page `Utilisateur`.

## Page Tâches
Cette page doit afficher :
- __toutes les tâches__, avec pour chacune leur __état__,
- un __formulaire__ permettant d'__ajouter une nouvelle tâche__.

Chaque __tâche__ possède les propriétés suivantes :
- `nom`,
- `deadline` (date),
- `utilisateur` (id de l'utilisateur à qui la tâche est attribuée),
- `état` (boolean indiquand si la tâche à été validée (true) ou non (false -> par défaut)).

Le formulaire permettant d'ajouter une nouvelle tâche, doit posséder une liste déroulante (balise `select`) qui contient tous les utilisateurs inscrits.

Au clic d'une tâche, on arrive sur le page `Tâche`.

## Page Utilisateur
Cette page doit afficher :
- un __formulaire__ permettant de __modifier l'utilisateur__ (`nom`,`prénom`, `email`),
- la __liste des tâches assignées__ à l'utilisateur (`nom`, `deadline`, `état`).

S'il n'y a aucune tâche d'assignée à l'utilisateur, affichez le message "`John` ne possède aucune tâche" en remplaçant `John` par le prénom de l'utilisateur.

Chaque tâche doit pouvoir être :
- `validée`,
- `supprimée`.

## Page Tâche
Cette page doit afficher :
- un __formulaire__ permettant de __modifier la tâche__ (`nom de la tâche`,`deadline`, `utilisateur`).