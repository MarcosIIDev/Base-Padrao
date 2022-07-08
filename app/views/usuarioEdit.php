<section class="content-header sessTit">
    <div class="container-fluid">
        <div class="row mb-2">
            <!-- Título -->
            <div  class="col-sm-6">
                <h1 style="font-size: 25px;">Editar Usuário</h1>
            </div>
            <!-- Lado Direito -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <a href="<?php echo BASE_URL; ?>/usuario" style="min-width: 95px; margin-right:  5px" type="button" class="btn btn-default btn-sm" title="Voltar" ><i class="fas fa-times"></i> Cancelar</a>
                    <button style="min-width: 95px; margin-right: -7px" type='submit' form="formUsuario" class='btn bg-primary btn-sm btn-tam' ><i class="fas fa-check"></i> Salvar</button>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Conteudo da Pagina -->
<section  class="content sessMargin">
    
    <form class="needs-validation" novalidate id="formUsuario" name="formUsuario" action="<?php echo BASE_URL; ?>/usuario/editMod/<?php echo $Usuario['usu_id']; ?>" method="post" enctype="multipart/form-data">
        <!-- Abas -->
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#tab01" role="tab" aria-controls="nav-home" aria-selected="true">Dados</a>
              <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#tab02" role="tab" aria-controls="nav-profile" aria-selected="false">Observações/Foto</a>
            </div>
        </nav>

        <!-- Conteudo da Abas -->
        <div class="tab-content boxligth" id="nav-tabContent">
            <!-- Aba Dados -->
            <div class="tab-pane fade show active" id="tab01" role="tabpanel" aria-labelledby="nav-home-tab">
                <!-- Linha 1 -->
                <div class="row">
                    <div class="form-group form-group-sm col-md-6">
                        <label for="edusuario">Nome do Usuário </label>
                        <input type="text" class="form-control text-uppercase" name="edusuario" id="edusuario" maxlength="100" required value="<?php echo $Usuario['usu_usuario']; ?>">
                        <div class="invalid-feedback">Digite um Nome</div>
                    </div>
                    <div class="form-group form-group-sm col-md-6">
                        <label for="edativo">Ativo</label>
                        <select class="form-control" name="edativo" id="edativo" value="">
                            <option value="S" <?php echo ($Usuario['usu_ativo'] == 'S') ? 'selected':'' ?>>SIM</option>
                            <option value="N" <?php echo ($Usuario['usu_ativo'] == 'N') ? 'selected':'' ?>>NÃO</option>
                        </select>
                    </div>
                </div>  
                <!-- Linha 2 -->
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="edemail">Email</label>
                        <input type="email" class="form-control text-lowercase" id="edemail" name="edemail" maxlength="50" value="<?php echo $Usuario['usu_email']; ?>" />
                        <div class="invalid-feedback">Digite um email válido</div>
                    </div>
                </div>   
                <!-- Linha 3 -->
                <div class="row">
                    <div class="form-group form-group-sm col-md-6">
                        <label for="edlogin">Login </label>
                        <input type="text" class="form-control text-lowercase" name="edlogin" id="edlogin" maxlength="15" required value="<?php echo $Usuario['usu_login']; ?>">
                        <div class="invalid-feedback">Digite um Login</div>
                    </div>
                    <div class="form-group form-group-sm col-md-6">
                        <label for="edsenha" class="control-label">Senha </label>
                        <input type="password" class="form-control text-uppercase" name="edsenha" id="edsenha" maxlength="10" readonly value="*******">
                    </div>
                </div>
                <!-- Linha 4 -->
                <div class="row">
                    <div class="form-group form-group-sm col-md-12">
                        <label for="edgrupo" class="control-label">Grupo de Acesso </label>
                        <select class="form-control" name="edgrupo" id="edgrupo" required>
                            <option value="" >SELECIONE UM GRUPO</option>
                            <?php foreach ($listGrupos as $dados): ?>
                                <option value="<?php echo $dados['grp_id'] ?>" <?php echo ($Usuario['usu_grupo'] == $dados['grp_id']) ? 'selected':'' ?>><?php echo $dados['grp_grupo'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">Selecione um Grupo</div>
                    </div>
                </div>
                <!-- Linha 5 -->
                <div class="row">
                    <div class="form-group form-group-sm col-md-12">
                        <label for="edunidade" class="control-label">Unidade </label>
                        <select class="form-control" id="edunidade" name="edunidade" <?php echo (count($listUnidades) > 1) ? 'required' : 'readonly' ?>>
                            <?php foreach ($listUnidades as $dados): ?>
                            <option value="<?php echo $dados['und_id'] ?>" <?php echo ($Usuario['usu_unidade'] == $dados['und_id']) ? 'selected':'' ?>><?php echo $dados['und_unidade'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">Selecione uma Unidade</div>
                    </div>
                </div>    
            </div><!-- /Aba Dados -->

            <!-- Aba Observações -->
            <div class="tab-pane fade" id="tab02" role="tabpanel" aria-labelledby="nav-profile-tab">
                <!-- Linha 01 -->
                <div class="form-row">
                    <div class="form-group col">
                        <label for="edobs">Observações</label>
                        <textarea style="max-height: 217px" class="form-control" id="edobs" name="edobs" rows="9" ><?php echo $Usuario['usu_obs']; ?></textarea>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="edobs">Foto</label>
                        <div class="text-center">
                            <?php $foto = ($Usuario['usu_foto'] == '' OR !file_exists(PATH_USER.$Usuario['usu_foto'])) ? "no_photo.png" : $Usuario['usu_foto']; ?>
                            <img name="edfoto" src="<?php echo BASE_URL; ?>/assets/imagens/user/<?php echo $foto ?>" width="256" alt="Foto" class="img-thumbnail"> <br/>
                        </div>    
                    </div>
                </div>
                <!-- Linha 02 -->
                <div class="form-row">
                    <div class="form-group col">
                        <label for="edfile">Foto</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroupFileAddon01"><i class="fas fa-folder-open"></i></span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="edfile" id="customFileLang" lang="pt-br" onchange="previewImagem()" />
                                <label class="custom-file-label" for="customFileLang"><?php echo $Usuario['usu_foto']; ?></label>
                                <div class="invalid-feedback">Selecione um arquivo</div>
                            </div>

                        </div> 
                    </div>
                </div>   
            </div><!-- /Aba Observações -->

        </div>
    
    </form>
              
    
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
