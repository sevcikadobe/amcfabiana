<?php global $wp_query;
$count = 1; 
$query_args = array('post_type' => 'sh_testimonials' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);
   
if( $cat ) $query_args['testimonials_category'] = $cat;
$query = new WP_Query($query_args) ; 

$t = $GLOBALS['_sh_base'];

$data_filtration = '';
$data_posts = '';
?>


<?php if( $query->have_posts() ):
	
		ob_start();?>
	
		<?php $count = 0; 
		$fliteration = array();?>
		<?php while( $query-> have_posts() ): $query-> the_post(); 
			$active = ( $query->current_post == 0 ) ? ' active' : '';
			$data_filtration[get_the_id()] = '<li role="presentation" class="'.$active.'"><a href="#testi'.get_the_id().'" aria-controls="testi'.get_the_id().'" role="tab" data-toggle="tab">
													'.get_the_post_thumbnail(get_the_id(), 'thumbnail', array('class' => 'img-circle' )).'
													<i class="fa fa-plus-circle"></i>
												</a></li>';
			$meta = get_post_meta( get_the_id(), '_sh_portfolio_meta', true );//printr($meta);?>
				
			<div role="tabpanel" class="tab-pane<?php echo esc_attr($active); ?>" id="testi<?php the_ID();?>">
				<h5 class="customerName"><?php the_title();?></h5>
				<h5 class="customerType"><?php echo sh_set($meta, 'designation');?></h5>
				<p>“ <?php echo _sh_trim(get_the_content(), $text_limit);?> ”</p>
			</div>
		
		<?php endwhile; ?>
		
	
	
<?php $data_posts = ob_get_contents();
ob_end_clean();

endif; 
ob_start();
?>
<section id="testimonialTabs" class="row contentRowPad">
        <div class="container">
            <div class="row sectionTitle">
                <h3><?php echo balanceTags($title);?></h3>
                <h5><?php echo balanceTags($subtitle);?></h5>
            </div>
            <div class="row">
                <ul class="nav nav-tabs" role="tablist" id="testiTab">
                    <?php echo implode( "\n", (array)$data_filtration ); ?>
                </ul>

                <div class="tab-content testiTabContent">
                    <?php echo balanceTags($data_posts); ?>
                </div>
            </div>
        </div>
    </section> <!--Testimonial Tabs-->


<?php return ob_get_clean(); ?>