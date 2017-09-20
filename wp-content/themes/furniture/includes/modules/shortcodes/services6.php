<?php  
   $count = 1; 
   $query_args = array('post_type' => 'sh_services' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);
   
   if( $cat ) $query_args['services_category'] = $cat;
   $query = new WP_Query($query_args) ; 
    // print_r($query);
   ob_start() ;?>
<?php if( $query->have_posts() ):?>

<section id="hww" class="row contentRowPad">
<div class="container">
	<h3><?php echo balanceTags($title);?></h3>
	
	<?php while($query->have_posts()): $query->the_post();
        	  global $post ;
			  $services_meta = _WSH()->get_meta(); 
	?>
	
	<div class="col-sm-4">
		<h5><span><?php printf( '%02d',  $count ); ?></span> <?php the_title();?></h5>
		<p><?php echo _sh_trim(get_the_content(), $text_limit);?></p>
	</div>
	
	<?php $count++; endwhile; ?>
	
</div>
</section>

<?php endif;?>		

<?php 
   $output = ob_get_contents(); 
   ob_end_clean(); 
   return $output ; ?>