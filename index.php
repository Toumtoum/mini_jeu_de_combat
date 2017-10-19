<?php

function chargerClasse($class)
{
  require 'class/' . $class . '.php'; // On inclut la classe correspondante au paramètre passé.
}
spl_autoload_register('chargerClasse');

function connectBdd () {
  try{
    $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root' , 'qX7-xM4-z6z-vPb',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  }
  catch (Exception $e)
  {
  die ('Erreur : ' .$e->getMessage());
  }
  return $bdd;
  }

  //Chargement automatique des classes

  // Connection BDD

  // Création d'une instance personnageManager

  $db = connectbdd();

  $manager = new personnageManager($db);

  // Créer un personnage si il n'existe pas déja et l'insérer en base de données.

  if (isset($_POST['creer']) && isset($_POST['nom']) && !empty(['nom'])){
    $data = ["nom" => $_POST["nom"]];
    $perso = new Personnage($data);

    if ($manager -> exists($_POST['nom'])){
      echo 'Ce personnage existe déjà';
  }
  else {
    $manager -> addPersonnage($perso);
  }
  }



  if (isset($_POST['attaquant']) && isset($_POST['attaque']) && isset($_POST['attaquer'])){
    $persoAttaquant = $manager->get($_POST['attaquant']);
    $perso = $manager->get($_POST['attaque']);
    $persoAttaquant->frapper($perso);
    if ($perso->getDegats() >= 100){
      $manager->deletePersonnage($perso);
    }
    else {
    $manager->updatePersonnage($perso);
  }
  // header("Location: index.php");

  }
 ?>
<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->

        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <link href="css/bootstrap.min.css" rel="stylesheet">


    </head>
    <body>

      <main>
    <table class="striped">
      <thead>
        <tr>
          <th>PERSONNAGE</th>
          <th>DEGATS</th>
        </tr>
      </thead>
      <tbody>
      <?php
      if ($manager -> getAll()){
      $donnees = $manager -> getAll();

      foreach ($donnees as $value) {?>
        <tr>
            <td><? echo $value->getNom();?></td>
            <td><? echo $value->getDegats();?></td>
        </tr>
        <?php
        }
        }?>
        </tbody>
      </table>

          </div>

          <div>
            <form action="" method="post">
              <p>
                Nom : <input type="text" name="nom" maxlength="50" />
                <input type="submit" value="Créer ce personnage" name="creer" />
              </p>
            </form>
          </div>



          <div class="jouer">
            <form action="" method="post">
              <label for="attaquant">PERSONNAGE ATTAQUANT</label>
              <select id="attaquant" name="attaquant" class="form-control">
              <!-- <option value="" disabled selected>Choix du personnage qui attaque</option> -->
              <?php
              foreach ($donnees as $value) {?>
                <option value=<? echo $value->getId();?>><? echo $value->getNom();?></option>
              <?php
              }?>
              </select>
              <label for="attaque">PERSONNAGE ATTAQUÉ</label>
              <select id="attaque" name="attaque" class="form-control">
              <!-- <option value="" disabled selected>Choix du personnage attaqué</option> -->
              <?php
              foreach ($donnees as $value) {?>
                <option value=<? echo $value->getId();?>><? echo $value->getNom();?></option>
              <?php
              }?>
              </select>
              <input type="submit" value="ATTAQUER" name="attaquer" />
            </form>
          </div>


      </main>


        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.12.0.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>



        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='https://www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>
    </body>
</html>
