<div id="portfolio" class="scroll-portfolio clearfix">
    <?php
        if(isset($products) && count($products) > 0 && !is_null($products)) :
            foreach($products as $p):
    ?>
                <div class="portfolio-item pf-icons pf-media">
                    <div class="portfolio-image">
                        <img src="<?php echo theme_base_url()?>assets/images/1.jpg" />
                        <a class="hidden" rel="prettyPhoto[gal1]"></a>
                        <a class="hidden"  rel="prettyPhoto[gal1]"></a>
                        <div class="options" >
                            <a href="" id="description"> Descrição</a>
                            <a class="cart" id="buy" data-product="<?=$p->PR_COD?>" data-product-name="<?=$p->PR_NAME?>"> Adicionar à lista</a>
                        </div>

                        <div class="portfolio-overlay">
                            <div class="portfolio-overlay-wrap">
                            </div>
                            <div class="p-overlay-icons clearfix">
                                <a  class="p-o-gallery" rel="prettyPhoto[gal1]" href="<?php echo theme_base_url()?>assets/assets/images/grande/1.jpg"></a>
                            </div>
                        </div>
                    </div>
                </div>
    <?php
            endforeach;
        else:
            echo '<h2>Nenhum produto disponível.</h2>';
        endif;
    ?>
</div>