<?php $options = _WSH()->option();
//print_r($options);
$bg = sh_set( $options, 'footer_bg' );
?>

<footer class="row" <?php if($bg):?>style="background-image: url('<?php echo esc_url($bg); ?>');"<?php endif;?>>
<div class="row m0 topFooter">
<?php if(sh_set( $options, 'footer_top' )):?>
	<div class="container line1">
		<div class="row footFeatures">
			
			<?php if(is_active_sidebar('footer-top-sidebar')) dynamic_sidebar('footer-top-sidebar'); ?>	
		
		</div>
	</div>
	
<?php endif;?>
<?php if(sh_set( $options, 'footer_middle' )):?>
	<div class="container line2">
		<div class="row">
			
			<?php if(is_active_sidebar('footer-sidebar')) dynamic_sidebar('footer-sidebar'); ?>
			
		</div>
	</div>
<?php endif;?>
</div>
<?php if(sh_set( $options, 'footer_bottom' )):?>
<div class="row m0 copyRight">
	<div class="container">
		<div class="row">
			<div class="fleft"><?php echo balanceTags(sh_set($options, 'copy_right'));?></div>
			<ul class="nav nav-pills fright">
				<?php wp_nav_menu( array( 'theme_location' => 'footer_menu', 'container_id' => 'navbar-collapse-1',

                                        'container_class'=>'navbar-collapse collapse',
                                        'menu_class'=>'nav navbar-nav navbar-right',
                                        'fallback_cb'=>false, 
                                        'items_wrap' => '%3$s', 
                                        'container'=>false, 
                                        //'walker'=> new SH_Bootstrap_walker() 

                                    ) ); ?>
			</ul>
		</div>
	</div>
</div>

<?php endif;?>

</footer>

<?php wp_footer(); ?>

</body>

</html>