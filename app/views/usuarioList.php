<section class="content-header sessTit">
    <div class="container-fluid">
        <div class="row mb-2">
            <!-- Título -->
            <div  class="col-sm-6">
                <h1 style="font-size: 25px;">Relação de Usuários </h1>
            </div>
            <!-- Lado Direito -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <a style="min-width: 95px; margin-right:  5px" type="button" class="btn btn-default btn-sm" title="Imprimir Relação"><i class="fas fa-print"></i> Imprimir</a>
                    <a href="<?php echo BASE_URL; ?>/usuario/adicionar" style="min-width: 95px; margin-right: -20px" type="button" class="btn bg-primary btn-sm" title="Novo Registro" ><i class="fas fa-plus"></i> Adicionar</a>
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
            <table class="table table-striped table-hover table-sm table-responsive-sm" id="tgSemOrdem">
                <thead>
                    <th width="60"></th>
                    <th>Nome do Usuário</th>
                    <th>Login</th>
                    <th>Grupo</th>
                    <th>Unidade</th>
                    <th width="90"></th>
                </thead>
                
                <tbody> 
                    <?php 
                        foreach ($listUsuarios as $linha) : 
                            //Foto
                            $foto = ($linha['usu_foto'] == '' OR !file_exists(PATH_USER.$linha['usu_foto'])) ? "no_photo.png" : $linha['usu_foto'];
                        
                    ?>
                    <tr <?php echo ($linha['usu_ativo'] == 'N') ? "class='text-danger'":"" ?>>
                        <td><img src="<?php echo BASE_URL; ?>/assets/imagens/user/<?php echo $foto ?>" alt="Product 1" class="img-circle img-size-50 mr-2"> </td>
                        <td class="align-middle"><?php echo mb_strimwidth($linha['usu_usuario'], 0, 35, "..."); ?></td>
                        <td class="align-middle"><?php echo $linha['usu_login'] ?></td>
                        <td class="align-middle"><?php echo $linha['grp_grupo'] ?></td>
                        <td class="align-middle"><?php echo $linha['und_unidade'] ?></td>
                        <td class="align-middle text-right">
                            <a href='<?php echo BASE_URL; ?>/usuario/editar/<?php echo $linha['usu_id']?>' class = 'btn btn-primary btn-xs' title = 'Editar'><i class="fas fa-pencil-alt"></i></a>
                            <?php if (!$viewData['user']->hasPermissao('N_DELREG')): ?>
                                <button style="cursor: no-drop" class = 'btn btn-danger btn-xs disabled' title = 'Excluir' ><i class="fas fa-trash-alt"></i></i></button>
                            <?php else : ?>  
                                <button class = 'btn btn-danger btn-xs' title = 'Excluir' data-toggle = 'modal' data-target = '#mdlExcluir<?php echo $linha['usu_id']?>'><i class="fas fa-trash-alt"></i></button>
                            <?php endif; ?> 
                        </td>
                    </tr>
                    
                    <!-- Modal Exclusao de Registro-->
                    <div class="modal" id="mdlExcluir<?php echo $linha['usu_id']?>" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body text-center">
                                    <img class="text-center" src="<?php echo BASE_URL; ?>/assets/imagens/sistema/msg_error.png"  width="85px">
                                    <br/>
                                    <span style="font-size: 30px; color: #595959"><b>Exclusão de Usuário</b></span><br/>
                                    <b style="font-size: 20px" class="text-danger"><?php echo mb_strimwidth($linha['usu_usuario'], 0, 30, "...") ?></b><br><br>
                                    <a style="min-width: 100px; margin-right: 20px" type="button" class="btn btn-default btn-tam" data-dismiss="modal"><i class="fas fa-times"></i> Cancelar</a>
                                    <a style="min-width: 100px" href="<?php echo BASE_URL; ?>/usuario/delMod/<?php echo $linha['usu_id'] ?>" type='button' class='btn btn-danger btn-tam' ><i class="fas fa-trash-alt"></i> Excluir</a>
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

 
