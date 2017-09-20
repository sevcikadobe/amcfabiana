<?php  
   $count = 1; 
   $query_args = array('post_type' => 'sh_services' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);
   
   if( $cat ) $query_args['services_category'] = $cat;
   $query = new WP_Query($query_args) ; 
    // print_r($query);
   ob_start() ;?>
<?php if( $query->have_posts() ):?>

<section id="shopFeatures" class="row">
<div class="container">
	<div class="row text-center">
	
		<?php while($query->have_posts()): $query->the_post();
        	  global $post ;
			  $services_meta = _WSH()->get_meta(); 
	    ?>

		<div class="col-sm-3 coreFeature">
			<div class="row m0 coreFeatureInner">
				<div class="row m0 icon circle">
				<img src="<?php echo sh_set($services_meta, 'service_image');?>" alt=""></div>
				<h5><?php the_title();?></h5>
				<p><?php echo _sh_trim(get_the_excerpt(), $text_limit);?></p>
			</div>
		</div>
		
		<?php endwhile;?>
	
	</div>
</div>
</section> <!--Shop Core Feature-->

<?php endif;?>		
<?php 
   $output = ob_get_contents(); 
   ob_end_clean(); 
   return $output ; ?>