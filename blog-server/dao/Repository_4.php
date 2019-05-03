<?php

/**
 * classe d'une table à quatre (4) tuples
 */
class Repository_4
{
    /*
    * les requêtes péparées
    */
    private $inserer ;
    private $selectAll ;
    private $selectById ;
    private $selectByValue1 ;
    private $selectByValue2 ;
    private $selectByValue3 ;
    private $supprimer;
    private $modifier ;
    private $nombre ;
    private $nombre_1 ;
    private $nombre_2 ;
    private $nombre_3 ;

    public function __construct($bdd, $table, $var1, $var2, $var3, $var4)
    {
        $this->inserer = $bdd->prepare('INSERT INTO '.$table.'('.$var1.', '.$var2.', '.$var3.', '.$var4.') VALUES (:'.$var1.', :'.$var2.', :'.$var3.', :'.$var4.')') ;
        $this->selectAll = $bdd->prepare('SELECT DISTINCT '.$var1.', '.$var2.', '.$var3.', '.$var4.' FROM '.$table.' ORDER BY '.$var1) ;
        $this->modifier = $bdd->prepare('UPDATE '.$table.' SET '.$var1.' = :'.$var1.', '.$var2.' = :'.$var2.', '.$var3.' = :'.$var3.', '.$var4.' = :'.$var4.' WHERE '.$var1.' = :'.$var1) ;
        $this->nombre = $bdd->prepare('SELECT COUNT(*) AS nbre FROM '.$table) ;
        $this->nombre_1 = $bdd->prepare('SELECT COUNT(*) AS nbre FROM '.$table.' WHERE '.$var2.' = :'.$var2.'') ;
        $this->nombre_2 = $bdd->prepare('SELECT COUNT(*) AS nbre FROM '.$table.' WHERE '.$var3.' = :'.$var3.'') ;
        $this->nombre_3 = $bdd->prepare('SELECT COUNT(*) AS nbre FROM '.$table.' WHERE '.$var4.' = :'.$var4.'') ;
        $this->supprimer = $bdd->prepare('DELETE FROM '.$table.' WHERE '.$var1.' = :'.$var1.'');
        $this->selectById = $bdd->prepare('SELECT DISTINCT '.$var1.', '.$var2.', '.$var3.', '.$var4.' FROM '.$table.' WHERE '.$var1.' = :'.$var1.' ORDER BY '.$var1) ;
        $this->selectByValue1 = $bdd->prepare('SELECT DISTINCT '.$var1.', '.$var2.', '.$var3.', '.$var4.' FROM '.$table.' WHERE '.$var2.' = :'.$var2.'') ;
        $this->selectByValue2 = $bdd->prepare('SELECT DISTINCT '.$var1.', '.$var2.', '.$var3.', '.$var4.' FROM '.$table.' WHERE '.$var3.' = :'.$var3.'') ;
        $this->selectByValue3 = $bdd->prepare('SELECT DISTINCT '.$var1.', '.$var2.', '.$var3.', '.$var4.' FROM '.$table.' WHERE '.$var4.' = :'.$var4.'') ;
    }

    public function save($var1, $var2, $var3, $var4, $val1, $val2, $val3, $val4){
        $this->inserer->execute(array($var1 => $val1,
            $var2 => $val2,
            $var3 => $val3,
            $var4 => $val4
        )) ;
        return $this->inserer->rowCount() ;
    }

    public function merge($var1, $var2, $var3, $var4, $val1, $val2, $val3, $val4){
        $this->modifier->execute(array($var1 => $val1,
            $var2 => $val2,
            $var3 => $val3,
            $var4 => $val4
        )) ;
        return $this->modifier->rowCount() ;
    }

    public function counts(){
        $this->nombre->execute() ;
        $resultat = $this->nombre->fetch() ;
        $nombre = $resultat['nbre'] ;
        return $nombre ;
    }

    public function counts_1($var2, $val2){
        $this->nombre_1->execute(array($var2 => $val2)) ;
        $resultat = $this->nombre_1->fetch() ;
        $nombre = $resultat['nbre'] ;
        return $nombre ;
    }

    public function counts_2($var3, $val3){
        $this->nombre_2->execute(array($var3 => $val3)) ;
        $resultat = $this->nombre_2->fetch() ;
        $nombre = $resultat['nbre'] ;
        return $nombre ;
    }

    public function counts_3($var4, $val4){
        $this->nombre_3->execute(array($var4 => $val4)) ;
        $resultat = $this->nombre_3->fetch() ;
        $nombre = $resultat['nbre'] ;
        return $nombre ;
    }

    public function findAll(){
        $this->selectAll->execute() ;
        return $this->selectAll->fetchAll() ;
    }

    public function findById($var1, $val1){
        $this->selectById->execute(array($var1 => $val1)) ;
        return $this->selectById->fetchAll() ;
    }

    public function findByValue_1($var2, $val2){
        $this->selectByValue1->execute(array($var2 => $val2));
        return $this->selectByValue1->fetchAll();
    }

    public function findByValue_2($var3, $val3){
        $this->selectByValue2->execute(array($var3 => $val3));
        return $this->selectByValue2->fetchAll();
    }

    public function findByValue_3($var4, $val4){
        $this->selectByValue3->execute(array($var4 => $val4));
        return $this->selectByValue3->fetchAll();
    }

    public function remove($var1, $val1){
        $this->supprimer->execute(array($var1 => $val1));
        return $this->supprimer->rowCount();
    }
}


