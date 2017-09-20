<?php
$count = 1;  
ob_start() ;
$options = _WSH()->option();
?>

<!-- Client Logos -->
<section id="brands2" class="row contentRowPad">
<div class="container">
	<h3 class="heading text-center"><?php echo balanceTags($title);?></h3>
	<div class="row brands">                
		<ul class="nav">
		<?php if($clients = sh_set(sh_set($options, 'brand_or_client'), 'brand_or_client')):?>
		<?php foreach($clients as $key => $value):?>
		<?php if(sh_set($value, 'tocopy') || $count > $num) continue;?>
			<li><a href="<?php echo sh_set($value, 'client_link');?>"><img src="<?php echo sh_set($value, 'brand_img');?>" alt=""></a></li>
		<?php $count++; endforeach;?>
        <?php endif;?>	
		</ul>
	</div>
</div>
</section>

<?php
	$output = ob_get_contents(); 
   ob_end_clean(); 
   return $output ; ?>   