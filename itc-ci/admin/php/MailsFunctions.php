<?php

function getMailReservation($email, $contenu, $objet){

    if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $email)){$passage_ligne = "\r\n";} // On filtre les serveurs qui présentent des bogues.
    else {$passage_ligne = "\n";}

    $message_html = $contenu;

    //=====Création de la boundary.

    $boundary = "-----=".md5(rand());

    $boundary_alt = "-----=".md5(rand());

    //==========

    //=====Définition du sujet.

    $sujet = $objet;

    //=========

    //=====Création du header de l'e-mail.

    $header = "MIME-Version: 1.0".$passage_ligne;

    $header.= "Content-Type: multipart/mixed;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;

    //==========

    //=====Création du message.

    $message = $passage_ligne."--".$boundary.$passage_ligne;

    $message.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary_alt\"".$passage_ligne;

    $message.= $passage_ligne."--".$boundary_alt.$passage_ligne;

    //=====Ajout du message au format HTML.

    $message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;

    $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;

    $message.= $passage_ligne.$message_html.$passage_ligne;

    //==========

    //=====On ferme la boundary alternative.

    $message.= $passage_ligne."--".$boundary_alt."--".$passage_ligne;

    //==========

    return mail($email, $sujet, $message, $header);
}


/*function getMailConfirmation($email, $contenu, $objet){

    if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $email)){$passage_ligne = "\r\n";} // On filtre les serveurs qui présentent des bogues.
    else {$passage_ligne = "\n";}

    $message_html = $contenu;

    //=====Création de la boundary.

    $boundary = "-----=".md5(rand());

    $boundary_alt = "-----=".md5(rand());

    //==========

    //=====Définition du sujet.

    $sujet = $objet;

    //=========

    //=====Création du header de l'e-mail.

    $header = "MIME-Version: 1.0".$passage_ligne;

    $header.= "Content-Type: multipart/mixed;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;

    //==========

    //=====Création du message.

    $message = $passage_ligne."--".$boundary.$passage_ligne;

    $message.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary_alt\"".$passage_ligne;

    $message.= $passage_ligne."--".$boundary_alt.$passage_ligne;

    //=====Ajout du message au format HTML.

    $message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;

    $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;

    $message.= $passage_ligne.$message_html.$passage_ligne;

    //==========

    //=====On ferme la boundary alternative.

    $message.= $passage_ligne."--".$boundary_alt."--".$passage_ligne;

    //==========

    return mail($email, $sujet, $message, $header);
}*/


function verifDomaine($email){
    $reponse = false;

    $domaine = explode('@', $email);
    getmxrr($domaine[1], $mxhost);

    if($mxhost) $reponse = true;

    return $reponse;
}


function essaiMailText($mail, $contenu, $sujet){
    if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui présentent des bogues.
    {
        $passage_ligne = "\r\n";
    }
    else
    {
        $passage_ligne = "\n";
    }


//=====Création de la boundary.
    $boundary = "-----=".md5(rand());
    $boundary_alt = "-----=".md5(rand());
//==========

//=====Création du header de l'e-mail.
    $header = "From: \"WeaponsB\"<sylvestregaye@gmail.com>".$passage_ligne;
    $header.= "Reply-to: \"WeaponsB\" <$mail>".$passage_ligne;
    $header.= "MIME-Version: 1.0".$passage_ligne;
    $header.= "Content-Type: multipart/mixed;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
//==========

//=====Création du message.
    $message = $passage_ligne."--".$boundary.$passage_ligne;
    $message.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary_alt\"".$passage_ligne;
    $message.= $passage_ligne."--".$boundary_alt.$passage_ligne;

//=====Ajout du message au format HTML.
    $message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
    $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
    $message.= $passage_ligne.$contenu.$passage_ligne;
//==========

//=====On ferme la boundary alternative.
    $message.= $passage_ligne."--".$boundary_alt."--".$passage_ligne;
//==========



    $message.= $passage_ligne."--".$boundary.$passage_ligne;

//=====Envoi de l'e-mail.
    return(mail($mail,$sujet,$message,$header));

//==========
}

?>
