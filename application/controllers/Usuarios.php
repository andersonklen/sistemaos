<?php

class Usuarios extends CI_Controller
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
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'cUsuario')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para configurar os usuários.');
            redirect(base_url());
        }

        $this->load->helper(array('form', 'codegen_helper'));
        $this->load->model('usuarios_model', '', true);
        $this->data['menuUsuarios'] = 'Usuários';
        $this->data['menuConfiguracoes'] = 'Configurações';

               // Debug
        // $this->output->enable_profiler(TRUE);
    }

    function index()
    {
        $this->gerenciar();
    }

    function gerenciar()
    {
        
        $this->load->library('pagination');
        

        $config['base_url'] = base_url().'index.php/usuarios/gerenciar/';
        $config['total_rows'] = $this->usuarios_model->count('tb_usuario');
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

        $this->data['results'] = $this->usuarios_model->get($config['per_page'], $this->uri->segment(3));
       
        $this->data['view'] = 'usuarios/usuarios';
        $this->load->view('tema/topo', $this->data);

       
        
    }
    
    function adicionar()
    {
          
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
        
        if ($this->form_validation->run('usuarios') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="alert alert-danger">'.validation_errors().'</div>' : false);

        } else {

            $data = array(
                    'usuario_nome' => set_value('nome'),
                    'usuario_rg' => set_value('rg'),
                    'usuario_cpf' => set_value('cpf'),
                    'usuario_logradouro' => set_value('rua'),
                    'usuario_numero' => set_value('numero'),
                    'usuario_bairro' => set_value('bairro'),
                    'usuario_cidade' => set_value('cidade'),
                    'usuario_estado' => set_value('estado'),
                    'usuario_email' => set_value('email'),
                    'usuario_senha' => password_hash($this->input->post('senha'), PASSWORD_DEFAULT),
                    'usuario_tel01' => set_value('telefone'),
                    'usuario_tel02' => set_value('celular'),
                    'usuario_situacao' => set_value('situacao'),
                    'usuario_permissoes_codigo' => $this->input->post('permissoes_id'),
                    'usuario_data_cadastro' => date('Y-m-d')
            );
           
            if ($this->usuarios_model->add('tb_usuario', $data) == true) {
                $this->session->set_flashdata('success', 'Usuário cadastrado com sucesso!');
                redirect(base_url().'index.php/usuarios/adicionar/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';

            }
        }
        
        $this->load->model('permissoes_model');
        $this->data['permissoes'] = $this->permissoes_model->getActive('tb_permissoes', 'tb_permissoes.permissoes_codigo,tb_permissoes.permissoes_nome');
        $this->data['view'] = 'usuarios/adicionarUsuario';
        $this->load->view('tema/topo', $this->data);
   
       
    }
    
    function editar()
    {
        
        if (!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))) {
            $this->session->set_flashdata('error', 'Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('mapos');
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required');
        $this->form_validation->set_rules('rg', 'RG', 'trim|required');
        $this->form_validation->set_rules('cpf', 'CPF', 'trim|required');
        $this->form_validation->set_rules('rua', 'Rua', 'trim|required');
        $this->form_validation->set_rules('numero', 'Número', 'trim|required');
        $this->form_validation->set_rules('bairro', 'Bairro', 'trim|required');
        $this->form_validation->set_rules('cidade', 'Cidade', 'trim|required');
        $this->form_validation->set_rules('estado', 'Estado', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('telefone', 'Telefone', 'trim|required');
        $this->form_validation->set_rules('situacao', 'Situação', 'trim|required');
        $this->form_validation->set_rules('permissoes_id', 'Permissão', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">'.validation_errors().'</div>' : false);

        } else {

            if ($this->input->post('idUsuarios') == 1 && $this->input->post('situacao') == 0) {
                $this->session->set_flashdata('error', 'O usuário super admin não pode ser desativado!');
                redirect(base_url().'index.php/usuarios/editar/'.$this->input->post('idUsuarios'));
            }

            $senha = $this->input->post('senha');
            if ($senha != null) {

                $senha = password_hash($senha, PASSWORD_DEFAULT);

                $data = array(
                        'usuario_nome' => $this->input->post('nome'),
                        'usuario_rg' => $this->input->post('rg'),
                        'usuario_cpf' => $this->input->post('cpf'),
                        'usuario_logradouro' => $this->input->post('rua'),
                        'usuario_numero' => $this->input->post('numero'),
                        'usuario_bairro' => $this->input->post('bairro'),
                        'usuario_cidade' => $this->input->post('cidade'),
                        'usuario_estado' => $this->input->post('estado'),
                        'usuario_email' => $this->input->post('email'),
                        'usuario_senha' => $senha,
                        'usuario_tel01' => $this->input->post('telefone'),
                        'usuario_tel01' => $this->input->post('celular'),
                        'usuario_situacao' => $this->input->post('situacao'),
                        'usuario_permissoes_codigo' => $this->input->post('permissoes_id')
                );
            } else {

                $data = array(
                        'usuario_nome' => $this->input->post('nome'),
                        'usuario_rg' => $this->input->post('rg'),
                        'usuario_cpf' => $this->input->post('cpf'),
                        'usuario_logradouro' => $this->input->post('rua'),
                        'usuario_numero' => $this->input->post('numero'),
                        'usuario_bairro' => $this->input->post('bairro'),
                        'usuario_cidade' => $this->input->post('cidade'),
                        'usuario_estado' => $this->input->post('estado'),
                        'usuario_email' => $this->input->post('email'),
                        'usuario_tel01' => $this->input->post('telefone'),
                        'usuario_tel02' => $this->input->post('celular'),
                        'usuario_situacao' => $this->input->post('situacao'),
                        'usuario_permissoes_codigo' => $this->input->post('permissoes_id')
                );

            }

           
            if ($this->usuarios_model->edit('tb_usuario', $data, 'usuario_codigo', $this->input->post('idUsuarios')) == true) {
                $this->session->set_flashdata('success', 'Usuário editado com sucesso!');
                redirect(base_url().'index.php/usuarios/editar/'.$this->input->post('idUsuarios'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro</p></div>';

            }
        }

        $this->data['result'] = $this->usuarios_model->getById($this->uri->segment(3));
        $this->load->model('permissoes_model');
        $this->data['permissoes'] = $this->permissoes_model->getActive('tb_permissoes', 'tb_permissoes.permissoes_codigo,tb_permissoes.permissoes_nome');

        $this->data['view'] = 'usuarios/editarUsuario';
        $this->load->view('tema/topo', $this->data);
            
      
    }
    
    public function excluir()
    {

            $ID =  $this->uri->segment(3);
            $this->usuarios_model->delete('tb_usuario', 'usuario_codigo', $ID);
            redirect(base_url().'index.php/usuarios/gerenciar/');
    }
}
