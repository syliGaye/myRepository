<?php

class Article {
    private $id;
    private $titre;
    private $libelle;
    private $datePub;
    private $dateModification;
    private $bloggueur;

    function __construct()
    {
        $this->bloggueur = null;
        $this->dateModification = null;
        $this->datePub = null;
        $this->id = null;
        $this->libelle = null;
        $this->titre = null;
    }

    /**
     * @return mixed
     */
    public function getBloggueur()
    {
        return $this->bloggueur;
    }

    /**
     * @param mixed $bloggueur
     */
    public function setBloggueur($bloggueur)
    {
        $this->bloggueur = $bloggueur;
    }

    /**
     * @return mixed
     */
    public function getDateModification()
    {
        return $this->dateModification;
    }

    /**
     * @param mixed $dateModification
     */
    public function setDateModification($dateModification)
    {
        $this->dateModification = $dateModification;
    }

    /**
     * @return mixed
     */
    public function getDatePub()
    {
        return $this->datePub;
    }

    /**
     * @param mixed $datePub
     */
    public function setDatePub($datePub)
    {
        $this->datePub = $datePub;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param mixed $libelle
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    }

    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

} 