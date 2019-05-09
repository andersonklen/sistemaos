<?php $totalServico = 0;
$totalProdutos = 0;?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<title>Map OS</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/matrix-style.css" />
<link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
<style>
    .table {
        margin-bottom: 5px;
    }
</style>
</head>
<body>

 
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
       
        <div class="invoice-content">
                <div class="invoice-head" style="margin-bottom: 0">

                    <table class="table table-condensed" style="">
                        <tbody>
                            <?php if ($emitente == null) {?>
                                        
                            <tr>
                                <td colspan="3" class="alert">Você precisa configurar os dados do emitente. >>><a href="<?php echo base_url(); ?>index.php/mapos/emitente">Configurar</a><<<</td>
                            </tr>
                            <?php } else {?>
                            <tr>
                                <td style="width: 25%"><img src=" <?php echo $emitente[0]->emitente_url_logo; ?> " style="max-height: 100px"></td>
                                <td> <span style="font-size: 20px; "> <?php echo $emitente[0]->emitente_nome; ?></span> </br><span><?php echo $emitente[0]->emitente_cnpj; ?> </br> <?php echo $emitente[0]->emitente_logradouro.', '.$emitente[0]->emitente_numero.' - '.$emitente[0]->emitente_bairro.' - '.$emitente[0]->emitente_cidade.' - '.$emitente[0]->emitente_uf; ?> </span> </br> <span> E-mail: <?php echo $emitente[0]->emitente_email.' - Fone: '.$emitente[0]->emitente_tel01; ?></span></td>
                                <td style="width: 18%; text-align: center"><b>#PROTOCOLO:</b> <span ><?php echo $result->os_codigo?></span></br> </br> <span>Emissão: <?php echo date('d/m/Y')?></span></td>
                            </tr>

                            <?php } ?>
                        </tbody>
                    </table>

            
                    <table class="table table-condensend">
                        <tbody>
                            <tr>
                                <td style="width: 50%; padding-left: 0">
                                    <ul>
                                        <li>
                                            <span><h5><b>CLIENTE</b></h5>
                                            <span><?php echo $result->cliente_nome_razao?></span><br/>
                                            <span><?php echo $result->cliente_logradouro?>, <?php echo $result->cliente_numero?>, <?php echo $result->cliente_bairro?></span>, 
                                            <span><?php echo $result->cliente_cidade?> - <?php echo $result->cliente_estado?></span><br>
                                            <span>E-mail: <?php echo $result->cliente_email?></span><br>
                                            <span>Celular: <?php echo $result->cliente_tel01?></span>
                                        </li>
                                    </ul>
                                </td>
                                <td style="width: 50%; padding-left: 0">
                                    <ul>
                                        <li>
                                            <span><h5><b>RESPONSÁVEL</b></h5></span>
                                            <span><?php echo $result->usuario_nome?></span> <br/>
                                            <span>Telefone: <?php echo $result->usuario_tel01?></span><br/>
                                            <span>Email: <?php echo $result->email_responsavel ?></span>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table> 
    
                </div>

                <div style="margin-top: 0; padding-top: 0">
                    

                    <table class="table table-condensed">
                        <tbody>
                            
                            <?php if($result->os_data_inicial != null){?>
                            <tr>
                                <td>
                                <b>DATA INICIAL: </b>
                                <?php echo date('d/m/Y', strtotime($result->os_data_inicial)); ?>
                                </td>

                                <td>
                                <b>DATA FINAL: </b>
                                <?php echo $result->os_data_final ? date('d/m/Y', strtotime($result->os_data_final)) : ''; ?>
                                </td>

                                <td>
                                <b>GARANTIA: </b>
                                <?php echo $result->os_garantia; ?>
                                </td>

                            </tr>
                            <?php }?>

                            <?php if($result->os_descricao_produto != null){?>
                            <tr>
                                <td colspan="3">
                                <b>DESCRIÇÃO: </b>
                                <?php echo $result->os_descricao_produto ?>
                                </td>
                            </tr>
                            <?php }?>
            
                            <?php if($result->os_defeito != null){?>
                            <tr>
                                <td colspan="3">
                                <b>DEFEITO APRESENTADO: </b>
                                <?php echo $result->os_defeito?>
                                </td>
                            </tr>
                            <?php }?>
                            
                            <?php if($result->os_observacoes != null){?>
                            <tr>
                                <td colspan="3">
                                <b>OBSERVAÇÕES: </b>
                                <?php echo $result->os_observacoes?>
                                </td>
                            </tr>
                            <?php }?>

                            <?php if($result->os_laudo_tecnico != null){?>
                            <tr>
                                <td colspan="3">
                                <b>LAUDO TÉCNICO: </b>
                                <?php echo $result->os_laudo_tecnico?>
                                </td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                    
                    <?php if ($produtos != null) {?>
                        <br />
                        <table class="table table-bordered table-condensed" id="tblProdutos">
                                    <thead>
                                        <tr>
                                            <th>Produto</th>
                                            <th>Quantidade</th>
                                            <th>Sub-total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                        foreach ($produtos as $p) {

                                            $totalProdutos = $totalProdutos + $p->subTotal;
                                            echo '<tr>';
                                            echo '<td>'.$p->descricao.'</td>';
                                            echo '<td>'.$p->quantidade.'</td>';
                                            
                                            echo '<td>R$ '.number_format($p->subTotal, 2, ',', '.').'</td>';
                                            echo '</tr>';
                                        }?>

                                        <tr>
                                            <td colspan="2" style="text-align: right"><strong>Total:</strong></td>
                                            <td><strong>R$ <?php echo number_format($totalProdutos, 2, ',', '.');?></strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php }?>
                        
                                <?php if ($servicos != null) {?>
                            <table class="table table-bordered table-condensed">
                                    <thead>
                                        <tr>
                                            <th>Serviço</th>
                                            <th>Sub-total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        setlocale(LC_MONETARY, 'en_US');
                                        foreach ($servicos as $s) {
                                            $preco = $s->preco;
                                            $totalServico = $totalServico + $preco;
                                            echo '<tr>';
                                            echo '<td>'.$s->nome.'</td>';
                                            echo '<td>R$ '.number_format($s->preco, 2, ',', '.').'</td>';
                                            echo '</tr>';
                                        }?>

                                        <tr>
                                            <td colspan="1" style="text-align: right"><strong>Total:</strong></td>
                                            <td><strong>R$ <?php  echo number_format($totalServico, 2, ',', '.');?></strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                        <?php }?>
                        <h4 style="text-align: right">Valor Total: R$ <?php echo number_format($totalProdutos + $totalServico, 2, ',', '.');?></h4>

                        <table class="table table-bordered table-condensed">                                      
                            <tbody>
                                    <tr> 
                                        <td>Data <hr></td>
                                        <td>Assinatura do Cliente <hr></td>
                                        <td>Assinatura do Responsável <hr></td>
                                    </tr>
                            </tbody>
                        </table>

                </div>
            </div>                
      </div>
    </div>
  </div>



<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script> 
<script src="<?php echo base_url();?>assets/js/matrix.js"></script> 

<script>
    window.print();
</script>

</body>
</html>







