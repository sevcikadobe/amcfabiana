<?php ob_start(); ?>

<div class="media contactInfo">
	<div class="media-left">
		<i class="<?php echo esc_attr($icon);?>"></i>
	</div>
	<div class="media-body">
		<h5 class="heading"><?php echo balanceTags($title);?></h5>
		<p><?php echo balanceTags($contents);?></p>
	</div>
</div> <!--contactInfo-->

<?php return ob_get_clean(); 