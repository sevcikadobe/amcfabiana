<?php
$count = 1;  
ob_start() ;
$options = _WSH()->option();
$option_media = sh_set( sh_set( $options, 'social_media' ), 'social_media' );
$exploded = explode( ',', $social_media );
?>

<section id="welcome2furniture" class="row contentRowPAd">
<div class="container">
	<h3 class="heading"><?php echo balanceTags($title);?></h3>
	<p><?php echo balanceTags($contents);?></p>
	<ul class="list-inline">
		<?php if($exploded)
		foreach( $exploded as $exp ): 
			$social = sh_set( $option_media, $exp ); //printr($social);?>
			<li><a href="<?php echo esc_url( sh_set( $social, 'social_link' ) ); ?>"><i class="fa <?php echo sh_set($social, 'social_icon');?>"></i></a></li>
		<?php endforeach; ?>
	</ul>
</div>
</section>

<?php
	$output = ob_get_contents(); 
   ob_end_clean(); 
   return $output ; ?>   