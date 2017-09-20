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
				<div class="row m0 featureImg">
					<?php the_post_thumbnail('830x390');?>
				</div>
				
				<div class="row m0 titleRow">
					<div class="fleft date"><?php echo get_the_date('d');?><span><?php echo get_the_date('M');?></span></div>
					<div class="fleft titlePart">
						<a href="<?php the_permalink();?>"><h4 class="blogTitle heading"><?php the_title();?></h4></a>
						<p class="m0"><?php esc_html_e('By ', 'furniture');?><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author();?></a><span>|</span><a href="<?php the_permalink();?>#comments"><?php comments_number();?></a></p>
					</div>
				</div>
				<div class="row m0 excerpt">
					 <?php the_content();?>
					 <div class="tags"><?php the_tags();?></div>
				</div>
			</div> <!--Blog Row End-->
			
			<div class="shareRow row m0">
				<h4 class="heading fleft"><?php esc_html_e('Share this post', 'furniture');?></h4>
					<ul class="list-inline">
						<li><a href="javascript:void(0);" title="Facebook"><i class="fa fa-facebook st_facebook_large"></i></a></li>
						<li><a href="javascript:void(0);" title="Twitter"><i class="fa fa-twitter st_twitter_large"></i></a></li>
						<li><a href="javascript:void(0);" title="Google Plus"><i class="fa fa-google-plus st_googleplus_large"></i></a></li>
						<li><a href="javascript:void(0);" title="Linkedin"><i class="fa fa-linkedin st_linkedin_large"></i></a></li>
					</ul>
					<script type="text/javascript">var switchTo5x=true;</script>
					<script type="text/javascript" src="https://ws.sharethis.com/button/buttons.js"></script>
					<script type="text/javascript">stLight.options({publisher: "e5f231e9-4404-49b7-bc55-0e8351a047cc", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
			</div>
			
			<div class="media authorBox">
				<div class="media-left authorImg">
					<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' )); ?>">
						<?php echo get_avatar('', 100 ); ?>
					</a>
				</div>
				<div class="media-body">
					<h5 class="heading"><?php esc_html_e('About ', 'furniture');?><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' )); ?>">Dwayne Johnson</a></h5>
					<p><?php the_author_meta( 'description', get_the_author_meta('ID') ); ?></p>
				</div>
				<div class="row m0">
					<ul class="list-inline">
						<?php if($facebook_url = get_the_author_meta('facebook')):?>
							<li><a href="<?php echo esc_url($facebook_url); ?>"><i class="fa fa-facebook"></i><?php esc_html_e(' Facebook', 'furniture');?></a></li>
						<?php endif;?>
						<?php if($twitter_url = get_the_author_meta('twitter')):?>
							<li><a href="<?php echo esc_url($twitter_url);?>"><i class="fa fa-twitter"></i><?php esc_html_e(' twitter', 'furniture');?></a></li>
						<?php endif;?>
						<?php if($google_plus_url = get_the_author_meta('google-plus')):?>
							<li><a href="<?php echo esc_url($google_plus_url);?>"><i class="fa fa-google-plus"></i><?php esc_html_e(' google+', 'furniture');?></a></li>
						<?php endif;?>
						<?php if($email_url = get_the_author_meta('user_email')):?>
							<li><a href="mailto:<?php echo esc_attr($email_url); ?>"><i class="fa fa-envelope"></i><?php esc_html_e(' Email', 'furniture');?></a></li>
						<?php endif;?>
					</ul>
				</div>
			</div> <!--Author Box - Shortcode Item -> Single Blog Page-->
			
			<?php wp_link_pages(array('before'=>'<div class="paginate-links">'.esc_html__('Pages: ', 'furniture'), 'after' => '</div>', 'link_before'=>'<span>', 'link_after'=>'</span>')); ?>
            
			<?php comments_template(); ?><!-- end comments -->
			
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