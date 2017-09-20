<?php  
   $count = 1; 
   $query_args = array('post_type' => 'product' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);
   
   if( $cat ) $query_args['product_cat'] = $cat;
   $query = new WP_Query($query_args) ;
   ob_start() ;?>
   
<?php if($query->have_posts()): ?>

<section class="row contentRowPad woocommerce">
<div class="container">
<h3 class="heading text-center heading-center"><?php echo balanceTags($title);?></h3>
<div class="row">
	
	<?php while($query->have_posts()): $query->the_post();
               global $post ; 
               $meta = _WSH()->get_meta() ; 
			   $last_class = ( ( $query->current_post % 3 ) == 0 ) ? ' first' : '';
	?>
	
	<div class="col-sm-4 product2<?php echo $last_class; ?>">
		<div class="row m0 thumbnail">
			<div class="row m0 imgHov">
				<?php the_post_thumbnail('350x236');?>
				<?php if (!$hide_overlay) :?>
				<div class="hovArea row m0">
					<div class="links row m0">
						
						<?php 
							$post_thumbnail_id = get_post_thumbnail_id($post->ID);
							$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
						?>
						
						<a href="<?php the_permalink();?>"><i class="fa fa-link"></i></a>
						<a href="<?php echo esc_url($post_thumbnail_url);?>" data-lightbox="product4" data-title="WOW SOFAS"><i class="fa fa-expand"></i></a>
					</div>
					<div class="row m0 getlike">
						<a href="<?php the_permalink();?>" class="fleft"><i class="fa fa-shopping-cart"></i><?php esc_html_e(' Add to cart', 'furniture');?></a>
						<a href="javascript:void(0);" class="add_to_compare fright" data-id="<?php the_ID(); ?>"><i class="fa fa-sliders"></i></a>
						<a href="javascript:void(0);" class="add_to_wishlist fright" data-id="<?php the_ID(); ?>"><i class="fa fa-heart-o"></i></a>
					</div>
				</div>
				<?php endif; ?>
			</div>
			<div class="row m0 productIntro">
				<h5 class="heading"><a href="<?php the_permalink();?>"><?php the_title();?></a> <span><?php woocommerce_template_loop_price(); ?></span></h5>
				<h5 class="proCat"><?php the_terms( $post->ID, 'product_cat', '', ' , ' ); ?></h5>
				<div class="row stars m0 text-left">
					<?php woocommerce_template_loop_rating(); ?>
				</div>                            
				<div class="row m0 colorSelect">
				<?php if($color_arr = sh_set($meta, 'product_color')):?>
					<?php foreach($color_arr as $key => $color): //printr($color);?>	
					<input type="radio" id="cl1<?php echo esc_attr($key);?>" name="proColor">
					<label for="cl1"><span style="background-color:<?php echo esc_attr($color['product_color']);?>"></span></label>
					<?php endforeach;?>
				<?php endif;?>	
				</div>
			</div>
		</div>
	</div> 
	
	<?php endwhile;?>
	
</div>
</div>
</section>

<?php endif;  ?>

<?php 
   $output = ob_get_contents(); 
   ob_end_clean(); 
   return $output ; ?>