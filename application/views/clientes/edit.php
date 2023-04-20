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
                            <li class="breadcrumb-item"><a title="Clientes" href="<?php echo base_url($this->router->fetch_class()); ?>">Clientes</a></li>
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
                                    <?php echo formata_data_banco_com_hora($cliente->cliente_data_alteracao); ?>
                                    <!-- date('d/m/Y | H:m', strtotime($cliente->cliente_data_alteracao)); -->
                                </p>
                                <p class="float-left">
                                    <strong>
                                        <i class="fas fa-clock"></i>&nbsp;Data do cadastro:
                                    </strong>&nbsp;
                                    <?php echo formata_data_banco_com_hora($cliente->cliente_data_cadastro); ?>
                                    <!-- date('d/m/Y | H:m', strtotime($cliente->cliente_data_cadastro)); -->
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
                                    <legend class="font-small"><i class="fas fa-user-tie"></i>&nbsp;Dados pessoais</legend>
                                    <div class="form-group row">
                                        <!-- FIXME: cliente_tipo -->
                                        <div class="col-md-4 mb-2">
                                            <label>Tipo pessoa</label>
                                            <input type="text" class="form-control form-control-user" disabled
                                            value="<?php echo ($cliente->cliente_tipo == 1 ? 'Pessoa Física' : 'Pessoa Jurídica'); ?>" />
                                        </div>
                                        <!-- FIXME: cliente_nome_razao -->
                                        <div class="col-md-4 mb-2">
                                            <?php if($cliente->cliente_tipo == 1): ?>
                                                <label for="cliente_nome">Nome</label>
                                                <input type="text" class="form-control form-control-user" id="cliente_nome" name="cliente_nome"
                                                placeholder="Informe o nome" value="<?php echo $cliente->cliente_nome_razao; ?>" />
                                                <?php echo form_error('cliente_nome', '<small class="form-text text-danger">','</small>') ?>
                                            <?php else: ?>
                                                <label for="cliente_razao">Razão social</label>
                                                <input type="text" class="form-control form-control-user" id="cliente_razao" name="cliente_razao"
                                                placeholder="Informe a razão social" value="<?php echo $cliente->cliente_nome_razao; ?>" />
                                                <?php echo form_error('cliente_razao', '<small class="form-text text-danger">','</small>') ?>
                                            <?php endif; ?>
                                        </div>
                                        <!-- FIXME: cliente_sobrenome_fantasia -->
                                        <div class="col-md-4 mb-2">
                                            <?php if($cliente->cliente_tipo == 1): ?>
                                                <label for="cliente_sobrenome">Sobrenome</label>
                                                <input type="text" class="form-control form-control-user" id="cliente_sobrenome" name="cliente_sobrenome"
                                                placeholder="Informe o sobrenome" value="<?php echo $cliente->cliente_sobrenome_fantasia; ?>" />
                                                <?php echo form_error('cliente_sobrenome', '<small class="form-text text-danger">','</small>') ?>
                                            <?php else: ?>
                                                <label for="cliente_fantasia">Nome fantasia</label>
                                                <input type="text" class="form-control form-control-user" id="cliente_fantasia" name="cliente_fantasia"
                                                placeholder="Informe o nome fantasia" value="<?php echo $cliente->cliente_sobrenome_fantasia; ?>" />
                                                <?php echo form_error('cliente_fantasia', '<small class="form-text text-danger">','</small>') ?>
                                            <?php endif; ?>
                                        </div>
                                        <!-- FIXME: cliente_email -->
                                        <div class="col-md-4 mb-2">
                                            <label for="cliente_email">Email</label>
                                            <input type="text" class="form-control form-control-user" id="cliente_email" name="cliente_email"
                                            placeholder="Informe o email" value="<?php echo $cliente->cliente_email; ?>" />
                                            <?php echo form_error('cliente_email', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                        <!-- FIXME: cliente_telefone -->
                                        <div class="col-md-4 mb-2">
                                            <label for="cliente_telefone">Telefone fixo</label>
                                            <input type="text" class="form-control form-control-user phone_with_ddd" id="cliente_telefone" name="cliente_telefone"
                                            placeholder="Informe o telefone fixo" value="<?php echo $cliente->cliente_telefone; ?>" />
                                            <?php echo form_error('cliente_telefone', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                        <!-- FIXME: cliente_celular -->
                                        <div class="col-md-4 mb-2">
                                            <label for="cliente_celular">Celular</label>
                                            <input type="text" class="form-control form-control-user sp_celphones" id="cliente_celular" name="cliente_celular"
                                            placeholder="Informe o celular" value="<?php echo $cliente->cliente_celular; ?>" />
                                            <?php echo form_error('cliente_celular', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                        <!-- FIXME: cliente_cpf_cnpj -->
                                        <div class="col-md-4 mb-2">
                                            <?php if($cliente->cliente_tipo == 1): ?>
                                                <label for="cliente_cpf">CPF</label>
                                                <input type="text" class="form-control form-control-user cpf" id="cliente_cpf" name="cliente_cpf"
                                                placeholder="Informe o CPF" value="<?php echo $cliente->cliente_cpf_cnpj; ?>" />
                                                <?php echo form_error('cliente_cpf', '<small class="form-text text-danger">','</small>') ?>
                                            <?php else: ?>
                                                <label for="cliente_cnpj">CNPJ</label>
                                                <input type="text" class="form-control form-control-user cnpj" id="cliente_cnpj" name="cliente_cnpj"
                                                placeholder="Informe o cnpj" value="<?php echo $cliente->cliente_cpf_cnpj; ?>" />
                                                <?php echo form_error('cliente_cnpj', '<small class="form-text text-danger">','</small>') ?>
                                            <?php endif; ?>                                            
                                        </div>
                                        <!-- FIXME: cliente_rg_ie -->
                                        <div class="col-md-4 mb-2">
                                            <?php if($cliente->cliente_tipo == 1): ?>
                                                <label for="cliente_rg">RG</label>
                                                <input type="text" class="form-control form-control-user rg" id="cliente_rg" name="cliente_rg"
                                                placeholder="Informe o RG" value="<?php echo $cliente->cliente_rg_ie; ?>" />
                                                <?php echo form_error('cliente_rg', '<small class="form-text text-danger">','</small>') ?>
                                            <?php else: ?>
                                                <label for="cliente_ie">IE</label>
                                                <input type="text" class="form-control form-control-user" id="cliente_ie" name="cliente_ie"
                                                placeholder="Informe o ie" value="<?php echo $cliente->cliente_rg_ie; ?>" />
                                                <?php echo form_error('cliente_ie', '<small class="form-text text-danger">','</small>') ?>
                                            <?php endif; ?>
                                        </div>
                                        <?php if($cliente->cliente_tipo == 1): ?>
                                            <!-- FIXME: cliente_data_nascimento -->
                                            <div class="col-md-4 mb-2">
                                                <label for="cliente_data_nascimento">Data nascimento</label>
                                                <input type="date" class="form-control form-control-user-date" id="cliente_data_nascimento" name="cliente_data_nascimento"
                                                value="<?php echo $cliente->cliente_data_nascimento; ?>" />
                                                <?php echo form_error('cliente_data_nascimento', '<small class="form-text text-danger">','</small>') ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </fieldset>

                                <fieldset class="mb-4 p-2 border">
                                    <legend class="font-small"><i class="fas fa-map-marked-alt"></i>&nbsp;Informação de endereço</legend>
                                    <div class="form-group row">
                                        <!-- FIXME: cliente_cep -->
                                        <div class="col-md-4 mb-2">
                                            <label for="cliente_cep">CEP</label>
                                            <input type="text" class="form-control form-control-user cep" id="cliente_cep" name="cliente_cep"
                                            placeholder="Informe o CEP" value="<?php echo $cliente->cliente_cep; ?>" />
                                            <?php echo form_error('cliente_cep', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                        <!-- FIXME: cliente_endereco -->
                                        <div class="col-md-4 mb-2">
                                            <label for="cliente_endereco">Endereço</label>
                                            <input type="text" class="form-control form-control-user" id="cliente_endereco" name="cliente_endereco"
                                            placeholder="Informe o endereço" value="<?php echo $cliente->cliente_endereco; ?>" />
                                            <?php echo form_error('cliente_endereco', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                        <!-- FIXME: cliente_numero_endereco -->
                                        <div class="col-md-4 mb-2">
                                            <label for="cliente_numero_endereco">Número</label>
                                            <input type="text" class="form-control form-control-user" id="cliente_numero_endereco" name="cliente_numero_endereco"
                                            placeholder="Informe o número" value="<?php echo $cliente->cliente_numero_endereco; ?>" />
                                        </div>
                                        <!-- FIXME: cliente_bairro -->
                                        <div class="col-md-4 mb-2">
                                            <label for="cliente_bairro">Bairro</label>
                                            <input type="text" class="form-control form-control-user" id="cliente_bairro" name="cliente_bairro"
                                            placeholder="Informe o bairro" value="<?php echo $cliente->cliente_bairro; ?>" />
                                            <?php echo form_error('cliente_bairro', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                        <!-- FIXME: cliente_complemento -->
                                        <div class="col-md-4 mb-2">
                                            <label for="cliente_complemento">Complemento</label>
                                            <input type="text" class="form-control form-control-user" id="cliente_complemento" name="cliente_complemento"
                                            placeholder="Informe o complemento" value="<?php echo $cliente->cliente_complemento; ?>" />
                                            <?php echo form_error('cliente_complemento', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                        <!-- FIXME: cliente_cidade -->
                                        <div class="col-md-4 mb-2">
                                            <label for="cliente_cidade">Cidade</label>
                                            <input type="text" class="form-control form-control-user" id="cliente_cidade" name="cliente_cidade"
                                            placeholder="Informe a cidade" value="<?php echo $cliente->cliente_cidade; ?>" />
                                            <?php echo form_error('cliente_cidade', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                        <!-- FIXME: cliente_estado -->
                                        <div class="col-md-4 mb-2">
                                            <label for="cliente_estado">Estado</label>
                                            <input type="text" class="form-control form-control-user uf" id="cliente_estado" name="cliente_estado"
                                            placeholder="Informe o estado" value="<?php echo $cliente->cliente_estado; ?>" />
                                            <?php echo form_error('cliente_estado', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset class="mb-4 p-2 border">
                                    <legend class="font-small"><i class="fas fa-tools"></i>&nbsp;Alterações</legend>
                                    <div class="form-group row">
                                        <!-- FIXME: cliente_ativo -->
                                        <div class="col-md-4 mb-2">
                                            <label for="cliente_ativo">Ativo</label>
                                            <select class="form-control custom-select" id="cliente_ativo" name="cliente_ativo">
                                                <option value="0" <?php echo ($cliente->cliente_ativo == 0 ? 'selected' : ''); ?>>Não</option>
                                                <option value="1" <?php echo ($cliente->cliente_ativo == 0 ? '' : 'selected'); ?>>Sim</option>
                                            </select>
                                        </div>
                                    </div>
                                </fieldset>

                                <div class="form-group row">
                                    <!-- FIXME: cliente_obs -->
                                    <div class="col-12 mb-2">
                                        <label for="cliente_obs">Observação</label>
                                        <textarea class="form-control" id="cliente_obs" name="cliente_obs"
                                        placeholder="Informe a abservação"><?php echo $cliente->cliente_obs; ?></textarea>
                                        <?php echo form_error('cliente_obs', '<small class="form-text text-danger">','</small>') ?>
                                    </div>

                                    <input type="hidden" name="cliente_id" value="<?php echo $cliente->cliente_id; ?>" />
                                    <input type="hidden" name="cliente_tipo" value="<?php echo $cliente->cliente_tipo; ?>" />
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