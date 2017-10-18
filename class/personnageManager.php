<?php
class personnageManager{

  private $_db;

  public function __construct($db){

    $this->setDb($db);

  }

  public function addPersonnage(Personnage $perso){

    $req = $this->_db -> prepare('INSERT INTO personnages (nom,degats) VALUES (:nom,:degats)');
    $req -> execute(['nom' => $perso -> getNom(),
                    'degats' => 0]);

  }

  public function deletePersonnage(Personnage $perso){
    $req = $this->_db -> prepare('DELETE FROM personnages WHERE id = :id');
    $req -> execute(['id' => $perso -> setId()]);
  }

  public function updatePersonnage(Personnage $perso){
    $req = $this->_db -> preapre('UPDATE personnages SET degats = :degats WHERE id = :id');
    $req -> execute(['degats' => $perso->getDegats(),
                    'id' => $perso->getId()]);
  }

  public function getAll()
  {

    $req = $this->_db->query('SELECT * FROM personnages');
    $donnees = $req->fetchAll();

    return $donnees;
  }

  public function get($id)
  {
    $id = (int) $id;

    $req = $this->_db->query('SELECT * FROM personnages WHERE id = '.$id);
    $donnees = $req->fetchAll();

    return $donnees;
  }

  function exists($nom){
    $req = $this->_db -> prepare('SELECT nom FROM personnages WHERE nom = :nom');
    $req -> execute(['nom' => $nom]);
    $result = $req -> fetch();

    return $result;
  }

  public function setDb(PDO $db)
  {
  $this->_db = $db;
  }


}
