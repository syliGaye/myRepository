<?php

/**
 * classe d'une table à quatre (9) tuples
 */
class Repository_9
{
    /*
    * les requêtes péparées
    */
    private $inserer ;
    private $selectAll ;
    private $supprimer;
    private $supprimer1;
    private $supprimer2;
    private $supprimer3;
    private $supprimer4;
    private $supprimer5;
    private $supprimer6;
    private $supprimer7;
    private $supprimer8;
    private $selectById ;
    private $modifier ;
    private $nombre ;
    private $selectByValue1;
    private $selectByValue2;
    private $selectByValue3;
    private $selectByValue4;
    private $selectByValue5;
    private $selectByValue6;
    private $selectByValue7;
    private $selectByValue8;

    public function __construct($bdd, $table, $var1, $var2, $var3, $var4, $var5, $var6, $var7, $var8, $var9)
    {
        $this->inserer = $bdd->prepare('INSERT INTO '.$table.'('.$var1.', '.$var2.', '.$var3.', '.$var4.', '.$var5.', '.$var6.', '.$var7.', '.$var8.', '.$var9.') VALUES (:'.$var1.', :'.$var2.', :'.$var3.', :'.$var4.', :'.$var5.', :'.$var6.', :'.$var7.', :'.$var8.', :'.$var9.')') ;
        $this->selectAll = $bdd->prepare('SELECT DISTINCT '.$var1.', '.$var2.', '.$var3.', '.$var4.', '.$var5.', '.$var6.', '.$var7.', '.$var8.', '.$var9.' FROM '.$table.' ORDER BY '.$var1) ;
        $this->modifier = $bdd->prepare('UPDATE '.$table.' SET '.$var1.' = :'.$var1.', '.$var2.' = :'.$var2.', '.$var3.' = :'.$var3.', '.$var4.' = :'.$var4.', '.$var5.' = :'.$var5.', '.$var6.' = :'.$var6.', '.$var7.' = :'.$var7.', '.$var8.' = :'.$var8.', '.$var9.' = :'.$var9.' WHERE '.$var1.' = :'.$var1) ;
        $this->nombre = $bdd->prepare('SELECT COUNT(*) AS nbre FROM '.$table) ;
        $this->supprimer = $bdd->prepare('DELETE FROM '.$table.' WHERE '.$var1.' = :'.$var1.'');
        $this->supprimer1 = $bdd->prepare('DELETE FROM '.$table.' WHERE '.$var2.' = :'.$var2.'');
        $this->supprimer2 = $bdd->prepare('DELETE FROM '.$table.' WHERE '.$var3.' = :'.$var3.'');
        $this->supprimer3 = $bdd->prepare('DELETE FROM '.$table.' WHERE '.$var4.' = :'.$var4.'');
        $this->supprimer4 = $bdd->prepare('DELETE FROM '.$table.' WHERE '.$var5.' = :'.$var5.'');
        $this->supprimer5 = $bdd->prepare('DELETE FROM '.$table.' WHERE '.$var6.' = :'.$var6.'');
        $this->supprimer6 = $bdd->prepare('DELETE FROM '.$table.' WHERE '.$var7.' = :'.$var7.'');
        $this->supprimer7 = $bdd->prepare('DELETE FROM '.$table.' WHERE '.$var8.' = :'.$var8.'');
        $this->supprimer8 = $bdd->prepare('DELETE FROM '.$table.' WHERE '.$var9.' = :'.$var9.'');
        $this->selectById = $bdd->prepare('SELECT DISTINCT '.$var1.', '.$var2.', '.$var3.', '.$var4.', '.$var5.', '.$var6.', '.$var7.', '.$var8.', '.$var9.' FROM '.$table.' WHERE '.$var1.' = :'.$var1.' ORDER BY '.$var1) ;
        $this->selectByValue1 = $bdd->prepare('SELECT DISTINCT '.$var1.', '.$var2.', '.$var3.', '.$var4.', '.$var5.', '.$var6.', '.$var7.', '.$var8.', '.$var9.' FROM '.$table.' WHERE '.$var2.' = :'.$var2.'') ;
        $this->selectByValue2 = $bdd->prepare('SELECT DISTINCT '.$var1.', '.$var2.', '.$var3.', '.$var4.', '.$var5.', '.$var6.', '.$var7.', '.$var8.', '.$var9.' FROM '.$table.' WHERE '.$var3.' = :'.$var3.'') ;
        $this->selectByValue3 = $bdd->prepare('SELECT DISTINCT '.$var1.', '.$var2.', '.$var3.', '.$var4.', '.$var5.', '.$var6.', '.$var7.', '.$var8.', '.$var9.' FROM '.$table.' WHERE '.$var4.' = :'.$var4.'') ;
        $this->selectByValue4 = $bdd->prepare('SELECT DISTINCT '.$var1.', '.$var2.', '.$var3.', '.$var4.', '.$var5.', '.$var6.', '.$var7.', '.$var8.', '.$var9.' FROM '.$table.' WHERE '.$var5.' = :'.$var5.'') ;
        $this->selectByValue5 = $bdd->prepare('SELECT DISTINCT '.$var1.', '.$var2.', '.$var3.', '.$var4.', '.$var5.', '.$var6.', '.$var7.', '.$var8.', '.$var9.' FROM '.$table.' WHERE '.$var6.' = :'.$var6.'') ;
        $this->selectByValue6 = $bdd->prepare('SELECT DISTINCT '.$var1.', '.$var2.', '.$var3.', '.$var4.', '.$var5.', '.$var6.', '.$var7.', '.$var8.', '.$var9.' FROM '.$table.' WHERE '.$var7.' = :'.$var7.'') ;
        $this->selectByValue7 = $bdd->prepare('SELECT DISTINCT '.$var1.', '.$var2.', '.$var3.', '.$var4.', '.$var5.', '.$var6.', '.$var7.', '.$var8.', '.$var9.' FROM '.$table.' WHERE '.$var8.' = :'.$var8.'') ;
        $this->selectByValue8 = $bdd->prepare('SELECT DISTINCT '.$var1.', '.$var2.', '.$var3.', '.$var4.', '.$var5.', '.$var6.', '.$var7.', '.$var8.', '.$var9.' FROM '.$table.' WHERE '.$var9.' = :'.$var9.'') ;
    }

