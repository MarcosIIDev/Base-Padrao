<section class="content-header sessTit">
    <div class="container-fluid">
        <div class="row mb-2">
            <!-- Título -->
            <div  class="col-sm-6">
                <h1 style="font-size: 25px;">Editar Grupo</h1>
            </div>
            <!-- Lado Direito -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <a href="<?php echo BASE_URL; ?>/grupo" style="min-width: 95px; margin-right:  5px" type="button" class="btn btn-default btn-sm btn-tam"><i class="fas fa-times" title="Voltar"></i> Cancelar</a>
                    <button style="min-width: 95px; margin-right: -7px" type='submit' form="formGrupo"  class='btn bg-primary btn-sm btn-tam' ><i class="fas fa-check"></i> Salvar</button>
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

            <form class="needs-validation" id="formGrupo" name="formGrupo" novalidate method="POST" action="<?php echo BASE_URL; ?>/grupo/editMod/<?php echo $Grupo['grp_id']; ?>" data-toggle="validator" role="form">
                
                <div class="modal-body">
                    <!-- Formulário -->
                    <div class="row"> 
                        <div class="form-group col-sm-12 form-group-sm">
                            <label for="edgrupo">Nome do Grupo</label>
                            <input type="text" class="form-control text-uppercase" name="edgrupo"  maxlength="50" value="<?php echo $Grupo['grp_grupo']; ?>" required autofocus>
                            <div class="invalid-feedback">Digite um Nome</div>
                        </div>
                    </div> 
                    
                    <!-- Permissões -->
                    <div class="card">
                        <div class="card-header text-primaryt text-center bg-light font-weight-bold  "> ITENS DE PERMISSÕES </div>
                        <div style="min-height: 235px" class="card-body">
                            <!-- Itens de Permissão -->
                            <div class="row">
                                <?php foreach ($listPermissoes as $linha) : ?>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" <?php echo (in_array($linha['prm_slug'], $listLinks))?'checked':''; ?> <?php (in_array($linha['prm_slug'], $listLinks))?'checked':'' ?> class="flat-red uppercase" name="permissoes[]" value="<?php echo $linha['prm_id']; ?>"  id="perm-<?php echo $linha['prm_id']; ?>">
                                            <label style="font-size: 16px; font-weight: normal; "  for="perm-<?php echo $linha['prm_id']; ?>" ><?php echo $linha['prm_permissao']; ?> </label><br/>
                                        </div>
                                    </div> 
                                </div>    
                                <?php endforeach; ?>
                            </div>  
                        </div>    
                    </div>
                </div>    

            </form>
    
        </div><!-- /.card-body -->
              
    </div><!-- /.card -->
    
    <!-- Mensagem de Retorno de Erro -->
    <div style="position: fixed; right: 10px; top: 65px;" id="msg_erro">
        <?php if (!empty($msgReturnErr)) : ?>
            <div id="alertaErr" class="alert alert-light alert-dismissible fade show border-danger" role="alert">
                <span class="text-danger"> <img style="margin-left: -10px; margin-right: 7px;" src="<?php echo BASE_URL; ?>/assets/imagens/sistema/btn_close.png" /> <?php echo $msgReturnErr; ?></span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
        <?php endif; ?>
    </div><!-- /Mensagem de Erro -->
    

    <!-- Mensagem de Retorno de Sucesso -->
    <div style="position: fixed; right: 10px; top: 65px;" id="msg_erro">
        <?php if (!empty($msgReturnSucc)) : ?>
            <div id="alertaErr" class="alert alert-light alert-dismissible fade show border-success" role="alert">
                <span class="text-success"> <img style="margin-left: -10px; margin-right: 7px;" src="<?php echo BASE_URL; ?>/assets/imagens/sistema/btn_check.png" /> <?php echo $msgReturnSucc; ?></span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
        <?php endif; ?>
    </div><!-- /Mensagem de Sucesso -->
            
</section>
