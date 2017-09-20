<?php  
   $count = 1; 
   $query_args = array('post_type' => 'sh_services' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);
   
   if( $cat ) $query_args['services_category'] = $cat;
   $query = new WP_Query($query_args) ; 
    // print_r($query);
   ob_start() ;?>

<?php if( $query->have_posts() ):?>

<section id="serviceStyle2" class="row contentRowPad">
<div class="container">
	<div class="row">
		
		<?php while($query->have_posts()): $query->the_post();
        	  global $post ;
			  $services_meta = _WSH()->get_meta(); 
	    ?>
		
		<div class="col-sm-4 service2">
			<div class="media">
				<div class="media-left">
					<a href="<?php echo sh_set($services_meta, 'single_link');?>"><img src="<?php echo sh_set($services_meta, 'service_image');?>" alt="" class="media-object"></a>
				</div>
				<div class="media-body">
					<h4 class="heading"><?php the_title();?></h4>
					<p><?php echo _sh_trim(get_the_excerpt(), $text_limit);?></p>
					<a href="<?php echo sh_set($services_meta, 'single_link');?>" class="readMore"><?php esc_html_e('Find out more  ', 'furniture');?><i class="fa fa-angle-right"></i></a>
				</div>
			</div>
		</div> <!--service style 2-1-->
		
		<?php endwhile;?>
		 
	</div>
</div>
</section>

<?php endif;?>		
<?php 
   $output = ob_get_contents(); 
   ob_end_clean(); 
   return $output ; ?>