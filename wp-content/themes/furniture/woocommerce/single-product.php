<?php
$options = _WSH()->option();

$header_style = sh_set( $options, 'header_style' );
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$meta = _WSH()->get_meta('_sh_layout_settings');
$meta1 = _WSH()->get_meta('_sh_header_settings'); //printr($meta1);
$layout = sh_set( $meta, 'layout', 'full' );
$sidebar = sh_set( $meta, 'sidebar', 'product-sidebar' );
$classes = ( !$layout || $layout == 'full' ) ? ' col-lg-12 col-md-12' : ' col-lg-8 col-md-8';
get_header( 'shop' ); ?>

<?php $header_bg_image = sh_set( $meta1, 'bg_image' ) ? $meta1['bg_image'] : ''; //printr($header_bg_image);?>
<section id="breadcrumbRow" class="row">

	<?php //if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
		<h2 <?php if($header_bg_image):?>style="background-image: url('<?php echo esc_url($header_bg_image); ?>');"<?php endif;?>>
			<?php echo (sh_set( $meta1, 'header_title' ) ) ? sh_set( $meta1, 'header_title' ) :  get_the_title(); ?>
		</h2>
	<?php //endif; ?>

	<div class="row pageTitle m0">

		<div class="container">
			<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
			<h4 class="fleft">
				<?php echo get_the_title(); ?>
			</h4>
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
			<div class="row singleProduct">
				
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

				<div class="<?php echo esc_attr($classes); ?>" id="content">

					<div id="shop-page" class="row clearfix">
						<?php
						/**
						 * woocommerce_before_main_content hook
						 *
						 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
						 * @hooked woocommerce_breadcrumb - 20
						 */
						do_action( 'woocommerce_before_main_content' );?>
						
						<?php while ( have_posts() ) : the_post(); 
						?>
							<?php wc_get_template_part( 'content', 'single-product' ); ?>
						<?php endwhile; // end of the loop. ?>
						
						<?php
							/**
							 * woocommerce_after_main_content hook
							 *
							 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
							 */
							do_action( 'woocommerce_after_main_content' );
						?>
						
					</div>
					<hr />
					</div>
					</div>
				</div>
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
<?php get_footer( 'shop' ); ?>