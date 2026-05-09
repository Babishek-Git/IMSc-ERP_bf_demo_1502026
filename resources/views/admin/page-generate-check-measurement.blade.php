<?php
//function getCheckMeasItemPage($subdivid,$sheetid,$rbn,$cmid){
//	$MBPageArr = array();
//	$select_id_query = "select mbdetail_id from check_measurement_details where cmid = '$cmid' and sheetid = '$sheetid' and subdivid = '$subdivid'";
//	$select_id_sql = mysql_query($select_id_query);
//	if($select_id_sql == true){
//		if(mysql_num_rows($select_id_sql)>0){
//			while($IDList = mysql_fetch_object($select_id_sql)){
//				$MbDetailId = $IDList->mbdetail_id;
//				if($MbDetailId == "ALL"){
//					// get Page from Mbook generate Table
//					$select_mb_query = "select mbno, mbpage from mbookgenerate where sheetid = '$sheetid' and subdivid = '$subdivid' and rbn = '$rbn'";
//					$select_mb_sql = mysql_query($select_mb_query);
//					if($select_mb_sql == true){
//						if(mysql_num_rows($select_mb_sql)>0){
//							$MBGList = mysql_fetch_object($select_mb_sql);
//							$G_Mbno = $MBGList->mbno;
//							$G_MbPage = $MBGList->mbpage;
//							$MBPageArr[$G_Mbno][] = $G_MbPage;
//						}
//					}
//				}else{
//					// get Page from mbook details table and Push into an array
//					$select_mb_query = "select mbookno, page from mbookdetail where subdivid = '$subdivid' and mbdetail_id = '$MbDetailId'";
//					$select_mb_sql = mysql_query($select_mb_query);
//					if($select_mb_sql == true){
//						if(mysql_num_rows($select_mb_sql)>0){
//							while($MDGList = mysql_fetch_object($select_mb_sql)){
//								$D_Mbno = $MDGList->mbookno;
//								$D_MbPage = $MDGList->page;
//								$MBPageArr[$D_Mbno][] = $D_MbPage;
//							}
//						}
//					}
//				}
//			}
//		}
//	}
//	$OutPut = "";
//	foreach($MBPageArr as $key => $value){
//		$Mbookno = $key; 
//		$PageStr = "";
//		if($OutPut != ""){
//			$OutPut = $OutPut."<br/>";
//		}
//		$unique_page = array_unique($value);
//		natsort($unique_page);
//		foreach($unique_page as $page){
//			$MbookPage = $page;
//			$PageStr .= $MbookPage.",";
//		}
//		$PageStr = rtrim($PageStr,",");
//		$OutPut = "MB-".$Mbookno."/ Pg-".$PageStr;
//	}
//	return $OutPut;
//}
//
//function CheckLineForCheckMeas($table,$page,$abstmbno,$flag,$Amount){
//	$Str  = "";
//	if($flag == "Y"){
//	$Str .= "<tr class='labelbold'><td colspan='6' align='right'><b>C/O Page No ".($page+1)." / Abstract MB No ".$abstmbno."</b></td><td align='right'><b>".$Amount."<b/></td><td align='right'></td></tr>";
//	}
//	$Str .= "<tr class='labelprint'><td colspan='8' align='center' style='border-bottom:2px solid white;border-left:2px solid white;border-right:2px solid white; background:none'><span class='badge'>Page ".$page."</span></td></tr>";
//	$Str .= "</table>";
//	$Str .= '<table width="1087px" border="0"  cellpadding="2" cellspacing="2" align="center" bgcolor="#FFFFFF" style="border:none;" class="table1 label">
//			<tr style="border:none;"><td align="center" style="border:none;background:none;" class="labelprint">Abstract M.Book No. '.$abstmbno.'&nbsp;&nbsp;&nbsp;</td></tr>
//			</table>';
//	$Str .= $table;		
//	$Str .= "<table width='1087px' bgcolor='white' cellpadding='3' cellspacing='3' align='center' class='label table1'>";
//	if($flag == "Y"){
//	$Str .= "<tr class='labelbold'><td colspan='6' align='right'><b>B/F Page No ".$page." / Abstract MB No ".$abstmbno."</b></td><td align='right'><b>".$Amount."</b></td><td align='right'></td></tr>";
//	}
//	return $Str;
//}
//
//function UpdateCheckMeasurPage($cmid,$abstsheetid,$rbn,$mbook,$page){
//	$update_page_query = "update check_measurement_master set abst_mbookno = '$mbook', abst_page = '$page' where cmid = '$cmid' and sheetid = '$abstsheetid' and rbn = '$rbn'";
//	$update_page_sql = mysql_query($update_page_query);
//}
//
//$CMLine = $Line;	
//$abstsheetid = $sheetid;								  
//$WorkLevel = GetWorkLevelAssign($abstsheetid);
//if($WorkLevel != ""){
//echo $title;
//echo $table;
//echo "<table width='1087px' bgcolor='white' cellpadding='3' cellspacing='3' align='center' class='label table1'>";
//	$expWorkLevel = explode(",",$WorkLevel);
//	for($chm=0; $chm<count($expWorkLevel); $chm++){
//		$WLevelid = $expWorkLevel[$chm];
//		$BWRoleName = GetRoleName($WLevelid,$_SESSION['staff_section']);
//		
//		$select_check_master_query 	= "select * from check_measurement_master where levelid = '$WLevelid' and sheetid = '$abstsheetid' and rbn = '$rbn' and forward_flag = 'FW'
//										and	cmid = (select max(cmid) from check_measurement_master where sheetid = '$abstsheetid' and rbn = '$rbn' and levelid = '$WLevelid')";
//		$select_check_master_sql 	= mysql_query($select_check_master_query);
//		if($select_check_master_sql == true){
//			if(mysql_num_rows($select_check_master_sql)>0){
//				//$page++;
//				$MasterList = mysql_fetch_object($select_check_master_sql);
//				$checked_total_percent = $MasterList->checked_total_percent;
//				$cmid = $MasterList->cmid;
//				$checked_total_amount = $MasterList->checked_total_amount;
//				$checked_total_percent = $MasterList->checked_total_percent;
//				
//				echo "<tr class='labelprint' bgcolor='#dfdfdf'><td colspan='9' align='center' style='background-color:#0466B7; color:#FFFFFF; text-shadow:none'>Check Measurement done by <b style='text-transform: uppercase;'>".$BWRoleName."</b></td></tr>";
//				echo "<tr class='labelprint'>";
//				echo "<td align='center' nowrap='nowrap'>Item No.</td>";
//				echo "<td align='center'>Description</td>";
//				//echo "<td align='center' nowrap='nowrap'>RAB No.</td>";
//				echo "<td align='center' nowrap='nowrap'>MB / Page</td>";
//				//echo "<td align='center' nowrap='nowrap'>P/No.</td>";
//				echo "<td align='center'>Qty.</td>";
//				echo "<td align='center'>Unit</td>";
//				echo "<td align='center'>Rate</td>";
//				echo "<td align='center'>Amount</td>";
//				echo "<td>&nbsp;</td>";
//				echo "</tr>";
//				$CMLine++;
//				
//				/*if($CMLine>30){
//					echo CheckLineForCheckMeas($table,$page,$abstmbno,"N");
//					$CMLine = $Line; $page++;
//				}*/
//				
//				if($checked_total_percent == 100){
//					echo "<tr class='labelprint'>";
//					echo "<td align='center' colspan='8' style='width:1087px'> 100% Check Measurement done  by ".$BWRoleName."</td>";
//					echo "</tr>";
//					UpdateCheckMeasurPage($cmid,$abstsheetid,$rbn,$abstmbno,$page);
//					$CMLine++;
//					echo "<tr class='labelprint'>";
//					echo "<td align='center' colspan='8' style='width:1087px'>&nbsp;</td>";
//					echo "</tr>";
//					$CMLine++;
//					if($CMLine>25){
//						echo CheckLineForCheckMeas($table,$page,$abstmbno,"N",0);
//						$CMLine = $Line; $page++;
//					}
//					//echo "<tr class='labelprint'><td colspan='10' align='center' style='border-bottom:2px solid white;border-left:2px solid white;border-right:2px solid white;background:none'><span class='badge'>Page ".$page."</span></td></tr>";
//				}else{
//					$select_check_measure_query = "select b.itemno, b.subdivid, sum(b.item_qty_checked) as checked_qty, b.item_qty_paid, b.pay_percent, b.part_pay_flag, b.check_percent, 
//												sum(b.check_amount) as check_amount, b.flag, b.mtype, c.description, c.shortnotes, c.rate, c.per, c.decimal_placed, b.mbno, b.mbpage 
//												from check_measurement_details b 
//												inner join schdule c on (b.subdivid = c.subdivid)
//												where b.cmid = '$cmid' group by b.subdivid";
//					//echo $select_check_measure_query;							
//					$select_check_measure_sql = mysql_query($select_check_measure_query);
//					
//							if($select_check_measure_sql == true){
//								if(mysql_num_rows($select_check_measure_sql)>0){
//									//echo "<table width='1087px' bgcolor='white' cellpadding='3' cellspacing='3' align='center' class='label table1'>";
//									//echo "<tr class='labelprint' bgcolor='#dfdfdf'><td colspan='10' align='center'>CHECK MEASUREMENT DONE BY <b style='text-transform: uppercase;'>".$BWRoleName."</b></td></tr>";
//									//echo "<tr class='labelprint'>";
//									//echo "<td align='center' nowrap='nowrap'>Item No.</td>";
//									//echo "<td align='center'>Description</td>";
//									//echo "<td align='center' nowrap='nowrap'>RAB No.</td>";
//									//echo "<td align='center' nowrap='nowrap'>MB No.</td>";
//									//echo "<td align='center' nowrap='nowrap'>P/No.</td>";
//									//echo "<td align='center'>Qty.</td>";
//									//echo "<td align='center'>Unit</td>";
//									//echo "<td align='center'>Rate</td>";
//									//echo "<td align='center'>Amount</td>";
//									//echo "<td>&nbsp;</td>";
//									//echo "</tr>";
//									
//									/// here select max(cmdtid) row mbook no and page no where cmid 
//									$Total_Checked_Amount = 0;
//									while($CMList1 = mysql_fetch_object($select_check_measure_sql)){
//										$description = $CMList1->description;
//										$shortnotes = $CMList1->shortnotes;
//										if($shortnotes != ""){
//											$CMItemDesc = $shortnotes;
//										}else{
//											$CMItemDesc = $description;
//										}
//										$wrap_cnt1 = 0;
//										$WrapReturn1 = getWordWrapCount($CMItemDesc,180);
//										$CMItemDesc = $WrapReturn1[0];
//										$wrap_cnt1 = $WrapReturn1[1];
//										$CMLine = $CMLine+$wrap_cnt1;//+1;
//										
//										
//										$select_max_page_query 	= "select mbno, mbpage from check_measurement_details where sheetid = '$abstsheetid' and subdivid = '$CMList1->subdivid' and cmid = '$cmid' and cmdtid = (select max(cmdtid) from check_measurement_details where sheetid = '$abstsheetid' and subdivid = '$CMList1->subdivid' and cmid = '$cmid')";
//										$select_max_page_sql 	= mysql_query($select_max_page_query);
//										if($select_max_page_sql == true){
//											$MaxPList = mysql_fetch_object($select_max_page_sql);
//											$max_page = "";//$MaxPList->mbpage;
//											$max_mbno = "";//$MaxPList->mbno;
//										}
//										$Res = "";
//										$MBPageRef = getCheckMeasItemPage($CMList1->subdivid,$abstsheetid,$rbn,$cmid);
//										//echo $Res;
//										//print_r($Res);
//										/*foreach($Res as $k => $v){
//											echo $CMList1->itemno." = ".$k."<br/>";
//											foreach($v as $n){
//												echo $n.'<br />';
//											}
//										}*/
//										
//										//echo $select_max_page_query;exit;
//										//$checked_total_amount = $CMList1->checked_total_amount;
//										//$checked_total_percent = $CMList1->checked_total_percent;
//										echo "<tr class='labelprint'>";
//										echo "<td align='center'>".$CMList1->itemno."</td>";
//										echo "<td align='left'>".$CMItemDesc."</td>";
//										//echo "<td align='center'>".$rbn."</td>";
//										//echo "<td align='center'>".$CMList1->mbno." - ".$max_mbno."</td>";
//										//echo "<td align='center'>".$CMList1->mbpage." - ".$max_page."</td>";
//										echo "<td align='left'>".$MBPageRef."</td>";
//										//echo "<td align='center'>".$max_page."</td>";
//										echo "<td align='right'>".$CMList1->checked_qty."</td>";
//										echo "<td align='center'>".$CMList1->per."</td>";
//										echo "<td align='right'>".$CMList1->rate."</td>";
//										echo "<td align='right'>".$CMList1->check_amount."</td>";
//										echo "<td>&nbsp;</td>";
//										echo "</tr>";
//										$Total_Checked_Amount = $Total_Checked_Amount + $CMList1->check_amount;
//										$CMLine++;
//										if($CMLine>25){
//											echo CheckLineForCheckMeas($table,$page,$abstmbno,"Y",$Total_Checked_Amount);
//											$CMLine = $Line; $page++;
//										}
//									}
//									echo "<tr class='labelbold'>";
//									echo "<td>&nbsp;</td>";
//									echo "<td>&nbsp;</td>";
//									//echo "<td>&nbsp;</td>";
//									//echo "<td>&nbsp;</td>";
//									echo "<td align='right' colspan='4'>Total Test check amount</td>";
//									echo "<td align='right'>".number_format($Total_Checked_Amount, 2, '.', '')."</td>";
//									echo "<td rowspan='2' nowrap='nowrap'>&nbsp;X100 %</td>";
//									echo "</tr>";
//									$CMLine++;
//									if($CMLine>25){
//										echo CheckLineForCheckMeas($table,$page,$abstmbno,"N",0);
//										$CMLine = $Line; $page++;
//									}
//									echo "<tr class='labelbold'>";
//									echo "<td>&nbsp;</td>";
//									echo "<td>&nbsp;</td>";
//									//echo "<td>&nbsp;</td>";
//									//echo "<td>&nbsp;</td>";
//									echo "<td align='right' colspan='4'>This Bill amount</td>";
//									echo "<td align='right'>".number_format($Rbn_net_amount_excl_reb, 2, '.', '')."</td>";
//									echo "</tr>";
//									$CMLine++;
//									if($CMLine>25){
//										echo CheckLineForCheckMeas($table,$page,$abstmbno,"N",0);
//										$CMLine = $Line; $page++;
//									}
//									echo "<tr class='labelprint'>";
//									echo "<td>&nbsp;</td>";
//									echo "<td>&nbsp;</td>";
//									echo "<td>&nbsp;</td>";
//									//echo "<td>&nbsp;</td>";
//									//echo "<td>&nbsp;</td>";
//									echo "<td>&nbsp;</td>";
//									echo "<td>&nbsp;</td>";
//									echo "<td>&nbsp;</td>";
//									echo "<td>&nbsp;</td>";
//									echo "<td>&nbsp;</td>";
//									echo "</tr>";
//									$CMLine++;
//									if($CMLine>25){
//										echo CheckLineForCheckMeas($table,$page,$abstmbno,"N",0);
//										$CMLine = $Line; $page++;
//									}
//									echo "<tr class='labelbold'>";
//									echo "<td>&nbsp;</td>";
//									//echo "<td>&nbsp;</td>";
//									//echo "<td>&nbsp;</td>";
//									echo "<td>&nbsp;</td>";
//									echo "<td align='right' colspan='5'>Result:Satisfactory </td>";
//									echo "<td align='right'>".number_format($checked_total_percent, 2, '.', '')."% </td>";
//									echo "</tr>";
//									UpdateCheckMeasurPage($cmid,$abstsheetid,$rbn,$abstmbno,$page);
//									//echo "<tr class='labelprint'><td colspan='8' align='center' style='border-bottom:2px solid white;border-left:2px solid white;border-right:2px solid white; background:none'><span class='badge'>Page ".$page."</span></td></tr>";
//									$CMLine++;
//									//if($CMLine>20){
//										//echo CheckLineForCheckMeas($table,$page,$abstmbno);
//										//$CMLine = $Line;
//									//}
//								}
//							}
//				}
//			}
//			
//		}
//		//echo "<p  style='page-break-after:always;'></p>";
//	}
//		echo "<tr class='labelprint'><td colspan='8' align='center' style='border-bottom:2px solid white;border-left:2px solid white;border-right:2px solid white; background:none'><span class='badge'>Page ".$page."</span></td></tr>";
//		echo "</table>";
//		$page++;
//}
?>