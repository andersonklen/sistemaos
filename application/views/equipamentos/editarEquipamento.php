<div class="row-fluid" style="margin-top:0">
                              <div class="span12">
                                    <div class="widget-box">
                                          <div class="widget-title">
                                                <span class="icon">
                                                      <i class="icon-align-justify"></i>
                                                </span>
                                                <h5>Editar Equipamento</h5>
                                          </div>
                                          <div class="widget-content nopadding">
                                                <?php echo $custom_error; ?>
                                                <form action="<?php echo current_url(); ?>" id="formEquipamentos" method="post" class="form-horizontal" >
                                                    <?php echo form_hidden('vw_hi_equipamento_codigo', $result->equipamento_codigo) ?>
                                                    <div class="control-group">
                                                            <label for="nome" class="control-label">Nome<span class="required">*</span></label>
                                                            <div class="controls">
                                                                  <input id="vw_equipamento_nome" type="text" name="vw_equipamento_nome" value="<?php echo $result->equipamento_nome ?>"  />
                                                            </div>
                                                      </div>
                                                      <div class="control-group">
                                                            <label for="modelo" class="control-label"><span class="required">Modelo*</span></label>
                                                            <div class="controls">
                                                                <input id="vw_equipamento_partnumber" type="text" name="vw_equipamento_partnumber" value="<?php echo $result->equipamento_partnumber ?>"  />
                                                            </div>
                                                      </div>

                                                      <div class="form-actions">
                                                      <div class="span12">
                                                            <div class="span6 offset3">
                                                            <button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Alterar</button>
                                                            <a href="<?php echo base_url()?>index.php/equipamentos" id="btnAdicionar" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
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
                  nome:{ required: true},
            },
            messages:{
                  nome :{ required: 'Campo Requerido.'},
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



