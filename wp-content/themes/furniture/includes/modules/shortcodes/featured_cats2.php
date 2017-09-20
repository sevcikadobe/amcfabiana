<?php //wp_enqueue_script(array('jquery', 'owl-carousel'));
   $count = 0;
   $term_args = array('hide_empty' => $empty , 'number' => $num , 'order_by' => $sort , 'order' => $order);
   //if( $cat ) $query_args['category_name'] = $cat;
   //echo balanceTags($cat); exit('sssss');
   $terms = get_terms( 'product_cat', $term_args) ; 
   //printr($terms);
   ob_start() ;?>
   
<section id="featureCat2" class="row contentRowPad">
<div class="container">
	<h3 class="heading"><?php echo balanceTags($title); ?></h3>
<?php if ( ! empty( $terms ) && ! is_wp_error( $terms ) ):?>
	<div class="row m0">
	
	<?php foreach ( $terms as $term ) :
			$meta = _WSH()->get_term_meta( '_sh_product_cat_settings', $term->term_id );//printr($meta);
	?>
	
		<div class="col-sm-3">
			<div class="row category2 text-center">
				<div class="row m0 imgHov">
				<?php   $thumbnail_id = get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true ); ?>
					<?php echo wp_get_attachment_image( $thumbnail_id, '292x198' ); ?>
					<div class="hovArea row m0">
						<a href="<?php echo esc_url(get_term_link($term));  ?>"><?php esc_html_e('shop now ', 'furniture');?><i class="fa fa-caret-right"></i></a>
					</div>
				</div>
				<div class="row m0">
					<h5 class="heading"><?php echo balanceTags($term->name);?></h5>
					<ul class="list-unstyled black-color">
					<?php $query = get_posts(array('showposts'=>4, 'post_type'=>'product', 'product_cat'=>$term->slug, 'order'=>'DESC')); //printr($query);?>
						<?php if( $query )
						foreach( $query as $qu ): ?>
							<li><a href="<?php echo get_permalink($qu->ID); ?>" title="<?php echo get_the_title($qu->ID); ?>"><?php echo get_the_title($qu->ID); ?></a></li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>
		
		<?php endforeach;?>
		
	</div>
	
	<?php endif;?>

</div>
</section>

<?php return ob_get_clean();