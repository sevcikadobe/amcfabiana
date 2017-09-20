<?php


/** Set ABSPATH for execution */
define( 'ABSPATH', dirname(dirname(__FILE__)) . '/' );
define( 'WPINC', 'wp-includes' );

/**
 * @ignore
 */
//function __() {}

/**
 * @ignore
 */
//function _x() {}

/**
 * @ignore
 */
function add_filter() {}

/**
 * @ignore
 */
function esc_attr($str) {return $str;}

/**
 * @ignore
 */
function apply_filters() {}

/**
 * @ignore
 */
function get_option() {}

/**
 * @ignore
 */
function is_lighttpd_before_150() {}

/**
 * @ignore
 */
function add_action() {}

/**
 * @ignore
 */
function did_action() {}

/**
 * @ignore
 */
function do_action_ref_array() {}

/**
 * @ignore
 */
function get_bloginfo() {}

/**
 * @ignore
 */
function is_admin() {return true;}

/**
 * @ignore
 */
function site_url() {}

/**
 * @ignore
 */
function admin_url() {}

/**
 * @ignore
 */
function home_url() {}

/**
 * @ignore
 */
function includes_url() {}

/**
 * @ignore
 */
function wp_guess_url() {}

if ( ! function_exists( 'json_encode' ) ) :
/**
 * @ignore
 */
function json_encode() {}
endif;



/* Convert hexdec color string to rgb(a) string */
 
function hex2rgba($color, $opacity = false) {
 
	$default = 'rgb(0,0,0)';
 
	//Return default if no color provided
	if(empty($color))
          return $default; 
 
	//Sanitize $color if "#" is provided 
        if ($color[0] == '#' ) {
        	$color = substr( $color, 1 );
        }
 
        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return $default;
        }
 
        //Convert hexadec to rgb
        $rgb =  array_map('hexdec', $hex);
 
        //Check if opacity is set(rgba or rgb)
        if($opacity){
        	if(abs($opacity) > 1)
        		$opacity = 1.0;
        	$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
        	$output = 'rgb('.implode(",",$rgb).')';
        }
 
        //Return rgb(a) color string
        return $output;
}

$color = '#ffc300';
if( isset($_GET['color'])) {
	$color = $_GET['color'];
}
$color = '#'.$color;
ob_start(); ?>
#header .logo_line .searchSec .searchForm .input-group .searchIco, #header .navbar #mainNav .nav li a:hover, #header .logo_line .searchSec .cartCount .cartCountInner .badge, footer .topFooter .widget input.form-control[type="submit"]:hover, footer .topFooter .widget input.form-control[type="submit"]:focus, #header .navbar #mainNav .nav li.active a, #header .navbar #mainNav .nav li.open a, #breadcrumbRow .pageTitle, #whatWeDid .tab_menu .row .nav li.active a, .ourGreatServices .column4 .sideBox .icoPlus a, #contactBanner, #pricing .pricing.active .pricingTitle, #pricing .pricing.active .joinNow, #pricing .pricing:hover .pricingTitle,#pricing .pricing:hover .joinNow, #pricing .pricing.active:hover .joinNow a, .btn.btn-primary.filled, .tooltip .tooltip-inner, .tooltip .tooltip-arrow, .base-bg, .custom_progress .progress-bar, .product2 .thumbnail .imgHov .hovArea .getlike,.cartTable .table tbody tr td .edit, .woocommerce-checkout .btn  {
  background-color: <?php echo esc_attr($color); ?> ;
} 

#testiTab li a i, .testiTabContent .tab-pane h5.customerName, footer .topFooter .widget ul li a:hover, #header .top_menus .nav li a:hover, #hww .col-sm-4 h5 span, #header .navbar #mainNav .nav li.dropdown .dropdown-menu li a:hover, #header .navbar #mainNav .nav li.open .dropdown-menu li a:hover, .ourGreatServices .column4 .middleBox h4, .ourGreatServices .column4 .middleBox a, .blog .titleRow .titlePart .blogTitle:hover, .blog .titleRow .titlePart p a:hover, .blog .titleRow .titlePart p a:hover, .blog .titleRow .date:hover, .btn.btn-primary, span[data-toggle="tooltip"], abbr[title], .testimonialStyle2 .clientInfo .clientName, .testimonialStyle4 .clientName, .product2 .thumbnail .imgHov .hovArea .links a, .product2 .thumbnail .productIntro .heading span {
 color: <?php echo esc_attr($color); ?> ;
}

footer .topFooter .widget input.form-control[type="submit"]:hover, footer .topFooter .widget input.form-control[type="submit"]:focus, .blog .titleRow .date:hover, .btn.btn-primary, abbr[title], .testimonialStyle4, #header .navbar #mainNav .nav li.dropdown .dropdown-menu, #header .navbar #mainNav .nav li.open .dropdown-menu, .product2 .thumbnail .imgHov .hovArea .links a {
	border-color: <?php echo esc_attr($color); ?>
<?php 

$out = ob_get_clean();
$expires_offset = 31536000; // 1 year
header('Content-Type: text/css; charset=UTF-8');
header('Expires: ' . gmdate( "D, d M Y H:i:s", time() + $expires_offset ) . ' GMT');
header("Cache-Control: public, max-age=$expires_offset");
header('Vary: Accept-Encoding'); // Handle proxies
header('Content-Encoding: gzip');

echo gzencode($out);
exit;