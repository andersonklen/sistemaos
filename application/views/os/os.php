<link rel="stylesheet" href="<?php echo base_url();?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>

<div class="span12" style="margin-left: 0">
    <form method="get" action="<?php echo base_url(); ?>index.php/os/gerenciar">
        <?php if ($this->permission->checkPermission($this->session->userdata('permissao'), 'aOs')) { ?>
            <div class="span3">
                <a href="<?php echo base_url(); ?>index.php/os/adicionar" class="btn btn-success span12"><i class="icon-plus icon-white"></i> Adicionar OS</a>
            </div>
        <?php } ?>

        <div class="span3">
            <input type="text" name="vw_os_pesquisa"  id="vw_os_pesquisasa"  placeholder="Nome do cliente a pesquisar" class="span12" value="" >
        </div>
        <div class="span2">
            <select name="status" id="status" class="span12">
                <option value="">Selecione status</option>
                <option value="Aberto">Aberto</option>
                <option value="Faturado">Faturado</option>
                <option value="Em Andamento">Em Andamento</option>
                <option value="Orçamento">Orçamento</option>
                <option value="Finalizado">Finalizado</option>
                <option value="Cancelado">Cancelado</option>
            </select>

        </div>

        <div class="span3">
            <input type="text" name="data"  id="data"  placeholder="Data Inicial" class="span6 datepicker" value="">
            <input type="text" name="data2"  id="data2"  placeholder="Data Final" class="span6 datepicker" value="" >
        </div>
        <div class="span1">
            <button class="span12 btn"> <i class="icon-search"></i> </button>
        </div>
    </form>
</div>

<?php

if (!$results) {?>
    <div class="widget-box">
     <div class="widget-title">
        <span class="icon">
            <i class="icon-tags"></i>
         </span>
        <h5>Ordens de Serviço</h5>

     </div>

<div class="widget-content nopadding">


<table class="table table-bordered ">
    <thead>
        <tr style="backgroud-color: #2D335B">
            <th>#</th>
            <th>Cliente</th>
            <th>Data Inicial</th>
            <th>Data Final</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>
    <tbody>

        <tr>
            <td colspan="6">Nenhuma OS Cadastrada</td>
        </tr>
    </tbody>
</table>
</div>
</div>
<?php } else {?>


<div class="widget-box">
     <div class="widget-title">
        <span class="icon">
            <i class="icon-tags"></i>
         </span>
        <h5>Ordens de Serviço</h5>

     </div>

<div class="widget-content nopadding">

<table class="table table-bordered ">
    <thead>
        <tr style="backgroud-color: #2D335B">
            <th>#</th>
            <th>Cliente</th>
            <th>Equipamento</th>
            <th>S/N</th>
            <th>Atendente</th>
            <th>Técnico</th>            
            <th>Data Entrada</th>            
            <th>Prev. Entrega</th>            
            <th>Status</th>
            <th></th>
        </tr>
    </thead>  
    <tbody>
      <?php foreach ($results as $r) {
        $dataentrada = date(('d/m/Y'), strtotime($r->os_data_entrada));
        $dataFinal = date(('d/m/Y'), strtotime($r->os_data_final));
        if ($r->os_data_prev_entrega=='0000-00-00' ){
          $datapreventrega = '<span class="badge" style="background-color: #8B0000; border-color: #8B0000">Sem Previsão</span>';
        } else {
          $datapreventrega = date(('d/m/Y'), strtotime($datapreventrega));
        } 

        switch ($r->os_status) {
          case 'Aberto':
          $cor = '#8A9B0F';
          break;
          case 'Em Andamento':
          $cor = '#A7DBD8';
          break;
          case 'Orçamento':
          $cor = '#CDB380';
          break;
          case 'Cancelado':
          $cor = '#E97F02';
          break;
          case 'Finalizado':
          $cor = '#0B486B';
          break;
          case 'Faturado':
          $cor = '#B266FF';
          break;
          default:
          $cor = '#E0E4CC';
          break;
        }

        echo '<tr>';
        echo '<td>'.$r->os_codigo.'</td>';
        echo '<td>'.$r->cliente_nome_razao.'</td>';
        echo '<td>'.$r->equipamento_nome.'</td>';
        echo '<td>'.$r->os_numero_de_serie_equipamento.'</td>';                        
        echo '<td>'.$r->os_atendente.'</td>';
        echo '<td>'.$r->os_tecnico.'</td>';
        echo '<td>'.$dataentrada.'</td>';  
        echo '<td>'.$datapreventrega.'</td>';              
        echo '<td><span class="badge" style="background-color: '.$cor.'; border-color: '.$cor.'">'.$r->os_status.'</span> </td>';

        echo '<td>';
        if ($this->permission->checkPermission($this->session->userdata('permissao'), 'vOs')) {
          echo '<a style="margin-right: 1%" href="'.base_url().'index.php/os/visualizar/'.$r->os_codigo.'" class="btn tip-top" title="Ver mais detalhes"><i class="icon-eye-open"></i></a>';
          echo '<a style="margin-right: 1%" href="'.base_url().'index.php/os/imprimir/'.$r->os_codigo.'" target="_blank" class="btn btn-inverse tip-top" title="Imprimir"><i class="icon-print"></i></a>';
        }
        if ($this->permission->checkPermission($this->session->userdata('permissao'), 'eOs')) {
          echo '<a style="margin-right: 1%" href="'.base_url().'index.php/os/editar/'.$r->os_codigo.'" class="btn btn-info tip-top" title="Editar OS"><i class="icon-pencil icon-white"></i></a>';
        }
        if ($this->permission->checkPermission($this->session->userdata('permissao'), 'dOs')) {
          echo '<a href="#modal-excluir" role="button" data-toggle="modal" os="'.$r->os_codigo.'" class="btn btn-danger tip-top" title="Excluir OS"><i class="icon-remove icon-white"></i></a>  ';
        }


        echo  '</td>';
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
  <form action="<?php echo base_url() ?>index.php/os/excluir" method="post" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 id="myModalLabel">Excluir OS</h5>
  </div>
  <div class="modal-body">
    <input type="hidden" id="idOs" name="id" value="" />
    <h5 style="text-align: center">Deseja realmente excluir esta OS?</h5>
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
        
        var os = $(this).attr('os');
        $('#idOs').val(os);

    });

   $(document).on('click', '#excluir-notificacao', function(event) {
       event.preventDefault();
       
       $.ajax({
           url: '<?php echo site_url() ?>/os/excluir_notificacao',
           type: 'GET',
           dataType: 'json',
       })
       .done(function(data) {
           if(data.result == true){
              alert('Notificação excluída com sucesso');
              location.reload();
           }else{
              alert('Ocorreu um problema ao tentar exlcuir notificação.');
           }   


       });
       

   });

   $(".datepicker" ).datepicker({ dateFormat: 'dd/mm/yy' });

});

</script>