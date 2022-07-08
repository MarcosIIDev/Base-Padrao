<!-- Menu Lateral -->
<nav class="mt-2">
    
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        
        <!-- Menu HOME -->
        <li class="nav-item">
            <a href="<?php echo BASE_URL ?>" class="nav-link <?php echo ($viewData['menu'] == 'home')?'active':''; ?>">
                <i class="nav-icon fas fa-home mr-3"></i>
                <p> Home </p>
            </a>
        </li>
                            
        <!-- Menu ADMINISTRADOR -->
        <li class="nav-item has-treeview <?php echo ($viewData['menu'] == 'unidade' || $viewData['menu'] == 'usuario' || $viewData['menu'] == 'grupo')?'menu-open':''; ?>">
            <a href="#" class="nav-link <?php echo ($viewData['menu'] == 'unidade' || $viewData['menu'] == 'usuario' || $viewData['menu'] == 'grupo')?'active':''; ?>">
                <i class="nav-icon fas fa-users-cog mr-3"></i>
                <p> Administrador <i class="right fas fa-angle-left"></i> </p>
            </a>
            <ul class="nav nav-treeview">
                <!-- Cad de Unidade -->
                <li class="nav-item">
                    <a href="<?php echo BASE_URL ?>/unidade" class="nav-link <?php echo ($viewData['menu'] == 'unidade')?'active':''; ?>">
                    <i class="fas fa-house-user mr-3"></i>
                    <p>Cad. de Unidade</p>
                    </a>
                </li>
                <!-- Cad de Usuario -->
                <li class="nav-item">
                    <a href="<?php echo BASE_URL ?>/usuario" class="nav-link <?php echo ($viewData['menu'] == 'usuario')?'active':''; ?>">
                    <i class="fas fa-user-plus mr-3"></i>
                    <p>Cad. de Usuário</p>
                    </a>
                </li>
                <!-- Cad de Grupo -->
                <li class="nav-item">
                    <a href="<?php echo BASE_URL ?>/grupo" class="nav-link <?php echo ($viewData['menu'] == 'grupo')?'active':''; ?>">
                    <i class="fas fa-layer-group mr-3"></i>
                    <p>Cad. de Grupo</p>
                    </a>
                </li>
                
            </ul>
        </li>
        
        <!-- Menu LOGOUT -->
        <li class="nav-item">
            <a href="<?php echo BASE_URL ?>/login/logout" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt mr-3"></i>
                <p> Logout </p>
            </a>
        </li>
        
    </ul>
    
</nav>    <!-- /.sidebar-menu -->