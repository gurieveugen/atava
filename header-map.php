<?php
/**
 * @package WordPress
 * @subpackage Base_Theme
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); 
		wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php
	$chat = new Chat();
	echo $chat->getHTML();
	?>
	<a href="#" class="chat"></a>
	<div id="wrapper">
		<header id="header">
			<div class="logo"><img src="<?php echo TDU; ?>/images/logo.png" alt="Logo image"></div>
			<div class="info">
				<div class="company">
					<img src="<?php echo TDU; ?>/images/phone.png" alt="Phone">
					<span><?php bloginfo('name'); ?></span>
					<span class="green"><?php echo (string) get_option( 'gc_gs_phone' ); ?></span>
				</div>
				<div class="languages">
					<ul class="languages">
						<li><a href="#"><i class="cz"></i></a></li>
						<li><a href="#"><i class="ua"></i></a></li>
						<li><a href="#"><i class="ru"></i></a></li>
						<li><a href="#"><i class="pl"></i></a></li>
						<li><a href="#"><i class="uk"></i></a></li>
						<li><a href="#"><i class="de"></i></a></li>
					</ul>
					<a href="<?php echo get_bloginfo('url'); ?>/osobni-preprava/" class="button">Rychlá poptávka</a>
				</div>
			</div>
		</header>
		<div id="main">