    public function save($var1, $var2, $var3, $var4, $var5, $var6, $var7, $var8, $var9, $val1, $val2, $val3, $val4, $val5, $val6, $val7, $val8, $val9){
        $this->inserer->execute(array($var1 => $val1,
            $var2 => $val2,
            $var3 => $val3,
            $var4 => $val4,
            $var5 => $val5,
            $var6 => $val6,
            $var7 => $val7,
            $var8 => $val8,
            $var9 => $val9
        )) ;
        return $this->inserer->rowCount() ;
    }

    public function merge($var1, $var2, $var3, $var4, $var5, $var6, $var7, $var8, $var9, $val1, $val2, $val3, $val4, $val5, $val6, $val7, $val8, $val9){
        $this->modifier->execute(array($var1 => $val1,
            $var2 => $val2,
            $var3 => $val3,
            $var4 => $val4,
            $var5 => $val5,
            $var6 => $val6,
            $var7 => $val7,
            $var8 => $val8,
            $var9 => $val9
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

    public function findByValue_4($var5, $val5){
        $this->selectByValue4->execute(array($var5 => $val5));
        return $this->selectByValue4->fetchAll();
    }

    public function findByValue_5($var6, $val6){
        $this->selectByValue5->execute(array($var6 => $val6));
        return $this->selectByValue5->fetchAll();
    }

    public function findByValue_6($var7, $val7){
        $this->selectByValue6->execute(array($var7 => $val7));
        return $this->selectByValue6->fetchAll();
    }

    public function findByValue_7($var8, $val8){
        $this->selectByValue7->execute(array($var8 => $val8));
        return $this->selectByValue7->fetchAll();
    }

    public function findByValue_8($var9, $val9){
        $this->selectByValue8->execute(array($var9 => $val9));
        return $this->selectByValue8->fetchAll();
    }

    public function remove($var1, $val1){
        $this->supprimer->execute(array($var1 => $val1));
        return $this->supprimer->rowCount();
    }

    public function remove_1($var2, $val2){
        $this->supprimer1->execute(array($var2 => $val2));
        return $this->supprimer1->rowCount();
    }

    public function remove_2($var3, $val3){
        $this->supprimer2->execute(array($var3 => $val3));
        return $this->supprimer2->rowCount();
    }

    public function remove_3($var4, $val4){
        $this->supprimer3->execute(array($var4 => $val4));
        return $this->supprimer3->rowCount();
    }

    public function remove_4($var5, $val5){
        $this->supprimer4->execute(array($var5 => $val5));
        return $this->supprimer4->rowCount();
    }

    public function remove_5($var6, $val6){
        $this->supprimer5->execute(array($var6 => $val6));
        return $this->supprimer5->rowCount();
    }

    public function remove_6($var7, $val7){
        $this->supprimer6->execute(array($var7 => $val7));
        return $this->supprimer6->rowCount();
    }

    public function remove_7($var8, $val8){
        $this->supprimer7->execute(array($var8 => $val8));
        return $this->supprimer7->rowCount();
    }

    public function remove_8($var9, $val9){
        $this->supprimer8->execute(array($var9 => $val9));
        return $this->supprimer8->rowCount();
    }
}
