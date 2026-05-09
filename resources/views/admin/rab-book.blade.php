@include('layouts.library.config')
@include('layouts.library.functions') 
@include('layouts.library.binddata') 
@include('layouts.library.common')
@include('layouts.library.spellnumber')
@include('layouts.header')
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Abstrack MBook</title>
    <link rel="stylesheet" href="script/font.css" />
</head>
<body  bgcolor="#444444" onload="setRowSpan();noBack();" onpageshow="if (event.persisted) noBack();" onUnload="" style="padding:0; margin:0;">
<table width="1087px" height="56px" align="center" class='label' bgcolor="#035A85">
	<tr bgcolor="#035A85" style="position:fixed;">
		<td style="color:#FFFFFF; border:none; font-size:16px;" width="1077px"  height="48px" class="" align="center">Abstract History - View </td>
	</tr>
</table>
<form name="form" method="post" onsubmit="return confirm('Do you really want to submit the Book?');">
<table width='1087px' cellpadding='3' cellspacing='3' align='center' class='label table1' bgcolor="#FFFFFF" id="table1">
<!--<tr bgcolor="#d4d8d8" style="height:5px"><td colspan="13" style="border-top-color:#666666; border-bottom-color:#666666;height:5px"></td></tr>-->
<tr>
	<td colspan='3' align='right' class='labelbold'>C/o Page No / Abstract MB No </td>
	<td></td>
	<td></td>
	<td align='right' class='labelbold'></td>
	<td></td>
	<td></td>
	<td align='right' class='labelbold'></td>
	<td></td>
	<td align='right' class='labelbold'></td>
	<td></td>
</tr>
<tr class='labelprint'><td colspan='12' align='center' style='border-bottom:2px solid white;border-left:1px solid white;border-right:1px solid white;'>Page <?php //echo $page; ?></td></tr>
</table>
<p style='page-break-after:always;'></p>
<table width="1087px" border="0"  cellpadding="2" cellspacing="2" align="center" bgcolor="#FFFFFF" style="border:none;" class="labelprint">
	<tr style="border:none;"><td align="center" style="border:none;">Abstract M.Book No.&nbsp;&nbsp;</td></tr>
</table>
<table width='1087px' cellpadding='3' cellspacing='3' align='center' class='label table1' bgcolor='#FFFFFF' id='table1'>
<tr>
	<td colspan='3' align='right' class='labelbold'>B/f from Page No / Abstract MB No </td>
	<td></td>
	<td></td>
	<td align='right' class='labelbold'></td>
	<td></td>
	<td></td>
	<td align='right' class='labelbold'></td>
	<td></td>
	<td align='right' class='labelbold'></td>
	<td></td>
</tr>
<input type="hidden" name="hid_item_str" id="hid_item_str" value="" />
<tr border='1' bgcolor="" class="labelprint">
	<!--<td  align='center' width='' class='labelsmall' style=" border-top-color:#666666; border-bottom-color:#0A9CC5; background-color:#0A9CC5" id="td_popupbutton<?php echo $table_group_row; ?>">
		<input type="checkbox" name="check" id="ch_item" value=""  />
	</td>-->
	<td width="61px" align="center" style="border-top-color:#666666;" class="">
	</td>
	<td colspan="8" style="border-top-color:#666666;" class="">
	</td>
	<td style="border-top-color:#666666;" width="40px">&nbsp;</td>
	<td style="border-top-color:#666666;" width="40px">&nbsp;</td>
	<td style="border-top-color:#666666;" width="40px">&nbsp;</td>
