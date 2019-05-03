<?php

function envoyerMail($mail, $nom, $prenom, $objet, $content){

    if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui présentent des bogues.
    {
        $passage_ligne = "\r\n";
    }
    else
    {
        $passage_ligne = "\n";
    }
//=====Déclaration des messages au format texte et au format HTML.
    $message_txt = "";
    $message_html = $content;
//==========

//=====Lecture et mise en forme de la pièce jointe.
    /*$fichier   = fopen($photo, "r");
    $attachement = fread($fichier, filesize($photo));
    $attachement = chunk_split(base64_encode($attachement));
    fclose($fichier);*/
//==========

//=====Création de la boundary.
    $boundary = "-----=".md5(rand());
    $boundary_alt = "-----=".md5(rand());
//==========

//=====Définition du sujet.
    $sujet = $objet;
//=========

//=====Création du header de l'e-mail.
    $header = "From: \"ITC CI\"<sylvestregaye@gmail.com>".$passage_ligne;
    $header.= "Reply-to: \"$prenom $nom\" <$mail>".$passage_ligne;
    $header.= "MIME-Version: 1.0".$passage_ligne;
    $header.= "Content-Type: multipart/mixed;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
//==========

//=====Création du message.
    $message = $passage_ligne."--".$boundary.$passage_ligne;
    $message.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary_alt\"".$passage_ligne;
    $message.= $passage_ligne."--".$boundary_alt.$passage_ligne;
//=====Ajout du message au format texte.
    $message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
    $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
    $message.= $passage_ligne.$message_txt.$passage_ligne;
//==========

    $message.= $passage_ligne."--".$boundary_alt.$passage_ligne;

//=====Ajout du message au format HTML.
    $message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
    $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
    $message.= $passage_ligne.$message_html.$passage_ligne;
//==========

//=====On ferme la boundary alternative.
    $message.= $passage_ligne."--".$boundary_alt."--".$passage_ligne;
//==========



    $message.= $passage_ligne."--".$boundary.$passage_ligne;

//=====Ajout de la pièce jointe.
    /*$message.= "Content-Type: image/jpeg; name=\"logo_itc.jpg\"".$passage_ligne;
    $message.= "Content-Transfer-Encoding: base64".$passage_ligne;
    $message.= "Content-Disposition: attachment; filename=\"logo_itc.jpg\"".$passage_ligne;
    $message.= $passage_ligne.$attachement.$passage_ligne.$passage_ligne;
    $message.= $passage_ligne."--".$boundary."--".$passage_ligne;*/
//==========

    return mail($mail, $sujet, $message, $header);
}

function envoyerMail2($mail, $nom, $objet, $content){

    if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui présentent des bogues.
    {
        $passage_ligne = "\r\n";
    }
    else
    {
        $passage_ligne = "\n";
    }
//=====Déclaration des messages au format texte et au format HTML.
    $message_txt = "";
    $message_html = $content;
//==========

//=====Lecture et mise en forme de la pièce jointe.
    /*$fichier   = fopen($photo, "r");
    $attachement = fread($fichier, filesize($photo));
    $attachement = chunk_split(base64_encode($attachement));
    fclose($fichier);*/
//==========

//=====Création de la boundary.
    $boundary = "-----=".md5(rand());
    $boundary_alt = "-----=".md5(rand());
//==========

//=====Définition du sujet.
    $sujet = $objet;
//=========

//=====Création du header de l'e-mail.
    $header = "From: \"$nom\"<$mail>".$passage_ligne;
    $header.= "Reply-to: \"ITC CI\" <info@itc-ci.com>".$passage_ligne;
    $header.= "MIME-Version: 1.0".$passage_ligne;
    $header.= "Content-Type: multipart/mixed;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
//==========

//=====Création du message.
    $message = $passage_ligne."--".$boundary.$passage_ligne;
    $message.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary_alt\"".$passage_ligne;
    $message.= $passage_ligne."--".$boundary_alt.$passage_ligne;
//=====Ajout du message au format texte.
    $message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
    $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
    $message.= $passage_ligne.$message_txt.$passage_ligne;
//==========

    $message.= $passage_ligne."--".$boundary_alt.$passage_ligne;

//=====Ajout du message au format HTML.
    $message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
    $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
    $message.= $passage_ligne.$message_html.$passage_ligne;
//==========

//=====On ferme la boundary alternative.
    $message.= $passage_ligne."--".$boundary_alt."--".$passage_ligne;
//==========



    $message.= $passage_ligne."--".$boundary.$passage_ligne;

//=====Ajout de la pièce jointe.
    /*$message.= "Content-Type: image/jpeg; name=\"logo_itc.jpg\"".$passage_ligne;
    $message.= "Content-Transfer-Encoding: base64".$passage_ligne;
    $message.= "Content-Disposition: attachment; filename=\"logo_itc.jpg\"".$passage_ligne;
    $message.= $passage_ligne.$attachement.$passage_ligne.$passage_ligne;
    $message.= $passage_ligne."--".$boundary."--".$passage_ligne;*/
//==========

    return mail('info@itc-ci.com', $sujet, $message, $header);
}

