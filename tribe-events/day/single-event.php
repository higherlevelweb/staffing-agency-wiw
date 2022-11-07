<?php
/**
 * Day View Single Event
 * This file contains one event in the day view
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/day/single-event.php
 *
 * @version 4.6.19
 *
 */

if ( tec_events_views_v1_should_display_deprecated_notice() ) {
	_deprecated_file( __FILE__, '5.13.0', null, 'On version 6.0.0 this file will be removed. Please refer to <a href="https://evnt.is/v1-removal">https://evnt.is/v1-removal</a> for template customization assistance.' );
}

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$venue_details = tribe_get_venue_details();

// Venue microformats
$has_venue         = ( $venue_details ) ? ' vcard' : '';
$has_venue_address = ( ! empty( $venue_details['address'] ) ) ? ' location' : '';

// The address string via tribe_get_venue_details will often be populated even when there's
// no address, so let's get the address string on its own for a couple of checks below.
$venue_address = tribe_get_address();

//Get post data
global $post;

//Send Additonal Meta Data into tooltip
$shift_meta_shift_id = get_post_meta( $post->ID, 'Shift ID' );
$shift_meta_employee_name = get_post_meta( $post->ID, 'Employee Name' );
$shift_meta_position = get_post_meta( $post->ID, 'Shift Position' );
$shift_meta_shift_room = get_post_meta( $post->ID, 'Shift Room' );
$shift_meta_shift_status = get_post_meta( $post->ID, 'Shift Status' );

$additional_data = array();
$additional_data['shift_id'] = $shift_meta_shift_id[0];
$additional_data['employee_name'] = $shift_meta_employee_name[0];
$additional_data['shift_position'] = $shift_meta_position[0];
$additional_data['shift_room'] = $shift_meta_shift_room[0];
$additional_data['shift_status'] = $shift_meta_shift_status[0];

?>

<!-- Event Title -->
<div class="tribe-events-event-meta">
	<div>
		<!-- Schedule & Recurrence Details -->
		<div class="tribe-event-schedule-details">
			<?php echo tribe_events_event_schedule_details() ?>
		</div>

	</div>
</div><!-- .tribe-events-event-meta -->

<? if ($additional_data['shift_status']=="closed") { ?>
<div class="tribe-events-list-event-description tribe-events-content description entry-summary">
	<div class="entry-summary">
			<div> Room: <?php echo $additional_data['shift_room']; ?> </div>
			<div> Employee: <?php echo  $additional_data['employee_name']; ?> </div>
			<div> Position: <?php echo $additional_data['shift_position']; ?> </div>
	</div>
	<a href="<?php echo esc_url( tribe_get_event_link() ); ?>" class="tribe-events-read-more" rel="bookmark"><?php esc_html_e( 'More details', 'the-events-calendar' ) ?> &raquo;</a>
</div><!-- .tribe-events-list-event-description -->
<? } else { ?>
	<div class="tribe-events-list-event-description tribe-events-content description entry-summary">
	<div class="entry-summary">
		<div class="tribe-events-open-alert">Open Shift</div>
	</div>
	<a href="<?php echo esc_url( tribe_get_event_link() ); ?>" class="tribe-events-read-more" rel="bookmark"><?php esc_html_e( 'More details', 'the-events-calendar' ) ?> &raquo;</a>
</div><!-- .tribe-events-list-event-description -->
<? } ?>
<?php
do_action( 'tribe_events_after_the_content' );
