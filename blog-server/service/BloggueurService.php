<?php
require_once '../dao/Repository_4.php';
require_once '../model/Bloggueur.php' ;
require_once '../configuration/MyPDO.php';

class BloggueurService {
    private $repository;
    private $bloggueur;
    private $list;

    function __construct($db)
    {
        $this->repository = new Repository_4($db, 'bloggeur', 'codebloggeur', 'nom', 'prenoms', 'idutilisateur');
    }

    public function findAllBloggueur(){
        $this->list = array();
        foreach($this->repository->findAll() as $value){
            $this->bloggueur = new Bloggueur();
            $this->bloggueur->setId($value['codebloggeur']);
            $this->bloggueur->setNom($value['nom']);
            $this->bloggueur->setPrenoms($value['prenoms']);
            $this->bloggueur->setUtilisateur($value['idutilisateur']);
            array_push($this->list, $this->bloggueur);
        }

        return $this->list;
    }

    public function findOneBloggueur($id){
        $this->bloggueur = new Bloggueur();
        foreach($this->repository->findById('codebloggeur', $id) as $value){
            $this->bloggueur->setId($value['codebloggeur']);
            $this->bloggueur->setNom($value['nom']);
            $this->bloggueur->setPrenoms($value['prenoms']);
            $this->bloggueur->setUtilisateur($value['idutilisateur']);
        }
        return $this->bloggueur;
    }

    public function findOneBloggueurByUtilisateur($utilisateur){
        $this->bloggueur = new Bloggueur();
        foreach($this->repository->findByValue_3('idutilisateur', $utilisateur) as $value){
            $this->bloggueur->setId($value['codebloggeur']);
            $this->bloggueur->setNom($value['nom']);
            $this->bloggueur->setPrenoms($value['prenoms']);
            $this->bloggueur->setUtilisateur($value['idutilisateur']);
        }
        return $this->bloggueur;
    }

    public function countBloggueur(){
        return $this->repository->counts();
    }

    public function saveBloggueur($blog){
        $this->bloggueur = new Bloggueur();
        $this->bloggueur = $blog;
        $id = retourneId('blg', ($this->countBloggueur())+1);
        $this->repository->save('codebloggeur', 'nom', 'prenoms', 'idutilisateur',
            $id, $this->bloggueur->getNom(), $this->bloggueur->getPrenoms(), $this->bloggueur->getUtilisateur());
    }

    public function mergebloggueur($art){
        $this->bloggueur = new Bloggueur();
        $this->bloggueur = $art;
        $this->repository->merge('codebloggeur', 'nom', 'prenoms', 'idutilisateur',
            $this->bloggueur->getId(), $this->bloggueur->getNom(), $this->bloggueur->getPrenoms(), $this->bloggueur->getUtilisateur());
    }

    public function deletebloggueur($id){
        $this->bloggueur->setId($id);
        $this->repository->remove('codebloggeur', $this->bloggueur->getId());
    }

    public function retourBloggueur($id, $arrayUtilisateur){
        $this->bloggueur = new Bloggueur();
        $this->bloggueur = $this->findOneBloggueur($id);
        return array('id' => $this->bloggueur->getId(),
            'nom' => $this->bloggueur->getNom(),
            'prenoms' => $this->bloggueur->getPrenoms(),
            'utilisateur' => $arrayUtilisateur
        );
    }
} 