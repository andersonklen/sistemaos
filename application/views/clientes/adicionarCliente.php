<link rel="stylesheet" href="<?php echo base_url();?>assets/js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-user"></i>
                </span>
                <h5>Cadastro de Cliente</h5>
            </div>
            <div class="widget-content nopadding">
                <?php if ($custom_error != '') {
                    echo '<div class="alert alert-danger">' . $custom_error . '</div>';
} ?>
                <form action="<?php echo current_url(); ?>" id="formCliente" method="post" class="form-horizontal" >


                     <div class="control-group">
                        <label  class="control-label">Tipo de Cliente</label>
                        <div class="controls">
                            <select name="vw_cliente_tipo" id="vw_cliente_tipo" onchange="js_check_tipo_cliente()">
                                <option value="fisica">Pessoa Física</option>
                                <option value="juridica">Pessoa Jurídica</option>
                            </select>
                        </div>
                    </div>


                    <div class="control-group">
                        <label for="nomeCliente" id="label_nome_razao"class="control-label">Nome<span class="required">*</span></label>
                        <div class="controls">
                            <input id="vw_cliente_nome_razao" type="text" name="vw_cliente_nome_razao" value="<?php echo set_value('nomeCliente'); ?>"  />
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="nomeCliente" id="label_apelido_nomefantasia" class="control-label">Apelido</label>
                        <div class="controls">
                            <input id="vw_cliente_apelido_fantasia" type="text" name="vw_cliente_apelido_fantasia" value="<?php echo set_value('nomeCliente'); ?>"  />
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="documento" id="label_cpf_cnpj" class="control-label">CPF<span class="required">*</span></label>
                        <div class="controls">
                            <input id="vw_cliente_cpf_cnpj" type="text" name="vw_cliente_cpf_cnpj" value="<?php echo set_value('documento'); ?>"  />
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="documento" id="label_rg_inscricao" class="control-label">RG</label>
                        <div class="controls">
                            <input id="vw_cliente_rg_inscricao" type="text" name="vw_cliente_rg_inscricao" value="<?php echo set_value('documento'); ?>"  />
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="vw_data_nasc" class="control-label">Data de Nascimento</label>
                        <div class="controls">
                            <input id="vw_cliente_data_nasc" type="text" name="vw_cliente_data_nasc"  class="form-control" onkeypress="$(this).mask('00/00/0000')" value="<?php echo set_value('Data de Nascimento'); ?>"  placeholder="DD/MM/AAAA"/>
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="vw_genero" class="control-label">Genero<span class="required">*</span></label>
                        <div class="controls">
                            <select name="vw_cliente_genero" id="vw_cliente_genero" >
                                <option value=""></option>
                                <option value="masculino">Masculino</option>
                                <option value="feminino">Feminino</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label for="telefone" class="control-label">Telefone 1<span class="required">*</span></label>
                        <div class="controls">
                            <input id="vw_cliente_tel01" type="text" name="vw_cliente_tel01" class="form-control" onkeypress="$(this).mask('(00) 0000-00009')" value="<?php echo set_value('telefone'); ?>"  />
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="celular" class="control-label">Telefone 2</label>
                        <div class="controls">
                            <input id="vw_cliente_tel02" type="text" name="vw_cliente_tel02" class="form-control" onkeypress="$(this).mask('(00) 0000-00009')" value="<?php echo set_value('celular'); ?>"  />
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="email" class="control-label">Email<span class="required">*</span></label>
                        <div class="controls">
                            <input id="vw_cliente_email" type="text" name="vw_cliente_email" value="<?php echo set_value('email'); ?>"  />
                        </div>
                    </div>
                    
                    <div class="control-group" class="control-label">
                        <label for="cep" class="control-label">CEP<span class="required">*</span></label>
                        <div class="controls">
                            <input id="vw_cliente_cep" type="text" name="vw_cliente_cep" class="form-control" onkeypress="$(this).mask('00.000-000')" value="<?php echo set_value('cep'); ?>"  value="<?php echo set_value('cep'); ?>"  />
                        </div>
                    </div>
                    

                    
                    <div class="control-group" class="control-label">
                        <label for="rua" class="control-label">Logradouro<span class="required">*</span></label>
                        <div class="controls">
                            <input id="vw_cliente_logradouro" type="text" name="vw_cliente_logradouro" value="<?php echo set_value('rua'); ?>"  />
                        </div>
                    </div>

                    <div class="control-group">
                        <label for="numero" class="control-label">Número<span class="required">*</span></label>
                        <div class="controls">
                            <input id="vw_cliente_numero" type="text" name="vw_cliente_numero" value="<?php echo set_value('numero'); ?>"  />
                        </div>
                    </div>

                    <div class="control-group" class="control-label">
                        <label for="bairro" class="control-label">Bairro<span class="required">*</span></label>
                        <div class="controls">
                            <input id="vw_cliente_bairro" type="text" name="vw_cliente_bairro" value="<?php echo set_value('bairro'); ?>"  />
                        </div>
                    </div>

                    <div class="control-group" class="control-label">
                        <label for="cidade" class="control-label">Cidade<span class="required">*</span></label>
                        <div class="controls">
                            <input id="vw_cliente_cidade" type="text" name="vw_cliente_cidade" value="<?php echo set_value('cidade'); ?>"  />
                             <input id="vw_cliente_cidade_id" type="hidden" name="vw_cliente_cidade_id" value="<?php echo set_value('cidade'); ?>"  />
                        </div>
                    </div>

                    <div class="control-group" class="control-label">
                        <label for="estado" class="control-label">Estado<span class="required">*</span></label>
                        <div class="controls">
                            <input id="vw_cliente_estado" type="text" name="vw_cliente_estado" value="<?php echo set_value('estado'); ?>"  />
                        </div>
                    </div>



                    <div class="form-actions">
                        <div class="span12">
                            <div class="span6 offset3">
                                <button type="submit" class="btn btn-success"><i class="icon-plus icon-white"></i> Adicionar</button>
                                <a href="<?php echo base_url() ?>index.php/clientes" id="" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
  // $(document).ready(function(){
   //         $("#vw_cliente_nome_razao").autocomplete({
   //             source: "<?php //echo base_url(); ?>index.php/clientes/autoCompleteCidade",
   //             minLength: 1,
   //             select: function( event, ui ) {
   //                  $("#vw_cliente_cidade_id").val(ui.item.id);
   //             }
   //         });




    $("#vw_cliente_cpf_cnpj").keydown(function(){
        try {
            $("#vw_cliente_cpf_cnpj").unmask();
        } catch (e) {

        }
    
        var tamanho = $("#vw_cliente_cpf_cnpj").val().length;
        if(tamanho < 11){
            $("#vw_cliente_cpf_cnpj").mask("999.999.999-99");
        } else if(tamanho >= 11){
            $("#vw_cliente_cpf_cnpj").mask("99.999.999/9999-99");
        }
    
        // ajustando foco
        var elem = this;
        setTimeout(function(){
             // mudo a posição do seletor
            elem.selectionStart = elem.selectionEnd = 10000;
        }, 0);
    
        // reaplico o valor para mudar o foco
        var currentValue = $(this).val();
        $(this).val('');
        $(this).val(currentValue);
    });





