@include('layouts.library.config')
@include('layouts.library.functions')
@include('layouts.library.binddata') 
@include('layouts.header')
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
        <!--==============================header=================================-->
		 <form action="" method="post" enctype="multipart/form-data" name="form">
        @include('admin.menu')
        <!--==============================Content=================================-->
        <div class="content">
		   <div class="title">Supplementary Agreement Entry</div>
            <div class="container_12">
                <div class="grid_12">
                    <blockquote class="bq1">
						   <div class="container">
								<div class="row ">
									<div class="div2">&nbsp;</div>
									<div class="div8">
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Main Agreement Details</div></div></div>
										<div class="row innerdiv">
											<div class="row">
												<div class="div4">
													<label for="fname">Work Short Name</label>
												</div>
												<div class="div8">
													<select name="cmb_work_no" id="cmb_work_no" onChange="find_workname()" class="textboxdisplay" style="width:470px;height:22px;" tabindex="7">
														 <option value="">--------------- Select ---------------</option>
													</select>
													<label id="val_work" style="color:#f10b0b"></label>
												</div>
											</div>
											<div class="row">
												<div class="div4">
													<label for="fname">Work Order No.</label>
												</div>
												<div class="div8">
													<input type="text" name="txt_workorder_no" id="txt_workorder_no" readonly="" rows="6" class="textboxdisplay" style="width: 465px;" value="">
												</div>
											</div>
											<div class="row">
												<div class="div4">
													<label for="fname">Name of Work</label>
												</div>
												<div class="div8">
													<textarea name="workname" readonly="" rows="4" class="textboxdisplay" style="width: 465px;"></textarea>
												</div>
											</div>
											
										</div>
									</div>
								  	<div class="div2">&nbsp;</div>
								</div>
								<div class="row ">
									<div class="div2">&nbsp;</div>
									<div class="div8">
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Supplementary Agreement Details</div></div></div>
										<div class="row innerdiv">
											<div class="row">
												<div class="div4">
													<label for="fname">Supp.Agreement Work Order No.</label>
												</div>
												<div class="div8">
													<input type="text" name="txt_workorder_no_supp" id="txt_workorder_no_supp" readonly="" rows="6" class="textboxdisplay" style="width: 245px;" value="">
													<label id="val_workorder_no_supp" style="color:#f10b0b"></label>
												</div>
											</div>
											<div class="row">
												<div class="div4">
													<label for="fname">Supp.Agreement No.</label>
												</div>
												<div class="div8">
													<input type="text" name="txt_agment_no_supp" id="txt_agment_no_supp" rows="6" class="textboxdisplay" style="width: 245px;" value="">
												    <label id="val_agment_no_supp" style="color:#f10b0b"></label>
												</div>
											</div>
											<div class="row">
												<div class="div4">
													<label for="fname">CC No.</label>
												</div>
												<div class="div8">
													<input type="text" name="txt_cc_no_supp" id="txt_cc_no_supp"  rows="6" class="textboxdisplay" style="width: 125px;" value="">
												    <label id="val_cc_no_supp" style="color:#f10b0b"></label>
												</div>
											</div>
											<div class="row">
												<div class="div4">
													<label for="fname">No.of.Supp.Agreement</label>
												</div>
												<div class="div8">
													<input type="text" name="txt_no_supp_agment" id="txt_no_supp_agment" rows="6" class="textboxdisplay" style="width: 125px;" value="">
												    <label id="val_no_supp_agment" style="color:#f10b0b"></label>
													<input type="hidden" name="txt_work_name_supp" id="txt_work_name_supp" rows="6" class="textboxdisplay" style="width: 165px;" value="">
													<input type="hidden" name="txt_no_short_name_supp" id="txt_short_name_supp" rows="6" class="textboxdisplay" style="width: 165px;" value="">
													<input type="hidden" name="txt_tech_sanction_supp" id="txt_tech_sanction_supp" rows="6" class="textboxdisplay" style="width: 165px;" value=">
													<input type="hidden" name="txt_name_contractor_supp" id="txt_name_contractor_supp" rows="6" class="textboxdisplay" style="width: 165px;" value="">
													<input type="hidden" name="txt_rebate_percent_supp" id="txt_rebate_percent_supp" rows="6" class="textboxdisplay" style="width: 165px;" value="">
													<input type="hidden" name="txt_work_order_date_supp" id="txt_work_order_date_supp" rows="6" class="textboxdisplay" style="width: 165px;" value="">
													<input type="hidden" name="txt_worktype_supp" id="txt_no_worktype_supp" rows="6" class="textboxdisplay" style="width: 165px;" value="">
													<input type="hidden" name="txt_rbn_supp" id="txt_rbn_supp" rows="6" class="textboxdisplay" style="width: 165px;" value="">
												</div>
											</div>
											
										</div>
									</div>
								  	<div class="div2">&nbsp;</div>
								</div>
								
									<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
										<div class="buttonsection">
											 <input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
										</div>
										<div class="buttonsection">
										
										<input type="submit" name="update" id="update" value=" Update "/>
										<input type="hidden" name="txt_supp_sheetid" id="txt_supp_sheetid" value=""/>						
										<input type="submit" data-type="submit" value=" Save " name="save" id="save"/>
										</div>
								   </div>
								</div>
						   </div>
						   
                     </blockquote>
                </div>
            </div>
        </div>
         <!--==============================footer=================================-->
        @include('layouts.footer')
</form>
</body>
</html>

