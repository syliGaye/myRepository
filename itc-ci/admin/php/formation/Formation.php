<?php
require_once '../repositories/Repository_4.php';

class Formation {
    private $id ;
    private $titre;
    private $certifDeFormation ;
    private $idTechnologie ;

    function __construct()
    {
        $this->certifDeFormation = null;
        $this->id = null;
        $this->idTechnologie = null;
        $this->titre = null;
    }

    public function getAllFormation($db){
        $repository_4 = new Repository_4($db, 'formation', 'id', 'titre', 'certifDeFormation', 'idTechnologie');
        return $repository_4->findAll();
    }

    public function getFormationById($db, $id){
        $repository_4 = new Repository_4($db, 'formation', 'id', 'titre', 'certifDeFormation', 'idTechnologie');
        $this->setId($id);
        return $repository_4->findById('id', $id) ;
    }

    public function getFormationByTitre($db, $titre){
        $repository_4 = new Repository_4($db, 'formation', 'id', 'titre', 'certifDeFormation', 'idTechnologie');
        $this->setTitre($titre);
        return $repository_4->findByValue_1('titre', $this->getTitre());
    }

    public function getFormationByTechnologie($db, $idTechnologie){
        $repository_4 = new Repository_4($db, 'formation', 'id', 'titre', 'certifDeFormation', 'idTechnologie');
        $this->setIdTechnologie($idTechnologie);
        return $repository_4->findByValue_3('idTechnologie', $this->getIdTechnologie());
    }

    public function getFormationByCertif($db, $certif){
        $repository_4 = new Repository_4($db, 'formation', 'id', 'titre', 'certifDeFormation', 'idTechnologie');
        $this->setCertifDeFormation($certif);
        return $repository_4->findByValue_2('certifDeFormation', $this->getCertifDeFormation());
    }

    public function getFormationRowCount($db){
        $repository_4 = new Repository_4($db, 'formation', 'id', 'titre', 'certifDeFormation', 'idTechnologie');
        return $repository_4->counts();
    }

    public function saveFormation($db, $titre, $certifDeFormation, $idTechnologie){
        $repository_4 = new Repository_4($db, 'formation', 'id', 'titre', 'certifDeFormation', 'idTechnologie');
        $donnee = $this->getAllFormation($db);
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

        $this->setCertifDeFormation($certifDeFormation);
        $this->setIdTechnologie($idTechnologie);  $this->setTitre($titre);

        return $repository_4->save('id', 'titre', 'certifDeFormation', 'idTechnologie',
            $this->getId(), $this->getTitre(), $this->getCertifDeFormation(), $this->getIdTechnologie());
    }

    public function mergeFormation($db, $id, $titre, $certifDeFormation, $idTechnologie){
        $repository_4 = new Repository_4($db, 'formation', 'id', 'titre', 'certifDeFormation', 'idTechnologie');
        $this->setId($id);  $this->setCertifDeFormation($certifDeFormation);
        $this->setIdTechnologie($idTechnologie);   $this->setTitre($titre);

        return $repository_4->merge('id', 'titre', 'certifDeFormation', 'idTechnologie',
            $this->getId(), $this->getTitre(), $this->getCertifDeFormation(), $this->getIdTechnologie());
    }

    public function removeFormation($db, $id){
        $repository_4 = new Repository_4($db, 'formation', 'id', 'titre', 'certifDeFormation', 'idTechnologie');
        $this->setId($id);
        return $repository_4->remove('id', $this->getId());
    }

    public function removeFormationThroughCertif($db, $certif){
        $repository_4 = new Repository_4($db, 'formation', 'id', 'titre', 'certifDeFormation', 'idTechnologie');
        $this->setCertifDeFormation($certif);
        return $repository_4->remove_2('certifDeFormation', $this->getCertifDeFormation());
    }

    public function removeFormationThroughTechnologie($db, $idTechnologie){
        $repository_4 = new Repository_4($db, 'formation', 'id', 'titre', 'certifDeFormation', 'idTechnologie');
        $this->setIdTechnologie($idTechnologie);
        return $repository_4->remove_3('idTechnologie', $this->getIdTechnologie());
    }

    public function getCertifDeFormation()
    {
        return $this->certifDeFormation;
    }

    public function setCertifDeFormation($certifDeFormation)
    {
        $this->certifDeFormation = $certifDeFormation;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getIdTechnologie()
    {
        return $this->idTechnologie;
    }

    public function setIdTechnologie($idTechnologie)
    {
        $this->idTechnologie = $idTechnologie;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function setTitre($titre)
    {
        $this->titre = $titre;
    }
} 