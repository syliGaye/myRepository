<?php
include_once 'php/configuration/configuration.php' ;

if(isset($_SESSION['username'])){
    include_once 'views/blocks/header_1.php';
//echo $mail_webmaster ;
    ?>

    <title>ITC - Souscripteurs</title>
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
                                <li><a href="index.php"><i class="fa fa-dashboard"></i> <span>Tableau de bord</span></a></li>
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
                                <li class="active open">
                                    <a role="button" tabindex="0"><i class="fa fa-certificate"></i> <span>Participants</span></a>
                                    <ul>
                                        <li class="active"><a href="souscripteurs.php"><i class="fa fa-caret-right"></i> Gestion des Souscripteurs</a></li>
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


    <section id="content">

        <div class="page page-shop-products">

            <div class="pageheader">

                <h2>Souscripteur </h2>

                <div class="page-bar">

                    <ul class="page-breadcrumb">
                        <li>
                            <a href="index.php"><i class="fa fa-home"></i> ITC - Admin</a>
                        </li>
                        <li>
                            <a href="souscripteurs.php"> Souscripteur</a>
                        </li>
                    </ul>

                </div>

            </div>

            <!-- page content -->
            <div class="pagecontent">


                <!-- row -->
                <div class="row">
                    <!-- col -->
                    <div class="col-md-12">


                        <!-- tile -->
                        <section class="tile" id="listeSouscripteur">

                            <!-- tile header -->
                            <div class="tile-header dvd dvd-btm">
                                <h1 class="custom-font">Liste des <strong>Souscripteurs</strong></h1>

                            </div>
                            <!-- /tile header -->

                            <!-- tile body -->
                            <div class="tile-body">

                                <div class="form-group">
                                    <label for="filtrerSouscrip" style="padding-top: 5px">Rechercher:</label>
                                    <input id="filtrerSouscrip" type="text" ng-model="filtreDeSouscrip" class="form-control input-sm w-sm mb-10 inline-block"/>
                                </div>

                                <div class="table-responsive">
                                    <table id="searchTextResults" data-page-size="5" class="footable table table-custom">
                                        <thead>
                                        <tr>
                                            <th style="width:60px;">#</th>
                                            <th style="width:90px;">Id</th>
                                            <th>Nom</th>
                                            <th>Pr&eacute;noms</th>
                                            <th>Email</th>
                                            <th>Telepnone</th>
                                            <th>Type Session</th>
                                            <th>Formation</th>
                                            <!--<th style="width: 160px;" class="no-sort">Actions</th>-->
                                        </tr>
                                        </thead>
                                        <tbody ng-repeat="(cle, sous) in souscripteurs | filter:filtreDeSouscrip">
                                        <tr class="odd gradeX">
                                            <td>{{cle + 1}}</td>
                                            <td>{{sous.id}}</td>
                                            <td>{{sous.nom}}</td>
                                            <td>{{sous.prenoms}}</td>
                                            <td>{{sous.email}}</td>
                                            <td>{{sous.tel}}</td>
                                            <td>{{sous.typeSession}}</td>
                                            <td>{{sous.formation}}</td>
                                            <!--<td><a>&nbsp;&nbsp;&nbsp;&nbsp;</a><a href="#" id="{{sous.id}}" class="btn btn-xs btn-lightred suppSouscrip"><i class="fa fa-times"></i></a></td>-->
                                        </tr>
                                        </tbody>
                                        <tfoot class="hide-if-no-paging">
                                        <tr>
                                            <td colspan="5" class="text-center">
                                                <ul class="pagination"></ul>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <!-- /tile body -->


                        </section>
                        <!-- /tile -->

                    </div>
                    <!-- /col -->
                </div>
                <!-- /row -->


            </div>
            <!-- /page content -->

        </div>

    </section>
    <!--/ CONTENT -->

    </div>
    <!--/ Application Content -->

    <!-- Modal -->
    <div class="modal fade" id="souscripteurModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-center" id="souscripteurModalTitle"><strong>Modal title</strong></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="souscripteurModalBody">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" id="souscripteurBtnModalNon" class="btn btn-secondary" data-dismiss="modal"> Non</button>
                    <button type="button" id="souscripteurBtnModalOui" class="btn btn-primary"> Oui</button>
                </div>
            </div>
        </div>
    </div>

    <?php
    include_once'views/pages/alerts.php' ;
    include_once 'views/blocks/footer.php';
    ?>

    <script src="assets/js/souscripteur.js"></script>
    <!--/ Page Specific Scripts -->
    </body>
    </html>
<?php
}
else{
    header('Location: login.php') ;
}
?>