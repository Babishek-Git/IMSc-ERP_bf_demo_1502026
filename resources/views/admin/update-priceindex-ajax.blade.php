@include('layouts.library.binddata') 
<?php
require_once("library/binddata.php");
 //$cpdtid			=	$_POST[cpdtid];
// $spdtid			=	$_POST[spdtid];
// $flag				=	$_POST[flag];
// if($flag == "E"){
//	 $cem_pi_rate 	= 	$_POST[cem_pi_rate];
//	 $stl_pi_rate 	= 	$_POST[stl_pi_rate];
//	 $month_year 	= 	$_POST[month_year];
//	 
//	 $updateQuery1 	= "update price_index_detail set pi_rate = '$cem_pi_rate', pi_month = '$month_year' where pdtid = '$cpdtid'";
//	 $updateSql1 	= mysql_query($updateQuery1);
//	 
//	 $updateQuery2 	= "update price_index_detail set pi_rate = '$stl_pi_rate', pi_month = '$month_year' where pdtid = '$spdtid'";
//	 $updateSql2 	= mysql_query($updateQuery2);
//	 
//	 if(($updateSql1 == true) && ($updateSql2 == true)){
//		echo 1;
//	 }else{
//		echo 0;
//	 }
// }if($flag == "D"){
//	 $DeleteQuery1 	= "delete from price_index_detail where pdtid = '$cpdtid'";
//	 $DeleteSql1 	= mysql_query($DeleteQuery1);
//	 
//	 $DeleteQuery2 	= "delete from price_index_detail where pdtid = '$spdtid'";
//	 $DeleteSql2 	= mysql_query($DeleteQuery2);
//	 if(($DeleteSql1 == true)&&($DeleteSql2 == true)){
//		echo 1;
//	 }else{
//		echo 0;
//	 }
// }
?>