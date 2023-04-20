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
                            <a title="Voltar" 
                                href="<?php echo base_url($this->router->fetch_class()); ?>" 
                                class="btn btn-sm btn-success float-right">
                                <i class="fas fa-arrow-left"></i>&nbsp;
                                Voltar
                            </a>
                        </div>
                        <div class="card-body">
                            <form method="POST" name="form_add">
                                <fieldset class="mb-4 p-2 border">
                                    <legend class="font-small"><i class="fas fa-laptop"></i>&nbsp;Informações do serviço</legend>
                                        <div class="form-group row">
                                            <!-- FIXME: servico_nome -->
                                            <div class="col-md-4 mb-2">
                                                <label for="servico_nome">Nome</label>
                                                <input type="text" class="form-control form-control-user" id="servico_nome" name="servico_nome"
                                                placeholder="Informe o nome" value="<?php echo set_value('servico_nome'); ?>" />
                                                <?php echo form_error('servico_nome', '<small class="form-text text-danger">','</small>') ?>
                                            </div>
                                            <!-- FIXME: servico_preco -->
                                            <div class="col-md-4 mb-2">
                                                <label for="servico_preco">Preço</label>
                                                <input type="text" class="form-control form-control-user money" id="servico_preco" name="servico_preco"
                                                placeholder="Informe o preço" value="<?php echo set_value('servico_preco'); ?>" />
                                                <?php echo form_error('servico_preco', '<small class="form-text text-danger">','</small>') ?>
                                            </div>
                                            <!-- FIXME: servico_descricao -->
                                            <div class="col-md-4 mb-2">
                                                <label for="servico_descricao">Descrição</label>
                                                <input type="text" class="form-control form-control-user" id="servico_descricao" name="servico_descricao"
                                                placeholder="Informe a descrição" value="<?php echo set_value('servico_descricao'); ?>" />
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
                                                <option value="0">Não</option>
                                                <option value="1">Sim</option>
                                            </select>
                                        </div>
                                    </div>
                                </fieldset>

                                <button title="Salvar dados" type="submit" class="btn btn-sm btn-primary">Salvar dados</button>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- Container-fluid -->

        </div>
        <!-- End of Main Content -->

<!-- FIXME: FOOTER -->