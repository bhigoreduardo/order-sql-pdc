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
                            <li class="breadcrumb-item"><a title="Serviços" href="<?php echo base_url($this->router->fetch_class()); ?>">Serviços</a></li>
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
                                    <?php echo formata_data_banco_com_hora($servico->servico_data_alteracao); ?>
                                </p>
                                <p class="float-left">
                                    <strong>
                                        <i class="fas fa-clock"></i>&nbsp;Data do cadastro:
                                    </strong>&nbsp;
                                    <?php echo formata_data_banco_com_hora($servico->servico_data_cadastro); ?>
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
                                    <legend class="font-small"><i class="fas fa-laptop"></i>&nbsp;Informações do serviço</legend>
                                        <div class="form-group row">
                                            <!-- FIXME: servico_nome -->
                                            <div class="col-md-4 mb-2">
                                                <label for="servico_nome">Nome</label>
                                                <input type="text" class="form-control form-control-user" id="servico_nome" name="servico_nome"
                                                placeholder="Informe o nome" value="<?php echo $servico->servico_nome; ?>" />
                                                <?php echo form_error('servico_nome', '<small class="form-text text-danger">','</small>') ?>
                                            </div>
                                            <!-- FIXME: servico_preco -->
                                            <div class="col-md-4 mb-2">
                                                <label for="servico_preco">Preço</label>
                                                <input type="text" class="form-control form-control-user money" id="servico_preco" name="servico_preco"
                                                placeholder="Informe o preço" value="<?php echo $servico->servico_preco; ?>" />
                                                <?php echo form_error('servico_preco', '<small class="form-text text-danger">','</small>') ?>
                                            </div>
                                            <!-- FIXME: servico_descricao -->
                                            <div class="col-md-4 mb-2">
                                                <label for="servico_descricao">Descrição</label>
                                                <input type="text" class="form-control form-control-user" id="servico_descricao" name="servico_descricao"
                                                placeholder="Informe a descrição" value="<?php echo $servico->servico_descricao; ?>" />
                                                <?php echo form_error('servico_descricao', '<small class="form-text text-danger">','</small>') ?>
                                            </div>
                                        </div>
                                </fieldset>

                                <fieldset class="mb-4 p-2 border">
                                    <legend class="font-small"><i class="fas fa-tools"></i>&nbsp;Alterações</legend>
                                    <div class="form-group row">
                                        <!-- FIXME: servico_ativo -->
                                        <div class="col-md-4 mb-2">
                                            <label for="servico_ativo">Ativo</label>
                                            <select class="form-control custom-select" id="servico_ativo" name="servico_ativo">
                                                <option value="0" <?php echo ($servico->servico_ativo == 0 ? 'selected' : ''); ?>>Não</option>
                                                <option value="1" <?php echo ($servico->servico_ativo == 0 ? '' : 'selected'); ?>>Sim</option>
                                            </select>
                                        </div>

                                        <input type="hidden" name="servico_id" value="<?php echo $servico->servico_id; ?>" />
                                    </div>
                                </fieldset>

                                <button title="Atualizar dados" type="submit" class="btn btn-sm btn-primary">Atualizar dados</button>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- Container-fluid -->

        </div>
        <!-- End of Main Content -->

<!-- FIXME: FOOTER -->