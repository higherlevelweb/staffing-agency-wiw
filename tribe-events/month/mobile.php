<?php
/**
 * Please see single-event.php in this directory for detailed instructions on how to use and modify these templates.
 *
 * Override this template in your own theme by creating a file at:
 *
 *     [your-theme]/tribe-events/month/mobile.php
 *
 * @version  4.7.1
 */

if ( tec_events_views_v1_should_display_deprecated_notice() ) {
	_deprecated_file( __FILE__, '5.13.0', null, 'On version 6.0.0 this file will be removed. Please refer to <a href="https://evnt.is/v1-removal">https://evnt.is/v1-removal</a> for template customization assistance.' );
}

?>

<script type="text/html" id="tribe_tmpl_month_mobile_day_header">
	<div class="tribe-mobile-day" data-day="[[=date]]">[[ if(has_events) { ]]
		<h3 class="tribe-mobile-day-heading">[[=i18n.for_date]] <span>[[=raw date_name]]<\/span><\/h3>[[ } ]]
	<\/div>
</script>

<script type="text/html" id="tribe_tmpl_month_mobile">
	<div class="tribe-events-mobile tribe-clearfix tribe-events-mobile-event-[[=eventId]][[ if(categoryClasses.length) { ]] [[= categoryClasses]][[ } ]]">
		<h4 class="summary">
			<a class="url" href="[[=permalink]]" title="[[=title]]" rel="bookmark">[[=dateDisplay]]<\/a>
		<\/h4>

		<div class="tribe-events-event-body">
			<div class="tribe-events-event-schedule-details">
				<span class="tribe-event-date-start">[[=shift_room]] <\/span>
			<\/div>
			<div class="tribe-event-description">[[=employee_name]]<br />[[=shift_position]]<\/div>
			<a href="[[=permalink]]" class="tribe-events-read-more" rel="bookmark">More details >><\/a>
		<\/div>
	<\/div>
</script>
