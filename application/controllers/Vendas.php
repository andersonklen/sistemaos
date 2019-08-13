<?php

class Vendas extends CI_Controller
{
    

    /**
     * author: Ramon Silva
     * email: silva018-mg@yahoo.com.br
     *
     */
    
    function __construct()
    {
        parent::__construct();
        
        if ((!session_id()) || (!$this->session->userdata('logado'))) {
            redirect('mapos/login');
        }
        
        $this->load->helper(array('form','codegen_helper'));
        $this->load->model('vendas_model', '', true);
        $this->data['menuVendas'] = 'Vendas';
    }
    
    function index()
    {
        $this->gerenciar();
    }

    function gerenciar()
    {
        
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'vVenda')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para visualizar vendas.');
            redirect(base_url());
        }

        $this->load->library('pagination');
        
        
        $config['base_url'] = base_url().'index.php/vendas/gerenciar/';
        $config['total_rows'] = $this->vendas_model->count('tb_venda');
        $config['per_page'] = 10;
        $config['next_link'] = 'Próxima';
        $config['prev_link'] = 'Anterior';
        $config['full_tag_open'] = '<div class="pagination alternate"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li><a style="color: #2D335B"><b>';
        $config['cur_tag_close'] = '</b></a></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['first_link'] = 'Primeira';
        $config['last_link'] = 'Última';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
            
        $this->pagination->initialize($config);

        $this->data['results'] = $this->vendas_model->get('tb_venda', '*', '', $config['per_page'], $this->uri->segment(3));
       
        $this->data['view'] = 'vendas/vendas';
        $this->load->view('tema/topo', $this->data);
      
        
    }
    
    function adicionar()
    {

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'aVenda')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para adicionar Vendas.');
            redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
        
        if ($this->form_validation->run('vendas') == false) {
            $this->data['custom_error'] = (validation_errors() ? true : false);
        } else {

            $dataVenda = $this->input->post('dataVenda');

            try {
                
                $dataVenda = explode('/', $dataVenda);
                $dataVenda = $dataVenda[2].'-'.$dataVenda[1].'-'.$dataVenda[0];


            } catch (Exception $e) {
                $dataVenda = date('Y/m/d');
            }

            $data = array(
                'venda_data_venda' => $dataVenda,
                'venda_cliente_codigo' => $this->input->post('clientes_id'),
                'venda_usuario_codigo' => $this->input->post('usuarios_id'),
                'venda_faturado' => 0
            );

            if (is_numeric($id = $this->vendas_model->add('tb_venda', $data, true))) {
                $this->session->set_flashdata('success', 'Venda iniciada com sucesso, adicione os produtos.');
                redirect('vendas/editar/'.$id);

            } else {
                
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }
         
        $this->data['view'] = 'vendas/adicionarVenda';
        $this->load->view('tema/topo', $this->data);
    }
    

    
    function editar()
    {

        if (!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))) {
            $this->session->set_flashdata('error', 'Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('mapos');
        }

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'eVenda')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para editar vendas');
            redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('tb_venda') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {

            $dataVenda = $this->input->post('dataVenda');

            try {
                
                $dataVenda = explode('/', $dataVenda);
                $dataVenda = $dataVenda[2].'-'.$dataVenda[1].'-'.$dataVenda[0];


            } catch (Exception $e) {
                $dataVenda = date('Y/m/d');
            }

            $data = array(
                'venda_data_venda' => $dataVenda,
                'venda_usuario_codigo' => $this->input->post('usuarios_id'),
                'venda_cliente_codigo' => $this->input->post('clientes_id')
            );

            if ($this->vendas_model->edit('tb_venda', $data, 'venda_codigo', $this->input->post('idVendas')) == true) {
                $this->session->set_flashdata('success', 'Venda editada com sucesso!');
                redirect(base_url() . 'index.php/vendas/editar/'.$this->input->post('idVendas'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro</p></div>';
            }
        }

        $this->data['result'] = $this->vendas_model->getById($this->uri->segment(3));
        $this->data['produtos'] = $this->vendas_model->getProdutos($this->uri->segment(3));
        $this->data['view'] = 'vendas/editarVenda';
        $this->load->view('tema/topo', $this->data);
   
    }

    public function visualizar()
    {

        if (!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))) {
            $this->session->set_flashdata('error', 'Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('mapos');
        }
        
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'vVenda')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para visualizar vendas.');
            redirect(base_url());
        }

        $this->data['custom_error'] = '';
        $this->load->model('mapos_model');
        $this->data['result'] = $this->vendas_model->getById($this->uri->segment(3));
        $this->data['produtos'] = $this->vendas_model->getProdutos($this->uri->segment(3));
        $this->data['emitente'] = $this->mapos_model->getEmitente();
        
        $this->data['view'] = 'vendas/visualizarVenda';
        $this->load->view('tema/topo', $this->data);
       
    }

    public function imprimir()
    {
        
        if (!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))) {
            $this->session->set_flashdata('error', 'Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('mapos');
        }
        
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'vVenda')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para visualizar vendas.');
            redirect(base_url());
        }

        $this->data['custom_error'] = '';
        $this->load->model('mapos_model');
        $this->data['result'] = $this->vendas_model->getById($this->uri->segment(3));
        $this->data['produtos'] = $this->vendas_model->getProdutos($this->uri->segment(3));
        $this->data['emitente'] = $this->mapos_model->getEmitente();
        
        $this->load->view('vendas/imprimirVenda', $this->data);
        
    }
    
    public function excluir()
    {

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'dVenda')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para excluir vendas');
            redirect(base_url());
        }
        
        $id =  $this->input->post('id');
        if ($id == null) {

            $this->session->set_flashdata('error', 'Erro ao tentar excluir venda.');
            redirect(base_url().'index.php/vendas/gerenciar/');
        }

        $this->db->where('item_de_venda_codigo', $id);
        $this->db->delete('tb_item_de_venda');

        $this->db->where('venda_codigo', $id);
        $this->db->delete('tb_venda');

        $this->session->set_flashdata('success', 'Venda excluída com sucesso!');
        redirect(base_url().'index.php/vendas/gerenciar/');

    }

    public function autoCompleteProduto()
    {
        
        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            $this->vendas_model->autoCompleteProduto($q);
        }

    }

    public function autoCompleteCliente()
    {

        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            $this->vendas_model->autoCompleteCliente($q);
        }

    }

    public function autoCompleteUsuario()
    {

        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            $this->vendas_model->autoCompleteUsuario($q);
        }

    }



    public function adicionarProduto()
    {

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'eVenda')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para editar vendas.');
            redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('quantidade', 'Quantidade', 'trim|required');
        $this->form_validation->set_rules('idProduto', 'Produto', 'trim|required');
        $this->form_validation->set_rules('idVendasProduto', 'Vendas', 'trim|required');
        
        if ($this->form_validation->run() == false) {
            echo json_encode(array('result'=> false));
        } else {

            $preco = $this->input->post('preco');
            $quantidade = $this->input->post('quantidade');
            $subtotal = $preco * $quantidade;
            $produto = $this->input->post('idProduto');
            $data = array(
                'item_de_venda_quantidade'=> $quantidade,
                'item_de_venda_subtotal'=> $subtotal,
                'item_de_venda_produto_codigo'=> $produto,
                'item_de_venda_venda_codigo'=> $this->input->post('idVendasProduto'),
            );

            if ($this->vendas_model->add('tb_item_de_venda', $data) == true) {
               $sql = "UPDATE tb_produto set produto_estoque_atual = produto_estoque_atual - ? WHERE produto_codigo = ?";
               $this->db->query($sql, array($quantidade, $produto));
                
                echo json_encode(array('result'=> true));
            } else {
                echo json_encode(array('result'=> false));
            }

        }
        
      
    }

    function excluirProduto()
    {

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'eVenda')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para editar Vendas');
            redirect(base_url());
        }

            $ID = $this->input->post('idProduto');
        if ($this->vendas_model->delete('tb_item_de_venda', 'item_de_venda_codigo', $ID) == true) {
                
            $quantidade = $this->input->post('quantidade');
            $produto = $this->input->post('produto');


            $sql = "UPDATE tb_produto set produto_estoque_atual = produto_estoque_atual + ? WHERE produto_codigo = ?";

            $this->db->query($sql, array($quantidade, $produto));
                
            echo json_encode(array('result'=> true));
        } else {
            echo json_encode(array('result'=> false));
        }
    }



    public function faturar()
    {

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'eVenda')) {
              $this->session->set_flashdata('error', 'Você não tem permissão para editar Vendas');
              redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
 

        if ($this->form_validation->run('receita') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {

            $venda_id = $this->input->post('vendas_id');
            $vencimento = $this->input->post('vencimento');
            $recebimento = $this->input->post('recebimento');

            try {
                
                $vencimento = explode('/', $vencimento);
                $vencimento = $vencimento[2].'-'.$vencimento[1].'-'.$vencimento[0];

                if ($recebimento != null) {
                    $recebimento = explode('/', $recebimento);
                    $recebimento = $recebimento[2].'-'.$recebimento[1].'-'.$recebimento[0];

                }
            } catch (Exception $e) {
                $vencimento = date('Y/m/d');
            }

            $data = array(
                'lancamento_venda_codigo' => $venda_id,
                'lancamento_descricao' => set_value('descricao'),
                'lancamento_valor' => $this->input->post('valor'),
                'lancamento_cliente_codigo' => $this->input->post('clientes_id'),
                'lancamento_data_vencimento' => $vencimento,
                'lancamento_data_pagamento' => $recebimento,
                'lancamento_baixado' => $this->input->post('recebido'),
                'lancamento_cliente_fornecedor' => set_value('cliente'),
                'lancamento_forma_pgto' => $this->input->post('formaPgto'),
                'lancamento_tipo' => $this->input->post('tipo')
            );

            if ($this->vendas_model->add('tb_lancamento', $data) == true) {
                
                $venda = $this->input->post('vendas_id');

                $this->db->set('venda_faturado', 1);
                $this->db->set('venda_valor_total', $this->input->post('valor'));
                $this->db->where('venda_codigo', $venda);
                $this->db->update('tb_venda');

                $this->session->set_flashdata('success', 'Venda faturada com sucesso!');
                $json = array('result'=>  true);
                echo json_encode($json);
                die();
            } else {
                $this->session->set_flashdata('error', 'Ocorreu um erro ao tentar faturar venda.');
                $json = array('result'=>  false);
                echo json_encode($json);
                die();
            }
        }

        $this->session->set_flashdata('error', 'Ocorreu um erro ao tentar faturar venda.');
        $json = array('result'=>  false);
        echo json_encode($json);
        
    }
}
