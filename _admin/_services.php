<?php
$op=$_GET['op'];
if($op=="activate" || $op=="deactivate"){
	$code=SM_e($_GET["c"]);
	
	if($op=="activate"){
		$live="y";
	}else if($op=="deactivate"){
		$live="n";
	}
	$saveIt=$wpdb->update("skedmaker_services", array("live"=>$live), array("code"=>$code));
	if(!$saveIt){
		SM_redBox("Count not ".ucwords($op)." this service. Try again later", 800, 21);
	}else{
		SM_greenBox(ucwords($op)."d the service.", 800, 21);
		SM_redirect($smadmin."&v=services&", 500);
		die();
	}
}

SM_delete_check("skedmaker_services");
SM_delete_confirm("skedmaker_services");

if ($_SERVER['REQUEST_METHOD']=='POST' && $_GET['v']=='services'){
	$errorMessage="";
	$service_name=SM_e($_POST['service_name']);
	if($service_name==""){$errorMessage="y"; $errorService="y";}
	if($errorMessage==""){
		if($_GET['c']!=""){
			$code=SM_e($_GET['c']);
			$saveIt=$wpdb->update("skedmaker_services", array("name"=>$service_name), array("code"=>$code));
			$save_message="Edited Service Info!";
		}else{
			$service_code=SM_code();
			$saveIt=$wpdb->insert("skedmaker_services", array("name"=>$service_name, "code"=>$service_code, "live"=>"y"));
			$save_message="Saved New Service!";
		}
		//-- save it
		if(!$saveIt){
			SM_redBox("Error saving, try again later.", 800, 21);
		}else{
			$redirect_to=$smadmin."&v=services&";
			SM_greenBox($save_message, 800, 21);
			SM_redirect($redirect_to, 500);
			die();
		}
	}
}
SM_title("Services", "btn_services32_reg.png", $smadmin."&amp;v=services&amp;");

if($_GET['c']==""){
	$button_text="Save New Service";
	$banner_text="New Service";
//-- editing
}else{
	$button_text="Save Edits";
	$banner_text="Edit Existing Service";
	$code=SM_e($_GET['c']);	
	$result=SM_result("SELECT * FROM skedmaker_services WHERE code='$code'");
	foreach($result as $row){
		$service_name=SM_d($row['name']);
	}
}
?>
<!-- ==================================================================================================
======= Services ========================================================
================================================================================================== -->
<form enctype="multipart/form-data" id="form1" name="form1" method="post" action="<?php echo $smadmin;?>&amp;v=services&amp;op=services&amp;&amp;c=<?php echo $_GET['c'];?>&amp;" style="margin-top:0px">
<?php if($_GET['c']!=""){SM_blueBox("You are editing this service. <br><br><a href='".$smadmin."&v=services&' class='skedblue'>Click here to create a new service.</span></a>", 800, 21); echo "<br>";}?>

<table class='cc800'><tr>
<td class='blueBanner1'><?php echo $banner_text;?></td></tr>
<tr><td class='blueBanner2'>

<table class='cc100'>
<tr><td class='pad10' colspan='2'>Enter a service for your clients to select when booking.</td></tr>

<tr><td class='label200'><?php SM_check_text("Name of Service:", $errorService);?></td>
<td class='sminput'><input name="service_name" type="text" value="<?php echo $service_name; ?>" maxlength="250" class="form_textfield" style='width:500px;'/></td></tr>

<tr>
<td style='text-align:center; padding:7px;'><div class='navMenuRound'><a href='<?php echo $smadmin."&amp;v=home&amp;";?>' class='sked'><img src='<?php echo $sm_btns_dir."btn_home16_reg.png";?>' class='btn'/>Admin Home</a></div></td>
<td class='sminput'><input type="submit" name="button" id="button" value="<?php echo $button_text;?>" /></td></tr>

</table></td></tr></table>
</form>
<br />

<?php 
$total_services=SM_total("SELECT * FROM skedmaker_services");
if($total_services<1){
	SM_grayBox("You have no services to list. Create a new service above...", 800, 21);
}else{
	function list_services($activated_deactivated){
		global $sm_btns_dir;
		global $smadmin;
		if($activated_deactivated=="Activated"){
			$result=SM_result("SELECT * FROM skedmaker_services WHERE live='y' ORDER BY name ");
			$total=SM_total("SELECT * FROM skedmaker_services WHERE live='y'");
			$banner_action="Activated";
			$banner_img="<img src='".$sm_btns_dir."btn_check_green16_reg.png' class='btn'>";
		}else{
			$result=SM_result("SELECT * FROM skedmaker_services WHERE live!='y' ORDER BY name");
			$total=SM_total("SELECT * FROM skedmaker_services WHERE live!='y'");
			$banner_action="Deactivated";
			$banner_img="<img src='".$sm_btns_dir."btn_block16_reg.png' class='btn'>";
		}
		if($total<1){
			SM_grayBox("No ".$banner_action." Services to list.", 800, 21);
		}else{
			if($total==1){$service_word="Service";}else{$service_word="Services";}
	
			echo "<table class='cc800'><tr><td class='pad7'><span style='font-size:16px;'>".$banner_img.$total." ".$banner_action." ".$service_word."</span></td><tr></table>";
			echo "<table class='cc800'><tr>";
			echo "<td class='tab-left' style='padding:7px; width:85%'>Service Name</td>";
			echo "<td class='tab-right' style='padding:7px; width:15%' colspan='3'>Actions</td>";
			echo "</tr>";
						
			foreach($result as $row){
				$service_name=SM_d($row['name']);
				$this_code=SM_d($row['code']);
				$stagger=SM_stagger($stagger);	
				echo "<td class='list_left'><div class='navNotes'><a href='".$smadmin."&v=services&op=edit&c=".$this_code."&' class='b2w'>".$service_name."</a></div></td>";
				
				echo "<td class='nopadcenter'><div class='navNotes'><a href='".$smadmin."&v=services&amp;op=edit&amp;c=".$this_code."&' title='Edit'><img src='".$sm_btns_dir."btn_edit16_reg.png' class='btn' title='Edit'></a></div></td>";

				if($activated_deactivated=="Activated"){
					echo "<td class='list_center' style='padding:0px; border:0px;'><div class='navNotes'><a href='".$smadmin."&v=services&amp;op=deactivate&amp;c=".$this_code."&' title='Deactivate'><img src='".$sm_btns_dir."btn_block16_reg.png' class='btn' title='Deactivate'></div></a></td>";
					echo "<td class='list_right'>&nbsp;</td>";
				}else{
					echo "<td class='nopad' style='padding:0px;'><div class='navNotes'><a href='".$smadmin."&v=services&amp;op=activate&amp;c=".$this_code."&' title='Activate'><img src='".$sm_btns_dir."btn_check_green16_reg.png' class='btn' title='Activate'></a></div></td>";
					echo "<td class='list_right' style='padding:0px;'><div class='navNotes'><a href='".$smadmin."&v=services&amp;op=delete&amp;c=".$this_code."&' title='Delete'><img src='".$sm_btns_dir."btn_delete16_reg.png' class='btn' title='Delete'></a></div></td>";				
				}
				echo "</tr>";
			}
			echo "<tr><td colspan='3' class='tab-bottom-left'>&nbsp;</td><td class='tab-bottom-right'</td></tr>"; 
			echo "</table>";
		}
	}
	list_services("Activated");
	echo "<br><br>";
	list_services("Deactivated");
}


