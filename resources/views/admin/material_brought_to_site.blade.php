@extends('layouts.dashboard-master')
@section('content')
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
	<div class="content">
		<div class="title"></div>
        	<div class="container_12">
				<div class="grid_12">
					<blockquote class="bq1">
						<form name="form" method="post" action="">
							<div class="container">
								<div class="row ">
									<div class="div2">&nbsp;</div>
									<div class="div8 mbtable">
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Material Brought to Site Details Entry</div></div></div>									
										<div class="row innerdiv">
											<div class="row">
												<div class="div1">&nbsp;</div>
												<div class="div3">
													<label for="fname">Work Short Name</label>
												</div>
												<div class="div6">
													<select name="cmb_work_no" id="cmb_work_no" onChange="find_workname()" style="width:100%;" class="textboxdisplay">
														<option value="">--------------- Select ---------------</option>
														@if(isset ($data['WorkOrderList']))
														@foreach($data['WorkOrderList'] as $key => $value)
														 @php 
															$SelStr = "";
															if(isset($data['BankBranchData'])){
													 		if($data['BankBranchData']->state_id == $value->state_id){
															$SelStr = 'selected="selected"';
													 			} 
															}
														@endphp
														<option value="{{$value->sheetid}}" {{$SelStr}} >{{$value->short_name}}</option>
														@endforeach
														@endif
													</select>
												</div>
												<div class="div1">&nbsp;</div>
											</div>
											<div class="row">
												<div class="div1">&nbsp;</div>
												<div class="div3">
													<label for="fname">Work Order No.</label>
												</div>
												<div class="div6">
													<input type="text" name="txt_workorder_no" id="txt_workorder_no" readonly="" style="width:100%;" class="textboxdisplay">
												</div>
												<div class="div1">&nbsp;</div>
											</div>
											<div class="row">
												<div class="div1">&nbsp;</div>
												<div class="div3">
													<label for="fname">Material Type </label>
												</div>
												<div class="div6">
													<select name="cmb_type" id="cmb_type" style="width:100%;" class="textboxdisplay">
														<option value="">---------- Select ----------</option>
														@if(isset ($data['MaterialList']))
														@foreach($data['MaterialList'] as $key => $value)
														@php 
															$SelStr = "";
															if(isset($data['BankBranchData'])){
													 		if($data['BankBranchData']->state_id == $value->state_id){
															$SelStr = 'selected="selected"';
													 			} 
															}
														@endphp 
														<option value="{{$value->matid}}" {{$SelStr}}>{{$value->mat_type}}</option>
														@endforeach
														@endif
													</select>
												</div>
												<div class="div1">&nbsp;</div>
											</div>
											<div class="row">
												<div class="div1">&nbsp;</div>
												<div class="div3">
													<label for="fname">Invoice Date</label>
												</div>
												<div class="div6">
													<input type="text" name='txt_from_date' id='txt_from_date' style="width:100%;" class="textboxdisplay" >
												</div>
												<div class="div1">&nbsp;</div>
											</div>
											<div class="row">
												<div class="div1">&nbsp;</div>
												<div class="div3">
													<label for="fname">Quantity</label>
												</div>
												<div class="div6">
													<input type="text" name="txt_qty" id="txt_qty" style="width:100%;" class="textboxdisplay">
												</div>
												<div class="div1">&nbsp;</div>
											</div>
											<div class="row">
												<div class="div1">&nbsp;</div>
												<div class="div3">
													<label for="fname">Quantity Unit </label>
												</div>
												<div class="div6">
													<select name="cmb_qty_unit" id="cmb_qty_unit" style="width:100%;" class="textboxdisplay">
														<option value="">---------- Select ----------</option>
														@if(isset ($data['UnitList']))
														@foreach($data['UnitList'] as $key => $value)
														@php 
															$SelStr = "";
															if(isset($data['BankBranchData'])){
													 			if($data['BankBranchData']->state_id == $value->state_id){
																$SelStr = 'selected="selected"';
													 			} 
															}
														@endphp 
												<option value="{{$value->unitid}}" {{$SelStr}} >{{$value->unit_name}}</option>
												@endforeach
												@endif
													</select>

												</div>
												<div class="div1">&nbsp;</div>
											</div>
											<div class="row">
												<div class="div1">&nbsp;</div>
												<div class="div3">
													<label for="fname">Reference No</label>
												</div>
												<div class="div6">
													<input type="text" name="txt_no" id="txt_no" style="width:100%;" class="textboxdisplay">
												</div>
												<div class="div1">&nbsp;</div>
											</div>
										</div>
										@php $AddUrl = 'admin.viewmaterialbroughttosite'; @endphp
										<div class="row">
											<div class="div12" align="center">
											<input type="button" class="backbutton" name="btn_view" id="btn_view" value=" View " onClick="window.location='{{route($AddUrl)}}'" />
												<input type="submit" data-type="submit" value="Save" name="submit" id="submit"/>
												<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
											</div>
										</div>
										<div class="smediv">&nbsp;</div>
									</div>
									<div class="div2">&nbsp;</div>
								</div>  
							</div>
						</form>
						@if(session()->has('success'))
   							 <div class="alert alert-success">
        						{{ session()->get('success') }}
    						</div>
						@endif	

						@if(session()->has('error'))
    						<div class="alert alert-danger">
        						{{ session()->get('error') }}
    						</div>
						@endif
					</blockquote>
				</div>
			</div>
		</div>
	</body>
</html>

<script>
	$('#cmb_work_no').chosen();
	$('#cmb_type').chosen();
	$('#cmb_qty_unit').chosen();
</script>
@endsection