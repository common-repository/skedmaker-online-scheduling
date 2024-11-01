<?php
$loginValid='admin';

include(plugin_dir_path( __FILE__ ) . "_include/sm-status.php");
$isAdmin='y';

// If ts a no show notice, display the form.
if($_GET['ns']!="" || $_GET['op']=="noshow"){echo "<br><br>"; include(plugin_dir_path( __FILE__ ) . '_include/_form_no_show.php');}

// The operation to perform
$op=$_GET['op'];

// The admin page to show
$view=$_GET['v'];

// Custom Days
$customskedcode=$_GET['csc'];

// settings edited
$settingedit=$_GET['settingedit'];

SM_block_unblock();
SM_cancel_apt("admin");
SM_remove_custom_from_day($_GET['csc'], $bulkReturn, $year, $month, $day, $weekday);
SM_purge_past_check();
SM_purge_past_confirm();

// Get the page to show. If it's blank, make it home page
if($_GET['v']==""){$view='home';}else{$view=$_GET['v'];}

if($view==""){$view="home";}
echo "<br><br>";

function SM_pro_msg($page, $btn){
	global $sm_btns_dir;
	global $smadmin;
	echo "<span class='redText' style='font-size:18px;'><img src='".$sm_btns_dir.$btn."' class='btn'>".$page." is only available with Skedmaker PRO.</span><br><br>";
	echo "<a href='".$smadmin."'>Click here for more information about Skedmaker PRO</a>";
	echo "<br><br>";
	echo "<a href='".$smadmin."'>Go back to Administration</a>";
	
}

if($view=="clients" || $view=="reminders" || $view=="search" || $view=="map" || $view=="map2"){
	$sm_page=plugin_dir_path( __FILE__ ) . "_admin/pro/_".$view.".php";
}else{
	$sm_page=plugin_dir_path( __FILE__ ) . "_admin/_".$view.".php";
}

if(file_exists($sm_page)){
	include($sm_page);
}else if($_GET['v']=="map"){
	SM_pro_msg("Appointment Map", "btn_map32_reg.png");
}else if($_GET['v']=="clients"){
	SM_pro_msg("Client List", "btn_clients32_reg.png");
}else if($_GET['v']=="reminders"){
	SM_pro_msg("Sending Reminders", "btn_reminders32_reg.png");

}else{
	echo "<span class='redText'>Sorry, can not find the page you are looking for.</span><br><br>";
	echo "<a href='".$smadmin."'>Go to Skedmaker Administration Page.</a>";
}

SM_foot(); ?>