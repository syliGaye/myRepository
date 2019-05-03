<?php

class Reponse {
    private $id;
    private $sujet;
    private $message;
    private $date;
    private $commentaire;
    private $utilisateur;

    function __construct()
    {
        $this->commentaire = null;
        $this->date = null;
        $this->id = null;
        $this->message = null;
        $this->sujet = null;
        $this->utilisateur = null;
    }

    /**
     * @return mixed
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * @param mixed $commentaire
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
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
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getSujet()
    {
        return $this->sujet;
    }

    /**
     * @param mixed $sujet
     */
    public function setSujet($sujet)
    {
        $this->sujet = $sujet;
    }

    /**
     * @return null
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * @param null $utilisateur
     */
    public function setUtilisateur($utilisateur)
    {
        $this->utilisateur = $utilisateur;
    }
} 