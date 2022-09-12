<?php
/**
 * staffing-agency-wiw functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package staffing-agency-wiw
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/* staffing-agency-wiw scripts (CSS and navigation JavaScript) */
function staffing_agency_wiw_scripts() {
    wp_enqueue_style( 'staffing-agency-wiw-bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css',false,'1.1','all');
    wp_enqueue_style( 'staffing-agency-wiw-slider', get_template_directory_uri() . '/css/slider.css',false,'1.1','all');
	wp_enqueue_style( 'staffing-agency-wiw-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_style( 'staffing-agency-wiw-icofont', get_template_directory_uri() . '/assets/icofont/icofont.min.css',false,'1.1','all');
    wp_enqueue_script( 'staffing-agency-wiw-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array(), _S_VERSION, true );
    wp_enqueue_script( 'staffing-agency-wiw-popper', get_template_directory_uri() . '/js/popper.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'staffing-agency-wiw-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
    wp_enqueue_script( 'staffing-agency-wiw-main', get_template_directory_uri() . '/js/main.js', array(), _S_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'staffing_agency_wiw_scripts' );

// Add theme support for menus.
add_theme_support( 'menus' );

// This theme uses wp_nav_menu() in one location.
register_nav_menus(
	array(
		'menu-1' => esc_html__( 'Primary', 'staffing-agency-wptheme-wiw' ),
        'client-menu' => esc_html__( 'Client', 'staffing-agency-wptheme-wiw' )
	)
);

/*
add_filter('wp_nav_menu_items','add_new_menu_item', 10, 2);
function add_new_menu_item( $nav, $args ) {
    if( $args->theme_location == 'menu-1' )
    $newmenuitem = "<li id='nav-menu-logo'><img src='" . get_template_directory_uri() . "/images/ecs-logo.png'/></li>";
    $nav = $newmenuitem.$nav;
    return $nav;
}
*/

function my_hooked_function( $arg ) {
    echo "I don't talk to strangers";

    if (
        tribe_is_event() || 
        tribe_is_event_category() || 
        tribe_is_in_main_loop() || 
        tribe_is_view() || 
        'tribe_events' == get_post_type() || 
        is_singular( 'tribe_events' )
    ) {

            $url = wp_login_url();
              // Redirect!
              wp_safe_redirect( $url );
              exit;

}
add_action( 'init', 'my_hooked_function' );

}

/** 
 * Generate Custom breadcrumbs 
**/  
function get_breadcrumb() {
    echo '<a href="'.home_url().'" rel="nofollow">Home</a>';
    if (is_category() || is_single()) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
        the_category(' &bull; ');
            if (is_single()) {
                echo " &nbsp;&nbsp;&#187;&nbsp;&nbsp; ";
                the_title('');
            }
    } elseif (is_page()) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
        echo the_title('');
    } elseif (is_search()) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;Search Results for... ";
        echo '"<em>';
        echo the_search_query();
        echo '</em>"';
    }
}

/*
 * Functions for testimonials custom post types
*/
add_action( 'init', 'testimonials_post_type' );
function testimonials_post_type() {
    $labels = array(
        'name' => 'Testimonials',
        'singular_name' => 'Testimonial',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Testimonial',
        'edit_item' => 'Edit Testimonial',
        'new_item' => 'New Testimonial',
        'view_item' => 'View Testimonial',
        'search_items' => 'Search Testimonials',
        'not_found' =>  'No Testimonials found',
        'not_found_in_trash' => 'No Testimonials in the trash',
        'parent_item_colon' => '',
    );
 
    register_post_type( 'testimonials', array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'exclude_from_search' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => 10,
        'supports' => array( 'editor' ),
        'register_meta_box_cb' => 'testimonials_meta_boxes', // Callback function for custom metaboxes
    ) );
}

/*
 * Testimonials custom post types Meta Boxes
*/
function testimonials_meta_boxes() {
    add_meta_box( 'testimonials_form', 'Testimonial Details', 'testimonials_form', 'testimonials', 'normal', 'high' );
}

