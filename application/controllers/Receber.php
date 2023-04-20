<?php

defined('BASEPATH') OR exit('Acesso não permitido.');

class Receber extends CI_Controller {
    public function __construct() {
        parent::__construct();

        // Check loggedin
        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou, faça login novamente.');
            return redirect('login');
        }

        $this->load->model('financeiro_model');
    }

    public function index() {
        $data = array(
            'titulo' => 'Contas à receber cadastradas',
            'styles' => array(
                'vendor/datatables/dataTables.bootstrap4.min.css',
            ),
            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js',
            ),
            'contas_receber' => $this->financeiro_model->get_all_receber(),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('receber/index');
        $this->load->view('layout/footer');
    }

    public function edit($conta_receber_id = null) {
        if (!$conta_receber_id || !$this->core_model->get_by_id('contas_receber', array('conta_receber_id' => $conta_receber_id))) {
            $this->session->set_flashdata('error', 'Conta à receber não cadastrada.');
            return redirect('receber');
        }

        // conta_receber_id
        // conta_receber_data_cadastro
        $this->form_validation->set_rules('conta_receber_cliente_id', 'cliente', 'trim|required');
        $this->form_validation->set_rules('conta_receber_data_vencimento', 'data vencimento', 'trim|required');
        // conta_receber_data_pagamento
        $this->form_validation->set_rules('conta_receber_valor', 'valor', 'trim|required');
        // conta_receber_status
        $this->form_validation->set_rules('conta_receber_obs', 'observação', 'trim|max_length[500]');
        // conta_receber_data_alteracao

        if ($this->form_validation->run()) {
            $data = elements(
                array(
                    // 'conta_receber_id',
                    // 'conta_receber_data_cadastro',
                    'conta_receber_cliente_id',
                    'conta_receber_data_vencimento',
                    // 'conta_receber_data_pagamento',
                    'conta_receber_valor',
                    'conta_receber_status',
                    'conta_receber_obs',
                    // 'conta_receber_data_alteracao',
                ), $this->input->post(),
            );
            if ($this->input->post('conta_receber_status') == 1) {
                $data['conta_receber_data_pagamento'] = date('Y-m-d H:i:s');
            }
            // Clear
            $data = html_escape($data);
            // Inser
            $this->core_model->update('contas_receber', $data, array('conta_receber_id' => $conta_receber_id));

            redirect('receber');
        }

        $data = array(
            'titulo' => 'Editar conta à receber',
            'styles' => array(
                'vendor/select2/select2.min.css',
            ),
            'scripts' => array(
                'vendor/select2/select2.min.js',
                'vendor/select2/app.js',
                'vendor/mask/jquery.mask.min.js',
                'vendor/mask/app.js',
            ),
            'conta_receber' => $this->core_model->get_by_id('contas_receber', array('conta_receber_id' => $conta_receber_id)),
            'clientes' => $this->core_model->get_all('clientes', array('cliente_ativo' => 1)),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('receber/edit');
        $this->load->view('layout/footer');
    }

    public function add() {
        // conta_receber_id
        // conta_receber_data_cadastro
        $this->form_validation->set_rules('conta_receber_cliente_id', 'cliente', 'trim|required');
        $this->form_validation->set_rules('conta_receber_data_vencimento', 'data vencimento', 'trim|required');
        // conta_receber_data_pagamento
        $this->form_validation->set_rules('conta_receber_valor', 'valor', 'trim|required');
        // conta_receber_status
        $this->form_validation->set_rules('conta_receber_obs', 'observação', 'trim|max_length[500]');
        // conta_receber_data_alteracao

        if ($this->form_validation->run()) {
            $data = elements(
                array(
                    // 'conta_receber_id',
                    // 'conta_receber_data_cadastro',
                    'conta_receber_cliente_id',
                    'conta_receber_data_vencimento',
                    // 'conta_receber_data_pagamento',
                    'conta_receber_valor',
                    'conta_receber_status',
                    'conta_receber_obs',
                    // 'conta_receber_data_alteracao',
                ), $this->input->post(),
            );
            if ($this->input->post('conta_receber_status') == 1) {
                $data['conta_receber_data_pagamento'] = date('Y-m-d H:i:s');
            }
            // Clear
            $data = html_escape($data);
            // Inser
            $this->core_model->insert('contas_receber', $data);

            redirect('receber');
        }

        $data = array(
            'titulo' => 'Cadastrar conta à receber',
            'styles' => array(
                'vendor/select2/select2.min.css',
            ),
            'scripts' => array(
                'vendor/select2/select2.min.js',
                'vendor/select2/app.js',
                'vendor/mask/jquery.mask.min.js',
                'vendor/mask/app.js',
            ),
            'clientes' => $this->core_model->get_all('clientes', array('cliente_ativo' => 1)),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('receber/add');
        $this->load->view('layout/footer');
    }

    public function del($conta_receber_id = null) {
        if (!$conta_receber_id || !$this->core_model->get_by_id('contas_receber', array('conta_receber_id' => $conta_receber_id))) {
            $this->session->set_flashdata('error', 'Conta à receber não cadastrada.');
            return redirect('receber');
        }

        if ($this->core_model->get_by_id('contas_receber', array('conta_receber_id' => $conta_receber_id, 'conta_receber_status !=' => 1))) {
            $this->session->set_flashdata('info', 'Conta à receber pendente.');
            return redirect('receber');
        }

        if (!$this->ion_auth->is_admin()) {
            $this->session->set_flashdata('info', 'Perfil não tem permissão para excluir registro.');
            return redirect('receber');
        } else {
            if ($this->core_model->delete('contas_receber', array('conta_receber_id' => $conta_receber_id))) {
                $this->session->set_flashdata('success', 'Registro excluído com sucesso.');
            }
            
            return redirect('receber');
        }

        $this->session->set_flashdata('error', 'Falha na tentativa de excluir o registro.');
        return redirect('receber');
    }
}