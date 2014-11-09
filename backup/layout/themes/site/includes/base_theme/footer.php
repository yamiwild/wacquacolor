                <div class="bg-blue-last"></div>
            </div>
        </div>

        <footer>
        Acquacolor moldes de silicone © <?=date('Y')?>
        </footer>

        <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" src="<?php echo theme_base_url() ?>assets/scripts/weframework.js"></script>
        <script type="text/javascript" src="<?php echo theme_base_url() ?>assets/js/custom.js"></script>
        <script type="text/javascript" src="<?php echo theme_base_url() ?>assets/plugins/toastr/toastr.js"></script>
        <script type="text/javascript" src="<?php echo theme_base_url() ?>assets/plugins/cart/js/cart.js"></script>
        <script type="text/javascript" src="<?php echo theme_base_url() ?>assets/plugins/mask/jquery.mask.min.js"></script>

        <script type="text/javascript">
            jQuery( document ).ready(function() {
                $('#cnpj').mask('99.999.999/9999-99');
            });
        </script>
    </body>
</html>