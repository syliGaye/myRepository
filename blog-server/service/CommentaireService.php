<?php
require_once '../dao/Repository_6.php';
require_once '../model/Commentaire.php' ;
require_once '../configuration/MyPDO.php';

class CommentaireService {
    private $repository;
    private $commentaire;
    private $list;

    function __construct($db)
    {
        $this->repository = new Repository_6($db, 'commentaire', 'codecomment', 'datecomment', 'message', 'sujet', 'codarticle', 'idutilisateur');
    }

    public function findAllCommentaire(){
        $this->list = array();
        foreach($this->repository->findAll() as $value){
            $this->commentaire = new commentaire();
            $this->commentaire->setId($value['codecomment']);
            $this->commentaire->setDate($value['datecomment']);
            $this->commentaire->setMessage($value['message']);
            $this->commentaire->setSujet($value['sujet']);
            $this->commentaire->setArticle($value['codarticle']);
            $this->commentaire->setUtilisateur($value['idutilisateur']);
            array_push($this->list, $this->commentaire);
        }

        return $this->list;
    }

    public function findAllCommentaireByArticle($article){
        $this->list = array();
        foreach($this->repository->findByValue_4('codarticle', $article) as $value){
            $this->commentaire = new commentaire();
            $this->commentaire->setId($value['codecomment']);
            $this->commentaire->setDate($value['datecomment']);
            $this->commentaire->setMessage($value['message']);
            $this->commentaire->setSujet($value['sujet']);
            $this->commentaire->setArticle($value['codarticle']);
            $this->commentaire->setUtilisateur($value['idutilisateur']);
            array_push($this->list, $this->commentaire);
        }
        return $this->list;
    }

    public function findAllCommentaireByUtilisateur($utilisateur){
        $this->list = array();
        foreach($this->repository->findByValue_5('idutilisateur', $utilisateur) as $value){
            $this->commentaire = new commentaire();
            $this->commentaire->setId($value['codecomment']);
            $this->commentaire->setDate($value['datecomment']);
            $this->commentaire->setMessage($value['message']);
            $this->commentaire->setSujet($value['sujet']);
            $this->commentaire->setArticle($value['codarticle']);
            $this->commentaire->setUtilisateur($value['idutilisateur']);
            array_push($this->list, $this->commentaire);
        }
        return $this->list;
    }

    public function findOneCommentaire($id){
        $this->commentaire = new Commentaire();
        foreach($this->repository->findById('codecomment', $id) as $value){
            $this->commentaire->setId($value['codecomment']);
            $this->commentaire->setDate($value['datecomment']);
            $this->commentaire->setMessage($value['message']);
            $this->commentaire->setSujet($value['sujet']);
            $this->commentaire->setArticle($value['codarticle']);
            $this->commentaire->setUtilisateur($value['idutilisateur']);
        }
        return $this->commentaire;
    }

    public function countCommentaire(){
        return $this->repository->counts();
    }

    public function countCommentaireByArticle($article){
        return $this->repository->counts_4('codarticle', $article);
    }

    public function countCommentaireByUtilisateur($utlisateur){
        return $this->repository->counts_5('idutilisateur', $utlisateur);
    }

    public function saveCommentaire($comment){
        $this->commentaire = new Commentaire();
        $this->commentaire = $comment;
        $id = retourneId('coment', ($this->countCommentaire())+1);
        $this->repository->save('codecomment', 'datecomment', 'message', 'sujet', 'codarticle', 'idutilisateur',
            $id, $this->commentaire->getDate(), $this->commentaire->getMessage(),
            $this->commentaire->getSujet(), $this->commentaire->getArticle(), $this->commentaire->getUtilisateur());
    }

    public function mergeCommentaire($comment){
        $this->commentaire = new Commentaire();
        $this->commentaire = $comment;
        $this->repository->merge('codecomment', 'datecomment', 'message', 'sujet', 'codarticle', 'idutilisateur',
            $this->commentaire->getId(), $this->commentaire->getDate(), $this->commentaire->getMessage(),
            $this->commentaire->getSujet(), $this->commentaire->getArticle(), $this->commentaire->getUtilisateur());
    }

    public function deleteCommentaire($id){
        $this->commentaire->setId($id);
        $this->repository->remove('codecomment', $this->commentaire->getId());
    }

    public function retourCommentaire($id, $articleArray, $utilisateurArray){
        $this->commentaire = new Commentaire();
        $this->commentaire = $this->findOneCommentaire($id);
        return array('id' => $this->commentaire->getId(),
            'sujet' => $this->commentaire->getSujet(),
            'date' => $this->commentaire->getDate(),
            'message' => $this->commentaire->getMessage(),
            'article' => $articleArray,
            'utilisateur' => $utilisateurArray
        );
    }
} 