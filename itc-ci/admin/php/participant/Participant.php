<?php
require_once '../repositories/Repository_6.php';

class Participant {
    private $id ;
    private $nom ;
    private $prenoms ;
    private $contact ;
    private $email ;
    private $idSession;

    function __construct(){
        $this->contact = null;
        $this->email = null;
        $this->id = null;
        $this->nom = null;
        $this->prenoms = null;
        $this->idSession = null;
    }

    public function getAllParticipant($db){
        $repository_6 = new Repository_6($db, 'participant', 'id', 'nom', 'prenoms', 'email', 'telepnone', 'idSession');
        return $repository_6->findAll();
    }

    public function getParticipantById($db, $id){
        $repository_6 = new Repository_6($db, 'participant', 'id', 'nom', 'prenoms', 'email', 'telepnone', 'idSession');
        $this->setId($id);
        return $repository_6->findById('id', $this->getId());
    }

    public function getParticipantByEmail($db, $email){
        $repository_6 = new Repository_6($db, 'participant', 'id', 'nom', 'prenoms', 'email', 'telepnone', 'idSession');
        $this->setEmail($email);
        return $repository_6->findByValue_3('email', $this->getEmail());
    }

    public function getParticipantBySession($db, $idSession){
        $repository_6 = new Repository_6($db, 'participant', 'id', 'nom', 'prenoms', 'email', 'telepnone', 'idSession');
        $this->setIdSession($idSession);
        return $repository_6->findByValue_5('idSession', $this->getIdSession());
    }

    public function getParticipantRowCount($db){
        $repository_6 = new Repository_6($db, 'participant', 'id', 'nom', 'prenoms', 'email', 'telepnone', 'idSession');
        return $repository_6->counts();
    }

    public function saveParticipant($db, $nom, $prenoms, $email, $telepnone, $idSession){
        $repository_6 = new Repository_6($db, 'participant', 'id', 'nom', 'prenoms', 'email', 'telepnone', 'idSession');
        $donnee = $this->getAllParticipant($db);
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

        $this->setNom($nom);  $this->setPrenoms($prenoms);  $this->setEmail($email);
        $this->setContact($telepnone);  $this->setIdSession($idSession);

        return $repository_6->save('id', 'nom', 'prenoms', 'email', 'telepnone', 'idSession',
            $this->getId(), $this->getNom(), $this->getPrenoms(), $this->getEmail(), $this->getContact(), $this->getIdSession());
    }

    public function mergeParticipant($db, $id, $nom, $prenoms, $email, $telepnone, $idSession){
        $repository_6 = new Repository_6($db, 'participant', 'id', 'nom', 'prenoms', 'email', 'telepnone', 'idSession');
        $this->setNom($nom);  $this->setPrenoms($prenoms);  $this->setEmail($email);  $this->setId($id);
        $this->setContact($telepnone);  $this->setIdSession($idSession);

        return $repository_6->merge('id', 'nom', 'prenoms', 'email', 'telephone', 'idSession',
            $this->getId(), $this->getNom(), $this->getPrenoms(), $this->getEmail(), $this->getContact(), $this->getIdSession());
    }

    public function removeParticipant($db, $id){
        $repository_6 = new Repository_6($db, 'participant', 'id', 'nom', 'prenoms', 'email', 'telepnone', 'idSession');
        $this->setId($id);
        return $repository_6->remove('id', $this->getId());
    }

    public function removeParticipantThroughEmail($db, $email){
        $repository_6 = new Repository_6($db, 'participant', 'id', 'nom', 'prenoms', 'email', 'telepnone', 'idSession');
        $this->setEmail($email);
        return $repository_6->remove_4('email', $this->getEmail());
    }

    public function removeParticipantThroughSession($db, $idSession){
        $repository_6 = new Repository_6($db, 'participant', 'id', 'nom', 'prenoms', 'email', 'telepnone', 'idSession');
        $this->setIdSession($idSession);
        return $repository_6->remove_5('idSession', $this->getIdSession());
    }

    public function getContact()
    {
        return $this->contact;
    }

    public function setContact($contact)
    {
        $this->contact = $contact;
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

    public function getPrenoms()
    {
        return $this->prenoms;
    }

    public function setPrenoms($prenoms)
    {
        $this->prenoms = $prenoms;
    }

    public function getIdSession()
    {
        return $this->idSession;
    }


    public function setIdSession($idSession)
    {
        $this->idSession = $idSession;
    }
} 