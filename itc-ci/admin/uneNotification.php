
<?php
include_once 'php/configuration/configuration.php' ;

//echo $_SESSION['username'] ;

if(isset($_SESSION['username'])){?>
    <!doctype html>
    <!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
    <!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
    <!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
    <!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->



    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>ITC - Notification</title>
        <link rel="icon" type="image/ico" href="assets/images/logo_icon_essai.ico" />
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <!-- vendor css files -->
        <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/vendor/animate.css">
        <link rel="stylesheet" href="assets/css/vendor/font-awesome.min.css">
        <link rel="stylesheet" href="assets/js/vendor/animsition/css/animsition.min.css">
        <link rel="stylesheet" href="assets/js/vendor/datetimepicker/css/bootstrap-datetimepicker.min.css">
        <link rel="stylesheet" href="assets/js/vendor/toastr/toastr.min.css">

        <!-- project main css files -->
        <link rel="stylesheet" href="assets/css/main.css">
        <!--/ stylesheets -->

        <script src="assets/js/vendor/modernizr/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        <!--/ modernizr -->


    </head>


    <body id="minovate" class="appWrapper">



    <!--[if lt IE 8]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->


    <div id="wrap" class="animsition">
        <input type="hidden" value="<?php echo $_SESSION['notif']; ?>" id="voirNotification">

        <div class="page page-core page-login">

            <div class="container w-420 p-15 bg-white mt-40 text-center">


                <h2 class="text-light text-primary" id="titreNotif"> Titre</h2>

                <!-- tile body -->
                <div class="tile-body text-left" id="corpsNotif">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
                <!-- /tile body -->

                <div class="form-group text-left mt-20">
                    <button class="btn btn-rounded btn-ef btn-ef-2 btn-ef-2-danger btn-ef-2b ml-0" id="uneNotifRetour"><i class="fa fa-arrow-left"></i> Retour</button>
                    <button class="btn btn-rounded btn-ef btn-ef-2 btn-ef-2-greensea btn-ef-2b mb-10 mr-5 pull-right" id="uneNotifAller"> Continuer <i class="fa fa-arrow-right"></i></button>
                </div>
            </div>

        </div>



    </div>
    <!--/ Application Content -->

    <?php
    include_once 'views/pages/alerts.php' ;
    ?>




    <!-- ============================================
    ============== Vendor JavaScripts ===============
    ============================================= -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery/jquery-1.11.2.min.js"><\/script>')</script>

    <script src="assets/js/vendor/bootstrap/bootstrap.min.js"></script>
    <script src="assets/js/vendor/jRespond/jRespond.min.js"></script>
    <script src="assets/js/vendor/sparkline/jquery.sparkline.min.js"></script>
    <script src="assets/js/vendor/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/js/vendor/animsition/js/jquery.animsition.min.js"></script>
    <script src="assets/js/vendor/screenfull/screenfull.min.js"></script>
    <script src="assets/js/vendor/toastr/toastr.min.js"></script>
    <!--/ vendor javascripts -->

    <script src="assets/js/main.js"></script>
    <!--/ custom javascripts -->

    <script src="assets/js/uneNotification.js"></script>-->
    <!--/ Page Specific Scripts -->


    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
    <script>
        (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='https://www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
        ga('create','UA-XXXXX-X','auto');ga('send','pageview');
    </script>

    </body>
    </html>
<?php
}
else{
    header('Location: login.php') ;
}
?>