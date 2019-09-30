<style>
/* Hiding the checkbox, but allowing it to be focused */
.badgebox
{
    opacity: 0;
}

.badgebox + .badge
{
    /* Move the check mark away when unchecked */
    text-indent: -999999px;
    /* Makes the badge's width stay the same checked and unchecked */
	width: 27px;
}

.badgebox:focus + .badge
{
    /* Set something to make the badge looks focused */
    /* This really depends on the application, in my case it was: */
    
    /* Adding a light border */
    box-shadow: inset 0px 0px 5px;
    /* Taking the difference out of the padding */
}

.badgebox:checked + .badge
{
    /* Move the check mark back when checked */
	text-indent: 0;
}
</style>
<link rel="stylesheet" href="<?php echo base_url();?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-align-justify"></i>
                </span>
                <h5>Editar Produto</h5>
            </div>
            <div class="widget-content nopadding">
                <?php echo $custom_error; ?>
                <form action="<?php echo current_url(); ?>" id="formProduto" method="post" class="form-horizontal" >
                     <div class="control-group">
                        <?php echo form_hidden('vw_produto_codigo', $result->produto_codigo) ?>
                        <label for="marca" class="control-label">Marca<span class="required">*</span></label>
                        <div class="controls">
                            <input id="vw_produto_marca" type="text" name="vw_produto_marca" value="<?php echo $result->marca_nome; ?>"  />
                            <input id="vw_produto_marca_id" type="hidden" name="vw_produto_marca_id" value="<?php echo $result->produto_marca_codigo; ?>"  />
                        </div>
                        <label for="descricao" class="control-label">Descrição<span class="required">*</span></label>
                        <div class="controls">
                            <input id="vw_produto_descricao" type="text" name="vw_produto_descricao" value="<?php echo $result->produto_descricao; ?>"  />
                        </div>
                        <label for="partnumber" class="control-label">Part Number</label>
                        <div class="controls">
                            <input id="vw_produto_partnumber" type="text" name="vw_produto_partnumber" value="<?php echo $result->produto_partnumber; ?>"  />
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Tipo de Movimento</label>
                        <div class="controls">
                            <label for="entrada" class="btn btn-default" style="margin-top: 5px;">Entrada 
                                <input type="checkbox" id="vw_produto_movimenta_entrada" name="vw_produto_movimenta_entrada" class="badgebox" value="1" 
                                    <?=($result->produto_movimenta_entrada == 1)?'checked':''?>>
                                <span class="badge" >&check;</span>
                            </label>
                            <label for="saida" class="btn btn-default" style="margin-top: 5px;">Saída 
                                <input type="checkbox" id="vw_produto_movimenta_saida" name="vw_produto_movimenta_saida" class="badgebox" value="1"
                                    <?=($result->produto_movimenta_saida == 1)?'checked':''?>>
                                <span class="badge" >&check;</span>
                            </label>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="precoCompra" class="control-label">Preço de Compra<span class="required">*</span></label>
                        <div class="controls">
                            <input id="vw_produto_preco_compra" class="money" type="text" name="vw_produto_preco_compra" value="<?php echo $result->produto_preco_compra; ?>"  />
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="precoVenda" class="control-label">Preço de Venda<span class="required">*</span></label>
                        <div class="controls">
                            <input id="vw_produto_preco_venda" class="money" type="text" name="vw_produto_preco_venda" value="<?php echo $result->produto_preco_venda; ?>"  />
                        </div>
                    </div>

                    <div class="control-group">
                    <label for="unidade" class="control-label">Unidade<span class="required">*</span></label>
                    <div class="controls">
                        <select id="vw_produto_unid_medida" name="vw_produto_unid_medida">
                            <option value="UN" <?=($result->produto_unid_medida == 'UN')?'selected':''?>>Unidade</option>
                            <option value="KG" <?=($result->produto_unid_medida == 'KG')?'selected':''?>>Kilograma</option>
                            <option value="LT" <?=($result->produto_unid_medida == 'LT')?'selected':''?>>Litro</option>
                            <option value="CX" <?=($result->produto_unid_medida == 'CX')?'selected':''?>>Caixa</option>
                        </select>                        
                    </div>
                    </div>                    

                    <div class="control-group">
                        <label for="estoque" class="control-label">Estoque<span class="required">*</span></label>
                        <div class="controls">
                            <input id="vw_produto_estoque_atual" type="text" name="vw_produto_estoque_atual" value="<?php echo $result->produto_estoque_atual; ?>"  />
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="estoqueMinimo" class="control-label">Estoque Mínimo</label>
                        <div class="controls">
                            <input id="vw_produto_estoque_minimo" type="text" name="vw_produto_estoque_minimo" value="<?php echo $result->produto_estoque_minimo; ?>"  />
                        </div>
                    </div>

                    <div class="form-actions">
                        <div class="span12">
                            <div class="span6 offset3">
                                <button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Alterar</button>
                                <a href="<?php echo base_url() ?>index.php/produtos" id="" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
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
      $("#vw_produto_marca").autocomplete({
            source: "<?php echo base_url(); ?>index.php/produtos/autoCompleteMarca",
            minLength: 1,
            select: function( event, ui ) {

                 $("#vw_produto_marca_id").val(ui.item.id);


            }
      });
}); 



    $(document).ready(function(){
        $(".money").maskMoney();

        $('#formProduto').validate({
            rules :{
                  vw_produto_descricao: { required: true},
                  vw_produto_unid_medida: { required: true},
                  vw_produto_preco_compra: { required: true},
                  vw_produto_preco_venda: { required: true},
                  vw_produto_estoque_atual: { required: true}
            },
            messages:{
                  vw_produto_descricao: { required: 'Campo Requerido.'},
                  vw_produto_unid_medida: {required: 'Campo Requerido.'},
                  vw_produto_preco_compra: { required: 'Campo Requerido.'},
                  vw_produto_preco_venda: { required: 'Campo Requerido.'},
                  vw_produto_estoque_atual: { required: 'Campo Requerido.'}
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




