<section class="content-header sessTit">
    <div class="container-fluid">
        <div class="row mb-2">
            <!-- Título -->
            <div  class="col-sm-6">
                <h1 style="font-size: 25px;">Relação de Permissões</h1>
            </div>
            <!-- Lado Direito -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <a style="min-width: 95px; margin-right:  5px" type="button" class="btn btn-default btn-sm" title="Imprimir Relação"><i class="fas fa-print"></i> Imprimir</a>
                    <a style="min-width: 95px; margin-right: -7px" type="button" class="btn bg-primary btn-sm text-white" title="Novo Registro" data-toggle="modal" data-target="#mdlAdicionar"><i class="fas fa-plus"></i> Adicionar</a>
                </ol>
                
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Conteudo da Pagina -->
<section class="content sessMargin">
    <!-- box Padrão -->
    <div class="card">
        <div style="min-height: 520px" class="card-body">
            <table class="table table-striped table-hover table-sm table-responsive-sm" id="tgtab5">
                <thead>
                    <th>Permissão</th>
                    <th class="text-center">Ordem</th>
                    <th>Slug</th>
                    <th class="text-center">Grupos</th>
                    <th width="90"></th>
                </thead>
                
                <tbody> 
                    <?php foreach ($listPermissoes as $linha): ?>
                    <tr>
                        <td><?php echo $linha['prm_permissao'] ?></td>
                        <td class="text-center"><?php echo $linha['prm_ordem'] ?></td>
                        <td><?php echo $linha['prm_slug'] ?></td>
                        <td class="text-center"><?php echo $linha['TOTAL_ITEM'] ?></td>
                        <td class="text-right">
                            <button class = 'btn btn-primary btn-xs' title = 'Editar' data-toggle = 'modal' data-target = '#mdlEdit<?php echo $linha['prm_id']?>'><i class="fas fa-pencil-alt"></i></button>
                            <?php if($linha['TOTAL_ITEM'] > 0){ ?>
                                <button style="cursor: no-drop" class = 'btn btn-danger btn-xs disabled' title = 'Excluir' ><i class="fas fa-trash-alt"></i></i></button>
                            <?php } else { ?>  
                                <button class = 'btn btn-danger btn-xs' title = 'Excluir' data-toggle = 'modal' data-target = '#mdlExcluir<?php echo $linha['prm_id']?>'><i class="fas fa-trash-alt"></i></i></button>
                            <?php } ?> 
                        </td>
                    </tr>
                    
                    <!-- Modal Exclusao de Registro-->
                    <div class="modal" id="mdlExcluir<?php echo $linha['prm_id']?>" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body text-center">
                                    <img class="text-center" src="<?php echo BASE_URL; ?>/assets/imagens/sistema/msg_error.png"  width="85px">
                                    <br/>
                                    <span style="font-size: 30px; color: #595959"><b>Exclusão de Item de Permissão</b></span><br/>
                                    <b style="font-size: 20px" class="text-danger"><?php echo mb_strimwidth($linha['prm_permissao'], 0, 30, "...") ?></b><br><br>
                                    <a style="min-width: 100px; margin-right: 20px" type="button" class="btn btn-default btn-tam" data-dismiss="modal"><i class="fas fa-times"></i> Cancelar</a>
                                    <a style="min-width: 100px" href="<?php echo BASE_URL; ?>/permissao/delMod/<?php echo $linha['prm_id'] ?>" type='button' class='btn btn-danger btn-tam' ><i class="fas fa-trash-alt"></i> Excluir</a>
                                </div>
                            </div>
                        </div>
                    </div><!-- /Modal Exclusao de Registro-->
                    
                    <!-- Modal Editar -->
                    <div class="modal fade" id="mdlEdit<?php echo $linha['prm_id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form method="POST" action="<?php echo BASE_URL; ?>/permissao/editMod/<?php echo $linha['prm_id']?>" data-toggle="validator" role="form">
                                    <div class="modal-header bg-primary">
                                        <h5 class="modal-title" id="exampleModalLabel">Editar Permissão</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                        <div class="modal-body">
                                            <!-- Linha 01 -->
                                            <div class="row"> 
                                                <div class="form-group col-sm-12 form-group-sm">
                                                    <label for="edpermissao">Nome da Permissão</label>
                                                    <input type="text" class="form-control text-uppercase" name="edpermissao"  maxlength="50" value="<?php echo $linha['prm_permissao']?>" required autofocus>
                                                    <div class="help-block with-errors font10"></div>
                                                </div>
                                            </div> 
                                            <!-- Linha 02 -->
                                            <div class="row"> 
                                                <div class="form-group col-sm-12 form-group-sm">
                                                    <label for="edslug">Nome do Slug</label>
                                                    <input type="text" class="form-control text-uppercase" name="edslug"  maxlength="50" value="<?php echo $linha['prm_slug']?>" disabled>
                                                    <div class="help-block with-errors font10"></div>
                                                </div>
                                            </div>
                                            <!-- Linha 03 -->
                                            <div class="row"> 
                                                <div class="form-group col-md-12">
                                                    <label for="edordem">Ordem</label>
                                                    <input type="number" min="1" class="form-control" id="edordem" name="edordem"  value="<?php echo $linha['prm_ordem']?>" />
                                                </div>
                                            </div>    

                                        </div>

                                        <div class="modal-footer">
                                            <a type="button" class="btn btn-default btn-sm btn-tam" data-dismiss="modal"><i class="fas fa-times"></i> Cancelar</a>
                                            <button type='submit' class='btn btn-primary btn-sm btn-tam' ><i class="fas fa-check"></i> Salvar</button>
                                        </div>
                                    </form>  
                                
                            </div><!-- /.modal-content-->
                            
                        </div><!-- /.modal-dialog-->
                        
                    </div><!-- Modal Exclusao de Registro-->

                    <?php endforeach; ?>
                    
                </tbody>
                
            </table>
            
        </div><!-- /.card-body -->
              
    </div><!-- /.card -->
            
    <!-- Modal Adicionar -->
    <div class="modal fade" id="mdlAdicionar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="needs-validation" novalidate method="POST" action="<?php echo BASE_URL; ?>/permissao/addMod" data-toggle="validator" role="form">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="exampleModalLabel">Adicionar Permissão</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <!-- Linha 01 -->
                    <div class="row"> 
                        <div class="form-group col-sm-12 form-group-sm">
                            <label for="edpermissao">Nome do Item de Permissão</label>
                            <input type="text" class="form-control text-uppercase" name="edpermissao"  maxlength="50" value="" required>
                            <div class="help-block with-errors font10"></div>
                        </div>
                    </div> 
                    <!-- Linha 02 -->
                    <div class="row"> 
                        <div class="form-group col-sm-12 form-group-sm">
                            <label for="edslug">Nome do Slug</label>
                            <input type="text" class="form-control text-uppercase" name="edslug"  maxlength="50" value="" required>
                            <div class="help-block with-errors font10"></div>
                        </div>
                    </div>
                    <!-- Linha 03 -->
                    <div class="row"> 
                        <div class="form-group col-md-12">
                            <label for="edordem">Ordem</label>
                            <input type="number" min="1" class="form-control" id="edordem" name="edordem" />
                        </div>
                    </div>  

                </div>

                <div class="modal-footer">
                    <a type="button" class="btn btn-default btn-sm btn-tam" data-dismiss="modal"><i class="fas fa-times"></i> Cancelar</a>
                    <button type='submit' class='btn bg-primary btn-sm btn-tam' ><i class="fas fa-check"></i> Salvar</button>
                </div>
            </form>  
            </div>
        </div>
    </div><!-- Modal Ediçao de Registro-->
    
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

