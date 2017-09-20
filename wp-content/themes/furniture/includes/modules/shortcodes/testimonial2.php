<?php global $wp_query;
$count = 1; 
$query_args = array('post_type' => 'sh_testimonials' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);
   
if( $cat ) $query_args['testimonials_category'] = $cat;
$query = new WP_Query($query_args) ; 

ob_start() ;?>


<?php if( $query->have_posts() ):?>
	
<section id="testimonialTabs" class="row contentRowPad">       
<div class="container">
	<div class="row sectionTitle">
		<h3><?php echo balanceTags($title);?></h3>
		<h5><?php echo balanceTags($subtitle);?></h5>
	</div>
	<div class="row">
	
	<?php while( $query-> have_posts() ): $query-> the_post();?>
	
		<div class="col-sm-6">
			<div class="row m0 testimonialStyle2">
				<div class="testiInner">
					<p>“ <?php echo _sh_trim(get_the_content(), $text_limit);?> ”</p>
					<div class="row m0 clientInfo">                           
						<div class="thumbnail">
						
							<?php the_post_thumbnail('thumbnail');?>
						
						</div>
						<div class="clientName"><?php the_title();?></div>
					</div>
				</div>
			</div>
		</div>
		
		<?php endwhile;?>
		
	</div>
</div>
</section> <!--Testimonial Tabs-->

<?php endif;?>

<?php return ob_get_clean(); ?>