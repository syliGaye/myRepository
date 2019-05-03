<?php

/**
 * classe d'une table à quatre (2) tuples
 */
class Repository_2
{
    /*
    * les requêtes péparées
    */
    private $inserer ;
    private $selectAll ;
    private $supprimer;
    private $selectById ;
    private $modifier ;
    private $nombre ;
    private $selectByValue1;

    public function __construct($bdd, $table, $var1, $var2)
    {
        $this->inserer = $bdd->prepare('INSERT INTO '.$table.'('.$var1.', '.$var2.') VALUES (:'.$var1.', :'.$var2.')') ;
        $this->selectAll = $bdd->prepare('SELECT '.$var1.', '.$var2.' FROM '.$table.' ORDER BY '.$var1) ;
        $this->modifier = $bdd->prepare('UPDATE '.$table.' SET '.$var1.' = :'.$var1.', '.$var2.' = :'.$var2.' WHERE '.$var1.' = :'.$var1) ;
        $this->nombre = $bdd->prepare('SELECT COUNT(*) AS nbre FROM '.$table) ;
        $this->supprimer = $bdd->prepare('DELETE FROM '.$table.' WHERE '.$var1.' = :'.$var1.'');
        $this->selectById = $bdd->prepare('SELECT '.$var1.', '.$var2.' FROM '.$table.' WHERE '.$var1.' = :'.$var1) ;
        $this->selectByValue1 = $bdd->prepare('SELECT '.$var1.', '.$var2.' FROM '.$table.' WHERE '.$var2.' = :'.$var2.'') ;
    }

    public function save($var1, $var2, $val1, $val2){
        $this->inserer->execute(array($var1 => $val1,
            $var2 => $val2)) ;
        return $this->inserer->rowCount() ;
    }

    public function merge($var1, $var2, $val1, $val2){
        $this->modifier->execute(array($var1 => $val1,
            $var2 => $val2
        )) ;
        return $this->modifier->rowCount() ;
    }

    public function remove($var1, $val1){
        $this->supprimer->execute(array($var1 => $val1));
        return $this->supprimer->rowCount();
    }

    public function counts(){
        $this->nombre->execute() ;
        $resultat = $this->nombre->fetch() ;
        $nombre = $resultat['nbre'] ;
        return $nombre ;
    }

    public function findAll(){
        $this->selectAll->execute() ;
        return $this->selectAll->fetchAll() ;
    }

    public function findById($var1, $val1){
        $this->selectById->execute(array($var1 => $val1)) ;
        return $this->selectById->fetch() ;
    }

    public function findByValue_1($var2, $val2){
        $this->selectByValue1->execute(array($var2 => $val2));
        return $this->selectByValue1->fetchAll();
    }
}


