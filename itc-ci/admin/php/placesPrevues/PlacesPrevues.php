<?php
require_once '../repositories/Repository_3.php';

class PlacesPrevues {
    private $id;
    private $nbrePlaces;
    private $idSession;

    function __construct(){
        $this->id = null;
        $this->idSession = null;
        $this->nbrePlaces = null;
    }

    public function getAllPlacesPrevues($db){
        $repository_3 = new Repository_3($db, 'placesprevues', 'id', 'nbrePlaces', 'idSession');
        return $repository_3->findAll();
    }

    public function getPlacesPrevuesById($db, $id){
        $repository_3 = new Repository_3($db, 'placesprevues', 'id', 'nbrePlaces', 'idSession');
        $this->setId($id);
        return $repository_3->findById('id', $this->getId());
    }

    public function getPlacesPrevuesBySession($db, $idSession){
        $repository_3 = new Repository_3($db, 'placesprevues', 'id', 'nbrePlaces', 'idSession');
        $this->setIdSession($idSession);
        return $repository_3->findByValue_2('idSession', $this->getIdSession());
    }

    public function getPlacesPrevuesByNbrePlaces($db, $nbrePlaces){
        $repository_3 = new Repository_3($db, 'placesprevues', 'id', 'nbrePlaces', 'idSession');
        $this->setNbrePlaces($nbrePlaces);
        return $repository_3->findByValue_1('nbrePlaces', $this->getNbrePlaces());
    }

    public function getPlacesPrevuesRowCount($db){
        $repository_3 = new Repository_3($db, 'placesprevues', 'id', 'nbrePlaces', 'idSession');
        return $repository_3->counts();
    }

    public function removePlacesPrevues($db, $id){
        $repository_3 = new Repository_3($db, 'placesprevues', 'id', 'nbrePlaces', 'idSession');
        $this->setId($id);
        return $repository_3->remove('id', $this->getId());
    }

    public function removePlacesPrevuesThroughSession($db, $idSession){
        $repository_3 = new Repository_3($db, 'placesprevues', 'id', 'nbrePlaces', 'idSession');
        $this->setIdSession($idSession);
        return $repository_3->remove_2('idSession', $this->getIdSession());
    }

    public function savePlacesPrevues($db, $nbrePlaces, $idSession){
        $repository_3 = new Repository_3($db, 'placesprevues', 'id', 'nbrePlaces', 'idSession');
        $donnee = $this->getAllPlacesPrevues($db);
        $i = 1;
        if(count($donnee) === 0){$this->setId(1);}
        else{
            foreach($donnee as $valeur){
                if($valeur['id'] != $i){
                    $this->setId($i);
                    break;
                }
                else{$this->setId($i + 1);}
                $i++;
            }
        }

        $this->setNbrePlaces($nbrePlaces);  $this->setIdSession($idSession);
        return $repository_3->save('id', 'nbrePlaces', 'idSession', $this->getId(), $this->getNbrePlaces(), $this->getIdSession());
    }

    public function mergePlacesPrevues($db, $id, $nbrePlaces, $idSession){
        $repository_3 = new Repository_3($db, 'placesprevues', 'id', 'nbrePlaces', 'idSession');
        $this->setId($id);  $this->setNbrePlaces($nbrePlaces);  $this->setIdSession($idSession);
        return $repository_3->merge('id', 'nbrePlaces', 'idSession', $this->getId(), $this->getNbrePlaces(), $this->getIdSession());
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getIdSession()
    {
        return $this->idSession;
    }

    public function setIdSession($idSession)
    {
        $this->idSession = $idSession;
    }

    public function getNbrePlaces()
    {
        return $this->nbrePlaces;
    }

    public function setNbrePlaces($nbrePlaces)
    {
        $this->nbrePlaces = $nbrePlaces;
    }
} 