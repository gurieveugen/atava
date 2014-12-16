<?php
/*
 * @package WordPress
 * @subpackage Base_Theme
 */

// ==============================================================
// Constants
// ==============================================================
define('TDU', get_bloginfo('template_url'));
define( 'WPCF7_AUTOP', false );
// ==============================================================
// Require
// ==============================================================
require_once 'includes/__.php';

// ==============================================================
// Actions & filters
// ==============================================================
add_action('wp_enqueue_scripts', 'scriptsAndStyles');
add_action('after_setup_theme', 'themeSetup');

/**
 * Add some scripts and styles
 */
function scriptsAndStyles() 
{
	// ==============================================================
	// Scripts
	// ==============================================================
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'string-format', TDU.'/js/string.format.js' );
	wp_enqueue_script( 'transport', TDU.'/js/transport.js', array( 'jquery' ) );
	wp_enqueue_script( 'main', TDU.'/js/main.js', array( 'jquery', 'transport' ) );
	wp_enqueue_script( 'flexslider', TDU.'/js/flexslider.js', array( 'jquery' ) );
	wp_enqueue_script( 'boutique', TDU.'/js/jquery.boutique.js', array( 'jquery' ) );
	wp_enqueue_script( 'selecter', TDU.'/js/jquery.fs.selecter.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'jquery-ui-datepicker');
	wp_enqueue_script( 'google_map', 'https://maps.googleapis.com/maps/api/js?v=3.exp' );
	//wp_enqueue_script( 'boxer', TDU.'/js/jquery.fs.boxer.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'jcarousel', TDU.'/js/jquery.jcarousel.min.js', array( 'jquery' ) );

	wp_enqueue_script( 'jquery.mousewheel', TDU.'/fancybox/lib/jquery.mousewheel-3.0.6.pack.js', array( 'jquery' ) );
	wp_enqueue_script( 'jquery.fancybox', TDU.'/fancybox/source/jquery.fancybox.pack.js', array( 'jquery' ) );
	wp_enqueue_script( 'jquery.fancybox-buttons', TDU.'/fancybox/source/helpers/jquery.fancybox-buttons.js', array( 'jquery' ) );
	wp_enqueue_script( 'jquery.fancybox-media', TDU.'/fancybox/source/helpers/jquery.fancybox-media.js', array( 'jquery' ) );
	wp_enqueue_script( 'jquery.fancybox-thumbs', TDU.'/fancybox/source/helpers/jquery.fancybox-thumbs.js', array( 'jquery' ) );

	// ==============================================================
	// Styles
	// ==============================================================
	wp_enqueue_style( 'boutique', TDU.'/css/boutique.css' );
	wp_enqueue_style( 'selecter', TDU.'/css/jquery.fs.selecter.min.css' );
	wp_enqueue_style( 'jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css' );
	//wp_enqueue_style( 'boxer', TDU.'/css/jquery.fs.boxer.css' );
	//
	wp_enqueue_style( 'jquery.fancybox', TDU.'/fancybox/source/jquery.fancybox.css?v=2.1.5' );
	wp_enqueue_style( 'jquery.fancybox-buttons', TDU.'/fancybox/source/helpers/jquery.fancybox-buttons.css' );
	wp_enqueue_style( 'jquery.fancybox-thumbs', TDU.'/fancybox/source/helpers/jquery.fancybox-thumbs.css' );

	// ==============================================================
	// Localize
	// ==============================================================
	wp_localize_script( 'main', 'defaults', array( 'template_url' => get_bloginfo('template_url') ) );
}

/**
 * Setup Theme
 */
function themeSetup() 
{
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'full', 9999, 569, true );
	add_image_size( 'featured', 232, 192, true );
	add_image_size( 'widget-small', 301, 306, true );
	add_image_size( 'widget-large', 1292, 548, true );
	add_image_size( 'testimonial-author', 57, 57, true );
	add_image_size( 'coverflow', 282, 476, true );
	add_image_size( 'medium', 490, 324, true );
	add_image_size( 'castle', 227, 178, true );
	add_image_size( 'castle_inner', 302, 193, true );

	register_nav_menus( 
		array(
			'primary'      => __( 'Top primary menu', 'goldenstudy' ),
		) 
	);
}


