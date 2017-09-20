<?php  
   ob_start() ;?>

<div class="row sectionTitle">
	<h3><?php echo balanceTags($title);?></h3>
	<h5><?php echo balanceTags($subtitle);?></h5>
</div>

<?php 
$output = ob_get_contents(); 
ob_end_clean(); 
return $output ; ?>