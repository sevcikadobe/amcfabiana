<?php 
$options = _WSH()->option();
get_header(); 
//$settings  = sh_set(sh_set(get_post_meta(get_the_ID(), 'sh_page_meta', true) , 'sh_page_options') , 0);
//$meta = _WSH()->get_meta('_sh_layout_settings');
//$layout = sh_set( $meta, 'layout', 'full' );
//$sidebar = sh_set( $meta, 'sidebar', 'product-sidebar' );
//$classes = ( !$layout || $layout == 'full' ) ? ' col-lg-12 col-md-12' : ' col-lg-9 col-md-9';
?>

<section id="breadcrumbRow" class="row">
	<h2><?php esc_html_e('404', 'furniture');?></h2>
	<div class="row pageTitle m0">
		<div class="container">
			<h4 class="fleft"><?php esc_html_e('404', 'furniture');?></h4>
			<ul class="breadcrumb fright">
				<?php echo balanceTags(get_the_breadcrumb()); ?>
			</ul>
		</div>
	</div>
</section>

<section id="page404" class="row contentRowPad">
	<div class="container">
		<img src="<?php echo esc_url(get_template_directory_uri());?>/images/404.png" alt="">
	</div>
</section>

<?php get_footer(); ?>