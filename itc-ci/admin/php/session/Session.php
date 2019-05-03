<?php
require_once '../repositories/Repository_8.php';

class Session {
    private $id ;
    private $dateFin ;
    private $prix;
    private $dateDebut;
    private $dureeSession;
    private $idFormation;
    private $idConsultant;
    private $idTypeSession;

    function __construct(){
        $this->dateDebut = null;
        $this->dureeSession = null;
        $this->id = null;
        $this->idConsultant = null;
        $this->idFormation = null;
        $this->idTypeSession = null;
        $this->dateFin = null;
        $this->prix = null;
    }

    public function getAllSessions($db){
        $repository_8 = new Repository_8($db, 'session', 'id', 'dateFin', 'prix', 'dateDebut', 'dureeSession', 'idFormation', 'idConsultant', 'idTypeSession');
        return $repository_8->findAll();
    }

    public function getSessionById($db, $id){
        $repository_8 = new Repository_8($db, 'session', 'id', 'dateFin', 'prix', 'dateDebut', 'dureeSession', 'idFormation', 'idConsultant', 'idTypeSession');
        $this->setId($id);
        return $repository_8->findById('id', $this->getId());
    }

    public function getSessionRowCount($db){
        $repository_8 = new Repository_8($db, 'session', 'id', 'dateFin', 'prix', 'dateDebut', 'dureeSession', 'idFormation', 'idConsultant', 'idTypeSession');
        return $repository_8->counts();
    }

    public function getSessionByDateFin($db, $dateFin){
        $repository_8 = new Repository_8($db, 'session', 'id', 'dateFin', 'prix', 'dateDebut', 'dureeSession', 'idFormation', 'idConsultant', 'idTypeSession');
        $this->setDateFin($dateFin);
        return $repository_8->findByValue_1('dateFin', $this->getDateFin());
    }

    public function getSessionByPrix($db, $prix){
        $repository_8 = new Repository_8($db, 'session', 'id', 'dateFin', 'prix', 'dateDebut', 'dureeSession', 'idFormation', 'idConsultant', 'idTypeSession');
        $this->setPrix($prix);
        return $repository_8->findByValue_2('prix', $this->getPrix());
    }

    public function getSessionByDateDebut($db, $dateDebut){
        $repository_8 = new Repository_8($db, 'session', 'id', 'dateFin', 'prix', 'dateDebut', 'dureeSession', 'idFormation', 'idConsultant', 'idTypeSession');
        $this->setDateDebut($dateDebut);
        return $repository_8->findByValue_3('dateDebut', $this->getDateDebut());
    }

    public function getSessionByDureeSession($db, $dureeSession){
        $repository_8 = new Repository_8($db, 'session', 'id', 'dateFin', 'prix', 'dateDebut', 'dureeSession', 'idFormation', 'idConsultant', 'idTypeSession');
        $this->setDureeSession($dureeSession);
        return $repository_8->findByValue_4('dureeSession', $this->getDureeSession());
    }

    public function getSessionByFormation($db, $idFormation){
        $repository_8 = new Repository_8($db, 'session', 'id', 'dateFin', 'prix', 'dateDebut', 'dureeSession', 'idFormation', 'idConsultant', 'idTypeSession');
        $this->setIdFormation($idFormation);
        return $repository_8->findByValue_5('idFormation', $this->getIdFormation());
    }

    public function getSessionByConsultant($db, $idConsultant){
        $repository_8 = new Repository_8($db, 'session', 'id', 'dateFin', 'prix', 'dateDebut', 'dureeSession', 'idFormation', 'idConsultant', 'idTypeSession');
        $this->setIdConsultant($idConsultant);
        return $repository_8->findByValue_6('idConsultant', $this->getIdConsultant());
    }

    public function getSessionByTypeSession($db, $idTypeSession){
        $repository_8 = new Repository_8($db, 'session', 'id', 'dateFin', 'prix', 'dateDebut', 'dureeSession', 'idFormation', 'idConsultant', 'idTypeSession');
        $this->setIdTypeSession($idTypeSession);
        return $repository_8->findByValue_7('idTypeSession', $this->getIdTypeSession());
    }

