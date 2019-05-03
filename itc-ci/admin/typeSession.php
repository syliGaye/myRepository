<?php
include_once 'php/configuration/configuration.php' ;

if(isset($_SESSION['username'])){
    $typeSession =  (isset($_GET['addTypeSession'])) ? htmlentities($_GET['addTypeSession']) : NULL ;
    include_once 'views/blocks/header_1.php';
//echo $mail_webmaster ;
    ?>

    <title>ITC - Type de Session</title>
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
                                <li class="active open">
                                    <a role="button" tabindex="0"><i class="fa fa-gears"></i> <span>Param&egrave;tres G&eacute;n&eacute;raux</span></a>
                                    <ul>
                                        <li><a href="domaine.php"><i class="fa fa-caret-right"></i> Domaines</a></li>
                                        <li><a href="technologie.php"><i class="fa fa-caret-right"></i> Technologies</a></li>
                                        <li class="active"><a href="typeSession.php"><i class="fa fa-caret-right"></i> Type Session</a></li>
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


    <section id="content">

        <div class="page page-shop-products">

            <div class="pageheader">

                <h2>Formation </h2>

                <div class="page-bar">

                    <ul class="page-breadcrumb">
                        <li>
                            <a href="index.php"><i class="fa fa-home"></i> ITC - Admin</a>
                        </li>
                        <li>
                            <a href="#">Param&egrave;tres G&eacute;n&eacute;raux</a>
                        </li>
                        <li>
                            <a href="typeSession.php"> Type Session</a>
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
                        <section class="tile" id="listeTypeSession">

                            <!-- tile header -->
                            <div class="tile-header dvd dvd-btm">
                                <h1 class="custom-font">Les <strong>Types de Session</strong></h1>
                                <ul class="controls">
                                    <?php
                                    if($_SESSION['fonction'] !== 'consultant'){
                                        ?>
                                        <li>
                                            <a role="button" tabindex="0" id="newTypeSession"><i class="fa fa-plus mr-5"></i> Nouveau</a>
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
                                    <label for="filtrerTypeSession" style="padding-top: 5px">Rechercher:</label>
                                    <input id="filtrerTypeSession" type="text" ng-model="filtreDeTypeSession" class="form-control input-sm w-sm mb-10 inline-block"/>
                                    <input type="hidden" value="<?php echo $typeSession ;?>" id="openAddTypeSession" />
                                </div>

                                <table id="searchTextResults" data-page-size="5" class="footable table table-custom">
                                    <thead>
                                    <tr>
                                        <th style="width:60px;">#</th>
                                        <th style="width:90px;">Id</th>
                                        <th>Libell&eacute;</th>
                                        <th>Jours de Cours</th>
                                        <th>Dure&eacute; / Semaine</th>
                                        <?php
                                        if($_SESSION['fonction'] === 'Administrateur'){
                                            ?>
                                            <th style="width: 160px;" class="no-sort">Actions</th>
                                        <?php
                                        }
                                        ?>
                                    </tr>
                                    </thead>
                                    <tbody ng-repeat="(cle, type) in typeSessions | filter:filtreDeTypeSession">
                                    <tr>
                                        <td>{{cle + 1}}</td>
                                        <td>{{type.id}}</td>
                                        <td>{{type.libelle}}</td>
                                        <td>{{type.joursHeures}}</td>
                                        <td>{{type.dureeSession}}</td>
                                        <?php
                                        if($_SESSION['fonction'] === 'Administrateur'){
                                            ?>
                                            <td><a href="#" class="btn btn-xs btn-default mr-5 editTypeSession" id="{{type.id}}"><i class="fa fa-pencil"></i></a><a href="#" id="{{type.id}}" class="btn btn-xs btn-lightred suppTypeSession"><i class="fa fa-times"></i></a></td>
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


                        <section class="tile" id="saveTypeSession" hidden>

                            <!-- tile header -->
                            <div class="tile-header dvd dvd-btm">
                                <h1 class="custom-font"><strong>Nouveau Type Session </strong></h1>
                                <ul class="controls">

                                    <li><a role="button" tabindex="0"><i></i></a></li>
                                </ul>
                            </div>
                            <!-- /tile header -->
                            <div class="tile-body">

                                <form id="formTypeSession" class="form-horizontal" role="form">
                                    <input type="hidden" id="cacheIdTypeSession" name="cacheIdTypeSession"/>
                                    <div class="form-group">
                                        <label for="newLibTypeSession" class="col-sm-2 control-label">Libell&eacute;</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="newLibTypeSession" id="newLibTypeSession" placeholder="Entrer un libellé">
                                        </div>
                                    </div>

                                    <hr class="line-dashed line-full"/>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">LUNDI</label>
                                        <div class="col-sm-10">

                                            <label class="checkbox-inline checkbox-custom">
                                                <input type="checkbox" name="checkHeureJour[]" id="lunCheckbox1" value="LUN_0800_1300"><i></i> 8h00-13h00
                                            </label>
                                            <label class="checkbox-inline checkbox-custom">
                                                <input type="checkbox" name="checkHeureJour[]" id="lunCheckbox2" value="LUN_0830_1430"><i></i> 8h30-14h30
                                            </label>
                                            <label class="checkbox-inline checkbox-custom">
                                                <input type="checkbox" name="checkHeureJour[]" id="lunCheckbox3" value="LUN_1330_1830"><i></i> 13h30-18h30
                                            </label>
                                            <label class="checkbox-inline checkbox-custom">
                                                <input type="checkbox" name="checkHeureJour[]" id="lunCheckbox4" value="LUN_1830_2030"><i></i> 18h30-20h30
                                            </label>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">MARDI</label>
                                        <div class="col-sm-10">

                                            <label class="checkbox-inline checkbox-custom">
                                                <input type="checkbox" name="checkHeureJour[]" id="marCheckbox1" value="MAR_0800_1300"><i></i> 8h00-13h00
                                            </label>
                                            <label class="checkbox-inline checkbox-custom">
                                                <input type="checkbox" name="checkHeureJour[]" id="marCheckbox2" value="MAR_0830_1430"><i></i> 8h30-14h30
                                            </label>
                                            <label class="checkbox-inline checkbox-custom">
                                                <input type="checkbox" name="checkHeureJour[]" id="marCheckbox3" value="MAR_1330_1830"><i></i> 13h30-18h30
                                            </label>
                                            <label class="checkbox-inline checkbox-custom">
                                                <input type="checkbox" name="checkHeureJour[]" id="marCheckbox4" value="MAR_1830_2030"><i></i> 18h30-20h30
                                            </label>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">MERCREDI</label>
                                        <div class="col-sm-10">

                                            <label class="checkbox-inline checkbox-custom">
                                                <input type="checkbox" name="checkHeureJour[]" id="merCheckbox1" value="MER_0800_1300"><i></i> 8h00-13h00
                                            </label>
                                            <label class="checkbox-inline checkbox-custom">
                                                <input type="checkbox" name="checkHeureJour[]" id="merCheckbox2" value="MER_0830_1430"><i></i> 8h30-14h30
                                            </label>
                                            <label class="checkbox-inline checkbox-custom">
                                                <input type="checkbox" name="checkHeureJour[]" id="merCheckbox3" value="MER_1330_1830"><i></i> 13h30-18h30
                                            </label>
                                            <label class="checkbox-inline checkbox-custom">
                                                <input type="checkbox" name="checkHeureJour[]" id="merCheckbox4" value="MER_1830_2030"><i></i> 18h30-20h30
                                            </label>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">JEUDI</label>
                                        <div class="col-sm-10">

                                            <label class="checkbox-inline checkbox-custom">
                                                <input type="checkbox" name="checkHeureJour[]" id="jeuCheckbox1" value="JEU_0800_1300"><i></i> 8h00-13h00
                                            </label>
                                            <label class="checkbox-inline checkbox-custom">
                                                <input type="checkbox" name="checkHeureJour[]" id="jeuCheckbox2" value="JEU_0830_1430"><i></i> 8h30-14h30
                                            </label>
                                            <label class="checkbox-inline checkbox-custom">
                                                <input type="checkbox" name="checkHeureJour[]" id="jeuCheckbox3" value="JEU_1330_1830"><i></i> 13h30-18h30
                                            </label>
                                            <label class="checkbox-inline checkbox-custom">
                                                <input type="checkbox" name="checkHeureJour[]" id="jeuCheckbox4" value="JEU_1830_2030"><i></i> 18h30-20h30
                                            </label>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">VENDREDI</label>
                                        <div class="col-sm-10">

                                            <label class="checkbox-inline checkbox-custom">
                                                <input type="checkbox" name="checkHeureJour[]" id="venCheckbox1" value="VEN_0800_1300"><i></i> 8h00-13h00
                                            </label>
                                            <label class="checkbox-inline checkbox-custom">
                                                <input type="checkbox" name="checkHeureJour[]" id="venCheckbox2" value="VEN_0830_1430"><i></i> 8h30-14h30
                                            </label>
                                            <label class="checkbox-inline checkbox-custom">
                                                <input type="checkbox" name="checkHeureJour[]" id="venCheckbox3" value="VEN_1330_1830"><i></i> 13h30-18h30
                                            </label>
                                            <label class="checkbox-inline checkbox-custom">
                                                <input type="checkbox" name="checkHeureJour[]" id="venCheckbox4" value="VEN_1830_2030"><i></i> 18h30-20h30
                                            </label>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">SAMEDI</label>
                                        <div class="col-sm-10">

                                            <label class="checkbox-inline checkbox-custom">
                                                <input type="checkbox" name="checkHeureJour[]" id="samCheckbox1" value="SAM_0800_1300"><i></i> 8h00-13h00
                                            </label>
                                            <label class="checkbox-inline checkbox-custom">
                                                <input type="checkbox" name="checkHeureJour[]" id="samCheckbox2" value="SAM_0830_1430"><i></i> 8h30-14h30
                                            </label>
                                            <label class="checkbox-inline checkbox-custom">
                                                <input type="checkbox" name="checkHeureJour[]" id="samCheckbox3" value="SAM_1330_1830"><i></i> 13h30-18h30
                                            </label>
                                            <label class="checkbox-inline checkbox-custom">
                                                <input type="checkbox" name="checkHeureJour[]" id="samCheckbox4" value="SAM_1830_2030"><i></i> 18h30-20h30
                                            </label>

                                        </div>
                                    </div>

                                    <hr class="line-dashed line-full"/>

                                    <div class="form-group">
                                        <label for="nbreHeureTypeSession" class="col-sm-2 control-label">Nombre d'heures</label>
                                        <div class="col-sm-10">
                                            <output type="text" class="form-control" name="nbreHeureTypeSession" id="nbreHeureTypeSession" disabled>0</output>
                                        </div>
                                    </div>

                                    <input type="hidden" name="nbreHeureCache" id="nbreHeureCache"/>

                                </form>

                                <div class="modal-footer">
                                    <button class="btn btn-success btn-ef btn-ef-3 btn-ef-3c" id="validerTypeSession"><i class="fa fa-arrow-right"></i> Enregistrer</button>
                                    <button class="btn btn-lightred btn-ef btn-ef-4 btn-ef-4c" data-dismiss="modal" id="retourListeTypeSession"><i class="fa fa-arrow-left"></i> Retour</button>
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
    <div class="modal fade" id="typeSessionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-center" id="typeSessionModalTitle"><strong>Modal title</strong></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="typeSessionModalBody">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" id="typeSessionBtnModalNon" class="btn btn-secondary" data-dismiss="modal"> Non</button>
                    <button type="button" id="typeSessionBtnModalOui" class="btn btn-primary"> Oui</button>
                </div>
            </div>
        </div>
    </div>

    <?php
    include_once'views/pages/alerts.php' ;
    include_once 'views/blocks/footer.php';
    ?>

    <script src="assets/js/typeSession.js"></script>
    <!--/ Page Specific Scripts -->
    </body>
    </html>
<?php
}
else{
    header('Location: login.php') ;
}
?>