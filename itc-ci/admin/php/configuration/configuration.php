<?php

require_once 'MyPDO.php';

//On efface les cookies
efface_cookies() ;

//On demarre les sessions
session_start();

/******************************************************
----------------Configuration Obligatoire--------------
Veuillez modifier les variables ci-dessous pour que le
site puisse fonctionner correctement.
******************************************************/

//On se connecte a la base de donnee
$db = new MyPDO('mysql:hote=localhost; dbname=itcci_bd', 'root','admin') ;

//Email de la structure
$mail_webmaster = 'sylvestregaye@gmail.com';

//Telephone
$phone_structutre = '+225 47669724' ;

//Adresse du dossier de la top site
$url_root = 'http://www.itc-ci.com//';

/******************************************************
----------------Configuration Optionelle---------------
******************************************************/

//Nom du fichier de laccueil
$url_home = 'index.php';
