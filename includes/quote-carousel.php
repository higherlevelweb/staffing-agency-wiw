<!-- quote-carousel -->
<div id="quote-carousel" class="carousel slide" data-ride="carousel" data-interval="9000">
    <hr />
    <!-- The slideshow -->
    <div class="carousel-inner">
<?php
$args = array(
    'post_type' => 'testimonials'
);
$the_query = new WP_Query( $args ); ?>

<?php if ( $the_query->have_posts() ) : ?>
	<?php $count = 0; ?>
    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
		<?php 
		$testimonial_post = get_post_custom();
		$testimonial_client_name = unserialize($testimonial_post['_testimonial'][0])['client_name'];
		$testimonial_source_name = unserialize($testimonial_post['_testimonial'][0])['source'];
		$testimonial_link_name = unserialize($testimonial_post['_testimonial'][0])['link'];
  		?>
        <div class="carousel-item <?php if ($count == 0) { echo " active"; } ?>">
            <!-- Quote <?php echo $count . " - " . $post->ID ?> -->
            <div class="item">
                <blockquote>
                    <div class="row">
						<p><i class="icofont-quote-left"></i><?php the_content(); ?></p>
                        <span class="credit"><small>- <?php echo $testimonial_client_name; if ($testimonial_source_name!="") { echo " - " . $testimonial_source_name;  } ?></small></span>
                    </div>
					<?php 
					if ($testimonial_link_name!=""){
					?>
					 <span class="credit"><small><a href="<?php echo $testimonial_link_name; ?>"><?php echo $testimonial_link_name; ?></a></small></span>
					<?php
					}
					?>
                </blockquote>
            </div>
        </div>
	<?php $count++; ?>
    <?php endwhile; ?>

    <?php wp_reset_postdata(); ?>

<?php endif; ?>
    </div>
</div>
<!-- /.carousel -->
