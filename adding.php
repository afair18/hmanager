<?php
error_reporting(E_ERROR | E_PARSE);
include('config.php');
session_start();
// here includes language file pack
include ('language.php');
//
include('inc/security.php');
if (isset($_POST['addnewentries'])) {
$_POST = sanitize($_POST);
$_GET  = sanitize($_GET);
	
    if (!empty($_POST)) {
        $domnameEmpty      = null;
        $domregistrarEmpty = null;
        $domregdateEmpty   = null;
        $domexpdateEmpty   = null;
        $hostnameEmpty     = null;
        $hosturlEmpty      = null;
        $hostregdateEmpty  = null;
        $hostexpdateEmpty  = null;
        $adminmailEmpty    = null;
        $adminmobileEmpty  = null;
        $mailindalertNull  = null;
        $smsindalertNull   = null;
        $vipindalertNull   = null;
    } //!empty($_POST)
    $domname      = $_POST['domname'];
    $domregistrar = $_POST['domregistrar'];
    $domregdate   = $_POST['domregdate'];
    $domexpdate   = $_POST['domexpdate'];
    $hostname     = $_POST['hostname'];
    $h_status     = $_POST['h_status'];
    $hosturl      = $_POST['hosturl'];
    $hostregdate  = $_POST['hostregdate'];
    $hostexpdate  = $_POST['hostexpdate'];
    $adminmail    = $_POST['adminmail'];
    $adminmobile  = $_POST['adminmobile'];
    $mailindalert = $_POST['mailindalert'];
    $smsindalert  = $_POST['smsindalert'];
    $vipindalert  = $_POST['vipindalert'];
    $valid        = true;
    //if (empty($domname)) {
    //    $domnameEmpty = $LngdomnameEmpty;
    //    $valid        = false;
    //} //empty($domname)
    //if (empty($domregistrar)) {
    //    $domregistrarEmpty = $LngdomregistrarEmpty;
    //    $valid             = false;
    //} //empty($domregistrar)
    //if (empty($domexpdate)) {
    //    $domexpdateEmpty = $LngdomexpdateEmpty;
    //    $valid           = false;
    //} //empty($domexpdate)
    //if (empty($hostname)) {
    //    $hostnameEmpty = $LnghostnameEmpty;
    //    $valid         = false;
    //} //empty($hostname)
    //if (empty($hostexpdate)) {
    //   $hostexpdateEmpty = $LnghostexpdateEmpty;
    //    $valid            = false;
    //} //empty($hostexpdate)
    if (empty($adminmail)) {
        $adminmailEmpty = $LngadminmailEmpty;
        $valid          = false;
    } //empty($adminmail)
    else if (!filter_var($adminmail, FILTER_VALIDATE_EMAIL)) {
        $adminmailEmpty = $LngadminmailEmpty2;
        $valid          = false;
    } //!filter_var($adminmail, FILTER_VALIDATE_EMAIL)	
    if ($valid) {
        $mailindalert = $_POST['mailindalert'];
        $smsindalert  = $_POST['smsindalert'];
        $vipindalert  = $_POST['vipindalert'];
        $sql          = "INSERT INTO dbcontent (domname, domregistrar, domregdate, domexpdate, hostname, hosturl, hostregdate, hostexpdate, adminmail, adminmobile, mailindalert, smsindalert, vipindalert) VALUES ('$domname', '$domregistrar', '$domregdate', '$domexpdate', '$hostname', '$hosturl', '$hostregdate', '$hostexpdate', '$adminmail', '$adminmobile','$mailindalert' ,'$smsindalert' , '$vipindalert')";
        $query        = mysql_query($sql);
        header("Location: index.php");
    } //$valid
} //isset($_POST['addnewentries'])
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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo $LngAddNewTitle ?></title>
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/datepicker.css" rel="stylesheet">
<link href="css/default.css" rel="stylesheet" type="text/css" id="style_color"/>
  	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
</head>

<body>
    <div class="container">
    
     <div class="span10 offset1">
  <div class="form-actions">
     <div class="row">
                    <center>
     <h3>&nbsp;&nbsp;<?php echo $LngAddNewPage ?></h3>
                    </center>    
     </div>
     </div>
  <div class="form-actions">
     <form class="form-horizontal" action="adding.php" method="post">
<!-- /////////////// CREATE DOMAIN NAME //////////////////////////////// -->          
  <div class="control-group <?php
echo !empty($domnameEmpty) ? 'error' : '';
?>">
  <!-- <div style="display: inline; color: red"> -->
    <label class="control-label">*&nbsp;<?php echo $Lngdomname ?></label>
    <div class="controls">
       <input name="domname" type="text"  placeholder="<?php echo $Lngdomname ?>" value="<?php
