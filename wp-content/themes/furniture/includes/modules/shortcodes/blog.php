<?php  
   $count = 1; 
   $query_args = array('post_type' => 'post' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);
   
   if( $cat ) $query_args['category'] = $cat;
   $query = new WP_Query($query_args) ; 
    // print_r($query);
   ob_start() ;?>
<?php if( $query->have_posts() ):?>

<section id="fromBlogs" class="row contentRowPad">
<div class="container">
	<div class="row sectionTitle">
		<h3><?php echo balanceTags($title);?></h3>
		<h5><?php echo balanceTags($subtitle);?></h5>
	</div>
	<div class="row">
	
		<?php while($query->have_posts()): $query->the_post();
        	  global $post;
			  $services_meta = _WSH()->get_meta(); 
	    ?>
			
		<div class="col-sm-4">
			<div class="blog row m0">
				<div class="row m0 featureImg">
					<?php the_post_thumbnail('370x244');?>
				</div>
				<div class="row m0 titleRow">
					<div class="fleft date"><?php echo get_the_date('d');?><span><?php echo get_the_date('M');?></span></div>
					<div class="fleft titlePart">
						<a href="<?php the_permalink();?>"><h6 class="blogTitle heading"><?php the_title();?></h6></a>
						<p class="m0"><?php esc_html_e('By ', 'furniture');?><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author();?></a><span>|</span><a href="<?php the_permalink();?>#comments"><?php comments_number();?></a></p>
					</div>
				</div>
				<div class="row m0 excerpt">
					<?php the_excerpt();?>
				</div>
			</div> <!--Blog Row End-->
		</div>
		
		<?php endwhile;?>
		
	</div>
</div>
</section>

<?php endif;?>		

<?php 
   $output = ob_get_contents(); 
   ob_end_clean(); 
   return $output ; ?>