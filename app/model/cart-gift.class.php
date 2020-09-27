<?php
namespace wcCartGifts\model;

class cartGift{
  public function __construct(){
    add_action( 'init', array( $this, 'register_post_type' ), 0 );
    add_action( 'acf/init', array( $this, 'register_fields' ) );
  }

  public function find_ids_by_value( $value ){
    $args = [
      'post_type' => 'cart_gift',
      'posts_per_page' => -1,
      'meta_query' => [
        [
          'key' => 'active',
          'value' => true,
        ],
        [
          'key' => 'value',
          'value' => $value,
          'compare' => '<=',
          'type' => 'NUMERIC',
        ],
      ]
    ];

    $the_query = new \WP_Query( $args );
    $gifts = [];
    while( $the_query->have_posts() ){ $the_query->the_post();
      if( !get_field('cumulative') ){
        if( count($gifts) == 0 ){
          $gifts[] = get_the_ID();
          break;
        }
      } else {
        $gifts[] = get_the_ID();
      }
    }

    return $gifts;
  }

  public function query_by_ids( $gifts ){
    return new \WP_Query( [ 'post_type' => 'cart_gift', 'post__in' => ( $gifts ?: [0] ) ] ); // 'post__in' workaround: https://core.trac.wordpress.org/ticket/28099
  }

  public function query_by_value( $value ){
    $gifts = $this->find_ids_by_value( $value );

    return $this->query_by_ids( $gifts );
  }
  
  function register_post_type() {
    $labels = array(
      'name'                  => _x( 'Cart Gifts', 'Post Type General Name', 'wc-cart-gifts' ),
      'singular_name'         => _x( 'Cart Gift', 'Post Type Singular Name', 'wc-cart-gifts' ),
      'menu_name'             => __( 'Cart Gifts', 'wc-cart-gifts' ),
      'name_admin_bar'        => __( 'Cart Gift', 'wc-cart-gifts' ),
      'archives'              => __( 'Cart Gift Archives', 'wc-cart-gifts' ),
      'attributes'            => __( 'Cart Gift Attributes', 'wc-cart-gifts' ),
      'parent_item_colon'     => __( 'Parent Cart Gift:', 'wc-cart-gifts' ),
      'all_items'             => __( 'Cart Gifts', 'wc-cart-gifts' ),
      'add_new_item'          => __( 'Add New Cart Gift', 'wc-cart-gifts' ),
      'add_new'               => __( 'Add New Cart Gift', 'wc-cart-gifts' ),
      'new_item'              => __( 'New Cart Gift', 'wc-cart-gifts' ),
      'edit_item'             => __( 'Edit Cart Gift', 'wc-cart-gifts' ),
      'update_item'           => __( 'Update Cart Gift', 'wc-cart-gifts' ),
      'view_item'             => __( 'View Cart Gift', 'wc-cart-gifts' ),
      'view_items'            => __( 'View Cart Gifts', 'wc-cart-gifts' ),
      'search_items'          => __( 'Search Cart Gift', 'wc-cart-gifts' ),
      'not_found'             => __( 'Not found', 'wc-cart-gifts' ),
      'not_found_in_trash'    => __( 'Not found in Trash', 'wc-cart-gifts' ),
      'featured_image'        => __( 'Featured Image', 'wc-cart-gifts' ),
      'set_featured_image'    => __( 'Set featured image', 'wc-cart-gifts' ),
      'remove_featured_image' => __( 'Remove featured image', 'wc-cart-gifts' ),
      'use_featured_image'    => __( 'Use as featured image', 'wc-cart-gifts' ),
      'insert_into_item'      => __( 'Insert into Cart Gift', 'wc-cart-gifts' ),
      'uploaded_to_this_item' => __( 'Uploaded to this Cart Gift', 'wc-cart-gifts' ),
      'items_list'            => __( 'Cart Gifts list', 'wc-cart-gifts' ),
      'items_list_navigation' => __( 'Cart Gifts list navigation', 'wc-cart-gifts' ),
      'filter_items_list'     => __( 'Filter Cart Gifts list', 'wc-cart-gifts' ),
    );
    
    $args = array(
      'label'                 => __( 'Cart Gift', 'wc-cart-gifts' ),
      'description'           => __( 'Cart Gifts', 'wc-cart-gifts' ),
      'labels'                => $labels,
      'supports'              => array( 'title', 'thumbnail', 'editor' ),
      'hierarchical'          => false,
      'public'                => true,
      'show_ui'               => true,
      'show_in_menu'          => true,
      'menu_position'         => 5,
      'show_in_admin_bar'     => true,
      'show_in_nav_menus'     => true,
      'can_export'            => true,
      'has_archive'           => false,
      'exclude_from_search'   => true,
      'publicly_queryable'    => true,
    );
    register_post_type( 'cart_gift', $args );
  }

  public function register_fields(){
    acf_add_local_field_group(array(
      'key' => 'group_5f6cc8a532838',
      'title' => 'Cart Gift',
      'fields' => array(
        array(
          'key' => 'field_5f6cfce05057f',
          'label' => 'Active',
          'name' => 'active',
          'type' => 'true_false',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'message' => '',
          'default_value' => 1,
          'ui' => 1,
          'ui_on_text' => '',
          'ui_off_text' => '',
        ),
        array(
          'key' => 'field_5f6f8567d7066',
          'label' => 'Cumulative',
          'name' => 'cumulative',
          'type' => 'true_false',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'message' => '',
          'default_value' => 0,
          'ui' => 1,
          'ui_on_text' => '',
          'ui_off_text' => '',
        ),
        array(
          'key' => 'field_5f6cc8b8b9e37',
          'label' => 'Value',
          'name' => 'value',
          'type' => 'number',
          'instructions' => '',
          'required' => 0,
          'conditional_logic' => 0,
          'wrapper' => array(
            'width' => '',
            'class' => '',
            'id' => '',
          ),
          'default_value' => '',
          'placeholder' => '',
          'prepend' => '',
          'append' => '',
          'min' => '',
          'max' => '',
          'step' => '',
        ),
      ),
      'location' => array(
        array(
          array(
            'param' => 'post_type',
            'operator' => '==',
            'value' => 'cart_gift',
          ),
        ),
      ),
      'menu_order' => 0,
      'position' => 'normal',
      'style' => 'default',
      'label_placement' => 'top',
      'instruction_placement' => 'label',
      'hide_on_screen' => '',
      'active' => 1,
      'description' => '',
    ));
  }
}