</script>
<script type="text/javascript">

$(document).ready(function(){
      $("#vw_cliente_cidade").autocomplete({
            source: "<?php echo base_url(); ?>index.php/clientes/autoCompleteCidade",
            minLength: 1,
            select: function( event, ui ) {

                 $("#vw_cliente_cidade_id").val(ui.item.id);


            }
      });
});


    function js_check_tipo_cliente(){
        var option = document.getElementById("vw_cliente_tipo").value;
        if(option == "fisica"){
            document.getElementById("label_nome_razao").innerHTML ="Nome*";
            document.getElementById("label_cpf_cnpj").innerHTML ="CPF*";
            document.getElementById("label_apelido_nomefantasia").innerHTML ="Apelido";
            document.getElementById("label_rg_inscricao").innerHTML ="RG";
            document.getElementById("vw_cliente_data_nasc").disabled  = false;
            document.getElementById("vw_cliente_genero").disabled  = false;
        }
        if(option == "juridica"){
           document.getElementById("label_nome_razao").innerHTML ="Razão Social*";
           document.getElementById("label_cpf_cnpj").innerHTML ="CNPJ*";
           document.getElementById("label_apelido_nomefantasia").innerHTML ="Nome Fantasia*";
           document.getElementById("label_rg_inscricao").innerHTML ="Inscr. Estadual";
           document.getElementById("vw_cliente_data_nasc").disabled  = true;
           document.getElementById("vw_cliente_genero").disabled  = true;
           document.getElementById("vw_cliente_data_nasc").value ="";
           document.getElementById("vw_cliente_genero").value ="";
        }
    }



           $('#formCliente').validate({
            rules :{
                  vw_cliente_tipo:{ required: true},
                  vw_cliente_nome_razao:{ required: true},
                  vw_cliente_cpf_cnpj:{ required: true},
                  vw_cliente_data_nasc:{ required: true},
                  vw_cliente_genero:{ required: true},
                  vw_cliente_tel01:{ required: true},
                  vw_cliente_email:{ required: true},                  
                  vw_cliente_logradouro:{ required: true},
                  vw_cliente_numero:{ required: true},
                  vw_cliente_bairro:{ required: true},
                  vw_cliente_cidade:{ required: true},
                  vw_cliente_estado:{ required: true},
                  vw_cliente_cep:{ required: true}
            },
            messages:{
                  vw_cliente_tipo :{ required: 'Campo Requerido.'},
                  vw_cliente_nome_razao :{ required: 'Campo Requerido.'},
                  vw_cpf_cnpj:{ required: 'Campo Requerido.'},
                  vw_cliente_data_nasc:{ required: 'Campo Requerido.'},
                  vw_cliente_genero:{ required: 'Campo Requerido.'},
                  vw_cliente_tel01:{ required: 'Campo Requerido.'},
                  vw_cliente_email:{ required: 'Campo Requerido.'},
                  vw_cliente_logradouro:{ required: 'Campo Requerido.'},
                  vw_cliente_numero:{ required: 'Campo Requerido.'},
                  vw_cliente_bairro:{ required: 'Campo Requerido.'},
                  vw_cliente_cidade:{ required: 'Campo Requerido.'},
                  vw_cliente_estado:{ required: 'Campo Requerido.'},
                  vw_cliente_cep:{ required: 'Campo Requerido.'}

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

</script>
<script type="text/javascript" >

        $(document).ready(function() {


            function limpa_formulario_cep() {
                // Limpa valores do formulário de cep.
                $("#vw_cliente_logradouro").val("");
                $("#vw_cliente_bairro").val("");
                $("#vw_cliente_cidade").val("");
                $("#vw_cliente_estado").val("");
            }
            
            //Quando o campo cep perde o foco.
            $("#vw_cliente_cep").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#vw_cliente_logradouro").val("...");
                        $("#vw_cliente_bairro").val("...");
                        $("#vw_cliente_cidade").val("...");
                        $("#vw_cliente_estado").val("...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#vw_cliente_logradouro").val(dados.logradouro);
                                $("#vw_cliente_bairro").val(dados.bairro);
                                $("#vw_cliente_cidade").val(dados.localidade);
                                $("#vw_cliente_estado").val(dados.uf);
                                document.getElementById("vw_cliente_numero").focus();
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulario_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulario_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulario_cep();
                }
            });
        });

    </script>
