<?php global $wp_query;
$count = 1; 
$query_args = array('post_type' => 'sh_testimonials' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);
   
if( $cat ) $query_args['testimonials_category'] = $cat;
$query = new WP_Query($query_args) ; 

ob_start() ;?>


<?php if( $query->have_posts() ):?>
	
<section id="testimonialTabs" class="row  contentRowPad">       
<div class="container">
	<h3 class="heading text-center"><?php echo balanceTags($title);?></h3>
	<div class="row">
	
		<?php while($query->have_posts()): $query->the_post();
        	  global $post ;
			  $testimonial_meta = _WSH()->get_meta(); 
	    ?>
		
		<div class="col-sm-4">
			<div class="row m0 testimonialStyle3">
				<div class="testiText row m0"><?php echo _sh_trim(get_the_content(), $text_limit);?></div>
				<div class="row m0 clientInfo text-center">
					<?php the_post_thumbnail('thumbnail');?>
					<div class="clientName"><?php the_title();?></div>
					<?php if($ratting = sh_set($testimonial_meta, 'testimonial_rating')): //echo balanceTags($ratting); exit;?>
					
					<ul class="stars list-inline">
                         <?php for($x=1; $x<=5; $x++){
							 	
								if($x <= $ratting) echo '<li class="stared"><i class="fa fa-star"></i></li>'; else echo '<li class=""><i class="fa fa-star"></i></li>';  
							}?>
						 
                    </ul>
					
					<?php endif;?>
				</div>
			</div>
		</div>
		
		<?php endwhile; ?>
		
	</div>
</div>
</section> <!--Testimonial Tabs-->

<?php endif;?>

<?php return ob_get_clean(); ?>