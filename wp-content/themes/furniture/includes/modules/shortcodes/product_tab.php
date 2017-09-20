<?php global $wp_query; 
global $post;
$count = 1; 
$query_args = array('post_type' => 'product' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);

if( $cat ) {

	if( $terms = get_terms( 'product_cat', array('child_of' => $cat, 'fields' => 'ids', 'hide_empty' => false) ) ) {

		$query_args['tax_query'] = array(array('taxonomy' => 'product_cat', 'field'=>'id', 'terms' => $terms));
	}else {
		$query_args['tax_query'] = array(array('taxonomy' => 'product_cat', 'field'=>'id', 'terms' => array($cat)));
		//$query_args['product_cat'] = $cat;
	}
}
$query = new WP_Query($query_args) ; 

$t = $GLOBALS['_sh_base'];

$data_filtration = '';
$tabs = '';
?>


<?php if( $query->have_posts() ):
	
		//ob_start();?>
	
		<?php $count = 0; 
		$fliteration = array();?>
		<?php while( $query-> have_posts() ): $query-> the_post();
			$meta = _WSH()->get_meta(); 
			$active = ( $query->current_post == 0 ) ? ' active' : '';
			$terms = get_the_terms( get_the_id(), 'product_cat' );
			
			if( $terms ) :
			
				foreach( $terms as $term ):
					//$data_filtration[get_the_id()] = '<li role="presentation"><a href="#proT'.get_the_id().'" aria-controls="proT'.get_the_id().'" role="tab" data-toggle="tab">'.get_the_title(get_the_id()).'</a></li>';
					$meta = get_post_meta( get_the_id(), '_sh_portfolio_meta', true );//printr($meta);
					$tabs[$term->term_id] = '<a href="#proT'.$term->term_id.'" aria-controls="proT'.$term->term_id.'" role="tab" data-toggle="tab">'.$term->name.'</a>';
					ob_start();?>
				
					<div class="col-sm-4 product2">
						<div class="row m0 thumbnail">
							<div class="row m0 imgHov">
								<?php the_post_thumbnail('350x236');?>
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
										<a href="<?php the_permalink();?>" class="fleft"><i class="fa fa-shopping-cart"></i><?php esc_html_e(' Add to cart', 'furniture')?></a>
										<a href="#" class="fright"><i class="fa fa-sliders"></i></a>
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
					
				<?php $data_filtration[$term->term_id][get_the_id()] = ob_get_clean();
				endforeach;
			endif; 		
		endwhile; ?>
		
	
	
<?php //$data_posts = ob_get_contents();
//ob_end_clean();

endif; 
ob_start();
?>

<section id="productOnTab" class="row contentRowPad woocommerce">
	<div class="container">
		<div class="row">
			<ul class="nav nav-tabs centeredTabMenu" role="tablist" id="productTab">
				<?php $count = 0;
				if( $tabs ) //echo implode( "\n", $tabs );
				foreach( $tabs as $tab ):
					$active = ( $count == 0 ) ? ' class="active"' : '';
					echo '<li role="presentation"'.$active.'>'.$tab.'</li>';
					$count++;
				endforeach;?>
			</ul>
			
			<div class="tab-content">
			  
			  <?php $count = 0;
			  if( $data_filtration )
			  foreach( $data_filtration as $k =>$filter ): ?>
			  
				  <div role="tabpanel" class="tab-pane<?php if( $count == 0 ) echo ' active'; ?>" id="proT<?php echo esc_attr($k); ?>">
					  <div class="row">
						<?php if( $filter ) echo implode( "\n", $filter ); ?>
					  </div>
				  </div>
			  	<?php $count++;
			  endforeach; ?>
			  
			  
			</div>
		</div>
	</div>
</section>

<?php return ob_get_clean(); ?>