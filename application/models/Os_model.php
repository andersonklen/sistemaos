<?php
class Os_model extends CI_Model
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
        
        $this->db->select($fields.',tb_cliente.cliente_nome_razao');
        $this->db->from($table);
        $this->db->join('tb_cliente', 'tb_cliente.cliente_codigo = tb_os.os_clientes_codigo');
        $this->db->limit($perpage, $start);
        $this->db->order_by('os_codigo', 'desc');
        if ($where) {
            $this->db->where($where);
        }
        
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }


    function getOs($table, $fields, $where = '', $perpage = 0, $start = 0, $one = false, $array = 'array')
    {

        $lista_clientes = array();
        if ($where) {

            if (array_key_exists('pesquisa', $where)) {
                $this->db->select('cliente_codigo');
                $this->db->like('cliente_nome_razao', $where['pesquisa']);
                $this->db->limit(5);
                $clientes = $this->db->get('tb_cliente')->result();

                foreach ($clientes as $c) {
                    array_push($lista_clientes, $c->idClientes);
                }

            }
        }

        $this->db->select($fields.',tb_cliente.cliente_nome_razao, tb_usuario.usuario_nome');
        $this->db->from($table);
        $this->db->join('tb_cliente', 'tb_cliente.cliente_codigo = tb_os.os_cliente_codigo');
        $this->db->join('tb_usuario', 'tb_usuario.usuario_codigo = tb_os.os_usuario_codigo', 'left');

        // condicionais da pesquisa

        // condicional de status
        if (array_key_exists('os_status', $where)) {
            $this->db->where('os_status', $where['os_status']);
        }

        // condicional de clientes
        if (array_key_exists('pesquisa', $where)) {
            if ($lista_clientes != null) {
                $this->db->where_in('tb_os.os_cliente_codigo', $lista_clientes);
            }
        }

        // condicional data inicial
        if (array_key_exists('de', $where)) {
            $this->db->where('os_data_inicial >=', $where['de']);
        }
        // condicional data final
        if (array_key_exists('ate', $where)) {

            $this->db->where('os_data_final <=', $where['ate']);
        }
        
        $this->db->limit($perpage, $start);


        $this->db->order_by('tb_os.os_codigo', 'desc');
        $query = $this->db->get();

        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    function getById($id)
    {
        $this->db->select('tb_os.*, tb_cliente.*, tb_usuario.usuario_tel01, tb_usuario.usuario_email as email_responsavel,tb_usuario.usuario_nome');
        $this->db->from('tb_os');
        $this->db->join('tb_cliente', 'tb_cliente.cliente_codigo = tb_os.os_cliente_codigo');
        $this->db->join('tb_usuario', 'tb_usuario.usuario_codigo = tb_os.os_usuario_codigo');
        $this->db->where('tb_os.os_codigo', $id);
        $this->db->limit(1);
        return $this->db->get()->row();
    }

    public function getProdutos($id = null)
    {
        
        $this->db->select('tb_produto_os.*, tb_produto.*');
        $this->db->from('tb_produto_os');
        $this->db->join('tb_produto', 'tb_produto.produto_codigo = tb_produto_os.produto_os_produto_codigo');
        $this->db->where('produto_os_os_codigo', $id);
        return $this->db->get()->result();
    }

    public function getServicos($id = null)
    {
        $this->db->select('tb_servico_os.*, tb_servico.*');
        $this->db->from('tb_servico_os');
        $this->db->join('tb_servico', 'tb_servico.servico_codigo = tb_servico_os.servico_os_servico_codigo');
        $this->db->where('servico_os_os_codigo', $id);
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
                $row_set[] = array('label'=>$row['produto_descricao'].' | Preço: R$ '.$row['produto_preco_venda'].' | Estoque: '.$row['produto_estoque'],'estoque'=>$row['produto_estoque'],'id'=>$row['produto_codigo'],'preco'=>$row['produto_preco_venda']);
            }
            echo json_encode($row_set);
        }
    }

    public function autoCompleteProdutoSaida($q)
    {
        
        $this->db->select('*');
        $this->db->limit(5);
        $this->db->like('produto_descricao', $q);
        $this->db->where('produto_movimenta_saida', 1);
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
                $row_set[] = array('label'=>$row['cliente_nome_razao'].' | Tel. 1: '.$row['cliente_tel01'],'id'=>$row['cliente_codigo']);
            }
            echo json_encode($row_set);
        }
    }


    public function autoCompleteEquipamento($q)
    {

        $this->db->select('*');
        $this->db->limit(5);
        $this->db->like('equipamento_nome', $q);
        $query = $this->db->get('tb_equipamento');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $row_set[] = array('label'=>$row['equipamento_nome'].' - '.$row['equipamento_partnumber'],'id'=>$row['equipamento_codigo']);
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
                $row_set[] = array('label'=>$row['usuario_nome'].' | Tel 01: '.$row['usuario_tel01'],'id'=>$row['usuario_codigo']);
            }
            echo json_encode($row_set);
        }
    }

    public function autoCompleteServico($q)
    {

        $this->db->select('*');
        $this->db->limit(5);
        $this->db->like('servico_nome', $q);
        $query = $this->db->get('tb_servico');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $row_set[] = array('label'=>$row['servico_nome'].' | Preço: R$ '.$row['servico_preco'],'id'=>$row['servico_codigo'],'preco'=>$row['servico_preco']);
            }
            echo json_encode($row_set);
        }
    }


    public function anexar($os, $anexo, $url, $thumb, $path)
    {
        
        $this->db->set('anexo_nome', $anexo);
        $this->db->set('anexo_url', $url);
        $this->db->set('anexo_thumb', $thumb);
        $this->db->set('anexo_path', $path);
        $this->db->set('anexo_os_codigo', $os);

        return $this->db->insert('tb_anexo');
    }

    public function getAnexos($os)
    {
        
        $this->db->where('anexo_os_codigo', $os);
        return $this->db->get('tb_anexo')->result();
    }
}
