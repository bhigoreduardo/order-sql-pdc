<?php

defined('BASEPATH') OR exit('Acesso não permitido.');

class Ordens_servicos_model extends CI_Model {
    public function get_by_id($ordem_servico_id = null) {
        if ($ordem_servico_id) {
            $this->db->select([
                'ordens_servicos.*',
                'formas_pagamentos.forma_pagamento_id as forma_pagamento_id',
                'formas_pagamentos.forma_pagamento_nome as forma_pagamento',
                'clientes.cliente_id as cliente_id',
                'clientes.cliente_cpf_cnpj as cliente_cpf_cnpj',
                'clientes.cliente_nome_razao as cliente_nome_razao',
                'clientes.cliente_sobrenome_fantasia as cliente_sobrenome_fantasia',
                'clientes.cliente_tipo as cliente_tipo',
            ]);

            $this->db->join('formas_pagamentos', 'formas_pagamentos.forma_pagamento_id = ordens_servicos.ordem_servico_forma_pagamento_id', 'LEFT');
            $this->db->join('clientes', 'clientes.cliente_id = ordens_servicos.ordem_servico_cliente_id', 'LEFT');

            $this->db->where('ordem_servico_id', $ordem_servico_id);

            return $this->db->get('ordens_servicos')->row();
        }
    }

    public function get_all() {
        $this->db->select([
            'ordens_servicos.*',
            'formas_pagamentos.forma_pagamento_id as forma_pagamento_id',
            'formas_pagamentos.forma_pagamento_nome as forma_pagamento',
            'clientes.cliente_id as cliente_id',
            'clientes.cliente_nome_razao as cliente',
        ]);

        $this->db->join('formas_pagamentos', 'formas_pagamentos.forma_pagamento_id = ordens_servicos.ordem_servico_forma_pagamento_id', 'LEFT');
        $this->db->join('clientes', 'clientes.cliente_id = ordens_servicos.ordem_servico_cliente_id', 'LEFT');

        return $this->db->get('ordens_servicos')->result();
    }

    public function get_all_servicos_by_ordem($ordem_servico_id= null) {
        if ($ordem_servico_id) {
            $this->db->select([
                'ordem_tem_servicos.*',
                'servicos.servico_nome as servico',
                'servicos.servico_descricao as servico_descricao' // FIXME: Verificar a necessidade
            ]);

            $this->db->join('servicos', 'servicos.servico_id = ordem_tem_servicos.ordem_ts_id_servico ', 'LEFT');
            $this->db->where('ordem_tem_servicos.ordem_ts_id_ordem_servico', $ordem_servico_id);

            return $this->db->get('ordem_tem_servicos')->result();
        }
    }

    public function delete_old_servicos($ordem_servico_id = null) {
        if ($ordem_servico_id) {
            $this->db->delete('ordem_tem_servicos', array('ordem_ts_id_ordem_servico' => $ordem_servico_id));
        }
    }
}