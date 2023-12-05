<!-- left sidebar -->
        <!-- ============================================================== -->
        <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">
                                Administrateur
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-6" aria-controls="submenu-6"><i class="fas fa-fw fa-users"></i>Clients</a>
                                <div id="submenu-6" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('/list_societe') }}">Société</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('/list_client') }}">Client particulier</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/diffusion') }}">
                                        <i class="fas fa-fw fa-table"></i> Diffusion
                                    </a>
                                </li>
                            </li>
                            <li class="nav-item">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/index') }}">
                                        <i class="fas fa-fw fa-table"></i> Facture
                                    </a>
                                </li>
                            </li>
                            <li class="nav-item">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/statistique') }}">
                                        <i class="fas fa-fw fa-table"></i> Statistique
                                    </a>
                                </li>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
