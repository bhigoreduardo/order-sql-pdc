<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('/'); ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-user"></i>
        </div>
        <div class="sidebar-brand-text mx-3">OS - Inovare Soft</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('/'); ?>">
            <i class="fas fa-home"></i>
            <span>Início</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Seções
    </div>

    <!-- Nav Item - Cadastros -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne"
            aria-expanded="true" aria-controls="collapseOne">
            <i class="fas fa-database"></i>
            <span>Cadastros</span>
        </a>
        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Opções:</h6>
                <!-- Nav Item - Clientes -->
                <a title="Gerenciar clientes" class="collapse-item" href="<?php echo base_url('clientes'); ?>">
                    <i class="fas fa-user-tie"></i>&nbsp;Clientes
                </a>
                <!-- Nav Item - Fornecedores -->
                <a title="Gerenciar fornecedores" class="collapse-item" href="<?php echo base_url('fornecedores'); ?>">
                    <i class="fas fa-user-tag"></i>&nbsp;Fornecedores
                </a>
                <!-- Nav Item - Vendedores -->
                <a title="Gerenciar vendedores" class="collapse-item" href="<?php echo base_url('vendedores'); ?>">
                    <i class="fas fa-user-friends"></i>&nbsp;Vendedores
                </a>
                <!-- Nav Item - Serviços -->
                <a title="Gerenciar serviços" class="collapse-item" href="<?php echo base_url('servicos'); ?>">
                    <i class="fas fa-laptop"></i>&nbsp;Serviços
                </a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Estoques -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-box-open"></i>
            <span>Estoques</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Opções:</h6>
                <!-- Nav Item - Marcas -->
                <a title="Gerenciar marcas" class="collapse-item" href="<?php echo base_url('marcas'); ?>">
                    <i class="fas fa-cubes"></i>&nbsp;Marcas
                </a>
                <!-- Nav Item - Categorias -->
                <a title="Gerenciar categorias" class="collapse-item" href="<?php echo base_url('categorias'); ?>">
                    <i class="fab fa-buffer"></i>&nbsp;Categorias
                </a>
                <!-- Nav Item - Produtos -->
                <a title="Gerenciar produtos" class="collapse-item" href="<?php echo base_url('produtos'); ?>">
                    <i class="fas fa-boxes"></i>&nbsp;Produtos
                </a>
            </div>
        </div>
    </li>

    <!-- Adminstrador -->
    <!-- Nav Item - Financeiro -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
            aria-expanded="true" aria-controls="collapseThree">
            <i class="fas fa-wallet"></i>
            <span>Financeiro</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Opções:</h6>
                <!-- Nav Item - Contas à pagar -->
                <a title="Gerenciar contas à pagar" class="collapse-item" href="<?php echo base_url('pagar'); ?>">
                    <i class="fas fa-book"></i>&nbsp;Contas à pagar
                </a>
                <!-- Nav Item - Contas à receber -->
                <a title="Gerenciar contas à receber" class="collapse-item" href="<?php echo base_url('receber'); ?>">
                    <i class="fas fa-hand-holding-usd"></i>&nbsp;Contas à receber
                </a>
                <!-- Nav Item - Formas de pagamento -->
                <a title="Gerenciar formas de pagamento" class="collapse-item" href="<?php echo base_url('pagamentos'); ?>">
                    <i class="fas fa-credit-card"></i>&nbsp;Formas de pagamento
                </a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Vendas -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour"
            aria-expanded="true" aria-controls="collapseFour">
            <i class="fas fa-cash-register"></i>
            <span>Vendas</span>
        </a>
        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Opções:</h6>
                <!-- Nav Item - Ordens de serviço -->
                <a title="Gerenciar ordens de serviço" class="collapse-item" href="<?php echo base_url('ordens'); ?>">
                    <i class="fas fa-shopping-basket"></i>&nbsp;Ordens de serviço
                </a>
                <!-- Nav Item - Vendas -->
                <a title="Gerenciar vendas" class="collapse-item" href="<?php echo base_url('vendas'); ?>">
                    <i class="fas fa-shopping-cart"></i>&nbsp;Vendas
                </a>
            </div>
        </div>
    </li>

    <!-- Adminstrador -->
    <!-- Nav Item - Relatórios -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFive"
            aria-expanded="true" aria-controls="collapseFive">
            <i class="fas fa-search-dollar"></i>
            <span>Relatórios</span>
        </a>
        <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Opções:</h6>
                <!-- Nav Item - Relatório de contas à pagar -->
                <a title="Gerenciar relatório de contas à pagar" class="collapse-item" href="<?php echo base_url('relatorio-contas-pagar'); ?>">
                    <i class="fas fa-book"></i>&nbsp;Contas à pagar
                </a>
                <!-- Nav Item - Relatório de contas à receber -->
                <a title="Gerenciar relatório de contas à receber" class="collapse-item" href="<?php echo base_url('relatorio-contas-receber'); ?>">
                    <i class="fas fa-hand-holding-usd"></i>&nbsp;Contas à receber
                </a>
                <!-- Nav Item - Relatório de ordens de serviço -->
                <a title="Gerenciar relatório de ordens de serviço" class="collapse-item" href="<?php echo base_url('relatorio-ordens'); ?>">
                    <i class="fas fa-shopping-basket"></i>&nbsp;Ordens de serviço
                </a>
                <!-- Nav Item - Relatório de vendas -->
                <a title="Gerenciar relatório de vendas" class="collapse-item" href="<?php echo base_url('relatorio-vendas'); ?>">
                    <i class="fas fa-shopping-cart"></i>&nbsp;Vendas
                </a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Configurações
    </div>

    <!-- Nav Item - Usuários -->
    <li class="nav-item">
        <a title="Gerenciar usuários" class="nav-link" href="<?php echo base_url('usuarios'); ?>">
            <i class="fas fa-users"></i>
            <span>Usuários</span>
        </a>
    </li>

    <!-- Nav Item - Sistema -->
    <li class="nav-item">
        <a title="Gerenciar dados do sistema" class="nav-link" href="<?php echo base_url('sistema'); ?>">
            <i class="fas fa-cogs"></i>
            <span>Sistema</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->

<!-- Nav Item - Pages Collapse Menu -->
<!-- <li class="nav-item active">
    <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
        aria-controls="collapsePages">
        <i class="fas fa-fw fa-folder"></i>
        <span>Pages</span>
    </a>
    <div id="collapsePages" class="collapse show" aria-labelledby="headingPages"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Login Screens:</h6>
            <a class="collapse-item" href="login.html">Login</a>
            <a class="collapse-item" href="register.html">Register</a>
            <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
            <div class="collapse-divider"></div>
            <h6 class="collapse-header">Other Pages:</h6>
            <a class="collapse-item" href="404.html">404 Page</a>
            <a class="collapse-item active" href="blank.html">Blank Page</a>
        </div>
    </div>
</li> -->

<!-- Nav Item - Utilities Collapse Menu -->
<!-- <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Utilities</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Utilities:</h6>
            <a class="collapse-item" href="utilities-color.html">Colors</a>
            <a class="collapse-item" href="utilities-border.html">Borders</a>
            <a class="collapse-item" href="utilities-animation.html">Animations</a>
            <a class="collapse-item" href="utilities-other.html">Other</a>
        </div>
    </div>
</li> -->