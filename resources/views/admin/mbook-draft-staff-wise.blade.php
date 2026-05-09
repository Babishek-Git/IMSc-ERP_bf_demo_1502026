@include('layouts.library.config')
@include('layouts.library.functions')
@include('layouts.library.binddata')
@include('layouts.library.common')
@include('layouts.library.declaration')
@include('layouts.library.sysdate')
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>General M.Book</title>
        <link rel="stylesheet" href="script/font.css" />
</head>
		<script language="javascript" type="text/javascript" src="script/Date_Calendar.js"></script>
		<script language="javascript" type="text/javascript" src="script/validfn.js"></script>
		<link rel="stylesheet" href="css/button_style.css"></link>
	 	<link rel="stylesheet" href="js/jquery-ui.css">
	  	<script src="js/jquery-1.10.2.js"></script>
	  	<script src="js/jquery-ui.js"></script>
	  	<link rel="stylesheet" href="/resources/demos/style.css">
		<script src="js/printPage.js"></script>

<body bgcolor="" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
<form name="form" id="form" method="post">
<input type="hidden" name="txt_mbno_id" value="" id="txt_mbno_id" />
<table width="875" border="0" cellpadding="3" cellspacing="3" align="center" bgcolor="#FFFFFF" class='label'>
		<tr height="" class="labelbold">
				<td width="81" align="center"></td>
				<td width="48" align="center"></td>
				<td colspan="5" align="right">
				C/o to page /General MB No./General MB No.
				</td>
				<td width="65" align="right"></td>
				<td width="32"></td>
		</tr>
			<tr height="" class="labelbold">
				<td width="81" align="center"></td>
				<td width="48" align="center"></td>
				<td colspan="5" align="right"></td>
				<td width="65" align="right"></td>
				<td width="32"></td>
			</tr>
					<tr height="" class="labelbold">
						<td width="81"></td>
						<td width="48" align="center"></td>
						<td width="390" align="right">
						<input type="text" class="labelbold" name="txt_page"  style="width:100%; border:none; text-align:right;" id="txt_page" />
						</td>
						<td width="35" align="center"></td>
						<td width="65" colspan="3" align="right">
						</td>
						<td width="65" align="right"></td>
						<td width="32" align="center">
						</td>
					</tr>
						<tr height="" class="labelbold">
							<td width="81"></td>
							<td width="48" align="center"></td>
							<td width="390" align="right">
							<input type="text" class="labelbold" name="txt_page"  style="width:100%; border:none; text-align:right;" id="txt_page" />

							</td>
							<td width="35" align="center"></td>
							<td width="65" colspan="3" align="center" class="labelcontentblue">Total</td>
							<td width="65" align="right" class="labelcontentblue">
							</td>
							<td width="32" align="center"></td>
						</tr>
			<!--<tr height="">
				<td width="81" align="center"></td>
				<td width="48" align="center"></td>
				<td colspan="5"></td>
				<td width="65">&nbsp;</td>
				<td width="32">&nbsp;</td>
			</tr>-->
			<tr height="">
				<td width="81" align="center"></td>
				<td width="48" align="center"></td>
				<td colspan="5"></td>
				<td width="65"></td>
				<td width="32"></td>
			</tr>
					<tr height="" class="labelbold">
						<td width="81"></td>
						<td width="48" align="center"></td>
						<td width="390" align="right">
						
						<input type="text" class="labelbold" name="txt_page"  style="width:100%; border:none; text-align:right;" id="txt_page<?php echo $txtboxid; ?>" />
						
						</td>
						<td width="35" align="center"></td>
						<td width="65" colspan="3" align="right">
						</td>
						<td width="65" align="right"></td>
						<td width="32" align="center">
						
						</td>
					</tr>
					
						<tr height="" class="labelbold">
							<td width="81"></td>
							<td width="48" align="center"></td>
							<td width="390" align="right">
							
							<input type="text" class="labelbold" name="txt_page"  style="width:100%; border:none; text-align:right;" id="txt_page<?php //echo $txtboxid; ?>" />
							
							</td>
							<td width="35" align="center"></td>
							<td width="65" colspan="3" align="center" class="labelcontentblue">Total</td>
							<td width="65" align="right" class="labelcontentblue">
							
							</td>
							<td width="32" align="center"></td>
						</tr>
					<!--<tr height="">
						<td width="81" align="center"></td>
						<td width="48" align="center"></td>
						<td colspan="5"></td>
						<td width="65">&nbsp;</td>
						<td width="32">&nbsp;</td>
					</tr>-->
					<tr height="">
						<td width="81" align="center"></td>
						<td width="48" align="center"></td>
						<td colspan="5"></td>
						<td width="65"></td>
						<td width="32"></td>
					</tr>
		<!---  THE BELOW ROW IS FOR PRINT EACH RECORD ------>
					<tr height="">
						<td width="81"></td>
						<td width="48"></td>
						<td width="390"></td>
						<td width="35" align="right"></td>
						<td width="65" align="right"></td>
						<td width="65" align="right"></td>
						<td width="65" align="right"></td>
						<td width="65" align="right"></td>
						<td width="32" align="center">
						
						</td>
					</tr>
					<input type="hidden" name="txt_textboxcount" id="txt_textboxcount" value=""/>
					<!----  THIS ROW IS FOR PRINT TOTAL OF THE LAST ROW IN WHILE LOOP ----->
						<tr height="" class="labelbold">
							<td width="81"></td>
							<td width="48" align="center"></td>
							<td width="390" align="right">
								<input type="text" class="labelbold" name="txt_page"  style="width:100%; border:none; text-align:right;" id="txt_page<?php echo $txtboxid; ?>" />
							</td>
							<td width="35" align="center"></td>
							<td width="65" colspan="3" align="right">
							</td>
							<td width="65" align="right"></td>
							<td width="32" align="center">
							</td>
						</tr> 
						<tr height="" class="labelbold">
							<td width="81"></td>
							<td width="48" align="center"></td>
							<td width="390" align="right">
								<input type="text" class="labelbold" name="txt_page"  style="width:100%; border:none; text-align:right;" id="txt_page<?php echo $txtboxid; ?>" />
							</td>
							<td width="35" align="center"></td>
							<td width="65" colspan="3" align="right" class="labelcontentblue">Total</td>
							<td width="65" align="right" class="labelcontentblue">
						
							</td>
							<td width="32" align="center"></td>
						</tr>
					</table> 
						<tr height="" class="labelbold">
							<td width="81" align="center"></td>
							<td width="48" align="center"></td>
							<td colspan="5" align="right">
								C/o to page <?php if($page >= 100){ echo $NextMBPageList[$NextMbIncr]; ?>/General MB No.<?php echo $NextMBList[$NextMbIncr]; }else{ echo $page+1; ?>/General MB No.<?php echo $mbookno; } ?>
							</td>
							<td width="65" align="right"><?php if($contentarea != 0) { echo number_format($contentarea,$pre_decimal,".",","); } ?></td>
							<td width="32"></td>
						</tr>
						<tr height="" class="labelbold">
							<td width="81" align="center"></td>
							<td width="48" align="center"></td>
							<td colspan="5" align="right"></td>
							<td width="65" align="right"></td>
							<td width="32"></td>
						</tr>
						<tr height="" class="labelbold">
							<td width="81"></td>
							<td width="48" align="center"></td>
							<td width="390" align="right"></td>
							<td width="35" align="center"></td>
						<!--<td width="65" align="center"></td>
							<td width="65" align="center"></td>-->
							<td width="195" colspan="3" align="right"></td>
							<td width="65" align="right"></td>
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
						<tr height="" border="1px" style="border-bottom:solid; border-bottom-color:#CACACA;" class="labelbold">
							<td width="81"></td>
							<td width="48" align="center"></td>
							<td width="390" align="right"></td>
							<td width="35" align="center"></td>
