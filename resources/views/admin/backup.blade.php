@include('layouts.library.config')
@include('layouts.library.functions')
@include('layouts.header')
    <body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
        <!--==============================header=================================-->
       <!-- <form action="" method="post" enctype="multipart/form-data" name="phuploader" onSubmit="return confirm('Do you really want to Save Designation.?');">-->
        <form action="" method="post" enctype="multipart/form-data" name="phuploader" onSubmit="submitform();">
            @include('admin.menu')
            <!--==============================Content=================================-->
            <div class="content">
                <div class="title">Back Up</div>
                <div class="container_12">
                    <div class="grid_12">
                        	<blockquote id="bq1" class="bq1" style="overflow:auto">
							
                             <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="color1">
                                <tr><td colspan="3">&nbsp;</td></tr>
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr><td colspan="3">&nbsp;</td></tr>
								<tr>
                                    <td class="label" colspan="3" align="center"> 
									Click a <a>Back Up</a> button to take a data back up.
									</td>									
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td class="labeldisplay" id="val_design" style="color:red">&nbsp;</td>
								</tr>
								<tr>
									<td colspan="3">&nbsp;</td>
								</tr>
                                <tr>
                                    <td colspan="3" height="50px">
									<div style="text-align:center">
										 <!--<input type="image" src="Buttons/submit.png" onmouseover="this.src='Buttons/submit_hover.png';" onmouseout="this.src='Buttons/submit.png';" class="btn" name="submit" id="submit" data-type="submit" value="Submit" onClick="return validation()"/>&nbsp;&nbsp;&nbsp;&nbsp;-->
										<div class="buttonsection"><input type="submit" name="submit" id="submit" data-type="submit" value="Back Up"/></div>
										<!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
										<div class="buttonsection"><input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/></div>
									</div>
									</td>
								</tr>
							    <tr>
									<td colspan="3">&nbsp;</td>
								</tr>
                            </table>
						
                          <div class="col2"></div>
                        </blockquote>
                    </div>
                </div>
            </div>
                 <!--==============================footer=================================-->
           @include('layouts.footer')
            
        </form>
		
    </body>
</html>
