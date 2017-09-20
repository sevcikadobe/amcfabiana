<?php  
   ob_start() ;?>

<section id="contactBanner" class="row shortcodesRow">
<div class="container">
	<div class="row">
		<div class="col-sm-9">
			<h3><?php echo balanceTags($title);?></h3>
			<h5><?php echo balanceTags($text);?></h5>
		</div>
		<div class="col-sm-3">
		   <a href="<?php echo esc_url($btn_link);?>" class="btn"><?php echo balanceTags($btn_text);?></a>                    
		</div>
	</div>
</div>
</section>

<?php 
$output = ob_get_contents(); 
ob_end_clean(); 
return $output ; ?>