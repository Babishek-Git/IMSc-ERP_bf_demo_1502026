@include('layouts.library.config')
@include('layouts.library.functions') 
@include('layouts.library.binddata') 
@include('layouts.library.common')
@include('layouts.header')
    <body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
        <!--==============================header=================================-->
        <form action="" method="post" enctype="multipart/form-data" name="form">
           @include('admin.menu')
            <!--==============================Content=================================-->
			<div class="content">
                <div align="center" class="container_12">
<table width='875' cellpadding='3' cellspacing='3' align='center' class='label table1 labelprint' bgcolor="#FFFFFF" id="table1">
	<tr style=" height:35px;" class="label">
		<td align="center" valign="middle" nowrap="nowrap">Description</td>
		<td align="center" valign="middle" nowrap="nowrap">Month</td>
		<td align="center" valign="middle" nowrap="nowrap"> Qty.<br/>in mt. </td>
		<td align="center" valign="middle" nowrap="nowrap"> MB/Page </td>
		<td align="center" valign="middle">Base <br/>Index</td>
		<td align="center" valign="middle">Base <br/>Price</td>
		<td align="center" valign="middle">Price <br/>Index</td>
		<td align="center" valign="middle">Formula</td>
		<td align="center" valign="middle">Formula with Values</td>
		<td align="center" valign="middle" nowrap="nowrap">Amount &nbsp;<i class='fa fa-inr' style='font-weight:normal; padding-top:5px;'></i></td>
	</tr>
	<tr style=" height:35px;">
		<td align="center" valign="middle" nowrap="nowrap" rowspan=""></td>
		<td align="center" valign="middle" nowrap="nowrap"></td>
		<td align="right" valign="middle" nowrap="nowrap"></td>
		<td align="center" valign="middle" nowrap="nowrap"></td>
		<td align="center" valign="middle"></td>
		<td align="center" valign="middle"></td>
		<td align="center" valign="middle"></td>
		<td align="center" valign="middle"></td>
		<td align="center" valign="middle"></td>
		<td align="right" valign="middle" nowrap="nowrap">&nbsp;</td>
	</tr>
	<tr style=" height:35px;">
		<!--<td align="center" valign="middle" nowrap="nowrap"></td>-->
		<td align="center" valign="middle" nowrap="nowrap"></td>
		<td align="right" valign="middle" nowrap="nowrap"></td>
		<td align="center" valign="middle" nowrap="nowrap"></td>
		<td align="center" valign="middle"></td>
		<td align="center" valign="middle"></td>
		<td align="center" valign="middle"></td>
		<td align="center" valign="middle"></td>
		<td align="center" valign="middle"></td>
		<td align="right" valign="middle" nowrap="nowrap">&nbsp;</td>
	</tr>	
  	<tr style=" height:35px;" class="label">
		<td align="right" valign="middle" colspan="5"><input type="text" name="txt_tca_co" id="txt_tca_co" class="hidtextbox"></td>
		<td colspan="4" align="right" valign="middle">10-CA Escalation Amount&nbsp;&nbsp;<i class='fa fa-inr' style='font-weight:normal; padding-top:5px;'></i>&nbsp;</td>
		<td align="right" valign="middle"><?php $TCA_Total_Amt = round($TCA_Total_Amt); echo number_format($TCA_Total_Amt,2,".",","); ?>&nbsp;</td>
	</tr>
	<tr style='border-style:none;'><td colspan='10' align='center' style='border-style:none;'> page <?= $page; ?></td></tr>
</table>
<p style='page-break-after:always;'>&nbsp;</p>
<!--*************************** TCA Ends Here *****************************////-->

<!--*************************** TCC Ends Here *****************************////-->

