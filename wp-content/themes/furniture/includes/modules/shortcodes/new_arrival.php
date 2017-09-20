<?php  
  ob_start() ;?>

<div class="homeBanner">
	<div class="row">
		<img src="<?php echo wp_get_attachment_url($img, 'full');?>" alt="" class="bgImage" width="293" height="180" />
		<div class="row m0 bannerTextArea">
			<div class="row m0 bannerTextAreaInner">
				<h4><?php echo balanceTags($title);?></h4>
				<h5><?php echo balanceTags($subtitle);?></h5>
			</div>
		</div>
	</div>
</div>

<?php 
   $output = ob_get_contents(); 
   ob_end_clean(); 
   return $output ; ?>