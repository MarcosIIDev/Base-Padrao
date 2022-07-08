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
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/plugins/bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/plugins/adminLTE/css/adminlte.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/plugins/fonts/font-google.css" />
        
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/plugins/icheck/icheck-bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/plugins/datatables/datatables.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/plugins/sweetalert2/sweetalert2.all.min.css" />
        
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/personalizado/css/style.css" />
        
    </head>
    
    <body class="hold-transition sidebar-mini">
        
        <div class="wrapper">

            <!-- Navbar CORES: navbar-(cores) - navbar-(light/dark) -->
            <nav class="main-header navbar navbar-expand navbar-info navbar-light">
                <!-- Menu Superior Esquerdo -->
                <ul class="navbar-nav">
                    <li class="nav-item"> <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a> </li>
                    <!-- <li class="nav-item d-none d-sm-inline-block"> <a href="index3.html" class="nav-link">Home</a> </li> -->
                </ul>
                
                <!-- Formulario de Pesquisa -->
                <?php //include 'templates/formPesquisa.php'; ?>

                <!-- Menu Superior Direito -->
                <ul class="navbar-nav ml-auto">
                    
                    <!-- Menu de Messagem -->
                    <?php //include 'templates/menuMensagens.php'; ?>

                    <!-- Menu de Notificações -->
                    <?php //include 'templates/menuNotificacoes.php'; ?>

                    <!-- Menu de Usuario -->
                    <?php include 'templates/menuUser.php'; ?>
					
					<!-- Menu de Linguagem -->
                    <?php include 'templates/menuLinguagem.php'; ?>
                    <?php //include 'templates/menuLinguagem_IMG.php'; ?>

                    <!-- Menu S/Admin -->
                    <?php if($viewData['user']->hasPermissao('SUPER_ADMIN')) {
                        include 'templates/menuAdmin.php';} 
                    ?>
                    
                </ul>

            </nav><!-- /.navbar -->

            <!-- Menu Lateral Principal - CORES: sidebar-(dark/light)-(cores) -->
            <aside class="main-sidebar sidebar-light-info elevation-4">
                <!-- Logotipo da marca - CORES: (bg-info) -->
                <a href="<?php echo BASE_URL; ?>" class="brand-link bg-info">
                    <img src="<?php echo BASE_URL; ?>/assets/imagens/adminLTE/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">AdminLTE 3</span>
                </a>

                <!-- Sidebar Esquerdo -->
                <div class="sidebar">
                    <!-- Painel do usuário (optional) -->
                    <?php //include 'templates/painelUser.php'; ?>

                    <!-- Menu Lateral Esquerdo -->
                    <?php include 'templates/menuLateral.php'; ?>

                </div><!-- /.sidebar -->

            </aside><!-- /Menu Lateral Principal -->

            
            <!-- Conteudo da Pagina  -->
            <div class="content-wrapper">

                <!-- *** CONTEUDO DINÂMICO *** -->
                <?php $this->loadViewInTemplate($viewName, $viewData); ?>   

            </div> <!-- /.conteudo da Pagina -->

            
            <!-- Sidebar Direito -->
            <?php include 'templates/sideAdmin.php'; ?>

            <!-- Footer -->
            <?php include 'templates/footer.php'; ?>
            
            
        </div><!-- ./wrapper -->

        <!-- jQuery -->
        <script src="<?php echo BASE_URL; ?>/assets/plugins/jquery/jquery.min.js"></script>
        <script src="<?php echo BASE_URL; ?>/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo BASE_URL; ?>/assets/plugins/adminLTE/js/adminlte.min.js"></script>
        
        <script src="<?php echo BASE_URL; ?>/assets/plugins/datatables/datatables.min.js"></script>
        <script src="<?php echo BASE_URL; ?>/assets/plugins/file-input/bs-custom-file-input.min.js"></script>
        <script src="<?php echo BASE_URL; ?>/assets/plugins/jquery-mask/jquery.mask.min.js"></script>
        <script src="<?php echo BASE_URL; ?>/assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
        
        <script src="<?php echo BASE_URL; ?>/assets/personalizado/js/script.js"></script>
        <script src="<?php echo BASE_URL; ?>/assets/personalizado/js/tbGrid.js"></script>
        
        
        
        <!-- Trocar Senha -->
        <div class="modal fade bd-example-modal-sm" id="TrocaSenha" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <form class="needs-validation" novalidate id="formTrocaSenha" name="formTrocaSenha"  action="<?php echo BASE_URL; ?>" method="POST">
                        <div class="modal-header bg-info">
                            <h5 class="modal-title" id="exampleModalLabel"><i style="font-size: 16px; margin-right: 10px" class="fas fa-key"></i> Trocar Senha</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>

                        <div class="modal-body">
                            <!-- Linha 01 -->
                            <div class="row"> 
                                <div class="form-group col-sm-12 form-group-sm">
                                    <label for="edsenhaantiga">Senha Antiga</label>
                                    <input type="text" class="form-control text-uppercase" name="edsenhaantiga" id='edsenhaantiga'  maxlength="10" value="" required>
                                    <div class="invalid-feedback">Digite sua senha anterior</div>
                                </div>
                            </div> 
                            <!-- Linha 02 -->
                            <div class="row"> 
                                <div class="form-group col-sm-12 form-group-sm">
                                    <label for="edsenhanew">Nova Senha</label>
                                    <input type="text" class="form-control text-uppercase" name="edsenhanew" id='edsenhanew' minlength="6"  maxlength="10" value="" required>
                                    <div class="invalid-feedback">Minimo 6 caracteres</div>
                                </div>
                            </div> 
                            <!-- Linha 03 -->
                            <div class="row"> 
                                <div class="form-group col-sm-12 form-group-sm">
                                    <label for="edsenhaconfirm">Confirmar Nova Senha</label>
                                    <input type="text" class="form-control text-uppercase" name="edsenhaconfirm" id='edsenhaconfirm' minlength="6"  maxlength="10" value="" required>
                                    <div class="invalid-feedback">As Senhas não estão iguais</div>
                                </div>
                            </div> 
                        </div><!-- /.modal-body -->

                        <div class="modal-footer">
                            <a style="min-width: 100px" type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fas fa-times"></i> Cancelar</a>
                            <button style="min-width: 100px" type='submit' class='btn btn-info btn-sm' ><i class="fas fa-check"></i> Salvar</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    
    </body>
    
</html>