<table width='875' cellpadding='3' cellspacing='3' align='center' class='label table1 labelprint' bgcolor="#FFFFFF" id="table1">
	<tr class="label" style="height:30px;" id="det_row0">
		<td align="center" valign="middle" nowrap="nowrap">Sl.No.</td>
		<td align="center" valign="middle" nowrap="nowrap" width="30%">Description </td>
		<td align="center" valign="middle" nowrap="nowrap"> Formula </td>
	</tr>
	<tr style=" height:30px;" id="det_row4">
		<td align="center" valign="middle" nowrap="nowrap">4</td>
		<td align="left" valign="middle" width="30%">MBook Page No. </td>
		<td align="center" valign="middle" nowrap="nowrap">&nbsp;  </td>
	</tr>
	<tr style=" height:30px;" id="det_row5">
		<td align="center" valign="middle" nowrap="nowrap">5</td>
		<td align="left" valign="middle" width="30%">gross value of work done upto <label class="pointout">this month.</label></td>
		<td align="center" valign="middle" nowrap="nowrap"> ( A ) </td>
	</tr>
	<tr style=" height:30px;" id="det_row6">
		<td align="center" valign="middle" nowrap="nowrap">6</td>
		<td align="left" valign="middle" width="30%">gross value of work done upto <label class="pointout">last month</label>. </td>
		<td align="center" valign="middle" nowrap="nowrap"> ( B ) </td>
	
	</tr>
	<tr style=" height:30px;" id="det_row7">
		<td align="center" valign="middle" nowrap="nowrap">7</td>
		<td align="left" valign="middle" width="30%">Gross value of work done since previous Month RAB. </td>
		<td align="center" valign="middle" nowrap="nowrap"> ( C ) = (A)-(B) </td>
	
	</tr>
	<tr style=" height:30px;" id="det_row8">
		<td align="center" valign="middle" nowrap="nowrap">8</td>
		<td align="left" valign="middle" width="30%">
			Full assessed value of <label class="pointout">secured advance</label> (excluding materials covered under Cluase 10CA) fresh <label class="pointout">paid</label> in this month RAB.
		</td>
		<td align="center" valign="middle" nowrap="nowrap"> ( D ) </td>
	
	</tr>
	<tr style=" height:30px;" id="det_row9">
		<td align="center" valign="middle" nowrap="nowrap">9</td>
		<td align="left" valign="middle" width="30%">
			Full assessed value of <label class="pointout">secured advance</label> (excluding materials covered under Cluase 10CA)<label class="pointout">recovered</label> in this  month RAB. 
		</td>
		<td align="center" valign="middle" nowrap="nowrap"> ( E ) </td>
	
	</tr>
	<tr style=" height:30px;" id="det_row10">
		<td align="center" valign="middle" nowrap="nowrap">10</td>
		<td align="left" valign="middle" width="30%">Full assessed value of <label class="pointout">secured advance</label> for which <label class="pointout">escalation payable</label> in this month RAB. </td>
		<td align="center" valign="middle" nowrap="nowrap"> ( F ) = (D-E) </td>
	
	</tr>
	<tr style=" height:30px;" id="det_row11">
		<td align="center" valign="middle" nowrap="nowrap">11</td>
		<td align="left" valign="middle" width="30%">Advance payment made during this month. </td>
		<td align="center" valign="middle" nowrap="nowrap"> ( G ) </td>
	
	</tr>
	<tr style=" height:30px;" id="det_row12">
		<td align="center" valign="middle" nowrap="nowrap">12</td>
		<td align="left" valign="middle" width="30%">Advance payment recovered during this month. </td>
		<td align="center" valign="middle" nowrap="nowrap"> ( H ) </td>
	
	</tr>
	<tr style=" height:30px;" id="det_row13">
		<td align="center" valign="middle" nowrap="nowrap">13</td>
		<td align="left" valign="middle" width="30%">Advance payment for which escalation is payable in this month. </td>
		<td align="center" valign="middle" nowrap="nowrap"> ( I ) = (G-H) </td>

	</tr>
	<tr style='border-style:none;'><td colspan='9' align='center' style='border-style:none;'> page </td></tr>
</table>
<p style='page-break-after:always;'>&nbsp;</p>
<table width='875' cellpadding='3' cellspacing='3' align='center' class='label table1 labelprint' bgcolor="#FFFFFF" id="table1">
	<tr class="label" style="height:30px;" id="det_row0">
		<td align="center" valign="middle" nowrap="nowrap">Sl.No.</td>
		<td align="center" valign="middle" nowrap="nowrap" width="30%">Description </td>
		<td align="center" valign="middle" nowrap="nowrap"> Formula </td>
		
	</tr>
	<tr style=" height:30px;" id="det_row14">
		<td align="center" valign="middle" nowrap="nowrap">14</td>
		<td align="left" valign="middle" width="30%">Extra items/deviated quantities paid as per Clause 12 based on prevailing market rates in this month. </td>
		<td align="center" valign="middle" nowrap="nowrap"> ( J ) </td>

	</tr>
	<tr style=" height:30px;" id="det_row15">
		<td align="center" valign="middle" nowrap="nowrap">15</td>
		<td align="left" valign="middle" width="30%">M = (C+F+I-J) </td>
		<td align="center" valign="middle" nowrap="nowrap"> ( M ) </td>
	
	</tr>
	<tr style=" height:30px;" id="det_row16">
		<td align="center" valign="middle" nowrap="nowrap">16</td>
		<td align="left" valign="middle" width="30%">N = 0.85*M </td>
		<td align="center" valign="middle" nowrap="nowrap"> ( N ) </td>
	
	</tr>
	<tr style=" height:30px;" id="det_row17">
		<td align="center" valign="middle" nowrap="nowrap">17</td>
		<td align="left" valign="middle" width="30%">Less cost of materials  supplied by the department as per Clause 10 and recovered during the month. </td>
		<td align="center" valign="middle" nowrap="nowrap"> ( K ) </td>
	
	</tr>
	<tr style=" height:30px;" id="det_row18">
		<td align="center" valign="middle" nowrap="nowrap">18</td>
		<td align="left" valign="middle" width="30%">Less cost if servuces rebdered at fixed charges as per Clause 34 and recovered during this month. </td>
		<td align="center" valign="middle" nowrap="nowrap"> ( L ) </td>
	</tr>
	<tr style=" height:30px;" id="det_row19">
		<td align="center" valign="middle" nowrap="nowrap">&nbsp;</td>
		<td align="left" valign="middle" width="30%">1) Water Charges </td>
		<td align="center" valign="middle" nowrap="nowrap"> ( L1 ) </td>
	
	</tr>
	<tr style=" height:30px;" id="det_row20">
		<td align="center" valign="middle" nowrap="nowrap">&nbsp;</td>
		<td align="left" valign="middle" width="30%">2) Electricity charges</td>
		<td align="center" valign="middle" nowrap="nowrap"> ( L2 ) </td>
	
	</tr>
	<tr style=" height:30px;" id="det_row21">
		<td align="center" valign="middle" nowrap="nowrap">19</td>
		<td align="left" valign="middle" width="30%">Cost of work for which escalation is applicable for this month. </td>
		<td align="center" valign="middle" nowrap="nowrap"> W = N - (K+L1+L2) </td>
	
	</tr>
	<tr style=" height:30px;" id="det_row22">
		<td align="center" valign="middle" nowrap="nowrap">20</td>
		<td align="left" valign="middle" width="30%">Cost of work for which escalation is applicable for this quarter. </td>
		<td align="center" valign="middle" nowrap="nowrap">&nbsp;  </td>
	
	</tr>

 <!==========================**************RAB DETAILS PRINTING SECTION ENDS HERE*************===========================!>

