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
                	<form name="form" method="post" action="AccountsGenerateSection4.php">
                    	<div class="container">
							
							<div class="container-fluid">
								<div data-wizard-init>
								  <ul class="steps">
									<li data-step="1">Memo Payment</li>
									<li data-step="2" >Abstract - B</li>
									<li data-step="3" class="active">Recovery</li>
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
									<div data-step="3" align="center">
										<table width="90%" class="tableA" align="center">
											<tr>
												<td colspan="4" align="center"> <b>Recovery Particulars - </b></td>
											</tr>
											<tr class="label">
												<td colspan="4">
													<span style="float:left">CCODE :</span>
													<span style="float:right">S.No.&nbsp;&nbsp;&nbsp;</span>
												</td>
											</tr>
											<tr class="label">
												<td align="left" colspan="1">1. Name of Contractor </td>
												<td align="left" colspan="3"></td>
											</tr>
											
											
											
											<tr class="label">
												<td align="left" colspan="1">2. Name of Work </td>
												<td align="left" colspan="3"></td>
											</tr>
											<tr class="label">
												<td align="left" colspan="1">3. Contract Value </td>
												<td align="left" colspan="3">Rs. </td>
											</tr>
											<tr class="label">
												<td align="left" colspan="1">4. Bill Value </td>
												<td align="left" colspan="3">Rs. </td>
											</tr>
											
											<tr class="label">
												<td align="left" colspan="2">5. [A] Creadited to works</td>
												<td align="left" colspan="2">5. [B] Creadited to other works</td>
											</tr>
											<tr class="label">
												<td align="left">[1] Labour welfare cess </td>
												<td align="right" width="200px"><span style="float:left">Rs.</span></td>
												<td align="left">[1] Income tax</td>
												<td align="right" width="200px"><span style="float:left">Rs.</span></td>
											</tr>
											<tr class="label">
												<td align="left">[2] Secured Advance</td>
												<td align="right"><span style="float:left">Rs.</span></td>
												<td align="left">[2] Int . on mobi. Adv:</td>
												<td align="right">&nbsp;</td>
											</tr>
											<tr class="label">
												<td align="left">[3] Ele. Charge</td>
												<td align="right"><span style="float:left">Rs.</span></td>
												<td align="left">[3] Security Deposit</td>
												<td align="right"><span style="float:left">Rs.</span></td>
											</tr>
											<tr class="label">
												<td align="left">[4] Mob.Advance </td>
												<td align="right"><span style="float:left">Rs.</span></td>
												<td align="left"></td>
												<td align="left"></td>
											</tr>
											<tr class="label">
												<td align="left" colspan="2">5. [C]- By cheque :<br><br></td>
												<td align="left" colspan="2"></td>
											</tr>
											<tr class="label">
												<td colspan="4">
													<span style="float:left">kalpakkam - 603102 <br/> Date : </span>
													<span style="float:right">Asst.Accts. Officer<br> IG.C.A.R.</span>
												</td>
											</tr>
											<tr class="label">
												<td align="left" colspan="4">CCODE : </td>
											</tr>
											<tr class="label">
												<td align="center" colspan="4">Accounts III  Coding Sheet</td>
											</tr>
											<tr class="label">
												<td align="center" colspan="4">Month ....................:  2018 vr. No. & Date :   ___________</td>
											</tr>
											<tr class="label">
												<td align="left" colspan="4">1. Name of Contractor :&nbsp;</td>
											</tr>
										</table>
										
										<table width="90%" class="tableA" align="center">
											<tr class="label">
												<td align ="center">Particulars</td>
												<td align ="center">Proj.No</td>
												<td align ="center">Budget-wise item</td>
												<td align ="right">Amount (Rs.)</td>
											</tr>
											<tr class="label">
												<td align ="left">Debitable to</td>
												<td align ="center"></td>
												<td align ="center"></td>
												<td align ="right"></td>
											</tr>
											<tr class="label">
												<td align ="left">Income tax</td>
												<td align ="center"></td>
												<td align ="center"></td>
												<td align ="right"></td>
											</tr>
											<tr class="label">
												<td align ="left">Surcharge on IT</td>
												<td align ="center"></td>
												<td align ="center"></td>
												<td align ="right"></td>
											</tr>
											<tr class="label">
												<td align ="left">Pr. CESS on IT & SC</td>
												<td align ="center"></td>
												<td align ="center"></td>
												<td align ="right"></td>
											</tr>
											<tr class="label">
												<td align ="left">Hr. CESS on IT & SC</td>
												<td align ="center"></td>
												<td align ="center"></td>
												<td align ="right"></td>
											</tr>
											<tr class="label">
												<td align ="left">Int. ON Mob. Adv</td>
												<td align ="center"></td>
												<td align ="center"></td>
												<td align ="right"></td>
											</tr>
											<tr class="label">
												<td align ="left">Elects. Charge</td>
												<td align ="center"></td>
												<td align ="center"></td>
												<td align ="right"></td>
											</tr>
											<tr class="label">
												<td align ="left">Security Deposit</td>
												<td align ="center"></td>
												<td align ="center"></td>
												<td align ="right"></td>
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