</tr>
					<tr border='1' bgcolor="#FFFFFF" class="labelprint">
						<td  align='center' width='' class='' rowspan="">&nbsp;</td>
						<td  align='left' width='180px' class='' rowspan="" style="font-size:10px;"></td>
						<td  align='right' width='' class='' rowspan=""></td>
						<td  align='left' width='' class='' rowspan="">&nbsp;</td>
						<td  align='left' width='' class='' rowspan="">&nbsp;</td>
						<td  align='right' width='' class='' rowspan="">&nbsp;</td>
						<td  align='right' width='' class='' rowspan=""></td>
						<td  align='right' width='' class=''></td>
						<td  align='right' width='' class=''>
						</td>
						<td  align='right' width='6%' class='' rowspan=""></td>
						<td  align='right' width='3%' class='' rowspan="">
						</td>
						<td  align='center' width='40px' class='' rowspan="" style="font-size:9px;">
						</td>
					</tr>
							<tr border='1' bgcolor="#FFFFFF" class="labelprint">
								<td  align='right' width='' class=''></td>
								<td  align='right' width='' class=''></td>
								<td  align='right' width='' class=''></td>
								<td  align='right' width='' class=''>
								</td>
								<td  align='center' width='40px' class='' rowspan="" style="font-size:9px;">
								</td>
							</tr>
					<tr border='1' bgcolor="#FFFFFF" class="labelprint">
						<!--<td  align='left' width='3%' class=''>&nbsp;</td>-->
						<td  align='left' width='' class='' rowspan="">&nbsp;</td>
						<td  align='left' width='' class='' style="font-size:10px;" rowspan=""></td>
						<td  align='right' width='' class='' rowspan=""></td>
						<td  align='left' width='' class='' rowspan="">&nbsp;</td>
						<td  align='left' width='' class='' rowspan="">&nbsp;</td>
						<td  align='right' width='' class='' rowspan="">&nbsp;</td>
						<td  align='left' width='' class='' rowspan="">&nbsp;</td>
						<td  align='right' width='' class=''>
						</td>
						<td  align='right' width='' class=''>
						</td>
						<td  align='right' width='' class='' rowspan=""></td>
						<td  align='right' width='' class='' rowspan="">
						</td>
						<td  align='center' width='' class='' rowspan="" style="font-size:9px;">
						</td>
					</tr>	
					<tr border='1' bgcolor="#FFFFFF" class="labelprint">
						<td  align='right' width='' class=''></td>
						<td  align='right' width='' class=''></td>
						<td  align='right' width='' class=''></td>
						<td  align='right' width='' class=''>
						</td>
						<td  align='center' width='' class='' rowspan="" style="font-size:9px;">
						</td>
					</tr>
		<tr border='1' bgcolor="#FFFFFF" class="labelprint">
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
		</tr>
		<tr border='1' bgcolor="#FFFFFF" class="labelprint">
			<td  align='right' width='' class=''></td>
			<td  align='right' width='' class=''></td>
			<td  align='center' width='' class='' style="font-size:9px;"></td>
		</tr>
		<tr border='1' class="labelprint" style="font-size:10px;">
			<td colspan="12" align="left" bgcolor="">Remarks &nbsp; :&nbsp;&nbsp;&nbsp;</td>
		</tr>
	<tr border='1' class="labelprint" bgcolor="">
		<!--<td  align='left' width='3%' class=' label' style="border-bottom-color:#666666">&nbsp;</td>-->
		<td  align='left' width='' class=''>&nbsp;</td>
		<td  align='right' width='' class='labelbold'>TOTAL</td>
		<td  align='right' width='' class=''>
		</td>
		<td  align='right' width='' class=''>
		</td>
		<td  align='left' width='' class=''>
		</td>
		<td  align='right' width='' class=''>
		</td>
		<td  align='left' width='' class=''>&nbsp;</td>
		<td  align='right' width='' class=''>
		</td>
		<td  align='right' width='' class=''>
		</td>
		<td  align='right' width='' class=''>
		</td>
		<td  align='right' width='' class=''>
		</td>
		<td  align='right' width='' class=''>&nbsp;</td>
	</tr>
	<tr bgcolor=""><td colspan="12">&nbsp;</td></tr>
	<!--<tr bgcolor="#d4d8d8" style="height:10px"><td colspan="13" style="border-top-color:#0A9CC5; border-bottom-color:#0A9CC5;"></td></tr>-->
	<input type="hidden" name="row_count" id="row_count" value="" />
<tr>
	<td colspan='3' align='right' class='labelbold'>C/o Page No / Abstract MB No </td>
	<td></td>
	<td></td>
	<td align='right' class='labelbold'></td>
	<td></td>
	<td></td>
	<td align='right' class='labelbold'></td>
	<td></td>
	<td align='right' class='labelbold'></td>
	<td></td>
</tr>
<tr class='labelprint'><td colspan='12' align='center' style='border-bottom:2px solid white;border-left:2px solid white;border-right:2px solid white;'>Page <?php //echo $page; ?></td></tr>
</table>
<p style='page-break-after:always;'></p>
<table width="1087px" border="0"  cellpadding="2" cellspacing="2" align="center" bgcolor="#FFFFFF" style="border:none;" class="labelprint">
	<tr style="border:none;"><td align="center" style="border:none;">Abstract M.Book No.&nbsp;&nbsp;</td></tr>
