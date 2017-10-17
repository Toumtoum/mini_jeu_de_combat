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

  public function getNom(){

    return $this->_nom;

  }

  public function getDegats(){

    return $this->_degats;

  }

  public function setDegats(){

    $this->_degats += 5;

    if ($this->_degats >= 100){

      echo $this->_nom 'n\'est plus des notres';

    }

    else{

      echo $this->_nom 'vient d\'être frappé';

    }

  }

  public function setNom($nom){

    $this->_nom = $nom;

  }

  public function frapper(Personnage $Perso){

    if ($Perso == $this->_nom){

      echo 'TU NE PEUX PAS TE FRAPPER TOI MÊME!!!!!!!!!!!!!!';

    }
    else {

    $Perso->setDegats();

    }

  }

  }


 ?>