<!==========================    ESCALATION DETAILS PRINTING SECTION STARTS HERE   ===========================!>

<tr style='border-style:none;'><td colspan='9' align='center' style='border-style:none;'> page <?= $page; ?></td></tr>
</table>
<br/>

<p style='page-break-after:always;'>&nbsp;</p>
<?php echo $title; $page++; ?>
<?php echo $table;  ?>
<table width='875' cellpadding='3' cellspacing='3' align='center' class='label table1 labelprint' bgcolor="#FFFFFF" id="table1">
	<tr class="label" style="height:35px;">
		<td align="center" valign="middle" nowrap="nowrap">Desc.</td>
		<td align="center" valign="middle" nowrap="nowrap">Month</td>
		<td align="center" valign="middle">Total RAB<br/> Value (W)</td>
		<td align="center" valign="middle">Base <br/>Index</td>
		<td align="center" valign="middle">Esc <br/>Breakup</td>
		<td align="center" valign="middle">Price <br/>Index</td>
		<td align="center" valign="middle">Avg Price <br/>Index</td>
		<td align="center" valign="middle">Formula</td>
		<td align="center" valign="middle">Formula with Values</td>
		<td align="center" valign="middle" nowrap="nowrap">Amount &nbsp;<i class='fa fa-inr' style='font-weight:normal; padding-top:5px;'></i></td>
	</tr>
		<tr style="height:35px;">
			<td align="center" rowspan="" valign="middle" nowrap="nowrap"></td>
			<td align="center" valign="middle" nowrap="nowrap"></td>
			<td align="center" rowspan="" valign="middle"></td>
			<td align="center" rowspan="" valign="middle"></td>
			<td align="center" rowspan="" valign="middle"></td>
			<td align="center" valign="middle"></td>
			<td align="center" rowspan="" valign="middle"></td>
			<td align="center" rowspan="" valign="middle"></td>
			<td align="center" rowspan="" valign="middle"></td>
			<td align="center" rowspan="" valign="middle" nowrap="nowrap"></td>
		</tr>
		<tr style="height:35px;">
			<td align="center" valign="middle" nowrap="nowrap"></td>
			<td align="center" valign="middle"><?php echo $pi_rate; ?></td>
		</tr>
	
		<tr style="height:35px;" class="label">
			<td align="right" valign="middle" colspan="6"><input type="text" name="txt_tcc_co" id="txt_tcc_co" class="hidtextbox"></td>
			<td align="right" valign="middle" colspan="3">10-CC Escalation amount for this Quarter&nbsp;&nbsp; &nbsp;<i class='fa fa-inr' style='font-weight:normal; padding-top:5px;'></i>&nbsp;&nbsp;&nbsp;</td>
			<td align="center" valign="middle"></td>
		</tr>
		<tr style='border-style:none;'><td colspan='10' align='center' style='border-style:none;'> page </td></tr>
</table>
<table width='675' cellpadding='3' cellspacing='3' align='center' class='label table1 labelprint' bgcolor="#FFFFFF" id="table1">
	<tr><td colspan="3" align="center">Escalation for Quarter - I</td></tr>
	<tr>
		<td>10-CA Escalation amount for Quarter - </td>
		<td>B/f MB-/Pg-</td>
		<td align="right">&nbsp;</td>
	</tr>
	<tr>
		<td>10-CC Escalation amount for Quarter - </td>
		<td>B/f MB-/Pg-</td>
		<td align="right">&nbsp;</td>
	</tr>
	<tr>
		<td>Total Escalation amount for Quarter - </td>
		<td>C/o MB/Pg</td>
		<td align="right">&nbsp;</td>
	</tr>
</table>
<!--*************************** TCC Ends Here *****************************////-->
		<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
			<div class="buttonsection">
				<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
			</div>
			<!--<div class="buttonsection">
				<input type="submit" name="submit" id="submit" value=" View "/>
			</div>-->
		</div>
		</div>
		</div>
        </form>
    </body>
</html>
