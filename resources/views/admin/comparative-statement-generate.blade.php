@include('layouts.library.config')
@include('layouts.library.functions')
@include('layouts.library.binddata') 
@include('layouts.library.common')
@include('layouts.library.spreadsheet-reader')
@include('layouts.header')
 <body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload=""
      @include('admin.menu')
        <div class="content">
                        <div class="title">Comparative Statement</div>
            <div class="container_12">
                <div class="grid_12">
                    <blockquote class="bq1">
                        <form name="form" method="post" action="ComparativeStatement.php">
                       
                            <div class="container">

                             <table width="100%"  bgcolor="#E8E8E8" border="0" cellpadding="0" cellspacing="0" align="center" >
                                <tr>
									<td width="19%">&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td>&nbsp;</td> 
									<td  class="label">Work Short Name </td>
									<td  class="labeldisplay">
									   <select name="cmb_shortname" id="cmb_shortname" class="textboxdisplay" style="width:470px;height:22px;" tabindex="7">
										 <option value="">--------------- Select ---------------</option>
									   </select>
									</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td></td>
									<td id="val_work" style="color:red" colspan="3"></td>
								</tr>
								<tr>
								   	<td>&nbsp;</td>
								   	<td  class="label">Tender No. </td>
								   	<td  class="labeldisplay"><input type="text" name="txt_workorder" id="txt_workorder" readonly="" class="textboxdisplay" style="width: 465px;"></td>
								   	<td>&nbsp;</td>
								   	<td>&nbsp;</td>
								</tr>
                                <tr>
									<td>&nbsp;</td>
									<td></td>
									<td id="val_workorder" style="color:red" colspan="3"></td>
								</tr>
								<tr>
								   	<td>&nbsp;</td>
								   	<td  class="label">Name of the Work </td>
								   	<td  class="labeldisplay"><textarea name="workname" id="workname" readonly="" rows="6" class="textboxdisplay" style="width: 465px;"></textarea></td>
								   	<td>&nbsp;</td>
								   	<td>&nbsp;</td>
								</tr>
                                <tr>
									<td>&nbsp;</td>
									<td></td>
									<td id="val_work" style="color:red" colspan="3"></td>
								</tr>
                                   
								<tr>
									<td>&nbsp;&nbsp;</td>
									<td width="" class="label"></td>
									<td id="val_rbn" style="color:red" colspan="3"></td>
								</tr>
                                <tr>
                                    <td colspan="5">
                                    <center>
                                        <input type="hidden" class="text" name="submit" value="true" />
										<input  type="hidden" class="text" name="runningbilltext" id="runningbilltext" value=""/>
                                        <!--<input type="image" src="Buttons/View_Normal.png" onmouseover="this.src='Buttons/View_Over.png';" onmouseout="this.src='Buttons/View_Normal.png';" class="btn" data-type="submit" value="View" name="submit" id="submit"   />-->
                                        <!--<input type="submit" data-type="submit" value=" View " name="submit" id="submit"/>&nbsp;&nbsp;&nbsp;
										<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>-->
                                    </center>	    
									</td>
                               </tr>
                               <tr>
							   		<td colspan="5"></td>
							   </tr>

                             </table>
                            </div>
							<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
								<div class="buttonsection">
								 <input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();">
								</div>
								<div class="buttonsection">
									<input type="submit" data-type="submit" value=" View " name="submit" id="submit"/>
								</div>
							</div>
                        </form>
                    </blockquote>
                </div>

            </div>
        </div>
    @include('layouts.footer')
    </body>
</html>

