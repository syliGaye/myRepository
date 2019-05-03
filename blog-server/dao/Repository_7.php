<?php

/**
 * classe d'une table à quatre (7) tuples
 */
class Repository_7
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
    private $nombre_1 ;
    private $nombre_2 ;
    private $nombre_3 ;
    private $nombre_4 ;
    private $nombre_5 ;
    private $nombre_6 ;
    private $selectByValue_1;
    private $selectByValue_2;
    private $selectByValue_3;
    private $selectByValue_4;
    private $selectByValue_5;
    private $selectByValue_6;

    public function __construct($bdd, $table, $var1, $var2, $var3, $var4, $var5, $var6, $var7)
    {
        $this->inserer = $bdd->prepare('INSERT INTO '.$table.'('.$var1.', '.$var2.', '.$var3.', '.$var4.', '.$var5.', '.$var6.', '.$var7.') VALUES (:'.$var1.', :'.$var2.', :'.$var3.', :'.$var4.', :'.$var5.', :'.$var6.', :'.$var7.')') ;
        $this->selectAll = $bdd->prepare('SELECT '.$var1.', '.$var2.', '.$var3.', '.$var4.', '.$var5.', '.$var6.', '.$var7.' FROM '.$table.' ORDER BY '.$var1) ;
        $this->modifier = $bdd->prepare('UPDATE '.$table.' SET '.$var1.' = :'.$var1.', '.$var2.' = :'.$var2.', '.$var3.' = :'.$var3.', '.$var4.' = :'.$var4.', '.$var5.' = :'.$var5.', '.$var6.' = :'.$var6.', '.$var7.' = :'.$var7.' WHERE '.$var1.' = :'.$var1) ;
        $this->nombre = $bdd->prepare('SELECT COUNT(*) AS nbre FROM '.$table) ;
        $this->nombre_1 = $bdd->prepare('SELECT COUNT(*) AS nbre FROM '.$table.' WHERE '.$var2.' = :'.$var2.'') ;
        $this->nombre_2 = $bdd->prepare('SELECT COUNT(*) AS nbre FROM '.$table.' WHERE '.$var3.' = :'.$var3.'') ;
        $this->nombre_3 = $bdd->prepare('SELECT COUNT(*) AS nbre FROM '.$table.' WHERE '.$var4.' = :'.$var4.'') ;
        $this->nombre_4 = $bdd->prepare('SELECT COUNT(*) AS nbre FROM '.$table.' WHERE '.$var5.' = :'.$var5.'') ;
        $this->nombre_5 = $bdd->prepare('SELECT COUNT(*) AS nbre FROM '.$table.' WHERE '.$var6.' = :'.$var6.'') ;
        $this->nombre_6 = $bdd->prepare('SELECT COUNT(*) AS nbre FROM '.$table.' WHERE '.$var7.' = :'.$var7.'') ;
        $this->supprimer = $bdd->prepare('DELETE FROM '.$table.' WHERE '.$var1.' = :'.$var1.'');
        $this->selectById = $bdd->prepare('SELECT '.$var1.', '.$var2.', '.$var3.', '.$var4.', '.$var5.', '.$var6.', '.$var7.' FROM '.$table.' WHERE '.$var1.' = :'.$var1.' ORDER BY '.$var1) ;
        $this->selectByValue_1 = $bdd->prepare('SELECT '.$var1.', '.$var2.', '.$var3.', '.$var4.', '.$var5.', '.$var6.', '.$var7.' FROM '.$table.' WHERE '.$var2.' = :'.$var2.' ORDER BY '.$var1) ;
        $this->selectByValue_2 = $bdd->prepare('SELECT '.$var1.', '.$var2.', '.$var3.', '.$var4.', '.$var5.', '.$var6.', '.$var7.' FROM '.$table.' WHERE '.$var3.' = :'.$var3.' ORDER BY '.$var1) ;
        $this->selectByValue_3 = $bdd->prepare('SELECT '.$var1.', '.$var2.', '.$var3.', '.$var4.', '.$var5.', '.$var6.', '.$var7.' FROM '.$table.' WHERE '.$var4.' = :'.$var4.' ORDER BY '.$var1) ;
        $this->selectByValue_4 = $bdd->prepare('SELECT '.$var1.', '.$var2.', '.$var3.', '.$var4.', '.$var5.', '.$var6.', '.$var7.' FROM '.$table.' WHERE '.$var5.' = :'.$var5.' ORDER BY '.$var1) ;
        $this->selectByValue_5 = $bdd->prepare('SELECT '.$var1.', '.$var2.', '.$var3.', '.$var4.', '.$var5.', '.$var6.', '.$var7.' FROM '.$table.' WHERE '.$var6.' = :'.$var6.' ORDER BY '.$var1) ;
        $this->selectByValue_6 = $bdd->prepare('SELECT '.$var1.', '.$var2.', '.$var3.', '.$var4.', '.$var5.', '.$var6.', '.$var7.' FROM '.$table.' WHERE '.$var7.' = :'.$var7.' ORDER BY '.$var1) ;
    }

    public function save($var1, $var2, $var3, $var4, $var5, $var6, $var7, $val1, $val2, $val3, $val4, $val5, $val6, $val7){
        $this->inserer->execute(array($var1 => $val1,
            $var2 => $val2,
            $var3 => $val3,
            $var4 => $val4,
            $var5 => $val5,
            $var6 => $val6,
            $var7 => $val7
        )) ;
        return $this->inserer->rowCount() ;
    }

    public function merge($var1, $var2, $var3, $var4, $var5, $var6, $var7, $val1, $val2, $val3, $val4, $val5, $val6, $val7){
        $this->modifier->execute(array($var1 => $val1,
            $var2 => $val2,
            $var3 => $val3,
            $var4 => $val4,
            $var5 => $val5,
            $var6 => $val6,
            $var7 => $val7
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

    public function counts_4($var5, $val5){
        $this->nombre_4->execute(array($var5 => $val5)) ;
        $resultat = $this->nombre_4->fetch() ;
        $nombre = $resultat['nbre'] ;
        return $nombre ;
    }

    public function counts_5($var6, $val6){
        $this->nombre_5->execute(array($var6 => $val6)) ;
        $resultat = $this->nombre_5->fetch() ;
        $nombre = $resultat['nbre'] ;
        return $nombre ;
    }

    public function counts_6($var7, $val7){
        $this->nombre_6->execute(array($var7 => $val7)) ;
        $resultat = $this->nombre_6->fetch() ;
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
        $this->selectByValue_1->execute(array($var2 => $val2));
        return $this->selectByValue_1->fetchAll();
    }

    public function findByValue_2($var3, $val3){
        $this->selectByValue_2->execute(array($var3 => $val3));
        return $this->selectByValue_2->fetchAll();
    }

    public function findByValue_3($var4, $val4){
        $this->selectByValue_3->execute(array($var4 => $val4));
        return $this->selectByValue_3->fetchAll();
    }

    public function findByValue_4($var5, $val5){
        $this->selectByValue_4->execute(array($var5 => $val5));
        return $this->selectByValue_4->fetchAll();
    }

    public function findByValue_5($var6, $val6){
        $this->selectByValue_5->execute(array($var6 => $val6));
        return $this->selectByValue_5->fetchAll();
    }

    public function findByValue_6($var7, $val7){
        $this->selectByValue_6->execute(array($var7 => $val7));
        return $this->selectByValue_6->fetchAll();
    }
}


