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
    	<div class="title printbutton">General Accounts Statement Generation</div>
        <div class="container_12">
        	<div class="grid_12">
            	 <blockquote class="bq1" style="overflow:auto" id="printSection">
                	<form name="form" method="post" action="AccountsGenerateSection6.php">
                    	<div class="container">
							
							<div class="container-fluid">
								<div data-wizard-init>
								  <ul class="steps">
									<li data-step="1">Memo Payment</li>
									<li data-step="2" >Abstract - B</li>
									<li data-step="3" >Recovery</li>
									<li data-step="4">Accounts Works</li>
									<li data-step="5">Bill Miscellaneous</li>
									<li data-step="6"class="active">Certificate Of Deduction</li>
								  </ul>
								  <div class="steps-content" align="center">
									<div data-step="6" align="center">
										<table width="90%" class="tableA" align="center">
											<tr>
												<td colspan="2">
													<span style="float:left"> CCODE :</span>
													<span style="float:right">TDS CERTIFICATE<br> No.1GC/A  -  00014</span>
												</td>
											</tr>
											<tr class="label">
												<td colspan="2" align="center">FORM NO. 16 A  [See Rule 31(1)(b)]</td>
											</tr>
											<tr class="label">
												<td colspan="2" align="center">CERTIFICATE OF DEDUCTION OF TAX AT SOURCE UNDER SECTION 203 OF THE INCOME TAX ACT 1961</td>
											</tr>
											<tr class="label">
												<td colspan="2" align="justify">
												[For interest on securities dividends: interest other than interest on securities; winnings from lottery or cross word 
												puzzle; winnings from horse race; payments to contractors and sub-contractors; insurance commission; payments to non-resident 
												sportsmen/sports association; payments in respect of deposits under national savings scheme; payments on account of repurchase 
												of units by natura fund or unit trust of india; commission. recoveration or price  on sale of lottery tickets; other 
												suos under section 195; income of foreign companies referred; to in section 196A(2); income from units referred to in section 
												1968; income from foreign currency bonds or shares of an india company referred to in section 196C; income of foreign institutional investors from securities to in section 1960;
												</td>
											</tr>
											<tr class="label">
												<td align="left">Authority : </td>
												<td align="left"></td>
											</tr>
											<tr class="label">
												<td align="left">Name and address of the person Deducting tax  : </td>
												<td align="left">Pay and Accounts Officer Indira Gandhi Center for Atomic Research Kalpakkam - 603 102, Kancheepuram District. </td>
											</tr>
											<tr class="label">
												<td align="left">TDS Circle where Annual Return under section 206 is to be delivered</td>
												<td align="left"> </td>
											</tr>
											<tr class="label">
												<td align="left">Name and address of the person to whom payment made or in whose account it is credited</td>
												<td align="left"></td>
											</tr>
											<tr class="label">
												<td align="left">Tax Deduction A/c. of the Deductor Nature of payment Pan/Gir No.of the payee Tax/Gir No. of the Deductor For the Period</td>
												<td align="left"></td>
											</tr>
											<tr class="label">
												<td colspan="8" align="center">DETAILS OF PAYMENT . TAX DEDUCTION AND DEPOSIT OF TAX CENTRAL GOVT. A/C.</td>
											</tr>
											<tr class="label">
												<td align="left">Date of payment/credit :</td>
												<td align="left"> </td>
											</tr>
											<tr class="label">
												<td align="left">Amount paid/credited  :</td>
												<td align="left"> </td>
											</tr>
											<tr class="label">
												<td align="left">Amount of Income-Tax deducted:</td>
												<td align="left"> </td>
											</tr>
											<tr class="label">
												<td align="left">Rate at which deducted:</td>
												<td align="left"> </td>
											</tr>
											<tr class="label">
												<td align="left">Date  & Challan No. of deposit of tax into Central Govt. A.C Name of Bank and Branch where tax deposited</td>
												<td align="left"> </td>
											</tr>
											<tr class="label">
												<td align="left">&nbsp;&nbsp;&nbsp; in words : - .F. &nbsp;&nbsp;&nbsp; has been deducted at source and paid to the credit of the Central &nbsp;&nbsp;&nbsp; Government as per details given above.</td>
												<td align="left"> </td>
											</tr>
											<tr>
												<td colspan="8">
													</br></br>
													<span style="float:left"> Place: Date: </span>
													<span style="float:right">Signature of person responsible for   deduction of tax </span>
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

