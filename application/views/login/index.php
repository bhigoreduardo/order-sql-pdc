<!-- FIXME: HEADER -->

    <!-- Begin Page Content -->
    <div class="container-fluid bg-gradient-primary min-vh-100">

        <!-- Outer Row -->
        <div class="row justify-content-center h-100">

            <div class="col-xl-10 col-lg-12 col-md-9 d-flex h-100 align-items-center justify-content-center">

                <div class="card o-hidden border-0 shadow-lg my-5 w-100">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Seja bem vindo!</h1>
                                    </div>
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
                                    <form class="user" method="POST" name="form_auth" action="<?php echo base_url('login/auth'); ?>">
                                        <!-- FIXME: email -->
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user"
                                                id="email" aria-describedby="emailHelp"
                                                placeholder="Informe seu email">
                                        </div>
                                        <!-- FIXME: password -->
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user"
                                                id="password" placeholder="Informe sua senha">
                                        </div>
                                        <!-- FIXME: TODO: Remember -->
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck" name="remember">
                                                <label class="custom-control-label" for="customCheck">Lembrar-me</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Entrar
                                        </button>
                                    </form>
                                    <!-- <hr> -->
                                    <!-- FIXME: TODO: Recovery password -->
                                    <!-- <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div> -->
                                    <!-- FIXME: TODO: Register -->
                                    <!-- <div class="text-center">
                                        <a class="small" href="register.html">Create an Account!</a>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <!-- /.container-fluid -->

<!-- FIXME: FOOTER -->