<?php
include_once 'php/configuration/configuration.php' ;

if(isset($_SESSION['username'])){
    $session = (isset($_GET['addSession'])) ? htmlentities($_GET['addSession']) : NULL ;
    include_once 'views/blocks/header_1.php';
//echo $mail_webmaster ;
    ?>

    <title>ITC - Sessions de Formation</title>
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
                                <li class="active open">
                                    <a role="button" tabindex="0"><i class="fa fa-graduation-cap"></i> <span>Formation</span> <!--<span class="label label-success">new</span>--></a>
                                    <ul>
                                        <li class="active"><a href="session.php"><i class="fa fa-caret-right"></i> Sessions de formation</a></li>
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


    <section id="content">

        <div class="page page-shop-products">

            <div class="pageheader">

                <h2>Sessions </h2>

                <div class="page-bar">

                    <ul class="page-breadcrumb">
                        <li>
                            <a href="index.php"><i class="fa fa-home"></i> ITC - Admin</a>
                        </li>
                        <li>
                            <a href="#">Formation</a>
                        </li>
                        <li>
                            <a href="session.php"> Sessions de Formation</a>
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
                        <section class="tile" id="listSession">

                            <!-- tile header -->
                            <div class="tile-header dvd dvd-btm">
                                <h1 class="custom-font">Liste des <strong>Sessions</strong></h1>
                                <ul class="controls">
                                    <?php
                                    if($_SESSION['fonction'] !== 'consultant'){
                                        ?>
                                        <li><a href="#" id="newSession"><i class="fa fa-plus mr-5"></i> Nouveau</a></li>
                                    <?php
                                    }
                                    ?>

                                    <li><a role="button" tabindex="0" ><i ></i></a></li>
                                </ul>
                            </div>
                            <!-- /tile header -->

                            <!-- tile body -->
                            <div class="tile-body">
                                <div class="form-group">
                                    <label for="filtrerSession" style="padding-top: 5px">Rechercher:</label>
                                    <input id="filtrerSession" type="text" ng-model="filtreDeSession" class="form-control input-sm w-sm mb-10 inline-block"/>
                                    <input type="hidden" value="<?php echo $session; ?>" id="openAddSession" />
                                </div>

                                <table id="searchTextResults" data-page-size="5" class="footable table table-custom">
                                    <thead>
                                    <tr>
                                        <th style="width:60px;"></th>
                                        <th style="width:60px;">#</th>
                                        <th style="width:90px;">Id</th>
                                        <th>Formation</th>
                                        <th>Consultant</th>
                                        <th>Type de Session</th>
                                        <th>Date de D&eacute;but</th>
                                        <th>Date de Fin</th>
                                        <th>Dur&eacute;e (en heures)</th>
                                        <th>Prix</th>
                                        <th>Places disponibles</th>
                                        <th>Reservations</th>
                                        <th>Nbre de Participants</th>
                                        <?php
                                        if($_SESSION['fonction'] === 'Administrateur'){
                                            ?>
                                            <th style="width:150px;" class="no-sort">Actions</th>
                                        <?php
                                        }
                                        ?>
                                    </tr>
                                    </thead>
                                    <tbody ng-repeat="(cle, ssc) in sessionsCours | filter:filtreDeSession">
                                    <tr>
                                        <td><a href="#" class="btn btn-xs btn-default mr-5 ********************************************************************************************************************************************************************************************************" id="{{ssc.idSession}}"><i class="fa fa-eye"></i></a></td>
                                        <td>{{cle + 1}}</td>
                                        <td>{{ssc.idSession}}</td>
                                        <td>{{ssc.titre}}</td>
                                        <td>{{ssc.consultant}}</td>
                                        <td>{{ssc.libTypeSession}}</td>
                                        <td>{{ssc.dateDebut}}</td>
                                        <td>{{ssc.dateFin}}</td>
                                        <td>{{ssc.dureeSession}}</td>
                                        <td>{{ssc.prix}}</td>
                                        <td>{{ssc.nbreDePlaces}}</td>
                                        <td>{{ssc.reservation}}</td>
                                        <td>{{ssc.participants}}</td>
                                        <?php
                                        if($_SESSION['fonction'] === 'Administrateur'){
                                            ?>
                                            <td><a href="#" class="btn btn-xs btn-default mr-5 editSession" id="{{ssc.idSession}}"><i class="fa fa-pencil"></i></a><a href="#" id="{{ssc.idSession}}" class="btn btn-xs btn-lightred suppSession"><i class="fa fa-times"></i></a></td>
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
                            <!-- /tile body -->

                        </section>
                        <!-- /tile -->


                        <section class="tile" id="saveSession" hidden>

                            <!-- tile header -->
                            <div class="tile-header dvd dvd-btm">
                                <h1 class="custom-font"><strong id="titreSaveSession">Nouvelle Session </strong></h1>
                                <ul class="controls">

                                    <li><a role="button" tabindex="0"><i></i></a></li>
                                </ul>
                            </div>
                            <!-- /tile header -->

                            <!-- tile body -->
                            <div class="tile-body">

                                <form id="formSession" class="form-horizontal" role="form">
                                    <input type="hidden" name="idSessionCache" id="idSessionCache">


                                    <div class="form-group">
                                        <label for="selectFormationSession" class="col-sm-2 control-label">Formation</label>
                                        <div class="col-sm-10">

                                            <select class="form-control mb-10" name="selectFormationSession" id="selectFormationSession">
                                                <option value="">-----</option>
                                                <option ng-repeat="forma in formation" id="{{forma.id}}" value="{{forma.id}}">{{forma.titre}}</option>
                                            </select>
                                            <p class="help-block mb-0"><a href="formation.php?addFormation=add"> <strong> Nouvelle Formation</strong></a></p>
                                        </div>
                                    </div><br/>

                                    <div class="form-group">
                                        <label for="selectConsultantSession" class="col-sm-2 control-label">Consultant</label>
                                        <div class="col-sm-10">

                                            <select class="form-control mb-10" name="selectConsultantSession" id="selectConsultantSession">
                                                <option value="">-----</option>
                                                <option ng-repeat="consul in consults" value="{{consul.id}}">{{consul.prenoms}}&nbsp;&nbsp;{{consul.nom}}</option>
                                            </select>
                                            <p class="help-block mb-0"><a href="consultant.php?addConsultant=add"> <strong> Nouveau Consultant</strong></a></p>
                                        </div>
                                    </div><br/>

                                    <div class="form-group">
                                        <label for="selectTypeSessionSession" class="col-sm-2 control-label">Type Session</label>
                                        <div class="col-sm-10">

                                            <select class="form-control mb-10" name="selectTypeSessionSession" id="selectTypeSessionSession">
                                                <option value="">-----</option>
                                                <option ng-repeat="tps in typeSessions" value="{{tps.id}}">{{tps.libelle}}</option>
                                            </select>
                                            <p class="help-block mb-0"><a href="typeSession.php?addTypeSession=add"> <strong> Nouveau Type Session</strong></a></p>
                                        </div>
                                    </div><br/>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="nbreDeSemaine">Nombre de Semaines</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="1" name="nbreDeSemaine" id="nbreDeSemaine" class="form-control touchspin" data-min='1' data-verticalbuttons="true">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="nbreHeureSession" class="col-sm-2 control-label">Nombre d'heures</label>
                                        <div class="col-sm-10">
                                            <output type="text" class="form-control" name="nbreHeureSession" id="nbreHeureSession" disabled>0</output>
                                            <input type="hidden" name="nbreHeureSessionCache" id="nbreHeureSessionCache"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="prixSession" class="col-sm-2 control-label">Prix de la Session</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="prixSession" id="prixSession" placeholder="F CFA (en chiffres)">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label" for="placesPrevueSession"> Places Pr&eacute;vues</label>
                                        <div class="col-sm-10">
                                            <input type="text" value="10" id="placesPrevueSession" name="placesPrevueSession" class="form-control touchspin" data-min='1' data-verticalbuttons="true">
                                            <input type="hidden" name="idPP" id="idPP">
                                        </div>
                                    </div>
                                </form>

                                <div class="modal-footer">
                                    <button class="btn btn-success btn-ef btn-ef-3 btn-ef-3c" id="validerSession"><i class="fa fa-arrow-right"></i> Enregistrer</button>
                                    <button class="btn btn-lightred btn-ef btn-ef-4 btn-ef-4c" data-dismiss="modal" id="retourListeSession"><i class="fa fa-arrow-left"></i> Retour</button>
                                </div>

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
    <div class="modal fade" id="sessionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-center" id="sessionModalTitle"><strong>Modal title</strong></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="sessionModalBody">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" id="sessionBtnModalNon" class="btn btn-secondary" data-dismiss="modal"> Non</button>
                    <button type="button" id="sessionBtnModalOui" class="btn btn-primary"> Oui</button>
                </div>
            </div>
        </div>
    </div>


    <?php
    include_once'views/pages/alerts.php' ;
    include_once 'views/blocks/footer.php';
    ?>

    <script src="assets/js/session.js"></script>
    <!--/ Page Specific Scripts -->
    </body>
    </html>
<?php
}
else{
    header('Location: login.php') ;
}
?>