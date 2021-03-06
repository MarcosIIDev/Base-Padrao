<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <!-- Metas -->
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Modelo MVC">
        <meta name="author" content="Luciano Alves">

        <!-- Título-->
        <title>New Projeto</title>
        
        <!-- css -->
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/plugins/fontawesome/css/all.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/plugins/adminLTE/css/adminlte.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/plugins/fonts/font-google.css" />
        
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/plugins/icheck/icheck-bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/plugins/datatables/datatables.min.css" />
        
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/personalizado/css/style.css" />
        
    </head>
    
    <body class="hold-transition sidebar-mini">
        
        <div class="wrapper">

            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Menu Superior Esquerdo -->
                <ul class="navbar-nav">
                    <li class="nav-item"> <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a> </li>
                    <li class="nav-item d-none d-sm-inline-block"> <a href="index3.html" class="nav-link">Home</a> </li>
                    <li class="nav-item d-none d-sm-inline-block"> <a href="#" class="nav-link">Contact</a> </li>
                </ul>

                <!-- Formulario de Pesquisa -->
                <form class="form-inline ml-3">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit"> <i class="fas fa-search"></i> </button>
                        </div>
                    </div>
                </form>

                <!-- Menu Superior Direito -->
                <ul class="navbar-nav ml-auto">
                    <!-- Menu de Mensagem -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                          <i class="far fa-comments"></i> <span class="badge badge-danger navbar-badge">3</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                            <a href="#" class="dropdown-item">
                                <!-- Message Start -->
                                <div class="media">
                                    <img src="<?php echo BASE_URL; ?>/assets/imagens/adminLTE/user1.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            Brad Diesel
                                            <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                        </h3>
                                        <p class="text-sm">Call me whenever you can...</p>
                                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                    </div>
                                </div><!-- Message End -->
                            </a>

                            <div class="dropdown-divider"></div>

                            <a href="#" class="dropdown-item">
                                <!-- Message Start -->
                                <div class="media">
                                    <img src="<?php echo BASE_URL; ?>/assets/imagens/adminLTE/user2.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            John Pierce
                                            <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                        </h3>
                                        <p class="text-sm">I got your message bro</p>
                                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                    </div>
                                </div><!-- Message End -->
                            </a>

                            <div class="dropdown-divider"></div>

                            <a href="#" class="dropdown-item">
                                <!-- Message Start -->
                                <div class="media">
                                    <img src="<?php echo BASE_URL; ?>/assets/imagens/adminLTE/user3.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            Nora Silvester
                                            <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                                        </h3>
                                        <p class="text-sm">The subject goes here</p>
                                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                    </div>
                                </div><!-- Message End -->
                            </a>

                            <div class="dropdown-divider"></div>

                            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>

                        </div><!-- /dropdown-menu dropdown-menu-lg dropdown-menu-right -->

                    </li><!-- /Menu de Mensagem -->

                    <!-- Menu de notificações -->
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="far fa-bell"></i>
                            <span class="badge badge-warning navbar-badge">15</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <span class="dropdown-header">15 Notifications</span>

                            <div class="dropdown-divider"></div>

                            <a href="#" class="dropdown-item">
                              <i class="fas fa-envelope mr-2"></i> 4 new messages
                              <span class="float-right text-muted text-sm">3 mins</span>
                            </a>

                            <div class="dropdown-divider"></div>

                            <a href="#" class="dropdown-item">
                              <i class="fas fa-users mr-2"></i> 8 friend requests
                              <span class="float-right text-muted text-sm">12 hours</span>
                            </a>

                            <div class="dropdown-divider"></div>

                            <a href="#" class="dropdown-item">
                              <i class="fas fa-file mr-2"></i> 3 new reports
                              <span class="float-right text-muted text-sm">2 days</span>
                            </a>

                            <div class="dropdown-divider"></div>

                            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                        </div><!-- /dropdown-menu dropdown-menu-lg dropdown-menu-right -->

                    </li><!-- /Menu de notificações -->

                    <!-- Btn Super Administrador -->
                    <li class="nav-item">
                        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                            <i class="fas fa-th-large"></i>
                        </a>
                    </li>

                </ul>

            </nav><!-- /.navbar -->

            <!-- Menu Lateral Principal -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Logotipo da marca -->
                <a href="<?php echo BASE_URL; ?>" class="brand-link">
                    <img src="<?php echo BASE_URL; ?>/assets/imagens/adminLTE/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">AdminLTE 3</span>
                </a>

                <!-- Paineis -->
                <div class="sidebar">
                    <!-- Painel do usuário -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="<?php echo BASE_URL; ?>/assets/imagens/adminLTE/user2.jpg" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block">Alexander Pierce</a>
                        </div>
                    </div>

                    <!-- Menu Lateral -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <!-- Home -->
                            <li class="nav-item">
                                <a href="#" class="nav-link active">
                                  <i class="nav-icon fas fa-th"></i>
                                  <p> Pagina Principal <span class="right badge badge-danger">New</span> </p>
                                </a>
                            </li>

                            <!-- SubMenu -->
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p> Starter Pages <i class="right fas fa-angle-left"></i> </p>
                                </a>

                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                          <a href="#" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Active Page</p>
                                          </a>
                                    </li>
                                    <li class="nav-item">
                                          <a href="#" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Inactive Page</p>
                                          </a>
                                    </li>
                                </ul>
                            </li>

                        </ul>

                    </nav><!-- /.sidebar-menu -->

                </div><!-- /.sidebar -->

            </aside><!-- /Menu Lateral Principal -->

            <!-- Conteúdo da página -->
            <div class="content-wrapper">

            </div><!-- /.Conteúdo da página -->

            <!-- Painel Administrador -->
            <aside class="control-sidebar control-sidebar-dark">
                <div class="p-3">
                    <h5>Title</h5>
                    <p>Sidebar content</p>
                </div>
            </aside><!-- /Painel Administrador -->

            <!-- Rodapé Principal -->
            <footer class="main-footer">
              <!-- Texto da Direita -->
              <div class="float-right d-none d-sm-inline">
                    Anything you want
              </div>
              <!-- Texto da Esquerda -->
              <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
            </footer>

        </div><!-- ./wrapper -->

        <!-- jQuery -->
        <script src="<?php echo BASE_URL; ?>/assets/plugins/jquery/jquery.min.js"></script>
        <script src="<?php echo BASE_URL; ?>/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo BASE_URL; ?>/assets/plugins/adminLTE/js/adminlte.min.js"></script>
    
    </body>
    
</html>