<?php

class Slider{

	//                    __  __              __    
	//    ____ ___  ___  / /_/ /_  ____  ____/ /____
	//   / __ `__ \/ _ \/ __/ __ \/ __ \/ __  / ___/
	//  / / / / / /  __/ /_/ / / / /_/ / /_/ (__  ) 
	// /_/ /_/ /_/\___/\__/_/ /_/\____/\__,_/____/  
	public function __construct()
	{
		add_shortcode( 'slider', array(&$this, 'getHTML') );
	}
	/**
	 * Get slidet HTML
	 * @param  array  $args --- query arguments
	 * @return string       --- HTML code
	 */
	public function getHTML($args = array())
	{
		$defaults = array(
			'posts_per_page'   => 5,
			'offset'           => 0,
			'orderby'          => 'post_date',
			'order'            => 'DESC',
			'include'          => '',
			'exclude'          => '',
			'meta_key'         => '',
			'meta_value'       => '',
			'post_type'        => 'slide',
			'post_mime_type'   => '',
			'post_parent'      => '',
			'post_status'      => 'publish',
			'suppress_filters' => true 
		);

		if(isset($args['gallery']))
		{
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'gallery',
					'field'    => 'id',
					'terms'    => $args['gallery'],
				),
			);
			unset($args['gallery']);
		}

		$args   = array_merge($defaults, $args);
		$slides = get_posts($args);
		$res    = array();
		if(count($slides))
		{
			foreach ($slides as &$slide) 
			{
				$res[] = $this->wrapSlide($slide);
			}
			return $this->wrapSlider(implode('', $res));
		}
		return '';
	}                                        

	private function wrapSlider($slides)
	{
		ob_start();
		?>
		<div class="main-slider">
			<aside>
				<ul class="slides">
					<?php echo $slides; ?>
				</ul>
			</aside>			
		</div>
		<?php

	    $var = ob_get_contents();
	    ob_end_clean();
	    return $var;
	}

	/**
	 * Wrap single slide to HTML
	 * @param  object $slide --- post object
	 * @return string        --- HTML code
	 */
	private function wrapSlide($slide)
	{
		$thumb = wp_get_attachment_image_src(get_post_thumbnail_id($slide->ID), 'medium');
	    $thumb = is_array($thumb) ? $thumb[0] : 'http://placehold.it/1020x328';
	    $sale  = (string) get_post_meta($slide->ID, 'aso_sale', true);
	    $sub   = (string) get_post_meta( $slide->ID, 'aditional_options_subtitle', true );
		ob_start();
		?>
		<li>
			<figure>
				<img src="<?php echo $thumb; ?>" alt="<?php echo $slide->post_title; ?>">
				<figcaption>
					<span class="title"><?php echo $slide->post_title; ?></span>
					<span class="subtitle"><?php echo $sub; ?></span>
				</figcaption>
			</figure>
		</li>
		<?php

	    $var = ob_get_contents();
	    ob_end_clean();
	    return $var;
	}
}