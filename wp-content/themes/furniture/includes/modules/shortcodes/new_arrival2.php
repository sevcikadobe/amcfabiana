<?php  
  ob_start() ;?>
<?php if($style == 'left'):?>
<div class="dum">
<div class="row m0 newArrivals">
	<img src="<?php echo wp_get_attachment_url($img, 'full');?>" alt="" width="371" height="317" />
	<div class="row m0 newArrivalsBox">                            
		<div class="row m0 newArrivalsBoxInner">
			<?php echo balanceTags($contents);?>
		</div>
	</div>
</div>
</div>
<?php else:?>
<div class="dum">
	<div class="row m0 factoryOutlet">
		<img src="<?php echo wp_get_attachment_url($img, 'full');?>" alt="" width="371" height="317">
		<div class="row m0 factoryOutletBox">
			<div class="row m0 factoryOutletBoxInner">
				<?php echo balanceTags($contents);?>
			</div>
		</div>
	</div>
</div>
<?php endif;?>
<?php 
   $output = ob_get_contents(); 
   ob_end_clean(); 
   return $output ; ?>