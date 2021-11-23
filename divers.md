C:\wamp64\www\App_Snowtricks

Domain

[TRICK] ok
Form
la ou les photos rattachées à la figure  
la ou les vidéos rattachées à la figure

[SHOW TRICK] pb id faire des slug
@Route
https://symfony.com/doc/current/routing.html
Les URL des pages des figures doivent contenir le nom de la figure sous forme de slug.

@Route("/blog/{slug}", name="blog_show")

[COMMENT] ok table + ok form + no association +
Form
Pour chaque message, il sera affiché les informations suivantes :
● le nom complet de l’auteur du message ;
● la photo de l’auteur du message ;
● la date de création du message ;
● le contenu du message.

---

[REGISTER USER] @/register ok form + ils ont oublier Avatar + envoie email de validation:
le nom d’utilisateur ;
l’adresse email ;
le mot de passe.
Une fois ces informations entrées, l’utilisateur reçoit un email
permettant de valider la création du compte et d’activer le compte
(via un token de validation par exemple).
https://symfony.com/doc/current/mailer.html

[email de validation]
Mailtrap

[LOGIN] @/login okform + ok rememberme
La connexion se fait sur une page dédiée via le nom d’utilisateur et le mot de passe.

- Pas dans le projet [REMEMBER ME]
  https://symfony.com/doc/current/security/remember_me.html

---

[FORGETPASSWORD] ok Ajouter ds login + comment le configurer voir video.

il peut cliquer sur « mot de passe oublié » et
sera redirigé vers la page d’oubli du mot de passe.

[RESETPASSWORD] En attente pb login make:reset-password
https://symfony.com/doc/current/security/passwords.html#reset-password
Une fois arrivé sur cette page, l’utilisateur peut entrer un nouveau mot de passe via un
formulaire.
Une fois son mot de passe changé, l’utilisateur sera redirigé vers la page d’accueil.

---

Questions
Pas d'Admin
