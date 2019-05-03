<?php
?>
<body id="minovate" class="appWrapper">

<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->


<div id="wrap" class="animsition">
    <section id="header">
        <header class="clearfix">

            <!-- Branding -->
            <div class="branding">
                <a class="brand" href="index.php">
                    <span><strong>{{main.title}}</strong></span>
                </a>
                <a role="button" tabindex="0" class="offcanvas-toggle visible-xs-inline"><i class="fa fa-bars"></i></a>
            </div>
            <!-- Branding end -->



            <!-- Left-side navigation -->
            <ul class="nav-left pull-left list-unstyled list-inline">
                <li class="sidebar-collapse divided-right">
                    <a role="button" tabindex="0" class="collapse-sidebar">
                        <i class="fa fa-outdent"></i>
                    </a>
                </li>
            </ul>
            <!-- Left-side navigation end -->


            <!-- Search -->
            <div class="search" id="main-search">
                <input type="text" class="form-control underline-input" placeholder="Rechercher...">
            </div>
            <!-- Search end -->


            <!-- Right-side navigation -->
            <ul class="nav-right pull-right list-inline">

                <li class="dropdown notifications">

                    <a href class="dropdown-toggle" data-toggle="dropdown" id="afficherNotif">
                        <i class="fa fa-bell"></i>
                        <?php
                        $query = $db->prepare('SELECT COUNT(*) AS nbre FROM notification WHERE etatOuverture = "ferme"') ;
                        $query->execute();
                        $dn = $query->fetch();
                        $nbreNotif = $dn['nbre'];

                        $query1 = $db->prepare('SELECT COUNT(*) AS nbre FROM notification WHERE etatLecture = "non lu"') ;
                        $query1->execute();
                        $dn2 = $query1->fetch();
                        $nbreNotifLu = $dn2['nbre'];

                        $query2 = $db->prepare('SELECT id, titre, contenu, etatOuverture, etatLecture, idSession FROM notification WHERE etatLecture = "non lu"') ;
                        $query2->execute();
                        $donnee = $query2->fetchAll();

                        if($nbreNotif > 0){
                            echo '<span class="badge bg-lightred" id="nbreNotification">'.$nbreNotif.'</span>';
                        }
                        ?>
                    </a>

                    <div class="dropdown-menu pull-right with-arrow panel panel-default animated littleFadeInLeft" id="lesNotifs" hidden>

                        <div class="panel-heading">
                            <?php
                            if($nbreNotifLu > 0){
                                echo 'Vous avez <strong>'.$nbreNotifLu.'</strong> notifications';
                            }
                            else{echo'Vous n\'avez aucune notification';}
                            ?>

                        </div>

                        <ul class="list-group">
                            <?php
                            $i = 0;
                            foreach($donnee as $val){
                                ?>
                                <li class="list-group-item">
                                    <a role="button" tabindex="0" class="media titreNotif" id="<?php echo $val['id'];?>">
                                        <div class="media-body">
                                            <span class="block text-center" id="<?php echo $val['idSession']; ?>"><?php echo $val['titre']; ?></span>
                                        </div>
                                    </a>
                                </li>
                            <?php
                            }
                            ?>

                        </ul>

                        <div class="panel-footer">
                            <a role="button" tabindex="0"> Afficher toutes les notifications <i class="fa fa-angle-right pull-right"></i></a>
                        </div>

                    </div>

                </li>

                <li class="dropdown nav-profile">

                    <a href class="dropdown-toggle" data-toggle="dropdown" id="afficherProfil">
                        <img src="assets/images/placeholder-avatar.png" alt="" class="img-circle size-30x30">
                        <span><?php echo ' '.htmlentities($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?><i class="fa fa-angle-down"></i></span>
                    </a>

                    <ul class="dropdown-menu animated littleFadeInRight" role="menu" id="leProfil" hidden>

                        <li>
                            <a role="button" tabindex="0" href="pageProfil.php">
                                <!--<span class="badge bg-greensea pull-right">86%</span>-->
                                <i class="fa fa-user"></i>Mon Profil
                            </a>
                        </li>
                        <li>
                            <a role="button" tabindex="0" id="profilLogout">
                                <i class="fa fa-sign-out"></i>D&eacute;connexion
                            </a>
                        </li>

                    </ul>

                </li>
            </ul>
            <!-- Right-side navigation end -->

            &nbsp;&nbsp;&nbsp;&nbsp;
        </header>

    </section>
<!--/ HEADER Content  -->