<?php
include "spellnumber.php";
//$msg = ''; $Line = 0;
//function checkPartpayment($DpmArrMbidList,$Key)
//{
//	$InitKey = $Key;
//	while($perc = current($DpmArrMbidList)) 
//	{
//		if ($perc == $InitKey) 
//		{
//			//echo key($DpmArrPayPercentList).'<br />';
//			$res .= key($DpmArrMbidList)."*";
//		}
//		next($DpmArrMbidList);
//	}
//	return rtrim($res,"*");
//}
//
//function removeArray($res,$array)
//{
//	$explodeRes = explode("*",rtrim($res,"*"));
//	for($i=0; $i<count($explodeRes);$i++)
//	{
//		$RemKey = $explodeRes[$i];
//		unset($array[$RemKey]);
//	}
//	return $array;
//}
//function CheckPageBreak($tablehead,$abstmbno,$table,$page)
//{
//	$nextpage = $page+1;
//	$Output .= "<tr>
//					<td colspan='3' align='right' class='labelbold'>C/o Page No ".$nextpage."/ Abstract MB No ".$abstmbno."</td>
//					<td></td>
//					<td></td>
//					<td align='right' class='labelbold'>HEllo</td>
//					<td></td>
//					<td></td>
//					<td align='right' class='labelbold'>HEllo</td>
//					<td></td>
//					<td align='right' class='labelbold'>HEllo</td>
//					<td></td>
//				</tr>";
//	$Output .=  "<tr class='labelprint'><td colspan='12' align='center' style='border-bottom:2px solid white;border-left:2px solid white;border-right:2px solid white;'>Page ".$page."</td></tr>";
//	$Output .= "</table>";
//	$Output .= "<p  style='page-break-after:always;'></p>";
//	$Output .= '<table width="100%" border="0"  cellpadding="2" cellspacing="2" align="center" bgcolor="#FFFFFF" style="border:none;" class="labelprint">
//				<tr style="border:none;"><td align="right" style="border:none;">Abstract M.Book No. '.$abstmbno.'&nbsp;&nbsp;</td></tr>
//				</table>';
//	$Output .= $table;
//	$Output .= "<table width='100%' cellpadding='3' cellspacing='3' align='center' class='label table1' bgcolor='#FFFFFF' id='table1'>";
//	$Output .= $tablehead;
//	$Output .= "<tr>
//					<td colspan='3' align='right' class='labelbold'>B/f from Page No ".$page."/ Abstract MB No ".$abstmbno."</td>
//					<td></td>
//					<td></td>
//					<td align='right' class='labelbold'>HEllo</td>
//					<td></td>
//					<td></td>
//					<td align='right' class='labelbold'>HEllo</td>
//					<td></td>
//					<td align='right' class='labelbold'>HEllo</td>
//					<td></td>
//				</tr>";
//	echo $Output;
//}
///*function getWordWrapCount($description,$char)
//{
//	$wrap_cnt 	= 0; 
//	$descwork 	= "";
//	$char_no 	= $char;
//	$work_desc 	= $description;
//	$desc 		= wordwrap($work_desc,$char_no,'<br>');
//	$exp_line 	= explode('<br>', $desc);
//	$wlcnt 		= count($exp_line);
//	for($xc=0; $xc<$wlcnt; $xc++)
//	{
//		if($exp_line[$xc] != "")
//		{
//			$wrap_cnt++;
//			$descwork .= $exp_line[$xc]."<br/> ";
//		}
//	}
//	return array($descwork, $wrap_cnt);
//}*/
//
//function getWordWrapCount($description,$char)
//{
//	$WordCount = 0; $OutputStr = ""; $LineCount = 1; $All = 0;
//	$pieces = explode(" ",$description);
//	$count 	= count($pieces);
//	for($i=0; $i<$count; $i++){
//		$word 	= $pieces[$i];
//		$len 	= strlen($word);
//		$WordCount = $WordCount + $len; $All = $All + $len;
//		if($WordCount < 45){
//			$OutputStr = $OutputStr." ".$word;
//		}else{
//			$OutputStr = $OutputStr."<br/> ".$word;
//			$WordCount = 0;
//			$LineCount++;
//		}
//	}
//	$All = $All + $count;
//	return array($OutputStr, $LineCount);
//}
//
//$staffid 		= 	$_SESSION['sid'];
//$userid 		= 	$_SESSION['userid'];
//$abstsheetid    = 	$sheetid;
//$_SESSION["abstsheetid"] = 	$sheetid;
//$abstsheetid    = 	$_SESSION["abstsheetid"];
//$RowLine = 27;	
?>
<!--<style>
.pagetitle
{
	text-shadow:
    -1px -1px 0 #7F7F7F,
    1px -1px 0 #7F7F7F,
    -1px 1px 0 #7F7F7F,
    1px 1px 0 #7F7F7F; 
}
.table1
{
	color:#BF0602;
	/*color:#921601;*/
	border: 1px solid #cacaca;
	border-collapse: collapse;
}
.table1 td
{ 
	border: 1px solid #cacaca;
	border-collapse: collapse;
}
.fontcolor1
{
	color:#FFFFFF;
}

