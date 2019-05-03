<?php
include_once 'php/configuration/configuration.php' ;

if(isset($_SESSION['username'])){
    include_once 'views/blocks/header_1.php';
//echo $mail_webmaster ;
    ?>

    <title>ITC - Mon Profil</title>
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

        <h2>Profil </h2>

        <div class="page-bar">

            <ul class="page-breadcrumb">
                <li>
                    <a href="index.php"><i class="fa fa-home"></i> ITC - Admin</a>
                </li>
                <li>
                    <a href="pageProfil.php"> Mon Profil</a>
                </li>
            </ul>

        </div>

    </div>

    <!-- page content -->
    <div class="pagecontent">


    <!-- row -->
    <div class="row">






    <!-- col -->
    <div class="col-md-4">

        <!-- tile -->
        <section class="tile tile-simple">

            <!-- tile widget -->
            <div class="tile-widget p-30 text-center">

                <div class="thumb thumb-xl">
                    <img class="img-circle" src="assets/images/placeholder-avatar.png" alt="">
                </div>
                <h4 class="mb-0" id="nomEtPrenoms"></h4>
                <span class="text-muted" id="profilFonction"></span>

            </div>
            <!-- /tile widget -->


        </section>
        <!-- /tile -->


    </div>
    <!-- /col -->






    <!-- col -->
    <div class="col-md-8">

    <!-- tile -->
    <section class="tile tile-simple">

    <!-- tile body -->
    <div class="tile-body p-0">

    <div role="tabpanel">

    <!-- Nav tabs -->
    <ul class="nav nav-tabs tabs-dark" role="tablist">
        <li role="presentation" class="active"><a href="#settingsTab" aria-controls="settingsTab" role="tab" data-toggle="tab">Param&egrave;tres</a></li>
        <!--<li role="presentation"><a href="#feedTab" aria-controls="feedTab" role="tab" data-toggle="tab">Feed</a></li>-->
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">


    <div role="tabpanel" class="tab-pane active" id="settingsTab">

        <div class="wrap-reset">

            <form class="profile-settings" id="formProfilChange">
                <input type="hidden" id="idDeLaSession" name="idDeLaSession" value="<?php echo $_SESSION['id'] ;?>" />

                <div class="row">
                    <div class="form-group col-md-12 legend">
                        <h4>Informations <strong>Personelles</strong></h4>
                        <p>Your personal account settings</p>
                    </div>
                </div>

                <div class="row">

                    <div class="form-group col-sm-6">
                        <label for="first-name">Nom</label>
                        <input type="text" name="profilFirstName" class="form-control" id="profilFirstName">
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="last-name">Pr&eacute;noms</label>
                        <input type="text" class="form-control" id="profilLastName" name="profilLastName">
                    </div>

                </div>

                <div class="row">

                    <div class="form-group col-sm-6">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control" id="profilEmail" name="profilEmail">
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="phone">T&eacute;l&eacute;phone</label>
                        <input type="text" class="form-control" name="profilPhone" id="profilPhone">
                        <span class="help-block" id="profilPhoneSpan">+(421) 999 999 999</span>
                    </div>

                </div>


                <div class="row">
                    <div class="form-group col-md-12 legend">
                        <h4>Param&egrave;tres de <strong>S&eacute;curit&eacute;</strong></h4>
                        <p>Secure your account</p>
                    </div>
                </div>

                <div class="row">

                    <div class="form-group col-sm-6">
                        <label for="username">Nom Utilisateur</label>
                        <input type="text" class="form-control" id="profilUsername" name="profilUsername" readonly>
                    </div>


                    <div class="form-group col-sm-6">
                        <label for="password">Mot de passe</label>
                        <input type="password" class="form-control" id="profilPassword" value="secretpassword" readonly>
                    </div>

                </div>

                <div class="row">

                    <div class="form-group col-sm-6">
                        <label for="new-password">Nouveau Mot de Passe</label>
                        <input type="password" class="form-control" id="profilNewPassword" name="profilNewPassword" placeholder="Entrer un nouveau Mot de passe">
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="new-password-repeat">Rep&eacute;ter Nouveau Mot de Passe</label>
                        <input type="password" class="form-control" id="profilNewPasswordRepeat" placeholder="Repéter nouveau Mot de passe">
                    </div>

                </div>

                <!-- tile footer -->
                <div class="tile-footer text-right bg-tr-black lter dvd dvd-top">
                    <!-- SUBMIT BUTTON -->
                    <button type="submit" class="btn btn-default" id="modifierProfil" disabled><i class="fa fa-pencil"></i> Modifier</button>
                </div>
                <!-- /tile footer -->

            </form>

        </div>

    </div>

    <!--<div role="tabpanel" class="tab-pane" id="feedTab">

    <div class="wrap-reset">

    <div class="streamline-form">
        <textarea class="form-control br-0 br-2-t" placeholder="What's up dude?" rows="5"></textarea>
        <div class="post-toolbar">
            <a href="#" tooltip="Add File"><i class="fa fa-paperclip"></i></a>
            <a href="#" tooltip="Add Image"><i class="fa fa-camera"></i></a>
            <a href="#" class="pull-right" tooltip="Post it!"><i class="fa fa-share"></i></a>
        </div>
    </div>

    <div class="streamline mt-20">

    <article class="streamline-post">

        <aside>
            <div class="thumb thumb-sm">
                <img class="img-circle" src="assets/images/profile-photo.jpg" alt="">
            </div>
        </aside>

        <div class="post-container">

            <div class="panel panel-default">
                <div class="panel-heading bg-white">
                    John Douey <small class="text-muted">posted a new status</small>
                    <span class="text-muted pull-right"><i class="fa fa-clock-o mr-5"></i> Just now</span>
                </div>
                <div class="panel-body">
                    On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain.

                    <p class="mt-10 mb-0">
                        <a href="" active-toggle="" class="btn btn-default btn-xs active">
                            <i class="fa fa-heart-o text-inactive"></i><i class="fa fa-heart text-danger text-active"></i> Like (14)
                        </a>
                        <a href="" class="btn btn-default btn-xs">
                            <i class="fa fa-comments"></i> Comments (30)
                        </a>
                        <a href="" class="btn btn-default btn-xs">
                            <i class="fa fa-mail-reply"></i> Reply
                        </a>
                    </p>
                </div>
            </div>

            <ul class="list-unstyled post-replies">

                <li>

                    <aside>
                        <div class="thumb thumb-sm">
                            <img class="img-circle" src="assets/images/random-avatar4.jpg" alt="">
                        </div>
                    </aside>

                    <div class="reply-container">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <p>
                                    <strong>James Bend</strong>
                                    <span class="text-muted pull-right"><i class="fa fa-clock-o mr-5"></i> 6 minutes ago</span>
                                </p>

                                <p class="mb-0 text-small">These cases are perfectly simple and easy to distinguish.</p>

                                <p class="mt-10 mb-0">
                                    <a href="" active-toggle="" class="btn btn-default btn-xs">
                                        <i class="fa fa-heart-o text-inactive"></i><i class="fa fa-heart text-danger text-active"></i> Like (5)
                                    </a>
                                    <a href="" class="btn btn-default btn-xs">
                                        <i class="fa fa-mail-reply"></i> Reply
                                    </a>
                                </p>

                            </div>
                        </div>
                    </div>

                </li>

                <li>

                    <aside>
                        <div class="thumb thumb-sm">
                            <img class="img-circle" src="assets/images/ici-avatar.jpg" alt="">
                        </div>
                    </aside>

                    <div class="reply-container">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <p>
                                    <strong>Ing. Imrich Kamarel</strong>
                                    <span class="text-muted pull-right"><i class="fa fa-clock-o mr-5"></i> 50 minutes ago</span>
                                </p>

                                <p class="mb-0 text-small">In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best.</p>

                                <p class="mt-10 mb-0">
                                    <a href="" active-toggle="" class="btn btn-default btn-xs active">
                                        <i class="fa fa-heart-o text-inactive"></i><i class="fa fa-heart text-danger text-active"></i> Like
                                    </a>
                                    <a href="" class="btn btn-default btn-xs">
                                        <i class="fa fa-mail-reply"></i> Reply
                                    </a>
                                </p>

                            </div>
                        </div>
                    </div>

                </li>

                <li>

                    <aside>
                        <div class="thumb thumb-sm">
                            <img class="img-circle" src="assets/images/arnold-avatar.jpg" alt="">
                        </div>
                    </aside>

                    <div class="reply-container">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <p>
                                    <strong>Arnold Karlsberg</strong>
                                    <span class="text-muted pull-right"><i class="fa fa-clock-o mr-5"></i> 56 minutes ago</span>
                                </p>

                                <p class="mb-0 text-small">But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted.</p>

                                <p class="mt-10 mb-0">
                                    <a href="" active-toggle="" class="btn btn-default btn-xs">
                                        <i class="fa fa-heart-o text-inactive"></i><i class="fa fa-heart text-danger text-active"></i> Like (2)
                                    </a>
                                    <a href="" class="btn btn-default btn-xs">
                                        <i class="fa fa-mail-reply"></i> Reply
                                    </a>
                                </p>

                            </div>
                        </div>
                    </div>

                </li>

            </ul>

        </div>

    </article>

    <article class="streamline-post">
        <aside>
            <div class="thumb thumb-sm">
                <img class="img-circle" src="assets/images/random-avatar1.jpg" alt="">
            </div>
        </aside>
        <div class="post-container">
            <div class="panel panel-default">
                <div class="panel-heading bg-white">
                    Mike Herrington <small class="text-muted">posted a new status</small>
                    <span class="text-muted pull-right"><i class="fa fa-clock-o mr-5"></i> 39 minutes ago</span>
                </div>
                <div class="panel-body">
                    Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.

                    <p class="mt-10 mb-0">
                        <a href="" active-toggle="" class="btn btn-default btn-xs">
                            <i class="fa fa-heart-o text-inactive"></i><i class="fa fa-heart text-danger text-active"></i> Like
                        </a>
                        <a href="" class="btn btn-default btn-xs">
                            <i class="fa fa-comments"></i> Comments (9)
                        </a>
                        <a href="" class="btn btn-default btn-xs">
                            <i class="fa fa-mail-reply"></i> Reply
                        </a>
                    </p>

                </div>
            </div>
        </div>
    </article>

    <article class="streamline-post">
        <aside>
            <div class="thumb thumb-sm">
                <img class="img-circle" src="assets/images/random-avatar3.jpg" alt="">
            </div>
        </aside>
        <div class="post-container">
            <div class="panel panel-default">
                <div class="panel-heading bg-white">
                    Robin Wills <small class="text-muted">added a new photo</small>
                    <span class="text-muted pull-right"><i class="fa fa-clock-o mr-5"></i> 1 hour ago</span>
                </div>
                <div class="panel-body">

                    <img src="http://placekitten.com/g/800/600" class="img-responsive mb-20" alt />

                    <p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain.</p>

                    <p class="mt-10 mb-0">
                        <a href="" active-toggle="" class="btn btn-default btn-xs active">
                            <i class="fa fa-heart-o text-inactive"></i><i class="fa fa-heart text-danger text-active"></i> Like (16)
                        </a>
                        <a href="" class="btn btn-default btn-xs">
                            <i class="fa fa-comments"></i> Comments (16)
                        </a>
                        <a href="" class="btn btn-default btn-xs">
                            <i class="fa fa-mail-reply"></i> Reply
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </article>

    <div class="text-center">
        <a href="#" class="btn btn-sm btn-default">
            Load More …
        </a>
    </div>

    </div>

    </div>

    </div>-->
    </div>

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
    <div class="modal fade" id="profilModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-center" id="profilModalTitle"><strong>Modal title</strong></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="profilModalBody">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" id="profilBtnModalNon" class="btn btn-secondary" data-dismiss="modal"> Non</button>
                    <button type="button" id="profilBtnModalOui" class="btn btn-primary"> Oui</button>
                </div>
            </div>
        </div>
    </div>

    <?php
    include_once'views/pages/alerts.php' ;
    include_once 'views/blocks/footer.php';
    ?>

    <script src="assets/js/pageProfil.js"></script>
    <!--/ Page Specific Scripts -->
    </body>
    </html>
<?php
}
else{
    header('Location: login.php') ;
}
?>