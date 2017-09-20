<?php  
   $query_args = array('post_type' => 'sh_team' , 'showposts' => $num , 'order_by' => $sort , 'order' => $order);
   if( $cat ) $query_args['team_category'] = $cat;
   $query = new WP_Query($query_args) ;
   ob_start() ;?>
<?php if($query->have_posts()): ?> 

<section id="ourTeam" class="row shortcodesRow">
<div class="container">
	<h4 class="shortcodeHeading"><?php echo balanceTags($title);?></h4>
	<div class="row">
		
		<?php  while($query->have_posts()): $query->the_post();
			   global $post ; 
			   $meta = _WSH()->get_meta() ; 
		?>
		
		<div class="col-sm-3">
			<div class="thumbnail">
				<?php the_post_thumbnail('249x260');?>
				<div class="caption">
					<h4><?php the_title();?></h4>
					<h5><?php echo sh_set($meta, 'designation');?></h5>
					<ul class="list-inline row m0">
						<?php if($socials = sh_set($meta, 'sh_team_social')): //printr($socials);?>
						<?php foreach($socials as $key => $social):?>
							<li><a href="<?php echo sh_set($social, 'social_link');?>"><i class="fa <?php echo sh_set($social, 'social_icon');?>"></i></a></li>
						<?php endforeach; ?>
						<?php endif;?>
					</ul>
				</div>
			</div>
		</div>
		
		<?php endwhile; ?>
		
	</div>
</div>
</section>



<?php endif;?>

<?php 
   $output = ob_get_contents(); 
   ob_end_clean(); 
   return $output ; ?>