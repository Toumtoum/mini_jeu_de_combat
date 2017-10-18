<?php

class Personnage {

  Private $_id;
  Private $_nom;
  Private $_degats;

  public function __construct(array $donnees){

    $this->hydrate($donnees);

  }

  public function hydrate(array $donnees){

    foreach ($donnees as $key => $value){
      $method = 'set'.ucfirst($key);

      if (method_exists($this, $method)){
        $this->$method($value);
      }
    }
  }

// GETTERS

  public function getId(){

    return $this->_id;

  }

  public function getNom(){

    return $this->_nom;

  }

  public function getDegats(){

    return $this->_degats;

  }

// SETTERS

  public function setId($id){

  if (is_int($id)){
    $this->_id = $id;
  }

}

  public function setNom($nom){

  if (is_string($nom)){
    $this->_nom = $nom;
  }

}

  public function setDegats($degats){

  if (is_int($degats)){
    $this->_degats = $degats;
  }

}

// Méthodes

  public function encaisserDegats(){

    $this->_degats += 5;

    if ($this->_degats >= 100){

      echo $this->_nom . 'n\'est plus des notres';

    }

    else{

      echo $this->_nom . 'vient d\'être frappé';

    }

  }

  public function frapper(Personnage $perso){

    if ($perso == $this->_nom){

      echo 'TU NE PEUX PAS TE FRAPPER TOI MÊME!!!!!!!!!!!!!!';

    }
    else {

    $perso->encaisserDegats();

    }

  }

  }


 ?>
