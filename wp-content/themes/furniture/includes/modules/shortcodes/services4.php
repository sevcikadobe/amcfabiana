<?php  
   ob_start() ;?>

<div class="column4">
<div class="row m0 sideBox">
	<div class="row imgB m0">
		<img src="<?php echo wp_get_attachment_url($img, 'full')?>" width="301" height="253" alt="" />
	</div>
	<div class="row m0 icoPlus">
		<img src="<?php echo wp_get_attachment_url($img2, 'full')?>" alt="" width="64" height="64" /><br>
		<a href="<?php echo esc_url($btn_link);?>"><span><?php echo balanceTags($btn_text);?></span></a>
	</div>
</div>
</div>

<?php 
$output = ob_get_contents(); 
ob_end_clean(); 
return $output ; ?>