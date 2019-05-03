<?php
include_once 'php/configuration/configuration.php' ;

if(isset($_SESSION['username'])){
    $participant =  (isset($_GET['addParticipant'])) ? htmlentities($_GET['addParticipant']) : NULL ;
    include_once 'views/blocks/header_1.php';
//echo $mail_webmaster ;
    ?>

    <title>ITC - Participants</title>
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
                                        <li><a href="souscripteurs.php"><i class="fa fa-caret-right"></i> Gestion des Souscripteurs</a></li>
                                        <li class="active"><a href="participants.php"><i class="fa fa-caret-right"></i> Gestion des participants</a></li>
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

                <h2>Participant </h2>

                <div class="page-bar">

                    <ul class="page-breadcrumb">
                        <li>
                            <a href="index.php"><i class="fa fa-home"></i> ITC - Admin</a>
                        </li>
                        <li>
                            <a href="participants.php"> Participant</a>
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
                        <section class="tile" id="listeParticipant">

                            <!-- tile header -->
                            <div class="tile-header dvd dvd-btm">
                                <h1 class="custom-font">Liste des <strong>Participants</strong> aux sessions</h1>
                                <ul class="controls">
                                    <?php
                                    if($_SESSION['fonction'] !== 'consultant'){
                                        ?>
                                        <li>
                                            <a role="button" tabindex="0" id="newParticipant"><i class="fa fa-plus mr-5"></i> Nouveau</a>
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
                                    <label for="filtrerParticipant" style="padding-top: 5px">Rechercher:</label>
                                    <input id="filtrerParticipant" type="text" ng-model="filtreDeParticipant" class="form-control input-sm w-sm mb-10 inline-block"/>
                                    <input type="hidden" value="<?php echo $participant ;?>" id="openAddParticipant" />
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
                                            <th>Tel</th>
                                            <th>Formation</th>
                                            <th>Session</th>
                                            <?php
                                            if($_SESSION['fonction'] === 'Administrateur'){
                                                ?>
                                                <th style="width: 160px;" class="no-sort">Actions</th>
                                            <?php
                                            }
                                            ?>
                                        </tr>
                                        </thead>
                                        <tbody ng-repeat="(cle, parts) in participants | filter:filtreDeParticipant">
                                        <tr class="odd gradeX">
                                            <td>{{cle + 1}}</td>
                                            <td>{{parts.id}}</td>
                                            <td>{{parts.nom}}</td>
                                            <td>{{parts.prenoms}}</td>
                                            <td>{{parts.email}}</td>
                                            <td>{{parts.tel}}</td>
                                            <td>{{parts.formation}}</td>
                                            <td>{{parts.typeSession}}</td>
                                            <?php
                                            if($_SESSION['fonction'] === 'Administrateur'){
                                                ?>
                                                <td><a href="#" class="btn btn-xs btn-default mr-5 editParticipant" id="{{parts.id}}"><i class="fa fa-pencil"></i></a><a href="#" id="{{parts.id}}" class="btn btn-xs btn-lightred suppParticipant"><i class="fa fa-times"></i></a></td>
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

                        <section class="tile" id="saveParticipant" hidden>
                            <!-- tile header -->
                            <div class="tile-header dvd dvd-btm">
                                <h1 class="custom-font"><strong>Nouveau Participant </strong></h1>
                                <ul class="controls">
                                    <li>
                                        <a role="button" tabindex="0" id="retourListeParticipant"><i class="fa fa-arrow-left mr-5"></i> Retour</a>
                                    </li>

                                    <li><a role="button" tabindex="0"><i></i></a></li>
                                </ul>
                            </div>
                            <!-- /tile header -->

                            <!-- tile body -->
                            <div class="tile-body">
                                <form id="formParticipant" class="form-horizontal" role="form">
                                    <label class="checkbox checkbox-custom">
                                        <input name="radioParticipant" type="radio" id="radioParticipantSous"><i></i> J'ai souscris en ligne
                                    </label>
                                    <label class="checkbox checkbox-custom">
                                        <input name="radioParticipant" type="radio" id="radioParticipantNonSous"><i></i> Je n'ai fait aucune souscription
                                    </label>
                                </form><br/><br/>

                                <form id="formParticipantSoucrit" class="form-horizontal" role="form" hidden>
                                    <div class="form-group">
                                        <label for="selectPartFormation" class="col-sm-2 control-label">Formation</label>
                                        <div class="col-sm-10">

                                            <select class="form-control mb-10" name="selectPartFormation" id="selectPartFormation">
                                                <option value="">-----</option>
                                                <option ng-repeat="form in formation" value="{{form.id}}">{{form.titre}}</option>
                                            </select>

                                        </div>
                                        <label for="selectPartSession" class="col-sm-2 control-label">Session</label>
                                        <div class="col-sm-10">

                                            <select class="form-control mb-10" name="selectPartSession" id="selectPartSession">
                                                <option value="">-----</option>
                                                <option ng-repeat="typSess in typeSessions" value="{{typSess.id}}">{{typSess.libelle}}</option>
                                            </select>

                                        </div>
                                        <label for="selectPartSouscrip" class="col-sm-2 control-label">Souscripteur</label>
                                        <div class="col-sm-10">

                                            <select class="form-control mb-10" name="selectPartSouscrip" id="selectPartSouscrip">
                                                <option value="">-----</option>
                                                <!--<option ng-repeat="techno in technology" value="{{techno.id}}">{{techno.libelle}}</option>-->
                                            </select>

                                        </div>
                                        <input type="hidden" name="sessionPartSouscriptCache" id="sessionPartSouscriptCache" />
                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-success btn-ef btn-ef-3 btn-ef-3c" id="validerPartSous"><i class="fa fa-arrow-right"></i> Enregistrer</button>
                                    </div>
                                </form>

                                <form id="formParticipantNonSoucrit" class="form-horizontal" role="form" hidden>
                                    <div class="form-group">
                                        <label for="inputTitre" class="col-sm-2 control-label">Nom</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="nomPartNonSous" id="nomPartNonSous" placeholder="Nom">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputTitre" class="col-sm-2 control-label">Pr&eacute;noms</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="prenomsPartNonSous" id="prenomsPartNonSous" placeholder="Prénoms">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputTitre" class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" name="emailPartNonSous" id="emailPartNonSous" placeholder="Email">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="selectPartFormationNonSous" class="col-sm-2 control-label">Formation</label>
                                        <div class="col-sm-10">

                                            <select class="form-control mb-10" name="selectPartFormationNonSous" id="selectPartFormationNonSous">
                                                <option value="">-----</option>
                                                <option ng-repeat="form in formation" value="{{form.id}}">{{form.titre}}</option>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="selectPartSessionNonSous" class="col-sm-2 control-label">Session</label>
                                        <div class="col-sm-10">

                                            <select class="form-control mb-10" name="selectPartSessionNonSous" id="selectPartSessionNonSous">
                                                <option value="">-----</option>
                                                <option ng-repeat="typSess in typeSessions" value="{{typSess.id}}">{{typSess.libelle}}</option>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputTitre" class="col-sm-2 control-label">T&eacute;l&eacute;phone</label>
                                        <div class="col-sm-10">
                                            <input type="tel" class="form-control" name="telPartNonSous" id="telPartNonSous" placeholder="(+XXX) XXXXXXXX">
                                        </div>
                                    </div>



                                    <div class="modal-footer">
                                        <button class="btn btn-success btn-ef btn-ef-3 btn-ef-3c" id="validerPartNonSous"><i class="fa fa-arrow-right"></i> Enregistrer</button>
                                    </div>
                                </form>

                            </div>
                            <!-- /tile body -->

                        </section>

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
    <div class="modal fade" id="participantModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-center" id="participantModalTitle"><strong>Modal title</strong></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="participantModalBody">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" id="participantBtnModalNon" class="btn btn-secondary" data-dismiss="modal"> Non</button>
                    <button type="button" id="participantBtnModalOui" class="btn btn-primary"> Oui</button>
                </div>
            </div>
        </div>
    </div>

    <?php
    include_once'views/pages/alerts.php' ;
    include_once 'views/blocks/footer.php';
    ?>

    <script src="assets/js/participant.js"></script>
    <!--/ Page Specific Scripts -->
    </body>
    </html>
<?php
}
else{
    header('Location: login.php') ;
}
?>