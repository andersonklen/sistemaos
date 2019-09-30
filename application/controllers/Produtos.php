<?php

class Produtos extends CI_Controller
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

        $this->load->helper(array('form', 'codegen_helper'));
        $this->load->model('produtos_model', '', true);
        $this->data['menuProdutos'] = 'Produtos';
    }

    function index()
    {
        $this->gerenciar();
    }

    function gerenciar()
    {
        
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'vProduto')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para visualizar produtos.');
            redirect(base_url());
        }

        $this->load->library('table');
        $this->load->library('pagination');
        
        
        $config['base_url'] = base_url().'index.php/produtos/gerenciar/';
        $config['total_rows'] = $this->produtos_model->count('tb_produto');
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

        $this->data['results'] = $this->produtos_model->get('tb_produto', 'produto_codigo,produto_descricao,produto_partnumber,produto_unid_medida,produto_preco_compra,produto_preco_venda,produto_estoque_atual,produto_estoque_minimo,produto_deletado,marca_nome', 'produto_deletado=\'NAO\'', $config['per_page'], $this->uri->segment(3));
       
       
        $this->data['view'] = 'produtos/produtos';
        $this->load->view('tema/topo', $this->data);
       
        
    }
    
    function adicionar()
    {

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'aProduto')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para adicionar produtos.');
            redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('produtos') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $produto_preco_compra = $this->input->post('vw_produto_preco_compra');
            $produto_preco_compra = str_replace(",", "", $produto_preco_compra);
            $produto_preco_venda = $this->input->post('vw_produto_preco_venda');
            $produto_preco_venda = str_replace(",", "", $produto_preco_venda);
            $data = array(
                'produto_marca_codigo' => set_value('vw_produto_marca_id'),
                'produto_descricao' => set_value('vw_produto_descricao'),
                'produto_partnumber' => set_value('vw_produto_partnumber'),                
                'produto_unid_medida' => set_value('vw_produto_unid_medida'),
                'produto_preco_compra' => $produto_preco_compra,
                'produto_preco_venda' => $produto_preco_venda,
                'produto_estoque_atual' => set_value('vw_produto_estoque_atual'),
                'produto_estoque_minimo' => set_value('vw_produto_estoque_minimo'),
                'produto_movimenta_saida' => set_value('vw_produto_movimenta_saida'),
                'produto_movimenta_entrada' => set_value('vw_produto_movimenta_entrada'),                
                'produto_situacao' => 'ativo',
                'produto_data_cadastro' => date('Y-m-d H:i:s'),            
                'produto_data_ultima_alteracao' => date('Y-m-d H:i:s'),
                'produto_deletado' => 'nao',
            );

            if ($this->produtos_model->add('tb_produto', $data) == true) {
                $this->session->set_flashdata('success', 'Produto adicionado com sucesso!');
                redirect(base_url() . 'index.php/produtos/adicionar/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>An Error Occured.</p></div>';
            }
        }
        $this->data['view'] = 'produtos/adicionarProduto';
        $this->load->view('tema/topo', $this->data);
     
    }

    function editar()
    {

        if (!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))) {
            $this->session->set_flashdata('error', 'Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('mapos');
        }

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'eProduto')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para editar produtos.');
            redirect(base_url());
        }
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('produtos') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $produto_preco_compra = $this->input->post('vw_produto_preco_compra');
            $produto_preco_compra = str_replace(",", "", $produto_preco_compra);
            $produto_preco_venda = $this->input->post('vw_produto_preco_venda');
            $produto_preco_venda = str_replace(",", "", $produto_preco_venda);
            $data = array(
                'produto_marca_codigo' => $this->input->post('vw_produto_marca_id'),
                'produto_descricao' => $this->input->post('vw_produto_descricao'),
                'produto_partnumber' => $this->input->post('vw_produto_partnumber'),                
                'produto_unid_medida' => $this->input->post('vw_produto_unid_medida'),
                'produto_preco_compra' => $produto_preco_compra,
                'produto_preco_venda' => $produto_preco_venda,
                'produto_estoque_atual' => $this->input->post('vw_produto_estoque_atual'),
                'produto_estoque_minimo' => $this->input->post('vw_produto_estoque_minimo'),
                'produto_movimenta_saida' => $this->input->post('vw_produto_movimenta_saida'),
                'produto_movimenta_entrada' => $this->input->post('vw_produto_movimenta_entrada'),
                'produto_situacao' => 'ativo',      
                'produto_data_ultima_alteracao' => date('Y-m-d H:i:s')                
            );
            //print_r($data);
            //    exit;

            if ($this->produtos_model->edit('tb_produto', $data, 'produto_codigo', $this->input->post('vw_produto_codigo')) == true) {
                $this->session->set_flashdata('success', 'Produto editado com sucesso!');
                redirect(base_url() . 'index.php/produtos/editar/'.$this->input->post('vw_produto_codigo'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>An Error Occured</p></div>';
            }
        }

        $this->data['result'] = $this->produtos_model->getById($this->uri->segment(3));

        $this->data['view'] = 'produtos/editarProduto';
        $this->load->view('tema/topo', $this->data);
     
    }


    function visualizar()
    {
        
        if (!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))) {
            $this->session->set_flashdata('error', 'Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('mapos');
        }
        
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'vProduto')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para visualizar produtos.');
            redirect(base_url());
        }

        $this->data['result'] = $this->produtos_model->getById($this->uri->segment(3));

        if ($this->data['result'] == null) {
            $this->session->set_flashdata('error', 'Produto não encontrado.');
            redirect(base_url() . 'index.php/produtos/editar/'.$this->input->post('produto_codigo'));
        }

        $this->data['view'] = 'produtos/visualizarProduto';
        $this->load->view('tema/topo', $this->data);
     
    }
    
    function excluir()
    {

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'dProduto')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para excluir produtos.');
            redirect(base_url());
        }

        
        $id =  $this->input->post('id');
        if ($id == null) {

            $this->session->set_flashdata('error', 'Erro ao tentar excluir produto.');
            redirect(base_url().'index.php/produtos/gerenciar/');
        }

        // $this->db->where('produto_codigo', $id);
        // $this->db->delete('produtos_os');


        // $this->db->where('produto_codigo', $id);
        // $this->db->delete('itens_de_vendas');
        
        // $this->produtos_model->delete('tb_produto', 'produto_codigo', $id);
        
        $data = array( 
                    'produto_deletado'      => 'sim', 
                    'produto_data_ultima_alteracao' =>  date('Y-m-d H:i:s'),
                    );
                    $this->db->where('produto_codigo', $id);
                    $this->db->update('tb_produto', $data); 
        
        

        $this->session->set_flashdata('success', 'Produto excluido com sucesso!');
        redirect(base_url().'index.php/produtos/gerenciar/');
    }


    public function autoCompleteMarca()
    {
        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            $this->produtos_model->autoCompleteMarca($q);
        }

    } 

}
