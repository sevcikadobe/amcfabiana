<?php $theme_options = _WSH()->option(); ?>
<div class="user-controls-bar">
		<?php global $woocommerce; ?>
				
				<div class="dropBox">
					<div class="box-section">
						<?php if( function_exists('WC') )
							if( WC()->cart->get_cart() ):?>
                                <ul class="cart-info-list">
                                    
                                        
                                    <li class="cart-item">
                                    </li>
                                    
                                </ul><!--/ cart-info-list -->
                                <?php $cart_page = get_option( 'woocommerce_cart_page_id' );?>
                                
								<div class="text-center">
                                    <a href="<?php echo get_permalink( wc_get_page_id('shop' )); ?>" class="btn btn-dark btn-block dismiss-button">Continue Shopping</a>
                                    
                                    <?php if( $cart_page ): ?>
                                        <a href="<?php echo get_permalink( $cart_page ); ?>" class="btn btn-dark btn-block dismiss-button"><?php _e('Continue Cart', 'furniture');?></a>
                                    <?php endif; ?>
                                </div>
						<?php else: ?>
                        
							<div class="text-center">
							  <h6>Your Cart is empty</h6>
							  <a href="<?php echo get_permalink( wc_get_page_id('shop' )); ?>" class="btn btn-dark btn-block dismiss-button">Continue Shopping</a>
							  
							</div>							
						<?php endif; ?>
					</div><!-- /cart-info-box -->	
	      		</div><!-- /dropBox -->
	</div><!-- /user-controls -->