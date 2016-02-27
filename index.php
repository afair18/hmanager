<?php 
error_reporting(E_ERROR | E_PARSE);
if(!file_exists("config.php"))
  {
//  die("File not found");
echo '<META HTTP-EQUIV="Refresh" Content="0; URL=install.php">';
exit();
  }
else
  {
		include ('config.php');
		session_start();
// here includes language file pack
include ('language.php');
//include ('vesrion.php');
include('inc/security.php');
//
  
  }
				
if($_GET['delid']) 	 {
	include('inc/security.php');
	 $delid = $_GET['delid'];
	 	$sql = "DELETE from dbcontent WHERE id='".$delid."';";
	 	$query = mysql_query($sql);
			header('Location: index.php?deleted='.$delid);
			exit();
	 }; 
////////////////
if($_POST['entries'] || $_GET['entries'])  { 
if (isset($_POST['entries'])) { $profileid = $_POST['entries']; }
if (isset($_GET['entries'])) { $profileid = $_GET['entries']; $sview = $profileid;}
	$query = "select * from dbcontent where id = '".$profileid."'"; 
	$result = mysql_query($query,$connection) or die(mysql_error());
	$info = mysql_fetch_assoc($result);
	$id = $info['id'];
	$domname = $info['domname'];
	$hostname = $info['hostname'];
	$contactid = $info['contactid'];
	$deluser = $info['deluser'];
	$domregdate = $info['domregdate'];
	$domexpdate = $info['domexpdate'];
	$domregistrar = $info['domregistrar'];
	$hostregdate = $info['hostregdate'];
	$adminmobile = $info['adminmobile'];
	$adminmail = $info['adminmail'];
	$hosturl = $info['hosturl'];
	$hostexpdate = $info['hostexpdate'];	
	};
?>
<?php
///////// COUNTY NAME $visitorcountry ////////
function visitor_country()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];
    $result  = "Unknown";
    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));

    if($ip_data && $ip_data->geoplugin_countryName != null)
    {
        $result = $ip_data->geoplugin_countryName;
    }

    return $result;
}

$visitorcountry = visitor_country();
//echo visitor_country(); // Output Coutry name [Ex: United States]
//echo $visitorcountry;
///////// END COUNTRY NAME ///////////

////////////// VISITOR SYS $user_os  AND BROWSER  $user_browser
$user_agent     =   $_SERVER['HTTP_USER_AGENT'];

function getOS() { 

    global $user_agent;

    $os_platform    =   "Unknown OS Platform";

    $os_array       =   array(
                            '/windows nt 6.2/i'     =>  'Windows 8',
                            '/windows nt 6.1/i'     =>  'Windows 7',
                            '/windows nt 6.0/i'     =>  'Windows Vista',
                            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                            '/windows nt 5.1/i'     =>  'Windows XP',
                            '/windows xp/i'         =>  'Windows XP',
                            '/windows nt 5.0/i'     =>  'Windows 2000',
                            '/windows me/i'         =>  'Windows ME',
                            '/win98/i'              =>  'Windows 98',
                            '/win95/i'              =>  'Windows 95',
                            '/win16/i'              =>  'Windows 3.11',
                            '/macintosh|mac os x/i' =>  'Mac OS X',
                            '/mac_powerpc/i'        =>  'Mac OS 9',
                            '/linux/i'              =>  'Linux',
                            '/ubuntu/i'             =>  'Ubuntu',
                            '/iphone/i'             =>  'iPhone',
                            '/ipod/i'               =>  'iPod',
                            '/ipad/i'               =>  'iPad',
                            '/android/i'            =>  'Android',
                            '/blackberry/i'         =>  'BlackBerry',
                            '/webos/i'              =>  'Mobile'
                        );

    foreach ($os_array as $regex => $value) { 

        if (preg_match($regex, $user_agent)) {
            $os_platform    =   $value;
        }

    }   

    return $os_platform;

}

function getBrowser() {

    global $user_agent;

    $browser        =   "Unknown Browser";

    $browser_array  =   array(
                            '/msie/i'       =>  'Internet Explorer',
                            '/firefox/i'    =>  'Firefox',
                            '/safari/i'     =>  'Safari',
                            '/chrome/i'     =>  'Chrome',
                            '/opera/i'      =>  'Opera',
                            '/netscape/i'   =>  'Netscape',
                            '/maxthon/i'    =>  'Maxthon',
                            '/konqueror/i'  =>  'Konqueror',
                            '/mobile/i'     =>  'Handheld Browser'
                        );

    foreach ($browser_array as $regex => $value) { 

        if (preg_match($regex, $user_agent)) {
            $browser    =   $value;
        }

    }

    return $browser;

}


