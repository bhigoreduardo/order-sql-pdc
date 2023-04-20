<?php

defined('BASEPATH') OR exit('Acesso não permitido.');

class Sistema extends CI_Controller {
    public function __construct() {
        parent::__construct();

        // Check loggedin
        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou, faça login novamente.');
            return redirect('login');
        }
    }

    public function index() {
        $this->form_validation->set_rules('sistema_razao_social', 'razão social', 'trim|required|min_length[3]|max_length[45]');
        $this->form_validation->set_rules('sistema_nome_fantasia', 'nome fantasia', 'trim|required|min_length[3]|max_length[45]');
        $this->form_validation->set_rules('sistema_cnpj', 'cnpj', 'trim|required|callback_check_cnpj');
        $this->form_validation->set_rules('sistema_ie', 'ie', 'trim|required');
        $this->form_validation->set_rules('sistema_celular', 'celular', 'trim|required|callback_check_celular');
        $this->form_validation->set_rules('sistema_email', 'email', 'trim|required|valid_email|max_length[60]');
        $this->form_validation->set_rules('sistema_site_url', 'site', 'trim|valid_url|max_length[60]');
        $this->form_validation->set_rules('sistema_cep', 'cep', 'trim|required|callback_check_cep');
        $this->form_validation->set_rules('sistema_endereco', 'endereço', 'trim|required|max_length[60]');
        $this->form_validation->set_rules('sistema_cidade', 'cidade', 'trim|required|max_length[40]');
        $this->form_validation->set_rules('sistema_estado', 'estado', 'trim|required|exact_length[2]');
        $this->form_validation->set_rules('sistema_numero', 'número', 'trim|max_length[10]');
        $this->form_validation->set_rules('sistema_txt_ordem_servico', 'descrição do sistema', 'trim|max_length[500]');

        if ($this->input->post('sistema_telefone')) {
            $this->form_validation->set_rules('sistema_telefone', 'telefone', 'trim|callback_check_telefone');
        }

        if ($this->form_validation->run()) {
            $data = elements(
                array(
                    'sistema_razao_social',
                    'sistema_nome_fantasia',
                    'sistema_cnpj',
                    'sistema_ie',
                    'sistema_telefone',
                    'sistema_celular',
                    'sistema_email',
                    'sistema_site_url',
                    'sistema_cep',
                    'sistema_endereco',
                    'sistema_cidade',
                    'sistema_estado',
                    'sistema_numero',
                    'sistema_txt_ordem_servico',
                ),
                $this->input->post()
            );
            // Clear data
            $data = html_escape($data);
            // Update
            $this->core_model->update('sistema', $data, array('sistema_id' => 1));

            return redirect('sistema');
        } 
        
        $data = array(
            'titulo' => 'Editar sistema',
            'scripts' => array(
                'vendor/mask/jquery.mask.min.js',
                'vendor/mask/app.js',
            ),
            'sistema' => $this->core_model->get_by_id('sistema', array('sistema_id' => 1)),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('sistema/index');
        $this->load->view('layout/footer');
    }

    public function check_cnpj($sistema_cnpj) {
        $sistema_id = 1;
        $sistema_cnpj = preg_replace("/[^0-9]/", "", $sistema_cnpj);
        $sistema_cnpj = str_pad($sistema_cnpj, 14, '0', STR_PAD_LEFT);

        if ($sistema_cnpj == '00000000000000' ||
            $sistema_cnpj == '11111111111111' ||
            $sistema_cnpj == '22222222222222' ||
            $sistema_cnpj == '33333333333333' ||
            $sistema_cnpj == '44444444444444' ||
            $sistema_cnpj == '55555555555555' ||
            $sistema_cnpj == '66666666666666' ||
            $sistema_cnpj == '77777777777777' ||
            $sistema_cnpj == '88888888888888' ||
            $sistema_cnpj == '99999999999999' ||
            empty($sistema_cnpj)) {
                $this->form_validation->set_message('check_cnpj', 'Digite um CNPJ válido.');
                return false;
        }
        if (strlen($sistema_cnpj) != 14) {
            $this->form_validation->set_message('check_cnpj', 'O campo CNPJ deve conter 14 números.');
            return false;
        }
        if (!is_numeric($sistema_cnpj)) {
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
            $soma2 = intval($soma2) + ($sistema_cnpj[$i] * $k);

            if ($i < 12) {
                $soma1 = intval($soma1) + ($sistema_cnpj[$i] * $j);
            }

            $k--;
            $j--;
        }

        $digito1 = $soma1 % 11 < 2 ? 0 : 11 - $soma1 % 11;
        $digito2 = $soma2 % 11 < 2 ? 0 : 11 - $soma2 % 11;

        if (!($sistema_cnpj[12] == $digito1) and ($sistema_cnpj[13] == $digito2)) {
            $this->form_validation->set_message('check_cnpj', 'Digite um CNPJ válido.');
            return false;
        }
        if ($sistema_id) {
            if ($this->core_model->get_by_id('sistema', array('sistema_id !=' => $sistema_id, 'sistema_cnpj' => $sistema_cnpj))) {
                $this->form_validation->set_message('check_cnpj', 'Documento já está em uso.');
                return false;
            }
        }

        return true;
    }

    public function check_telefone($sistema_telefone) {
        $sistema_id = 1;
        $sistema_telefone = remove_caracteres($sistema_telefone);

        if (strlen($sistema_telefone) != 10) {
            $this->form_validation->set_message('check_telefone', 'O campo telefone deve conter 10 números com ddd.');
            return false;
        }
        if (!is_numeric($sistema_telefone)) {
            $this->form_validation->set_message('check_telefone', 'O campo telefone deve conter apenas números.');
            return false;
        }
        if ($sistema_id) {
            if ($this->core_model->get_by_id('sistema', array('sistema_id !=' => $sistema_id, 'sistema_telefone' => $sistema_telefone))) {
                $this->form_validation->set_message('check_telefone', 'Telefone já está em uso.');
                return false;
            }
        }

        return true;
    }

    public function check_celular($sistema_celular) {
        $sistema_id = 1;
        $sistema_celular = remove_caracteres($sistema_celular);

        if (strlen($sistema_celular) != 11) {
            $this->form_validation->set_message('check_celular', 'O campo celular deve conter 11 números com ddd.');
            return false;
        }
        if (!is_numeric($sistema_celular)) {
            $this->form_validation->set_message('check_celular', 'O campo celular deve conter apenas números.');
            return false;
        }
        if ($sistema_id) {
            if ($this->core_model->get_by_id('sistema', array('sistema_id !=' => $sistema_id, 'sistema_celular' => $sistema_celular))) {
                $this->form_validation->set_message('check_celular', 'Celular já está em uso.');
                return false;
            }
        }

        return true;
    }

    public function check_cep($sistema_cep) {
        $sistema_cep = remove_caracteres($sistema_cep);

        if (strlen($sistema_cep) != 8) {
            $this->form_validation->set_message('check_cep', 'O campo CEP deve conter 8 números.');
            return false;
        }
        if (!is_numeric($sistema_cep)) {
            $this->form_validation->set_message('check_cep', 'O campo CEP deve conter apenas números.');
            return false;
        }

        return true;
    }
}