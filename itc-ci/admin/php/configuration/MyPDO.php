<?php

class MyPDO extends PDO {
    
    public function __construct($hostDb, $nomUtilisateur = null, $motDePasse = null) {
        parent::__construct($hostDb, $nomUtilisateur, $motDePasse);
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;
    }
    
    public function prepare($sql, $option = null) {
        $statement = parent::prepare($sql);
        
        if(strpos(strtoupper($sql), 'SELECT') === 0){$statement->setFetchMode(PDO::FETCH_ASSOC) ;}
        
        return $statement ;
    }
}



function efface_cookies(){
    global $HTTP_COOKIE_VARS;
    if (0 < sizeof($HTTP_COOKIE_VARS)) {
        while (list ($k_cookie, $v_cookie) = each ($HTTP_COOKIE_VARS)) { setcookie($k_cookie);}
    }
}