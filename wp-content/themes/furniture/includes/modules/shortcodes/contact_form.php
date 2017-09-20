<?php

   ob_start();



   $mail_salt = function_exists('_sh_generate_salt' ) ? _sh_generate_salt( $email ) : $email;?>

<div class="row m0">
	<h4 class="contactHeading heading"><?php echo balanceTags($title);?></h4>
</div>
<div id="message"></div>
<div class="row m0 contactForm">
	<form class="row m0" id="contactForm" method="post" action="<?php echo admin_url( 'admin-ajax.php?action=_sh_ajax_callback&amp;subaction=contact_form_submit'); ?>" name="contactForm">
		<div class="row">
			<div class="col-sm-6">
				<label for="name"><?php esc_html_e('Name *', 'furniture');?></label>
				<input type="text" class="form-control" name="contact_name" id="contact_name">
			</div>
			<div class="col-sm-6">
				<label for="email"><?php esc_html_e('Email *', 'furniture');?></label>
				<input type="email" class="form-control" name="contact_email" id="contact_email">
			</div>
		</div>
		<div class="row m0">
			<label for="subject"><?php esc_html_e('subject *', 'furniture');?></label>
			<input type="text" class="form-control" name="contact_subject" id="contact_subject">
		</div>
		<div class="row m0">
			<label for="message"><?php esc_html_e('your message', 'furniture');?></label>
			<textarea name="contact_message" id="contact_message" class="form-control"></textarea>
		</div>
		<button class="btn btn-primary btn-lg filled" type="submit"><?php esc_html_e('send message', 'furniture');?></button>                            
	</form>
	<div id="success">
			<span class="green textcenter">
				<?php esc_html_e('Your message was sent successfully! I will be in touch as soon as I can.', 'furniture');?>
			</span>
	</div>
	<div id="error">
		<span>
			<?php esc_html_e('Something went wrong, try refreshing and submitting the form again.', 'furniture');?>
		</span>
	</div>
</div>
    
<?php return ob_get_clean();?>		