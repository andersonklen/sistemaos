
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
                <h5>Editar OS</h5>
            </div>
            <div class="widget-content nopadding">
                <div class="span12" id="divProdutosServicos" style=" margin-left: 0">
                    <ul class="nav nav-tabs">
                        <li class="active" id="tabDetalhes"><a href="#tab1" data-toggle="tab">Detalhes da OS</a></li>
                        <li id="tabProdutos"><a href="#tab2" data-toggle="tab">Produtos</a></li>
                        <li id="tabServicos"><a href="#tab3" data-toggle="tab">Serviços</a></li>
                        <li id="tabAnexos"><a href="#tab4" data-toggle="tab">Anexos</a></li>
                    </ul>
                    <div class="tab-content">

                       <div class="tab-pane active" id="tab1">

                            <div class="span12" id="divCadastrarOs">
                                
                                <form action="<?php echo current_url(); ?>" method="post" id="formOs">
                                    <?php echo form_hidden('idOs', $result->os_codigo) ?>


                                    <div class="span12" style="padding: 1%; margin-left: 0">
                                        <h3>#Ordem de Serviço: <?php echo $result->os_codigo ?></h3>
                                        
                                        <div class="span6" style="margin-left: 0">
                                            <label for="data_entrada">Data de entrada do equipamento</label>
                                            <input id="vw_os_data_entrada" class="span12" type="text" name="vw_os_data_entrada" readonly="true" value="<?php echo date('d/m/Y', strtotime($result->os_data_entrada));?>" />
                                        </div>
                                        <div class="span6">
                                            <label for="atendente">Atendente</label>
                                            <input id="vw_os_data_atendente" class="span12" type="text" name="vw_os_data_atendente" readonly="true"  value="<?php echo $result->atendente ?>"  />
                                        </div>
                                    </div>

                                   
                                    <div class="span12" style="padding: 1%; margin-left: 0">                                      
                                        
                                        <div class="span6" style="margin-left: 0">
                                            <label for="cliente">Cliente<span class="required">*</span></label>
                                            <input id="vw_os_cliente" class="span12" type="text" name="vw_os_cliente" value="<?php echo $result->cliente_nome_razao ?>"  />
                                            <input id="vw_os_cliente_id" class="span12" type="hidden" name="vw_os_cliente_id" value="<?php echo $result->os_cliente_codigo ?>"  />
                                            <input id="valorTotal" type="hidden" name="valorTotal" value=""  />
                                        </div>



                                    </div>


                                    <div class="span12" style="padding: 1% ; margin-left: 0">
                                        <div class="span6">
                                            <label for="equipamento">Equipamento<span class="required">*</span></label>
                                            <input id="vw_os_equipamento" class="span12" type="text" name="vw_os_equipamento" value="<?php echo $result->os_equipamento_codigo ?>"  />
                                            <input id="vw_os_equipamento_id" class="span12" type="hidden" name="vw_os_equipamento_id" value="<?php echo $result->os_equipamento_codigo ?>"  />
                                        </div>
                                        <div class="span6">
                                            <label for="numero_de_serie">Num. de Série  </label>
                                            <input id="vw_os_numero_de_serie" class="span12" type="text" name="vw_os_numero_de_serie" value="<?php echo $result->os_numero_de_serie_equipamento ?>"  />                                            
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
                                                        <option value="0">Sem baterias</option>
                                                        <option value="1">1 bateria</option>
                                                        <option value="2">2 baterias</option>
                                                        <option value="3">3 baterias</option>
                                                        <option value="4">4 baterias</option>
                                                        <option value="5">5 baterias</option>                                                        
                                                    </select>
                                                </div>

                                                <div class="span4">
                                                    <label for="acessorios03">Carregador de Tomada<span class="required">*</span></label>                                                    
                                                    <select name="vw_os_acessorios03" id="vw_os_acessorios03" >
                                                        <option value=""></option>
                                                        <option value="Sim">Sim</option>
                                                        <option value="Não">Não</option>
                                                                        
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="span12" style="padding: 1% ; margin-left: 0">  
                                                <div class="span4">
                                                    <label for="acessorios04">Manuais <span class="required">*</span></label>                                                    
                                                    <select name="vw_os_acessorios04" id="vw_os_acessorios04" >
                                                        <option value=""></option>
                                                        <option value="Sim">Sim</option>
                                                        <option value="Não">Não</option>                                         
                                                    </select>
                                                </div>
                                                <div class="span4">
                                                    <label for="acessorios05">Protetor de Gimbal/Camera<span class="required">*</span></label>                                                    
                                                    <select name="vw_os_acessorios05" id="vw_os_acessorios05" >
                                                        <option value=""></option>
                                                        <option value="Sim">Sim</option>
                                                        <option value="Não">Não</option>                                      
                                                    </select>
                                                </div>                                                
                                                
                                                <div class="span4">
                                                    <label for="acessorios06">Bolsa de Transporte<span class="required">*</span></label>                                                    
                                                    <select name="vw_os_acessorios06" id="vw_os_acessorios06" >
                                                        <option value=""></option>
                                                        <option value="Sim">Sim</option>
                                                        <option value="Não">Não</option>                                                    
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



                                    <div class="span12" style="padding: 1%; margin-left: 0">
                                        <div class="span6">
                                            <label for="acessorios10">Outros acessórios</label>
                                            <textarea class="span12" name="vw_os_acessorios10" id="vw_os_acessorios10" style="width:100%;" rows="5"><?php echo $result->os_observacoes ?></textarea>
                                        </div>
                                        <div class="span6">
                                            <label for="observacoes">Observações</label>
                                            <textarea class="span12" name="vw_os_observações" id="observacoes" style="width:100%;" rows="5"><?php echo $result->os_observacoes ?></textarea>
                                        </div>
                                    </div>

                                    <div class="span12" style="padding: 1%; margin-left: 0">
                                        <div class="span12">
                                            <label for="defeito">Defeito relatado pelo cliente</label>
                                            <textarea class="span12" name="vw_os_defeito" id="vw_os_defeito" style="width:100%;" rows="5"><?php echo $result->os_defeito ?></textarea>
                                        </div>
                                    </div>



                                    <div class="span12" style="padding: 1%; margin-left: 0">
                                        <div class="span3">
                                            <label for="tecnico">Técnico / Responsável<span class="required">*</span></label>
                                            <input id="tecnico" class="span12" type="text" name="tecnico" value="<?php echo $result->tecnico ?>" />
                                            <input id="vw_os_tecnico_id" class="span12" type="hidden" name="vw_os_tecnico_id" value="<?php echo $result->os_tecnico_codigo ?>"  />
                                        </div>
                                        <div class="span3">
                                            <label for="vstatus">Status<span class="required">*</span></label>
                                            <select class="span12" name="vw_os_status" id="vw_os_status" value="">
                                                <option <?php if ($result->os_status == 'Orçamento') {  echo 'selected'; } ?> value="Orçamento">Na fila</option>
                                                <option <?php if ($result->os_status == 'Em Andamento') { echo 'selected'; } ?> value="Em Andamento">Em Andamento</option>
                                                <option <?php if ($result->os_status == 'Orçamento') {  echo 'selected'; } ?> value="Orçamento">Orçamento</option>
                                                <option <?php if ($result->os_status == 'Aberto') { echo 'selected'; } ?> value="Aberto">Aberto</option>
                                                <option <?php if ($result->os_status == 'Faturado') { echo 'selected'; } ?> value="Faturado">Faturado</option>                                                
                                                <option <?php if ($result->os_status == 'Finalizado') { echo 'selected'; } ?> value="Finalizado">Finalizado</option>
                                                <option <?php if ($result->os_status == 'Cancelado') { echo 'selected'; } ?> value="Cancelado">Cancelado</option>
                                            </select>
                                        </div>
                                        <div class="span2">
                                            <label for="previsao_entrega">Previsão de Entrega<span class="required">*</span></label>
                                            <input id="vw_os_data_prev_entrega" class="span12 datepicker" type="text" name="vw_os_data_prev_entrega" value="<?php echo date('d/m/Y', strtotime($result->os_data_inicial)); ?>"  />
                                        </div>
                                    </div>



                                    <div class="span12" style="padding: 1%; margin-left: 0">

                                        <div class="span6">
                                            <label for="descricaoProduto">Laudo técnico</label>
                                            <textarea class="span12" name="vw_os_laudo_tecnico" id="vw_os_laudo_tecnico" style="width:100%;" rows="5"><?php echo $result->os_laudo_tecnico?></textarea>
                                        </div>
                                        <div class="span6">
                                            <label for="defeito">Observações técnicas (Uso interno / não é impresso na O.S )</label>
                                            <textarea class="span12" name="vw_os_observacoes_internas" id="vw_os_observacoes_internas" style="width:100%;" rows="5"><?php echo $result->os_observacoes_internas?></textarea>
                                        </div>

                                    </div>                                    
                                    <div class="span12" style="padding: 1%; margin-left: 0">
                                        <div class="span6 offset3" style="text-align: center">
                                            <?php if ($result->os_faturado == 0) { ?>
                                                <a href="#modal-faturar" id="btn-faturar" role="button" data-toggle="modal" class="btn btn-success"><i class="icon-file"></i> Faturar</a>
                                            <?php } ?>
                                            <button class="btn btn-primary" id="btnContinuar"><i class="icon-white icon-ok"></i> Alterar</button>
                                            <a href="<?php echo base_url() ?>index.php/os/visualizar/<?php echo $result->os_codigo; ?>" class="btn btn-inverse"><i class="icon-eye-open"></i> Visualizar OS</a>
                                            <a href="<?php echo base_url() ?>index.php/os" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>


                        <!--Produtos-->
                        <div class="tab-pane" id="tab2">
                            <div class="span12 well" style="padding: 1%; margin-left: 0">
                                <form id="formProdutos" action="<?php echo base_url() ?>index.php/os/adicionarProduto" method="post">
                                    <div class="span8">
                                        <input type="hidden" name="idProduto" id="idProduto" />
                                        <input type="hidden" name="idOsProduto" id="idOsProduto" value="<?php echo $result->os_codigo?>" />
                                        <input type="hidden" name="estoque" id="estoque" value=""/>
                                        <input type="hidden" name="preco" id="preco" value=""/>
                                        <label for="">Produto</label>
                                        <input type="text" class="span12" name="produto" id="produto" placeholder="Digite o nome do produto" />
                                    </div>
                                    <div class="span2">
                                        <label for="">Quantidade</label>
                                        <input type="text" placeholder="Quantidade" id="quantidade" name="quantidade" class="span12" />
                                    </div>
                                    <div class="span2">
                                        <label for="">.</label>
                                        <button class="btn btn-success span12" id="btnAdicionarProduto"><i class="icon-white icon-plus"></i> Adicionar</button>
                                    </div>
                                </form>
                            </div>
                            <div class="span12" id="divProdutos" style="margin-left: 0">
                                <table class="table table-bordered" id="tblProdutos">
                                    <thead>
                                        <tr>
                                            <th>Produto</th>
                                            <th>Quantidade</th>
                                            <th>Ações</th>
                                            <th>Sub-total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $total = 0;
                                        foreach ($produtos as $p) {
                                            
                                            $total = $total + $p->subTotal;
                                            echo '<tr>';
                                            echo '<td>'.$p->produto_descricao.'</td>';
                                            echo '<td>'.$p->quantidade.'</td>';
                                            echo '<td><a href="" idAcao="'.$p->produtos_os_codigo.'" prodAcao="'.$p->idProdutos.'" quantAcao="'.$p->quantidade.'" title="Excluir Produto" class="btn btn-danger"><i class="icon-remove icon-white"></i></a></td>';
                                            echo '<td>R$ '.number_format($p->subTotal, 2, ',', '.').'</td>';
                                            echo '</tr>';
                                        }?>
                                       
                                        <tr>
                                            <td colspan="3" style="text-align: right"><strong>Total:</strong></td>
                                            <td><strong>R$ <?php echo number_format($total, 2, ',', '.');?><input type="hidden" id="total-venda" value="<?php echo number_format($total, 2); ?>"></strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>

                        <!--Serviços-->
                        <div class="tab-pane" id="tab3">
                            <div class="span12" style="padding: 1%; margin-left: 0">
                                <div class="span12 well" style="padding: 1%; margin-left: 0">
                                    <form id="formServicos" action="<?php echo base_url() ?>index.php/os/adicionarServico" method="post">
                                    <div class="span10">
                                        <input type="hidden" name="idServico" id="idServico" />
                                        <input type="hidden" name="idOsServico" id="idOsServico" value="<?php echo $result->os_codigo?>" />
                                        <input type="hidden" name="precoServico" id="precoServico" value=""/>
                                        <label for="">Serviço</label>
                                        <input type="text" class="span12" name="servico" id="servico" placeholder="Digite o nome do serviço" />
                                    </div>
                                    <div class="span2">
                                        <label for="">.</label>
                                        <button class="btn btn-success span12"><i class="icon-white icon-plus"></i> Adicionar</button>
                                    </div>
                                    </form>
                                </div>
                                <div class="span12" id="divServicos" style="margin-left: 0">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Serviço</th>
                                                <th>Ações</th>
                                                <th>Sub-total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $total = 0;
                                            foreach ($servicos as $s) {
                                                $preco = $s->preco;
                                                $total = $total + $preco;
                                                echo '<tr>';
                                                echo '<td>'.$s->nome.'</td>';
                                                echo '<td><span idAcao="'.$s->idServicos_os.'" title="Excluir Serviço" class="btn btn-danger"><i class="icon-remove icon-white"></i></span></td>';
                                                echo '<td>R$ '.number_format($s->preco, 2, ',', '.').'</td>';
                                                echo '</tr>';
                                            }?>

                                        <tr>
                                            <td colspan="2" style="text-align: right"><strong>Total:</strong></td>
                                            <td><strong>R$ <?php echo number_format($total, 2, ',', '.');?><input type="hidden" id="total-servico" value="<?php echo number_format($total, 2); ?>"></strong></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>


                        <!--Anexos-->
                        <div class="tab-pane" id="tab4">
                            <div class="span12" style="padding: 1%; margin-left: 0">
                                <div class="span12 well" style="padding: 1%; margin-left: 0" id="form-anexos">
                                    <form id="formAnexos" enctype="multipart/form-data" action="javascript:;" accept-charset="utf-8"s method="post">
                                    <div class="span10">
                                
                                        <input type="hidden" name="idOsServico" id="idOsServico" value="<?php echo $result->os_codigo?>" />
                                        <label for="">Anexo</label>
                                        <input type="file" class="span12" name="userfile[]" multiple="multiple" size="20" />
                                    </div>
                                    <div class="span2">
                                        <label for="">.</label>
                                        <button class="btn btn-success span12"><i class="icon-white icon-plus"></i> Anexar</button>
                                    </div>
                                    </form>
                                </div>
                
                                <div class="span12" id="divAnexos" style="margin-left: 0">
                                    <?php
                                    $cont = 1;
                                    $flag = 5;
                                    foreach ($anexos as $a) {

                                        if ($a->thumb == null) {
                                            $thumb = base_url().'assets/img/icon-file.png';
                                            $link = base_url().'assets/img/icon-file.png';
                                        } else {
                                            $thumb = base_url().'assets/anexos/thumbs/'.$a->thumb;
                                            $link = $a->url.$a->anexo;
                                        }

                                        if ($cont == $flag) {
                                            echo '<div style="margin-left: 0" class="span3"><a href="#modal-anexo" imagem="'.$a->idAnexos.'" link="'.$link.'" role="button" class="btn anexo" data-toggle="modal"><img src="'.$thumb.'" alt=""></a></div>';
                                            $flag += 4;
                                        } else {
                                            echo '<div class="span3"><a href="#modal-anexo" imagem="'.$a->idAnexos.'" link="'.$link.'" role="button" class="btn anexo" data-toggle="modal"><img src="'.$thumb.'" alt=""><p align="center">'. $a->anexo .'</p></a></div>';
                                        }
                                        $cont ++;
                                    } ?>
                                </div>
                            </div>
                        </div>
                


                    </div>

                </div>


