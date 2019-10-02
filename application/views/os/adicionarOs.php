<link rel="stylesheet" href="<?php echo base_url();?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.validate.js"></script>
<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-tags"></i>
                </span>
                <h5>Cadastro de OS</h5>
            </div>

            <div class="widget-content nopadding">


                <div class="span12" id="divProdutosServicos" style=" margin-left: 0">
                    <ul class="nav nav-tabs">
                        <li class="active" id="tabDetalhes"><a href="#tab1" data-toggle="tab">Detalhes da OS</a></li>
                    </ul>

                        <div class="tab-content">
                            <!-- Inicio Aba de detalhes -->
                            <div class="tab-pane active" id="tab1">
                                <div class="span12" id="divCadastrarOs" style="padding: 1%; margin-left: 0">                                        
                                    <div class="span12 well" style="padding: 1%; margin-left: 0">
                                        <?php if ($custom_error == true) { ?>
                                            <div class="span12 alert alert-danger" id="divInfo" style="padding: 1%;">Dados incompletos, verifique os campos com asterisco ou se selecionou corretamente cliente e responsável.
                                            </div>
                                        <?php } ?>
                                        <form action="<?php echo current_url(); ?>" method="post" id="formOs">

                                            
                                            <div class="span12" style="padding: 1% ; margin-left: 0 ">
                                                <div class="span6">
                                                    <label for="cliente">Cliente<span class="required">*</span></label>
                                                    <input id="vw_os_cliente" class="span12" type="text" name="vw_os_cliente" value=""  />
                                                    <input id="vw_os_clientes_id" class="span12" type="hidden" name="vw_os_clientes_id" value=""  />
                                                </div>
                                                <div class="span6">
                                                       <label for="usuario">Data de entrada do equipamento<span class="required">*</span></label>                                    
                                                       <input id="vw_os_data_entrada" type="text" name="vw_os_data_entrada" class="span12 datepicker"  onkeypress="$(this).mask('00/00/0000')" value="<?php echo set_value('Data de Nascimento'); ?>"  placeholder="DD/MM/AAAA"/>
                                                </div>
                                            </div>

                                            <div class="span12" style="padding: 1% ; margin-left: 0">
                                                <div class="span6">
                                                    <label for="equipamento">Equipamento<span class="required">*</span></label>
                                                    <input id="vw_os_equipamento" class="span12" type="text" name="vw_os_equipamento" value=""  />
                                                    <input id="vw_os_equipamento_id" class="span12" type="hidden" name="vw_os_equipamento_id" value=""  />
                                                </div>
                                                <div class="span6">
                                                    <label for="numero_de_serie">Num. de Série  </label>
                                                    <input id="vw_os_numero_de_serie" class="span12" type="text" name="vw_os_numero_de_serie" value=""  />                                            
                                                </div>
                                            </div>                                

                                            <div class="span12" style="padding: 1% ; margin-left: 0">                                  
                                                
                                                <div class="span4">
                                                    <label for="acessorios01">Qtde de hélices<span class="required">*</span></label>
                                                    <select name="vw_os_acessorios01" id="vw_os_acessorios01" >
                                                        <option value=""></option>
                                                        <option value="0">Sem hélices</option>
                                                        <option value="1">1 hélice</option>
                                                        <option value="2">2 hélices</option>
                                                        <option value="3">3 hélices</option>
                                                        <option value="4">4 hélices</option>
                                                        <option value="5">5 hélices</option>
                                                        <option value="6">6 hélices</option>
                                                        <option value="7">7 hélices</option>
                                                        <option value="8">8 hélices</option>
                                                        <option value="9">9 hélices</option>                                            
                                                        <option value="10">10 hélices</option>                                                             
                                                    </select>
                                                </div>
                                                
                                                <div class="span4">
                                                    <label for="acessorios02">Qtde de baterias<span class="required">*</span></label>                                                    
                                                    <select name="vw_os_acessorios02" id="vw_os_acessorios02" >
                                                        <option value=""></option>
                                                        <option value="1">Sem baterias</option>
                                                        <option value="1">1 bateria</option>
                                                        <option value="2">2 baterias</option>
                                                        <option value="2">3 baterias</option>
                                                        <option value="2">4 baterias</option>
                                                        <option value="2">5 baterias</option>                                                        
                                                    </select>
                                                </div>

                                                <div class="span4">
                                                    <label for="acessorios03">Carregador de Tomada<span class="required">*</span></label>                                                    
                                                    <select name="vw_os_acessorios03" id="vw_os_acessorios03" >
                                                        <option value=""></option>
                                                        <option value="sim">Sim</option>
                                                        <option value="nao">Não</option>
                                                                        
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="span12" style="padding: 1% ; margin-left: 0">  
                                                <div class="span4">
                                                    <label for="acessorios04">Manuais <span class="required">*</span></label>                                                    
                                                    <select name="vw_os_acessorios04" id="vw_os_acessorios04" >
                                                        <option value=""></option>
                                                        <option value="1">Sim</option>
                                                        <option value="2">Não</option>                                         
                                                    </select>
                                                </div>
                                                <div class="span4">
                                                    <label for="acessorios05">Protetor de Gimbal/Camera<span class="required">*</span></label>                                                    
                                                    <select name="vw_os_acessorios05" id="vw_os_acessorios05" >
                                                        <option value=""></option>
                                                        <option value="1">Sim</option>
                                                        <option value="2">Não</option>                                      
                                                    </select>
                                                </div>                                                
                                                
                                                <div class="span4">
                                                    <label for="acessorios06">Bolsa de Transporte<span class="required">*</span></label>                                                    
                                                    <select name="vw_os_acessorios06" id="vw_os_acessorios06" >
                                                        <option value=""></option>
                                                        <option value="1">Sim</option>
                                                        <option value="2">Não</option>                                                    
                                                    </select>
                                                </div>
                                            </div>

                                            
                                            <div class="span12" style="padding: 1% ; margin-left: 0">                                                                                  
                                                <div class="span4">
                                                    <label for="acessorios07">1º Cartão de Memoria<span class="required">*</span></label>
                                                    <select name="acessorios07" id="acessorios07" >
                                                        <option value=""></option>
                                                        <option value="nao">Não</option>
                                                        <option value="1">1 GB</option>
                                                        <option value="2">2 GB</option>
                                                        <option value="4">4 GB</option>
                                                        <option value="8">8 GB</option>
                                                        <option value="16">16 GB</option>                                                        
                                                        <option value="32">32 GB</option>                                                        
                                                        <option value="64">64 GB</option>                                                        
                                                        <option value="128">128 GB</option>                                                                                                                
                                                        <option value="256">256 GB</option>                                                                                                               
                                                    </select>
                                                </div>
                                                
                                                <div class="span4">
                                                    <label for="acessorios08">2º Cartão de Memoria<span class="required">*</span></label>
                                                    <select name="vw_os_acessorios08" id="vw_os_acessorios08" >
                                                        <option value=""></option>
                                                        <option value="nao">Não</option>
                                                        <option value="1">1 GB</option>
                                                        <option value="2">2 GB</option>
                                                        <option value="4">4 GB</option>
                                                        <option value="8">8 GB</option>
                                                        <option value="16">16 GB</option>                                                        
                                                        <option value="32">32 GB</option>                                                        
                                                        <option value="64">64 GB</option>                                                        
                                                        <option value="128">128 GB</option>                                                                                                                
                                                        <option value="256">256 GB</option>                                                                                                               
                                                    </select>
                                                </div>

                                                <div class="span4">
                                                    <label for="acessorios09">3º Cartão de Memoria<span class="required">*</span></label>
                                                    <select name="vw_os_acessorios09" id="vw_os_acessorios09" >
                                                        <option value=""></option>
                                                        <option value="nao">Não</option>
                                                        <option value="1">1 GB</option>
                                                        <option value="2">2 GB</option>
                                                        <option value="4">4 GB</option>
                                                        <option value="8">8 GB</option>
                                                        <option value="16">16 GB</option>                                                        
                                                        <option value="32">32 GB</option>                                                        
                                                        <option value="64">64 GB</option>                                                        
                                                        <option value="128">128 GB</option>                                                                                                                
                                                        <option value="256">256 GB</option>                                                                                                               
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="span12" style="padding: 1% ; margin-left: 0"> 
                                                <div class="span6">                                                    
                                                    <label for="acessorios10">Outros Acessórios</label>
                                                    <textarea class="span6" style="width:100%;" name="vw_os_acessorios10" id="vw_os_acessorios10" rows="5"></textarea>
                                                </div>                                                                                               

                                                <div class="span6">                                                    
                                                    <label for="observacoes">Observações</label>
                                                    <textarea class="span6"  style="width:100%;" name="vw_os_observacoes" id="vw_os_observacoes" rows="5" placeholder="Relatar detalhes como arranhões ou amassados no equipamento."></textarea>
                                                </div>                                                                                               
                                            </div>
                                            
                                            <div class="span12" style="padding: 1% ; margin-left: 0"> 
                                                <div class="span12">                                                    
                                                    <label for="defeito">Problema relatado pelo cliente</label>
                                                    <textarea class="span12" name="vw_os_defeito" id="vw_os_defeito" rows="5" placeholder="Escrever de forma detalhada o problema informado pelo cliente. Exemplo: 'Ao tentar voar com o equipamento desligar.' "></textarea>
                                                </div>                                                                                               
                                            </div>

                                            <!--
                                          <div class="span12" style="padding: 1%; margin-left: 0">
                                                
                                                <div class="span3">
                                                    <label for="status">Status<span class="required">*</span></label>
                                                    <select class="span12" name="vw_os_status" id="vw_os_status" value="">
                                                        <option value="Orçamento">Orçamento</option>
                                                        <option value="Aberto">Aberto</option>
                                                        <option value="Em Andamento">Em Andamento</option>
                                                        <option value="Finalizado">Finalizado</option>
                                                        <option value="Nao Autorizado Manut">Não Autorizado Manut.</option>                                                
                                                        <option value="Somente Laudo">Somente Laudo</option>                                                                                              
                                                        <option value="Cancelado">Cancelado</option>
                                                    </select>
                                                </div>
                                            
                                                <div class="span3">

                                                    <label for="dataInicial">Data Inicial<span class="required">*</span></label>
                                                    <input id="vw_os_dataInicial" class="span12 datepicker" type="text" name="vw_os_dataInicial" value="<?php //echo date('d/m/Y'); ?>"  />
                                                </div>
                                                                                      
                                                <div class="span3">
                                                    <label for="dataFinal">Data Final</label>
                                                    <input id="vw_os_dataFinal" class="span12 datepicker" type="text" name="vw_os_dataFinal" value=""  />
                                                </div>
                                                 
                                                <div class="span3">
                                                    <label for="garantia">Garantia</label>
                                                    <input id="garantia" type="text" class="span12" name="garantia" value=""  />
                                                </div>
                                      
                                            </div>

                                        

                                        <div class="span12" style="padding: 1%; margin-left: 0">
                                            <div class="span6">
                                                <label for="defeito">Defeito relatado pelo cliente</label>
                                                <textarea class="span12" name="vw_os_defeito" id="vw_os_defeito" cols="30" rows="5"></textarea>
                                            </div>


                                            <div class="span6">
                                                <label for="descricaoProduto">Observações do Equipamento</label>
                                                <textarea class="span12" name="vw_os_descricaoProduto" id="vw_os_descricaoProduto" cols="30" rows="5"></textarea>
                                            </div>                                        
                                        </div>

                                            <div class="span12" style="padding: 1%; margin-left: 0">
                                                <div class="span6">
                                                    <label for="observacoes">Observações</label>
                                                    <textarea class="span12" name="vw_os_observacoes" id="vw_os_observacoes" cols="30" rows="5"></textarea>
                                                </div>

                                                  
                                                <div class="span6">
                                                    <label for="laudo_tecnico">Laudo Técnico</label>
                                                    <textarea class="span12" name="vw_os_laudo_tecnico" id="vw_os_laudo_tecnico" cols="30" rows="5"></textarea>
                                                </div>
                                            
                                            -->
                                            <div class="span12" style="padding: 1%; margin-left: 0">
                                                <div class="span6 offset3" style="text-align: center">
                                                    <button class="btn btn-success" id="btnContinuar"><i class="icon-share-alt icon-white"></i> Continuar</button>
                                                    <a href="<?php echo base_url() ?>index.php/os" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
                                                </div>
                                            </div>

                                        </form>                                
                                    </div>
                                </div>
                            </div>
                            <!-- Fim Aba de detalhes -->

                        </div>

                </div>       
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
    $(document).ready(function(){

      $("#vw_os_equipamento").autocomplete({
        source: "<?php echo base_url(); ?>index.php/os/autoCompleteEquipamento",
        minLength: 1,
        select: function( event, ui ) {

           $("#vw_os_equipamento_id").val(ui.item.id);


       }
   });

      $("#vw_os_cliente").autocomplete({
        source: "<?php echo base_url(); ?>index.php/os/autoCompleteCliente",
        minLength: 1,
        select: function( event, ui ) {

           $("#vw_os_clientes_id").val(ui.item.id);


       }
   });

      $("#vw_os_usuario").autocomplete({
        source: "<?php echo base_url(); ?>index.php/os/autoCompleteUsuario",
        minLength: 1,
        select: function( event, ui ) {

           $("#vw_os_usuario_id").val(ui.item.id);


       }
   });

      
      

      $("#formOs").validate({
          rules:{
           cliente: {required:true},
           tecnico: {required:true},
           dataInicial: {required:true}
       },
       messages:{
           cliente: {required: 'Campo Requerido.'},
           tecnico: {required: 'Campo Requerido.'},
           dataInicial: {required: 'Campo Requerido.'}
       },

       errorClass: "help-inline",
       errorElement: "span",
       highlight:function(element, errorClass, validClass) {
        $(element).parents('.control-group').addClass('error');
    },
    unhighlight: function(element, errorClass, validClass) {
        $(element).parents('.control-group').removeClass('error');
        $(element).parents('.control-group').addClass('success');
    }
});

      $(".datepicker" ).datepicker({ dateFormat: 'dd/mm/yy' });

  });

</script>

