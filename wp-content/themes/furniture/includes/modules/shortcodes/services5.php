<?php  
   ob_start() ;?>

<div class="column4">
<div class="row m0 middleBox">
	<h4><?php echo balanceTags($title);?></h4>
	<p><?php echo balanceTags($text);?></p>
	<a href="<?php echo esc_url($readmore_link);?>" class="readMore"><?php echo balanceTags($readmore_text);?><i class="fa fa-angle-right"></i></a>
</div>
</div>

<?php 
$output = ob_get_contents(); 
ob_end_clean(); 
return $output ; ?>