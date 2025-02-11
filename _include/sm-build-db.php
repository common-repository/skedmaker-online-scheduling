<?php 
global $wpdb;
// $wpdb->show_errors();
if(!function_exists('SM_check_db_varchar')){function SM_check_db_varchar($table, $col, $varchar_length){
	global $wpdb;
	foreach($wpdb->get_col("DESC "." $table ", 0 ) as $DB_col) {
		if($col==$DB_col){
			$pos==true;
		}
	}
	if($pos!=true){
		$saveIt=$wpdb->query("ALTER TABLE $table ADD $col VARCHAR($varchar_length) NOT NULL;");
		if($saveIt){
			echo "<p style='color:#090; font-weight:bold; font-size:18px; '>Added column: ".$col." to table: ".$table."</p>";
		}
	}
}}

if(!function_exists('SM_check_db_text')){function SM_check_db_text($table, $col){
	global $wpdb;
	foreach($wpdb->get_col("DESC "." $table ", 0 ) as $DB_col) {
		if($col==$DB_col){
			$pos==true;
		}
	}
	if($pos!=true){
		$saveIt=$wpdb->query("ALTER TABLE $table ADD $col text NOT NULL;");
		if($saveIt){
			echo "<p style='color:#090; font-weight:bold; font-size:18px; '>Added column: ".$col." to table: ".$table."</p>";
		}
	}
}}


