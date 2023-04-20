<?php

defined('BASEPATH') OR exit('Acesso não permitido.');

class Core_model extends CI_Model {
    public function get_all($tabela = null, $condicao = null) {
        if ($tabela) {
            if (is_array($condicao)) {
                $this->db->where($condicao);
            }
            
            return $this->db->get($tabela)->result();
        }

        return false;
    }

    public function get_by_id($tabela = null, $condicao = null) {
        if($tabela && is_array($condicao)) {
            $this->db->where($condicao);
            $this->db->limit(1);

            return $this->db->get($tabela)->row();
        }

        return  false;
    }

    public function insert($tabela = null, $data = null, $get_last_id = null) {
        if($tabela && is_array($data)) {
            $this->db->insert($tabela, $data);

            if ($get_last_id) {
                $this->session->set_userdata('last_id', $this->db->insert_id());
            }

            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('success', 'Informações salvas com sucesso.');
                return true;
            }
        }
        
        $this->session->set_flashdata('error', 'Falha na tentativa de salvar as informações.');
        return false;
    }

    public function update($tabela = null, $data = null, $condicao = null) {
        if ($tabela && is_array($data) && is_array($condicao)) {
            if ($this->db->update($tabela, $data, $condicao)) {
                $this->session->set_flashdata('success', 'Informações atualizadas com sucesso.');
                return true;
            }
        }
        
        $this->session->set_flashdata('error', 'Falha na tentativa de atualizar as informações.');
        return false;
    }

    public function delete($tabela = null, $condicao = null) {
        $this->db->db_debug = false;

        if ($tabela && is_array($condicao)) {
            $status = $this->db->delete($tabela, $condicao);
            $errors = $this->db->error();

            $this->db->db_debug = true;
            
            if (!$status) {
                foreach ($errors as $code) {
                    if ($code === 1451) {
                        $this->session->set_flashdata('error', 'Este registro não pode ser excluído, pois está em uso.');
                        return false;
                    }
                }
            }

            $this->session->set_flashdata('success', 'Registro excluído com sucesso.');
            return true;
        }

        $this->session->set_flashdata('error', 'Falha na tentativa de excluir o registro.');
        return false;
    }

    public function generate_unique_code($table = null, $type_of_code = null, $size_of_code = null, $field_search = null) {
        /**
         * @ Habilitar helper string
         * @param string $table
         * @param string $type_of_code. Ex.: 'numeric', 'alpha', 'alnum', 'basic', 'numeric', 'nozero', 'md5', 'sha1'
         * @param int $size_of_code
         * @param string $field_seach
         * @return int
         */
        do {
            $code = random_string($type_of_code, $size_of_code);
            $this->db->where($field_search, $code);
            $this->db->from($table);
        } while ($this->db->count_all_results() >= 1);

        return $code;
    }

    public function auto_complete_produtos($busca = null) {
        if (!$busca) {
            return false;
        }

        $this->db->like('produto_descricao', $busca, 'BOTH');
        $this->db->where('produto_ativo', 1);
        $this->db->where('produto_quantidade_estoque >', 0);

        return $this->db->get('produtos')->result();
    }

    public function auto_complete_servicos($busca = null) {
        if (!$busca) {
            return false;
        }

        $this->db->like('servico_nome', $busca);
        $this->db->where('servico_ativo', 1);

        return $this->db->get('servicos')->result();
    }

}