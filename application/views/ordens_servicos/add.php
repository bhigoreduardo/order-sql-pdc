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
                            <li class="breadcrumb-item"><a title="Ordens de serviços" href="<?php echo base_url('/ordens'); ?>">Ordens de serviços</a></li>
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
                                href="<?php echo base_url('/ordens'); ?>" 
                                class="btn btn-sm btn-success float-right">
                                <i class="fas fa-arrow-left"></i>&nbsp;
                                Voltar
                            </a>
                        </div>
                        <div class="card-body">
                            <form method="POST" id="form" name="form_add" enctype="multipart/form-data" accept-charset="utf-8">
                                <fieldset class="mb-4 p-2 border">
                                    <legend class="font-small"><i class="fas fa-tools"></i>&nbsp;&nbsp;Escolha os serviços</legend>

                                    <!-- FIXME: ordem_ts_id_servico -->
                                    <div class="form-group row mb-3">
                                        <div class="ui-widget col-lg-12 mb-1 mt-1">
                                            <input id="buscar_servicos" class="search form-control form-control-lg col-lg-12" placeholder="Que serviço você está buscando?">
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table id="table_servicos" class="table">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th style="width: 55%">Serviço</th>
                                                    <th class="text-right pr-2" style="width: 12%">Valor unitário</th>
                                                    <th class="text-center" style="width: 8%">Qtd</th>
                                                    <th style="width: 8%">% Desc</th>
                                                    <th class="text-right pr-2" style="width: 15%">Total</th>
                                                    <th style="width: 25%"></th>
                                                    <th style="width: 25%"></th>
                                                </tr>
                                            </thead>
                                            <tbody id="lista_servicos"></tbody>
                                            <tfoot>
                                                <tr class="">
                                                    <td colspan="5" class="text-right border-0">
                                                        <label class="font-weight-bold pt-1" for="total">Valor de desconto:</label>
                                                    </td>
                                                    <td class="text-right border-0">
                                                        <input type="text" name="ordem_servico_valor_desconto" class="form-control form-control-user text-right pr-1" data-format="$ 0,0.00" data-cell="L1" data-formula="SUM(H1:H5)" readonly="">
                                                    </td>
                                                    <td class="border-0">&nbsp;</td>
                                                </tr>

                                                <tr class="">
                                                    <td colspan="5" class="text-right border-0">
                                                        <label class="font-weight-bold pt-1" for="total">Total a pagar:</label>
                                                    </td>
                                                    <td class="text-right border-0">
                                                        <input type="text" name="ordem_servico_valor_total" class="form-control form-control-user text-right pr-1" data-format="$ 0,0.00" data-cell="G2" data-formula="SUM(F1:F5)" readonly="">
                                                    </td>
                                                    <td class="border-0">&nbsp;</td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>  
                                </fieldset>

                                <fieldset class="mb-4 p-2 border">
                                    <legend class="font-small"><i class="far fa-list-alt"></i>&nbsp;&nbsp;Informações da ordem</legend>
                                    <div class="form-group row">
                                        <!-- FIXME: ordem_servico_forma_pagamento_id  -->
                                        <div class="col-md-4 mb-2">
                                            <label for="ordem_servico_forma_pagamento_id ">Forma pagamento</label>
                                            <select class="form-control custom-select forma_pagamento" id="ordem_servico_forma_pagamento_id " name="ordem_servico_forma_pagamento_id">
                                                <?php foreach($formas_pagamentos as $forma_pagamento): ?>
                                                    <option value="<?php echo $forma_pagamento->forma_pagamento_id ?>">
                                                        <?php echo $forma_pagamento->forma_pagamento_nome; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <!-- FIXME: ordem_servico_cliente_id -->
                                        <div class="col-md-4 mb-2">
                                            <label for="ordem_servico_cliente_id">Cliente</label>
                                            <select class="form-control custom-select contas_receber" id="ordem_servico_cliente_id" name="ordem_servico_cliente_id">
                                                <?php foreach($clientes as $cliente): ?>
                                                    <option value="<?php echo $cliente->cliente_id ?>">
                                                        <?php echo $cliente->cliente_nome_razao; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <!-- FIXME: ordem_servico_status -->
                                        <div class="col-md-4 mb-2">
                                            <label for="ordem_servico_status">Situação</label>
                                            <select class="form-control custom-select" id="ordem_servico_status" name="ordem_servico_status">
                                                <option value="0">Pendente</option>
                                                <option value="1">Pago</option>
                                            </select>
                                        </div>
                                        <!-- FIXME: ordem_servico_descricao -->
                                        <div class="col-md-4 mb-2">
                                            <label for="ordem_servico_descricao">Descrição</label>
                                            <input type="text" class="form-control form-control-user" id="ordem_servico_descricao" name="ordem_servico_descricao"
                                            placeholder="Informe a descrição" value="<?php echo set_value('ordem_servico_descricao'); ?>" />
                                            <?php echo form_error('ordem_servico_descricao', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                        <!-- FIXME: ordem_servico_equipamento -->
                                        <div class="col-md-4 mb-2">
                                            <label for="ordem_servico_equipamento">Equipamento</label>
                                            <input type="text" class="form-control form-control-user" id="ordem_servico_equipamento" name="ordem_servico_equipamento"
                                            placeholder="Informe o equipamento" value="<?php echo set_value('ordem_servico_equipamento'); ?>" />
                                            <?php echo form_error('ordem_servico_equipamento', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                        <!-- FIXME: ordem_servico_marca_equipamento -->
                                        <div class="col-md-4 mb-2">
                                            <label for="ordem_servico_marca_equipamento">Marca</label>
                                            <input type="text" class="form-control form-control-user" id="ordem_servico_marca_equipamento" name="ordem_servico_marca_equipamento"
                                            placeholder="Informe o equipamento" value="<?php echo set_value('ordem_servico_marca_equipamento'); ?>" />
                                            <?php echo form_error('ordem_servico_marca_equipamento', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                        <!-- FIXME: ordem_servico_modelo_equipamento -->
                                        <div class="col-md-4 mb-2">
                                            <label for="ordem_servico_modelo_equipamento">Modelo</label>
                                            <input type="text" class="form-control form-control-user" id="ordem_servico_modelo_equipamento" name="ordem_servico_modelo_equipamento"
                                            placeholder="Informe o equipamento" value="<?php echo set_value('ordem_servico_modelo_equipamento'); ?>" />
                                            <?php echo form_error('ordem_servico_modelo_equipamento', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                        <!-- FIXME: ordem_servico_acessorios -->
                                        <div class="col-12 mb-2">
                                            <label for="ordem_servico_acessorios">Acessórios</label>
                                            <textarea class="form-control" id="ordem_servico_acessorios" name="ordem_servico_acessorios"
                                            placeholder="Informe a abservação"><?php echo set_value('ordem_servico_acessorios'); ?></textarea>
                                            <?php echo form_error('ordem_servico_acessorios', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                        <!-- FIXME: ordem_servico_defeito -->
                                        <div class="col-12 mb-2">
                                            <label for="ordem_servico_defeito">Defeitos</label>
                                            <textarea class="form-control" id="ordem_servico_defeito" name="ordem_servico_defeito"
                                            placeholder="Informe a abservação"><?php echo set_value('ordem_servico_defeito'); ?></textarea>
                                            <?php echo form_error('ordem_servico_defeito', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                        <!-- FIXME: ordem_servico_obs -->
                                        <div class="col-12 mb-2">
                                            <label for="ordem_servico_obs">Observações</label>
                                            <textarea class="form-control" id="ordem_servico_obs" name="ordem_servico_obs"
                                            placeholder="Informe a abservação"><?php echo set_value('ordem_servico_obs'); ?></textarea>
                                            <?php echo form_error('ordem_servico_obs', '<small class="form-text text-danger">','</small>') ?>
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