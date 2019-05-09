<?php
class Usuarios_model extends CI_Model
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

    

    function get($perpage = 0, $start = 0, $one = false)
    {
        
        $this->db->from('tb_usuario');
        $this->db->select('tb_usuario.*, tb_permissoes.permissoes_nome as permissao');
        $this->db->limit($perpage, $start);
        $this->db->join('tb_permissoes', 'tb_usuario.usuario_permissoes_codigo = tb_permissoes.permissoes_codigo', 'left');
  
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    function getAllTipos()
    {
        $this->db->where('usuario_situacao', 1);
        return $this->db->get('tiposUsuario')->result();
    }

    function getById($id)
    {
        $this->db->where('usuario_codigo', $id);
        $this->db->limit(1);
        return $this->db->get('tb_usuario')->row();
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
}
