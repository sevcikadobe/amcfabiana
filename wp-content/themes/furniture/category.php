<?php global $wp_query; //printr($wp_query);  
$options = _WSH()->option();
get_header(); 
$meta = _WSH()->get_term_meta( '_sh_category_settings' );
print_r($meta); exit();
_WSH()->page_settings = $meta; 
$layout = sh_set( $meta, 'layout', 'full' );
$sidebar = sh_set( $meta, 'sidebar', 'blog-sidebar' );
$view = sh_set( $meta, 'view', 'list' );
$view = sh_set( $_GET, 'view' ) ? sh_set( $_GET, 'view' ) : $view;
$classes = ( !$layout || $layout == 'full' || sh_set($_GET, 'layout_style')=='full' ) ? ' col-md-12' : ' col-lg-8 col-md-8' ;
$bg = sh_set( $meta, 'header_img' );
$title = sh_set( $meta, 'header_title' );
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
	
		<?php if( $layout == 'left' ): ?>
		
                <div class="col-md-4 col-sm-4 col-xs-12">
                        <div id="sidebar" class="clearfix">        
							<?php if(is_active_sidebar($sidebar)) dynamic_sidebar( $sidebar ); ?>
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
		
		<?php if( $layout == 'right' ): ?>
		
                <div class="pull-right col-md-4 col-sm-4 col-xs-12">
                        <div id="sidebar" class="clearfix">        
							<?php if(is_active_sidebar($sidebar)) dynamic_sidebar( $sidebar ); ?>
                		</div>
                </div>
		
		<?php endif; ?><!-- end sidebar -->

	</div>
</div>
</section>

<?php get_footer(); ?>