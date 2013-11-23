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
 * Register the 'get_age' shortcode with WordPress.
 */
add_shortcode( 'get_age',  function ( $atts ) {
	return SJP_Age::calculate_age( $atts );
} );


/**
 * A static namespace for the WordPress shortcode 'get_age'.
 * 
 * @author Stephen Parker
 *
 */
class SJP_Age {
	
	/**
	 * Adda an appropriate time unit of measurment to the given 'age interval'. It
	 * uses some fuzzy logic that selects the appropriate unit (from 'days',
	 * 'weeks', 'months' or 'years') to measure time.
	 * 
	 * @param unknown $interval
	 * @return string
	 */
	private static function format_age( $age_interval ) {
		$year = $age_interval->format( "%Y" );
		if ( $year >= 2 ) {
			return $year . ' years';
		}
		$month = $age_interval->format( "%m" );
		if ( $year == 1 ) {
			$month += 12;
		}
		if ( $month >= 2 ) {
			return $month . ' months';
		}
		$day = $age_interval->format( "%d" );
		if ( $month == 1 && $day <= 6 ) {
			return '1 month';
		}
		$day = $age_interval->days;
		if ( $day >= 14 ) {
			return floor( $day / 7 ) . ' weeks';
		}
		if ( $day == 7 ) {
			return '1 week';
		}
		if ( $day >= 2 ) {
			return $day . ' days';
		}
		return '1 day';
	}

	/**
	 * The callback for the shortcode to calculate age.
	 * 
	 * @param unknown $atts
	 * @return string
	 */
	public static function calculate_age( $atts ) {
		// parse and validate input
		extract( shortcode_atts( array(
			'year' => null,
			'month' => null,
			'day' => null,
		), $atts ) );
		if ( $year == null ) {
			return "error: no year value";
		}
		if ( $month == null ) {
			return "error: no month value";
		}
		if ( $day == null ) {
			return "error: no year day.";
		}
		
		// calculate age		
		$age_interval = date_diff( new DateTime(), new DateTime( $year . '-' . $month . '-' . $day ) );
		
		// format and return result
		return SJP_Age::format_age( $age_interval );
	}
	
}