<?php

class Bloggueur {
    private $id;
    private $nom;
    private $prenoms;
    private $utilisateur;

    function __construct()
    {
        $this->id = null;
        $this->nom = null;
        $this->prenoms = null;
        $this->utilisateur = null;
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
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenoms()
    {
        return $this->prenoms;
    }

    /**
     * @param mixed $prenoms
     */
    public function setPrenoms($prenoms)
    {
        $this->prenoms = $prenoms;
    }

    /**
     * @return mixed
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * @param mixed $utilisateur
     */
    public function setUtilisateur($utilisateur)
    {
        $this->utilisateur = $utilisateur;
    }
} 