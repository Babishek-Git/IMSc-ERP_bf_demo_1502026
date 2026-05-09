@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@php
if(isset($data['StRemarkData'])){	
	$StRemarkData = $data['StRemarkData'][0];
	$StRemId = $StRemarkData->stremid; 
	$Remarks = $StRemarkData->remark; 
	$ModuleCode = $StRemarkData->module_code; 
	$OfficeId = $StRemarkData->office_id; 
}
$ModuleOptions = [
    'DEU'    => 'Tender Estimate',
    'TS'     => 'Technical Sanction',
    'RTS'    => 'Revised Technical Sanction',
    'NIT'    => 'Notice Inviting Tender',
    'CST'    => 'Comparative Statement',
    'NCST'   => 'Negotiate Comparative Statement',
    'LOI'    => 'LOA',
    'PGU'    => 'Performance Guarantee (User)',
    'WO'     => 'Work Order',
    'RABUC'  => 'BILL FORWARD TO CHECK & APPROVE',
    'BILLV'  => 'Bill Verification',
    'GSTRU'  => 'GST Reimbursement (User)',
    'GSTRA'  => 'GST Reimbursement (Accounts)',
];
@endphp
<div class="content">
	<div class="title"></div>
	<div class="container_12">
		<div class="grid_12">
			<blockquote class="bq1" style="overflow:auto">
				<form name="form"  method="post" action="">
					<div class="container" align="center">
						<div class="div1 "></div>
							<div class="div10 mbtable"  align="center">
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Standard Remarks Entry</div></div></div>
									<div class="divrowbox innerdiv pt-2">
										<div class="div8 formbox" style="margin:0 0 0 17%;">						
											<div class="row">
												<div class="div2 label" align="center" >
													Division
												</div>
												<div class="div8">
													<select class="group tboxclass" name="cmb_division" id="cmb_division">
														@if(session('WcmsRoleGroupCode') == 'SUPUSER')
															<option value="">For all Division</option>
														@endif
														@if(isset($data['OfficeList']))
															@foreach($data['OfficeList'] as $key => $value)
															@php
																if(isset($OfficeId) && $value->office_id == $OfficeId){
																	$OfficeStr = 'selected="selected"';
																}else{
																	$OfficeStr = '';
																}
																@endphp
																@if((session('WcmsRoleGroupCode') == 'ADMUSER' && $value->office_id == session('WcmsEmpDiv') && $value->active == 1) || (session('WcmsRoleGroupCode') == 'ACCADMUSER' && $value->office_id == session('WcmsEmpDiv') && $value->active == 1))
																	@if($value->active == 1)
																		<option {{$OfficeStr}} value="{{$value->office_id}}">{{$value->office_name}}</option>																	
																	@endif
																@elseif((session('WcmsRoleGroupCode') == 'SUPUSER' && $value->active == 1))
																	<option {{$OfficeStr}}  value="{{$value->office_id}}">{{$value->office_name}}</option>
																@endif
															@endforeach
														@endif
													</select>
												</div>
											</div>
											<div class="row">
												<div class="div2 label" align="center" >
													Module <span class="reqindi">*</span>
												</div>
												<div class="div8">
													<select name="cmb_module_code" id="cmb_module_code" class="tboxclass" width="100%">
														<option value="">------------------select-----------------</option>
														@foreach($ModuleOptions as $Value => $Label)
															@php
															if(isset($ModuleCode) && $Value == $ModuleCode){
																$Str = 'selected="selected"';
															}else{
																$Str = '';
															}
															@endphp
    													    <option {{$Str}} value="{{ $Value }}">{{ $Label }}</option>
    													@endforeach
													</select>
												</div>
											</div>
											<div class="row">										
												<div class="div2 label" align="center" >
													Remark <span class="reqindi">*</span>
												</div>
												<div class="div8">
													<input type="text" name="txt_remarks_content" id="txt_remarks_content" class="tboxclass  dates" value="@if(isset($Remarks)){{$Remarks}}@endif">
													<input type="hidden" name="hid_remarks" id="hid_remarks" class="tboxclass  dates" value="@if(isset($StRemId)){{encrypt($StRemId)}}@endif">
												</div>
											</div>
											<div class="clearrow"></div>											
											<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
												<div class="buttonsection" id="next_btn_section">
													<input type="submit" data-type="submit" value="Save" name="btn_save" id="btn_save" />
													<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
												</div>
												<div class="buttonsection" id="next_btn_section">
													<input type="button" class="backbutton" value="View" name="btn_view" id="btn_view" onclick="window.location='{{ route('admin.ViewStandardRemarks') }}'"/>
												</div>
											</div>
										</div>
										<div class="clearrow"></div>
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
<script type="text/javascript" language="javascript">
	$(document).ready(function(){	
		$("#cmb_module_code").chosen();
		$("#cmb_division").chosen();
		$("body").on("click", "#btn_save", function(event) {
			var RemarkCon = $("#txt_remarks_content").val();
			var ModuleCode = $("#cmb_module_code").val();
			if(ModuleCode == ""){
				BootstrapDialog.alert("Please Select the Module");
				event.preventDefault;
				return false;
			}else if(RemarkCon == ''){
				BootstrapDialog.alert("Please Enter Remarks Content");
				event.preventDefault;
				return false;
			}
		});		
	});
</script>
@endsection