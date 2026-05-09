@include('layouts.library.config')
@include('layouts.library.functions') 
@include('layouts.library.common')
@include('layouts.library.binddata') 
@include('layouts.header')
    <body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
        <form action="" method="post" enctype="multipart/form-data" name="form">
           @include('admin.menu')
            <div class="content">
                <div class="container_12">
                    <div class="grid_12">
                        <blockquote class="bq1" style="overflow-y:scroll;">
                            <div class="title printbutton">Electricity Recovery Bill</div>
                        	<table width="1060px" border="0" align="center" cellpadding="0" cellspacing="0" class="color4">
								<tr><td colspan="4" align="center" class="labelheadprint">Government of India</td></tr>
								<tr><td colspan="4" align="center" class="labelheadprint">Department of Atomic Energy</td></tr>
								<tr><td colspan="4" align="center" class="labelheadprint">Indira Gandhi Centre for Atomic Research</td></tr>
								<tr><td colspan="4" align="center" class="labelheadprint">Fast Reactor Fuel Cycle Facility (FRFCF)</td></tr>
								<tr><td colspan="4" align="center" class="labelheadprint">&nbsp;</td></tr>
								<tr>
									<td width="10%">&nbsp;</td>
									<td width="25%" align="left" class="labelheadprint">Electricity Bill No  </td>
									<td align="left" class="labelheadprint">:&nbsp;&nbsp;&nbsp;&nbsp;</td>
									<td align="center" class="labelheadprint">Date : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								</tr>
								
								<tr><td colspan="4" align="center" class="labelheadprint">&nbsp;</td></tr>
								
								<tr>
									<td>&nbsp;</td>
									<td align="left" class="labelheadprint">Name of work </td>
									<td colspan="2" align="left" class="labelheadprint">
										:&nbsp;&nbsp;&nbsp;&nbsp;<b></b> 
									</td>
								</tr>
								
								<tr><td colspan="4" align="center" class="labelheadprint">&nbsp;</td></tr>
								
								<tr>
									<td>&nbsp;</td>
									<td align="left" class="labelheadprint">Technical sanction No. </td>
									<td colspan="2" align="left" class="labelheadprint">
										:&nbsp;&nbsp;&nbsp;&nbsp; 
									</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td align="left" class="labelheadprint">Agreement No. </td>
									<td colspan="2" align="left" class="labelheadprint">
										:&nbsp;&nbsp;&nbsp;&nbsp; 
									</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td align="left" class="labelheadprint">Meter No. </td>
									<td colspan="2" align="left" class="labelheadprint">
										:&nbsp;&nbsp;&nbsp;&nbsp;
									</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td align="left" class="labelheadprint">Initial meter reading </td>
									<td colspan="2" align="left" class="labelheadprint">
										:&nbsp;&nbsp;&nbsp;&nbsp;
									</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td align="left" class="labelheadprint">Final meter reading </td>
									<td colspan="2" align="left" class="labelheadprint">
										:&nbsp;&nbsp;&nbsp;&nbsp;
									</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td align="left" class="labelheadprint">Consumption of Electricity </td>
									<td colspan="2" align="left" class="labelheadprint">
										:&nbsp;&nbsp;&nbsp;&nbsp;
									</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td align="left" class="labelheadprint">Rate of Electricity </td>
									<td colspan="2" align="left" class="labelheadprint">
										:&nbsp;&nbsp;&nbsp;&nbsp;<i class='fa fa-inr' style='font-weight:normal; padding-top:4px; width:4px; height:5px;'></i>&nbsp;&nbsp;&nbsp;
									</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td align="left" class="labelheadprint">Meter Rent </td>
									<td colspan="2" align="left" class="labelheadprint">
										:&nbsp;&nbsp;&nbsp;&nbsp;<i class='fa fa-inr' style='font-weight:normal; padding-top:4px; width:4px; height:5px;'></i>&nbsp;&nbsp;&nbsp;
									</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td align="left" class="labelheadprint">Electricity charges </td>
									<td colspan="2" align="left" class="labelheadprint">
										:&nbsp;&nbsp;&nbsp;&nbsp;<i class='fa fa-inr' style='font-weight:normal; padding-top:4px; width:4px; height:5px;'></i>&nbsp;&nbsp;&nbsp;
									</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td align="left" class="labelheadprint">Proposed to be recorded in  </td>
									<td colspan="2" align="left" class="labelheadprint">
										:&nbsp;&nbsp;&nbsp;&nbsp;<b></b>
									</td>
								</tr>
								<tr><td colspan="4" align="center" class="labelheadprint">&nbsp;</td></tr>
								<tr><td colspan="4" align="center" class="labelheadprint">&nbsp;</td></tr>
								<tr>
									<td width="10%">&nbsp;</td>
									<td width="25%" align="left" class="labelheadprint"> </td>
									<td align="left" class="labelheadprint"></td>
									<td align="center" class="labelheadprint">&nbsp;&nbsp;&nbsp;&nbsp;<b></b>&nbsp;&nbsp;</td>
								</tr>
								<tr><td colspan="4" align="center" class="labelheadprint">&nbsp;</td></tr>
								<tr><td colspan="4" align="center" class="labelheadprint">&nbsp;</td></tr>
								<tr>
									<td width="10%">&nbsp;</td>
									<td width="25%" align="left" class="labelheadprint"></td>
									<td align="left" class="labelheadprint"></td>
									<td align="center" class="labelheadprint">&nbsp;&nbsp;&nbsp;&nbsp;<b></b>&nbsp;&nbsp;</td>
								</tr>
								<tr>
									<td width="10%">&nbsp;</td>
									<td width="25%" align="left" class="labelheadprint"></td>
									<td align="left" class="labelheadprint"></td>
									<td align="center" class="labelheadprint">&nbsp;&nbsp;&nbsp;&nbsp;<b></b>&nbsp;&nbsp;</td>
								</tr>
								<tr><td colspan="4" align="center" class="labelheadprint">&nbsp;</td></tr>
								<tr>
									<td width="10%">&nbsp;</td>
									<td width="25%" align="left" class="labelheadprint"><b>To</b></td>
									<td align="left" class="labelheadprint"></td>
									<td align="center" class="labelheadprint"></td>
								</tr>
								<tr>
									<td width="10%">&nbsp;</td>
									<td width="25%" align="left" class="labelheadprint"><b>AAO (Works)</b></td>
									<td align="left" class="labelheadprint"></td>
									<td align="center" class="labelheadprint"></td>
								</tr>
								<tr>
									<td width="10%">&nbsp;</td>
									<td width="25%" align="left" class="labelheadprint"><b>IGCAR</b></td>
									<td align="left" class="labelheadprint"></td>
									<td align="center" class="labelheadprint"></td>
								</tr>
								<tr><td colspan="4" align="center" class="labelheadprint">&nbsp;</td></tr>
								<tr><td colspan="4" align="center" class="labelheadprint">&nbsp;</td></tr>
							</table>
							<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
								<div class="buttonsection">
									<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
								</div>
								<div class="buttonsection">
									<input type="button" class="backbutton" name="print" id="print" value="Print" onClick="javascript:window.open('Print_ElectricityBill.php','','TOOLBAR=NO,RESIZABLE=NO,SCROLLBARS=YES,HEIGHT=350,WIDTH=685,LEFT=100,TOP=40')"/>
								</div>
							</div>
                        </blockquote>
                    </div>
                </div>
            </div>
          @include('layouts.footer')
        </form>
    </body>
</html>
