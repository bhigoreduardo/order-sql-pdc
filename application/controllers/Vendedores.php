<?php

defined('BASEPATH') OR exit('Acesso não permitido.');

class Vendedores extends CI_Controller {
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
            'titulo' => 'Vendedores cadastrados',
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
            'vendedores' => $this->core_model->get_all('vendedores'),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('vendedores/index');
        $this->load->view('layout/footer');
    }

    public function edit($vendedor_id = null) {
        if (!$vendedor_id || !$this->core_model->get_by_id('vendedores', array('vendedor_id' => $vendedor_id))) {
            $this->session->set_flashdata('error', 'Vendedor não cadastrado.');
            return redirect('vendedores');
        }

        // vendedor_id
        // vendedor_codigo
        // vendedor_data_cadastro
        $this->form_validation->set_rules('vendedor_nome_completo', 'nome completo', 'trim|required|min_length[10]|max_length[145]');
        $this->form_validation->set_rules('vendedor_cpf', 'CPF', 'trim|required|callback_check_cpf');
        $this->form_validation->set_rules('vendedor_rg', 'RG', 'trim|required|callback_check_rg');
        // vendedor_telefone
        $this->form_validation->set_rules('vendedor_celular', 'celular', 'trim|required|callback_check_celular');
        $this->form_validation->set_rules('vendedor_email', 'email', 'trim|required|valid_email|max_length[45]|callback_check_email');
        $this->form_validation->set_rules('vendedor_cep', 'cep', 'trim|required|callback_check_cep');
        $this->form_validation->set_rules('vendedor_endereco', 'endereço', 'trim|required|max_length[45]');
        $this->form_validation->set_rules('vendedor_numero_endereco', 'número', 'trim|max_length[22]');
        $this->form_validation->set_rules('vendedor_complemento', 'complemento', 'trim|max_length[45]');
        $this->form_validation->set_rules('vendedor_bairro', 'bairro', 'trim|required|max_length[45]');
        $this->form_validation->set_rules('vendedor_cidade', 'cidade', 'trim|required|max_length[45]');
        $this->form_validation->set_rules('vendedor_estado', 'estado', 'trim|required|exact_length[2]');
        // vendedor_ativo
        $this->form_validation->set_rules('vendedor_obs', 'observação', 'trim|max_length[500]');
        // vendedor_data_alteracao

        if ($this->input->post('vendedor_telefone')) {
            $this->form_validation->set_rules('vendedor_telefone', 'telefone', 'trim|callback_check_telefone');
        }

        if ($this->form_validation->run()) {
            $data = elements(
                array(
                    // 'vendedor_id',
                    // 'vendedor_codigo',
                    // 'vendedor_data_cadastro',
                    'vendedor_nome_completo',
                    'vendedor_cpf',
                    'vendedor_rg',
                    'vendedor_telefone',
                    'vendedor_celular',
                    'vendedor_email',
                    'vendedor_cep',
                    'vendedor_endereco',
                    'vendedor_numero_endereco',
                    'vendedor_complemento',
                    'vendedor_bairro',
                    'vendedor_cidade',
                    // 'vendedor_estado',
                    'vendedor_ativo',
                    'vendedor_obs',
                    // 'vendedor_data_alteracao',
                ),
                $this->input->post()
            );
            $data['vendedor_estado'] = strtoupper($this->input->post('vendedor_estado'));
            // Clear data
            $data = html_escape($data);
            // Insert
            $this->core_model->update('vendedores', $data, array('vendedor_id' => $vendedor_id));

            return redirect('vendedores');
        }

        $data = array(
            'titulo' => 'Editar vendedor',
            'scripts' => array(
                'vendor/mask/jquery.mask.min.js',
                'vendor/mask/app.js',
            ),
            'vendedor' => $this->core_model->get_by_id('vendedores', array('vendedor_id' => $vendedor_id)),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('vendedores/edit');
        $this->load->view('layout/footer');

    }

    public function add() {
        // vendedor_id
        // vendedor_codigo
        // vendedor_data_cadastro
        $this->form_validation->set_rules('vendedor_nome_completo', 'nome completo', 'trim|required|min_length[10]|max_length[145]');
        $this->form_validation->set_rules('vendedor_cpf', 'CPF', 'trim|required|is_unique[vendedores.vendedor_cpf]|callback_check_cpf');
        $this->form_validation->set_rules('vendedor_rg', 'RG', 'trim|required|is_unique[vendedores.vendedor_rg]');
        // vendedor_telefone
        $this->form_validation->set_rules('vendedor_celular', 'celular', 'trim|required|is_unique[vendedores.vendedor_celular]|callback_check_celular');
        $this->form_validation->set_rules('vendedor_email', 'email', 'trim|required|valid_email|max_length[45]|is_unique[vendedores.vendedor_email]');
        $this->form_validation->set_rules('vendedor_cep', 'cep', 'trim|required|callback_check_cep');
        $this->form_validation->set_rules('vendedor_endereco', 'endereço', 'trim|required|max_length[45]');
        $this->form_validation->set_rules('vendedor_numero_endereco', 'número', 'trim|max_length[22]');
        $this->form_validation->set_rules('vendedor_complemento', 'complemento', 'trim|max_length[45]');
        $this->form_validation->set_rules('vendedor_bairro', 'bairro', 'trim|required|max_length[45]');
        $this->form_validation->set_rules('vendedor_cidade', 'cidade', 'trim|required|max_length[45]');
        $this->form_validation->set_rules('vendedor_estado', 'estado', 'trim|required|exact_length[2]');
        // vendedor_ativo
        $this->form_validation->set_rules('vendedor_obs', 'observação', 'trim|max_length[500]');
        // vendedor_data_alteracao

        if ($this->input->post('vendedor_telefone')) {
            $this->form_validation->set_rules('vendedor_telefone', 'telefone', 'trim|is_unique[vendedores.vendedor_telefone]|callback_check_telefone');
        }

        if ($this->form_validation->run()) {
            $data = elements(
                array(
                    // 'vendedor_id',
                    // 'vendedor_codigo',
                    // 'vendedor_data_cadastro',
                    'vendedor_nome_completo',
                    'vendedor_cpf',
                    'vendedor_rg',
                    'vendedor_telefone',
                    'vendedor_celular',
                    'vendedor_email',
                    'vendedor_cep',
                    'vendedor_endereco',
                    'vendedor_numero_endereco',
                    'vendedor_complemento',
                    'vendedor_bairro',
                    'vendedor_cidade',
                    // 'vendedor_estado',
                    'vendedor_ativo',
                    'vendedor_obs',
                    // 'vendedor_data_alteracao',
                ), $this->input->post(),
            );
            // Generate code
            $data['vendedor_codigo'] = $this->core_model->generate_unique_code('vendedores', 'numeric', 8, 'vendedor_codigo');
            $data['vendedor_estado'] = strtoupper($this->input->post('vendedor_estado'));
            // Clear data
            $data = html_escape($data);
            // Insert
            $this->core_model->insert('vendedores', $data);

            return redirect('vendedores');
        }

        $data = array(
            'titulo' => 'Cadastrar vendedor',
            'scripts' => array(
                'vendor/mask/jquery.mask.min.js',
                'vendor/mask/app.js'
            ),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('vendedores/add');
        $this->load->view('layout/footer');
    }

    public function del($vendedor_id = null) {
        if (!$vendedor_id || !$this->core_model->get_by_id('vendedores', array('vendedor_id' => $vendedor_id))) {
            $this->session->set_flashdata('error', 'Vendedor não cadastrado.');
            return redirect('vendedores');
        }

        if (!$this->ion_auth->is_admin()) {
            $this->session->set_flashdata('info', 'Perfil não tem permissão para excluir registro.');
            return redirect('vendedores');
        } else {
            if ($this->core_model->delete('vendedores', array('vendedor_id' => $vendedor_id))) {
                $this->session->set_flashdata('success', 'Registro excluído com sucesso.');
            }

            return redirect('vendedores');
        }

        $this->session->set_flashdata('error', 'Falha na tentativa de excluir o registro.');
        return redirect('vendedores');
    }

    public function check_cpf($vendedor_cpf) {
        $vendedor_id = $this->input->post('vendedor_id');
        $vendedor_cpf = preg_replace("/[^0-9]/", "", $vendedor_cpf);
        $vendedor_cpf = str_pad($vendedor_cpf, 11, '0', STR_PAD_LEFT);

        if ($vendedor_cpf == '00000000000' ||
            $vendedor_cpf == '11111111111' ||
            $vendedor_cpf == '22222222222' ||
            $vendedor_cpf == '33333333333' ||
            $vendedor_cpf == '44444444444' ||
            $vendedor_cpf == '55555555555' ||
            $vendedor_cpf == '66666666666' ||
            $vendedor_cpf == '77777777777' ||
            $vendedor_cpf == '88888888888' ||
            $vendedor_cpf == '99999999999') {
            $this->form_validation->set_message('check_cpf', 'Digite um CPF válido.');
            return false;
        }
        if (strlen($vendedor_cpf) != 11) {
            $this->form_validation->set_message('check_cpf', 'O campo CPF deve conter 11 números.');
            return false;
        }
        if (!is_numeric($vendedor_cpf)) {
            $this->form_validation->set_message('check_cpf', 'O campo CPF deve conter apenas números.');
            return false;
        }

        for ($t = 9; $t < 11; $t++) {
            $d = 0;
            for ($c = 0; $c < $t; $c++) {
                $d += $vendedor_cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;

            if ($vendedor_cpf[$c] != $d) {
                $this->form_validation->set_message('check_cpf', 'Digite um CPF válido.');
                return false;
            }
        }

        if ($vendedor_id) {
            if ($this->core_model->get_by_id('vendedores', array('vendedor_id !=' => $vendedor_id, 'vendedor_cpf' => $vendedor_cpf))) {
                $this->form_validation->set_message('check_cpf', 'Documento já está em uso.');
                return false;
            }
        }

        return true;
    }

    public function check_rg($vendedor_rg) {
        $vendedor_id = $this->input->post('vendedor_id');

        if ($this->core_model->get_by_id('vendedores', array('vendedor_id !=' => $vendedor_id, 'vendedor_rg' => $vendedor_rg))) {
            $this->form_validation->set_message('check_rg', 'Documento já está em uso.');
            return false;
        }

        return true;
    }

    public function check_telefone($vendedor_telefone) {
        $vendedor_id = $this->input->post('vendedor_id');
        $vendedor_telefone = remove_caracteres($vendedor_telefone);

        if (strlen($vendedor_telefone) != 10) {
            $this->form_validation->set_message('check_telefone', 'O campo telefone deve conter 10 números com ddd.');
            return false;
        }
        if (!is_numeric($vendedor_telefone)) {
            $this->form_validation->set_message('check_telefone', 'O campo telefone deve conter apenas números.');
            return false;
        }
        if ($vendedor_id) {
            if ($this->core_model->get_by_id('vendedores', array('vendedor_id !=' => $vendedor_id, 'vendedor_telefone' => $vendedor_telefone))) {
                $this->form_validation->set_message('check_telefone', 'Telefone já está em uso.');
                return false;
            }
        }

        return true;
    }

    public function check_celular($vendedor_celular) {
        $vendedor_id = $this->input->post('vendedor_id');
        $vendedor_celular = remove_caracteres($vendedor_celular);

        if (strlen($vendedor_celular) != 11) {
            $this->form_validation->set_message('check_celular', 'O campo celular deve conter 11 números com ddd.');
            return false;
        }
        if (!is_numeric($vendedor_celular)) {
            $this->form_validation->set_message('check_celular', 'O campo celular deve conter apenas números.');
            return false;
        }
        if ($vendedor_id) {
            if ($this->core_model->get_by_id('vendedores', array('vendedor_id !=' => $vendedor_id, 'vendedor_celular' => $vendedor_celular))) {
                $this->form_validation->set_message('check_celular', 'Celular já está em uso.');
                return false;
            }
        }

        return true;
    }

    public function check_email($vendedor_email) {
        $vendedor_id = $this->input->post('vendedor_id');

        if ($this->core_model->get_by_id('vendedores', array('vendedor_id !=' => $vendedor_id, 'vendedor_email' => $vendedor_email))) {
            $this->form_validation->set_message('email_check', 'Email já está em uso.');
            return false;
        }

        return true;
    }

    public function check_cep($vendedor_cep) {
        $vendedor_cep = remove_caracteres($vendedor_cep);

        if (strlen($vendedor_cep) != 8) {
            $this->form_validation->set_message('check_cep', 'O campo CEP deve conter 8 números.');
            return false;
        }
        if (!is_numeric($vendedor_cep)) {
            $this->form_validation->set_message('check_cep', 'O campo CEP deve conter apenas números.');
            return false;
        }

        return true;
    }
}