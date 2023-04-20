<?php

defined('BASEPATH') OR exit('Acesso não permitido.');

class Financeiro_model extends CI_Model {
    public function get_all_pagar() {
        $this->db->select([
            'contas_pagar.*',
            'fornecedores.fornecedor_id as fornecedor_id',
            'fornecedores.fornecedor_nome_razao as fornecedor',
        ]);

        $this->db->join('fornecedores', 'fornecedores.fornecedor_id = contas_pagar.conta_pagar_fornecedor_id', 'LEFT');
        return $this->db->get('contas_pagar')->result();
    }

    public function get_all_receber() {
        $this->db->select([
            'contas_receber.*',
            'clientes.cliente_id as cliente_id',
            'clientes.cliente_nome_razao as cliente',
        ]);

        $this->db->join('clientes', 'clientes.cliente_id = contas_receber.conta_receber_cliente_id', 'LEFT');
        return $this->db->get('contas_receber')->result();
    }
}