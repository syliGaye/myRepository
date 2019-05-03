<?php
require_once '../dao/Repository_5.php';
require_once '../model/Utilisateur.php' ;
require_once '../configuration/MyPDO.php';

class UtilisateurService {
    private $repository;
    private $utilisateur;
    private $list;

    function __construct($db)
    {
        $this->repository = new Repository_5($db, 'utilisateur', 'idutilisateur', 'datecreation', 'mail', 'pseudo', 'statut');
    }

    public function findAllUtilisateur(){
        $this->list = array();
        foreach($this->repository->findAll() as $value){
            $this->utilisateur = new Utilisateur();
            $this->utilisateur->setId($value['idutilisateur']);
            $this->utilisateur->setDate($value['datecreation']);
            $this->utilisateur->setMail($value['mail']);
            $this->utilisateur->setPseudo($value['pseudo']);
            $this->utilisateur->setStatut($value['statut']);
            array_push($this->list, $this->utilisateur);
        }

        return $this->list;
    }

    public function findOneUtilisateur($id){
        $this->utilisateur = new Utilisateur();
        foreach($this->repository->findById('idutilisateur', $id) as $value){
            $this->utilisateur->setId($value['idutilisateur']);
            $this->utilisateur->setDate($value['datecreation']);
            $this->utilisateur->setMail($value['mail']);
            $this->utilisateur->setPseudo($value['pseudo']);
            $this->utilisateur->setStatut($value['statut']);
        }
        return $this->utilisateur;
    }

    public function findOneUtilisateurByPseudo($pseudo){
        $this->utilisateur = new Utilisateur();
        foreach($this->repository->findByValue_3('pseudo', $pseudo) as $value){
            $this->utilisateur->setId($value['idutilisateur']);
            $this->utilisateur->setDate($value['datecreation']);
            $this->utilisateur->setMail($value['mail']);
            $this->utilisateur->setPseudo($value['pseudo']);
            $this->utilisateur->setStatut($value['statut']);
        }
        return $this->utilisateur;
    }

    public function findOneUtilisateurByEmail($mail){
        $this->utilisateur = new Utilisateur();
        foreach($this->repository->findByValue_2('mail', $mail) as $value){
            $this->utilisateur->setId($value['idutilisateur']);
            $this->utilisateur->setDate($value['datecreation']);
            $this->utilisateur->setMail($value['mail']);
            $this->utilisateur->setPseudo($value['pseudo']);
            $this->utilisateur->setStatut($value['statut']);
        }
        return $this->utilisateur;
    }

    public function findAllUtilisateurByStatut($statut){
        $this->list = array();
        foreach($this->repository->findByValue_4('statut', $statut) as $value){
            $this->utilisateur = new Utilisateur();
            $this->utilisateur->setId($value['idutilisateur']);
            $this->utilisateur->setDate($value['datecreation']);
            $this->utilisateur->setMail($value['mail']);
            $this->utilisateur->setPseudo($value['pseudo']);
            $this->utilisateur->setStatut($value['statut']);
            array_push($this->list, $this->utilisateur);
        }
        return $this->list;
    }

    public function countUtilisateur(){
        return $this->repository->counts();
    }

    public function countUtilisateurByStatut($statut){
        return $this->repository->counts_3('statut', $statut);
    }

    public function saveUtilisateur($user){
        $this->utilisateur = new Utilisateur();
        $this->utilisateur = $user;
        $this->utilisateur->setId(retourneId('user', ($this->countUtilisateur())+1));
        $this->repository->save('idutilisateur', 'datecreation', 'mail', 'pseudo', 'statut',
            $this->utilisateur->getId(), $this->utilisateur->getDate(), $this->utilisateur->getMail(), $this->utilisateur->getPseudo(), $this->utilisateur->getStatut());
        return $this->utilisateur->getId();
    }

    public function mergeUtilisateur($user){
        $this->utilisateur = new Utilisateur();
        $this->utilisateur = $user;
        $this->repository->merge('idutilisateur', 'datecreation', 'mail', 'pseudo', 'statut',
            $this->utilisateur->getId(), $this->utilisateur->getDate(), $this->utilisateur->getMail(), $this->utilisateur->getPseudo(), $this->utilisateur->getStatut());
    }

    public function deleteUtilisateur($id){
        $this->utilisateur->setId($id);
        $this->repository->remove('idutilisateur', $this->utilisateur->getId());
    }

    public function retourUtilisateur($id){
        $this->utilisateur = new Utilisateur();
        $this->utilisateur = $this->findOneUtilisateur($id);
        return array(
            'id' => $this->utilisateur->getId(),
            'pseudo' => $this->utilisateur->getPseudo(),
            'mail' => $this->utilisateur->getMail(),
            'date' => $this->utilisateur->getDate(),
            'statut' => $this->utilisateur->getStatut()
        );
    }
} 