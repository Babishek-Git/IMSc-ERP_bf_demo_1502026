@include('layouts.library.config')
@include('layouts.library.functions') 
@include('layouts.library.binddata')
@include('layouts.library.common')
@include('layouts.header')
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
  <!--==============================header=================================-->
  <?php include "Menu.php"; ?>
  <link rel="stylesheet" href="css/timeline.css">
  <!--==============================Content=================================-->
	<div class="content">
    	<div class="title printbutton">Pass Order Statements</div>
        <div class="container_12">
        	<div class="grid_12">
            	 <blockquote class="bq1" style="overflow:auto">
                	<form name="form" method="post" action="AccountsGenerateSection5.php">
                    	<div class="container">
							
							<div class="container-fluid">
								<div data-wizard-init>
								  <ul class="steps">
									<li data-step="1">Memo Payment</li>
									<li data-step="2" >Abstract - B</li>
									<li data-step="3" >Recovery</li>
									<li data-step="4"class="active">Accounts Works</li>
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
									<div data-step="4" align="center">
										<table width="90%" class="tableA" align="center">
											<tr class="label">
												<td colspan="2" align="center">Government Of India<br>Deportment Of Atomic Energy<br>Indira Gandhi Centre For Atomic Research</td>
											</tr>
											<tr class="label" align="center">
												<td colspan="2">
													<span style="float:center"><b>ACCOUNTS (Works)</b></span>
												</td>
											</tr>
											<tr class="label">
												<td colspan="2">
													<span style="float:right">Date..............</span>
												</td>
											</tr>
											<tr class="label">
												<td align="left" width="250px">Name Of Payee</td>
												<td align="left">:&nbsp;&nbsp;</td>
											</tr>
											<tr class="label">
												<td align="left">Account Number </td>
												<td align="left">:&nbsp;&nbsp;</td>
											</tr>
											
											<tr class="label">
												<td align="left">Bank/Branch/Code </td>
												<td align="left">:&nbsp;&nbsp;/ </td>
											</tr>
											
											<tr class="label">
												<td align="left">Mode Of Payment </td>
												<td align="left">:&nbsp;&nbsp;</td>
											</tr>
											<tr class="label">
												<td align="left">IFSC Code </td>
												<td align="left">:&nbsp;&nbsp;</td>
											</tr>
											
											<tr class="label">
												<td align="left">Amount </td>
												<td align="left">:&nbsp;&nbsp;</td>
											</tr>
											
											<tr class="label">
												<td align="left">Payment Passed On </td>
												<td align="left">:&nbsp;&nbsp;</td>
											</tr>
											<tr class="label">
												<td colspan="2">
													<span style="float:right"><br><br>&nbsp;&nbsp;<br>Asst.Accts.Officer<br><br></span>
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

