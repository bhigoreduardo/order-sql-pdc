<?php

defined('BASEPATH') OR exit('Acesso não permitido.');

class Usuarios extends CI_Controller {
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
            'titulo' =>  'Usuários cadastrados',
            'styles' => array(
                'vendor/datatables/dataTables.bootstrap4.min.css',
            ),
            'scripts' => array(
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js',
            ),
            'usuarios' => $this->ion_auth->users()->result(),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('usuarios/index');
        $this->load->view('layout/footer');
    }

    public function check_email($email) {
        $user_id = $this->input->post('id');

        if ($this->core_model->get_by_id('users', array('email' => $email, 'id !=' => $user_id))) {
            $this->form_validation->set_message('check_email', 'Email já está em uso.');

            return false;
        }

        return true;
    }

    public function check_username($username) {
        $user_id = $this->input->post('id');

        if ($this->core_model->get_by_id('users', array('username' => $username, 'id !=' => $user_id))) {
            $this->form_validation->set_message('check_username', 'Usuário já está em uso.');

            return false;
        }

        return true;
    }

    public function edit($user_id = null) {
        if(!$user_id || !$this->ion_auth->user($user_id)->row()) {
            $this->session->set_flashdata('error', 'Usuário não cadastrado.');
            return redirect('usuarios');
        }

        $this->form_validation->set_rules('first_name', 'nome', 'trim|required|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('last_name', 'sobrenome', 'trim|required|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|max_length[120]|callback_check_email');
        $this->form_validation->set_rules('username', 'usuário', 'trim|required|min_length[3]|max_length[50]|callback_check_username');
        $this->form_validation->set_rules('password', 'senha', 'min_length[5]|max_length[25]');
        $this->form_validation->set_rules('repeat_password', 'repetir senha', 'matches[password]');

        if ($this->form_validation->run()) {
            $data = elements(
                array(
                    'first_name',
                    'last_name',
                    'email',
                    'username',
                    'active',
                    'password'
                ),
                $this->input->post()
            );
            // Clear data
            // $data = $this->security->xss_clean($data);
            $data = html_escape($data);
            // Check change pass
            if (!$this->input->post('password')) {
                unset($data['password']);
            }
            if ($this->ion_auth->update($user_id, $data)) {
                $group_db = $this->ion_auth->get_users_groups($user_id)->row();
                $group_post = $this->input->post('group');
                // Check update group
                if ($group_db->id != $group_post) {
                    $this->ion_auth->remove_from_group($group_db->id, $user_id);
                    $this->ion_auth->add_to_group($group_post, $user_id);
                }

                $this->session->set_flashdata('success', 'Informações atualizadas com sucesso.');
            } else {
                $this->session->set_flashdata('error', 'Falha na tentativa de atualizar as informações.');
            }

            return redirect('usuarios');
        }

        $data = array(
            'titulo' => 'Editar usuário',
            'usuario' => $this->ion_auth->user($user_id)->row(),
            'perfil' => $this->ion_auth->get_users_groups($user_id)->row(),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('usuarios/edit');
        $this->load->view('layout/footer');
    }

    public function add() {
        $this->form_validation->set_rules('first_name', 'nome', 'trim|required|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('last_name', 'sobrenome', 'trim|required|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|max_length[60]|is_unique[users.email]');
        $this->form_validation->set_rules('username', 'usuário', 'trim|required|min_length[3]|max_length[50]|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'senha', 'required|min_length[5]|max_length[25]');
        $this->form_validation->set_rules('repeat_password', 'repetir senha', 'matches[password]');

        if ($this->form_validation->run()) {
            $username = $this->security->xss_clean($this->input->post('username'));
            $password = $this->security->xss_clean($this->input->post('password'));
            $email = $this->security->xss_clean($this->input->post('email'));
            $additional_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'username' => $this->input->post('username'),
                'active' => $this->input->post('active'),
            );
            $group = $this->security->xss_clean(array($this->input->post('group')));
            // Clear data
            // $additional_data = $this->security->xss_clean($additional_data);
            $additional_data = html_escape($additional_data);
            // Insert
            if ($this->ion_auth->register($username, $password, $email, $additional_data, $group)) {
                $this->session->set_flashdata('success', 'Informações salvas com sucesso.');
            } else {
                $this->session->set_flashdata('error', 'Falha na tentativa de salvar as informações.');
            }

            return redirect('usuarios');
        }

        $data = array(
            'titulo' => 'Cadastrar usuário',
        );

        $this->load->view('layout/header', $data);
        $this->load->view('usuarios/add');
        $this->load->view('layout/footer');
    }

    public function del($user_id = null) {
        if (!$user_id || !$this->ion_auth->user($user_id)->row()) {
            $this->session->set_flashdata('error', 'Usuário não cadastrado.');
            return redirect('usuarios');
        }

        if ($this->ion_auth->is_admin($user_id)) {
            $this->session->set_flashdata('error', 'Perfil administrador não pode ser excluído.');
            return redirect('usuarios');
        }

        if (!$this->ion_auth->is_admin()) {
            $this->session->set_flashdata('info', 'Perfil não tem permissão para excluir registro.');
            return redirect('usuarios');
        } else {
            if ($this->ion_auth->delete_user($user_id)) {
                $this->session->set_flashdata('success', 'Registro excluído com sucesso.');
                return redirect('usuarios');
            }
        }

        $this->session->set_flashdata('error', 'Falha na tentativa de excluir o registro.');
        return redirect('usuarios');
    }
}

// echo '<pre>';
// print_r($data);
// exit();

// echo '<pre>';
// print_r($data['usuarios']);
// exit();

// echo '<pre>';
// print_r($this->input->post());
// exit();

/*
[first_name] => Admin
[last_name] => istrator
[email] => admin@admin.com
[username] => administrator
[active] => 1
[group] => 1
[password] => 
[repeat_password] => 
[id] => 1
*/