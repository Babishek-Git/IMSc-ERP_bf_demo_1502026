@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
    <form action="" method="post" enctype="multipart/form-data" name="form">
            <div class="content">
                <div class="title">Recoveries</div>
                <div class="container_12">
                    <div class="grid_12" align="center">
						<!--<div align="right"><a href="AgreementEntryView.php">View</a>&nbsp;&nbsp;&nbsp;</div>-->
                        <blockquote class="bq1" style="overflow:auto">
									<br/>
                        		<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" class="color1">
									<tr>
										<td colspan="4" class="label" style="background-color:#D4D4D4">GST</td>
									</tr>
									<tr><td colspan="4" class="label">&nbsp;</td></tr>
									<tr>
										<td class="label">CGST </td>
										<td>
											<input type="text" class="textboxdisplay" name="txt_cgst" id="txt_cgst" style="width:70px" value="">
											<label class="label labledescription">&nbsp;% of Total Bill Value&nbsp;</label>
										</td>
										<td class="label">SGST</td>
										<td>
											<input type="text" class="textboxdisplay" name="txt_sgst" id="txt_sgst" style="width:70px" value="">
											<label class="label labledescription">&nbsp; % of Total Bill Value&nbsp;</label>
										</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td align="center" class="labeldisplay" id="val_cgst" style="color:red" colspan="">&nbsp;</td>
										<td>&nbsp;</td>
										<td align="center" class="labeldisplay" id="val_sgst" style="color:red" colspan="">&nbsp;</td>
									</tr>
									
									<tr>
										<td colspan="4" class="label" style="background-color:#D4D4D4">Under 8 (a)</td>
									</tr>
									<tr><td colspan="4" class="label">&nbsp;</td></tr>
									<tr>
										<td class="label">WCT (Non Civil)</td>
										<td>
											<input type="text" class="textboxdisplay" name="txt_wct_noncivil" id="txt_wct_noncivil" style="width:70px" value="">
											<label class="label labledescription">&nbsp;% of Total Bill Value&nbsp;</label>
										</td>
										<td class="label">WCT (Civil)</td>
										<td>
											<input type="text" class="textboxdisplay" name="txt_wct_civil" id="txt_wct_civil" style="width:70px" value="">
											<label class="label labledescription">&nbsp; % of Total Bill Value&nbsp;</label>
										</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td align="center" class="labeldisplay" id="val_wct_noncivil" style="color:red" colspan="">&nbsp;</td>
										<td>&nbsp;</td>
										<td align="center" class="labeldisplay" id="val_wct_civil" style="color:red" colspan="">&nbsp;</td>
									</tr>
																		<tr>
										<td class="label">VAT (Non Civil)</td>
										<td>
											<input type="text" class="textboxdisplay" name="txt_vat_noncivil" id="txt_vat_noncivil" style="width:70px" value="">
											<label class="label labledescription">&nbsp;% of Total Bill Value&nbsp;</label>
										</td>
										<td class="label">VAT (Civil)</td>
										<td>
											<input type="text" class="textboxdisplay" name="txt_vat_civil" id="txt_vat_civil" style="width:70px" value="">
											<label class="label labledescription">&nbsp; % of Total Bill Value&nbsp;</label>
										</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td align="center" class="labeldisplay" id="val_vat_noncivil" style="color:red" colspan="">&nbsp;</td>
										<td>&nbsp;</td>
										<td align="center" class="labeldisplay" id="val_vat_civil" style="color:red" colspan="">&nbsp;</td>
									</tr>
									<tr>
										<td class="label">Mobilization Advance</td>
										<td>
											<input type="text" class="textboxdisplay" name="txt_mob_advance" id="txt_mob_advance" style="width:70px" value="">
											<label class="label labledescription">&nbsp;% of Total Bill Value&nbsp;</label>
										</td>
										<td class="label">Labour Welfare Cess</td>
										<td>
											<input type="text" class="textboxdisplay" name="txt_labour_welfare" id="txt_labour_welfare" style="width:70px" value="">
											<label class="label labledescription">&nbsp; % of Total Bill Value &nbsp;</label>
										</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td align="center" class="labeldisplay" id="val_mob_advance" style="color:red" colspan="">&nbsp;</td>
										<td>&nbsp;</td>
										<td align="center" class="labeldisplay" id="val_labour_welfare" style="color:red" colspan="">&nbsp;</td>
									</tr>
									<tr>
										<td colspan="4" class="label" style="background-color:#D4D4D4">Under 8 (b)</td>
									</tr>
									<tr><td colspan="4" class="label">&nbsp;</td></tr>
									<tr>
										<td class="label">Security Deposit in <br/>Total Work Order Cost</td>
										<td>
											<input type="text" class="textboxdisplay" name="txt_sd" id="txt_sd" style="width:70px" value="">
											<label class="label labledescription">&nbsp;% of Total work order cost&nbsp;</label>
										</td>
										<td class="label">Security Deposit in <br/>Every RBN</td>
										<td>
											<input type="text" class="textboxdisplay" name="txt_sd_rbn" id="txt_sd_rbn" style="width:70px" value="">
											<label class="label labledescription">&nbsp; % of Total Bill Value&nbsp;</label>
										</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td align="center" class="labeldisplay" id="val_sd" style="color:red" colspan="">&nbsp;</td>
										<td>&nbsp;</td>
										<td align="center" class="labeldisplay" id="val_sd_rbn" style="color:red" colspan="">&nbsp;</td>
									</tr>
									<tr>
										<td class="label">Income Tax</td>
										<td>
											<input type="text" class="textboxdisplay" name="txt_incometax" id="txt_incometax" style="width:70px" value="">
											<label class="label labledescription">&nbsp;% of Total Bill Value&nbsp;</label>
										</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td align="center" class="labeldisplay" id="val_incometax" style="color:red" colspan="">&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td class="label">IT Cess</td>
										<td>
											<input type="text" class="textboxdisplay" name="txt_itcess" id="txt_itcess" style="width:70px" value="">
											<label class="label labledescription">&nbsp;% of Total Income Tax&nbsp;</label>
										</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td align="center" class="labeldisplay" id="val_itcess" style="color:red" colspan="">&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
																		<tr>
										<td class="label">IT Educational Cess</td>
										<td>
											<input type="text" class="textboxdisplay" name="txt_edu_cess" id="txt_edu_cess" style="width:70px" value="<?php //echo $incometax; ?>">
											<label class="label labledescription">&nbsp;% of Total Income Tax&nbsp;</label>
										</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td align="center" class="labeldisplay" id="val_edu_cess" style="color:red" colspan="">&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>

									<tr>
										<td class="label">Water Charges (Rs.)</td>
										<td colspan="3">
											<input type="text" class="textboxdisplay" name="txt_water_charge" id="txt_water_charge" style="width:150px" value="">
											<label class="label">&nbsp;&nbsp;/&nbsp;&nbsp;</label>
											<input type="text" class="textboxdisplay" name="txt_water_maxlevel" id="txt_water_maxlevel" style="width:150px" value="">
											<label class="label">&nbsp;&nbsp;Litres&nbsp;&nbsp;</label>
										</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td align="center" class="labeldisplay" id="val_water_charge" style="color:red" colspan="">&nbsp;</td>
										<td align="center" class="labeldisplay" id="val_water_maxlevel" style="color:red" colspan="">&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td class="label">Electricity Charges (Rs.)</td>
										<td colspan="3">
											<input type="text" class="textboxdisplay" name="txt_electricity_charge" id="txt_electricity_charge" style="width:150px" value="">
											<label class="label">&nbsp;&nbsp;/ unit&nbsp;&nbsp;</label>
										</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td align="center" class="labeldisplay" id="val_electricity_charge" style="color:red" colspan="3">&nbsp;</td>
									</tr>
									<!--<tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td class="label">Rent for Land (Rs.)</td>
										<td colspan="3">
											<input type="text" class="textboxdisplay" name="txt_land_rent" id="txt_land_rent" style="width:150px" value="">
										</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td align="center" class="labeldisplay" id="val_land_rent" style="color:red" colspan="3">&nbsp;</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td class="label">Liquidated damages <br/>recoveries (Rs.)</td>
										<td colspan="3">
											<input type="text" class="textboxdisplay" name="txt_liquid_damage" id="txt_liquid_damage" style="width:150px" value="<?php //echo $liquiddamage; ?>">
										</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td align="center" class="labeldisplay" id="val_liquid_damage" style="color:red" colspan="3">&nbsp;</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td class="label">Interest on <br/>mobilization Advance (Rs.)</td>
										<td colspan="3">
											<input type="text" class="textboxdisplay" name="txt_interest_ma" id="txt_interest_ma" style="width:150px" value="<?php //echo $interestma; ?>">
										</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td align="center" class="labeldisplay" id="val_interest_ma" style="color:red" colspan="3">&nbsp;</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td class="label">Other Recoveries</td>
										<td colspan="3">
											<input type="text" class="textboxdisplay" name="txt_other_recovery" id="txt_other_recovery" style="width:150px" value="<?php //echo $otherrecovery; ?>">
										</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td align="center" class="labeldisplay" id="val_other_recovery" style="color:red" colspan="3">&nbsp;</td>
									</tr>-->
								</table>
									<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
										<div class="buttonsection">
											<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
										</div>
										<div class="buttonsection">
											<input type="submit" name="submit" id="submit" value=" Save " />
										</div>
									</div>
                        </blockquote>
                    </div>
                </div>
            </div>
          
</form>
@endsection
