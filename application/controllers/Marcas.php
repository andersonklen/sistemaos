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

        // Habilitar o debug
        $this->output->enable_profiler(TRUE);
    
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
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'aMarca')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para adicionar marcas.');
            redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('marcas') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            end;
            $data = array(
                'marca_nome' => set_value('vw_marca_nome'),
                'marca_website' => set_value('vw_marca_website'),
            );

            if ($this->marcas_model->add('tb_marca', $data) == true) {
                $this->session->set_flashdata('success', 'Marca adicionada com sucesso!');
                redirect(base_url() . 'index.php/marcas/adicionar/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }
        $this->data['view'] = 'marcas/adicionarMarcas';
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
            $data = array(
                'marca_nome' => $this->input->post('vw_marca_nome'),
                'marca_website' => $this->input->post('vw_marca_website'),
            );

            if ($this->marcas_model->edit('tb_marca', $data, 'marca_codigo', $this->input->post('vw_hi_Marcas')) == true) {
                $this->session->set_flashdata('success', 'Marca/Fabrincante editado com sucesso!');
                //redirect(base_url() . 'index.php/marcas/editar/'.$this->input->post('marca_codigo'));
                redirect(base_url() . 'index.php/marcas/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um errro.</p></div>';
            }
        }

        $this->data['result'] = $this->marcas_model->getById($this->uri->segment(3));

        $this->data['view'] = 'marcas/editarMarcas';
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

        $this->db->where('marca_codigo', $id);
        $this->db->delete('tb_marca');

        $this->marcas_model->delete('tb_marca', 'marca_codigo', $id);
        

        $this->session->set_flashdata('success', 'Serviço excluido com sucesso!');
        redirect(base_url().'index.php/marcas/gerenciar/');
    }
}
