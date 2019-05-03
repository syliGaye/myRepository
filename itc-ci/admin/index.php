<?php
include_once 'php/configuration/configuration.php' ;

//echo $_SESSION['username'] ;

if(isset($_SESSION['username'])){
include_once 'views/blocks/header_1.php';
?>

<title>ITC | Tableau de bord</title>
</head>
<?php
include_once 'views/blocks/header.php';
?>

<!-- ================================================
                ================= SIDEBAR Content ===================
                ================================================= -->
<aside id="sidebar">


<div id="sidebar-wrap">

<div class="panel-group slim-scroll" role="tablist">
<div class="panel panel-default">
    <div class="panel-heading" role="tab">
        <h4 class="panel-title">
            <a data-toggle="collapse" href="#sidebarNav">
                Navigation <i class="fa fa-angle-up"></i>
            </a>
        </h4>
    </div>
    <div id="sidebarNav" class="panel-collapse collapse in" role="tabpanel">
        <div class="panel-body">


            <!-- ===================================================
            ================= NAVIGATION Content ===================
            ==================================================== -->
            <ul id="navigation">
                <li class="active"><a href="index.php"><i class="fa fa-dashboard"></i> <span>Tableau de bord</span></a></li>
                <?php
                if($_SESSION['fonction'] !== 'Administrateur'){

                    ?>
                    <li><a href="compteConsultant.php" tabindex="0"><i class="fa fa-briefcase"></i> <span>Comptes Utilisateurs</span></a></li>
                    <?php
                }
                else{
                    ?>
                    <li>
                        <a role="button" tabindex="0"><i class="fa fa-briefcase"></i> <span>Administration</span></a>
                        <ul>
                            <li><a href="page_404.php"><i class="fa fa-caret-right"></i> Parametrage</a></li>
                            <li><a href="compteConsultant.php"><i class="fa fa-caret-right"></i> Gestion des comptes</a></li>
                        </ul>
                    </li>
                    <?php
                }
                ?>
                <li>
                    <a role="button" tabindex="0"><i class="fa fa-gears"></i> <span>Param&egrave;tres G&eacute;n&eacute;raux</span></a>
                    <ul>
                        <li><a href="domaine.php"><i class="fa fa-caret-right"></i> Domaines</a></li>
                        <li><a href="technologie.php"><i class="fa fa-caret-right"></i> Technologies</a></li>
                        <li><a href="typeSession.php"><i class="fa fa-caret-right"></i> Type Session</a></li>
                    </ul>
                </li>
                <li>
                    <a role="button" tabindex="0"><i class="fa fa-graduation-cap"></i> <span>Formation</span> <!--<span class="label label-success">new</span>--></a>
                    <ul>
                        <li><a href="session.php"><i class="fa fa-caret-right"></i> Sessions de formation</a></li>
                        <li><a href="formation.php"><i class="fa fa-caret-right"></i> Gestion des formation</a></li>
                    </ul>
                </li>
                <li><a href="consultant.php"><i class="fa fa-users"></i> <span> Gestion des consultants</span></a></li>
                <li>
                    <a role="button" tabindex="0"><i class="fa fa-certificate"></i> <span>Participants</span></a>
                    <ul>
                        <li><a href="souscripteurs.php"><i class="fa fa-caret-right"></i> Gestion des Souscripteurs</a></li>
                        <li><a href="participants.php"><i class="fa fa-caret-right"></i> Gestion des participants</a></li>
                    </ul>
                </li>
            </ul>
            <!--/ NAVIGATION Content -->


        </div>
    </div>
</div>
</div>

</div>


</aside>
<!--/ SIDEBAR Content -->


</div>
<!--/ CONTROLS Content -->




<!-- ====================================================
================= CONTENT ===============================
===================================================== -->
<section id="content">
<div class="page page-dashboard">

<div class="pageheader">

    <h2>Tableau de bord</h2>

    <div class="page-bar">

        <ul class="page-breadcrumb">
            <li>
                <a href="index.php"><i class="fa fa-home"></i> ITC - Admin</a>
            </li>
            <li>
                <a href="index.php">Tableau de bord</a>
            </li>
        </ul>

    </div>

</div>
<?php
if($_SESSION['fonction'] === 'consultant'){
    ?>
    <!-- cards row -->
    <div class="row">

        <!-- col -->
        <div class="card-container col-lg-3 col-sm-6 col-sm-12">
            <div class="card">
                <div class="front bg-blue">

                    <!-- row -->
                    <div class="row">
                        <!-- col -->
                        <div class="col-xs-4">
                            <i class="fa fa-graduation-cap fa-4x"></i>
                        </div>
                        <!-- /col -->
                        <!-- col -->
                        <div class="col-xs-8">
                            <p class="text-elg text-strong mb-0"> {{formation.length}}</p>
                            <span>Formation(s)</span>
                        </div>
                        <!-- /col -->
                    </div>
                    <!-- /row -->

                </div>
                <div class="back bg-blue">

                    <!-- row -->
                    <div class="row">

                        <!-- col -->
                        <div>
                            <a href='formation.php'><i class="fa fa-eye fa-2x"></i> Afficher</a>
                        </div>
                        <!-- /col -->
                    </div>
                    <!-- /row -->

                </div>
            </div>
        </div>
        <!-- /col -->

        <!-- col -->
        <div class="card-container col-lg-3 col-sm-6 col-sm-12">

            <div class="card">
                <div class="front bg-slategray">

                    <!-- row -->
                    <div class="row">
                        <!-- col -->
                        <div class="col-xs-4">
                            <i class="fa fa-tag fa-4x"></i>
                        </div>
                        <!-- /col -->
                        <!-- col -->
                        <div class="col-xs-8">
                            <p class="text-elg text-strong mb-0">{{sessionsCours.length}}</p>
                            <span>Session(s)</span>
                        </div>
                        <!-- /col -->
                    </div>
                    <!-- /row -->

                </div>
                <div class="back bg-slategray">

                    <!-- row -->
                    <div class="row">
                        <!-- col -->
                        <div>
                            <a href='session.php'><i class="fa fa-eye fa-2x"></i> Afficher</a>
                        </div>
                        <!-- /col -->
                    </div>
                    <!-- /row -->

                </div>
            </div>
        </div>
        <!-- /col -->

        <!-- col -->
        <div class="card-container col-lg-3 col-sm-6 col-sm-12">
            <div class="card">
                <div class="front bg-blue">

                    <!-- row -->
                    <div class="row">
                        <!-- col -->
                        <div class="col-xs-4">
                            <i class="fa fa-certificate fa-4x"></i>
                        </div>
                        <!-- /col -->
                        <!-- col -->
                        <div class="col-xs-8">
                            <p class="text-elg text-strong mb-0">{{participants.length}}</p>
                            <span>Participant(s)</span>
                        </div>
                        <!-- /col -->
                    </div>
                    <!-- /row -->

                </div>
                <div class="back bg-blue">

                    <!-- row -->
                    <div class="row">
                        <!-- col -->
                        <div>
                            <a href="participants.php"><i class="fa fa-eye fa-2x"></i> Afficher</a>
                        </div>
                        <!-- /col -->
                    </div>
                    <!-- /row -->

                </div>
            </div>
        </div>
        <!-- /col -->

        <!-- col -->
        <div class="card-container col-lg-3 col-sm-6 col-sm-12">
            <div class="card">
                <div class="front bg-slategray">

                    <!-- row -->
                    <div class="row">
                        <!-- col -->
                        <div class="col-xs-4">
                            <i class="fa fa-users fa-4x"></i>
                        </div>
                        <!-- /col -->
                        <!-- col -->
                        <div class="col-xs-8">
                            <p class="text-elg text-strong mb-0">{{consults.length}}</p>
                            <span>Consultant(s)</span>
                        </div>
                        <!-- /col -->
                    </div>
                    <!-- /row -->

                </div>
                <div class="back bg-slategray">

                    <!-- row -->
                    <div class="row">
                        <!-- col -->
                        <div>
                            <a href="consultant.php"><i class="fa fa-eye fa-2x"></i> Afficher</a>
                        </div>
                        <!-- /col -->
                    </div>
                    <!-- /row -->

                </div>
            </div>
        </div>
        <!-- /col -->

    </div>
    <!-- /row -->
<?php
}
else{
    ?>
    <!-- cards row -->
    <div class="row">

        <!-- col -->
        <div class="card-container col-lg-3 col-sm-6 col-sm-12">
            <div class="card">
                <div class="front bg-blue">

                    <!-- row -->
                    <div class="row">
                        <!-- col -->
                        <div class="col-xs-4">
                            <i class="fa fa-graduation-cap fa-4x"></i>
                        </div>
                        <!-- /col -->
                        <!-- col -->
                        <div class="col-xs-8">
                            <p class="text-elg text-strong mb-0"> {{formation.length}}</p>
                            <span>Formation(s)</span>
                        </div>
                        <!-- /col -->
                    </div>
                    <!-- /row -->

                </div>
                <div class="back bg-blue">

                    <!-- row -->
                    <div class="row">
                        <!-- col -->
                        <div class="col-xs-6">
                            <a href="formation.php?addFormation=add"><i class="fa fa-plus fa-2x"></i> Ajouter</a>
                        </div>
                        <!-- /col -->
                        <!-- col -->
                        <div class="col-xs-6">
                            <a href='formation.php'><i class="fa fa-eye fa-2x"></i> Afficher</a>
                        </div>
                        <!-- /col -->
                    </div>
                    <!-- /row -->

                </div>
            </div>
        </div>
        <!-- /col -->

        <!-- col -->
        <div class="card-container col-lg-3 col-sm-6 col-sm-12">

            <div class="card">
                <div class="front bg-slategray">

                    <!-- row -->
                    <div class="row">
                        <!-- col -->
                        <div class="col-xs-4">
                            <i class="fa fa-tag fa-4x"></i>
                        </div>
                        <!-- /col -->
                        <!-- col -->
                        <div class="col-xs-8">
                            <p class="text-elg text-strong mb-0">{{sessionsCours.length}}</p>
                            <span>Session(s)</span>
                        </div>
                        <!-- /col -->
                    </div>
                    <!-- /row -->

                </div>
                <div class="back bg-slategray">

                    <!-- row -->
                    <div class="row">
                        <!-- col -->
                        <div class="col-xs-6">
                            <a href='session.php?addSession=add'><i class="fa fa-plus fa-2x"></i> Ajouter</a>
                        </div>
                        <!-- /col -->
                        <!-- col -->
                        <div class="col-xs-6">
                            <a href='session.php'><i class="fa fa-eye fa-2x"></i> Afficher</a>
                        </div>
                        <!-- /col -->
                    </div>
                    <!-- /row -->

                </div>
            </div>
        </div>
        <!-- /col -->

        <!-- col -->
        <div class="card-container col-lg-3 col-sm-6 col-sm-12">
            <div class="card">
                <div class="front bg-blue">

                    <!-- row -->
                    <div class="row">
                        <!-- col -->
                        <div class="col-xs-4">
                            <i class="fa fa-certificate fa-4x"></i>
                        </div>
                        <!-- /col -->
                        <!-- col -->
                        <div class="col-xs-8">
                            <p class="text-elg text-strong mb-0">{{participants.length}}</p>
                            <span>Participant(s)</span>
                        </div>
                        <!-- /col -->
                    </div>
                    <!-- /row -->

                </div>
                <div class="back bg-blue">

                    <!-- row -->
                    <div class="row">
                        <!-- col -->
                        <div class="col-xs-6">
                            <a href='participants.php?addParticipant=add'><i class="fa fa-plus fa-2x"></i> Ajouter</a>
                        </div>
                        <!-- /col -->
                        <!-- col -->
                        <div class="col-xs-6">
                            <a href="participants.php"><i class="fa fa-eye fa-2x"></i> Afficher</a>
                        </div>
                        <!-- /col -->
                    </div>
                    <!-- /row -->

                </div>
            </div>
        </div>
        <!-- /col -->

        <!-- col -->
        <div class="card-container col-lg-3 col-sm-6 col-sm-12">
            <div class="card">
                <div class="front bg-slategray">

                    <!-- row -->
                    <div class="row">
                        <!-- col -->
                        <div class="col-xs-4">
                            <i class="fa fa-users fa-4x"></i>
                        </div>
                        <!-- /col -->
                        <!-- col -->
                        <div class="col-xs-8">
                            <p class="text-elg text-strong mb-0">{{consults.length}}</p>
                            <span>Consultant(s)</span>
                        </div>
                        <!-- /col -->
                    </div>
                    <!-- /row -->

                </div>
                <div class="back bg-slategray">

                    <!-- row -->
                    <div class="row">
                        <!-- col -->
                        <div class="col-xs-6">
                            <a href='consultant.php?addConsultant=add'><i class="fa fa-plus fa-2x"></i> Ajouter</a>
                        </div>
                        <!-- /col -->
                        <!-- col -->
                        <div class="col-xs-6">
                            <a href="consultant.php"><i class="fa fa-eye fa-2x"></i> Afficher</a>
                        </div>
                        <!-- /col -->
                    </div>
                    <!-- /row -->

                </div>
            </div>
        </div>
        <!-- /col -->

    </div>
    <!-- /row -->
<?php
}
?>

<!-- row -->
<div class="row">



    <!-- col -->
    <div>

        <!-- tile -->
        <section>


            <!-- tile body -->
            <div>

                <!-- row -->
                <div class="row">
                    <div class="text-center"><h3 class="text-light text-white"><span class="text-lightred"><img src="assets/images/logo_itc.jpg" class="img-container" style="width: 20%;" alt=""></h3></div>
                </div>
                <!-- /row -->

            </div>
            <!-- /tile body -->

        </section>
        <!-- /tile -->

    </div>
    <!-- /col -->

</div>
<!-- /row -->


</div>
</section>
<!--/ CONTENT -->






</div>
<!--/ Application Content -->

<?php
include_once 'views/blocks/footer.php';
?>
<script src="assets/js/indexs.js"></script>
</body>
</html>
<?php
}
else{
    header('Location: login.php') ;
}
?>