<?php

class Coverflow{
	//                    __  __              __    
	//    ____ ___  ___  / /_/ /_  ____  ____/ /____
	//   / __ `__ \/ _ \/ __/ __ \/ __ \/ __  / ___/
	//  / / / / / /  __/ /_/ / / / /_/ / /_/ (__  ) 
	// /_/ /_/ /_/\___/\__/_/ /_/\____/\__,_/____/  
	public function __construct()
	{
		add_shortcode( 'coverflow', array(&$this, 'getHTML') );
	}                                             

	public function getHTML($args)
	{
		$defaults = array(
			'posts_per_page'   => -1,
			'offset'           => 0,
			'orderby'          => 'post_date',
			'order'            => 'DESC',
			'include'          => '',
			'exclude'          => '',
			'meta_key'         => '',
			'meta_value'       => '',
			'post_type'        => 'info_coverflow',
			'post_mime_type'   => '',
			'post_parent'      => '',
			'post_status'      => 'publish',
			'suppress_filters' => true 
		);

		if(isset($args['info_category']))
		{
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'info_category',
					'field'    => 'id',
					'terms'    => $args['info_category'],
				),
			);
			unset($args['info_category']);
		}
		$args   = array_merge($defaults, $args);
		$images = get_posts($args);
		$result = array();
		if(count($images))
		{
			foreach ($images as $image) 
			{
				array_push( $result, $this->wrapFigure( $image ) );
			}
			return $this->wrapCoverflow( implode('', $result ) );
		}
		return '';
	}

	/**
	 * Wrap images to HTML code
	 * @param  string $images --- images HTML code
	 * @return string --- coverflow HTML code
	 */
	public function wrapCoverflow($images)
	{
		ob_start();
		?>
		<ul id="coverflow" class="boutique">
			<?php echo $images; ?>
		</ul>
		<?php
		
		$var = ob_get_contents();
		ob_end_clean();
		return $var;
	}

	/**
	 * Wrap image and content to figure HTML 
	 * @param  object $object --- post object
	 * @return string --- HTLM code
	 */
	private function wrapFigure($object)
	{
		$image = $this->wrapImage($object);
		ob_start();
		?>
		<li>
			<figure>
				<?php echo $image; ?>
				<figcaption>
					<?php echo $object->post_content; ?>
				</figcaption>
			</figure>
		</li>
		<?php
		$var = ob_get_contents();
		ob_end_clean();
		return $var;
	}

	/**
	 * Wrap thumbnail to HTML code
	 * @param  object $image --- post object
	 * @return string --- HTML code
	 */
	private function wrapImage($image)
	{
		$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $image->ID ), 'coverflow' );
		$thumb = is_array($thumb) ? $thumb[0] : 'http://placehold.it/282x476';
		$url   = (string) get_post_meta( $image->ID, 'aditional_options_url', true );
		return sprintf(
			'<img src="%s" alt="" data-url="%s">',
			$thumb, $url
		);
	}

	/**
	 * Get coverflow code
	 * @param  integer $cat --- category id
	 * @return HTML code
	 */
	public static function getCoverflow($cat)
	{
		$cat = intval($cat);
		if(!$cat) return '';
		ob_start();
		?>
		<div class="coverflow-block">
			<div class="coverflow-wrapper">
				<?php echo do_shortcode( '[coverflow info_category="'.$cat.'"]' ); ?>	
			</div>	
		</div>
		<?php
		
		$var = ob_get_contents();
		ob_end_clean();
		return $var;
	}
}