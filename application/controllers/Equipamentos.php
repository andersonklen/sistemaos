<?php

class Equipamentos extends CI_Controller
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
        $this->load->model('equipamentos_model', '', true);
        $this->data['menuEquipamentos'] = 'Equipamentos';
    
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
        
        
        $config['base_url'] = base_url().'index.php/equipamentos/gerenciar/';
        $config['total_rows'] = $this->equipamentos_model->count('tb_equipamento');
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

        $this->data['results'] = $this->equipamentos_model->get('tb_equipamento', 'equipamento_codigo,equipamento_nome,equipamento_modelo,equipamento_observacao', '', $config['per_page'], $this->uri->segment(3));
       
        $this->data['view'] = 'equipamentos/equipamento';
        $this->load->view('tema/topo', $this->data);

       
        
    }
    
    function adicionar()
    {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'aEquipamento')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para adicionar equipamentos.');
            redirect(base_url());
        }


        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('equipamentos') == false) {
           $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            // $preco = $this->input->post('preco');
            // $preco = str_replace(",", "", $preco);
            echo "1";
            end;
            $data = array(
                'equipamento_nome' => set_value('vw_equipamento_nome'),
                'equipamento_modelo' => set_value('vw_equipamento_modelo'),
            );

            if ($this->equipamentos_model->add('tb_equipamento', $data) == true) {
                $this->session->set_flashdata('success', 'Serviço adicionado com sucesso!');
                redirect(base_url() . 'index.php/equipamentos/adicionar/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }
        $this->data['view'] = 'equipamentos/adicionarEquipamento';
        $this->load->view('tema/topo', $this->data);

    }

    function editar()
    {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'eEquipamento')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para editar marcass.');
            redirect(base_url());
        }
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('equipamentos') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $preco = $this->input->post('preco');
            $preco = str_replace(",", "", $preco);
            $data = array(
                'equipamento_nome' => $this->input->post('vw_equipamento_nome'),
                'equipamento_observacao' => $this->input->post('vw_equipamento_modelo'),
            );

            if ($this->equipamentos_model->edit('tb_equipamento', $data, 'equipamento_codigo', $this->input->post('vw_hi_equipamento_codigo')) == true) {
                $this->session->set_flashdata('success', 'Serviço editado com sucesso!');
                //redirect(base_url() . 'index.php/equipamentos/editar/'.$this->input->post('vw_hi_equipamento_codigo'));
                redirect(base_url() . 'index.php/equipamentos/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um errro.</p></div>';
            }
        }

        $this->data['result'] = $this->equipamentos_model->getById($this->uri->segment(3));

        $this->data['view'] = 'equipamentos/editarEquipamento';
        $this->load->view('tema/topo', $this->data);

    }
    
    function excluir()
    {

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'dEquipamento')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para excluir equipamentos.');
            redirect(base_url());
        }
       
        
        $id =  $this->input->post('id');
        if ($id == null) {

            $this->session->set_flashdata('error', 'Erro ao tentar excluir equipamentos.');
            redirect(base_url().'index.php/equipamentos/gerenciar/');
        }

        // $this->db->where('marcas_id', $id);
        // $this->db->delete('marcas_os');

        $this->equipamentos_model->delete('tb_equipamento', 'equipamento_codigo', $id);
        

        $this->session->set_flashdata('success', 'Item excluido com sucesso!');
        redirect(base_url().'index.php/equipamentos/gerenciar/');
    }
}
