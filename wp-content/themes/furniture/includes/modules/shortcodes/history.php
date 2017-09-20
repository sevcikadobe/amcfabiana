<?php global $wp_query;
$count = 0; 
$query_args = array('post_type' => 'sh_history' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);
   
$query = new WP_Query($query_args) ; 

$t = $GLOBALS['_sh_base'];

$filteration = array();
$data_filtration = '';
$data_posts = '';
?>


<?php if( $query->have_posts() ):
	?>
	
		<?php $count = 0; 
		$fliteration = array();?>
		<?php while( $query-> have_posts() ): $query-> the_post(); 
			$active = ( $count == 0 ) ? ' active' : '';
			$terms = get_the_terms( get_the_id(), 'history_category' );
			if( $terms ) :
				foreach( $terms as $term ):

					$meta = get_post_meta( get_the_id(), '_sh_portfolio_meta', true );//printr($meta);
					$filteration[$term->term_id] = '<li role="presentation" {{active}}>
														<a href="#wwd'.$term->term_id.'" aria-controls="wwd'.$term->term_id.'" role="tab" data-toggle="tab">'.$term->name.'</a>
													  </li>';
					ob_start();?>
						
					
					<h3><?php the_title();?></h3>
					
					<?php the_content();?>
					
			
		
					<?php $data_filtration[$term->term_id][get_the_id()] = ob_get_clean();
				endforeach;
			endif;
			$count++; 		
		endwhile; ?>
		
	
	
<?php //$data_posts = ob_get_contents();
//ob_end_clean();

endif; 
ob_start();
?>

<section id="whatWeDid" class="row contentRowPad">
<div class="container">
	<div class="row">
		<div class="col-sm-6 tab_menu">
			<div class="row m0">
				
				<ul class="nav navbar-right" role="tablist" id="myTab">
					<?php //echo implode( "\n", (array)$filteration );
					$count = 0; 
					foreach( $filteration as $fi ):
						$active = ( $count == 0 ) ? ' class="active"' : '';
						echo str_replace( '{{active}}', $active, $fi );
						$count++;
					endforeach;?>	
				</ul>
			
			</div>
		</div>
		<div class="col-sm-6 tab-contents">
			
			<?php if( $data_filtration ): ?>
				<div class="tab-content">
					<?php $count = 0; 
					foreach( $data_filtration as $k => $filt ): 
						$active = ( $count == 0 ) ? ' active' : '';?> 
						<div role="tabpanel" class="tab-pane<?php echo esc_attr($active); ?>" id="wwd<?php echo esc_attr($k); ?>">
							<?php echo balanceTags( implode( "\n", (array) $filt ) ); ?>
						</div>
					<?php $count++;
					endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
</section>

<?php return ob_get_clean(); ?>