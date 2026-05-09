@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@php 
	if(isset($data['WorkData'])){ 
		$WorkData = $data['WorkData']; 
		$WorkName = $WorkData->workname;
		$GlobId = $WorkData->globid;
		$WorkOrderNo = $WorkData->work_order_no;
		$Rbn = $WorkData->rbn;
		$SheetId = $WorkData->sheetid;
		$WaitStage = $WorkData->work_stage;
		if($WaitStage == 'RABFTA'){
			$WorkStage = 'Waiting in Forward to Accounts';
		}
	} else {
		$WorkData = array();
	}
	if(isset($data['EmpData'])){
		$EmpDate = $data['EmpData'][0]; 
		$EmpName = $EmpDate->emp_known_as;
	}else{
		$EmpName ='';
	}
@endphp
<style>
	.SpanBoxCheckInfo{
		width:100%;
		font-size:15px;
		border:2px solid #000000;
		border-radius:40px;
		padding-left:8px;
		background:#0490d5;
	}
	.SpanBoxWrongInfo{
		width:100%;
		font-size:15px;
		border:2px solid #000000;
		border-radius:10px;
		padding-left:8px;
		background:#ae1963;
	}
	.SpanBoxInfo{
		width:100%;
		font-size:15px;
		border:2px solid #000000;
		border-radius:10px;
		padding-left:8px;
		background:#cccccc;
	}

	.SpanBoxCheck{
		width:100%;
		margin:0px;
		font-size:13px;
		font-weight:600;
		border:1px solid #025984;
		border-radius:10px;
		padding-left:4px;
		background:#0490d5;
	}
	.SpanBoxCheck:hover .downSpanCheck {
		color: #fff;
		background-color: #8eb6ea;
		border:1px solid #fff;
	}
	.downSpanCheck{
		padding:8px;
		border:1px solid #fff;
		border-radius:50px;
		float:right;
		font-size:13px;
		color: #fff;
		box-shadow: inset 0 0 5px rgba(33, 98, 183, 0.5);
	}
	.downSpanTextCheck{
		top: 8px;
		float:left;
  		position: relative;
		color: #fff;
	}
	.tuploadbtnCheck {
		border: 1px solid #025984;
		font-size: 12px;
		padding: 3px 4px 4px 4px;
		line-height: 12px;
	}
	.tuploadbtnCheck:hover {
		color: #fff !important;
		background-color: #025984 !important;
		border: 1px solid #025984 !important;
	}




	.SpanBoxWrong{
		width:100%;
		margin:0px;
		font-size:13px;
		font-weight:600;
		border:1px solid #860244;
		border-radius:10px;
		padding-left:4px;
		background:#ae1963;
	}
	.SpanBoxWrong:hover .downSpanWrong {
		color: #fff;
		background-color: #F44;
		border:1px solid #fff;
	}
	.downSpanWrong{
		padding:8px;
		border:1px solid #fff;
		border-radius:50px;
		float:right;
		font-size:13px;
		color: #fff;
		box-shadow: inset 0 0 5px rgba(33, 98, 183, 0.5);
	}
	.downSpanTextWrong{
		top: 8px;
		float:left;
  		position: relative;
		color: #fff;
	}
	.tuploadbtnWrong {
		border: 1px solid #860244;
		font-size: 12px;
		padding: 3px 4px 4px 4px;
		line-height: 12px;
	}
	.tuploadbtnWrong:hover {
		color: #fff !important;
		background-color: #860244 !important;
		border: 1px solid #860244 !important;
	}




	.SpanBox{
		width:100%;
		margin:0px;
		font-size:13px;
		font-weight:600;
		border:1px solid #001a00;
		padding-left:4px;
		background:#cccccc;
	}
	.SpanBox:hover .downSpan {
		color: #fff;
		background-color: #808080;
		border:1px solid #fff;
	}
	.downSpan{
		padding:8px;
		border:1px solid #fff;
		border-radius:50px;
		float:right;
		font-size:13px;
		color:#333333;
		box-shadow: inset 0 0 5px rgba(33, 98, 183, 0.5);
	}
	.downSpanText{
		top: 8px;
		float:left;
  		position: relative;
		color: #333333;
	}
	.tuploadbtn {
		border: 1px solid #808080;
		font-size: 12px;
		padding: 3px 4px 4px 4px;
		line-height: 12px;
	}
	.tuploadbtn:hover {
		color: #000000 !important;
		background-color: #808080 !important;
		border: 1px solid #808080 !important;
	}



	.tooltip-l {
		position: relative;
		display: block;
	}
	.panel-body {
 		padding: 4px;
	}
	.div3{
		color:black;
	}
</style>


