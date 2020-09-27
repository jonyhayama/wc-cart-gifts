<?php
namespace wcCartGifts\controller;

class cartGifts{
  public function __construct(){
    add_filter( 'manage_cart_gift_posts_columns', [$this, 'set_custom_edit_cart_gift_columns'] );
    add_action( 'manage_cart_gift_posts_custom_column' , [$this, 'custom_cart_gift_column'], 10, 2 );
  }

  public function set_custom_edit_cart_gift_columns( $columns ){
    $columns['value'] = __( 'Value', 'wc-cart-gitfs' );
    $columns['cumulative'] = __( 'Cumulative', 'wc-cart-gitfs' );
    $columns['active'] = __( 'Active', 'wc-cart-gitfs' );

    return $columns;
  }

  function custom_cart_gift_column( $column, $post_id ) {
    switch ( $column ) {
      case 'active':
        echo (get_field( 'active', $post_id )) ? __('Yes', 'wc-cart-gitfs') : __('No', 'wc-cart-gitfs');
        break;
      
      case 'value':
        echo wc_price( get_field( 'value', $post_id ) );
        break;
      
      case 'cumulative':
        echo (get_field( 'cumulative', $post_id )) ? __('Yes', 'wc-cart-gitfs') : __('No', 'wc-cart-gitfs');
        break;
    }
  }
}