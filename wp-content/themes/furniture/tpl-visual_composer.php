<?php /* Template Name: VC Page */
get_header() ;
//$meta = _WSH()->get_meta('_sh_layout_settings');
$meta1 = _WSH()->get_meta('_sh_header_settings');
$meta = _WSH()->get_meta('_sh_layout_settings');
$layout = sh_set( $meta, 'layout', 'full' );
$sidebar = sh_set( $meta, 'sidebar') ? $meta['sidebar'] : 'default-sidebar';
$classes = ( !$layout || $layout == 'full' || sh_set($_GET, 'layout_style')=='full' ) ? ' col-md-12' : ' col-lg-8 col-md-8';
?>
<?php if(sh_set($meta1, 'bread_crumb')):?>
	<?php $header_bg_image = sh_set( $meta1, 'bg_image' ) ? $meta1['bg_image'] : ''; ?>
	<section id="breadcrumbRow" class="row">
		<h2 <?php if($header_bg_image):?>style="background-image: url('<?php echo esc_url($header_bg_image); ?>');"<?php endif;?>><?php if(sh_set($meta1, 'header_title')) echo sh_set($meta1, 'header_title'); else echo wp_title('');?></h2>
		<div class="row pageTitle m0">
			<div class="container">
				<h4 class="fleft"><?php if(sh_set($meta1, 'header_title')) echo sh_set($meta1, 'header_title'); else echo wp_title('');?></h4>
				<ul class="breadcrumb fright">
					<?php echo get_the_breadcrumb(); ?>
				</ul>
			</div>
		</div>

	</section>

<?php endif;?>
	
	<?php //if( !sh_set( $meta, 'is_home' ) ) get_template_part( 'includes/modules/header/header', 'single' ); ?>
	<div class="sss">
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
          
		<div class="white-bg">
			<?php while( have_posts() ): the_post(); ?>
			<?php the_content(); ?>
			<?php endwhile;  ?>
		</div>
	</div>	
	<?php get_footer() ; ?>