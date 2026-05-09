@include('layouts.library.config')
@include('layouts.library.functions')  
@include('layouts.library.common')
@include('layouts.header')
    <body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
        <!--==============================header=================================-->
        <form action="" method="post" enctype="multipart/form-data" name="form">
           @include('admin.menu')
            <!--==============================Content=================================-->
            <div class="content">
                <div class="container_12">
                    <div class="grid_12">

						<!--<div align="right"><a href="View_Other_recovery_generate_Bill.php">View</a>&nbsp;&nbsp;&nbsp;</div>-->
                        <blockquote class="bq1">
                            <div class="title">Other Recoveries</div>
							<input type="hidden" name="hid_sheetid" id="hid_sheetid" value="">
						<div style="height:630px; overflow-y:scroll;">
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
                                
                                
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Work Order No.</td>
                                    <td><input type="text" name='txt_workorder' id='txt_workorder' class="textboxdisplay" value="" style="width: 465px;"></td>
                                </tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_workorder" style="color:red" colspan="">&nbsp;</td></tr>
								
								
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Abstract Net Amount (Rs)</td>
                                    <td>
										<input type="text" name='txt_abstract_amt' id='txt_abstract_amt' class="textboxdisplay textright" value="" style="width: 120px;">
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;
										<label class="label">RAB No. </label>
										<input type="text" name='txt_rbn' id='txt_rbn' class="textboxdisplay textright" value="" style="width: 120px;">
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
                                    <td class="label">Secured Desposit (Rs.)</td>
                                    <td>
										<input type="text" name='txt_sd_perc' id='txt_sd_perc' class="textboxdisplay textright" value="" style="width: 40px;">
										<label class="label"> % of Net Amount </label>
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="text" name='txt_sd' id='txt_sd' class="textboxdisplay textright" value="" style="width: 120px;">
										
										
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
										<input type="text" name='txt_wct_perc' id='txt_wct_perc' class="textboxdisplay textright" value="" style="width: 40px;">
										<label class="label"> % of Net Amount </label>
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="text" name='txt_wct' id='txt_wct' class="textboxdisplay textright" value="" style="width: 120px;">
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
										<input type="text" name='txt_vat_perc' id='txt_vat_perc' class="textboxdisplay textright" value="" style="width: 40px;">
										<label class="label"> % of Net Amount </label>
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="text" name='txt_vat' id='txt_vat' class="textboxdisplay textright" value="" style="width: 120px;">
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
										<input type="text" name='txt_mob_adv_perc' id='txt_mob_adv_perc' class="textboxdisplay textright" value="" style="width: 40px;">
										<label class="label"> % of Net Amount </label>
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="text" name='txt_mob_adv' id='txt_mob_adv' class="textboxdisplay textright" value="" style="width: 120px;">
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
										<input type="text" name='txt_lw_cess_perc' id='txt_lw_cess_perc' class="textboxdisplay textright" value="" style="width: 40px;">
										<label class="label"> % of Net Amount </label>
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="text" name='txt_lw_cess' id='txt_lw_cess' class="textboxdisplay textright" value="" style="width: 120px;">
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
										<input type="text" name='txt_incometax_perc' id='txt_incometax_perc' class="textboxdisplay textright" value="" style="width: 40px;">
										<label class="label"> % of Net Amount </label>
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="text" name='txt_incometax' id='txt_incometax' class="textboxdisplay textright" value="" style="width: 120px;">
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
										<input type="text" name='txt_ITcess_perc' id='txt_ITcess_perc' class="textboxdisplay textright" value="" style="width: 40px;">
										<label class="label"> % of Income Tax </label>
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="text" name='txt_ITcess' id='txt_ITcess' class="textboxdisplay textright" value="" style="width: 120px;">
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
										<input type="text" name='txt_ITEcess_perc' id='txt_ITEcess_perc' class="textboxdisplay textright" value="" style="width: 40px;">
										<label class="label"> % of Income Tax </label>
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										&nbsp;&nbsp;&nbsp;&nbsp;
										<input type="text" name='txt_ITEcess' id='txt_ITEcess' class="textboxdisplay textright" value="" style="width: 120px;">
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
										<input type="text" name='txt_rent_land' id='txt_rent_land' class="textboxdisplay textright" value="" style="width: 120px;">
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
										<input type="text" name='txt_liquid_damage' id='txt_liquid_damage' class="textboxdisplay textright" value="" style="width: 120px;">
										&nbsp;&nbsp;&nbsp;&nbsp;
										<!--<input type="text" name='txt_initial' id='txt_initial' class="textboxdisplay" value="" style="width: 40px;">
										<label class="label"> % of Income Tax </label>
										&nbsp;&nbsp;&nbsp;&nbsp;-->
									</td>
                                </tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_liquid_damage" style="color:red" colspan="">&nbsp;</td></tr>
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Other Recoveries (Rs.)</td>
                                    <td>
										<input type="text" name='txt_other_recovery' id='txt_other_recovery' class="textboxdisplay textright" value="" style="width: 120px;">
										&nbsp;&nbsp;&nbsp;&nbsp;
										<!--<input type="text" name='txt_initial' id='txt_initial' class="textboxdisplay" value="" style="width: 40px;">
										<label class="label"> % of Income Tax </label>
										&nbsp;&nbsp;&nbsp;&nbsp;-->
									</td>
                                </tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_other_recovery" style="color:red" colspan="">&nbsp;</td></tr>
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
            <!--==============================footer=================================-->
          @include('layouts.footer')
        </form>
    </body>
</html>
