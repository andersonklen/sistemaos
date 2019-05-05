<?php
class Mapos_model extends CI_Model
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
        $this->db->from('tb_usuario');
        $this->db->select('usuario.*, tb_permissoes.nome as tb_permissao');
        $this->db->join('tb_permissoes', 'tb_permissoes.permissoes_codigo = tb_usuario.permissoes_codigo', 'left');
        $this->db->where('usuario_codigo', $id);
        $this->db->limit(1);
        return $this->db->get()->row();
    }

    public function alterarSenha($senha)
    {
        $this->db->set('usuario_senha', password_hash($senha, PASSWORD_DEFAULT));
        $this->db->where('usuario_codigo',  $this->session->userdata('id'));
        $this->db->update('tb_usuario');

        if ($this->db->affected_rows() >= 0) {
            return true;
        }
        return false;
    }

    function pesquisar($termo)
    {
         $data = array();
         // buscando clientes
         $this->db->like('cliente_nome_razao', $termo);
         $this->db->limit(5);
         $data['tb_cliente'] = $this->db->get('tb_cliente')->result();

         // buscando os
         $this->db->like('os_codigo', $termo);
         $this->db->limit(5);
         $data['tb_os'] = $this->db->get('os')->result();

         // buscando produtos
         $this->db->like('produto_descricao', $termo);
         $this->db->limit(5);
         $data['tb_produto'] = $this->db->get('tb_produto')->result();

         //buscando serviços
         $this->db->like('servico_nome', $termo);
         $this->db->limit(5);
         $data['servicos'] = $this->db->get('tb_servico')->result();

         return $data;


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

    function getOsAbertas()
    {
        $this->db->select('tb_os.*, tb_cliente.cliente_nome_razao');
        $this->db->from('tb_os');
        $this->db->join('tb_cliente', 'tb_cliente.cliente_codigo = tb_os.os_cliente_codigo');
        $this->db->where('tb_os.os_status', 'Aberto');
        $this->db->limit(10);
        return $this->db->get()->result();
    }

    function getProdutosMinimo()
    {

        $sql = "SELECT * FROM tb_produto WHERE produto_estoque_atual <= produto_estoque_minimo LIMIT 10";
        return $this->db->query($sql)->result();

    }

    function getOsEstatisticas()
    {
        $sql = "SELECT os_status, COUNT(os_status) as total FROM tb_os GROUP BY os_status ORDER BY os_status";
        return $this->db->query($sql)->result();
    }

    public function getEstatisticasFinanceiro()
    {
        $sql = "SELECT SUM(CASE WHEN lancamento_baixado = 1 AND lancamento_tipo = 'receita' THEN lancamento_valor END) as total_receita, 
                       SUM(CASE WHEN lancamento_baixado = 1 AND lancamento_tipo = 'despesa' THEN lancamento_valor END) as total_despesa,
                       SUM(CASE WHEN lancamento_baixado = 0 AND lancamento_tipo = 'receita' THEN lancamento_valor END) as total_receita_pendente,
                       SUM(CASE WHEN lancamento_baixado = 0 AND lancamento_tipo = 'despesa' THEN lancamento_valor END) as total_despesa_pendente FROM tb_lancamento";
        return $this->db->query($sql)->row();
    }


    public function getEmitente()
    {
        return $this->db->get('tb_emitente')->result();
    }

    public function addEmitente($nome, $cnpj, $ie, $logradouro, $numero, $bairro, $cidade, $uf, $telefone, $email, $logo)
    {
       
        $this->db->set('emitente_nome', $nome);
        $this->db->set('emitente_cnpj', $cnpj);
        $this->db->set('emitente_ie', $ie);
        $this->db->set('emitente_logradouro', $logradouro);
        $this->db->set('emitente_numero', $numero);
        $this->db->set('emitente_bairro', $bairro);
        $this->db->set('emitente_cidade', $cidade);
        $this->db->set('emitente_uf', $uf);
        $this->db->set('emitente_tel01', $telefone);
        $this->db->set('emitente_email', $email);
        $this->db->set('emitente_url_logo', $logo);
        return $this->db->insert('tb_emitente');
    }


    public function editEmitente($id, $nome, $cnpj, $ie, $logradouro, $numero, $bairro, $cidade, $uf, $telefone, $email)
    {
        
        $this->db->set('emitente_nome', $nome);
        $this->db->set('emitente_cnpj', $cnpj);
        $this->db->set('emitente_ie', $ie);
        $this->db->set('emitente_logradouro', $logradouro);
        $this->db->set('emitente_numero', $numero);
        $this->db->set('emitente_bairro', $bairro);
        $this->db->set('emitente_cidade', $cidade);
        $this->db->set('emitente_uf', $uf);
        $this->db->set('emitente_tel01', $telefone);
        $this->db->set('emitente_email', $email);
        $this->db->where('emitente_codigo', $id);
        return $this->db->update('tb_emitente');
    }


    public function editLogo($id, $logo)
    {
        
        $this->db->set('emitente_url_logo', $logo);
        $this->db->where('emitente_codigo', $id);
        return $this->db->update('tb_emitente');
         
    }

    public function check_credentials($email)
    {
        $this->db->where('usuario_email', $email);
        $this->db->where('usuario_situacao', 1);
        $this->db->limit(1);
        return $this->db->get('tb_usuario')->row();
    }
}
