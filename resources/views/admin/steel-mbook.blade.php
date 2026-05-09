@include('layouts.library.config')
@include('layouts.library.functions')
@include('layouts.library.binddata')
@include('layouts.library.common')
@include('layouts.library.sysdate')
@include('layouts.header')
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Steel M.Book</title>
        <link rel="stylesheet" href="script/font.css" />
    </head>
		<script language="javascript" type="text/javascript" src="script/Date_Calendar.js"></script>
		<script language="javascript" type="text/javascript" src="script/validfn.js"></script>
		<link rel="stylesheet" href="css/button_style.css"></link>
	 	<link rel="stylesheet" href="js/jquery-ui.css">
	  	<script src="js/jquery-1.10.2.js"></script>
	  	<script src="js/jquery-ui.js"></script>
	  	<link rel="stylesheet" href="/resources/demos/style.css">
            <table width="1087px" border="0" cellpadding="3" cellspacing="3" align="center" bgcolor='#FFFFFF'>
				<tr height=''>
                    <td width='' colspan="6" class='labelcenter labelheadblue' style='text-align:right'></td>
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
                 <tr height=''>
                    <td width='' class='labelcenter'></td>
                    <td width='' class='labelcenter'></td>
                    <td width='' colspan="14" class='labelcenter' style="text-align:left;"></td>
                </tr>
                <tr height=''>
                    <td width='' class='labelcenter'></td>
                    <td width='' class='labelcenter' bgcolor=""></td>
                    <td width='' colspan="3" class='labelcenter labelheadblue' style='text-align:right'>
					<input type="text" name="txt_pageid" readonly="" id="txt_pageid" class="textboxcobf" />
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
                 <tr style='border:none' class="label">
					<td style='border:none' colspan='16' align="right"><br/></td>
				</tr>
				<tr style='border:none' class="label"><td style='border:none' colspan='16' align="right">Prepared by&emsp;&emsp;</td></tr>
                <tr height=''>
                    <td width='8%' class='labelcenter'></td>
                    <td width='' class='labelcenter'></td>
                    <td width='' colspan="14" class='labelcenter' style="text-align:left;"></td>
                </tr>
                <tr height=''>
                    <td width='8%' class='labelcenter'></td>
                    <td width='4%' class='labelcenter'></td>
                    <td width='15%' class='labelcenter' style="text-align:left;word-wrap:break-word;"></td>
                    <td width='3%' class='labelcenter' style="text-align:right"></td>
                    <td width='3%' class='labelcenter' style="text-align:right"></td>
                    <td width='4%' class='labelcenter' style="text-align:right"></td>
                    <td width='7%' class='labelcenter' style="text-align:right"></td>
					<td width='7%' class='labelcenter'></td> 
					<td width='7%' class='labelcenter' style="text-align:right"></td> 
					<td width='7%' class='labelcenter'></td>        
					<td width='7%' class='labelcenter' style="text-align:right"></td>               
					<td width='7%' class='labelcenter'></td>       
					<td width='7%' class='labelcenter' style="text-align:right"></td> 
					<td width='7%' class='labelcenter'></td>     
					<td width='7%' class='labelcenter' style="text-align:right"></td>      
					<td width='7%' class='labelcenter'></td>     
					<td width='7%' class='labelcenter' style="text-align:right"></td>    
					<td width='7%' class='labelcenter'></td> 
					<td width='7%' class='labelcenter' style="text-align:right"></td>
					<td width='7%' class='labelcenter'></td>
					<td width='7%' class='labelcenter' style="text-align:right"></td>            
					<td width='7%' class='labelcenter'></td> 
					<td width='6%' class='labelcenter' style="text-align:right"></td>           
					<td width='6%' class='labelcenter'></td> 		                
                    <td width='2%' class='labelcenter'></td>
                </tr>
                <!---   THIS IS FOR LAST ROW TOTAL IN WHILE LOOP -->
                <tr height=''>
                    <td width='' class='labelcenter'></td>
                    <td width='' class='labelcenter' bgcolor=""></td>
                    <td width='' colspan="4" class='labelcenter labelheadblue' style='text-align:right'>
					<input type="text" name="txt_pageid" readonly="" id="txt_pageid"  class="textboxcobf" />
					</td>
                    <!--<td width='' class='labelcenter'></td>-->
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
				<tr style='border:none' class="label">
					<td style='border:none' colspan='16' align="right"><br/></td>
				</tr>
				<tr style='border:none'><td style='border:none' colspan='16' align="right" class="label">Prepared by&emsp;&emsp;</td></tr>
				<tr height='25px' bgcolor=""><td colspan="16" align="center" class="labelbold labelheadblue" ><?php echo "Summary"; ?></td></tr>
                </tr>
				<tr height='' bgcolor="">
                    <td width='' class='labelcenter'></td>
                    <td width='' class='labelcenter'></td>
                    <td width='' colspan="3" class='labelcenter labelheadblue'>Sub Total</td>
                    <td width='' class='labelcenter labelheadblue'></td>
                    <td width='' class='labelcenter labelheadblue' style="text-align:right"></td>
                    <td width='' class='labelcenter labelheadblue' style="text-align:right"></td>
                    <td width='' class='labelcenter labelheadblue' style="text-align:right"></td>
                    <td width='' class='labelcenter labelheadblue' style="text-align:right"></td>
                    <td width='' class='labelcenter labelheadblue' style="text-align:right"></td>
                    <td width='' class='labelcenter labelheadblue' style="text-align:right"></td>
                    <td width='' class='labelcenter labelheadblue' style="text-align:right"></td>
                    <td width='' class='labelcenter labelheadblue' style="text-align:right"></td>
					<td width='' class='labelcenter labelheadblue' style="text-align:right"></td>
                    <td width='' class='labelcenter'></td>
                </tr>
				<tr height='' bgcolor="">
                    <td width='' class='labelcenter'></td>
                    <td width='' class='labelcenter'></td>
                    <td width='' colspan="3" class='labelcenter'>Unit Weight</td>
                    <td width='' class='labelcenter'></td>
                    <td width='' class='labelcenter' style="text-align:right">0.395</td>
                    <td width='' class='labelcenter' style="text-align:right">0.617</td>
                    <td width='' class='labelcenter' style="text-align:right">0.888</td>
                    <td width='' class='labelcenter' style="text-align:right">1.580</td>
                    <td width='' class='labelcenter' style="text-align:right">2.470</td>
                    <td width='' class='labelcenter' style="text-align:right">3.860</td>
                    <td width='' class='labelcenter' style="text-align:right">4.830</td>
                    <td width='' class='labelcenter' style="text-align:right">6.313</td>
					<td width='' class='labelcenter' style="text-align:right">8.000</td>
                    <td width='' class='labelcenter'></td>
                </tr>	
				<tr height='' bgcolor="">
                    <td width='' class='labelcenter'></td>
                    <td width='' class='labelcenter'></td>
                    <td width='' colspan="3" class='labelcenter'>Total Weight</td>
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
                   <td width='' colspan="3" class='labelcenter'>Total in kg</td>
                   <td width='' colspan="10" class='labelcenter'></td>
                   <td width='' class='labelcenter'></td>
				   
                </tr>
				<tr height='' bgcolor="">
                   <td width='' class='labelcenter'></td>
                   <td width='' class='labelcenter'></td>
                   <td width='' colspan="3" class='labelcenter labelheadblue'>Total in mt</td>
                   <td width='' colspan="10" class='labelcenter labelheadblue'></td>
                   <td width='' class='labelcenter'></td>
				   
                </tr>
				<tr height=''>
                    <td width='8%' class='labelcenter'></td>
                    <td width='4%' class='labelcenter' bgcolor=""></td>
                    <td width='15%' class='labelcenter'></td>
					<td width='3%' class='labelcenter'></td>
					<td width='3%' class='labelcenter'></td>
                    <td width='4%' class='labelcenter'></td>
                    <td width='7%' class='labelcenter' style="text-align:right"></td>
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
					<td width='' colspan="6" class='labelcenter labelheadblue'></td>
					<td width='7%' class='labelcenter' style="text-align:right"></td>
					<td width='7%' class='labelcenter' style="text-align:right"></td>
					<td width='7%' class='labelcenter' style="text-align:right"></td>
					<td width='7%' class='labelcenter' style="text-align:right"></td>
					 <td width='7%' class='labelcenter' style="text-align:right"></td>
					 <td width='7%' class='labelcenter' style="text-align:right"></td>
					 <td width='7%' class='labelcenter' style="text-align:right"></td>
					 <td width='7%' class='labelcenter' style="text-align:right"></td>
					 <td width='6%' class='labelcenter' style="text-align:right"></td>
					 <td width='' class='labelcenter'></td>
				</tr>
				<tr height='' bgcolor="">
					<td width='' colspan="6" class='labelcenter labelheadblue'></td>
					<td width='7%' class='labelcenter' style="text-align:right"></td>
					<td width='7%' class='labelcenter' style="text-align:right"></td>
					<td width='7%' class='labelcenter' style="text-align:right"></td>
					<td width='7%' class='labelcenter' style="text-align:right"></td>
					<td width='7%' class='labelcenter' style="text-align:right"></td>
					<td width='7%' class='labelcenter' style="text-align:right"></td>
					<td width='7%' class='labelcenter' style="text-align:right"></td>
					<td width='7%' class='labelcenter' style="text-align:right"></td>
					<td width='6%' class='labelcenter' style="text-align:right"></td>
					<td width='' class='labelcenter'>&nbsp;</td>
				</tr>
				<tr height='' bgcolor="">
                    <td width='' class='labelcenter'></td>
                    <td width='' class='labelcenter'></td>
                    <td width='' colspan="3" class='labelcenter labelheadblue'>Sub Total</td>
                    <td width='' class='labelcenter labelheadblue'></td>
                    <td width='' class='labelcenter labelheadblue' style="text-align:right"></td>
                    <td width='' class='labelcenter labelheadblue' style="text-align:right"></td>
                    <td width='' class='labelcenter labelheadblue' style="text-align:right"></td>
                    <td width='' class='labelcenter labelheadblue' style="text-align:right"></td>
                    <td width='' class='labelcenter labelheadblue' style="text-align:right"></td>
                    <td width='' class='labelcenter labelheadblue' style="text-align:right"></td>
                    <td width='' class='labelcenter labelheadblue' style="text-align:right"></td>
                    <td width='' class='labelcenter labelheadblue' style="text-align:right"></td>
					<td width='' class='labelcenter labelheadblue' style="text-align:right"></td>
                    <td width='' class='labelcenter'></td>
                </tr>
				<tr height='' bgcolor="">
                    <td width='' class='labelcenter'></td>
                    <td width='' class='labelcenter'></td>
                    <td width='' colspan="3" class='labelcenter'>Unit Weight</td>
                    <td width='' class='labelcenter'></td>
                    <td width='' class='labelcenter' style="text-align:right">0.395</td>
                    <td width='' class='labelcenter' style="text-align:right">0.617</td>
                    <td width='' class='labelcenter' style="text-align:right">0.888</td>
                    <td width='' class='labelcenter' style="text-align:right">1.580</td>
                    <td width='' class='labelcenter' style="text-align:right">2.470</td>
                    <td width='' class='labelcenter' style="text-align:right">3.860</td>
                    <td width='' class='labelcenter' style="text-align:right">4.830</td>
                    <td width='' class='labelcenter' style="text-align:right">6.313</td>
					<td width='' class='labelcenter' style="text-align:right">8.000</td>
                    <td width='' class='labelcenter'></td>
                </tr>	
				<tr height='' bgcolor="">
                    <td width='' class='labelcenter'></td>
                    <td width='' class='labelcenter'></td>
                    <td width='' colspan="3" class='labelcenter'>Total Weight</td>
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
                   <td width='' colspan="3" class='labelcenter'>Total in kg</td>
                   <td width='' colspan="10" class='labelcenter'></td>
                   <td width='' class='labelcenter'></td>
				   
                </tr>
				<tr height='' bgcolor=""><!--A8FDAC-->
                   <td width='' class='labelcenter'></td>
                   <td width='' class='labelcenter'></td>
                   <td width='' colspan="3" class='labelcenter labelheadblue'>Total in mt</td>
                   <td width='' colspan="10" class='labelcenter labelheadblue'></td>
                   <td width='' class='labelcenter'></td>
				   
                </tr>
				<tr style="border-style:none;">
					<td style="border-style:none;" colspan="9" align="right" class="label"></td>
					<td style="border-style:none;" colspan="7" align="center" class="label"></td>
				</tr>
			   </table>
			   <input type="hidden" name="txt_boxid_str" id="txt_boxid_str" value=""  />
			  <!-- <div class="divFooter">UNCLASSIFIED</div>-->
			 <!--<hr />-->
            <table align="center" style="border:none;" class="printbutton">
                <tr style="border:none">
                   <td align="center" colspan="15" style="border:none;"><br/><input type="submit" name="back" value=" Back "/></td>
                </tr>
            </table>
		</form>
    </body>
</html>