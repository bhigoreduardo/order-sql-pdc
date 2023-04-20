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
                            <li class="breadcrumb-item"><a title="Contas à pagar" href="<?php echo base_url($this->router->fetch_class()); ?>">Contas à pagar</a></li>
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
                                    <legend class="font-small"><i class="fas fa-info-circle"></i>&nbsp;Informações da conta</legend>
                                    <div class="form-group row">
                                        <!-- FIXME: conta_pagar_fornecedor_id -->
                                        <div class="col-md-4 mb-2">
                                            <label for="conta_pagar_fornecedor_id">Fornecedor</label>
                                            <select class="form-control custom-select contas_pagar" id="conta_pagar_fornecedor_id" name="conta_pagar_fornecedor_id">
                                                <?php foreach($fornecedores as $fornecedor): ?>
                                                    <option value="<?php echo $fornecedor->fornecedor_id; ?>">
                                                        <?php echo $fornecedor->fornecedor_nome_razao; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <!-- FIXME: conta_pagar_data_vencimento -->
                                        <div class="col-md-4 mb-2">
                                            <label for="conta_pagar_data_vencimento">Data vencimento</label>
                                            <input type="date" class="form-control form-control-user-date" id="conta_pagar_data_vencimento" name="conta_pagar_data_vencimento"
                                            value="<?php echo set_value('conta_pagar_data_vencimento'); ?>" />
                                            <?php echo form_error('conta_pagar_data_vencimento', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                        <!-- FIXME: conta_pagar_valor -->
                                        <div class="col-md-4 mb-2">
                                            <label for="conta_pagar_valor">Valor</label>
                                            <input type="text" class="form-control form-control-user money2" id="conta_pagar_valor" name="conta_pagar_valor"
                                            placeholder="Informe o valor" value="<?php echo set_value('conta_pagar_valor'); ?>" />
                                            <?php echo form_error('conta_pagar_valor', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset class="mb-4 p-2 border">
                                    <legend class="font-small"><i class="fas fa-tools"></i>&nbsp;Alterações</legend>
                                    <div class="form-group row">
                                        <!-- FIXME: conta_pagar_status -->
                                        <div class="col-md-4 mb-2">
                                            <label for="conta_pagar_status">Situação</label>
                                            <select class="form-control custom-select" id="conta_pagar_status" name="conta_pagar_status">
                                                <option value="0">Pendente</option>
                                                <option value="1">Pago</option>
                                            </select>
                                        </div>
                                    </div>
                                </fieldset>

                                <div class="form-group row">
                                    <!-- FIXME: conta_pagar_obs -->
                                    <div class="col-12 mb-2">
                                        <label for="conta_pagar_obs">Observação</label>
                                        <textarea class="form-control" id="conta_pagar_obs" name="conta_pagar_obs"
                                        placeholder="Informe a abservação"><?php echo set_value('conta_pagar_obs'); ?></textarea>
                                        <?php echo form_error('conta_pagar_obs', '<small class="form-text text-danger">','</small>') ?>
                                    </div>
                                </div>

                                <button title="Salvar dados" type="submit" class="btn btn-sm btn-primary">Salvar dados</button>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- Container-fluid -->

        </div>
        <!-- End of Main Content -->

<!-- FIXME: FOOTER -->