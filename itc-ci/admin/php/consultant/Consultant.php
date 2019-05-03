<?php

require_once '../repositories/Repository_11.php';

class Consultant {
    private $id ;
    private $nom ;
    private $prenoms ;
    private $dateNaissance ;
    private $nationalite ;
    private $profession ;
    private $employeur ;
    private $fonction ;
    private $lieuHabitation ;
    private $telephone ;
    private $email ;

    function __construct(){
        $this->id = null ;
        $this->nom = null ;
        $this->prenoms = null ;
        $this->dateNaissance = null;
        $this->nationalite = null;
        $this->profession = null;
        $this->employeur = null;
        $this->fonction = null;
        $this->lieuHabitation = null;
        $this->telephone = null;
        $this->email = null;
    }

    public function getAllConsultant($db){
        $repository = new Repository_11($db, 'consultant', 'id', 'nom', 'prenoms', 'dateNaissance', 'nationalite', 'profession', 'employeur', 'fonction', 'lieuHabitation', 'telephone', 'email') ;
        return $repository->findAll() ;
    }

    public function getConsultantById($db, $id){
        $this->setId($id) ;
        $repository = new Repository_11($db, 'consultant', 'id', 'nom', 'prenoms', 'dateNaissance', 'nationalite', 'profession', 'employeur', 'fonction', 'lieuHabitation', 'telephone', 'email') ;
        return $repository->findById('id', $this->getId()) ;
    }

    public function getConsultantByEmail($db, $email){
        $repository = new Repository_11($db, 'consultant', 'id', 'nom', 'prenoms', 'dateNaissance', 'nationalite', 'profession', 'employeur', 'fonction', 'lieuHabitation', 'telephone', 'email') ;
        $this->setEmail($email);
        return $repository->findByValue_10('email', $this->getEmail());
    }

    public function saveConsultant($db, $nom, $prenoms, $dateNaissance, $nationalite, $profession, $employeur, $fonction, $lieuHabitation, $telephone, $email){
        $repository = new Repository_11($db, 'consultant', 'id', 'nom', 'prenoms', 'dateNaissance', 'nationalite', 'profession', 'employeur', 'fonction', 'lieuHabitation', 'telephone', 'email') ;
        $donnee = $this->getAllConsultant($db);
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

        $this->setNom($nom);  $this->setPrenoms($prenoms);  $this->setDateNaissance($dateNaissance);  $this->setNationalite($nationalite);
        $this->setProfession($profession);  $this->setEmployeur($employeur);  $this->setFonction($fonction);  $this->setLieuHabitation($lieuHabitation) ;
        $this->setTelephone($telephone);  $this->setEmail($email);

        return $repository->save('id', 'nom', 'prenoms', 'dateNaissance', 'nationalite', 'profession', 'employeur', 'fonction', 'lieuHabitation', 'telephone', 'email',
            $this->getId(), $this->getNom(), $this->getPrenoms(), $this->getDateNaissance(), $this->getNationalite(), $this->getProfession(),
            $this->getEmployeur(), $this->getFonction(), $this->getLieuHabitation(), $this->getTelephone(), $this->getEmail()) ;
    }

    public function getConsultantRowCount($db){
        $repository = new Repository_11($db, 'consultant', 'id', 'nom', 'prenoms', 'dateNaissance', 'nationalite', 'profession', 'employeur', 'fonction', 'lieuHabitation', 'telephone', 'email') ;
        return $repository->counts() ;
    }

    public function mergeConsultant($db, $id, $nom, $prenoms, $dateNaissance, $nationalite, $profession, $employeur, $fonction, $lieuHabitation, $telephone, $email){
        $repository = new Repository_11($db, 'consultant', 'id', 'nom', 'prenoms', 'dateNaissance', 'nationalite', 'profession', 'employeur', 'fonction', 'lieuHabitation', 'telephone', 'email') ;
        $this->setId($id);  $this->setTelephone($telephone);  $this->setEmail($email);
        $this->setNom($nom);  $this->setPrenoms($prenoms);  $this->setDateNaissance($dateNaissance);  $this->setNationalite($nationalite);
        $this->setProfession($profession);  $this->setEmployeur($employeur);  $this->setFonction($fonction);  $this->setLieuHabitation($lieuHabitation) ;
        return $repository->merge('id', 'nom', 'prenoms', 'dateNaissance', 'nationalite', 'profession', 'employeur', 'fonction', 'lieuHabitation', 'telephone', 'email',
            $this->getId(), $this->getNom(), $this->getPrenoms(), $this->getDateNaissance(), $this->getNationalite(), $this->getProfession(),
            $this->getEmployeur(), $this->getFonction(), $this->getLieuHabitation(), $this->getTelephone(), $this->getEmail()) ;
    }

    public function removeConsultant($db, $id){
        $repository = new Repository_11($db, 'consultant', 'id', 'nom', 'prenoms', 'dateNaissance', 'nationalite', 'profession', 'employeur', 'fonction', 'lieuHabitation', 'telephone', 'email') ;
        $this->setId($id);
        return $repository->remove('id', $this->getId());
    }

    public function removeConsultantThroughEmail($db, $email){
        $repository = new Repository_11($db, 'consultant', 'id', 'nom', 'prenoms', 'dateNaissance', 'nationalite', 'profession', 'employeur', 'fonction', 'lieuHabitation', 'telephone', 'email') ;
        $this->setEmail($email);
        return $repository->remove_10('email', $this->getEmail());
    }

    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmployeur()
    {
        return $this->employeur;
    }

    public function setEmployeur($employeur)
    {
        $this->employeur = $employeur;
    }

    public function getFonction()
    {
        return $this->fonction;
    }

    public function setFonction($fonction)
    {
        $this->fonction = $fonction;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getLieuHabitation()
    {
        return $this->lieuHabitation;
    }

    public function setLieuHabitation($lieuHabitation)
    {
        $this->lieuHabitation = $lieuHabitation;
    }

    public function getNationalite()
    {
        return $this->nationalite;
    }

    public function setNationalite($nationalite)
    {
        $this->nationalite = $nationalite;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function getPrenoms()
    {
        return $this->prenoms;
    }

    public function setPrenoms($prenoms)
    {
        $this->prenoms = $prenoms;
    }

    public function getProfession()
    {
        return $this->profession;
    }

    public function setProfession($profession)
    {
        $this->profession = $profession;
    }

    public function getTelephone()
    {
        return $this->telephone;
    }

    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

}