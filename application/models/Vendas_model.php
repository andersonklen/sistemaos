<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Vendas_model extends CI_Model
{

    /**
     * author: Ramon Silva
     * email: silva018-mg@yahoo.com.br
     *
     */

    function __construct()
    {
        parent::__construct();
    }

    
    function get($table, $fields, $where = '', $perpage = 0, $start = 0, $one = false, $array = 'array')
    {
        
        $this->db->select($fields.', tb_cliente.cliente_nome_razao, tb_cliente.cliente_codigo');
        $this->db->from($table);
        $this->db->limit($perpage, $start);
        $this->db->join('tb_cliente', 'tb_cliente.cliente_codigo = '.$table.'.venda_cliente_codigo');
        $this->db->order_by('venda_codigo', 'desc');
        if ($where) {
            $this->db->where($where);
        }
        
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    function getById($id)
    {
        $this->db->select('tb_venda.*, tb_cliente.*, tb_lancamento.lancamento_data_vencimento, tb_usuario.usuario_tel01, tb_usuario.usuario_codigo,tb_usuario.usuario_nome');
        $this->db->from('tb_venda');
        $this->db->join('tb_cliente', 'tb_cliente.cliente_codigo = tb_venda.venda_cliente_codigo');
        $this->db->join('tb_usuario', 'tb_usuario.usuario_codigo = tb_venda.venda_usuario_codigo');
        $this->db->join('tb_lancamento', 'tb_venda.venda_codigo = tb_lancamento.lancamento_venda_codigo', 'LEFT');
        $this->db->where('tb_venda.venda_codigo', $id);
        $this->db->limit(1);
        return $this->db->get()->row();
    }

    public function getProdutos($id = null)
    {
        $this->db->select('tb_item_de_venda.*, tb_produto.*');
        $this->db->from('tb_item_de_venda');
        $this->db->join('tb_produto', 'tb_produto.produto_codigo = tb_item_de_venda.item_de_venda_produto_codigo');
        $this->db->where('item_de_venda_venda_codigo', $id);
        return $this->db->get()->result();
    }

    
    function add($table, $data, $returnId = false)
    {
        $this->db->insert($table, $data);
        if ($this->db->affected_rows() == '1') {
            if ($returnId == true) {
                return $this->db->insert_id($table);
            }
            return true;
        }
        
        return false;
    }
    
    function edit($table, $data, $fieldID, $ID)
    {
        $this->db->where($fieldID, $ID);
        $this->db->update($table, $data);

        if ($this->db->affected_rows() >= 0) {
            return true;
        }
        
        return false;
    }
    
    function delete($table, $fieldID, $ID)
    {
        $this->db->where($fieldID, $ID);
        $this->db->delete($table);
        if ($this->db->affected_rows() == '1') {
            return true;
        }
        
        return false;
    }

    function count($table)
    {
        return $this->db->count_all($table);
    }

    public function autoCompleteProduto($q)
    {

        $this->db->select('*');
        $this->db->limit(5);
        $this->db->like('produto_descricao', $q);
        $query = $this->db->get('tb_produto');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $row_set[] = array('label'=>$row['produto_descricao'].' | Preço: R$ '.$row['produto_preco_venda'].' | Estoque: '.$row['produto_estoque_atual'],'estoque'=>$row['produto_estoque_atual'],'id'=>$row['produto_codigo'],'preco'=>$row['produto_preco_venda']);
            }
            echo json_encode($row_set);
        }
    }

    public function autoCompleteCliente($q)
    {

        $this->db->select('*');
        $this->db->limit(5);
        $this->db->like('cliente_nome_razao', $q);
        $query = $this->db->get('tb_cliente');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $row_set[] = array('label'=>$row['cliente_nome_razao'].' | Telefone: '.$row['cliente_tel01'],'id'=>$row['cliente_codigo']);
            }
            echo json_encode($row_set);
        }
    }

    public function autoCompleteUsuario($q)
    {

        $this->db->select('*');
        $this->db->limit(5);
        $this->db->like('usuario_nome', $q);
        $this->db->where('usuario_situacao', 1);
        $query = $this->db->get('tb_usuario');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $row_set[] = array('label'=>$row['usuario_nome'].' | Telefone: '.$row['usuario_tel01'],'id'=>$row['usuario_codigo']);
            }
            echo json_encode($row_set);
        }
    }
}

/* End of file vendas_model.php */
/* Location: ./application/models/vendas_model.php */
