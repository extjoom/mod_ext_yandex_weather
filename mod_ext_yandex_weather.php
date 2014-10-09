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
error_reporting(E_ALL & ~E_NOTICE);

require_once __DIR__ . '/helper.php';

$document 					= JFactory::getDocument();
$document->addStyleSheet(JURI::base() . 'modules/mod_ext_yandex_weather/assets/css/default.css');
$moduleclass_sfx			= $params->get('moduleclass_sfx');


$cityID						= (int)$params->get('cityid', 27612);

$ext_current_weather		= (int)$params->get('ext_current_weather', 1);
$ext_current_show_t			= (int)$params->get('ext_current_show_t', 1);
$ext_current_show_img		= (int)$params->get('ext_current_show_img', 1);
$ext_current_show_cloud		= (int)$params->get('ext_current_show_cloud', 1);
$ext_current_show_w			= (int)$params->get('ext_current_show_w', 1);
$ext_current_show_h			= (int)$params->get('ext_current_show_h', 1);
$ext_current_show_p			= (int)$params->get('ext_current_show_p', 1);

$ext_weather				= (int)$params->get('ext_weather', 1);
$count_day					= (int)$params->get('count_day', 3);
$ext_show_img				= (int)$params->get('ext_show_img', 1);
$ext_show_cloud				= (int)$params->get('ext_show_cloud', 1);
$ext_show_w					= (int)$params->get('ext_show_w', 1);
$ext_show_h					= (int)$params->get('ext_show_h', 1);
$ext_show_p					= (int)$params->get('ext_show_p', 1);









$day_of_the_week_array = array(
	1 => 'Понедельник',
	2 => 'Вторник',
	3 => 'Среда',
	4 => 'Четверг',
	5 => 'Пятница',
	6 => 'Суббота',
	7 => 'Воскресенье'
	); 
	
$day_of_the_week_array_min = array(
	1 => 'Пн', 
	2 => 'Вт',
	3 => 'Ср',
	4 => 'Чт',
	5 => 'Пт',
	6 => 'Сб',
	7 => 'Вс'
	); 

$time_of_day = array(
	0 => 'утро',
	1 => 'день',
	2 => 'вечер',
	3 => 'ночь'
	);	
	

// data export
$path='http://export.yandex.ru/weather-ng/forecasts/'.$cityID.'.xml';

$file_headers = @get_headers($path);
if(strpos($file_headers[0],'200 OK')>0){
	$xml = simplexml_load_file($path);
	$ext_error 	= '';	
	$out = modExtYandexWeatherHelper::getWeather($xml, $count_day, $day_of_the_week_array, $day_of_the_week_array_min, $time_of_day);
	//var_dump($xml);
} else {
	//exit('Failed to open '.$path);
	$ext_error = 'Failed to open '.$path;
	}	

require JModuleHelper::getLayoutPath('mod_ext_yandex_weather', $params->get('layout', 'default'));
?>