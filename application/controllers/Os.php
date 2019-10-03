<?php

class Os extends CI_Controller
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
        $this->load->model('os_model', '', true);
        //$this->load->model('mapos_model', '', true);
        $this->data['menuOs'] = 'OS';
         // Debug
        //$this->output->enable_profiler(TRUE);
    }
    
    function index()
    {
        $this->gerenciar();
    }

    function gerenciar()
    {
        
        $this->load->library('pagination');
        
        $where_array = array();

        $pesquisa = $this->input->get('vw_os_pesquisa');
        $status = $this->input->get('status');
        $de = $this->input->get('data');
        $ate = $this->input->get('data2');

        if ($pesquisa) {
            $where_array['pesquisa'] = $pesquisa;
        }
        if ($status) {
            $where_array['status'] = $status;
        }
        if ($de) {

            $de = explode('/', $de);
            $de = $de[2].'-'.$de[1].'-'.$de[0];

            $where_array['de'] = $de;
        }
        if ($ate) {
            $ate = explode('/', $ate);
            $ate = $ate[2].'-'.$ate[1].'-'.$ate[0];

            $where_array['ate'] = $ate;
        }
        
        $config['base_url'] = base_url().'index.php/os/gerenciar/';
        $config['total_rows'] = $this->os_model->count('tb_os');
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

        $this->data['results'] = $this->os_model->getOs('tb_os','os_codigo,os_data_entrada,os_data_final,os_garantia,os_descricao_produto,os_defeito,os_status,os_observacoes,os_laudo_tecnico,equipamento_nome,equipamento_partnumber,os_data_prev_entrega,os_numero_de_serie_equipamento', $where_array, $config['per_page'], $this->uri->segment(3));
       
        $this->data['view'] = 'os/os';
        $this->load->view('tema/topo', $this->data);
      
        
    }
    
    function adicionar()
    {


        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'aOs')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para adicionar O.S.');
            redirect(base_url());
        }

        //$usuario=$this->mapos_model->getById($this->session->userdata('id'));
        //$usuario= $this->session->userdata('id');
       //$usuariologado=$this->session->userdata();
       //print_r($usuariologado);
       //exit;

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
        
        if ($this->form_validation->run('os') == false) {
            $this->data['custom_error'] = (validation_errors() ? true : false);
        } else {

            $acessorios  = $this->input->post('vw_os_acessorios01').'|*][*|';
            $acessorios .= $this->input->post('vw_os_acessorios02').'|*][*|';
            $acessorios .= $this->input->post('vw_os_acessorios03').'|*][*|';
            $acessorios .= $this->input->post('vw_os_acessorios04').'|*][*|';
            $acessorios .= $this->input->post('vw_os_acessorios05').'|*][*|';
            $acessorios .= $this->input->post('vw_os_acessorios06').'|*][*|';
            $acessorios .= $this->input->post('vw_os_acessorios07').'|*][*|';
            $acessorios .= $this->input->post('vw_os_acessorios08').'|*][*|';
            $acessorios .= $this->input->post('vw_os_acessorios09').'|*][*|';
            $acessorios .= $this->input->post('vw_os_acessorios10').'|*][*|';


            $dataInicial = $this->input->post('dataInicial');
            $dataFinal = $this->input->post('dataFinal');

            $dataEntrada = explode('/', set_value('vw_os_data_entrada'));
            $dataEntrada = $dataEntrada[2].'-'.$dataEntrada[1].'-'.$dataEntrada[0];

            try {
                
                //$dataInicial = explode('/', $dataInicial);
                $dataInicial = explode('/', '12/12/2019');
                $dataInicial = $dataInicial[2].'-'.$dataInicial[1].'-'.$dataInicial[0];

                if ($dataFinal) {
                    $dataFinal = explode('/', $dataFinal);
                    $dataFinal = $dataFinal[2].'-'.$dataFinal[1].'-'.$dataFinal[0];
                } else {
                    $dataFinal = date('Y/m/d');
                }

            } catch (Exception $e) {
                $dataInicial = date('Y/m/d');
                $dataFinal = date('Y/m/d');
            }

            $data = array(
                'os_data_entrada' => $dataEntrada,
                'os_cliente_codigo' => set_value('vw_os_clientes_id'),
                'os_atendente_codigo' => $this->session->userdata('id'),
                'os_equipamento_codigo' => set_value('vw_os_equipamento_id'),//set_value('idUsuario'),                
                'os_numero_de_serie_equipamento' => set_value('vw_os_numero_de_serie'),//set_value('idUsuario'),
                'os_acessorios' => $acessorios,
                'os_observacoes' => set_value('vw_os_observacoes'),
                'os_defeito' => set_value('vw_os_defeito'),
                'os_status' => 'Orçamento',                                
                'os_faturado' => 0,
                'os_data_cadastro' => date('Y-m-d H:i:s'),
                'os_data_ultima_alteracao' => date('Y-m-d H:i:s'),
                'os_deletado' => 'nao',

                'os_data_final' => date('Y-m-d'),                
               // 'os_descricao_produto' => set_value('descricaoProduto'),
                

                //'os_laudo_tecnico' => set_value('laudoTecnico'),
                
            );

            if (is_numeric($id = $this->os_model->add('tb_os', $data, true))) {
                $this->session->set_flashdata('success', 'OS adicionada com sucesso, você pode adicionar produtos ou serviços a essa OS nas abas de "Produtos" e "Serviços"!');
                redirect('os/editar/'.$id);

            } else {
                
                $this->data['custom_error'] = '<div class="form_error"><p>An Error Occured.</p></div>';
            }
        }
         
        $this->data['view'] = 'os/adicionarOs';
        $this->load->view('tema/topo', $this->data);
    }
    
    public function adicionarAjax()
    {

        $this->load->library('form_validation');

        if ($this->form_validation->run('os') == false) {
            $json = array("result"=> false);
            echo json_encode($json);
        } else {
            $data = array(
                'os_data_inicial' => set_value('dataInicial'),
                'os_cliente_codigo' => $this->input->post('clientes_id'),//set_value('idCliente'),
                'os_usuarios_id' => $this->input->post('usuarios_id'),//set_value('idUsuario'),
                'os_data_final' => set_value('dataFinal'),
                'os_garantia' => set_value('garantia'),
                'os_descricao_produto' => set_value('descricaoProduto'),
                'os_defeito' => set_value('defeito'),
                'os_status' => set_value('status'),
                'os_observacoes' => set_value('observacoes'),
                'os_laudo_tecnico' => set_value('laudoTecnico')
            );

            if (is_numeric($id = $this->os_model->add('tb_os', $data, true))) {
                $json = array("result"=> true, "id"=> $id);
                echo json_encode($json);

            } else {
                $json = array("result"=> false);
                echo json_encode($json);

            }
        }
         
    }

    function editar()
    {

        if (!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))) {
            $this->session->set_flashdata('error', 'Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('mapos');
        }

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'eOs')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para editar O.S.');
            redirect(base_url());
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('os') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {



            $acessorios  = $this->input->post('vw_os_acessorios01').'|*][*|';
            $acessorios .= $this->input->post('vw_os_acessorios02').'|*][*|';
            $acessorios .= $this->input->post('vw_os_acessorios03').'|*][*|';
            $acessorios .= $this->input->post('vw_os_acessorios04').'|*][*|';
            $acessorios .= $this->input->post('vw_os_acessorios05').'|*][*|';
            $acessorios .= $this->input->post('vw_os_acessorios06').'|*][*|';
            $acessorios .= $this->input->post('vw_os_acessorios07').'|*][*|';
            $acessorios .= $this->input->post('vw_os_acessorios08').'|*][*|';
            $acessorios .= $this->input->post('vw_os_acessorios09').'|*][*|';
            $acessorios .= $this->input->post('vw_os_acessorios10').'|*][*|';

            $datapreventrega = $this->input->post('vw_os_data_prev_entrega');
            $datapreventrega = explode('/', $datapreventrega);
            $datapreventrega = $datapreventrega[2].'-'.$datapreventrega[1].'-'.$datapreventrega[0];


            $data = array(
                'os_cliente_codigo' => $this->input->post('vw_os_cliente_id'),
                'os_equipamento_codigo' => set_value('vw_os_equipamento_id'),//set_value('idUsuario'),                
                'os_numero_de_serie_equipamento' => set_value('vw_os_numero_de_serie'),//set_value('idUsuario'),
                'os_acessorios' => $acessorios,                
                'os_observacoes' => $this->input->post('vw_os_observacoes'),
                'os_defeito' => $this->input->post('vw_os_defeito'),
                'os_tecnico_codigo' => $this->input->post('vw_os_tecnico_id'),
                'os_status' => $this->input->post('vw_os_status'),
                'os_laudo_tecnico' => $this->input->post('os_laudo_tecnico'),                
                'os_observacoes_internas' => $this->input->post('vw_os_observacoes_internas'),                
                'os_data_prev_entrega' => $datapreventrega,                

                // # logs
                'os_data_ultima_alteracao' => date('Y-m-d H:i:s'),
                'os_usuario_ult_alteracao' =>$this->session->userdata('nome')
            );



            if ($this->os_model->edit('tb_os', $data, 'os_codigo', $this->input->post('idOs')) == true) {
                $this->session->set_flashdata('success', 'Os editada com sucesso!');
                redirect(base_url() . 'index.php/os/editar/'.$this->input->post('idOs'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro</p></div>';
            }
        }

        $this->data['result'] = $this->os_model->getById($this->uri->segment(3));
        $this->data['produtos'] = $this->os_model->getProdutos($this->uri->segment(3));
        $this->data['servicos'] = $this->os_model->getServicos($this->uri->segment(3));
        $this->data['anexos'] = $this->os_model->getAnexos($this->uri->segment(3));
        $this->data['view'] = 'os/editarOs';
        $this->load->view('tema/topo', $this->data);
   
    }

    public function visualizar()
    {

        if (!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))) {
            $this->session->set_flashdata('error', 'Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('mapos');
        }

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'vOs')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para visualizar O.S.');
            redirect(base_url());
        }

        $this->data['custom_error'] = '';
        $this->load->model('mapos_model');
        $this->data['result'] = $this->os_model->getById($this->uri->segment(3));
        $this->data['produtos'] = $this->os_model->getProdutos($this->uri->segment(3));
        $this->data['servicos'] = $this->os_model->getServicos($this->uri->segment(3));
        $this->data['emitente'] = $this->mapos_model->getEmitente();

        $this->data['view'] = 'os/visualizarOs';
        $this->load->view('tema/topo', $this->data);
       
    }

    public function imprimir()
    {
        
        if (!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))) {
            $this->session->set_flashdata('error', 'Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('mapos');
        }
        
        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'vOs')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para visualizar O.S.');
            redirect(base_url());
        }
        
                $this->data['custom_error'] = '';
                $this->load->model('mapos_model');
                $this->data['result'] = $this->os_model->getById($this->uri->segment(3));
                $this->data['produtos'] = $this->os_model->getProdutos($this->uri->segment(3));
                $this->data['servicos'] = $this->os_model->getServicos($this->uri->segment(3));
                $this->data['emitente'] = $this->mapos_model->getEmitente();
        
                $this->load->view('os/imprimirOs', $this->data);
               
    }
    
    function excluir()
    {

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'dOs')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para excluir O.S.');
            redirect(base_url());
        }
        
        $id =  $this->input->post('id');
        if ($id == null) {

            $this->session->set_flashdata('error', 'Erro ao tentar excluir OS.');
            redirect(base_url().'index.php/os/gerenciar/');
        }

        $this->db->where('servico_os_codigo', $id);
        $this->db->delete('tb_servico_os');

        $this->db->where('produto_os_codigo', $id);
        $this->db->delete('tb_produto_os');

        $this->db->where('anexo_os_codigo', $id);
        $this->db->delete('tb_anexo');

        //$this->os_model->delete('tb_os', 'os_codigo', $id);
        $data04 = array(
                'os_deletado' => 'sim'
            );
        $this->os_model->edit('tb_os', $data04 , 'os_codigo', $id);
        

        $this->session->set_flashdata('success', 'OS excluída com sucesso!');
        redirect(base_url().'index.php/os/gerenciar/');


        
    }

    public function autoCompleteProduto()
    {
        
        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            $this->os_model->autoCompleteProduto($q);
        }

    }

    public function autoCompleteProdutoSaida()
    {
        
        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            $this->os_model->autoCompleteProdutoSaida($q);
        }

    }

    public function autoCompleteCliente()
    {

        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            $this->os_model->autoCompleteCliente($q);
        }

    }

    public function autoCompleteEquipamento()
    {

        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            $this->os_model->autoCompleteEquipamento($q);
        }

    }

    public function autoCompleteUsuario()
    {

        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            $this->os_model->autoCompleteUsuario($q);
        }

    }

    public function autoCompleteServico()
    {

        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            $this->os_model->autoCompleteServico($q);
        }

    }

    public function adicionarProduto()
    {

        
        $preco = $this->input->post('preco');
        $quantidade = $this->input->post('quantidade');
        $subtotal = $preco * $quantidade;
        $produto = $this->input->post('idProduto');
        $data = array(
            'quantidade'=> $quantidade,
            'subTotal'=> $subtotal,
            'produtos_id'=> $produto,
            'os_id'=> $this->input->post('idOsProduto'),
        );

        if ($this->os_model->add('produtos_os', $data) == true) {
            $sql = "UPDATE tb_produto set estoque = estoque - ? WHERE produto_codigo = ?";
            $this->db->query($sql, array($quantidade, $produto));
            
            echo json_encode(array('result'=> true));
        } else {
            echo json_encode(array('result'=> false));
        }
      
    }

    function excluirProduto()
    {
        
            $ID = $this->input->post('idProduto');
        if ($this->os_model->delete('produtos_os', 'idProdutos_os', $ID) == true) {
                
            $quantidade = $this->input->post('quantidade');
            $produto = $this->input->post('produto');


            $sql = "UPDATE produtos set estoque = estoque + ? WHERE idProdutos = ?";

            $this->db->query($sql, array($quantidade, $produto));
                
            echo json_encode(array('result'=> true));
        } else {
            echo json_encode(array('result'=> false));
        }
    }

    public function adicionarServico()
    {

        $data = array(
            'servicos_id'=> $this->input->post('idServico'),
            'os_id'=> $this->input->post('idOsServico'),
            'subTotal'=> $this->input->post('precoServico')
        );

        if ($this->os_model->add('servicos_os', $data) == true) {

            echo json_encode(array('result'=> true));
        } else {
            echo json_encode(array('result'=> false));
        }

    }

    function excluirServico()
    {
            $ID = $this->input->post('idServico');
        if ($this->os_model->delete('servicos_os', 'idServicos_os', $ID) == true) {

            echo json_encode(array('result'=> true));
        } else {
            echo json_encode(array('result'=> false));
        }
    }


    public function anexar()
    {

        $this->load->library('upload');
        $this->load->library('image_lib');

        $upload_conf = array(
            'upload_path'   => realpath('./assets/anexos'),
            'allowed_types' => 'jpg|png|gif|jpeg|JPG|PNG|GIF|JPEG|pdf|PDF|cdr|CDR|docx|DOCX|txt', // formatos permitidos para anexos de os
            'max_size'      => 0,
            );
    
        $this->upload->initialize($upload_conf);
        
        foreach ($_FILES['userfile'] as $key => $val) {
            $i = 1;
            foreach ($val as $v) {
                $field_name = "file_".$i;
                $_FILES[$field_name][$key] = $v;
                $i++;
            }
        }
        unset($_FILES['userfile']);
    

        $error = array();
        $success = array();
        
        foreach ($_FILES as $field_name => $file) {
            if (! $this->upload->do_upload($field_name)) {
                $error['upload'][] = $this->upload->display_errors();
            } else {

                $upload_data = $this->upload->data();
                
                if ($upload_data['is_image'] == 1) {

                   // set the resize config
                    $resize_conf = array(
    
                        'source_image'  => $upload_data['full_path'],
                        'new_image'     => $upload_data['file_path'].'thumbs/thumb_'.$upload_data['file_name'],
                        'width'         => 200,
                        'height'        => 125
                        );

                    $this->image_lib->initialize($resize_conf);

                    if (! $this->image_lib->resize()) {
                        $error['resize'][] = $this->image_lib->display_errors();
                    } else {
                        $success[] = $upload_data;
                        $this->load->model('Os_model');
                        $this->Os_model->anexar($this->input->post('idOsServico'), $upload_data['file_name'], base_url().'assets/anexos/', 'thumb_'.$upload_data['file_name'], realpath('./assets/anexos/'));

                    }
                } else {

                    $success[] = $upload_data;

                    $this->load->model('Os_model');

                    $this->Os_model->anexar($this->input->post('idOsServico'), $upload_data['file_name'], base_url().'assets/anexos/', '', realpath('./assets/anexos/'));
 
                }
                
            }
        }


        if (count($error) > 0) {
            echo json_encode(array('result'=> false, 'mensagem' => 'Nenhum arquivo foi anexado.'));
        } else {
            echo json_encode(array('result'=> true, 'mensagem' => 'Arquivo(s) anexado(s) com sucesso .'));
        }
        

    }


    public function excluirAnexo($id = null)
    {
        if ($id == null || !is_numeric($id)) {
            echo json_encode(array('result'=> false, 'mensagem' => 'Erro ao tentar excluir anexo.'));
        } else {

            $this->db->where('idAnexos', $id);
            $file = $this->db->get('anexos', 1)->row();

            unlink($file->path.'/'.$file->anexo);

            if ($file->thumb != null) {
                unlink($file->path.'/thumbs/'.$file->thumb);
            }
            
            if ($this->os_model->delete('anexos', 'idAnexos', $id) == true) {

                echo json_encode(array('result'=> true, 'mensagem' => 'Anexo excluído com sucesso.'));
            } else {
                echo json_encode(array('result'=> false, 'mensagem' => 'Erro ao tentar excluir anexo.'));
            }

            
        }
    }


    public function downloadanexo($id = null)
    {
        
        if ($id != null && is_numeric($id)) {
            
            $this->db->where('idAnexos', $id);
            $file = $this->db->get('anexos', 1)->row();

            $this->load->library('zip');

            $path = $file->path;

            $this->zip->read_file($path.'/'.$file->anexo);

            $this->zip->download('file'.date('d-m-Y-H.i.s').'.zip');

        }
      
    }


    public function faturar()
    {

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
 

        if ($this->form_validation->run('receita') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {


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
                'descricao' => set_value('descricao'),
                'valor' => $this->input->post('valor'),
                'clientes_id' => $this->input->post('clientes_id'),
                'data_vencimento' => $vencimento,
                'data_pagamento' => $recebimento,
                'baixado' => $this->input->post('recebido') ? : 0,
                'cliente_fornecedor' => set_value('cliente'),
                'forma_pgto' => $this->input->post('formaPgto'),
                'tipo' => $this->input->post('tipo')
            );

            if ($this->os_model->add('lancamentos', $data) == true) {
                
                $os = $this->input->post('os_id');

                $this->db->set('faturado', 1);
                $this->db->set('valorTotal', $this->input->post('valor'));
                $this->db->set('status', 'Faturado');
                $this->db->where('idOs', $os);
                $this->db->update('os');

                $this->session->set_flashdata('success', 'OS faturada com sucesso!');
                $json = array('result'=>  true);
                echo json_encode($json);
                die();
            } else {
                $this->session->set_flashdata('error', 'Ocorreu um erro ao tentar faturar OS.');
                $json = array('result'=>  false);
                echo json_encode($json);
                die();
            }
        }

        $this->session->set_flashdata('error', 'Ocorreu um erro ao tentar faturar OS.');
        $json = array('result'=>  false);
        echo json_encode($json);
        
    }
}