.

        </div>

    </div>
</div>
</div>




 
<!-- Modal visualizar anexo -->
<div id="modal-anexo" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Visualizar Anexo</h3>
  </div>
  <div class="modal-body">
    <div class="span12" id="div-visualizar-anexo" style="text-align: center">
        <div class='progress progress-info progress-striped active'><div class='bar' style='width: 100%'></div></div>
    </div>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>
    <a href="" id-imagem="" class="btn btn-inverse" id="download">Download</a>
    <a href="" link="" class="btn btn-danger" id="excluir-anexo">Excluir Anexo</a>
  </div>
</div>





<!-- Modal Faturar-->
<div id="modal-faturar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<form id="formFaturar" action="<?php echo current_url() ?>" method="post">
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
  <h3 id="myModalLabel">Faturar Venda</h3>
</div>
<div class="modal-body">
    
    <div class="span12 alert alert-info" style="margin-left: 0"> Obrigatório o preenchimento dos campos com asterisco.</div>
    <div class="span12" style="margin-left: 0"> 
      <label for="descricao">Descrição</label>
      <input class="span12" id="descricao" type="text" name="descricao" value="Fatura de Venda - #<?php echo $result->os_codigo; ?> "  />
      
    </div>  
    <div class="span12" style="margin-left: 0"> 
      <div class="span12" style="margin-left: 0"> 
        <label for="cliente">Cliente*</label>
        <input class="span12" id="cliente" type="text" name="cliente" value="<?php echo $result->nomeCliente ?>" />
        <input type="hidden" name="clientes_id" id="clientes_id" value="<?php echo $result->clientes_id ?>">
        <input type="hidden" name="os_id" id="os_id" value="<?php echo $result->idOs; ?>">
      </div>
      
      
    </div>
    <div class="span12" style="margin-left: 0"> 
      <div class="span4" style="margin-left: 0">  
        <label for="valor">Valor*</label>
        <input type="hidden" id="tipo" name="tipo" value="receita" /> 
        <input class="span12 money" id="valor" type="text" name="valor" value="<?php echo number_format($total, 2); ?> "  />
      </div>
      <div class="span4" >
        <label for="vencimento">Data Vencimento*</label>
        <input class="span12 datepicker" id="vencimento" type="text" name="vencimento"  />
      </div>
      
    </div>
    
    <div class="span12" style="margin-left: 0"> 
      <div class="span4" style="margin-left: 0">
        <label for="recebido">Recebido?</label>
        &nbsp &nbsp &nbsp &nbsp <input  id="recebido" type="checkbox" name="recebido" value="1" /> 
      </div>
      <div id="divRecebimento" class="span8" style=" display: none">
        <div class="span6">
          <label for="recebimento">Data Recebimento</label>
          <input class="span12 datepicker" id="recebimento" type="text" name="recebimento" /> 
        </div>
        <div class="span6">
          <label for="formaPgto">Forma Pgto</label>
          <select name="formaPgto" id="formaPgto" class="span12">
            <option value="Dinheiro">Dinheiro</option>
            <option value="Cartão de Crédito">Cartão de Crédito</option>
            <option value="Cheque">Cheque</option>
            <option value="Boleto">Boleto</option>
            <option value="Depósito">Depósito</option>
            <option value="Débito">Débito</option>        
          </select> 
      </div>
      
    </div>
    
    
