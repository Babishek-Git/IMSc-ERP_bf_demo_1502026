<?php
//$CMLine = $Line;	
//$abstsheetid = $sheetid;
////$Rbn_net_amount;
//$OverAllSlmAmount = $OverAllSlmAmount + $Rbn_net_amount;
////echo $OverAllSlmAmount;exit;
//$EscQtrArray = array();
//$EscTccAmtArray = array();
//$EscTcaAmtArray = array();
//$esc_cnt = 0;
//$Esc_Total_Amt = 0;
//$select_esc_rbn_query = "select * from escalation where sheetid = '$abstsheetid' and flag = 0 and rbn = '$rbn' ORDER BY quarter ASC";
//$select_esc_rbn_sql = mysql_query($select_esc_rbn_query);
//if($select_esc_rbn_sql == true)
//{
//	if(mysql_num_rows($select_esc_rbn_sql)>0)
//	{
//		$esc_cnt = 1;
//		while($EscList = mysql_fetch_object($select_esc_rbn_sql))
//		{
//			$quarter = $EscList->quarter;
//			$esc_tcc_amount = $EscList->tcc_amt;
//			$esc_tca_amount = $EscList->tca_amt;
//			$esc_qtr_amt = round(($esc_tcc_amount+$esc_tca_amount),2);//$EscList->esc_total_amt;
//			
//			//$Esc_Total_Amt = $Esc_Total_Amt+$esc_tcc_amount+$esc_tca_amount;
//			$Esc_Total_Amt = $Esc_Total_Amt+$esc_qtr_amt;//+$esc_tca_amount;
//			
//			array_push($EscQtrArray,$quarter);
//			array_push($EscTccAmtArray,$esc_qtr_amt);
//			//array_push($EscTcaAmtArray,$esc_tca_amount);
//		}
//	}
//}
//$Esc_Total_Amt = round($Esc_Total_Amt);
////$OverAllSlmAmount = $OverAllSlmAmount + $Esc_Total_Amt;
//
//$RevEscQtrArray = array();
//$RevEscTccAmtArray = array();
//$RevEscTcaAmtArray = array();
//$rev_esc_cnt = 0;
//$RevEsc_Total_Amt = 0;
//$select_rev_esc_rbn_query = "select * from escalation where sheetid = '$abstsheetid' and flag = 0 and rev_esc_total_amt != 0 ORDER BY quarter ASC";
////echo $select_rev_esc_rbn_query;
//$select_rev_esc_rbn_sql = mysql_query($select_rev_esc_rbn_query);
//if($select_rev_esc_rbn_sql == true)
//{
//	if(mysql_num_rows($select_rev_esc_rbn_sql)>0)
//	{
//		$esc_cnt = 1;
//		while($RevEscList = mysql_fetch_object($select_rev_esc_rbn_sql))
//		{
//			$rev_quarter = $RevEscList->quarter;
//			$rev_esc_tcc_amount = $RevEscList->rev_tcc_amt;
//			$rev_esc_tca_amount = $RevEscList->rev_tca_amt;
//			
//			$total_rev_esc_amt = round(($rev_esc_tcc_amount+$rev_esc_tca_amount),2);
//			
//			$paid_esc_tcc_amount = $RevEscList->tcc_amt;
//			$paid_esc_tca_amount = $RevEscList->tca_amt;
//			
//			$total_paid_esc_amt = round(($paid_esc_tcc_amount+$paid_esc_tca_amount),2);
//			
//			//// Second or more than two time revised
//			$select_esc_paid_query = "select rev_tcc_mbook, rev_tcc_mbpage, rev_esc_total_amt from escalation_revised where sheetid = '$abstsheetid' and quarter = '$rev_quarter' ORDER BY rev_esc_id  DESC";
//			$select_esc_paid_sql = mysql_query($select_esc_paid_query);
//			if($select_esc_paid_sql == true)
//			{
//				$PaidEAbaMB = mysql_fetch_object($select_esc_paid_sql);
//				$PaidEsc_Abs_MBook = $PaidEAbaMB->rev_tcc_mbook;
//				$PaidEsc_Abs_MBPage = $PaidEAbaMB->rev_tcc_mbpage;
//				$PaidEsc_Abs_tot_amt = $PaidEAbaMB->rev_esc_total_amt;
//				//echo $PaidEsc_Abs_tot_amt;
//			}
//			if($PaidEsc_Abs_tot_amt>0)
//			{
//				$paid_esc_tcc_amount = $PaidEsc_Abs_MBook;
//				$paid_esc_tca_amount = $PaidEsc_Abs_MBPage;
//				//$Esc_Abs_tot_amt = $PaidEsc_Abs_tot_amt;
//				//$total_paid_esc_amt = round(($paid_esc_tcc_amount+$paid_esc_tca_amount),2);
//				$total_paid_esc_amt = $PaidEsc_Abs_tot_amt;
//			}
//			
//			
//			//echo $total_paid_esc_amt;
//			
//			//$rev_esc_qtr_amt = round(($rev_esc_tcc_amount+$rev_esc_tca_amount),2);//$EscList->esc_total_amt;
//			$rev_esc_qtr_amt = round(($total_rev_esc_amt-$total_paid_esc_amt),2);
//			
//			
//			//$Esc_Total_Amt = $Esc_Total_Amt+$esc_tcc_amount+$esc_tca_amount;
//			$RevEsc_Total_Amt = $RevEsc_Total_Amt+$rev_esc_qtr_amt;//+$esc_tca_amount;
//			
//			array_push($RevEscQtrArray,$rev_quarter);
//			array_push($RevEscTccAmtArray,$rev_esc_qtr_amt);
//			//array_push($EscTcaAmtArray,$esc_tca_amount);
//		}
//	}
//}
//$RevEsc_Total_Amt = round($RevEsc_Total_Amt);
////$OverAllSlmAmount = $OverAllSlmAmount + $RevEsc_Total_Amt;
//
////print_r($RevEscTccAmtArray);exit;
////print_r($EscAmtArray);
//$secured_advance_query = "select sec_adv_amount from secured_advance where sheetid = '$abstsheetid' and rbn = '$rbn'";
//$secured_advance_sql = mysql_query($secured_advance_query);
//if($secured_advance_sql == true)
//{
//	$SAList 		= 	mysql_fetch_object($secured_advance_sql);
//	$sec_adv_amount	= 	$SAList->sec_adv_amount; 
//}
//else
//{
//	$sec_adv_amount = 0;
//}
////$OverAllSlmAmount = $OverAllSlmAmount + $sec_adv_amount;
//
//
//
//$total_recovery = 0;
//$water_recovery_query = "select water_cost from generate_waterbill where sheetid = '$abstsheetid' and rbn = '$rbn'";
//$water_recovery_sql = mysql_query($water_recovery_query);
//if($water_recovery_sql == true)
//{
//	while($WRList 	= 	mysql_fetch_object($water_recovery_sql))
//	{
//		$water_charge 	=  $water_charge+$WRList->water_cost; 
//	}
//}
//else
//{
//	$water_charge = 0;
//}
//$total_recovery = $total_recovery + $water_charge;
//$electricity_recovery_query = "select electricity_cost from generate_electricitybill where sheetid = '$abstsheetid' and rbn = '$rbn'";
//$electricity_recovery_sql = mysql_query($electricity_recovery_query);
//if($electricity_recovery_sql == true)
//{
//	while($ERList 	= 	mysql_fetch_object($electricity_recovery_sql))
//	{
//		$electricity_charge  = 	$electricity_charge+$ERList->electricity_cost;
//	}
//}
//else
//{
//	$electricity_charge = 0;
//}
//$total_recovery = $total_recovery + $electricity_charge;
//$general_recovery_query = "select * from generate_otherrecovery where sheetid = '$abstsheetid' and rbn = '$rbn'";
////echo $general_recovery_query;
//$general_recovery_sql = mysql_query($general_recovery_query);
//if($general_recovery_sql == true)
//{
//	$GRList 			= 	mysql_fetch_object($general_recovery_sql);
//	$cgst_amt 			= 	round($GRList->cgst_amt);
//	$cgst_percent 		= 	$GRList->cgst_percent;
//	$sgst_amt 			= 	round($GRList->sgst_amt);
//	$sgst_percent 		= 	$GRList->sgst_percent;
//	
//	$sd_amt 			= 	round($GRList->sd_amt);
//	$sd_percent 		= 	$GRList->sd_percent;
//	$wct_amt 			= 	round($GRList->wct_amt);
//	$wct_percent 		= 	$GRList->wct_percent;
//	$vat_amt 			= 	round($GRList->vat_amt);
//	$vat_percent 		= 	$GRList->vat_percent;
//	$mob_adv_amt 		= 	round($GRList->mob_adv_amt);
//	$mob_adv_percent 	= 	$GRList->mob_adv_percent;
//	$lw_cess_amt 		= 	round($GRList->lw_cess_amt);
//	$lw_cess_percent 	= 	$GRList->lw_cess_percent;
//	$incometax_amt 		= 	round($GRList->incometax_amt);
//	$incometax_percent 	= 	$GRList->incometax_percent;
//	$it_cess_amt 		= 	round($GRList->it_cess_amt);
//	$it_cess_percent 	= 	$GRList->it_cess_percent;
//	$it_edu_amt 		= 	round($GRList->it_edu_amt);
//	$it_edu_percent 	= 	$GRList->it_edu_percent;
//	$land_rent 			= 	round($GRList->land_rent);
//	$liquid_damage 		= 	round($GRList->liquid_damage);
//	//$other_recovery_1 	= 	round($GRList->other_recovery_1_amt);
//	//$other_recovery_2	= 	round($GRList->other_recovery_2_amt);
//	$other_recovery_1 	= 	round($GRList->other_recovery_1);
//	$other_recovery_2	= 	round($GRList->other_recovery_2);
//	$other_recovery_1_desc 	= 	$GRList->other_recovery_1_desc;
//	$other_recovery_2_desc	= 	$GRList->other_recovery_2_desc;
//	if($other_recovery_1_desc == "")
//	{
//		$other_recovery_1_desc = "Other Recovery 1 ";
//	}
//	if($other_recovery_2_desc == "")
//	{
//		$other_recovery_2_desc = "Other Recovery 2 ";
//	}
//	$non_dep_machine_equip 	= 	round($GRList->non_dep_machine_equip);
//	$non_dep_man_power 	= 	round($GRList->non_dep_man_power);
//	$nonsubmission_qa 	= 	round($GRList->nonsubmission_qa);
//}
//if($non_dep_machine_equip != 0)
//{
//	$non_dep_machine_equip_print = number_format($non_dep_machine_equip, 2, '.', '');
//}
//else
//{
//	$non_dep_machine_equip_print = "NIL";
//}
//
//if($non_dep_man_power != 0)
//{
//	$non_dep_man_power_print = number_format($non_dep_man_power, 2, '.', '');
//}
//else
//{
//	$non_dep_man_power_print = "NIL";
//}
//
//if($electricity_charge != 0)
//{
//	$electricity_charge_print = number_format($electricity_charge, 2, '.', '');
//}
//else
//{
//	$electricity_charge_print = "NIL";
//}
//
//if($water_charge != 0)
//{
//	$water_charge_print = number_format($water_charge, 2, '.', '');
//}
//else
//{
//	$water_charge_print = "NIL";
//}
//$total_recovery = $total_recovery + $sd_amt+$wct_amt + $vat_amt+$mob_adv_amt + $lw_cess_amt+$incometax_amt + $it_cess_amt+$it_edu_amt + $land_rent+$liquid_damage + $other_recovery_1 + $other_recovery_2 + $non_dep_machine_equip + $non_dep_man_power + $nonsubmission_qa + $cgst_amt + $sgst_amt;
//$rrcount = 0;  $total_rec_rel_amt = 0;
//$RRDescCivArr = array(); $RRAmtCivArr = array(); $RRDescAccArr = array(); $RRAmtAccArr = array();
////echo $total_recovery;exit;
//$recov_release_query = "select * from recovery_release where sheetid = '$abstsheetid' and rbn = '$rbn'";
//$recov_release_sql = mysql_query($recov_release_query);
////echo $recov_release_query;
//if($recov_release_sql == true)
//{
//	if(mysql_num_rows($recov_release_sql)>0)
//	{
//		while($RecRelList = mysql_fetch_object($recov_release_sql))
//		{
//			$rec_rel_desc_civil = $RecRelList->description_civil;
//			$rec_rel_amt_civil 	= $RecRelList->amount_civil;
//			$rec_rel_desc_acc 	= $RecRelList->description_acc;
//			$rec_rel_amt_acc 	= $RecRelList->amount_acc;
//			array_push($RRDescCivArr,$rec_rel_desc_civil);
//			array_push($RRAmtCivArr,$rec_rel_amt_civil);
//			array_push($RRDescAccArr,$rec_rel_desc_acc);
//			array_push($RRAmtAccArr,$rec_rel_amt_acc);
//			$total_rec_rel_amt  = $total_rec_rel_amt+$rec_rel_amt_civil;
//			$rrcount++;
//		}
//	}
//}
//echo $title;
//echo $table;
//echo "<table width='1087px' bgcolor='white' cellpadding='3' cellspacing='3' align='center' class='label table1'>";
//echo $tablehead;
//echo "<tr style='border:none'><td style='border:none' class='labelbold' align='center' colspan='12'><u>Memo of payment</u></td></tr>";
////echo "<tr style='border:none'><td style='border:none' class='labelprint' align='right' colspan='6'>Upto date value of work done : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none' class='labelprint' align='right' colspan='5'>".number_format($OverAllSlmDpmAmount, 2, '.', '')."</td><td style='border:none'>&nbsp;</td></tr>";
////echo "<tr style='border:none'><td style='border:none' class='labelprint' align='right' colspan='6'>Deduct Previous Paid : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none' class='labelprint' align='right' colspan='3'>&nbsp;</td><td colspan='2' align='right' class='labelprint' style='border:none;'>(-)&nbsp;&nbsp;".number_format($OverAllDpmAmount, 2, '.', '')."</td><td style='border:none;'>&nbsp;</td></tr>";
//
//////// Newly Added for Page Generate Memo of Payment
////echo "<tr style='border:none'><td style='border:none' class='labelprint' align='right' colspan='6'>Deduct Previous Paid : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none' class='labelprint' align='right' colspan='3'>&nbsp;</td><td colspan='2' align='right' class='labelprint' style='border:none;'>(-)&nbsp;&nbsp;".number_format($OverAllSlmAmount, 2, '.', '')."</td><td style='border:none;'>&nbsp;</td></tr>";
//////  This is for print Escalation
//if(count($EscQtrArray)>0)
//{
//	for($q1=0; $q1<count($EscQtrArray); $q1++)
//	{
//		$EQtr = $EscQtrArray[$q1];
//		$ETccAmt = $EscTccAmtArray[$q1];
//		//echo "<tr style='border:none'><td style='border:none' class='labelprint' align='right' colspan='6'>Escalation for Quarter - ".$EQtr." : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none' class='labelprint' align='right' colspan='3'>&nbsp;</td><td colspan='2' align='right' class='labelprint' style='border:none;'>&nbsp;&nbsp;".number_format($ETccAmt, 2, '.', '')."</td><td style='border:none;'>&nbsp;</td></tr>";
//	}
//}
//$OverAllSlmAmount = round($OverAllSlmAmount+$Esc_Total_Amt);
//
//////  This is for print Revised Escalation
//if(count($RevEscQtrArray)>0)
//{
//	for($q2=0; $q2<count($RevEscQtrArray); $q2++)
//	{
//		$RevEQtr = $RevEscQtrArray[$q2];
//		$RevETccAmt = $RevEscTccAmtArray[$q2];
//		//echo "<tr style='border:none'><td style='border:none' class='labelprint' align='right' colspan='6'>Revised Escalation for Quarter - ".$RevEQtr." : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none' class='labelprint' align='right' colspan='3'>&nbsp;</td><td colspan='2' align='right' class='labelprint' style='border:none;'>&nbsp;&nbsp;".number_format($RevETccAmt, 2, '.', '')."</td><td style='border:none;'>&nbsp;</td></tr>";
//	}
//}
//$OverAllSlmAmount = round($OverAllSlmAmount+$RevEsc_Total_Amt);
//$Overall_net_amt_final = round(($OverAllSlmAmount + $sec_adv_amount + $total_rec_rel_amt - $total_recovery),2);
//$Overall_net_amt_final = round($Overall_net_amt_final);
//
//echo "<tr style='border:none'><td style='border:none' class='labelbold' align='right' colspan='6'>Net Amount : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'>  </td><td style='border:none' class='labelprint' align='right' colspan='3'>&nbsp;</td><td style='border:none;' class='labelbold' align='right' colspan='2'>".number_format($OverAllSlmAmount, 2, '.', '')."</td><td style='border:none;'>&nbsp;</td></tr>";
////echo "<tr style='border:none'><td style='border:none' class='labelprint' align='right' colspan='6'>Secured Advance : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none' class='labelprint' align='right' colspan='3'>&nbsp;</td><td colspan='2' align='right' class='labelprint' style='border:none;'>".number_format($sec_adv_amount, 2, '.', '')."</td><td style='border:none;'>&nbsp;</td></tr>";
//
//
//
//
//
//echo "<tr style='border:none'><td colspan='2' class='labelbold' align='right' style='border:none'>&nbsp;<u>Recoveries</u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td style='border:none' class='labelbold' align='left' colspan='10'></td></tr>";
//$gs = 1; $ea = 1; $eb = 1; $ed = 1; 
//$gst_text = "<b>GST</b>"; $ea_text = "<b>Under 8[a]</b>"; $eb_text = "<b>Under 8[b]</b>";  $ec_text = "<b>Under 8[c]</b>";  $ed_text = "<b><u>With hold Amount</u></b>";
//
//if($cgst_percent != 0){
//	echo "<tr style='border:none'><td style='border:none' colspan='2' align='right' class='labelprint'>".$gst_text." (".$gs.")</td><td style='border:none' class='labelprint' align='right' colspan='4'>CGST @ ".number_format($cgst_percent, 2, '.', '')."% : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none' colspan='5' align='right' class='labelprint'>&nbsp;&nbsp;".number_format($cgst_amt, 2, '.', '')."</td><td style='border:none' colspan=''>&nbsp;</td></tr>";
//	$gs++; $gst_text = "";
//}
//if($sgst_percent != 0){
//	echo "<tr style='border:none'><td style='border:none' colspan='2' align='right' class='labelprint'>".$gst_text." (".$gs.")</td><td style='border:none' class='labelprint' align='right' colspan='4'>SGST @ ".number_format($sgst_percent, 2, '.', '')."% : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none' colspan='5' align='right' class='labelprint'>&nbsp;&nbsp;".number_format($sgst_amt, 2, '.', '')."</td><td style='border:none' colspan=''>&nbsp;</td></tr>";
//	$gs++; $gst_text = "";
//}
//if($wct_percent != 0){
//	echo "<tr style='border:none'><td style='border:none' colspan='2' align='right' class='labelprint'>".$ea_text." (".$ea.")</td><td style='border:none' class='labelprint' align='right' colspan='4'>W.C.T @ ".number_format($wct_percent, 2, '.', '')."% : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none' colspan='5' align='right' class='labelprint'>&nbsp;&nbsp;".number_format($wct_amt, 2, '.', '')."</td><td style='border:none' colspan=''>&nbsp;</td></tr>";
//	$ea++; $ea_text = "";
//}
//if($vat_percent != 0){
//	echo "<tr style='border:none'><td style='border:none' colspan='2' align='right' class='labelprint'>".$ea_text." (".$ea.")</td><td style='border:none' class='labelprint' align='right' colspan='4'>VAT @  ".number_format($vat_percent, 2, '.', '')."% : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none' colspan='5' align='right' class='labelprint'>&nbsp;&nbsp;".number_format($vat_amt, 2, '.', '')."</td><td style='border:none' colspan='1'>&nbsp;</td></tr>";
//	$ea++; $ea_text = "";
//}
//if($lw_cess_percent != 0){
//	echo "<tr style='border:none'><td style='border:none' colspan='2' align='right' class='labelprint'>".$ea_text." (".$ea.")</td><td style='border:none' class='labelprint' align='right' colspan='4'>Labour Welfare CESS @ ".number_format($lw_cess_percent, 2, '.', '')."% : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none' colspan='5' align='right' class='labelprint'>&nbsp;&nbsp;".number_format($lw_cess_amt, 2, '.', '')."</td><td style='border:none' colspan='1'>&nbsp;</td></tr>";
//	$ea++; $ea_text = "";
//}
//if($mob_adv_percent != 0){
//	echo "<tr style='border:none'><td style='border:none' colspan='2' align='right' class='labelprint'>".$ea_text." (".$ea.")</td><td style='border:none' class='labelprint' align='right' colspan='4'>Mobilization Advance : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none' colspan='5' align='right' class='labelprint'>&nbsp;&nbsp;".number_format($mob_adv_amt, 2, '.', '')."</td><td style='border:none' colspan='1'>&nbsp;</td></tr>";
//	$ea++; $ea_text = "";
//}
//if($incometax_percent != 0){
//	echo "<tr style='border:none'><td style='border:none' colspan='2' align='right' class='labelprint'>".$eb_text." (".$eb.")</td><td style='border:none' class='labelprint' align='right' colspan='4'>Income Tax @ ".number_format($incometax_percent, 2, '.', '')."% : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none' colspan='5' align='right' class='labelprint'>&nbsp;&nbsp;".number_format($incometax_amt, 2, '.', '')."</td><td style='border:none' colspan='1'>&nbsp;</td></tr>";
//	$eb++; $eb_text = "";
//}
//if($it_cess_percent != 0){
//	echo "<tr style='border:none'><td style='border:none' colspan='2' align='right' class='labelprint'>".$eb_text." (".$eb.")</td><td style='border:none' class='labelprint' align='right' colspan='4'>IT Cess @ ".number_format($it_cess_percent, 2, '.', '')."% : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none' colspan='5' align='right' class='labelprint'>&nbsp;&nbsp;".number_format($it_cess_amt, 2, '.', '')."</td><td style='border:none' colspan='1'>&nbsp;</td></tr>";
//	$eb++; $eb_text = "";
//}
//if($it_edu_percent != 0){
//	echo "<tr style='border:none'><td style='border:none' colspan='2' align='right' class='labelprint'>".$eb_text." (".$eb.")</td><td style='border:none' class='labelprint' align='right' colspan='4'>IT Education CESS @ ".number_format($it_edu_percent, 2, '.', '')."% : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none' colspan='5' align='right' class='labelprint'>&nbsp;&nbsp;".number_format($it_edu_amt, 2, '.', '')."</td><td style='border:none' colspan='1'>&nbsp;</td></tr>";
//	$eb++; $eb_text = "";
//}
//if($water_charge != 0){
//	echo "<tr style='border:none'><td style='border:none' colspan='2' align='right' class='labelprint'>".$eb_text." (".$eb.")</td><td style='border:none' class='labelprint' align='right' colspan='4'>Water Charges (as per Bill enclosed) : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none' colspan='5' align='right' class='labelprint'>".$water_charge_print."</td><td colspan='1' style='border:none'>&nbsp;</td></tr>";
//	$eb++; $eb_text = "";
//}
//if($electricity_charge != 0){
//	echo "<tr style='border:none'><td style='border:none' colspan='2' align='right' class='labelprint'>".$eb_text." (".$eb.")</td><td style='border:none' class='labelprint' align='right' colspan='4'>Electricity Charges (as per Bill enclosed) : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none' colspan='5' align='right' class='labelprint'>&nbsp;&nbsp;".$electricity_charge_print."</td><td colspan='1' style='border:none'>&nbsp;</td></tr>";
//	$eb++; $eb_text = "";
//}
//if($land_rent != 0){
//	echo "<tr style='border:none'><td style='border:none' colspan='2' align='right' class='labelprint'>".$eb_text." (".$eb.")</td><td style='border:none' class='labelprint' align='right' colspan='4'>Rent for Land : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none' colspan='5' align='right' class='labelprint'>&nbsp;&nbsp;".number_format($land_rent, 2, '.', '')."</td><td colspan='1' style='border:none'>&nbsp;</td></tr>";
//	$eb++; $eb_text = "";
//}
//if($liquid_damage != 0){
//	echo "<tr style='border:none'><td style='border:none' colspan='2' align='right' class='labelprint'>".$eb_text." (".$eb.")</td><td style='border:none' class='labelprint' align='right' colspan='4'>Liquidated Damages : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none' colspan='5' align='right' class='labelprint'>&nbsp;&nbsp;".number_format($liquid_damage, 2, '.', '')."</td><td colspan='1' style='border:none'>&nbsp;</td></tr>";
//	$eb++; $eb_text = "";
//}
//if($other_recovery_1 != 0){
//	echo "<tr style='border:none'><td style='border:none' colspan='2' align='right' class='labelprint'>".$eb_text." (".$eb.")</td><td style='border:none' class='labelprint' align='right' colspan='4'>".$other_recovery_1_desc." : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none' colspan='5' align='right' class='labelprint'>&nbsp;&nbsp;".number_format($other_recovery_1, 2, '.', '')."</td><td colspan='1' style='border:none'>&nbsp;</td></tr>";
//	$eb++; $eb_text = "";
//}
//if($other_recovery_2 != 0){
//	echo "<tr style='border:none'><td style='border:none' colspan='2' align='right' class='labelprint'>".$eb_text." (".$eb.")</td><td style='border:none' class='labelprint' align='right' colspan='4'>".$other_recovery_2_desc." : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none' colspan='5' align='right' class='labelprint'>&nbsp;&nbsp;".number_format($other_recovery_2, 2, '.', '')."</td><td colspan='1' style='border:none'>&nbsp;</td></tr>";
//	$eb++; $eb_text = "";
//}
//if($non_dep_machine_equip != 0){
//	echo "<tr style='border:none'><td style='border:none' colspan='2' align='right' class='labelprint'>".$eb_text." (".$eb.")</td><td style='border:none' class='labelprint' align='right' colspan='4'>Non Deployment of machineries & equipment as (per clause 18)  : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none' colspan='5' align='right' class='labelprint'>".$non_dep_machine_equip_print."</td><td colspan='1' style='border:none'>&nbsp;</td></tr>";
//	$eb++; $eb_text = "";
//}
//if($non_dep_man_power != 0){
//	echo "<tr style='border:none'><td style='border:none' colspan='2' align='right' class='labelprint'>".$eb_text." (".$eb.")</td><td style='border:none' class='labelprint' align='right' colspan='4'>Non Deployment of Technical manpower (as per clause 36(i)) : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none' colspan='5' align='right' class='labelprint'>".$non_dep_man_power_print."</td><td colspan='1' style='border:none'>&nbsp;</td></tr>";
//	$eb++; $eb_text = "";
//}
//
//echo "<tr style='border:none'><td style='border:none' colspan='2' align='right' class='labelprint'>".$eb_text." (".$eb.")</td><td style='border:none' class='labelprint' align='right' colspan='4'>Non-Submission of QA related document : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none' colspan='5' align='right' class='labelprint'>".number_format($nonsubmission_qa, 2, '.', '')."</td><td colspan='1' style='border:none'>&nbsp;</td></tr>";
//$eb++; $eb_text = "";
//
//
//if($sd_amt != 0){
//	$eb = 1;
//	echo "<tr style='border:none'><td style='border:none' colspan='2' align='right' class='labelprint'>".$ec_text." (".$eb.")</td><td style='border:none' class='labelprint' align='right' colspan='4'>Security Deposit @ 5% : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none' colspan='5' align='right' class='labelprint'>&nbsp;&nbsp;".number_format($sd_amt, 2, '.', '')."</td><td colspan='1' style='border:none'>&nbsp;</td></tr>";
//	$eb++; $eb_text = "";
//}
//
//// This row is for Recovery Release
//if($rrcount>0){
//	for($rrc=0; $rrc<$rrcount; $rrc++){
//	echo "<tr style='border:none'><td style='border:none' colspan='2' align='right' class='labelprint'>".$ed_text." (".$ed.")</td><td style='border:none' class='labelprint' align='right' colspan='4'>".$RRDescCivArr[$rrc]." : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none' colspan='5' align='right' class='labelprint'>".number_format($RRAmtCivArr[$rrc], 2, '.', '')."</td><td colspan='1' style='border:none'>&nbsp;</td></tr>";
//	$ed++; $ed_text = "";
//	}
//}
//
//echo "<tr style='border:none'><td style='border:none' class='labelprint' align='center' colspan='12'>&nbsp;</td></tr>";
//if($total_recovery != 0){
//	echo "<tr style='border:none'><td style='border:none' class='labelprint' align='right' colspan='5'></td><td style='border:none' class='labelprint' align='right' colspan='4'>&nbsp;</td><td colspan='2' align='right' style='border:none; border-bottom:1px dashed #000000' class='labelprint'></td><td style='border:none; border-bottom:1px dashed #000000'>&nbsp;</td></tr>";
//}
//
//if($Overall_net_amt_final != 0){
//	echo "<tr style='border:none'><td style='border:none' class='labelprint' align='right' colspan='5'><b>Net Payable Amount :</b> <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none' class='labelprint' align='right' colspan='6'><b>".number_format($Overall_net_amt_final, 2, '.', '')."</b></td><td style='border:none'>&nbsp;</td></tr>";
//}
//$split_amt = explode(".",$Overall_net_amt_final);
//$rupees_part = $split_amt[0];
//$paise_part = $split_amt[1];
//$rupee_part_word = number_to_words($rupees_part);
//
//if($paise_part != 0){
//	$paise_part_word = " and Paise ".number_to_words($paise_part)."";
//}
//$amount_in_words = $rupee_part_word.$paise_part_word;
//echo "<tr style='border:none'><td style='border:none'>&nbsp;</td><td style='border:none'>&nbsp;</td><td style='border:none' class='labelprint' align='left' colspan='12'>Amount: (Rupees ".$amount_in_words.")</td></tr>";
//echo "<tr style='border:none'><td style='border:none' class='labelprint' align='center' colspan='12'><span class='badge'>page ".$page."</span></td></tr>";
//echo "</table>";
//echo "<p  style='page-break-after:always;'></p>";
//
//if(($OverAllSlmAmount != 0) && ($OverAllSlmAmount != "")){
//	$delete_memo_payment_query 	= "delete from memo_payment_accounts_edit where sheetid  = '$sheetid' and rbn = '$rbn'";
//	$delete_memo_payment_sql 	= mysql_query($delete_memo_payment_query);
//	//echo $delete_memo_payment_query;
//	
//	$insert_memo_payment_query 	= "insert into memo_payment_accounts_edit set 
//								sheetid  = '$sheetid', rbn = '$rbn', abstract_net_amt_civil = '$OverAllSlmAmount',
//								mbookno  = '$abstmbno', page = '$page',
//								cgst_percent_civil = '$cgst_percent', cgst_amt_civil = '$cgst_amt', 
//								sgst_percent_civil = '$sgst_percent', sgst_amt_civil = '$sgst_amt', 
//								wct_percent_civil = '$wct_percent', wct_amt_civil = '$wct_amt',
//								vat_percent_civil = '$vat_percent', vat_amt_civil = '$vat_amt',
//								lw_cess_percent_civil = '$lw_cess_percent', lw_cess_amt_civil = '$lw_cess_amt', 
//								mob_adv_percent_civil = '$mob_adv_percent', mob_adv_amt_civil = '$mob_adv_amt',
//								incometax_percent_civil = '$incometax_percent', incometax_amt_civil = '$incometax_amt',
//								it_cess_percent_civil = '$it_cess_percent', it_cess_amt_civil = '$it_cess_amt',
//								it_edu_percent_civil = '$it_edu_percent', it_edu_amt_civil = '$it_edu_amt',
//								non_dep_machine_equip_civil = '$non_dep_machine_equip', non_dep_man_power_civil = '$non_dep_man_power',
//								land_rent_civil = '$land_rent', liquid_damage_civil = '$liquid_damage', 
//								other_recovery_1_amt_civil = '$other_recovery_1', other_recovery_2_amt_civil = '$other_recovery_2',
//								other_recovery_1_desc_civil = '$other_recovery_1_desc', other_recovery_2_desc_civil = '$other_recovery_2_desc',
//								sd_percent_civil = '$sd_percent', sd_amt_civil = '$sd_amt',
//								sec_adv_amount_civil = '$sec_adv_amount',
//								electricity_cost_civil = '$electricity_charge',
//								water_cost_civil = '$water_charge',
//								net_payable_amt_civil = '$Overall_net_amt_final',
//								nonsubmission_qa_civil = '$nonsubmission_qa', staffid_civil = '$staffid', userid_civil = '$userid', 
//								modifieddate_civil = NOW(), active = 1";
//	$insert_memo_payment_sql = mysql_query($insert_memo_payment_query);
//}
?>