<?php

class AjaxResponse {
    private $message;
    private $objet;
    private $liste;

    function __construct()
    {
        $this->liste = array();
        $this->message = "ok";
        $this->objet = null;
    }

    /**
     * @return mixed
     */
    public function getListe()
    {
        return $this->liste;
    }

    /**
     * @param mixed $liste
     */
    public function setListe($liste)
    {
        $this->liste = $liste;
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
    public function getObjet()
    {
        return $this->objet;
    }

    /**
     * @param mixed $objet
     */
    public function setObjet($objet)
    {
        $this->objet = $objet;
    }
} 