<?php
while( $the_query->have_posts() ){ $the_query->the_post(); ?>
  <tr class="wc-cart-gift-row">
    <td class="thumb">
      <?php if( has_post_thumbnail() ) { ?>
        <div class="wc-order-item-thumbnail"><?php the_post_thumbnail('thumb'); ?></div>
      <?php } ?>
    </td>
    <td class="product-name">
      <a href="<?php echo get_edit_post_link() ?>"><?php the_title(); ?></a>
      <?php the_content(); ?>
    </td>
    <td class="item_cost" width="1%" data-sort-value="0"><?php _e( 'Free', 'wc-cart-gifts' ); ?></td>
    <td class="quantity" width="1%"><small class="times">×</small> 1</td>
    <td class="line_cost" width="1%" data-sort-value="0"></td>
    <td></td>
  </tr>
<?php }
