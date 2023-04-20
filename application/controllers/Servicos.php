<?php

defined('BASEPATH') OR exit('Acesso não permitido.');

class Servicos extends CI_Controller {
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
            'titulo' => 'Serviços cadastrados',
            'styles' => array(
                'vendor/datatables/dataTables.bootstrap4.min.css',
            ),
            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js',
            ),
            'servicos' => $this->core_model->get_all('servicos'),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('servicos/index');
        $this->load->view('layout/footer');
    }

    public function edit($servico_id = null) {
        if (!$servico_id || !$this->core_model->get_by_id('servicos', array('servico_id' => $servico_id))) {
            $this->session->set_flashdata('error', 'Serviço não cadastrado.');
            return redirect('servicos');
        }

        // servico_id
        // servico_data_cadastro
        $this->form_validation->set_rules('servico_nome', 'nome', 'trim|required|min_length[3]|max_length[145]|callback_check_nome');
        $this->form_validation->set_rules('servico_preco', 'preço', 'trim|required|max_length[15]');
        $this->form_validation->set_rules('servico_descricao', 'descrição', 'trim|required|max_length[500]');
        // servico_ativo
        // servico_data_alteracao

        if ($this->form_validation->run()) {
            // $servico_preco = str_replace('R$', '', trim($this->input->post('servico_preco')));
            // $servico_preco = str_replace(',', '', trim($servico_preco));

            $data = elements(
                    array(
                        // 'servico_id',
                        'servico_nome',
                        'servico_preco',
                        'servico_descricao',
                        'servico_ativo',
                        // 'servico_data_alteracao',
                    ), $this->input->post()
            );
            // $data['servico_preco'] = trim(preg_replace('/\$/', '', $servico_preco));
            // Clear
            $data = html_escape($data);
            // Inser
            $this->core_model->update('servicos', $data, array('servico_id' => $servico_id));

            redirect('servicos');
        }

        
        $data = array(
            'titulo' => 'Editar serviço',
            'scripts' => array(
                'vendor/mask/jquery.mask.min.js',
                'vendor/mask/app.js',
            ),
            'servico' => $this->core_model->get_by_id('servicos', array('servico_id' => $servico_id)),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('servicos/edit');
        $this->load->view('layout/footer');
    }

    public function add() {
        // servico_id
        // servico_data_cadastro
        $this->form_validation->set_rules('servico_nome', 'nome', 'trim|required|min_length[3]|max_length[145]|is_unique[servicos.servico_nome]');
        $this->form_validation->set_rules('servico_preco', 'preço', 'trim|required|max_length[15]');
        $this->form_validation->set_rules('servico_descricao', 'descrição', 'trim|required|max_length[500]');
        // servico_ativo
        // servico_data_alteracao

        if ($this->form_validation->run()) {
            $data = elements(
                    array(
                        // 'servico_id',
                        'servico_nome',
                        'servico_preco',
                        'servico_descricao',
                        'servico_ativo',
                        // 'servico_data_alteracao',
                    ), $this->input->post()
            );
            // Clear
            $data = html_escape($data);
            // Inser
            $this->core_model->insert('servicos', $data);

            redirect('servicos');
        }

        $data = array(
            'titulo' => 'Cadastrar serviço',
            'scripts' => array(
                'vendor/mask/jquery.mask.min.js',
                'vendor/mask/app.js',
            ),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('servicos/add');
        $this->load->view('layout/footer');
    }

    public function del($servico_id = null) {
        if (!$servico_id || !$this->core_model->get_by_id('servicos', array('servico_id' => $servico_id))) {
            $this->session->set_flashdata('error', 'Serviço não cadastrado.');
            return redirect('servicos');
        }

        if (!$this->ion_auth->is_admin()) {
            $this->session->set_flashdata('info', 'Perfil não tem permissão para excluir registro.');
            return redirect('servicos');
        } else {
            if ($this->core_model->delete('servicos', array('servico_id' => $servico_id))) {
                $this->session->set_flashdata('success', 'Registro excluído com sucesso.');
            }

            return redirect('servicos');
        }

        $this->session->set_flashdata('error', 'Falha na tentativa de excluir o registro.');
        return redirect('servicos');
    }

    public function check_nome($servico_nome) {
        $servico_id = $this->input->post('servico_id');

        if ($this->core_model->get_by_id('servicos', array('servico_id !=' => $servico_id, 'servico_nome' => $servico_nome))) {
            $this->form_validation->set_message('email_check', 'Serviço já cadastrado.');
            return false;
        }

        return true;
    }
}