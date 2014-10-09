<?php
/*
# ------------------------------------------------------------------------
# Extensions for Joomla 2.5.x - Joomla 3.x
# ------------------------------------------------------------------------
# Copyright (C) 2011-2015 Ext-Joom.com. All Rights Reserved.
# @license - PHP files are GNU/GPL V2.
# Author: Ext-Joom.com
# Websites:  http://www.ext-joom.com 
# Date modified: 02/10/2014 - 13:00
# ------------------------------------------------------------------------
*/

// no direct access
defined('_JEXEC') or die;


class modExtYandexWeatherHelper
{

	public static function getWeather ($xml, $count_day = 10, $day_of_the_week_array, $day_of_the_week_array_min, $time_of_day) 
	{  
		$out = array();
		$counter = 0 ;
		
		foreach ( $xml->day as $day )  {

			if ($counter == $count_day) {
				break;
			}

			   $get_date = explode ("-" , $day['date']) ;
			   $day_of_week = date("N", mktime(0, 0, 0, $get_date[1], $get_date[2], $get_date[0])) ;

			   $out[$counter]['day'] = $get_date[2] ;
			   $out[$counter]['month'] = $get_date[1] ;			   
			   $out[$counter]['year'] = $get_date[0] ;
			   $out[$counter]['day_of_week'] = $day_of_the_week_array[$day_of_week] ;
			   $out[$counter]['day_of_week_min'] = $day_of_the_week_array_min[$day_of_week] ;				   
			   


			 for ($i=0;$i<=3;$i++) {

				
				$get_temp_from = $day->day_part[$i]->{'temperature-data'}->from;
				$get_temp_to = $day->day_part[$i]->{'temperature-data'}->to;
				$get_temp_avg = $day->day_part[$i]->{'temperature-data'}->avg;

				if( $get_temp_from > 0 ) $get_temp_from = '+'.$get_temp_from; 
				if( $get_temp_to > 0 ) $get_temp_to = '+'.$get_temp_to; 
				if( $get_temp_avg > 0 ) $get_temp_avg = '+'.$get_temp_avg; 
				
				$out[$counter]['weather'][$i]['temp_from'] = $get_temp_from;
				$out[$counter]['weather'][$i]['temp_to'] = $get_temp_to;
				$out[$counter]['weather'][$i]['temp_avg'] = $get_temp_avg;
				
				
				$out[$counter]['weather'][$i]['image'] = $day->day_part[$i]->image;
				$out[$counter]['weather'][$i]['imagev2'] = $day->day_part[$i]->{'image-v2'};
				$out[$counter]['weather'][$i]['imagev3'] = $day->day_part[$i]->{'image-v3'};
						
				$out[$counter]['weather'][$i]['time_of_day'] = $time_of_day[$i] ;			
				$out[$counter]['weather'][$i]['weather_type'] = $day->day_part[$i]->weather_type;			
				$out[$counter]['weather'][$i]['wind_direction'] = $day->day_part[$i]->wind_direction;
				$out[$counter]['weather'][$i]['wind_speed'] = $day->day_part[$i]->wind_speed;
				$out[$counter]['weather'][$i]['humidity'] = $day->day_part[$i]->humidity;
				$out[$counter]['weather'][$i]['pressure'] = $day->day_part[$i]->pressure;					


			}
			
			$counter++ ;
		}

		return $out ;
	}

}