</table>
<table width='1087px' cellpadding='3' cellspacing='3' align='center' class='label table1' bgcolor='#FFFFFF' id='table1'>
<tr>
	<td colspan='3' align='right' class='labelbold'>B/f from Page No / Abstract MB No </td>
	<td></td>
	<td></td>
	<td align='right' class='labelbold'></td>
	<td></td>
	<td></td>
	<td align='right' class='labelbold'></td>
	<td></td>
	<td align='right' class='labelbold'></td>
	<td></td>
</tr>
	<tr class="labelprint" bgcolor="#F0F0F0">
		<td colspan="2" align="right">Total Cost&nbsp;&nbsp; <i class='fa fa-inr' style=' width:4px; height:5px; font-weight:normal;'></i>&nbsp;&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td align="right"></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td align="right"></td>
		<td>&nbsp;</td>
		<td align="right"></td>
		<td>&nbsp;</td>
	</tr>
	<tr class="labelprint">
		<td colspan="2" align="right">Less Over All Rebate : %&nbsp; <i class='fa fa-inr' style=' width:4px; height:5px; font-weight:normal;'></i>&nbsp;&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td align="right"></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td align="right"></td>
		<td>&nbsp;</td>
		<td align="right"></td>
		<td>&nbsp;</td>
	</tr>
	<tr class="labelbold" bgcolor="#F0F0F0">
		<td colspan="2" align="right">Gross Amount&nbsp;&nbsp; <i class='fa fa-inr' style=' width:4px; height:5px;'></i>&nbsp;&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td align="right"></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td align="right"></td>
		<td>&nbsp;</td>
		<td align="right"></td>
		<td>&nbsp;</td>
	</tr>
<tr>
	<td colspan='3' align='right' class='labelbold'>C/o Page No / Abstract MB No </td>
	<td></td>
	<td></td>
	<td align='right' class='labelbold'></td>
	<td></td>
	<td></td>
	<td align='right' class='labelbold'></td>
	<td></td>
	<td align='right' class='labelbold'></td>
	<td></td>
</tr>
<tr class='labelprint'><td colspan='12' align='center' style='border-bottom:2px solid white;border-left:2px solid white;border-right:2px solid white;'>Page <?php //echo $page; ?></td></tr>
</table>
<p style='page-break-after:always;'></p>
<table width="1087px" border="0"  cellpadding="2" cellspacing="2" align="center" bgcolor="#FFFFFF" style="border:none;" class="labelprint">
	<tr style="border:none;"><td align="center" style="border:none;">Abstract M.Book No.&nbsp;&nbsp;</td></tr>
</table>
<table width='1087px' cellpadding='3' cellspacing='3' align='center' class='label table1' bgcolor='#FFFFFF' id='table1'>
<tr>
	<td colspan='3' align='right' class='labelbold'>B/f from Page No / Abstract MB No </td>
	<td></td>
	<td></td>
	<td align='right' class='labelbold'></td>
	<td></td>
	<td></td>
	<td align='right' class='labelbold'></td>
	<td></td>
	<td align='right' class='labelbold'></td>
	<td style="border-bottom:1px dashed #CCCCCC;"></td>
</tr>

<tr class='labelprint'><td colspan='12' align='center' style='border-bottom:2px solid white;border-left:1px solid white;border-right:1px solid white;'>

Page </td></tr>
</table>
<p style='page-break-after:always;'></p>
	<tr>
	<td  align='left' width='7%' class='labelsmall'>&nbsp;</td>
	<td  align='left' width='20%' class='labelsmall'>&nbsp;</td>
	<td  align='right' width='8%' class='labelsmall'>&nbsp;</td>
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
<input type="hidden" name="txt_abstmbno" id="txt_abstmbno" value="" />
<input type="hidden" name="txt_maxpage" id="txt_maxpage" value="" />

<input type="hidden" name="table_group_count" id="table_group_count" value="" />
<input type="hidden" name="txt_sheetid" id="txt_sheetid" value="" />
<div align="center" class="btn_outside_sect printbutton">
	<!--<div class="btn_inside_sect"><input type="Submit" name="Submit" value="Submit" id="Submit" /> </div>-->
	<!--<div class="btn_inside_sect"><input type="button" class="backbutton" name="print" value=" Print " onclick="printBook();" /></div>-->
	<div class="btn_inside_sect"><input type="button" name="Back" value="Back" id="back" class="backbutton" onclick="goBack();" /> </div>
