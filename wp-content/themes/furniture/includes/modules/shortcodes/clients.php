<?php
$count = 1;  
ob_start() ;
$options = _WSH()->option();
?>

<!-- Client Logos -->
<section id="brands" class="row contentRowPad">
<div class="container">
	<div class="row sectionTitle">
		<h3><?php echo balanceTags($title);?></h3>
		<h5><?php echo balanceTags($subtitle);?></h5>
	</div>
	<div class="row brands">                
		<ul class="nav navbar-nav">
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