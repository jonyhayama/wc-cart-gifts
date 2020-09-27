<?php
namespace wcCartGifts\controller;

class cart{
  public function __construct(){
    add_action('woocommerce_cart_contents', [ $this, 'append_cart_gift_rows' ]);
    add_action('woocommerce_review_order_after_cart_contents', [ $this, 'append_checkout_gift_rows' ]);
  }

  public function get_gift_rows_locals(){
    $total = WC()->cart->total;

    return [
      'the_query' => wc_cart_gifts('cart_gift')->query_by_value($total),
    ];
  }

  public function append_cart_gift_rows(){
    wc_cart_gifts()->get_template_part( [ 'template' => 'cart/gift_rows', 'locals' => $this->get_gift_rows_locals() ] );
  }

  public function append_checkout_gift_rows(){
    wc_cart_gifts()->get_template_part( [ 'template' => 'checkout/gift_rows', 'locals' => $this->get_gift_rows_locals() ] );
  }
}