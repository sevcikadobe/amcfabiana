<?php global $wp_query; //printr($wp_query); 
$options = _WSH()->option();
get_header(); 
$settings  = _WSH()->option(); 
$layout = sh_set( $settings, 'search_page_layout', 'full' );
if( !$layout || $layout == 'full' || sh_set($_GET, 'layout_style')=='full' ) $sidebar = ''; else
$sidebar = sh_set( $settings, 'search_page_sidebar', 'blog-sidebar' );
$view = sh_set( $settings, 'search_page_view', 'list' );
_WSH()->page_settings = array('layout'=>$layout, 'view'=> $view, 'sidebar'=>$sidebar);
$classes = ( !$layout || $layout == 'full' || sh_set($_GET, 'layout_style')=='full' ) ? ' col-md-12' : ' col-lg-8 col-md-8' ;
$bg = sh_set( $settings, 'search_page_header_img' );
$title = sh_set( $settings, 'search_page_header_title' );
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
			 <?php if(have_posts()) :?>
			 <?php while( have_posts() ): the_post();?>
            
			<div id="post-<?php the_ID(); ?>" <?php post_class();?>>
                
                <?php get_template_part( 'blog' ); ?>
			</div><!-- end col -->
			
			<?php endwhile; ?>
			<?php else: ?>
			
					<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'furniture' ); ?></p>
					<?php get_search_form(); ?>
				
			<?php endif; ?>
			
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