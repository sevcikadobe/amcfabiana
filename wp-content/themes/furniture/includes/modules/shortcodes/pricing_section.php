<?php ob_start(); ?>

<section id="pricing" class="row contentRowPad">
<div class="container">
	<div class="row sectionTitle">
		<h3><?php echo balanceTags($title); ?></h3>
		<h5><?php echo balanceTags($subtitle); ?></h5>
	</div>
	<div class="row">
		<?php echo do_shortcode( $contents );?>
	</div>
</div>
</section>

<?php return ob_get_clean(); ?>