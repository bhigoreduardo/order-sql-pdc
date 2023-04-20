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
                            <li class="breadcrumb-item"><a title="Fornecedores" href="<?php echo base_url($this->router->fetch_class()); ?>">Fornecedores</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo; ?></li>
                        </ol>
                        </nav>
                    </nav>

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800"><?php echo $titulo; ?></h1>

                    <!-- Form data -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a title="Voltar" 
                                href="<?php echo base_url($this->router->fetch_class()); ?>" 
                                class="btn btn-sm btn-success float-right">
                                <i class="fas fa-arrow-left"></i>&nbsp;
                                Voltar
                            </a>
                        </div>
                        <div class="card-body">
                            <form method="POST" name="form_add">
                                <!-- FIXME: fornecedor_tipo -->
                                <div class="custom-control custom-radio custom-control-inline mb-4">
                                    <input type="radio" id="pessoa_fisica" name="fornecedor_tipo" 
                                    class="custom-control-input" value="1" <?php echo set_checkbox('fornecedor_tipo', '1'); ?> checked="">
                                    <label class="custom-control-label pt-1" for="pessoa_fisica">Pessoa Física</label>
                                </div>
                                <!-- FIXME: fornecedor_tipo -->
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="pessoa_juridica" name="fornecedor_tipo"
                                    class="custom-control-input" value="2" <?php echo set_checkbox('fornecedor_tipo', '2'); ?> >
                                    <label class="custom-control-label pt-1" for="pessoa_juridica">Pessoa Jurídica</label>
                                </div>

                                <fieldset class="mb-4 p-2 border">
                                    <legend class="font-small"><i class="fas fa-user-tie"></i>&nbsp;Dados pessoais</legend>
                                    <div class="form-group row">
                                        <!-- FIXME: fornecedor_tipo -->
                                        <div class="col-md-4 mb-2">
                                            <label>Tipo pessoa</label>
                                            <div class="pessoa_fisica">
                                                <input type="text" class="form-control form-control-user" disabled value="<?php echo 'Pessoa Física'; ?>" />
                                            </div>
                                            <div class="pessoa_juridica">
                                                <input type="text" class="form-control form-control-user" disabled value="<?php echo 'Pessoa Jurídica'; ?>" />
                                            </div>
                                        </div>
                                        <!-- FIXME: fornecedor_nome_razao -->
                                        <div class="col-md-4 mb-2">
                                            <div class="pessoa_fisica">
                                                <label for="fornecedor_nome">Nome</label>
                                                <input type="text" class="form-control form-control-user" id="fornecedor_nome" name="fornecedor_nome"
                                                placeholder="Informe o nome" value="<?php echo set_value('fornecedor_nome'); ?>" />
                                                <?php echo form_error('fornecedor_nome', '<small class="form-text text-danger">','</small>') ?>
                                            </div>
                                            <div class="pessoa_juridica">
                                                <label for="fornecedor_razao">Razão social</label>
                                                <input type="text" class="form-control form-control-user" id="fornecedor_razao" name="fornecedor_razao"
                                                placeholder="Informe a razão social" value="<?php echo set_value('fornecedor_razao'); ?>" />
                                                <?php echo form_error('fornecedor_razao', '<small class="form-text text-danger">','</small>') ?>
                                            </div>
                                        </div>
                                        <!-- FIXME: fornecedor_sobrenome_fantasia -->
                                        <div class="col-md-4 mb-2">
                                            <div class="pessoa_fisica">
                                                <label for="fornecedor_sobrenome">Sobrenome</label>
                                                <input type="text" class="form-control form-control-user" id="fornecedor_sobrenome" name="fornecedor_sobrenome"
                                                placeholder="Informe o sobrenome" value="<?php echo set_value('fornecedor_sobrenome'); ?>" />
                                                <?php echo form_error('fornecedor_sobrenome', '<small class="form-text text-danger">','</small>') ?>
                                            </div>
                                            <div class="pessoa_juridica">
                                                <label for="fornecedor_fantasia">Nome fantasia</label>
                                                <input type="text" class="form-control form-control-user" id="fornecedor_fantasia" name="fornecedor_fantasia"
                                                placeholder="Informe o nome fantasia" value="<?php echo set_value('fornecedor_fantasia'); ?>" />
                                                <?php echo form_error('fornecedor_fantasia', '<small class="form-text text-danger">','</small>') ?>
                                            </div>
                                        </div>
                                        <!-- FIXME: fornecedor_email -->
                                        <div class="col-md-4 mb-2">
                                            <label for="fornecedor_email">Email</label>
                                            <input type="text" class="form-control form-control-user" id="fornecedor_email" name="fornecedor_email"
                                            placeholder="Informe o email" value="<?php echo set_value('fornecedor_email'); ?>" />
                                            <?php echo form_error('fornecedor_email', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                        <!-- FIXME: fornecedor_telefone -->
                                        <div class="col-md-4 mb-2">
                                            <label for="fornecedor_telefone">Telefone</label>
                                            <input type="text" class="form-control form-control-user phone_with_ddd" id="fornecedor_telefone" name="fornecedor_telefone"
                                            placeholder="Informe o telefone" value="<?php echo set_value('fornecedor_telefone'); ?>" />
                                            <?php echo form_error('fornecedor_telefone', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                        <!-- FIXME: fornecedor_celular -->
                                        <div class="col-md-4 mb-2">
                                            <label for="fornecedor_celular">Celular</label>
                                            <input type="text" class="form-control form-control-user sp_celphones" id="fornecedor_celular" name="fornecedor_celular"
                                            placeholder="Informe o celular" value="<?php echo set_value('fornecedor_celular'); ?>" />
                                            <?php echo form_error('fornecedor_celular', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                        <!-- FIXME: fornecedor_cpf_cnpj -->
                                        <div class="col-md-4 mb-2">
                                            <div class="pessoa_fisica">
                                                <label for="fornecedor_cpf">CPF</label>
                                                <input type="text" class="form-control form-control-user cpf" id="fornecedor_cpf" name="fornecedor_cpf"
                                                placeholder="Informe o CPF" value="<?php echo set_value('fornecedor_cpf'); ?>" />
                                                <?php echo form_error('fornecedor_cpf', '<small class="form-text text-danger">','</small>') ?>
                                            </div>
                                            <div class="pessoa_juridica">
                                                <label for="fornecedor_cnpj">CNPJ</label>
                                                <input type="text" class="form-control form-control-user cnpj" id="fornecedor_cnpj" name="fornecedor_cnpj"
                                                placeholder="Informe o CNPJ" value="<?php echo set_value('fornecedor_cnpj'); ?>" />
                                                <?php echo form_error('fornecedor_cnpj', '<small class="form-text text-danger">','</small>') ?>
                                            </div>
                                        </div>
                                        <!-- FIXME: fornecedor_rg_ie -->
                                        <div class="col-md-4 mb-2">
                                            <div class="pessoa_fisica">
                                                <label for="fornecedor_rg">RG</label>
                                                <input type="text" class="form-control form-control-user rg" id="fornecedor_rg" name="fornecedor_rg"
                                                placeholder="Informe o RG" value="<?php echo set_value('fornecedor_rg'); ?>" />
                                                <?php echo form_error('fornecedor_rg', '<small class="form-text text-danger">','</small>') ?>
                                            </div>
                                            <div class="pessoa_juridica">
                                                <label for="fornecedor_ie">IE</label>
                                                <input type="text" class="form-control form-control-user" id="fornecedor_ie" name="fornecedor_ie"
                                                placeholder="Informe a IE" value="<?php echo set_value('fornecedor_ie'); ?>" />
                                                <?php echo form_error('fornecedor_ie', '<small class="form-text text-danger">','</small>') ?>
                                            </div>
                                        </div>
                                        <!-- FIXME: fornecedor_data_nascimento -->
                                        <div class="col-md-4 mb-2 pessoa_fisica">
                                            <label for="fornecedor_data_nascimento">Data nascimento</label>
                                            <input type="date" class="form-control form-control-user-date" id="fornecedor_data_nascimento" name="fornecedor_data_nascimento"
                                            value="<?php echo set_value('fornecedor_data_nascimento'); ?>" />
                                            <?php echo form_error('fornecedor_data_nascimento', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset class="mb-4 p-2 border">
                                    <legend class="font-small"><i class="fas fa-map-marked-alt"></i>&nbsp;Informação de endereço</legend>
                                    <div class="form-group row">
                                        <!-- FIXME: fornecedor_cep -->
                                        <div class="col-md-4 mb-2">
                                            <label for="fornecedor_cep">CEP</label>
                                            <input type="text" class="form-control form-control-user cep" id="fornecedor_cep" name="fornecedor_cep"
                                            placeholder="Informe o CEP" value="<?php echo set_value('fornecedor_cep'); ?>" />
                                            <?php echo form_error('fornecedor_cep', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                        <!-- FIXME: fornecedor_endereco -->
                                        <div class="col-md-4 mb-2">
                                            <label for="fornecedor_endereco">Endereço</label>
                                            <input type="text" class="form-control form-control-user" id="fornecedor_endereco" name="fornecedor_endereco"
                                            placeholder="Informe o endereço" value="<?php echo set_value('fornecedor_endereco'); ?>" />
                                            <?php echo form_error('fornecedor_endereco', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                        <!-- FIXME: fornecedor_numero_endereco -->
                                        <div class="col-md-4 mb-2">
                                            <label for="fornecedor_numero_endereco">Número</label>
                                            <input type="text" class="form-control form-control-user" id="fornecedor_numero_endereco" name="fornecedor_numero_endereco"
                                            placeholder="Informe o número" value="<?php echo set_value('fornecedor_numero_endereco'); ?>" />
                                        </div>
                                        <!-- FIXME: fornecedor_bairro -->
                                        <div class="col-md-4 mb-2">
                                            <label for="fornecedor_bairro">Bairro</label>
                                            <input type="text" class="form-control form-control-user" id="fornecedor_bairro" name="fornecedor_bairro"
                                            placeholder="Informe o bairro" value="<?php echo set_value('fornecedor_bairro'); ?>" />
                                            <?php echo form_error('fornecedor_bairro', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                        <!-- FIXME: fornecedor_complemento -->
                                        <div class="col-md-4 mb-2">
                                            <label for="fornecedor_complemento">Complemento</label>
                                            <input type="text" class="form-control form-control-user" id="fornecedor_complemento" name="fornecedor_complemento"
                                            placeholder="Informe o complemento" value="<?php echo set_value('fornecedor_complemento'); ?>" />
                                            <?php echo form_error('fornecedor_complemento', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                        <!-- FIXME: fornecedor_cidade -->
                                        <div class="col-md-4 mb-2">
                                            <label for="fornecedor_cidade">Cidade</label>
                                            <input type="text" class="form-control form-control-user" id="fornecedor_cidade" name="fornecedor_cidade"
                                            placeholder="Informe a cidade" value="<?php echo set_value('fornecedor_cidade'); ?>" />
                                            <?php echo form_error('fornecedor_cidade', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                        <!-- FIXME: fornecedor_estado -->
                                        <div class="col-md-4 mb-2">
                                            <label for="fornecedor_estado">Estado</label>
                                            <input type="text" class="form-control form-control-user uf" id="fornecedor_estado" name="fornecedor_estado"
                                            placeholder="Informe o estado" value="<?php echo set_value('fornecedor_estado'); ?>" />
                                            <?php echo form_error('fornecedor_estado', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset class="mb-4 p-2 border">
                                    <legend class="font-small"><i class="fas fa-tools"></i>&nbsp;Alterações</legend>
                                    <div class="form-group row">
                                        <!-- FIXME: fornecedor_ativo -->
                                        <div class="col-md-4 mb-2">
                                            <label for="fornecedor_ativo">Ativo</label>
                                            <select class="form-control custom-select" id="fornecedor_ativo" name="fornecedor_ativo">
                                                <option value="0">Não</option>
                                                <option value="1">Sim</option>
                                            </select>
                                        </div>
                                    </div>
                                </fieldset>

                                <div class="form-group row">
                                    <!-- FIXME: fornecedor_obs -->
                                    <div class="col-12 mb-2">
                                        <label for="fornecedor_obs">Observação</label>
                                        <textarea class="form-control" id="fornecedor_obs" name="fornecedor_obs"
                                        placeholder="Informe a abservação"><?php echo set_value('fornecedor_obs'); ?></textarea>
                                        <?php echo form_error('fornecedor_obs', '<small class="form-text text-danger">','</small>') ?>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-sm btn-primary">Salvar dados</button>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- Container-fluid -->

        </div>
        <!-- End of Main Content -->

<!-- FIXME: FOOTER -->