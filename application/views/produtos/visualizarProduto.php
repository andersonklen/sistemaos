<div class="accordion" id="collapse-group">
    <div class="accordion-group widget-box">
        <div class="accordion-heading">
            <div class="widget-title">
                <a data-parent="#collapse-group" href="#collapseGOne" data-toggle="collapse">
                    <span class="icon"><i class="icon-list"></i></span><h5>Dados do Produto</h5>
                </a>
            </div>
        </div>
        <div class="collapse in accordion-body">
            <div class="widget-content">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td style="text-align: right; width: 30%"><strong>Descrição</strong></td>
                            <td><?php echo $result->produto_descricao ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><strong>Unidade</strong></td>
                            <td><?php echo $result->produto_unid_medida ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><strong>Preço de Compra</strong></td>
                            <td>R$ <?php echo $result->produto_preco_compra; ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><strong>Preço de Venda</strong></td>
                            <td>R$ <?php echo $result->produto_preco_venda; ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><strong>Estoque</strong></td>
                            <td><?php echo $result->produto_estoque_atual; ?></td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><strong>Estoque Mínimo</strong></td>
                            <td><?php echo $result->produto_estoque_minimo; ?></td>
                        </tr>
                  
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

