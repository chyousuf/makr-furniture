<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage Gavco
 */

get_header(); ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header mt-5 mb-5" style="text-align: center;">
					<h1 class="page-title" style="color:#676767;font-weight: 600;"><?php _e( 'Oops! That page can&rsquo;t be found.', 'twentyseventeen' ); ?></h1>
					<a href="<?php echo get_home_url(); ?>" class="btn btn-primary mt-3">Back to Home</a>
				</header>
			</section>
		</main>
	</div>
</div>

<?php get_footer();
