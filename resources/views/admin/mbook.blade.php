@include('layouts.library.config')
@include('layouts.library.functions')
@include('layouts.library.binddata')
@include('layouts.library.common')
@include('layouts.library.config')
@include('layouts.library.functions')
@include('layouts.library.binddata') 
@include('layouts.library.common')
@include('layouts.header') 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>General M.Book</title>
        <link rel="stylesheet" href="script/font.css" />
</head>
<body bgcolor="#000000" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="" style="padding:0; margin:0;">
	<table width="875" style=" text-align:center; left:198px;" height="56px" align="center" bgcolor="#20b2aa" class='header label'>
		<tr style="position:fixed;">
			<td style="color:#FFFFFF; border:none; font-size:18px;" width="874" height="56px" align="center" bgcolor="#20b2aa">GENERAL MEASUREMENT BOOK - COMPOSITE</td>
		</tr>
	</table>
	<form name="form" id="form" method="post">
		<input type="hidden" name="txt_mbno_id" value="" id="txt_mbno_id" />
			<table width="875" border="0" cellpadding="3" cellspacing="3" align="center" bgcolor="#FFFFFF" class="label">
				<div id="dialog" title="Choose MBook No." style="background-color:#f9f8f6;font-size: 12px;">
					<p style="font-size:12px; font-weight:bold; color:#911200;">Select Next MBook Number</p>
					<select id="newmbooklist" name="mb" style="width:275px;">
						<option value="">---------------------Select--------------------</option>
					</select>
					<br/>
					<span id="error_msg" style="color:#FF0000; font-weight:bold;"></span>
					<input type="button" class="submit_btn" id="btn" style="color:#FFFFFF;background-color:#9c27b0;border:none;" name="btn" value="Submit"/>
					<input type="button" class="cancel_btn" id="btn_cancel" style="color:#FFFFFF;background-color:#e51c23;border:none;" name="btn_cancel" value="Cancel"/>
				</div>
				<tr height="">
					<td width="81" align="center"></td>
					<td width="48" align="center"></td>
					<td colspan="5" align="right" class="labelheadblue">
					</td>
					<td width="65" align="right"></td>
					<td width="32"></td>
				</tr>
				<tr height="">
					<td width="81" align="center"></td>
					<td width="48" align="center"></td>
					<td colspan="5" align="right" class="labelheadblue"></td>
					<td width="65" align="right"></td>
					<td width="32"></td>
				</tr>
				<tr height="">
					<td width="81"></td>
					<td width="48" align="center"></td>
					<td width="390" align="center" class="labelheadblue">
						<input type="text" name="txt_page" class="textboxcobf" id="txt_page" />
					</td>
					<td width="35" align="center"></td>
					<td width="65" colspan="3" align="center" class="labelcontentblue"></td>
					<td width="65" align="right" class="labelcontentblue"></td>
					<td width="32" align="center"></td>
				</tr>
				<tr height="">
					<td width="81"></td>
					<td width="48" align="center"></td>
					<td width="390" align="center" class="labelheadblue"></td>
					<td width="35" align="center"></td>
					<td width="65" colspan="3" align="center" class="labelcontentblue">Total</td>
					<td width="65" align="right" class="labelcontentblue"></td>
					<td width="32" align="center"></td>
				</tr>
				<tr style='border:none'>
					<td style='border:none' colspan='9' align="right"><br/></td>
				</tr>
				<tr style='border:none'><td style='border:none' colspan='9' align="right">Prepared by&emsp;&emsp;</td></tr>
				<tr height="">
					<td width="81" align="center"></td>
					<td width="48" align="center"></td>
					<td colspan="5"></td>
					<td width="65">&nbsp;</td>
					<td width="32">&nbsp;</td>
				</tr>
				<tr height="">
					<td width="81" align="center"></td>
					<td width="48" align="center"></td>
					<td colspan="5"></td>
					<td width="65"></td>
					<td width="32"></td>
				</tr>
				<tr height="">
					<td width="81"></td>
					<td width="48"></td>
					<td width="390"></td>
					<td width="35" align="center"></td>
					<td width="65" align="center"></td>
					<td width="65" align="center"></td>
					<td width="65" align="center"></td>
					<td width="65" align="right"></td>
					<td width="32" align="center">
				</td>
			</tr>
		<input type="hidden" name="txt_textboxcount" id="txt_textboxcount" value="" />
		<!----  THIS ROW IS FOR PRINT TOTAL OF THE LAST ROW IN WHILE LOOP ----->
			<tr height="">
				<td width="81"></td>
				<td width="48" align="center"></td>
				<td width="390" class="labelheadblue">
					<input type="text" name="txt_page" class="textboxcobf" id="txt_page" />
				</td>
				<td width="35" align="center"></td>
				<td width="65" colspan="3" align="center" class="labelcontentblue">
				</td>
				<td width="65" align="right"  class="labelcontentblue"></td>
				<td width="32" align="center">
				</td>
			</tr> 
			<tr height="">
				<td width="81"></td>
				<td width="48" align="center"></td>
				<td width="390" align="center" class="labelheadblue">
				<input type="text" name="txt_page" class="textboxcobf" id="txt_page" />
				</td>
				<td width="35" align="center"></td>
				<td width="65" colspan="3" align="center" class="labelcontentblue">Total</td>
				<td width="65" align="right" class="labelcontentblue"></td>
				<td width="32" align="center"></td>
			</tr>
			<tr style='border:none'>
				<td style='border:none' colspan='9' align="right"><br/></td>
			</tr>
			<tr style='border:none'><td style='border:none' colspan='9' align="right">Prepared by&emsp;&emsp;</td></tr>			
		</table> 
		<table>
			<tr height="">
				<td width="81" align="center"></td>
				<td width="48" align="center"></td>
				<td colspan="5" align="right" class="labelheadblue"></td>
				<td width="65" align="right"></td>
				<td width="32"></td>
			</tr>
			<tr height="">
				<td width="81" align="center"></td>
				<td width="48" align="center"></td>
				<td colspan="5" align="right" class="labelheadblue"></td>
				<td width="65" align="right"></td>
				<td width="32"></td>
			</tr>
			<tr height="">
				<td width="81"></td>
				<td width="48" align="center"></td>
				<td width="390" align="right" class="labelcontentblue">Total&nbsp;&nbsp;</td>
				<td width="35" align="center"></td>
				<td width="65" align="center"></td>
				<td width="65" align="center"></td>
				<td width="65" align="center"></td>
				<td width="65" align="right" class="labelcontentblue"></td>
				<td width="32" align="center"></td>
			</tr>
			<tr height="">
				<td width="81"></td>
				<td width="48" align="center"></td>
				<td width="390"></td>
				<td width="35" align="center"></td>
				<td width="65" align="center"></td>
				<td width="65" align="center"></td>
				<td width="65" align="center"></td>
				<td width="65" align="right"></td>
				<td width="32" align="center"></td>
			</tr>
			<tr height="" border="1px" style="border-bottom:solid; border-bottom-color:#CACACA;">
				<td width="81"></td>
				<td width="48" align="center"></td>
				<td width="390" align="right" class="labelcontentblue">Total&nbsp;&nbsp;</td>
				<td width="35" align="center"></td>
				<td width="65" align="center"></td>
				<td width="65" align="center"></td>
				<td width="65" align="center"></td>
				<td width="65" align="right" class="labelcontentblue"></td>
				<td width="32" align="center"></td>
			</tr>
			<input type="hidden" name="txt_boxid_str" id="txt_boxid_str" value="<?php echo rtrim($summary_b,","); ?>"  />
			<table border="0" width="875" style="border-style:none" align="center" bgcolor="#000000" class='labelcontent printbutton'>
				<tr border="0" style="border-style:none">
					<td border="0" style="border-style:none">&nbsp;</td>
				</tr>
				<tr border="0" style="border-style:none">
					<td border="0" style="border-style:none" align="center">
						<input type="submit" name="Back" value=" Back " /> 
					</td>
				</tr>
			</table>  
		</form>
    </body>
</html>