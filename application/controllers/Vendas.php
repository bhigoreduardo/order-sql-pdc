<?php

defined('BASEPATH') OR exit('Acesso não permitido.');

class Vendas extends CI_Controller {
    public function __construct() {
        parent::__construct();

        // Check loggedin
        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('info', 'Sua sessão expirou, faça login novamente.');
            return redirect('login');
        }

        $this->load->model('vendas_model');
    }

    public function index() {
        $data = array(
            'titulo' => 'Vendas cadastradas',
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
            'vendas' => $this->vendas_model->get_all(),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('vendas/index');
        $this->load->view('layout/footer');
    }

    public function edit($venda_id = null) {
        if (!$venda_id || !$this->core_model->get_by_id('vendas', array('venda_id' => $venda_id))) {
            $this->session->set_flashdata('error', 'Venda não cadastrada.');
            return redirect('vendas');
        }

        // venda_id
        // venda_data_cadastro
        $this->form_validation->set_rules('venda_cliente_id', 'cliente', 'required');
        $this->form_validation->set_rules('venda_forma_pagamento_id', 'forma pagamento', 'required');
        $this->form_validation->set_rules('venda_vendedor_id', 'vendedor', 'required');
        // venda_tipo
        // venda_status
        // venda_valor_desconto
        // venda_valor_total
        // venda_data_alteracao

        if ($this->form_validation->run() && $this->input->post('produto_descricao')) {
            if (!$this->input->post('produto_descricao')) {
                $this->session->set_flashdata('info', 'Necessário inserir pelo menos 1 produto.');
                return redirect('vendas/edit/' . $venda_id);
            }

            $venda_valor_desconto = str_replace('R$', '', trim($this->input->post('venda_valor_desconto')));
            $venda_valor_desconto = str_replace(',', '', trim($venda_valor_desconto));
            $venda_valor_total = str_replace('R$', '', trim($this->input->post('venda_valor_total')));
            $venda_valor_total = str_replace(',', '', trim($venda_valor_total));

            $data = elements(
                array(
                    // 'venda_id',
                    // 'venda_data_cadastro',
                    'venda_cliente_id',
                    'venda_forma_pagamento_id',
                    'venda_vendedor_id',
                    'venda_tipo',
                    'venda_status',
                    // 'venda_valor_desconto',
                    // 'venda_valor_total',
                    // 'venda_data_alteracao',
                ), $this->input->post(),
            );
            $data['venda_valor_desconto'] = trim(preg_replace('/\$/', '', $venda_valor_desconto));
            $data['venda_valor_total'] = trim(preg_replace('/\$/', '', $venda_valor_total));
            // Clear
            $data = html_escape($data);
            // Update
            $this->core_model->update('vendas', $data, array('venda_id' => $venda_id));
            $this->vendas_model->delete_old_produtos($venda_id);

            $venda_produto_id_produto = $this->input->post('produto_id');
            $venda_produto_quantidade = $this->input->post('produto_quantidade');
            $venda_produto_valor_unitario = str_replace('R$', '', $this->input->post('produto_preco_venda'));
            $venda_produto_desconto = str_replace('%', '', $this->input->post('produto_desconto'));
            $venda_produto_valor_total = str_replace('R$', '', $this->input->post('produto_item_total'));

            for ($i = 0; $i < count($venda_produto_id_produto); $i++) {
                $data = array(
                    'venda_produto_id_venda' => $venda_id,
                    'venda_produto_id_produto' => $venda_produto_id_produto[$i],
                    'venda_produto_quantidade' => $venda_produto_quantidade[$i],
                    'venda_produto_valor_unitario' => $venda_produto_valor_unitario[$i],
                    'venda_produto_desconto' => $venda_produto_desconto[$i],
                    'venda_produto_valor_total' => $venda_produto_valor_total[$i],
                );
                // Clear
                $data = html_escape($data);
                // Insert
                $this->core_model->insert('venda_produtos', $data);
            }

            redirect('vendas');
        }

        $data = array(
            'titulo' => 'Editar venda',
            'styles' => array(
                'vendor/select2/select2.min.css',
                'vendor/autocomplete/jquery-ui.css',
                'vendor/autocomplete/estilo.css',
            ),
            'scripts' => array(
                'vendor/autocomplete/jquery-migrate.js',
                'vendor/calcx/jquery-calx-sample-2.2.8.min.js',
                'vendor/calcx/venda.js',
                'vendor/select2/select2.min.js',
                'vendor/select2/app.js',
                'vendor/sweetalert2/sweetalert2.js',
                'vendor/autocomplete/jquery-ui.js',
            ),
            'venda' => $this->vendas_model->get_by_id($venda_id),
            'produtos' => $this->vendas_model->get_all_produtos_by_venda($venda_id),
            'clientes' => $this->core_model->get_all('clientes', array('cliente_ativo' => 1)),
            'formas_pagamentos' => $this->core_model->get_all('formas_pagamentos', array('forma_pagamento_ativo' => 1)),
            'vendedores' => $this->core_model->get_all('vendedores', array('vendedor_ativo' => 1)),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('vendas/edit');
        $this->load->view('layout/footer');
    }

    public function add() {
        // venda_id
        // venda_data_cadastro
        $this->form_validation->set_rules('venda_cliente_id', 'cliente', 'required');
        $this->form_validation->set_rules('venda_forma_pagamento_id', 'forma pagamento', 'required');
        $this->form_validation->set_rules('venda_vendedor_id', 'vendedor', 'required');
        // venda_tipo
        // venda_status
        // venda_valor_desconto
        // venda_valor_total
        // venda_data_alteracao

        if ($this->form_validation->run() && $this->input->post('produto_descricao')) {
            $venda_valor_desconto = str_replace('R$', '', trim($this->input->post('venda_valor_desconto')));
            $venda_valor_desconto = str_replace(',', '', trim($venda_valor_desconto));
            $venda_valor_total = str_replace('R$', '', trim($this->input->post('venda_valor_total')));
            $venda_valor_total = str_replace(',', '', trim($venda_valor_total));

            $data = elements(
                array(
                    // 'venda_id',
                    // 'venda_data_cadastro',
                    'venda_cliente_id',
                    'venda_forma_pagamento_id',
                    'venda_vendedor_id',
                    'venda_tipo',
                    'venda_status',
                    // 'venda_valor_desconto',
                    // 'venda_valor_total',
                    // 'venda_data_alteracao',
                ), $this->input->post(),
            );
            $data['venda_valor_desconto'] = trim(preg_replace('/\$/', '', $venda_valor_desconto));
            $data['venda_valor_total'] = trim(preg_replace('/\$/', '', $venda_valor_total));
            // Clear
            $data = html_escape($data);
            // Insert
            $this->core_model->insert('vendas', $data, true);
            
            $venda_id = $this->session->userdata('last_id');

            $venda_produto_id_produto = $this->input->post('produto_id');
            $venda_produto_quantidade = $this->input->post('produto_quantidade');
            $venda_produto_valor_unitario = str_replace('R$', '', $this->input->post('produto_preco_venda'));
            $venda_produto_desconto = str_replace('%', '', $this->input->post('produto_desconto'));
            $venda_produto_valor_total = str_replace('R$', '', $this->input->post('produto_item_total'));

            for ($i = 0; $i < count($venda_produto_id_produto); $i++) {
                $data = array(
                    'venda_produto_id_venda' => $venda_id,
                    'venda_produto_id_produto' => $venda_produto_id_produto[$i],
                    'venda_produto_quantidade' => $venda_produto_quantidade[$i],
                    'venda_produto_valor_unitario' => $venda_produto_valor_unitario[$i],
                    'venda_produto_desconto' => $venda_produto_desconto[$i],
                    'venda_produto_valor_total' => $venda_produto_valor_total[$i],
                );
                // Clear
                $data = html_escape($data);
                // Insert
                $this->db->insert('venda_produtos', $data);
            }

            redirect('vendas');
        }

        $data = array(
            'titulo' => 'Cadastrar venda',
            'styles' => array(
                'vendor/select2/select2.min.css',
                'vendor/autocomplete/jquery-ui.css',
                'vendor/autocomplete/estilo.css',
            ),
            'scripts' => array(
                'vendor/autocomplete/jquery-migrate.js',
                'vendor/calcx/jquery-calx-sample-2.2.8.min.js',
                'vendor/calcx/venda.js',
                'vendor/select2/select2.min.js',
                'vendor/select2/app.js',
                'vendor/sweetalert2/sweetalert2.js',
                'vendor/autocomplete/jquery-ui.js',
            ),
            'clientes' => $this->core_model->get_all('clientes'),
            'formas_pagamentos' => $this->core_model->get_all('formas_pagamentos'),
            'vendedores' => $this->core_model->get_all('vendedores'),
        );

        $this->load->view('layout/header', $data);
        $this->load->view('vendas/add');
        $this->load->view('layout/footer');
    }

    public function del($venda_id = null) {
        if (!$venda_id || !$this->core_model->get_by_id('vendas', array('venda_id' => $venda_id))) {
            $this->session->set_flashdata('error', 'Venda não cadastrada.');
            return redirect('vendas');
        }

        if ($this->core_model->get_by_id('vendas', array('venda_id' => $venda_id, 'venda_status !=' => 1))) {
            $this->session->set_flashdata('info', 'Venda pendente.');
            return redirect('vendas');
        }

        if (!$this->ion_auth->is_admin()) {
            $this->session->set_flashdata('info', 'Perfil não tem permissão para excluir registro.');
            return redirect('vendas');
        } else {
            if ($this->core_model->delete('vendas', array('venda_id' => $venda_id))) {
                $this->session->set_flashdata('success', 'Registro excluído com sucesso.');
            }

            return redirect('vendas');
        }

        $this->session->set_flashdata('error', 'Falha na tentativa de excluir o registro.');
        return redirect('vendas');
    }
}