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
                            <li class="breadcrumb-item"><a title="Produtos" href="<?php echo base_url($this->router->fetch_class()); ?>">Produtos</a></li>
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
                                    <legend class="font-small"><i class="fas fa-box"></i>&nbsp;Informações do produto</legend>
                                    <div class="form-group row">
                                        <!-- FIXME: produto_codigo -->
                                        <div class="col-md-4 mb-2">
                                            <label for="produto_codigo">Código</label>
                                            <input type="text" class="form-control form-control-user" id="produto_codigo" name="produto_codigo"
                                            placeholder="Informe o código" value="<?php echo set_value('produto_codigo'); ?>" />
                                            <?php echo form_error('produto_codigo', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                        <!-- FIXME: produto_codigo_barras -->
                                        <div class="col-md-4 mb-2">
                                            <label for="produto_codigo_barras">Código de barras</label>
                                            <input type="text" class="form-control form-control-user" id="produto_codigo_barras" name="produto_codigo_barras"
                                            placeholder="Informe o código de barras" value="<?php echo set_value('produto_codigo_barras'); ?>" />
                                            <?php echo form_error('produto_codigo_barras', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                        <!-- FIXME: produto_ncm -->
                                        <div class="col-md-4 mb-2">
                                            <label for="produto_ncm">NCM</label>
                                            <input type="text" class="form-control form-control-user" id="produto_ncm" name="produto_ncm"
                                            placeholder="Informe o NCM" value="<?php echo set_value('produto_ncm'); ?>" />
                                            <?php echo form_error('produto_ncm', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                        <!-- FIXME: produto_descricao -->
                                        <div class="col-md-4 mb-2">
                                            <label for="produto_descricao">Descrição</label>
                                            <input type="text" class="form-control form-control-user" id="produto_descricao" name="produto_descricao"
                                            placeholder="Informe a descrição" value="<?php echo set_value('produto_descricao'); ?>" />
                                            <?php echo form_error('produto_descricao', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                        <!-- FIXME: produto_categoria_id -->
                                        <div class="col-md-4 mb-2">
                                            <label for="produto_categoria_id">Categoria</label>
                                            <select class="form-control custom-select categoria" id="produto_categoria_id" name="produto_categoria_id">
                                                <?php foreach($categorias as $categoria): ?>
                                                    <option value="<?php echo $categoria->categoria_id; ?>">
                                                        <?php echo $categoria->categoria_nome; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <!-- FIXME: produto_marca_id -->
                                        <div class="col-md-4 mb-2">
                                            <label for="produto_marca_id">Marca</label>
                                            <select class="form-control custom-select marca" id="produto_marca_id" name="produto_marca_id">
                                                <?php foreach($marcas as $marca): ?>
                                                    <option value="<?php echo $marca->marca_id; ?>">
                                                        <?php echo $marca->marca_nome; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <!-- FIXME: produto_fornecedor_id -->
                                        <div class="col-md-4 mb-2">
                                            <label for="produto_fornecedor_id">Fornecedor</label>
                                            <select class="form-control custom-select fornecedor" id="produto_fornecedor_id" name="produto_fornecedor_id">
                                                <?php foreach($fornecedores as $fornecedor): ?>
                                                    <option value="<?php echo $fornecedor->fornecedor_id; ?>">
                                                        <?php echo $fornecedor->fornecedor_nome_razao; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset class="mb-4 p-2 border">
                                    <legend class="font-small"><i class="fas fa-funnel-dollar"></i>&nbsp;Informações de custo e estoque</legend>
                                    <div class="form-group row">
                                        <!-- FIXME: produto_preco_custo -->
                                        <div class="col-md-4 mb-2">
                                            <label for="produto_preco_custo">Preço custo</label>
                                            <input type="text" class="form-control form-control-user money" id="produto_preco_custo" name="produto_preco_custo"
                                            placeholder="Informe o preço de custo" value="<?php echo set_value('produto_preco_custo'); ?>" />
                                            <?php echo form_error('produto_preco_custo', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                        <!-- FIXME: produto_preco_venda -->
                                        <div class="col-md-4 mb-2">
                                            <label for="produto_preco_venda">Preço venda</label>
                                            <input type="text" class="form-control form-control-user money" id="produto_preco_venda" name="produto_preco_venda"
                                            placeholder="Informe o preço de venda" value="<?php echo set_value('produto_preco_venda'); ?>" />
                                            <?php echo form_error('produto_preco_venda', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                        <!-- FIXME: produto_estoque_minimo -->
                                        <div class="col-md-4 mb-2">
                                            <label for="produto_estoque_minimo">Estoque mínimo</label>
                                            <input type="text" class="form-control form-control-user" id="produto_estoque_minimo" name="produto_estoque_minimo"
                                            placeholder="Informe o preço de venda" value="<?php echo set_value('produto_estoque_minimo'); ?>" />
                                            <?php echo form_error('produto_estoque_minimo', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                        <!-- FIXME: produto_quantidade_estoque -->
                                        <div class="col-md-4 mb-2">
                                            <label for="produto_quantidade_estoque">Quantidade estoque</label>
                                            <input type="text" class="form-control form-control-user" id="produto_quantidade_estoque" name="produto_quantidade_estoque"
                                            placeholder="Informe o preço de venda" value="<?php echo set_value('produto_quantidade_estoque'); ?>" />
                                            <?php echo form_error('produto_quantidade_estoque', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                        <!-- FIXME: produto_unidade -->
                                        <div class="col-md-4 mb-2">
                                            <label for="produto_unidade">Unidade medida</label>
                                            <input type="text" class="form-control form-control-user" id="produto_unidade" name="produto_unidade"
                                            placeholder="Informe o preço de venda" value="<?php echo set_value('produto_unidade'); ?>" />
                                            <?php echo form_error('produto_unidade', '<small class="form-text text-danger">','</small>') ?>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset class="mb-4 p-2 border">
                                    <legend class="font-small"><i class="fas fa-tools"></i>&nbsp;Alterações</legend>
                                    <div class="form-group row">
                                        <!-- FIXME: produto_ativo -->
                                        <div class="col-md-4 mb-2">
                                            <label for="produto_ativo">Ativo</label>
                                            <select class="form-control custom-select" id="produto_ativo" name="produto_ativo">
                                                <option value="0">Não</option>
                                                <option value="1">Sim</option>
                                            </select>
                                        </div>
                                    </div>
                                </fieldset>

                                <div class="form-group row">
                                    <!-- FIXME: produto_obs -->
                                    <div class="col-12 mb-2">
                                        <label for="produto_obs">Observação</label>
                                        <textarea class="form-control" id="produto_obs" name="produto_obs"
                                        placeholder="Informe a abservação"><?php echo set_value('produto_obs'); ?></textarea>
                                        <?php echo form_error('produto_obs', '<small class="form-text text-danger">','</small>') ?>
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