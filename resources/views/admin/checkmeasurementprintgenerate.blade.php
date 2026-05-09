@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
<div class="content">
		<div class="title"></div>
		<div class="container_12">
			<div class="grid_12">
				<blockquote class="bq1">
					<form name="form" method="post" action="CheckMeasurementPrintView.php">

						<div class="container">
							<div class="div2">&nbsp;</div>
							<div class="div8 mbtable" >
							  	<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Check Measurement Print</div></div></div>
								
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

										<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
											<div class="buttonsection">
												<input type="button" name="back" value="Back" id="back" class="backbutton" onClick="goBack();" />
											</div>	
											<div class="buttonsection" id="view_btn_section">
												<input type="submit" data-type="submit" value=" View " name="btn_view" id="btn_view"/>
												<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
											</div>
										</div>
									</div>
									<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
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
