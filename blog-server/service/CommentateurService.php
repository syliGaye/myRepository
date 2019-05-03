<?php
require_once '../dao/Repository_2.php';
require_once '../model/Commentateur.php' ;
require_once '../configuration/MyPDO.php';

class CommentateurService {
    private $repository;
    private $commentateur;
    private $list;

    function __construct($db)
    {
        $this->repository = new Repository_2($db, 'commentateur', 'idcommentateur', 'idutilisateur');
    }

    public function findAllCommentateur(){
        $this->list = array();
        foreach($this->repository->findAll() as $value){
            $this->commentateur = new Commentateur();
            $this->commentateur->setId($value['idcommentateur']);
            $this->commentateur->setUtilisateur($value['idutilisateur']);
            array_push($this->list, $this->commentateur);
        }

        return $this->list;
    }

    public function findOneCommentateur($id){
        $this->commentateur = new Commentateur();
        foreach($this->repository->findById('idcommentateur', $id) as $value){
            $this->commentateur->setId($value['idcommentateur']);
            $this->commentateur->setUtilisateur($value['idutilisateur']);
        }
        return $this->commentateur;
    }

    public function findOneCommentateurByUtilisateur($utilisateur){
        $this->commentateur = new Commentateur();
        foreach($this->repository->findByValue_1('idutilisateur', $utilisateur) as $value){
            $this->commentateur->setId($value['idcommentateur']);
            $this->commentateur->setUtilisateur($value['idutilisateur']);
        }
        return $this->commentateur;
    }

    public function countcommentateur(){
        return $this->repository->counts();
    }

    public function savecommentateur($art){
        $this->commentateur = new Commentateur();
        $this->commentateur = $art;
        $id = retourneId('cmtat', ($this->countcommentateur())+1);
        $this->repository->save('idcommentateur', 'idutilisateur',
            $id, $this->commentateur->getUtilisateur());
    }

    public function mergecommentateur($art){
        $this->commentateur = new Commentateur();
        $this->commentateur = $art;
        $this->repository->merge('idcommentateur', 'idutilisateur',
            $this->commentateur->getId(), $this->commentateur->getUtilisateur());
    }

    public function deletecommentateur($id){
        $this->commentateur->setId($id);
        $this->repository->remove('idcommentateur', $this->commentateur->getId());
    }

    public function retourCommentaire($id, $utilisateurArray){
        $this->commentateur = new Commentateur();
        $this->commentateur = $this->findOneCommentateur($id);
        return array('id' => $this->commentateur->getId(),
            'utilisateur' => $utilisateurArray
        );
    }
} 