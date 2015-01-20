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
		return $this->test();
		
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

	public function test()
	{
		ob_start();
		?>
		<div id="coverflow">
			<div class="covers">
				<ul>
					<li><div class="imgdiv">
							<a href="http://www.example.com" target="_blank">
								<img src="<?php echo TDU; ?>/coverflow/img/01-tunnel.jpg" alt="">
							</a>
						</div>
						<div class="text">
							<p>The text and images are easily indexed by search engines</p>
						</div>
					</li>
					<li><div class="imgdiv">
							<a href="<?php echo TDU; ?>/coverflow/img/02-couple.jpg" data-gallery="gallery" data-cap="lightbox caption 02">
								<img src="<?php echo TDU; ?>/coverflow/img/02-couple.jpg" alt="">
							</a>
						</div>
						<div class="text">
							<p>The text over the images is optional <br> and it is <span style="color: #f55; font-weight: bold; font-size: 20px;">CSS</span><span style="color: yellow; font-style: italic;">formatted</span></p>
						</div>
					</li>
					<li><div class="imgdiv">
							<a href="<?php echo TDU; ?>/coverflow/img/03-bridge.jpg" data-gallery="gallery" data-cap="lightbox caption 03">
								<img src="<?php echo TDU; ?>/coverflow/img/03-bridge.jpg" alt="">
							</a>
						</div>
						<div class="text">
							<p>You can also have <a href="http://www.example.com" target="_blank" style="color: #00a;">links</a></p>
						</div>
					</li>
					<li><div class="imgdiv">
							<a>
								<img src="<?php echo TDU; ?>/coverflow/img/04-china.jpg" alt="">
							</a>
						</div>
						<div class="text">
							
						</div>
					</li>
					<li><div class="imgdiv">
							<a href="<?php echo TDU; ?>/coverflow/img/05-camera.jpg" data-gallery="gallery" data-cap="lightbox caption 05">
								<img src="<?php echo TDU; ?>/coverflow/img/05-camera.jpg" alt="">
							</a>
						</div>
						<div class="text">
							<p>This is a new CSS Jquery Coverflow.</p><p>Install it for free on your website</p>
						</div>
					</li>
					<li><div class="imgdiv">
							<a href="<?php echo TDU; ?>/coverflow/img/06-free.jpg" data-gallery="gallery" data-cap="lightbox caption 06">
								<img src="<?php echo TDU; ?>/coverflow/img/06-free.jpg" alt="">
							</a>
						</div>
						<div class="text">
							<p>Works great on iPhone and iPad</p><p>with tap and swipe movements</p>
						</div>
					</li>
					<li><div class="imgdiv">
							<a href="<?php echo TDU; ?>/coverflow/img/07-joy.jpg" data-gallery="gallery" data-cap="lightbox caption 07">
								<img src="<?php echo TDU; ?>/coverflow/img/07-joy.jpg" alt="">
							</a>
						</div>
						<div class="text">
							<p>The Coverflow is responsive</p><p>Narrow the width of your browser to see</p>
						</div>
					</li>
					<li><div class="imgdiv">
							<a href="<?php echo TDU; ?>/coverflow/img/08-feet.jpg" data-gallery="gallery" data-cap="lightbox caption 08">
								<img src="<?php echo TDU; ?>/coverflow/img/08-feet.jpg" alt="">
							</a>
						</div>
						<div class="text">
							<p>Clicking on this image</p><p>Will open a lightbox with a bigger image</p>
						</div>
					</li>
					<li><div class="imgdiv">
							<a href="http://www.example.com" target="_blank">
								<img src="<?php echo TDU; ?>/coverflow/img/09-girl.jpg" alt="">
							</a>
						</div>
						<div class="text">
							<p>Clicking on this image</p><p>Will take you to an external link</p>
						</div>
					</li>
					<li><div class="imgdiv">
							<a href="<?php echo TDU; ?>/coverflow/img/10-beach.jpg" data-gallery="gallery" data-cap="lightbox caption 10">
								<img src="<?php echo TDU; ?>/coverflow/img/10-beach.jpg" alt="">
							</a>
						</div>
						<div class="text">
							<p>But it could also take you to a link inside your web page</p>
						</div>
					</li>
					</ul>
			</div>
			<div class="Controller"></div>
			<div class="ScrollBar"></div>
		</div>
		<?php
		
		$var = ob_get_contents();
		ob_end_clean();
		return $var;
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