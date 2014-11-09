<div class="content content-100">
    <h1>Orçamento</h1>
    <?php if(isset($products) && count($products) > 0): ?>
        <?php if(isset($msg)) echo $msg; ?>
        <form method="post">
            <label>CNPJ</label>
            <input name="cnpj" id="cnpj">
            <table class="table_orcamento">
                <tbody>

                    <?php foreach($products as $p): ?>
                        <tr>
                            <td>
                                Imagem
                            </td>
                            <td>
                                <?=$p->PR_NAME?>
                            </td>
                            <td>
                                <?=$p->PCA_NAME?>
                            </td>
                            <td>
                                <a href="<?=base_url()?>orcamento/deletar/<?=$p->PR_COD?>">Retirar da lista</a>
                            </td>
                        </tr>
                    <?php
                        endforeach;
                    ?>
                </tbody>
            </table>
            <button type="submit"><img src="http://localhost/clientes/acquacolor/layout/themes/site/assets/img/button.png" name="enviar"></button>
        </form>
    <?php
    else:
        echo '<h2 id="blue">Você não posui nenhum produto na sua lista, visite nossa página de <a href="'.base_url().'produtos">produtos</a></h2>';
    endif;
    ?>
</div>
<div class="clear"></div>
<div class="bg-blue after"></div>
