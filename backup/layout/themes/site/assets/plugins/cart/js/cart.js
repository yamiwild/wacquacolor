jQuery( document ).ready(function() {
    var cart = jQuery(".cart");
    //Click Event
    cart.click(function(){
        var product = jQuery(this).attr('data-product');
        var product_name = jQuery(this).attr('data-product-name');
        if(jQuery.isNumeric(product))
        {
            jQuery.ajax({
                type: "POST",
                url: theme_base_url() + "assets/plugins/cart/php/register.php",
                data: { cod: product, action: 'register' }
            }).done(function( msg ) {
                var result = JSON.parse(msg);
                if(result.error_msg == 0)
                {
                    jQuery('.cart-num-itens').html(result.itens);
                    toastr.success(product_name + ' foi adicionado a sua lista');
                    if(!jQuery(".cart-finish").is(':visible'))
                    {
                        jQuery(".cart-finish").show();
                    }
                }
                else
                {
                    toastr.error(product_name + ' já encontra-se na sua lista');
                }
            });
        }
    })
});