<form action="{{route('admin.WorkTenderCancelConfirm')}}" method="post" enctype="multipart/form-data" name="form">
	<div class="content">
		<div class="title"></div>
		<div class="container_12">
			<div class="grid_12">
				<blockquote class="bq1" style="overflow:auto">
					<div class="container">
						<div class="row plr">
							<div class="div12 mbtable">
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Work or Tender Cancel Confirmation</div></div></div>
								<div class="row innerdiv">
									<div class="row">
										<table class="table-bordered dataTable no-footer" align="center" id="dataTable">
											<thead>
												<tr>
													<th class="colhead" colspan="3" nowrap="nowrap">
														<div class="row">
															<div class="div3 lboxlabel" style="margin-top:0px">
																Work Information
															</div>
															<div class="div9 rboxlabel" style="margin-top:0px">
																<div class="row row-fluid line-control-menu-bar formtitlebar" style="border:none;padding-top:0px; background:none;">
																	@php 
																		$BackUrl ='admin.WorkTenderCancel';
																	@endphp
																	<div class="btn-group floatr">
																		<button type="button" class="btn btn-default btnprimary" title="Back" name="back" id="back" value=" BACK " onclick="window.location='{{ route($BackUrl) }}'"><i class="fa fa-arrow-circle-o-left pt2"></i> Back</button>
																	</div>
																	<div class="btn-group">
																		<button type="submit" class="btn btn-default btninfo" data-usercnt="" name="btn_save" id="btn_save" value=" CONFIRM " data-name="btn_save"><i class="fa fa-check pt2"></i> Confirm </button>
																	</div>
																</div>
															</div>
														</div>
													</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td class="colhead" style="vertical-align: text-top;width:50%">
														@if(isset($WorkData))
															<div class="row border-b">
																<div class="div3 lboxlabel" >Work Name</div>
																<div class="div9 lboxlabel">: @if(isset($WorkName)){{ $WorkName }}@endif</div>
															</div>
															<div class="row">
																<div class="div3 lboxlabel">Reference No</div>
																<div class="div9 lboxlabel">: @if(isset($WorkData->ref_no)){{ $WorkData->ref_no }}@endif</div>
															</div>
															<div class="row">
																<div class="div3 lboxlabel">Work Created by</div>
																<div class="div9 lboxlabel">: @if(isset($WorkData->works_created_by)){{$EmpName}} ( <span style="color:red;">{{ $WorkData->works_created_by}}</span> ) @endif</div>
															</div>
															@if(isset($WorkData->ts_no))
															<div class="row">
																<div class="div3 lboxlabel">Technical Scantion No.</div>
																<div class="div9 lboxlabel">: {{ $WorkData->ts_no }}</div>
															</div>
															@endif
															@if(isset($WorkData->tr_no))
															<div class="row">
																<div class="div3 lboxlabel">Tender No.</div>
																<div class="div9 lboxlabel">: {{ $WorkData->tr_no }}</div>
															</div>
															@endif
															@if(isset($WorkData->work_order_no))
															<div class="row">
																<div class="div3 lboxlabel">WorkOrder No.</div>
																<div class="div9 lboxlabel">: {{ $WorkData->work_order_no }}</div>
															</div>
															@endif
															<div class="row">
																<div class="div3 lboxlabel">Work Stage </div>
																<div class="div9 lboxlabel">: @if(isset($WorkData->work_stage)){{ Helper::GetWorkStage($WorkData->work_stage) }}@endif</div>
															</div>
															<div class="row" >
																<div class="div12 divhead" style="text-align:center;">Delete Stage Wise</div>
															</div>
															<div class="row">
																<div class="div5 lboxlabel" style="margin:6px;">Cancel Complete Work</div>
																<div class="div6 lboxlabel"><input name="del_stage_wise" type="radio" value="DCW" checked></div>
															</div>
															<div class="row">
																<div class="div5 lboxlabel" style="margin:6px;">Technical sanction<span style="color:red;"> (Delete TS and After TS)</span> </div>
																<div class="div6 lboxlabel"><input name="del_stage_wise" type="radio" value="TS"></div>
															</div>	
															<div class="row">
																<div class="div5 lboxlabel" style="margin:6px;">NIT<span style="color:red;"> (Delete NIT and After NIT)</span> </div>
																<div class="div6 lboxlabel"><input name="del_stage_wise" type="radio" value="NIT"></div>
															</div>																
															<input type="hidden" name="hid_globid" id="hid_globid" value="{{ encrypt($GlobId) }}" />
															<input type="hidden" name="hid_ts_id" id="hid_ts_id" value="@if(isset($WorkData->ts_id)){{ encrypt($WorkData->ts_id) }}@endif" />
															<input type="hidden" name="hid_Work_stage" id="hid_Work_stage" value="@if(isset($WorkData->work_stage)){{ encrypt($WorkData->work_stage) }}@endif" />
														@endif
													</td>
													<td class="colhead" nowrap="nowrap" style="vertical-align: text-top;">
														<div class="panel-body border">
															<div class="row">
																<div class="div12 lboxlabel">&nbsp;Remarks <span class="reqindi">*</span></div>
															</div>
															<div class="smclearrow"></div>
															<div>
																<textarea name="txt_remarks" id="txt_remarks" max="1000" rows="10" class="tboxsmclass"></textarea>
															</div>
														</div>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
					     	</div> 
							<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
							<div class="div12">&nbsp;</div> 
						</div>
					</div>
				</blockquote>
			</div>
		</div>
	</div>
</form>
<script>
	
	var KillEvent = 0;
	$("body").on("click","#btn_save", function(event){
		if(KillEvent == 0){
			var Remarks  	= $("#txt_remarks").val();
			if(Remarks == ""){
				BootstrapDialog.alert("Remarks should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else{ 
				event.preventDefault();
				BootstrapDialog.confirm({
					title: 'Confirmation Message',
					message: 'Are you sure want to Cancel this Work ?',
					closable: false,
					draggable: false, 
					btnCancelLabel: 'Cancel', 
					btnOKLabel: 'Ok', 
					callback: function(result) {
						if(result){
							KillEvent = 1;
							$("#btn_save").trigger( "click" );
						}else {
							KillEvent = 0;
						}
					}
				});
			}
		}
	});


</script>

@endsection