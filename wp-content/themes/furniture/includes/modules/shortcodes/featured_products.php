<?php  
   $count = 1; 
   $query_args = array('post_type' => 'product' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);
   
   if( $cat ) $query_args['product_cat'] = $cat;
   $query = new WP_Query($query_args) ;
   ob_start() ;?>
   
<?php if($query->have_posts()): ?>

<section id="featureProducts" class="row contentRowPad woocommerce">
<div class="container">
	<div class="row sectionTitle">
		<?php if($title):?><h3><?php echo balanceTags($title);?></h3><?php endif;?>
		<?php if($subtitle):?><h5><?php echo balanceTags($subtitle);?></h5><?php endif;?>
	</div>
	<div class="row">
		
		<?php while($query->have_posts()): $query->the_post();
               global $post ; 
               $meta = _WSH()->get_meta() ; 
		?>
            
		<div class="col-sm-3 product">
			<div class="productInner row m0">
				<div class="row m0 imgHov">
                	<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail('270x341');?>
                    </a>
					<?php if (!$hide_overlay) :?>
					<div class="row m0 hovArea">
						<div class="row m0 icons">
							<ul class="list-inline">
							
							<?php 
								$post_thumbnail_id = get_post_thumbnail_id($post->ID);
								$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
							?>
								<li><a href="javascript:void(0);" class="add_to_wishlist" data-id="<?php the_ID(); ?>"><i class="fa fa-heart"></i></a></li>
								<li><a href="javascript:void(0);" class="add_to_compare" data-id="<?php the_ID(); ?>"><i class="fa fa-exchange"></i></a></li>
								<li><a href="<?php echo esc_url($post_thumbnail_url);?>" data-lightbox="product4" data-title="WOW SOFAS"><i class="fa fa-expand"></i></a></li>
							</ul>                                    
						</div>
						<div class="row m0 proType">
						<?php the_terms( $post->ID, 'product_cat', '', ' , ' ); ?>	
						</div>
						<div class="row m0 proRating">
							<?php woocommerce_template_loop_rating(); ?>
						</div>
						<div class="row m0 proPrice"><?php woocommerce_template_loop_price(); ?></div>
					</div>
					<?php  endif;?>
				</div>
				<div class="row m0 proName"><a href="<?php the_permalink();?>"><?php the_title();?></a></div>
				<div class="row m0 proBuyBtn">
					<button class="addToCart btn" onClick="location.href='<?php the_permalink();?>'"><?php esc_html_e('add to cart', 'furniture');?></button>
				</div>
			</div>
		</div>
		
		<?php endwhile; ?>
		
	</div>
</div>
</section> <!--Feature Products 4 Collumn-->

<?php endif;  ?>

<?php 
   $output = ob_get_contents(); 
   ob_end_clean(); 
   return $output ; ?>