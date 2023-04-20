<?php

defined('BASEPATH') OR exit('Acesso não permitido.');

class Ordens_servicos extends CI_Controller {
    public function __construct() {
        parent::__construct();

        // Check loggedin
        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou, faça login novamente.');
            return redirect('login');
        }

        $this->load->model('ordens_servicos_model');
    }

    public function index() {
        $data = array(
            'titulo' => 'Ordens de serviços cadastrados',
            'styles' => array(
                'vendor/datatables/dataTables.bootstrap4.min.css',
            ),
            'scripts' => array(
                'vendor/mask/jquery.mask.min.js',
                'vendor/mask/app.js',
                'vendor/datatables/jquery.dataTables.min.js',
                'vendor/datatables/dataTables.bootstrap4.min.js',
                'vendor/datatables/app.js',
            ),
            'ordens_servicos' => $this->ordens_servicos_model->get_all(),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('ordens_servicos/index');
        $this->load->view('layout/footer');
    }

    public function edit($ordem_servico_id = null) {
        if (!$ordem_servico_id || !$this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id))) {
            $this->session->set_flashdata('error', 'Ordem de serviço não cadastrada.');
            return redirect('ordens');
        }

        // ordem_servico_id
        // ordem_servico_data_cadastro
        $this->form_validation->set_rules('ordem_servico_forma_pagamento_id', 'forma pagamento', 'trim|required');
        $this->form_validation->set_rules('ordem_servico_cliente_id', 'cliente', 'trim|required');
        // ordem_servico_data_conclusao
        $this->form_validation->set_rules('ordem_servico_descricao', 'descrição', 'trim|required|min_length[3]|max_length[60]');
        $this->form_validation->set_rules('ordem_servico_equipamento', 'equipamento', 'trim|required|min_length[3]|max_length[60]');
        $this->form_validation->set_rules('ordem_servico_marca_equipamento', 'marca', 'trim|max_length[60]');
        $this->form_validation->set_rules('ordem_servico_modelo_equipamento', 'modelo', 'trim|max_length[60]');
        $this->form_validation->set_rules('ordem_servico_acessorios', 'acessórios', 'trim|max_length[500]');
        $this->form_validation->set_rules('ordem_servico_defeito', 'defeito', 'trim|required|max_length[500]');
        // ordem_servico_valor_desconto $this->form_validation->set_rules('ordem_servico_valor_desconto', 'desconto', 'trim|max_length[10]');
        // ordem_servico_valor_total $this->form_validation->set_rules('ordem_servico_valor_total', 'total', 'trim|required|max_length[10]');
        // ordem_servico_status
        $this->form_validation->set_rules('ordem_servico_obs', 'observação', 'trim|max_length[500]');
        // ordem_servico_data_alteracao

        if ($this->form_validation->run()) {
            if (!$this->input->post('servico_nome')) {
                $this->session->set_flashdata('info', 'Necessário inserir pelo menos 1 serviço.');
                return redirect('ordens/edit/' . $ordem_servico_id);
            }

            $ordem_servico_valor_desconto = str_replace('R$', '', trim($this->input->post('ordem_servico_valor_desconto')));
            $ordem_servico_valor_desconto = str_replace(',', '', trim($ordem_servico_valor_desconto));
            $ordem_servico_valor_total = str_replace('R$', '', trim($this->input->post('ordem_servico_valor_total')));
            $ordem_servico_valor_total = str_replace(',', '', trim($ordem_servico_valor_total));

            $data = elements(
                array(
                    // 'ordem_servico_id',
                    // 'ordem_servico_data_cadastro',
                    'ordem_servico_forma_pagamento_id',
                    'ordem_servico_cliente_id',
                    // 'ordem_servico_data_conclusao',
                    'ordem_servico_descricao',
                    'ordem_servico_equipamento',
                    'ordem_servico_marca_equipamento',
                    'ordem_servico_modelo_equipamento',
                    'ordem_servico_acessorios',
                    'ordem_servico_defeito',
                    // 'ordem_servico_valor_desconto',
                    // 'ordem_servico_valor_total',
                    'ordem_servico_status',
                    'ordem_servico_obs',
                    // 'ordem_servico_data_alteracao',
                ), $this->input->post(),
            );
            $data['ordem_servico_valor_desconto'] = trim(preg_replace('/\$/', '', $ordem_servico_valor_desconto));
            $data['ordem_servico_valor_total'] = trim(preg_replace('/\$/', '', $ordem_servico_valor_total));
            if ($this->input->post('ordem_servico_status') == 1) {
                $data['ordem_servico_data_conclusao'] = date('Y-m-d H:i:s');
            }
            // Clear
            $data = html_escape($data);
            // Update
            $this->core_model->update('ordens_servicos', $data, array('ordem_servico_id' => $ordem_servico_id));
            $this->ordens_servicos_model->delete_old_servicos($ordem_servico_id);

            $ordem_ts_id_servico = $this->input->post('servico_id');
            $ordem_ts_quantidade = $this->input->post('servico_quantidade');
            $ordem_ts_valor_unitario = str_replace('R$', '', $this->input->post('servico_preco'));
            $ordem_ts_valor_unitario = str_replace(',', '', $ordem_ts_valor_unitario);
            $ordem_ts_valor_desconto = str_replace('%', '', $this->input->post('servico_desconto'));
            $ordem_ts_valor_total = str_replace('R$', '', $this->input->post('servico_item_total'));
            $ordem_ts_valor_total = str_replace(',', '', $ordem_ts_valor_total);

            for ($i = 0; $i < count($ordem_ts_id_servico); $i++) {
                $data = array(
                    'ordem_ts_id_ordem_servico' => $ordem_servico_id,
                    'ordem_ts_id_servico' => $ordem_ts_id_servico[$i],
                    'ordem_ts_quantidade' => $ordem_ts_quantidade[$i],
                    'ordem_ts_valor_unitario' => $ordem_ts_valor_unitario[$i],
                    'ordem_ts_valor_desconto' => $ordem_ts_valor_desconto[$i],
                    'ordem_ts_valor_total' => $ordem_ts_valor_total[$i],
                );
                // Clear
                $data = html_escape($data);
                // Insert
                $this->core_model->insert('ordem_tem_servicos', $data);
            }

            redirect('ordens');
        }

        $data = array(
            'titulo' => 'Editar ordem de serviço',
            'styles' => array(
                'vendor/select2/select2.min.css',
                'vendor/autocomplete/jquery-ui.css',
                'vendor/autocomplete/estilo.css',
            ),
            'scripts' => array(
                'vendor/autocomplete/jquery-migrate.js',
                'vendor/calcx/jquery-calx-sample-2.2.8.min.js',
                'vendor/calcx/os.js',
                'vendor/select2/select2.min.js',
                'vendor/select2/app.js',
                'vendor/sweetalert2/sweetalert2.js',
                'vendor/autocomplete/jquery-ui.js',
            ),
            'ordem_servico' => $this->ordens_servicos_model->get_by_id($ordem_servico_id),
            'formas_pagamentos' => $this->core_model->get_all('formas_pagamentos', array('forma_pagamento_ativo' => 1)),
            'clientes' => $this->core_model->get_all('clientes', array('cliente_ativo' => 1)),
            'servicos' => $this->ordens_servicos_model->get_all_servicos_by_ordem($ordem_servico_id),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('ordens_servicos/edit');
        $this->load->view('layout/footer');
    }

    public function add() {
        // ordem_servico_id
        // ordem_servico_data_cadastro
        $this->form_validation->set_rules('ordem_servico_forma_pagamento_id', 'forma pagamento', 'trim|required');
        $this->form_validation->set_rules('ordem_servico_cliente_id', 'cliente', 'trim|required');
        // ordem_servico_data_conclusao
        $this->form_validation->set_rules('ordem_servico_descricao', 'descrição', 'trim|required|min_length[3]|max_length[60]');
        $this->form_validation->set_rules('ordem_servico_equipamento', 'equipamento', 'trim|required|min_length[3]|max_length[60]');
        $this->form_validation->set_rules('ordem_servico_marca_equipamento', 'marca', 'trim|max_length[60]');
        $this->form_validation->set_rules('ordem_servico_modelo_equipamento', 'modelo', 'trim|max_length[60]');
        $this->form_validation->set_rules('ordem_servico_acessorios', 'acessórios', 'trim|max_length[500]');
        $this->form_validation->set_rules('ordem_servico_defeito', 'defeito', 'trim|required|max_length[500]');
        // ordem_servico_valor_desconto $this->form_validation->set_rules('ordem_servico_valor_desconto', 'desconto', 'trim|max_length[10]');
        // ordem_servico_valor_total $this->form_validation->set_rules('ordem_servico_valor_total', 'total', 'trim|required|max_length[10]');
        // ordem_servico_status
        $this->form_validation->set_rules('ordem_servico_obs', 'observação', 'trim|max_length[500]');
        // ordem_servico_data_alteracao

        // echo '<pre>';
        // print_r($this->input->post());
        // exit();

        if ($this->form_validation->run()) {
            $ordem_servico_valor_desconto = str_replace('R$', '', trim($this->input->post('ordem_servico_valor_desconto')));
            $ordem_servico_valor_desconto = str_replace(',', '', trim($ordem_servico_valor_desconto));
            $ordem_servico_valor_total = str_replace('R$', '', trim($this->input->post('ordem_servico_valor_total')));
            $ordem_servico_valor_total = str_replace(',', '', trim($ordem_servico_valor_total));

            $data = elements(
                array(
                    // 'ordem_servico_id',
                    // 'ordem_servico_data_cadastro',
                    'ordem_servico_forma_pagamento_id',
                    'ordem_servico_cliente_id',
                    // 'ordem_servico_data_conclusao',
                    'ordem_servico_descricao',
                    'ordem_servico_equipamento',
                    'ordem_servico_marca_equipamento',
                    'ordem_servico_modelo_equipamento',
                    'ordem_servico_acessorios',
                    'ordem_servico_defeito',
                    // 'ordem_servico_valor_desconto',
                    // 'ordem_servico_valor_total',
                    'ordem_servico_status',
                    'ordem_servico_obs',
                    // 'ordem_servico_data_alteracao',
                ), $this->input->post(),
            );
            $data['ordem_servico_valor_desconto'] = trim(preg_replace('/\$/', '', $ordem_servico_valor_desconto));
            $data['ordem_servico_valor_total'] = trim(preg_replace('/\$/', '', $ordem_servico_valor_total));
            if ($this->input->post('ordem_servico_status') == 1) {
                $data['ordem_servico_data_conclusao'] = date('Y-m-d H:i:s');
            }
            // Clear
            $data = html_escape($data);
            // Insert
            $this->core_model->insert('ordens_servicos', $data, true);

            if ($this->input->post('servico_nome')) {
                $ordem_servico_id = $this->session->userdata('last_id');

                $ordem_ts_id_servico = $this->input->post('servico_id');
                $ordem_ts_quantidade = $this->input->post('servico_quantidade');
                $ordem_ts_valor_unitario = str_replace('R$', '', $this->input->post('servico_preco'));
                $ordem_ts_valor_unitario = str_replace(',', '', $ordem_ts_valor_unitario);
                $ordem_ts_valor_desconto = str_replace('%', '', $this->input->post('servico_desconto'));
                $ordem_ts_valor_total = str_replace('R$', '', $this->input->post('servico_item_total'));
                $ordem_ts_valor_total = str_replace(',', '', $ordem_ts_valor_total);

                for ($i = 0; $i < count($ordem_ts_id_servico); $i++) {
                    $data = array(
                        'ordem_ts_id_ordem_servico' => $ordem_servico_id,
                        'ordem_ts_id_servico' => $ordem_ts_id_servico[$i],
                        'ordem_ts_quantidade' => $ordem_ts_quantidade[$i],
                        'ordem_ts_valor_unitario' => $ordem_ts_valor_unitario[$i],
                        'ordem_ts_valor_desconto' => $ordem_ts_valor_desconto[$i],
                        'ordem_ts_valor_total' => $ordem_ts_valor_total[$i],
                    );
                    // Clear
                    $data = html_escape($data);
                    // Insert
                    $this->db->insert('ordem_tem_servicos', $data);
                }
            }

            redirect('ordens');
        }

        $data = array(
            'titulo' => 'Cadastrar ordem de serviço',
            'styles' => array(
                'vendor/select2/select2.min.css',
                'vendor/autocomplete/jquery-ui.css',
                'vendor/autocomplete/estilo.css',
            ),
            'scripts' => array(
                'vendor/autocomplete/jquery-migrate.js',
                'vendor/calcx/jquery-calx-sample-2.2.8.min.js',
                'vendor/calcx/os.js',
                'vendor/select2/select2.min.js',
                'vendor/select2/app.js',
                'vendor/sweetalert2/sweetalert2.js',
                'vendor/autocomplete/jquery-ui.js',
            ),
            'formas_pagamentos' => $this->core_model->get_all('formas_pagamentos'),
            'clientes' => $this->core_model->get_all('clientes'),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('ordens_servicos/add');
        $this->load->view('layout/footer');
    }

    public function del($ordem_servico_id = null) {
        if (!$ordem_servico_id || !$this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id))) {
            $this->session->set_flashdata('error', 'Ordem de serviço não cadastrada.');
            return redirect('ordens');
        }

        if ($this->core_model->get_by_id('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id, 'ordem_servico_status !=' => 1))) {
            $this->session->set_flashdata('info', 'Ordem de serviço pendente.');
            return redirect('ordens');
        }

        if (!$this->ion_auth->is_admin()) {
            $this->session->set_flashdata('info', 'Perfil não tem permissão para excluir registro.');
            return redirect('ordens');
        } else {
            if ($this->core_model->delete('ordens_servicos', array('ordem_servico_id' => $ordem_servico_id))) {
                $this->session->set_flashdata('success', 'Registro excluído com sucesso.');
            }

            return redirect('ordens');
        }

        $this->session->set_flashdata('error', 'Falha na tentativa de excluir o registro.');
        return redirect('ordens');
    }
}