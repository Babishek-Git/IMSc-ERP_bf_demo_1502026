@include('layouts.library.config')
@include('layouts.library.functions') 
@include('layouts.library.binddata')
@include('layouts.library.common')
@include('layouts.header')
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
  <!--==============================header=================================-->
  @include('admin.menu')
  <link rel="stylesheet" href="css/timeline.css">
  <!--==============================Content=================================-->
	<div class="content">
    	<div class="title printbutton">Pass Order Statements</div>
        <div class="container_12">
        	<div class="grid_12">
            	 <blockquote class="bq1" style="overflow:auto">
                	<form name="form" method="post" action="AccountsGenerateSection3.php">
                    	<div class="container">
							
							<div class="container-fluid">
								<div data-wizard-init>
								  <ul class="steps">
									<li data-step="1">Memo Payment</li>
									<li data-step="2" class="active">Abstract - B</li>
									<li data-step="3">Recovery</li>
									<li data-step="4">Accounts Works</li>
									<li data-step="5">Bill Miscellaneous</li>
									<!--<li data-step="6">Certificate Of Deduction</li>-->
								  </ul>
								 <div class="steps-content" align="center" id="printSection">
								 	<style>
										@media print {
											.printbutton{
												display:none;
											}
										} 
									</style>
									<div data-step="2" align="center">
									<table width="90%" class="tableA" align="center">	
										<tr>
											<td colspan="2" align="center">I.G.C.A.R.-Accounts(works)</td>
										</tr>
										<tr>
											<td colspan="2" align="center"><b>Abstract-B</b></td>
										</tr>
										<tr class="label">
											<td align="left" width="240px">Name of Contractor</td>
											<td align="left"></td>
										</tr>
										<tr class="label">
											<td align="left">Name of Work</td>
											<td align="left"></td>
										</tr>
										<tr class="label">
											<td align="left">Technical Sanction No.</td>
											<td align="left"></td>
										</tr>
										<tr class="label">
											<td align="left">Head Of Account</td>
											<td align="left"></td>
										</tr>
										<tr class="label">
											<td align="left">Month</td>
											<td align="left"></td>
										</tr>
										<tr class="label">
											<td align="left">Budget Control Reg. Page No. </td>
											<td align="left"></td>
										</tr>
										<!--<tr class="label">
											<td align="left">&nbsp; </td>
											<td align="left"></td>
										</tr>-->
										<tr class="label">
											<td align="center" colspan="2"><u><b>Final Charges</b></u></td>
										</tr>
										<tr class="label">
											<td align="left" style="border-right:none;">Income Tax <span style="float:right">Rs.</span></td>
											<td align="left" style="border-left:none;"> <div style="width:175px; text-align:right"></div></td>
										</tr>
									
										<tr class="label">
											<td align="left" style="border-right:none;">Surcharge on IT <span style="float:right">Rs.</span></td>
											<td align="left" style="border-left:none;"> <div style="width:175px; text-align:right"></div></td>
										</tr>
									
										<tr class="label">
											<td align="left" style="border-right:none;">Cess on IT & SC <span style="float:right">Rs.</span></td>
											<td align="left" style="border-left:none;"> <div style="width:175px; text-align:right"></div></td>
										</tr>
										
										<tr class="label">
											<td align="left" style="border-right:none;">HCESS on IT & SC  <span style="float:right">Rs.</span></td>
											<td align="left" style="border-left:none;"> <div style="width:175px; text-align:right"></div></td>
										</tr>
										<tr class="label">
											<td align="left" style="border-right:none;">Labour Welfare Cess:  <span style="float:right">Rs.</span></td>
											<td align="left" style="border-left:none;"> <div style="width:175px; text-align:right"></div></td>
										</tr>
										<tr class="label">
											<td align="left" style="border-right:none;">Int on Mobi Adv:  <span style="float:right">Rs.</span></td>
											<td align="left" style="border-left:none;"> <div style="width:175px; text-align:right"></div></td>
										</tr>
										<tr class="label">
											<td align="left" style="border-right:none;">Security Deposit:  <span style="float:right">Rs.</span></td>
											<td align="left" style="border-left:none;"> <div style="width:175px; text-align:right"></div></td>
										</tr>
										<tr class="label">
											<td align="left" style="border-right:none;">By Cheque <span style="float:right">Rs.</span></td>
											<td align="left" style="border-left:none;"> <div style="width:175px; text-align:right"></div></td>
										</tr>
										<tr class="label">
											<td align="center" colspan="2"><u><b>Suspense Account : </b></u></td>
										</tr>
										
										<tr class="label">
											<td align="left" style="border-right:none;"><!---NIL-<br>-->Secured Advance <span style="float:right">Rs.</span></td>
											<td align="left" style="border-left:none;"> <div style="width:175px; text-align:right"></div></td>
										</tr>
										<tr class="label">
											<td align="center" colspan="2"><u><b>Others Transactions :</b></u> </td>
										</tr>
										
										<tr class="label">
											<td align="left" style="border-right:none;">Electrical Charge (-) <span style="float:right">Rs.</span></td>
											<td align="left" style="border-left:none;"> <div style="width:175px; text-align:right"></div></td>
										</tr>
										<tr class="label">
											<td align="left" style="border-right:none;">Mobilization Advance (-) <span style="float:right">Rs.</span></td>
											<td align="left" style="border-left:none;"> <div style="width:175px; text-align:right"></div></td>
										</tr>
										<tr class="label">
											<td align="left" style="border-right:none;">Total <span style="float:right">Rs.</span></td>
											<td align="left" style="border-left:none;"> <div style="width:175px; text-align:right"></div></td>
										</tr>
									</table>
									<input type="hidden" name="txt_sheetid" id="txt_sheetid" value=""> 
									<input type="hidden" name="txt_rbn" id="txt_rbn" value=""> 
								</div>
							</div>
						</div>
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

