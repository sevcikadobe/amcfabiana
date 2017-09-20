<?php

if( !class_exists( 'SH_Base' ) ) include_once('base.php');
add_action( 'init', 'sh_theme_init');


if( !function_exists( 'sh_set' ) ) {
	function sh_set( $var, $key, $def = '' )
	{
		//if( !$var ) return false;
	
		if( is_object( $var ) && isset( $var->$key ) ) return $var->$key;
		elseif( is_array( $var ) && isset( $var[$key] ) ) return $var[$key];
		elseif( $def ) return $def;
		else return false;
	}
}


if( !function_exists('printr' ) ) {
	function printr($data)
	{
		echo '<pre>'; print_r($data);exit;
	}
}

if( !function_exists('_font_awesome' ) ) {
	function _font_awesome( $index )
	{
		$array = array_values($GLOBALS['_font_awesome']);
		if( $font = sh_set($array, $index )) return $font;
		else return false;
	}
}

if( !function_exists('_load_class' ) ) {
	function _load_class($class, $directory = 'libraries', $global = true, $prefix = 'SH_')
	{
		$obj = &$GLOBALS['_sh_base'];
		$obj = is_object( $obj ) ? $obj : new stdClass;
	
		$name = FALSE;
	
		// Is the request a class extension?  If so we load it too
		$path = get_template_directory().'/includes/'.$directory.'/'.$class.'.php';
		if( file_exists($path) )
		{
			$name = $prefix.ucwords( $class );
	
			if (class_exists($name) === FALSE)	require($path);
		}
	
		// Did we find the class?
		if ($name === FALSE) exit('Unable to locate the specified class in theme: '.$class.'.php');
	
		if( $global ) $GLOBALS['_sh_base']->$class = new $name();
		else new $name();
	}
}


include_once('library/form_helper.php');
include_once('library/functions.php');
include_once('library/widgets.php');


_load_class( 'enqueue', 'helpers', false );
_load_class( 'seo', 'helpers', false );
_load_class( 'bootstrap_walker', 'helpers', false );


if( sh_set( $_GET, 'sh_shortcode_editor_action' ) ) {
	include_once('resource/shortcode_output.php');exit;
}

/**
 * Include Vafpress Framework
 */
	

if( is_admin() )
/** Plugin Activation */
require_once('thirdparty'.DIRECTORY_SEPARATOR.'tgm-plugin-activation'.DIRECTORY_SEPARATOR.'plugins.php');

function sh_theme_init()
{
	
	global $pagenow;
	
	return;
	
	/**
	 * Include Custom Data Sources
	 */
	require_once 'vafpress/admin/data_sources.php';
	
	/**
	 * Load options, metaboxes, and shortcode generator array templates.
	 */
	// metaboxes
	$tmpl_mb1  = include SH_ROOT.'includes/vafpress/admin/metabox/meta_boxes.php';
	// * Create instances of Metaboxes
	foreach( $tmpl_mb1 as $tmb )  new VP_Metabox($tmb);
	
	$tmpl_mb1  = include SH_ROOT.'includes/vafpress/admin/taxonomy/taxonomy.php';
	include_once( 'vp_new/taxonomy.php' );
	foreach( $tmpl_mb1 as $tmb )  new SH_Metabox($tmb);
	
	
	// shortocode generators
	$tmpl_sg1  = SH_ROOT.'includes/vafpress/admin/shortcode_generator/shortcodes1.php';
	$tmpl_sg2  = SH_ROOT.'includes/vafpress/admin/shortcode_generator/shortcodes2.php';

	if( is_admin() ) {
		
		include_once( 'helpers/backup_class.php' );
		$backup = new SH_Backup_class;
		
		if( sh_set( $_GET, 'page' ) == 'furniture'.'_option' ) 
		{
			if( sh_set( $_GET, 'sh_dummydata_export' ) ){
				
				$backup->export();
			}
			
		}
	}	
	
	if( function_exists( 'vc_map' )) 
	include_once( 'vc_map.php' );
	
	// options
	$tmpl_opt  = SH_ROOT.'includes/vafpress/admin/option/option.php';
	
	
	/**
	 * Create instance of Options
	 */
	$theme_options = new VP_Option(array(
		'is_dev_mode'           => false,                                  // dev mode, default to false
		'option_key'            => 'furniture'.'_theme_options',                      // options key in db, required
		'page_slug'             => 'furniture'.'_option',                      // options page slug, required
		'template'              => $tmpl_opt,                              // template file path or array, required
		'menu_page'             => 'themes.php',                           // parent menu slug or supply `array` (can contains 'icon_url' & 'position') for top level menu
		'use_auto_group_naming' => true,                                   // default to true
		'use_util_menu'         => true,                                   // default to true, shows utility menu
		'minimum_role'          => 'edit_theme_options',                   // default to 'edit_theme_options'
		'layout'                => 'fluid',                                // fluid or fixed, default to fixed
		'page_title'            => __( 'Theme Options', 'furniture' ), // page title
		'menu_label'            => __( 'Theme Options', 'furniture' ), // menu label
	));
	
		_WSH()->user_extra( array('facebook'=>__('Facebook', 'furniture'), 'twitter'=>__('Twitter', 'furniture'), 'dribbble'=>__('Dribble', 'furniture'), 'github'=>__('Github', 'furniture'),
	'flickr'=>__('Flickr', 'furniture'), 'google-plus'=>__('Google+', 'furniture'), 'youtube'=>__('Youtube', 'furniture')) );
	
	$sh_exlude_hooks = include_once( 'resource/remove_action.php' );

	foreach( $sh_exlude_hooks as $k => $v )
	{
		foreach( $v as $value )
		remove_action( $k, $value[0], $value[1] );
	}

}


