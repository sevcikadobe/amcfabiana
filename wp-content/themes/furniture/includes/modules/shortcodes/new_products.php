<?php  
   $count = 1; 
   $query_args = array('post_type' => 'product' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);
   
   if( $cat ) $query_args['product_cat'] = $cat;
   $query = new WP_Query($query_args) ;
   ob_start() ;?>
   
<?php if($query->have_posts()): ?>

<section id="newProducts" class="row contentRowPad woocommerce">
<div class="container">
	<h3 class="heading"><?php echo balanceTags($title);?></h3>
	<div class="row">
		
		<?php while($query->have_posts()): $query->the_post();
               global $post ; 
               $meta = _WSH()->get_meta() ; 
		?>
		
		<div class="col-sm-3 product2">
			<div class="row m0 thumbnail">
				<div class="row m0 imgHov">
					<?php the_post_thumbnail('270x341');?>
					<div class="hovArea row m0">
						<div class="links row m0">
							<?php 
								$post_thumbnail_id = get_post_thumbnail_id($post->ID);
								$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
							?>
							<a href="<?php the_permalink();?>"><i class="fa fa-link"></i></a>
							<a href="<?php echo esc_url($post_thumbnail_url);?>" data-lightbox="product1" data-title="<?php the_title();?>"><i class="fa fa-expand"></i></a>
						</div>
						<div class="row m0 getlike">
							<a href="<?php the_permalink();?>" class="fleft"><i class="fa fa-shopping-cart"></i> Add to cart</a>
							<a href="javascript:void(0);" class="add_to_compare fright" data-id="<?php the_ID(); ?>"><i class="fa fa-sliders"></i></a>
							<a href="javascript:void(0);" class="add_to_wishlist fright" data-id="<?php the_ID(); ?>"><i class="fa fa-heart-o"></i></a>
						</div>
					</div>
				</div>
				<div class="row m0 productIntro">
					<h5 class="heading"><a href="<?php the_permalink();?>"><?php the_title();?></a> <span><?php woocommerce_template_loop_price(); ?></span></h5>
					<h5 class="proCat"><?php the_terms( $post->ID, 'product_cat', '', ' , ' ); ?></h5>
					<div class="row stars m0 text-left">
						<?php woocommerce_template_loop_rating(); ?>
					</div>
				</div>
			</div>
		</div> <!--Product 2-->
		 
		 <?php endwhile; ?>
		 
	</div>
</div>
</section>

<?php endif;  ?>

<?php 
   $output = ob_get_contents(); 
   ob_end_clean(); 
   return $output ; ?>