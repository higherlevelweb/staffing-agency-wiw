<?php
/* Template Name: Admin Page */
/* The template for displaying all site admin pages
 *
 * This is the template that displays all pages by default.
 * 
 * @package staffing-agency-wiw
 */

get_header();
?>
<div id="meta-page">
    <div class="meta-page-right"><?php get_breadcrumb(); ?></div>
    <div class="meta-page-left"><h2><? wp_title('') ?></h2></div>
</div>
<main id="primary" class="site-main">

    <?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

		endwhile; // End of the loop.
		?>

</main><!-- #main -->

<?php
get_footer();