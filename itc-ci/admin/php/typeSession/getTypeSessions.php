<?php
include_once '../configuration/configuration.php';
require_once 'TypeSession.php';

$typeSession = new TypeSession();
$donnee = $typeSession->getAllTypeSession($db);
echo json_encode(['data' => $donnee]) ;