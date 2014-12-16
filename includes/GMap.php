<?php

class GMap{
	//                    __  __              __    
	//    ____ ___  ___  / /_/ /_  ____  ____/ /____
	//   / __ `__ \/ _ \/ __/ __ \/ __ \/ __  / ___/
	//  / / / / / /  __/ /_/ / / / /_/ / /_/ (__  ) 
	// /_/ /_/ /_/\___/\__/_/ /_/\____/\__,_/____/  
	public function __construct()
	{
		add_shortcode( 'gmap', array(&$this, 'getHTML') );
	}	                                             

	/**
	 * Get google map HTML code
	 * @param  array $args --- arguments array
	 * @return string --- google map HTML code
	 */
	public function getHTML($args)
	{
		$lng = (string) get_option( 'gc_gs_longitude' );
		$lat = (string) get_option( 'gc_gs_latitude' );
		return sprintf('<div id="map-canvas" data-lng="%s" data-lat="%s"></div>', $lng, $lat);
	}
}