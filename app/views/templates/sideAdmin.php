<aside class="control-sidebar control-sidebar-dark">
    <!--Área do Super Admin -->
    <div class="p-2">
        <nav>
            <!-- Abas -->
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a style="min-width: 60px" class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true" title="Configurações"><i class="fas fa-cogs"></i></a>
                <a style="min-width: 60px" class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false" title="Financeiro"><i class="fas fa-dollar-sign"></i></a>
                <a style="min-width: 60px" class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-check" role="tab" aria-controls="nav-check" aria-selected="false" title="Checklist"><i class="fas fa-tasks"></i></a>
            </div>
        </nav>

        <div class="tab-content" id="nav-tabContent">
            <!-- Aba Configurações -->
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <p><a href="<?php echo BASE_URL; ?>/permissao" class=""> <i style="margin-left: -10px; margin-right: 10px" class="fas fa-puzzle-piece"></i> Ctrl de Permissões </a> </p>
                <p><a href="<?php echo BASE_URL; ?>/ConfigSys" class=""> <i style="margin-left: -10px; margin-right: 10px" class="fas fa-cog"></i> Config. do Sistema </a> </p>
                <p><a href="<?php echo BASE_URL; ?>/ConfigSys/backupBD" class=""> <i style="margin-left: -10px; margin-right: 12px" class="nav-icon fas fa-database"></i> Backup de BD </a> </p>
            </div><!-- /Aba Configurações -->

            <!-- Aba Financeiro -->
            <div  class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <p><a href="<?php echo BASE_URL; ?>/Pagamento" class=""> <i style="margin-left: -10px; margin-right: 10px" class="fas fa-hand-holding-usd"></i> Receb. de Mensalidade </a> </p>
                <p> <a href="#" class=""> <i style="margin-left: -10px; margin-right: 17px" class="fas fa-dollar-sign"></i> Controle de Pagamento </a> </p>
            </div><!-- /Aba Financeiro -->

            <!-- Aba Checklist -->
            <div  class="tab-pane fade" id="nav-check" role="tabpanel" aria-labelledby="nav-check-tab">

                <!-- Checklist -->   
                
            </div><!-- /Aba Checklist -->

        </div><!-- /.tab-content -->

    </div><!-- /.p-2 -->

</aside><!-- /.control-sidebar -->