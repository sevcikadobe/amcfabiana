<?php
global $wp_query; //printr($wp_query);
$settings  = _WSH()->option();
get_header(); 
if( $wp_query->is_posts_page ) {
    $queried_object = get_queried_object();
	$meta = _WSH()->get_meta('_sh_layout_settings', $queried_object->ID);//printr($meta);
	$meta1 = _WSH()->get_meta('_sh_header_settings', $queried_object->ID);//printr($meta1);
	$page_layout = sh_set( $meta, 'layout', 'right' );
	$page_sidebar = sh_set( $meta, 'sidebar', 'default-sidebar' );
	$bg = sh_set( $meta1, 'bg_image' );
	$title = sh_set( $meta1, 'header_title', sh_set($queried_object, 'post_title') );
} else {
	$page_layout = (sh_set($_GET, 'layout')) ? sh_set($_GET, 'layout') : sh_set($settings, 'archive_page_layout');
	$page_layout = $page_layout ? $page_layout : 'right';
	$page_sidebar = sh_set($settings, 'archive_page_sidebar', 'default-sidebar');
	$bg = sh_set( $settings, 'archive_page_header_img' );
	$title = sh_set( $settings, 'archive_page_header_title', 'Blog' );
	
}
$page_sidebar = $page_sidebar ? $page_sidebar : 'default-sidebar';
$classes = ( $page_layout && $page_layout === 'full') ? 'col-md-12' : 'col-md-8';
?>

<section id="breadcrumbRow" class="row">
	<h2 <?php if($bg):?>style="background-image: url('<?php echo esc_url($bg); ?>');"<?php endif;?>><?php if($title) echo  balanceTags( $title ); else wp_title('');?></h2>
	<div class="row pageTitle m0">
		<div class="container">
			<h4 class="fleft"><?php if($title) echo  balanceTags( $title ); else wp_title('');?></h4>
			<ul class="breadcrumb fright">
			    <?php echo get_the_breadcrumb(); ?>
        	</ul>
		</div>
	</div>
</section>


<section class="row contentRowPad">
<div class="container">
	<div class="row">
	
		<?php if( $page_layout == 'left' ): ?>
		
                <div class="col-md-4 col-sm-4 col-xs-12">
                        <div id="sidebar" class="clearfix">        
							<?php if(is_active_sidebar($page_sidebar)) dynamic_sidebar( $page_sidebar ); ?>
                		</div>
                </div>
		
		<?php endif; ?><!-- end sidebar -->
		
		<div class="<?php echo esc_attr($classes);?>">
			 <?php while( have_posts() ): the_post();?>
            
			<div id="post-<?php the_ID(); ?>" <?php post_class();?>>
                
                <?php get_template_part( 'blog' ); ?>
			</div><!-- end col -->
			
			<?php endwhile; ?>
			
			<nav class="text-left"> 
                <?php _the_pagination(); ?>
            </nav>
		
		</div>
		
		<?php if( $page_layout == 'right' ): ?>
		
                <div class="pull-right col-md-4 col-sm-4 col-xs-12">
                        <div id="sidebar" class="clearfix">        
							<?php if(is_active_sidebar($page_sidebar)) dynamic_sidebar( $page_sidebar ); ?>
                		</div>
                </div>
		
		<?php endif; ?><!-- end sidebar -->

	</div>
</div>
</section>

<?php
get_footer();
?>