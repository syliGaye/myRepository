<?php
require_once '../repositories/Repository_6.php' ;

class Utilisateur {
    private $id ;
    private $nom ;
    private $prenom ;
    private $email ;
    private $tel ;
    private $user ;

    function __construct()
    {
        $this->email = null;
        $this->id = null;
        $this->nom = null;
        $this->prenom = null;
        $this->tel = null;
        $this->user = null;
    }

    public function getAllUtilisateur($db){
        $repository_6 = new Repository_6($db, 'utilisateur', 'id', 'nom', 'prenom', 'email', 'telephone', 'idCompteUser') ;
        return $repository_6->findAll() ;
    }

    public function getUtilisateurById($db, $id){
        $repository_6 = new Repository_6($db, 'utilisateur', 'id', 'nom', 'prenom', 'email', 'telephone', 'idCompteUser') ;
        $this->setId($id) ;
        return $repository_6->findById('id', $this->getId()) ;
    }

    public function getUtilisateurByNom($db, $nom){
        $repository_6 = new Repository_6($db, 'utilisateur', 'id', 'nom', 'prenom', 'email', 'telephone', 'idCompteUser') ;
        $this->setNom($nom) ;
        return $repository_6->findByValue_1('', $this->getNom()) ;
    }

    public function getUtilisateurByPrenom($db, $prenom){
        $repository_6 = new Repository_6($db, 'utilisateur', 'id', 'nom', 'prenom', 'email', 'telephone', 'idCompteUser') ;
        $this->setPrenom($prenom) ;
        return $repository_6->findByValue_2('prenom', $this->getPrenom()) ;
    }

    public function getUtilisateurByEmail($db, $email){
        $repository_6 = new Repository_6($db, 'utilisateur', 'id', 'nom', 'prenom', 'email', 'telephone', 'idCompteUser') ;
        $this->setEmail($email) ;
        return $repository_6->findByValue_3('email', $this->getEmail()) ;
    }

    public function getUtilisateurByTel($db, $tel){
        $repository_6 = new Repository_6($db, 'utilisateur', 'id', 'nom', 'prenom', 'email', 'telephone', 'idCompteUser') ;
        $this->setTel($tel) ;
        return $repository_6->findByValue_4('telephone', $this->getTel()) ;
    }

    public function getUtilisateurByUser($db, $user){
        $repository_6 = new Repository_6($db, 'utilisateur', 'id', 'nom', 'prenom', 'email', 'telephone', 'idCompteUser') ;
        $this->setUser($user) ;
        return $repository_6->findByValue_5('idCompteUser', $this->getUser()) ;

    }

    public function getUtilisateurRowCounts($db){
        $repository_6 = new Repository_6($db, 'utilisateur', 'id', 'nom', 'prenom', 'email', 'telephone', 'idCompteUser') ;
        return $repository_6->counts() ;
    }

    public function saveUtilisateur($db, $nom, $prenom, $email, $tel, $user){
        $repository_6 = new Repository_6($db, 'utilisateur', 'id', 'nom', 'prenom', 'email', 'telephone', 'idCompteUser') ;
        $donnee = $this->getAllUtilisateur($db) ;

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
        $this->setNom($nom);  $this->setPrenom($prenom);  $this->setEmail($email) ;
        $this->setTel($tel);  $this->setUser($user) ;

        return $repository_6->save('id', 'nom', 'prenom', 'email', 'telephone', 'idCompteUser', $this->getId(), $this->getNom(),
            $this->getPrenom(), $this->getEmail(), $this->getTel(), $this->getUser()) ;
    }

    public function mergeUtilisateur($db, $id, $nom, $prenom, $email, $tel, $user){
        $repository_6 = new Repository_6($db, 'utilisateur', 'id', 'nom', 'prenom', 'email', 'telephone', 'idCompteUser') ;

        $this->setNom($nom);  $this->setPrenom($prenom);  $this->setEmail($email) ;
        $this->setTel($tel);  $this->setUser($user);  $this->setId($id) ;

        return $repository_6->merge('id', 'nom', 'prenom', 'email', 'telephone', 'idCompteUser', $this->getId(), $this->getNom(),
            $this->getPrenom(), $this->getEmail(), $this->getTel(), $this->getUser()) ;
    }

    public function removeUtilisateur($db, $id){
        $repository_6 = new Repository_6($db, 'utilisateur', 'id', 'nom', 'prenom', 'email', 'telephone', 'idCompteUser') ;
        $this->setId($id) ;
        return $repository_6->remove('', $this->getId()) ;
    }

    public function removeUtilisateurThroughNom($db, $nom){
        $repository_6 = new Repository_6($db, 'utilisateur', 'id', 'nom', 'prenom', 'email', 'telephone', 'idCompteUser') ;
        $this->setNom($nom) ;
        return $repository_6->remove_1('nom', $this->getNom()) ;
    }

    public function removeUtilisateurThroughPrenom($db, $prenom){
        $repository_6 = new Repository_6($db, 'utilisateur', 'id', 'nom', 'prenom', 'email', 'telephone', 'idCompteUser') ;
        $this->setPrenom($prenom) ;
        return $repository_6->remove_2('prenom', $this->getPrenom()) ;
    }

    public function removeUtilisateurThroughEmail($db, $email){
        $repository_6 = new Repository_6($db, 'utilisateur', 'id', 'nom', 'prenom', 'email', 'telephone', 'idCompteUser') ;
        $this->setEmail($email) ;
        return $repository_6->remove_3('email', $this->getEmail()) ;
    }

    public function removeUtilisateurThroughTel($db, $tel){
        $repository_6 = new Repository_6($db, 'utilisateur', 'id', 'nom', 'prenom', 'email', 'telephone', 'idCompteUser') ;
        $this->setTel($tel) ;
        return $repository_6->remove_4('telephone', $this->getTel()) ;
    }

    public function removeUtilisateurThroughUser($db, $user){
        $repository_6 = new Repository_6($db, 'utilisateur', 'id', 'nom', 'prenom', 'email', 'telephone', 'idCompteUser') ;
        $this->setUser($user) ;
        return $repository_6->remove_5('idCompteUser', $this->getUser()) ;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public function getTel()
    {
        return $this->tel;
    }

    public function setTel($tel)
    {
        $this->tel = $tel;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }
} 