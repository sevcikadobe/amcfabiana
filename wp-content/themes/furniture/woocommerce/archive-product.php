<?php
 
$options = _WSH()->option();
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$shop_id = get_option( 'woocommerce_shop_page_id' );
$bg_image = '';

if( $shop_id && is_archive('product') && !(is_tax( 'product_cat' )) ) {
	$meta1 = _WSH()->get_meta('_sh_layout_settings', $shop_id); //print_r($meta1);exit;
	$meta = _WSH()->get_meta('_sh_header_settings', $shop_id);
	$layout = sh_set( $meta1, 'layout', 'full' );
	$bg_image = sh_set( $meta, 'bg_image', 'full' );
}
elseif( is_tax( 'product_cat' ) || is_tax( 'product_tag' ) )
{
	$meta1 = _WSH()->get_term_meta( '_sh_category_settings' );//print_r($meta1);exit; 
	//$meta = _WSH()->get_term_meta('_sh_layout_settings');
	$layout = sh_set( $meta1, 'layout', 'full' );
	$bg_image = sh_set( $meta1, 'header_img' );
}

//printr($meta);exit;
$layout = sh_set( $_GET, 'layout' ) ? $_GET['layout'] : $layout; 
if( !$layout || $layout == 'full' || sh_set($_GET, 'layout_style')=='full' ) $sidebar = ''; else
$sidebar = (sh_set( $meta1, 'sidebar')) ? $meta1['sidebar'] : 'default-sidebar'; // print_r($meta1);exit;
$classes = ( !$layout || $layout == 'full' || sh_set($_GET, 'layout_style')=='full' ) ? ' col-md-12' : ' col-lg-8 col-md-8';
get_header( 'shop' ); ?>

<section id="breadcrumbRow" class="row">
	<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
		<h2 style="background:transparent url('<?php echo $bg_image; ?>')no-repeat scroll center 0 / cover"><?php woocommerce_page_title(); ?></h2>
 	<?php endif; ?>	
	
	<div class="row pageTitle m0">
		<div class="container">
			<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
				<h4 class="fleft"><?php woocommerce_page_title(); ?></h4>
			<?php endif; ?>
			
			<ul class="breadcrumb fright">
				<?php echo get_the_breadcrumb(); ?>
			</ul>
		</div>
	</div>
</section>

<section class="clearfix woocommerce">
<div class="row contentRowPad">	
	<div class="container">
    	<div class="row">
			
			<?php if( $layout == 'left' ): ?>
		
					
	                <div class="pull-left col-md-4 col-sm-4 col-xs-12">
						<div id="sidebar" class="clearfix">
							<?php dynamic_sidebar( $sidebar ); ?>
							<?php
								/**
								 * woocommerce_sidebar hook
								 *
								 * @hooked woocommerce_get_sidebar - 10
								 */
								do_action( 'woocommerce_sidebar' );
							?>
						</div>
	                </div>
		
			<?php endif; ?>
          
          	<div class="<?php echo esc_attr($classes);?>">
			            
				<?php
					/**
					 * woocommerce_before_main_content hook
					 *
					 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
					 * @hooked woocommerce_breadcrumb - 20
					 */
					//do_action( 'woocommerce_before_main_content' );
				?>
				
				<div class="widget-title sort-catalog clearfix">
					<?php echo woocommerce_catalog_ordering();?>
	            </div>
                        
                
                <?php do_action( 'woocommerce_archive_description' ); ?>
		        
		        <div id="shop-page" class="row clearfix">
				
					<?php if ( have_posts() ) : ?>
		
						<?php
							/**
							 * woocommerce_before_shop_loop hook
							 *
							 * @hooked woocommerce_result_count - 20
							 * @hooked woocommerce_catalog_ordering - 30
							 */
							//do_action( 'woocommerce_before_shop_loop' );
						?>
			
						<?php woocommerce_product_loop_start(); ?>
			
							<?php woocommerce_product_subcategories(); ?>
			
							<?php while ( have_posts() ) : the_post(); ?>
			
								<?php wc_get_template_part( 'content', 'product' ); ?>
			
							<?php endwhile; // end of the loop. ?>
			
						<?php woocommerce_product_loop_end(); ?>
						<div class="clearfix"></div>
						<?php
							/**
							 * woocommerce_after_shop_loop hook
							 *
							 * @hooked woocommerce_pagination - 10
							 */
							do_action( 'woocommerce_after_shop_loop' );
						?>
				
						<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
				
							<?php wc_get_template( 'loop/no-products-found.php' ); ?>
				
						<?php endif; ?>
				
						<?php
							/**
							 * woocommerce_after_main_content hook
							 *
							 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
							 */
							do_action( 'woocommerce_after_main_content' );
						?>
					
					</div>
                </div>
	
				<?php if( $layout == 'right' ): ?>
		
					
	                <div class="pull-right col-md-4 col-sm-4 col-xs-12">
						<div id="sidebar" class="clearfix">
							<?php dynamic_sidebar( $sidebar ); ?>
							<?php
								/**
								 * woocommerce_sidebar hook
								 *
								 * @hooked woocommerce_get_sidebar - 10
								 */
								do_action( 'woocommerce_sidebar' );
							?>
						</div>
	                </div>
		
				<?php endif; ?>
				
				
		</div>
		
	</div>
	</div>
</section>
<?php wp_enqueue_script('bootstrap-select');?>
<?php get_footer( 'shop' ); ?>