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
                <img src="<?php echo BASE_URL; ?>/assets/imagens/sistema/logo.png" height="120" class="user-image text-center">
            </div>
            
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg text-primary">Faça o login para iniciar sua sessão</p>

                    <form class="needs-validation" novalidate id="formLogin"  action="<?php echo BASE_URL; ?>/login/checkLogin" method="post">
                        <!-- Usuário -->
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Usuário"  name="edlogin" required="true">
                            <div class="input-group-append">
                                <div class="input-group-text"> <i class="fas fa-user text-primary"></i> </div>
                            </div>
                            <div class="invalid-feedback">Digite o nome do Usuário</div>
                        </div>
                        
                        <!-- Senha -->
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Senha"  name="edsenha" required>
                            <div class="input-group-append">
                                <div class="input-group-text"> <i class="fas fa-lock text-primary"></i> </div>
                            </div>
                            <div class="invalid-feedback">Digite sua Senha</div>
                        </div>
                        
                        <!-- Input Unidade -->
                        <div class="form-group">
                            <select class="form-control" id="edunidade" name="edunidade" <?php echo (count($listUnidades) > 1) ? 'required' : 'readonly' ?>>
                                <?php if (count($listUnidades) > 1) : ?>
                                    <option value="">SELECIONE UMA UNIDADE</option>
                                <?php endif; ?>
                                    
                                <?php foreach ($listUnidades as $dados): ?>
                                    <option value="<?php echo $dados['und_id'] ?>"><?php echo $dados['und_unidade'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">Selecione uma Unidade</div>
                        </div>
                        
                        
                        <!-- btn Enviar -->
                        <div class="social-auth-links text-center mb-3">
                            <button type="submit" class="btn bg-primary btn-block"> Entrar</button>
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