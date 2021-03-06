<?php
class Produtos_model extends CI_Model
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
        
        $this->db->select($fields);
        $this->db->from($table);
        $this->db->order_by('produto_codigo', 'desc');
        $this->db->limit($perpage, $start);
        $this->db->join('tb_marca', 'tb_marca.marca_codigo = '.$table.'.produto_marca_codigo');
        if ($where) {
            $this->db->where($where);
        }
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        
        return $result;






        
        //$this->db->select($fields.', tb_cliente.cliente_nome_razao, tb_cliente.cliente_codigo');
        //$this->db->from($table);
        //$this->db->limit($perpage, $start);
       /// $this->db->join('tb_cliente', 'tb_cliente.cliente_codigo = '.$table.'.venda_cliente_codigo');
       // $this->db->order_by('venda_codigo', 'desc');
       // if ($where) {
       //     $this->db->where($where);
       // }
      //  
      //  $query = $this->db->get();
      //  
      //  $result =  !$one  ? $query->result() : $query->row();
      //  return $result;





    }

    function getById($id)
    {
        $this->db->where('produto_codigo', $id);
        $this->db->limit(1);
        $this->db->join('tb_marca', 'tb_marca.marca_codigo = tb_produto.produto_marca_codigo');
        return $this->db->get('tb_produto')->row();
    }
    
    function add($table, $data)
    {
        $this->db->insert($table, $data);
        if ($this->db->affected_rows() == '1') {
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

    public function autoCompleteMarca($q)
    {
        $this->db->select('*');
        $this->db->limit(5);
        $this->db->where('marca_deletado', 'nao');
        $this->db->like('marca_nome', $q);
        $query = $this->db->get('tb_marca');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $row_set[] = array('label'=>$row['marca_nome'],'id'=>$row['marca_codigo']);
            }
            echo json_encode($row_set);
        }
    }

}
