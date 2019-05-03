<?php
include_once 'php/configuration/configuration.php' ;

//echo $_SESSION['username'] ;

if(isset($_SESSION['username'])){
    include_once 'views/blocks/header_1.php';
    ?>

    <title>ITC | Gestion des comptes</title>
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
                                    <li class="active"><a href="compteConsultant.php" tabindex="0"><i class="fa fa-briefcase"></i> <span>Comptes Utilisateurs</span></a></li>
                                <?php
                                }
                                else{
                                    ?>
                                    <li class="active open">
                                        <a role="button" tabindex="0"><i class="fa fa-briefcase"></i> <span>Administration</span></a>
                                        <ul>
                                            <li><a href="page_404.php"><i class="fa fa-caret-right"></i> Parametrage</a></li>
                                            <li class="active"><a href="compteConsultant.php"><i class="fa fa-caret-right"></i> Gestion des comptes</a></li>
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

    <!--/ CONTENT -->
    <section id="content">

    <div class="page page-shop-products">

    <div class="pageheader">

        <h2>Gestion des Utilisateurs </h2>

        <div class="page-bar">

            <ul class="page-breadcrumb">
                <li>
                    <a href="index.php"><i class="fa fa-home"></i> ITC - Admin</a>
                </li>
                <li>
                    <a href="compteConsultant.php"> Utilisateurs</a>
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
        <section class="tile" id="listeUtilisateur">

            <!-- tile header -->
            <div class="tile-header dvd dvd-btm">
                <h1 class="custom-font">Liste des <strong>Utilisateurs</strong></h1>
                <ul class="controls">
                    <?php
                    if($_SESSION['fonction'] === 'Administrateur'){
                        ?>
                        <li>
                            <a role="button" tabindex="0" id="newUtilisateur"><i class="fa fa-plus mr-5"></i> Nouveau</a>
                        </li>
                    <?php
                    }
                    ?>

                    <li><a role="button" tabindex="0"><i></i></a></li>
                </ul>
            </div>
            <!-- /tile header -->

            <!-- tile body -->
            <div class="tile-body">

                <div class="form-group">
                    <label for="filtrerUtilisateur" style="padding-top: 5px">Rechercher:</label>
                    <input id="filtrerUtilisateur" type="text" ng-model="filtreDeUtilisateur" class="form-control input-sm w-sm mb-10 inline-block"/>
                </div>

                <div class="table-responsive">
                    <table id="searchTextResults" data-page-size="5" class="footable table table-custom">
                        <thead>
                        <tr>
                            <th style="width:60px;">#</th>
                            <th style="width:90px;">Id</th>
                            <th>Nom</th>
                            <th>Pr&eacute;noms</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>T&eacute;l&eacute;phone</th>
                            <th>Fonction</th>
                            <?php
                            if($_SESSION['fonction'] === 'Administrateur'){
                                ?>
                                <th style="width: 160px;" class="no-sort">Actions</th>
                            <?php
                            }
                            ?>
                        </tr>
                        </thead>
                        <tbody ng-repeat="(cle, user) in users | filter:filtreDeUtilisateur">
                        <tr class="odd gradeX">
                            <td>{{cle + 1}}</td>
                            <td>{{user.id}}</td>
                            <td>{{user.nom}}</td>
                            <td>{{user.prenoms}}</td>
                            <td>{{user.nomUtilisateur}}</td>
                            <td>{{user.mail}}</td>
                            <td>{{user.phone}}</td>
                            <td>{{user.fonction}}</td>
                            <?php
                            if($_SESSION['fonction'] === 'Administrateur'){
                                ?>
                                <td><a href="#" id="{{parts.id}}" class="btn btn-xs btn-lightred suppUtilisateur"><i class="fa fa-times"></i></a></td>
                            <?php
                            }
                            ?>
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

        <section class="tile" id="saveUtilisateur" hidden>
            <!-- tile header -->
            <div class="tile-header dvd dvd-btm">
                <h1 class="custom-font"><strong>Nouvel Utilisateur </strong></h1>
                <ul class="controls">
                    <li><a role="button" tabindex="0"><i></i></a></li>
                </ul>
            </div>
            <!-- /tile header -->

            <!-- tile body -->
            <div class="tile-body">
                <form name="formUtilisateur" role="form" id="formUtilisateur">

                    <div class="form-group">
                        <label for="utilisateurUsername">Nom Utilisateur: </label>
                        <input type="text" name="utilisateurUsername" id="utilisateurUsername" class="form-control"
                               data-parsley-trigger="change"
                               data-parsley-range="[6, 20]"
                               required>
                    </div>

                    <div class="row">

                        <div class="form-group col-md-6">
                            <label for="utilisateurPass">Mot de Passe: </label>
                            <input type="password" name="utilisateurPass" id="utilisateurPass" class="form-control"
                                   data-parsley-trigger="change"
                                   data-parsley-range="[6, 20]"
                                   required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="utilisateurPassConfirm">V&eacute;rifier Mot de Passe: </label>
                            <input type="password" name="utilisateurPassConfirm" id="utilisateurPassConfirm" class="form-control"
                                   data-parsley-trigger="change"
                                   data-parsley-range="[6, 20]"
                                   data-parsley-equalto="#password"
                                   required>
                        </div>

                    </div>

                    <hr class="line-dashed line-full" />

                    <div class="checkbox row">
                        <div class="col-md-6">
                            <label class="checkbox checkbox-custom">
                                <input name="jeSuisConsultant" id="jeSuisConsultantOui" value="oui" type="radio"><i></i> Je suis un <strong>Consultant</strong>
                            </label>
                        </div>

                        <div class="col-md-6">
                            <label class="checkbox checkbox-custom">
                                <input name="jeSuisConsultant" id="jeSuisConsultantNon" value="non" type="radio"><i></i> Je ne suis pas <strong>Consultant</strong>
                            </label>
                        </div>
                    </div>

                    <hr class="line-dashed line-full" />
                    <input type="hidden" name="userSelectConsult" id="userSelectConsult"/>

                    <div id="autreUsers" hidden>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="utilisateurNom">Nom: </label>
                                <input type="text" name="utilisateurNom" id="utilisateurNom" class="form-control" placeholder="Nom">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="utilisateurPrenom">Pr&eacute;noms: </label>
                                <input type="text" name="utilisateurPrenom" id="utilisateurPrenom" class="form-control" placeholder="Prénoms">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="utilisateurEmail">Email: </label>
                                <input type="email" name="utilisateurEmail" id="utilisateurEmail" class="form-control"
                                       data-parsley-trigger="change"
                                       placeholder="Email">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="utilisateurPhone">Phone: </label>
                                <input type="text" name="utilisateurPhone" id="utilisateurPhone" class="form-control" placeholder="(XXX) XXXX XXX"
                                       data-parsley-trigger="change"
                                       pattern="^[\d\+\-\.\(\)\/\s]*$">
                            </div>
                        </div>

                    </div>


                    <div id="iAmConsultant" hidden>
                        <label class="col-sm-3 control-label">Consultants: </label>
                        <select name="utilisateurSelectConsultant" id="utilisateurSelectConsultant" class="form-control mb-10"
                                data-parsley-trigger="change">
                            <option value="">Choisir Consultant...</option>
                            <option ng-repeat="cons in consults" value="{{cons.id}}">{{cons.nom}} {{cons.prenoms}}  "<{{cons.email}}>"</option>
                        </select>
                    </div>

                </form>

            </div>
            <!-- /tile body -->

            <!-- tile footer -->
            <div class="tile-footer text-right bg-tr-black lter dvd dvd-top">
                <button class="btn btn-success btn-ef btn-ef-3 btn-ef-3c" id="validerUtilisateur"><i class="fa fa-arrow-right"></i> Enregistrer</button>
                <button class="btn btn-lightred btn-ef btn-ef-4 btn-ef-4c" data-dismiss="modal" id="retourListeUtilisateur"><i class="fa fa-arrow-left"></i> Retour</button>
            </div>
            <!-- /tile footer -->

        </section>

    </div>
    <!-- /col -->
    </div>
    <!-- /row -->


    </div>
    <!-- /page content -->

    </div>

    </section>





    </div>
    <!--/ Application Content -->

    <?php
    include_once'views/pages/alerts.php' ;
    include_once 'views/blocks/footer.php';
    ?>
    <script src="assets/js/compteConsultant.js"></script>
    </body>
    </html>
<?php
}
else{
    header('Location: login.php') ;
}
?>