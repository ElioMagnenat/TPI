<div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion d-flex align-items-center" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <img class="logo" src="./ressources/style/img/logo.png">
        <hr class="sidebar-divider my-0">
        <hr class="sidebar-divider">
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center" href="?controller=book&action=listBook">
                <i class="fas fa-fw fa-table"></i>
                <span>Catalogue</span>
            </a>
            <a class="nav-link d-flex align-items-center" href="?controller=student&action=listStudent">
                <i class="fas fa-users"></i>
                <span>Élèves</span>
            </a>
        </li>
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
                <div class="d-flex justify-content-between align-items-center px-3 py-2" style="width: 100%;">
                    <div class="flex-grow-1 text-center">
                        <h1 class="m-0 ">BiblioSolidaire</h1>
                    </div>
                    <!-- Bouton du menu -->
                    <div class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="menuDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v text-primary fa-2x"></i>
                    </a>

                    <!-- Menu déroulant -->
                    <div class="dropdown-menu dropdown-menu-right shadow" aria-labelledby="menuDropdown">
                        <!-- Importer -->
                        <form action="?controller=book&action=importDatabase" method="post" enctype="multipart/form-data" class="m-0 p-0 w-100">
                            <button type="button" class="dropdown-item d-flex align-items-center" onclick="document.getElementById('sqlUpload').click();">
                                <i class="fas fa-file-import text-primary mr-2"></i>
                                <span>Importer</span>
                            </button>
                            <input type="file" name="sql_file" accept=".sql" id="sqlUpload" onchange="this.form.submit()" style="display: none;">
                        </form>

                        <div class="dropdown-divider"></div>

                        <!-- Exporter -->
                        <a class="dropdown-item d-flex align-items-center" href="?controller=book&action=exportDatabase">
                            <i class="fas fa-file-export text-primary mr-2"></i>
                            <span>Exporter</span>
                        </a>
                    </div>
                    </div>
                </div>

            </nav>
            <!-- End of Topbar -->

            <!-- Page Content -->
            <div class="container-fluid h-100">
                <!-- Ton contenu principal ici -->