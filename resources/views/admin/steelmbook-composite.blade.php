@include('layouts.library.config')
@include('layouts.library.functions')
@include('layouts.library.binddata') 
@include('layouts.library.common')
@include('layouts.header') 
@include('layouts.library.sysdate')
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Steel M.Book</title>
        <link rel="stylesheet" href="script/font.css" />
        
    </head>
<body bgcolor="#444444" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="" style="padding:0; margin:0;">
<table width="1087px" style=" text-align:center; left:92px;" height="56px" align="center" bgcolor="#035A85" class=''>
	<tr style="position:fixed;">
		<td class="title"  width="1086px"  height="56px" align="center" bgcolor="#035A85">Steel Sub-Abstract</td>
	</tr>
</table>
<form name="form" method="post" style="">
<input type="hidden" name="hid_staffid" id="hid_staffid" value="" />
<input type="hidden" name="hid_sheetid" id="hid_sheetid" value="" />
<input type="hidden" name="hid_userid" id="hid_userid" value="" />
<input type="hidden" name="txt_steelmbno_id" value="" id="txt_steelmbno_id" />
<table width="1087px" border="0" cellpadding="3" cellspacing="3" align="center" bgcolor='#FFFFFF'>
			<!--<tr height=''>
				<td width='8%'>&nbsp;</td>
				<td width='4%'>&nbsp;</td>
				<td width='15%'>&nbsp;</td>
				<td width='3%'>&nbsp;</td>
				<td width='3%'>&nbsp;</td>
				<td width='4%'>&nbsp;</td>
				<td width='7%'>&nbsp;</td>
				<td width='7%'>&nbsp;</td>
				<td width='7%'>&nbsp;</td>
				<td width='7%'>&nbsp;</td>
				<td width='7%'>&nbsp;</td>
				<td width='7%'>&nbsp;</td>
				<td width='7%'>&nbsp;</td>
				<td width='7%'>&nbsp;</td>
				<td width='6%'>&nbsp;</td>
				<td width='2%'>&nbsp;</td>
		   </tr>-->
		   <tr height='' class="label">
				<td width='8%'></td>
				<td width='4%'></td>
				<td width='25%' colspan="4" align="right">&nbsp;</td>
				<td width='7%' align="right"></td>
				<td width='7%' align="right"></td>
				<td width='7%' align="right"></td>
				<td width='7%' align="right"></td>
				<td width='7%' align="right"></td>
				<td width='7%' align="right"></td>
				<td width='7%' align="right"></td>
				<td width='7%' align="right"></td>
				<td width='6%' align="right"></td>
				<td width='2%'>&nbsp;</td>
		   	</tr>
			<tr height='' class="label">
				<td width='8%'>&nbsp;</td>
				<td width='4%'>&nbsp;</td>
				<td width='25%' align="right" colspan="4">Unit Weight&nbsp;</td>
				<td width='7%' align="right">0.395</td>
				<td width='7%' align="right">0.617</td>
				<td width='7%' align="right">0.888</td>
				<td width='7%' align="right">1.58</td>
				<td width='7%' align="right">2.47</td>
				<td width='7%' align="right">3.85</td>
				<td width='7%' align="right">4.83</td>
				<td width='7%' align="right">6.31</td>
				<td width='6%' align="right">7.990</td>
				<td width='2%' align="right">&nbsp;</td>
		   	</tr>
			<tr height='' class="label">
				<td width='8%' align="right">&nbsp;</td>
				<td width='4%' align="right">&nbsp;</td>
				<td width='25%' align="right" colspan="4">Total Weight&nbsp;</td>
				<td width='7%' align="right"></td>
				<td width='7%' align="right"></td>
				<td width='7%' align="right"></td>
				<td width='7%' align="right"></td>
				<td width='7%' align="right"></td>
				<td width='7%' align="right"></td>
				<td width='7%' align="right"></td>
				<td width='7%' align="right"></td>
				<td width='6%' align="right"></td>
				<td width='2%' align="right">&nbsp;</td>
		   	</tr>
			<tr height='' bgcolor="" class="label labelbold">
                <td width=''></td>
                <td width=''></td>
                <td width='' colspan="4" align="right">Total ( in kg )&nbsp;</td>
                <td width='' colspan="3" align="right"></td>
				<td width='' colspan="6" align="left">&nbsp;</td>
                <td width='' align="left"></td>
          	</tr>
			<tr height='' bgcolor="" class="label labelbold">
                <td width='' class='labelcenter'></td>
                <td width='' class='labelcenter'></td>
                <td width='' colspan="4" align="right">Total ( in mt )&nbsp;</td>
                <td width='' colspan="3" align="right"></td>
				<td width='' colspan="6" align="right"></td>
                <td width='' align="left"></td>
         	</tr>
			
			<!--<tr height='' class="label labelheadblue">
				<td width='8%'>&nbsp;</td>
				<td width='4%'>&nbsp;</td>
				<td width='25%' colspan="4"></td>
				<td width='7%'>&nbsp;</td>
				<td width='7%'>&nbsp;</td>
				<td width='7%'>&nbsp;</td>
				<td width='7%'>&nbsp;</td>
				<td width='7%'>&nbsp;</td>
				<td width='7%'>&nbsp;</td>
				<td width='7%'>&nbsp;</td>
				<td width='7%'>&nbsp;</td>
				<td width='6%'>&nbsp;</td>
				<td width='2%'>&nbsp;</td>
		   </tr>-->
		   <!--<tr height='' class="label labelheadblue">
				<td width='8%'>&nbsp;</td>
				<td width='4%'>&nbsp;</td>
				<td width='25%' colspan="4"></td>
				<td width='7%'>&nbsp;</td>
				<td width='7%'>&nbsp;</td>
				<td width='7%'>&nbsp;</td>
				<td width='7%'>&nbsp;</td>
				<td width='7%'>&nbsp;</td>
				<td width='7%'>&nbsp;</td>
				<td width='7%'>&nbsp;</td>
				<td width='7%'>&nbsp;</td>
				<td width='6%'>&nbsp;</td>
				<td width='2%'>&nbsp;</td>
		   </tr>-->
			<tr height='' class="label">
				<td width='8%'></td>
				<td width='4%'></td>
				<td width='25%' colspan="4">&nbsp;</td>
				<td width='7%' align="right"></td>
				<td width='7%' align="right"></td>
				<td width='7%' align="right"></td>
				<td width='7%' align="right"></td>
				<td width='7%' align="right"></td>
				<td width='7%' align="right"></td>
				<td width='7%' align="right"></td>
				<td width='7%' align="right"></td>
				<td width='6%' align="right"></td>
				<td width='2%'>&nbsp;</td>
		   	</tr>
		   	<!--<tr height='' class="label">
				<td width='8%'>&nbsp;</td>
				<td width='4%'>&nbsp;</td>
				<td width='25%' align="right" colspan="4">Unit Weight&nbsp;</td>
				<td width='7%' align="right">0.395</td>
				<td width='7%' align="right">0.617</td>
				<td width='7%' align="right">0.888</td>
				<td width='7%' align="right">1.58</td>
				<td width='7%' align="right">2.47</td>
				<td width='7%' align="right">3.85</td>
				<td width='7%' align="right">4.83</td>
				<td width='7%' align="right">6.31</td>
				<td width='6%' align="right">7.990</td>
				<td width='2%' align="right">&nbsp;</td>
		   	</tr>-->
		   <!--	<tr height='' class="label">
				<td width='8%' align="right">&nbsp;</td>
				<td width='4%' align="right">&nbsp;</td>
				<td width='25%' align="right" colspan="4">Total Weight&nbsp;</td>
				<td width='7%' align="right"></td>
				<td width='7%' align="right"></td>
				<td width='7%' align="right"></td>
				<td width='7%' align="right"></td>
				<td width='7%' align="right"></td>
				<td width='7%' align="right"></td>
				<td width='7%' align="right"></td>
				<td width='7%' align="right"></td>
				<td width='6%' align="right"></td>
				<td width='2%' align="right">&nbsp;</td>
		   	</tr>-->
		   	<!--<tr height='' bgcolor="" class="label labelbold">
                <td width=''></td>
                <td width=''></td>
                <td width='' colspan="4" align="right">Total ( in kg )&nbsp;</td>
                <td width='' colspan="3" align="right"></td>
				<td width='' colspan="6" align="left">&nbsp;</td>
                <td width='' align="left"></td>
          	</tr>-->
		  	<!--<tr height='' bgcolor="" class="label labelbold">
                <td width='' class='labelcenter'></td>
                <td width='' class='labelcenter'></td>
                <td width='' colspan="4" align="right">Total ( in mt )&nbsp;</td>
                <td width='' colspan="3" align="right"></td>
				<td width='' colspan="6" align="right"></td>
                <td width='' align="left"></td>
         	</tr>-->
			<!--<tr height='' class="label labelheadblue">
				<td width='8%'>&nbsp;</td>
				<td width='4%'>&nbsp;</td>
				<td width='25%' colspan="4"></td>
				<td width='7%'>&nbsp;</td>
				<td width='7%'>&nbsp;</td>
				<td width='7%'>&nbsp;</td>
				<td width='7%'>&nbsp;</td>
				<td width='7%'>&nbsp;</td>
				<td width='7%'>&nbsp;</td>
				<td width='7%'>&nbsp;</td>
				<td width='7%'>&nbsp;</td>
				<td width='6%'>&nbsp;</td>
				<td width='2%'>&nbsp;</td>
		   </tr>-->
		   <!--<tr height='' class="label labelheadblue">
				<td width='8%'>&nbsp;</td>
				<td width='4%'>&nbsp;</td>
				<td width='25%' colspan="4"></td>
				<td width='7%'>&nbsp;</td>
				<td width='7%'>&nbsp;</td>
				<td width='7%'>&nbsp;</td>
				<td width='7%'>&nbsp;</td>
				<td width='7%'>&nbsp;</td>
				<td width='7%'>&nbsp;</td>
				<td width='7%'>&nbsp;</td>
				<td width='7%'>&nbsp;</td>
				<td width='6%'>&nbsp;</td>
				<td width='2%'>&nbsp;</td>
		   </tr>-->
			<tr height='' class="label">
				<td width='8%'></td>
				<td width='4%'></td>
				<td width='25%' colspan="4" align="right">&nbsp;</td>
				<td width='7%' align="right"></td>
				<td width='7%' align="right"></td>
				<td width='7%' align="right"></td>
				<td width='7%' align="right"></td>
				<td width='7%' align="right"></td>
				<td width='7%' align="right"></td>
				<td width='7%' align="right"></td>
				<td width='7%' align="right"></td>
				<td width='6%' align="right"></td>
				<td width='2%'>&nbsp;</td>
		   	</tr>
			<tr height='' class="label">
				<td width='8%'>&nbsp;</td>
				<td width='4%'>&nbsp;</td>
				<td width='25%' align="right" colspan="4">Unit Weight&nbsp;</td>
				<td width='7%' align="right">0.395</td>
				<td width='7%' align="right">0.617</td>
				<td width='7%' align="right">0.888</td>
				<td width='7%' align="right">1.58</td>
				<td width='7%' align="right">2.47</td>
				<td width='7%' align="right">3.85</td>
				<td width='7%' align="right">4.83</td>
				<td width='7%' align="right">6.31</td>
				<td width='6%' align="right">7.990</td>
				<td width='2%' align="right">&nbsp;</td>
		   	</tr>
			<tr height='' class="label">
				<td width='8%' align="right">&nbsp;</td>
				<td width='4%' align="right">&nbsp;</td>
				<td width='25%' align="right" colspan="4">Total Weight&nbsp;</td>
				<td width='7%' align="right"></td>
				<td width='7%' align="right"></td>
				<td width='7%' align="right"></td>
				<td width='7%' align="right"></td>
				<td width='7%' align="right"></td>
				<td width='7%' align="right"></td>
				<td width='7%' align="right"></td>
				<td width='7%' align="right"></td>
				<td width='6%' align="right"></td>
				<td width='2%' align="right">&nbsp;</td>
		   	</tr>
			<tr height='' bgcolor="" class="label labelbold">
                <td width=''></td>
                <td width=''></td>
                <td width='' colspan="4" align="right">Total ( in kg )&nbsp;</td>
                <td width='' colspan="3" align="right"></td>
				<td width='' colspan="6" align="left">&nbsp;</td>
                <td width='' align="left"></td>
          	</tr>
			<tr height='' bgcolor="" class="label labelbold">
                <td width='' class='labelcenter'></td>
                <td width='' class='labelcenter'></td>
                <td width='' colspan="4" align="right">Total ( in mt )&nbsp;</td>
                <td width='' colspan="3" align="right"></td>
				<td width='' colspan="6" align="right"></td>
                <td width='' align="left"></td>
         	</tr>
		<tr style="border-style:none" class="label">
					<td colspan="16" style="border-style:none" align="center">
					</td>
				</tr>
</table>
<table align="center" style="border:none;" class="printbutton">
                <tr style="border:none">
                   <td align="center" colspan="15" style="border:none;"><br/>
				   <input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/></td>
                </tr>
            </table>	
 </form>
</body>
</html>