    public function saveSession($db, $dateFin, $prix, $dateDebut, $dureeSession, $idFormation, $idConsultant, $idTypeSession){
        $repository_8 = new Repository_8($db, 'session', 'id', 'dateFin', 'prix', 'dateDebut', 'dureeSession', 'idFormation', 'idConsultant', 'idTypeSession');
        $donnee = $this->getAllSessions($db);
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

        $this->setDateFin($dateFin);  $this->setPrix($prix);
        $this->setDateDebut($dateDebut);  $this->setDureeSession($dureeSession);
        $this->setIdFormation($idFormation);  $this->setIdConsultant($idConsultant);  $this->setIdTypeSession($idTypeSession);

        $repository_8->save('id', 'dateFin', 'prix', 'dateDebut', 'dureeSession', 'idFormation', 'idConsultant', 'idTypeSession',
            $this->getId(), $this->getDateFin(), $this->getPrix(), $this->getDateDebut(), $this->getDureeSession(), $this->getIdFormation(), $this->getIdConsultant(), $this->getIdTypeSession());

        return $this->getId();
    }

    public function removeSession($db, $id){
        $repository_8 = new Repository_8($db, 'session', 'id', 'dateFin', 'prix', 'dateDebut', 'dureeSession', 'idFormation', 'idConsultant', 'idTypeSession');
        $this->setId($id);
        return $repository_8->remove('id', $this->getId());
    }

    public function removeSessionThroughFormation($db, $idFormartion){
        $repository_8 = new Repository_8($db, 'session', 'id', 'dateFin', 'prix', 'dateDebut', 'dureeSession', 'idFormation', 'idConsultant', 'idTypeSession');
        $this->setIdFormation($idFormartion);
        return $repository_8->remove_5('idFormation', $this->getIdFormation());
    }

    public function removeSessionThroughConsultant($db, $idConsultant){
        $repository_8 = new Repository_8($db, 'session', 'id', 'dateFin', 'prix', 'dateDebut', 'dureeSession', 'idFormation', 'idConsultant', 'idTypeSession');
        $this->setIdConsultant($idConsultant);
        return $repository_8->remove_6('idConsultant', $this->getIdConsultant());
    }

    public function removeSessionThroughTypeSession($db, $idTypeSession){
        $repository_8 = new Repository_8($db, 'session', 'id', 'dateFin', 'prix', 'dateDebut', 'dureeSession', 'idFormation', 'idConsultant', 'idTypeSession');
        $this->setIdTypeSession($idTypeSession);
        return $repository_8->remove_7('idTypeSession', $this->getIdTypeSession());
    }

    public function mergeSession($db, $id, $dateFin, $prix, $dateDebut, $dureeSession, $idFormation, $idConsultant, $idTypeSession){
        $repository_8 = new Repository_8($db, 'session', 'id', 'dateFin', 'prix', 'dateDebut', 'dureeSession', 'idFormation', 'idConsultant', 'idTypeSession');
        $this->setId($id);  $this->setDateFin($dateFin);  $this->setPrix($prix);
        $this->setDateDebut($dateDebut);  $this->setDureeSession($dureeSession);
        $this->setIdFormation($idFormation);  $this->setIdConsultant($idConsultant);  $this->setIdTypeSession($idTypeSession);

        return $repository_8->merge('id', 'dateFin', 'prix', 'dateDebut', 'dureeSession', 'idFormation', 'idConsultant', 'idTypeSession',
            $this->getId(), $this->getDateFin(), $this->getPrix(), $this->getDateDebut(), $this->getDureeSession(), $this->getIdFormation(), $this->getIdConsultant(), $this->getIdTypeSession());
    }

    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
    }

    public function getDureeSession()
    {
        return $this->dureeSession;
    }

    public function setDureeSession($dureeSession)
    {
        $this->dureeSession = $dureeSession;
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

    public function getIdFormation()
    {
        return $this->idFormation;
    }

    public function setIdFormation($idFormation)
    {
        $this->idFormation = $idFormation;
    }

    public function getIdTypeSession()
    {
        return $this->idTypeSession;
    }

    public function setIdTypeSession($idTypeSession)
    {
        $this->idTypeSession = $idTypeSession;
    }

    public function getDateFin()
    {
        return $this->dateFin;
    }

    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;
    }

    public function getPrix()
    {
        return $this->prix;
    }

    public function setPrix($prix)
    {
        $this->prix = $prix;
    }
} 