</div>
<div class="modal-footer">
  <button class="btn" data-dismiss="modal" aria-hidden="true" id="btn-cancelar-faturar">Cancelar</button>
  <button class="btn btn-primary">Faturar</button>
</div>
</form>
</div>





<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.validate.js"></script>
<script src="<?php echo base_url();?>assets/js/maskmoney.js"></script>

<script type="text/javascript">
$(document).ready(function(){
    
    $(".money").maskMoney(); 

     $('#recebido').click(function(event) {
        var flag = $(this).is(':checked');
        if(flag == true){
          $('#divRecebimento').show();
        }
        else{
          $('#divRecebimento').hide();
        }
     });

     $(document).on('click', '#btn-faturar', function(event) {
       event.preventDefault();
         valor = $('#total-venda').val();
         total_servico = $('#total-servico').val();
         valor = valor.replace(',', '' );
         total_servico = total_servico.replace(',', '' );
         total_servico = parseFloat(total_servico); 
         valor = parseFloat(valor);
         $('#valor').val(valor + total_servico);
     });
     
     $("#formFaturar").validate({
          rules:{
             descricao: {required:true},
             cliente: {required:true},
             valor: {required:true},
             vencimento: {required:true}
      
          },
          messages:{
             descricao: {required: 'Campo Requerido.'},
             cliente: {required: 'Campo Requerido.'},
             valor: {required: 'Campo Requerido.'},
             vencimento: {required: 'Campo Requerido.'}
          },
          submitHandler: function( form ){       
            var dados = $( form ).serialize();
            $('#btn-cancelar-faturar').trigger('click');
            $.ajax({
              type: "POST",
              url: "<?php echo base_url();?>index.php/os/faturar",
              data: dados,
              dataType: 'json',
              success: function(data)
              {
                if(data.result == true){
                    
                    window.location.reload(true);
                }
                else{
                    alert('Ocorreu um erro ao tentar faturar OS.');
                    $('#progress-fatura').hide();
                }
              }
              });

              return false;
          }
     });

     $("#produto").autocomplete({
            source: "<?php echo base_url(); ?>index.php/os/autoCompleteProduto",
            minLength: 2,
            select: function( event, ui ) {

                 $("#idProduto").val(ui.item.id);
                 $("#estoque").val(ui.item.estoque);
                 $("#preco").val(ui.item.preco);
                 $("#quantidade").focus();
                 

            }
      });

      $("#servico").autocomplete({
            source: "<?php echo base_url(); ?>index.php/os/autoCompleteServico",
            minLength: 2,
            select: function( event, ui ) {

                 $("#idServico").val(ui.item.id);
                 $("#precoServico").val(ui.item.preco);
                 

            }
      });


      $("#cliente").autocomplete({
            source: "<?php echo base_url(); ?>index.php/os/autoCompleteCliente",
            minLength: 2,
            select: function( event, ui ) {

                 $("#clientes_id").val(ui.item.id);


            }
      });

      $("#tecnico").autocomplete({
            source: "<?php echo base_url(); ?>index.php/os/autoCompleteUsuario",
            minLength: 2,
            select: function( event, ui ) {

                 $("#usuarios_id").val(ui.item.id);


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




      $("#formProdutos").validate({
          rules:{
             quantidade: {required:true}
          },
          messages:{
             quantidade: {required: 'Insira a quantidade'}
          },
          submitHandler: function( form ){
             var quantidade = parseInt($("#quantidade").val());
             var estoque = parseInt($("#estoque").val());
             if(estoque < quantidade){
                alert('Você não possui estoque suficiente.');
             }
             else{
                 var dados = $( form ).serialize();
                $("#divProdutos").html("<div class='progress progress-info progress-striped active'><div class='bar' style='width: 100%'></div></div>");
                $.ajax({
                  type: "POST",
                  url: "<?php echo base_url();?>index.php/os/adicionarProduto",
                  data: dados,
                  dataType: 'json',
                  success: function(data)
                  {
                    if(data.result == true){
                        $( "#divProdutos" ).load("<?php echo current_url();?> #divProdutos" );
                        $("#quantidade").val('');
                        $("#produto").val('').focus();
                    }
                    else{
                        alert('Ocorreu um erro ao tentar adicionar produto.');
                    }
                  }
                  });

                  return false;
                }

             }
             
       });

       $("#formServicos").validate({
          rules:{
             servico: {required:true}
          },
          messages:{
             servico: {required: 'Insira um serviço'}
          },
          submitHandler: function( form ){       
                 var dados = $( form ).serialize();
                 
                $("#divServicos").html("<div class='progress progress-info progress-striped active'><div class='bar' style='width: 100%'></div></div>");
                $.ajax({
                  type: "POST",
                  url: "<?php echo base_url();?>index.php/os/adicionarServico",
                  data: dados,
                  dataType: 'json',
                  success: function(data)
                  {
                    if(data.result == true){
                        $( "#divServicos" ).load("<?php echo current_url();?> #divServicos" );
                        $("#servico").val('').focus();
                    }
                    else{
                        alert('Ocorreu um erro ao tentar adicionar serviço.');
                    }
                  }
                  });

                  return false;
                }

       });


        $("#formAnexos").validate({
         
          submitHandler: function( form ){       
                //var dados = $( form ).serialize();
                var dados = new FormData(form); 
                $("#form-anexos").hide('1000');
                $("#divAnexos").html("<div class='progress progress-info progress-striped active'><div class='bar' style='width: 100%'></div></div>");
                $.ajax({
                  type: "POST",
                  url: "<?php echo base_url();?>index.php/os/anexar",
                  data: dados,
                  mimeType:"multipart/form-data",
                  contentType: false,
                  cache: false,
                  processData:false,
                  dataType: 'json',
                  success: function(data)
                  {
                    if(data.result == true){
                        $("#divAnexos" ).load("<?php echo current_url();?> #divAnexos" );
                        $("#userfile").val('');

                    }
                    else{
                        $("#divAnexos").html('<div class="alert fade in"><button type="button" class="close" data-dismiss="alert">×</button><strong>Atenção!</strong> '+data.mensagem+'</div>');      
                    }
                  },
                  error : function() {
                      $("#divAnexos").html('<div class="alert alert-danger fade in"><button type="button" class="close" data-dismiss="alert">×</button><strong>Atenção!</strong> Ocorreu um erro. Verifique se você anexou o(s) arquivo(s).</div>');      
                  }

                  });

                  $("#form-anexos").show('1000');
                  return false;
                }

        });

       $(document).on('click', 'a', function(event) {
            var idProduto = $(this).attr('idAcao');
            var quantidade = $(this).attr('quantAcao');
            var produto = $(this).attr('prodAcao');
            if((idProduto % 1) == 0){
                $("#divProdutos").html("<div class='progress progress-info progress-striped active'><div class='bar' style='width: 100%'></div></div>");
                $.ajax({
                  type: "POST",
                  url: "<?php echo base_url();?>index.php/os/excluirProduto",
                  data: "idProduto="+idProduto+"&quantidade="+quantidade+"&produto="+produto,
                  dataType: 'json',
                  success: function(data)
                  {
                    if(data.result == true){
                        $( "#divProdutos" ).load("<?php echo current_url();?> #divProdutos" );
                        
                    }
                    else{
                        alert('Ocorreu um erro ao tentar excluir produto.');
                    }
                  }
                  });
                  return false;
            }
            
       });



       $(document).on('click', 'span', function(event) {
            var idServico = $(this).attr('idAcao');
            if((idServico % 1) == 0){
                $("#divServicos").html("<div class='progress progress-info progress-striped active'><div class='bar' style='width: 100%'></div></div>");
                $.ajax({
                  type: "POST",
                  url: "<?php echo base_url();?>index.php/os/excluirServico",
                  data: "idServico="+idServico,
                  dataType: 'json',
                  success: function(data)
                  {
                    if(data.result == true){
                        $("#divServicos").load("<?php echo current_url();?> #divServicos" );

                    }
                    else{
                        alert('Ocorreu um erro ao tentar excluir serviço.');
                    }
                  }
                  });
                  return false;
            }

       });


       $(document).on('click', '.anexo', function(event) {
           event.preventDefault();
           var link = $(this).attr('link');
           var id = $(this).attr('imagem');
           var url = '<?php echo base_url(); ?>index.php/os/excluirAnexo/';
           $("#div-visualizar-anexo").html('<img src="'+link+'" alt="">');
           $("#excluir-anexo").attr('link', url+id);

           $("#download").attr('href', "<?php echo base_url(); ?>index.php/os/downloadanexo/"+id);

       });

       $(document).on('click', '#excluir-anexo', function(event) {
           event.preventDefault();

           var link = $(this).attr('link'); 
           $('#modal-anexo').modal('hide');
           $("#divAnexos").html("<div class='progress progress-info progress-striped active'><div class='bar' style='width: 100%'></div></div>");

           $.ajax({
                  type: "POST",
                  url: link,
                  dataType: 'json',
                  success: function(data)
                  {
                    if(data.result == true){
                        $("#divAnexos" ).load("<?php echo current_url();?> #divAnexos" );
                    }
                    else{
                        alert(data.mensagem);
                    }
                  }
            });
       });



       $(".datepicker" ).datepicker({ dateFormat: 'dd/mm/yy' });




});

</script>




