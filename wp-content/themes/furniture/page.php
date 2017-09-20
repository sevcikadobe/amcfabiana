<?php $options = _WSH()->option();
get_header(); 
$settings  = sh_set(sh_set(get_post_meta(get_the_ID(), 'sh_page_meta', true) , 'sh_page_options') , 0);
$meta = _WSH()->get_meta('_sh_layout_settings');
$meta1 = _WSH()->get_meta('_sh_header_settings');
$meta2 = _WSH()->get_meta();
//printr($meta); 
_WSH()->page_settings = $meta;
$layout = sh_set( $meta, 'layout', 'full' );
if( !$layout || $layout == 'full' || sh_set($_GET, 'layout_style')=='full' ) $sidebar = ''; else
$sidebar = sh_set( $meta, 'sidebar', 'product-sidebar' );
$classes = ( !$layout || $layout == 'full' || sh_set($_GET, 'layout_style')=='full' ) ? ' col-md-12 col-sm-12 col-xs-12' : ' col-md-8 col-sm-8 col-xs-12';
$bg = sh_set( $meta1, 'bg_image' );
$title = sh_set( $meta1, 'header_title' );
/** Update the post views counter */
//_WSH()->post_views( true );?>

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
			<?php while( have_posts() ): the_post(); ?>
            	<div id="post-<?php the_ID(); ?>" <?php post_class();?>>
					<div class="blog row m0 single_post">
						
						<div class="desc">
							<?php the_content();?>
						</div>
						
						<?php the_tags('<div class="tags">', ', ', '</div>');?>
						
						<div class="clearfix"></div>
						
						<?php comments_template(); ?><!-- end comments -->
			
					</div>
				</div>
			
			<?php endwhile;?>
			
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