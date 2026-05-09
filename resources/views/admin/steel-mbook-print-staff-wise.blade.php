@include('layouts.library.config')
@include('layouts.library.functions')
@include('layouts.library.binddata')
@include('layouts.library.common')
@include('layouts.library.declaration')
@include('layouts.library.sysdate')
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Steel M.Book</title>
        <link rel="stylesheet" href="script/font.css" />
    </head>
	<input type="hidden" name="hid_staffid" id="hid_staffid" value="" />
	<input type="hidden" name="hid_sheetid" id="hid_sheetid" value="" />
	<input type="hidden" name="hid_userid" id="hid_userid" value="" />
	<input type="hidden" name="txt_steelmbno_id" value="" id="txt_steelmbno_id" />
        <table width="1087px" border="0" cellpadding="3" cellspacing="3" align="center" bgcolor='#FFFFFF' class="label">
			<div id="dialog" title="Choose MBook No." style=" background-color:#f9f8f6;font-size: 12px;">
			<p style="font-size:12px; font-weight:bold; color:#911200;">Select Next MBook Number</p>
				<select id="newmbooklist" name="mb" style="width:275px;">
					<option value="">---------------------Select--------------------</option>
				</select>
				<br/>
				<span id="error_msg" style="color:#FF0000; font-weight:bold;"></span>
				<input type="button" class="submit_btn" id="btn" style="color:#FFFFFF;background-color:#9c27b0;border:none;" name="btn" value="Submit"/>
				<input type="button" class="cancel_btn" id="btn_cancel" style="color:#FFFFFF;background-color:#e51c23;border:none;" name="btn_cancel" value="Cancel"/></div>						
					<tr height=''>
						<td width='' colspan="7" class='labelbold' style='text-align:right'></td>
						<td width='' class='labelbold' style="text-align:right"></td>
						<td width='' class='labelbold' style="text-align:right"></td>
						<td width='' class='labelbold' style="text-align:right"></td>
						<td width='' class='labelbold' style="text-align:right"></td>
						<td width='' class='labelbold' style="text-align:right"></td>
						<td width='' class='labelbold' style="text-align:right"></td>
						<td width='' class='labelbold' style="text-align:right"></td>
						<td width='' class='labelbold' style="text-align:right"></td>
						<td width='' class='labelbold' style="text-align:right"></td>
						<td width='' class='labelbold'></td>
                	</tr>
                     <tr height=''>
                        <td width='' class='labelcenter'></td>
                        <td width='' class='labelcenter'></td>
                        <td width='' colspan="15" class='labelcenter' style="text-align:left;"></td>
                    </tr>
					<tr height=''>
						<td width='' class='labelcenter'></td>
						<td width='' class='labelcenter' bgcolor=""></td>
						<td width='' colspan="4" class='labelcenter' style='text-align:right'>
							<input type="text" class="labelbold" name="txt_pageid" readonly="" id="txt_pageid" style="width:100%; text-align:right; border:none;" />
						</td>
						<td width='' class='labelcenter'></td>
						<td width='' class='labelcenter' style="text-align:right"></td>
                    <td width='' class='labelcenter' style="text-align:right"></td>
                    <td width='' class='labelcenter' style="text-align:right"></td>
                    <td width='' class='labelcenter' style="text-align:right"></td>
                    <td width='' class='labelcenter' style="text-align:right"></td>
                    <td width='' class='labelcenter' style="text-align:right"></td>
                    <td width='' class='labelcenter' style="text-align:right"></td>
                    <td width='' class='labelcenter' style="text-align:right"></td>
					<td width='' class='labelcenter' style="text-align:right"></td>
                    <td width='' class='labelcenter'></td>
                </tr>
                <tr height='' style="border:none;" class="label" align="right"><td colspan="16" style="border:none;"><br/>&nbsp;&nbsp;</td></tr>
				<tr height='' style="border:none;" class="label" align="right">
					<td colspan="5" style="border:none;">&nbsp;&nbsp;</td>
					<td colspan="6" style="border:none;">Checked By&nbsp;&nbsp;</td>
					<td colspan="6" style="border:none;">Prepared By&nbsp;&nbsp;</td>
				</tr>
                <tr height=''>
                    <td width='8%' class='labelcenter'></td>
                    <td width='' class='labelcenter'></td>
                    <td width='' colspan="15" class='labelcenter' style="text-align:left;"></td>
                </tr>
                <tr height=''>
                    <td width='8%' class=''></td>
                    <td width='4%' class=''></td>
                <!--<td width='12%' class='' style="text-align:left;" nowrap="nowrap"></td>-->
					<td width='12%' class='' style="text-align:left;"></td>
                    <td width='3%' class='' style="text-align:right"></td>
                    <td width='3%' class='' style="text-align:right"></td>
                    <td width='3%' class='' style="text-align:right"></td>
                    <td width='4%' class='' style="text-align:right"></td>
					<td width='7%' class='' style="text-align:right"></td>
					<td width='7%' class=''></td> 
					<td width='7%' class='' style="text-align:right"></td>   
					<td width='7%' class=''></td>            
					<td width='7%' class='' style="text-align:right"></td>
					<td width='7%' class=''></td>        
					<td width='7%' class='' style="text-align:right"></td>
					<td width='7%' class=''></td>   
					<td width='7%' class='' style="text-align:right"></td>
					<td width='7%' class=''></td>      
					<td width='7%' class='' style="text-align:right"></td>     
					<td width='7%' class=''></td> 
					<td width='7%' class='' style="text-align:right"></td>    
					<td width='7%' class=''></td>  
					<td width='7%' class='' style="text-align:right"></td>
					<td width='7%' class=''></td>
					<td width='6%' class='' style="text-align:right"></td>            
					<td width='6%' class=''></td> 	                
                    <td width='2%' class='labelcenter'></td>
                </tr>
				<tr height=''>
                    <td width='' colspan="7" class='labelbold' style='text-align:right'></td>
                    <td width='' class='labelbold' style="text-align:right"></td>
                    <td width='' class='labelbold' style="text-align:right"></td>
                    <td width='' class='labelbold' style="text-align:right"></td>
                    <td width='' class='labelbold' style="text-align:right"></td>
                    <td width='' class='labelbold' style="text-align:right"></td>
                    <td width='' class='labelbold' style="text-align:right"></td>
                    <td width='' class='labelbold' style="text-align:right"></td>
                    <td width='' class='labelbold' style="text-align:right"></td>
					<td width='' class='labelbold' style="text-align:right"></td>
                    <td width='' class='labelbold'></td>
                </tr>	
                <tr height=''>
                    <td width='' class='labelcenter'></td>
                    <td width='' class='labelcenter' bgcolor=""></td>
                    <td width='' colspan="5" class='labelbold' style='text-align:right'>
					<input type="text" name="txt_pageid" class="labelbold" readonly="" id="txt_pageid" style="width:100%; text-align:right; border:none;" />
					</td>
                    <!--<td width='' class='labelcenter'></td>-->
                    <td width='' class='labelbold' style="text-align:right"></td>
                    <td width='' class='labelbold' style="text-align:right"></td>
                    <td width='' class='labelbold' style="text-align:right"></td>
                    <td width='' class='labelbold' style="text-align:right"></td>
                    <td width='' class='labelbold' style="text-align:right"></td>
                    <td width='' class='labelbold' style="text-align:right"></td>
                    <td width='' class='labelbold' style="text-align:right"></td>
                    <td width='' class='labelbold' style="text-align:right"></td>
					<td width='' class='labelbold' style="text-align:right"></td>
                    <td width='' class='labelbold'></td>
                </tr>
				<tr height='' style="border:none;" class="label" align="right"><td colspan="16" style="border:none;"><br/></td></tr>
				<tr height='' style="border:none;" class="label" align="right">
					<td colspan="5" style="border:none;">&nbsp;&nbsp;</td>
					<td colspan="6" style="border:none;">Checked By&nbsp;&nbsp;</td>
					<td colspan="6" style="border:none;">Prepared By&nbsp;&nbsp;</td>
				</tr>
				<tr height='25px'><td colspan="17" align="center" class="labelbold"></td></tr>
				<tr height='' bgcolor="">
                    <td width='' class='labelcenter'></td>
                    <td width='' class='labelcenter'></td>
                    <td width='' colspan="4" align="right" class='label labelbold'>Total</td>
                    <td width='' class='labelcenter labelheadblue'></td>
                    <td width='' class='labelcenter labelbold' style="text-align:right"></td>
                    <td width='' class='labelcenter labelbold' style="text-align:right">each</td>
                    <td width='' class='labelcenter labelbold' style="text-align:right" colspan="7"></td>
                    <td width='' class='labelcenter'></td>
                </tr>	
				<!--<tr height='' bgcolor="">
                   <td width='' class='labelcenter'></td>
                   <td width='' class='labelcenter'></td>
                   <td width='' colspan="3" class='labelcenter labelheadblue'>Total</td>
                   <td width='' colspan="10" class='labelcenter labelheadblue'></td>
                </tr>-->
				<tr height=''>
                    <td width='' class='labelcenter'></td>
                    <td width='' class='labelcenter'></td>
                    <td width='' colspan="4" class='labelcenter'>Sub Total</td>
                    <td width='' class='labelcenter'></td>
                    <td width='' class='labelcenter' style="text-align:right"></td>
                    <td width='' class='labelcenter' style="text-align:right"></td>
                    <td width='' class='labelcenter' style="text-align:right"></td>
                    <td width='' class='labelcenter' style="text-align:right"></td>
                    <td width='' class='labelcenter' style="text-align:right"></td>
                    <td width='' class='labelcenter' style="text-align:right"></td>
                    <td width='' class='labelcenter' style="text-align:right"></td>
                    <td width='' class='labelcenter' style="text-align:right"></td>
					<td width='' class='labelcenter' style="text-align:right"></td>
                    <td width='' class='labelcenter'></td>
                </tr>
				<!--<tr>
					<td width='' class='labelcenter'></td>
                    <td width='' class='labelcenter'></td>
                    <td width='' colspan="7" align="right" class='label labelheadblue'></td>
                    <td width='' class='labelcenter labelheadblue' style="text-align:right"></td>
                    <td width='' class='labelcenter labelheadblue' style="text-align:right"></td>
                    <td width='' class='labelcenter labelheadblue' style="text-align:right"></td>
                    <td width='' class='labelcenter labelheadblue' style="text-align:right"></td>
                    <td width='' class='labelcenter labelheadblue' style="text-align:right"></td>
					<td width='' class='labelcenter labelheadblue' style="text-align:right"></td>
                    <td width='' class='labelcenter'></td>
				</tr>-->
				<tr height='' bgcolor="">
                    <td width='' class='labelcenter'></td>
                    <td width='' class='labelcenter'></td>
                    <td width='' colspan="4" class='labelcenter'>Unit Weight</td>
                    <td width='' class='labelcenter'></td>
                    <td width='' class='labelcenter' style="text-align:right">0.395</td>
                    <td width='' class='labelcenter' style="text-align:right">0.617</td>
                    <td width='' class='labelcenter' style="text-align:right">0.888</td>
                    <td width='' class='labelcenter' style="text-align:right">1.58</td>
                    <td width='' class='labelcenter' style="text-align:right">2.47</td>
                    <td width='' class='labelcenter' style="text-align:right">3.85</td>
                    <td width='' class='labelcenter' style="text-align:right">4.83</td>
                    <td width='' class='labelcenter' style="text-align:right">6.31</td>
					<td width='' class='labelcenter' style="text-align:right">7.990</td>
                    <td width='' class='labelcenter'></td>
                </tr>	
				<tr height='' bgcolor="">
                    <td width='' class='labelcenter'></td>
                    <td width='' class='labelcenter'></td>
                    <td width='' colspan="4" class='labelcenter'>Total Weight</td>
                    <td width='' class='labelcenter'></td>
                    <td width='' class='labelcenter' style="text-align:right"></td>
                    <td width='' class='labelcenter' style="text-align:right"></td>
                    <td width='' class='labelcenter' style="text-align:right"></td>
                    <td width='' class='labelcenter' style="text-align:right"></td>
                    <td width='' class='labelcenter' style="text-align:right"></td>
                    <td width='' class='labelcenter' style="text-align:right"></td>
                    <td width='' class='labelcenter' style="text-align:right"></td>
                    <td width='' class='labelcenter' style="text-align:right"></td>
					<td width='' class='labelcenter' style="text-align:right"></td>
                    <td width='' class='labelcenter'></td>
                </tr>
				<tr height='' bgcolor="">
                   <td width='' class='labelcenter'></td>
                   <td width='' class='labelcenter'></td>
                   <td width='' colspan="4" class='labelcenter'>Total in kgs</td>
                   <td width='' colspan="5" class='labelcenter'></td>
                   <td width='' colspan="6" class='labelcenter'></td>
				   
                </tr>
				<tr height=''>
                   <td width='' class='labelcenter'></td>
                   <td width='' class='labelcenter'></td>
                   <td width='' colspan="4" align="right" class='labelbold'>Total in MT</td>
                   <td width='' colspan="5" align="center" class='labelbold'></td>
                   <td width='' colspan="6" class='labelbold' style='text-align:right'></td>
				   
                </tr>	
				<tr height=''>
                    <td width='8%' class='labelcenter'></td>
                    <td width='4%' class='labelcenter' bgcolor=""></td>
                    <td width='15%' class='labelcenter' colspan="4"></td>
					<td width='3%' class='labelcenter'></td>
                    <td width='7%' class='labelcenter' style="text-align:right">
					</td>
                    <td width='7%' class='labelcenter' style="text-align:right"></td>
                    <td width='7%' class='labelcenter' style="text-align:right"></td>
                    <td width='7%' class='labelcenter' style="text-align:right"></td>
                    <td width='7%' class='labelcenter' style="text-align:right"></td>
                    <td width='7%' class='labelcenter' style="text-align:right"></td>
                    <td width='7%' class='labelcenter' style="text-align:right"></td>
                    <td width='7%' class='labelcenter' style="text-align:right"></td>
					<td width='6%' class='labelcenter' style="text-align:right"></td>
                    <td width='2%' class='labelcenter'></td>
                </tr>
				<tr height='' bgcolor="">
					<td width='' colspan="7" class='labelbold' style="text-align:right">C/o to page /Steel MB No./Steel MB No.</td>
					<td width='7%' class='labelbold' style="text-align:right"></td>
					<td width='7%' class='labelbold' style="text-align:right"></td>
					<td width='7%' class='labelbold' style="text-align:right"></td>
					<td width='7%' class='labelbold' style="text-align:right"></td>
					<td width='7%' class='labelbold' style="text-align:right"></td>
					<td width='7%' class='labelbold' style="text-align:right"></td>
					<td width='7%' class='labelbold' style="text-align:right"></td>
					<td width='7%' class='labelbold' style="text-align:right"></td>
					<td width='6%' class='labelbold' style="text-align:right"></td>
					<td width='' class='labelbold'></td>
				</tr>
				<tr height='' bgcolor="">
					<td width='' colspan="7" class='labelbold' style="text-align:right">B/f from page Steel MB No./Steel MB No.</td>
					<td width='7%' class='labelbold' style="text-align:right"> </td>
					<td width='7%' class='labelbold' style="text-align:right"></td>
					<td width='7%' class='labelbold' style="text-align:right"></td>
					<td width='7%' class='labelbold' style="text-align:right"></td>
					<td width='7%' class='labelbold' style="text-align:right"></td>
					<td width='7%' class='labelbold' style="text-align:right"></td>
					<td width='7%' class='labelbold' style="text-align:right"></td>
					<td width='7%' class='labelbold' style="text-align:right"></td>
					<td width='6%' class='labelbold' style="text-align:right"></td>
					<td width='' class='labelbold'>&nbsp;</td>
				</tr>
				<tr height='' bgcolor="">
                    <td width='' class='labelcenter'></td>
                    <td width='' class='labelcenter'></td>
                    <td width='' colspan="4" align="right" class='label labelbold'>Total</td>
                    <td width='' class='labelcenter labelheadblue'></td>
                    <td width='' class='labelcenter labelbold' style="text-align:right"></td>
                    <td width='' class='labelcenter labelbold' style="text-align:right">each</td>
                    <td width='' class='labelcenter labelbold' style="text-align:right" colspan="7"></td>
                    <td width='' class='labelcenter'></td>
                </tr>
				<!--<tr height='' bgcolor="">
                   <td width='' class='labelcenter'></td>
                   <td width='' class='labelcenter'></td>
                   <td width='' colspan="3" class='labelcenter labelheadblue'>Total</td>
                   <td width='' colspan="10" class='labelcenter labelheadblue'></td>
                </tr>-->
				<tr height=''>
                    <td width='' class='labelcenter'></td>
                    <td width='' class='labelcenter'></td>
                    <td width='' colspan="4" class='labelcenter'>Sub Total</td>
                    <td width='' class='labelcenter'></td>
                    <td width='' class='labelcenter' style="text-align:right"></td>
                    <td width='' class='labelcenter' style="text-align:right"></td>
                    <td width='' class='labelcenter' style="text-align:right"></td>
                    <td width='' class='labelcenter' style="text-align:right"></td>
                    <td width='' class='labelcenter' style="text-align:right"></td>
                    <td width='' class='labelcenter' style="text-align:right"></td>
                    <td width='' class='labelcenter' style="text-align:right"></td>
                    <td width='' class='labelcenter' style="text-align:right"></td>
					<td width='' class='labelcenter' style="text-align:right"></td>
                    <td width='' class='labelcenter'></td>
                </tr>
				<!--<tr>
					<td width='' class='labelcenter'></td>
                    <td width='' class='labelcenter'></td>
                    <td width='' colspan="7" align="right" class='label labelheadblue'></td>
                    <td width='' class='labelcenter labelheadblue' style="text-align:right"></td>
                    <td width='' class='labelcenter labelheadblue' style="text-align:right"></td>
                    <td width='' class='labelcenter labelheadblue' style="text-align:right"></td>
                    <td width='' class='labelcenter labelheadblue' style="text-align:right"></td>
                    <td width='' class='labelcenter labelheadblue' style="text-align:right"></td>
					<td width='' class='labelcenter labelheadblue' style="text-align:right"></td>
                    <td width='' class='labelcenter'></td>
				</tr>-->
				<tr height='' bgcolor="">
                    <td width='' class='labelcenter'></td>
                    <td width='' class='labelcenter'></td>
                    <td width='' colspan="4" class='labelcenter'>Unit Weight</td>
                    <td width='' class='labelcenter'></td>
                    <td width='' class='labelcenter' style="text-align:right">0.395</td>
                    <td width='' class='labelcenter' style="text-align:right">0.617</td>
                    <td width='' class='labelcenter' style="text-align:right">0.888</td>
                    <td width='' class='labelcenter' style="text-align:right">1.58</td>
                    <td width='' class='labelcenter' style="text-align:right">2.47</td>
                    <td width='' class='labelcenter' style="text-align:right">3.85</td>
                    <td width='' class='labelcenter' style="text-align:right">4.83</td>
                    <td width='' class='labelcenter' style="text-align:right">6.31</td>
					<td width='' class='labelcenter' style="text-align:right">7.990</td>
                    <td width='' class='labelcenter'></td>
                </tr>
				<tr height='' bgcolor="">
                    <td width='' class='labelcenter'></td>
                    <td width='' class='labelcenter'></td>
                    <td width='' colspan="4" class='labelcenter'>Total Weight</td>
                    <td width='' class='labelcenter'></td>
                    <td width='' class='labelcenter' style="text-align:right"></td>
                    <td width='' class='labelcenter' style="text-align:right"></td>
                    <td width='' class='labelcenter' style="text-align:right"></td>
                    <td width='' class='labelcenter' style="text-align:right"></td>
                    <td width='' class='labelcenter' style="text-align:right"></td>
                    <td width='' class='labelcenter' style="text-align:right"></td>
                    <td width='' class='labelcenter' style="text-align:right"></td>
                    <td width='' class='labelcenter' style="text-align:right"></td>
					<td width='' class='labelcenter' style="text-align:right"></td>
                    <td width='' class='labelcenter'></td>
                </tr>
				<tr height='' bgcolor="">
                   <td width='' class='labelcenter'></td>
                   <td width='' class='labelcenter'></td>
                   <td width='' colspan="4" class='labelcenter'>Total in kgs</td>
                   <td width='' colspan="5" class='labelcenter'></td>
                   <td width='' colspan="6" class='labelcenter'></td>
				   
                </tr>
				<tr height=''>
                   <td width='' class='labelcenter'></td>
                   <td width='' class='labelcenter'></td>
                   <td width='' colspan="4" align="right" class='labelbold'>Total in MT</td>
                   <td width='' colspan="5" align="center" class='labelbold'></td>
                   <td width='' colspan="6" class='labelbold' style='text-align:right'></td>
				   
                </tr>	
			<!--<tr style="border-style:none;">
					<td style="border-style:none;" colspan="8" align="right" class="label"></td>
					<td style="border-style:none;" colspan="7" align="center" class="label"></td>
				</tr>-->
				<tr style="border-style:none;">
					<td style="border-style:none;" colspan="9" align="right" class="label"></td>
					<td style="border-style:none;" colspan="8" align="center" class="label"></td>
				</tr>
			   </table>
			   <input type="hidden" name="txt_boxid_str" id="txt_boxid_str" value=""  />
			  <!-- <div class="divFooter">UNCLASSIFIED</div>-->
			 <!--<hr />-->
           <!-- <table align="center" style="border:none;" class="printbutton">
                <tr style="border:none">
                   <td align="center" colspan="15" style="border:none;"><br/><input type="submit" name="back" value=" Back "/></td>
                </tr>
            </table>-->
			<div align="center" class="btn_outside_sect printbutton">
				<div class="btn_inside_sect"><input type="submit" name="back" value=" Back " /> </div>
				<div class="btn_inside_sect"><input type="button" class="backbutton" name="print" value=" Print " onclick="printBook();" /></div>
			</div>
		</form>
    </body>
</html>