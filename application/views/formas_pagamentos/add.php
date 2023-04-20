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
                            <li class="breadcrumb-item"><a title="Formas de pagamentos" href="<?php echo base_url('/pagamentos'); ?>">Formas de pagamentos</a></li>
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
                                href="<?php echo base_url('/pagamentos'); ?>" 
                                class="btn btn-sm btn-success float-right">
                                <i class="fas fa-arrow-left"></i>&nbsp;
                                Voltar
                            </a>
                        </div>
                        <div class="card-body">
                            <form method="POST" name="form_add">
                                <fieldset class="mb-4 p-2 border">
                                    <legend class="font-small"><i class="fas fa-info-circle"></i>&nbsp;Informações da forma de pagamento</legend>
                                    <div class="form-group row">
                                        <!-- FIXME: forma_pagamento_nome -->
                                        <div class="col-md-4 mb-2">
                                            <label for="forma_pagamento_nome">Método</label>
                                            <input type="text" class="form-control form-control-user" id="forma_pagamento_nome" name="forma_pagamento_nome"
                                            placeholder="Informe o valor" value="<?php echo set_value('forma_pagamento_nome'); ?>" />
                                            <?php echo form_error('forma_pagamento_nome', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                        <!-- FIXME: forma_pagamento_aceita_parcela -->
                                        <div class="col-md-4 mb-2">
                                            <label for="forma_pagamento_aceita_parcela">Parcela</label>
                                            <select class="form-control custom-select" id="forma_pagamento_aceita_parcela" name="forma_pagamento_aceita_parcela">
                                                <option value="0">Não</option>
                                                <option value="1">Sim</option>
                                            </select>
                                        </div>                                        
                                    </div>
                                </fieldset>

                                <fieldset class="mb-4 p-2 border">
                                    <legend class="font-small"><i class="fas fa-tools"></i>&nbsp;Alterações</legend>
                                    <div class="form-group row">
                                        <!-- FIXME: forma_pagamento_ativo -->
                                        <div class="col-md-4 mb-2">
                                            <label for="forma_pagamento_ativo">Ativo</label>
                                            <select class="form-control custom-select" id="forma_pagamento_ativo" name="forma_pagamento_ativo">
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