<?php

defined('BASEPATH') OR exit('Acesso não permitido.');

class Pagar extends CI_Controller {
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
            'titulo' => 'Contas à pagar cadastradas',
            'styles' => array(
                'vendor/datatables/dataTables.bootstrap4.min.css',
            ),
            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js',
            ),
            'contas_pagar' => $this->financeiro_model->get_all_pagar(),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('pagar/index');
        $this->load->view('layout/footer');
    }

    public function edit($conta_pagar_id = null) {
        if (!$conta_pagar_id || !$this->core_model->get_by_id('contas_pagar', array('conta_pagar_id' => $conta_pagar_id))) {
            $this->session->set_flashdata('error', 'Conta à pagar não cadastrada.');
            return redirect('pagar');
        }

        // conta_pagar_id
        // conta_pagar_data_cadastro
        $this->form_validation->set_rules('conta_pagar_fornecedor_id', 'fornecedor', 'trim|required');
        $this->form_validation->set_rules('conta_pagar_data_vencimento', 'data vencimento', 'trim|required');
        // conta_pagar_data_pagamento
        $this->form_validation->set_rules('conta_pagar_valor', 'valor', 'trim|required');
        // conta_pagar_status
        $this->form_validation->set_rules('conta_pagar_obs', 'observação', 'trim|max_length[500]');
        // conta_pagar_data_alteracao

        if ($this->form_validation->run()) {
            $data = elements(
                array(
                    // 'conta_pagar_id',
                    // 'conta_pagar_data_cadastro',
                    'conta_pagar_fornecedor_id',
                    'conta_pagar_data_vencimento',
                    // 'conta_pagar_data_pagamento',
                    'conta_pagar_valor',
                    'conta_pagar_status',
                    'conta_pagar_obs',
                    // 'conta_pagar_data_alteracao',
                ), $this->input->post(),
            );
            if ($this->input->post('conta_pagar_status') == 1) {
                $data['conta_pagar_data_pagamento'] = date('Y-m-d H:i:s');
            }
            // Clear
            $data = html_escape($data);
            // Inser
            $this->core_model->update('contas_pagar', $data, array('conta_pagar_id' => $conta_pagar_id));

            redirect('pagar');
        }

        $data = array(
            'titulo' => 'Editar conta à pagar',
            'styles' => array(
                'vendor/select2/select2.min.css',
            ),
            'scripts' => array(
                'vendor/select2/select2.min.js',
                'vendor/select2/app.js',
                'vendor/mask/jquery.mask.min.js',
                'vendor/mask/app.js',
            ),
            'conta_pagar' => $this->core_model->get_by_id('contas_pagar', array('conta_pagar_id' => $conta_pagar_id)),
            'fornecedores' => $this->core_model->get_all('fornecedores', array('fornecedor_ativo' => 1)),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('pagar/edit');
        $this->load->view('layout/footer');
    }

    public function add() {
        // conta_pagar_id
        // conta_pagar_data_cadastro
        $this->form_validation->set_rules('conta_pagar_fornecedor_id', 'fornecedor', 'trim|required');
        $this->form_validation->set_rules('conta_pagar_data_vencimento', 'data vencimento', 'trim|required');
        // conta_pagar_data_pagamento
        $this->form_validation->set_rules('conta_pagar_valor', 'valor', 'trim|required');
        // conta_pagar_status
        $this->form_validation->set_rules('conta_pagar_obs', 'observação', 'trim|max_length[500]');
        // conta_pagar_data_alteracao

        if ($this->form_validation->run()) {
            $data = elements(
                array(
                    // 'conta_pagar_id',
                    // 'conta_pagar_data_cadastro',
                    'conta_pagar_fornecedor_id',
                    'conta_pagar_data_vencimento',
                    // 'conta_pagar_data_pagamento',
                    'conta_pagar_valor',
                    'conta_pagar_status',
                    'conta_pagar_obs',
                    // 'conta_pagar_data_alteracao',
                ), $this->input->post(),
            );
            if ($this->input->post('conta_pagar_status') == 1) {
                $data['conta_pagar_data_pagamento'] = date('Y-m-d H:i:s');
            }
            // Clear
            $data = html_escape($data);
            // Inser
            $this->core_model->insert('contas_pagar', $data);

            redirect('pagar');
        }

        $data = array(
            'titulo' => 'Cadastrar conta à pagar',
            'styles' => array(
                'vendor/select2/select2.min.css',
            ),
            'scripts' => array(
                'vendor/select2/select2.min.js',
                'vendor/select2/app.js',
                'vendor/mask/jquery.mask.min.js',
                'vendor/mask/app.js',
            ),
            'fornecedores' => $this->core_model->get_all('fornecedores', array('fornecedor_ativo' => 1)),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('pagar/add');
        $this->load->view('layout/footer');
    }

    public function del($conta_pagar_id = null) {
        if (!$conta_pagar_id || !$this->core_model->get_by_id('contas_pagar', array('conta_pagar_id' => $conta_pagar_id))) {
            $this->session->set_flashdata('error', 'Conta à pagar não cadastrada.');
            return redirect('pagar');
        }

        if ($this->core_model->get_by_id('contas_pagar', array('conta_pagar_id' => $conta_pagar_id, 'conta_pagar_status !=' => 1))) {
            $this->session->set_flashdata('info', 'Conta à pagar pendente.');
            return redirect('pagar');
        }

        if (!$this->ion_auth->is_admin()) {
            $this->session->set_flashdata('info', 'Perfil não tem permissão para excluir registro.');
            return redirect('pagar');
        } else {
            if ($this->core_model->delete('contas_pagar', array('conta_pagar_id' => $conta_pagar_id))) {
                $this->session->set_flashdata('success', 'Registro excluído com sucesso.');
                return redirect('pagar');
            }
            
            return redirect('pagar');
        }

        $this->session->set_flashdata('error', 'Falha na tentativa de excluir o registro.');
        return redirect('pagar');
    }
}