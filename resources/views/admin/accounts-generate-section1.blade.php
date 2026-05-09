

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
                	<form name="form" method="post" action="AccountsGenerateSection2.php">
                    	<div class="container">
							
							<div class="container-fluid">
								<div data-wizard-init>
								  <ul class="steps">
									<li data-step="1">Memo For Payment</li>
									<li data-step="2">Abstract - B</li>
									<li data-step="3">Recovery</li>
									<li data-step="4">Accounts Works</li>
									<li data-step="5">Bill Miscellaneous</li>
									<!--<li data-step="6">Certificate Of Deduction</li>-->
								  </ul>
								  <div class="steps-content" align="center" id="printSection">
									<div data-step="1" align="center">
										<table width="90%" class="tableA" align="center">
											<tr class="label">
												<td  colspan="8" align="center">
													   <span style="float:center"><b>Memo For Payment</b></span>
													   <span style="float:right">C.CODE &nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; </span>
												</td>
											</tr>
											<tr class="label">
												<td colspan="8">
													<span style="float:left">Bill NO : RAB -  </span>
													<span style="float:right">SL NO.&nbsp;&nbsp;:&nbsp;  &nbsp;&nbsp;Date :&nbsp;&nbsp; </span>
												</td>
											</tr>
											
											
											
											<tr class="label">
												<td align="left" width="250px">Name of Contractor</td>
												<td colspan="7"></td>
											</tr>
											<tr class="label">
												<td align="left">Name of Work</td>
												<td colspan="7"></td>
											</tr>
											<tr class="label">
												<td align="left">Contract Value</td>
												<td colspan="3"></td>
												<td align="left">Contract Valid Upto</td>
												<td colspan="3"></td>
											</tr>
											<tr class="label">
												<td align="left">Agreement No.</td>
												<td colspan="7"></td>
											</tr>
											<tr class="label">
												<td align="left">Work Order No.</td>
												<td colspan="7"></td>
											</tr>
											<tr class="label">
												<td align="left">Tecnical Sanction No.</td>
												<td colspan="3"></td>
												<td align="left">HOA</td>
												<td colspan="3"> </td>                  
											</tr>
											<!--<tr class="label">
												<td align="left" colspan="8">
												A. Upto Date Value of Work Done - Page No.  MB No.  : 
												</td>
											</tr>-->
											<!--<tr class="label">
												<td align="left" colspan="8">
												B. ADD/DEDUCT Secure Advance : 
												</td>
											</tr>-->
											<tr class="label">
												<td align="left" colspan="2" style="border-right:none;" nowrap="nowrap">A. Upto Date Value of Work Done - Page No.  MB No.<span style="float:right">:&nbsp; RS.</span> </td>
												<td align="left" colspan="6" style="border-left:none;"><div style="width:175px; text-align:right"></div></td>
											</tr>
											
											<tr class="label">
												<td align="left" colspan="2" style="border-right:none;">B. ADD/DEDUCT Secure Advance :&nbsp;&nbsp;&nbsp;<span style="float:right">:&nbsp; RS.</span> </td>
												<td align="left" colspan="6" style="border-left:none;"><div style="width:175px; text-align:right"></div></td>
											</tr>
											<!--<tr class="label">
												<td align="left" colspan="8">B.ADD: Secure Advance &nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp; RS.&nbsp;</td>
											</tr>-->
											<tr class="label">
												<td align="left" colspan="2" style="border-right:none;">C. Grand Total &nbsp;&nbsp;&nbsp;&nbsp;<span style="float:right">:&nbsp; RS.</span> </td>
												<td align="left" colspan="6" style="border-left:none;"><div style="width:175px; text-align:right"></div></td>
											</tr>
											<tr class="label">
												<td align="left" colspan="2" style="border-right:none;">D. Less: Previous PMT Page No.  MB No. (-)&nbsp;&nbsp;&nbsp;&nbsp;<span style="float:right">:&nbsp; RS.</span> </td> 
												<td align="left" colspan="6" style="border-left:none;"><div style="width:175px; text-align:right"></div></td>
											</tr>
											<tr class="label">
												<td align="left" colspan="2" style="border-right:none;">Net Total  &nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;[C-D]<span style="float:right">:&nbsp;&nbsp;RS.</span></td>
												<td align="left" colspan="6" style="border-left:none;"><div style="width:175px; text-align:right"></div></td>
											</tr>
											<tr class="label">
												<td align="left" colspan="8">8. Recoveries :</td>
												
											</tr>
										</table>
										<table width="90%" class="tableA" align="center">
											<tr class="label">
												<td align="left">&nbsp;[a]</td>
												<td align="left" colspan="2" class="labelmedium">Recoveries Creditable Under Works</td>
											</tr>
											<tr class="label">
												<td align="left">&nbsp;</td>
												<td align="left" class="labelmedium"> &nbsp;&nbsp;&nbsp;&nbsp;[]  C.L.CESS @  % On () &nbsp;&nbsp;&nbsp;&nbsp;  </td>
												<td align="left">:&nbsp;&nbsp;&nbsp; RS.&nbsp; </td>
											</tr>
											<tr class="label">
												<td align="left">&nbsp;</td>
												<td align="left" class="labelmedium"> &nbsp;&nbsp;&nbsp;&nbsp;[]  Mobilisation ADvance &nbsp;&nbsp;&nbsp;&nbsp;  </td>
												<td align="left">:&nbsp;&nbsp;&nbsp; RS.&nbsp; </td>
											</tr>
											<tr class="label">
												<td align="left">&nbsp;[b]</td>
												<td align="left" colspan="2" class="labelmedium">Recoveries Creditable To Other Head of Acctount</td>
											</tr>
											<tr class="label">
												<td align="left">&nbsp;</td>
												<td align="left" class="labelmedium"> &nbsp;&nbsp;&nbsp;&nbsp;[]  CGST @ % On ( ) &nbsp;&nbsp;&nbsp;&nbsp;</td>
												<td align="left">:&nbsp;&nbsp;&nbsp; RS.&nbsp; </td>
											</tr>
											<tr class="label">
												<td align="left">&nbsp;</td>
												<td align="left" class="labelmedium"> &nbsp;&nbsp;&nbsp;&nbsp;[]  SGST @  % On ( ) &nbsp;&nbsp;&nbsp;&nbsp;</td>
												<td align="left">:&nbsp;&nbsp;&nbsp; RS.&nbsp; </td>
											</tr>
											<tr class="label">
												<td align="left">&nbsp;</td>
												<td align="left" class="labelmedium"> &nbsp;&nbsp;&nbsp;&nbsp;[]  S.D. @  % On ( ) &nbsp;&nbsp;&nbsp;&nbsp;</td>
												<td align="left">:&nbsp;&nbsp;&nbsp; RS.&nbsp; </td>
											</tr>
											<tr class="label">
												<td align="left">&nbsp;</td>
												<td align="left" class="labelmedium"> &nbsp;&nbsp;&nbsp;&nbsp;[]  WCT @  % On ( ) &nbsp;&nbsp;&nbsp;&nbsp;</td>
												<td align="left">:&nbsp;&nbsp;&nbsp; RS.&nbsp;  </td>
											</tr>
											<tr class="label">
												<td align="left">&nbsp;</td>
												<td align="left" class="labelmedium"> &nbsp;&nbsp;&nbsp;&nbsp;[]  VAT @  % On ( ) &nbsp;&nbsp;&nbsp;&nbsp;</td>
												<td align="left">:&nbsp;&nbsp;&nbsp; RS.&nbsp;</td>
											</tr>
											<tr class="label">
												<td align="left">&nbsp;</td>
												<td align="left" class="labelmedium"> &nbsp;&nbsp;&nbsp;&nbsp;[]  L.W CESS AMOUNT @  % On ( ) &nbsp;&nbsp;&nbsp;&nbsp;</td> 
												<td align="left">:&nbsp;&nbsp;&nbsp;&nbsp; RS.&nbsp; </td>
											</tr>
											<tr class="label">
												<td align="left">&nbsp;</td>
												<td align="left" class="labelmedium"> &nbsp;&nbsp;&nbsp;&nbsp;[]  INCOMETAX @ % On ( ) &nbsp;&nbsp;&nbsp;&nbsp;</td>
												<td align="left">:&nbsp;&nbsp;&nbsp; RS.&nbsp;  </td>
											</tr>
											<tr class="label">
												<td align="left">&nbsp;</td>
												<td align="left" class="labelmedium"> &nbsp;&nbsp;&nbsp;&nbsp;[]  IT CESS @  % On ( ) &nbsp;&nbsp;&nbsp;&nbsp;</td>
												<td align="left">:&nbsp;&nbsp;&nbsp; RS.&nbsp; </td>
											</tr>
											<tr class="label">
												<td align="left">&nbsp;</td>
												<td align="left" class="labelmedium"> &nbsp;&nbsp;&nbsp;&nbsp;[]  IT EDUCATION @  % On ( ) &nbsp;&nbsp;&nbsp;&nbsp;</td>
												<td align="left">:&nbsp;&nbsp;&nbsp; RS.&nbsp;</td>
											</tr>
											<tr class="label">
												<td align="left">&nbsp;</td>
												<td align="left" class="labelmedium"> &nbsp;&nbsp;&nbsp;&nbsp;[]  LAND RENT &nbsp;&nbsp;&nbsp;&nbsp;</td>
												<td align="left">:&nbsp;&nbsp;&nbsp; RS.&nbsp;  </td>
											</tr>
											<tr class="label">
												<td align="left">&nbsp;</td>
												<td align="left" class="labelmedium"> &nbsp;&nbsp;&nbsp;&nbsp;[]  LIQUID DAMAGE &nbsp;&nbsp;&nbsp;&nbsp;</td>
												<td align="left">:&nbsp;&nbsp;&nbsp; RS.&nbsp;  </td>
											</tr>
											<tr class="label">
												<td align="left">&nbsp;</td>
												<td align="left" class="labelmedium"> &nbsp;&nbsp;&nbsp;&nbsp;[]  OTHER_RECOVERY_1_DESC &nbsp;&nbsp;&nbsp;&nbsp;</td>
												<td align="left">:&nbsp;&nbsp;&nbsp; RS.&nbsp; </td>
											</tr>
											<tr class="label">
												<td align="left">&nbsp;</td>
												<td align="left" class="labelmedium"> &nbsp;&nbsp;&nbsp;&nbsp;[]  OTHER_RECOVERY_2_DESC &nbsp;&nbsp;&nbsp;&nbsp;</td>
												<td align="left">:&nbsp;&nbsp;&nbsp; RS.&nbsp; </td>
											</tr>
											<tr class="label">
												<td align="left">&nbsp;</td>
												<td align="left" class="labelmedium"> &nbsp;&nbsp;&nbsp;&nbsp;[]  NON DEP MACHINE EUIP &nbsp;&nbsp;&nbsp;&nbsp;</td>
												<td align="left">:&nbsp;&nbsp;&nbsp; RS.&nbsp;</td>
											</tr>
											<tr class="label">
												<td align="left">&nbsp;</td>
												<td align="left" class="labelmedium"> &nbsp;&nbsp;&nbsp;&nbsp;[]  NON DEP MAN POWER &nbsp;&nbsp;&nbsp;&nbsp;</td>
												<td align="left">:&nbsp;&nbsp;&nbsp; RS.&nbsp; </td>
											</tr>
											<tr class="label">
												<td align="left">&nbsp;</td>
												<td align="left" class="labelmedium"> &nbsp;&nbsp;&nbsp;&nbsp;[]  NON SUBMISSION  &nbsp;&nbsp;&nbsp;&nbsp;</td>
												<td align="left">:&nbsp;&nbsp;&nbsp; RS.&nbsp; </td>
											</tr>											
											<tr class="label">
												<td align="left">&nbsp;</td>
												<td align="left" class="labelmedium"> &nbsp;&nbsp;&nbsp;&nbsp;Total Recovery &nbsp;&nbsp;&nbsp;&nbsp;</td>
												<td align="left">:&nbsp;&nbsp;&nbsp; RS.&nbsp; </td>
											</tr>
											<td colspan="8" align="center">
												<span style="float:center"> Cod. Amt. ................. </span>
											</td>
											<!--<tr class="label">
												<td align ="center">Assitantsp[I]<br> 10.4.2018</td>
												<td align ="center">Ducument Prepared</td>
												<td align ="center">Registed Entries</td>
											</tr>
											<tr class="label">
												<td align ="center"></td>
												<td align ="center">1. MB P.No. ___________</td>
												<td align ="center">1. C.L.  P.No</td>
											</tr>
											<tr class="label">
												<td align ="center">Assitantsp[II]</td>
												<td align ="center">2. Cod. Amt. 3,81,64,816</td>
												<td align ="center">2. B.C  P.No</td>
											</tr>
											<tr class="label">
												<td align ="center"></td>
												<td align ="center">3. I.T.C  ______________</td>
												<td align ="center">3. S.D  P.No</td>
											</tr>
											<tr class="label">
												<td align ="center">A.A.O</td>
												<td align ="center">4. W.C.T _____________</td>
												<td align ="center">4. MRR  P.No</td>
											</tr>
											<tr class="label">
												<td align ="center"></td>
												<td align ="center">5. Recovery St  ________</td>
												<td align ="center">5. S.C P .No</td>
											</tr>
											<tr class="label">
												<td align ="center">A.O</td>
												<td align ="center"></td>
												<td align ="center"></td>
											</tr>
											<tr class="label">
												<td align ="center">D.C.A</td>
												<td align ="center"></td>
												<td align ="center"></td>
											</tr>-->
										</table>
										<p style='page-break-after:always; background-color:#f1f1f1; text-align:center' align="center"></p>
										<table width="90%" class="tableA" align="center">
											<tr class="label">
												<td colspan="3" align="center">Government Of India<br>Deportment Of Atomic Energy<br>Indira Gandhi Centre For Atomic Research</td>
											</tr>
											<tr class="label" align="center">
												<td colspan="3">
													<span style="float:center"><b>ACCOUNTS (Works)</b></span>
												</td>
											</tr>
											<tr class="label">
												<td colspan="3">
													<span style="float:right">&nbsp;&nbsp;Date :&nbsp;&nbsp; ..............</span>
												</td>
											</tr>
											<tr class="label">
											    <td align="left">&nbsp;</td>
												<td align="left"class="labelmedium">Name Of Payee</td>
												<td align="left"> :&nbsp;&nbsp;</td>
											</tr>
											<tr class="label">
											    <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
												<td align="left"class="labelmedium">Account Number : </td>
												<td align="left">:&nbsp;&nbsp; </td>
											</tr>
											
											<tr class="label">
											    <td align="left">A.A.O.</td>
												<td align="left">Bank/Branch/Code: </td>
												<td align="left">:&nbsp;&nbsp; / </td>
											</tr>
											
											<tr class="label">
											    <td align="left"></td>
												<td align="left">Mode Of Payment </td>
												<td align="left">:&nbsp;&nbsp;</td>
											</tr>
											<tr class="label">
											    <td align="left">A.O.</td>
												<td align="left">IFSC Code </td>
												<td align="left">:&nbsp;&nbsp;</td>
											</tr>
											
											<tr class="label">
											    <td align="left">&nbsp;</td>
												<td align="left">Amount</td>
												<td align="left">:&nbsp;&nbsp;</td>
											</tr>
											
											<tr class="label">
											    <td align="left">D.C.A.</td>
												<td align="left">Payment Passed On</td>
												<td align="left">:&nbsp;&nbsp;</td>
											</tr>
											<tr class="label">
												<td colspan="3">
													<span style="float:right"><br><br>&nbsp;&nbsp;<br>Asst.Accts.Officer<br><br></span>
												</td>
											</tr>
										</table>
										<p style='page-break-after:always; background-color:#f1f1f1; text-align:center' align="center"></p>
										<input type="hidden" name="txt_sheetid" id="txt_sheetid" value=""> 
										<input type="hidden" name="txt_rbn" id="txt_rbn" value=""> 
										<input type="hidden" name="txt_hoa" id="txt_hoa" value="">
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

