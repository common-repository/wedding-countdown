<?php

/*
Plugin Name: Wedding Countdown Widget
Plugin URI: http://www.yourweddingpro.co.uk
Description: Displays a wedding countdown in your sidebar.
Author: Your Wedding Pro
Version: 1.0
Author URI: http://www.yourweddingpro.co.uk

Wedding Countdown Widget is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or 
any later version.

Christmas Countdown Widget is distributed in the hope that it will be useful, 
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Wedding Countdown Widget. If not, see <http://www.gnu.org/licenses/>.
*/

//Enqueue Countdown Scripts and Styles

function ds_wedding_countdown_scripts() {
  wp_enqueue_style( 'weddingcount-styles', plugins_url( 'css/weddingcount-styles.css', __FILE__ ) );
  wp_enqueue_script( 'weddingcount-scripts', plugins_url( 'scripts/scriptfile.js', __FILE__ ) );
}
add_action( 'wp_enqueue_scripts', 'ds_wedding_countdown_scripts' );




//Extends Wedding Countdown Widget

class ds_weddingcount extends WP_Widget {
  function ds_weddingcount()
  {
    $widget_ops = array('classname' => 'ds_weddingcount', 'description' => 'Drag this widget to your sidebar to display Your Wedding Countdown.' );
    $this->WP_Widget('ds_weddingcount', 'Wedding Countdown', $widget_ops);
  }
 
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
	$liststyle = $instance['liststyle'];
	$bride = $instance['bride'];
	$groom = $instance['groom'];
	$venue = $instance['venue'];
	$date = $instance['date'];
	$showcount = $instance['showcount'];
	$day = $instance['day'];
	$month = $instance['month'];
	$year = $instance['year'];
	$hour = $instance['hour'];
	$minute = $instance['minute'];
	$timediff = $instance['timediff'];
?>
  <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
  <p><label for="<?php echo $this->get_field_id('liststyle'); ?>">List Style: <select name="<?php echo $this->get_field_name('liststyle'); ?>" id="<?php echo $this->get_field_id('liststyle'); ?>" class="widefat">
<?php
$options = array('icons', 'bullets', 'none');
foreach ($options as $option) {
echo '<option value="' . $option . '" id="' . $option . '"', $liststyle == $option ? ' selected="selected"' : '', '>', $option, '</option>';
}
?>
</select></label></p>
   <p><label for="<?php echo $this->get_field_id('bride'); ?>">Brides Name: <input class="widefat" id="<?php echo $this->get_field_id('bride'); ?>" name="<?php echo $this->get_field_name('bride'); ?>" type="text" value="<?php echo esc_attr($bride); ?>" /></label></p>
   <p><label for="<?php echo $this->get_field_id('groom'); ?>">Grooms Name: <input class="widefat" id="<?php echo $this->get_field_id('groom'); ?>" name="<?php echo $this->get_field_name('groom'); ?>" type="text" value="<?php echo esc_attr($groom); ?>" /></label></p>
   <p><label for="<?php echo $this->get_field_id('venue'); ?>">Venue Name: <input class="widefat" id="<?php echo $this->get_field_id('venue'); ?>" name="<?php echo $this->get_field_name('venue'); ?>" type="text" value="<?php echo esc_attr($venue); ?>" /></label></p>
   <p><label for="<?php echo $this->get_field_id('date'); ?>">Date: <input class="widefat" id="<?php echo $this->get_field_id('date'); ?>" name="<?php echo $this->get_field_name('date'); ?>" type="text" value="<?php echo esc_attr($date); ?>" /></label></p>
   
