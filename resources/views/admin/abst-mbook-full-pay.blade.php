<?php
//session_start();
@ob_start();
require_once 'library/config.php';
require_once 'library/functions.php';
require_once 'library/binddata.php';
checkUser();
include "common.php";
$msg = '';
function dt_display($ddmmyyyy)
{
 $dt=explode('-',$ddmmyyyy);
 $dd=$dt[2];
 $mm=$dt[1];
 $yy=$dt[0];
 return $dd . '/' . $mm . '/' . $yy;
}
$staffid = $_SESSION['sid'];
$userid = $_SESSION['userid'];
$rbn = $_SESSION["rbn"]; 
//echo $rbn;exit;
$abstsheetid=$_SESSION["abstsheetid"]; $abstmbno=$_SESSION["abs_mbno"];$abstmbpage=$_SESSION["abs_page"];	
$fromdate = $_SESSION['fromdate']; $todate = $_SESSION['todate']; $abs_mbno_id = $_SESSION["abs_mbno_id"];
//echo $abstmbno; echo "NEXT".$abstmbpage;
if($abstsheetid =='') { echo "<script>alert('Please try again...') </script>"; header('Location: AbsGenerate.php'); }
if($_POST["Submit"] == "Submit")
{	
	//$max_page_abs = $_POST['txt_maxpage'];
//	$update_asb_maxpage = "update mbookallotment set mbpage = '$max_page_abs' WHERE allotmentid	= '$abs_mbno_id' AND sheetid = '$abstsheetid' AND active = 1";
//	//echo $update_asb_maxpage;exit;
//	$update_asb_maxpage_sql = mysql_query($update_asb_maxpage);
//	$oldmbook_query = "SELECT * from oldmbook WHERE sheetid = '$abstsheetid'";
//	$oldmbook_sql = mysql_query($oldmbook_query);
//	if(mysql_num_rows($oldmbook_sql)>0)
//	{
//		while($res = mysql_fetch_array($oldmbook_sql))
//		{
//	$update_mbookallot_query = "UPDATE mbookallotment set active = '0' WHERE sheetid = '$abstsheetid' AND staffid = '$staffid' AND allotmentid = '".$res['old_id']."'";
//	$update_mbookallot_sql = mysql_query($update_mbookallot_query);
//	$update_aggreement_mbookallot_query = "UPDATE agreementmbookallotment set active = '0' WHERE sheetid = '$abstsheetid' AND allotmentid = '".$res['old_id']."'";
//	$update_aggreement_mbookallot_sql = mysql_query($update_aggreement_mbookallot_query); 
//	$oldmbook .= $res['mbname']."*"; 	
//	//echo $update_mbookallot_query."<br/>";
//	//echo $update_aggreement_mbookallot_query."<br/>";	
//		} //echo $oldmbook;exit;
//	} //exit;
//    $currentquantity = trim($_POST['currentquantity']);
//    $mbookquery="INSERT INTO measurementbook  (measurementbookdate, staffid, sheetid, divid, subdivid, fromdate, todate, mbno, mbnopages, mbpage, mbremainpage, mbtotalpages, mbtotal, flag, rbn, active, userid,abstquantity,abstmbookno,abstmbpage)
//                            SELECT  mbgeneratedate, staffid, sheetid, divid, subdivid, fromdate, todate, mbno, mbnopages, mbpage, mbremainpage, mbtotalpages, mbtotal, flag, rbn, active, userid,(abstquantity+mbtotal), $abstmbno,$abstmbpage FROM mbookgenerate";// WHERE flag =1 OR flag = 2"; //AND STAFFID
//   	$mbooksql = mysql_query($mbookquery);   
//    $sheetquery = "UPDATE sheet SET rbn = '$runn_acc_bill_no' WHERE sheetid ='$abstsheetid'";//AND STAFFID
//    $sheetsql = dbQuery($sheetquery);
//	$mbookpage_query = "select distinct mbno from mbookgenerate a WHERE NOT EXISTS(select mbname from oldmbook b WHERE a.mbno = b.mbname AND b.sheetid = '$abstsheetid') AND a.sheetid = '$abstsheetid'";
//	$mbookpage_sql = mysql_query($mbookpage_query);
//	while($result3 = mysql_fetch_array($mbookpage_sql))
//	{
//		$selectmaxpage_query = "select max(mbpage) from mbookgenerate WHERE sheetid	= '$abstsheetid' AND mbno ='".$result3['mbno']."'";
//		//echo $selectmaxpage_query;
//		$selectmaxpage_sql = mysql_query($selectmaxpage_query);
//		$mbookmaxpage = @mysql_result($selectmaxpage_sql,'mbpage');
//		$upademaxpage_query = "update mbookallotment set mbpage = '$mbookmaxpage' WHERE sheetid = '$abstsheetid' AND active = 1 AND mbno ='".$result3['mbno']."'";
//		$upademaxpage_sql = mysql_query($upademaxpage_query);
//		//echo $upademaxpage_query."<br/>";
//	}//exit;
//	$newmbooksql = "DELETE FROM oldmbook WHERE sheetid = '$abstsheetid'";// DELETE NEW MBOOK TABLE
//	$result2 = dbQuery($newmbooksql);
//	$mbookgeneratedelsql = "DELETE FROM mbookgenerate WHERE sheetid ='$abstsheetid'"; //DELETE MBOOK GENERATE TABLE
//    $result1 = dbQuery($mbookgeneratedelsql);
//	$rebate_perc_update_query = "update measurementbook set  pay_percent = '100' where sheetid = '$abstsheetid' AND rbn = '$rbn'";
//	$result3 = dbQuery($rebate_perc_update_query);
	//$mbooktempdelsql = "DELETE FROM measurementbook_temp WHERE sheetid ='$abstsheetid'"; //DELETE MBOOK GENERATE TABLE
//    $result4 = dbQuery($mbooktempdelsql);
//    header('Location: AbsGenerate_Fullpay.php');   
//}
//if($_POST["Back"] == "Back")
//{
//     header('Location: AbsGenerate_Fullpay.php');
//}
//$query = "SELECT    sheetid, sheet_name, short_name, work_order_no, work_name, tech_sanction, name_contractor, agree_no, rbn, rebate_percent FROM sheet WHERE sheetid ='$abstsheetid' ";
////echo $query;
//$sqlquery = mysql_query($query);
//if ($sqlquery == true) 
//{
//    $List = mysql_fetch_object($sqlquery);
//    $work_name = $List->work_name;   
//	$short_name = $List->short_name; 
//	$tech_sanction = $List->tech_sanction;  
//    $name_contractor = $List->name_contractor;    
//	$agree_no = $List->agree_no; 
//	$overall_rebate_perc = $List->rebate_percent; 
//	$runn_acc_bill_no = $rbn;
//	$work_order_no = $List->work_order_no; /*   if($List->rbn == 0){$runn_acc_bill_no =1;  } else { $runn_acc_bill_no=$List->rbn +1;}*/
//	$length = strlen($work_name);
 	//$start_line = ceil($length/70);  
//    $querys = "SELECT mb_id, sheetid, mb_date, fromdate, todate, mb_no, mb_page, rbn, active FROM mbookgenerate WHERE active =1
//        AND sheetid ='$abstsheetid'  AND mb_id in(1,2)";//'$id'";
////echo $querys;
//$sqlquerys = mysql_query($querys);
//$Lists = mysql_fetch_object($sqlquerys);
// $mb_page = $Lists->mb_page;
//}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Abstrack MBook</title>
		<link rel="stylesheet" href="Font style/font.css" />
        <link rel="stylesheet" href="script/font.css" />
     <script type="text/javascript">
		function showpage(textvalue,txtvalue)
		{
			//alert("text   " +textvalue +"  value   " +txtvalue)
			document.getElementById(textvalue).value = "B/f from P"+txtvalue +" TMS";
			  
		}
   	</script>
     <style>
	 	.pagetitle
		{
			text-shadow:
			-1px -1px 0 #7F7F7F,
			1px -1px 0 #7F7F7F,
			-1px 1px 0 #7F7F7F,
			1px 1px 0 #7F7F7F; 
		}
		.labelheadblue{
		color:#0000CD;
		font-weight:bold;
		font-size:12px;
		}
		.labelheadred{
		color:#BF0602;
		font-weight:bold;
		font-size:12px;
		}
		.labelcontentblue
		{
		color:#0000CD;
		font-weight:bold;
		font-size:12pt;	
		}
		.label
		{
			color:#0000CD;
		}
		.right {
			position: absolute;
			right: 0px;
			width: 300px;
			background-color: #b0e0e6;
		}
		table{ border-collapse: collapse; }
			td { border: 1px solid #CACACA; }
			@media screen {
				div.divFooter {
					display: none;
				}
			}
			@media print {
				div.divFooter {
					position: fixed;
					bottom: 0;
				}
				.printbutton
				{
				display: none !important;
				 }
				}
	</style>
    </head>

    <script language="javascript" type="text/javascript" src="script/Date_Calendar.js"></script>
    <script language="javascript" type="text/javascript" src="script/validfn.js"></script>
	<link rel="stylesheet" href="css/button_style.css"></link>
	<link rel="stylesheet" href="js/jquery-ui.css">
  	<script src="js/jquery-1.10.2.js"></script>
  	<script src="js/jquery-ui.js"></script>
  	<link rel="stylesheet" href="/resources/demos/style.css">
    <script type="text/javascript" language="javascript">
        function pnr()
        {
            x = confirm("NOTE: Set Paper Size A4, and 0.5 inch Margin to TOP,BOTTOM,LEFT,RIGHT.\n\nReady to Print-out ?")
            if (x == true)
            {
                document.getElementById("btn_print").style.display = 'none'
                window.print();
            }
        }
		function goBack()
		{
			url = "AbsGenerate_Fullpay.php";
			window.location.replace(url);
		}
    </script>
<SCRIPT type="text/javascript">
		window.history.forward();
		function noBack() { window.history.forward(); }
	</SCRIPT>
<body bgcolor="black" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="" style="padding:0; margin:0;">
<table width="1087px" height="56px" align="center" class='label' bgcolor="#20b2aa">
<tr bgcolor="#20b2aa" style="position:fixed">
<td style="color:#FFFFFF; border:none; font-size:16px;" width="1085px" height="56px" class="pagetitle" align="center">ABSTRACT MEASUREMENT BOOK - FULL PAYMENT</td>
</tr>
</table>
<form name="form" method="post">
<?php
//$title = '<table width="1087px" border="0"  cellpadding="1" cellspacing="1" align="center" bgcolor="#FFFFFF" style="border:none;" class = "label">
//			<tr style="border:none;"><td align="right" style="border:none;">Abstract M.Book No. '.$abstmbno.'&nbsp;&nbsp;<br/>&nbsp;</td></tr>
//			</table>';
//echo $title;
//$table = $table . "<table width='1087px'  bgcolor='#f2f5f9' border='0' cellpadding='2' cellspacing='2' align='center' >";
//$table = $table . "<tr>";
//$table = $table . "<td width='17%' class='labelbold labelheadblue'>Name of work:</td>";
//$table = $table . "<td width='43%' style='word-wrap:break-word' class='labelbold labelheadred'>" .$work_name."</td>";
//$table = $table . "<td width='18%' class='labelbold labelheadblue'>Name of the contractor</td>";
//$table = $table . "<td width='22%' class='labelbold labelheadred'>" . $name_contractor . "</td>";
//$table = $table . "</tr>";
//$table = $table . "<tr>";
//$table = $table . "<td class='labelbold labelheadblue'>Technical Sanction No.</td>";
//$table = $table . "<td class='labelbold labelheadred'>" . $tech_sanction . "</td>";
//$table = $table . "<td class='labelbold labelheadblue'>Agreement No.</td>";
//$table = $table . "<td class='labelbold labelheadred'>" . $agree_no . "</td>";
//$table = $table . "</tr>";
//$table = $table . "<tr>";
//$table = $table . "<td class='labelbold labelheadblue'>Work order No.</td>";
//$table = $table . "<td class='labelbold labelheadred'>" . $work_order_no . "</td>";
//$table = $table . "<td class='labelbold labelheadblue'>Running Account bill No.</td>";
//$table = $table . "<td class='labelheadred'>" . $runn_acc_bill_no . "</td>";
//$table = $table . "</tr>";
//$table = $table . "<tr>";
//$table = $table . "<td colspan ='4' class='label labelheadblue' align='center'>Abstract Cost for ".$short_name." for the period of ".date("d/m/Y", strtotime($fromdate))." to ".date("d/m/Y", strtotime($todate))."</td>";
//$table = $table . "</tr>";
//$table = $table . "</table>";
//$table = $table . "<table width='1087px'  bgcolor='#f2f5f9' border='1' cellpadding='2' cellspacing='2' align='center' id='mbookdetail' class='label'>";
//$table = $table . "<tr>";
//$table = $table . "<td  align='center' class='labelsmall labelheadblue' width='7%' rowspan='2'>Item No.</td>";
//$table = $table . "<td  align='center' class='labelsmall labelheadblue' width='20%' rowspan='2'>Description of work</td>";
//$table = $table . "<td  align='center' class='labelsmall labelheadblue' width='8%' rowspan='2'>Contents of Area</td>";
//$table = $table . "<td  align='center' class='labelsmall labelheadblue' width='7%' rowspan='2'>Rate<br />Rs.  P.</td>";
//$table = $table . "<td  align='center' class='labelsmall labelheadblue' width='4%' rowspan='2'>Per</td>";
//$table = $table . "<td  align='center' class='labelsmall labelheadblue' width='10%' rowspan='2'>Total value to Date<br />Rs.  P.</td>";
//$table = $table . "<td  align='center' class='labelsmall labelheadblue' width='' colspan='3'>Deduct previous Measurements</td>";
//$table = $table . "<td  align='center' class='labelsmall labelheadblue' width='' colspan='2'>Since Last Measurement</td>";
//$table = $table . "<td  align='center' class='labelsmall labelheadblue' width='5%' rowspan='2'>Remark</td>";
//$table = $table . "</tr>";
//$table = $table . "<tr>";
//$table = $table . "<td width='5%' align='center' class='labelsmall labelheadblue'>Page</td>";
//$table = $table . "<td width='7%' align='center' class='labelsmall labelheadblue'>Quantity</td>";
//$table = $table . "<td  width='10%'align='center' class='labelsmall labelheadblue'>Amount<br />Rs.  P.</td>";
//$table = $table . "<td width='7%' align='center' class='labelsmall labelheadblue'>Quantity</td>";
//$table = $table . "<td  width='10%' align='center' class='labelsmall labelheadblue'>Value<br />Rs.  P.</td>";
//$table = $table . "</tr>";
//$table = $table . "</table>";
?>
<?php //echo $table; ?>

<table width='1087px' border='0' cellpadding='3' cellspacing='3' align='center' class='label' bgcolor="#FFFFFF">
<?php 
//$prev_subdivid = ""; $prev_measure_qty = 0;$currentline = $start_line + 6; $page = $abstmbpage;//echo $currentline;
//$unionqur = "(SELECT subdivid  FROM mbookgenerate WHERE sheetid = '$abstsheetid') UNION (SELECT subdivid  FROM measurementbook WHERE sheetid = '$abstsheetid')";
////echo $unionqur;exit; 
//$unionsql = mysql_query($unionqur);
//while($Listsubdivid = mysql_fetch_array($unionsql)) { $subdivid_list .= $Listsubdivid['subdivid']."*"; }
//$subdivisionlist_1 = explode("*",rtrim($subdivid_list,"*"));
////echo count($subdivisionlist);
//natsort($subdivisionlist_1);
//foreach($subdivisionlist_1 as $key => $summ_1)
//{
//   if($summ_1 != "")
//   {
//      $subdivisionlist_2 .= $summ_1.",";
//   }
//}
//$subdivisionlist = explode(',',rtrim($subdivisionlist_2,","));
//$co_bf_tot_qty = 0; $co_bf_tot_amt = 0; $co_bf_prev_total_qty = 0; $co_bf_prev_total_amt = 0; $co_bf_slast_total_qty = 0; $co_bf_slast_total_amt = 0;
//for($i=0;$i<count($subdivisionlist);$i++)
//{
//	$decimal = get_decimal_placed($subdivisionlist[$i],$abstsheetid);
//	/*if($currentline>32)
//	{
?>
<tr>
	<td  align='left' width='7%' class='labelsmall'>&nbsp;</td>
	<td  align='left' width='20%' class='labelsmall'><?php //echo "C/o to Page ".($page+1);?></td>
	<td  align='right' width='8%' class='labelsmall'><?php //echo $co_bf_tot_qty; ?></td>
	<td  align='left' width='7%' class='labelsmall'>&nbsp;</td>
	<td  align='left' width='4%' class='labelsmall'>&nbsp;</td>
	<td  align='right' width='10%' class='labelsmall'><?php //echo number_format($co_bf_tot_amt, 2, '.', ''); ?></td>
	<td  align='left' width='5%' class='labelsmall'>&nbsp;</td>
	<td  align='right' width='7%' class='labelsmall'><?php //echo $co_bf_prev_total_qty; ?></td>
	<td  align='right' width='10%' class='labelsmall'><?php //echo number_format($co_bf_prev_total_amt, 2, '.', ''); ?></td>
	<td  align='right' width='7%' class='labelsmall'><?php //echo $co_bf_slast_total_qty; ?></td>
	<td  align='right' width='10%' class='labelsmall'><?php //echo number_format($co_bf_slast_total_amt, 2, '.', ''); ?></td>
	<td  align='left' width='5%' class='labelsmall'>&nbsp;</td>
</tr>
<?php 
		//echo "</table>"; //echo "IIII".$currentline;
		/*for($x=$currentline;$x<36;$x++)
		{
			echo "&nbsp"."<br/>";
		}
		$currentline = $start_line + 8;
		$page++;
		echo $table; 
		echo "<table width='100%' bgcolor='white'   border='0' cellpadding='0' cellspacing='0' align='left' class='label'>";
?>
<tr>
	<td  align='left' width='7%' class='labelsmall'>&nbsp;</td>
	<td  align='left' width='20%' class='labelsmall'><?php echo "B/f from Page ".$prevpage;?></td>
	<td  align='right' width='8%' class='labelsmall'><?php echo $co_bf_tot_qty; ?></td>
	<td  align='left' width='7%' class='labelsmall'>&nbsp;</td>
	<td  align='left' width='4%' class='labelsmall'>&nbsp;</td>
	<td  align='right' width='10%' class='labelsmall'><?php echo number_format($co_bf_tot_amt, 2, '.', ''); ?></td>
	<td  align='left' width='5%' class='labelsmall'>&nbsp;</td>
	<td  align='right' width='7%' class='labelsmall'><?php echo $co_bf_prev_total_qty; ?></td>
	<td  align='right' width='10%' class='labelsmall'><?php echo number_format($co_bf_prev_total_amt, 2, '.', ''); ?></td>
	<td  align='right' width='7%' class='labelsmall'><?php echo $co_bf_slast_total_qty; ?></td>
	<td  align='right' width='10%' class='labelsmall'><?php echo number_format($co_bf_slast_total_amt, 2, '.', ''); ?></td>
	<td  align='left' width='5%' class='labelsmall'>&nbsp;</td>
</tr>
<?php 
	}*/
	//$mbookquery = "SELECT * FROM measurementbook WHERE subdivid = '$subdivisionlist[$i]' AND sheetid = '$abstsheetid'";
//	$mbooksql = mysql_query($mbookquery);
//	if(mysql_num_rows($mbooksql)>0)
//	{
//		while($MBList = mysql_fetch_array($mbooksql))
//		{
//			$mesurementbook_details .= $MBList['subdivid']."*".$MBList['mbtotal']."*".$MBList['abstmbookno']."*".$MBList['abstmbpage']."*";
//		}
//		$explodval = explode("*",rtrim($mesurementbook_details,"*"));//echo count($explodval)."<br/>";
//		$prev_measurement_qty = 0;
//		for($j=0;$j<count($explodval);$j+=4)
//		{
//			$prev_measurement_qty = $prev_measurement_qty + $explodval[$j+1];
//			$mbno_dp = $explodval[$j+2];
//			$mbpageno_dp = $explodval[$j+3];
//		}
//	}
//	else
//	{
//		$prev_measurement_qty = 0;
//		$mbno_dp = "";
//		$mbpageno_dp = "";
//	} 
//	
//	$mesurementbook_details = "";
//	$mbookgeneratequery = "SELECT * FROM mbookgenerate WHERE subdivid = '$subdivisionlist[$i]' AND sheetid = '$abstsheetid'";
//	$mbookgeneratesql = mysql_query($mbookgeneratequery);
//	if(mysql_num_rows($mbookgeneratesql)>0)
//	{
//		while($MBGENList = mysql_fetch_array($mbookgeneratesql))
//		{
//			$mesurementgenerate_details .= $MBGENList['subdivid']."*".$MBGENList['mbtotal']."*".$MBGENList['mbno']."*".$MBGENList['mbpage']."*";
//		}
//		$explodedval = explode("*",rtrim($mesurementgenerate_details,"*"));//echo $mesurementgenerate_details."<br/>";
//		$sincelast_measurement_qty = 0;
//		for($k=0;$k<count($explodedval);$k+=4)
//		{
//			$sincelast_measurement_qty = $sincelast_measurement_qty + $explodedval[$k+1];
//			$mbno_sl = $explodedval[$k+2];
//			$mbpageno_sl = $explodedval[$k+3];
//		}
//	}
//	else
//	{
//		$sincelast_measurement_qty = 0;
//		$mbno_sl = "";
//		$mbpageno_sl = "";		
//	} 
//$schduledetails = getschduledetails($abstsheetid,$subdivisionlist[$i]);
//$rateandremarks = explode('*',$schduledetails);
//$total_quantity = $sincelast_measurement_qty + $prev_measurement_qty;
//$descript_len = strlen(getscheduledescription($subdivisionlist[$i]));
//$line_increment = ceil($descript_len/150);	
//$currentline = $currentline + $line_increment;
//if($currentline>25)
//	{
?>
<tr class="labelheadblue">
	<td  align='left' width='7%' class='labelsmall'>&nbsp;</td>
	<td  align='left' width='20%' class='labelsmall labelheadblue'><?php //echo "C/o to Page ".($page+1)."/Abstract MB No ".$abstmbno;?></td>
	<td  align='right' width='8%' class='labelsmall'><?php //echo $co_bf_tot_qty; ?></td>
	<td  align='left' width='7%' class='labelsmall'>&nbsp;</td>
	<td  align='left' width='4%' class='labelsmall'>&nbsp;</td>
	<td  align='right' width='10%' class='labelsmall'><?php //echo number_format($co_bf_tot_amt, 2, '.', ''); ?></td>
	<td  align='left' width='5%' class='labelsmall'>&nbsp;</td>
	<td  align='right' width='7%' class='labelsmall'><?php //echo $co_bf_prev_total_qty; ?></td>
	<td  align='right' width='10%' class='labelsmall'><?php //echo number_format($co_bf_prev_total_amt, 2, '.', ''); ?></td>
	<td  align='right' width='7%' class='labelsmall'><?php //echo $co_bf_slast_total_qty; ?></td>
	<td  align='right' width='10%' class='labelsmall'><?php //echo number_format($co_bf_slast_total_amt, 2, '.', ''); ?></td>
	<td  align='left' width='5%' class='labelsmall'>&nbsp;</td>
</tr>
<?php 
		//echo "<tr style='border:none'><td colspan='12' style='border:none' align='center'><br/>Page ".$page."</td></tr>";
//		echo "</table>"; //echo "SSSS".$currentline;
//		/*for($x=$currentline;$x<43;$x++)
//		{
//			echo "&nbsp"."<br/>";
//		}*/
//		echo "<p  style='page-break-after:always;'></p>";
//		$currentline = $start_line + 8;
//		$page++;
//		echo $title;
//		echo $table; 
//		echo "<table width='1087px' bgcolor='white'   border='0' cellpadding='3' cellspacing='3' align='center' class='label'>";
?>
<tr class="labelheadblue">
	<td  align='left' width='7%' class='labelsmall'>&nbsp;</td>
	<td  align='left' width='20%' class='labelsmall labelheadblue'><?php //echo "B/f from Page ".$prevpage."/Abstract MB No ".$abstmbno;?></td>
	<td  align='right' width='8%' class='labelsmall'><?php //echo $co_bf_tot_qty; ?></td>
	<td  align='left' width='7%' class='labelsmall'>&nbsp;</td>
	<td  align='left' width='4%' class='labelsmall'>&nbsp;</td>
	<td  align='right' width='10%' class='labelsmall'><?php //echo number_format($co_bf_tot_amt, 2, '.', ''); ?></td>
	<td  align='left' width='5%' class='labelsmall'>&nbsp;</td>
	<td  align='right' width='7%' class='labelsmall'><?php //echo $co_bf_prev_total_qty; ?></td>
	<td  align='right' width='10%' class='labelsmall'><?php //echo number_format($co_bf_prev_total_amt, 2, '.', ''); ?></td>
	<td  align='right' width='7%' class='labelsmall'><?php //echo $co_bf_slast_total_qty; ?></td>
	<td  align='right' width='10%' class='labelsmall'><?php //echo number_format($co_bf_slast_total_amt, 2, '.', ''); ?></td>
	<td  align='left' width='5%' class='labelsmall'>&nbsp;</td>
</tr>
<?php 
	//}
?>
<tr>
	<td width="7%" align="center"><?php //echo getsubdivname($subdivisionlist[$i]);?></td>
	<td colspan="11"><?php //echo getscheduledescription($subdivisionlist[$i]); ?></td>
</tr>
<?php
//$mbooktype_query = "select flag from mbookgenerate WHERE subdivid = '$subdivisionlist[$i]' AND sheetid = '$abstsheetid'";
////echo "$mbooktype_query"."<br/>";
//$mbooktype_sql = mysql_query($mbooktype_query);
//$flagtype = @mysql_result($mbooktype_sql,0,'flag');
//if($flagtype == 1) { $mbookdescription = "/General MB No."; }
//if($flagtype == 2) { $mbookdescription = "/Steel MB No."; }
 ?>
<!--<tr>
	<td width="7%"></td>
	<td colspan="11" style="word-wrap:break-word;">ddddddddddddddddddddddddddddddddddddddddddddddd</td>
</tr>-->
<?php //if($prev_measurement_qty != 0) { ?>
<tr>
	<td  align='left' width='7%' class='labelsmall'>&nbsp;</td>
	<td  align='left' width='20%' class='labelsmall'><?php //echo "Prev-Qty Vide P ".$mbpageno_dp."/Abstract MB No ".$mbno_dp; ?></td>
	<td  align='right' width='8%' class='labelsmall'><?php //echo number_format($prev_measurement_qty, $decimal, '.', ''); ?></td>
	<td  align='left' width='7%' class='labelsmall'>&nbsp;</td>
	<td  align='left' width='4%' class='labelsmall'>&nbsp;</td>
	<td  align='right' width='10%' class='labelsmall'>&nbsp;</td>
	<td  align='left' width='5%' class='labelsmall'>&nbsp;</td>
	<td  align='left' width='7%' class='labelsmall'>&nbsp;</td>
	<td  align='right' width='10%' class='labelsmall'>&nbsp;</td>
	<td  align='left' width='7%' class='labelsmall'>&nbsp;</td>
	<td  align='right' width='10%' class='labelsmall'>&nbsp;</td>
	<td  align='left' width='5%' class='labelsmall'>&nbsp;</td>
</tr>
<?php //} ?>
<?php //if($sincelast_measurement_qty != 0) { ?>
<tr>
	<td  align='left' width='7%' class='labelsmall'>&nbsp;</td>
	<td  align='left' width='20%' class='labelsmall'><?php //echo "Qty Vide P ".$mbpageno_sl.$mbookdescription.$mbno_sl; ?></td>
	<td  align='right' width='8%' class='labelsmall'><?php //echo number_format($sincelast_measurement_qty, $decimal, '.', ''); ?></td>
	<td  align='left' width='7%' class='labelsmall'>&nbsp;</td>
	<td  align='left' width='4%' class='labelsmall'>&nbsp;</td>
	<td  align='right' width='10%' class='labelsmall'>&nbsp;</td>
	<td  align='left' width='5%' class='labelsmall'>&nbsp;</td>
	<td  align='left' width='7%' class='labelsmall'>&nbsp;</td>
	<td  align='right' width='10%' class='labelsmall'>&nbsp;</td>
	<td  align='left' width='7%' class='labelsmall'>&nbsp;</td>
	<td  align='right' width='10%' class='labelsmall'>&nbsp;</td>
	<td  align='left' width='5%' class='labelsmall'>&nbsp;</td>
</tr>
<?php //} ?>
<tr>
	<td  align='left' width='7%' class='labelsmall'>&nbsp;</td>
	<td  align='right' width='20%' class='labelsmall labelheadred'>Total</td>
	<td  align='right' width='8%' class='labelheadred'>
		<?php 
		//echo number_format($total_quantity, $decimal, '.', ''); 
		//$co_bf_tot_qty = $co_bf_tot_qty + $total_quantity; 
		?>
	</td>
	<td  align='right' width='7%' class='labelheadred'><?php //echo $rateandremarks[0]; ?></td>
	<td  align='left' width='4%' class='labelheadred'><?php //echo $rateandremarks[1]; ?></td>
	<td  align='right' width='10%' class='labelsmall labelheadred'>
		<?php 
		//echo number_format(($total_quantity*$rateandremarks[0]), 2, '.', ''); 
		//$co_bf_tot_amt = $co_bf_tot_amt + ($total_quantity*$rateandremarks[0]); 
		?>
	</td>
	<td  align='left' width='5%' class='labelheadred'>&nbsp;</td>
	<td  align='right' width='7%' class='labelheadred'>
		<?php 
		//echo number_format($prev_measurement_qty, $decimal, '.', ''); 
		//$co_bf_prev_total_qty = $co_bf_prev_total_qty + $prev_measurement_qty;
		?>
	</td>
	<td  align='right' width='10%' class='labelsmall labelheadred'>
		<?php 
		//echo number_format(($prev_measurement_qty*$rateandremarks[0]), 2, '.', ''); 
		//$co_bf_prev_total_amt = $co_bf_prev_total_amt + ($prev_measurement_qty*$rateandremarks[0]);
		?>
	</td>
	<td  align='right' width='7%' class='labelheadred'>
		<?php 
		//echo number_format($sincelast_measurement_qty, $decimal, '.', ''); 
		//$co_bf_slast_total_qty = $co_bf_slast_total_qty + $sincelast_measurement_qty; 
		?>
	</td>
	<td  align='right' width='10%' class='labelsmall labelheadred'>
		<?php 
		//echo number_format(($sincelast_measurement_qty*$rateandremarks[0]), 2, '.', ''); 
		//$co_bf_slast_total_amt = $co_bf_slast_total_amt + ($sincelast_measurement_qty*$rateandremarks[0]);
		?>
	</td>
	<td  align='left' width='5%' class='labelsmall'>&nbsp;</td>
</tr>
<tr bgcolor="">
	<td  align='left' width='' class='labelsmall'>&nbsp;</td>
	<td  align='left' width='' class='labelsmall'>&nbsp;</td>
	<td  align='right' width='' class='labelsmall'>&nbsp;</td>
	<td  align='left' width='' class='labelsmall'>&nbsp;</td>
	<td  align='left' width='' class='labelsmall'>&nbsp;</td>
	<td  align='right' width='' class='labelsmall'>&nbsp;</td>
	<td  align='left' width='' class='labelsmall'>&nbsp;</td>
	<td  align='right' width='' class='labelsmall'>&nbsp;</td>
	<td  align='right' width='' class='labelsmall'>&nbsp;</td>
	<td  align='right' width='' class='labelsmall'>&nbsp;</td>
	<td  align='right' width='' class='labelsmall'>&nbsp;</td>
	<td  align='left' width='' class='labelsmall'>&nbsp;</td>
</tr>
<?php
//$str .= $subdivisionlist[$i].",".$page.",";
//$total_quantity = 0;$mesurementgenerate_details = ""; $currentline+=5; $prevpage = $page;
//}
?>
<!--<tr bgcolor="#CCFFFF">
	<td  align='left' width='7%' class='labelsmall'>&nbsp;</td>
	<td  align='left' width='20%' class='labelsmall'><?php //echo "B/f from Page ".$prevpage;?></td>
	<td  align='right' width='8%' class='labelsmall'><?php //echo $co_bf_tot_qty; ?></td>
	<td  align='left' width='7%' class='labelsmall'>&nbsp;</td>
	<td  align='left' width='4%' class='labelsmall'>&nbsp;</td>
	<td  align='right' width='10%' class='labelsmall'><?php //echo number_format($co_bf_tot_amt, 2, '.', ''); ?></td>
	<td  align='left' width='5%' class='labelsmall'>&nbsp;</td>
	<td  align='right' width='7%' class='labelsmall'><?php //echo $co_bf_prev_total_qty; ?></td>
	<td  align='right' width='10%' class='labelsmall'><?php //echo number_format($co_bf_prev_total_amt, 2, '.', ''); ?></td>
	<td  align='right' width='7%' class='labelsmall'><?php //echo $co_bf_slast_total_qty; ?></td>
	<td  align='right' width='10%' class='labelsmall'><?php //echo number_format($co_bf_slast_total_amt, 2, '.', ''); ?></td>
	<td  align='left' width='5%' class='labelsmall'>&nbsp;</td>
</tr>-->
<?php 

//if($currentline>25)
	//{
?>
<tr class="labelheadblue">
	<td  align='left' width='7%' class='labelsmall'>&nbsp;</td>
	<td  align='left' width='20%' class='labelsmall'><?php //echo "C/o to Page ".($page+1);?></td>
	<td  align='right' width='8%' class='labelsmall'><?php //echo $co_bf_tot_qty; ?></td>
	<td  align='left' width='7%' class='labelsmall'>&nbsp;</td>
	<td  align='left' width='4%' class='labelsmall'>&nbsp;</td>
	<td  align='right' width='10%' class='labelsmall'><?php //echo number_format($co_bf_tot_amt, 2, '.', ''); ?></td>
	<td  align='left' width='5%' class='labelsmall'>&nbsp;</td>
	<td  align='right' width='7%' class='labelsmall'><?php //echo $co_bf_prev_total_qty; ?></td>
	<td  align='right' width='10%' class='labelsmall'><?php //echo number_format($co_bf_prev_total_amt, 2, '.', ''); ?></td>
	<td  align='right' width='7%' class='labelsmall'><?php //echo $co_bf_slast_total_qty; ?></td>
	<td  align='right' width='10%' class='labelsmall'><?php //echo number_format($co_bf_slast_total_amt, 2, '.', ''); ?></td>
	<td  align='left' width='5%' class='labelsmall'>&nbsp;</td>
</tr>
<?php 
		//echo "<tr style='border:none'><td colspan='12' style='border:none' align='center'><br/>Page ".$page."</td></tr>";
//		echo "</table>"; //echo "SSSS".$currentline;
//		/*for($x=$currentline;$x<43;$x++)
//		{
//			echo "&nbsp"."<br/>";
//		}*/
//		echo "<p  style='page-break-after:always;'></p>";
//		$currentline = $start_line + 8;
//		$page++;
//		echo $title;
//		echo $table; 
//		echo "<table width='1087px' bgcolor='white'   border='0' cellpadding='3' cellspacing='3' align='center' class='label'>";
?>
<tr class="labelheadblue">
	<td  align='left' width='7%' class='labelsmall'>&nbsp;</td>
	<td  align='left' width='20%' class='labelsmall'><?php //echo "B/f from Page ".$prevpage;?></td>
	<td  align='right' width='8%' class='labelsmall'><?php //echo $co_bf_tot_qty; ?></td>
	<td  align='left' width='7%' class='labelsmall'>&nbsp;</td>
	<td  align='left' width='4%' class='labelsmall'>&nbsp;</td>
	<td  align='right' width='10%' class='labelsmall'><?php //echo number_format($co_bf_tot_amt, 2, '.', ''); ?></td>
	<td  align='left' width='5%' class='labelsmall'>&nbsp;</td>
	<td  align='right' width='7%' class='labelsmall'><?php //echo $co_bf_prev_total_qty; ?></td>
	<td  align='right' width='10%' class='labelsmall'><?php // echo number_format($co_bf_prev_total_amt, 2, '.', ''); ?></td>
	<td  align='right' width='7%' class='labelsmall'><?php //echo $co_bf_slast_total_qty; ?></td>
	<td  align='right' width='10%' class='labelsmall'><?php //echo number_format($co_bf_slast_total_amt, 2, '.', ''); ?></td>
	<td  align='left' width='5%' class='labelsmall'>&nbsp;</td>
</tr>
<?php 
	//}
?>

<tr bgcolor="">
	<td  align='left' width='7%' class='labelsmall'>&nbsp;</td>
	<td  align='left' width='20%' class='labelsmall labelheadblue'><?php //echo "Total Cost"; ?></td>
	<td  align='right' width='8%' class='labelsmall'><?php //echo $co_bf_tot_qty; ?></td>
	<td  align='left' width='7%' class='labelsmall'>&nbsp;</td>
	<td  align='left' width='4%' class='labelsmall'>&nbsp;</td>
	<td  align='right' width='10%' class='labelsmall labelheadblue'><?php //echo number_format($co_bf_tot_amt, 2, '.', ''); ?></td>
	<td  align='left' width='5%' class='labelsmall'>&nbsp;</td>
	<td  align='right' width='7%' class='labelsmall'><?php //echo $co_bf_prev_total_qty; ?></td>
	<td  align='right' width='10%' class='labelsmall labelheadblue'><?php //echo number_format($co_bf_prev_total_amt, 2, '.', ''); ?></td>
	<td  align='right' width='7%' class='labelsmall'><?php //echo $co_bf_slast_total_qty; ?></td>
	<td  align='right' width='10%' class='labelsmall labelheadblue'><?php //echo number_format($co_bf_slast_total_amt, 2, '.', ''); ?></td>
	<td  align='left' width='5%' class='labelsmall'>&nbsp;</td>
</tr>
<?php
//$todate_rebate_amt 	= number_format($co_bf_tot_amt, 2, '.', '') * $overall_rebate_perc / 100;
//$dpm_rebate_amt 	= number_format($co_bf_prev_total_amt, 2, '.', '') * $overall_rebate_perc / 100;
//$slm_rebate_amt		= number_format($co_bf_slast_total_amt, 2, '.', '') * $overall_rebate_perc / 100;
//
//$overall_todate_amt_with_rebate = number_format($co_bf_tot_amt, 2, '.', '') - number_format($todate_rebate_amt, 2, '.', '');
//$overall_dpm_amt_with_rebate 	= number_format($co_bf_prev_total_amt, 2, '.', '') - number_format($dpm_rebate_amt, 2, '.', '');
//$overall_slm_amt_with_rebate 	= number_format($co_bf_slast_total_amt, 2, '.', '') - number_format($slm_rebate_amt, 2, '.', '');
?>
<tr bgcolor="">
	<td  align='left' width='7%' class='labelsmall'>&nbsp;</td>
	<td  align='left' width='20%' class='labelsmall labelheadblue'><?php //echo "Less Overall Rebate = ".$overall_rebate_perc." %"; ?></td>
	<td  align='right' width='8%' class='labelsmall'></td>
	<td  align='left' width='7%' class='labelsmall'>&nbsp;</td>
	<td  align='left' width='4%' class='labelsmall'>&nbsp;</td>
	<td  align='right' width='10%' class='labelsmall labelheadblue'><?php //echo number_format($todate_rebate_amt, 2, '.', ''); ?></td>
	<td  align='left' width='5%' class='labelsmall'>&nbsp;</td>
	<td  align='right' width='7%' class='labelsmall'></td>
	<td  align='right' width='10%' class='labelsmall labelheadblue'><?php //echo number_format($dpm_rebate_amt, 2, '.', ''); ?></td>
	<td  align='right' width='7%' class='labelsmall'></td>
	<td  align='right' width='10%' class='labelsmall labelheadblue'><?php //echo number_format($slm_rebate_amt, 2, '.', ''); ?></td>
	<td  align='left' width='5%' class='labelsmall'>&nbsp;</td>
</tr>
<tr bgcolor="" class="labelheadblue">
	<td  align='left' width='7%' class='labelsmall'>&nbsp;</td>
	<td  align='left' width='20%' class='labelsmall labelheadblue'><?php //echo "Gross Amount (Rs.) "; ?></td>
	<td  align='right' width='8%' class='labelsmall'></td>
	<td  align='left' width='7%' class='labelsmall'>&nbsp;</td>
	<td  align='left' width='4%' class='labelsmall'>&nbsp;</td>
	<td  align='right' width='10%' class='labelsmall labelheadblue'><?php //echo number_format($overall_todate_amt_with_rebate, 2, '.', ''); ?></td>
	<td  align='left' width='5%' class='labelsmall'>&nbsp;</td>
	<td  align='right' width='7%' class='labelsmall'></td>
	<td  align='right' width='10%' class='labelsmall labelheadblue'><?php //echo number_format($overall_dpm_amt_with_rebate, 2, '.', ''); ?></td>
	<td  align='right' width='7%' class='labelsmall'></td>
	<td  align='right' width='10%' class='labelsmall labelheadblue'><?php //echo number_format($overall_slm_amt_with_rebate, 2, '.', ''); ?></td>
	<td  align='left' width='5%' class='labelsmall'>&nbsp;</td>
</tr>
<tr style='border:none'>
	<td colspan='6' style='border:none' align='right'><br/><br/><br/>Page <?php //echo $page; ?></td>
	<td colspan='6' style='border:none' align='center'><!--<br/><br/><br/>Prepared By--></td>
</tr>
</table>
<?php 
//$abstractpagelist = explode(",",rtrim($str,","));
//for($k=0; $k<count($abstractpagelist); $k+=2)
//{
//$update_abstractpage_query = "update mbookgenerate set abstmbpage = '".$abstractpagelist[$k+1]."' WHERE subdivid = '".$abstractpagelist[$k]."' AND sheetid = '$abstsheetid'";
//$update_abstractpage_sql = mysql_query($update_abstractpage_query);
//echo $update_abstractpage_query."<br/>";
//}
 ?>
<input type="hidden" name="txt_abstmbno" id="txt_abstmbno" value="<?php //echo $abstmbno; ?>" />
<input type="hidden" name="txt_maxpage" id="txt_maxpage" value="<?php //echo $page+4; ?>" /> <!--- This is for page no update - inclue empty page($page+4) -->
<!--<table border="0" width="13%" align="center" style="border-style:none" class="printbutton">
	<tr border="0" style="border-style:none">
		<td border="0" style="border-style:none">&nbsp;
		</td>
	</tr>
	<tr border="0" style="border-style:none">
		<td border="0" style="border-style:none">
			<input type="Submit" name="Submit" value="Submit" /> &nbsp;&nbsp;&nbsp; 
			<input type="submit" name="Back" value="Back" /> 
		</td>
	</tr>
</table> -->
<div align="center" class="btn_outside_sect printbutton">
	<div class="btn_inside_sect"><input type="Submit" name="Submit" id="Submit" value="Submit" /> </div>
	<div class="btn_inside_sect"><input type="button" name="Back" value="Back" id="back" class="backbutton" onclick="goBack();" /> </div>
</div>               
        </form>
    </body>
</html>