.popuptitle
{
	background-color:#0080FF;
	font-weight:bold;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:14px;
	color:#FFFFFF;
	line-height:25px;
	border:1px solid #9b9da0;
}
.table2
{
	color:#071A98;
	border:1px solid #cacaca;
	border-collapse: collapse;
}
.table2 td
{
	border:1px solid #cacaca;
	border-collapse: collapse;
}
.bottomsection
{
 	position: absolute;
    bottom: 0;
	width:100%;
	line-height:38px;
}
.buttonsection
{
	display: inline-block;
	line-height:38px;
}
.buttonstyle
{
	background-color:#0080FF;
	width:80px;
	height:25px;
	color:#FFFFFF;
	-moz-box-shadow: 0px 1px 0px 0px #0080FF;
	-webkit-box-shadow: 0px 1px 0px 0px #0080FF;
	box-shadow: 0px 1px 0px 0px #0080FF;
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #0080FF), color-stop(1, #0080FF));
	background:-moz-linear-gradient(top, #0080FF 5%, #0080FF 100%);
	background:-webkit-linear-gradient(top, #0080FF 5%, #0080FF 100%);
	background:-o-linear-gradient(top, #0080FF 5%, #0080FF 100%);
	background:-ms-linear-gradient(top, #0080FF 5%, #0080FF 100%);
	background:linear-gradient(to bottom, #0080FF 5%, #0080FF 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#0080FF', endColorstr='#0080FF',GradientType=0);
	border:1px solid #0080FF;
	display:inline-block;
	cursor:pointer;
	font-weight:bold;

}
.buttonstyle:hover
{
	font-size:14px;
	padding: 0.1em 1em;
	-moz-box-shadow: 0px 1px 4px rgba(0,0,0,5);
    -webkit-box-shadow: 0px 1px 4px rgba(0,0,0,5);
    box-shadow:0px 1px 4px rgba(0,0,0,5);
	background:#E80017;
	border:1px solid #E80017;
}
.popuptextbox
{
	border:none;
	font-family:Verdana;
	font-size:12px;
	font-weight:bold;
	color:#DE0117;
	text-align:center;
	pointer-events: none;
}
.dynamictextbox
{
	border:1px solid #ffffff;
	height:21px;
	color:#DE0117;
	font-weight:bold;
}
.dynamictextbox:hover, .dynamictextbox:focus
{
	/*outline: none;*/
	border:1px solid #2aade4;
	box-shadow: 0 0 7px #2aade4;
	color:#DE0117;
    /*border-color: #9ecaed;
    box-shadow: 0 0 10px #9ecaed;*/
}
.dynamictextbox2
{
	border:1px solid #2aade4;
	box-shadow: 0 0 7px #2aade4;
	color:#DE0117;	
}
.dynamicrowcell
{
	padding-bottom:0px;
	padding-top:0px; 
	padding-left:0px; 
	padding-right:0px;
	text-align:right;
	font:Verdana, Arial, Helvetica, sans-serif;
}
.hide
{
	display:none;
}
.labelprint
{
	font-weight:normal;
	color:#000000;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:10pt;
}
@media print 
{
	.printbutton
	{
		display: none !important;
	}
}
/*.table1 tr:nth-child(even) {background: #CCC}
.table1 tr:nth-child(odd) {background: #FFF}*/
</style>-->		
<!--<table width="100%" height="56px" align="center" class='label' bgcolor="#0A9CC5">
	<tr bgcolor="#0A9CC5" style="position:fixed;">
		<td style="color:#FFFFFF; border:none; font-size:16px;" width="1077px"  height="48px" class="pagetitle" align="center">ABSTRACT MEASUREMENT BOOK - PART PAYMENT</td>
	</tr>
</table>-->
<?php
//$page = $abstmbpage;
/*$title = '<table width="100%" border="0"  cellpadding="2" cellspacing="2" align="center" bgcolor="#FFFFFF" style="border:none;" class="labelprint">
			<tr style="border:none;"><td align="center" style="border:none;">Abstract M.Book No. '.$abstmbno.'&nbsp;&nbsp;&nbsp;</td></tr>
			</table>';
echo $title;
//$Line = $Line+2;
$table = $table . "<table width='100%'  bgcolor='#FFFFFF' border='0' cellpadding='1' cellspacing='1' align='center' class='table1 labelprint' >";
$table = $table . "<tr>";
$table = $table . "<td width='17%' class=''>Name of work</td>";
$table = $table . "<td width='43%' style='word-wrap:break-word' class=''>" .$work_name."</td>";
$table = $table . "<td width='18%' class=''>Name of the contractor</td>";
$table = $table . "<td width='22%' class='' colspan='3'>" . $name_contractor . "</td>";
$table = $table . "</tr>";
$table = $table . "<tr>";
$table = $table . "<td class=''>Technical Sanction No.</td>";
$table = $table . "<td class=''>" . $tech_sanction . "</td>";
$table = $table . "<td class=''>Agreement No.</td>";
$table = $table . "<td class='' colspan='3'>" . $agree_no . "</td>";
$table = $table . "</tr>";
$table = $table . "<tr>";
$table = $table . "<td class=''>Work order No.</td>";
$table = $table . "<td class=''>" . $work_order_no . "</td>";
$table = $table . "<td class=''>Running Account bill No. </td>";
$table = $table . "<td class=''>" . $runn_acc_bill_no . "</td>";
$table = $table . "<td class='' align='right'>CC No. </td>";
$table = $table . "<td class=''>" . $ccno . "</td>";
$table = $table . "</tr>";
//$table = $table . "<tr>";
//$table = $table . "<td colspan ='4' class='labelprint' align='center'>Abstract Cost for ".$short_name." for the period of ".date("d/m/Y", strtotime($fromdate))." to ".date("d/m/Y", strtotime($todate))."</td>";
//$table = $table . "</tr>";
$table = $table . "</table>";
//$Line = $Line+6;
//$tablehead = $tablehead . "<table width='100%' frame=''  bgcolor='#0A9CC5' border='1' cellpadding='3' cellspacing='3' align='center' style='color:#ffffff;' id='mbookdetail' class='label table1'>";
$tablehead = $tablehead . "<tr style='background-color:#EEEEEE;' class='labelprint'>";
//$tablehead = $tablehead . "<td  align='center' class='labelsmall labelheadblue' width='12px' style='background-color:#0A9CC5;' rowspan='2'></td>";
$tablehead = $tablehead . "<td  align='center' class='' width='44px' rowspan='2'>Item No.</td>";
$tablehead = $tablehead . "<td  align='center' class='' width='130px' rowspan='2'>Description of work</td>";
$tablehead = $tablehead . "<td  align='center'  width='40px' rowspan='2'>Contents of Area</td>";
$tablehead = $tablehead . "<td  align='center' class='' width='40px' rowspan='2'>Rate&nbsp;<i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'></td>";
$tablehead = $tablehead . "<td  align='center' class='' width='40px' rowspan='2'>Per</td>";
$tablehead = $tablehead . "<td  align='center' class='' width='40px' rowspan='2'>Total value to Date&nbsp;<i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'></td>";
$tablehead = $tablehead . "<td  align='center' class='' width='100px' colspan='3'>Deduct previous Measurements</td>";
$tablehead = $tablehead . "<td  align='center' class='' width='120px' colspan='3'>Since Last Measurement</td>";
$tablehead = $tablehead . "</tr>";
$tablehead = $tablehead . "<tr style='background-color:#EEEEEE;' class='labelprint'>";
$tablehead = $tablehead . "<td width='30px' align='center' class=''>Page</td>";
$tablehead = $tablehead . "<td width='40px' align='center' class=''>Quantity</td>";
$tablehead = $tablehead . "<td width='40px' align='center' class=''>Amount&nbsp;<i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'></td>";
$tablehead = $tablehead . "<td width='40px' align='center' class=''>Quantity</td>";
$tablehead = $tablehead . "<td width='40px' align='center' class=''>Value&nbsp;<i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'></td>";
$tablehead = $tablehead . "<td width='40px' align='center' class=''>Remark</td>";
$tablehead = $tablehead . "</tr>";
//$tablehead = $tablehead . "</table>";*/
?>
<?php //echo $table; ?>
<!--<table width='100%' cellpadding='3' cellspacing='3' align='center' class='label table1' bgcolor="#FFFFFF" id="table1">-->
<?php //echo $tablehead; ?>
<!--<tr bgcolor="#d4d8d8" style="height:5px"><td colspan="13" style="border-top-color:#666666; border-bottom-color:#666666;height:5px"></td></tr>-->
<?php 
//$Line = $Line+2;
//$color_var = 0; $table_group_row = 0; $temp_array = array(); $OverAllDpmAmount = 0; $OverAllSlmDpmAmount = 0; $OverAllSlmDpmAmount = 0; $SubdividSlmStr = "";
//$unionqur = "(SELECT subdivid  FROM mbookgenerate WHERE sheetid = '$abstsheetid') UNION (SELECT subdivid  FROM measurementbook WHERE sheetid = '$abstsheetid' AND (part_pay_flag = '0' OR part_pay_flag = '1'))";
//$unionsql = mysql_query($unionqur);
//while($Listsubdivid = mysql_fetch_array($unionsql)) { $subdivid_list .= $Listsubdivid['subdivid']."*"; }
//$subdivisionlist_1 = explode("*",rtrim($subdivid_list,"*"));
//natsort($subdivisionlist_1);
//foreach($subdivisionlist_1 as $key => $summ_1)
//{
//   if($summ_1 != "")
//   {
//      $subdivisionlist_2 .= $summ_1.",";
//   }
//}
//$subdivisionlist = explode(',',rtrim($subdivisionlist_2,","));
//for($i=0;$i<count($subdivisionlist);$i++)
//{
//	$DpmArrPercent 			= array();
//	$DpmArrPayPercentList 	= array();
//	$DpmArrQuantityList 	= array();
//	$DpmArrRbnList 			= array();
//	$DpmArrAmbList			= array();
//	$DpmArrAmbPgList		= array();
//	$DpmArrMbidList			= array();
//	$SlmArrMbidList			= array();
//	$SlmArrQuantityList 	= array();
//	$SlmArrPayPercentList 	= array();
//	$slm_mesurementbook_details = ""; $dpm_mesurementbook_details = "";
//	$slm_measurement_qty = 0; $dpm_measurement_qty = 0; $slm_cnt = 0; $dpm_cnt = 0;  $rowcount = 0; $slm_amount_item = 0; $dpm_amount_item = 0;
//	$schduledetails = 	getschduledetails($abstsheetid,$subdivisionlist[$i]);
//	$rateandunit 	= 	explode('*',$schduledetails);
//	$rate 			= 	$rateandunit[0];
//	$unit 			= 	$rateandunit[1];
//	$decimal 		= 	get_decimal_placed($subdivisionlist[$i],$abstsheetid);
////*************THIS PART IS FOR SINCE LAST MEASUREMENT ( S.L.M. ) SECTION*******************//
//
//	$mbookslmquery = "SELECT * FROM measurementbook_temp WHERE subdivid = '$subdivisionlist[$i]' AND sheetid = '$abstsheetid'";// ORDER BY pay_percent DESC";// AND  (part_pay_flag = '0' OR  part_pay_flag = '1')";
//	$mbookslmquery_sql = mysql_query($mbookslmquery);
//	if(mysql_num_rows($mbookslmquery_sql)>0)
//	{
//		$SubdividSlmStr .= $subdivisionlist[$i]."*";
//		while($SLMList = mysql_fetch_array($mbookslmquery_sql))
//		{
//			if(($SLMList['part_pay_flag'] =='0') || ($SLMList['part_pay_flag'] == '1'))
//			{
//				$slm_mesurementbook_details .= $SLMList['subdivid']."*".$SLMList['mbtotal']."*".$SLMList['mbno']."*".$SLMList['mbpage']."*".$SLMList['divid']."*".$SLMList['abstmbookno']."*".$SLMList['abstmbpage']."*".$SLMList['pay_percent']."*".$SLMList['flag']."*".$SLMList['part_pay_flag']."*".$SLMList['remarks']."*".$SLMList['rbn']."*";
//				$slm_measurement_qty = $slm_measurement_qty + $SLMList['mbtotal'];
//				$mbookno_slm 		= 	$SLMList['mbno'];
//				$mbpageno_slm 		= 	$SLMList['mbpage'];
//				$absmbookno_slm 	= 	$SLMList['abstmbookno'];
//				$absmbpageno_slm 	= 	$SLMList['abstmbpage'];
//				$flag_slm			= 	$SLMList['flag'];
//				$partpay_flag_slm 	= 	$SLMList['part_pay_flag'];
//				$divid				= 	$SLMList['divid'];
//				$payment_percent 	= 	$SLMList['pay_percent'];
//				$PartPayremarks		=	$SLMList['remarks'];
//				$slm_cnt++;
//			}
//			else
//			{
//			
//				$qty_dpm_slm 		= 	$SLMList['mbtotal'];
//				$percent_dpm_slm 	= 	$SLMList['pay_percent'];
//				if($SLMList['part_pay_flag'] != "")
//				{
//					$partpay_flag_slm = $SLMList['part_pay_flag'];
//					$explode_partpayflag_dpm_slm = explode("*",$partpay_flag_slm);
//					$rbn_dpm_slm 	= $explode_partpayflag_dpm_slm[1];
//					$bmid_dpm_slm	= $explode_partpayflag_dpm_slm[2];
//					array_push($SlmArrMbidList,$bmid_dpm_slm);
//					array_push($SlmArrQuantityList,$qty_dpm_slm);
//					array_push($SlmArrPayPercentList,$percent_dpm_slm);
//				}
//			}
//		}
//	}
//	else
//	{
//		$slm_measurement_qty = 0;
//		$slm_cnt = 0;
//	}
//	//echo "A = ".$slm_cnt."<br/>";
////*************THIS PART IS FOR DEDUCT PREVIOUS MEASUREMENT ( D.P.M. ) SECTION*******************//
//	$TempDpmQty = 0; $dpm_mesurementbook_details_2 = ""; $dpm_mesurementbook_details_1 = "";
//	$mbookdpmquery = "SELECT * FROM measurementbook WHERE subdivid = '$subdivisionlist[$i]' AND sheetid = '$abstsheetid' ORDER BY rbn ASC ";// AND  part_pay_flag = '0'";
//	$mbookdpmquery_sql = mysql_query($mbookdpmquery);
//	if(mysql_num_rows($mbookdpmquery_sql)>0)
//	{
//		//array_push($subdivid_array,$subdivisionlist[$i]);
//		while($DPMList = mysql_fetch_array($mbookdpmquery_sql))
//		{
//			if(($DPMList['part_pay_flag'] == '0') || ($DPMList['part_pay_flag'] == '1'))
//			{
//				if($DPMList['pay_percent'] == '100')
//				{
//					$TempDpmQty = $TempDpmQty + $DPMList['mbtotal'];
//					$dpm_measurement_qty 	= 	$dpm_measurement_qty + $DPMList['mbtotal']; 
//					$dpm_mesurementbook_details_1 = $DPMList['subdivid']."*".$TempDpmQty."*".$DPMList['mbno']."*".$DPMList['mbpage']."*".$DPMList['divid']."*".$DPMList['abstmbookno']."*".$DPMList['abstmbpage']."*".$DPMList['pay_percent']."*".$DPMList['flag']."*".$DPMList['part_pay_flag']."*".$DPMList['remarks']."*".$DPMList['rbn']."*".$DPMList['measurementbookid']."*";
//				}
//				else
//				{
//					$dpm_mesurementbook_details_2 .= $DPMList['subdivid']."*".$DPMList['mbtotal']."*".$DPMList['mbno']."*".$DPMList['mbpage']."*".$DPMList['divid']."*".$DPMList['abstmbookno']."*".$DPMList['abstmbpage']."*".$DPMList['pay_percent']."*".$DPMList['flag']."*".$DPMList['part_pay_flag']."*".$DPMList['remarks']."*".$DPMList['rbn']."*".$DPMList['measurementbookid']."*";
//					$dpm_measurement_qty 	= 	$dpm_measurement_qty + $DPMList['mbtotal'];
//					$mbookno_dpm 			= 	$DPMList['mbno'];
//					$mbpageno_dpm 			= 	$DPMList['mbpage'];
//					$absmbookno_dpm 		= 	$DPMList['abstmbookno'];
//					$absmbpageno_dpm 		= 	$DPMList['abstmbpage'];
//					$flag_dpm				= 	$DPMList['flag'];
//					$partpay_flag_dpm 		= 	$DPMList['part_pay_flag'];
//					$divid					= 	$DPMList['divid'];
//					$paypercent_dpm_init	=	$DPMList['pay_percent'];
//					$measurebookid_dpm_int	=	$DPMList['measurementbookid'];
//					$DpmArrPercent[$measurebookid_dpm_int]	=	$paypercent_dpm_init;
//					$dpm_cnt++;
//				}
//				//echo $dpm_measurement_qty."<br/>";
//			}
//			elseif($DPMList['part_pay_flag'] == 'DMY')
//			{
//				$absmbookno_dpm 	= 	$DPMList['abstmbookno'];
//				$absmbpageno_dpm 	= 	$DPMList['abstmbpage'];
//			}
//			else
//			{
//				$paypercent_dpm		=	$DPMList['pay_percent'];
//				$qty_dpm			=	$DPMList['mbtotal'];
//				$partpay_flag_dpm 	= 	$DPMList['part_pay_flag'];
//				$absmbookno_dpm 	= 	$DPMList['abstmbookno'];
//				$absmbpageno_dpm 	= 	$DPMList['abstmbpage'];
//				$divid				= 	$DPMList['divid'];
//				$explode_partpay_flag	 = explode("*",$partpay_flag_dpm);
//				
//				$PartpayRbn 		= 	$explode_partpay_flag[1];
//				$PartpayMbid 		= 	$explode_partpay_flag[2];
//				array_push($DpmArrPayPercentList,$paypercent_dpm);
//				array_push($DpmArrQuantityList,$qty_dpm);
//				array_push($DpmArrRbnList,$PartpayRbn);
//				array_push($DpmArrAmbList,$absmbookno_dpm);
//				array_push($DpmArrAmbPgList,$absmbpageno_dpm);
//				array_push($DpmArrMbidList,$PartpayMbid);
//			}
//			$AbstractMbookNoDpm 		= $DPMList['abstmbookno'];
//			$AbstractMbookPageNoDpm		= $DPMList['abstmbpage'];
//		}
//		if($dpm_mesurementbook_details_1 != ""){ $dpm_cnt++; }
//		$dpm_mesurementbook_details = $dpm_mesurementbook_details_1.$dpm_mesurementbook_details_2;
//	}
//	else
//	{
//		$dpm_measurement_qty = 0;
//		$dpm_cnt = 0;
//	}
////echo $dpm_mesurementbook_details."<br/>";	
////echo "C = ".$dpm_measurement_qty."<br/>";	
//$subdivid = $subdivisionlist[$i];
//$subdivname = getsubdivname($subdivisionlist[$i]);
//$description1 = getscheduledescription_new($subdivisionlist[$i]);
//				$snotes = $description1;
//				$degcelsius = "&#8451";
//				$description = str_replace("DEGCEL","$degcelsius",$snotes);
////echo "D".$description;
//$slm_str = $subdivid."*@*".$subdivname."*@*".$divid."*@*".$description."*@*".$slm_measurement_qty."*@*".$mbookno_slm."*@*".$mbpageno_slm."*@*".$absmbookno_slm."*@*".$absmbpageno_slm."*@*".$flag_slm."*@*".$partpay_flag_slm."*@*".$staffid."*@*".$userid."*@*".$fromdate."*@*".$todate;
//$dpm_str = $subdivid."*@*".$subdivname."*@*".$divid."*@*".$description."*@*".$dpm_measurement_qty."*@*".$mbookno_dpm."*@*".$mbpageno_dpm."*@*".$absmbookno_dpm."*@*".$absmbpageno_dpm."*@*".$flag_dpm."*@*".$partpay_flag_dpm."*@*".$staffid."*@*".$userid."*@*".$fromdate."*@*".$todate;
//if($slm_cnt == 0)
//{
//	$slm_str = "";
//}
//if($dpm_cnt == 0)
//{
//	$dpm_str = "";
//}
//$item_str = $slm_str."@@@".$dpm_str;
//$slm_str = ""; $dpm_str = "";  $Linecheck = 3;// one row for item and desc, second for total cost row, third for new line row space between two item
//
//
//$UnitFactor 		= findNumericFromString($unit);
////$rateWithUnitfactor = round($rate / $UnitFactor,2);
//$rateWithUnitfactor = $rate / $UnitFactor;
//$rateDispaly 		= $rate;
//
//
//$checkbox_str = $subdivid."*".$subdivname."*".$description."*".$slm_measurement_qty."*".$dpm_measurement_qty."*".$rate."*".$unit."*".$abstsheetid;
//$rate 				= $rateWithUnitfactor;
//
////--*************THIS PART IS FOR C/O , B/F and Page Break SECTION********************//
//if($slm_cnt == 1){ $Line = $Line + 2; $Linecheck = $Linecheck + 2; } else { $Line = $Line + $slm_cnt;  $Linecheck = $Linecheck + $slm_cnt;}
//if($dpm_cnt == 1){ $Line = $Line + 2; $Linecheck = $Linecheck + 2; } else { $Line = $Line + $dpm_cnt;  $Linecheck = $Linecheck + $dpm_cnt;}
//
//$LineTemp = $Line + $Linecheck;
//echo $subdivname." = ".$Line." = ".$LineTemp." = ".$Linecheck."<br/>";
/*if($LineTemp >= 34){ $Line = 34; $LineTemp = 0; }
if($Line >= 34)
{
?>
<tr>
	<td colspan='3' align='right' class='labelbold'>C/o Page No <?php echo $page+1; ?>/ Abstract MB No <?php echo $abstmbno; ?></td>
	<td></td>
	<td></td>
	<td align='right' class='labelbold'><?php echo number_format($OverAllSlmDpmAmount, 2, '.', ''); ?></td>
	<td></td>
	<td></td>
	<td align='right' class='labelbold'><?php echo number_format($OverAllDpmAmount, 2, '.', ''); ?></td>
	<td></td>
	<td align='right' class='labelbold'><?php echo number_format($OverAllSlmAmount, 2, '.', ''); ?></td>
	<td><?php //echo $LineTemp; ?></td>
</tr>
<tr class='labelprint'><td colspan='12' align='center' style='border-bottom:2px solid white;border-left:2px solid white;border-right:2px solid white;'>Page <?php echo $page; ?></td></tr>
</table>
<p style='page-break-after:always;'></p>
<table width="100%" border="0"  cellpadding="2" cellspacing="2" align="center" bgcolor="#FFFFFF" style="border:none;" class="labelprint">
	<tr style="border:none;"><td align="center" style="border:none;">Abstract M.Book No.<?php echo $abstmbno; ?>&nbsp;&nbsp;</td></tr>
</table>
<?php echo $table; ?>
<table width='100%' cellpadding='3' cellspacing='3' align='center' class='label table1' bgcolor='#FFFFFF' id='table1'>
<?php echo $tablehead; ?>
<tr>
	<td colspan='3' align='right' class='labelbold'>B/f from Page No <?php echo $page; ?>/ Abstract MB No <?php echo $abstmbno; ?></td>
	<td></td>
	<td></td>
	<td align='right' class='labelbold'><?php echo number_format($OverAllSlmDpmAmount, 2, '.', ''); ?></td>
	<td></td>
	<td></td>
	<td align='right' class='labelbold'><?php echo number_format($OverAllDpmAmount, 2, '.', ''); ?></td>
	<td></td>
	<td align='right' class='labelbold'><?php echo number_format($OverAllSlmAmount, 2, '.', ''); ?></td>
	<td><?php //echo $LineIncr."*".$Linecheck; ?></td>
</tr>
<?php
$Line = $LineIncr+$Linecheck; $page++;
}*/
//--*************THIS PART IS FOR " PRINT " Item Name, Description and Check Box  SECTION********************//
?>
<input type="hidden" name="hid_item_str" id="hid_item_str" value="<?php //echo $item_str; ?>" />
<!--<tr border='1' bgcolor="" class="labelprint">
	<td width="61px" align="center" style="border-top-color:#666666;" class="">
		<?php //echo $subdivname;?>
	</td>
	<td colspan="8" style="border-top-color:#666666;" class="">
		<?php //echo $description; ?>
	</td>
	<td style="border-top-color:#666666;" width="40px"><?php //echo $slm_cnt."**".$dpm_cnt; ?>&nbsp;</td>
	<td style="border-top-color:#666666;" width="40px"><?php //echo $Line; ?>&nbsp;</td>
	<td style="border-top-color:#666666;" width="40px"><?php //echo $Line; ?>&nbsp;</td>
</tr>-->
<?php 
$rowcount++; $Line++;//echo "A = ".$Line."<br/>";
// if($Line >= 28) { CheckPageBreak($tablehead,$abstmbno,$table,$page);  $Line = $LineIncr; $page++; echo $slm_amount_item."<br/>"; }
//--*************THIS PART IS FOR " PRINT " DEDUCT PREVIOUS MEASUREMENT ( D.P.M. ) SECTION*****************//
	//$QtyDpmSlm_4 = 0;	$PercDpmSlm_4 = 0;	$Dpm_Slm_Amount_4 = 0;	$total_percent_dpm_slm_4 = 0;
	//$QtyDpmSlm_3 = 0;	$PercDpmSlm_3 = 0;	$Dpm_Slm_Amount_3 = 0;	$total_percent_dpm_slm_3 = 0;
//	$QtyDpmSlm_2 = 0;	$PercDpmSlm_2 = 0;	$Dpm_Slm_Amount_2 = 0;	$total_percent_dpm_slm_2 = 0;
//	$QtyDpmSlm_1 = 0;	$PercDpmSlm_1 = 0;	$Dpm_Slm_Amount_1 = 0;	$total_percent_dpm_slm_1 = 0;
//
//	if($dpm_cnt > 0)
//	{
//		$eplodedpm = explode("*", rtrim($dpm_mesurementbook_details,"*"));
//		//echo "D = ".count($eplodedpm)."<br/>";
//		 $DpmTemp = 0;
//		for($x4=0; $x4<count($eplodedpm); $x4+=13)
//		{
//			$dpmqty 				= $eplodedpm[$x4+1];
//			//echo $dpmqty."<br/>";
//			$remarks 				= $eplodedpm[$x4+10];
//			$rbnDpm					= $eplodedpm[$x4+11];
//			$MeasurementbookidDpm	= $eplodedpm[$x4+12];
//			$paymentpercent_dpm 	= $eplodedpm[$x4+7];
//			$dpmamt 				= $dpmqty * $rate * $paymentpercent_dpm / 100;
//			$dummy=0;
//			if(in_array($MeasurementbookidDpm, $DpmArrMbidList)) 
//			{
//				$ArrUniqueVal 	= array_unique($DpmArrMbidList);
//				$UniqueCount 	= count($ArrUniqueVal);
//				$x6=0;
//				$count_1 		= count($DpmArrAmbList);
//				$count_2 		= count($DpmArrAmbPgList);
//				$AMBookNo 		= $DpmArrAmbList[$count_1-1];
//				$AMBookPage 	= $DpmArrAmbList[$count_2-1];
//				while($x6<=$UniqueCount)
//				{
//					$StartKey = $ArrUniqueVal[$x6];
//					$PaidDpmPerc = $DpmArrPercent[$StartKey];
//					$rowspancnt = $UniqueCount+$DpmTemp;
//					$DpmKeyresult = checkPartpayment($DpmArrMbidList,$StartKey);
//					$DpmPercSum = $PaidDpmPerc;
//					if($DpmKeyresult != "")
//					{
//						$explodeDpmKeyresult = explode("*",$DpmKeyresult);
//						for($x7=0; $x7<count($explodeDpmKeyresult); $x7++)
//						{
//							$key = $explodeDpmKeyresult[$x7];
//							$DpmPercSum = $DpmPercSum + $DpmArrPayPercentList[$key];
//						}
//						if(($x6 == 0)&&($DpmTemp == 0))
//						{
//						$DpmQuantityty_1 = $DpmArrQuantityList[$key];
//						$DpmAmount_1 = $DpmQuantityty_1 * $rate * $DpmPercSum /100;
//							if(in_array($StartKey, $SlmArrMbidList))
//							{
//								$Arrkey = array_search($StartKey, $SlmArrMbidList);
//								$QtyDpmSlm_1 = $SlmArrQuantityList[$Arrkey];
//								$PercDpmSlm_1 = $SlmArrPayPercentList[$Arrkey];
//								$Dpm_Slm_Amount_1 = $QtyDpmSlm_1 * $PercDpmSlm_1 * $rate/100;
//							}
//						$total_percent_dpm_slm_1 = $DpmPercSum+$PercDpmSlm_1;
//						
?>
					<!--<tr border='1' bgcolor="#FFFFFF" class="labelprint">
						<td  align='center' width='' class='' rowspan="">&nbsp;</td>
						<td  align='left' width='180px' class='' rowspan="" style="font-size:10px;"></td>
						<td  align='right' width='' class='' rowspan=""></td>
						<td  align='left' width='' class='' rowspan="">&nbsp;</td>
						<td  align='left' width='' class='' rowspan="">&nbsp;</td>
						<td  align='right' width='' class='' rowspan="">&nbsp;</td>
						<td  align='right' width='' class='' rowspan=""></td>
						<td  align='right' width='' class=''></td>
						<td  align='right' width='' class=''>-->
							
						<!--</td>
						<td  align='right' width='6%' class='' rowspan=""></td>
						<td  align='right' width='3%' class='' rowspan="">-->
							
						<!--</td>
						<td  align='center' width='40px' class='' rowspan="" style="font-size:9px;">
							
						</td>
					</tr>-->

							<!--<tr border='1' bgcolor="#FFFFFF" class="labelprint">
								<td  align='right' width='' class=''></td>
								<td  align='right' width='' class=''>-->
								
								<!--</td>
								<td  align='right' width='' class=''></td>
								<td  align='right' width='' class=''>-->
									
								<!--</td>
								<td  align='center' width='40px' class='' rowspan="" style="font-size:9px;">
									
								</td>
							</tr>-->
	
					<!--<tr border='1' bgcolor="#FFFFFF" class="labelprint">
						<td  align='left' width='' class='' rowspan="">&nbsp;</td>
						<td  align='left' width='' class='' style="font-size:10px;" rowspan=""></td>
						<td  align='right' width='' class='' rowspan=""></td>
						<td  align='left' width='' class='' rowspan="">&nbsp;</td>
						<td  align='left' width='' class='' rowspan="">&nbsp;</td>
						<td  align='right' width='' class='' rowspan="">&nbsp;</td>
						<td  align='left' width='' class='' rowspan="">&nbsp;</td>
						<td  align='right' width='' class=''>
						</td>
						<td  align='right' width='' class=''>-->
						<!--</td>
						<td  align='right' width='' class='' rowspan=""></td>
						<td  align='right' width='' class='' rowspan="">-->
						<!--</td>
						<td  align='center' width='' class='' rowspan="" style="font-size:9px;">
							
						</td>
					</tr>	-->
				<!--<tr border='1' bgcolor="#FFFFFF" class="labelprint">
					<td  align='right' width='' class=''></td>
					<td  align='right' width='' class=''>-->
					<!--</td>
						<td  align='right' width='' class=''></td>
						<td  align='right' width='' class=''>--
						<!--</td>
						<td  align='center' width='' class='' rowspan="" style="font-size:9px;">
						</td>
				</tr>-->
		<!--<tr border='1' bgcolor="#FFFFFF" class="labelprint">
			<td  align='left' width='' class='' rowspan="">&nbsp;</td>
			<td  align='left' width='' class='' style="font-size:10px;" rowspan=""></td>
			<td  align='right' width='' class='' rowspan=""></td>
			<td  align='left' width='' class='' rowspan="">&nbsp;</td>
			<td  align='left' width='' class='' rowspan="">&nbsp;</td>
			<td  align='right' width='' class='' rowspan="">&nbsp;</td>
			<td  align='left' width='' class='' rowspan="">&nbsp;</td>
			<td  align='right' width='' class='' rowspan="">&nbsp;</td>
			<td  align='right' width='' class='' rowspan="">&nbsp;</td>
			<td  align='right' width='' class=''>
			</td>
			<td  align='right' width='' class=''>
			</td>
			<td  align='center' width='' class='' style="font-size:9px;">
				
			</td>
		</tr>-->

		<!--<tr border='1' bgcolor="#FFFFFF" class="labelprint">
			<td  align='right' width='' class=''></td>
			<td  align='right' width='' class=''></td>
			<td  align='center' width='' class='' style="font-size:9px;"></td>
		</tr>-->

		<!--<tr border='1' class="labelprint" style="font-size:10px;">
			<td colspan="12" align="left" bgcolor="">Remarks &nbsp; :&nbsp;&nbsp;&nbsp;  </td>
		</tr>-->
	<tr border='1' class="labelprint" bgcolor="">
		<td  align='center' width='' class='labelbold'></td>
		<td  align='left' width='' class=''></td>
		<td  align='center' width='' class=''></td>
		<td  align='center' width='' class=''></td>
		<td  align='right' width='' class=''></td>
		<td  align='right' width='' class=''></td>
		<td  align='right' width='' class=''></td>
		<td  align='right' width='' class=''>&nbsp;</td>
	</tr>
	<input type="hidden" name="row_count" id="row_count" value="" />
	<tr class="labelprint" bgcolor="#F0F0F0">
		<td align="right" colspan="4">Total Cost&nbsp;&nbsp; <i class='fa fa-inr' style=' width:4px; height:5px; font-weight:normal; padding-top:5px;'></i>&nbsp;&nbsp;</td>
		<td>&nbsp;</td>
		<td align="right"></td>
		<td align="right"></td>
		<td>&nbsp;</td>
	</tr>
	<tr class="labelprint">
		<td align="right" colspan="4">Less: Over All Rebate : %&nbsp; <i class='fa fa-inr' style=' width:4px; height:5px; font-weight:normal; padding-top:5px;'></i>&nbsp;&nbsp;</td>
		<td>&nbsp;</td>
		<td align="right"></td>
		<td align="right">/td>
		<td>&nbsp;</td>
	</tr>
	<tr class="labelbold" bgcolor="#F0F0F0">
		<td align="right" colspan="4">Gross Amount&nbsp;&nbsp; <i class='fa fa-inr' style=' width:4px; height:5px; padding-top:5px;'></i>&nbsp;&nbsp;</td>
		<td>&nbsp;</td>
		<td align="right"></td>
		<td align="right"></td>
		<td>&nbsp;</td>
	</tr>
<!--</table>-->
