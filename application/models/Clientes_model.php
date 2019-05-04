<?php
class Clientes_model extends CI_Model
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
        $this->db->order_by('cliente_codigo', 'desc');
        $this->db->limit($perpage, $start);
        if ($where) {
            $this->db->where($where);
        }
        
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    function getById($id)
    {
        $this->db->where('cliente_codigo', $id);
        $this->db->limit(1);
        return $this->db->get('tb_cliente')->row();
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
    
    public function getOsByCliente($id)
    {
        $this->db->where('os_cliente_codigo', $id);
        $this->db->order_by('os_codigo', 'desc');
        $this->db->limit(10);
        return $this->db->get('tb_os')->result();
    }


    public function autoCompleteCidade($q)
    // public function autoCompleteCidade($q)
    {
        $this->db->select('*');
        $this->db->from('tb_cidade');
        $this->db->join('tb_estado', 'tb_cidade.cidade_estado_codigo  = tb_estado.estado_codigo');
        $this->db->limit(5);
        $this->db->like('cidade_nome', $q);
        $query = $this->db->get();

        


      
     //   $this->db->select('vendas.*,usuarios.nome');
     //   $this->db->from('vendas');
     //   $this->db->join('usuarios', 'usuarios.idUsuarios = vendas.usuarios_id');
     //   $this->db->where('clientes_id', $cliente);
     //   $this->db->limit(5);

     //   return $this->db->get()->result();



        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                //echo print_r($row);
                $row_set[] = array('label'=>$row['cidade_nome'].' - '.$row['estado_uf'],'id'=>$row['cidade_codigo']);
            }    
            echo json_encode($row_set);
        }
    }
}
