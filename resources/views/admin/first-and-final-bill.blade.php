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
        <div class="title printbutton">First And Final Bill Form</div>
            <div class="container_12">
                <div class="grid_12">
                    <blockquote class="bq1" style="overflow:auto" id="printSection">
                        <form name="form" method="post" action="FirstandFinalBillGenerate.php">
                            <div class="container" align="center">
								<br/>
								<table width="100%" class="table1" align="center">
									<tr class="label">
										<td colspan="16" align="center">First And Final Bill</td>
									</tr>
									<tr class="label">
										<td colspan="16" align="center">(Central P.W.A Code Paragraphs 10_2_10 & 10_2_11)</td>
									</tr>
									<tr class="label">
										<td colspan="16">
											<span style="float:left">Division .......... <?php echo $ccno; ?></span>
											<span style="float:right">Sub Division.............</span>
										</td>
									</tr>
									<tr class="label">
										<td colspan="16" align="center">
										(For Contractors & Suppliers To be used when a single payment is made for a job or contract i.e.
										only on its completion. A single form may be used for making payment to several contractors or suppliers 
										if they relate to the same work or to the same head of account in the case of suppliers and are billed for the same time.)										
										</td>
									</tr>
									<tr class="label">
										<td colspan="8" align="left">Name Of work (in the case of bills for work done) : <b><?php echo $work_name; ?></b></td>
										<td colspan="8" align="left"> Cash Book Voucher No : .............&nbsp; Date ............ </td>
									</tr>
									<tr class="label">
										<td colspan="16" align="center">&nbsp;</td>
									</tr>
									</table>	
								    <table width="100%" class="table1" align="center">
									  <tr class="label">
										<td align="center" valign="middle" rowspan="2">Name Of Contractor Or Suppliers & Reference To Agreement</td>
										<td align="center" valign="middle" rowspan="2">Items Or Work Or Supplies (Grouped Under Sub Heads And Sub Works Of Estimate)*</td>
										<td align="center" valign="middle" colspan="3" rowspan="2">Reference : To Recorded Measurements And Date</td>
										<td align="center" valign="middle" colspan="2">Date</td>
										<td align="center" valign="middle" rowspan="2">Quantity</td>
										<td align="center" valign="middle" rowspan="2">Rate</td>
										<td align="center" colspan="3" >Total Amount Payable To Contractor/Supplier</td>
										<td align="center" valign="middle" rowspan="2">Payee's Dated Signature In Token Of (1)Acceptance Of Bill And (2) Acknowledgement Of Payment</td>
										<td align="center" valign="middle" rowspan="2">Date Signature Of Witness</td>
										<td align="center" colspan="2">Dated Certificates Of Disbursement</td>
									 </tr>
									 <tr class="label">
										<td align="center" valign="middle">Written order to commence work</td>
										<td align="center" valign="middle">Actual Completion Of Work</td>
										<td align="center" valign="middle">In Figures</td>
										<td align="center" colspan="2" valign="middle">In Words</td>
										<td align="center" valign="middle">Mode Pf Payment Cash Of Cheque (No.and date)</td>
										<td align="center" valign="middle">Paid by me</td>
									</tr>
									<tr class="label">
									    <td align="left">&nbsp;</td>
										<td align="left">&nbsp;</td>
										<td align="center" valign="middle">Book No</td>
										<td align="center" valign="middle">Page No</td>
										<td align="center" valign="middle">Date</td>
										<td align="left">&nbsp;</td>
										<td align="left">&nbsp;</td>
										<td align="left">&nbsp;</td>
										<td align="left">&nbsp;</td>
										<td align="left">&nbsp;</td>
										<td align="left"colspan="2">&nbsp;</td>
										<td align="left">&nbsp;</td>
										<td align="left">&nbsp;</td>
										<td align="left"colspan="2">&nbsp;</td>
									</tr>
 									<tr class="label">
									    <td align="left" rowspan="" style="vertical-align:top"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="left">&nbsp;</td>
										<td align="left" rowspan="" style="vertical-align:top;"></td>
										<td align="left" rowspan="" style="vertical-align:top;"></td>
										<td align="right"></td>
										<td align="right"></td>
										<td align="right"></td>
										<td align="justify"colspan="2"></td>
										<td align="left">&nbsp;</td>
										<td align="left">&nbsp;</td>
										<td align="left"colspan="2">&nbsp;</td>
									</tr>
									<tr class="label">
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="left">&nbsp;</td>
										<td align="right"></td>
										<td align="right"></td>
										<td align="right"></td>
										<td align="justify"colspan="2"></td>
										<td align="left">&nbsp;</td>
										<td align="left">&nbsp;</td>
										<td align="left"colspan="2">&nbsp;</td>
									</tr>
									<tr>
										<td colspan="9" align="right"><b>Total Amount (Rs.) </b></td>
										<td>
										<b>
										</b>
										</td>
										<td align="left" colspan="2"><b></b></td>
										<td align="left">&nbsp;</td>
										<td align="left">&nbsp;</td>
										<td align="left" colspan="2">&nbsp;</td>
									</tr>	
								</table>	
								<table width="100%" class="table1" align="center">
									<tr>
								       <td><br><br><br><br><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><!--uma 10072019 space increase-->
								         <span style="float:left">Date .......... </span>
								         <span style="float:right"><b>Signature of officer preparing the bill</b></span><br><br>
										 <span style="float:left">pay Rs(...........................) in cash and Rs ..........................................................</span>
										 <span style="float:right"><b><br/><br/>Signature of officer authorizing payment</b></span><br><br>
										 ...................................................................by cheque<br><br>
										 <span style="float:left">Date ................................. </span><br><br>
										 in case of payments to suppliers a red link entry should be made across the page above 
											&nbsp;
											the entries relating thereto , in one of the following forms, applicable to the case:-<br>
											(1) Stock<br>
											(2) Purchases For Stock<br>
											(3) purchase of the directissue to work.....................
											(4) purchase for the work...................................
											For issue to contractor................................................<br><br>
											not required in case of works done or supplies made under a piece work agreement .<br><br>
											in case of works the accounts of which are kept by sub heads the amounts relating 
											to all items of work failing under the same sub heads should be titaled in red ink.<br><br>
											Payment should be attested by some known person when the payees Acknowledgement is given be a mark, seal or thumb impression.<br><br>
											This signature is necessary only when the officer authorizing payment is not the officer who prepares the bill.<br><br>
										    (for use in Divisional Office)
								       </td>
								     </tr>
							</table>
						</div>
       				</form>
      				</blockquote>
					<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
						<div class="buttonsection">
							<input type="button" name="back" value="Back" id="back" class="backbutton" onClick="goBack();" />
						</div>
						<div class="buttonsection" id="view_btn_section">
							<input type="button" name="btn_print" value="Print" id="btn_print" class="backbutton" onClick="PrintBook();" />
						</div>
					</div>
    			</div>	
   			</div>
		</div>
<!--==============================footer=================================-->
@include('layouts.footer')
</body>
</html>

