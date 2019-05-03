<?php
require_once '../repositories/Repository_5.php';

class Disponibilite {
    private $id;
    private $dateDebut;
    private $dateFin;
    private $jrsHrsDispo;
    private $idConsultant;

    function __construct(){
        $this->dateDebut = null;
        $this->jrsHrsDispo = null;
        $this->dateFin = null;
        $this->id = null;
        $this->idConsultant = null;
    }

    public function getAllDisponibilite($db){
        $repository_5 = new Repository_5($db, 'disponibilite', 'id', 'dateDebut', 'dateFin', 'jrsHrsDispo', 'idConsultant');
        return $repository_5->findAll();
    }

    public function getDisponibiliteRowCount($db){
        $repository_5 = new Repository_5($db, 'disponibilite', 'id', 'dateDebut', 'dateFin', 'jrsHrsDispo', 'idConsultant');
        return $repository_5->counts();
    }

    public function getDisponibiliteById($db, $id){
        $repository_5 = new Repository_5($db, 'disponibilite', 'id', 'dateDebut', 'dateFin', 'jrsHrsDispo', 'idConsultant');
        $this->setId($id);
        return $repository_5->findById('id', $this->getId());
    }

    public function getDisponibiliteByConsultant($db, $idConsultant){
        $repository_5 = new Repository_5($db, 'disponibilite', 'id', 'dateDebut', 'dateFin', 'jrsHrsDispo', 'idConsultant');
        $this->setIdConsultant($idConsultant);
        return $repository_5->findByValue_4('idConsultant', $this->getIdConsultant());
    }

    public function saveDisponibilite($db, $dateDebut, $dateFin, $jrsHrsDispo, $idConsultant){
        $repository_5 = new Repository_5($db, 'disponibilite', 'id', 'dateDebut', 'dateFin', 'jrsHrsDispo', 'idConsultant');
        $donnee = $this->getAllDisponibilite($db);
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

        $this->setDateDebut($dateDebut);  $this->setDateFin($dateFin);
        $this->setJrsHrsDispo($jrsHrsDispo);  $this->setIdConsultant($idConsultant);

        return $repository_5->save('id', 'dateDebut', 'dateFin', 'jrsHrsDispo', 'idConsultant',
            $this->getId(), $this->getDateDebut(), $this->getDateFin(), $this->getJrsHrsDispo(), $this->getIdConsultant());
    }

    public function mergeDisponibilite($db, $id, $dateDebut, $dateFin, $jrsHrsDispo, $idConsultant){
        $repository_5 = new Repository_5($db, 'disponibilite', 'id', 'dateDebut', 'dateFin', 'jrsHrsDispo', 'idConsultant');
        $this->setId($id);  $this->setDateDebut($dateDebut);  $this->setDateFin($dateFin);
        $this->setJrsHrsDispo($jrsHrsDispo);  $this->setIdConsultant($idConsultant);

        return $repository_5->merge('id', 'dateDebut', 'dateFin', 'jrsHrsDispo', 'idConsultant',
            $this->getId(), $this->getDateDebut(), $this->getDateFin(), $this->getJrsHrsDispo(), $this->getIdConsultant());
    }

    public function removeDisponibilite($db, $id){
        $repository_5 = new Repository_5($db, 'disponibilite', 'id', 'dateDebut', 'dateFin', 'jrsHrsDispo', 'idConsultant');
        $this->setId($id);
        return $repository_5->remove('id', $this->getId());
    }

    public function removeDisponibiliteByConsultant($db, $idConsultant){
        $repository_5 = new Repository_5($db, 'disponibilite', 'id', 'dateDebut', 'dateFin', 'jrsHrsDispo', 'idConsultant');
        $this->setIdConsultant($idConsultant);
        return $repository_5->remove_4('idConsultant', $this->getIdConsultant());
    }

    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
    }

    public function getJrsHrsDispo()
    {
        return $this->jrsHrsDispo;
    }

    public function setJrsHrsDispo($jrsHrsDispo)
    {
        $this->jrsHrsDispo = $jrsHrsDispo;
    }

    public function getDateFin()
    {
        return $this->dateFin;
    }

    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getIdConsultant()
    {
        return $this->idConsultant;
    }

    public function setIdConsultant($idConsultant)
    {
        $this->idConsultant = $idConsultant;
    }


}