<?php

class Clientes extends CI_Controller
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
            $this->load->helper(array('codegen_helper'));
            $this->load->model('clientes_model', '', true);
            $this->data['menuClientes'] = 'clientes';
             // Debug
            // $this->output->enable_profiler(TRUE);
    }
    
    function index()
    {
        $this->gerenciar();
    }

    function gerenciar()
    {

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'vCliente')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para visualizar clientes.');
            redirect(base_url());
        }
        $this->load->library('table');
        $this->load->library('pagination');
        
   
        $config['base_url'] = base_url().'index.php/clientes/gerenciar/';
        $config['total_rows'] = $this->clientes_model->count('tb_cliente');
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
        
        $this->data['results'] = $this->clientes_model->get('tb_cliente', 'cliente_codigo,cliente_nome_razao,cliente_apelido_fantasia,cliente_cpf_cnpj,cliente_tel01,cliente_tel02,cliente_email,cliente_logradouro,cliente_numero,cliente_bairro,cliente_cidade,cliente_estado,cliente_cep', '', $config['per_page'], $this->uri->segment(3));
        
        $this->data['view'] = 'clientes/clientes';
        $this->load->view('tema/topo', $this->data);
      
       
        
    }
    
    function adicionar()
    {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'aCliente')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para adicionar clientes.');
            redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';


        if ($this->form_validation->run('clientes') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {

           // try {
                $datanascimento = $this->input->post('vw_cliente_data_nasc');
                $datanascimento = explode('/', $datanascimento);
                $datanascimento = $datanascimento[2].'-'.$datanascimento[1].'-'.$datanascimento[0];
            //}

            $data = array(
                'cliente_tipo' => set_value('vw_cliente_tipo'),
                'cliente_nome_razao' => set_value('vw_cliente_nome_razao'),
                'cliente_apelido_fantasia' => set_value('vw_cliente_apelido_fantasia'),
                'cliente_cpf_cnpj' => set_value('vw_cliente_cpf_cnpj'),
                'cliente_rg_inscricao' => set_value('vw_cliente_rg_inscricao'),
                'cliente_data_nascimento' =>  $datanascimento,                
                'cliente_sexo' => set_value('vw_cliente_genero'),                
                'cliente_tel01' => set_value('vw_cliente_tel01'),
                'cliente_tel02' => set_value('vw_cliente_tel02'),
                'cliente_email' => set_value('vw_cliente_email'),
                'cliente_cep' => set_value('vw_cliente_cep'),
                'cliente_logradouro' => set_value('vw_cliente_logradouro'),
                'cliente_numero' => set_value('vw_cliente_numero'),
                'cliente_bairro' => set_value('vw_cliente_bairro'),
                //'cidade' => set_value('cidade'),
                'cliente_cidade' => $this->input->post('vw_cliente_cidade'),//set_value('idCliente'),
                // 'usuarios_id' => $this->input->post('usuarios_id'),//set_value('idUsuario'),

                'cliente_estado' => set_value('vw_cliente_estado'),
                
                'cliente_data_cadastro' => date('Y-m-d H:i:s'),
                'cliente_data_alteracao' => date('Y-m-d H:i:s'),
                'cliente_deletado' => 'nao',
            );

            if ($this->clientes_model->add('tb_cliente', $data) == true) {
                $this->session->set_flashdata('success', 'Cliente adicionado com sucesso!');
                redirect(base_url() . 'index.php/clientes/adicionar/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }
        $this->data['view'] = 'clientes/adicionarCliente';
        $this->load->view('tema/topo', $this->data);

    }

    function editar()
    {

        if (!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))) {
            $this->session->set_flashdata('error', 'Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('mapos');
        }


        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para editar clientes.');
            redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('clientes') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = array(
                'cliente_nome_razao' => $this->input->post('vw_cliente_nome_razao'),
                'cliente_cpf_cnpj' => $this->input->post('vw_cpf_cnpj'),
                'cliente_tel01' => $this->input->post('vw_tel01'),
                'cliente_tel02' => $this->input->post('vw_tel02'),
                'cliente_email' => $this->input->post('vw_email'),
                'cliente_logradouro' => $this->input->post('vw_logradouro'),
                'cliente_numero' => $this->input->post('vw_numero'),
                'cliente_bairro' => $this->input->post('vw_bairro'),
                'cliente_cidade' => $this->input->post('vw_cidade'),
                'cliente_estado' => $this->input->post('vw_estado'),
                'cliente_cep' => $this->input->post('vw_cep')
            );

            if ($this->clientes_model->edit('tb_cliente', $data, 'cliente_codigo', $this->input->post('idClientes')) == true) {
                $this->session->set_flashdata('success', 'Cliente editado com sucesso!');
                redirect(base_url() . 'index.php/clientes/editar/'.$this->input->post('idClientes'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro</p></div>';
            }
        }


        $this->data['result'] = $this->clientes_model->getById($this->uri->segment(3));
        $this->data['view'] = 'clientes/editarCliente';
        $this->load->view('tema/topo', $this->data);

    }

    public function visualizar()
    {

        if (!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))) {
            $this->session->set_flashdata('error', 'Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('mapos');
        }

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'vCliente')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para visualizar clientes.');
            redirect(base_url());
        }

        $this->data['custom_error'] = '';
        $this->data['result'] = $this->clientes_model->getById($this->uri->segment(3));
        $this->data['results'] = $this->clientes_model->getOsByCliente($this->uri->segment(3));
        $this->data['view'] = 'clientes/visualizar';
        $this->load->view('tema/topo', $this->data);

        
    }
    
    public function excluir()
    {

            
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'dCliente')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para excluir clientes.');
            redirect(base_url());
        }

            
            $id =  $this->input->post('id');
        if ($id == null) {

            $this->session->set_flashdata('error', 'Erro ao tentar excluir cliente.');
            redirect(base_url().'index.php/clientes/gerenciar/');
        }

            //$id = 2;
            // excluindo OSs vinculadas ao cliente
            $this->db->where('os_cliente_codigo', $id);
            $os = $this->db->get('tb_os')->result();

        if ($os != null) {

            foreach ($os as $o) {
                // Exclui os serviços da OS.
                $this->db->where('servico_os_codigo', $o->idOs);
                $this->db->delete('tb_servicos_os');

                // Exclui os produtos da OS.
                $this->db->where('produto_os_codigo', $o->idOs);
                $this->db->delete('tb_produtos_os');

                // Exclui a OS.
                $this->db->where('os_codigo', $o->idOs);
                $this->db->delete('tb_os');
            }
        }

            // excluindo Vendas vinculadas ao cliente
            $this->db->where('venda_cliente_codigo', $id);
            $vendas = $this->db->get('tb_venda')->result();

        if ($vendas != null) {

            foreach ($vendas as $v) {
                $this->db->where('vendas_id', $v->idVendas);
                $this->db->delete('itens_de_vendas');


                $this->db->where('idVendas', $v->idVendas);
                $this->db->delete('vendas');
            }
        }

            //excluindo receitas vinculadas ao cliente
            $this->db->where('lancamento_cliente_codigo', $id);
            $this->db->delete('tb_lancamento');


            $data = array(
               'cliente_data_alteracao' => date('Y-m-d H:i:s'),
               'cliente_deletado' => 'sim'
            );

            $this->clientes_model->edit('tb_cliente', $data, 'cliente_codigo', $id);
            //$this->clientes_model->delete('tb_cliente', 'cliente_codigo', $id);

            $this->session->set_flashdata('success', 'Cliente excluido com sucesso!');
            redirect(base_url().'index.php/clientes/gerenciar/');
    }



    public function autoCompleteCidade()
    {
        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            $this->clientes_model->autoCompleteCidade($q);
        }

    }  
}

