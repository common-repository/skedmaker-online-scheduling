<?php

/**

 * @package DB Explorer

 * @version 0.98

 */

/*

Plugin Name: Skedmaker

Plugin URI: http://www.skedmaker.com/?op=skedmaker&amp;

Description: Online Appointment Scheduling

Version: 0.98

Author URI: http://www.skedmaker.com/

*/



add_action('activated_plugin','save_error');

function save_error(){file_put_contents(plugin_dir_path( __FILE__ ) . '/error.html', ob_get_contents());}



function plugin_admin_add_page() {

	add_menu_page( 'Skedmaker Admin', 'Skedmaker', 'manage_options', plugin_dir_path( __FILE__ ) . 'admin_home.php', '', 'dashicons-calendar-alt', 81);

}

add_action('admin_menu', 'plugin_admin_add_page');



function my_enqueue($hook) {

	//-- for our special admin page

	if( 'skedmaker/admin_home.php' != $hook )

		return;

	wp_register_style('skedmaker', plugins_url('skedmaker-online-scheduling/_include/sm-styles.php'));

	wp_enqueue_style('skedmaker');

}



function SM_scripts() {

	wp_enqueue_script( 'jquery' );

	wp_register_style( 'prefix-style', plugins_url('_include/sm-styles.php', __FILE__) );

	wp_enqueue_style( 'prefix-style' );

}

add_action('wp_enqueue_scripts','SM_scripts');



//-- Start session if not already started

function register_session(){if( !session_id() )session_start();}

add_action('init','register_session');



add_action('admin_enqueue_scripts', 'my_enqueue');



//-- shortcode

function skedmaker_shortcode($atts){include_once(plugin_dir_path( __FILE__ ) . "index.php");}

add_shortcode( 'wp-skedmaker', 'skedmaker_shortcode' );







//////////////////////////////////////////////////////////////////////////////////////////////////

//-- dashboard panel

//////////////////////////////////////////////////////////////////////////////////////////////////

/*

$sm_dash_panel=plugin_dir_path( __FILE__ ) . "_include/pro/_dashboard_panel.php";

if(file_exists($sm_dash_panel)){

	function SM_register_dashboard(){

		wp_add_dashboard_widget( 'SM_dashboard_sales', __("<a href='".admin_url()."?page=skedmaker-online-scheduling/admin_home.php&v=home' style='font-size:14px; font-weight:bold; color:#000; text-decoration:none;'>Skedmaker Online Scheduling</a>", 'SM'), 'SM_dashboard' );

	}

	add_action('wp_dashboard_setup', 'SM_register_dashboard', 10 );



function SM_dashboard(){

	global $wpdb;

	global $sm_btns_dir;

	$result=$wpdb->get_results("SELECT * FROM skedmaker_users", ARRAY_A);

	foreach($result as $row){

		$timezone=urldecode($row['timezone']);

		$reminder_interval=urldecode($row['reminder_interval']);

		$daylight_savings=urldecode($row['daylight_savings']);

	}

	$todaysdate=date('Y-m-d H:i.s');

	$todayTS=strtotime($todaysdate);



	$check_DST=date("I", time());

	if($check_DST==1 && $daylight_savings=="y"){$todayTS=$todayTS+3600;}



	$todayTS=strtotime("$timezone hours", $todayTS);



	$SMd1=$todayTS+$reminder_interval;

	$SMd2=date("Y-m-d 00:00.01", $SMd1);



	$startRange=strtotime($SMd2);

	$endRange=$startRange+86400;



	// ------- reminders

	$countIt=$wpdb->get_results("SELECT * FROM skedmaker_sked WHERE startdate>'$startRange' AND startdate<'$endRange' AND (usercode!='Admin Blocked' OR name!='Admin Blocked') AND email!='' AND reminder_sent='' ");

	$total_reminders=count($countIt);

	if($total_reminders==1){$reminder_word="reminder";}else{$reminder_word="reminders";}

	if($total_reminders>0){$reminder_color="F00";}



	// ------ today's apts

	$todayTS=strtotime(date('Y-m-d H:i.s'));

	$check_DST=date("I", time());

	if($check_DST==1 && $daylight_savings=="y"){$todayTS=$todayTS+3600;}



	$todayTS=strtotime("$timezone hours", $todayTS);



	$SMd1=$todayTS;

	$SMd2=strtotime(date("Y-m-d 00:00.01", $SMd1));



	$start_upcoming=$SMd2;

	$end_upcoming=$start_upcoming+86400;



	$countIt=$wpdb->get_results("SELECT * FROM skedmaker_sked WHERE startdate>'$start_upcoming' AND startdate<'$end_upcoming' AND usercode!='Admin Blocked' AND name!='Admin Blocked'");

	$total_today=count($countIt);

	if($total_today==1){$apt_word="appointment";}else{$apt_word="appointments";}



	//------- tomorrow's apts

	$tomorrow_start=$start_upcoming+86400;

	$tomorrow_end=$tomorrow_start+86400;

	$countIt=$wpdb->get_results("SELECT * FROM skedmaker_sked WHERE startdate>'$tomorrow_start' AND startdate<'$tomorrow_end' AND usercode!='Admin Blocked' AND name!='Admin Blocked'");

	$total_tomorrow=count($countIt);

	if($total_tomorrow==1){$tom_word="appointment";}else{$tom_word="appointments";}	



	// reminders

	echo "<table>";

	echo "<tr><td style='padding-bottom:14px;'>";

	echo "<a href='".admin_url()."?page=skedmaker-online-scheduling/admin_home.php&v=reminders' style='color:#".$reminder_color.";'>";

	echo "<img src='".plugins_url('_btns/btn_reminders32_reg.png', __FILE__)."' style='margin-right:7px; vertical-align:middle;'>";

	echo $total_reminders." ".$reminder_word." to send for ".date("l, F d, Y", $startRange);

	echo "</a></td></tr>";



	// today

	echo "<tr><td style='padding-bottom:14px;'>";

	echo "<a href='".admin_url()."?page=skedmaker-online-scheduling/admin_home.php&v=appointments&list=future&'>";

	echo "<img src='".plugins_url('_btns/btn_chair32_reg.png', __FILE__)."' style='margin-right:7px; vertical-align:middle;'>";

	echo $total_today." ".$apt_word." today.";

	echo "</a></td></tr>";



	// tomorrow

	echo "<tr><td style='padding-bottom:14px;'>";

	echo "<a href='".admin_url()."?page=skedmaker-online-scheduling/admin_home.php&v=appointments&list=future&'>";

	echo "<img src='".plugins_url('_btns/btn_future32_reg.png', __FILE__)."' style='margin-right:7px; vertical-align:middle;'>";

	echo $total_tomorrow." ".$tom_word." scheduled for tomorrow.";

	echo "</a></td></tr>";

	echo "</table>";

}	

}
*/
?>