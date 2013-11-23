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

/* Copyright 2013 Stephen Parker (shurakaisoft@gmail.com)
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public Licence as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
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
	 * The callback for the shortcode to calculate age.
	 * 
	 * @param unknown $atts shortcode attributes
	 * @return string formatted age result
	 */
	public static function calculate_age( $atts ) {
		// parse and validate input
		extract( shortcode_atts( array(
			'year' => null,
			'month' => null,
			'day' => null,
		), $atts ) );
 		$errors = '';
 		if ( $year == null ) {
 			$errors .= ' ERROR: no year value. ';
 		}
 		if ( $month == null ) {
 			$errors .= ' ERROR: no month value. ';
 		}
		if ( $day == null ) {
			$errors .= ' ERROR: no day value. ';
		}
		if ( "" !== $errors ) {
			return $errors;
		} 
		
		// calculate age		
		$age_interval = date_diff( new DateTime(), new DateTime( "{$year}-{$month}-{$day}" ) );
		
		// format and return result
		return SJP_Age::format_age( $age_interval );
	}

	
	/**
	 * Adda an appropriate time unit of measurment to the given 'age interval'. It
	 * uses some fuzzy logic that selects the appropriate unit (from 'days',
	 * 'weeks', 'months' or 'years') to measure time.
	 * 
	 * @param DateInterval $age_interval time difference.
	 * @return string formatted age result
	 */
	private static function format_age( $age_interval ) {
		$year = $age_interval->format( '%Y' );
		if ( $year >= 2 ) {
			return $year . ' years';
		}
		$month = $age_interval->format( '%m' );
		if ( $year == 1 ) {
			$month += 12;
		}
		if ( $month >= 2 ) {
			return $month . ' months';
		}
		$day = $age_interval->format( '%d' );
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

}