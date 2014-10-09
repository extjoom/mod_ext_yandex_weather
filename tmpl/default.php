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
?>

<div class="mod_ext_yandex_weather <?php echo $moduleclass_sfx ?>">
	<div class="mod_ext_yandex_weather_wrap">			
		<?php
		if ($ext_error == '') {
		?>
		
		<?php if ($ext_current_weather > 0) : ?>		
		
		<div class="text-header-weather">Сейчас в <?php echo $xml->fact->station; ?>:</div>
		<table class="table ext_current_weather">
			<tbody>	
				<tr class="ext_yandex_weather_info">					
					
					<?php if ($ext_current_show_img > 0) : ?>						
					<td class="ext_current_weather_image_weather_type">
						<div class="ext_current_weather_img"><img src="<?php echo JUri::root(); ?>/modules/mod_ext_yandex_weather/assets/images/wiz<?php echo $xml->fact->image; ?>.png"></div>						
					</td>
					<?php endif; ?>
					
					<?php if ($ext_current_show_t > 0) : ?>	
					<td class="ext_current_weather_temperature"><?php echo ($xml->fact->temperature > 0 ? '+'.$xml->fact->temperature : $xml->fact->temperature); ?></td>					
					<?php endif; ?>
					
					
					<td class="ext_current_weather_block">
						
						<?php if ($ext_current_show_cloud > 0) : ?>	
						<div class="ext_current_weather_weather_type"><?php echo $xml->fact->weather_type; ?></div>
						<?php endif; ?>
						
						<?php if ($ext_current_show_w > 0) : ?>	
						
						<?php if ( $xml->fact->wind_direction == 'calm' ) { ?>
							<div><span>Ветер:</span> Штиль</div>
						<?php } else {
							
							switch ($xml->fact->wind_direction){
							   case 's':
								 $wind_direction="южный";
								 break;
							   case 'se':
								 $wind_direction="юго-восточный";
								 break;
							   case 'n':
								 $wind_direction="северный";
								 break;
							   case 'ne':
								 $wind_direction="северо-восточный";
								 break;
							   case 'w':
								 $wind_direction="западный";
								 break;
							   case 'e':
								 $wind_direction="восточный";
								 break;
							   case 'sw':
								 $wind_direction="юго-западный";
								 break;
							   case 'nw':
								 $wind_direction="северо-западный";
								 break;
							   case 'calm':
								 $wind_direction="штиль";
								 break;
							}	

						?>
							<div><span>Ветер:</span> <?php echo $wind_direction; ?>, <?php echo $xml->fact->wind_speed.' м/с'; ?></div>
						<?php } ?>
						
						<?php endif; ?>
						
						<?php if ($ext_current_show_p > 0) : ?>	
						<div><span>Давление:</span> <?php echo $xml->fact->pressure; ?> мм рт. ст.</div>
						<?php endif; ?>
						
						<?php if ($ext_current_show_h > 0) : ?>	
						<div><span>Влажность:</span> <?php echo $xml->fact->humidity; ?>%</div>		
						<?php endif; ?>
						
					</td>					
				</tr>
			</tbody>
		</table>
		
		<?php endif; ?>
		
		<?php if ($ext_weather > 0) : ?>	
		<table class="table ">
			<tbody>	
					<tr class="ext_yandex_weather_info">
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						
						<?php if ($ext_show_img > 0) : ?>	
						<td>&nbsp;</td>
						<?php endif; ?>
						
						<?php if ($ext_show_cloud > 0) : ?>	
						<td>&nbsp;</td>
						<?php endif; ?>
						
						<?php if ($ext_show_p > 0) : ?>	
						<td>
							<div>Давление,</div>
							<div>мм рт. ст.</div>
						</td>
						<?php endif; ?>
						
						<?php if ($ext_show_h > 0) : ?>	
						<td>
							<div>Влажность</div>
						</td>
						<?php endif; ?>
						<?php if ($ext_show_w > 0) : ?>	
						<td>
							<div>Ветер,</div>
							<div>м/с</div>
						</td>	
						<?php endif; ?>
					</tr>
			<?php foreach ($out as $key => $value) { ?>			
				<?php foreach ($value['weather'] as $key1 => $value1) { ?>
					
					<?php if ($key1 == 0 AND $key != 0): ?>
					<tr class="ext_tr_clear">
						<td>&nbsp;</td>
					</tr>
					<?php endif; ?>
					<tr>						
						
						<td class="ext_td_day_of_week">
							<?php if ($key1 == 0): ?>
								<?php echo $value['day_of_week_min']; ?>
							<?php endif; ?>
						</td>
						
						<td class="ext_td_day_and_month">
							<?php if ($key1 == 0): ?>
								<?php //echo $value['year']; ?>
								<div class="ext_day"><?php echo $value['day']; ?></div>
								<div class="ext_month">
									<?php 
										switch ($value['month']) {
												case "1":
													echo "Январь";
													break;
												case "2":
													echo "Февраль";
													break;
												case "3":
													echo "Март";
													break;
												 case "4":
													echo "Апрель";
													break;
												 case "5":
													echo "Май";
													break;
												 case "6":
													echo "Июнь";
													break;
												 case "7":
													echo "Июль";
													break;
												 case "8":
													echo "Август";
													break;
												 case "9":
													echo "Сентябрь";
													break;
												 case "10":
													echo "Октябрь";
													break;
												 case "11":
													echo "Ноябрь";
													break;
												 case "12":
													echo "Декабрь";
													break;
											}								
									?>
								</div>
							<?php endif; ?>
						</td>
					
						<td>
							<div class="ext_time_of_day">
								<?php echo $value1['time_of_day']; ?>					
							</div>							
							<div class="ext_temperature">
								<?php 
								if ($value1['temp_from'] == '' OR $value1['temp_to'] == '') { 
									echo $value1['temp_avg'] ; 
									} else { 
										echo $value1['temp_from'].'...'.$value1['temp_to']; 
										} 
								?>
							</div>
						</td>	
							
						<?php if ($ext_show_img > 0) : ?>	
						<td class="ext_img">
							<img src="<?php echo JUri::root(); ?>/modules/mod_ext_yandex_weather/assets/images/wiz<?php echo $value1['image']; ?>.png">						
						</td>									
						<?php endif; ?>
						
						<?php if ($ext_show_cloud > 0) : ?>	
						<td class="ext_weather_type">
							<?php echo $value1['weather_type']; ?>
						</td>
						<?php endif; ?>
						
						<?php if ($ext_show_p > 0) : ?>						
						<td class="ext_pressure">
							<?php echo $value1['pressure']; ?>
						</td>
						<?php endif; ?>
						
						<?php if ($ext_show_h > 0) : ?>	
						<td class="ext_humidity">
							<?php echo $value1['humidity'].'%'; ?>
						</td>
						<?php endif; ?>
						
						<?php if ($ext_show_w > 0) : ?>	
						<td class="ext_wind">							
							<?php if ( $value1['wind_direction'] == 'calm') {?>
								<div>Штиль</div>
							<?php } else { ?>							
								<div class="ext_wind_direction"><img src="<?php echo JUri::root(); ?>/modules/mod_ext_yandex_weather/assets/images/wind/<?php echo $value1['wind_direction']; ?>.gif"></div>
								<div class="ext_wind_speed"><?php echo $value1['wind_speed']; ?></div>
							<?php } ?>
						</td>						
						<?php endif; ?>					
						
					</tr>					
				<?php } ?>			
			<?php } ?>					
			</tbody>
		</table>
		<?php endif; ?>
		
		<?php	
		} else {
			echo '<p style="color:red;">'.$ext_error.'</p>';
		}
		?>	
    </div>
	<div style="clear:both;"></div>
</div>
