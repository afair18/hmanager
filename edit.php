eeeeeddd
11122
<?php
error_reporting(E_ERROR | E_PARSE);
include('config.php');
session_start();
// here includes language file pack
include ('language.php');
//
if (isset($_GET['editentries'])) {
    include('inc/security.php');
} //isset($_GET['editentries'])
if (isset($_POST['entries'])) {
    $profileid = $_POST['entries'];
} //isset($_POST['entries'])
if (isset($_GET['entries'])) {
    $profileid = $_GET['entries'];
    $sview     = $profileid;
} //isset($_GET['entries'])
		$query = "select * from dbcontent where id = '" . $profileid . "'";
		$result = mysql_query($query, $connection) or die(mysql_error());
		$info         = mysql_fetch_assoc($result);
		$id           = $info['id'];
		$domname      = $info['domname'];
		$hostname     = $info['hostname'];
		$contactid    = $info['contactid'];
		$domregdate   = $info['domregdate'];
		$domexpdate   = $info['domexpdate'];
		$domregistrar = $info['domregistrar'];
		$hostregdate  = $info['hostregdate'];
		$adminmobile  = $info['adminmobile'];
		$adminmail    = $info['adminmail'];
		$hosturl      = $info['hosturl'];
		$hostexpdate  = $info['hostexpdate'];
		$mailindalert = $info['mailindalert'];
		$smsindalert  = $info['smsindalert'];
		$vipindalert  = $info['vipindalert'];
if ($vip == 1) {
    $sp  = "checked";
    $ord = "";
} //$vip == 1
else {
    $sp  = "";
    $ord = "checked";
}
if (isset($_POST['editentriesdata'])) {
    include('inc/security.php');
	
$_POST = sanitize($_POST);
$_GET  = sanitize($_GET);
	
    if (!empty($_POST)) {
        $domnameNull      = null;
        $domregistrarNull = null;
        $domregdateNull   = null;
        $domexpdateNull   = null;
        $hostnameNull     = null;
        $hostexpdateNull  = null;
        $adminmailNull    = null;
        $adminmobileNull  = null;
        $mailindalertNull = null;
        $smsindalertNull  = null;
        $vipindalertNull  = null;
    } //!empty($_POST)
    $id           = $_POST['id'];
    $domname      = $_POST['domname'];
    $domregistrar = $_POST['domregistrar'];
    $domregdate   = $_POST['domregdate'];
    $domexpdate   = $_POST['domexpdate'];
    $hostname     = $_POST['hostname'];
    $hostexpdate  = $_POST['hostexpdate'];
    $adminmail    = $_POST['adminmail'];
    $adminmobile  = $_POST['adminmobile'];
    $mailindalert = $_POST['mailindalert'];
    $smsindalert  = $_POST['smsindalert'];
    $vipindalert  = $_POST['vipindalert'];
    $valid        = true;
    //if (empty($domname)) {
    //    $domnameNull = 'Please enter Domain Name';
    //    $valid       = false;
    //} //empty($domname)
    //if (empty($domregistrar)) {
    //    $domregistrarNull = 'Please enter Registrar Name';
    //    $valid            = false;
    //} //empty($domregistrar)
    //if (empty($domexpdate)) {
    //    $domexpdateNull = 'Please enter Domain Expiration Date';
    //    $valid          = false;
    //} //empty($domexpdate)
    //if (empty($hostname)) {
    //    $hostnameNull = 'Please enter Hosting Name';
    //    $valid        = false;
    //} //empty($hostname)
    //if (empty($hostexpdate)) {
    //    $hostexpdateNull = 'Please enter Hosting Expiration Date';
    //    $valid           = false;
    //} //empty($hostexpdate)
    if (empty($adminmail)) {
        $adminmailNull = 'Please enter Admin adminmail Address';
        $valid         = false;
    } //empty($adminmail)
    $editid        = $_POST['editid'];
    $eid           = $_POST['id'];
    $edomname      = $_POST['domname'];
    $ehostname     = $_POST['hostname'];
    $econtactid    = $_POST['contactid'];
    $edomregdate   = $_POST['domregdate'];
    $edomexpdate   = $_POST['domexpdate'];
    $edomregistrar = $_POST['domregistrar'];
    $ehostregdate  = $_POST['hostregdate'];
    $eadminmobile  = $_POST['adminmobile'];
    $eadminmail    = $_POST['adminmail'];
    $ehosturl      = $_POST['hosturl'];
    $ehostexpdate  = $_POST['hostexpdate'];
    $emailindalert = $_POST['mailindalert'];
    $esmsindalert  = $_POST['smsindalert'];
    $evipindalert  = $_POST['vipindalert'];
    if ($evip == "sp") {
        $evip = 1;
    } //$evip == "sp"
    else {
        $evip = 0;
    }
    if ($valid) {
        $sql   = "UPDATE dbcontent SET domname='" . $edomname . "', hostname='" . $ehostname . "', contactid='" . $econtactid . "', domregdate='" . $edomregdate . "', domexpdate='" . $edomexpdate . "', vip='" . $evip . "', domregistrar='" . $edomregistrar . "', hostregdate='" . $ehostregdate . "', adminmobile='" . $eadminmobile . "', adminmail='" . $eadminmail . "', hosturl='" . $ehosturl . "', hostexpdate='" . $ehostexpdate . "', mailindalert='" . $emailindalert . "',  smsindalert='" . $esmsindalert . "',  vipindalert='" . $evipindalert . "' WHERE id='" . $editid . "'";
        $query = mysql_query($sql);
        header('Location: index.php');
        exit();
    } //$valid
    header('Location: edit.php?entries=' . $editid . '&editentries=1');
} //isset($_POST['editentriesdata'])
//////// SANITIZE 
function cleanInput($input)
{
    $search = array(
        '@<script[^>]*?>.*?</script>@si',
        '@<[\/\!]*?[^<>]*?>@si',
        '@<style[^>]*?>.*?</style>@siU',
        '@<![\s\S]*?--[ \t\n\r]*>@'
    );
    $output = preg_replace($search, '', $input);
    return $output;
}
function sanitize($input)
{
    if (is_array($input)) {
        foreach ($input as $var => $val) {
            $output[$var] = sanitize($val);
        } //$input as $var => $val
    } //is_array($input)
    else {
        if (get_magic_quotes_gpc()) {
            $input = stripslashes($input);
        } //get_magic_quotes_gpc()
        $input  = cleanInput($input);
        $output = mysql_real_escape_string($input);
    }
    return $output;
}
$_POST = sanitize($_POST);
$_GET  = sanitize($_GET);
///////// END /////////
?>
<!DOCTYPE html>
<html lang="en">
    <meta charset="utf-8">
