<?php

class Castles{
	//                    __  __              __    
	//    ____ ___  ___  / /_/ /_  ____  ____/ /____
	//   / __ `__ \/ _ \/ __/ __ \/ __ \/ __  / ___/
	//  / / / / / /  __/ /_/ / / / /_/ / /_/ (__  ) 
	// /_/ /_/ /_/\___/\__/_/ /_/\____/\__,_/____/  
	public function __construct()
	{
		add_shortcode( 'castles', array(&$this, 'getHTML') );
	}	                                             

	/**
	 * Get castles grid HTML code
	 * @param  array $args --- arguments array
	 * @return string --- castles grid HTML code
	 */
	public function getHTML($args)
	{
		$args = (array) $args;
		$defaults = array(
			'posts_per_page'   => -1,
			'offset'           => 0,
			'orderby'          => 'post_date',
			'order'            => 'DESC',
			'include'          => '',
			'exclude'          => '',
			'meta_key'         => '',
			'meta_value'       => '',
			'post_type'        => 'castle',
			'post_mime_type'   => '',
			'post_parent'      => '',
			'post_status'      => 'publish',
			'suppress_filters' => true 
		);

		if(isset($args['castles_category']))
		{
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'castles_category',
					'field'    => 'id',
					'terms'    => $args['castles_category'],
				),
			);
			unset($args['castles_category']);
		}
		$args    = array_merge($defaults, $args);
		$castles = get_posts($args);
		$result  = array();
		$dialogs = array();
		if(count($castles))
		{
			for($i = 0; $i < count($castles); $i+=4)
			{
				array_push( $result, '<ul>' );
				for($x = 0; $x < 5; $x++)
				{
					if(!isset($castles[$i+$x])) continue;
					$castle = $castles[$i+$x];
					array_push( $result, $this->wrapFigure( $castle ) );
					array_push( $dialogs, $this->wrapDialog( $castle ) );
				}
				array_push( $result, '</ul>' );
			}
	
			return $this->wrapCastles( implode('', $result ).implode('', $dialogs) );
		}
		return '';
	}

	/**
	 * Wrap castles to container HTML code
	 * @param  string $castles --- castles HTML code
	 * @return string --- castles HTML code
	 */
	public function wrapCastles($castles)
	{
		ob_start();
		?>
		<div class="castles">
			<?php echo $castles; ?>
		</div>
		<?php
		
		$var = ob_get_contents();
		ob_end_clean();
		return $var;
	}

	/**
	 * Wrap object to dialog box HTML
	 * @param  object $o --- post object ( stdClass )
	 * @return string --- HTML code
	 */
	private function wrapDialog($o)
	{
		ob_start();
		?>
		<div id="castle-dialog-<?php echo $o->ID; ?>" class="castle-dialog">
			<div class="content">
				<?php echo $this->getImages($o); ?>
		    	<article>
		    		<h1><?php echo $o->post_title; ?></h1>
		    		<div class="txt">
		    			<?php echo $o->post_content; ?>	
		    		</div>
		    	</article>
		    </div>
		</div>
		<?php
		$var = ob_get_contents();
		ob_end_clean();
		return $var;
	}

	/**
	 * Get images from post
	 * @param  object $o --- post object
	 * @return string --- html code
	 */
	private function getImages($o)
	{
		$str = '';
		$images = self::getAllImagesFromPost($o->ID, 'castle_inner');
		if(count($images))
		{
			foreach ($images as $img) 
			{
				$str .= sprintf('<li><img src="%s" alt="Image"></li>', $img);
			}
		}
		ob_start();
		?>
		<div class="images-block">
			<aside id="jcarousel-<?php echo $o->ID; ?>">
				<ul class="images slides">
					<?php echo $str; ?>
				</ul>
			</aside>
		</div>
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
		<li id="castle-<?php echo $object->ID; ?>">
			<span class="title"><?php echo $object->post_title; ?></span>
			<figure>
				<?php echo $image; ?>
				<figcaption>
					<?php echo $object->post_excerpt; ?>
					<a href="#castle-dialog-<?php echo $object->ID; ?>" class="btn fancybox-inline">Číst dále</a>
					<div class="clear"></div>
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
		$thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $image->ID ), 'castle' );
		$thumb = is_array($thumb) ? $thumb[0] : 'http://placehold.it/282x476';
		$url   = (string) get_post_meta( $image->ID, 'aditional_options_url', true );
		return sprintf(
			'<img src="%s" alt="" data-url="%s">',
			$thumb, $url
		);
	}

	/**
	 * Get castles code
	 * @param  integer $cat --- category id
	 * @return HTML code
	 */
	public static function getCastles($cat)
	{
		$cat = intval($cat);
		if(!$cat) return '';
		ob_start();
		?>
		<div class="castles-block">
			<?php echo do_shortcode( '[castles castles_category="'.$cat.'"]' ); ?>	
		</div>
		<?php
		
		$var = ob_get_contents();
		ob_end_clean();
		return $var;
	}


	/**
	* Get all images from post
	*/
	public static function getAllImagesFromPost($id, $size = 'full')
	{
		$args = array(
			'post_type'   => 'attachment',
			'numberposts' => -1,
			'post_status' => null,
			'post_parent' => $id
		);
		$images = array();

		$post_thumbnail = intval(get_post_thumbnail_id( $id ));
		$attachments = get_posts( $args );
		if ( $attachments )
		{
			foreach ( $attachments as $attachment )
			{
				if($attachment->ID == $post_thumbnail) continue;
				$tmp = wp_get_attachment_image_src($attachment->ID, $size);

				if($tmp[0])
				{
					$images[] = $tmp[0];
				}  
			}
		}
		return $images;
	}
	
}