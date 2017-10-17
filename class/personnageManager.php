<?php
class personnageManager{

  private $_db;

  public function __construct($db){

    $this->setDb($db)

  }

  public function addPersonnage(Personnage $Perso){

    $req = $this->_db -> prepare('INSERT INTO personnages (nom,degats) VALUES (:nom,:degats)');
    $req = execute(['nom' => $Perso -> getNom(),
                    'degats' => $Perso -> getDegats()]);

  }

  public function deletePersonnage(Personnage $perso){
    $req = $this->_db -> prepare('DELETE FROM personnages WHERE id = :id');
    $req = execute(['id' => $Perso -> setId()]);
  }

  public function updatePersonnage(Personnage $Perso){
    $req = $this->_db -> preapre('UPDATE personnages SET degats = :degats WHERE id = :id');
    $req = execute(['degats' => $perso->getDegats(),
                    'id' => $perso->getId()]);
  }

  public function get($id)
  {
    $id = (int) $id;

    $req = $this->_db->query('SELECT id, nom, forcePerso, degats, niveau, experience FROM personnages WHERE id = '.$id);
    $donnees = $req->fetchAll();

    return new Personnage($donnees);
  }

  public function setDb(PDO $db)
  {
  $this->_db = $db;
  }


}
