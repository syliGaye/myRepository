<?php
require_once '../repositories/Repository_6.php';

class Notification {
    private $id;
    private $titre;
    private $corps;
    private $ouverture;
    private $lecture;
    private $idSession;

    function __construct(){
        $this->corps = null;
        $this->id = null;
        $this->lecture = null;
        $this->ouverture = null;
        $this->titre = null;
        $this->idSession = null;
    }

    public function getAllNotification($db){
        $repository_6 = new Repository_6($db, 'notification', 'id', 'titre', 'contenu', 'etatOuverture', 'etatLecture', 'idSession');
        return $repository_6->findAll();
    }

    public function getNotificationById($db, $id){
        $repository_6 = new Repository_6($db, 'notification', 'id', 'titre', 'contenu', 'etatOuverture', 'etatLecture', 'idSession');
        $this->setId($id);
        return $repository_6->findById('id', $this->getId());
    }

    public function getNotificationByTitre($db, $titre){
        $repository_6 = new Repository_6($db, 'notification', 'id', 'titre', 'contenu', 'etatOuverture', 'etatLecture', 'idSession');
        $this->setTitre($titre);
        return $repository_6->findByValue_1('titre', $this->getTitre());
    }

    public function getNotificationByOuverture($db, $ouverture){
        $repository_6 = new Repository_6($db, 'notification', 'id', 'titre', 'contenu', 'etatOuverture', 'etatLecture', 'idSession');
        $this->setOuverture($ouverture);
        return $repository_6->findByValue_3('etatOuverture', $this->getOuverture());
    }

    public function getNotificationByLecture($db, $lecture){
        $repository_6 = new Repository_6($db, 'notification', 'id', 'titre', 'contenu', 'etatOuverture', 'etatLecture', 'idSession');
        $this->setLecture($lecture);
        return $repository_6->findByValue_4('etatLecture', $this->getLecture());
    }

    public function getNotificationBySession($db, $idSession){
        $repository_6 = new Repository_6($db, 'notification', 'id', 'titre', 'contenu', 'etatOuverture', 'etatLecture', 'idSession');
        $this->setIdSession($idSession);
        return $repository_6->findByValue_5('idSession', $this->getIdSession());
    }

    public function saveNotification($db, $titre, $corps, $ouverture, $lecture, $idSession){
        $repository_6 = new Repository_6($db, 'notification', 'id', 'titre', 'contenu', 'etatOuverture', 'etatLecture', 'idSession');
        $donnee = $this->getAllNotification( $db);
        $i = 1;
        if(count($donnee) === 0){$this->setId(1);}
        else{
            foreach($donnee as $valeur){
                if($valeur['id'] != $i){
                    $this->setId($i);
                    break;
                }
                else{$this->setId($i + 1);}
                $i++;
            }
        }

        $this->setTitre($titre);  $this->setCorps($corps);  $this->setOuverture($ouverture);  $this->setLecture($lecture);  $this->setIdSession($idSession);
        return $repository_6->save('id', 'titre', 'contenu', 'etatOuverture', 'etatLecture', 'idSession',
            $this->getId(), $this->getTitre(), $this->getCorps(), $this->getOuverture(), $this->getLecture(), $this->getIdSession());
    }

    public function mergeNotification($db, $id, $titre, $corps, $ouverture, $lecture, $idSession){
        $repository_6 = new Repository_6($db, 'notification', 'id', 'titre', 'contenu', 'etatOuverture', 'etatLecture', 'idSession');
        $this->setId($id);  $this->setTitre($titre);  $this->setCorps($corps);  $this->setOuverture($ouverture);  $this->setLecture($lecture);
        $this->setIdSession($idSession);

        return $repository_6->merge('id', 'titre', 'contenu', 'etatOuverture', 'etatLecture', 'idSession',
            $this->getId(), $this->getTitre(), $this->getCorps(), $this->getOuverture(), $this->getLecture(), $this->getIdSession());
    }

    public function removeNotification($db, $id){
        $repository_6 = new Repository_6($db, 'notification', 'id', 'titre', 'contenu', 'etatOuverture', 'etatLecture', 'idSession');
        $this->setId($id);
        return $repository_6->remove('id', $this->getId());
    }

    public function removeNotificationThoughTitre($db, $titre){
        $repository_6 = new Repository_6($db, 'notification', 'id', 'titre', 'contenu', 'etatOuverture', 'etatLecture', 'idSession');
        $this->setTitre($titre);
        return $repository_6->remove_1('titre', $this->getTitre());
    }

    public function removeNotificationThoughOuverture($db, $ouverture){
        $repository_6 = new Repository_6($db, 'notification', 'id', 'titre', 'contenu', 'etatOuverture', 'etatLecture', 'idSession');
        $this->setOuverture($ouverture);
        return $repository_6->remove_3('etatOuverture', $this->getOuverture());
    }

    public function removeNotificationThoughLecture($db, $lecture){
        $repository_6 = new Repository_6($db, 'notification', 'id', 'titre', 'contenu', 'etatOuverture', 'etatLecture', 'idSession');
        $this->setLecture($lecture);
        return $repository_6->remove_4('etatLecture', $this->getLecture());
    }

    public function removeNotificationThoughSession($db, $idSession){
        $repository_6 = new Repository_6($db, 'notification', 'id', 'titre', 'contenu', 'etatOuverture', 'etatLecture', 'idSession');
        $this->setIdSession($idSession);
        return $repository_6->remove_5('idSession', $this->getIdSession());
    }

    public function getCorps()
    {
        return $this->corps;
    }

    public function setCorps($corps)
    {
        $this->corps = $corps;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getLecture()
    {
        return $this->lecture;
    }

    public function setLecture($lecture)
    {
        $this->lecture = $lecture;
    }

    public function getOuverture()
    {
        return $this->ouverture;
    }

    public function setOuverture($ouverture)
    {
        $this->ouverture = $ouverture;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    public function getIdSession()
    {
        return $this->idSession;
    }

    public function setIdSession($idSession)
    {
        $this->idSession = $idSession;
    }
} 