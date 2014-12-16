<?php
/**
 * Template name: Osobni preprava
 */
get_header(); 
the_post();
?>
<div class="page-content">
	<span class="page-title">Atava Travel ~ O nás</span>
	<h2><?php the_title(); ?></h2>
	<div class="osobni-preprava">
		<?php the_content(); ?>	
	</div>
</div>
<?php get_footer(); ?>
