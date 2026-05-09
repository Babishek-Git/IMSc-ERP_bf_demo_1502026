@include('layouts.library.config')
@include('layouts.library.functions') 
@include('layouts.library.binddata')
@include('layouts.header')
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
<!--==============================header=================================-->
	@include('admin.menu')
<!--==============================Content=================================-->
	<div class="content">
		<div class="title">Abstract  Generate </div>
		<div class="container_12">
			<div class="grid_12">
				<blockquote class="bq1" style="overflow:scroll">
					<form name="form" method="post">
						<div class="container">
							<table width="100%"  bgcolor="#E8E8E8" border="0" cellpadding="0" cellspacing="0" align="center" >
							<tr><td style=" width: 24%">&nbsp;</td></tr>
							<tr> 
								<td>&nbsp;</td> 
								<td  class="label">Date</td>
								<td><input type="text" readonly="" name="txt_date" id="txt_date" class="textboxdisplay" value="<?php //echo date('d/m/y') ?>" size="15"/>				              
								</td>
								<td></td>
								<td>&nbsp;</td>
							</tr>
							<tr><td>&nbsp;</td></tr>
							<tr> 
								<td>&nbsp;</td> 
								<td  class="label">Work Short Name</td>
								<td  class="labeldisplay">
									<select name="cmb_work_no" id="cmb_work_no" onChange="find_workname(); func_AbsGenerateMBno(); func_abshead_date();findabstarctmbbokno();" class="textboxdisplay" style="width:400px;height:22px;" tabindex="7">
										<option value="">---------------------- Select ---------------------</option>
									</select>
								</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							<tr><td>&nbsp;</td><td></td><td colspan="3" id="val_work" style="color:red"></td></tr>
							<tr>
								<td>&nbsp;</td>
								<td  class="label">Work Order No.</td>
								<td  class="labeldisplay">
									<input type="text" name="txt_workorder_no" id="txt_workorder_no" class="textboxdisplay" style="width: 395px;" readonly="">
								</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
							<tr>
								<td>&nbsp;</td>
								<td  class="label">Name of the Work </td>
								<td  class="labeldisplay"><textarea name="workname" class="textboxdisplay txtarea_style" style="width: 398px;" rows="5" disabled="disabled"></textarea></td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td  class="label">&nbsp;</td>
								<td  class="labeldisplay">&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							<tr> 
								<td>&nbsp;</td> 
								<td  class="label">From Date </td>
								<td  class="labeldisplay"><input type="text" name="txt_fromdate" readonly="" id="txt_fromdate" class="textboxdisplay" value="" size="15"/>
								</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td><span id="generate_error" style="color:red; font-weight:bold"></span></td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							<tr> 
								<td>&nbsp;</td> 
								<td  class="label">To Date </td>
								<td  class="labeldisplay"><input type="text" name="txt_todate" readonly="" id="txt_todate" class="textboxdisplay" value="" size="15"/>
								</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							<tr><td>&nbsp;</td></tr>
							<tr> 
								<td>&nbsp;</td> 
								<td  class="label">Abstract MBook  No</td>
								<td  class="labeldisplay">
							<!-- <select name="currentmbookno" id="currentmbookno" class="textboxdisplay" style="width:400px;height:22px;" tabindex="7">
								<option value="0"> -- Select MBook No -- </option>
							</select>-->                                  
								<input type="text" name="currentmbook" id="currentmbook" class="textboxdisplay" size="54" readonly=""/>
							</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr><td>&nbsp;</td><td></td><td id="val_mbook" style="color:red"></td></tr>
						<tr> 
							<td>&nbsp;</td> 
							<td  class="label">Abstract MBook Page </td>
							<td  class="labeldisplay">
								<input type="text" name="bookpageno1" id="bookpageno1"  class="textboxdisplay"  size="54" tabindex="5" readonly=""/>
								<input type="hidden" name="absmbookid" id="absmbookid" />
								<input type="hidden" name="bookpageno" id="bookpageno" />
								<input type="hidden" name="count" id="count" />
							</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr><td>&nbsp;</td></tr>
						<tr> 
							<td>&nbsp;</td> 
							<td  class="label">Running Account Bill No. </td>
							<td  class="labeldisplay">
								<input type="text" name="txt_rbn_no" id="txt_rbn_no"  class="textboxdisplay"  size="54" tabindex="5" readonly=""/>
							</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr><td>&nbsp;</td></tr>
					<!-- <tr>
							<td>&nbsp;</td>
							<td  class="label">Payment Percentage</td>
							<td  class="labeldisplay">
								<input type="text" name="txt_paymentpercent" id="txt_paymentpercent" maxlength="2" class="textboxdisplay" size="3" value="100"> <label class="label">( % )</label>
							</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr><td>&nbsp;</td><td></td><td id="val_work" style="color:red"></td></tr>-->
						<tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr>
						<tr>
							<td colspan="6">
							<center>
								<input type="hidden" class="text" name="submit" value="true" />
							<!-- <input type="submit" class="btn" data-type="submit" value="Generate" name="html" id="generate_html"   />&nbsp;&nbsp;&nbsp;
								<input type="submit" class="btn"   data-type="submit" value="Excel Format" name="xcel" id="xcel"  style="display: none;" /> 
								<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>-->
							</center>	    </td>
						<!--  style="display: none;"-->
						</tr>
					</table>
				</div>
				<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
				<div class="buttonsection">
					<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
				</div>
				<div class="buttonsection" style="width:105px">
					<input type="submit" class="btn" data-type="submit" value="Generate" name="html" id="generate_html"   />
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