<title><?php echo $LngEditPageTitle ?></title>
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
<link   href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker.css" rel="stylesheet">
<link href="css/default.css" rel="stylesheet" type="text/css" id="style_color"/>
    	<!-- CONFIRM DELETE --> 
<script type="text/javascript">
function confirmDelete(delUrl) {
  if (confirm("Are you sure you want to delete this profile?                                                            All of the data will be removed permanently.")) {
    document.location = delUrl;
  }
}
</script>
</head>           
<body>
<div id="top"></div>
<div id="wrapper">

    <div class="container">
    
    			<div class="span10 offset1">
					<div class="form-actions">
    				<div class="row">
                  <center>
		    		<h3>
                    <?php echo $LngEditPage ?> "<?php echo( $info['domname'])?>" <?php echo $LngEditPage2 ?></h3>
		    		</center>
                  </div>
		    		</div>
					 <div class="form-actions">
	    			<form class="form-horizontal" method="POST" action="edit.php?entries="> <!-- %%% AICI REDIRECTIONAREA DUPA EDIT !!! -->
			<div class="apple_overlay" id="overlay">
				<div class="contentWrap"></div>
			</div>	
<?php if($_POST['editentries'] || isset($_GET['editentries']))  { 
//@@@@@@@@@@@@@@@@@@@@@@ BEGIN EDITING entries @@@@@@@@@@@@@@@@@@@@@@@@@@@@

?>
		<form id="entries-form" name="entries-form" enctype="multipart/form-data" method="POST" action="">
<!-- /////////////// EDIT DOMAIN NAME //////////////////////////////// -->          
					  <!-- <div style="display: inline; color: red"> -->
                      <div class="control-group <?php echo !empty($domnameNull)?'error':'';?>">
    <label class="control-label"><?php echo $Lngdomname ?></label>
					      <div class="controls">
                      <input name="domname" type="text"  placeholder="<?php echo $Lngdomname ?>"     
                        value="<?php echo !empty($domname)?$domname:'';?>">
					      	<?php if (!empty($domnameNull)): ?>
					      		<span class="help-inline"><?php echo $domnameNull;?></span>
					      	<?php endif; ?>
					    <!-- </div> -->
					  </div>
					  </div>
<!-- /////////////// EDIT DOMAIN domregistrar //////////////////////////////// -->          
					  <!-- <div style="display: inline; color: red"> -->
					  <div class="control-group <?php echo !empty($domregistrarNull)?'error':'';?>">
    <label class="control-label"><?php echo $Lngdomregistrar ?></label>
					    <div class="controls">
	<input name="domregistrar" type="text"  placeholder="<?php echo $Lngdomregistrar ?>" value="<?php echo !empty($domregistrar)?$domregistrar:'';?>">
   					      	<?php if (!empty($domregistrarNull)): ?>
					      		<span class="help-inline"><?php echo $domregistrarNull;?></span>
					      	<?php endif; ?>
					    <!-- </div> -->
					    </div>
					  </div>
<!-- ////// @@@@@@@@@@@@@@@@@@ DATEPICKER HERE @@@@@@@@@@@@@@@@@@/////// -->
<!-- /////////////// EDIT Registration Domain Date" //////////////////////////////// -->          
					  <div class="control-group <?php echo !empty($domregdateNull)?'error':'';?>">
    <label class="control-label"><?php echo $Lngdomregdate ?></label>
					    <div class="controls">
				<div class="input-append date" id="dp1" data-date="" data-date-format="dd.mm.yyyy">
	<input name="domregdate"  size="16" type="text"  placeholder="<?php echo $Lngdomregdate ?>" value="<?php echo !empty($domregdate)?$domregdate:'';?>">
				<span class="add-on"><i class="icon-calendar"></i></span>
   					      	<?php if (!empty($domregdateNull)): ?>
					      		<span class="help-inline"><?php echo $domregdateNull;?></span>
					      	<?php endif; ?>
					    </div>
					    </div>
					  </div>
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->  
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->  
<!-- ////// @@@@@@@@@@@@@@@@@@ DATEPICKER HERE @@@@@@@@@@@@@@@@@@/////// -->
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->  
<!-- /////////////// EDIT Expiration Domain Date" //////////////////////////////// --> 
					  <!-- <div style="display: inline; color: red"> -->
					  <div class="control-group <?php echo !empty($domexpdateNull)?'error':'';?>">
    <label class="control-label"><?php echo $Lngdomexpdate?></label>
					    <div class="controls">
				<div class="input-append date" id="dp2" data-date="" data-date-format="dd.mm.yyyy">
	<input name="domexpdate" size="16" type="text"  placeholder="<?php echo $Lngdomexpdate?>"value="<?php echo !empty($domexpdate)?$domexpdate:'';?>">
				<span class="add-on"><i class="icon-calendar"></i></span>
					      	<?php if (!empty($domexpdateNull)): ?>
					      		<span class="help-inline"><?php echo $domexpdateNull;?></span>
					      	<?php endif; ?>
					    <!-- </div> -->
					    </div>
					  </div>
					  </div>
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->  
<!-- /////////////// EDIT Hosting Name //////////////////////////////// --> 
					  <!-- <div style="display: inline; color: red"> -->
					  <div class="control-group <?php echo !empty($hostnameNull)?'error':'';?>">
    <label class="control-label"><?php echo $Lnghostname ?></label>
					    <div class="controls">
	<input name="hostname" type="text"  placeholder="<?php echo $Lnghostname ?>" value="<?php echo !empty($hostname)?$hostname:'';?>">
					      	<?php if (!empty($hostnameNull)): ?>
					      		<span class="help-inline"><?php echo $hostnameNull;?></span>
					      	<?php endif; ?>
					    <!-- </div> -->
					  </div>
					  </div>
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ --> 
<!-- /////////////// EDIT HOST URL //////////////////////////////// -->          
					  <div class="control-group <?php echo !empty($hosturlNull)?'error':'';?>">
    <label class="control-label"><?php echo $Lnghosturl ?></label>
					    <div class="controls">
	 <input name="hosturl" type="text"  placeholder="<?php echo $Lnghosturl ?>" value="<?php echo !empty($hosturl)?$hosturl:'';?>">
                         <?php if (!empty($hosturlNull)): ?>
					      		<span class="help-inline"><?php echo $hosturlNull;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ --> 
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->  
<!-- ////// @@@@@@@@@@@@@@@@@@ DATEPICKER HERE @@@@@@@@@@@@@@@@@@/////// -->
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->  
<!-- /////////////// EDIT Registration Hosting Date //////////////////////////////// -->          
					  <div class="control-group <?php echo !empty($hostregdateNull)?'error':'';?>">
    <label class="control-label"><?php echo $Lnghostregdate ?></label>
					    <div class="controls">
				<div class="input-append date" id="dp3" data-date="" data-date-format="dd.mm.yyyy">
	<input name="hostregdate" size="16" type="text"  placeholder="<?php echo $Lnghostregdate ?>"value="<?php echo !empty($hostregdate)?$hostregdate:'';?>">
				<span class="add-on"><i class="icon-calendar"></i></span>
   					      	<?php if (!empty($hostregdateNull)): ?>
					      		<span class="help-inline"><?php echo $hostregdateNull;?></span>
					      	<?php endif; ?>
					    </div>
					    </div>
					  </div>
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->  
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->  
<!-- ////// @@@@@@@@@@@@@@@@@@ DATEPICKER HERE @@@@@@@@@@@@@@@@@@/////// -->
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->  
<!-- /////////////// EDIT Expiration Hosting Date //////////////////////////////// -->          
					  <div class="control-group <?php echo !empty($hostexpdateNull)?'error':'';?>">
					  <!-- <div style="display: inline; color: red"> -->
    <label class="control-label"><?php echo $Lnghostexpdate ?></label>
					    <div class="controls">
				<div class="input-append date" id="dp4" data-date="" data-date-format="dd.mm.yyyy">
	<input name="hostexpdate" size="16" type="text"  placeholder="<?php echo $Lnghostexpdate ?>" value="<?php echo !empty($hostexpdate)?$hostexpdate:'';?>">
				<span class="add-on"><i class="icon-calendar"></i></span>
					      	<?php if (!empty($hostexpdateNull)): ?>
					      		<span class="help-inline"><?php echo $hostexpdateNull;?></span>
					      	<?php endif; ?>
					    <!-- </div> -->
					    </div>
					  </div>
					  </div>
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->  
       
<!-- /////////////// EDIT ADMIN adminmail //////////////////////////////// -->          
					  <div class="control-group <?php echo !empty($adminmailNull)?'error':'';?>">
					  <div style="display: inline; color: red">
    <label class="control-label">*&nbsp;<?php echo $Lngadminmail ?></label>
					    <div class="controls">
	<input name="adminmail" type="text" placeholder="<?php echo $Lngadminmail ?>" value="<?php echo !empty($adminmail)?$adminmail:'';?>">
					      	<?php if (!empty($adminmailNull)): ?>
					      		<span class="help-inline"><?php echo $adminmailNull;?></span>
					      	<?php endif;?>
					    </div>
					  </div>
					  </div>
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<!-- /////////////// EDIT ADMIN MOBILE //////////////////////////////// -->          
					  <div class="control-group <?php echo !empty($adminmobileNull)?'error':'';?>">
    <label class="control-label"><?php echo $Lngadminmobile ?></label>
					    <div class="controls">
	<input name="adminmobile" type="text"  placeholder="<?php echo $Lngadminmobile ?>" value="<?php echo !empty($adminmobile)?$adminmobile:'';?>">
					      	<?php if (!empty($adminmobileNull)): ?>
					      		<span class="help-inline"><?php echo $adminmobileNull;?></span>
					      	<?php endif; ?>
					    </div>
					  </div>
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->          
<!-- /////////////// SEND MAIL ADMIN ALERT //////////////////////////////// -->  
		<div style="float: left;"> 
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<!--     <label class="control-label">EMAIL Send to Admin&nbsp;&nbsp;</label>-->
			<?php	
						$isDataThere1 = $mailindalert; // This should be decided by your database checks, this is just for demonstration.
					    echo '<span style="color:green ;text-align:center;">'.$LngadminmailSEND.'&nbsp;&nbsp;</span>'.'<input name="mailindalert" type="checkbox" '. ($isDataThere1 ? ' checked' : '') .' placeholder="1" value="1">';
            ?> 
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->          
<!-- /////////////// SEND SMS ADMIN ALERT //////////////////////////////// -->  

<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->          
<!-- /////////////// SEND VIP ALERT //////////////////////////////// -->
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="hidden" name="editid" value="<?php echo $profileid;?>"> <!-- %%%  AICI E SECRETUL SALVARII INFO - profileid !!!!!!! -->
					<!--<div style="float: left;"><input type="submit" name="deleteentries" value="Delete" class="button">	<input type="hidden" name="delid" value="<?php echo $profileid;?>"></div>-->
    </br>
    </br>

    			<div class="span9 offset3">
               <a class="btn" href="index.php">&nbsp;<?php echo $LngHome ?>&nbsp;</a> &nbsp; &nbsp;
               <input type="submit" name="editentriesdata" value="&nbsp;&nbsp;<?php echo $LngSave ?>&nbsp;&nbsp;" class="btn btn-success"></button>
				</div>
				</div>
				</form>
	<? } //END EDIT entries  ?>
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->             
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->             
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
	<script>
	if (top.location != location) {
    top.location.href = document.location.href ;
  }
		$(function(){
			window.prettyPrint && prettyPrint();
			$('#dp1').datepicker({
				format: 'dd.mm.yyyy'
			});
			$('#dp2').datepicker();
			$('#dp3').datepicker();
			$('#dp3').datepicker();
			$('#dpYears').datepicker();
			$('#dpMonths').datepicker();			
			var startDate = new Date(2012,1,20);
			var endDate = new Date(2012,1,25);
			$('#dp4').datepicker()
				.on('changeDate', function(ev){
					if (ev.date.valueOf() > endDate.valueOf()){
						$('#alert').show().find('strong').text('The start date can not be greater then the end date');
					} else {
						$('#alert').hide();
						startDate = new Date(ev.date);
						$('#startDate').text($('#dp4').data('date'));
					}
					$('#dp4').datepicker('hide');
				});
			$('#dp5').datepicker()
				.on('changeDate', function(ev){
					if (ev.date.valueOf() < startDate.valueOf()){
						$('#alert').show().find('strong').text('The end date can not be less then the start date');
					} else {
						$('#alert').hide();
						endDate = new Date(ev.date);
						$('#endDate').text($('#dp5').data('date'));
					}
					$('#dp5').datepicker('hide');
				});
        // disabling dates
        var nowTemp = new Date();
        var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

        var checkin = $('#dpd1').datepicker({
          onRender: function(date) {
            return date.valueOf() < now.valueOf() ? 'disabled' : ''; 
          }
        }).on('changeDate', function(ev) {
          if (ev.date.valueOf() > checkout.date.valueOf()) {
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() + 1);
            checkout.setValue(newDate);
          }
          checkin.hide();
          $('#dpd2')[0].focus();
        }).data('datepicker');
        var checkout = $('#dpd2').datepicker({
          onRender: function(date) {
            return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
          }
        }).on('changeDate', function(ev) {
          checkout.hide();
        }).data('datepicker');
	        var checkin = $('#dpd3').datepicker({
          onRender: function(date) {
            return date.valueOf() < now.valueOf() ? 'disabled' : '';  
          }
        }).on('changeDate', function(ev) {
          if (ev.date.valueOf() > checkout.date.valueOf()) {
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() + 1);
            checkout.setValue(newDate);
          }
          checkin.hide();
          $('#dpd4')[0].focus();
        }).data('datepicker');
        var checkout = $('#dpd4').datepicker({
          onRender: function(date) {
            return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
          }
        }).on('changeDate', function(ev) {
          checkout.hide();
        }).data('datepicker');
		});
	</script>
    
  </div>
  </div>    
</div>
</div>
</div>
</body>
</html>

