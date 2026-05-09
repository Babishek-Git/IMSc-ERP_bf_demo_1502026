@include('layouts.library.config')
@include('layouts.library.functions') 
@include('layouts.header')
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
        <!--==============================header=================================-->
         @include('admin.menu')
        <!--==============================Content=================================-->
        <div class="content">
            <div class="container_12">
                <div class="grid_12">
                    <blockquote class="bq1">
                        <div class="title">Running Account Bill View</div>
                        <form name="form" method="post" action="">
                       
                            <div class="container">

                                <table width="1000"  bgcolor="#E8E8E8" border="0" cellpadding="0" cellspacing="0" align="center" >
                                    <tr><td width="12%">&nbsp;</td></tr>
                                    <tr>
					<td>&nbsp;</td> 
					<td  class="label">Work Order No </td>
					<td  class="labeldisplay">
					<select name="cmb_work_no" id="cmb_work_no" onChange="func_items();find_workname()" class="textboxdisplay" style="width:400px;height:22px;" tabindex="7">
					<option value="">---------------------------------Select---------------------------------</option>
					<option value=""></option>
					</select></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				<tr><td>&nbsp;</td><td></td><td id="val_work" style="color:red"></td></tr>
				<tr>
                                        <td>&nbsp;</td>
                                        <td  class="label">Name of the Work </td>
                                        <td  class="labeldisplay">
										<textarea name="workname" class="textboxdisplay txtarea_style" style="width: 400px;" rows="5" disabled="disabled"></textarea>
										</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
                                <tr><td>&nbsp;</td><td></td><td id="val_work" style="color:red"></td></tr>
                                <tr> 
                                        <td>&nbsp;</td> 
                                        <td  class="label">Running Account Bill No </td>
                                        <td  class="labeldisplay">
                                            <select name="cmb_rbn" id="cmb_rbn" class="textboxdisplay" style="width:400px;height:22px;" size="" tabindex="7" onChange="cmb_runningbilltext()">
                                                <option value=0>---------------------------------RBN.----------------------------------</option>
                                                
                                            </select></td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                </tr>
                                    
				<tr>
                                        <td>&nbsp;&nbsp;</td><td width="25%" class="label"></td>
                                       <td id="val_rbn" style="color:red">
                                </tr>
                                <tr>
                                        <td colspan="6">
                                    <center>
                                        <input type="hidden" class="text" name="submit" value="true" />
										<input  type="hidden" class="text" name="runningbilltext" id="runningbilltext" value=""/>
                                        <input type="submit" class="btn" data-type="submit" value=" View " name="submit" id="submit"   />
                                    </center>	    </td>
                                </tr>
                                <tr><td></td></tr>
                                </table>
                            </div>
                            <div class="col2">
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

