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
                        <form name="form" method="post" action="SecuredAdvancePrintView.php">
                            <div class="container" align="center">
								<br/>
								<!--<table width="1173px"  bgcolor="#E8E8E8" class="table1" align="center">
									
								</table>-->
								<table width="1087px"  bgcolor="#E8E8E8" class="table1" align="center">
								<thead>
									<tr>
										<td class="label" colspan="2">Name of Work</td>
										<td colspan="13"></td>
									</tr>
									<tr>
										<td class="label" colspan="2">Work Oredr No.</td>
										<td colspan="13"></td>
									</tr>
									<tr>
										<td class="label" colspan="2">RAB No.</td>
										<td colspan="13"></td>
									</tr>
									<tr>
										<td class="label" colspan="15" align="center"> Variation Statement for RAB - </td>
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
										<td align="center" valign="middle" rowspan="2">Remarks</td>
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
								</thead>
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
										<td align="left">
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
										<td align="center" valign="middle" rowspan="2">Remarks</td>
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
										<td align="center" valign="middle" rowspan="2">Remarks</td>
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
										<td align="left" colspan="4">[ % ] of overall  as per Agreement</td>
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
									<tr><td align="center" colspan="15"> No Records Found !</td></tr>
								</table>
								<p style='page-break-after:always;'></p>
								<table width="1087px"  bgcolor="#E8E8E8" class="table1" align="center">
									<thead>
										<tr>
											<td class="label" nowrap="nowrap">Name of Work</td>
											<td colspan="2"></td>
										</tr>
										<tr>
											<td class="label" nowrap="nowrap">Work Oredr No.</td>
											<td colspan="2"></td>
										</tr>
										<tr>
											<td class="label" nowrap="nowrap">RAB No.</td>
											<td colspan="2"></td>
										</tr>
										<tr>
											<td class="label" colspan="3" align="center"> Variation Statement Remarks Annexure for RAB - </td>
										</tr>
										<tr class="label">
											<td align="center" valign="middle" nowrap="nowrap" rowspan="2">Item No.</td>
											<td align="left" valign="middle">Description</td>
											<td align="center" valign="middle">Remarks</td>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td align="center" valign="middle"></td>
											<td width="40%" valign="middle"></td>
											<td valign="middle"></td>
										</tr>
									</tbody>
								</table>
								<!--<p style='page-break-after:always;'></p>-->
							</div>
       					</form>
					<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
						<div class="buttonsection">
							<input type="button" name="back" value="Back" id="back" class="backbutton" onClick="goBack();" />
						</div>
						<div class="buttonsection" id="view_btn_section">
							<input type="button" name="btn_print" value="Print" id="btn_print" class="backbutton" onClick="PrintBook();" />
						</div>
					</div>
      				</blockquote>
    			</div>
   			</div>
		</div>
<!--==============================footer=================================-->
@include('layouts.footer')
</body>
</html>

