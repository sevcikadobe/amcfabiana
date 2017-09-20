<?php
/**
 * Cart Page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.1.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $woocommerce; ?>
<section class="row contentRowPad">
    <div class="container">
        <div class="row cartPage">
		
		<h3 class="heading pageHeading"><?php wp_title('');?></h3>
<?php
wc_print_notices();
do_action( 'woocommerce_before_cart' ); ?>
<form action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post">
	<?php do_action( 'woocommerce_before_cart_table' ); ?>
	 <div class="table-responsive cartTable row m0 shop_table cart">
		<table class="table">
			<thead>
				<tr>
					<th class="productImage"><?php esc_html_e( 'Product image', 'furniture' ); ?></th>
					<th class="productName"><?php esc_html_e( 'Product name', 'furniture' ); ?></th>
					<th class="productprice"><?php esc_html_e( 'price', 'furniture' ); ?></th>
					<th class="product-quantity"><?php esc_html_e( 'quantity', 'furniture' ); ?></th>
					<th class="product-subtotal"><?php esc_html_e( 'total', 'furniture' ); ?></th>
					<th class="product-remove"><?php esc_html_e( 'remove', 'furniture' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php do_action( 'woocommerce_before_cart_contents' ); ?>
				<?php
				foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
					$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
					$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
					if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
						?>
						<tr  role="alert" class="alert <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
							<td class="productImage">
								<?php
									$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
									if ( ! $_product->is_visible() )
										echo balanceTags($thumbnail);
									else
										printf( '<a href="%s">%s</a>', $_product->get_permalink(), $thumbnail );
								?>
							</td>
							<td class="productName">
								<?php
									if ( ! $_product->is_visible() )
										echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
									else
										echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', $_product->get_permalink(), $_product->get_title() ), $cart_item, $cart_item_key );
									// Backorder notification
		               				if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) )
		               					echo '<p class="backorder_notification">' . __( 'Available on backorder', 'furniture' ) . '</p>';
								?>
								
								<div class="row descList m0">
                                        <dl class="dl-horizontal">
                                            
											<?php // Meta data
												  echo WC()->cart->get_item_data( $cart_item );
											?>
                                        
										</dl>
                                    </div>
							</td>
							<td class="price">
								
								<?php
									echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
								?>
								
							</td>
							
							<td>
								<?php
									if ( $_product->is_sold_individually() ) {
										$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
									} else {
										$product_quantity = woocommerce_quantity_input( array(
											'input_name'  => "cart[{$cart_item_key}][qty]",
											'input_value' => $cart_item['quantity'],
											'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
											'min_value'   => '0'
										), $_product, false );
									}
									echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );
								?>
							</td>
							
							<td class="price">
								<?php
									echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
								?>
							</td>
							
							<td class="product-remove">
								<?php
									echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="remove edit" title="%s"><i class="fa fa-trash-o"></i></a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'furniture' ) ), $cart_item_key );
								?>
							</td>
							
						</tr>
						<?php
					}
				}
				do_action( 'woocommerce_cart_contents' );
				?>
				<tr>
					<td colspan="7" class="actions">
						<?php if ( WC()->cart->coupons_enabled() ) { ?>
							<div class="coupon pull-left">
								<label for="coupon_code"><?php esc_html_e( 'Coupon', 'furniture' ); ?>:</label> <input type="text" name="coupon_code" class="input-text btn btn-primary btn-lg" id="coupon_code" value="" placeholder="<?php esc_html_e( 'Coupon code', 'furniture' ); ?>" /> <input type="submit" class="btn btn-primary" name="apply_coupon" value="<?php esc_html_e( 'Apply Coupon', 'furniture' ); ?>" />
								<?php do_action('woocommerce_cart_coupon'); ?>
							</div>
						<?php } ?>
						<div class="pull-right">
							<input type="submit" class="btn btn-primary btn-default" name="update_cart" value="<?php esc_html_e( 'Update Cart', 'furniture' ); ?>" /> <input type="submit" class="checkout-button btn btn-primary alt wc-forward btn-default" name="proceed" value="<?php esc_html_e( 'Proceed to Checkout', 'furniture' ); ?>" />
						</div>
						<?php //do_action( 'woocommerce_proceed_to_checkout' ); ?>
						<?php wp_nonce_field( 'woocommerce-cart' ); ?>
					</td>
				</tr>
				<?php do_action( 'woocommerce_after_cart_contents' ); ?>
			</tbody>
		</table>
	</div>
<?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>
<hr />
<div class="clearfix"></div>
<div class="row calculate">
	<div class="cart-collaterals">
		<div class="padding-top">
			<?php woocommerce_cart_totals(); ?>
		
			<?php woocommerce_shipping_calculator(); ?>
	        <div class="clearfix"></div>
	        
			<?php //do_action( 'woocommerce_cart_collaterals' ); ?>
		</div>
	</div>
</div>
<?php do_action( 'woocommerce_after_cart' ); ?>
		</div>
	</div>
</section>
