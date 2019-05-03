<?php
require_once '../repositories/Repository_4.php' ;

class TypeSession {
    private $id;
    private $libelle;
    private $joursHeures;
    private $dureeSession;

    function __construct(){
        $this->dureeSession = null;
        $this->id = null;
        $this->joursHeures = null;
        $this->libelle = null;
    }

    public function getAllTypeSession($db){
        $repository = new Repository_4($db, 'typesession', 'id', 'libelle', 'joursHeures', 'dureeSession') ;
        return $repository->findAll();
    }

    public function getTypeSessionById($db, $id){
        $repository = new Repository_4($db, 'typesession', 'id', 'libelle', 'joursHeures', 'dureeSession') ;
        $this->setId($id);
        return $repository->findById('id', $this->getId()) ;
    }

    public function getTypeSessionByLibelle($db, $libelle){
        $repository = new Repository_4($db, 'typesession', 'id', 'libelle', 'joursHeures', 'dureeSession') ;
        $this->setLibelle($libelle);
        return $repository->findByValue_1('libelle', $this->getLibelle());
    }

    public function getTypeSessionByJoursHeures($db, $joursHeures){
        $repository = new Repository_4($db, 'typesession', 'id', 'libelle', 'joursHeures', 'dureeSession') ;
        $this->setJoursHeures($joursHeures);
        return $repository->findByValue_2('joursHeures', $this->getJoursHeures());
    }

    public function getTypeSessionRowCount($db){
        $repository = new Repository_4($db, 'typesession', 'id', 'libelle', 'joursHeures', 'dureeSession') ;
        return $repository->counts();
    }

    public function saveTypeSession($db, $libelle, $joursHeures, $dureeSession){
        $repository = new Repository_4($db, 'typesession', 'id', 'libelle', 'joursHeures', 'dureeSession') ;
        $donnee = $this->getAllTypeSession($db);
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

        $this->setLibelle($libelle);  $this->setJoursHeures($joursHeures);  $this->setDureeSession($dureeSession);

        return $repository->save('id', 'libelle', 'joursHeures', 'dureeSession',
            $this->getId(), $this->getLibelle(), $this->getJoursHeures(), $this->getDureeSession());
    }

    public function mergeTypeSession($db, $id, $libelle, $joursHeures, $dureeSession){
        $repository = new Repository_4($db, 'typesession', 'id', 'libelle', 'joursHeures', 'dureeSession') ;
        $this->setId($id);  $this->setLibelle($libelle);
        $this->setJoursHeures($joursHeures);  $this->setDureeSession($dureeSession);

        return $repository->merge('id', 'libelle', 'joursHeures', 'dureeSession',
            $this->getId(), $this->getLibelle(), $this->getJoursHeures(), $this->getDureeSession());
    }

    public function removeTypeSession($db, $id){
        $repository = new Repository_4($db, 'typesession', 'id', 'libelle', 'joursHeures', 'dureeSession') ;
        $this->setId($id);
        return $repository->remove('id', $this->getId());
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

    public function getJoursHeures()
    {
        return $this->joursHeures;
    }

    public function setJoursHeures($joursHeures)
    {
        $this->joursHeures = $joursHeures;
    }

    public function getLibelle()
    {
        return $this->libelle;
    }

    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }
} 