/*
 * Testimonials custom post types admin form
*/
function testimonials_form() {
    $post_id = get_the_ID();
    $testimonial_data = get_post_meta( $post_id, '_testimonial', true );
    $client_name = ( empty( $testimonial_data['client_name'] ) ) ? '' : $testimonial_data['client_name'];
    $source = ( empty( $testimonial_data['source'] ) ) ? '' : $testimonial_data['source'];
    $link = ( empty( $testimonial_data['link'] ) ) ? '' : $testimonial_data['link'];
 
    wp_nonce_field( 'testimonials', 'testimonials' );
    ?>
<p>
    <label>Client's Names (optional)</label><br />
    <input type="text" value="<?php echo $client_name; ?>" name="testimonial[client_name]" size="40" />
</p>
<p>
    <label>Business/Site Name (optional)</label><br />
    <input type="text" value="<?php echo $source; ?>" name="testimonial[source]" size="40" />
</p>
<p>
    <label>Link (optional)</label><br />
    <input type="text" value="<?php echo $link; ?>" name="testimonial[link]" size="40" />
</p>
<?php
}

/*
 * Save testimonials custom post types
*/
add_action( 'save_post', 'testimonials_save_post' );
function testimonials_save_post( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return;
 
    if ( ! empty( $_POST['testimonials'] ) && ! wp_verify_nonce( $_POST['testimonials'], 'testimonials' ) )
        return;
 
    if ( ! empty( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
        if ( ! current_user_can( 'edit_page', $post_id ) )
            return;
    } else {
        if ( ! current_user_can( 'edit_post', $post_id ) )
            return;
    }
 
    if ( ! wp_is_post_revision( $post_id ) && 'testimonials' == get_post_type( $post_id ) ) {
        remove_action( 'save_post', 'testimonials_save_post' );
 
        wp_update_post( array(
            'ID' => $post_id,
            'post_title' => 'Testimonial - ' . $post_id
        ) );
 
        add_action( 'save_post', 'testimonials_save_post' );
    }
 
    if ( ! empty( $_POST['testimonial'] ) ) {
        $testimonial_data['client_name'] = ( empty( $_POST['testimonial']['client_name'] ) ) ? '' : sanitize_text_field( $_POST['testimonial']['client_name'] );
        $testimonial_data['source'] = ( empty( $_POST['testimonial']['source'] ) ) ? '' : sanitize_text_field( $_POST['testimonial']['source'] );
        $testimonial_data['link'] = ( empty( $_POST['testimonial']['link'] ) ) ? '' : esc_url( $_POST['testimonial']['link'] );
 
        update_post_meta( $post_id, '_testimonial', $testimonial_data );
    } else {
        delete_post_meta( $post_id, '_testimonial' );
    }
}

/*
 * Manage testimonials custom post types
*/
add_filter( 'manage_edit-testimonials_columns', 'testimonials_edit_columns' );
function testimonials_edit_columns( $columns ) {
    $columns = array(
        'cb' => '<input type="checkbox" />',
        'title' => 'Title',
        'testimonial' => 'Testimonial',
        'testimonial-client-name' => 'Client Name',
        'testimonial-source' => 'Business/Site',
        'testimonial-link' => 'Link',
        'author' => 'Posted by',
        'date' => 'Date'
    );
 
    return $columns;
}

/*
 * Save testimonials custom post types columns
*/
add_action( 'manage_posts_custom_column', 'testimonials_columns', 10, 2 );
function testimonials_columns( $column, $post_id ) {
    $testimonial_data = get_post_meta( $post_id, '_testimonial', true );
    switch ( $column ) {
        case 'testimonial':
            the_excerpt();
            break;
        case 'testimonial-client-name':
            if ( ! empty( $testimonial_data['client_name'] ) )
                echo $testimonial_data['client_name'];
            break;
        case 'testimonial-source':
            if ( ! empty( $testimonial_data['source'] ) )
                echo $testimonial_data['source'];
            break;
        case 'testimonial-link':
            if ( ! empty( $testimonial_data['link'] ) )
                echo $testimonial_data['link'];
            break;
    }
}

/*
 * Contact 7 Form Validation Filter to ensure End Date comes after Start Data and that shift is minimum 3 hours if on same day
*/
add_filter( 'wpcf7_validate_date*', 'custom_date_confirmation_validation_filter', 20, 2 );
function custom_date_confirmation_validation_filter( $result, $tag ) {
    $start = strtotime($_POST['ShiftStartDate'] . " " . $_POST['shift-start-time']);
    $end = strtotime($_POST['ShiftEndDate'] . " " . $_POST['shift-end-time']);
    $minutes = (strtotime($_POST['shift-end-time']) - strtotime($_POST['shift-start-time'])) / 60;
    if ( $start > $end ) {
        $msg = "The shift end date must come after the shift start date.";
        $result->invalidate( $tag, $msg);
    } else if (strtotime($_POST['ShiftStartDate']) == strtotime($_POST['ShiftEndDate'])){
        if($minutes <= 179){
            $msg = "Shift must be at least 3 hours.";
            $result->invalidate( $tag, $msg);
        }
    }
    return $result;
}

//Get current user
function get_user_by_meta_data( $meta_key, $meta_value ) {

	// Query for users based on the meta data
	$user_query = new WP_User_Query(
		array(
			'meta_key'	  =>	$meta_key,
			'meta_value'	=>	$meta_value
		)
	);

	// Get the results from the query, returning the first user
	$users = $user_query->get_results();
	return $users[0];
} 

// Filter The Evnets Calerndar Events to only show by specific category for specific client pages based on client account number	
add_action( 'pre_get_posts', 'tribe_exclude_events_categories_all_views' );
function tribe_exclude_events_categories_all_views( $query ) { 
	if ( !current_user_can('edit_pages') && $query->query_vars['post_type'] == Tribe__Events__Main::POSTTYPE && isset( $query->query_vars['eventDisplay'] ) && ! is_singular( 'tribe_events' ) && ! is_tax( Tribe__Events__Main::TAXONOMY ) ) {
		{
			$user_id = get_current_user_id();
  		    $key = 'client_account_number';
  		    $single = true;
  		    $client_sid = "cid_".get_user_meta( $user_id, $key, $single ); 
			
			$query->set( 'tax_query', array(
				array(
					'taxonomy' => Tribe__Events__Main::TAXONOMY,
					'field'    => 'slug',
					'terms' => array($client_sid),
					'operator' => 'IN'
				)
			) );
		}
	}
	return $query;
}

//Change the "There were no results found" text on TEC.
add_filter( 'tribe_the_notices', 'change_notice', 10, 2 );

function change_notice( $html ) {
	if ( stristr( $html, 'There were no results found.' ) ) {
		//Replace 'Your custom message' with the text you want.  	
		$html = str_replace( 'There were no results found.', 'Your custom message', $html );
	}
	return $html;
}

/*
// add custom javscript if it is an events calendar page
function the_events_calendar_javascript() {
    if ( tribe_is_event_query() ) {
    ?>
        <script>
          // your javscript code goes here
          alert("Do action!");
        </script>
    <?php
     }
}
add_action('wp_footer', 'the_events_calendar_javascript');
*/

/*
 * Use this function to throw website into maintainence mode
 * COMMENT THIS SECTION OUT TO TAKE THE SITE BACK OUT OF MAINTAINTENCE MODE
 * This code only gives access to the site for those logged in, and with proper access rights.
function wp_maintenance_mode() {
    if (!current_user_can('edit_themes') || !is_user_logged_in()) {
    wp_die('<h2>Undergoing Maintenance</h2><br />Our website currently undergoing under planned maintenance. Sorry for any inconvience, please check back later.');
    }
    }
    add_action('get_header', 'wp_maintenance_mode');
 */ 