$user_os        =   getOS();
$user_browser   =   getBrowser();

//$device_details =   "<strong>Browser: </strong>".$user_browser."<br /><strong>Operating System: </strong>".$user_os."";
//
//print_r($device_details);
//
//echo("<br /><br /><br />".$_SERVER['HTTP_USER_AGENT']."");
////////// END USER OS AND BROWSER ////////
///////////////////////////////////////////
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
    
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />

    
    <meta charset="utf-8">
    <title><?php echo $LngMainPageTitle ?></title>

    <link   href="css/bootstrap.min.css" rel="stylesheet">

    <style>
		table { margin:10px auto; border-collapse:collapse; border:1px solid gray; }
		td,th { border:1px solid gray; text-align:left; padding:20px; }
		td.opt1 { text-align:center; vertical-align:middle; }
		td.opt2 { text-align:right; }
	</style>

<style>
.btn-custom1 { background-color: hsl(145, 62%, 80%) !important; background-repeat: repeat-x; filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#ffffff", endColorstr="#acebc6"); background-image: -khtml-gradient(linear, left top, left bottom, from(#ffffff), to(#acebc6)); background-image: -moz-linear-gradient(top, #ffffff, #acebc6); background-image: -ms-linear-gradient(top, #ffffff, #acebc6); background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #ffffff), color-stop(100%, #acebc6)); background-image: -webkit-linear-gradient(top, #ffffff, #acebc6); background-image: -o-linear-gradient(top, #ffffff, #acebc6); background-image: linear-gradient(#ffffff, #acebc6); border-color: #acebc6 #acebc6 hsl(145, 62%, 75%); color: #ccc !important; text-shadow: 0 1px 1px rgba(255, 255, 255, 0.33); -webkit-font-smoothing: antialiased; }
</style>	
	<!-- CONFIRM DELETE -->
<script type="text/javascript">
function confirmDelete(delUrl) {
  if (confirm("Are you sure you want to delete this profile?                                                            All of the data will be removed permanently.")) {
    document.location = delUrl;
  }
}
</script>
		<link rel="stylesheet" media="all" type="text/css" href="http://code.jquery.com/ui/1.10.0/themes/smoothness/jquery-ui.css" />
		<link rel="stylesheet" media="all" type="text/css" href="css/jquery-ui-timepicker-addon.css" />
		
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.0.min.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/ui/1.10.0/jquery-ui.min.js"></script>
		<script type="text/javascript">
			
			$(function(){
				$('#tabs').tabs();
		
				$('.example-container > pre').each(function(i){
					eval($(this).text());
				});
			});
			
		</script>
        
<script type="text/javascript">	
// Popup window code
function newPopupWide(url) {
	popupWindow360 = window.open(
		url,'popUpWindow360','height=500,width=1000,left10,top=10,resizable=yes,scrollbars=yes,toolbar=no,menubar=no,location=no,titlebar=no,directories=no,status=no').focus();}
</script>
	<link href="css/default.css" rel="stylesheet" type="text/css" id="style_color"/>            
</head>
<body>

<div id="top"></div>

<center>

<div class="container-fluid">
					  <div class="form-actions">
                      
           <div style="float: left;"><h4><img src="img/D&H.png" width="98" height="90"; style="display: inline;"/>
           &nbsp; &nbsp;&nbsp;&nbsp;&nbsp; 
           <?php echo $LngMainPage."&nbsp;&nbsp;".$version ?>
			</h4>
           </div>
           </div>
            
			<div class="row">
            
				<form id="entries-form" name="newentries" enctype="multipart/form-data" method="POST" action="adding.php?new=entries">
				<!--	<form id="entries-form" name="newentries" enctype="multipart/form-data" method="POST" action="adding.php">-->
					&nbsp;&nbsp;&nbsp;<input type="submit" name="newentries" value="<?php echo $LngAddNew ?>" class="btn btn-success">
					</form>                    
                <div style="float: left;">&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<?php if (!isset($_SESSION['valid_user'])) { 
			echo '<a class="btn btn-small btn-primary" href="login.php">'.$LngAdminLogin.'</a>';
			}?>
			<?php if (isset($_SESSION['valid_user']) && isset($sview)) { // Logged in // alternate
			if (isset($_SESSION['valid_user']) && isset($_GET['editentries'])) {
			}
//$LngAdminLogin = "Admin Login";
//$LngAdminLogout = "Admin Logout";
//$LngSettings = "Settings";
//$LngTestnow = "Test Now";
			};
			?>
			<?php if (isset($_SESSION['valid_user'])) { 
			echo '<a class="btn btn-small" href="logout.php">'.$LngAdminLogout.'</a>';
			}?>
           &nbsp;&nbsp;
       		<?php if (isset($_SESSION['valid_user'])) { 
           echo ' <a class="btn btn-small" href="settings.php">'.$LngSettings.'</a>';
			}?>
           &nbsp;&nbsp;
       		<?php if (isset($_SESSION['valid_user'])) { 
            echo ' <a class="btn btn-small btn-info" href="cron_test.php">'.$LngTestnow.'</a>';
			}?>
                   <div style="display: inline; color: gray">
                   &nbsp;&nbsp;&nbsp;&nbsp; 

                    &nbsp;<?php echo $LngTotal ?>:&nbsp;
                    <div style="display: inline; color: red">
					<?php					
                  $query = mysql_query("SELECT * FROM dbcontent");
					$number=mysql_num_rows($query);
					echo $number; 
					?></div>
                    &nbsp;&nbsp;<?php echo $LngEntries ?>.
                   <!-- </span>	-->
                   </div>
                   &nbsp;&nbsp;&nbsp;&nbsp; 
                   &nbsp;&nbsp;&nbsp;&nbsp; 
                
                
                </div>

                           <div style="float: right;">
			<a class="btn btn-small" href="JavaScript:newPopupWide('help/index.html');">&nbsp;<?php echo $LngHelp ?>&nbsp;</a>
            </div>

                  </div>           
				<table class="table table-striped table-bordered tabble-condensed">
                
		              <thead>
		                <tr>
		                  <th><?php echo $LngMenu1 ?></th><!-- Domains & Hostings Management</th> -->
		                  <th><?php echo $LngMenu2 ?></th><!-- Domain Name</th> -->
		                  <th><?php echo $LngMenu3 ?></th><!-- Days Left</th> -->
		                  <th><?php echo $LngMenu4 ?></th><!-- Domain Status</th> -->
                         <!-- table separator start -->
                         <th bgcolor="#d6dee0"></th>
                         <!-- table separator end -->
		                  <th><?php echo $LngMenu5 ?></th><!-- Hosting Name</th> -->
		                  <th><?php echo $LngMenu6 ?></th><!-- Days Left</th> -->
		                  <th><?php echo $LngMenu7 ?></th><!-- Hosting Status</th> -->
		                  <th><?php echo $LngMenu8 ?></th><!-- Send Mail</th> -->
                       </tr> 
 		              <tbody>
		              <?php 
 $data = mysql_query("SELECT * FROM dbcontent ORDER BY id DESC") 
 or die(mysql_error()); 

 while($info = mysql_fetch_array( $data )) 
 					{//a href="index.php?entries='.$sview.'&editentries=1" .$info['id']. 
////////  CALCULATE DOMAIN DAYS LEFT ////////////////////////
						$d_datenow = date("j.n.Y");
						$d_datetarget = $info['domexpdate'];
						$d_expflag = 0;
						$h_expflag = 0;
						$d_diff = strtotime($d_datetarget) - strtotime($d_datenow);
						if ($d_diff < 0) { $d_diff = 0; $d_expflag = 1;};
						$d_daysleft = floor(($d_diff - $years * 365*60*60*24 - $month*30*60*60*24)/ (60*60*24));
///////// END CALCULATE DOMAIN DAYS LEFT ////////////////
//////////// DOMAIN BUTTON TYPE ///////////// 
$d_btntype = '<a class="btn btn-small btn-success" href="list.php?entries='.$info['id'].'&editentries=1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$LngOK.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button></a>';			
if ($d_daysleft <= "31"){
$d_btntype = '<a class="btn btn-small btn-warning" href="http://'.$info['domregistrar'].'">&nbsp;'.$LngALLERT.'&nbsp;</button></a>';
if ($d_daysleft < "8")	{
$d_btntype = '<a class="btn btn-small btn-danger" href="http://'.$info['domregistrar'].'">&nbsp;'.$LngEXPIRE.'&nbsp;&nbsp;</button></a>';
}							
if ($d_daysleft == "0")	
{
$d_btntype = '<a class="btn btn-small btn-danger" href="http://'.$info['domregistrar'].'">&nbsp;'.$LngEXPIRE.'&nbsp;</button></a>';

	if ($d_expflag == 1) {
$d_btntype = '<a class="btn btn-small btn-custom1"; href="http://'.$info['domregistrar'].'">'.$LngEXPIRED.'</button></a>';
}
}							
};// BIIGER THAN 30 DAYS
//////////// END DOMAIN BUTTON TYPE ///////////// 
////////  CALCULATE HOSTING DAYS LEFT ////////////////////////
$h_datenow = date("j.n.Y");
$h_datetarget = $info['hostexpdate'];
$h_diff = strtotime($h_datetarget) - strtotime($h_datenow);
if ($h_diff < 0) { $h_diff = 0; $h_expflag = 1;};
$h_daysleft = floor(($h_diff - $years * 365*60*60*24 - $month*30*60*60*24)/ (60*60*24));
//////////// HOSTING BUTTON TYPE ///////////// 
$h_btntype = '<a class="btn btn-small btn-success" href="list.php?entries='.$info['id'].'&editentries=1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$LngOK.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button></a>';			
if ($h_daysleft <= "31")
{
$h_btntype = '<a class="btn btn-small btn-warning" href="http://'.$info['hostname'].'">&nbsp;'.$LngALLERT.'&nbsp;</button></a>';
if ($h_daysleft < "8") 
{
$h_btntype = '<a class="btn btn-small btn-danger" href="http://'.$info['hostname'].'">&nbsp;'.$LngEXPIRE.'&nbsp;</button></a>';
}							
if ($h_daysleft == 0) 
{
$h_btntype = '<a class="btn btn-small btn-danger" href="http://'.$info['hostname'].'">&nbsp;'.$LngEXPIRE.'&nbsp;</button></a>';

	if ($h_expflag == 1) {
$h_btntype = '<a class="btn btn-small btn-custom1"; href="http://'.$info['hostname'].'">'.$LngEXPIRED.'</button></a>';
}
}
};// BIIGER THAN 30 DAYS
//////////// END HOSTING BUTTON TYPE ///////////// 
	echo '<tr>';
	echo '<td width=250>';
				//echo '&nbsp;&nbsp;';
	echo '<a class="btn btn-small btn-info" href="list.php?entries='.$info['id'].'&editentries=1">'.$LngList.'&nbsp;&nbsp;&nbsp;<i class="icon-list"></i></button></a>';
	echo '&nbsp;&nbsp;';
	echo '<a class="btn btn-small btn-success" href="edit.php?entries='.$info['id'].'&editentries=1">'.$LngEdit.'&nbsp;&nbsp;&nbsp;<i class="icon-pencil"></i></button></a>';
	echo '&nbsp;&nbsp;';
	echo '<a class="btn btn-small btn-danger" href="remove.php?entries='.$info['id'].'&editentries=1">'.$LngDelete.'&nbsp;<i class="icon-remove"></i></button></a>';					
	echo '</td>';
 //Print "<tr>"; 	
	echo '<td>'. $info['domname'] . '</td>';
	echo '<td>'. $d_daysleft. '</td>';
	echo '<td>'. $d_btntype. '</td>';
///////////////////////////						
	echo '<td bgcolor="#d6dee0">'.'</td>';// table separator
	echo '<td>'. $info['hostname'] . '</td>';
	echo '<td>'. $h_daysleft. '</td>';
	echo '<td>'. $h_btntype. '</td>';
///////////////////////////						
	$isDataThere = $info['mailindalert']; // This should be decided by your database checks, this is just for demonstration.
	echo '<td>'.'<input type="checkbox" disabled ' . ($isDataThere ? 'checked' : '') . '>';
	echo '</tr>';
					};
?>
  </tbody>
 </thead>
 </table>


</div>
</center>













</div>




</body>
</html>