</div> 

		<!-- modal content -->
		<!--<div id="basic-modal-content">
			<div align="center" class="popuptitle">Part Payment Work Sheet</div>
			<div align="center" style="padding-top:10px;">
			<table class="label table2" width="100%" cellpadding="3" cellspacing="3" id="table2">
				<tr bgcolor="">
					<td width="60px" align="left">Item No.</td>
					<td width="">
						<input type="text" readonly="" name="txt_item_no" id="txt_item_no" size="8" class="popuptextbox" />
						<input type="hidden" name="txt_item_id" id="txt_item_id" size="8" class="popuptextbox" />
					</td>
					<td width="60px" align="center">RAB No.</td>
					<td width="">
						<input type="text" name="txt_rab_no" id="txt_rab_no" size="6" class="popuptextbox" value="" />
					</td>
					<td  align="left" colspan="4">Measurement Date - From &nbsp; :
						<input type="text" name="txt_from_date" id="txt_from_date" size="12" class="popuptextbox" value="" />
					To :
						<input type="text" name="txt_to_date" id="txt_to_date" size="12" class="popuptextbox" value="" />
					</td>
				</tr>
				<tr bgcolor="">
				<td width="135px" align="left">Item Description</td>
					<td width="700px" align="left" colspan="7">
						<textarea name="txt_item_desc" id="txt_item_desc" class="popuptextbox" rows="2" style="text-align:left; width:820px; height:34px;"></textarea>
					</td>
				</tr>

			</table>
			</div>
			<div style="padding-top:10px; height:325px;">
				<div style="float:left; width:567px; height:320px; overflow-y: auto;">
					<table class="label table2" cellpadding="3" cellspacing="3" width="94%" id="table3">
					<tr bgcolor="#0080ff" style="color:#FFFFFF">
						<td align="center" colspan="7">Deduct Previous Measurement</td>
					</tr>
					<tr>
						<td align="left" colspan="7" bgcolor="#f2efef">
						Deduct Previous Measurement Total Quantity&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;
						<input type="text" name="txt_dpm_qty" id="txt_dpm_qty" size="17" class="popuptextbox" style="text-align:left; background-color:#f2efef" />
						</td>
					</tr>
					<tr>
						<td width="10px" rowspan="2" align="center">RBN.</td>
						<td width="61px" rowspan="2" align="center">Item Qty.</td>
						<td width="63px" rowspan="2" align="center">Rate&nbsp; <i class='fa fa-inr' style=' width:4px; height:5px;'></i> </td>
						<td colspan="2" align="center" bgcolor="#eaeae8">Paid Details</td>
						<td colspan="2" align="center" bgcolor="#eaeae8">Payable Details</td>
					</tr>
					<tr>
						<td width="23px" align="center">(%)</td>
						<td width="110px" align="center">Amount&nbsp; <i class='fa fa-inr' style=' width:4px; height:5px;'></i> </td>
						<td width="23px" align="center">(%)</td>
						<td style='width:110px' align="center">Amount <i class='fa fa-inr' style=' width:4px; height:5px;'></i> </td>
					</tr>
					<tr>
						<td colspan="4" align="right">Total Amount <i class='fa fa-inr' style=' width:4px; height:5px;'></i>&nbsp;</td>
						<td align="left"><input type="text" name="txt_partpay_total_paidamt_dpm" id="txt_partpay_total_paidamt_dpm" class="dynamictextbox" style="text-align:right; width:100px;pointer-events: none;" /></td>
						<td colspan=""></td>
						<td colspan=""><input type="text" name="txt_partpay_total_payableamt_dpm" id="txt_partpay_total_payableamt_dpm" class="dynamictextbox" style="text-align:right; width:100px;pointer-events: none;" /></td>
					</tr>
					<tr>
						<td colspan="7">Remarks:<br/><textarea name="txt_dpm_remarks" id="txt_dpm_remarks" rows="3" style="width:519px;"></textarea>
						</td>
					</tr>
				</table>
				</div>
				<div style="float:right;  width:427px; height:320px; overflow-y: auto;">
					<table class="label table2" cellpadding="3" cellspacing="3" width="93%" id="table4">
						<tr bgcolor="#0080ff" style="color:#FFFFFF">
							<td align="center" colspan="5">Since Last Measurement</td>
						</tr>
						<tr>
							<td align="left" colspan="5" bgcolor="#f2efef">
							Since Last Measurement Quantity&nbsp;:&nbsp;
							<input type="text" name="txt_slm_qty" id="txt_slm_qty" size="13" class="popuptextbox" style="text-align:left; background-color:#f2efef" />
							<input type="hidden" name="hid_slm_qty" id="hid_slm_qty" size="13" class="popuptextbox" style="text-align:left; background-color:#f2efef" />
							</td>
						</tr>
						<tr>
							<td width="61px" align="center">Item Qty.</td>
							<td width="63px" align="center">Rate&nbsp;<i class='fa fa-inr' style=' width:4px; height:5px;'></i></td>
							<td width="23px" align="center">(%)</td>
							<td width="50px" align="center">Amount&nbsp;<i class='fa fa-inr' style=' width:4px; height:5px;'></i></td>
							<td width="10px" align="center">&nbsp;</td>
						</tr>
						<tr id='rowid0'>
							<td width="61px" align="center" class="dynamicrowcell">
							<input type="text" name="txt_partpay_qty_slm[]" id="txt_partpay_qty_slm0" class="dynamictextbox" style="text-align:right; width:93px; border: 1px solid #2aade4;" onblur="ValidateSlm(); calculateAmount(this,0,'qty','slm');" />
							</td>
							<td width="63px" align="center" class="dynamicrowcell">
							<input type="text" name="txt_item_rate_slm" readonly="" id="txt_item_rate_slm0" class="dynamictextbox" style="text-align:right; width:80px;" onblur="calculateAmount(this,0,'rate','slm');" />
							</td>
							<td width="23px" align="center" class="dynamicrowcell">
							<input type="text" name="txt_partpay_percent_slm" id="txt_partpay_percent_slm0" class="dynamictextbox" style="text-align:right; width:40px; border: 1px solid #2aade4;" onblur="ValidatePercent(this,'slm',0); calculateAmount(this,0,'percent','slm');" />
							</td>
							<td width="50px" align="center" class="dynamicrowcell">
							<input type="text" name="txt_partpay_amt_slm[]" id="txt_partpay_amt_slm0" class="dynamictextbox" style="text-align:right; width:130px;pointer-events: none;" />
							</td>
							<td width="10px" align="center" class="dynamicrowcell" style="text-align:center;">
							<input type="button" name="btn_add_row_slm" id="btn_add_row_slm" class="editbtnstyle" value=" + " style="width:32px; text-align:center; font-weight:bold; border-radius: 0px;" onclick="addRow();" />
							<input type="hidden" name="hid_slm_result[]" id="hid_slm_result0" class="dynamictextbox" />
							</td>
						</tr>
						<tr>
							<td width="147px" colspan="3" align="right">Total Amount&nbsp;<i class='fa fa-inr' style=' width:4px; height:5px;'></i>&nbsp;</td>
							<td width="50px" align="right"  class="dynamicrowcell">
							<input type="text" name="txt_partpay_total_amt_slm" id="txt_partpay_total_amt_slm" class="dynamictextbox" style="text-align:right; width:130px;pointer-events: none;" />
							</td>
							<td width="10px" align="center">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="5">Remarks:<br/><textarea name="txt_slm_remarks" id="txt_slm_remarks" rows="3" style="width:375px;"></textarea>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<div align="right">
				<table width="100%" height="65" class="label" cellpadding="3" cellspacing="3">
					<tr>
					<td align="right" width="440px">
					<label style="background:#EAEAEA; padding:6px;">Over All Total Amount</label>&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class='fa fa-inr' style=' width:4px; height:5px;'></i>&nbsp;
					<input type="text" name="txt_overall_total" id="txt_overall_total" size="20" class="dynamictextbox dynamictextbox2" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					</td>
					</tr>
				</table>
			</div>
			<div class="bottomsection" align="center">
				<div class="buttonsection" align="center"><input type="button" name="btn_save" id="btn_save" value=" Save " class="buttonstyle" onclick="SaveData()" /></div>
				<div class="buttonsection" align="center"><input type="button" name="btn_cancel" id="btn_cancel" value=" Cancel " class="buttonstyle" onclick="CancelData()" /></div>
			</div>
		</div>
		
		<!-- preload the images -->
		<!--<div style='display:none'>
			<img src='img/basic/x.png' alt='' />
		</div>     -->
</form>
</body>

</html>