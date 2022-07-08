<section class="content-header sessTit">
    <div class="container-fluid">
        <div class="row mb-2">
            <!-- Título -->
            <div  class="col-sm-6">
                <h1 style="font-size: 25px;">Editar Unidade</h1>
            </div>
            <!-- Lado Direito -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <a href="<?php echo BASE_URL; ?>/unidade/index" style="min-width: 95px; margin-right:  5px" type="button" class="btn btn-default btn-sm" title="Voltar" ><i class="fas fa-times"></i> Cancelar</a>
                    <button style="min-width: 95px; margin-right: -7px" type='submit' form="formUnidade" class='btn bg-primary btn-sm btn-tam' ><i class="fas fa-check"></i> Salvar</button>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Conteudo da Pagina -->
<section  class="content sessMargin">
    
    <form class="needs-validation" novalidate id="formUnidade" name="formUnidade" action="<?php echo BASE_URL; ?>/unidade/editMod/<?php echo $Unidade['und_id']; ?>" method="post">
        <!-- Abas -->
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#tab01" role="tab" aria-controls="nav-home" aria-selected="true">Dados</a>
              <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#tab02" role="tab" aria-controls="nav-profile" aria-selected="false">Observações</a>
            </div>
        </nav>

        <!-- Conteudo da Abas -->
        <div class="tab-content boxligth" id="nav-tabContent">
            <!-- Aba Dados -->
            <div class="tab-pane fade show active" id="tab01" role="tabpanel" aria-labelledby="nav-home-tab">
                <!-- Linha 01 -->
                <div class="form-row">
                    <div class="form-group col-md-10">
                        <label for="edunidade">Nome da Unidade</label>
                        <input type="text" class="form-control text-uppercase" id="edunidade" name="edunidade" maxlength="100" value="<?php echo $Unidade['und_unidade']; ?>" required />
                        <div class="invalid-feedback">Digite o nome da Unidade</div>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="edativo">Ativo</label>
                        <select class="form-control" id="edativo" name="edativo" required>
                            <option value="S" <?php echo ($Unidade['und_ativo'] == 'S') ? 'selected':'' ?>>SIM</option>
                            <option value="N" <?php echo ($Unidade['und_ativo'] == 'N') ? 'selected':'' ?>>NÃO</option>
                        </select>        
                    </div>
                </div>
                <!-- Linha 02 -->
                
                <!-- Linha 03 -->
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="edend">Endereço</label>
                        <input type="text" class="form-control text-uppercase" id="edend" name="edend" maxlength="100" value="<?php echo $Unidade['und_end']; ?>" />
                    </div>
                    <div class="form-group col-md-3">
                        <label for="edbairro">Bairro</label>
                        <input type="text" class="form-control text-uppercase" id="edbairro" name="edbairro" maxlength="30" value="<?php echo $Unidade['und_bairro']; ?>" />
                    </div>
                    <div class="form-group col-md-2">
                        <label for="edcidade">Cidade</label>
                        <input type="text" class="form-control text-uppercase" id="edcidade" name="edcidade" maxlength="30" value="<?php echo $Unidade['und_cidade']; ?>" required />
                        <div class="invalid-feedback">Digite uma Cidade</div>
                    </div>
                    <div class="form-group col-md-1">
                        <label for="eduf">UF</label>
                        <input type="text" class="form-control text-uppercase" id="eduf" name="eduf" maxlength="2"  value="<?php echo $Unidade['und_uf']; ?>" required />
                    </div>
                </div>   
                <!-- Linha 04 -->
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="edcep">CEP</label>
                        <input type="text" class="form-control" id="edcep" name="edcep" maxlength="10" onkeypress="$(this).mask('00.000-000')" value="<?php echo $Unidade['und_cep']; ?>" />
                    </div>
                    <div class="form-group col-md-2">
                        <label for="edfone1">Fone Com.</label>
                        <input type="text" class="form-control" id="edfone1" name="edfone1" maxlength="15" onkeypress="$(this).mask('(00) 0000-0000')" value="<?php echo $Unidade['und_fone1']; ?>" required />
                        <div class="invalid-feedback">Digite um número de Telefone</div>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="edfone2">Fone/Fax</label>
                        <input type="text" class="form-control" id="edfone2" name="edfone2" maxlength="15" onkeypress="$(this).mask('(00) 0000-0000')" value="<?php echo $Unidade['und_fone2']; ?>" />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="edemail">Email</label>
                        <input type="email" class="form-control text-lowercase" id="edemail" name="edemail" maxlength="50" value="<?php echo $Unidade['und_email']; ?>" />
                        <div class="invalid-feedback">Digite um email válido</div>
                    </div>
                </div>   
                <!-- Linha 05 -->
                <div class="form-row">
                    <div class="form-group col-md-10">
                        <label for="edresp">Nome do Responsável</label>
                        <input type="text" class="form-control text-uppercase" id="edresp" name="edresp" maxlength="100" value="<?php echo $Unidade['und_resp']; ?>" required />
                        <div class="invalid-feedback">Digite o nome do Responsável pela Unidade</div>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="edrespfone">Fone do Resp.</label>
                        <input type="text" class="form-control" id="edrespfone" name="edrespfone" maxlength="15"  onkeypress="$(this).mask('(00) 00000-0000')" value="<?php echo $Unidade['und_respfone']; ?>" />
                    </div>
                </div>  
                
            </div><!-- /Aba Dados -->

            <!-- Aba Observações -->
            <div class="tab-pane fade" id="tab02" role="tabpanel" aria-labelledby="nav-profile-tab">
                <!-- Linha 01 -->
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="edobs">Observações</label>
                        <textarea class="form-control" id="edobs" name="edobs" rows="15" > <?php echo $Unidade['und_obs']; ?></textarea>
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
