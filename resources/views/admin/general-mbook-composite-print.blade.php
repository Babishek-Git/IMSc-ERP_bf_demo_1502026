@include('layouts.library.config')
@include('layouts.library.functions')
@include('layouts.library.binddata')
@include('layouts.library.common')
@include('layouts.library.sysdate')
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>General M.Book</title>
        <link rel="stylesheet" href="script/font.css" />
</head>
<body bgcolor="" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
<!--<table width="875" style="position:fixed; text-align:center; left:194px;" height="60px" align="center" bgcolor="#20b2aa" class='header'>
<tr>
<td style="color:#FFFFFF; border:none; font-weight:bold; font-size:20px;">GENERAL MEASUREMENT BOOK</td>
</tr>
</table><br/><br/><br/>-->
<form name="form" id="form" method="post">
	<input type="hidden" name="txt_mbno_id" value="" id="txt_mbno_id" />
		<table width="875" border="0" cellpadding="3" cellspacing="3" align="center" bgcolor="#FFFFFF" class="label">
			<!--<tr height="" bgcolor="" class="label">
					<td width="81" 	align="center">&nbsp;</td>
					<td width="48" 	align="center"></td>
					<td width="230" align="left" colspan="" class="">Sub Abstract</td>
					<td width="65" 	align="right">&nbsp;</td>
					<td width="32" 	align="center">&nbsp;</td>
					<td width="32" 	align="center">&nbsp;</td>
					<td width="32" 	align="center">&nbsp;</td>
					<td width="32" 	align="center">&nbsp;</td>
					<td width="32" 	align="center">&nbsp;</td>
				</tr>-->
				<tr height="" bgcolor="" class="labelheadblue">
					<td width="81" 	align="center">&nbsp;</td>
					<td width="48" 	align="center">&nbsp;</td>
					<td width="390" align="right">&nbsp;</td>
					<td width="230" align="right" colspan="4" class="">
					C/o to page /General MB No./General MB No
					</td>
					<td width="65" 	align="right">&nbsp;</td>
					<td width="32" 	align="center">&nbsp;</td>
				</tr>
				<tr height="" bgcolor="" class="labelheadblue">
					<td width="81" 	align="center">&nbsp;</td>
					<td width="48" 	align="center">&nbsp;</td>
					<td width="390" align="right">&nbsp;</td>
					<td width="230" align="right" colspan="4" class=""></td>
					<td width="65" 	align="right">&nbsp;</td>
					<td width="32" 	align="center">&nbsp;</td>
				</tr>
				<tr height="" bgcolor="" class="labelbold">
					<td width="81" 	align="center"></td>
					<td width="48" 	align="center">&nbsp;</td>
					<td width="390" align="right">Total&nbsp;</td>
					<td width="230" align="right" nowrap="nowrap" colspan="4" class="cobffont"></td>
					<td width="65" 	align="right"></td>
					<td width="32" 	align="left"></td>
				</tr>	
				<tr height="" bgcolor="" class="labelheadblue">
					<td width="81" 	align="center">&nbsp;</td>
					<td width="48" 	align="center">&nbsp;</td>
					<td width="390" align="right">&nbsp;</td>
					<td width="230" align="right" colspan="4" class="">
					C/o to page /General MB No/General MB No.
					</td>
					<td width="65" 	align="right">&nbsp;</td>
					<td width="32" 	align="center">&nbsp;</td>
				</tr>
				<tr height="" bgcolor="" class="labelheadblue">
					<td width="81" 	align="center">&nbsp;</td>
					<td width="48" 	align="center">&nbsp;</td>
					<td width="390" align="right">&nbsp;</td>
					<td width="230" align="right" colspan="4" class=""></td>
					<td width="65" 	align="right">&nbsp;</td>
					<td width="32" 	align="center">&nbsp;</td>
				</tr>
				<tr height="" bgcolor="" class="">
					<td width="81" 	align="center">&nbsp;</td>
					<td width="48" 	align="center"></td>
					<td width="230" align="left" colspan="5" class=""></td>
					<td width="65" 	align="right">&nbsp;</td>
					<td width="32" 	align="center">&nbsp;</td>
				</tr>
				<tr height="" bgcolor="">
					<td width="81" 	align="center"></td>
					<td width="48" 	align="center"></td>
					<td width="390" align="center"></td>
					<td width="35" 	align="center">&nbsp;</td>
					<td width="65" 	align="center">&nbsp;</td>
					<td width="65" 	align="center">&nbsp;</td>
					<td width="65" 	align="center">&nbsp;</td>
					<td width="65" 	align="right"></td>
					<td width="32" 	align="center">&nbsp;</td>
				</tr>	
				<tr height="" bgcolor="" class="labelbold">
					<td width="81" 	align="center"></td>
					<td width="48" 	align="center">&nbsp;</td>
					<td width="390" align="right">Total&nbsp;</td>
					<td width="230" align="right" colspan="4" class="cobffont"></td>
					<td width="65" 	align="right"></td>
					<td width="32" 	align="left"></td>
				</tr>
				<tr style="border-style:none">
					<td colspan="9" style="border-style:none" align="center">
					</td>
				</tr>
			</table>
			<input type="hidden" name="hid_result" id="hid_result" value="" />
				<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
					<div class="buttonsection">
						<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
					</div>
				<!--<div class="buttonsection">
					<input type="submit" name="submit" value=" Submit " id="submit"/>
					</div>-->
					<div class="buttonsection">
						<input type="button" class="backbutton" name="print" value=" Print " onclick="printBook();" />
					</div>
				</div>
			</form>
	</body>
</html>