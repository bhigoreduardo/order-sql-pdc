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

                     <!-- Data Tables -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a title="Cadastrar serviço" 
                                href="<?php echo base_url($this->router->fetch_class().'/add'); ?>"
                                class="btn btn-sm btn-success float-right">
                                <i class="fas fa-laptop"></i>&nbsp;
                                Cadastrar serviço
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Serviço</th>
                                            <th>Preço</th>
                                            <th>Descrição</th>
                                            <th>Data alteração</th>
                                            <th class="text-center pr-2" width="5%">Ativo</th>
                                            <th class="text-center no-sort" width="15%">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($servicos as $servico): ?>
                                            <tr>
                                                <td><?php echo $servico->servico_id; ?></td>
                                                <td><?php echo mb_strimwidth($servico->servico_nome, 0, 30, '...'); ?></td>
                                                <td>
                                                    <?php echo 'R$&nbsp' . $servico->servico_preco; ?>
                                                </td>
                                                <td><?php echo mb_strimwidth($servico->servico_descricao, 0, 30, '...'); ?></td>
                                                <td><?php echo formata_data_banco_sem_hora($servico->servico_data_alteracao); ?></td>
                                                <td class="text-center">
                                                    <?php if($servico->servico_ativo == 1) {
                                                        echo '<span class="badge badge-info">Sim</span>';
                                                    } else {
                                                        echo '<span class="badge badge-warning">Não</span>';
                                                    } ?>
                                                </td>
                                                <td class="text-center">
                                                    <a title="Editar"
                                                        href="<?php echo base_url($this->router->fetch_class().'/edit/'.$servico->servico_id); ?>"
                                                        class="btn btn-sm btn-primary">
                                                        <i class="fas fa-user-edit"></i>&nbsp;
                                                        Editar
                                                    </a>
                                                    <a title="Excluir"
                                                        href="javascript(void)"
                                                        class="btn btn-sm btn-danger"
                                                        data-toggle="modal"
                                                        data-target="#servico-<?php echo $servico->servico_id; ?>">
                                                        <i class="fas fa-user-times"></i>&nbsp;
                                                        Excluir
                                                    </a>
                                                </td>
                                            </tr>

                                            <!-- Delete Modal-->
                                            <div class="modal fade" id="servico-<?php echo $servico->servico_id; ?>" tabindex="-1" role="dialog" 
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Realmente deseja excluir este registro?</h5>
                                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">Selecione <strong>"Sim"</strong> para confirmar sua ação.</div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-sm btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                                                            <a class="btn btn-sm btn-danger" 
                                                            href="<?php echo base_url($this->router->fetch_class().'/del/'.$servico->servico_id); ?>">Sim</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Serviço</th>
                                            <th>Preço</th>
                                            <th>Descrição</th>
                                            <th>Data alteração</th>
                                            <th class="text-center pr-2">Ativo</th>
                                            <th class="text-center no-sort">Ações</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Container-fluid -->

        </div>
        <!-- End of Main Content -->

<!-- FIXME: FOOTER -->