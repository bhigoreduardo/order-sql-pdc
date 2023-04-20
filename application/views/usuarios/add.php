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
                            <li class="breadcrumb-item"><a title="Usuários" href="<?php echo base_url('/usuarios')?>">Usuários</a></li>
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
                                href="<?php echo base_url('/usuarios'); ?>" 
                                class="btn btn-sm btn-success float-right">
                                <i class="fas fa-arrow-left"></i>&nbsp;
                                Voltar
                            </a>
                        </div>
                        <div class="card-body">
                            <form method="POST" name="form_add">
                                <div class="form-group row">
                                    <!-- FIXME: fist_name -->
                                    <div class="col-md-4 mb-2">
                                        <label for="first_name">Nome</label>
                                        <input type="text" class="form-control form-control-user" id="first_name" name="first_name"
                                        placeholder="Informe o nome" value="<?php echo set_value('first_name')?>" />
                                        <?php echo form_error('first_name', '<small class="form-text text-danger">', '</small>') ?>
                                    </div>
                                    <!-- FIXME: last_name -->
                                    <div class="col-md-4 mb-2">
                                        <label for="last_name">Sobrenome</label>
                                        <input type="text" class="form-control form-control-user" id="last_name" name="last_name"
                                        placeholder="Informe o sobrenome" value="<?php echo set_value('last_name'); ?>" />
                                        <?php echo form_error('last_name', '<small class="form-text text-danger">', '</small>')?>
                                    </div>
                                    <!-- FIXME: email -->
                                    <div class="col-md-4 mb-2">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control form-control-user" id="email" name="email"
                                        placeholder="Informe o e-mail (login)" value="<?php echo set_value('email'); ?>" />
                                        <?php echo form_error('email', '<small class="form-text text-danger">', '</small>')?>
                                    </div>
                                    <!-- FIXME: username -->
                                    <div class="col-md-4 mb-2">
                                        <label for="username">Usuário</label>
                                        <input type="username" class="form-control form-control-user" id="username" name="username"
                                        placeholder="Informe o nome de usuário" value="<?php echo set_value('username'); ?>" />
                                        <?php echo form_error('username', '<small class="form-text text-danger">', '</small>')?>
                                    </div>
                                    <!-- FIXME: active -->
                                    <div class="col-md-4 mb-2">
                                        <label for="active">Ativo</label>
                                        <select class="form-control custom-select" id="active" name="active">
                                            <option value="0">Inativo</option>
                                            <option value="1">Ativo</option>
                                        </select>
                                    </div>
                                    <!-- FIXME: group -->
                                    <div class="col-md-4 mb-2">
                                        <label for="group">Perfil</label>
                                        <select class="form-control custom-select" id="group" name="group">
                                            <option value="2">Vendedor</option>
                                            <option value="1">Administrador</option>
                                        </select>
                                    </div>
                                    <!-- FIXME: password -->
                                    <div class="col-md-6 mb-2">
                                        <label for="password">Senha</label>
                                        <input type="password" class="form-control form-control-user" id="password" name="password"
                                        placeholder="Informe a senha" />
                                        <?php echo form_error('password', '<small class="form-text text-danger">', '</small>')?>
                                    </div>
                                    <!-- FIXME: repeat_password -->
                                    <div class="col-md-6 mb-2">
                                        <label for="repeat_password">Repetir Senha</label>
                                        <input type="password" class="form-control form-control-user" id="repeat_password" name="repeat_password"
                                        placeholder="Repita a senha" />
                                        <?php echo form_error('repeat_password', '<small class="form-text text-danger">', '</small>')?>
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