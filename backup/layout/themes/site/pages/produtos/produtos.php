<?php
if(!(require_page('produtos') ||
   require_page('produtos/categoria/*') ||
   require_page('produtos/categoria/*/*'))
)
header('Location: ' . base_url() . 'error/404');
?>
    <div class="after">
        <div class="inter">
            <h2 id="blue">Atenção Visitante</h2>
            <p>
                Não efetuamos venda pelo site, esta area destina-se a consulta e simulação de pedido para os distibuidores cadastrados.
            </p>
        </div>
        <div class="my-cart">
            Meu carrinho: <span class="cart-num-itens"><?= $cart_itens ?></span> itens
            <?php
            if($cart_itens > 0)
                $display = 'display:block';
            else
                $display = 'display:none';
            ?>
            <span class="cart-finish" style="<?=$display?>"> | <b><a href="<?=base_url()?>orcamento">Enviar Orçamento</a></b></span>
        </div>
    
        <?php
            //Lista de Categoris
            include_file('pages/produtos/categorias.php');
        ?>

        <div class="content">
        <h1>Nossos Produtos</h1>
            <?php
                if(require_page('produtos/categoria/*'))
                {
                    include_file('pages/produtos/produto.php');
                }
                require_page('site/coracoes', 'pages/site/coracoes.php');
            ?>
        </div>
    </div>
    <div class="clear"></div>
    <div class="bg-blue after"></div>