echo !empty($domname) ? $domname : '';
?>">
       <?php
if (!empty($domnameEmpty)):
?>
       <span class="help-inline"><?php
    echo $domnameEmpty;
?></span>
       <?php
endif;
?>
    <!-- </div> -->
  </div>
  </div>
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->  
<!-- /////////////// CREATE DOMAIN domregistrar //////////////////////////////// -->          
  <div class="control-group <?php
echo !empty($domregistrarEmpty) ? 'error' : '';
?>">
  <!-- <div style="display: inline; color: red"> -->
    <label class="control-label"><?php echo $Lngdomregistrar ?></label>
    <div class="controls">
       <input name="domregistrar" type="text"  placeholder="<?php echo $Lngdomregistrar ?>" value="<?php
echo !empty($domregistrar) ? $domregistrar : '';
?>">
       <?php
if (!empty($domregistrarEmpty)):
?>
       <span class="help-inline"><?php
    echo $domregistrarEmpty;
?></span>
       <?php
endif;
?>
    <!-- </div> -->
  </div>
  </div>
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->  
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->  
<!-- ////// @@@@@@@@@@@@@@@@@@ DATEPICKER HERE @@@@@@@@@@@@@@@@@@/////// -->
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->  
<!-- /////////////// CREATE Registration Domain Date" //////////////////////////////// -->          
  <div class="control-group <?php
echo !empty($domregdateEmpty) ? 'error' : '';
?>">
    <label class="control-label"><?php echo $Lngdomregdate ?></label>
    <div class="controls">
<div class="input-append date" id="dp1" data-date="" data-date-format="dd.mm.yyyy">
<input name="domregdate"  size="16" type="text"  placeholder="<?php echo $Lngdomregdate ?>" value="<?php
echo !empty($domregdate) ? $domregdate : '';
?>">
<span class="add-on"><i class="icon-calendar"></i></span>
           <?php
if (!empty($domregdateEmpty)):
?>
       <span class="help-inline"><?php
    echo $domregdateEmpty;
?></span>
       <?php
endif;
?>
    </div>
    </div>
  </div>
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->  
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->  
<!-- ////// @@@@@@@@@@@@@@@@@@ DATEPICKER HERE @@@@@@@@@@@@@@@@@@/////// -->
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->  
<!-- /////////////// CREATE Expiration Domain Date" //////////////////////////////// -->          
  <div class="control-group <?php
echo !empty($domexpdateEmpty) ? 'error' : '';
?>">
  <!-- <div style="display: inline; color: red"> -->
    <label class="control-label"><?php echo $Lngdomexpdate?></label>
    <div class="controls">
<div class="input-append date" id="dp2" data-date="" data-date-format="dd.mm.yyyy">
<input name="domexpdate" size="16" type="text"  placeholder="<?php echo $Lngdomexpdate?>" value="<?php
echo !empty($domexpdate) ? $domexpdate : '';
?>">
<span class="add-on"><i class="icon-calendar"></i></span>
       <?php
if (!empty($domexpdateEmpty)):
?>
       <span class="help-inline"><?php
    echo $domexpdateEmpty;
?></span>
       <?php
endif;
?>
    <!-- </div> -->
    </div>
  </div>
  </div>
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->  
<!-- /////////////// CREATE Hosting Name //////////////////////////////// -->          
  <div class="control-group <?php
echo !empty($hostnameEmpty) ? 'error' : '';
?>">
 <!-- <div style="display: inline; color: red"> -->
    <label class="control-label"><?php echo $Lnghostname ?></label>
    <div class="controls">
       <input name="hostname" type="text"  placeholder="<?php echo $Lnghostname ?>" value="<?php
echo !empty($hostname) ? $hostname : '';
?>">
       <?php
if (!empty($hostnameEmpty)):
?>
       <span class="help-inline"><?php
    echo $hostnameEmpty;
?></span>
       <?php
endif;
?>
  <!--  </div> -->
  </div>
  </div>
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ --> 
<!-- /////////////// CREATE HOST URL //////////////////////////////// -->          
  <div class="control-group <?php
echo !empty($hosturlEmpty) ? 'error' : '';
?>">
    <label class="control-label"><?php echo $Lnghosturl ?></label>
    <div class="controls">
       <input name="hosturl" type="text"  placeholder="<?php echo $Lnghosturl ?>" value="<?php
echo !empty($hosturl) ? $hosturl : '';
?>">
       <?php
if (!empty($hosturlEmpty)):
?>
       <span class="help-inline"><?php
    echo $hosturlEmpty;
