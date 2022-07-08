<section class="content-header sessTit">
    <div class="container-fluid">
        <div class="row mb-2">
            <!-- Título -->
            <div  class="col-sm-6">
                <h1 style="font-size: 25px;">Relação de Grupos</h1>
            </div>
            <!-- Lado Direito -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <a href="<?php echo BASE_URL; ?>/pdf/relGrupos" style="min-width: 95px; margin-right:  5px" type="button" class="btn btn-default btn-sm" title="Imprimir Relação"><i class="fas fa-print"></i> Imprimir</a>
                    <a href="<?php echo BASE_URL; ?>/grupo/adicionar" style="min-width: 95px; margin-right: -7px" type="button" class="btn bg-primary btn-sm" title="Novo Registro" ><i class="fas fa-plus"></i> Adicionar</a>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Conteudo da Pagina -->
<section class="content sessMargin">
    <!-- box Padrão -->
    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-hover table-sm table-responsive-sm" id="tgtab3">
                <thead>
                    <th>Grupo de Permissão</th>
                    <th class="text-center" width="160">Usuários</th>
                    <th width="90"></th>
                </thead>
                
                <tbody> 
                    <?php foreach ($listGrupos as $linha) : ?>
                    <tr>
                        <td><?php echo $linha['grp_grupo'] ?></td>
                        <td class="text-center"><?php echo $linha['TOTAL_USER'] ?></td>
                        <td class="text-right">
                            <a href='<?php echo BASE_URL; ?>/grupo/editar/<?php echo $linha['grp_id']?>' class = 'btn btn-primary btn-xs' title = 'Editar'><i class="fas fa-pencil-alt"></i></a>
                            <?php if($linha['TOTAL_USER'] > 0 OR !$viewData['user']->hasPermissao('N_DELREG')): ?>
                                <button style="cursor: no-drop" class = 'btn btn-danger btn-xs disabled' title = 'Excluir' ><i class="fas fa-trash-alt"></i></i></button>
                            <?php else : ?>  
                                <button class = 'btn btn-danger btn-xs' title = 'Excluir' data-toggle = 'modal' data-target = '#mdlExcluir<?php echo $linha['grp_id']?>'><i class="fas fa-trash-alt"></i></i></button>
                            <?php endif; ?> 
                        </td>
                    </tr>
                    
                    <!-- Modal Exclusao de Registro-->
                    <div class="modal" id="mdlExcluir<?php echo $linha['grp_id']?>" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body text-center">
                                    <img class="text-center" src="<?php echo BASE_URL; ?>/assets/imagens/sistema/msg_error.png"  width="85px">
                                    <br/>
                                    <span style="font-size: 30px; color: #595959"><b>Exclusão de Grupo</b></span><br/>
                                    <b style="font-size: 20px" class="text-danger"><?php echo mb_strimwidth($linha['grp_grupo'], 0, 30, "...") ?></b><br><br>
                                    <a style="min-width: 100px; margin-right: 20px" type="button" class="btn btn-default btn-tam" data-dismiss="modal"><i class="fas fa-times"></i> Cancelar</a>
                                    <a style="min-width: 100px" href="<?php echo BASE_URL; ?>/grupo/delMod/<?php echo $linha['grp_id'] ?>" type='button' class='btn btn-danger btn-tam' ><i class="fas fa-trash-alt"></i> Excluir</a>
                                </div>
                            </div>
                        </div>
                    </div><!-- /Modal Exclusao de Registro-->
                    
                    <?php endforeach; ?>
                    
                </tbody>
                
            </table>
            
        </div><!-- /.card-body -->
              
    </div><!-- /.card -->
    
    <!-- Exibir Mensagem de Retorno -->
    <?php 
        $type  = ($msgReturnErr == '') ? "success" : "error";
        $title =  "Alteração de Registro";      
        $msg   = ($type == 'success') ? $msgReturnSucc : $msgReturnErr; 
    
        if ($msgReturnSucc <> '' OR $msgReturnErr <> '') :
    ?>        
        <script src="<?php echo BASE_URL; ?>/assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
        <script type="text/javascript">
            function alerta(type, title, message){
                Swal.fire({
                    icon: type,
                    title: title,
                    text: message,
                    showConfirmButton: false,
                    timer: 3000
                });
            }

            alerta("<?php echo $type; ?>", "<?php echo $title; ?>", "<?php echo $msg; ?>");
        </script>    
    <?php endif; ?> <!-- /Mensagem de Retorno -->
            
</section>

