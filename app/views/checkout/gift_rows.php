<?php
while( $the_query->have_posts() ){ $the_query->the_post(); ?>
  <tr class="wc-cart-gift-row">
    <td class="product-name">
      <?php the_title(); ?> <strong class="product-quantity">×&nbsp;1</strong>
    </td>
    <td class="product-total"><?php echo wc_price( WC()->cart->get_subtotal() ); ?></td>
  </tr>
<?php }
