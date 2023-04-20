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
                            <li class="breadcrumb-item"><a title="Página inicial" href="<?php echo base_url('/')?>">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo; ?></li>
                        </ol>
                        </nav>
                    </nav>

                    <!-- Alert Message -->
                    <?php if($message = $this->session->flashdata('error')): ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>
                                        <i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;
                                        <?php echo $message; ?>
                                    </strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if($message = $this->session->flashdata('success')): ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>
                                        <i class="fas fa-check"></i>&nbsp;&nbsp;
                                        <?php echo $message; ?>
                                    </strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800"><?php echo $titulo; ?></h1>

                    <!-- Form data -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a title="Voltar" 
                                href="<?php echo base_url('/'); ?>" 
                                class="btn btn-sm btn-success float-right">
                                <i class="fas fa-arrow-left"></i>&nbsp;
                                Voltar
                            </a>
                        </div>
                        <div class="card-body">
                            <form method="POST" name="form_index">
                                <div class="form-group row">
                                    <!-- FIXME: sistema_razao_social -->
                                    <div class="col-md-4 mb-2">
                                        <label for="sistema_razao_social">Razão Social</label>
                                        <input type="text" class="form-control form-control-user" id="sistema_razao_social" name="sistema_razao_social"
                                        placeholder="Informe a razão social" value="<?php echo $sistema->sistema_razao_social; ?>" />
                                        <?php echo form_error('sistema_razao_social', '<small class="form-text text-danger">', '</small>') ?>
                                    </div>
                                    <!-- FIXME: sistema_nome_fantasia -->
                                    <div class="col-md-4 mb-2">
                                        <label for="sistema_nome_fantasia">Nome fantasia</label>
                                        <input type="text" class="form-control form-control-user" id="sistema_nome_fantasia" name="sistema_nome_fantasia"
                                        placeholder="Informe o nome fantasia" value="<?php echo $sistema->sistema_nome_fantasia; ?>" />
                                        <?php echo form_error('sistema_nome_fantasia', '<small class="form-text text-danger">', '</small>') ?>
                                    </div>
                                    <!-- FIXME: sistema_cnpj -->
                                    <div class="col-md-4 mb-2">
                                        <label for="sistema_cnpj">CNPJ</label>
                                        <input type="text" class="form-control form-control-user cnpj" id="sistema_cnpj" name="sistema_cnpj"
                                        placeholder="Informe o CNPJ" value="<?php echo $sistema->sistema_cnpj; ?>" />
                                        <?php echo form_error('sistema_cnpj', '<small class="form-text text-danger">', '</small>') ?>
                                    </div>
                                    <!-- FIXME: sistema_ie -->
                                    <div class="col-md-4 mb-2">
                                        <label for="sistema_ie">IE</label>
                                        <input type="text" class="form-control form-control-user ie" id="sistema_ie" name="sistema_ie"
                                        placeholder="Informe a IE" value="<?php echo $sistema->sistema_ie; ?>" />
                                        <?php echo form_error('sistema_ie', '<small class="form-text text-danger">', '</small>') ?>
                                    </div>
                                    <!-- FIXME: sistema_telefone -->
                                    <div class="col-md-4 mb-2">
                                        <label for="sistema_telefone">Telefone</label>
                                        <input type="text" class="form-control form-control-user phone_with_ddd" id="sistema_telefone" name="sistema_telefone"
                                        placeholder="Informe o telefone" value="<?php echo $sistema->sistema_telefone; ?>" />
                                        <?php echo form_error('sistema_telefone', '<small class="form-text text-danger">', '</small>') ?>
                                    </div>
                                    <!-- FIXME: sistema_celular -->
                                    <div class="col-md-4 mb-2">
                                        <label for="sistema_celular">Celular</label>
                                        <input type="text" class="form-control form-control-user sp_celphones" id="sistema_celular" name="sistema_celular"
                                        placeholder="Informe o celular" value="<?php echo $sistema->sistema_celular; ?>" />
                                        <?php echo form_error('sistema_celular', '<small class="form-text text-danger">', '</small>') ?>
                                    </div>
                                    <!-- FIXME: sistema_email -->
                                    <div class="col-md-4 mb-2">
                                        <label for="sistema_email">Email</label>
                                        <input type="text" class="form-control form-control-user" id="sistema_email" name="sistema_email"
                                        placeholder="Informe o email" value="<?php echo $sistema->sistema_email; ?>" />
                                        <?php echo form_error('sistema_email', '<small class="form-text text-danger">', '</small>') ?>
                                    </div>
                                    <!-- FIXME: sistema_site_url -->
                                    <div class="col-md-4 mb-2">
                                        <label for="sistema_site_url">Site</label>
                                        <input type="text" class="form-control form-control-user" id="sistema_site_url" name="sistema_site_url"
                                        placeholder="Informe o site" value="<?php echo $sistema->sistema_site_url; ?>" />
                                        <?php echo form_error('sistema_site_url', '<small class="form-text text-danger">', '</small>') ?>
                                    </div>
                                    <!-- FIXME: sistema_cep -->
                                    <div class="col-md-4 mb-2">
                                        <label for="sistema_cep">CEP</label>
                                        <input type="text" class="form-control form-control-user cep" id="sistema_cep" name="sistema_cep"
                                        placeholder="Informe o CEP" value="<?php echo $sistema->sistema_cep; ?>" />
                                        <?php echo form_error('sistema_cep', '<small class="form-text text-danger">', '</small>') ?>
                                    </div>
                                    <!-- FIXME: sistema_endereco -->
                                    <div class="col-md-4 mb-2">
                                        <label for="sistema_endereco">Endereço</label>
                                        <input type="text" class="form-control form-control-user" id="sistema_endereco" name="sistema_endereco"
                                        placeholder="Informe o endereço" value="<?php echo $sistema->sistema_endereco; ?>" />
                                        <?php echo form_error('sistema_endereco', '<small class="form-text text-danger">', '</small>') ?>
                                    </div>
                                    <!-- FIXME: sistema_cidade -->
                                    <div class="col-md-4 mb-2">
                                        <label for="sistema_cidade">Cidade</label>
                                        <input type="text" class="form-control form-control-user" id="sistema_cidade" name="sistema_cidade"
                                        placeholder="Informe a cidade" value="<?php echo $sistema->sistema_cidade; ?>" />
                                        <?php echo form_error('sistema_cidade', '<small class="form-text text-danger">', '</small>') ?>
                                    </div>
                                    <!-- FIXME: sistema_estado -->
                                    <div class="col-md-2 mb-2">
                                        <label for="sistema_estado">Estado</label>
                                        <input type="text" class="form-control form-control-user uf" id="sistema_estado" name="sistema_estado"
                                        placeholder="Informe o estado" value="<?php echo $sistema->sistema_estado; ?>" />
                                        <?php echo form_error('sistema_estado', '<small class="form-text text-danger">', '</small>') ?>
                                    </div>
                                    <!-- FIXME: sistema_numero -->
                                    <div class="col-md-2 mb-2">
                                        <label for="sistema_numero">Número</label>
                                        <input type="text" class="form-control form-control-user" id="sistema_numero" name="sistema_numero"
                                        placeholder="Informe o número" value="<?php echo $sistema->sistema_numero; ?>" />
                                        <?php echo form_error('sistema_numero', '<small class="form-text text-danger">', '</small>') ?>
                                    </div>
                                    <!-- FIXME: sistema_txt_ordem_servico -->
                                    <div class="col-md-12 mb-2">
                                        <label for="sistema_txt_ordem_servico">Descrição ordem de serviço</label>
                                        <textarea class="form-control" id="sistema_txt_ordem_servico" name="sistema_txt_ordem_servico"
                                        placeholder="Informe a descrição do sistema"><?php echo $sistema->sistema_txt_ordem_servico; ?></textarea>
                                        <?php echo form_error('sistema_txt_ordem_servico', '<small class="form-text text-danger">', '</small>') ?>
                                    </div>

                                    <input type="hidden" name="id" value="<?php echo $sistema->sistema_id; ?>" />
                                </div>

                                <button title="Salvar alterações" type="submit" class="btn btn-sm btn-primary">Salvar alterações</button>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- Container-fluid -->

        </div>
        <!-- End of Main Content -->

<!-- FIXME: FOOTER -->