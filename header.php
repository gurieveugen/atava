<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php wp_title( ' ', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); 
		wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div id="wrapper">
		<?php
		$chat = new Chat();
		echo $chat->getHTML();
		?>
		<div class="toolpanel right">
			<a href="#" class="chat"></a>	
		</div>
		<div class="toolpanel left">
			<ul class="socials">
				<li><a href="<?php echo (string) get_option('gc_ss_facebook'); ?>"><img src="<?php echo TDU; ?>/images/facebook.png" alt="facebook"></a></li>
				<li><a href="<?php echo (string) get_option('gc_ss_odnoklasniki'); ?>"><img src="<?php echo TDU; ?>/images/odnoklasniki.png" alt="onoklasniki"></a></li>
				<li><a href="<?php echo (string) get_option('gc_ss_twitter'); ?>"><img src="<?php echo TDU; ?>/images/twitter.png" alt="twitter"></a></li>
				<li><a href="<?php echo (string) get_option('gc_ss_you_tube'); ?>"><img src="<?php echo TDU; ?>/images/youtube.png" alt="youtube"></a></li>
				<li><a href="<?php echo (string) get_option('gc_ss_google_plus'); ?>"><img src="<?php echo TDU; ?>/images/google_plus.png" alt="google_plus"></a></li>
			</ul>
		</div>
		<header id="header">
			<div class="logo"><img src="<?php echo TDU; ?>/images/atava_logggo.png" alt="Logo image" width="200"></div>
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
			<nav>
				<?php
					wp_nav_menu( 
						array( 
							'theme_location' => 'primary', 
							'container'      => false 
						) 
					);
				?>
			</nav>
		</header>
		<div id="main">