function envoyerMail3($senderMail, $senderName, $receiverMail, $recieverName, $object, $content){

    if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $receiverMail)) // On filtre les serveurs qui présentent des bogues.
    {
        $passage_ligne = "\r\n";
    }
    else
    {
        $passage_ligne = "\n";
    }
//=====Déclaration des messages au format texte et au format HTML.
    $message_txt = "";
    $message_html = $content;
//==========

//=====Lecture et mise en forme de la pièce jointe.
    /*$fichier   = fopen($photo, "r");
    $attachement = fread($fichier, filesize($photo));
    $attachement = chunk_split(base64_encode($attachement));
    fclose($fichier);*/
//==========

//=====Création de la boundary.
    $boundary = "-----=".md5(rand());
    $boundary_alt = "-----=".md5(rand());
//==========

//=====Définition du sujet.
    $sujet = $object;
//=========

//=====Création du header de l'e-mail.
    $header = "From: \"$senderName\"<$senderMail>".$passage_ligne;
    $header.= "Reply-to: \"$recieverName\" <$receiverMail>".$passage_ligne;
    $header.= "MIME-Version: 1.0".$passage_ligne;
    $header.= "Content-Type: multipart/mixed;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
//==========

//=====Création du message.
    $message = $passage_ligne."--".$boundary.$passage_ligne;
    $message.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary_alt\"".$passage_ligne;
    $message.= $passage_ligne."--".$boundary_alt.$passage_ligne;
//=====Ajout du message au format texte.
    $message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
    $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
    $message.= $passage_ligne.$message_txt.$passage_ligne;
//==========

    $message.= $passage_ligne."--".$boundary_alt.$passage_ligne;

//=====Ajout du message au format HTML.
    $message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
    $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
    $message.= $passage_ligne.$message_html.$passage_ligne;
//==========

//=====On ferme la boundary alternative.
    $message.= $passage_ligne."--".$boundary_alt."--".$passage_ligne;
//==========



    $message.= $passage_ligne."--".$boundary.$passage_ligne;

//=====Ajout de la pièce jointe.
    /*$message.= "Content-Type: image/jpeg; name=\"logo_itc.jpg\"".$passage_ligne;
    $message.= "Content-Transfer-Encoding: base64".$passage_ligne;
    $message.= "Content-Disposition: attachment; filename=\"logo_itc.jpg\"".$passage_ligne;
    $message.= $passage_ligne.$attachement.$passage_ligne.$passage_ligne;
    $message.= $passage_ligne."--".$boundary."--".$passage_ligne;*/
//==========

    return mail($receiverMail, $sujet, $message, $header);
}

function verifDomaine($email){
    $reponse = false;

    $domaine = explode('@', $email);
    getmxrr($domaine[1], $mxhost);

    if($mxhost) $reponse = true;

    return $reponse;
}