   <p><label for="<?php echo $this->get_field_id('showcount'); ?>">Show Countdown: <input id="<?php echo $this->get_field_id('showcount'); ?>" name="<?php echo $this->get_field_name('showcount'); ?>" type="checkbox" value="1" <?php checked( '1', $showcount ); ?> /></label></p>
   
   
   <p><label for="<?php echo $this->get_field_id('day'); ?>">Countdown Day: <select name="<?php echo $this->get_field_name('day'); ?>" id="<?php echo $this->get_field_id('day'); ?>" class="widefat">
<?php
$options = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31');
foreach ($options as $option) {
echo '<option value="' . $option . '" id="' . $option . '"', $day == $option ? ' selected="selected"' : '', '>', $option, '</option>';
}
?>
</select></label></p>

<p><label for="<?php echo $this->get_field_id('month'); ?>">Countdown Month: <select name="<?php echo $this->get_field_name('month'); ?>" id="<?php echo $this->get_field_id('month'); ?>" class="widefat">
<?php
$options = array('1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12');
foreach ($options as $option) {
echo '<option value="' . $option . '" id="' . $option . '"', $month == $option ? ' selected="selected"' : '', '>', $option, '</option>';
}
?>
</select></label></p>

<p><label for="<?php echo $this->get_field_id('year'); ?>">Countdown Year: <select name="<?php echo $this->get_field_name('year'); ?>" id="<?php echo $this->get_field_id('year'); ?>" class="widefat">
<?php
$options = array('2013', '2014', '2015', '2016', '2017', '2018', '2019', '2020', '2021', '2022', '2023', '2024', '2025');
foreach ($options as $option) {
echo '<option value="' . $option . '" id="' . $option . '"', $year == $option ? ' selected="selected"' : '', '>', $option, '</option>';
}
?>
</select></label></p>
   
<p><label for="<?php echo $this->get_field_id('hour'); ?>">Countdown Hour: <select name="<?php echo $this->get_field_name('hour'); ?>" id="<?php echo $this->get_field_id('hour'); ?>" class="widefat">
<?php
$options = array('00', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24');
foreach ($options as $option) {
echo '<option value="' . $option . '" id="' . $option . '"', $hour == $option ? ' selected="selected"' : '', '>', $option, '</option>';
}
?>
</select></label></p>

<p><label for="<?php echo $this->get_field_id('minute'); ?>">Countdown Minute: <select name="<?php echo $this->get_field_name('minute'); ?>" id="<?php echo $this->get_field_id('minute'); ?>" class="widefat">
<?php
$options = array('00', '15', '30', '45');
foreach ($options as $option) {
echo '<option value="' . $option . '" id="' . $option . '"', $minute == $option ? ' selected="selected"' : '', '>', $option, '</option>';
}
?>
</select></label></p>

<p><label for="<?php echo $this->get_field_id('timediff'); ?>">Countdown Time Difference: <select name="<?php echo $this->get_field_name('timediff'); ?>" id="<?php echo $this->get_field_id('timediff'); ?>" class="widefat">
<?php
$options = array('+00', '+01', '+02', '+03', '+04', '+05', '+06', '+07', '+08', '+09', '+10', '+11', '+12', '-01', '-02', '-03', '-04', '-05', '-06', '-07', '-08', '-09', '-10', '-11', '-12');
foreach ($options as $option) {
echo '<option value="' . $option . '" id="' . $option . '"', $timediff == $option ? ' selected="selected"' : '', '>', $option, '</option>';
}
?>
</select></label></p>
   
<?php
}
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = $new_instance['title'];
	$instance['liststyle'] = $new_instance['liststyle'];
	$instance['bride'] = $new_instance['bride'];
	$instance['groom'] = $new_instance['groom'];
	$instance['venue'] = $new_instance['venue'];
	$instance['date'] = $new_instance['date'];
	$instance['showcount'] = $new_instance['showcount'];
	$instance['day'] = $new_instance['day'];
	$instance['month'] = $new_instance['month'];
	$instance['year'] = $new_instance['year'];
	$instance['hour'] = $new_instance['hour'];
	$instance['minute'] = $new_instance['minute'];
	$instance['timediff'] = $new_instance['timediff'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
	$liststyle = $instance['liststyle']; ;
	$bride = $instance['bride']; ;
	$groom = $instance['groom']; ;
	$venue = $instance['venue']; ;
	$date = $instance['date']; ;
	$showcount = $instance['showcount']; ;
	$day = $instance['day']; ;
	$month = $instance['month']; ;
	$year = $instance['year']; ;
	$hour = $instance['hour']; ;
	$minute = $instance['minute']; ;
	$timediff = $instance['timediff']; ;
 
    if (!empty($title))
      echo $before_title . $title . $after_title;
	
	echo '<div class="weddingcountdown"><ul>';
	
	
if (!empty($bride))       
      echo '<li class="'.$liststyle.' bride">Bride: '.$bride.'</li>'; 
if (!empty($groom))       
      echo '<li class="'.$liststyle.' groom">Groom: '.$groom.'</li>'; 
if (!empty($venue))       
      echo '<li class="'.$liststyle.' venue">Venue: '.$venue.'</li>'; 
if (!empty($date))       
      echo '<li class="'.$liststyle.' date">Date: '.$date.'</li>'; 
if (!empty($showcount))       
     echo '<li class="'.$liststyle.' countdown"><span id="countdown1">'.$year.'-'.$month.'-'.$day.' '.$hour.':'.$minute.':00 GMT'.$timediff.':00</span></li>'; 
	  
 
 echo '</div></ul>';
 
    echo $after_widget;
	
	
  }
	
  
  
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("ds_weddingcount");') );