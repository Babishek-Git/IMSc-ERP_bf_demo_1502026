@include('layouts.library.config')
@include('layouts.library.functions')
@include('layouts.library.binddata')
@include('layouts.header')
<?php
session_start();
@ob_start();
require_once 'library/config.php';
require_once 'library/functions.php';
require_once 'library/binddata.php';
//checkUser();
//$msg = '';
//function dt_format($ddmmyyyy) {
//    $dt = explode('/', $ddmmyyyy);
//    $dd = $dt[0];
//    $mm = $dt[1];
//    $yy = $dt[2];
//    return $yy . '-' . $mm . '-' . $dd;
//}
//function dt_display($ddmmyyyy) {
//    $dt = explode('-', $ddmmyyyy);
//    $dd = $dt[2];
//    $mm = $dt[1];
//    $yy = $dt[0];
//    return $dd . '/' . $mm . '/' . $yy;
//}
//if(isset($_POST['submit'])){
//	$sheetid  	= $_POST['cmb_work_no'];
//	$ViewType  	= $_POST['txt_view_type']; 
//}
//if($ViewType == "W"){
//	include('WorkTransactionWorkReports.php');
//}else if($ViewType == "R"){
//	include('WorkTransactionRABReports.php');
//}else{
//	include('WorkTransactionWorkReports.php');
//}
?>