<?php ob_start(); ?>

<div class="row m0">
	<h4 class="contactHeading heading"><?php echo balanceTags($title);?></h4>
</div>
 <!--contactInfo-->
	<?php echo do_shortcode( $contents );?>
 <!--contactInfo-->

<?php return ob_get_clean(); ?>