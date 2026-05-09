@include('layouts.library.config')
<?php
require_once 'library/config.php';
//function dt_display($ddmmyyyy)
//{
// $dt=explode('-',$ddmmyyyy);
// $dd=$dt[2];
// $mm=$dt[1];
// $yy=$dt[0];
// return $dd . '-' . $mm . '-' . $yy;
//}
//$sheetid = $_GET['workorderno'];
//$meterno = $_GET['meterno'];
//$rbn     = $_GET['rbn'];
//$select_recovery_query 	= 	"SELECT * FROM  electricity_recovery WHERE sheetid = '$sheetid' AND meter_no = '$meterno' order by meter_no";
//$select_recovery_sql	=	mysql_query($select_recovery_query);
//if($select_recovery_sql == true) 
//{
//	$List = mysql_fetch_object($select_recovery_sql);
//	$meter_no 		= 	$List->meter_no;
//	$imr 			= 	$List->imr+1;
//	$imr_date 		= 	dt_display($List->imr_date);
//	$rate 			= 	$List->rate;
//	$meter_rent 	= 	$List->meter_rent;
//	$e_limit 		= 	$List->e_limit;
//	$factor 		= 	$List->factor;
//	$er_date 		= 	dt_display($List->er_date);
//	$recoverydata 	= $meter_no."*".$imr."*".$imr_date."*".$rate."*".$meter_rent."*".$e_limit."*".$er_date."*".$factor; 
//}
//
//$select_recovery_query_2 	= 	"SELECT * FROM generate_electricitybill WHERE wid = (SELECT MAX(a.wid) FROM generate_electricitybill a WHERE a.sheetid = '$sheetid') AND sheetid = '$sheetid' AND meter_no = '$meterno' AND rbn <='$rbn' order by meter_no";
//$select_recovery_sql_2	=	mysql_query($select_recovery_query_2);
//if($select_recovery_sql_2 == true) 
//{
//	if(mysql_num_rows($select_recovery_sql_2)>0)
//	{
//		$FMRList = mysql_fetch_object($select_recovery_sql_2);
//		$imr 		= 	$FMRList->fmr;//$FMRList->imr;
//		$imr_date 	= 	dt_display($FMRList->fmr_date);//dt_display($FMRList->imr_date);
//	}
//}
//$recoverydata 	= $recoverydata."*".$imr."*".$imr_date; 
////echo $recoverydata;
//echo $recoverydata;
	
?>
