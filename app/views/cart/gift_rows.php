<?php
while( $the_query->have_posts() ){ $the_query->the_post(); ?>
  <tr class="wc-cart-gift-row">
    <td class="product-remove"></td>
    <td class="product-thumbnail">
      <?php if( has_post_thumbnail() ) { ?>
        <div class="wc-cart-gift-thumbnail"><?php the_post_thumbnail('thumb'); ?></div>
      <?php } ?>
    </td>
    <td class="product-name">
      <?php the_title(); ?>
      <?php the_content(); ?>
    </td>
    <td class="product-price"><?php _e( 'Free', 'wc-cart-gifts' ); ?></td>
    <td class="product-quantity">1</td>
    <td class="product-subtotal"><?php echo wc_price( WC()->cart->get_subtotal() ); ?></td>
  </tr>
<?php }
