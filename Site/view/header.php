<div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion d-flex align-items-center" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <img class="logo" src="./ressources/style/img/logo.png">
        <hr class="sidebar-divider my-0">
        <hr class="sidebar-divider">
        <?php
        if((isset($_SESSION["user"]["user_id"]) && !empty($_SESSION["user"]["user_id"])))
        {?>
            <li class="nav-item">
            <a class="nav-link" href="?controller=wine&action=listeWine">
                <i class="fas fa-fw fa-table"></i>
                <span>Liste</span>
            </a>
            <?php if(isset($_SESSION["user"]["roles"]["isAdmin"])&& $_SESSION["user"]["roles"]["isAdmin"]){?>
            <a class="nav-link" href="?controller=account&action=rolesForm">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Droits</span>
            </a>
            <?php }?>
        </li>
        <?php } ?>
    </ul>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar shadow position-sticky">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="site-title navbar-nav d-flex justify-content-between align-items-center w-100">
                    <h1>Ma cave</h1>
                    <?php
                    if (isset($_SESSION["user"]["user_id"]) && !empty($_SESSION["user"]["user_id"])) {
                    ?>
                    <!-- Nav Item - User Connected Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?=$_SESSION["user"]["username"]?></span>
                            <img class="img-profile rounded-circle" src="./ressources/style/img/undraw_profile.svg">
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="?controller=account&action=disconnection">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Se déconnecter
                        </a>
                    </li>
                    <?php
                        } else {
                    ?>
                    <!-- Nav Item - User Connected Information -->
                    <li class="nav-item  no-arrow">
                        <a class="nav-link" href="?controller=account&action=connectForm"
                            data-toggle="" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">Se connecter</span>
                            <img class="img-profile rounded-circle" src="./ressources/style/img/undraw_profile.svg">
                        </a>
                    </li>
                    <?php
                        }
                    ?>


                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Page Content -->
            <div class="container-fluid h-100">
                <!-- Ton contenu principal ici -->