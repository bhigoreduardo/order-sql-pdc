<?php

defined('BASEPATH') OR exit('Acesso não permitido.');

class Produtos extends CI_Controller {
    public function __construct() {
        parent::__construct();

        // Check loggedin
        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou, faça login novamente.');
            return redirect('login');
        }

        $this->load->model('produtos_model');
    }

    public function index() {
        $data = array(
            'titulo' => 'Produtos cadastrados',
            'styles' => array(
                'vendor/datatables/dataTables.bootstrap4.min.css',
            ),
            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js',
            ),
            'produtos' => $this->produtos_model->get_all(),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('produtos/index');
        $this->load->view('layout/footer');
    }

    public function edit($produto_id = null) {
        if (!$produto_id || !$this->core_model->get_by_id('produtos', array('produto_id' => $produto_id))) {
            $this->session->set_flashdata('error', 'Produto não cadastrado.');
            return redirect('produtos');
        }

        // produto_id
        $this->form_validation->set_rules('produto_codigo', 'código', 'trim|required|max_length[45]|callback_check_codigo');
        // produto_data_cadastro
        $this->form_validation->set_rules('produto_categoria_id', 'categoria', 'trim|required');
        $this->form_validation->set_rules('produto_marca_id', 'marca', 'trim|required');
        $this->form_validation->set_rules('produto_fornecedor_id', 'fornecedor', 'trim|required');
        $this->form_validation->set_rules('produto_descricao', 'descrição', 'trim|required|min_length[3]|max_length[145]|callback_check_descricao');
        $this->form_validation->set_rules('produto_unidade', 'unidade medida', 'trim|required|max_length[25]');
        $this->form_validation->set_rules('produto_codigo_barras', 'código de barras', 'trim|max_length[45]');
        $this->form_validation->set_rules('produto_ncm', 'NCM', 'trim|max_length[15]');
        $this->form_validation->set_rules('produto_preco_custo', 'preço custo', 'trim|required|max_length[45]');
        $this->form_validation->set_rules('produto_preco_venda', 'preço venda', 'trim|required|max_length[45]|callback_check_preco_venda');
        $this->form_validation->set_rules('produto_estoque_minimo', 'estoque mínimo', 'trim|required|greater_than_equal_to[0]|max_length[10]');
        $this->form_validation->set_rules('produto_quantidade_estoque', 'quantidade estoque', 'trim|required|greater_than_equal_to[0]|max_length[10]');
        // produto_ativo
        $this->form_validation->set_rules('produto_obs', 'observação', 'trim|max_length[500]');
        // produto_data_alteracao

        if ($this->form_validation->run()) {
            $data = elements(
                array(
                    // 'produto_id',
                    'produto_codigo',
                    // 'produto_data_cadastro',
                    'produto_categoria_id',
                    'produto_marca_id',
                    'produto_fornecedor_id',
                    'produto_descricao',
                    'produto_unidade',
                    'produto_codigo_barras',
                    'produto_ncm',
                    'produto_preco_custo',
                    'produto_preco_venda',
                    'produto_estoque_minimo',
                    'produto_quantidade_estoque',
                    'produto_ativo',
                    'produto_obs',
                    // 'produto_data_alteracao',
                ), $this->input->post(),
            );
            // Clear
            $data = html_escape($data);
            // Inser
            $this->core_model->update('produtos', $data, array('produto_id' => $produto_id));

            redirect('produtos');
        }

        $data = array(
            'titulo' => 'Editar produto',
            'styles' => array(
                'vendor/select2/select2.min.css',
            ),
            'scripts' => array(
                'vendor/select2/select2.min.js',
                'vendor/select2/app.js',
                'vendor/mask/jquery.mask.min.js',
                'vendor/mask/app.js',
            ),
            'produto' => $this->core_model->get_by_id('produtos', array('produto_id' => $produto_id)),
            'categorias' => $this->core_model->get_all('categorias', array('categoria_ativo' => 1)),
            'marcas' => $this->core_model->get_all('marcas', array('marca_ativo' => 1)),
            'fornecedores' => $this->core_model->get_all('fornecedores', array('fornecedor_ativo' => 1)),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('produtos/edit');
        $this->load->view('layout/footer');
    }

    public function add() {
        // produto_id
        $this->form_validation->set_rules('produto_codigo', 'código', 'trim|required|max_length[45]|is_unique[produtos.produto_codigo]');
        // produto_data_cadastro
        $this->form_validation->set_rules('produto_categoria_id', 'categoria', 'trim|required');
        $this->form_validation->set_rules('produto_marca_id', 'marca', 'trim|required');
        $this->form_validation->set_rules('produto_fornecedor_id', 'fornecedor', 'trim|required');
        $this->form_validation->set_rules('produto_descricao', 'descrição', 'trim|required|min_length[3]|max_length[145]|is_unique[produtos.produto_descricao]');
        $this->form_validation->set_rules('produto_unidade', 'unidade medida', 'trim|required|max_length[25]');
        $this->form_validation->set_rules('produto_codigo_barras', 'código de barras', 'trim|max_length[45]');
        $this->form_validation->set_rules('produto_ncm', 'NCM', 'trim|max_length[15]');
        $this->form_validation->set_rules('produto_preco_custo', 'preço custo', 'trim|required|max_length[45]');
        $this->form_validation->set_rules('produto_preco_venda', 'preço venda', 'trim|required|max_length[45]|callback_check_preco_venda');
        $this->form_validation->set_rules('produto_estoque_minimo', 'estoque mínimo', 'trim|required|greater_than_equal_to[0]|max_length[10]');
        $this->form_validation->set_rules('produto_quantidade_estoque', 'quantidade estoque', 'trim|required|greater_than_equal_to[0]|max_length[10]');
        // produto_ativo
        $this->form_validation->set_rules('produto_obs', 'observação', 'trim|max_length[500]');
        // produto_data_alteracao

        if ($this->form_validation->run()) {
            $data = elements(
                array(
                    // 'produto_id',
                    'produto_codigo',
                    // 'produto_data_cadastro',
                    'produto_categoria_id',
                    'produto_marca_id',
                    'produto_fornecedor_id',
                    'produto_descricao',
                    'produto_unidade',
                    'produto_codigo_barras',
                    'produto_ncm',
                    'produto_preco_custo',
                    'produto_preco_venda',
                    'produto_estoque_minimo',
                    'produto_quantidade_estoque',
                    'produto_ativo',
                    'produto_obs',
                    // 'produto_data_alteracao',
                ), $this->input->post(),
            );
            // Clear
            $data = html_escape($data);
            // Inser
            $this->core_model->insert('produtos', $data);

            redirect('produtos');
        }

        $data = array(
            'titulo' => 'Cadastrar produto',
            'styles' => array(
                'vendor/select2/select2.min.css',
            ),
            'scripts' => array(
                'vendor/select2/select2.min.js',
                'vendor/select2/app.js',
                'vendor/mask/jquery.mask.min.js',
                'vendor/mask/app.js',
            ),
            'categorias' => $this->core_model->get_all('categorias', array('categoria_ativo' => 1)),
            'marcas' => $this->core_model->get_all('marcas', array('marca_ativo' => 1)),
            'fornecedores' => $this->core_model->get_all('fornecedores', array('fornecedor_ativo' => 1)),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('produtos/add');
        $this->load->view('layout/footer');
    }

    public function del($produto_id = null) {
        if (!$produto_id || !$this->core_model->get_by_id('produtos', array('produto_id' => $produto_id))) {
            $this->session->set_flashdata('error', 'Produto não cadastrado.');
            return redirect('produtos');
        }

        if (!$this->ion_auth->is_admin()) {
            $this->session->set_flashdata('info', 'Perfil não tem permissão para excluir registro.');
            return redirect('produtos');
        } else {
            if ($this->core_model->delete('produtos', array('produto_id' => $produto_id))) {
                $this->session->set_flashdata('success', 'Registro excluído com sucesso.');
            }

            return redirect('produtos');
        }

        $this->session->set_flashdata('error', 'Falha na tentativa de excluir o registro.');
        return redirect('produtos');
    }

    public function check_codigo($produto_codigo) {
        $produto_id = $this->input->post('produto_id');

        if ($this->core_model->get_by_id('produtos', array('produto_codigo' => $produto_codigo, 'produto_id !=' => $produto_id))) {
            $this->form_validation->set_message('check_codigo', 'Código já cadastrado.');
            return false;
        }

        return true;
    }

    public function check_descricao($produto_descricao) {
        $produto_id = $this->input->post('produto_id');

        if ($this->core_model->get_by_id('produtos', array('produto_id !=' => $produto_id, 'produto_descricao' => $produto_descricao))) {
            $this->form_validation->set_message('check_descricao', 'Descrição já cadastrada.');

            return false;
        }

        return true;
    }

    public function check_preco_venda($produto_preco_venda) {
        $produto_preco_custo = $this->input->post('produto_preco_custo');

        $produto_preco_custo = str_replace(',', '', $produto_preco_custo);
        $produto_preco_venda = str_replace(',', '', $produto_preco_venda);

        $produto_preco_custo = str_replace('.', '', $produto_preco_custo);
        $produto_preco_venda = str_replace('.', '', $produto_preco_venda);

        if ($produto_preco_venda < $produto_preco_custo) {
            $this->form_validation->set_message('check_preco_venda', 'Venda não pode ser inferior ao custo.');
            return false;
        }

        return true;
    }
}