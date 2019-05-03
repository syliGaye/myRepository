<?php
require_once '../repositories/Repository_4.php' ;

class Competences {
    private $id;
    private $description;
    private $idAspirant;
    private $idFormation;

    function __construct(){
        $this->description = null;
        $this->id = null;
        $this->idAspirant = null;
        $this->idFormation = null;
    }

    public function getAllCompetences($db){
        $repository_4 = new Repository_4($db, 'competences', 'id', 'description', 'idConsultant', 'idFormation');
        return $repository_4->findAll();
    }

    public function getCompetencesById($db, $id){
        $repository_4 = new Repository_4($db, 'competences', 'id', 'description', 'idConsultant', 'idFormation');
        $this->setId($id) ;
        return $repository_4->findById('id', $this->getId());
    }

    public function getCompetencesByConsultants($db, $idConsultant){
        $repository_4 = new Repository_4($db, 'competences', 'id', 'description', 'idConsultant', 'idFormation');
        $this->setIdAspirant($idConsultant);
        return $repository_4->findByValue_2('idConsultant', $this->getIdAspirant());
    }

    public function getCompetencesByFormation($db, $idFormation){
        $repository_4 = new Repository_4($db, 'competences', 'id', 'description', 'idConsultant', 'idFormation');
        $this->setIdFormation($idFormation);
        return $repository_4->findByValue_3('idFormation', $this->getIdFormation());
    }

    public function removeCompetences($db, $id){
        $repository_4 = new Repository_4($db, 'competences', 'id', 'description', 'idConsultant', 'idFormation');
        $this->setId($id);
        return $repository_4->remove('id', $this->getId());
    }

    public function removeCompetencesThroughConsultant($db, $idConsultant){
        $repository_4 = new Repository_4($db, 'competences', 'id', 'description', 'idConsultant', 'idFormation');
        $this->setIdAspirant($idConsultant);
        return $repository_4->remove_2('idConsultant', $this->getIdAspirant());
    }

    public function removeCompetencesThroughFormation($db, $idFormation){
        $repository_4 = new Repository_4($db, 'competences', 'id', 'description', 'idConsultant', 'idFormation');
        $this->setIdFormation($idFormation);
        return $repository_4->remove_3('idFormation', $this->getIdFormation());
    }

    public function getCompetencesRowCount($db){
        $repository_4 = new Repository_4($db, 'competences', 'id', 'description', 'idConsultant', 'idFormation');
        return $repository_4->counts();
    }

    public function saveCompetences($db, $description, $idAspirant, $idFormation){
        $repository_4 = new Repository_4($db, 'competences', 'id', 'description', 'idConsultant', 'idFormation');
        $donnee = $this->getAllCompetences($db);
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

        $this->setDescription($description);
        $this->setIdAspirant($idAspirant);  $this->setIdFormation($idFormation);

        return $repository_4->save('id', 'description', 'idConsultant', 'idFormation',
            $this->getId(), $this->getDescription(), $this->getIdAspirant(), $this->getIdFormation());
    }

    public function mergeCompetences($db, $id, $description, $idAspirant, $idFormation){
        $repository_4 = new Repository_4($db, 'competences', 'id', 'description', 'idConsultant', 'idFormation');
        $this->setId($id);  $this->setDescription($description);
        $this->setIdAspirant($idAspirant);  $this->setIdFormation($idFormation);

        return $repository_4->merge('id', 'description', 'idConsultant', 'idFormation',
            $this->getId(), $this->getDescription(), $this->getIdAspirant(), $this->getIdFormation());
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getIdAspirant()
    {
        return $this->idAspirant;
    }

    public function setIdAspirant($idAspirant)
    {
        $this->idAspirant = $idAspirant;
    }

    public function getIdFormation()
    {
        return $this->idFormation;
    }

    public function setIdFormation($idFormation)
    {
        $this->idFormation = $idFormation;
    }
} 