@include('layouts.library.config')
@include('layouts.library.functions') 
@include('layouts.library.common')
@include('layouts.library.binddata') 
@include('layouts.header')
    <body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
        <!--==============================header=================================-->
        <form action="" method="post" enctype="multipart/form-data" name="form">
           @include('admin.menu')
            <!--==============================Content=================================-->
            <div class="content">
               <div class="title">Measurement Upload - View</div>
                <div class="container_12">
                    <div class="grid_12">
                        <blockquote class="bq1">
							<table width="100%" align="center" cellpadding="3" cellspacing="3" class="">
									<tr>
										<td width="24%">&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td width="">&nbsp;</td>
									</tr>
									<tr>
										<td width="20%">&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td width="">&nbsp;</td>
									</tr>
									<tr>
										<td width="20%">&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td width="">&nbsp;</td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td class="label">Work Short Name</td> 
										<td class="labeldisplay">
											<select name="txt_workshortname" id="txt_workshortname" class="textboxdisplay" style="width:439px;height:22px;" onChange="workorderdetail();" tabindex="7">
												<option value=""> --------------- Select Work Short Name ----------------- </option>
											</select>
											
												<input type="hidden" name="txt_sheetid" id="txt_sheetid" value=" ">
											
										</td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td width="20%">&nbsp;</td>
										<td>&nbsp;</td>
										<td id="val_workname" style="color:red"></td>
										<td width="">&nbsp;</td>
									</tr>
									<tr>
										<td width="">&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td width="">&nbsp;</td>
										<td class="label">Measurement Type</td>
										<td>
											<input type="radio" name="rad_measurementtype" id="rad_others" value="G">&nbsp;&nbsp;<label class="label">General</label>
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<input type="radio" name="rad_measurementtype" id="rad_steel" value="S">&nbsp;&nbsp;<label class="label">Steel</label>
										</td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td width="">&nbsp;</td>
										<td>&nbsp;</td>
										<td id="val_mtype" style="color:red"></td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td width="20%">&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td width="">&nbsp;</td>
									</tr>
									<tr>
										<td  height="30px;" colspan="4" align="center"><input type="button" class="backbutton" name="btn_view" id="btn_view" value=" View "></td>
									</tr>
									<tr>
										<td width="">&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
							</table>
                        </blockquote>
                    </div>
                </div>
            </div>
	  </form>
      <!--==============================footer=================================-->
     @include('layouts.footer')
	
    </body>
</html>
