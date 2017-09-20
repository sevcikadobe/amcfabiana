<?php $settings = get_option( 'furniture'.'_theme_options' );?>

<div class="blog row m0">
	
	<?php if(has_post_thumbnail()):?>
	
	<div class="row m0 featureImg">
		<?php the_post_thumbnail('830x390');?>
	</div>
	
	<?php endif;?>
	
	<div class="row m0 titleRow">
		<div class="fleft date"><?php echo get_the_date('d');?><span><?php echo get_the_date('M');?></span></div>
		<div class="fleft titlePart">
			<a href="<?php the_permalink();?>"><h4 class="blogTitle heading"><?php the_title();?></h4></a>
			<p class="m0"><?php esc_html_e('By ', 'furniture');?><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author();?></a><span>|</span><a href="<?php the_permalink();?>#comments"><?php comments_number();?></a></p>
		</div>
	</div>
	<div class="row m0 excerpt">
		<?php the_excerpt();?>
	</div>

</div> <!--Blog Row End-->