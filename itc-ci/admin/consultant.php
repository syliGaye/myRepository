<?php
include_once 'php/configuration/configuration.php' ;

if(isset($_SESSION['username'])){
    $consultant = (isset($_GET['addConsultant'])) ? htmlentities($_GET['addConsultant']) : NULL ;
    include_once 'views/blocks/header_1.php';
//echo $mail_webmaster ;
    ?>

    <title>ITC - Tableau de bord</title>
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
                                        <li><a href="domaine.php"><i class="fa fa-caret-right"></i> Technologies</a></li>
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
                                <li class="active"><a href="consultant.php"><i class="fa fa-users"></i> <span> Gestion des consultants</span></a></li>
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

                <h2>Consultants </h2>

                <div class="page-bar">

                    <ul class="page-breadcrumb">
                        <li>
                            <a href="index.php"><i class="fa fa-home"></i> ITC - Admin</a>
                        </li>
                        <li>
                            <a href="consultant.php"> Consultants</a>
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
                        <section class="tile" id="listConsultant">

                            <!-- tile header -->
                            <div class="tile-header dvd dvd-btm">
                                <h1 class="custom-font">Liste des <strong>Consultants</strong></h1>
                                <ul class="controls">
                                    <?php
                                    if($_SESSION['fonction'] !== 'consultant'){
                                        ?>
                                        <li><a href="#" id="newConsultant"><i class="fa fa-plus mr-5"></i> Nouveau</a></li>
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
                                    <label for="filtrerConsultant" style="padding-top: 5px">Rechercher:</label>
                                    <input id="filtrerConsultant" type="text" ng-model="filtreDeConsultant" class="form-control input-sm w-sm mb-10 inline-block"/>
                                    <input type="hidden" value="<?php echo $consultant ;?>" id="openAddConsultant" />
                                </div>

                                <table id="searchTextResults" data-page-size="5" class="footable table table-custom">
                                    <thead>
                                    <tr>
                                        <th style="width:60px;"></th>
                                        <th style="width:60px;">#</th>
                                        <th style="width:90px;">Id</th>
                                        <th>Nom</th>
                                        <th>Prenoms</th>
                                        <th>Nationalit&eacute;</th>
                                        <th>Profession</th>
                                        <th>Tel / Cel</th>
                                        <th>Email</th>
                                        <?php
                                        if($_SESSION['fonction'] === 'Administrateur'){
                                            ?>
                                            <th style="width:150px;" class="no-sort">Actions</th>
                                        <?php
                                        }
                                        ?>
                                    </tr>
                                    </thead>
                                    <tbody ng-repeat="(cle, consult) in consults | filter:filtreDeConsultant">
                                    <tr>
                                        <td><a href="#" class="btn btn-xs btn-default mr-5 voirConsultant" id="{{consult.id}}"><i class="fa fa-eye"></i></a></td>
                                        <td>{{cle + 1}}</td>
                                        <td>{{consult.id}}</td>
                                        <td>{{consult.nom}}</td>
                                        <td>{{consult.prenoms}}</td>
                                        <td>{{consult.nationalite}}</td>
                                        <td>{{consult.profession}}</td>
                                        <td>{{consult.telephone}}</td>
                                        <td>{{consult.email}}</td>
                                        <?php
                                        if($_SESSION['fonction'] === 'Administrateur'){
                                            ?>
                                            <td><a href="#" class="btn btn-xs btn-default mr-5 editConsultant" id="{{consult.id}}"><i class="fa fa-pencil"></i></a><a href="#" id="{{consult.id}}" class="btn btn-xs btn-lightred suppConsultant"><i class="fa fa-times"></i></a></td>
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


                        <section class="tile" id="createConsultant" hidden>
                            <!-- tile header -->
                            <div class="tile-header dvd dvd-btm">
                                <h1 class="custom-font"><strong>Enregistrer</strong> un Consultant</h1>
                                <ul class="controls">
                                    <li><a href="#" id="retourListConsultant"><i class="fa fa-arrow-left mr-5"></i> retour</a></li>

                                    <li><a role="button" tabindex="0" ><i ></i></a></li>
                                </ul>
                            </div>
                            <!-- /tile header -->

                            <div>

                                <div id="rootwizard" class="tab-container tab-wizard">
                                    <ul class="nav nav-tabs nav-justified">
                                        <li><a href="#tab1Consultant" data-toggle="tab">Civilit&eacute; <span class="badge badge-default pull-right wizard-step">1</span></a></li>
                                        <li><a href="#tab2Consultant" data-toggle="tab">Address<span class="badge badge-default pull-right wizard-step">2</span></a></li>
                                        <li><a href="#tab3Consultant" data-toggle="tab">Sp&eacute;cialit&eacute;<span class="badge badge-default pull-right wizard-step">3</span></a></li>
                                        <li><a href="#tab4Consultant" data-toggle="tab">Disponibilit&eacute;<span class="badge badge-default pull-right wizard-step">4</span></a></li>
                                        <li><a href="#tab5Consultant" data-toggle="tab">Validation<span class="badge badge-default pull-right wizard-step">5</span></a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane" id="tab1Consultant">

                                            <form name="step1" id="step1Consultant" role="form">

                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label for="nomConsultant">Nom: </label>
                                                        <input type="text" name="nomConsultant" id="nomConsultant" class="form-control"
                                                               required>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="prenomConsultant">Pr&eacute;noms: </label>
                                                        <input type="text" name="prenomConsultant" id="prenomConsultant" class="form-control"
                                                               required>
                                                    </div>
                                                </div>

                                                <div class="row">

                                                    <div class="form-group col-md-6">
                                                        <label for="dateNaissConsultant">Date de Naissance: </label>
                                                        <div class='input-group datepicker' data-format="L">
                                                            <input type="text" name="dateNaissConsultant" id="dateNaissConsultant" class="form-control" placeholder="MM/DD/YYYY"
                                                                   data-parsley-trigger="change"
                                                                   pattern="/(0[1-9]|1[012])/(0[1-9]|1[0-9]|2[0-9]|3[01])/[0-9]{4}$/"
                                                                   required>
                                                            <span class="input-group-addon">
                                                                <span class="fa fa-calendar"></span>
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="nationConsultant">Nationalit&eacute;: </label>
                                                        <input type="text" name="nationConsultant" id="nationConsultant" class="form-control"
                                                               minlength="3"
                                                               required>
                                                    </div>

                                                </div>

                                                <div class="row">

                                                    <div class="form-group col-md-6">
                                                        <label for="phoneConsultant">Tel / Cel: </label>
                                                        <input type="text" name="phoneConsultant" id="phoneConsultant" class="form-control" placeholder="(+XXX) XXX XXX XX"
                                                               data-parsley-trigger="change"
                                                               pattern="^[\d\+\-\.\(\)\/\s]*$"
                                                               required>
                                                    </div>

                                                    <div class="form- col-md-6">
                                                        <label for="emailConsultant">Email: </label>
                                                        <input type="email" name="emailConsultant" id="emailConsultant" class="form-control"
                                                               data-parsley-trigger="change"
                                                               required>
                                                    </div>

                                                </div>

                                            </form>

                                        </div>
                                        <div class="tab-pane" id="tab2Consultant">

                                            <form name="step2" id="step2Consultant" role="form">
                                                <input type="hidden" name="idForm2" id="idForm2">

                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label for="profConsultant">Profession: </label>
                                                        <input type="text" name="profConsultant" id="profConsultant" class="form-control"
                                                               required>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="empConsultant">Employeur: </label>
                                                        <input type="text" name="empConsultant" id="empConsultant" class="form-control"
                                                               required>
                                                    </div>
                                                </div>

                                                <div class="form-group mt-10">
                                                    <label for="fonctionConsultant">Fonction: </label>
                                                    <input type="text" name="fonctionConsultant" id="fonctionConsultant" class="form-control" placeholder="Fonction exercée"
                                                           required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="lieuHabitation">Lieu d'Habitation: </label>
                                                    <textarea class="form-control" rows="5" name="lieuHabitation" id="lieuHabitation" placeholder="Entrer le lieu d'habitation..." requred></textarea>
                                                </div>

                                            </form>

                                        </div>
                                        <div class="tab-pane" id="tab3Consultant">

                                            <form name="step3" id="step3Consultant" role="form" novalidate>
                                                <input type="hidden" name="idForm3" id="idForm3">

                                                <h4 class="custom-font">Dipl&ocirc;me et Certification</h4>

                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label for="lastDiplConsultant">Dernier dipl&ocirc;me obtenu: </label>
                                                        <input type="text" name="lastDiplConsultant" id="lastDiplConsultant" class="form-control"
                                                               required>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label for="lastCertifConsultant">Dernier certificat obtenu: </label>
                                                        <input type="text" name="lastCertifConsultant" id="lastCertifConsultant" class="form-control"
                                                               required>
                                                    </div>
                                                </div>

                                                <h4 class="custom-font">Comp&eacute;tences Formation</h4>

                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-sm-10" id="consultantDivCheckbox">
                                                            <label class="checkbox-inline checkbox-custom" ng-repeat="forma in formation">
                                                                <!--<input type="checkbox" name="checkFormationConsultant[]" value="{{forma.id}}"><i></i> {{forma.titre}}-->
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </form>

                                        </div>
                                        <div class="tab-pane" id="tab4Consultant">

                                            <form name="step4" id="step4Consultant" role="form" novalidate>
                                                <input type="hidden" name="idForm4" id="idForm4">
                                                <h4 class="custom-font">Espace de disponibilit&eacute;</h4>
                                                <div class="row">
                                                    <div class="form-group col-md-6 mb-0">
                                                        <label for="debutDispoConsultant">Date de d&eacute;but: </label>
                                                        <div class='input-group datepicker' data-format="L">
                                                            <input type="text" name="debutDispoConsultant" id="debutDispoConsultant" class="form-control" placeholder="MM/DD/YYYY"
                                                                   data-parsley-trigger="change"
                                                                   pattern="/(0[1-9]|1[012])/(0[1-9]|1[0-9]|2[0-9]|3[01])/[0-9]{4}$/"
                                                                   required>
                                                            <span class="input-group-addon">
                                                                <span class="fa fa-calendar"></span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6 mb-0">
                                                        <label for="finDispoConsultant">Date de fin: </label>
                                                        <div class='input-group datepicker' data-format="L">
                                                            <input type="text" name="finDispoConsultant" id="finDispoConsultant" class="form-control" placeholder="MM/DD/YYYY"
                                                                   data-parsley-trigger="change"
                                                                   pattern="/(0[1-9]|1[012])/(0[1-9]|1[0-9]|2[0-9]|3[01])/[0-9]{4}$/"
                                                                   required>
                                                            <span class="input-group-addon">
                                                                <span class="fa fa-calendar"></span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <input type="hidden" name="consultJrsHrsCpte" id="consultJrsHrsCpte" value="0">
                                                <h4 class="custom-font">Les jours de disponibilit&eacute;</h4>
                                                <div class="row">
                                                    <div class="form-group col-md-6 mb-0">
                                                        <label class="control-label">LUNDI</label>
                                                        <div>

                                                            <label class="checkbox-inline checkbox-custom">
                                                                <input type="checkbox" name="consultantHeureJour[]" id="lunConsult1" value="LUN_0800_1300"><i></i> 8h00-13h00
                                                            </label>
                                                            <label class="checkbox-inline checkbox-custom">
                                                                <input type="checkbox" name="consultantHeureJour[]" id="lunConsult2" value="LUN_0830_1430"><i></i> 8h30-14h30
                                                            </label>
                                                            <label class="checkbox-inline checkbox-custom">
                                                                <input type="checkbox" name="consultantHeureJour[]" id="lunConsult3" value="LUN_1330_1830"><i></i> 13h30-18h30
                                                            </label>
                                                            <label class="checkbox-inline checkbox-custom">
                                                                <input type="checkbox" name="consultantHeureJour[]" id="lunConsult4" value="LUN_1830_2030"><i></i> 18h30-20h30
                                                            </label>

                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-6 mb-0">
                                                        <label class="control-label">MARDI</label>
                                                        <div>

                                                            <label class="checkbox-inline checkbox-custom">
                                                                <input type="checkbox" name="consultantHeureJour[]" id="marConsult1" value="MAR_0800_1300"><i></i> 8h00-13h00
                                                            </label>
                                                            <label class="checkbox-inline checkbox-custom">
                                                                <input type="checkbox" name="consultantHeureJour[]" id="marConsult2" value="MAR_0830_1430"><i></i> 8h30-14h30
                                                            </label>
                                                            <label class="checkbox-inline checkbox-custom">
                                                                <input type="checkbox" name="consultantHeureJour[]" id="marConsult3" value="MAR_1330_1830"><i></i> 13h30-18h30
                                                            </label>
                                                            <label class="checkbox-inline checkbox-custom">
                                                                <input type="checkbox" name="consultantHeureJour[]" id="marConsult4" value="MAR_1830_2030"><i></i> 18h30-20h30
                                                            </label>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-md-6 mb-0">
                                                        <label class="control-label">MERCREDI</label>
                                                        <div>

                                                            <label class="checkbox-inline checkbox-custom">
                                                                <input type="checkbox" name="consultantHeureJour[]" id="merConsult1" value="MER_0800_1300"><i></i> 8h00-13h00
                                                            </label>
                                                            <label class="checkbox-inline checkbox-custom">
                                                                <input type="checkbox" name="consultantHeureJour[]" id="merConsult2" value="MER_0830_1430"><i></i> 8h30-14h30
                                                            </label>
                                                            <label class="checkbox-inline checkbox-custom">
                                                                <input type="checkbox" name="consultantHeureJour[]" id="merConsult3" value="MER_1330_1830"><i></i> 13h30-18h30
                                                            </label>
                                                            <label class="checkbox-inline checkbox-custom">
                                                                <input type="checkbox" name="consultantHeureJour[]" id="merConsult4" value="MER_1830_2030"><i></i> 18h30-20h30
                                                            </label>

                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-6 mb-0">
                                                        <label class="control-label">JEUDI</label>
                                                        <div>

                                                            <label class="checkbox-inline checkbox-custom">
                                                                <input type="checkbox" name="consultantHeureJour[]" id="jeuConsult1" value="JEU_0800_1300"><i></i> 8h00-13h00
                                                            </label>
                                                            <label class="checkbox-inline checkbox-custom">
                                                                <input type="checkbox" name="consultantHeureJour[]" id="jeuConsult2" value="JEU_0830_1430"><i></i> 8h30-14h30
                                                            </label>
                                                            <label class="checkbox-inline checkbox-custom">
                                                                <input type="checkbox" name="consultantHeureJour[]" id="jeuConsult3" value="JEU_1330_1830"><i></i> 13h30-18h30
                                                            </label>
                                                            <label class="checkbox-inline checkbox-custom">
                                                                <input type="checkbox" name="consultantHeureJour[]" id="jeuConsult4" value="JEU_1830_2030"><i></i> 18h30-20h30
                                                            </label>

                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="form-group col-md-6 mb-0">
                                                        <label class="control-label">VENDREDI</label>
                                                        <div>

                                                            <label class="checkbox-inline checkbox-custom">
                                                                <input type="checkbox" name="consultantHeureJour[]" id="venConsult1" value="VEN_0800_1300"><i></i> 8h00-13h00
                                                            </label>
                                                            <label class="checkbox-inline checkbox-custom">
                                                                <input type="checkbox" name="consultantHeureJour[]" id="venConsult2" value="VEN_0830_1430"><i></i> 8h30-14h30
                                                            </label>
                                                            <label class="checkbox-inline checkbox-custom">
                                                                <input type="checkbox" name="consultantHeureJour[]" id="venConsult3" value="VEN_1330_1830"><i></i> 13h30-18h30
                                                            </label>
                                                            <label class="checkbox-inline checkbox-custom">
                                                                <input type="checkbox" name="consultantHeureJour[]" id="venConsult4" value="VEN_1830_2030"><i></i> 18h30-20h30
                                                            </label>

                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-6 mb-0">
                                                        <label class="control-label">SAMEDI</label>
                                                        <div>

                                                            <label class="checkbox-inline checkbox-custom">
                                                                <input type="checkbox" name="consultantHeureJour[]" id="samConsult1" value="SAM_0800_1300"><i></i> 8h00-13h00
                                                            </label>
                                                            <label class="checkbox-inline checkbox-custom">
                                                                <input type="checkbox" name="consultantHeureJour[]" id="samConsult2" value="SAM_0830_1430"><i></i> 8h30-14h30
                                                            </label>
                                                            <label class="checkbox-inline checkbox-custom">
                                                                <input type="checkbox" name="consultantHeureJour[]" id="samConsult3" value="SAM_1330_1830"><i></i> 13h30-18h30
                                                            </label>
                                                            <label class="checkbox-inline checkbox-custom">
                                                                <input type="checkbox" name="consultantHeureJour[]" id="samConsult4" value="SAM_1830_2030"><i></i> 18h30-20h30
                                                            </label>

                                                        </div>
                                                    </div>
                                                </div>

                                            </form>

                                        </div>
                                        <div class="tab-pane" id="tab5Consultant">

                                            <p class="well">Etes-vous s&ucirc;r de l'exatitude des entr&eacute;es ?</p>

                                            <form name="step5" id="step5Consultant" role="form" novalidate>

                                                <div class="checkbox">
                                                    <label class="checkbox checkbox-custom">
                                                        <input type="checkbox" name="agreeConsultant" id="agreeConsultant" value="off"
                                                               required><i></i> Je suis s&ucirc;r
                                                    </label>
                                                </div>

                                            </form>

                                        </div>
                                        <ul class="pager wizard">
                                            <li class="previous"><button class="btn btn-default"><li class="fa fa-angle-double-left"></li> Pr&eacute;c&eacute;dent</button></li>
                                            <li class="next"><button class="btn btn-default">Suivant <li class="fa fa-angle-double-right"></li></button></li>
                                            <li class="next finish" style="display:none;"><button class="btn btn-success" id="validerConsultant"><li class="fa fa-check-square-o"></li> Valider</button></li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
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
    <div class="modal fade" id="consultantModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-center" id="consultantModalTitle"><strong>Modal title</strong></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="consultantModalBody">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" id="consultantBtnModalNon" class="btn btn-secondary" data-dismiss="modal"> Non</button>
                    <button type="button" id="consultantBtnModalOui" class="btn btn-primary"> Oui</button>
                </div>
            </div>
        </div>
    </div>

    <?php
    include_once'views/pages/alerts.php' ;
    include_once 'views/blocks/footer.php';
    ?>

    <script src="assets/js/consultant.js"></script>
    <!--/ Page Specific Scripts -->
    </body>
    </html>
<?php
}
else{
    header('Location: login.php') ;
}
?>