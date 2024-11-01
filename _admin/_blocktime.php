<?php 
if($_SERVER['REQUEST_METHOD']=='POST' && $_GET['v']=="blocktime"){
	$ts=$_GET['ts'];
	$DBcode=SM_code();

//	 $wpdb->show_errors();

	if($ip==""){$ip="NA";}

	$saveIt=$wpdb->insert('skedmaker_sked', array('ip'=>$ip, 'usercode'=>'Admin Blocked', 'name'=>'Admin Blocked', 'startdate'=>$ts, 'code'=>$DBcode, 'content'=>'', 'numberinparty'=>'1'));

	if(!$saveIt){
		SM_redBox("Error. Please try again later.", 800, 16);
	}else{
		echo "<br>";
		SM_greenBox("Blocked Time Frame!", 800, 21);
		SM_redirect($smadmin."&v=home&ts=".$_GET['ts']."&", 500);
		die();
	}
}

SM_title("Block Appointment", "btn_block32_reg.png", "");?>
<form id="formblock" name="formblock" method="post" action="<?php echo $smadmin;?>&amp;v=blocktime&amp;ts=<?php echo $_GET['ts'];?>&amp;" style='margin: 0px; padding: 0px;'>
<table class='cc800'>
<tr><td class='b2-only' style='padding:21px;'>
<b>Would you like to block the appointment for:</b><br /> <br /> 
<span style='font-size:21px'><?php echo SM_apt($_GET['ts']);?>?</span>
<br><br>
Site administrators may block out this specific time by clicking the button below.
<br><br>
This action will make the appointment time display &quot;Unavailable&quot; to your visitors and &quot;Admin Blocked&quot; on your admin home page.
<br><br>
To remove this block, click "Cancel" from the Admin Home page.
<br><br>
<input type="submit" name="block" id="block" value="Yes, Block This Appointment" />
<bR /><bR />
<a href='<?php echo $smadmin;?>&amp;v=home&amp;ts=<?php echo $_GET['ts']; ?>&' class='sked'><img src='<?php echo $sm_btns_dir;?>btn_home16_reg.png' class='btn' />No, Return to Admin Home Page</a>
</td></tr></table>
</form>