@include('layouts.library.config')
@include('layouts.library.functions') 
@include('layouts.library.binddata') 
@include('layouts.library.common')
@include('layouts.header')
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
  <!--==============================header=================================-->
  @include('admin.menu')
  <!--==============================Content=================================-->
		<div class="content">
        	<div class="title">Variation Statement</div>
            <div class="container_12">
                <div class="grid_12">
                    <blockquote class="bq1" style="overflow:auto" id="printSection">
                        <form name="form" method="post" action="">
                            <div class="container" align="center">
								<br/>
								<!--<table width="1173px"  bgcolor="#E8E8E8" class="table1" align="center">
									
								</table>-->
								<table width="1087px"  bgcolor="#E8E8E8" class="table1" align="center">
									<tr>
										<td class="label" colspan="2">Name of Work</td>
										<td colspan="12"></td>
									</tr>
									<tr>
										<td class="label" colspan="2">Work Oredr No.</td>
										<td colspan="12"></td>
									</tr>
									<tr>
										<td class="label" colspan="2">RAB No.</td>
										<td colspan="12"></td>
									</tr>
									<tr>
										<td class="label" colspan="14" align="center"> Variation Statement for RAB - </td>
									</tr>
									<tr class="label">
										<td align="center" valign="middle" nowrap="nowrap" rowspan="2">Item No.</td>
										<td align="left" valign="middle" rowspan="2">Description</td>
										<td align="center" valign="middle" colspan="4">As Per Agreement</td>
										<td align="center" valign="middle" colspan="2" nowrap="nowrap">As Per Execution</td>
										<td align="center" valign="middle" colspan="2">Excess</td>
										<td align="center" valign="middle" rowspan="2" nowrap="nowrap">% of Excess</td>
										<td align="center" valign="middle" colspan="2">Savings</td>
										<td align="center" valign="middle" rowspan="2" nowrap="nowrap">% of Savings</td>
									</tr>
									<tr class="label">
										<td align="left" valign="middle">Qty</td>
										<td align="left" valign="middle">Unit</td>
										<td align="left" valign="middle">Rate</td>
										<td align="left" valign="middle">Amount</td>
										<td align="left" valign="middle">Qty</td>
										<td align="left" valign="middle">Amount</td>
										<td align="left" valign="middle">Qty</td>
										<td align="left" valign="middle">Amount</td>
										<td align="left" valign="middle">Qty</td>
										<td align="left" valign="middle">Amount</td>
									</tr>
									<tr>
										<td align="center"></td>
										<td align="left" class="hideText"></td>
										<td align="right"></td>
										<td align="center"></td>
										<td align="right"></td>
										<td align="right"></td>
										
										<td align="right"></td>
										<td align="right"></td>
										
										<td align="right"></td>
										<td align="right"></td>
										<td align="center"></td>
										<td align="right"></td>
										<td align="right"></td>
										<td align="center"></td>
									</tr>
									<tr>
										<td colspan="14" align="center">
											<textarea name="txt_remarks[]" id="txt_remarks" style="width:99%; height:35px;" placeholder="Enter your remarks here" class="textboxdisplay"></textarea>
											<input type="hidden" name="txt_subdivid[]" id="txt_subdivid" class="textboxdisplay" value="">
											<input type="hidden" name="txt_sch_id[]" id="txt_sch_id" class="textboxdisplay" value="">
										</td>
									</tr>
								</table>
								<p style='page-break-after:always;'></p>
								<table width="1087px"  bgcolor="#E8E8E8" class="table1" align="center">
									<tr class="label">
										<td align="center" valign="middle" nowrap="nowrap" rowspan="2">Item No.</td>
										<td align="left" valign="middle" rowspan="2">Description</td>
										<td align="center" valign="middle" colspan="4">As Per Agreement</td>
										<td align="center" valign="middle" colspan="2" nowrap="nowrap">As Per Execution</td>
										<td align="center" valign="middle" colspan="2">Excess</td>
										<td align="center" valign="middle" rowspan="2" nowrap="nowrap">% of Excess</td>
										<td align="center" valign="middle" colspan="2">Savings</td>
										<td align="center" valign="middle" rowspan="2" nowrap="nowrap">% of Savings</td>
									</tr>
									<tr class="label">
										<td align="left" valign="middle">Qty</td>
										<td align="left" valign="middle">Unit</td>
										<td align="left" valign="middle">Rate</td>
										<td align="left" valign="middle">Amount</td>
										<td align="left" valign="middle">Qty</td>
										<td align="left" valign="middle">Amount</td>
										<td align="left" valign="middle">Qty</td>
										<td align="left" valign="middle">Amount</td>
										<td align="left" valign="middle">Qty</td>
										<td align="left" valign="middle">Amount</td>
									</tr>
							</table>
								<p style='page-break-after:always;'></p>
								<table width="1087px"  bgcolor="#E8E8E8" class="table1" align="center">
									<tr class="label">
										<td align="center" valign="middle" nowrap="nowrap" rowspan="2">Item No.</td>
										<td align="left" valign="middle" rowspan="2">Description</td>
										<td align="center" valign="middle" colspan="4">As Per Agreement</td>
										<td align="center" valign="middle" colspan="2" nowrap="nowrap">As Per Execution</td>
										<td align="center" valign="middle" colspan="2">Excess</td>
										<td align="center" valign="middle" rowspan="2" nowrap="nowrap">% of Excess</td>
										<td align="center" valign="middle" colspan="2">Savings</td>
										<td align="center" valign="middle" rowspan="2" nowrap="nowrap">% of Savings</td>
									</tr>
									<tr class="label">
										<td align="left" valign="middle">Qty</td>
										<td align="left" valign="middle">Unit</td>
										<td align="left" valign="middle">Rate</td>
										<td align="left" valign="middle">Amount</td>
										<td align="left" valign="middle">Qty</td>
										<td align="left" valign="middle">Amount</td>
										<td align="left" valign="middle">Qty</td>
										<td align="left" valign="middle">Amount</td>
										<td align="left" valign="middle">Qty</td>
										<td align="left" valign="middle">Amount</td>
									</tr>
									<tr class="label">
										<td align="left" colspan="4">Total Amount</td>
										<td align="right"></td>
										<td align="right"></td>
										<td align="center"></td>
										<td align="right"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
									</tr>
									<tr class="label">
										<td align="left" colspan="4">Rebate (  % )</td>
										<td align="right"></td>
										<td align="right"></td>
										<td align="center"></td>
										<td align="right"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
									</tr>
									<tr class="label">
										<td align="left" colspan="4">Total Amount</td>
										<td align="right"></td>
										<td align="right"></td>
										<td align="center"></td>
										<td align="right"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
									</tr>
									
									<tr class="label">
										<td align="left" colspan="4">Variation in Amount as per Agreement</td>
										<td align="right"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="right"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
									</tr>
									<!--<tr class="label">
										<td align="left" colspan="4">Variation in Amount as per TS</td>
										<td align="right"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="right"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
									</tr>-->
									<!--<tr class="label">
										<td align="left" colspan="4">Technical Sanction Amount</td>
										<td align="right"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="right"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
									</tr>-->
									<tr class="label">
										<td align="left" colspan="4">% ge of overall Excess as per Agreement</td>
										<td align="right"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="right"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
									</tr>
									<!--<tr class="label">
										<td align="left" colspan="4">% ge of overall Excess as per Technical Sanction</td>
										<td align="right"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="right"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
									</tr>-->
									<tr><td align="center" colspan="14"> No Records Found !</td></tr>
								</table>
								<p style='page-break-after:always;'></p>
							</div>
							<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
								<div class="buttonsection">
									<input type="button" name="back" value="Back" id="back" class="backbutton" onClick="goBack();" />
								</div>
								<div class="buttonsection" id="view_btn_section">
									<input type="submit" name="btn_save" value="Save & Next" id="btn_save" class="backbutton" />
								</div>
							</div>
       					</form>
      				</blockquote>
    			</div>
   			</div>
		</div>
<!--==============================footer=================================-->
@include('layouts.footer')
</body>
</html>

