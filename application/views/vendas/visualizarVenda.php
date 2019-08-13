<?php $totalProdutos = 0;?>
<div class="row-fluid" style="margin-top: 0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-tags"></i>
                </span>
                <h5>Venda</h5>
                <div class="buttons">
                    <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eVenda')) {
                        echo '<a title="Icon Title" class="btn btn-mini btn-info" href="'.base_url().'index.php/vendas/editar/'.$result->venda_codigo.'"><i class="icon-pencil icon-white"></i> Editar</a>';
} ?>
                    
                    <a target="_blank" title="Imprimir" class="btn btn-mini btn-inverse" href="<?php echo site_url()?>/vendas/imprimir/<?php echo $result->venda_codigo; ?>"><i class="icon-print icon-white"></i> Imprimir</a>
                </div>
            </div>
            <div class="widget-content" id="printOs">
                <div class="invoice-content">
                    <div class="invoice-head">
                        <table class="table">
                            <tbody>

                                <?php if ($emitente == null) {?>
                                            
                                <tr>
                                    <td colspan="3" class="alert">Você precisa configurar os dados do emitente. >>><a href="<?php echo base_url(); ?>index.php/mapos/emitente">Configurar</a><<<</td>
                                </tr>
                                <?php } else {?>

                                <tr>
                                    <td style="width: 25%"><img src=" <?php echo $emitente[0]->emitente_url_logo; ?> "></td>
                                    <td> <span style="font-size: 20px; "> <?php echo $emitente[0]->emitente_nome; ?></span> </br><span><?php echo $emitente[0]->emitente_cnpj; ?> </br> <?php echo $emitente[0]->emitente_logradouro.', nº:'.$emitente[0]->emitente_numero.', '.$emitente[0]->emitente_bairro.' - '.$emitente[0]->emitente_cidade.' - '.$emitente[0]->emitente_uf; ?> </span> </br> <span> E-mail: <?php echo $emitente[0]->emitente_email.' - Fone: '.$emitente[0]->emitente_tel01; ?></span></td>
                                    <td style="width: 18%; text-align: center">#Venda: <span ><?php echo $result->venda_codigo?></span></br> </br> <span>Emissão: <?php echo date('d/m/Y');?></span>
	                                    <?php if ($result->venda_faturado) : ?>
                                            <br>
                                            Vencimento: <?php echo date('d/m/Y', strtotime($result->data_vencimento)); ?>
	                                    <?php endif; ?>
                                    </td>
                                </tr>

                                <?php } ?>
                            </tbody>
                        </table>
   
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td style="width: 50%; padding-left: 0">
                                        <ul>
                                            <li>
                                                <span><h5>Cliente</h5>
                                                <span><?php echo $result->cliente_nome_razao?></span><br/>
                                                <span><?php echo $result->cliente_logradouro?>, <?php echo $result->cliente_numero?>, <?php echo $result->cliente_bairro?></span><br/>
                                                <span><?php echo $result->cliente_cidade?> - <?php echo $result->cliente_estado?></span>
                                            </li>
                                        </ul>
                                    </td>
                                    <td style="width: 50%; padding-left: 0">
                                        <ul>
                                            <li>
                                                <span><h5>Vendedor</h5></span>
                                                <span><?php echo $result->usuario_nome?></span> <br/>
                                                <span>Telefone: <?php echo $result->usuario_tel01?></span><br/>
                                                
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table> 
      
                    </div>

                    <div style="margin-top: 0; padding-top: 0">


                        <?php if ($produtos != null) {?>
              
                        <table class="table table-bordered table-condensed" id="tblProdutos">
                                    <thead>
                                        <tr>
                                            <th style="font-size: 15px">Produto</th>
                                            <th style="font-size: 15px">Quantidade</th>
                                            <th style="font-size: 15px">Sub-total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                        foreach ($produtos as $p) {

                                            $totalProdutos = $totalProdutos + $p->item_de_venda_subtotal;
                                            echo '<tr>';
                                            echo '<td>'.$p->produto_descricao.'</td>';
                                            echo '<td>'.$p->item_de_venda_quantidade.'</td>';
                                            
                                            echo '<td>R$ '.number_format($p->item_de_venda_subtotal, 2, ',', '.').'</td>';
                                            echo '</tr>';
                                        }?>

                                        <tr>
                                            <td colspan="2" style="text-align: right"><strong>Total:</strong></td>
                                            <td><strong>R$ <?php echo number_format($totalProdutos, 2, ',', '.');?></strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php }?>
                        
                
                        <hr />
                    
                        <h4 style="text-align: right">Valor Total: R$ <?php echo number_format($totalProdutos, 2, ',', '.');?></h4>

                    </div>
            

                    
                    
              
                </div>
            </div>
        </div>
    </div>
</div>
