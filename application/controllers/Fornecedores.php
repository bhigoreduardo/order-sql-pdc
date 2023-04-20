<?php

defined('BASEPATH') OR exit('Acesso não permitido');

class Fornecedores extends CI_Controller {
    public function __construct() {
        parent::__construct();

        // Check loggedin
        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou, faça login novamente.');
            return redirect('login');
        }
    }

    public function index() {
        $data = array(
            'titulo' => 'Fornecedores cadastrados',
            'styles' => array(
                'vendor/datatables/dataTables.bootstrap4.min.css',
            ),
            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js',
                'vendor/mask/jquery.mask.min.js',
                'vendor/mask/app.js',
            ),
            'fornecedores' => $this->core_model->get_all('fornecedores'),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('fornecedores/index');
        $this->load->view('layout/footer');
    }   

    public function edit($fornecedor_id = null) {
        if (!$fornecedor_id || !$this->core_model->get_by_id('fornecedores', array('fornecedor_id' => $fornecedor_id))) {
            $this->session->set_flashdata('error', 'Fornecedor não cadastrado.');
            return redirect('fornecedores');
        }

        // fornecedor_id
        // fornecedor_data_cadastro
        // fornecedor_tipo
        // fornecedor_nome_razao
        // fornecedor_sobrenome_fantasia
        // fornecedor_data_nascimento
        // fornecedor_cpf_cnpj
        // fornecedor_rg_ie
        // fornecedor_telefone
        $this->form_validation->set_rules('fornecedor_celular', 'celular', 'trim|required|callback_check_celular');
        $this->form_validation->set_rules('fornecedor_email', 'email', 'trim|required|valid_email|max_length[100]|callback_check_email');
        $this->form_validation->set_rules('fornecedor_cep', 'cep', 'trim|required|callback_check_cep');
        $this->form_validation->set_rules('fornecedor_endereco', 'endereço', 'trim|required|max_length[145]');
        $this->form_validation->set_rules('fornecedor_numero_endereco', 'número', 'trim|numeric|max_length[20]');
        $this->form_validation->set_rules('fornecedor_bairro', 'bairro', 'trim|required|max_length[45]');
        $this->form_validation->set_rules('fornecedor_complemento', 'complemento', 'trim|max_length[45]');
        $this->form_validation->set_rules('fornecedor_cidade', 'cidade', 'trim|required|max_length[45]');
        $this->form_validation->set_rules('fornecedor_estado', 'estado', 'trim|required|exact_length[2]');
        // fornecedor_ativo
        $this->form_validation->set_rules('fornecedor_obs', 'observação', 'trim|max_length[500]');
        // fornecedor_data_alteracao

        if ($this->input->post('fornecedor_tipo') == 1) {
            $this->form_validation->set_rules('fornecedor_nome', 'nome', 'trim|required|min_length[3]|max_length[200]');
            $this->form_validation->set_rules('fornecedor_sobrenome', 'sobrenome', 'trim|required|min_length[3]|max_length[145]');
            $this->form_validation->set_rules('fornecedor_data_nascimento', 'data nascimento', 'trim|required');
            $this->form_validation->set_rules('fornecedor_cpf', 'CPF', 'trim|required|callback_check_cpf');
            $this->form_validation->set_rules('fornecedor_rg', 'RG', 'trim|required|callback_check_rg_ie');
        } else {
            $this->form_validation->set_rules('fornecedor_razao', 'razão social', 'trim|required|min_length[3]|max_length[200]');
            $this->form_validation->set_rules('fornecedor_fantasia', 'nome fantasia', 'trim|required|min_length[3]|max_length[145]');
            $this->form_validation->set_rules('fornecedor_cnpj', 'CNPJ', 'trim|required|callback_check_cnpj');
            $this->form_validation->set_rules('fornecedor_ie', 'IE', 'trim|required|callback_check_rg_ie');
        }

        if ($this->form_validation->run()) {
            $data = elements(
                array(
                    // 'fornecedor_id',
                    // 'fornecedor_data_cadastro',
                    'fornecedor_tipo',
                    // 'fornecedor_nome_razao',
                    // 'fornecedor_sobrenome_fantasia',
                    // 'fornecedor_data_nascimento',
                    // 'fornecedor_cpf_cnpj',
                    // 'fornecedor_rg_ie',
                    'fornecedor_telefone',
                    'fornecedor_celular',
                    'fornecedor_email',
                    'fornecedor_cep',
                    'fornecedor_endereco',
                    'fornecedor_numero_endereco',
                    'fornecedor_bairro',
                    'fornecedor_complemento',
                    'fornecedor_cidade',
                    // 'fornecedor_estado',
                    'fornecedor_ativo',
                    'fornecedor_obs',
                    // 'fornecedor_data_alteracao',
                ), $this->input->post(),
            );
            $data['fornecedor_estado'] = strtoupper($this->input->post('fornecedor_estado'));
            if ($this->input->post('fornecedor_tipo') == 1) {
                $data['fornecedor_nome_razao'] = $this->input->post('fornecedor_nome');
                $data['fornecedor_sobrenome_fantasia'] = $this->input->post('fornecedor_sobrenome');
                $data['fornecedor_data_nascimento'] = $this->input->post('fornecedor_data_nascimento');
                $data['fornecedor_cpf_cnpj'] = $this->input->post('fornecedor_cpf');
                $data['fornecedor_rg_ie'] = $this->input->post('fornecedor_rg');
            } else {
                $data['fornecedor_nome_razao'] = $this->input->post('fornecedor_razao');
                $data['fornecedor_sobrenome_fantasia'] = $this->input->post('fornecedor_fantasia');
                $data['fornecedor_cpf_cnpj'] = $this->input->post('fornecedor_cnpj');
                $data['fornecedor_rg_ie'] = $this->input->post('fornecedor_ie');
            }
            // Clear data
            $data = html_escape($data);

            // echo '<pre>';
            // print_r($data);
            // exit();

            // Update
            $this->core_model->update('fornecedores', $data, array('fornecedor_id' => $fornecedor_id));

            return redirect('fornecedores');
        }

        $data = array(
            'titulo' => 'Editar fornecedor',
            'scripts' => array(
                'vendor/mask/jquery.mask.min.js',
                'vendor/mask/app.js',
            ),
            'fornecedor' => $this->core_model->get_by_id('fornecedores', array('fornecedor_id' => $fornecedor_id)),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('fornecedores/edit');
        $this->load->view('layout/footer');
    }

    public function add() {
        // fornecedor_id
        // fornecedor_data_cadastro
        // fornecedor_tipo
        // fornecedor_nome_razao
        // fornecedor_sobrenome_fantasia
        // fornecedor_data_nascimento
        // fornecedor_cpf_cnpj
        // fornecedor_rg_ie
        // fornecedor_telefone
        $this->form_validation->set_rules('fornecedor_celular', 'celular', 'trim|required|is_unique[fornecedores.fornecedor_celular]');
        $this->form_validation->set_rules('fornecedor_email', 'email', 'trim|required|valid_email|max_length[100]|is_unique[fornecedores.fornecedor_email]');
        $this->form_validation->set_rules('fornecedor_cep', 'cep', 'trim|required|callback_check_cep');
        $this->form_validation->set_rules('fornecedor_endereco', 'endereço', 'trim|required|max_length[145]');
        $this->form_validation->set_rules('fornecedor_numero_endereco', 'número', 'trim|numeric|max_length[20]');
        $this->form_validation->set_rules('fornecedor_bairro', 'bairro', 'trim|required|max_length[45]');
        $this->form_validation->set_rules('fornecedor_complemento', 'complemento', 'trim|max_length[45]');
        $this->form_validation->set_rules('fornecedor_cidade', 'cidade', 'trim|required|max_length[45]');
        $this->form_validation->set_rules('fornecedor_estado', 'estado', 'trim|required|exact_length[2]');
        // fornecedor_ativo
        $this->form_validation->set_rules('fornecedor_obs', 'observação', 'trim|max_length[500]');
        // fornecedor_data_alteracao
        
        if ($this->input->post('fornecedor_tipo') == 1) {
            $this->form_validation->set_rules('fornecedor_nome', 'nome', 'trim|required|min_length[3]|max_length[200]');
            $this->form_validation->set_rules('fornecedor_sobrenome', 'sobrenome', 'trim|required|min_length[3]|max_length[145]');
            $this->form_validation->set_rules('fornecedor_data_nascimento', 'data nascimento', 'trim|required');
            $this->form_validation->set_rules('fornecedor_cpf', 'CPF', 'trim|required|is_unique[fornecedores.fornecedor_cpf_cnpj]|callback_check_cpf');
            $this->form_validation->set_rules('fornecedor_rg', 'RG', 'trim|required|is_unique[fornecedores.fornecedor_rg_ie]');
        } else {
            $this->form_validation->set_rules('fornecedor_razao', 'razão social', 'trim|required|min_length[3]|max_length[200]');
            $this->form_validation->set_rules('fornecedor_fantasia', 'nome fantasia', 'trim|required|min_length[3]|max_length[145]');
            $this->form_validation->set_rules('fornecedor_cnpj', 'CNPJ', 'trim|required|is_unique[fornecedores.fornecedor_cpf_cnpj]|callback_check_cnpj');
            $this->form_validation->set_rules('fornecedor_ie', 'IE', 'trim|required|is_unique[fornecedores.fornecedor_rg_ie]');
        }
        if ($this->input->post('fornecedor_telefone')) {
            $this->form_validation->set_rules('fornecedor_telefone', 'telefone', 'trim|is_unique[fornecedores.fornecedor_telefone]');
        }

        if ($this->form_validation->run()) {
            $data = elements(
                array(
                    // 'fornecedor_id',
                    // 'fornecedor_data_cadastro',
                    'fornecedor_tipo',
                    // 'fornecedor_nome_razao',
                    // 'fornecedor_sobrenome_fantasia',
                    // 'fornecedor_data_nascimento',
                    // 'fornecedor_cpf_cnpj',
                    // 'fornecedor_rg_ie',
                    'fornecedor_telefone',
                    'fornecedor_celular',
                    'fornecedor_email',
                    'fornecedor_cep',
                    'fornecedor_endereco',
                    'fornecedor_numero_endereco',
                    'fornecedor_bairro',
                    'fornecedor_complemento',
                    'fornecedor_cidade',
                    // 'fornecedor_estado',
                    'fornecedor_ativo',
                    'fornecedor_obs',
                    // 'fornecedor_data_alteracao',
                ), $this->input->post(),
            );
            $data['fornecedor_estado'] = strtoupper($this->input->post('fornecedor_estado'));
            if ($this->input->post('fornecedor_tipo') == 1) {
                $data['fornecedor_nome_razao'] = $this->input->post('fornecedor_nome');
                $data['fornecedor_sobrenome_fantasia'] = $this->input->post('fornecedor_sobrenome');
                $data['fornecedor_data_nascimento'] = $this->input->post('fornecedor_data_nascimento');
                $data['fornecedor_cpf_cnpj'] = $this->input->post('fornecedor_cpf');
                $data['fornecedor_rg_ie'] = $this->input->post('fornecedor_rg');
            } else {
                $data['fornecedor_nome_razao'] = $this->input->post('fornecedor_razao');
                $data['fornecedor_sobrenome_fantasia'] = $this->input->post('fornecedor_fantasia');
                $data['fornecedor_cpf_cnpj'] = $this->input->post('fornecedor_cnpj');
                $data['fornecedor_rg_ie'] = $this->input->post('fornecedor_ie');
            }
            // Clear data
            $data = html_escape($data);
            // Insert
            $this->core_model->insert('fornecedores', $data);

            return redirect('fornecedores');
        }

        $data = array(
            'titulo' => 'Cadastrar fornecedor',
            'scripts' => array(
                'vendor/mask/jquery.mask.min.js',
                'vendor/mask/app.js',
                'js/clientes.js'
            ),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('fornecedores/add');
        $this->load->view('layout/footer');
    }

    public function del($fornecedor_id = null) {
        if (!$fornecedor_id || !$this->core_model->get_by_id('fornecedores', array('fornecedor_id' => $fornecedor_id))) {
            $this->session->set_flashdata('error', 'Fornecedor não cadastrado.');
            return redirect('fornecedores');
        }

        if (!$this->ion_auth->is_admin()) {
            $this->session->set_flashdata('info', 'Perfil não tem permissão para excluir registro.');
            return redirect('fornecedores');
        } else {
            if ($this->core_model->delete('fornecedores', array('fornecedor_id' => $fornecedor_id))) {
                $this->session->set_flashdata('success', 'Registro excluído com sucesso.');
            }

            return redirect('fornecedores');
        }

        $this->session->set_flashdata('error', 'Falha na tentativa de excluir o registro.');
        return redirect('fornecedores');
    }

    public function check_cpf($fornecedor_cpf) {
        $fornecedor_id = $this->input->post('fornecedor_id');
        $fornecedor_cpf = preg_replace("/[^0-9]/", "", $fornecedor_cpf);
        $fornecedor_cpf = str_pad($fornecedor_cpf, 11, '0', STR_PAD_LEFT);

        if ($fornecedor_cpf == '00000000000' ||
            $fornecedor_cpf == '11111111111' ||
            $fornecedor_cpf == '22222222222' ||
            $fornecedor_cpf == '33333333333' ||
            $fornecedor_cpf == '44444444444' ||
            $fornecedor_cpf == '55555555555' ||
            $fornecedor_cpf == '66666666666' ||
            $fornecedor_cpf == '77777777777' ||
            $fornecedor_cpf == '88888888888' ||
            $fornecedor_cpf == '99999999999') {
            $this->form_validation->set_message('check_cpf', 'Digite um CPF válido.');
            return false;
        }
        if (strlen($fornecedor_cpf) != 11) {
            $this->form_validation->set_message('check_cpf', 'O campo CPF deve conter 11 números.');
            return false;
        }
        if (!is_numeric($fornecedor_cpf)) {
            $this->form_validation->set_message('check_cpf', 'O campo CPF deve conter apenas números.');
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            $d = 0;
            for ($c = 0; $c < $t; $c++) {
                $d += $fornecedor_cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;

            if ($fornecedor_cpf[$c] != $d) {
                $this->form_validation->set_message('check_cpf', 'Digite um CPF válido.');
                return false;
            }
        }

        if ($fornecedor_id) {
            if ($this->core_model->get_by_id('fornecedores', array('fornecedor_id !=' => $fornecedor_id, 'fornecedor_cpf_cnpj' => $fornecedor_cpf))) {
                $this->form_validation->set_message('check_cpf', 'Documento já está em uso.');
                return false;
            }
        }

        return true;
    }

    public function check_cnpj($fornecedor_cnpj) {
        $fornecedor_id = $this->input->post('fornecedor_id');
        $fornecedor_cnpj = preg_replace("/[^0-9]/", "", $fornecedor_cnpj);
        $fornecedor_cnpj = str_pad($fornecedor_cnpj, 14, '0', STR_PAD_LEFT);

        if ($fornecedor_cnpj == '00000000000000' ||
            $fornecedor_cnpj == '11111111111111' ||
            $fornecedor_cnpj == '22222222222222' ||
            $fornecedor_cnpj == '33333333333333' ||
            $fornecedor_cnpj == '44444444444444' ||
            $fornecedor_cnpj == '55555555555555' ||
            $fornecedor_cnpj == '66666666666666' ||
            $fornecedor_cnpj == '77777777777777' ||
            $fornecedor_cnpj == '88888888888888' ||
            $fornecedor_cnpj == '99999999999999' ||
            empty($fornecedor_cnpj)) {
                $this->form_validation->set_message('check_cnpj', 'Digite um CNPJ válido.');
                return false;
        }
        if (strlen($fornecedor_cnpj) != 14) {
            $this->form_validation->set_message('check_cnpj', 'O campo CNPJ deve conter 14 números.');
            return false;
        }
        if (!is_numeric($fornecedor_cnpj)) {
            $this->form_validation->set_message('check_cnpj', 'O campo CNPJ deve conter apenas números.');
            return false;
        }

        $j = 5;
        $k = 6;
        $soma1 = "";
        $soma2 = "";

        for ($i = 0; $i < 13; $i++) {
            $j = $j == 1 ? 9 : $j;
            $k = $k == 1 ? 9 : $k;
            $soma2 = intval($soma2) + ($fornecedor_cnpj[$i] * $k);

            if ($i < 12) {
                $soma1 = intval($soma1) + ($fornecedor_cnpj[$i] * $j);
            }

            $k--;
            $j--;
        }

        $digito1 = $soma1 % 11 < 2 ? 0 : 11 - $soma1 % 11;
        $digito2 = $soma2 % 11 < 2 ? 0 : 11 - $soma2 % 11;

        if (!($fornecedor_cnpj[12] == $digito1) and ($fornecedor_cnpj[13] == $digito2)) {
            $this->form_validation->set_message('check_cnpj', 'Digite um CNPJ válido.');
            return false;
        }
        if ($fornecedor_id) {
            if ($this->core_model->get_by_id('fornecedores', array('fornecedor_id !=' => $fornecedor_id, 'fornecedor_cpf_cnpj' => $fornecedor_cnpj))) {
                $this->form_validation->set_message('check_cnpj', 'Documento já está em uso.');
                return false;
            }
        }

        return true;
    }

    public function check_rg_ie($fornecedor_rg_ie) {
        $fornecedor_id = $this->input->post('fornecedor_id');

        if ($this->core_model->get_by_id('fornecedores', array('fornecedor_id !=' => $fornecedor_id, 'fornecedor_rg_ie' => $fornecedor_rg_ie))) {
            $this->form_validation->set_message('check_rg_ie', 'Documento já está em uso.');
            return false;
        }

        return true;
    }

    public function check_telefone($fornecedor_telefone) {
        $fornecedor_id = $this->input->post('fornecedor_id');
        $fornecedor_telefone = remove_caracteres($fornecedor_telefone);

        if (strlen($fornecedor_telefone) != 10) {
            $this->form_validation->set_message('check_telefone', 'O campo telefone deve conter 10 números com ddd.');
            return false;
        }
        if (!is_numeric($fornecedor_telefone)) {
            $this->form_validation->set_message('check_telefone', 'O campo telefone deve conter apenas números.');
            return false;
        }
        if ($fornecedor_id) {
            if ($this->core_model->get_by_id('fornecedores', array('fornecedor_id !=' => $fornecedor_id, 'fornecedor_telefone' => $fornecedor_telefone))) {
                $this->form_validation->set_message('check_telefone', 'Telefone já está em uso.');
                return false;
            }
        }

        return true;
    }

    public function check_celular($fornecedor_celular) {
        $fornecedor_id = $this->input->post('fornecedor_id');
        $fornecedor_celular = remove_caracteres($fornecedor_celular);

        if (strlen($fornecedor_celular) != 11) {
            $this->form_validation->set_message('check_celular', 'O campo celular deve conter 11 números com ddd.');
            return false;
        }
        if (!is_numeric($fornecedor_celular)) {
            $this->form_validation->set_message('check_celular', 'O campo celular deve conter apenas números.');
            return false;
        }
        if ($fornecedor_id) {
            if ($this->core_model->get_by_id('fornecedores', array('fornecedor_id !=' => $fornecedor_id, 'fornecedor_celular' => $fornecedor_celular))) {
                $this->form_validation->set_message('check_celular', 'Celular já está em uso.');
                return false;
            }
        }

        return true;
    }

    public function check_email($fornecedor_email) {
        $fornecedor_id = $this->input->post('fornecedor_id');

        if ($this->core_model->get_by_id('fornecedores', array('fornecedor_id !=' => $fornecedor_id, 'fornecedor_email' => $fornecedor_email))) {
            $this->form_validation->set_message('email_check', 'Email já está em uso.');
            return false;
        }

        return true;
    }

    public function check_cep($fornecedor_cep) {
        $fornecedor_cep = remove_caracteres($fornecedor_cep);

        if (strlen($fornecedor_cep) != 8) {
            $this->form_validation->set_message('check_cep', 'O campo CEP deve conter 8 números.');
            return false;
        }
        if (!is_numeric($fornecedor_cep)) {
            $this->form_validation->set_message('check_cep', 'O campo CEP deve conter apenas números.');
            return false;
        }

        return true;
    }
}