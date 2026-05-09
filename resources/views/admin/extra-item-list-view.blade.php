@include('layouts.library.config')
@include('layouts.library.functions') 
@include('layouts.header') 
    <body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
        <!--==============================header=================================-->
        <form action="" method="post" enctype="multipart/form-data" name="phuploader">
            @include('admin.menu')
            <!--==============================Content=================================-->
            <div class="content">
                <div class="title">View Extra Item </div>
                <div class="container_12">
                    <div class="grid_12">
                        <blockquote class="bq1" style="overflow:auto">
								<div class="container">
									<!--<div class="row innerdiv">
										<div class="row">
												<div class="div4" align="right">
													<label for="fname"> Supplementary Work Order No.</label>
												</div>
												<div class="div4">
													<input type="text" name="txt_workorder_no" id="txt_workorder_no" readonly="" rows="6" class="textboxdisplay" style="width: 365px; height:25px;" value="<?php echo $work_order_no; ?>">
												</div>
										</div>
									
										<div class="row">
												<div class="div4" align="right">
													<label for="fname">Supplementary Name Of Work</label>
												</div>
												<div class="div4">
													<textarea name="workname" readonly="" rows="3" class="textboxdisplay" style="width: 365px;"></textarea>
												</div>
										</div>
									</div>--><br/>
									<table class="table-bordered table1" width="100%" align="center" id="dataTable">
										<thead>
										
											<tr>
												<td align="left" valign="middle" colspan="7">suplementary Work Name :  <br/> Supplementary Work Order No. : </td>
											</tr>
											<tr class="note heading">
												<th align="center" valign="middle">SNo.</th>
												<th align="center" valign="middle">Item No.</th>
												<th align="center" valign="middle">Item Description</th>
												<th align="center" valign="middle">Qty</th>
												<th align="center" valign="middle">Rate</th>
												<th align="center" valign="middle">Unit</th>
												<th align="center">Action</th>
											</tr>
										</thead>
										<tbody>
										<tr>
											<td colspan="7" align="center">No Records Found</td>
										</tr>
										<tr>
											<td align="center"></td>
											<td align="center"></td>
											<td align="left"></td>
											<td align="center"></td>
											<td align="center"></td>
											<td align="center"></td>
											<td align="center">
												<a href="ExtraItemCreatePage.php?sch_id=" class="oval-btn-edit">
													<i style="font-size:12px; padding-top:5px;" class="fa">&#xf044;</i> Edit	
												</a>
												&nbsp;
												<a href="javascript:Delete()"  class="oval-btn-delete">
												   <i style="font-size:12px; padding-top:5px; font-weight:100" class="fa">&#xf00d;</i> Delete
											    </a>
												
											</td>
										</tr>
										</tbody>
									</table>
								</div>
								<div>&nbsp;</div>
								<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
									<div class="buttonsection">
									<input type="submit" name="back" value="Back">
									</div>
								</div>
                        </blockquote>
                        <div>&nbsp;</div>
                        <div>
						</div>
                    </div>
                </div>
            </div>
             <!--==============================footer=================================-->
            @include('layouts.footer')
        </form>
    </body>
</html>

