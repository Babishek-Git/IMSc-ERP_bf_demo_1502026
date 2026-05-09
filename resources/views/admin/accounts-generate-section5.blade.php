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
                	<form name="form" method="post" action="AccountsStatementSteps.php">
                    	<div class="container">
							
							<div class="container-fluid">
								<div data-wizard-init>
								  	<ul class="steps">
										<li data-step="1">Memo Payment</li>
										<li data-step="2" >Abstract - B</li>
										<li data-step="3" >Recovery</li>
										<li data-step="4">Accounts Works</li>
										<li data-step="5"class="active">Bill Miscellaneous</li>
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
									<div data-step="5" align="center">
										<table width="90%" class="tableA" align="center">
											<tr class="label">
												<td colspan="2" align="center">Government Of India<br>Deportment Of Atomic Energy<br>Indira Gandhi Centre For Atomic Research, Kalpakkam</td>
											</tr>
											<tr class="label">
												<td colspan="2">
													<span style="float:left">Bill Code : </span>
													<span style="float:right">Date :..............&nbsp;&nbsp;</span>
												</td>
											</tr>
											<tr>
												<td class="label" colspan="2" align="center">BILL FOR MISCELLANEOUS PAYMENTS</td>
											</tr>
											<tr class="label">
												<td align="left" width="250px">Head Of Accounts: </td>
												<td align="left"></td>
											</tr>
											<tr class="label">
												<td align="left">Name Of Payee: </td>
												<td align="left"></td>
											</tr>
											<tr class="label">
												<td align="left">Address Of Payee : </td>
												<td align="left"></td>
											</tr>
											<tr class="label">
												<td align="left">Nature Of Claim: </td>
												<td align="left"></td>
											</tr>
											<tr class="label">
												<td align="left">Authority: </td>
												<td align="left"></td>
											</tr>
											<tr class="label">
												<td align="left">Bill No. & Date: </td>
												<td align="left">RAB :  & </td>
											</tr>
											<tr class="label">
												<td align="left">Bill Amount: </td>
												<td align="left">Rs. </td>
											</tr>
											<tr class="label">
												<td align="left">Amount Payable (Rs) :</td>
												<td align="left">Rs. </td>
											</tr>
											<tr class="label">
												<td align="left">INDUSTRIAL SAFE</td>
												<td align="left">Rs</td>
											</tr>
											<tr class="label">
												<td align="left">INCOME TAX - CO</td>
												<td align="left">Rs. </td>
											</tr>
											<tr class="label">
												<td align="left">SD - ACCOUNTS</td>
												<td align="left">Rs. </td>
											</tr>
											<tr class="label">
												<td align="left">Mode Of Payment :</td>
												<td align="left">CHEQUE</td>
											</tr>
											<tr class="label">
												<td align="left" colspan="2"> Pay Rs in Words :<br><br><br></td>
											</tr>
											<tr class="label">
												<td colspan="2">
													<span style="float:right">AAO/SAO/DCA</span>
												</td>
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

