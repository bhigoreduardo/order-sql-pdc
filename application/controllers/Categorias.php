<?php

defined('BASEPATH') OR exit('Acesso não permitido.');

class Categorias extends CI_Controller {
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
            'titulo' => 'Categorias cadastradas',
            'styles' => array(
                'vendor/datatables/dataTables.bootstrap4.min.css',
            ),
            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js',
            ),
            'categorias' => $this->core_model->get_all('categorias'),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('categorias/index');
        $this->load->view('layout/footer');
    }

    public function edit($categoria_id = null) {
        if (!$categoria_id || !$this->core_model->get_by_id('categorias', array('categoria_id' => $categoria_id))) {
            $this->session->set_flashdata('error', 'Categoria não cadastrada.');
            return redirect('categorias');
        }

        // categoria_id
        // categoria_data_cadastro
        $this->form_validation->set_rules('categoria_nome', 'nome', 'trim|required|min_length[3]|max_length[45]|callback_check_nome');
        // categoria_ativo
        // categoria_data_alteracao

        if ($this->form_validation->run()) {
            $data = elements(
                array(
                    // 'categoria_id',
                    // 'categoria_data_cadastro',
                    'categoria_nome',
                    'categoria_ativo',
                    // 'categoria_data_alteracao',
                ), $this->input->post(),
            );
            // Clear
            $data = html_escape($data);
            // Inser
            $this->core_model->update('categorias', $data, array('categoria_id' => $categoria_id));

            redirect('categorias');
        }

        $data = array(
            'titulo' => 'Editar categoria',
            'categoria' => $this->core_model->get_by_id('categorias', array('categoria_id' => $categoria_id)),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('categorias/edit');
        $this->load->view('layout/footer');
    }

    public function add() {
        // categoria_id
        // categoria_data_cadastro
        $this->form_validation->set_rules('categoria_nome', 'nome', 'trim|required|min_length[3]|max_length[45]|is_unique[categorias.categoria_nome]');
        // categoria_ativo
        // categoria_data_alteracao

        if ($this->form_validation->run()) {
            $data = elements(
                array(
                    // 'categoria_id',
                    // 'categoria_data_cadastro',
                    'categoria_nome',
                    'categoria_ativo',
                    // 'categoria_data_alteracao',
                ), $this->input->post(),
            );
            // Clear
            $data = html_escape($data);
            // Inser
            $this->core_model->insert('categorias', $data);

            redirect('categorias');
        }

        $data = array(
            'titulo' => 'Cadastrar categoria',
        );

        $this->load->view('layout/header', $data);
        $this->load->view('categorias/add');
        $this->load->view('layout/footer');
    }

    public function del($categoria_id = null) {
        if (!$categoria_id || !$this->core_model->get_by_id('categorias', array('categoria_id' => $categoria_id))) {
            $this->session->set_flashdata('error', 'Categoria não cadastrada.');
            return redirect('categorias');
        }

        if (!$this->ion_auth->is_admin()) {
            $this->session->set_flashdata('info', 'Perfil não tem permissão para excluir registro.');
            return redirect('categorias');
        } else {
            if ($this->core_model->delete('categorias', array('categoria_id' => $categoria_id))) {
                $this->session->set_flashdata('success', 'Registro excluído com sucesso.');
            }

            return redirect('categorias');
        }

        $this->session->set_flashdata('error', 'Falha na tentativa de excluir o registro.');
        return redirect('categorias');
    }

    public function check_nome($categoria_nome) {
        $categoria_id = $this->input->post('categoria_id');

        if ($this->core_model->get_by_id('categorias', array('categoria_id !=' => $categoria_id, 'categoria_nome' => $categoria_nome))) {
            $this->form_validation->set_message('email_check', 'categoria já cadastrada.');
            return false;
        }

        return true;
    }
}