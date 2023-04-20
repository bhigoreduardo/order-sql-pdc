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
                            <li class="breadcrumb-item"><a title="Ordens de serviço" href="<?php echo base_url('ordens'); ?>">Ordens de serviço</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo $titulo; ?></li>
                        </ol>
                        </nav>
                    </nav>

                    <!-- Alert Message -->
                    <?php if($message = $this->session->flashdata('info')): ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-info alert-dismissible fade show" role="alert">
                                    <strong>
                                        <i class="fas fa-info-circle"></i>&nbsp;&nbsp;
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
                            <div class="float-left">
                                <p class="float-left mr-2">
                                    <strong>
                                        <i class="fas fa-clock"></i>&nbsp;Última atualização:
                                    </strong>&nbsp;
                                    <?php echo formata_data_banco_com_hora($ordem_servico->ordem_servico_data_alteracao); ?>
                                </p>
                                <p class="float-left">
                                    <strong>
                                        <i class="fas fa-clock"></i>&nbsp;Data do cadastro:
                                    </strong>&nbsp;
                                    <?php echo formata_data_banco_com_hora($ordem_servico->ordem_servico_data_cadastro); ?>
                                </p>
                            </div>
                            <a title="Voltar" 
                                href="<?php echo base_url('ordens'); ?>" 
                                class="btn btn-sm btn-success float-right">
                                <i class="fas fa-arrow-left"></i>&nbsp;
                                Voltar
                            </a>
                        </div>
                        <div class="card-body">
                            <form method="POST" id="form" name="form_edit" enctype="multipart/form-data"  accept-charset="utf-8">
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
                                            <tbody id="lista_servicos">
                                                <?php if (isset($servicos)): ?>
                                                    <?php $i = 0; ?>
                                                    <?php foreach($servicos as $servico): ?>
                                                        <?php $i++; ?>
                                                        <tr>
                                                            <td><input type="hidden" name="servico_id[]" value="<?php echo $servico->ordem_ts_id_servico ; ?>" data-cell="A<?php echo $i; ?>" data-format="0" readonly></td>
                                                            <td><input title="Nome do servico" type="text" name="servico_nome[]" value="<?php echo $servico->servico; ?>" class="servico_nome form-control form-control-user input-sm" data-cell="B<?php echo $i; ?>" readonly></td>
                                                            <td><input title="Valor unitário do servico" name="servico_preco[]" value="<?php echo $servico->ordem_ts_valor_unitario ?>" class="form-control form-control-user input-sm text-right money pr-1" data-cell="C<?php echo $i; ?>" data-format="R$ 0,0.00" readonly></td>
                                                            <td><input title="Digite a quantidade apenas em número inteiros" type="text" inputmode="numeric" pattern="[-+]?[0-9]*[.,]?[0-9]+" name="servico_quantidade[]" value="<?php echo $servico->ordem_ts_quantidade ?>" class="qty form-control form-control-user text-center" data-cell="D<?php echo $i; ?>" data-format="0[.]00" required></td>
                                                            <td><input title="Insira o desconto" name="servico_desconto[]" class="form-control form-control-user input-sm text-right" value="<?php echo $servico->ordem_ts_valor_desconto ?>" data-cell="E<?php echo $i; ?>" data-format="0,0[.]00 %" required></td>
                                                            <td><input title="Valor total do servico selecionado" name="servico_item_total[]" value="<?php echo $servico->ordem_ts_valor_total ?>" class="form-control form-control-user input-sm text-right pr-1" data-cell="F<?php echo $i; ?>" data-format="R$ 0,0.00" data-formula="D<?php echo $i; ?>*(C<?php echo $i; ?>-(C<?php echo $i; ?>*E<?php echo $i; ?>))" readonly></td>
                                                            <td class="text-center"><input type="hidden" name="valor_desconto_servico[]" data-cell="H<?php echo $i; ?>"  data-format="R$ 0,0.00" data-formula="((C<?php echo $i; ?>*D<?php echo $i; ?>)-F<?php echo $i; ?>)"><button title="Remover o serviço" class="btn-remove btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </tbody>
                                            <tfoot>
                                                <tr class="">
                                                    <td colspan="5" class="text-right border-0">
                                                        <label class="font-weight-bold pt-1" for="total">Valor de desconto:</label>
                                                    </td>
                                                    <td class="text-right border-0">
                                                        <input type="text" name="ordem_servico_valor_desconto" class="form-control form-control-user text-right pr-1" data-format="$ 0,0.00" data-cell="L1" data-formula="SUM(H1:H<?php echo $i; ?>)" readonly="">
                                                    </td>
                                                    <td class="border-0">&nbsp;</td>
                                                </tr>

                                                <tr class="">
                                                    <td colspan="5" class="text-right border-0">
                                                        <label class="font-weight-bold pt-1" for="total">Total a pagar:</label>
                                                    </td>
                                                    <td class="text-right border-0">
                                                        <input type="text" name="ordem_servico_valor_total" class="form-control form-control-user text-right pr-1" data-format="$ 0,0.00" data-cell="G2" data-formula="SUM(F1:F<?php echo $i; ?>)" readonly="">
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
                                                    <option value="<?php echo $forma_pagamento->forma_pagamento_id ?>" <?php echo ($forma_pagamento->forma_pagamento_id == $ordem_servico->ordem_servico_forma_pagamento_id ? 'selected' : ''); ?>>
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
                                                    <option value="<?php echo $cliente->cliente_id ?>" <?php echo ($cliente->cliente_id == $ordem_servico->ordem_servico_cliente_id ? 'selected' : ''); ?>>
                                                        <?php echo $cliente->cliente_nome_razao; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <!-- FIXME: ordem_servico_status -->
                                        <div class="col-md-4 mb-2">
                                            <label for="ordem_servico_status">Situação</label>
                                            <select class="form-control custom-select" id="ordem_servico_status" name="ordem_servico_status">
                                                <option value="0" <?php echo ($ordem_servico->ordem_servico_status == 0 ? 'selected' : ''); ?>>Pendente</option>
                                                <option value="1" <?php echo ($ordem_servico->ordem_servico_status == 0 ? '' : 'selected'); ?>>Pago</option>
                                            </select>
                                        </div>
                                        <!-- FIXME: ordem_servico_descricao -->
                                        <div class="col-md-4 mb-2">
                                            <label for="ordem_servico_descricao">Descrição</label>
                                            <input type="text" class="form-control form-control-user" id="ordem_servico_descricao" name="ordem_servico_descricao"
                                            placeholder="Informe a descrição" value="<?php echo $ordem_servico->ordem_servico_descricao; ?>" />
                                            <?php echo form_error('ordem_servico_descricao', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                        <!-- FIXME: ordem_servico_equipamento -->
                                        <div class="col-md-4 mb-2">
                                            <label for="ordem_servico_equipamento">Equipamento</label>
                                            <input type="text" class="form-control form-control-user" id="ordem_servico_equipamento" name="ordem_servico_equipamento"
                                            placeholder="Informe o equipamento" value="<?php echo $ordem_servico->ordem_servico_equipamento; ?>" />
                                            <?php echo form_error('ordem_servico_equipamento', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                        <!-- FIXME: ordem_servico_marca_equipamento -->
                                        <div class="col-md-4 mb-2">
                                            <label for="ordem_servico_marca_equipamento">Marca</label>
                                            <input type="text" class="form-control form-control-user" id="ordem_servico_marca_equipamento" name="ordem_servico_marca_equipamento"
                                            placeholder="Informe o equipamento" value="<?php echo $ordem_servico->ordem_servico_marca_equipamento; ?>" />
                                            <?php echo form_error('ordem_servico_marca_equipamento', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                        <!-- FIXME: ordem_servico_modelo_equipamento -->
                                        <div class="col-md-4 mb-2">
                                            <label for="ordem_servico_modelo_equipamento">Modelo</label>
                                            <input type="text" class="form-control form-control-user" id="ordem_servico_modelo_equipamento" name="ordem_servico_modelo_equipamento"
                                            placeholder="Informe o equipamento" value="<?php echo $ordem_servico->ordem_servico_modelo_equipamento; ?>" />
                                            <?php echo form_error('ordem_servico_modelo_equipamento', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                        <!-- FIXME: ordem_servico_acessorios -->
                                        <div class="col-12 mb-2">
                                            <label for="ordem_servico_acessorios">Acessórios</label>
                                            <textarea class="form-control" id="ordem_servico_acessorios" name="ordem_servico_acessorios"
                                            placeholder="Informe a abservação"><?php echo $ordem_servico->ordem_servico_acessorios; ?></textarea>
                                            <?php echo form_error('ordem_servico_acessorios', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                        <!-- FIXME: ordem_servico_defeito -->
                                        <div class="col-12 mb-2">
                                            <label for="ordem_servico_defeito">Defeitos</label>
                                            <textarea class="form-control" id="ordem_servico_defeito" name="ordem_servico_defeito"
                                            placeholder="Informe a abservação"><?php echo $ordem_servico->ordem_servico_defeito; ?></textarea>
                                            <?php echo form_error('ordem_servico_defeito', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                        <!-- FIXME: ordem_servico_obs -->
                                        <div class="col-12 mb-2">
                                            <label for="ordem_servico_obs">Observações</label>
                                            <textarea class="form-control" id="ordem_servico_obs" name="ordem_servico_obs"
                                            placeholder="Informe a abservação"><?php echo $ordem_servico->ordem_servico_obs; ?></textarea>
                                            <?php echo form_error('ordem_servico_obs', '<small class="form-text text-danger">','</small>') ?>
                                        </div>

                                        <input type="hidden" name="ordem_servico_id" value="<?php echo $ordem_servico->ordem_servico_id; ?>" />
                                    </div>
                                </fieldset>

                                <button
                                    title="<?php echo ($ordem_servico->ordem_servico_status == 0 ? 'Atualizar dados' : 'Pago'); ?>"
                                    type="submit" class="btn btn-sm btn-primary"
                                    <?php echo ($ordem_servico->ordem_servico_status == 0 ? '' : 'disabled'); ?>>
                                    <?php echo ($ordem_servico->ordem_servico_status == 0 ? 'Atualizar dados' : 'Pago'); ?>
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- Container-fluid -->

        </div>
        <!-- End of Main Content -->

<!-- FIXME: FOOTER -->