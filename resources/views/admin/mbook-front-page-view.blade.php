@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
	<form action="" method="post" enctype="multipart/form-data" name="form">
        <div class="content">
			<div class="title printbutton">MBook Front Page - View</div>
                <div class="container_12">
                    <div class="grid_12" align="center">
                        <blockquote class="bq1" style="overflow-y:scroll;" id="printSection">
							<div style="">
                        	<table width="875" border="0" align="center" cellpadding="0" cellspacing="0" class="color4 double">
								<tr><td colspan="4" align="center" class="labelheadprint">&nbsp;</td></tr>
								<tr><td colspan="4" align="center" class="labelheadprint">Government of India</td></tr>
								<tr><td colspan="4" align="center" class="labelheadprint">Department of Atomic Energy</td></tr>
								<tr><td colspan="4" align="center" class="labelheadprint">Indira Gandhi Centre for Atomic Research</td></tr>
								<tr><td colspan="4" align="center" class="labelheadprint">Civil Engineering Group (CEG)</td></tr>
								<tr><td colspan="4" align="center" class="labelheadprint">&nbsp;</td></tr>
								<tr>
									<td width="10%">&nbsp;</td>
									<td width="30%" align="left" class="labelheadprint"><b>MEASUREMENT BOOK NO </b>  </td>
									<td width="30%" align="left" class="labelheadprint">:&nbsp;&nbsp;&nbsp;&nbsp;<b></b></td>
									<td align="left" class="labelheadprint">
										<label style="border:2px solid #000000; padding:4px 12px 4px 12px;">
											<b>
											</b>
										</label>
										&nbsp;&nbsp;&nbsp;&nbsp; 
										<b>
										</b>
									</td>
								</tr>
								<tr><td colspan="4" align="center" class="labelheadprint">&nbsp;</td></tr>
								<tr>
									<td>&nbsp;</td>
									<td align="left" class="labelheadprint">Issued to (Name) </td>
									<td colspan="2" align="left" class="labelheadprint">
										:&nbsp;&nbsp;&nbsp;&nbsp;
										<b><u></u></b> 
									</td>
								</tr>
								<tr><td colspan="4" align="center" class="labelheadprint">&nbsp;</td></tr>
								<tr>
									<td>&nbsp;</td>
									<td align="left" class="labelheadprint">Designation </td>
									<td colspan="2" align="left" class="labelheadprint">
										:&nbsp;&nbsp;&nbsp;&nbsp;
										<b><u></u></b> 
									</td>
								</tr>
								<tr><td colspan="4" align="center" class="labelheadprint">&nbsp;</td></tr>
								<tr>
									<td>&nbsp;</td>
									<td align="left" colspan="3" class="labelheadprint">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									Certified that this measurement book contains Page No. 
									<b><u>01</u></b> to <b><u>100</u></b> Pages only.
									</td>
								</tr>
								<tr><td colspan="4" align="center" class="labelheadprint">&nbsp;</td></tr>
								<tr><td colspan="4" align="center" class="labelheadprint">&nbsp;</td></tr>
								<!--<tr><td colspan="4" align="center" class="labelheadprint">&nbsp;</td></tr>
								<tr><td colspan="4" align="center" class="labelheadprint">&nbsp;</td></tr>
								<tr><td colspan="4" align="center" class="labelheadprint">&nbsp;</td></tr>
								<tr><td colspan="4" align="center" class="labelheadprint">&nbsp;</td></tr>
								<tr><td colspan="4" align="center" class="labelheadprint">&nbsp;</td></tr>-->
								<tr>
									<td width="10%">&nbsp;</td>
									<td width="25%" align="left" class="labelheadprint">Date : </td>
									<td align="right" colspan="2" class="labelheadprint">
									&nbsp;&nbsp;&nbsp;&nbsp;
									@php echo "Signature of the Issuing Authority."; @endphp
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								</tr>
								<tr><td colspan="4" align="center" class="labelheadprint">&nbsp;</td></tr>
								<tr><td colspan="4" align="center" class="labelheadprint">&nbsp;</td></tr>
							</table>
							<p style='page-break-after:always;'></p>
							<table width="875" border="0" align="center" cellpadding="0" cellspacing="0" class="color4">
								<tr><td colspan="4" align="center" class="labelheadprint">&nbsp;</td></tr>
								<tr><td colspan="4" align="center" class="labelheadprint">&nbsp;</td></tr>
								<tr>
									<td width="10%">&nbsp;</td>
									<td width="30%" align="left" class="labelheadprint"><b>MEASUREMENT BOOK NO </b>  </td>
									<td width="30%" align="left" class="labelheadprint">:&nbsp;&nbsp;&nbsp;&nbsp;<b></b></td>
									<td align="left" class="labelheadprint">
										<label style="border:2px solid #000000; padding:4px 12px 4px 12px;">
											<b>
											</b>
										</label>
										&nbsp;&nbsp;&nbsp;&nbsp; 
										<b>
										</b>
									</td>
								</tr>
								<tr><td colspan="4" align="center" class="labelheadprint">&nbsp;</td></tr>
								<tr>
									<td>&nbsp;</td>
									<td align="right" class="labelheadprint">Issued to </td>
									<td colspan="2" align="left" class="labelheadprint">
										(i)&nbsp;&nbsp;&nbsp;&nbsp; Name : 
										<b><u></u></b> 
									</td>
								</tr>
								<tr><td colspan="4" align="center" class="labelheadprint">&nbsp;</td></tr>
								<tr>
									<td>&nbsp;</td>
									<td align="right" class="labelheadprint">&nbsp;</td>
									<td colspan="2" align="left" class="labelheadprint">
										(ii)&nbsp;&nbsp;&nbsp;&nbsp;Designation : 
										<b><u></u></b> 
									</td>
								</tr>
								<tr><td colspan="4" align="center" class="labelheadprint">&nbsp;</td></tr>
								<tr>
									<td>&nbsp;</td>
									<td align="right" class="labelheadprint">&nbsp;</td>
									<td colspan="2" align="left" class="labelheadprint">
										(iii)&nbsp;&nbsp;&nbsp;&nbsp;Section :
										<b><u></u></b> 
									</td>
								</tr>
								<tr><td colspan="4" align="center" class="labelheadprint">&nbsp;</td></tr>
								<tr>
									<td>&nbsp;</td>
									<td align="left" colspan="3" class="labelheadprint">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									Certified that this measurement book contains<br/> <br/> 
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									Page No. <b><u>01</u></b> to <b><u>100</u></b> Pages only.
									</td>
								</tr>
								<tr><td colspan="4" align="center" class="labelheadprint">&nbsp;</td></tr>
								<tr><td colspan="4" align="center" class="labelheadprint">&nbsp;</td></tr>
								<tr><td colspan="4" align="center" class="labelheadprint">&nbsp;</td></tr>
								<tr><td colspan="4" align="center" class="labelheadprint">&nbsp;</td></tr>
								<tr><td colspan="4" align="center" class="labelheadprint">&nbsp;</td></tr>
								<tr><td colspan="4" align="center" class="labelheadprint">&nbsp;</td></tr>
								<tr><td colspan="4" align="center" class="labelheadprint">&nbsp;</td></tr>
								<tr>
									<td width="10%">&nbsp;</td>
									<td width="25%" align="left" class="labelheadprint">Date : </td>
									<td align="right" colspan="2" class="labelheadprint">
									&nbsp;&nbsp;&nbsp;&nbsp;
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
								</tr>
								<tr><td colspan="4" align="center" class="labelheadprint">&nbsp;</td></tr>
								<tr><td colspan="4" align="center" class="labelheadprint">&nbsp;</td></tr>
							</table>
							<p style='page-break-after:always;'></p>
                        	<table width="875" border="0" align="center" cellpadding="0" cellspacing="0" class="color4 labelmed">
								<tr>
									<td align="center" class=""><b>Instructions Regarding the Writing up etc., of Measurement Book</b></td>	
								</tr>
								<tr>
									<td class="para">
									The following instructions are laid down for the writing up of Measurement Books are printed at the beginning of all Measurement Books.
									</td>	
								</tr>
								<tr>
									<td class="para">
										(1) The Measurement Book is the basis of all account of quantities whether of work done by contractor or by labour employed departmentally 
										or of materials received and should be so kept that the transactions may be readily traceable in the accounts of the Department.
									</td>	
								</tr>
								<tr>
									<td class="para">
										Measurement Books should be considered as very important accounts records and maintained very carefully and accurately as they may have to
										be produced as evidence in a Court of Law
									</td>	
								</tr>
								<tr>
									<td class="para">
										(2) All the books belonging to a Division should be numbered serially and a register should be maintained in C.P.W.A. 
										Form 92 showing the serial
										number of each book, the sub-Divisions to which issued, the date of issue and the date of its return, so that in 
										eventual return to the Divisional 
										Officer and Sectional Officers to whom the Measurement Books have been issued.  Books no longer in use should be 
										withdrawn promptly even though not 
										completely written up.
									</td>
								</tr>
								<tr>
									<td class="para">
										Sub-divisional officers are required to submit the Measurement Books in use to the Divisional Office 
										from time to time so that at least once a year, the entries recorded in each book may be subjected 
										to a percentage check by the Divisional Accountant under the supervision of the Divisional 
										Officer.
									</td>
								</tr>
								<tr>
									<td class="para">
										(3) When an Officer or a subordinate in executive charge of work or stores is transferred, he should make over 
										the Measurement Books issued to him to his successor and in the prescribed Register in C.P.W.A. Form 92 they 
										should be shown as received back from the relieved Officer and issued to the relieving Officer. The transfer 
										should also be recorded after the last entry in each book and signed and dated by the relieved and relieving 
										Officer or subordinate.
									</td>
								</tr>
								<tr>
									<td class="para">(4)	Each set of measurement should commence with entries stating:</td>
								</tr>
								<tr>
									<td class="para">I.	In the case of bills for work done</td>
								</tr>
								<tr>
									<td class="para-med">(a)	Full name of work as given in estimate</td>
								</tr>
								<tr>
									<td class="para-med">(b)	Situation of work</td>
								</tr>
								<tr>
									<td class="para-med">(c)	Name of contractor</td>
								</tr>
								<tr>
									<td class="para-med">(d)	Number and date of his agreement</td>
								</tr>
								<tr>
									<td class="para-med">(e)	Date of written order to commence work</td>
								</tr>
								<tr>
									<td class="para-med">(f)	Date of actual completion of work</td>
								</tr>
								<tr>
									<td class="para-med">(g)	Date of measurement, and</td>
								</tr>
								<tr>
									<td class="para-med">(h)	Reference to previous measurement</td>
								</tr>
						   	</table>
							<p style='page-break-after:always;'></p>
                        	<table width="875" border="0" align="center" cellpadding="0" cellspacing="0" class="color4 labelmed">
								<tr>
									<td class="para">II.	In the case of bills for supply of materials</td>
								</tr> 
								<tr>
								 	<td class="para-med">(a)	Name of supplier</td>
								</tr>
								<tr>
								 	<td class="para-med">(b)	Number and date of his agreement or order</td>
								</tr>
								<tr>
								 	<td class="para-med">(c)	Purpose of supply in one of the following forms applicable to the case....</td>
								</tr>
								<tr>
								 	<td class="para-large">
										(i) "Stock" (for all supplies for stock purposes).<br/>
									</td>
								</tr>
								<tr>
								 	<td class="para-large">
										(ii) "Purchases" for direct issue to (here enter full name of work as given 
										<br/>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
										in the estimate)
									</td>
								</tr>
								<tr>
								 	<td class="para-large">
										(iii) "Purchases" for (here enter full name of work as given in estimate)<br/>
											&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
											.......................... for issue of contractor .........................
											<br/>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
											on ..........................
									</td>
								</tr>
								<tr>
								 	<td class="para-med">(d)	Date of written order to commence supplies</td>
								</tr>
								<tr>
								 	<td class="para-med">(e)	Date of actual completion of supplies, and</td>
								</tr>
								<tr>
								 	<td class="para-med">(f)	Date of measurement.</td>
								</tr>
								<tr>
								 	<td class="para">
										A suitable abstract should then be prepared which collect,in the case of
								   		measurement for works done, total quantities of each distinct item of work relating to each sanctioned sub-head.
									</td>
								</tr>
								<tr>
									 <td class="para">
										 If the measurements, are taken in connection with a running contract, a reference to the last set of measurements, if any,
										 should be recorded and if the entire job or contract has been completed the date of completion should be duly noted in the 
										 prescribed place. If the measurements taken are the first set measurements on a running account, or the first and final 
										 measurements, this fact should be suitably noted against the entries in the Measurement book and in the latter case, 
										 the actual date of completion should be noted in the prescribed place.
									 </td>
								</tr>
								<tr>
								 	<td class="para">
										(5)	All measurements should be recorded neatly and directly in the Measurement Book at the site of work.  
										The recording of measurements elsewhere and copying them into a Measurement Book is forbidden.  The entries should 
										ordinarily be made in ink when this is not possible the entries should be made in indelible pencil
									   	and the pencil entries should not be inked over but should be left untouched.  The entries in the contents of area, 
									   	column should however, be invariably made in ink in the first instance by the person who recorded the measurements.  
									   	The person recording the measurement will also record a dated certificate "measured by me" and sign his full name.
								   	</td>
								</tr>
								<tr>
								 	<td class="para">
										(6)	Measurements should be recorded only by Executive, Assistant Executive or Assistant Engineer or by Executive 
										subordinate in charge of work to whom Measurement Books have been supplied for the purpose, or other persons specially 
										authorised by the local Govt. to do so.
									</td>
								</tr>
								<tr>
								 	<td class="para">
										For all works the Sub-Divisional Officer himself should record the measurements of all important items such as 
										foundations of structures which owing to their situation cannot subsequently be checked and items which have a 
										very high unit rate such as reinforced concrete.
									</td>
								</tr>
						   	</table>
							<p style='page-break-after:always;'></p>
                        	<table width="875" border="0" align="center" cellpadding="0" cellspacing="0" class="color4 labelmed">
								<tr>
									 <td class="para">
										 Measurement for other items may be recorded by the executive Subordinate for running and 
										 final bills.  Such measurements (i.e., those recorded by Subordinates) should, however be 
										 test checked to the extent of at least 50 per cent (judged by their money value) by the S
										 ub-Divisional Officer himself in each case, and he will be responsible for the general 
										 correctness of the bill as a whole.
									</td class="para">
								</tr>
								<tr>
									 <td class="para">
									 	(7)	No erasers are allowed, if a mistake is made, it should be corrected by striking 
									 	out the incorrect entry and inserting the correct one between the lines.  Every such correction 
									 	should be initialed and dated by a responsible Officer.
									</td>
								</tr>
								<tr>
									 <td class="para">
										 Entries should be recorded continuously and no blank page left or turn out.  Any pages 
										 or space left blank inadvertently should be cancelled by diagonal lines, the cancellation 
										 being attested and dated.
									 </td>
								</tr>
								<tr>
									 <td class="para">
										 When any measurements are cancelled or disallowed they must be endorsed by the dated 
										 initials of the Officer ordering the cancellation or by a reference to these orders and 
										 initials by the Officer who made the measurements, the reasons for cancellation being also recorded.
									</td>
								</tr>
								<tr>
									 <td class="para">
									 	(8)	The Divisional Officer should test check at least ten percent of measurements 
									 	recorded by his subordinates, and accept responsibility for the general correctness of the 
									 	bill as a whole.
									</td>
								</tr>
								<tr>
									 <td class="para">
									 	(9)	On completion of the abstract, the books should be submitted to the Sub-Divisional 
										 Officer who after carrying out his test check should enter the words "Check and Bill" with his 
										 dated initials.  The Sub-Divisional clerk should then check the calculation of quantities in the 
										 abstract, and the bill in case of work carried out by contract, and should then place the 
										 Measurement Book and the bill before the Sub-Divisional Officer who, after comparing the two 
										 should sign the bill and the Measurement Book at the end of the abstract.  From the Measurement 
										 Book all quantities should be clearly traceable into the documents on which payments are made.  
										 When a bill is prepared for a work or supplies measured, every page containing the detailed measurements 
										 must be invariably scored out by a diagonal red ink line.  When the payment is made an endorsement 
										 must be made in red ink, on the abstract of measurements, giving a reference to the number and date 
										 of the voucher of payment.
									</td>
								</tr>
								<tr>
									 <td class="para">
									 	Any corrections to calculations of rates made in the Sub-Divisional or Divisional office should
									  	be made in red ink and brought to the notice of the Sub-Divisional Officer or the Divisional Officer,
									   	as the case may be, and of the person making the original measurements, in the case of final bills,
										payment should be deferred until the corrections have been accepted by the person making the measurements.
										All corrections made by the clerical staff should be in red ink.
									</td>
								</tr>
								<tr>
									 <td class="para">
									 	(10) When the work which is, susceptible of measurements is carried out by daily labour a
									  	similar plan should be adopted, the quantities of work done as shown on the Muster Roll being 
									  	compared with the entries in the Measurement Book before payment is authorised.
									</td>
								</tr>
								<tr>
									 <td class="para">
									 	(11) Measurement Books should be sent only Registered post or by the special Messenger.
									 </td>
								</tr>
						   </table>
							</div>
							<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
								<div class="buttonsection">
									<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
								</div>
								<div class="buttonsection">
									<input type="button" class="backbutton" name="print" id="print" value="Print" onClick="PrintBook();"/>
								</div>
							</div>
                        </blockquote>
                    </div>
                </div>
            </div>
          
        </form>
		@endsection