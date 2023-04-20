<?php

defined('BASEPATH') OR exit('Acesso não permitido.');

class Formas_pagamentos extends CI_Controller {
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
            'titulo' => 'Formas de pagamentos cadastradas',
            'styles' => array(
                'vendor/datatables/dataTables.bootstrap4.min.css',
            ),
            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js',
            ),
            'formas_pagamentos' => $this->core_model->get_all('formas_pagamentos'),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('formas_pagamentos/index');
        $this->load->view('layout/footer');
    }

    public function edit($forma_pagamento_id  = null) {
        if (!$forma_pagamento_id  || !$this->core_model->get_by_id('formas_pagamentos', array('forma_pagamento_id ' => $forma_pagamento_id ))) {
            $this->session->set_flashdata('error', 'Forma de pagamento não cadastrada.');
            return redirect('pagamentos');
        }

        // forma_pagamento_id
        // forma_pagamento_data_cadastro
        $this->form_validation->set_rules('forma_pagamento_nome', 'método', 'trim|required|callback_check_nome');
        // forma_pagamento_aceita_parcela
        // forma_pagamento_ativo
        // forma_pagamento_data_alteracao

        if ($this->form_validation->run()) {
            // Check fk desativar
            if ($this->input->post('forma_pagamento_ativo') == 0) {
                // ordens_servicos
                if ($this->db->table_exists('ordens_servicos') && 
                    $this->core_model->get_by_id('ordens_servicos', array('ordem_servico_forma_pagamento_id' => $this->input->post('forma_pagamento_id'), 'ordem_servico_status' => 0))
                    ) {
                        $this->session->set_flashdata('info', 'Este registro não pode ser desativado, pois está em uso.');
                        return redirect('pagamentos');
                }
                
                // vendas
                if ($this->db->table_exists('vendas') && 
                    $this->core_model->get_by_id('vendas', array('venda_forma_pagamento_id' => $this->input->post('forma_pagamento_id'), 'venda_status' => 0))
                    ) {
                        $this->session->set_flashdata('info', 'Este registro não pode ser desativado, pois está em uso.');
                        return redirect('pagamentos');
                }
            }

            $data = elements(
                array(
                    // 'forma_pagamento_id',
                    // 'forma_pagamento_data_cadastro',
                    'forma_pagamento_nome',
                    'forma_pagamento_aceita_parcela',
                    'forma_pagamento_ativo',
                    // 'forma_pagamento_data_alteracao',
                ), $this->input->post(),
            );
            // Clear
            $data = html_escape($data);
            // Update
            $this->core_model->update('formas_pagamentos', $data, array('forma_pagamento_id' => $forma_pagamento_id));

            redirect('pagamentos');
        }

        $data = array(
            'titulo' => 'Editar forma de pagamento',
            'forma_pagamento' => $this->core_model->get_by_id('formas_pagamentos', array('forma_pagamento_id ' => $forma_pagamento_id )),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('formas_pagamentos/edit');
        $this->load->view('layout/footer');
    }

    public function add() {
        // forma_pagamento_id
        // forma_pagamento_data_cadastro
        $this->form_validation->set_rules('forma_pagamento_nome', 'método', 'trim|required|is_unique[formas_pagamentos.forma_pagamento_nome]');
        // forma_pagamento_aceita_parcela
        // forma_pagamento_ativo
        // forma_pagamento_data_alteracao

        if ($this->form_validation->run()) {
            $data = elements(
                array(
                    // 'forma_pagamento_id',
                    // 'forma_pagamento_data_cadastro',
                    'forma_pagamento_nome',
                    'forma_pagamento_aceita_parcela',
                    'forma_pagamento_ativo',
                    // 'forma_pagamento_data_alteracao',
                ), $this->input->post(),
            );
            // Clear
            $data = html_escape($data);
            // Inser
            $this->core_model->insert('formas_pagamentos', $data);

            redirect('pagamentos');
        }

        $data = array(
            'titulo' => 'Cadastrar forma de pagamento',
        );

        $this->load->view('layout/header', $data);
        $this->load->view('formas_pagamentos/add');
        $this->load->view('layout/footer');
    }

    public function del($forma_pagamento_id  = null) {
        if (!$forma_pagamento_id  || !$this->core_model->get_by_id('formas_pagamentos', array('forma_pagamento_id ' => $forma_pagamento_id ))) {
            $this->session->set_flashdata('error', 'Forma de pagamento não cadastrada.');
            return redirect('pagamentos');
        }

        if (!$this->ion_auth->is_admin()) {
            $this->session->set_flashdata('info', 'Perfil não tem permissão para excluir registro.');
            return redirect('pagamentos');
        } else {
            if ($this->core_model->delete('formas_pagamentos', array('forma_pagamento_id ' => $forma_pagamento_id ))) {
                $this->session->set_flashdata('success', 'Registro excluído com sucesso.');
                return redirect('pagamentos');
            }
            
            return redirect('pagamentos');
        }

        $this->session->set_flashdata('error', 'Falha na tentativa de excluir o registro.');
        return redirect('pagamentos');
    }

    public function check_nome($forma_pagamento_nome) {
        $forma_pagamento_id = $this->input->post('forma_pagamento_id');

        if ($this->core_model->get_by_id('formas_pagamentos', array('forma_pagamento_id !=' => $forma_pagamento_id, 'forma_pagamento_nome' => $forma_pagamento_nome))) {
            $this->form_validation->set_message('check_nome', 'Método já cadastrado.');

            return false;
        }

        return true;
    }
}