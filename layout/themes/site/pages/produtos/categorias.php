<div class="sidebar">
    <h2>Categorias</h2>
    <ul class="category">
        <?php
            if(isset($categories) && count($categories) > 0)
            {
                foreach($categories as $c)
                {
                    echo '<li><a href="' . base_url() . 'produtos/categoria/' . $c->PCA_URL . '">'.$c->PCA_NAME.'</a></li>';
                }
            }
        ?>
    </ul>
</div>