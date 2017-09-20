<?php  
   $count = 0; 
   $query_args = array('post_type' => 'sh_catalog' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);
   
   if( $cat ) $query_args['catalog_category'] = $cat;
   $query = new WP_Query($query_args) ; 
    // print_r($query);
   ob_start() ;?>

<?php if( $query->have_posts() ):?>

<section class="row contentRowPad">
<div class="container">
	<div class="row" id="catalogs">
		
		<?php while($query->have_posts()): $query->the_post();
        	  global $post;
			  $catalog_meta = _WSH()->get_meta(); 
	    ?>
		
		<div class="fleft catalogBox">
			<div class="thumbnail">
				<div class="thumbnailInner row m0">
					<?php the_post_thumbnail('189x211');?>
					<?php if (!$hide_overlay) :?>
					<div class="row m0 hoverBox">
						<a href="<?php echo sh_set($catalog_meta, 'pdf');?>"><i class="fa fa-download"></i><br><?php esc_html_e('catalog', 'furniture');?></a>
					</div>
					<?php endif; ?>
				</div>
			</div>
			<div class="row m0 catalogType"><?php the_title();?><span>(pdf)</span></div>
		</div>
		
		<?php endwhile;?>
		
	</div>
</div>
</section>

<?php endif;?>		

<?php 
   $output = ob_get_contents(); 
   ob_end_clean(); 
   return $output ; ?>