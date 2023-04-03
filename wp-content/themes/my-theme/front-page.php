<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package My_Theme
 */

get_header();
?>

	<main id="primary" class="site-main">
<div class="container">

	<?php
		while ( have_posts() ) :
			the_post();

			//get_template_part( 'template-parts/content', get_post_type() );

			

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>
		<div class="projects mt-4">
			<h2>Projects</h2>
			<p class="text-muted small">Showing 6 projects for logged in user and 3 projects for guests</p>
			<div class="projects_result"></div>
		</div>
		<div class="quotes mt-4">
			<h2>Quotes</h2>
			<p class="text-muted small">Top 5 Randomnly picked Quotes</p>
			<div class="quotes_result"></div>
		</div>
		<div class="projects mt-4">
		<h2>Coffee</h2>
		<p class="text-muted small">A random coffee image</p>
		<?php
		echo do_shortcode( '[hs_give_me_coffees]' );
		?>
		</div>
</div>

	</main><!-- #main -->

<?php
// get_sidebar();
get_footer();