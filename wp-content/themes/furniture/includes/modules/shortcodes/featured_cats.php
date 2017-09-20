<?php //wp_enqueue_script(array('jquery', 'owl-carousel'));
   $count = 0;
   $term_args = array('hide_empty' => $empty , 'number' => $num , 'order_by' => $sort , 'order' => $order);
   //if( $cat ) $query_args['category_name'] = $cat;
   //echo balanceTags($cat); exit('sssss');
   $terms = get_terms( 'product_cat', $term_args) ; 
   //printr($terms);
   ob_start() ;?>
   
<section id="featureCategory" class="row contentRowPad">
<div class="row m0 sectionTitle">
	<h3><?php echo balanceTags($title);?></h3>
	<h5><?php echo balanceTags($subtitle);?></h5>
</div>
<?php if ( ! empty( $terms ) && ! is_wp_error( $terms ) ):?>
<div class="owl-carousel featureCats row m0">
	<?php foreach ( $terms as $term ) :
			$meta = _WSH()->get_term_meta( '_sh_product_cat_settings', $term->term_id );//printr($meta);
	?>

	<div class="item">
		<div class="row m0 imgHov">
		<?php   $thumbnail_id = get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true ); ?>
			<?php echo wp_get_attachment_image( $thumbnail_id, '377x284' ); ?>
			<?php if (!$hide_overlay) :?>
			<div class="row m0 hovArea">
				<i class="fa fa-heart-o"></i><br><h4><?php echo sprintf( _n( '1 item', '%s items', $term->count, 'furniture'), $term->count );?></h4><a href="<?php echo esc_url(get_term_link($term));  ?>"><?php esc_html_e('SHOP NOW', 'furniture');?></a>
			</div>
			<?php endif; ?>
		</div>
		<a href="<?php echo esc_url(get_term_link($term));  ?>"><h4><?php echo balanceTags($term->name);?></h4></a>
	</div>

	<?php endforeach;?>
	
</div>

<?php endif;?>

</section> <!--Feature Categories-->
  
<?php return ob_get_clean();