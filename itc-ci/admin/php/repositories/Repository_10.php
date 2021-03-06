<?php

/**
 * classe d'une table à quatre (10) tuples
 */
class Repository_10
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

    public function __construct($bdd, $table, $var1, $var2, $var3, $var4, $var5, $var6, $var7, $var8, $var9, $var10)
    {
        $this->inserer = $bdd->prepare('INSERT INTO '.$table.'('.$var1.', '.$var2.', '.$var3.', '.$var4.', '.$var5.', '.$var6.', '.$var7.', '.$var8.', '.$var9.', '.$var10.') VALUES (:'.$var1.', :'.$var2.', :'.$var3.', :'.$var4.', :'.$var5.', :'.$var6.', :'.$var7.', :'.$var8.', :'.$var9.', :'.$var10.')') ;
        $this->selectAll = $bdd->prepare('SELECT '.$var1.', '.$var2.', '.$var3.', '.$var4.', '.$var5.', '.$var6.', '.$var7.', '.$var8.', '.$var9.', '.$var10.' FROM '.$table.' ORDER BY '.$var1) ;
        $this->modifier = $bdd->prepare('UPDATE '.$table.' SET '.$var1.' = :'.$var1.', '.$var2.' = :'.$var2.', '.$var3.' = :'.$var3.', '.$var4.' = :'.$var4.', '.$var5.' = :'.$var5.', '.$var6.' = :'.$var6.', '.$var7.' = :'.$var7.', '.$var8.' = :'.$var8.', '.$var9.' = :'.$var9.', '.$var10.' = :'.$var10.' WHERE '.$var1.' = :'.$var1) ;
        $this->nombre = $bdd->prepare('SELECT COUNT(*) AS nbre FROM '.$table) ;
        $this->selectById = $bdd->prepare('SELECT '.$var1.', '.$var2.', '.$var3.', '.$var4.', '.$var5.', '.$var6.', '.$var7.', '.$var8.', '.$var9.', '.$var10.' FROM '.$table.' WHERE '.$var1.' = :'.$var1.' ORDER BY '.$var1) ;
    }

    public function save($var1, $var2, $var3, $var4, $var5, $var6, $var7, $var8, $var9, $var10, $val1, $val2, $val3, $val4, $val5, $val6, $val7, $val8, $val9, $val10){
        $this->inserer->execute(array($var1 => $val1,
            $var2 => $val2,
            $var3 => $val3,
            $var4 => $val4,
            $var5 => $val5,
            $var6 => $val6,
            $var7 => $val7,
            $var8 => $val8,
            $var9 => $val9,
            $var10 => $val10
        )) ;
        return $this->inserer->rowCount() ;
    }

    public function merge($var1, $var2, $var3, $var4, $var5, $var6, $var7, $var8, $var9, $var10, $val1, $val2, $val3, $val4, $val5, $val6, $val7, $val8, $val9, $val10){
        $this->modifier->execute(array($var1 => $val1,
            $var2 => $val2,
            $var3 => $val3,
            $var4 => $val4,
            $var5 => $val5,
            $var6 => $val6,
            $var7 => $val7,
            $var8 => $val8,
            $var9 => $val9,
            $var10 => $val10
        )) ;
        return $this->modifier->rowCount() ;
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
        return $this->selectById->fetchAll() ;
    }
}
