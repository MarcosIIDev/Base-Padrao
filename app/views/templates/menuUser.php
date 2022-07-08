<!-- Menu de Usuario -->
<li class="nav-item dropdown user-menu">
    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
        <img src="<?php echo BASE_URL; ?>/assets/imagens/user/<?php echo $viewData['user'] -> userFoto ?>" class="user-image img-circle elevation-2" alt="User Image">
    </a>
        
    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <!-- User image - CORES: (bg-teal) -->
        <li class="user-header bg-info">
            <img src="<?php echo BASE_URL; ?>/assets/imagens/user/<?php echo $viewData['user'] -> userFoto ?>" class="img-circle elevation-2" alt="User Image">
            <p>
                <?php echo mb_strimwidth($viewData['user'] -> userNome, 0, 25, "...") ?> 
                <small><?php echo $viewData['user'] -> userGrupo ?></small>
            </p>
        </li>

        <!-- Menu Body 
        <li class="user-body">
            <div class="row">
                <div class="col-4 text-center"> <a href="#">Followers</a> </div>
                <div class="col-4 text-center"> <a href="#">Sales</a> </div>
                <div class="col-4 text-center"> <a href="#">Friends</a> </div>
           </div>
        </li> -->

        <!-- Menu Footer-->
        <li class="user-footer">
            <a style="min-width: 115px" href="#" class="btn bg-info btn-flat" data-toggle="modal" data-target="#TrocaSenha"> <i class="fas fa-key"></i> Trocar Senha </a>
            <a style="min-width: 115px" href="<?php echo BASE_URL ?>/login/logout" class="btn bg-info btn-flat float-right"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </li>
    </ul>
    
</li><!-- /Menu de Usuario -->

