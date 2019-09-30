<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-align-justify"></i>
                </span>
                <h5>Cadastro de Equipamentos para Manutenção</h5>
            </div>
            <div class="widget-content nopadding">
                <?php echo $custom_error; ?>
                <form action="<?php echo current_url(); ?>" id="formServico" method="post" class="form-horizontal" >
                    <div class="control-group">
                        <label for="nome" class="control-label">Marca e Modelo<span class="required">*</span></label>
                        <div class="controls">
                            <input id="vw_equipamento_nome" type="text" name="vw_equipamento_nome" value="<?php echo set_value('equipamento_nome'); ?>"  />
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="modelo" class="control-label"><span class="required">Part Number</span></label>
                        <div class="controls">
                            <input id="vw_equipamento_partnumber" type="text" name="vw_equipamento_partnumber" value="<?php echo set_value('equipamento_modelo'); ?>"  />
                        </div>
                    </div>
         
                    <div class="form-actions">
                        <div class="span12">
                            <div class="span6 offset3">
                                <button type="submit" class="btn btn-success"><i class="icon-plus icon-white"></i> Adicionar</button>
                                <a href="<?php echo base_url() ?>index.php/equipamentos" id="btnAdicionar" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url()?>assets/js/jquery.validate.js"></script>
<script src="<?php echo base_url();?>assets/js/maskmoney.js"></script>
<script type="text/javascript">
      $(document).ready(function(){
          $(".money").maskMoney();
           $('#formServico').validate({
            rules :{
                  vw_equipamento_nome:{ required: true},
                  //vw_equipamento_partnumber:{ required: true}
            },
            messages:{
                  vw_equipamento_nome :{ required: 'Campo Requerido.'},
                  //vw_equipamento_partnumber :{ required: 'Campo Requerido.'}
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
      });
</script>




                                    
