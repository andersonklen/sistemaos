<?php

class Marcas extends CI_Controller
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
        $this->load->model('marcas_model', '', true);
        $this->data['menuMarcas'] = 'Marcas';
    
}
    



    function index()
    {
        $this->gerenciar();

    }

    function gerenciar()
    {
     //echo "teste2";

      //if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'vMarcas')) {
      //    $this->session->set_flashdata('error', 'Você não tem permissão para visualizar serviços.');
      //    redirect(base_url());     
      //   
      //  }

        $this->load->library('pagination');
        
        
        $config['base_url'] = base_url().'index.php/marcas/gerenciar/';
        $config['total_rows'] = $this->marcas_model->count('tb_marca');
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

        $this->data['results'] = $this->marcas_model->get('tb_marca', 'marca_codigo,marca_nome,marca_situacao', '', $config['per_page'], $this->uri->segment(3));
       
        $this->data['view'] = 'marcas/marcas';
        $this->load->view('tema/topo', $this->data);

       
        
    }
    
    function adicionar()
    {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'aMarcas')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para adicionar marcas.');
            redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('marcas') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $preco = $this->input->post('preco');
            $preco = str_replace(",", "", $preco);

            $data = array(
                'nome' => set_value('nome'),
                'descricao' => set_value('descricao'),
                'preco' => $preco
            );

            if ($this->marcas_model->add('marcas', $data) == true) {
                $this->session->set_flashdata('success', 'Serviço adicionado com sucesso!');
                redirect(base_url() . 'index.php/marcas/adicionar/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }
        $this->data['view'] = 'marcas/adicionarMarca';
        $this->load->view('tema/topo', $this->data);

    }

    function editar()
    {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'eMarca')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para editar marcass.');
            redirect(base_url());
        }
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('marcas') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $preco = $this->input->post('preco');
            $preco = str_replace(",", "", $preco);
            $data = array(
                'nome' => $this->input->post('nome'),
                'descricao' => $this->input->post('descricao'),
                'preco' => $preco
            );

            if ($this->marcas_model->edit('marcas', $data, 'idMarcas', $this->input->post('idMarcas')) == true) {
                $this->session->set_flashdata('success', 'Serviço editado com sucesso!');
                redirect(base_url() . 'index.php/marcas/editar/'.$this->input->post('idMarcas'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um errro.</p></div>';
            }
        }

        $this->data['result'] = $this->marcas_model->getById($this->uri->segment(3));

        $this->data['view'] = 'marcas/editarMarca';
        $this->load->view('tema/topo', $this->data);

    }
    
    function excluir()
    {

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'dMarca')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para excluir marcas.');
            redirect(base_url());
        }
       
        
        $id =  $this->input->post('id');
        if ($id == null) {

            $this->session->set_flashdata('error', 'Erro ao tentar excluir marca.');
            redirect(base_url().'index.php/marcas/gerenciar/');
        }

        $this->db->where('marcas_id', $id);
        $this->db->delete('marcas_os');

        $this->marcas_model->delete('marcas', 'idMarcas', $id);
        

        $this->session->set_flashdata('success', 'Serviço excluido com sucesso!');
        redirect(base_url().'index.php/marcas/gerenciar/');
    }
}
