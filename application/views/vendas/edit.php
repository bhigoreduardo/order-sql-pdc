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
                                    <?php echo formata_data_banco_com_hora($venda->venda_data_alteracao); ?>
                                </p>
                                <p class="float-left">
                                    <strong>
                                        <i class="fas fa-clock"></i>&nbsp;Data do cadastro:
                                    </strong>&nbsp;
                                    <?php echo formata_data_banco_com_hora($venda->venda_data_cadastro); ?>
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
                            <form method="POST" id="form" name="form_edit" enctype="multipart/form-data"  accept-charset="utf-8">
                                <fieldset class="mb-4 p-2 border">
                                    <legend class="font-small"><i class="fas fa-shopping-cart"></i>&nbsp;&nbsp;Escolha os produtos</legend>

                                    <!-- FIXME: venda_produto_id_produto  -->
                                    <div class="form-group row">
                                        <div class="ui-widget col-lg-12 mb-1 mt-1">
                                            <input id="buscar_produtos" class="search form-control form-control-lg col-lg-12" placeholder="Que produto você está buscando?">
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table id="table_produtos" class="table">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th class="" style="width: 55%">Produto</th>
                                                    <th class="text-right pr-2" style="width: 12%">Valor unitário</th>
                                                    <th class="text-center" style="width: 8%">Qtd</th>
                                                    <th class="" style="width: 8%">% Desc</th>
                                                    <th class="text-right pr-2" style="width: 15%">Total</th>
                                                    <th class="" style="width: 25%"></th>
                                                    <th class="" style="width: 25%"></th>
                                                </tr>
                                            </thead>
                                            <tbody id="lista_produtos" class="item">
                                                <?php $i = 0; ?>
                                                <?php foreach($produtos as $produto): ?>
                                                <?php $i++; ?>
                                                    <tr>
                                                        <td><input type="hidden" name="produto_id[]" value="<?php echo $produto->produto_id; ?>" data-cell="A<?php echo $i; ?>'" data-format="0" readonly></td>
                                                        <td><input title="Descrição do produto" type="text" name="produto_descricao[]" value="<?php echo $produto->produto_descricao; ?>" class="produto_descricao form-control form-control-user input-sm" data-cell="B<?php echo $i; ?>" readonly></td>
                                                        <td><input title="Valor unitário do produto" name="produto_preco_venda[]" value="<?php echo $produto->venda_produto_valor_unitario; ?>" class="form-control form-control-user input-sm text-right money pr-1" data-cell="C<?php echo $i; ?>" data-format="R$ 0,0.00" readonly></td>
                                                        <td><input title="Digite a quantidade apenas em número inteiros" type="text" inputmode="numeric" pattern="[-+]?[0-9]*[.,]?[0-9]+" name="produto_quantidade[]" value="<?php echo $produto->venda_produto_quantidade; ?>" class="qty form-control form-control-user text-center" data-cell="D<?php echo $i; ?>" data-format="0[.]00" required></td>
                                                        <td><input title="Insira o desconto" name="produto_desconto[]" class="form-control form-control-user input-sm text-right" value="<?php echo $produto->venda_produto_desconto; ?>" data-cell="E<?php echo $i; ?>" data-format="0,0[.]00 %" required></td>
                                                        <td><input title="Valor total do produto selecionado" name="produto_item_total[]" value="<?php echo $produto->venda_produto_valor_total; ?>" class="form-control form-control-user input-sm text-right pr-1" data-cell="F<?php echo $i; ?>" data-format="R$ 0,0.00" data-formula="D<?php echo $i; ?>*(C<?php echo $i; ?>-(C<?php echo $i; ?>*E<?php echo $i; ?>))" readonly></td>
                                                        <td class="text-center"><input type="hidden" name="valor_desconto_produto[]" data-cell="H<?php echo $i; ?>"  data-format="R$ 0,0.00" data-formula="((C<?php echo $i; ?>*D<?php echo $i; ?>)-F<?php echo $i; ?>)"><button title="Remover o produto" class="btn-remove btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                            <tfoot>
                                                <tr class="">
                                                    <td colspan="5" class="text-right border-0">
                                                        <label class="font-weight-bold pt-1" for="total">Valor de desconto:</label>
                                                    </td>

                                                    <td class="text-right border-0">
                                                        <input type="text" name="venda_valor_desconto" class="form-control form-control-user text-right pr-1" data-format="$ 0,0.00" data-cell="L1" data-formula="SUM(H1:H<?php echo $i; ?>)" readonly="">
                                                    </td>
                                                    <td class="border-0">&nbsp;</td>
                                                </tr>

                                                <tr class="">
                                                    <td colspan="5" class="text-right border-0">
                                                        <label class="font-weight-bold pt-1" for="total">Total a pagar:</label>
                                                    </td>

                                                    <td class="text-right border-0">
                                                        <input type="text" name="venda_valor_total" class="form-control form-control-user text-right pr-1" data-format="$ 0,0.00" data-cell="G2" data-formula="SUM(F1:F<?php echo $i; ?>)" readonly="">
                                                    </td>
                                                    <td class="border-0">&nbsp;</td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </fieldset>

                                <fieldset class="mb-4 p-2 border">
                                    <legend class="font-small"><i class="far fa-money-bill-alt"></i>&nbsp;&nbsp;Informações da venda</legend>

                                    <div class="form-group row">
                                        <!-- FIXME: venda_cliente_id -->
                                        <div class="col-md-4 mb-2">
                                            <label for="venda_cliente_id">Cliente</label>
                                            <select class="form-control custom-select contas_receber" id="venda_cliente_id" name="venda_cliente_id">
                                                <?php foreach($clientes as $cliente): ?>
                                                    <option value="<?php echo $cliente->cliente_id ?>" <?php echo ($cliente->cliente_id == $venda->venda_cliente_id ? 'selected' : ''); ?>>
                                                        <?php echo $cliente->cliente_nome_razao; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <!-- FIXME: venda_forma_pagamento_id -->
                                        <div class="col-md-4 mb-2">
                                            <label for="venda_forma_pagamento_id">Forma pagamento</label>
                                            <select class="form-control custom-select forma_pagamento" id="venda_forma_pagamento_id" name="venda_forma_pagamento_id">
                                                <?php foreach($formas_pagamentos as $forma_pagamento): ?>
                                                    <option value="<?php echo $forma_pagamento->forma_pagamento_id ?>" <?php echo ($forma_pagamento->forma_pagamento_id == $venda->venda_forma_pagamento_id ? 'selected' : ''); ?>>
                                                        <?php echo $forma_pagamento->forma_pagamento_nome; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <!-- FIXME: venda_vendedor_id -->
                                        <div class="col-md-4 mb-2">
                                            <label for="venda_vendedor_id">Vendedor</label>
                                            <select class="form-control custom-select vendedor" id="venda_vendedor_id" name="venda_vendedor_id">
                                                <?php foreach($vendedores as $vendedor): ?>
                                                    <option value="<?php echo $vendedor->vendedor_id ?>" <?php echo ($vendedor->vendedor_id == $venda->venda_vendedor_id ? 'selected' : ''); ?>>
                                                        <?php echo $vendedor->vendedor_nome_completo; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <!-- FIXME: venda_tipo -->
                                        <div class="col-md-4 mb-2">
                                            <label for="venda_tipo">Tipo</label>
                                            <select class="form-control custom-select" id="venda_tipo" name="venda_tipo">
                                                    <option value="0" <?php echo ($venda->venda_tipo == 0 ? 'selected' : ''); ?>>à vista</option>
                                                    <option value="1" <?php echo ($venda->venda_tipo == 0 ? '' : 'selected'); ?>>à prazo</option>
                                            </select>
                                        </div>
                                        <!-- FIXME: venda_status -->
                                        <div class="col-md-4 mb-2">
                                            <label for="venda_status">Situação</label>
                                            <select class="form-control custom-select" id="venda_status" name="venda_status">
                                                <option value="0" <?php echo ($venda->venda_status == 0 ? 'selected' : '') ;?>>Pendente</option>
                                                <option value="1" <?php echo ($venda->venda_status == 0 ? '' : 'selected') ;?>>Pago</option>
                                            </select>
                                        </div>

                                        <input type="hidden" name="venda_id" value="<?php echo $venda->venda_id; ?>" />
                                    </div>
                                </fieldset>

                                <button
                                    title="<?php echo ($venda->venda_status == 0 ? 'Atualizar dados' : 'Pago'); ?>"
                                    type="submit" class="btn btn-sm btn-primary"
                                    <?php echo ($venda->venda_status == 0 ? '' : 'disabled'); ?>>
                                    <?php echo ($venda->venda_status == 0 ? 'Atualizar dados' : 'Pago'); ?>
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- Container-fluid -->

        </div>
        <!-- End of Main Content -->

<!-- FIXME: FOOTER -->