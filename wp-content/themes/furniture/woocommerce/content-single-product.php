<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );
	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
$prod_meta = _WSH()->get_meta();
?>

<div id="product-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
		
	<?php //woocommerce_show_product_images(); 
	
	do_action( 'woocommerce_before_single_product_summary' ); ?>
		
	 <div class="col-sm-5">
	 	
		<?php
			/**
			 * woocommerce_single_product_summary hook
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_rating - 10
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 */
			do_action( 'woocommerce_single_product_summary' );
		?>
        
		<div class="row m0">
			<h4 class="heading"><?php woocommerce_template_single_title(); ?></h4>
			<h3 class="heading price"><?php woocommerce_template_single_price(); ?></h3>
			<div class="row m0 starsRow">
			<?php woocommerce_template_single_rating();?>
			</div>
			<div class="row descList m0">
				<dl class="dl-horizontal">
					
					<?php if(sh_set($prod_meta, 'manufacturer')):?>
						<dt><?php esc_html_e('manufacturer :', 'furniture');?></dt>
						<dd><?php echo sh_set($prod_meta, 'manufacturer');?></dd>
					<?php endif;?>
					<?php if(sh_set($prod_meta, 'availabilty')):?>
						<dt><?php esc_html_e('availability :', 'furniture');?></dt>
						<dd><?php echo sh_set($prod_meta, 'availabilty');?></dd>
					<?php endif;?>
					<?php if(sh_set($prod_meta, 'product_code')):?>
						<dt><?php esc_html_e('product code :', 'furniture');?></dt>
						<dd><?php echo sh_set($prod_meta, 'product_code');?></dd>
					<?php endif;?>
				
				</dl>
			</div>
			<div class="row m0 shortDesc">
				<p class="m0"><?php woocommerce_template_single_excerpt();?></p>
			</div>
			<div class="row m0 colorSelect">
				<h5 class="heading proAttr"><?php esc_html_e('Color :', 'furniture');?></h5>
				<?php if($color_arr = sh_set($prod_meta, 'product_color')):?>
					<?php foreach($color_arr as $key => $color): 
						$color = array_filter( $color );
						if( ! $color ) continue; ?>	
						<input type="radio" id="cl1<?php echo esc_attr($key);?>" name="proColor">
						<label for="cl1"><span style="background-color:<?php echo esc_attr($color['product_color']);?>"></span></label>
					<?php endforeach;?>
			<?php endif;?>	
			</div>
			<div class="row m0">
				<ul class="list-inline wce">
					<li><a href="javascript:void(0);" class="add_to_wishlist" data-id="<?php the_ID(); ?>"><img src="<?php echo get_template_directory_uri();?>/images/icons/heart.png" alt=""><?php esc_html_e('Add to Wishlist', 'furniture');?></a></li>
					<li><a href="javascript:void(0);" class="add_to_compare" data-id="<?php the_ID(); ?>"><img src="<?php echo get_template_directory_uri();?>/images/icons/compare.png" alt=""><?php esc_html_e('Add to Compare', 'furniture');?></a></li>
					<li><a data-toggle="modal" data-target="#myModal"><img src="<?php echo get_template_directory_uri();?>/images/icons/email.png" alt=""><?php esc_html_e('Email to a Friend', 'furniture');?></a></li>
				</ul>
			</div>
			<div class="row m0 qtyAtc">
				
				<?php echo woocommerce_template_single_add_to_cart();?>
			</div>
		</div>
     </div>            

	<div class="clearfix"></div>

	<hr/>
	
	<div class="col-md-12">
		<?php
			/**
			 * woocommerce_after_single_product_summary hook
			 *
			 * @hooked woocommerce_output_product_data_tabs - 10
			 * @hooked woocommerce_upsell_display - 15
			 * @hooked woocommerce_output_related_products - 20
			 */
			do_action( 'woocommerce_after_single_product_summary' );
		?>
	</div>
	<meta itemprop="url" content="<?php the_permalink(); ?>" />

</div>
<!-- #product-<?php the_ID(); ?> -->
<?php do_action( 'woocommerce_after_single_product' ); ?>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php esc_html_e('Email to a friend', 'furniture');?></h4>
      </div>
      <form action="#" method="post" id="_mail_to_friend">
	  <div class="modal-body">
	  	
		
			<label for="email"><?php esc_html_e('Email Address', 'furniture');?></label>
			<input type="email" name="friend_email" class="form-control" />
		
		
		
		
		
			<label for="email"><?php esc_html_e('Email Content', 'furniture');?></label>
			<textarea name="friend_message" class="form-control">
Hi,

Checkout this awesome product <?php the_permalink(); ?>
				
			</textarea>
			
			<?php wp_nonce_field( 'furniture_tellafriend_nonce_action', "_wpnonce" ); ?>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary"><?php esc_html_e('Send Email', 'furniture');?></button>
      </div>
	  </form>
    </div>
  </div>
</div>