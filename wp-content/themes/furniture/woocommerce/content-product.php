<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$meta = _WSH()->get_meta('_sh_layout_settings', get_option( 'woocommerce_shop_page_id' ));

$layout = sh_set( $meta, 'layout', 'full' );

$layout = sh_set( $_GET, 'layout' ) ? $_GET['layout'] : $layout;

if( !$layout || $layout == 'full' || sh_set($_GET, 'layout_style')=='full' ) {
	$classes[] = 'col-lg-3 col-md-3 col-sm-3 col-xs-12';
} else {
	$classes[] = 'col-lg-4 col-md-4 col-sm-4 col-xs-12';
}

$options = _WSH()->option();
$hide_overlay = sh_set($options,'hide_overlay');
?>

<li <?php post_class("col-sm-3 product"); ?>>

	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

	 <div class="productInner row m0">

		<div class="row m0 imgHov">
			<a href="<?php the_permalink();?>">
				<?php the_post_thumbnail('270x341', array('class' => 'img-responsive'));?>
			</a>
			<?php 
				$post_thumbnail_id = get_post_thumbnail_id($post->ID);
				$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
			?>
			<div class="row m0 hovArea">
				<div class="row m0 icons">
					<ul class="list-inline">
						<li><a href="javascript:void(0);" class="add_to_wishlist" data-id="<?php the_ID(); ?>"><i class="fa fa-heart"></i></a></li>
						<li><a href="javascript:void(0);" class="add_to_compare" data-id="<?php the_ID(); ?>"><i class="fa fa-exchange"></i></a></li>
						<li><a href="<?php echo esc_url($post_thumbnail_url);?>" data-lightbox="product4" data-title="WOW SOFAS"><i class="fa fa-expand"></i></a></li>
					</ul>                                    
				</div>
				<div class="row m0 proType"><?php the_terms( $post->ID, 'product_cat', '', ' , ' ); ?></div>
				<div class="row m0 proRating">
					<?php woocommerce_template_loop_rating(); ?>
				</div>
				<div class="row m0 proPrice"><i class="fa fa-usd"></i><?php woocommerce_template_loop_price();?></div>
			</div>
		  </div>
		  
		  
	<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>		

		  
		  <?php

			/**

			 * woocommerce_before_shop_loop_item_title hook

			 *

			 * @hooked woocommerce_show_product_loop_sale_flash - 10

			 * @hooked woocommerce_template_loop_product_thumbnail - 10

			 */

			do_action( 'woocommerce_before_shop_loop_item_title' );

		  ?>
		  
		  <div class="row m0 proName"><a href="<?php the_permalink();?>"><?php the_title();?></a></div>	
		  
		  <?php

			/**
	
			 * woocommerce_after_shop_loop_item_title hook
	
			 *
	
			 * @hooked woocommerce_template_loop_rating - 5
	
			 * @hooked woocommerce_template_loop_price - 10
	
			 */
	
			do_action( 'woocommerce_after_shop_loop_item_title' );
	
		  ?>
		  
		  <div class="row m0 proBuyBtn">
			<button class="addToCart btn" onClick="location.href='<?php the_permalink();?>'"><?php esc_html_e('add to cart', 'furniture');?></button>
		  </div>
		
	</div>
	
</li>