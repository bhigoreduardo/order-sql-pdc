<?php

defined('BASEPATH') OR exit('Acesso não permitido.');

class Marcas extends CI_Controller {
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
            'titulo' => 'Marcas cadastradas',
            'styles' => array(
                'vendor/datatables/dataTables.bootstrap4.min.css',
            ),
            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js',
            ),
            'marcas' => $this->core_model->get_all('marcas'),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('marcas/index');
        $this->load->view('layout/footer');
    }

    public function edit($marca_id = null) {
        if (!$marca_id || !$this->core_model->get_by_id('marcas', array('marca_id' => $marca_id))) {
            $this->session->set_flashdata('error', 'Marca não cadastrada.');
            return redirect('marcas');
        }

        // marca_id
        // marca_data_cadastro
        $this->form_validation->set_rules('marca_nome', 'nome', 'trim|required|min_length[3]|max_length[45]|callback_check_nome');
        // marca_ativo
        // marca_data_alteracao

        if ($this->form_validation->run()) {
            $data = elements(
                array(
                    // 'marca_id',
                    // 'marca_data_cadastro',
                    'marca_nome',
                    'marca_ativo',
                    // 'marca_data_alteracao',
                ), $this->input->post(),
            );
            // Clear
            $data = html_escape($data);
            // Inser
            $this->core_model->update('marcas', $data, array('marca_id' => $marca_id));

            redirect('marcas');
        }

        $data = array(
            'titulo' => 'Editar marca',
            'marca' => $this->core_model->get_by_id('marcas', array('marca_id' => $marca_id)),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('marcas/edit');
        $this->load->view('layout/footer');
    }

    public function add() {
        // marca_id
        // marca_data_cadastro
        $this->form_validation->set_rules('marca_nome', 'nome', 'trim|required|min_length[3]|max_length[45]|is_unique[marcas.marca_nome]');
        // marca_ativo
        // marca_data_alteracao

        if ($this->form_validation->run()) {
            $data = elements(
                array(
                    // 'marca_id',
                    // 'marca_data_cadastro',
                    'marca_nome',
                    'marca_ativo',
                    // 'marca_data_alteracao',
                ), $this->input->post(),
            );
            // Clear
            $data = html_escape($data);
            // Inser
            $this->core_model->insert('marcas', $data);

            redirect('marcas');
        }

        $data = array(
            'titulo' => 'Cadastrar marca',
        );

        $this->load->view('layout/header', $data);
        $this->load->view('marcas/add');
        $this->load->view('layout/footer');
    }

    public function del($marca_id = null) {
        if (!$marca_id || !$this->core_model->get_by_id('marcas', array('marca_id' => $marca_id))) {
            $this->session->set_flashdata('error', 'Marca não cadastrada.');
            return redirect('marcas');
        }

        if (!$this->ion_auth->is_admin()) {
            $this->session->set_flashdata('info', 'Perfil não tem permissão para excluir registro.');
            return redirect('marcas');
        } else {
            if ($this->core_model->delete('marcas', array('marca_id' => $marca_id))) {
                $this->session->set_flashdata('success', 'Registro excluído com sucesso.');
            }

            return redirect('marcas');
        }

        $this->session->set_flashdata('error', 'Falha na tentativa de excluir o registro.');
        return redirect('marcas');
    }

    public function check_nome($marca_nome) {
        $marca_id = $this->input->post('marca_id');

        if ($this->core_model->get_by_id('marcas', array('marca_id !=' => $marca_id, 'marca_nome' => $marca_nome))) {
            $this->form_validation->set_message('email_check', 'Marca já cadastrada.');
            return false;
        }

        return true;
    }
}