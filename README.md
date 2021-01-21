# Repository du Réseau de Transport Solidaire en Ouest Sud Charente

---

# Commandes Git (version courte)

- **Travailler sur le dossier en local :**<br>
    - Dans VS Code, ouvrir un nouveau terminal, se placer dans "www" et entrer :<br>
    - ``git clone https://github.com/LoicChampaloux/transport-solidaire.git``<br>
- **Créer puis travailler sur sa branche :**<br>
    - Dans VS Code, ouvrir un nouveau terminal, se placer dans "transport-solidaire" et entrer :<br>
    - ``git branch chloe``<br>
    - ``git chekout chloe``<br>
- **Envoyer ses modifications sur GitHub :**<br>
    - ``git add -p``<br>
    - ``y`` (yes) autant de fois que nécessaire<br>
    - ``git commit -m "Message"``<br>
    - ``git push -u origin chloe``<br>
    - **Sur GitHub**, créer une pull request<br>
    - Valider la merge (fusion) si aucun problème n'a été trouvé, sinon rectifier<br>
- **Prendre en compte les fichiers marqués d'un "U" (Untracked, non suivis) :**<br>
    - ``git add -A``<br>
- **Récupérer des modifications que l'on n'a pas en local :**<br>
    - ``git pull origin master``<br>

---

# Commandes Git (avec quelques explications)

## Travailler sur le dossier en local

- **Dans VS Code**, ouvrir un terminal en ayant le dossier "www" ouvert
- **Bien vérifier qu'on est dans "www" en ligne de commande** (par exemple ``D:\Programmes\wamp64\www>``, on est bien dans le dossier "www" de Wamp)
- ``git clone https://github.com/LoicChampaloux/transport-solidaire.git``

**Explications :**<br>
Le dossier va se cloner directement dans "www" avec, à l'intérieur, un dossier de configuration invisible ".git" nécessaire pour lier le dossier au repository sur Git.<br>

---

## Créer puis travailler sur sa branche

- ``git branch chloe``
- ``git chekout chloe``

**Explications :**<br>
``git branch`` crée une branche avec le nom qu'on lui donne (par ex ``chloe``). Crée automatiquement la branche distante associée (en l'occurrence ``origin chloe``, plus d'infos dans l'étape suivante).<br>
``git checkout`` sélectionne une branche existante (toujours ``chloe``) sur laquelle on va travailler.

---

## Envoyer ses modifications sur GitHub

- **Dans VS Code**, ouvrir un terminal en ayant le dossier du site ouvert
- ``git add -p``
- ``y`` (yes) autant de fois que nécessaire
- ``git commit -m "Message"``
- ``git push -u origin chloe``
- **Sur GitHub**, créer une pull request
- Valider la merge (fusion) si aucun problème n'a été trouvé, sinon rectifier

