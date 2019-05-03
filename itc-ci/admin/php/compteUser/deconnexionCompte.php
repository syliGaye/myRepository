<?php
include_once '../configuration/configuration.php';

unset($_SESSION['username'], $_SESSION['userid']);

$message = 'ok' ;
echo json_encode(['message' => $message]) ;