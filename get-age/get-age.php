<?php
/*
Plugin Name: get-age
Plugin URI: http://yp.id.au/coder/
Description: Adds a shortcode to calculate age.
Version: 1.0
Author: Stephen Parker
Author URI: http://yp.id.au/coder/
License: GPLv2 or later
*/


/**
 * helper function to get date from short code parameters
 * @param unknown $atts
 */
function sjp_ga_getInterval($atts) {
	extract( shortcode_atts( array(
		'year' => '2000',
		'month' => '1',
		'day' => '1',
	), $atts ) );
	return date_diff(new DateTime(), new DateTime($year . '-' . $month . '-' . $day));
}

function sjp_ga_get_age($atts) {
	
	$interval = sjp_ga_getInterval($atts);
	$year = $interval->format("%Y");
	$month = $interval->format("%m");
	$day = $interval->format("%d");

	if ($year >= 2) {
		return $year . ' years';
	}
	if ($year == 1) {
		$month += 12;
	}
	if ($month >= 2) {
		return $month . ' months';
	}
	if ($month == 1 && $day <= 6) {
		return '1 month';
	}
	$day = $interval->days;
	if ($day >= 14) {
		return floor($day / 7) . ' weeks';
	}
	if ($day == 7) {
		return '1 week';
	}
	if ($day >= 2) {
		return $day . ' days';
	}
	return '1 day';
}

add_shortcode( 'get_age', 'sjp_ga_get_age' );