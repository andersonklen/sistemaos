<?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'aCliente')) { ?>
    <a href="<?php echo base_url();?>index.php/clientes/adicionar" class="btn btn-success"><i class="icon-plus icon-white"></i> Adicionar Cliente</a>    
<?php } ?>

<?php
if (!$results) {?>

        <div class="widget-box">
        <div class="widget-title">
            <span class="icon">
                <i class="icon-user"></i>
            </span>
            <h5>Clientes</h5>

        </div>

        <div class="widget-content nopadding">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome / Razão</th>
                        <th>CPF / CNPJ</th>
                        <th>Telefone 1</th>
                        <th>Telefone 2</th>
                        <th>E-Mail</th>                        
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="5">Nenhum Cliente Cadastrado</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

<?php } else {
    

?>
<div class="widget-box">
     <div class="widget-title">
        <span class="icon">
            <i class="icon-user"></i>
         </span>
        <h5>Clientes</h5>

     </div>

<div class="widget-content nopadding">


<table class="table table-bordered ">
    <thead>
        <tr>
            <th>#</th>
            <th>Nome / Razão</th>
            <th>CPF / CNPJ</th>
            <th>Telefone 1</th>
            <th>Telefone 2</th>
            <th>E-Mail</th>              
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php           
            foreach ($results as $r) {
                //$i=$r->cliente_apelido_fantasia;
                if($r->cliente_apelido_fantasia<>''){                 
                    $cliente=$r->cliente_nome_razao.'  ( '.$r->cliente_apelido_fantasia.' )';
                } else {
                    $cliente=$r->cliente_nome_razao;                
                     
                }

            echo '<tr>';
            echo '<td>'.$r->cliente_codigo.'</td>';
            echo '<td>'.$cliente.'</td>';
            echo '<td>'.$r->cliente_cpf_cnpj.'</td>';
            echo '<td>'.$r->cliente_tel01.'</td>';
            echo '<td>'.$r->cliente_tel02.'</td>';
            echo '<td>'.$r->cliente_email.'</td>';
            echo '<td>';
            if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vCliente')) {
                echo '<a href="'.base_url().'index.php/clientes/visualizar/'.$r->cliente_codigo.'" style="margin-right: 1%" class="btn tip-top" title="Ver mais detalhes"><i class="icon-eye-open"></i></a>';
            }
            if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eCliente')) {
                echo '<a href="'.base_url().'index.php/clientes/editar/'.$r->cliente_codigo.'" style="margin-right: 1%" class="btn btn-info tip-top" title="Editar Cliente"><i class="icon-pencil icon-white"></i></a>';
            }
            if ($this->permission->checkPermission($this->session->userdata('permissao'), 'dCliente')) {
                echo '<a href="#modal-excluir" role="button" data-toggle="modal" cliente="'.$r->cliente_codigo.'" style="margin-right: 1%" class="btn btn-danger tip-top" title="Excluir Cliente"><i class="icon-remove icon-white"></i></a>';
            }

              
            echo '</td>';
            echo '</tr>';
}?>
        <tr>
            
        </tr>
    </tbody>
</table>
</div>
</div>
<?php echo $this->pagination->create_links();
}?>



 
<!-- Modal -->
<div id="modal-excluir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form action="<?php echo base_url() ?>index.php/clientes/excluir" method="post" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 id="myModalLabel">Excluir Cliente</h5>
  </div>
  <div class="modal-body">
    <input type="hidden" id="idCliente" name="id" value="" />
    <h5 style="text-align: center">Deseja realmente excluir este cliente e os dados associados a ele (OS, Vendas, Receitas)?</h5>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
    <button class="btn btn-danger">Excluir</button>
  </div>
  </form>
</div>






<script type="text/javascript">
$(document).ready(function(){


   $(document).on('click', 'a', function(event) {
        
        var cliente = $(this).attr('cliente');
        $('#idCliente').val(cliente);

    });

});

</script>
