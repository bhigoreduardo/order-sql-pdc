<?php

defined('BASEPATH') OR exit('Acesso não permitido.');

class Login extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->view('layout/header');
        $this->load->view('login/index');
        $this->load->view('layout/footer');
    }

    public function auth() {
        $identity = $this->security->xss_clean($this->input->post('email'));
        $password = $this->security->xss_clean($this->input->post('password'));
        $remember = $this->security->xss_clean($this->input->post('remember'));

        if ($this->ion_auth->login($identity, $password, $remember)) {
            $this->session->set_flashdata('success', 'Login realizado com sucesso.');
            return redirect('home');
        }

        $this->session->set_flashdata('error', 'Verifique se email e/ou senha, falha no login.');
        return redirect('login');
    }

    public function logout() {
        $this->ion_auth->logout();
        return redirect('login');
    }
}