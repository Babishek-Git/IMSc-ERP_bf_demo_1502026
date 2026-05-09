@include('layouts.library.config')
@include('layouts.library.functions') 
@include('layouts.library.binddata') 
@include('layouts.header')
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
        <!--==============================header=================================-->
    @include('admin.menu')
        <!--==============================Content=================================-->
    <div class="content">
       <div class="title">Escalation Configuration</div>
       <div class="container_12">
            <div class="grid_12">
                   <blockquote class="bq1" style="overflow:auto">
                        <form name="form" method="post" action="EscalationSettings.php">
                            <div class="container">
								<div class="row ">
									<div class="div12">
											<div class="row">
												<table class="DispTable" width="100%">
													<thead>
														<tr>
															<th>Item No</th>
															<th>Item Description</th>
															<th>Item Base Rate <br/> ( &#8377; )</th>
															<th>Theoretical Cement <br/> ( in kg )</th>
															<th>Material Type</th>
															<th>Is Escalation ?<br/> <input type="checkbox" name="ch_all"></th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td align="center" valign="middle"></td>
															<td align="justify" class="HideDesc" valign="middle"></td>
															<td align="center" valign="middle"><input type="text" name="txt_base_rate[]" class="textboxdisplay" ></td>
															<td align="center" valign="middle"><input type="text" name="txt_th_cement[]" class="textboxdisplay" ></td>
															<td align="center">
																<select name="cmb_material_type" class="DispSelectBox">
																	<option value=""> ---- Select Type------</option>
																</select>
															</td>
															<td align="center" valign="middle"><input type="checkbox" name="ch_is_esc[]" class="" ></td>
														</tr>
													</tbody>
												</table>
											</div>
											<div class="smediv">&nbsp;</div>
									</div>
								</div>
								<div class="row">
									<div class="div12" align="center">
										<input type="button" class="backbutton" name="back" id="back" value=" BACK " onClick="goBack();"/>
										<input type="submit" class="backbutton" name="save" id="save" value=" SAVE "/>
									</div>
								</div>  
								<div class="row">&nbsp;</div>                         
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

