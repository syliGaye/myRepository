<?php
require_once '../dao/Repository_6.php';
require_once '../model/Article.php' ;
require_once '../configuration/MyPDO.php';

class ArticleService {
    private $repository;
    private $article;
    private $list;

    function __construct($db)
    {
        $this->repository = new Repository_6($db, 'article', 'codarticle', 'datemodif', 'datepublication', 'libelle', 'titre', 'codebloggeur');
    }

    public function findAllArticle(){
        $this->list = array();
        foreach($this->repository->findAll() as $value){
            $this->article = new Article();
            $this->article->setId($value['codarticle']);
            $this->article->setDateModification($value['datemodif']);
            $this->article->setBloggueur($value['codebloggeur']);
            $this->article->setTitre($value['titre']);
            $this->article->setDatePub($value['datepublication']);
            $this->article->setLibelle($value['libelle']);
            array_push($this->list, $this->article);
        }

        return $this->list;
    }

    public function findAllArticleByBloggueur($bloggueur){
        $this->list = array();
        foreach($this->repository->findByValue_5('codebloggeur', $bloggueur) as $value){
            $this->article = new Article();
            $this->article->setId($value['codarticle']);
            $this->article->setDateModification($value['datemodif']);
            $this->article->setBloggueur($value['codebloggeur']);
            $this->article->setTitre($value['titre']);
            $this->article->setDatePub($value['datepublication']);
            $this->article->setLibelle($value['libelle']);
            array_push($this->list, $this->article);
        }
        return $this->list;
    }

    public function findOneArticle($id){
        $this->article = new Article();
        foreach($this->repository->findById('codarticle', $id) as $value){
            $this->article->setId($value['codarticle']);
            $this->article->setDateModification($value['datemodif']);
            $this->article->setBloggueur($value['codebloggeur']);
            $this->article->setTitre($value['titre']);
            $this->article->setDatePub($value['datepublication']);
            $this->article->setLibelle($value['libelle']);
        }
        return $this->article;
    }

    public function findOneArticleByTitre($titre){
        $this->article = new Article();
        foreach($this->repository->findByValue_4('titre', $titre) as $value){
            $this->article->setId($value['codarticle']);
            $this->article->setDateModification($value['datemodif']);
            $this->article->setBloggueur($value['codebloggeur']);
            $this->article->setTitre($value['titre']);
            $this->article->setDatePub($value['datepublication']);
            $this->article->setLibelle($value['libelle']);
        }
        return $this->article;
    }

    public function countArticle(){
        return $this->repository->counts();
    }

    public function countArticleByBloggueur($bloggueur){
        return $this->repository->counts_5('codebloggeur', $bloggueur);
    }

    public function saveArticle($art){
        $this->article = new Article();
        $this->article = $art;
        $id = retourneId('art', ($this->countArticle())+1);
        $this->repository->save('codarticle', 'datemodif', 'datepublication', 'libelle', 'titre', 'codebloggeur',
            $id, $this->article->getDateModification(), $this->article->getDatePub(),
            $this->article->getLibelle(), $this->article->getTitre(), $this->article->getBloggueur());
    }

    public function mergeArticle($art){
        $this->article = new Article();
        $this->article = $art;
        $this->repository->merge('codarticle', 'datemodif', 'datepublication', 'libelle', 'titre', 'codebloggeur',
            $this->article->getId(), $this->article->getDateModification(), $this->article->getDatePub(),
            $this->article->getLibelle(), $this->article->getTitre(), $this->article->getBloggueur());
    }

    public function deleteArticle($id){
        $this->article->setId($id);
        $this->repository->remove('codarticle', $this->article->getId());
    }

    public function retourArticle($id, $arrayBloggueur){
        $this->article = new Article();
        $this->article = $this->findOneArticle($id);
        return array('id' => $this->article->getId(),
            'titre' => $this->article->getTitre(),
            'libelle' => $this->article->getLibelle(),
            'datePub' => $this->article->getDatePub(),
            'dateModif' => $this->article->getDateModification(),
            'bloggeur' => $arrayBloggueur
        );
    }
} 