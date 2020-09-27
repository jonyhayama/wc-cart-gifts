jQuery(document).ready(function($) {
  $('div.woocommerce').on('change', '.qty', function(){
    $( document ).data('wc-cart-gifts:has_updated', true);
  });
  
	$( document ).on( 'updated_cart_totals', function() {
		if( $( document ).data('wc-cart-gifts:has_updated') ) {
			$( document ).data('wc-cart-gifts:has_updated', false);
			return;
		}
		$( document ).data('wc-cart-gifts:has_updated', true);
		$(".woocommerce-cart-form [name='update_cart']").removeAttr('disabled').trigger("click");
  });
});
