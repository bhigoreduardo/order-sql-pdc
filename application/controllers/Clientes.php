<?php

defined('BASEPATH') OR exit('Acesso não permitido.');

class Clientes extends CI_Controller {
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
            'titulo' => 'Clientes cadastrados',
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
            'clientes' => $this->core_model->get_all('clientes'),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('clientes/index');
        $this->load->view('layout/footer');
    }

    public function edit($cliente_id = null) {
        if (!$cliente_id || !$this->core_model->get_by_id('clientes', array('cliente_id' => $cliente_id))) {
            $this->session->set_flashdata('error', 'Cliente não cadastrado.');
            return redirect('clientes');
        }
        
        // cliente_id
        // cliente_data_cadastro
        // cliente_tipo
        // cliente_nome_razao
        // cliente_sobrenome_fantasia
        // cliente_data_nascimento
        // cliente_cpf_cnpj
        // cliente_rg_ie
        $this->form_validation->set_rules('cliente_email', 'email', 'trim|required|valid_email|max_length[50]|callback_check_email');
        // cliente_telefone
        $this->form_validation->set_rules('cliente_celular', 'celular', 'trim|required|callback_check_celular');
        $this->form_validation->set_rules('cliente_cep', 'cep', 'trim|required|callback_check_cep');
        $this->form_validation->set_rules('cliente_endereco', 'endereço', 'trim|required|max_length[155]');
        $this->form_validation->set_rules('cliente_numero_endereco', 'número', 'trim|max_length[20]');
        $this->form_validation->set_rules('cliente_bairro', 'bairro', 'trim|required|max_length[45]');
        $this->form_validation->set_rules('cliente_complemento', 'complemento', 'trim|max_length[145]');
        $this->form_validation->set_rules('cliente_cidade', 'cidade', 'trim|required|max_length[105]');
        $this->form_validation->set_rules('cliente_estado', 'estado', 'trim|required|exact_length[2]');
        // cliente_ativo
        $this->form_validation->set_rules('cliente_obs', 'observação', 'trim|max_length[500]');
        // cliente_data_alteracao

        if ($this->input->post('cliente_telefone')) {
            $this->form_validation->set_rules('cliente_telefone', 'telefone', 'trim|callback_check_telefone');
        }
        if ($this->input->post('cliente_tipo') == 1) {
            $this->form_validation->set_rules('cliente_nome', 'nome', 'trim|required|min_length[3]|max_length[45]');
            $this->form_validation->set_rules('cliente_sobrenome', 'sobrenome', 'trim|required|min_length[3]|max_length[45]');
            $this->form_validation->set_rules('cliente_data_nascimento', 'data nascimento', 'trim|required');
            $this->form_validation->set_rules('cliente_cpf', 'CPF', 'trim|required|callback_check_cpf');
            $this->form_validation->set_rules('cliente_rg', 'RG', 'trim|required|callback_check_rg_ie');
        } else {
            $this->form_validation->set_rules('cliente_razao', 'razão social', 'trim|required|min_length[3]|max_length[45]');
            $this->form_validation->set_rules('cliente_fantasia', 'nome fantasia', 'trim|required|min_length[3]|max_length[45]');
            $this->form_validation->set_rules('cliente_cnpj', 'CNPJ', 'trim|required|callback_check_cnpj');
            $this->form_validation->set_rules('cliente_ie', 'IE', 'trim|required|callback_check_rg_ie');
        }

        if ($this->form_validation->run()) {
            $data = elements(
                array(
                    // 'cliente_id',
                    // 'cliente_data_cadastro',
                    'cliente_tipo',
                    // 'cliente_nome_razao',
                    // 'cliente_sobrenome_fantasia',
                    // 'cliente_data_nascimento',
                    // 'cliente_cpf_cnpj',
                    // 'cliente_rg_ie',
                    'cliente_email',
                    'cliente_telefone',
                    'cliente_celular',
                    'cliente_cep',
                    'cliente_endereco',
                    'cliente_numero_endereco',
                    'cliente_bairro',
                    'cliente_complemento',
                    'cliente_cidade',
                    // 'cliente_estado',
                    'cliente_ativo',
                    'cliente_obs',
                    // 'cliente_data_alteracao',
                ),
                $this->input->post()
            );
            $data['cliente_estado'] = strtoupper($this->input->post('cliente_estado'));
            if ($this->input->post('cliente_tipo') == 1) {
                $data['cliente_nome_razao'] = $this->input->post('cliente_nome');
                $data['cliente_sobrenome_fantasia'] = $this->input->post('cliente_sobrenome');
                $data['cliente_cpf_cnpj'] = $this->input->post('cliente_cpf');
                $data['cliente_rg_ie'] = $this->input->post('cliente_rg');
                $data['cliente_data_nascimento'] = $this->input->post('cliente_data_nascimento');
            } else {
                $data['cliente_nome_razao'] = $this->input->post('cliente_razao');
                $data['cliente_sobrenome_fantasia'] = $this->input->post('cliente_fantasia');
                $data['cliente_cpf_cnpj'] = $this->input->post('cliente_cnpj');
                $data['cliente_rg_ie'] = $this->input->post('cliente_ie');
            }
            // Clear data
            $data = html_escape($data);
            // Insert
            $this->core_model->update('clientes', $data, array('cliente_id' => $cliente_id));

            return redirect('clientes');
        }

        $data = array(
            'titulo' => 'Editar cliente',
            'scripts' => array(
                'vendor/mask/jquery.mask.min.js',
                'vendor/mask/app.js',
            ),
            'cliente' => $this->core_model->get_by_id('clientes', array('cliente_id' => $cliente_id)),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('clientes/edit');
        $this->load->view('layout/footer');
    }

    public function add() {
        // cliente_id
        // cliente_data_cadastro
        // cliente_tipo
        // cliente_nome_razao
        // cliente_sobrenome
        // cliente_data_nascimento
        // cliente_cpf_cnpj
        // cliente_rg_ie
        $this->form_validation->set_rules('cliente_email', 'email', 'trim|required|valid_email|max_length[60]|is_unique[clientes.cliente_email]');
        // cliente_telefone
        $this->form_validation->set_rules('cliente_celular', 'celular', 'trim|required|is_unique[clientes.cliente_celular]');
        $this->form_validation->set_rules('cliente_cep', 'cep', 'trim|required|callback_check_cep');
        $this->form_validation->set_rules('cliente_endereco', 'endereço', 'trim|required|max_length[60]');
        $this->form_validation->set_rules('cliente_numero_endereco', 'número', 'trim|numeric|max_length[10]');
        $this->form_validation->set_rules('cliente_bairro', 'bairro', 'trim|required|max_length[40]');
        $this->form_validation->set_rules('cliente_complemento', 'complemento', 'trim|max_length[40]');
        $this->form_validation->set_rules('cliente_cidade', 'cidade', 'trim|required|max_length[40]');
        $this->form_validation->set_rules('cliente_estado', 'estado', 'trim|required|exact_length[2]');
        // cliente_ativo
        $this->form_validation->set_rules('cliente_obs', 'observação', 'trim|max_length[500]');
        // cliente_data_alteracao

        if ($this->input->post('cliente_telefone')) {
            $this->form_validation->set_rules('cliente_telefone', 'telefone', 'trim|is_unique[clientes.cliente_telefone]');
        }
        if ($this->input->post('cliente_tipo') == 1) {
            $this->form_validation->set_rules('cliente_nome', 'nome', 'trim|required|min_length[3]|max_length[45]');
            $this->form_validation->set_rules('cliente_sobrenome', 'sobrenome', 'trim|required|min_length[3]|max_length[45]');
            $this->form_validation->set_rules('cliente_data_nascimento', 'data nascimento', 'trim|required');
            $this->form_validation->set_rules('cliente_cpf', 'CPF', 'trim|required|is_unique[clientes.cliente_cpf_cnpj]|callback_check_cpf');
            $this->form_validation->set_rules('cliente_rg', 'RG', 'trim|required|is_unique[clientes.cliente_rg_ie]');
        } else {
            $this->form_validation->set_rules('cliente_razao', 'razão social', 'trim|required|min_length[3]|max_length[45]');
            $this->form_validation->set_rules('cliente_fantasia', 'nome fantasia', 'trim|required|min_length[3]|max_length[45]');
            $this->form_validation->set_rules('cliente_cnpj', 'CNPJ', 'trim|required|is_unique[clientes.cliente_cpf_cnpj]|callback_check_cnpj');
            $this->form_validation->set_rules('cliente_ie', 'IE', 'trim|required|is_unique[clientes.cliente_rg_ie]');
        }

        if ($this->form_validation->run()) {
            $data = elements(
                array(
                    // 'cliente_id',
                    // 'cliente_data_cadastro',
                    'cliente_tipo',
                    // 'cliente_nome_razao',
                    // 'cliente_sobrenome_fantasia',
                    // 'cliente_data_nascimento',
                    // 'cliente_cpf_cnpj',
                    // 'cliente_rg_ie',
                    'cliente_email',
                    'cliente_telefone',
                    'cliente_celular',
                    'cliente_cep',
                    'cliente_endereco',
                    'cliente_numero_endereco',
                    'cliente_bairro',
                    'cliente_complemento',
                    'cliente_cidade',
                    // 'cliente_estado',
                    'cliente_ativo',
                    'cliente_obs',
                    // 'cliente_data_alteracao',
                ),
                $this->input->post()
            );
            $data['cliente_estado'] = strtoupper($this->input->post('cliente_estado'));
            if ($this->input->post('cliente_tipo') == 1) {
                $data['cliente_nome_razao'] = $this->input->post('cliente_nome');
                $data['cliente_sobrenome_fantasia'] = $this->input->post('cliente_sobrenome');
                $data['cliente_cpf_cnpj'] = $this->input->post('cliente_cpf');
                $data['cliente_rg_ie'] = $this->input->post('cliente_rg');
                $data['cliente_data_nascimento'] = $this->input->post('cliente_data_nascimento');
            } else {
                $data['cliente_nome_razao'] = $this->input->post('cliente_razao');
                $data['cliente_sobrenome_fantasia'] = $this->input->post('cliente_fantasia');
                $data['cliente_cpf_cnpj'] = $this->input->post('cliente_cnpj');
                $data['cliente_rg_ie'] = $this->input->post('cliente_ie');
            }
            // Clear data
            $data = html_escape($data);
            // Insert
            $this->core_model->insert('clientes', $data);

            return redirect('clientes');
        }

        $data = array(
            'titulo' => 'Cadastrar cliente',
            'scripts' => array(
                'vendor/mask/jquery.mask.min.js',
                'vendor/mask/app.js',
                'js/clientes.js'
            ),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('clientes/add');
        $this->load->view('layout/footer');
    }

    public function del($cliente_id = null) {
        if (!$cliente_id || !$this->core_model->get_by_id('clientes', array('cliente_id' => $cliente_id))) {
            $this->session->set_flashdata('error', 'Clente não cadastrado.');
            return redirect('clientes');
        }

        if (!$this->ion_auth->is_admin()) {
            $this->session->set_flashdata('info', 'Perfil não tem permissão para excluir registro.');
            return redirect('clientes');
        } else {
            if ($this->core_model->delete('clientes', array('cliente_id' => $cliente_id))) {
                $this->session->set_flashdata('success', 'Registro excluído com sucesso.');
                return redirect('clientes');
            }
            
            return redirect('clientes');
        }

        $this->session->set_flashdata('error', 'Falha na tentativa de excluir o registro.');
        return redirect('clientes');
    }

    public function check_cpf($cliente_cpf) {
        $cliente_id = $this->input->post('cliente_id');
        $cliente_cpf = preg_replace("/[^0-9]/", "", $cliente_cpf);
        $cliente_cpf = str_pad($cliente_cpf, 11, '0', STR_PAD_LEFT);
        // $cliente_cpf = remove_caracteres($cliente_cpf);

        if ($cliente_cpf == '00000000000' ||
            $cliente_cpf == '11111111111' ||
            $cliente_cpf == '22222222222' ||
            $cliente_cpf == '33333333333' ||
            $cliente_cpf == '44444444444' ||
            $cliente_cpf == '55555555555' ||
            $cliente_cpf == '66666666666' ||
            $cliente_cpf == '77777777777' ||
            $cliente_cpf == '88888888888' ||
            $cliente_cpf == '99999999999') {
            $this->form_validation->set_message('check_cpf', 'Digite um CPF válido.');
            return false;
        }
        if (strlen($cliente_cpf) != 11) {
            $this->form_validation->set_message('check_cpf', 'O campo CPF deve conter 11 números.');
            return false;
        }
        if (!is_numeric($cliente_cpf)) {
            $this->form_validation->set_message('check_cpf', 'O campo CPF deve conter apenas números.');
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            $d = 0;
            for ($c = 0; $c < $t; $c++) {
                $d += $cliente_cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;

            if ($cliente_cpf[$c] != $d) {
                $this->form_validation->set_message('check_cpf', 'Digite um CPF válido.');
                return false;
            }
        }

        if ($cliente_id) {
            if ($this->core_model->get_by_id('clientes', array('cliente_id !=' => $cliente_id, 'cliente_cpf_cnpj' => $cliente_cpf))) {
                $this->form_validation->set_message('check_cpf', 'Documento já está em uso.');
                return false;
            }
        }

        return true;
    }

    public function check_cnpj($cliente_cnpj) {
        $cliente_id = $this->input->post('cliente_id');
        $cliente_cnpj = preg_replace("/[^0-9]/", "", $cliente_cnpj);
        $cliente_cnpj = str_pad($cliente_cnpj, 14, '0', STR_PAD_LEFT);
        // $cliente_cnpj = remove_caracteres($cliente_cnpj);

        if ($cliente_cnpj == '00000000000000' ||
            $cliente_cnpj == '11111111111111' ||
            $cliente_cnpj == '22222222222222' ||
            $cliente_cnpj == '33333333333333' ||
            $cliente_cnpj == '44444444444444' ||
            $cliente_cnpj == '55555555555555' ||
            $cliente_cnpj == '66666666666666' ||
            $cliente_cnpj == '77777777777777' ||
            $cliente_cnpj == '88888888888888' ||
            $cliente_cnpj == '99999999999999' ||
            empty($cliente_cnpj)) {
                $this->form_validation->set_message('check_cnpj', 'Digite um CNPJ válido.');
                return false;
        }
        if (strlen($cliente_cnpj) != 14) {
            $this->form_validation->set_message('check_cnpj', 'O campo CNPJ deve conter 14 números.');
            return false;
        }
        if (!is_numeric($cliente_cnpj)) {
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
            $soma2 = intval($soma2) + ($cliente_cnpj[$i] * $k);

            if ($i < 12) {
                $soma1 = intval($soma1) + ($cliente_cnpj[$i] * $j);
            }

            $k--;
            $j--;
        }

        $digito1 = $soma1 % 11 < 2 ? 0 : 11 - $soma1 % 11;
        $digito2 = $soma2 % 11 < 2 ? 0 : 11 - $soma2 % 11;

        if (!($cliente_cnpj[12] == $digito1) and ($cliente_cnpj[13] == $digito2)) {
            $this->form_validation->set_message('check_cnpj', 'Digite um CNPJ válido.');
            return false;
        }
        if ($cliente_id) {
            if ($this->core_model->get_by_id('clientes', array('cliente_id !=' => $cliente_id, 'cliente_cpf_cnpj' => $cliente_cnpj))) {
                $this->form_validation->set_message('check_cnpj', 'Documento já está em uso.');
                return false;
            }
        }

        return true;
    }

    public function check_rg_ie($cliente_rg_ie) {
        $cliente_id = $this->input->post('cliente_id');

        if ($this->core_model->get_by_id('clientes', array('cliente_id !=' => $cliente_id, 'cliente_rg_ie' => $cliente_rg_ie))) {
            $this->form_validation->set_message('check_rg_ie', 'Documento já está em uso.');
            return false;
        }

        return true;
    }

    public function check_email($cliente_email) {
        $cliente_id = $this->input->post('cliente_id');

        if ($this->core_model->get_by_id('clientes', array('cliente_id !=' => $cliente_id, 'cliente_email' => $cliente_email))) {
            $this->form_validation->set_message('email_check', 'Email já está em uso.');
            return false;
        }

        return true;
    }

    public function check_telefone($cliente_telefone) {
        $cliente_id = $this->input->post('cliente_id');
        $cliente_telefone = remove_caracteres($cliente_telefone);

        if (strlen($cliente_telefone) != 10) {
            $this->form_validation->set_message('check_telefone', 'O campo telefone deve conter 10 números com ddd.');
            return false;
        }
        if (!is_numeric($cliente_telefone)) {
            $this->form_validation->set_message('check_telefone', 'O campo telefone deve conter apenas números.');
            return false;
        }
        if ($cliente_id) {
            if ($this->core_model->get_by_id('clientes', array('cliente_id !=' => $cliente_id, 'cliente_telefone' => $cliente_telefone))) {
                $this->form_validation->set_message('check_telefone', 'Telefone já está em uso.');
                return false;
            }
        }

        return true;
    }

    public function check_celular($cliente_celular) {
        $cliente_id = $this->input->post('cliente_id');
        $cliente_celular = remove_caracteres($cliente_celular);

        if (strlen($cliente_celular) != 11) {
            $this->form_validation->set_message('check_celular', 'O campo celular deve conter 11 números com ddd.');
            return false;
        }
        if (!is_numeric($cliente_celular)) {
            $this->form_validation->set_message('check_celular', 'O campo celular deve conter apenas números.');
            return false;
        }
        if ($cliente_id) {
            if ($this->core_model->get_by_id('clientes', array('cliente_id !=' => $cliente_id, 'cliente_celular' => $cliente_celular))) {
                $this->form_validation->set_message('check_celular', 'Celular já está em uso.');
                return false;
            }
        }

        return true;
    }

    public function check_cep($cliente_cep) {
        $cliente_cep = remove_caracteres($cliente_cep);

        if (strlen($cliente_cep) != 8) {
            $this->form_validation->set_message('check_cep', 'O campo CEP deve conter 8 números.');
            return false;
        }
        if (!is_numeric($cliente_cep)) {
            $this->form_validation->set_message('check_cep', 'O campo CEP deve conter apenas números.');
            return false;
        }

        return true;
    }
}