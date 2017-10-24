<?php

// function chargerClasse($class)
// {
//   require '../models/' . $class . '.php';
//   require '../models/entites/' . $class . '.php'; // On inclut la classe correspondante au paramètre passé.
// }
// spl_autoload_register('chargerClasse');

require '../models/personnageManager.php';
require '../models/entites/Personnage.php';

// DB CONNECTION

require_once '../models/connectDb.php';

  $db = connectBdd();

// Creating personnageManager instance

  $manager = new personnageManager($db);

// Creat new Personnage if it doesn't exist

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

// Attacking Personnage and updating damage value in DB table

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
  }

include '../vue/index.php';
?>
