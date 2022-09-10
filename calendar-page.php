<?php
/* Template Name: Calendar Page */
/* The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * 
 * @package staffing-agency-wiw
 */
if(!is_user_logged_in()) {
    wp_redirect( wp_login_url() );
}
get_header();
$user = wp_get_current_user();
?>
<div id="meta-page">
    <div class="container">
        <div class="meta-page-left">
            <h2>
                My Calendar
            </h2>
        </div>
		<div class="meta-page-right"><?php echo $user->display_name ?></div>
    </div>
</div>
		
<main id="primary" class="site-main">

    <?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

		endwhile; // End of the loop.
		?>

</main><!-- #main -->
</div>

</main><!-- #main -->

<?php
get_footer();