@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
<div class="content">
		<div class="title"></div>
		<div class="container_12">
			<div class="grid_12">
				<blockquote class="bq1">
					<form name="form" method="post" action="">

						<div class="container">
							<div class="div2">&nbsp;</div>
							<div class="div8 mbtable" >
							  	<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Measurement Book Draft View</div></div></div>
								
								  	<div class="divrowbox innerdiv pt-2">
										<div class="row">
											<div class="div3 label"> 	
												Work Short Name
											</div>
											<div class="div9">
												<select name="cmb_work_no" id="cmb_work_no" onChange="find_workname()" class="tboxclass" style="height: 27px;" tabindex="7">
													<option value="">--------------- Select --------------- </option>
													@if(isset($works))
														@foreach($works as $work)
														<option value="{{ $work['sheetid'] }}">{{ $work['short_name'] }}</option>
														@endforeach
													@endif
												</select>
											</div>
										</div>

										<div class="row">
											<div class="div3 label"> 	
												Work Order No.
											</div>
											<div class="div9">
												<input type="text" name="txt_workorder_no" id="txt_workorder_no" readonly="" rows="6" class="tboxclass">
											</div>
										</div>

										<div class="row">
											<div class="div3 label"> 	
												Name of the Work
											</div>
											<div class="div9">
												<textarea name="workname" id="workname" readonly="" rows="6" class="tboxclass"></textarea>
											</div>
										</div>
										<div class="row">
											<div class="div3 label"> 	
												Measurement Book Type	
											</div>
											<div class="div9">
											<select name="cmb_mbook_type" id="cmb_mbook_type" class="textboxdisplay" style="width:400px;height:22px;" size="" tabindex="7">
                       							 <option value="">---------------------------------Select---------------------------------</option>
												 <option value="G">General M.Book</option>
												 <option value="S">Steel M.Book</option>
                      						</select>
											</div>
										</div>
										<div class="row">
											<div class="div3 label"> 	
												
											</div>
											<div class="div9" id="val_mbooktype" style="color:red">
											</div>
										</div>

										<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
											<div class="buttonsection">
												<input type="button" name="back" value="Back" id="back" class="backbutton" onClick="goBack();" />
												<input type="hidden" class="text" name="submit" value="true" />
												<input  type="hidden" class="text" name="runningbilltext" id="runningbilltext" value=""/>

											</div>	
											<div class="buttonsection" id="view_btn_section">

												<input type="submit" data-type="submit" value=" View " name="btn_view" id="btn_view"/>
												<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="div2">&nbsp;</div>
						</div>
					</form>
				</blockquote>
			</div>
		</div>
	</div>
@endsection