<?php

defined('BASEPATH') OR exit('Acesso não permitido.');

class Vendas_model extends CI_Model {
    public function get_by_id($venda_id = null) {
        if ($venda_id) {
            $this->db->select([
                'vendas.*',
                'formas_pagamentos.forma_pagamento_id as forma_pagamento_id',
                'formas_pagamentos.forma_pagamento_nome as forma_pagamento',
                'clientes.cliente_id as cliente_id',
                'clientes.cliente_cpf_cnpj as cliente_cpf_cnpj',
                'clientes.cliente_nome_razao as cliente_nome_razao',
                'clientes.cliente_sobrenome_fantasia as cliente_sobrenome_fantasia',
                'clientes.cliente_tipo as cliente_tipo',
                'vendedores.vendedor_id as vendedor_id',
                'vendedores.vendedor_nome_completo as vendedor',
            ]);

            $this->db->join('formas_pagamentos', 'formas_pagamentos.forma_pagamento_id = vendas.venda_forma_pagamento_id', 'LEFT');
            $this->db->join('clientes', 'clientes.cliente_id = vendas.venda_cliente_id', 'LEFT');
            $this->db->join('vendedores', 'vendedores.vendedor_id = vendas.venda_vendedor_id', 'LEFT');

            $this->db->where('venda_id', $venda_id);

            return $this->db->get('vendas')->row();
        }
    }

    public function get_all() {
        $this->db->select([
            'vendas.*',
            // 'clientes.cliente_id as cliente_id',
            'clientes.cliente_nome_razao as cliente',
            // 'clientes.cliente_sobrenome_fantasia as cliente_sobrenome_fantasia',
            // 'clientes.cliente_cpf_cnpj as cliente_cpf_cnpj',
            // 'formas_pagamentos.forma_pagamento_id as forma_pagamento_id',
            'formas_pagamentos.forma_pagamento_nome as forma_pagamento',
            // 'vendedores.vendedor_id as vendedor_id',
            'vendedores.vendedor_nome_completo as vendedor',
        ]);

        $this->db->join('clientes', 'clientes.cliente_id = vendas.venda_cliente_id', 'LEFT');
        $this->db->join('formas_pagamentos', 'formas_pagamentos.forma_pagamento_id = vendas.venda_forma_pagamento_id', 'LEFT');
        $this->db->join('vendedores', 'vendedores.vendedor_id = vendas.venda_vendedor_id', 'LEFT');

        return $this->db->get('vendas')->result();
    }

    public function delete_old_produtos($venda_id = null) {
        if ($venda_id) {
            $this->db->delete('venda_produtos', array('venda_produto_id_venda' => $venda_id));
        }
    }

    public function get_all_produtos_by_venda($venda_id = null) {
        if ($venda_id) {
            $this->db->select([
                'venda_produtos.*',
                'produtos.produto_id as produto_id',
                'produtos.produto_descricao as produto_descricao',
            ]);

            $this->db->join('produtos', 'produtos.produto_id = venda_produtos.venda_produto_id_produto', 'LEFT');
            $this->db->where('venda_produtos.venda_produto_id_venda', $venda_id);

            return $this->db->get('venda_produtos')->result();
        }
    }
}