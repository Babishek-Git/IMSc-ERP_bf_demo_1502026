@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
		<form action="" method="post" name="form">
        <div class="content">
            <div class="title">Substitute Item View</div>
            <div class="container_12">
                <div class="grid_12">
                    <blockquote class="bq1">
						   <div class="container">
								<div class="row ">
									<div class="div2">&nbsp;</div>
									<div class="div8">
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Substitute Item Details</div></div></div>
										<div class="row innerdiv">
											<div class="row">
												<div class="div4">
													<label for="fname">Work Short Name</label>
												</div>
												<div class="div8">
													<select name="cmb_work_no" id="cmb_work_no" onChange="find_workname();GetSupplementaryWorkOrder();" class="textboxdisplay" style="width:465px;height:22px;" tabindex="7">
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
													<input type="text" name="txt_workorder_no" id="txt_workorder_no" readonly="" rows="6" class="textboxdisplay" style="width: 465px;">
												</div>
											</div>
											<div class="row">
												<div class="div4">
													<label for="fname">Name of Work</label>
												</div>
												<div class="div8">
													<textarea name="workname" readonly="" rows="6" class="textboxdisplay" style="width: 465px;"></textarea>
												</div>
											</div>
											
											<div class="row">
												<div class="div4">
													<label for="fname">Supplementary Work Short Name</label>
												</div>
												<div class="div8">
													<select id="workorderno_supp" name="workorderno_supp" onChange="GetSupplementaryWorkOrderDetails()" class="textboxdisplay" style="width:465px;height:22px;" tabindex="7">
                                                       <option value="">--------------- Select ---------------</option>
                                                    </select> 
													<label id="val_work_supp" style="color:#f10b0b"></label>
												</div>
											</div>
											<div class="row">
												<div class="div4">
													<label for="fname">Supplementary Work Order No.</label>
												</div>
												<div class="div8">
													<input type="text" name='txt_workorder_no_supp' id='txt_workorder_no_supp' class="textboxdisplay" value="" style="width:465px;" readonly=""/>
												</div>
											</div>
										</div>
									</div>
								  	<div class="div2">&nbsp;</div>
								</div>
						   </div>
						   <div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
								<div class="buttonsection">
									<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
								</div>
								<div class="buttonsection">
									<input type="submit" data-type="submit" value=" View " name="submit" id="submit"/>
								</div>
								<div class="buttonsection">
									<input type="button" class="backbutton" name="create" id="create" value="Create New" onClick="CreateNew();"/>
								</div>
							</div>
						   <div class="div12">&nbsp;</div>
                    </blockquote>
                </div>
            </div>
        </div>
	</form>
@endsection

