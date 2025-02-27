# part-1

Bonjour et bienvenue à tous.

Lisez d'abord toute la consigne puis suivez les étapes dans l'ordre indiqué.

Amusez-vous bien ^^

```
===> Vous avez pour objectif de:
    - créer une appli responsive sur le thème de l'Univers cinématographique Marvel
    - stocker les données dans une bdd
    - mettre en place le CRUD sur les films
```

===> Contraintes:

- [ ] seules les technologies HTML5, Bootstrap, PHP/MySQL devront être utilisées
- [ ] l'arborescence du code source ne doit pas être modifiée sauf indications
- [ ] la bdd devra être construite selon les instructions fournies (_instructions/...JPG)
- [ ] les affiches des films devront avoir une taille de 300x400px 72ppp
- [ ] vous devrez re-travailler toutes les images pour le web (minimiser les tailles) avant de les uploader, exemple avec "./uploads/incredible-hulk.jpg" qui fait 31,4Ko
- [x] lu et approuvé :)

===> 1

- [ ] initialisez un nouveau dépôt privé sur GitHub et nommez le selon les mêmes consignes que les précédentes activités
- [ ] profitez-en pour m'inviter en tant que collaborateur ainsi que: Maxence D, Hugo, Quentin, Raphaël
- [ ] Vous devrez pusher vos commits quotidiennement.

===> 2

Les différentes pages de l'appli:
- [ ] accueil (message de bienvenue)
- [ ] liste de tous les films
- [ ] la fiche d'un film
- [ ] formulaire pour ajouter un nouveau film
- [ ] formulaire pour modifier un film déjà existant
- [ ] résultat(s) de recherche triée du plus ancien au plus récent

Page: liste de tous les films
- [ ] affiches cliquables des films triés du plus ancien au plus récent
- [ ] boutton ajouter

Page: fiche d'un film
- [ ] l'image
- [ ] toutes les infos de la bdd (exemple d'affichage pour *release_date*: "31 juillet 2020")
- [ ] boutton retour à la liste
- [ ] boutton modifier
- [ ] boutton supprimer qui ouvre une popup bootstrap et demande confirmation

Bouton Search:
- [ ] être en mesure de pouvoir faire une recherche de film à n'importe quel moment

===> 3

Au niveau du contenu des données:
- [ ] entre 5 et 10 films (date de sortie et titre fr)

===> 4

Une fois votre activité terminée
- [ ] exportez votre bdd (format .sql) dans le dossier sql
- [ ] faites un dernier commit "part 1 completed"
- [ ] et prévenez les collaborateurs

===> 5

```
if($activity == "part 1 completed" AND $motivation == true AND !empty($coffeeCup)){
  echo "d'abord créer une nouvelle branche Git";
  echo "continuer d'améliorer l'appli";
}
```

===> recommandations

- faites de l'indentation votre priorité
- prenez l'habitude de coder/commenter avec du vocabulaire anglais
- les contenus doivent rester en français pour l'instant


Restant à votre disposition
Merci, bon code ;)

Nicolas
[votre Formateur dévoué -_*]
