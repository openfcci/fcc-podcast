<?php
/**
 * Custom Podcast Page
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

				<?php load_template( FCCPOD__PLUGIN_PATH . 'includes/templates/radio-podcasts.php' ); ?><!--podcasts-->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
