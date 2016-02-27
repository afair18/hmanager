test112233
tt
eeeaddd
1212312
<?php
error_reporting(E_ERROR | E_PARSE);
include('config.php');
$query = "select * from settings";
$result = mysql_query($query, $connection) or die(mysql_error());
$info            = mysql_fetch_assoc($result);
$smssendmessage  = $info['smssendmessage'];
$beforexpirenote = $info['mailsendmessage'];
$mailalert       = $info['mailalert'];
$smsalert        = $info['smsalert'];
$sysmail         = $info['sysmail'];
//$sendname         = "codeofthefreedom@gmail.com";
//$sendname         = $sysmail;
$sysmobile       = $info['sysmobile'];
$today           = date("j.n.Y");
$weekdaynumber   = date("w");
$exalertvar      = array(
    "{expire alert}",
    "{exalert}"
);
$dateofexpirevar = array(
    "{dateofexpire}",
    "{expire date}"
);
$whatvar         = array(
    "{what}",
    "{what expire}"
);
$whoexpvar       = array(
    "{whoexp}",
    "{who expire}"
);
$whenvar         = array(
    "{when}",
    "{when expire}"
);
$whourlvar       = array(
    "{whourl}",
    "{whourl expire}"
);
$contactquery    = "SELECT * FROM dbcontent";
$contactview = mysql_query($contactquery, $connection) or die(mysql_error());
$contactview_results = mysql_num_rows($contactview);
while ($row = mysql_fetch_assoc($contactview)) {
    $mailindalert      = $row['mailindalert'];
    $smsindalert       = $row['smsindalert'];
    $whatxpdate        = $row['domexpdate'];
    $expdata           = explode(".", $whatxpdate);
    $wmcurdate         = explode(".", $today);
    $wcurrentdate      = $wmcurdate[0] . '.' . $wmcurdate[1] . '.' . $wmcurdate[2];
    $wcurrentdateday   = $wmcurdate[0];
    $wcurrentdatemonth = $wmcurdate[1];
    $wcurrentdateyear  = $wmcurdate[2];
    $datacorectata     = $expdata[0] . '.' . $expdata[1] . '.' . $expdata[2];
    $pDate                = strtotime($datacorectata . '-' . '1 week');
    $mDate                = strtotime($datacorectata . '-' . '1 month');
    $minus7days           = date('j.n.Y', $pDate);
    $wexpdata             = explode(".", $minus7days);
    $weekbeforemath       = $wexpdata[0] . '.' . $wexpdata[1] . '.' . $wexpdata[2];
    $weekbeforemathday    = $wexpdata[0];
    $weekbeforemathmonth  = $wexpdata[1];
    $weekbeforemathyear   = $wexpdata[2];
    $weekbefore           = $weekbeforemath;
    $minus30days          = date('j.n.Y', $mDate);
    $mexpdata             = explode(".", $minus30days);
    $monthbeforemath      = $mexpdata[0] . '.' . $mexpdata[1] . '.' . $mexpdata[2];
    $monthbeforemathday   = $mexpdata[0];
    $monthbeforemathmonth = $mexpdata[1];
    $monthbeforemathyear  = $mexpdata[2];
    $monthbefore          = $monthbeforemath;
    $flag1                = 0;
    $flag2                = 0;
    $alertcolor           = "GREEN";
    $whatexp              = "DOMAIN";
    $when                 = " AFTER 1 MONTH ";
    $whoexp               = $row['domname'];
    $whenexp              = $row['domexpdate'];
    $adminmail            = $row['adminmail'];
    $adminmobile          = $row['adminmobile'];
    $datenow              = date("j.n.Y");
    $diff                 = strtotime($whatxpdate) - strtotime($datenow);
    if ($diff < 0) {
        $diff  = 0;
        $flag2 = 1;
    } //$diff < 0
    $daysleft        = floor($diff / (60 * 60 * 24));
    $todaybeforemath = $expdata[0] . '.' . $expdata[1] . '.' . $expdata[2];
    $todaybefore     = $todaybeforemath;
    if ($flag2 == 0) {
        if ($monthbefore == $today) {
            $flag1       = 1;
            $alertcolor  = "YELLOW";
            $whatexp     = "DOMAIN";
            $when        = " AFTER 1 MONTH ";
            $whoexp      = $row['domname'];
            $whenexp     = $row['domexpdate'];
            $adminmail   = $row['adminmail'];
            $adminmobile = $row['adminmobile'];
        } //$monthbefore == $today
        if ($weekbefore == $today) {
            $flag1       = 1;
            $alertcolor  = "RED";
            $whatexp     = "DOMAIN";
            $when        = " AFTER 1 WEEK ";
            $whoexp      = $row['domname'];
            $whenexp     = $row['domexpdate'];
            $adminmail   = $row['adminmail'];
            $adminmobile = $row['adminmobile'];
        } //$weekbefore == $today
        if ($daysleft < 7) {
            $flag1       = 1;
            $alertcolor  = "RED";
            $whatexp     = "DOMAIN";
            $when        = " AFTER " . $daysleft . " DAYS";
            $whoexp      = $row['domname'];
            $whenexp     = $row['domexpdate'];
            $adminmail   = $row['adminmail'];
            $adminmobile = $row['adminmobile'];
            if ($todaybefore == $today) {
                $flag1       = 1;
                $alertcolor  = "RED";
                $whatexp     = "DOMAIN";
                $when        = " TODAY ";
                $whoexp      = $row['domname'];
                $whenexp     = $row['domexpdate'];
                $adminmail   = $row['adminmail'];
                $adminmobile = $row['adminmobile'];
            } //$todaybefore == $today
        } //$daysleft < 7
        if ($flag1 == 1) {
            $flag1 = 0;
            if ($mailalert == 1) {
                if ($mailindalert == 1) {
                    $theexpiremessage   = str_replace($whoexpvar, $whoexp, $beforexpirenote);
                    $theexpiremessage   = str_replace($whourlvar, $whoexp, $theexpiremessage);
                    $theexpiremessage   = str_replace($dateofexpirevar, $whenexp, $theexpiremessage);
                    $theexpiremessage   = str_replace($exalertvar, $alertcolor, $theexpiremessage);
                    $theexpiremessage   = str_replace($whatvar, $whatexp, $theexpiremessage);
                    $theexpiremessage   = str_replace($whenvar, $when, $theexpiremessage);
                    $domainemailmessage = $theexpiremessage;
                    $whatexp            = "DOMAIN";
                    $whoexp             = $row['domname'];
                    $whenexp            = $row['domexpdate'];
                    $adminmail          = $row['adminmail'];
                    $adminmobile        = $row['adminmobile'];
//                    $sendname         = "codeofthefreedom@gmail.com";
//                    $domainheaders      = "From: " . $sendname;
                    $expalertsubject    = "/Sent from Cron/ The " . $whatexp . ' ' . $whoexp . $when . ' EXPIRE ALLERT !';
                    mail($adminmail, $expalertsubject, $domainemailmessage, "From: " . $sysmail);
                } //$mailindalert == 1
            } //$mailalert == 1
        } //$flag1 == 1
    } //$flag2 == 0
} //$row = mysql_fetch_assoc($contactview)
include('config.php');
$query = "select * from settings";
$result = mysql_query($query, $connection) or die(mysql_error());
$info                = mysql_fetch_assoc($result);
$hostsmssendmessage  = $info['smssendmessage'];
$hostbeforexpirenote = $info['mailsendmessage'];
$hostmailalert       = $info['mailalert'];
$hostsmsalert        = $info['smsalert'];
$hostsysmail         = $info['sysmail'];
//$hostsendname        = "codeofthefreedom@gmail.com";
$hostsendname        = $hostsysmail;
$hostsysmobile       = $info['sysmobile'];
$today               = date("j.n.Y");
$hostweekdaynumber   = date("w");
$hostexalertvar      = array(
    "{expire alert}",
    "{exalert}"
);
$hostdateofexpirevar = array(
    "{dateofexpire}",
    "{expire date}"
);
$hostwhatvar         = array(
    "{what}",
    "{what expire}"
);
$hostwhoexpvar       = array(
    "{whoexp}",
    "{who expire}"
);
$hostwhenvar         = array(
    "{when}",
    "{when expire}"
);
$hostwhourlvar       = array(
    "{whourl}",
    "{whourl expire}"
);
$contactquery        = "SELECT * FROM dbcontent";
$contactview = mysql_query($contactquery, $connection) or die(mysql_error());
$contactview_results = mysql_num_rows($contactview);
while ($row = mysql_fetch_assoc($contactview)) {
    $hostmailindalert      = $row['mailindalert'];
    $hostsmsindalert       = $row['smsindalert'];
    $hostwhatxpdate        = $row['hostexpdate'];
    $hostexpdata           = explode(".", $hostwhatxpdate);
    $hostwmcurdate         = explode(".", $today);
    $hostwcurrentdate      = $hostwmcurdate[0] . '.' . $hostwmcurdate[1] . '.' . $hostwmcurdate[2];
    $hostwcurrentdateday   = $hostwmcurdate[0];
    $hostwcurrentdatemonth = $hostwmcurdate[1];
    $hostwcurrentdateyear  = $hostwmcurdate[2];
    $hostdatacorectata     = $hostexpdata[0] . '.' . $hostexpdata[1] . '.' . $hostexpdata[2];
    $hostpDate                = strtotime($hostdatacorectata . '-' . '1 week');
    $hostmDate                = strtotime($hostdatacorectata . '-' . '1 month');
    $hostminus7days           = date('j.n.Y', $hostpDate);
    $whostexpdata             = explode(".", $hostminus7days);
    $hostweekbeforemath       = $whostexpdata[0] . '.' . $whostexpdata[1] . '.' . $whostexpdata[2];
    $hostweekbeforemathday    = $whostexpdata[0];
    $hostweekbeforemathmonth  = $whostexpdata[1];
    $hostweekbeforemathyear   = $whostexpdata[2];
    $hostweekbefore           = $hostweekbeforemath;
    $hostminus30days          = date('j.n.Y', $hostmDate);
    $mhostexpdata             = explode(".", $hostminus30days);
    $hostmonthbeforemath      = $mhostexpdata[0] . '.' . $mhostexpdata[1] . '.' . $mhostexpdata[2];
    $hostmonthbeforemathday   = $mhostexpdata[0];
    $hostmonthbeforemathmonth = $mhostexpdata[1];
    $hostmonthbeforemathyear  = $mhostexpdata[2];
    $hostmonthbefore          = $hostmonthbeforemath;
    $hostflag1                = 0;
    $hostflag2                = 0;
    $hostalertcolor           = "GREEN";
    $hostwhatexp              = " HOSTING ";
    $hostwhen                 = " AFTER 1 MONTH ";
    $hostwhoexp               = $row['hostname'];
    $hostwhenexp              = $row['hostexpdate'];
    $hostadminmail            = $row['adminmail'];
    $hostadminmobile          = $row['adminmobile'];
    $hostdatenow              = date("j.n.Y");
    $hostdiff                 = strtotime($hostwhatxpdate) - strtotime($hostdatenow);
    if ($hostdiff < 0) {
        $hostdiff  = 0;
        $hostflag2 = 1;
    } //$hostdiff < 0
    $hostdaysleft        = floor($hostdiff / (60 * 60 * 24));
	$hosttodaybeforemath = $hostexpdata[0] . '.' . $hostexpdata[1] . '.' . $hostexpdata[2];
    $hosttodaybefore     = $hosttodaybeforemath;
    if ($hostflag2 == 0) {
        if ($hostmonthbefore == $today) {
            $hostflag1       = 1;
            $hostalertcolor  = "YELLOW";
            $hostwhatexp     = " HOSTING ";
            $hostwhen        = " AFTER 1 MONTH ";
            $hostwhoexp      = $row['hostname'];
            $hostwhenexp     = $row['hostexpdate'];
            $hostadminmail   = $row['adminmail'];
            $hostadminmobile = $row['adminmobile'];
        } //$hostmonthbefore == $today
        if ($hostweekbefore == $today) {
            $hostflag1       = 1;
            $hostalertcolor  = "RED";
            $hostwhatexp     = " HOSTING ";
            $hostwhen        = " AFTER 1 WEEK ";
            $hostwhoexp      = $row['hostname'];
            $hostwhenexp     = $row['hostexpdate'];
            $hostadminmail   = $row['adminmail'];
            $hostadminmobile = $row['adminmobile'];
        } //$hostweekbefore == $today
        if ($hostdaysleft < 7) {
            $hostflag1       = 1;
            $hostalertcolor  = "RED";
            $hostwhatexp     = " HOSTING ";
            $hostwhen        = " AFTER " . $hostdaysleft . " DAYS";
            $hostwhoexp      = $row['hostname'];
            $hostwhenexp     = $row['hostexpdate'];
            $hostadminmail   = $row['adminmail'];
            $hostadminmobile = $row['adminmobile'];
            if ($hosttodaybefore == $today) {
                $hostflag1       = 1;
                $hostalertcolor  = "RED";
                $hostwhatexp     = " HOSTING ";
                $hostwhen        = " TODAY ";
                $hostwhoexp      = $row['hostname'];
                $hostwhenexp     = $row['hostexpdate'];
                $hostadminmail   = $row['adminmail'];
                $hostadminmobile = $row['adminmobile'];
            } //$hosttodaybefore == $today
        } //$hostdaysleft < 7
        if ($hostflag1 == 1) {
            $hostflag1 = 0;
            if ($hostmailalert == 1) {
                if ($hostmailindalert == 1) {
                    $hosttheexpiremessage = str_replace($hostwhoexpvar, $hostwhoexp, $hostbeforexpirenote);
                    $hosttheexpiremessage = str_replace($hostwhourlvar, $hostwhoexp, $hosttheexpiremessage);
                    $hosttheexpiremessage = str_replace($hostdateofexpirevar, $hostwhenexp, $hosttheexpiremessage);
                    $hosttheexpiremessage = str_replace($hostexalertvar, $hostalertcolor, $hosttheexpiremessage);
                    $hosttheexpiremessage = str_replace($hostwhatvar, $hostwhatexp, $hosttheexpiremessage);
                    $hosttheexpiremessage = str_replace($hostwhenvar, $hostwhen, $hosttheexpiremessage);
                    $hostemailmessage     = $hosttheexpiremessage;
//                    $hostsendname         = "codeofthefreedom@gmail.com";
//                    $hostheaders          = "From: " . $hostsendname;
                    $hostwhatexp          = " HOSTING ";
                    $hostwhoexp           = $row['hostname'];
                    $hostwhenexp          = $row['hostexpdate'];
                    $hostadminmail        = $row['adminmail'];
                    $hostadminmobile      = $row['adminmobile'];
                    $hostexpalertsubject  = "/Sent from Cron/ The " . $hostwhatexp . ' ' . $hostwhoexp . $hostwhen . ' ' . ' EXPIRE ALLERT !';
                    mail($hostadminmail, $hostexpalertsubject, $hostemailmessage, "From: " . $hostsysmail);
                } //$hostmailindalert == 1
            } //$hostmailalert == 1
        } //$hostflag1 == 1
    } //$hostflag2 == 0
} //$row = mysql_fetch_assoc($contactview)

?>