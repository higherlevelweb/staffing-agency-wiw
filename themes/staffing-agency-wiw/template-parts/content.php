<?php
/**
 * Template part for displaying posts
 *
 * @package staffing-agency-wiw
 */

?>
<div id="page-content">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <div class="entry-content">
            <?php
	the_content(
		sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'staffing-agency-wiw' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			wp_kses_post( get_the_title() )
		)
	);

	wp_link_pages(
		array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'staffing-agency-wiw' ),
			'after'  => '</div>',
		)
	);
	?>
        </div><!-- .entry-content -->

    </article><!-- #post-<?php the_ID(); ?> -->
</div>