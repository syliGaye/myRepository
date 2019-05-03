<?php
require_once '../dao/Repository_6.php';
require_once '../model/Reponse.php' ;
require_once '../configuration/MyPDO.php';

class ReponseService {
    private $repository;
    private $reponse;
    private $list;

    function __construct($db)
    {
        $this->repository = new Repository_6($db, 'reponse', 'idreponse', 'datereply', 'msgreply', 'sujet', 'codecomment', 'idutilisateur');
    }

    public function findAllReponse(){
        $this->list = array();
        foreach($this->repository->findAll() as $value){
            $this->reponse = new Reponse();
            $this->reponse->setId($value['idreponse']);
            $this->reponse->setDate($value['datereply']);
            $this->reponse->setMessage($value['msgreply']);
            $this->reponse->setSujet($value['sujet']);
            $this->reponse->setCommentaire($value['codecomment']);
            $this->reponse->setUtilisateur($value['idutilisateur']);
            array_push($this->list, $this->reponse);
        }

        return $this->list;
    }

    public function findAllReponseByCommentaire($commentaire){
        $this->list = array();
        foreach($this->repository->findByValue_4('codecomment', $commentaire) as $value){
            $this->reponse = new Reponse();
            $this->reponse->setId($value['idreponse']);
            $this->reponse->setDate($value['datereply']);
            $this->reponse->setMessage($value['msgreply']);
            $this->reponse->setSujet($value['sujet']);
            $this->reponse->setCommentaire($value['codecomment']);
            $this->reponse->setUtilisateur($value['idutilisateur']);
            array_push($this->list, $this->reponse);
        }
        return $this->list;
    }

    public function findAllReponseByUtilisateur($utilisateur){
        $this->list = array();
        foreach($this->repository->findByValue_5('idutilisateur', $utilisateur) as $value){
            $this->reponse = new Reponse();
            $this->reponse->setId($value['idreponse']);
            $this->reponse->setDate($value['datereply']);
            $this->reponse->setMessage($value['msgreply']);
            $this->reponse->setSujet($value['sujet']);
            $this->reponse->setCommentaire($value['codecomment']);
            $this->reponse->setUtilisateur($value['idutilisateur']);
            array_push($this->list, $this->reponse);
        }
        return $this->list;
    }

    public function findOneReponse($id){
        $this->reponse = new Reponse();
        foreach($this->repository->findById('idreponse', $id) as $value){
            $this->reponse->setId($value['idreponse']);
            $this->reponse->setDate($value['datereply']);
            $this->reponse->setMessage($value['msgreply']);
            $this->reponse->setSujet($value['sujet']);
            $this->reponse->setCommentaire($value['codecomment']);
            $this->reponse->setUtilisateur($value['idutilisateur']);
        }
        return $this->reponse;
    }

    public function countReponse(){
        return $this->repository->counts();
    }

    public function countReponseByCommentaire($commentaire){
        return $this->repository->counts_4('codecomment', $commentaire);
    }

    public function countReponseByUtilisateur($utilisateur){
        return $this->repository->counts_5('idutilisateur', $utilisateur);
    }

    public function saveReponse($response){
        $this->reponse = new Reponse();
        $this->reponse = $response;
        $id = retourneId('resp', ($this->countReponse())+1);
        $this->repository->save('idreponse', 'datereply', 'msgreply', 'sujet', 'codecomment', 'idutilisateur',
            $id, $this->reponse->getDate(), $this->reponse->getMessage(),
            $this->reponse->getSujet(), $this->reponse->getCommentaire(), $this->reponse->getUtilisateur());
    }

    public function mergeReponse($response){
        $this->reponse = new Reponse();
        $this->reponse = $response;
        $this->repository->merge('idreponse', 'datereply', 'msgreply', 'sujet', 'codecomment', 'idutilisateur',
            $this->reponse->getId(), $this->reponse->getDate(), $this->reponse->getMessage(),
            $this->reponse->getSujet(), $this->reponse->getCommentaire(), $this->reponse->getUtilisateur());
    }

    public function deleteReponse($id){
        $this->reponse->setId($id);
        $this->repository->remove('idreponse', $this->reponse->getId());
    }

    public function retourReponse($id, $commentaireArray, $utilisateurArray){
        $this->reponse = new Reponse();
        $this->reponse = $this->findOneReponse($id);
        return array('id' => $this->reponse->getId(),
            'sujet' => $this->reponse->getSujet(),
            'date' => $this->reponse->getDate(),
            'message' => $this->reponse->getMessage(),
            'article' => $commentaireArray,
            'utilisateur' => $utilisateurArray
        );
    }
} 