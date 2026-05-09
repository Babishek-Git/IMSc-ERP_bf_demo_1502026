@extends('layouts.dashboard-master')
	
@section('content')
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
   <form action="" method="post" enctype="multipart/form-data" name="form">
            <div class="content">
              <div class="title">Generate - General Recoveries</div>
                <div class="container_12">
                    <div class="grid_12">
						<!--<div align="right"><a href="View_Other_recovery_generate_Bill.php">View</a>&nbsp;&nbsp;&nbsp;</div>-->
                        <blockquote class="bq1" style="overflow-y:scroll;">
							<input type="hidden" name="hid_sheetid" id="hid_sheetid" value="">
						<div>
                        <table width="1040px" border="0" align="center" cellpadding="0" cellspacing="0" class="color1">
                                <tr><td width="18%">&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Work Short Name</td> 
                                    <td>
										<select name="cmb_shortname" id="cmb_shortname" class="textboxdisplay" style="width:465px" onChange="workorderdetail();getabstractamount();">
											<option value="">----------------------- Select Work Short Name ------------------------</option>
										</select>
									</td>
                                </tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="val_shortname" style="color:red" colspan="">&nbsp;</td></tr>
                                
								<!--<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Name of Work</td>
                                    <td><textarea name='txt_workname' id='txt_workname' class="textboxdisplay" rows="6" style="width: 465px;"></textarea></td>
                                </tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_wname" style="color:red" colspan="">&nbsp;</td></tr>-->
                                
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Work Order No.</td>
                                    <td><input type="text" name='txt_workorder' id='txt_workorder' readonly="" class="textboxdisplay" value="" style="width: 465px;"></td>
                                </tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_workorder" style="color:red" colspan="">&nbsp;</td></tr>
								
								<!--<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Electricity Bill No.</td>
                                    <td><input type="text" name='txt_billno' id='txt_billno' class="textboxdisplay" value="" style="width: 465px;"></td>
                                </tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_billno" style="color:red" colspan="">&nbsp;</td></tr>
								
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Meter No.</td>
                                    <td><input type="text" name='txt_meterno' id='txt_meterno' class="textboxdisplay" value="" style="width: 465px;"></td>
                                </tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_meterno" style="color:red" colspan="">&nbsp;</td></tr>-->
								
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Abstract Net Amount (Rs)</td>
                                    <td>
										<input type="text" name='txt_abstract_amt' id='txt_abstract_amt' readonly="" class="textboxdisplay textright" value="" style="width: 120px;">
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;
										<label class="label">RAB No. </label>
										<input type="text" name='txt_rbn' id='txt_rbn' readonly="" class="textboxdisplay textright" value="" style="width: 120px;">
									</td>
                                </tr>
 								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td align="center" class="labeldisplay" id="" style="color:red" colspan="">
									<span id="val_abstract_amt"></span>
									<span id="val_rbn"></span>
									&nbsp;
									</td>
								</tr>		
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Secured Advance (SA) (Rs)</td>
                                    <td>
										<input type="text" name='txt_sec_adv' id='txt_sec_adv' readonly="" class="textboxdisplay textright" value="" style="width: 120px;">
									</td>
                                </tr>
 								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td align="center" class="labeldisplay" id="" style="color:red" colspan="">
									<span id="val_sec_adv"></span>
									&nbsp;
									</td>
								</tr>
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">CGST (Rs.)</td>
                                    <td>
										<input type="text" name='txt_cgst_perc' id='txt_cgst_perc' class="textboxdisplay textright" value="0" style="width: 40px;">
										<label class="label"> % of Net Amount </label>
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="text" name='txt_cgst' id='txt_cgst' readonly="" class="textboxdisplay textright" value="0" style="width: 120px;">
										
										
									</td>
                                </tr>
                                <tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td align="center" class="labeldisplay" id="" style="color:red" colspan="">
									<span id="val_cgst_perc"></span>
									<span id="val_cgst"></span>
									&nbsp;
									</td>
								</tr>
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">SGST (Rs.)</td>
                                    <td>
										<input type="text" name='txt_sgst_perc' id='txt_sgst_perc' class="textboxdisplay textright" value="0" style="width: 40px;">
										<label class="label"> % of Net Amount </label>
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="text" name='txt_sgst' id='txt_sgst' readonly="" class="textboxdisplay textright" value="0" style="width: 120px;">
										
										
									</td>
                                </tr>
                                <tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td align="center" class="labeldisplay" id="" style="color:red" colspan="">
									<span id="val_sgst_perc"></span>
									<span id="val_sgst"></span>
									&nbsp;
									</td>
								</tr>
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Secured Desposit (Rs.)</td>
                                    <td>
										<input type="text" name='txt_sd_perc' id='txt_sd_perc' class="textboxdisplay textright" value="0" style="width: 40px;">
										<label class="label"> % of Net Amount </label>
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="text" name='txt_sd' id='txt_sd' readonly="" class="textboxdisplay textright" value="0" style="width: 120px;">
										
										
									</td>
                                </tr>
                                <tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td align="center" class="labeldisplay" id="" style="color:red" colspan="">
									<span id="val_sd_perc"></span>
									<span id="val_sd"></span>
									&nbsp;
									</td>
								</tr>
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">WCT (Rs.)</td>
                                    <td>
										<input type="text" name='txt_wct_perc' id='txt_wct_perc' class="textboxdisplay textright" value="0" style="width: 40px;">
										<label class="label"> % of Net Amount </label>
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="text" name='txt_wct' id='txt_wct' readonly="" class="textboxdisplay textright" value="0" style="width: 120px;">
									</td>
                                </tr>
                                <tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td align="center" class="labeldisplay" id="" style="color:red" colspan="">
									<span id="val_wct_perc"></span>
									<span id="val_wct"></span>
									&nbsp;
									</td>
								</tr>
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">VAT (Rs.)</td>
                                    <td>
										<input type="text" name='txt_vat_perc' id='txt_vat_perc' class="textboxdisplay textright" value="0" style="width: 40px;">
										<label class="label"> % of Net Amount </label>
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="text" name='txt_vat' id='txt_vat' readonly="" class="textboxdisplay textright" value="0" style="width: 120px;">
									</td>
                                </tr>
                                <tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td align="center" class="labeldisplay" id="" style="color:red" colspan="">
									<span id="val_vat_perc"></span>
									<span id="val_vat"></span>
									&nbsp;
									</td>
								</tr>
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Mobilization Advance (Rs.)</td>
                                    <td>
										<input type="text" name='txt_mob_adv_perc' id='txt_mob_adv_perc' class="textboxdisplay textright" value="0" style="width: 40px;">
										<label class="label"> % of Net Amount </label>
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="text" name='txt_mob_adv' id='txt_mob_adv' readonly="" class="textboxdisplay textright" value="0" style="width: 120px;">
									</td>
                                </tr>
                                 <tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td align="center" class="labeldisplay" id="" style="color:red" colspan="">
									<span id="val_mob_adv_perc"></span>
									<span id="val_mob_adv"></span>
									&nbsp;
									</td>
								</tr>
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Labour Welfare Cess (Rs.)</td>
                                    <td>
										<input type="text" name='txt_lw_cess_perc' id='txt_lw_cess_perc' class="textboxdisplay textright" value="0" style="width: 40px;">
										<label class="label"> % of Net Amount </label>
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="text" name='txt_lw_cess' id='txt_lw_cess' readonly="" class="textboxdisplay textright" value="0" style="width: 120px;">
									</td>
                                </tr>
                                 <tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td align="center" class="labeldisplay" id="" style="color:red" colspan="">
									<span id="val_lw_cess_perc"></span>
									<span id="val_lw_cess"></span>
									&nbsp;
									</td>
								</tr>
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Income Tax (Rs.)</td>
                                    <td>
										<input type="text" name='txt_incometax_perc' id='txt_incometax_perc' class="textboxdisplay textright" value="0" style="width: 40px;">
										<label class="label"> % of ( Net + SA )  </label>
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="text" name='txt_incometax' id='txt_incometax' readonly="" class="textboxdisplay textright" value="0" style="width: 120px;">
									</td>
                                </tr>
                                <tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td align="center" class="labeldisplay" id="" style="color:red" colspan="">
									<span id="val_incometax_perc"></span>
									<span id="val_incometax"></span>
									&nbsp;
									</td>
								</tr>
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">IT Cess (Rs.)</td>
                                    <td>
										<input type="text" name='txt_ITcess_perc' id='txt_ITcess_perc' class="textboxdisplay textright" value="0" style="width: 40px;">
										<label class="label"> % of Income Tax </label>
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="text" name='txt_ITcess' id='txt_ITcess' readonly="" class="textboxdisplay textright" value="0" style="width: 120px;">
									</td>
                                </tr>
                                <tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td align="center" class="labeldisplay" id="" style="color:red" colspan="">
									<span id="val_ITcess_perc"></span>
									<span id="val_ITcess"></span>
									&nbsp;
									</td>
								</tr>
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">IT Educational Cess (Rs.)</td>
                                    <td>
										<input type="text" name='txt_ITEcess_perc' id='txt_ITEcess_perc' class="textboxdisplay textright" value="0" style="width: 40px;">
										<label class="label"> % of Income Tax </label>
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="text" name='txt_ITEcess' id='txt_ITEcess' readonly="" class="textboxdisplay textright" value="0" style="width: 120px;">
									</td>
                                </tr>
                                <tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td align="center" class="labeldisplay" id="" style="color:red" colspan="">
									<span id="val_ITEcess_perc"></span>
									<span id="val_ITEcess"></span>
									&nbsp;
									</td>
								</tr>
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Rent for Land (Rs.)</td>
                                    <td>
										<input type="text" name='txt_rent_land' id='txt_rent_land' class="textboxdisplay textright" value="0" style="width: 120px;">
										&nbsp;&nbsp;&nbsp;&nbsp;
										<!--<input type="text" name='txt_initial' id='txt_initial' class="textboxdisplay" value="" style="width: 40px;">
										<label class="label"> % of Income Tax </label>
										&nbsp;&nbsp;&nbsp;&nbsp;-->
									</td>
                                </tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_rent_land" style="color:red" colspan="">&nbsp;</td></tr>
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Liquidated Damages (Rs.)</td>
                                    <td>
										<input type="text" name='txt_liquid_damage' id='txt_liquid_damage' class="textboxdisplay textright" value="0" style="width: 120px;">
										&nbsp;&nbsp;&nbsp;&nbsp;
										<!--<input type="text" name='txt_initial' id='txt_initial' class="textboxdisplay" value="" style="width: 40px;">
										<label class="label"> % of Income Tax </label>
										&nbsp;&nbsp;&nbsp;&nbsp;-->
									</td>
                                </tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_liquid_damage" style="color:red" colspan="">&nbsp;</td></tr>
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Non Deployment of machineries (Rs.)</td>
                                    <td>
										<input type="text" name='txt_nodep_machine' id='txt_nodep_machine' class="textboxdisplay textright" value="0" style="width: 120px;">
										&nbsp;&nbsp;&nbsp;&nbsp;
										<!--<input type="text" name='txt_initial' id='txt_initial' class="textboxdisplay" value="" style="width: 40px;">
										<label class="label"> % of Income Tax </label>
										&nbsp;&nbsp;&nbsp;&nbsp;-->
									</td>
                                </tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_nodep_machine" style="color:red" colspan="">&nbsp;</td></tr>
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Non Deployment of Manpower (Rs.)</td>
                                    <td>
										<input type="text" name='txt_nodep_mp' id='txt_nodep_mp' class="textboxdisplay textright" value="0" style="width: 120px;">
										&nbsp;&nbsp;&nbsp;&nbsp;
										<!--<input type="text" name='txt_initial' id='txt_initial' class="textboxdisplay" value="" style="width: 40px;">
										<label class="label"> % of Income Tax </label>
										&nbsp;&nbsp;&nbsp;&nbsp;-->
									</td>
                                </tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_nodep_mp" style="color:red" colspan="">&nbsp;</td></tr>
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Non Submission of QA related document (Rs.)</td>
                                    <td>
										<input type="text" name='txt_nonsubmission_qa' id='txt_nonsubmission_qa' class="textboxdisplay textright" value="0" style="width: 120px;">
										&nbsp;&nbsp;&nbsp;&nbsp;
										<!--<input type="text" name='txt_initial' id='txt_initial' class="textboxdisplay" value="" style="width: 40px;">
										<label class="label"> % of Income Tax </label>
										&nbsp;&nbsp;&nbsp;&nbsp;-->
									</td>
                                </tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_nonsubmission_qa" style="color:red" colspan="">&nbsp;</td></tr>
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">
									<input type="text" name="txt_other_recovery_1_desc" id="txt_other_recovery_1_desc" value="Other Recoveries 1" class="textboxdisplay label" style="width:80%"/>
									</td>
                                    <td>
										<input type="text" name='txt_other_recovery_1' id='txt_other_recovery_1' class="textboxdisplay textright" value="0" style="width: 120px;">
										&nbsp;&nbsp;&nbsp;&nbsp;
										<!--<input type="text" name='txt_initial' id='txt_initial' class="textboxdisplay" value="" style="width: 40px;">
										<label class="label"> % of Income Tax </label>
										&nbsp;&nbsp;&nbsp;&nbsp;-->
									</td>
                                </tr>
                                <tr>
									<td>&nbsp;</td>
									<td class="labeldisplay" id="val_other_recovery_1_desc" style="color:red">&nbsp;</td>
									<td align="center" class="labeldisplay" id="val_other_recovery_1" style="color:red" colspan="">&nbsp;</td>
								</tr>
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">
									<input type="text" name="txt_other_recovery_2_desc" id="txt_other_recovery_2_desc" value="Other Recoveries 2" class="textboxdisplay label" style="width:80%"/>
									</td>
                                    <td>
										<input type="text" name='txt_other_recovery_2' id='txt_other_recovery_2' class="textboxdisplay textright" value="0" style="width: 120px;">
										&nbsp;&nbsp;&nbsp;&nbsp;
										<!--<input type="text" name='txt_initial' id='txt_initial' class="textboxdisplay" value="" style="width: 40px;">
										<label class="label"> % of Income Tax </label>
										&nbsp;&nbsp;&nbsp;&nbsp;-->
									</td>
                                </tr>
                                <tr>
									<td>&nbsp;</td>
									<td class="labeldisplay" id="val_other_recovery_2_desc" style="color:red">&nbsp;</td>
									<td align="center" class="labeldisplay" id="val_other_recovery_2" style="color:red" colspan="">&nbsp;</td>
								</tr>
								<!--<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Initial Meter Reading</td>
                                    <td>
										<input type="text" name='txt_initial' id='txt_initial' class="textboxdisplay" value="" style="width: 120px;">
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<label class="label">IMR Date </label>
										&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="text" name='txt_initial_date' id='txt_initial_date' class="textboxdisplay" value="" style="width: 120px;">
									</td>
                                </tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_initial" style="color:red" colspan="">&nbsp;</td></tr>
								
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Final Meter Reading</td>
                                    <td>
										<input type="text" name='txt_final' id='txt_final' class="textboxdisplay" value="" style="width: 120px;">
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<label class="label">FMR Date </label>
										&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="text" name='txt_final_date' id='txt_final_date' class="textboxdisplay" value="" style="width: 120px;">
									</td>
                                </tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_final" style="color:red" colspan="">&nbsp;</td></tr>-->
								
								
								<!--<tr>
									<td>&nbsp;</td>
									<td class="label">Rate of Electricity ( Rs.)</td>
									<td>
										<input type="text" name='txt_rate' id='txt_rate' class="textboxdisplay" value="" style="width: 120px;">
										&nbsp;&nbsp;
										<label class="label"> /&nbsp;unit </label>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<label class="label">Date </label>
										&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="text" name="txt_date" id='txt_date' class="textboxdisplay" style="width: 120px;">
									</td>
								</tr>
								<tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_rate" style="color:red" colspan="">&nbsp;</td></tr>
							
								<tr>
									<td>&nbsp;</td>
									<td class="label">Water Charges (Rs.)</td>
									<td>
										<input type="text" name='txt_rate' id='txt_rate' class="textboxdisplay" value="" style="width: 465px;">
									</td>
								</tr>
								<tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_rate" style="color:red" colspan="">&nbsp;</td></tr>-->
							
							</table>
							</div>	
                            
									<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
										<div class="buttonsection">
										<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
										</div>
										<div class="buttonsection">
											<input type="submit" name="update" id="update" value=" Update "/>
											<input type="submit" name="submit" id="submit" value=" Submit "/>
										</div>
									</div>
                        </blockquote>
                    </div>
                </div>
            </div>
        </form>
    </body>
</html>
@endsection