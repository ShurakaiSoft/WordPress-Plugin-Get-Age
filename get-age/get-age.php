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
 * 
 * @param unknown $interval
 * @return string formatted result.
 */
function sjp_ga_format($interval) {
	$year = $interval->format("%Y");
	if ($year >= 2) {
		return $year . ' years';
	}
	$month = $interval->format("%m");
	if ($year == 1) {
		$month += 12;
	}
	if ($month >= 2) {
		return $month . ' months';
	}
	$day = $interval->format("%d");
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


/**
 * callback for shortcode "get-age".
 *  
 * @param unknown $atts
 * @return string
 */
function sjp_ga_get_age($atts) {
	extract( shortcode_atts( array(
	'year' => '2000',
	'month' => '1',
	'day' => '1',
	), $atts ) );
	$interval = date_diff(new DateTime(), new DateTime($year . '-' . $month . '-' . $day));
	
	return sjp_ga_format($interval);	
}

add_shortcode( 'get-age', 'sjp_ga_get_age' );