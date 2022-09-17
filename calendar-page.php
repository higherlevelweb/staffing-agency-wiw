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
                <span class="header-bold">My Calendar</span> - <?php echo $user->display_name ?>
            </h2>
        </div>
        <?php
        if(current_user_can( 'manage_options' )){
        ?>
		<div class="meta-page-right"><a href="/wp-admin/" class="admin-alink"><i class="fa fa-wordpress" aria-hidden="true"></i><?php echo " WordPress Dashbaord"; ?></a> | <a href="/my-profile/" class="admin-alink"><i class="um-faicon-user"></i><?php echo " My  Profile"; ?></a> | <a href="/my-calendar/" class="admin-alink"><i class="fa fa-calendar-check-o" aria-hidden="true"></i><?php echo " Calendar"; ?></a></div>
        <?
        } else {
        ?>
		<div class="meta-page-right admin-alink"><a href="/my-profile/"><i class="um-faicon-user"></i><?php echo " My  Profile"; ?></a></div>
        <?
        }
        ?>
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