<?php
/**
 * Please see single-event.php in this directory for detailed instructions on how to use and modify these templates.
 *
 * Override this template in your own theme by creating a file at:
 *
 *     [your-theme]/tribe-events/month/tooltip.php
 * @version 4.6.21
 */

if ( tec_events_views_v1_should_display_deprecated_notice() ) {
	_deprecated_file( __FILE__, '5.13.0', null, 'On version 6.0.0 this file will be removed. Please refer to <a href="https://evnt.is/v1-removal">https://evnt.is/v1-removal</a> for template customization assistance.' );
}

?>

<script type="text/html" id="tribe_tmpl_tooltip">
	<div id="tribe-events-tooltip-[[=eventId]]" class="tribe-events-tooltip">
		<h4 class="entry-title summary">[[=dateDisplay]]<\/h4>

		<div class="tribe-events-event-body">
			[[ if(shift_status=='closed') { ]]
			<div class="tribe-event-duration">
				<abbr class="tribe-events-abbr tribe-event-date-start">[[=shift_room]] <\/abbr>
			<\/div>
			[[ } ]]
			[[ if(shift_status=='closed') { ]]
				<div class="tribe-event-description">[[=employee_name]]<br />[[=shift_position]]<\/div>
			[[ } else { ]]
				<div class="tribe-event-description">Open Shift<\/div>
			[[ } ]]
			<span class="tribe-events-arrow"><\/span>
		<\/div>
	<\/div>
</script>

<script type="text/html" id="tribe_tmpl_tooltip_featured">
	<div id="tribe-events-tooltip-[[=eventId]]" class="tribe-events-tooltip tribe-event-featured">
		[[ if(imageTooltipSrc.length) { ]]
			<div class="tribe-events-event-thumb">
				<img src="[[=imageTooltipSrc]]" alt="[[=title]]" \/>
			<\/div>
		[[ } ]]

		<h3 class="entry-title summary">[[=raw title]]<\/h3>

		<div class="tribe-events-event-body">
			<div class="tribe-event-duration">
				<abbr class="tribe-events-abbr tribe-event-date-start">[[=dateDisplay]] <\/abbr>
			<\/div>

			[[ if(excerpt.length) { ]]
			<div class="tribe-event-description">[[=raw excerpt]]<\/div>
			[[ } ]]
			<span class="tribe-events-arrow"><\/span>
		<\/div>
	<\/div>
</script>
