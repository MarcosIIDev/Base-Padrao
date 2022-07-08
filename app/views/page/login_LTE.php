<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <!-- Metas -->
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Sistema de Controle">
        <meta name="author" content="Luciano Alves">

        <!-- Título-->
        <title>Login</title>
        
        <!-- css -->
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/plugins/fontawesome/css/all.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/plugins/icheck/icheck-bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/plugins/adminLTE/css/adminlte.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>/assets/plugins/fonts/font-google.css" />
    </head>

    <body class="hold-transition login-page">
        <div class="login-box">
            
            <!-- Logo -->
            <div class="login-logo">
              <a href="<?php echo BASE_URL; ?>"><b>Admin</b>LTE</a>
            </div>
            
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Faça login para iniciar sua sessão</p>

                    <form action="../../index3.html" method="post">
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="Email">
                            <div class="input-group-append">
                              <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                              </div>
                            </div>
                        </div>
                        
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Senha">
                            <div class="input-group-append">
                              <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                              </div>
                            </div>
                        </div>
                        
                        <div class="row">
                          <div class="col-8">
                            <div class="icheck-primary">
                              <input type="checkbox" id="remember">
                              <label for="remember">
                                Lembre-me
                              </label>
                            </div>
                          </div>
                          <!-- /.col -->
                          <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Enviar</button>
                          </div>
                          <!-- /.col -->
                        </div>
                    </form>

                </div><!-- /.login-card-body -->
    
            </div><!-- /card -->
            
        </div><!-- /.login-box -->

        <!-- JQuery/JavaScript -->
        <script src="<?php echo BASE_URL; ?>/assets/plugins/jquery/jquery.min.js"></script>
        <script src="<?php echo BASE_URL; ?>/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo BASE_URL; ?>/assets/plugins/adminLTE/js/adminlte.min.js"></script>

    </body>
    
</html>