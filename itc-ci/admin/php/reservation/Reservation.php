<?php
require_once '../repositories/Repository_3.php';

class Reservation {
    private $id ;
    private $nbreReservation ;
    private $idSession ;

    function __construct(){
        $this->id = null;
        $this->idSession = null;
        $this->nbreReservation = null;
    }

    public function getAllReservation($db){
        $repository_3 = new Repository_3($db, 'reservation', 'id', 'nbreReservation', 'idSession');
        return $repository_3->findAll();
    }

    public function getReservationById($db, $id){
        $repository_3 = new Repository_3($db, 'reservation', 'id', 'nbreReservation', 'idSession');
        $this->setId($id);
        return $repository_3->findById('id', $this->getId());
    }

    public function getReservationBySession($db, $idSession){
        $repository_3 = new Repository_3($db, 'reservation', 'id', 'nbreReservation', 'idSession');
        $this->setIdSession($idSession);
        return $repository_3->findByValue_2('idSession', $this->getIdSession());
    }

    public function getReservationByNbre($db, $nbreReservation){
        $repository_3 = new Repository_3($db, 'reservation', 'id', 'nbreReservation', 'idSession');
        $this->setNbreReservation($nbreReservation);
        return $repository_3->findByValue_1('nbreReservation', $this->getNbreReservation());
    }

    public function getReservationRowCount($db){
        $repository_3 = new Repository_3($db, 'reservation', 'id', 'nbreReservation', 'idSession');
        return $repository_3->counts();
    }

    public function removeReservation($db, $id){
        $repository_3 = new Repository_3($db, 'reservation', 'id', 'nbreReservation', 'idSession');
        $this->setId($id);
        return $repository_3->remove('id', $this->getId());
    }

    public function removeReservationThroughSession($db, $idSession){
        $repository_3 = new Repository_3($db, 'reservation', 'id', 'nbreReservation', 'idSession');
        $this->setIdSession($idSession);
        return $repository_3->remove_2('idSession', $this->getIdSession());
    }

    public function saveReservation($db, $nbreReservation, $idSession){
        $repository_3 = new Repository_3($db, 'reservation', 'id', 'nbreReservation', 'idSession');
        $donnee = $this->getAllReservation($db);
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

        $this->setNbreReservation($nbreReservation);  $this->setIdSession($idSession);

        return $repository_3->save('id', 'nbreReservation', 'idSession', $this->getId(), $this->getNbreReservation(), $this->getIdSession());
    }

    public function mergeReservation($db, $id, $nbreReservation, $idSession){
        $repository_3 = new Repository_3($db, 'reservation', 'id', 'nbreReservation', 'idSession');
        $this->setId($id);  $this->setNbreReservation($nbreReservation);  $this->setIdSession($idSession);

        return $repository_3->merge('id', 'nbreReservation', 'idSession', $this->getId(), $this->getNbreReservation(), $this->getIdSession());
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

    public function getNbreReservation()
    {
        return $this->nbreReservation;
    }

    public function setNbreReservation($nbreReservation)
    {
        $this->nbreReservation = $nbreReservation;
    }
}