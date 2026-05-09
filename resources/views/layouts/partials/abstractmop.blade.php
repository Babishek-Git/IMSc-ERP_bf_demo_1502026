@php
echo \Helper::AbstractMBHeader($MbNo,$MbPage,$NextMBList,$NextMBPageList,$NextMbIncr);
if(isset($data['MBMainTitle'])){ echo $data['MBMainTitle']; }
echo $TableOpenStr;

$LastRowStr = \Helper::LastRowDisplay("A",$MbPage);
@endphp
<tr style='border:none'>
    <td style='border:none; width:200px' class='labelbold' align='left'>
        <a style="text-decoration:none" href="{{ route('accounts.MemoOfPaymentCreate', ['ccno'=>encrypt($Ccno),'cmb_measure_type'=>encrypt('A'),'btn_view'=>encrypt('ACC'),'action'=>encrypt('CHECK')]) }}">
            <span class="spanbtn" name="check_memo_payment" id="check_memo_payment">Click here to edit MOP</span>
        </a>
    </td>
    <td style='border:none' class='labelbold' align='center' colspan='3'><u>Memo of Payment</u></td>
</tr>
@php
$GrandTotal = $SlmTotalAmt;
if($MopData != NULL){
    foreach($MopData as $MopDataValue){

        echo "<tr style='border:none'><td style='border:none'>&nbsp;</td><td style='border:none; width:400px;' class='labelprint' align='right'>Upto date value of work done : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none' class='labelprint' align='right'>&nbsp;</td><td align='right' class='labelprint' style='border:none;'>&nbsp;&nbsp;".number_format($UptoTotalAmt, 2, '.', '')."</td><td style='border:none;'>&nbsp;</td></tr>";


        if($MopDataValue->sec_adv_amount != 0){ $GrandTotal = $GrandTotal + $MopDataValue->sec_adv_amount;
            echo "<tr style='border:none'><td style='border:none'>&nbsp;</td><td style='border:none' class='labelprint' align='right'>Secured Advance : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none' class='labelprint' align='right'>&nbsp;</td><td align='right' class='labelprint' style='border:none;'>&nbsp;&nbsp;".number_format($MopDataValue->sec_adv_amount, 2, '.', '')."</td><td style='border:none;'>&nbsp;</td></tr>";
        }
        if($MopDataValue->mob_adv_amt != 0){ $GrandTotal = $GrandTotal + $MopDataValue->mob_adv_amt;
            echo "<tr style='border:none'><td style='border:none'>&nbsp;</td><td style='border:none' class='labelprint' align='right'>Mob. Advance : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none' class='labelprint' align='right'>&nbsp;</td><td align='right' class='labelprint' style='border:none;'>&nbsp;&nbsp;".number_format($MopDataValue->mob_adv_amt, 2, '.', '')."</td><td style='border:none;'>&nbsp;</td></tr>";
        }
        if($MopDataValue->pl_mac_adv_amt != 0){ $GrandTotal = $GrandTotal + $MopDataValue->pl_mac_adv_amt;
            echo "<tr style='border:none'><td style='border:none'>&nbsp;</td><td style='border:none' class='labelprint' align='right'>P&M Advance : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none' class='labelprint' align='right'>&nbsp;</td><td align='right' class='labelprint' style='border:none;'>&nbsp;&nbsp;".number_format($MopDataValue->pl_mac_adv_amt, 2, '.', '')."</td><td style='border:none;'>&nbsp;</td></tr>";
        }
        if($MopDataValue->esc_amt != 0){ $GrandTotal = $GrandTotal + $MopDataValue->esc_amt;
            echo "<tr style='border:none'><td style='border:none'>&nbsp;</td><td style='border:none' class='labelprint' align='right'>Escalation : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none' class='labelprint' align='right'>&nbsp;</td><td align='right' class='labelprint' style='border:none;'>&nbsp;&nbsp;".number_format($MopDataValue->esc_amt, 2, '.', '')."</td><td style='border:none;'>&nbsp;</td></tr>";
        }
        $NetTotal =  $GrandTotal - $DpsTotalAmt;
        echo "<tr style='border:none'><td style='border:none'>&nbsp;</td><td style='border:none' class='labelprint' align='right'>Grand Total : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none' class='labelprint' align='right'>&nbsp;</td><td align='right' class='labelprint' style='border:none;'>&nbsp;&nbsp;".number_format($UptoTotalAmt, 2, '.', '')."</td><td style='border:none;'>&nbsp;</td></tr>";
        echo "<tr style='border:none'><td style='border:none'>&nbsp;</td><td style='border:none' class='labelprint' align='right'>Less Previous Payment : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none' class='labelprint' align='right'>&nbsp;</td><td align='right' class='labelprint' style='border:none;'>(-)&nbsp;&nbsp;".number_format($DpsTotalAmt, 2, '.', '')."</td><td style='border:none;'>&nbsp;</td></tr>";
        echo "<tr style='border:none'><td style='border:none'>&nbsp;</td><td style='border:none' class='labelprint' align='right'>Net Total : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none' class='labelprint' align='right'>&nbsp;</td><td align='right' class='labelprint' style='border:none;'>&nbsp;&nbsp;".number_format($NetTotal, 2, '.', '')."</td><td style='border:none;'>&nbsp;</td></tr>";

        $TotalRecovery = 0;
        $ea = 1; $eb = 1; $ed = 1; 
        $ea_text = "<b>Under 8[a]</b>"; $eb_text = "<b>Under 8[b]</b>";  $ec_text = "<b>Under 8[c]</b>";  $ed_text = "<b><u>With hold Amount</u></b>";
        echo "<tr style='border:none'><td style='border:none' align='right' class='labelprint'></td><td style='border:none;' class='labelprint' align='right'>".$ea_text."</td><td style='border:none;' align='right' class='labelprint'></td><td style='border:none' colspan=''>&nbsp;</td></tr>";
        if($MopDataValue->wct_percent != 0)
        {
            echo "<tr style='border:none'><td style='border:none' align='right' class='labelprint'></td><td style='border:none;' class='labelprint' align='right'>W.C.T @ ".number_format($MopDataValue->wct_percent, 2, '.', '')."% : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none;' align='right' class='labelprint'>&nbsp;&nbsp;".number_format($MopDataValue->wct_amt, 2, '.', '')."</td><td style='border:none' colspan=''>&nbsp;</td></tr>";
            $ea++; $ea_text = "";
            $TotalRecovery = $TotalRecovery + $MopDataValue->wct_amt;
        }
        if($MopDataValue->lw_cess_percent != 0)
        {
            echo "<tr style='border:none'><td style='border:none' align='right' class='labelprint'></td><td style='border:none;' class='labelprint' align='right'>Labour Welfare CESS @ ".number_format($MopDataValue->lw_cess_percent, 2, '.', '')."% : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none;' align='right' class='labelprint'>&nbsp;&nbsp;".number_format($MopDataValue->lw_cess_amt, 2, '.', '')."</td><td style='border:none' colspan=''>&nbsp;</td></tr>";
            $ea++; $ea_text = "";
            $TotalRecovery = $TotalRecovery + $MopDataValue->lw_cess_amt;
        }
        if($MopDataValue->mob_adv_amt_rec != 0)
        {
            echo "<tr style='border:none'><td style='border:none' align='right' class='labelprint'></td><td style='border:none;' class='labelprint' align='right'>Mobilization Advance (Rec.)  : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none;' align='right' class='labelprint'>&nbsp;&nbsp;".number_format($MopDataValue->mob_adv_amt_rec, 2, '.', '')."</td><td style='border:none' colspan=''>&nbsp;</td></tr>";
            $ea++; $ea_text = "";
            $TotalRecovery = $TotalRecovery + $MopDataValue->mob_adv_amt_rec;
        }
        if($MopDataValue->pl_mac_adv_rec != 0)
        {
            echo "<tr style='border:none'><td style='border:none' align='right' class='labelprint'></td><td style='border:none;' class='labelprint' align='right'>P&M Advance (Rec.) : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none;' align='right' class='labelprint'>&nbsp;&nbsp;".number_format($MopDataValue->pl_mac_adv_rec, 2, '.', '')."</td><td style='border:none' colspan=''>&nbsp;</td></tr>";
            $ea++; $ea_text = "";
            $TotalRecovery = $TotalRecovery + $MopDataValue->pl_mac_adv_rec;
        }
        if($MopDataValue->hire_charges != 0)
        {
            echo "<tr style='border:none'><td style='border:none' align='right' class='labelprint'></td><td style='border:none;' class='labelprint' align='right'>Hire Charges : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none;' align='right' class='labelprint'>&nbsp;&nbsp;".number_format($MopDataValue->hire_charges, 2, '.', '')."</td><td style='border:none' colspan=''>&nbsp;</td></tr>";
            $ea++; $ea_text = "";
            $TotalRecovery = $TotalRecovery + $MopDataValue->adv_amt;
        }
        if($MopDataValue->adv_amt != 0)
        {
            echo "<tr style='border:none'><td style='border:none' align='right' class='labelprint'></td><td style='border:none;' class='labelprint' align='right'>75% Advance Rec. : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none;' align='right' class='labelprint'>&nbsp;&nbsp;".number_format($MopDataValue->adv_amt, 2, '.', '')."</td><td style='border:none' colspan=''>&nbsp;</td></tr>";
            $ea++; $ea_text = "";
            $TotalRecovery = $TotalRecovery + $MopDataValue->adv_amt;
        }
        if($MopDataValue->other_recovery_1 != 0)
        {
            echo "<tr style='border:none'><td style='border:none' align='right' class='labelprint'></td><td style='border:none;' class='labelprint' align='right'>Other Recovery : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none;' align='right' class='labelprint'>&nbsp;&nbsp;".number_format($MopDataValue->other_recovery_1, 2, '.', '')."</td><td style='border:none' colspan=''>&nbsp;</td></tr>";
            $ea++; $ea_text = "";
            $TotalRecovery = $TotalRecovery + $MopDataValue->other_recovery_1_amt;
        }
        
        
        echo "<tr style='border:none'><td style='border:none' align='right' class='labelprint'></td><td style='border:none;' class='labelprint' align='right'>".$eb_text."</td><td style='border:none;' align='right' class='labelprint'></td><td style='border:none' colspan=''>&nbsp;</td></tr>";
        if($MopDataValue->incometax_percent != 0)
        {
            echo "<tr style='border:none'><td style='border:none' align='right' class='labelprint'></td><td style='border:none;' class='labelprint' align='right'>Income Tax @ ".number_format($MopDataValue->incometax_percent, 2, '.', '')."% : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none;' align='right' class='labelprint'>&nbsp;&nbsp;".number_format($MopDataValue->incometax_amt, 2, '.', '')."</td><td style='border:none' colspan=''>&nbsp;</td></tr>";
            $ea++; $ea_text = "";
            $TotalRecovery = $TotalRecovery + $MopDataValue->incometax_amt;
        }
        if($MopDataValue->sgst_tds_perc != 0)
        {
            echo "<tr style='border:none'><td style='border:none' align='right' class='labelprint'></td><td style='border:none;' class='labelprint' align='right'>SGST @ ".number_format($MopDataValue->sgst_tds_perc, 2, '.', '')."%  On Rs. ".$MopDataValue->bill_amt_gst." : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none;' align='right' class='labelprint'>&nbsp;&nbsp;".number_format($MopDataValue->sgst_tds_amt, 2, '.', '')."</td><td style='border:none' colspan=''>&nbsp;</td></tr>";
            $ea++; $ea_text = "";
            $TotalRecovery = $TotalRecovery + $MopDataValue->sgst_tds_amt;
        }
        if($MopDataValue->cgst_tds_perc != 0)
        {
            echo "<tr style='border:none'><td style='border:none' align='right' class='labelprint'></td><td style='border:none;' class='labelprint' align='right'>CGST @ ".number_format($MopDataValue->cgst_tds_perc, 2, '.', '')."%  On Rs. ".$MopDataValue->bill_amt_gst." : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none;' align='right' class='labelprint'>&nbsp;&nbsp;".number_format($MopDataValue->cgst_tds_amt, 2, '.', '')."</td><td style='border:none' colspan=''>&nbsp;</td></tr>";
            $ea++; $ea_text = "";
            $TotalRecovery = $TotalRecovery + $MopDataValue->cgst_tds_amt;
        }
        if($MopDataValue->igst_tds_perc != 0)
        {
            echo "<tr style='border:none'><td style='border:none' align='right' class='labelprint'></td><td style='border:none;' class='labelprint' align='right'>IGST @ ".number_format($MopDataValue->igst_tds_perc, 2, '.', '')."%  On Rs. ".$MopDataValue->bill_amt_gst." : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none;' align='right' class='labelprint'>&nbsp;&nbsp;".number_format($MopDataValue->igst_tds_amt, 2, '.', '')."</td><td style='border:none' colspan=''>&nbsp;</td></tr>";
            $ea++; $ea_text = "";
            $TotalRecovery = $TotalRecovery + $MopDataValue->igst_tds_amt;
        }
        if($MopDataValue->sd_amt != 0)
        {
            echo "<tr style='border:none'><td style='border:none' align='right' class='labelprint'></td><td style='border:none;' class='labelprint' align='right'>Security Deposit @ ".$MopDataValue->sd_percent."% : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none;' align='right' class='labelprint'>&nbsp;&nbsp;".number_format($MopDataValue->sd_amt, 2, '.', '')."</td><td style='border:none' colspan=''>&nbsp;</td></tr>";
            $ea++; $ea_text = "";
            $TotalRecovery = $TotalRecovery + $MopDataValue->sd_amt;
        }
        if($MopDataValue->water_charge != 0)
        {
            echo "<tr style='border:none'><td style='border:none' align='right' class='labelprint'></td><td style='border:none;' class='labelprint' align='right'>Water Charges : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none;' align='right' class='labelprint'>&nbsp;&nbsp;".number_format($MopDataValue->water_charge, 2, '.', '')."</td><td style='border:none' colspan=''>&nbsp;</td></tr>";
            $ea++; $ea_text = "";
            $TotalRecovery = $TotalRecovery + $MopDataValue->water_charge;
        }
        if($MopDataValue->electricity_charge != 0)
        {
            echo "<tr style='border:none'><td style='border:none' align='right' class='labelprint'></td><td style='border:none;' class='labelprint' align='right'>Electricity Charges. : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none;' align='right' class='labelprint'>&nbsp;&nbsp;".number_format($MopDataValue->electricity_charge, 2, '.', '')."</td><td style='border:none' colspan=''>&nbsp;</td></tr>";
            $ea++; $ea_text = "";
            $TotalRecovery = $TotalRecovery + $MopDataValue->electricity_charge;
        }
        if($MopDataValue->mob_adv_int_amt != 0)
        {
            echo "<tr style='border:none'><td style='border:none' align='right' class='labelprint'></td><td style='border:none;' class='labelprint' align='right'>Mob. Adv. Interest : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none;' align='right' class='labelprint'>&nbsp;&nbsp;".number_format($MopDataValue->mob_adv_int_amt, 2, '.', '')."</td><td style='border:none' colspan=''>&nbsp;</td></tr>";
            $ea++; $ea_text = "";
            $TotalRecovery = $TotalRecovery + $MopDataValue->mob_adv_int_amt;
        }
        if($MopDataValue->pl_mac_adv_int_amt != 0)
        {
            echo "<tr style='border:none'><td style='border:none' align='right' class='labelprint'></td><td style='border:none;' class='labelprint' align='right'>P&M Adv. Interest : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none;' align='right' class='labelprint'>&nbsp;&nbsp;".number_format($MopDataValue->pl_mac_adv_int_amt, 2, '.', '')."</td><td style='border:none' colspan=''>&nbsp;</td></tr>";
            $ea++; $ea_text = "";
            $TotalRecovery = $TotalRecovery + $MopDataValue->pl_mac_adv_int_amt;
        }
        if($TotalRecovery != 0)
        {
            echo "<tr style='border:none'><td style='border:none' align='right' class='labelprint'></td><td style='border:none;' class='labelprint' align='right'>Total recovery : <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none;' align='right' class='labelprint'>&nbsp;&nbsp;</td><td style='border:none' colspan='' align='right'>&nbsp;".number_format($TotalRecovery, 2, '.', '')."</td></tr>";
        }

        $NetPayableAmt = $NetTotal - $TotalRecovery;
        echo "<tr style='border:none'><td style='border:none' align='right' class='labelprint'></td><td style='border:none;' class='labelprint' align='right'><b>Net Payable Amount :</b> <i class='fa fa-inr' style='font-weight:normal; width:4px; height:5px;'> </td><td style='border:none;' align='right' class='labelprint'>&nbsp;&nbsp;</td><td style='border:none' colspan='' align='right'><b>&nbsp;".number_format($NetPayableAmt, 2, '.', '')."</b></td></tr>";
    }
}
echo $LastRowStr;
echo $TableCloseStr;
@endphp