<!--						<td width="65" align="center"></td>
							<td width="65" align="center"></td>-->
							<td width="195" colspan="3" align="right"></td>
							<td width="65" align="right"></td>
							<td width="32" align="center"></td>
						</tr>
						<input type="hidden" name="txt_boxid_str" id="txt_boxid_str" value="<?php echo rtrim($summary_b,","); ?>"  />
							<div align="center" class="btn_outside_sect printbutton">
								<div class="btn_inside_sect"><input type="submit" name="Back" value=" Back " /> </div>
								<!--<div class="btn_inside_sect"><input type="button" class="backbutton" name="print" value=" Print " onclick="printBook();" /></div>-->
								<!--<div class="btn_inside_sect">
									<a href="exportexcel.php?workno=" style="text-decoration:none">
										<input type="button" class="backbutton" name="export_excel" value="Excel" />
									</a>
								</div>-->
							</div>
						<!--<table border="0" width="875" style="border-style:none" align="center" bgcolor="#000000" class='labelcontent printbutton'>
							<tr border="0" style="border-style:none">
								<td border="0" style="border-style:none">&nbsp;
								</td>
								<td border="0" style="border-style:none">&nbsp;
								</td>
								<td border="0" style="border-style:none">&nbsp;
								</td>
							</tr>
							<tr border="0" style="border-style:none" height="35px;">
								<td border="0" style="border-style:none" align="right">
									<input type="submit" name="Back" value=" Back " /> 
								</td>
								<td border="0" style="border-style:none" width="20px">&nbsp;
								</td>
								<td border="0" style="border-style:none" align="left">
									<input type="button" class="backbutton" name="print" value=" Print " /> 
								</td>
							</tr>
						</table>  -->
			</div>
		</form>
  </body>
</html>