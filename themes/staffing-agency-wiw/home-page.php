<?php
/* Template Name: Home Page */
/* The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * 
 * @package staffing-agency-wiw
 */

get_header();
?>

<?php include get_template_directory() . '/includes/carousel.php'; ?>

<div class="jumbotron">
    <div class="container">
        <h2>
            <p>Great supply teachers available in Toronto</p>
        </h2>
        <p class="lead">Why do child care centres rely on Educare for their supply staffing needs? Just take a look at
            some testimonials in the green box below! Our expertise in child care staffing and our database of qualified
            teachers enables us to efficiently fulfill YOUR staffing needs, too.<strong> You can register with us if
                your child care centre is in Toronto.</strong></p>
        <p class="btn-highlight"><a href="/registration">Register Now</a></p>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-6 main-h3-link main-page-content"><a href="/registration">
                <h3>Having trouble finding qualified supply teachers quickly?</h3>
            </a>
            <ul>
                <li>
                    We can help you quickly cover shifts when your teachers are not available for any period of time
                    from three hours to many months.
                </li>
                <li>
                    Educare supply teachers undergo rigorous screening and evaluation before being hired and they meet
                    or exceed Child Care and Early Years Act requirements.
                </li>
            </ul>
            <a href="/careers">
                <h3 class="main-sub-h3-link">Become a Supply Teacher</h3>
            </a>
            <ul>
                <li>
                    Looking for a career in child care?
                </li>
                <li>
                    Looking for flexible working hours?
                </li>
            </ul>
            <p>
                We place and support supply teachers. We love helping early childhood professionals enjoy their
                experience of working in child care centres. Find out how you can <a
                    href="http://educarestaffing.com/careers">join our team</a>&nbsp;as a supply teacher!
            </p>
        </div>
        <div class="col-lg-6 main-img"> <img class="img-fluid rounded home-main"
                src="http://educarestaffing.com/wp-content/uploads/2022/03/educare-staffing-school.png" alt=""> </div>
    </div>
</div>

<?php include get_template_directory() . '/includes/quote-carousel.php'; ?>

<div class="container">
    <div class="row mb-4">
        <div class="col-md-7">
            <p class="main-call-to-action">
                If you would like to have the current rates of our services, simply click on the Request Current Rates
                button and submit the completed form.
            </p>
        </div>
        <div class="col-md-5"> <a class="btn btn-lg btn-secondary btn-block" href="/request-current-rates">Request
                Current Rates</a> </div>
    </div>
</div>

<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

		endwhile; // End of the loop.
		?>

</main><!-- #main -->

<?php
get_footer();