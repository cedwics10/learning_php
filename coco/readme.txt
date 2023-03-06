v3.0 UPDATE du 24/02/2023
- ajout de la classe interface I_crud (framework/I_crud.class.php)
- update du modele Ctr_xxx.php qui implements I_crud
- update du modele xxx_edit.php (action="save")

v2.2 UPDATE du 07/03/2022
- config.php : try catch sur la connexion
- ajout du module "authentification"
- fonction.php : 
	- modification de hlien : if (count($args)==0) return "index.php";
	- ajout de la fonction "checkAuth()"
	- ajout de la fonction "checkAllow($profil)"

v2.1 UPDATE du 28/02/2022 : 
- implementer des raccourcis d'accessibilité pour atteindre le menu et le contenu principal
- implementer les messages après enregistrements de données

v2.0 UPDATE du 25/02/2022
- Générateur : sélection des tables via des cases à cocher.
- Table.class.php : ajout de la methode "getTablesNames()".
- fonction.php : ajout de la fonction "debug()".

** Framework PDO MVC BOOTSTRAP5 2021/2022  **
- le controleur principal est : "www/index.php"
- toutes les url sont de la forme : index.php?m=<controleur>&a=<action>
- les controleurs secondaires sont dans "application/module/<module>"
- les requetes SQL sont dans le dossier "application/table"

|-- application : les fichiers propres à l'application web

   |-- _config : 
      |-- config.php : fichier de configuration inclus dans le controleur principal (index.php)

   |-- _gabarit : fichiers utilisés pour les gabarits (modèles de pages)
      |-- gabarit.php : gabarit par défaut
      |-- inc_entete.php : entête de page (bandeau supérieur)
      |-- inc_head.php : entête HTML (charge les fichiers css et js)
      |-- inc_menu.php : barre de navigation principale
      |-- inc_pied.php : pied de page   

   |-- module : dossier contenant les modules (ou contrôleurs secondaires)
      |-- _default : module par défaut, page d'acceuil
      |-- _generateur : permet de générer un module "CRUD" et une class Table pour chaque tables de la BDD. 
      |-- <module> : dossier d'un module. Pour un module de type CRUD, le nom du module correspond à une table et les fichiers sont :
         |-- Ctr_<table>.php : Controleur secondaire 
         |-- vue_<table>_edit.php : formulaire d'édition/création
         |-- vue_<table>_index.php : affiche la liste des enregistrements

   |-- table : dossier des requêtes SQL. Contient toutes les classes héritées de Table.class.php et toute classe accédant à la BDD

|-- document : cahier des charge, documentation, script sql...etc

|-- framework : dossier des fichiers internes au framework
   |-- Ctr_controleur.class.php : classe mère des controleurs   
   |-- fonction.php : fonctions utiles (autoload)
   |-- Table.class.php : classe mère des tables   

|-- vendor : dossier des librairies externes

|-- www : racine du site web
   |-- _css : fichiers css   
   |-- _images : fichiers images
   |-- _js : fichiers javascript
   |-- index.php : controleur principal

|-- composer.json : gestion des librairies utilisées. Pour installer les librairies : "composer install"
|-- composer.lock : gestion des librairies
|-- readme.txt : ce document
