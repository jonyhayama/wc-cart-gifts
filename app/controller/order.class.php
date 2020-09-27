<?php
namespace wcCartGifts\controller;

class order{
  public function __construct(){
    add_action('woocommerce_checkout_update_order_meta', [ $this, 'save_gift_data' ]);
    add_action('woocommerce_order_details_after_order_table_items', [ $this, 'append_gift_rows' ]);
    add_action('woocommerce_admin_order_items_after_line_items', [ $this, 'append_admin_gift_rows' ]);
  }

  public function save_gift_data( $order_id ){
    $order = new \WC_Order( $order_id );

    $gifts = wc_cart_gifts('cart_gift')->find_ids_by_value( $order->get_total() );

    update_post_meta( $order_id, 'wc_cart_gifts_ids', $gifts );
  }

  public function get_gift_rows_locals( $order ){
    $order = is_int( $order ) ? new \WC_Order( $order ) : $order;

    $gifts_ids = get_post_meta( $order->get_id(), 'wc_cart_gifts_ids', true );

    return [
      'the_query' => wc_cart_gifts('cart_gift')->query_by_ids($gifts_ids),
      'order' => $order,
    ];
  }

  public function append_gift_rows( $order ){
    wc_cart_gifts()->get_template_part( [ 'template' => 'order/gift_rows', 'locals' => $this->get_gift_rows_locals( $order ) ] );
  }

  public function append_admin_gift_rows( $order ){
    wc_cart_gifts()->get_template_part( [ 'template' => 'admin/order/gift_rows', 'locals' => $this->get_gift_rows_locals( $order ) ] );
  }
}