?></span>
       <?php
endif;
?>
    </div>
  </div>
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->  
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->  
<!-- ////// @@@@@@@@@@@@@@@@@@ DATEPICKER HERE @@@@@@@@@@@@@@@@@@/////// -->
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->  
<!-- /////////////// CREATE Registration Hosting Date //////////////////////////////// -->          
  <div class="control-group <?php
echo !empty($hostregdateEmpty) ? 'error' : '';
?>">
    <label class="control-label"><?php echo $Lnghostregdate ?></label>
    <div class="controls">
<div class="input-append date" id="dp3" data-date="" data-date-format="dd.mm.yyyy">
<input name="hostregdate" size="16" type="text"  placeholder="<?php echo $Lnghostregdate ?>" value="<?php
echo !empty($hostregdate) ? $hostregdate : '';
?>">
<span class="add-on"><i class="icon-calendar"></i></span>
       <?php
if (!empty($hostregdateEmpty)):
?>
       <span class="help-inline"><?php
    echo $hostregdateEmpty;
?></span>
       <?php
endif;
?>
    </div>
    </div>
  </div>
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->  
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->  
<!-- ////// @@@@@@@@@@@@@@@@@@ DATEPICKER HERE @@@@@@@@@@@@@@@@@@/////// -->
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->  
<!-- /////////////// CREATE Expiration Hosting Date //////////////////////////////// -->          
  <div class="control-group <?php
echo !empty($hostexpdateEmpty) ? 'error' : '';
?>">
 <!-- <div style="display: inline; color: red"> -->
    <label class="control-label"><?php echo $Lnghostexpdate ?></label>
    <div class="controls">
<div class="input-append date" id="dp4" data-date="" data-date-format="dd.mm.yyyy">
<input name="hostexpdate" size="16" type="text"  placeholder="<?php echo $Lnghostexpdate ?>" value="<?php
echo !empty($hostexpdate) ? $hostexpdate : '';
?>">
<span class="add-on"><i class="icon-calendar"></i></span>
       <?php
if (!empty($hostexpdateEmpty)):
?>
       <span class="help-inline"><?php
    echo $hostexpdateEmpty;
?></span>
       <?php
endif;
?>
    <!--</div> -->
    </div>
  </div>
  </div>
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->  
       
<!-- /////////////// CREATE ADMIN EMAIL //////////////////////////////// -->          
  <div class="control-group <?php
echo !empty($adminmailEmpty) ? 'error' : '';
?>">
  <div style="display: inline; color: red">
    <label class="control-label">*&nbsp;<?php echo $Lngadminmail ?></label>
    <div class="controls">
       <input name="adminmail" type="text" placeholder="<?php echo $Lngadminmail ?>" value="<?php
echo !empty($adminmail) ? $adminmail : '';
?>">&nbsp;**&nbsp;<?php echo $LngadminmailREAL ?>
       <?php
if (!empty($adminmailEmpty)):
?>
       <span class="help-inline"><?php
    echo $adminmailEmpty;
?></span>
       <?php
endif;
?>
    </div>
  </div>
  </div>
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<!-- /////////////// CREATE ADMIN MOBILE //////////////////////////////// -->          
  <div class="control-group <?php
echo !empty($adminmobileEmpty) ? 'error' : '';
?>">
    <label class="control-label"><?php echo $Lngadminmobile ?></label>
    <div class="controls">
       <input name="adminmobile" type="text"  placeholder="<?php echo $Lngadminmobile ?>" value="<?php
echo !empty($adminmobile) ? $adminmobile : '';
?>">
       <?php
if (!empty($adminmobileEmpty)):
?>
       <span class="help-inline"><?php
    echo $adminmobileEmpty;
?></span>
       <?php
endif;
?>
    </div>
  </div>
<div style="float: left;"> 
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php
$isDataThere1 = $mailindalert;
echo '<span style="color:green ;text-align:center;">'.$LngadminmailSEND.'&nbsp;</span>' . '<input name="mailindalert" type="checkbox" ' . ($isDataThere1 ? ' checked' : '') . ' placeholder="1" value="1">';
?> 
 
            </div>
                     </br>
                      </br>
                      <center>
  <a class="btn" href="index.php">&nbsp;<?php echo $LngHome ?>&nbsp;</a>&nbsp;
                          
  <button type="submit" class="btn btn-success" name="addnewentries">&nbsp;<?php echo $LngSave ?>&nbsp;</button>
                       </center>  
                         </form>                    
</div>
</div>
    </div> <!-- /container -->
    
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
    
  </body>
</html>