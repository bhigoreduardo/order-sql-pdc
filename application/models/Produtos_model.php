<?php

defined('BASEPATH') OR exit('Acesso não permitido.');

class Produtos_model extends CI_Model {
    public function get_all() {
        $this->db->select([
            'produtos.*',
            'categorias.categoria_id as categoria_id',
            'categorias.categoria_nome as categoria',
            'marcas.marca_id as marca_id',
            'marcas.marca_nome as marca',
            'fornecedores.fornecedor_id as fornecedor_id',
            'fornecedores.fornecedor_nome_razao as fornecedor',
        ]);

        $this->db->join('categorias', 'categorias.categoria_id = produtos.produto_categoria_id', 'LEFT');
        $this->db->join('marcas', 'marcas.marca_id = produtos.produto_marca_id', 'LEFT');
        $this->db->join('fornecedores', 'fornecedores.fornecedor_id = produtos.produto_fornecedor_id', 'LEFT');

        return $this->db->get('produtos')->result();
    }

    public function update_estoque($produto_id, $diferenca) {
        $this->db->set('produto_quantidade_estoque', 'produto_quantidade_estoque -' . $diferenca, false);
        $this->db->where('produto_id', $produto_id);
        $this->db->update('produtos');
    }
}