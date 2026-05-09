@include('layouts.library.config')
@include('layouts.library.functions') 
@include('layouts.library.binddata') 
@include('layouts.library.common')
@include('layouts.library.spellnumber')
@include('layouts.header')
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Abstrack MBook</title>
    <link rel="stylesheet" href="script/font.css" />
</head>
	<script language="javascript" type="text/javascript" src="script/Date_Calendar.js"></script>
	<script language="javascript" type="text/javascript" src="script/validfn.js"></script>
	<link rel="stylesheet" href="css/button_style.css"></link>
	<link rel="stylesheet" href="js/jquery-ui.css">
	<script src="js/jquery-1.10.2.js"></script>
	<script src="js/jquery-ui.js"></script>
	<link rel="stylesheet" href="/resources/demos/style.css">
	<link rel="stylesheet" href="Font style/font.css" />
	<link type='text/css' href='css/basic.css' rel='stylesheet' media='screen' />
	<script type='text/javascript' src='js/basic_model_jquery.js'></script>
	<script type='text/javascript' src='js/jquery.simplemodal.js'></script>
	<link rel="stylesheet" href="css/font-awesome.css" />
	<!--<script type='text/javascript' src='js/basic.js'></script>-->
	<script src="dist/sweetalert-dev.js"></script>
	<link rel="stylesheet" href="dist/sweetalert.css">
<body bgcolor="" onload="setRowSpan();noBack();" onpageshow="if (event.persisted) noBack();" onUnload="" style="padding:0; margin:0;">
<!--<table width="1087px" height="56px" align="center" class='label' bgcolor="#0A9CC5">
	<tr bgcolor="#0A9CC5" style="position:fixed;">
		<td style="color:#FFFFFF; border:none; font-size:16px;" width="1077px"  height="48px" class="pagetitle" align="center">ABSTRACT MEASUREMENT BOOK - PART PAYMENT</td>
	</tr>
</table>-->
<form name="form" method="post" onsubmit="return confirm('Do you really want to submit the Book?');">
<table width='1087px'  bgcolor='#FFFFFF' border='0' cellpadding='1' cellspacing='1' align='center' class='labelprint' >
	<tr>
		<td class="labelbold">Civil Secured Advance</td>
		<td class="labelbold"> Account of Secured Advance allowed on the Security Materials Brought to Site</td>
	</tr>
</table>
<table width='1087px'  bgcolor='#FFFFFF' border='0' cellpadding='1' cellspacing='1' align='center' class='table1 labelprint' >
	<tr>
		<td align="center">Sl No.</td>
		<td align="center">Item No.</td>
		<td align="center">Quantity Outstanding from previous bill</td>
		<td align="center">Deduct Quantity utilized in work measured since previous bill</td>
		<td align="center">Add Qty brought to site</td>
		<td align="center">outstanding including quantity brought to site since previous bill</td>
		<td align="center">Full rate assessed by the Divisional Officer</td>
		<td align="center">Description of Item</td>
		<td align="center">Unit</td>
		<td align="center">Reduced rate at which rate is made</td>
		<td align="center">Up-to-date amount of advance</td>
		<td align="center">Reference to Divisional officers written orders authorizing the advance</td>
		<td align="center">Reason for non - clearance of advance when outstanding more than three months</td>
	</tr>
</table>
<table width='1087px'  bgcolor='#FFFFFF' border='0' cellpadding='1' cellspacing='1' align='center' class='labelprint' >
	<tr>
		<td>Total amount outstanding as per this account  : </td>
		<td align="right"><b></b></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>Deduct-Amount outstanding as per entry (C) of Annexure to the previous bill  : </td>
		<td align="right"><b></b></td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class="labelbold" style="font-size:12px">Net Amount since previous bill (in words : Rupees ) </td>
		<td align="right"><b></b></td>
		<td width="15%" align="right"></td>
	</tr>
	<tr>
		<td colspan="3">
			Certified (1) that the plus quantities of materials shown in column 3 of the Account above have actually been brought by the Contractor to the site 
		of the work and the contractor had not previously received any advance on their security (2) that these materials are of an imperishable nature and 
		all are required by the Contractor for use on the work in connection with the items for which rates for finished work have been agreed upon and (3) 
		that a format agreement in Form 31 signed and executed by the Contractor in accordance with Paragraphs 10.2.24 (a) of the Central Public Works 
		Account Code in the Divisional Office.
		</td>
	</tr>
	<tr>
		<td colspan="3" align="center"><span class='badge'>Page </span></td>
	</tr>
</table>
<!--<div style="width:100%;" align="center">
	<div class="col-md" align="center"> 
		&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Certified (1) that the plus quantities of materials shown in column 3 of the Account above have actually been brought by the Contractor to the site 
		of the work and the contractor had not previously received any advance on their security (2) that these materials are of an imperishable nature and 
		all are required by the Contractor for use on the work in connection with the items for which rates for finished work have been agreed upon and (3) 
		that a format agreement in Form 31 signed and executed by the Contractor in accordance with Paragraphs 10.2.24 (a) of the Central Public Works 
		Account Code in the Divisional Office.
	</div>
</div>-->

<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
	<div class="buttonsection">
		<input type="button" name="back" value="Back" id="back" class="backbutton" onClick="goBack();" />
	</div>
	<div class="buttonsection" id="view_btn_section">
		<input type="button" class="backbutton" name="print" value=" Print " onclick="printBook();" />
	</div>
</div>
</form>
</body>
</html>