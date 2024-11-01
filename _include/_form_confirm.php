<?php 
// $wpdb->show_errors();
if(wp_is_mobile()){



	$button_text="Reserve Now";



	$go_back_text="Go Back";



	$b1_text="Reserve this appointment?";



	$main_title_text="Confirm";



}else{



	$button_text="Reserve This Appointment";



	$go_back_text="Pick a different appointment";



	$b1_text="Would you like to reserve this appointment?";



	$main_title_text="Confirm Appointment";



}



	$ts=$_GET['ts'];



	$datecode=$_GET['dc'];



	$timecode=$_GET['tc'];



	$view=$_GET['v'];



	$showApt=SM_apt($ts);







	$multipleWeekday=strtolower(date('l', $ts));



	if($multipleWeekday=="monday"){



		$today_multiple=$mondaymultiple;



	}else if($multipleWeekday=="tuesday"){



		$today_multiple=$tuesdaymultiple;



	}else if($multipleWeekday=="wednesday"){



		$today_multiple=$wednesdaymultiple;



	}else if($multipleWeekday=="thursday"){



		$today_multiple=$thrusdaymultiple;



	}else if($multipleWeekday=="friday"){



		$today_multiple=$fridaymultiple;



	}else if($multipleWeekday=="saturday"){



		$today_multiple=$saturdaymultiple;



	}else if($multipleWeekday=="sunday"){



		$today_multiple=$sundaymultiple;



	}







	if ($_SERVER['REQUEST_METHOD']=='POST' && $_GET['op']=="confirm"){



		$errorMessage="";



		$errorMessage=SM_uni_check();







		//-- get registerd client info



		if($loginValidClient=="y"){



			$result=SM_result("SELECT * FROM skedmaker_clients WHERE code='$usercode' LIMIT 1");



			foreach($result as $row){



				$client_email=SM_d($row['email']);



				$client_name=SM_d($row['username']);



				$client_phone=SM_d($row['phone']);



				$client_address=SM_d($row['address']);



				$client_address2=SM_d($row['address2']);



				$client_city=SM_d($row['city']);



				$client_state=SM_d($row['state']);



				$client_zip=SM_d($row['zip']);



			}



		//-- not registered, use post info	



		}else{



			$client_name=$_POST["client_name"];



			$client_email=$_POST["client_email"];



			$confirm_email=$_POST["confirm_email"];



			$client_phone=$_POST["client_phone"];



			$client_address=$_POST["client_address"];



			$client_address2=$_POST["client_address2"];



			$client_city=$_POST["client_city"];



			$client_state=$_POST["client_state"];



			$client_zip=$_POST["client_zip"];







		}







		$confirm_email=$_POST["confirm_email"];



		$num_in_party=$_POST["num_in_party"];



		$client_content=$_POST["client_content"];







		if($services_list_style=="select"){



			$services=$_POST["services"];



		}else{



			$result=SM_result("SELECT * FROM skedmaker_services WHERE live='y'");



			foreach($result as $row){



				$service_code=SM_d($row['code']);



				$service_val=$_POST["service".$service_code];



				if($service_val!=""){



					$final_services.=$service_val."~~~~~~~";



				}



			}



			$services=$final_services;



		}







		if($requirename=="y" && $client_name==""){$errorMessage="name"; $errorName="y";}



		if($require_client_address=="y" && ($client_address=="" || $client_city=="" || $client_state=="" || $client_zip=="")){$errorMessage="address"; $errorAddress="y";}



		if($loginValidClient!="y" && $requireemail=="y" && $client_email==""){$errorMessage="email"; $errorEmail="y";}



		if($loginValidClient!="y" && $requireemail=="y" && $requireconfirm=="y" && $client_email!=$confirm_email){$errorMessage="confemail"; $errorEmail="y"; $errorConfirmEmail="y";}



		if($loginValidClient!="y" && $requireemail=="y" && $requireconfirm=="y" && $confirm_email==""){$errorMessage="y"; $errorEmail="y"; $errorConfirmEmail="y";}



		if($loginValidClient!="y" && $requireemail=="y" && !eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $client_email)){$errorMessage="emailvalid";  $errorEmail='y'; $errorValid="y";}



		if($loginValidClient!="y" && $requirephone=="y" && $client_phone==""){$errorMessage="y"; $errorPhone="y";}



		if($requiremessage=='y' && $client_content==""){$errorMessage="y"; $errorContent="y";}



		if($requireservices=="y" && $services==""){$errorMessage="services"; $errorServices="y";}







		if($errorMessage==""){



			$final_address=$client_address." ".$client_city.", ".$client_state." ".$client_zip;



			



			$client_lat=SM_lat($final_address);



			$client_lon=SM_lon($final_address);



			



			$client_name=SM_e($client_name);



			$client_email=SM_e($client_email);



			$confirm_email=SM_e($confirm_email);



			$client_phone=SM_e($client_phone);



			$num_in_party=SM_e($num_in_party);



			$client_content=SM_e($client_content);



			$services=SM_e($services);







			if($num_in_party==""){$num_in_party="1";}







			$DBcode=SM_code();



			$canCode=$DBcode;



			



			if($ip==""){$ip="NA";}



			if($usercode==""){$usercode="NA";}



			if($datecode==""){$datecode="NA";}



			if($phone==""){$phone="NA";}



			if($services==""){$services="NA";}



			if($client_address==""){$client_address="NA";}



			if($client_address2==""){$client_address2="NA";}



			if($client_city==""){$client_city="NA";}



			if($client_state==""){$client_state="NA";}



			if($client_zip==""){$client_zip="NA";}



			if($client_lat==""){$client_lat="NA";}



			if($client_lon==""){$client_lon="NA";}







//			$saveIt=$wpdb->insert("skedmaker_sked", array("ip"=>$ip, "name"=>$client_name, "email"=>$client_email, "phone"=>$client_phone, "numberinparty"=>$num_in_party, "services"=>$services, "usercode"=>$usercode, "startdate"=>$ts, "code"=>$DBcode, "datecode"=>$datecode, "client_address"=>$client_address, "client_address2"=>$client_address2, "client_city"=>$client_city, "client_state"=>$client_state, "client_zip"=>$client_zip, "client_lat"=> $client_lat, "client_lon"=> $client_lon, "content"=>$client_content));







			$saveIt=$wpdb->insert("skedmaker_sked", array("ip"=>$ip, "name"=>$client_name, "email"=>$client_email, "phone"=>$client_phone, "numberinparty"=>$num_in_party, "services"=>$services, "usercode"=>$usercode, "startdate"=>$ts, "code"=>$DBcode, "datecode"=>$datecode, "content"=>$client_content));







			if(!$saveIt){



				SM_redBox("Sorry, could not reserve the appointment... Please try again laterzzzzzzzzzzzzzzzz.", "100%", 16);



				SM_foot();



			}else{



				//======= SUCCESSFULLY BOOKED!



				SM_greenBox("Your Appointment is Reserved!", "100%", 21); ?>



				<table class='cc100' style='border-collapse:separate; margin-top:14px;'>



				<tr><td class='blueBanner1'><?php if($username!=""){echo SM_d($username);}else{echo SM_d($client_name);}?>, your appointment details are below</td></tr>



				<tr><td class='blueBanner2' style='padding:7px;'>



				<?php if(is_admin()){SM_menu();} ?>



				<table class='cc100' style='border-collapse:separate;'>



				<tr><td style='text-align:center; border:0px; padding-bottom:0px;'><img src='<?php echo $sm_btns_dir;?>btn_chair32_reg.png' style='border:0px; margin-right:14px; vertical-align:middle;' /><span style='font-size:21px; font-weight:bold;'><?php echo $showApt; ?></span></td></tr>



				<?php 



				if($loginValidClient=="y"){



					$result=SM_result("SELECT * FROM skedmaker_clients WHERE code='$usercode' LIMIT 1");



					foreach($result as $row){$client_email=SM_d($row['email']);}



				}



				if($client_email!=""){?>



					<tr><td style='border:0px; text-align:center;'>



					<span style='font-weight:bold; font-size:18px;'>A confirmation e-mail was sent to: <br /><?php echo SM_d($client_email);?></span><br /><br />



					<b>This e-mail will also provide a cancellation link, should you need to reschedule.</b>



					</td></tr>



				<?php } ?>



				<?php if($loginValid!="admin"){ ?>



				<tr><td class='sminput'>







                <table class='cc100' style='border-collapse:separate;'><tr>



                <td style='border:0px; width:50%; text-align:center;'>



				<div class='navMenuRound' <?php if(wp_is_mobile()){?>style='width:200px'<?php } ?>><a href='<?php echo SM_permalink();?>&amp;ts=<?php echo $_GET['ts'];?>&amp;#skedtop' class='sked'><img src='<?php echo $sm_btns_dir;?>btn_settings16_reg.png' class='btn' />Back to Schedule</a></div>



                </td>



                <?php if(wp_is_mobile()){ // jump to next line+?>



                </tr><tr>



                <?php } ?>



                <td style='border:0px; width:50%; text-align:center;'>



                <div class='navMenuRound'><a href='#' onClick='window.print();' title='Print' class='sked'><img src='<?php echo $sm_btns_dir;?>btn_print16_reg.png' class='btn'>Print this Appointment</a></div>



                </td></tr></table>







				</td></tr>



				<?php } ?>



				<tr><td class='nopadb2'>&nbsp;</td></tr>



				<?php 



				//-- no cancel if theres no email



				if($client_email!=""){?>



					<tr><td class='pad14b2'>You may cancel and reschedule your appointment by clicking below.</td></tr>



					<tr><td style='text-align:center; border:0px;'>



					<div class='navCancel'  <?php if(wp_is_mobile()){?>style='width:225px'<?php } ?>><a href='<?php echo SM_permalink();?>&amp;op=cancel&amp;aptc=<?php echo $canCode; ?>&amp;#skedtop' class='sked'><img src='<?php echo $sm_btns_dir;?>btn_cancel16_reg.png' class='btn'/>Cancel This Appointment</a></div>



					</td></tr>



					<?php if($cancelpolicy!=""){echo "<tr><td class='pad14'><span class='redText'>".$cancelpolicy."</span></td></tr>";} ?>



			   <?php } ?>



				</table>



				</td></tr></table>



				<?php







				//-- if client is logged in, get their info



				if($loginValidClient=="y"){



					$result=SM_result("SELECT * FROM skedmaker_clients WHERE code='$usercode' LIMIT 1");



					foreach($result as $row){



						$client_email=SM_d($row['email']);



						$client_name=SM_d($row['username']);



						$client_address=SM_d($row['client_address']);



						$client_address2=SM_d($row['client_address2']);



						$client_city=SM_d($row['client_city']);



						$client_state=SM_d($row['client_state']);



						$client_zip=SM_d($row['client_zip']);



					}



				}else{



					if($client_name==""){$client_name="n/a";}



				}



				if($client_phone==""){$client_phone="n/a";}



				if($client_content==""){$client_content="n/a";}



				



				//-- decode services and prepare list for email



				if($services!=""){



					$services=SM_d($services);



					if($services_list_style=="menu"){



						$services_for_email=SM_get_service_name($services);



					}else{



						$service_bits=explode("~~~~~~~", $services);



						foreach($service_bits as $ind_svc){



							if($ind_svc!=""){



								$services_for_email.=SM_get_service_name($ind_svc)."<br>";



							}



						}



					}



				}







				$cancel_url=SM_permalink()."&amp;op=cancel&amp;aptc=".$DBcode."&amp;#skedtop";







				$bodyData="<table class='cc800'>



				<tr><td class='pad7'><span class='header'>".$sitename."</span></td></tr>



				<tr><td class='blueBanner1'>An appointment was made with the following details</td></tr>



				<tr><td class='blueBanner2' style='padding-left:0px; padding-right:0px;'>



				<table class='cc100'>



				<tr><td class='label150'>Name:</td><td class='pad7' style='width:650px;'>".SM_d($client_name)."</td></tr>



				<tr><td class='label150'>Appointment:</td><td class='pad7' style='width:650px;'>".$showApt."</td></tr>



				<tr><td class='label150'>E-mail:</td><td class='pad7' style='width:650px;'><span style='font-weight:normal'>".SM_d($client_email)."</span></td></tr>



				<tr><td class='label150'>Phone:</td><td class='pad7' style='width:650px;'><span style='font-weight:normal'>".SM_d($client_phone)."</span></td></tr>";



				if($num_in_party>1){$bodyData.="<tr><td class='label150'># in Party:</td><td class='pad7' style='width:650px;'><span style='font-weight:normal'>".SM_d($num_in_party)."</span></td></tr>";}



				if($services!=""){$bodyData.="<tr><td class='label150'>Services:</td><td class='pad7' style='width:650px;'><span style='font-weight:normal'>".SM_d($services_for_email)."</span></td></tr>";}



				$bodyData.="<tr><td class='label150'>Message:</td><td class='pad7' style='width:650px;'><span style='font-weight:normal'>".SM_d($client_content)."</span></td></tr>



				<tr><td class='pad7' colspan='2'><a href='".$cancel_url."'>Click here if you need to cancel this appointment</a></td></tr>



				<tr><td class='pad7' colspan='2'><span class='redText'>".$cancelpolicy."</span></td></tr>



				</table>";



				$biz_info=SM_biz_info();



				$bodyData=$bodyData.$biz_info."</td></tr></table>";







				if(SM_emailIt(SM_d($client_email), $adminemail, "", "Appointment Scheduled- ".SM_d($client_name), $bodyData)===false){



					SM_redBox("Sorry, the e-mail could not be sent. Please try again later.", "100%", 18);



				}



				$success="y";



				SM_foot();



			}



		}



	}







	$skedname=SM_d($skedname);



	$skedemail=SM_d($skedemail);



	$skedconfirmemail=SM_d($skedconfirmemail);



	$skedphone=SM_d($skedphone);



	$skedmsg=SM_d($skedmsg);







	//==================================================================================================



	//======= CLIENT SCHEDULING



	//==================================================================================================



	if($_GET['v']!=""){



		$back=$smadmin."&amp;ts=".$_GET['ts'];



		$viewURL="&amp;v=".$_GET['v'];



	}else{



		$viewURL="";



		$back=SM_permalink()."&amp;op=sked&amp;ts=".$_GET['ts']."&amp;#skedtop";



	}







	if($success!="y"){



		if(is_admin()){



			$post_url=$smadmin."&v=skedclient&";



		}else{



			$post_url=SM_permalink();



		}



		?>



	<form id="form1" name="form1" method="post" action="<?php echo $post_url;?>&amp;op=confirm&amp;ts=<?php echo $_GET['ts'];?>&amp;#skedtop">



	<?php SM_uni_create();?>







   <table class='cc100'><tr><td class='pad7' style='vertical-align:middle; text-align:left;'><a href='' class='header'><img src='<?php echo $sm_btns_dir;?>btn_settings32_reg.png' class='btn'><?php echo $main_title_text;?></a></td></tr></table>







	<table class='cc100' style='border-collapse:separate;'>



    <?php if($errorMessage!=""){?><tr><td class='padalert'><?php SM_redBox("The information in red below is required...", "100%", 21); ?></td></tr><?php } ?>



	<tr><td class='padalert' style='border:0px; padding-bottom:14px;'><?php SM_greenBox($showApt, "100%", 21); ?></td></tr>



	<tr><td class="blueBanner1"><?php echo $b1_text;?></td></tr>



	<tr><td class="blueBanner2">



	<table class='cc100'>



	<tr><td class='pad7b2' colspan='2'><b>Complete the form below to reserve this appointment.</b></td></tr>



<?php 



//////////////////////////////////////////////////////////////////////////////////////////////////



// -- Get the client info



//////////////////////////////////////////////////////////////////////////////////////////////////



	if($loginValidClient=="y"){



		$result=SM_result("SELECT * FROM skedmaker_clients WHERE code='$usercode' LIMIT 1");



		foreach($result as $row){



			$client_email=SM_d($row['email']);



			$client_name=SM_d($row['name']);



			$client_phone=SM_d($row['phone']);



		}



		if($client_phone==""){$client_phone="n/a";}



	}?>



	<tr><td class='label200'><?php SM_check_text("Name: ", $errorName);?></td>



	<?php if($loginValidClient=="y"){?>



		<td class='sminput'><?php echo SM_d($username);?></td></tr>



<?php }else{ ?>



		<td class='sminput'><input name="client_name" type="text" class='form_textfield_confirm' value="<?php echo SM_d($client_name);?>" maxlength="100" /></td></tr>



<?php }	?>









	<?php 



	if($loginValidClient=="y"){?>


	<tr><td class='label200'><?php SM_check_text("E-mail: ", $errorEmail);?></td>
		<td class='sminput'><?php echo $client_email;?></td></tr>



<?php }else{ ?>



	<?php if($requireemail=="y"){?>


	<tr><td class='label200'><?php SM_check_text("E-mail: ", $errorEmail);?></td>
		<td class='sminput'><input name="client_email" type="text" class='form_textfield_confirm' value="<?php echo SM_d($client_email);?>" maxlength="100" /></td></tr>



<?php }



	}



	?>



	<?php if($errorValid=="y"){echo "<tr><td class='nopad'>&nbsp;</td><td class='sub-error'>Enter a valid email address.</td></tr>";}?>







	<?php if($requireconfirm=="y" && $loginValidClient!="y"){?>



        <tr><td class='label200'><?php SM_check_text("Confirm E-mail: ", $errorConfirmEmail);?></td>



        <td class='sminput'><input name="confirm_email" type="text" class='form_textfield_confirm' value="<?php echo SM_d($confirm_email);?>" maxlength="100"/></td></tr>



	<?php } ?>







	<?php if($errorConfirmEmail=="y"){echo "<tr><td class='nopad'>&nbsp;</td><td class='sub-error'>The e-mails do not match.</td></tr>";}?>







	<?php if($requirephone=='y' && $loginValidClient!="y"){ ?>



            <tr><td class='label200'><?php SM_check_text("Phone: ", $errorPhone);?></td>



            <td class='sminput'><input name="client_phone" type="text" class='form_textfield_confirm' value="<?php echo SM_d($client_phone);?>" maxlength="100" /></td></tr>



	<?php }else if($requirephone=="y" && $loginValidClient=="y"){ ?>



            <tr><td class='label200'><?php SM_check_text("Phone: ", $errorPhone);?></td>



            <td class='sminput'><?php echo $client_phone;?></td></tr>



	<?php } ?>	



	<?php if($requirenumberinparty=='y'){ ?>



	<tr><td class='label200'><?php SM_check_text("# in Party", $errorNumInParty);?></td>



	<td class='sminput'>



	<select name='num_in_party' class='form_select' style='margin-right:7px;'>



	<?php 







	//-- if custom, get number of multiple apts allowed



	if($_GET['dc']!=""){



		$DBdc=$_GET['dc'];



		$DBts=$_GET['ts'];



		$DBhour=date("H", $DBts);



		if($DBhour>10){$DBhour="0".$DBhour;}



		$DBmin=date("i", $DBts);



		$result=SM_result("SELECT * FROM skedmaker_custom_timeframes WHERE datecode='$DBdc' AND starthour='$DBhour' AND startminute='$DBmin' LIMIT 1");



		foreach($result as $row){$today_multiple=SM_d($row['multiple']);}



	}







	//======= REMAINING



	//-- count # of appointments already booked



	$result=SM_result("SELECT * FROM skedmaker_sked WHERE startdate='$ts'");



	foreach($result as $row){



		$this_total_taken=SM_d($row['numberinparty']);



		if($this_total_taken==""){$this_total_taken=1;}



		$total_taken=$total_taken+$this_total_taken;



	}







	//-- check if they have a max number set under "requirements"



	//-- this will change the number of multiple appointments available to $partymax 



	$remaining=$today_multiple-$total_taken;



	if($requirenumberinparty=="y" && $partymax!=""){if($remaining>=$partymax){$remaining=$partymax;}}







	if($remaining<$partymax){$show_partymax=$remaining;}else{$show_partymax=$partymax;}







	for($x=1; $x<=$remaining; $x++){ ?>



	<option value="<?php echo $x;?>" <?php if($x==$num_in_party){ ?> selected="selected" <?php } ?> ><?php echo $x;?></option>



	<?php } ?>



	</select>



    <?php if($requirenumberinparty=="y" && $partymax!=""){echo " Maximum party of ".$show_partymax." for this time.";}



//	echo "<br>partymax:".$partymax." - today_multiple:".$today_multiple." - total_taken:".$total_taken." - remaining:".$remaining;



	?>



	</td></tr>



	<?php } ?>







	<?php 



	//======= SERVICES



	if($requireservices=="y"){?>



	<tr><td class='label200'><?php SM_check_text("Select Service:", $errorServices);?></td>



    <td class='sminput'>



	<?php 



	//-- USE select box



	if($services_list_style=="select" || $services_list_style==""){ 



	?>



    <select name='services' class='form_select'>



    <option value="">Select Service...</option>



    <?php 



	$result=SM_result("SELECT * FROM skedmaker_services WHERE live='y'");



	foreach($result as $row){



		$this_service=SM_d($row['name']);



		$service_code=SM_d($row['code']);

	if($limited_services=="y"){
		$total_services_taken=SM_total("SELECT * FROM skedmaker_sked WHERE startdate='$ts' AND services='$service_code' LIMIT 1");
		if($total_services_taken>0){$block='y';}else{$block="";}
	}

	if($block!="y"){
		?>



       <option value="<?php echo $service_code;?>" <?php if($services==$service_code){ ?> selected="selected" <?php } ?> ><?php echo $this_service;?></option>


	<?php } ?>
	<?php } ?>



	</select>







    <?php 



	//-- use checkboxes



	}else{ 



	$result=SM_result("SELECT * FROM skedmaker_services WHERE live='y'");



	foreach($result as $row){



		$this_service=SM_d($row['name']);



		$service_code=SM_d($row['code']);







		if(strpos($services, $service_code)!== false){



			$check_this=" checked='checked' ";



		}else{



			$check_this="";



		}



	?>



	<input name="service<?php echo $service_code;?>" type="checkbox" id="SMsvc<?php echo $service_code;?>" value="<?php echo $service_code;?>" <?php echo $check_this;?>/>



	<label for="SMsvc<?php echo $service_code;?>"><?php echo $this_service;?></label><bR />	



    <?php



	 } ?> 



	<?php } ?>



    </td></tr>



	<?php } ?>    







   	<?php 



	



	//-- address required, client not logged in



	if($require_client_address=='y' && $loginValidClient!="y"){ ?>



			<tr><td class='label200'><?php SM_check_text("Address: ", $errorAddress);?></td>



			<td class='sminput'><input name="client_address" type="text" class='form_textfield_confirm' value="<?php echo SM_d($client_address);?>" maxlength="100" /></td></tr>



            



   			<tr><td class='label200'><?php SM_check_text("Apt/Suite: ", $errorAddress);?></td>



			<td class='sminput'><input name="client_address2" type="text" class='form_textfield_confirm' value="<?php echo SM_d($client_address2);?>" maxlength="100" /></td></tr>







   			<tr><td class='label200'><?php SM_check_text("City: ", $errorAddress);?></td>



			<td class='sminput'><input name="client_city" type="text" class='form_textfield_confirm' value="<?php echo SM_d($client_city);?>" maxlength="100" /></td></tr>







   			<tr><td class='label200'><?php SM_check_text("State: ", $errorAddress);?></td>



			<td class='sminput'><input name="client_state" type="text" class='form_textfield_confirm' value="<?php echo SM_d($client_state);?>" maxlength="100" /></td></tr>







   			<tr><td class='label200'><?php SM_check_text("Zip/Postal Code: ", $errorAddress);?></td>



			<td class='sminput'><input name="client_zip" type="text" class='form_textfield_confirm' value="<?php echo SM_d($client_zip);?>" maxlength="100" /></td></tr>







<?php 



	//-- address required, client logged in - get address info



	}else if($require_client_address=="y" && $loginValidClient=="y"){



		$result=SM_result("SELECT * FROM skedmaker_clients WHERE code='$usercode' LIMIT 1");



		foreach($result as $row){



			$client_address=SM_d($row['address']);



			$client_address2=SM_d($row['address2']);



			$client_city=SM_d($row['city']);



			$client_state=SM_d($row['state']);



			$client_zip=SM_d($row['zip']);



			$client_lat=SM_d($row['lat']);



			$client_lon=SM_d($row['lon']);



		}







		if($client_lat=="" && $client_lon==""){?>



			<tr><td class='label200'>Address:</td><td class='sminput'>



			<a href='<?php echo SM_permalink();?>?op=myaccount&#address'><span class='redText'>Please update your address to reserve this appointment</span></a>



            </td></tr>	



	<?php }else{ ?>



             <tr><td class='label200'><?php SM_check_text("Address: ", $errorAddress);?></td><td class='sminput'><?php echo $client_address;?></td></tr>



             <tr><td class='label200'><?php SM_check_text("Apt/Suite: ", $errorAddress);?></td><td class='sminput'><?php echo $client_address2;?></td></tr>



             <tr><td class='label200'><?php SM_check_text("City: ", $errorAddress);?></td><td class='sminput'><?php echo $client_city;?></td></tr>



             <tr><td class='label200'><?php SM_check_text("State: ", $errorAddress);?></td><td class='sminput'><?php echo $client_state;?></td></tr>



             <tr><td class='label200'><?php SM_check_text("Zip/Postal Code: ", $errorAddress);?></td><td class='sminput'><?php echo $client_zip;?></td></tr>



	<?php }



} ?>



    



	<?php if($requiremessage=='y'){ ?>



	<tr><td class='label200'><?php SM_check_text("Message:", $errorContent);?></td><td class='sminput'>



	<textarea name="client_content" id="textarea" <?php if(!wp_is_mobile()){?> cols="45" rows="5" <?php } ?>class='form_area' ><?php echo SM_d($client_content);?></textarea></td></tr>



	<?php } ?>







	<tr><td class='label200'>&nbsp;</td><td class='sminput'><input type="submit" name="button" onclick='savingShow()' id="mainSave" style='text-transform:none;' value="<?php echo $button_text;?>"/>



	<div id='savingShow' style='display:none; padding:0px;'><img src='<?php echo $sm_btns_dir;?>_btns/saving.gif' alt='Saving' style='border:0px; padding:0px;'></div>



	</td></tr>



	<tr><td class='label200'>&nbsp;</td><td class='sminput'><div class='navMenuRound' <?php if(!wp_is_mobile()){?> style='width:275px;'<?php } ?>><a href="<?php echo $back; ?>" class='sked'><img src='<?php echo $sm_btns_dir;?>btn_settings16_reg.png' class='btn' alt='Pick a different appointment'/><?php echo $go_back_text;?></a></div></td></tr>



	<?php if($cancelpolicy!=""){echo "<tr><td class='sminput' colspan='2'><span class='redText'>".$cancelpolicy."</td></tr></span>";}?>



	</table>



	</td></tr></table>



	</form>



<?php 



SM_foot();



}// end succes check