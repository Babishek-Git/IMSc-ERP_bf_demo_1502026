@include('layouts.library.config')
@include('layouts.library.functions')
@include('layouts.library.binddata')
@include('layouts.library.common')
@include('layouts.library.sysdate')
@include('layouts.header')
<body class="page1" id="top">
        <!--==============================header=================================-->
	@include('admin.menu') 
        <!--==============================Content=================================-->
        <div class="content">
            <div class="container_12">
                <div class="grid_12">
                    <blockquote class="bq1">
                        <div class="title">Measurement Book Generate </div>
                        <form name="form" method="post" action="" >
                            <div class="container">
                                <table width="1000"  bgcolor="#E8E8E8" border="0" cellpadding="0" cellspacing="0" align="center" >
                                    <tr><td>&nbsp;</td></tr>
                                    <tr> 
                                        <td width="15%">&nbsp;</td> 
                                        <td  class="label">Date</td>
                                        <td><input type="text" name="txt_date" readonly="" id="txt_date" class="textboxdisplay" value="" size="15"/></td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr><td>&nbsp;</td></tr>
                                    <tr> 
                                        <td>&nbsp;</td> 
                                        <td  class="label">Work Order No </td>
                                        <td  class="labeldisplay">
                                            <select name="wordorderno" id="wordorderno"  class="textboxdisplay" tabindex="1" onChange="func_mbhead_date(); func_GenerateMBno(0,0);" style="width:405px;height:22px;" tabindex="7">
                                                <option value=""> -- Select Work Order No -- </option>
                                            </select>
										</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr><td>&nbsp;</td><td></td><td colspan="3" id="val_work" style="color:red"></td></tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td  class="label">Name of the Work </td>
                                        <td  class="labeldisplay">
											<textarea name="workname" class="textboxdisplay txtarea_style" id="workname" rows="5" style="width: 402px;" disabled="disabled"></textarea>
										</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                    <tr> 
                                        <td>&nbsp;</td>
                                        <td  class="label">Measurement Type</td>
                                        <td  class="label">
											<!--<input type="radio" name="rad_measurementtype" id="rad_steel" tabindex="2" value="S" onClick="">Steel&nbsp;&nbsp;&nbsp;
											<input type="radio" name="rad_measurementtype" id="rad_others" tabindex="3" value="G">General</td>-->
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr> 
                                        <td>&nbsp;</td>
                                        <td  class="label">&nbsp;</td>
                                        <td  class="labeldisplay" id="val_rad" style="color:red">&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr> 
                                        <td>&nbsp;</td> 
                                        <td  class="label">From Date </td>
                                        <td  class="labeldisplay">
										<input type="text" name="txt_fromdate" id="txt_fromdate" tabindex="4" class="textboxdisplay" value="" onChange="return ValidateForm('txt_fromdate');" size="15"/>
										<span id="check_date" style="color:red;"></span>
                                            </td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr><td>&nbsp;</td></tr>
                                    <tr> 
                                        <td>&nbsp;</td> 
                                        <td  class="label">To Date </td>

                                        <td  class="labeldisplay">
										<input type="text" name="txt_todate" id="txt_todate" tabindex="5" class="textboxdisplay" value="" onChange="return ValidateForm('txt_todate');" size="15"/>
										<span id="date_format" style="color:red;"></span>								
                                            </td>
                                         <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr> 
                                        <td>&nbsp;</td>
                                        <td  class="label">&nbsp;</td>
                                        <td  class="labeldisplay" id="val_date" style="color:red">&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                	<tr> 
                                        <td>&nbsp;</td> 
                                        <td  class="label">Measurement Book  No</td>
                                        <td  class="labeldisplay">
											<select name="currentmbookno" id="currentmbookno" class="textboxdisplay" tabindex="6" style="width:130px;height:22px;" tabindex="7" onChange="func_GenerateAbstractMBno(); findabstarctmbbokno();">
                                                <option value="0" selected="selected"> ----- Select ----- </option>
                                            </select>
                                            <font class="label">&nbsp;&nbsp;&nbsp;MBook Page &nbsp;&emsp;&nbsp;&nbsp;</font>&nbsp;
                                            <input type="hidden" name="currentmbook" id="currentmbook" />
											<input type="text" name="bookpageno1" id="bookpageno1" class="textboxdisplay"  size="15"/>
                                            <input type="hidden" name="bookpageno" id="bookpageno" />
                                            <input type="hidden" name="count" id="count" />
											
                                        </td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                <tr><td>&nbsp;</td><td></td><td id="val_mbook" style="color:red"></td></tr>
                                    <tr> 
                                        <td>&nbsp;</td> 
                                        <td  class="label">Abstract MBook No. </td>

                                        <td  class="labeldisplay">
											
											<select name="currentmbookno_abs" id="currentmbookno_abs" tabindex="7" class="textboxdisplay" style="width:130px;height:22px;" tabindex="7">
                                                <option value="0" selected="selected"> ----- Select ----- </option>
                                            </select>
											<font class="label">&nbsp;&nbsp;&nbsp;Abs MBook Page</font>&nbsp;
											<input type="hidden" name="currentmbook_abs" id="currentmbook_abs" />
											<input type="text" name="bookpageno_abs_1" id="bookpageno_abs_1" class="textboxdisplay"  size="15"/>
											<input type="hidden" name="bookpageno_abs" id="bookpageno_abs" />
											<!--<input type="hidden" name="count_abs" id="count_abs" />-->
											<!--<input type="hidden" name="hid_prev_abstmbno" id="hid_prev_abstmbno" value=""/>-->
                                        </td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr><td>&nbsp;</td></tr>
                                    <tr> 
                                        <td>&nbsp;</td> 
                                        <td  class="label">Running Account Bill No </td>

                                        <td  class="labeldisplay">
										<input type="text" name="rbnno" id="rbnno" tabindex="8" class="textboxdisplay" size="15" tabindex="5" onBlur="func_check_rbn();"/>
										
                                           <!-- <input type="hidden" name="rbnno" id="rbnno" />-->
                                        </td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>

                                    <tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td><span id="rbn_error" style="color:red; font-weight:bold"></span></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr><td>&nbsp;</td></tr>
                                    <tr>
                                        <td colspan="6">
											<center>
												<input type="hidden" class="text" name="submit" tabindex="9" value="true" />
											<!--<input type="submit" class="btn" data-type="submit" value="submit" />-->
												<input type="submit" class="btn" data-type="submit" value="Generate" name="btn_generate" id="btn_generate" />&nbsp;&nbsp;&nbsp;&nbsp;
												<input type="submit" class="btn" data-type="submit" value="Excel Format" name="xcel" id="xcel"   style="display: none;" />
											</center>	    
										</td>
                                    </tr>
                                    <tr><td></td></tr>
                                </table>
								<input type="hidden" name="hid_maxdate" id="hid_maxdate" >
                            </div>
                            <div class="col2">
						</div>   
                    </blockquote>
                                <!-- <div class="container">
                                    <div id="content">
                                        <div class="post"><div class="btn-sign"><h2><a href="#login-box" class="login-window"></a></h2></div></div>
                                        <div id="login-box" class="login-popup">
                                            <a href="#" class="close"><img src="images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
                                            <fieldset class="textbox">
                                                <label class="username">
                                                    <span> New Mbook No :</span>
                                                    <input id="mbnovalue" name="mbnovalue" type="text" autocomplete="on" placeholder="MBookNo">
                                                </label><br/>
                                                <input type="submit" class="btn" data-type="submit" name="btn_Update" id="btn_Update" value="Update" />
                                            </fieldset>
                                        </div>

                                    </div>
                                </div>-->
                    </form>
                </div>
            </div>
        </div>
         <!--==============================footer=================================-->
		@include('layouts.footer')
    </body>
</html>

