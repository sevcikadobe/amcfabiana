<?php  
   $count = 0; 
   $query_args = array('post_type' => 'sh_services' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);
   
   if( $cat ) $query_args['services_category'] = $cat;
   $query = new WP_Query($query_args) ; 
    // print_r($query);
   ob_start() ;?>

<?php if( $query->have_posts() ):?>

<section id="featuresTexts" class="row contentRowPad">
<div class="container">
	<h3 class="heading text-center heading-center"><?php echo balanceTags($title);?></h3>
	<div class="row">
		<div class="col-sm-6">
			
			<?php while($query->have_posts()): $query->the_post();
        	  global $post;
			  $services_meta = _WSH()->get_meta(); 
	    	?>
			
			<?php if(($count%2) == 0 && $count != 0):?>
				</div><div class="col-sm-6">
			<?php endif; ?>
			
			<div class="media featuresTexts">
				<div class="media-left">+</div>
				<div class="media-body">
					<h5 class="heading"><?php the_title();?></h5>
					<p><?php echo _sh_trim(get_the_content(), $text_limit);?></p>
					<?php if(sh_set($services_meta, 'readmore_text')):?>
						<a href="<?php echo sh_set($services_meta, 'readmore_link');?>"><?php echo sh_set($services_meta, 'readmore_text');?><i class="fa fa-angle-double-right"></i></a>
					<?php endif;?>
				</div>
			</div>
			
			<?php $count++; endwhile; ?>
		
		</div>
		
	</div>
</div>
</section>

<?php endif;?>		

<?php 
   $output = ob_get_contents(); 
   ob_end_clean(); 
   return $output ; ?>