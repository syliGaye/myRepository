<?php
include_once 'php/configuration/configuration.php' ;

if(isset($_SESSION['username'])){
    $content = (isset($_POST['summernote']))? htmlentities($_POST['summernote']):null;

    include_once 'views/blocks/header_deb.php';
    ?>



<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>ITC - Envoyer Mail</title>
    <link rel="icon" type="image/ico" href="assets/images/logo_icon_essai.ico" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">




    <!-- ============================================
    ================= Stylesheets ===================
    ============================================= -->
    <!-- vendor css files -->
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/vendor/animate.css">
    <link rel="stylesheet" href="assets/css/vendor/font-awesome.min.css">
    <link rel="stylesheet" href="assets/js/vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" href="assets/js/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="assets/js/vendor/toastr/toastr.min.css">
    <link rel="stylesheet" href="assets/js/vendor/chosen/chosen.css">
    <link rel="stylesheet" href="assets/js/vendor/summernote/summernote.css">
    <link rel="stylesheet" href="assets/css/vendor/simple-line-icons.css">
    <link rel="stylesheet" href="assets/css/vendor/weather-icons.min.css">


    <!-- project main css files -->
    <link rel="stylesheet" href="assets/css/main.css">
    <!--/ stylesheets -->



    <!-- ==========================================
    ================= Modernizr ===================
    =========================================== -->
    <script src="assets/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    <!--/ modernizr -->




</head>





<body id="minovate" class="appWrapper" ng-app="itcAdminApp" ng-controller="AdminMainCtrl">


<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<div id="wrap" class="animsition">
    <div class="page page-core page-login">
        <div class="container w-360 p-15 bg-white mt-40" style="width: auto;">
            <div class="tcol">
                <!-- right side header -->
                <div class="p-15 bg-white b-b">
                    <div class="btn-toolbar">
                        <div class="btn-group">
                            <button class="btn btn-rounded btn-ef btn-ef-2 btn-ef-2-danger btn-ef-2b mb-10" id="mailRetour"><i class="fa fa-arrow-left"></i> Retour</button>
                        </div>
                    </div>


                </div>
                <!-- /right side header -->
                <?php
                if($_SESSION['notif'] !== null){
                $tab = array();
                $query2 = $db->prepare('SELECT id, titre, contenu, etatOuverture, etatLecture, idSession FROM notification WHERE id = :id') ;
                $query2->execute(array('id' => $_SESSION['notif']));
                $donnee = $query2->fetch();

                $query2 = $db->prepare('SELECT * FROM souscripteur WHERE idSession = :idSession') ;
                $query2->execute(array('idSession' => $donnee['idSession']));
                $dn1 = $query2->fetchAll();
                $query3 = $db->prepare('SELECT * FROM session WHERE id = :id') ;
                $query3->execute(array('id' => $donnee['idSession']));
                $dn2 = $query3->fetch();

                foreach($dn1 as $val1){
                    $tab_essai = array(
                        'idNotif' => $donnee['id'],
                        'idSouscripteur' => $val1['id'],
                        'nomSouscripteur' => $val1['nom'],
                        'prenomSouscripteur' => $val1['prenoms'],
                        'contactSous' => $val1['telepnone'],
                        'emailSous' => $val1['email'],
                        'idSession' => $dn2['id']
                    );
                    array_push($tab, $tab_essai);
                }
                ?>

                <form role="form" enctype="application/x-www-form-urlencoded" action="php/notification/envoyerMail.php" method="post" class="form-horizontal mt-20">
                    <div class="p-30 bg-white b-b">bref</div>

                    <div class="p-15">

                        <input type="hidden" name="idNotifCache" value="<?php echo $donnee['id'] ;?>">
                        <input type="hidden" name="titreNotifCache" value="<?php echo $donnee['titre'] ;?>">
                        <input type="hidden" name="contentNotifCache" value="<?php echo $donnee['contenu'] ;?>">
                        <input type="hidden" name="ouvertNotifCache" value="<?php echo $donnee['etatOuverture'] ;?>">
                        <input type="hidden" name="sessionNotifCache" value="<?php echo $donnee['idSession'] ;?>">
                        <div class="form-group">
                            <label class="col-lg-2 control-label">To:</label>
                            <div class="col-lg-8">
                                <select name="lesRecipients[]" id="lesRecipients" data-placeholder="Select recipients..." multiple="" tabindex="3" class="chosen-select" style="width: 100%;">
                                    <?php
                                    foreach($tab as $valSous){
                                        echo '<option value="'.$valSous['emailSous'].'">'.$valSous['prenomSouscripteur'].' '.$valSous['nomSouscripteur'].', <"'.$valSous['emailSous'].'"></option>';
                                    }
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Subject:</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="objetMails" id="objetMails"">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Content:</label>
                            <div class="col-lg-8">
                                <textarea  name="summernote" id="summernote" value="jdvsdhhds"></textarea>
                                <!--<div id="summernote" class="leTextMail">Hello Summernote</div>-->
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-8 col-lg-offset-2">
                            <button role="button" class="btn btn-blue btn-ef btn-ef-7 btn-ef-7b b-0 br-2" id="leBoutonEnvoie"><i class="fa fa-envelope"></i> Envoyer</button>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>
<!--/ Application Content -->

<?php
include_once 'views/pages/alerts.php' ;
include_once 'views/blocks/footer.php'
?>


<!-- ===============================================
============== Page Specific Scripts ===============
================================================ -->
<script type="text/javascript" src="assets/js/sendMail.js"></script>
<!--/ Page Specific Scripts -->


</body>
</html>
<?php
}
else{
    header('Location: login.php') ;
}
?>