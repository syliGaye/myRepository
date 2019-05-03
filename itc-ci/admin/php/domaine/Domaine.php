<?php
require_once '../repositories/Repository_2.php';

class Domaine {
    private $id ;
    private $intitule ;

    function __construct()
    {
        $this->id = null ;
        $this->intitule = null ;
    }

    public function getAllDomaine($db){
        $repository_2 = new Repository_2($db, 'domaine', 'id', 'intitule') ;
        return $repository_2->findAll() ;
    }

    public function getDomaineById($db, $id){
        $this->setId($id) ;
        $repository_2 = new Repository_2($db, 'domaine', 'id', 'intitule') ;
        return $repository_2->findById('id', $this->getId()) ;
    }

    public function getDomaineByIntitule($db, $intitule){
        $repository_2 = new Repository_2($db, 'domaine', 'id', 'intitule') ;
        $this->setIntitule($intitule);
        return $repository_2->findByValue_1('intitule', $this->getIntitule());
    }

    public function getDomaineRowCount($db){
        $repository_2 = new Repository_2($db, 'domaine', 'id', 'intitule') ;
        return $repository_2->counts() ;
    }

    public function saveDomaine($db, $intitule){
        $repository_2 = new Repository_2($db, 'domaine', 'id', 'intitule') ;
        $donnee = $this->getAllDomaine($db);
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

        $this->setIntitule($intitule) ;
        return $repository_2->save('id', 'intitule', $this->getId(), $this->getIntitule()) ;
    }

    public function mergeDomaine($db, $id, $intitule){
        $repository_2 = new Repository_2($db, 'domaine', 'id', 'intitule') ;
        $this->setId($id) ;  $this->setIntitule($intitule) ;
        return $repository_2->merge('id', 'intitule', $this->getId(), $this->getIntitule()) ;
    }

    public function removeDomaine($db, $id){
        $repository_2 = new Repository_2($db, 'domaine', 'id', 'intitule') ;
        $this->setId($id);

        return $repository_2->remove('id', $id) ;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getIntitule()
    {
        return $this->intitule;
    }

    public function setIntitule($intitule)
    {
        $this->intitule = $intitule;
    }
}
