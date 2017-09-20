<?php ob_start(); ?>

<div class="col-sm-4">
<div class="pricing row m0 <?php if($active) echo 'active';?>">
	<div class="row m0 pricingTitle"><?php echo balanceTags($title);?></div>
	<div class="row features m0">
		<div class="row m0 pricePerMonth"><i class="fa fa-usd"></i><span class="amount"><?php echo balanceTags($price);?></span><?php echo balanceTags($package_duration);?></div>
		<ul class="list-group">
			
			<?php $features = explode("\n",$feature_str);?>
            <?php foreach($features as $feature):?>
            	<li class="list-group-item"><?php echo balanceTags($feature);?></li>
			<?php endforeach;?>
			
		</ul>
	</div>
	<div class="row m0 joinNow"><a href="<?php echo esc_url($btn_link);?>"><?php echo balanceTags($btn_text);?></a></div>
</div>
</div>

<?php return ob_get_clean(); 