// ==============================================================
// Control Collections
// ==============================================================
$ccollection_global = new Controls\ControlsCollection(
	array(		
		new Controls\Text(
			'Phone', 
			array(
				'default-value' => '+420 777 000 000',
				'description'   => 'Your contact phone'
			), 
			array('placeholder' => 'Enter your contact phone')
		),
		new Controls\Text(
			'Longitude', 
			array(
				'default-value' => '+420 777 000 000',
				'description'   => 'Longitude from google maps'
			), 
			array('placeholder' => 'Enter your Longitude')
		),
		new Controls\Text(
			'Latitude', 
			array(
				'default-value' => '+420 777 000 000',
				'description'   => 'Latitude from google maps'
			), 
			array('placeholder' => 'Enter your Latitude')
		),
	)
);

$ccollection_slide = new Controls\ControlsCollection(
	array(
		new Controls\Text(
			'Subtitle',
			array(
				'description' => 'Slide subtitle'
			),
			array(
				'placeholder' => 'Slide subtitle'
			)
		)
	)
);

$ccollection_info_coverflow = new Controls\ControlsCollection(
	array(
		new Controls\Text(
			'URL',
			array(
				'description' => 'Target URL'
			),
			array(
				'placeholder' => 'Target URL'
			)
		)
	)
);

$ccollection_page = new Controls\ControlsCollection(
	array(
		new Controls\Text(
			'Info category',
			array('description' => 'Enter info category. Example : 3'),
			array('placeholder' => 'Enter info category')
		),
		new Controls\Text(
			'Castle category',
			array('description' => 'Enter castle category. Example : 3'),
			array('placeholder' => 'Enter castle category')
		),
	)
);
// ==============================================================
// Sections
// ==============================================================
$section_global    = new Admin\Section(
	'Global settings', 
	array(
		'prefix'   => 'gc_gs_',
		'tab_icon' => 'fa-cog'
	), 
	$ccollection_global
);

// ==============================================================
// Pages
// ==============================================================
$page_settings = new Admin\Page(
	'Theme settings', array(), 
	array(
		$section_global
	)
);
// ==============================================================
// Post Types
// ==============================================================
$pt_slider = new Admin\PostType(
	'Slide',
	array(
		'icon_code' => 'f03e'
	)
);
$pt_coverflow = new Admin\PostType(
	'Info coverflow',
	array(
		'icon_code' => 'f129'
	)
);
$pt_castles = new Admin\PostType(
	'Castle',
	array(
		'icon_code' => 'f1ad',
		'supports'  => array('title', 'editor', 'thumbnail', 'excerpt'),
	)
);
// ==============================================================
// Taxonomies
// ==============================================================
$t_slider_cat = new Admin\Taxonomy(
	'Gallery',
	array(
		'post_type' => 'slide'
	)
);

$t_info_cat = new Admin\Taxonomy(
	'Info category',
	array(
		'post_type' => 'info_coverflow'
	)
);

$t_castles_cat = new Admin\Taxonomy(
	'Castles category',
	array(
		'post_type' => 'castle'
	)
);
// ==============================================================
// MetaBoxes
// ==============================================================
$mb_slide = new Admin\MetaBox(
	'Aditional options',
	array(
		'post_type' => 'slide'
	),
	$ccollection_slide
);

$mb_info_coverflow = new Admin\MetaBox(
	'Aditional options',
	array(
		'post_type' => 'info_coverflow'
	),
	$ccollection_info_coverflow
);

$mb_page = new Admin\MetaBox(
	'Aditional options',
	array(
		'post_type' => 'page',
		'prefix' => 'p_'
	),
	$ccollection_page
);
// ==============================================================
// Additional classes
// ==============================================================

$slider    = new Slider();
$coverflow = new Coverflow();
$castles   = new Castles();
$gmap      = new GMap();