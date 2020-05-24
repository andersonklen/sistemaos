<?php

class Whatsapp extends CI_Controller
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
        $this->load->model('whatsapp_model', '', true);
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
        
        
        $config['base_url'] = base_url().'index.php/whatsapp/gerenciar/';
        $config['total_rows'] = $this->whatsapp_model->count('tb_marca');
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

        $this->data['results'] = $this->whatsapp_model->get('tb_whatsapp_msg', 'whatsapp_msg_codigo,whatsapp_msg_number_origin,whatsapp_msg_message_in,',  "whatsapp_msg_deletado='nao'", $config['per_page'], $this->uri->segment(3));
       
        $this->data['view'] = 'whatsapp/whatsapp';
        $this->load->view('tema/topo', $this->data);

       
        
    }


    function webhook()
    {

        /*Mobile number with country code from the message came, 
        if the sender mobile number is saved in the phone contacts then instead of number the contact name will come here as number. 
        For Whatsapp Group the number will be Group Name @Sender Name / Number */
        $mobile_number = isset($_REQUEST['number']) ? $_REQUEST['number'] : 0;

        /*Text message received in the application - only first 1000 characters will be pushed to the server.*/
        $msg = isset($_REQUEST['message-in']) ? $_REQUEST['message-in'] : 0;

        /*On which messaging app the message has received 1=Whatsapp Personal | 2 = Whatsapp Business*/
        $application = isset($_REQUEST['application']) ? $_REQUEST['application'] : 0;

        /*What kind of message is received , text=1, photo=2, video=3, audio=4, location=5, document=6, contact=7*/
        $type = isset($_REQUEST['type']) ? $_REQUEST['type'] : 0;

        /*Unique id assigned by the picky assist application*/
        $uniqueid = isset($_REQUEST['unique-id']) ? $_REQUEST['unique-id'] : 0;

        if (!empty($mobile_number)) {
        /*Reply should be in JSON format. The response parameters are : 
        1. 'message-out' - Message you need to give it as reply.
        2. 'delay' - If you would like to give response by setting a delay then please pass the delay value 
        in “delay” variable , delay need to be set in seconds and maximum allowed delay is 3600 seconds 
        i.e delay=10 means message will send after 10 seconds
        */

        /*Giving Reply should be in JSON*/
        $data = array('message-out' => ' Hello Picky','delay' => 0);

        $result = json_encode($data);
        }

    }
    
    function enviarWhatsapp()
    {
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'aMarca')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para adicionar marcas.');
            redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('enviarwhatsapp') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {     
                $num_destino = set_value('vw_marca_nome');
                $mensagem = set_value('vw_marca_website');
                $marca_data_cadastro = date('Y-m-d H:i:s');
                $marca_data_ultima_alteracao = date('Y-m-d H:i:s');
                $marca_deletado = 'nao';
          

            $this->whatsapp_model->enviar($num_destino,$mensagem);
                $this->session->set_flashdata('success', 'Marca adicionada com sucesso!');
                redirect(base_url() . 'index.php/whatsapp/enviarWhatsapp/');
           // } else {
            //    $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
         //}





        }
        $this->data['view'] = 'Whatsapp/enviarWhatsapp';
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
                'marca_data_ultima_alteracao' => date('Y-m-d H:i:s'),                
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


       $data = array(
               'marca_data_ultima_alteracao' => date('Y-m-d H:i:s'),
               'marca_deletado' => 'sim'
            );

        $this->marcas_model->edit('tb_marca', $data, 'marca_codigo', $id);
        /// $this->db->where('marca_codigo', $id);
        // $this->db->delete('tb_marca');
        // $this->marcas_model->delete('tb_marca', 'marca_codigo', $id);
        

        $this->session->set_flashdata('success', 'Serviço excluido com sucesso!');
        redirect(base_url().'index.php/marcas/gerenciar/');
    }
}