// check if main Skedmaker tables exist. If not, build them.
$val=$wpdb->query('select 1 from `skedmaker_users`');
if($val===FALSE){

function SM_code(){
	$codedate=date('Ymd');
	$len=10;
	$base='BCDFGHJKLMNPRSTVWXYZ';
	$max=strlen($base)-1;
	$code='';
	mt_srand((double)microtime()*1000000);
	while (strlen($code)<$len+1)
		$code.=$base{mt_rand(0,$max)
	};
	$DBcode=$codedate.$code;
	return $DBcode;
}

if(!function_exists('SM_ts')){function SM_ts(){$date=strtotime(date("Y-m-d H:i.s")); return $date;}}

$conf_img="<img src='".$sm_btns_dir."btn_check_green32_reg.png' style='vertical-align:middle; margin-right:7px;'>";

//////////////////////////////////////////////////////////////////////////////////////////////////
// -- Blackouts
//////////////////////////////////////////////////////////////////////////////////////////////////
$blackouts="
CREATE TABLE IF NOT EXISTS `skedmaker_blackouts` (
  `id` int(11) NOT NULL auto_increment,
  `code` varchar(100) NOT NULL,
  `sitecode` varchar(100) NOT NULL,
  `start_date` varchar(50) NOT NULL,
  `end_date` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;";
$saveIt=$wpdb->query($blackouts);
// $conf_img="<img src='".$sm_btns_dir."btn_blackouts32_reg.png' style='vertical-align:middle; margin-right:7px;'>";
if(!$saveIt){echo "<p style='color:#f00;'>Error! Could not create table: skedmaker_blackouts</p>"; $errorMessage="y";}else{echo "<p style='color:#090; font-weight:bold; font-size:18px; '>".$conf_img." Created table: skedmaker_blackouts</p>";}







//////////////////////////////////////////////////////////////////////////////////////////////////



// -- Blocked dates



//////////////////////////////////////////////////////////////////////////////////////////////////



$blockeddates="



CREATE TABLE IF NOT EXISTS `skedmaker_blockeddates` (



  `id` int(20) NOT NULL auto_increment,



  `ip` varchar(100) NOT NULL,



  `date` varchar(100) NOT NULL,



  `timestamp` varchar(100) NOT NULL,



  `time` varchar(500) NOT NULL,



  `sitecode` varchar(500) NOT NULL,



  PRIMARY KEY  (`id`)



) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;";



$saveIt=$wpdb->query($blockeddates);



if(!$saveIt){echo "<p style='color:#f00;'>Error! Could not create table: skedmaker_blockeddates</p>"; $errorMessage="y";}else{echo "<p style='color:#090; font-weight:bold; font-size:18px; '>".$conf_img." Created table: skedmaker_blockeddates</p>";}







//////////////////////////////////////////////////////////////////////////////////////////////////



// -- Clients



//////////////////////////////////////////////////////////////////////////////////////////////////



$clients="



CREATE TABLE `skedmaker_clients` (



  `id` int(20) NOT NULL AUTO_INCREMENT,



  `code` varchar(100) NOT NULL,



  `username` varchar(500) NOT NULL,



  `email` varchar(500) NOT NULL,



  `password` varchar(100) NOT NULL,



  `phone` varchar(100) NOT NULL,



  `signup_date` varchar(100) NOT NULL,



  `recent_date` varchar(100) NOT NULL,



  `signup_ip` varchar(100) NOT NULL,



  `recent_ip` varchar(100) NOT NULL,



  `signup_location` varchar(500) NOT NULL,



  `recent_location` varchar(500) NOT NULL,



  `valid` varchar(50) NOT NULL,



  PRIMARY KEY (`id`)



) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;";



$saveIt=$wpdb->query($clients);



if(!$saveIt){echo "<p style='color:#f00;'>Error! Could not create table: skedmaker_clients</p>"; $errorMessage="y";}else{echo "<p style='color:#090; font-weight:bold; font-size:18px; '>".$conf_img." Created table: skedmaker_clients</p>";}







//////////////////////////////////////////////////////////////////////////////////////////////////



// -- Custom



//////////////////////////////////////////////////////////////////////////////////////////////////



$custom="



CREATE TABLE IF NOT EXISTS `skedmaker_custom` (



  `id` int(20) NOT NULL auto_increment,



  `name` varchar(500) NOT NULL,



  `sitecode` varchar(500) NOT NULL,



  `date` varchar(500) NOT NULL,



  `showdate` varchar(500) NOT NULL,



  `multiple` int(20) NOT NULL,



  `starthour` varchar(10) NOT NULL,



  `startminute` varchar(10) NOT NULL,



  `endhour` varchar(10) NOT NULL,



  `endminute` varchar(10) NOT NULL,



  `datecode` varchar(500) NOT NULL,



  `timecode` varchar(500) NOT NULL,



  `apt_info` text NOT NULL,



  PRIMARY KEY  (`id`)



) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;";



$saveIt=$wpdb->query($custom);



if(!$saveIt){echo "<p style='color:#f00;'>Error! Could not create table: skedmaker_custom</p>"; $errorMessage="y";}else{echo "<p style='color:#090; font-weight:bold; font-size:18px; '>".$conf_img." Created table: skedmaker_custom</p>";}







//////////////////////////////////////////////////////////////////////////////////////////////////



// -- Custom Sked



//////////////////////////////////////////////////////////////////////////////////////////////////



$custom_sked="



CREATE TABLE IF NOT EXISTS `skedmaker_custom_sked` (



  `id` int(20) NOT NULL auto_increment,



  `sitecode` varchar(500) NOT NULL,



  `datecode` varchar(500) NOT NULL,



  `date` varchar(500) NOT NULL,



  `startdate` varchar(100) NOT NULL,



  `enddate` varchar(100) NOT NULL,



  `year` varchar(500) NOT NULL,



  `month` varchar(500) NOT NULL,



  `day` varchar(500) NOT NULL,



  `weekday` varchar(500) NOT NULL,



  `name` varchar(500) NOT NULL,



  `code` varchar(500) NOT NULL,



  PRIMARY KEY  (`id`)



) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;";



$saveIt=$wpdb->query($custom_sked);



if(!$saveIt){echo "<p style='color:#f00;'>Error! Could not create table: skedmaker_custom_sked</p>"; $errorMessage="y";}else{echo "<p style='color:#090; font-weight:bold; font-size:18px; '>".$conf_img." Created table: skedmaker_custom_sked</p>";}







//////////////////////////////////////////////////////////////////////////////////////////////////



// -- Custom Timeframes



//////////////////////////////////////////////////////////////////////////////////////////////////



$custom_timeframes="



CREATE TABLE IF NOT EXISTS `skedmaker_custom_timeframes` (



  `id` int(20) NOT NULL auto_increment,



  `name` varchar(500) NOT NULL,



  `sitecode` varchar(500) NOT NULL,



  `date` varchar(500) NOT NULL,



  `showdate` varchar(500) NOT NULL,



  `multiple` int(20) NOT NULL,



  `starthour` varchar(10) NOT NULL,



  `startminute` varchar(10) NOT NULL,



  `endhour` varchar(10) NOT NULL,



  `endminute` varchar(10) NOT NULL,



  `datecode` varchar(500) NOT NULL,



  `timecode` varchar(500) NOT NULL,



  PRIMARY KEY  (`id`)



) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;";



$saveIt=$wpdb->query($custom_timeframes);



if(!$saveIt){echo "<p style='color:#f00;'>Error! Could not create table: skedmaker_timeframes</p>"; $errorMessage="y";}else{echo "<p style='color:#090; font-weight:bold; font-size:18px; '>".$conf_img." Created table: skedmaker_custom_timeframes</p>";}







//////////////////////////////////////////////////////////////////////////////////////////////////



// -- Send Reminders



//////////////////////////////////////////////////////////////////////////////////////////////////



$sendreminders="



CREATE TABLE IF NOT EXISTS `skedmaker_sendreminders` (



  `id` int(29) NOT NULL auto_increment,



  `date` varchar(500) NOT NULL,



  `showdate` varchar(500) NOT NULL,



  `sitecode` varchar(500) NOT NULL,



  PRIMARY KEY  (`id`)



) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;";



$saveIt=$wpdb->query($sendreminders);



if(!$saveIt){echo "<p style='color:#f00;'>Error! Could not create table: skedmaker_sendreminders</p>"; $errorMessage="y";}else{echo "<p style='color:#090; font-weight:bold; font-size:18px; '>".$conf_img." Created table: skedmaker_sendreminders</p>";}







$services="



CREATE TABLE IF NOT EXISTS `skedmaker_services` (



  `id` int(20) NOT NULL auto_increment,



  `code` varchar(500) NOT NULL,



  `name` varchar(500) NOT NULL,



  `price` varchar(100) NOT NULL,



  `live` varchar(100) NOT NULL,



  `content` text NOT NULL,



  PRIMARY KEY  (`id`)



) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;";



$saveIt=$wpdb->query($services);



if(!$saveIt){echo "<p style='color:#f00;'>Error! Could not create table: skedmaker_services</p>"; $errorMessage="y";}else{echo "<p style='color:#090; font-weight:bold; font-size:18px; '>".$conf_img." Created table: skedmaker_services</p>";}







//////////////////////////////////////////////////////////////////////////////////////////////////



// -- Sked -- this is the schedule table that stores booked apts.



//////////////////////////////////////////////////////////////////////////////////////////////////





$sked="



CREATE TABLE IF NOT EXISTS `skedmaker_sked` (



  `id` int(20) NOT NULL auto_increment,



  `ip` varchar(500) NOT NULL,



  `sitecode` varchar(500) NOT NULL,



  `usercode` varchar(500) NOT NULL,



  `datecode` varchar(500) NOT NULL,



  `name` varchar(500) NOT NULL,



  `email` varchar(500) NOT NULL,



  `phone` varchar(100) NOT NULL,



  `client_address` varchar(100) NOT NULL,



  `client_address2` varchar(100) NOT NULL,



  `client_city` varchar(100) NOT NULL,



  `client_state` varchar(100) NOT NULL,



  `client_zip` varchar(100) NOT NULL,



  `showdate` varchar(500) NOT NULL,



  `startdate` varchar(100) NOT NULL,



  `enddate` varchar(100) NOT NULL,



  `noshowsent` varchar(500) NOT NULL,



  `year` varchar(500) NOT NULL,



  `month` varchar(500) NOT NULL,



  `day` varchar(500) NOT NULL,



  `hour` varchar(500) NOT NULL,



  `minute` varchar(500) NOT NULL,



  `numberinparty` varchar(500) NOT NULL,



  `code` varchar(500) NOT NULL,



  `custom_timecode` varchar(500) NOT NULL,



  `country` varchar(500) NOT NULL,



  `region` varchar(500) NOT NULL,



  `city` varchar(500) NOT NULL,



  `reminder_sent` varchar(100) NOT NULL,



  `content` text NOT NULL,



  `services` text NOT NULL,



  PRIMARY KEY  (`id`)



) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;";



$saveIt=$wpdb->query($sked);



if(!$saveIt){echo "<p style='color:#f00;'>Error! Could not create table: skedmaker_sked</p>"; $errorMessage="y";}else{echo "<p style='color:#090; font-weight:bold; font-size:18px; '>".$conf_img." Created table: skedmaker_sked</p>";}







//////////////////////////////////////////////////////////////////////////////////////////////////



// -- create a unique code to prevent double posts



//////////////////////////////////////////////////////////////////////////////////////////////////



$uni="



CREATE TABLE IF NOT EXISTS `skedmaker_uni` (



  `id` int(20) NOT NULL auto_increment,



  `uni` varchar(500) NOT NULL,



  PRIMARY KEY  (`id`)



) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;";



$saveIt=$wpdb->query($uni);



if(!$saveIt){echo "<p style='color:#f00;'>Error! Could not create table: skedmaker_uni</p>"; $errorMessage="y";}else{echo "<p style='color:#090; font-weight:bold; font-size:18px; '>".$conf_img." Created table: skedmaker_uni</p>";}







//////////////////////////////////////////////////////////////////////////////////////////////////



// -- admin's user profile, all setting for skedmaker a re stored here.



//////////////////////////////////////////////////////////////////////////////////////////////////



$users="



CREATE TABLE IF NOT EXISTS `skedmaker_users` (

  `id` int(30) NOT NULL auto_increment,

  `timezone` varchar(500) NOT NULL,

  `sitecode` varchar(500) NOT NULL,

  `admincode` varchar(500) NOT NULL,

  `agentcode` varchar(20) NOT NULL,

  `promocode` varchar(100) NOT NULL,

  `valid` varchar(100) NOT NULL,

  `live` varchar(100) NOT NULL,

  `daysleft` int(20) NOT NULL,

  `sitename` varchar(500) NOT NULL,

  `photo` varchar(500) NOT NULL,

  `country` varchar(500) NOT NULL,

  `region` varchar(500) NOT NULL,

  `city` varchar(500) NOT NULL,

  `address1` varchar(500) NOT NULL,

  `address2` varchar(500) NOT NULL,

  `zipcode` varchar(100) NOT NULL,

  `phone` varchar(100) NOT NULL,

  `fax` varchar(100) NOT NULL,

  `directionsURL` varchar(1000) NOT NULL,

  `cellphone` varchar(100) NOT NULL,

  `website` varchar(500) NOT NULL,

  `ipsignup` varchar(50) NOT NULL,

  `iprecent` varchar(100) NOT NULL,

  `adminemail` varchar(500) NOT NULL,

  `password` varchar(200) NOT NULL,

  `trackcountry` varchar(100) NOT NULL,

  `trackregion` varchar(100) NOT NULL,

  `trackcity` varchar(100) NOT NULL,

  `datesignup` varchar(50) NOT NULL,

  `daterecent` varchar(50) NOT NULL,

  `datepaid` varchar(500) NOT NULL,

  `datekill` varchar(500) NOT NULL,

  `kill_sent_1days` varchar(20) NOT NULL,

  `kill_sent_4days` varchar(20) NOT NULL,

  `kill_sent_7days` varchar(20) NOT NULL,

  `warnday` varchar(50) NOT NULL,

  `mondaylive` varchar(10) NOT NULL,

  `mondayincrement` varchar(100) NOT NULL,

  `mondaymultiple` varchar(10) NOT NULL,

  `mondayopenhour` varchar(20) NOT NULL,

  `mondayopenminute` varchar(20) NOT NULL,

  `mondaybreakhour` varchar(20) NOT NULL,

  `mondaybreakminute` varchar(20) NOT NULL,

  `mondayreturnhour` varchar(20) NOT NULL,

  `mondayreturnminute` varchar(20) NOT NULL,

  `mondayclosehour` varchar(20) NOT NULL,

  `mondaycloseminute` varchar(20) NOT NULL,

  `monday_info` text NOT NULL,

  `tuesdaylive` varchar(10) NOT NULL,

  `tuesdayincrement` varchar(100) NOT NULL,

  `tuesdaymultiple` varchar(10) NOT NULL,

  `tuesdayopenhour` varchar(20) NOT NULL,

  `tuesdayopenminute` varchar(20) NOT NULL,

  `tuesdaybreakhour` varchar(20) NOT NULL,

  `tuesdaybreakminute` varchar(20) NOT NULL,

  `tuesdayreturnhour` varchar(20) NOT NULL,

  `tuesdayreturnminute` varchar(20) NOT NULL,

  `tuesdayclosehour` varchar(20) NOT NULL,

  `tuesdaycloseminute` varchar(20) NOT NULL,

  `tuesday_info` text NOT NULL,

  `wednesdaylive` varchar(10) NOT NULL,

  `wednesdayincrement` varchar(100) NOT NULL,

  `wednesdaymultiple` varchar(10) NOT NULL,

  `wednesdayopenhour` varchar(20) NOT NULL,

  `wednesdayopenminute` varchar(20) NOT NULL,

  `wednesdaybreakhour` varchar(20) NOT NULL,

  `wednesdaybreakminute` varchar(20) NOT NULL,

  `wednesdayreturnhour` varchar(20) NOT NULL,

  `wednesdayreturnminute` varchar(20) NOT NULL,

  `wednesdayclosehour` varchar(20) NOT NULL,

  `wednesdaycloseminute` varchar(20) NOT NULL,

  `wednesday_info` text NOT NULL,

  `thursdaylive` varchar(10) NOT NULL,

  `thursdayincrement` varchar(100) NOT NULL,

  `thursdaymultiple` varchar(10) NOT NULL,

  `thursdayopenhour` varchar(20) NOT NULL,

  `thursdayopenminute` varchar(20) NOT NULL,

  `thursdaybreakhour` varchar(20) NOT NULL,

  `thursdaybreakminute` varchar(20) NOT NULL,

  `thursdayreturnhour` varchar(20) NOT NULL,

  `thursdayreturnminute` varchar(20) NOT NULL,

  `thursdayclosehour` varchar(20) NOT NULL,

  `thursdaycloseminute` varchar(20) NOT NULL,

  `thursday_info` text NOT NULL,

  `fridaylive` varchar(10) NOT NULL,

  `fridayincrement` varchar(100) NOT NULL,

  `fridaymultiple` varchar(10) NOT NULL,

  `fridayopenhour` varchar(20) NOT NULL,

  `fridayopenminute` varchar(20) NOT NULL,

  `fridaybreakhour` varchar(20) NOT NULL,

  `fridaybreakminute` varchar(20) NOT NULL,

  `fridayreturnhour` varchar(20) NOT NULL,

  `fridayreturnminute` varchar(20) NOT NULL,

  `fridayclosehour` varchar(20) NOT NULL,

  `fridaycloseminute` varchar(20) NOT NULL,

  `friday_info` text NOT NULL,

  `saturdaylive` varchar(10) NOT NULL,

  `saturdayincrement` varchar(100) NOT NULL,

  `saturdaymultiple` varchar(10) NOT NULL,

  `saturdayopenhour` varchar(20) NOT NULL,

  `saturdayopenminute` varchar(20) NOT NULL,

  `saturdaybreakhour` varchar(20) NOT NULL,

  `saturdaybreakminute` varchar(20) NOT NULL,

  `saturdayreturnhour` varchar(20) NOT NULL,

  `saturdayreturnminute` varchar(20) NOT NULL,

  `saturdayclosehour` varchar(20) NOT NULL,

  `saturdaycloseminute` varchar(20) NOT NULL,

  `saturday_info` text NOT NULL,

  `sundaylive` varchar(10) NOT NULL,

  `sundayincrement` varchar(100) NOT NULL,

  `sundaymultiple` varchar(10) NOT NULL,

  `sundayopenhour` varchar(20) NOT NULL,

  `sundayopenminute` varchar(20) NOT NULL,

  `sundaybreakhour` varchar(20) NOT NULL,

  `sundaybreakminute` varchar(20) NOT NULL,

  `sundayreturnhour` varchar(20) NOT NULL,

  `sundayreturnminute` varchar(20) NOT NULL,

  `sundayclosehour` varchar(20) NOT NULL,

  `sundaycloseminute` varchar(20) NOT NULL,

  `sunday_info` text NOT NULL,

  `content` longtext NOT NULL,

  `banner` varchar(100) NOT NULL,

  `blockeddays` longtext NOT NULL,

  `blockedtimes` longtext NOT NULL,

  `terms` varchar(500) NOT NULL,

  `deleted` varchar(500) NOT NULL,

  `requirename` varchar(10) NOT NULL,

  `requireemail` varchar(10) NOT NULL,

  `requireconfirm` varchar(10) NOT NULL,

  `requirephone` varchar(10) NOT NULL,

  `requiremessage` varchar(10) NOT NULL,

  `sitepublic` varchar(10) NOT NULL,

  `facebook` varchar(10) NOT NULL,

  `twitter` varchar(20) NOT NULL,

  `googleplus` varchar(20) NOT NULL,

  `allowsameday` varchar(5) NOT NULL,

  `premium` varchar(100) NOT NULL,

  `protect` varchar(500) NOT NULL,

  `publicschedule` varchar(10) NOT NULL,

  `appointmentAvailable` varchar(500) NOT NULL,

  `appointmentUnavailable` varchar(500) NOT NULL,

  `appointmentpadding` varchar(100) NOT NULL,

  `cancel` text NOT NULL,

  `confirmation` text NOT NULL,

  `cancelpolicy` text NOT NULL,

  `feature` varchar(100) NOT NULL,

  `requirenumberinparty` varchar(100) NOT NULL,

  `partymax` varchar(100) NOT NULL,

  `keep_profile_open` varchar(1) NOT NULL,

  `calendarcaption` longtext NOT NULL,



  `services` text NOT NULL,

  `skin` varchar(50) NOT NULL,

  `color1` varchar(20) NOT NULL,

  `color2` varchar(20) NOT NULL,

  `color3` varchar(20) NOT NULL,

  `highlight` varchar(20) NOT NULL,

  `requireregistration` varchar(10) NOT NULL,

  `requirevalidation` varchar(10) NOT NULL,

  `send_notices_to_admin` varchar(10) NOT NULL,

  `send_notices_to_client` varchar(10) NOT NULL,

  `send_notices_to_BCC` varchar(10) NOT NULL,

  `BCC1` varchar(100) NOT NULL,

  `BCC2` varchar(100) NOT NULL,

  `BCC3` varchar(100) NOT NULL,

  `prefix_content` text NOT NULL,

  `daylight_savings` varchar(100) NOT NULL,  

  `reminder_interval` varchar(20) NOT NULL,  

  `requireservices` varchar(100) NOT NULL,

  `services_list_style` VARCHAR(100),

  `require_client_address` VARCHAR(100),
  
  `limited_services` VARCHAR(50),



  PRIMARY KEY  (`id`)

) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;";



$saveIt=$wpdb->query($users);



if(!$saveIt){echo "<p style='color:#f00;'>Error! Could not create table: skedmaker_users</p>"; $errorMessage="y";}else{echo "<p style='color:#090; font-weight:bold; font-size:18px; '>".$conf_img." Created table: skedmaker_users</p>";}







$genSC=SM_code();



$genUC=SM_code();



$genTS=SM_ts();







if($errorMessage!="y"){



	//////////////////////////////////////////////////////////////////////////////////////////////////



	// -- Create a defaut admin account



	//////////////////////////////////////////////////////////////////////////////////////////////////



	$SM_site_title=get_bloginfo('name');  // get the user defined name for the website, add to 'name '



	$insert_new_user="



	INSERT INTO `skedmaker_users` VALUES(

	0,

	'',

	'$genSC',

	'$genUC',

	'cjkagent',

	'sked250',

	'$genTS',

	'y',

	0,

	'$SM_site_title',

	'',

	'',

	'',

	'',

	'',

	'',

	'',

	'',

	'',

	'',

	'',

	'',

	'',

	'',

	'',

	'',

	'',

	'',

	'',

	'$genTS',

	'', '', '$genTS', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'y', 'y', 'y', '', '', 'y', '', '', '', 'y', '', '', '', 'Available', 'Unavailable', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'y', 'y', 'noBCC', '', '', '', '', 'y', '86400', '', '', '', '');";







	$saveIt=$wpdb->query($insert_new_user);



	if(!$saveIt){echo "<p style='color:#f00;'>Error! Could not create new user record. Try to re-load this page.</p>"; $errorMessage="y";}else{echo "<p style='color:#090; font-weight:bold; font-size:28px;'>".$conf_img." Created new user successfully!</p>";}







	if($errorMessage!="y"){



		function SM_redirect($goto, $wait){



			echo "<script language='javascript'>



			function direct(){



			   window.location='".$site.$goto."';



			   }



			   setTimeout( 'direct();', ".$wait.");



				</script>";



		}







		$headers = "From: info@skedmaker.com \r\n";



		$headers .= "Content-Type: text/html; charset=ISO-8859-1\n";



		$headers .= "MIME-Version: 1.0\n";



		$check_site=get_site_url();



		mail("info@skedmaker.com", "New Plugin", $check_site, $headers);







		SM_redirect("?page=skedmaker-online-scheduling/admin_home.php&v=home&", 1000);



		die();



	}



}



}







//////////////////////////////////////////////////////////////////////////////////////////////////



// -- Services -- this is the schedule table that stores services for selection when boking.



//////////////////////////////////////////////////////////////////////////////////////////////////



$val=$wpdb->query('select 1 from `skedmaker_services`');



if($val===FALSE){



$services="



CREATE TABLE IF NOT EXISTS `skedmaker_services` (



  `id` int(20) NOT NULL auto_increment,



  `code` varchar(500) NOT NULL,



  `name` varchar(500) NOT NULL,



  `price` varchar(100) NOT NULL,



  `live` varchar(100) NOT NULL,



  `content` text NOT NULL,



  PRIMARY KEY  (`id`)



) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;";



$saveIt=$wpdb->query($services);



if(!$saveIt){echo "<p style='color:#f00;'>Error! Could not create table: skedmaker_services</p>"; $errorMessage="y";}else{echo "<p style='color:#090; font-weight:bold; font-size:18px; '>".$conf_img." Created table: skedmaker_services</p>";}



}







//////////////////////////////////////////////////////////////////////////////////////////////////



// -- sked updates



//////////////////////////////////////////////////////////////////////////////////////////////////



SM_check_db_text("skedmaker_sked", "services");



SM_check_db_varchar("skedmaker_sked", "client_address", 100);



SM_check_db_varchar("skedmaker_sked", "client_address2", 100);



SM_check_db_varchar("skedmaker_sked", "client_city", 100);



SM_check_db_varchar("skedmaker_sked", "client_state", 100);



SM_check_db_varchar("skedmaker_sked", "client_zip", 100);



SM_check_db_varchar("skedmaker_sked", "client_lat", 100);



SM_check_db_varchar("skedmaker_sked", "client_lon", 100);







//////////////////////////////////////////////////////////////////////////////////////////////////



// -- users updates



//////////////////////////////////////////////////////////////////////////////////////////////////



SM_check_db_varchar("skedmaker_users", "requireservices", 100);



SM_check_db_varchar("skedmaker_users", "services_list_style", 100);



SM_check_db_varchar("skedmaker_users", "require_client_address", 100);



SM_check_db_varchar("skedmaker_users", "text_notices_to_admin", 10);



SM_check_db_varchar("skedmaker_users", "text_path", 200);



SM_check_db_varchar("skedmaker_users", "text_number", 50);
SM_check_db_varchar("skedmaker_users", "limited_services", 50);











//////////////////////////////////////////////////////////////////////////////////////////////////



// -- clients updates



//////////////////////////////////////////////////////////////////////////////////////////////////



SM_check_db_varchar("skedmaker_clients", "address", 100);



SM_check_db_varchar("skedmaker_clients", "address2", 100);



SM_check_db_varchar("skedmaker_clients", "city", 100);



SM_check_db_varchar("skedmaker_clients", "state", 100);



SM_check_db_varchar("skedmaker_clients", "zip", 100);



SM_check_db_varchar("skedmaker_clients", "lat", 100);



SM_check_db_varchar("skedmaker_clients", "lon", 100);







