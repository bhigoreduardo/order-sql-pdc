<!-- FIXME: HEADER -->

    <!-- FIXME: SIDEBAR -->
    <?php $this->load->view('layout/sidebar');  ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- FIXME: NAVBAR -->
            <?php $this->load->view('layout/navbar'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a title="Página inicial" href="<?php echo base_url('/'); ?>">Home</a></li>
                            <li class="breadcrumb-item"><a title="Vendedores" href="<?php echo base_url($this->router->fetch_class()); ?>">Vendedores</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo; ?></li>
                        </ol>
                        </nav>
                    </nav>

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800"><?php echo $titulo; ?></h1>

                    <!-- Form data -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="float-left">
                                <p class="float-left mr-2">
                                    <strong>
                                        <i class="fas fa-clock"></i>&nbsp;Última atualização:
                                    </strong>&nbsp;
                                    <?php echo formata_data_banco_com_hora($vendedor->vendedor_data_alteracao); ?>
                                </p>
                                <p class="float-left">
                                    <strong>
                                        <i class="fas fa-clock"></i>&nbsp;Data do cadastro:
                                    </strong>&nbsp;
                                    <?php echo formata_data_banco_com_hora($vendedor->vendedor_data_cadastro); ?>
                                </p>
                            </div>
                            <a title="Voltar" 
                                href="<?php echo base_url($this->router->fetch_class()); ?>" 
                                class="btn btn-sm btn-success float-right">
                                <i class="fas fa-arrow-left"></i>&nbsp;
                                Voltar
                            </a>
                        </div>
                        <div class="card-body">
                            <form method="POST" name="form_edit">
                                <fieldset class="mb-4 p-2 border">
                                    <legend class="font-small"><i class="fas fa-user-friends"></i>&nbsp;Dados pessoais</legend>
                                    <div class="form-group row">
                                        <!-- FIXME: vendedor_codigo -->
                                        <div class="col-md-4 mb-2">
                                            <label>Código</label>
                                            <input type="text" class="form-control form-control-user" disabled
                                            value="<?php echo $vendedor->vendedor_codigo; ?>" />
                                        </div>
                                        <!-- FIXME: vendedor_nome_completo -->
                                        <div class="col-md-4 mb-2">
                                            <label for="vendedor_nome_completo">Nome completo</label>
                                            <input type="text" class="form-control form-control-user" id="vendedor_nome_completo" name="vendedor_nome_completo"
                                            placeholder="Informe o nome completo" value="<?php echo $vendedor->vendedor_nome_completo; ?>" />
                                            <?php echo form_error('vendedor_nome_completo', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                        <!-- FIXME: vendedor_cpf -->
                                        <div class="col-md-4 mb-2">
                                            <label for="vendedor_cpf">CPF</label>
                                            <input type="text" class="form-control form-control-user cpf" id="vendedor_cpf" name="vendedor_cpf"
                                            placeholder="Informe o CPF" value="<?php echo $vendedor->vendedor_cpf; ?>" />
                                            <?php echo form_error('vendedor_cpf', '<small class="form-text text-danger">','</small>') ?>                                     
                                        </div>
                                        <!-- FIXME: vendedor_rg -->
                                        <div class="col-md-4 mb-2">
                                            <label for="vendedor_rg">RG</label>
                                            <input type="text" class="form-control form-control-user rg" id="vendedor_rg" name="vendedor_rg"
                                            placeholder="Informe o RG" value="<?php echo $vendedor->vendedor_rg; ?>" />
                                            <?php echo form_error('vendedor_rg', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                        <!-- FIXME: vendedor_telefone -->
                                        <div class="col-md-4 mb-2">
                                            <label for="vendedor_telefone">Telefone</label>
                                            <input type="text" class="form-control form-control-user phone_with_ddd" id="vendedor_telefone" name="vendedor_telefone"
                                            placeholder="Informe o telefone" value="<?php echo $vendedor->vendedor_telefone; ?>" />
                                            <?php echo form_error('vendedor_telefone', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                        <!-- FIXME: vendedor_celular -->
                                        <div class="col-md-4 mb-2">
                                            <label for="vendedor_celular">Celular</label>
                                            <input type="text" class="form-control form-control-user sp_celphones" id="vendedor_celular" name="vendedor_celular"
                                            placeholder="Informe o celular" value="<?php echo $vendedor->vendedor_celular; ?>" />
                                            <?php echo form_error('vendedor_celular', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                        <!-- FIXME: vendedor_email -->
                                        <div class="col-md-4 mb-2">
                                            <label for="vendedor_email">Email</label>
                                            <input type="text" class="form-control form-control-user" id="vendedor_email" name="vendedor_email"
                                            placeholder="Informe o email" value="<?php echo $vendedor->vendedor_email; ?>" />
                                            <?php echo form_error('vendedor_email', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset class="mb-4 p-2 border">
                                    <legend class="font-small"><i class="fas fa-map-marked-alt"></i>&nbsp;Informação de endereço</legend>
                                    <div class="form-group row">
                                        <!-- FIXME: vendedor_cep -->
                                        <div class="col-md-4 mb-2">
                                            <label for="vendedor_cep">CEP</label>
                                            <input type="text" class="form-control form-control-user cep" id="vendedor_cep" name="vendedor_cep"
                                            placeholder="Informe o CEP" value="<?php echo $vendedor->vendedor_cep; ?>" />
                                            <?php echo form_error('vendedor_cep', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                        <!-- FIXME: vendedor_endereco -->
                                        <div class="col-md-4 mb-2">
                                            <label for="vendedor_endereco">Endereço</label>
                                            <input type="text" class="form-control form-control-user" id="vendedor_endereco" name="vendedor_endereco"
                                            placeholder="Informe o endereço" value="<?php echo $vendedor->vendedor_endereco; ?>" />
                                            <?php echo form_error('vendedor_endereco', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                        <!-- FIXME: vendedor_numero_endereco -->
                                        <div class="col-md-4 mb-2">
                                            <label for="vendedor_numero_endereco">Número</label>
                                            <input type="text" class="form-control form-control-user" id="vendedor_numero_endereco" name="vendedor_numero_endereco"
                                            placeholder="Informe o número" value="<?php echo $vendedor->vendedor_numero_endereco; ?>" />
                                        </div>
                                        <!-- FIXME: vendedor_bairro -->
                                        <div class="col-md-4 mb-2">
                                            <label for="vendedor_bairro">Bairro</label>
                                            <input type="text" class="form-control form-control-user" id="vendedor_bairro" name="vendedor_bairro"
                                            placeholder="Informe o bairro" value="<?php echo $vendedor->vendedor_bairro; ?>" />
                                            <?php echo form_error('vendedor_bairro', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                        <!-- FIXME: vendedor_complemento -->
                                        <div class="col-md-4 mb-2">
                                            <label for="vendedor_complemento">Complemento</label>
                                            <input type="text" class="form-control form-control-user" id="vendedor_complemento" name="vendedor_complemento"
                                            placeholder="Informe o complemento" value="<?php echo $vendedor->vendedor_complemento; ?>" />
                                            <?php echo form_error('vendedor_complemento', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                        <!-- FIXME: vendedor_cidade -->
                                        <div class="col-md-4 mb-2">
                                            <label for="vendedor_cidade">Cidade</label>
                                            <input type="text" class="form-control form-control-user" id="vendedor_cidade" name="vendedor_cidade"
                                            placeholder="Informe a cidade" value="<?php echo $vendedor->vendedor_cidade; ?>" />
                                            <?php echo form_error('vendedor_cidade', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                        <!-- FIXME: vendedor_estado -->
                                        <div class="col-md-4 mb-2">
                                            <label for="vendedor_estado">Estado</label>
                                            <input type="text" class="form-control form-control-user uf" id="vendedor_estado" name="vendedor_estado"
                                            placeholder="Informe o estado" value="<?php echo $vendedor->vendedor_estado; ?>" />
                                            <?php echo form_error('vendedor_estado', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset class="mb-4 p-2 border">
                                    <legend class="font-small"><i class="fas fa-tools"></i>&nbsp;Alterações</legend>
                                    <div class="form-group row">
                                        <!-- FIXME: vendedor_ativo -->
                                        <div class="col-md-4 mb-2">
                                            <label for="vendedor_ativo">Ativo</label>
                                            <select class="form-control custom-select" id="vendedor_ativo" name="vendedor_ativo">
                                                <option value="0" <?php echo ($vendedor->vendedor_ativo == 0 ? 'selected' : ''); ?>>Não</option>
                                                <option value="1" <?php echo ($vendedor->vendedor_ativo == 0 ? '' : 'selected'); ?>>Sim</option>
                                            </select>
                                        </div>
                                    </div>
                                </fieldset>

                                <div class="form-group row">
                                    <!-- FIXME: vendedor_obs -->
                                    <div class="col-12 mb-2">
                                        <label for="vendedor_obs">Observação</label>
                                        <textarea class="form-control" id="vendedor_obs" name="vendedor_obs"
                                        placeholder="Informe a abservação"><?php echo $vendedor->vendedor_obs; ?></textarea>
                                        <?php echo form_error('vendedor_obs', '<small class="form-text text-danger">','</small>') ?>
                                    </div>

                                    <input type="hidden" name="vendedor_id" value="<?php echo $vendedor->vendedor_id; ?>" />
                                </div>

                                <button title="Atualizar dados" type="submit" class="btn btn-sm btn-primary">Atualizar dados</button>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- Container-fluid -->

        </div>
        <!-- End of Main Content -->

<!-- FIXME: FOOTER -->