**Explications :**<br>
On prendra en compte la hiérarchie suivante : chloe -> origin chloe -> origin master -> master (repository)<br>
``git add`` ajoute les modifications dans une zone de transit depuis une branche personnelle (chloe) vers la branche distante (origin chloe) ; ``-p`` (patch) permet de vérifier une à une les modifications en question et de les conserver ou non en tapant ``y`` (yes) ou ``n`` (no).<br>
``git commit`` valide les modifications de la branche distante avec un message obligatoire (``-m "Message"``) pour savoir de quoi il s'agit.<br>
``git push`` envoie le.s commit.s (miam l'écriture inclusive) de la branche qu'on a choisie avec ``-u``, en l'occurence la branche distante ``origin chloe``, vers origin master.

---

## Prendre en compte les fichiers marqués d'un "U" (Untracked, non suivis)

- **Dans VS Code**, ouvrir un terminal en ayant le dossier du site ouvert
- ``git add -A``
- Envoyer les modifications sur GitHub

---

## Récupérer des modifications que l'on n'a pas en local

- ``git pull origin master``

---

## Créer un repository sur GitHub et le lier à un dossier en local

- **Sur GitHub** directement, créer un nouveau repository
- Créer un nouveau dossier **dans le dossier "www"** qui va être associé au repository
- **Dans VS Code**, ouvrir un terminal en ayant le nouveau dossier ouvert
- ``git remote add origin https://github.com/LoicChampaloux/transport-solidaire.git``
- ``git push -u origin master``

---

# Merci Kevin, merci Jonas !

--------------------

## Partie MVC

### Architecture

```
|app
    |Controller
    |Table
    |Views
        |Templates
    App.php
    Autoloader.php
|config
    |config.php
|core
    |Auth
        |Dbauth.php
    |Controller
        |Controller.php
    |Database
        |Database.php
        |MysqlDatabase.php
    |Entity
        |Entity.php
    |Router
        |Route.php
        |Router.php
        |RouterException.php
    |Table
        |Table.php
    Autoloader.php
    Config.php
|public
    |index.php
.htaccess
```


Découpe de l'application dans différent dossier :
  * app : Contient tout ce qui est relatif a l'application
    * Controller : Controller de chaque page / type de page (contient le logique)
    * Table : Etant de Core/Table et permet de faire des actions générique sur une tabled db
    * Views : Toutes les vues du site avec un minimum de logique
  * config : Contient le fichier de configuration de la base de données (login, mdp, host)
  * core : Tout ce qui est générique mais pas propre a l'application (Router, Config pdo etc..)
    * Auth : Gère tout ce qui est login, session, cookies etc (Tout ce qi est relatif a de l'authentfication)
    * Controller : Controller générique, c'est lui qui rend les pages
    * Database : Tout ce qui est connection & paramatrage coté connecteur DB (PDO) (overload des fonctions de PDO, nouvelles fonction plus précise vis a vis l'application)
    * Entity : (parent Core\Entity avec magic get function) -> Permet de _loadModel('table')->methodDeLaTable
    * Router : Gère le routing du site
    * Table : Définis des actions générique sur la DB (fetch all, find etc)
  * public : Définis tout ce qui est coté client (sources js, css, images, pdf etc...)

---

### Utilisation

Globalement, une page est une vue, elle ne contient (dans les meilleurs cas) que la partie affichage.

La partie logique est reportée sur le controller associée a cette vue. Les controller ont toujours un nom en majuscule suffixé de controller, exemple : `IndexController.php`

Un controller est une class et se construit toujours de la même façon :
```php
<?php

// Le namespace (dossier virtuel) du controller
namespace App\Controller;

// Sont nom (=nom du fichier) et sont parent (toujours AppController)
class TestController extends AppController {

    // Un constructeur qui prend le constructeur de sont parent
    public function __construct() {
        parent::__construct();
    }

    // Les fonctions qui le compose exemple, ici avec le rendu d'une vu et de ses variables

    /**
     * Function render test view
     *
     * @return void
     */
    public function index() {
        App::getInstance()->title = 'Mon titre' . App::getInstance()->title;

        $enfants = [
            "Maurice" => 'Présent',
            "Nadine" => 'Abs'
        ];

        $this->render('test', compact('enfants'));
    }
}
```


Une vue est une page simple, sans header, sans footer :

```php
<h1>Bonsoir les enfants !</h1>

<p>Enfants présent :</p>
<span>Maurice : <?=$enfants['Maurice'];?> </span>
<span>Nadine : <?=$enfants['Nadine'];?> </span>
```

Pour chaque nouvelle vue, pensez a ajouter la route correspondante dans le router (public/index.php) :
```php
// Une route en get pour l'url /test avec comme controller TestController et comme fonction index
$router->get('/test', 'test.index');

// Une route get avec un parametre nommée id controller test fonction test
$router->get('/test/:id', 'test.test');

// Une route post avec le controller test et la fonction post
$router->post('/test', 'test.post');
```
