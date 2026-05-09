@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@php
 if(isset($data['Empdata'])){
	$Empdata  = $data['Empdata'];
	$ICNo     = collect($Empdata)->pluck('emp_no')->first();
	$EmpName  = collect($Empdata)->pluck('emp_first_name')->first();
	$EmpDOB   = collect($Empdata)->pluck('emp_dob')->first();
	$EmpDOJ   = collect($Empdata)->pluck('emp_doj')->first();
	$EmpRET   = collect($Empdata)->pluck('emp_retirement_dt')->first();
	$Desig    = collect($Empdata)->pluck('designation_name')->first();
	$GroupId  = collect($Empdata)->pluck('group')->first();
	$DivId    = collect($Empdata)->pluck('division_short_name')->first();
	$SecId    = collect($Empdata)->pluck('section')->first();
}

 if(isset($data['Familydata'])){
	$Familydata  = $data['Familydata'];
	$DependentId = collect($Familydata)->pluck('dependant_name')->first();
	$RealationId = collect($Familydata)->pluck('relationship_name')->first();
	$FamilyDOB   = collect($Familydata)->pluck('fam_member_dob')->first();
}

if(((session('WcmsRoleGroupCode') == "ADMUSER")||(session('WcmsRoleGroupCode') == "SUPUSER"))){
	$IsAdmin = 1;
}else{
	$IsAdmin = 0;
}

if(isset($data['EditCliamData']))
{
	$EditCliamData = $data['EditCliamData'];
	$NewFamilyMembData = json_decode($EditCliamData->new_value);
	$ChangeRequestId  = $EditCliamData->change_req_id;
}

$RelIndex = 1;

if(isset($data['Page'])){
	$Page = $data['Page'];
	
}else{
	$Page = NULL;
}

@endphp
<style>
    
	
</style>

<form action="" method="post" enctype="multipart/form-data" name="form">
	<div class="content">
		<div class="title"></div>
		<div class="container_12">
			<div class="grid_12">
				<blockquote class="bq1" style="overflow:auto">
					<div class="container">
						<div class="row plr">
              				<!-- <div class="div1"></div> -->
							<div class="div12 mbtable">
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Family Member Update -  Request Form</div></div></div>
								<div class="row innerdiv">
									<div class="row"> 
										 <!-- Form Steps --> 
										<div class="form-step active"> 
											
											<fieldset class="fieldbox">
												<legend class="fieldbox-legend">Basic information</legend>
												<div class="fieldbox-div">
													<!-- @if($IsAdmin == 1)
													<div class="div2 label label">Employee</div>
													<div class="div2">
														<select name="txt_emp_icno" id="txt_emp_icno" class="tboxsmclass ChosenInput">
															<option value="">-------- Select------</option>
															@if(isset($data['UserData']))
															@foreach($data['UserData'] as $UserData)
																	<option value="{{$UserData->emp_no}}">{{$UserData->emp_first_name}} (IC No.{{$UserData->emp_no}}, {{$UserData->designation_name}})</option>
															@endforeach
															@endif
														</select>
													</div>
													@else
													<div class="div2 label label">IC No</div>
													<div class="div2"><input type="text" name="txt_emp_icno" id="txt_emp_icno" class="tboxsmclass" value="@if((isset($ICNo))&&($IsAdmin == 0)){{$ICNo}}@endif"></div>
													@endif -->
													<div class="row smclearrow"></div>
													<div class="div2 label">IC No.</div> 
													<div class="div2"><input type="text" name="txt_emp_icno" id="txt_emp_icno" class="tboxsmclass" value="@if(isset($ICNo)){{$ICNo}}@endif" readonly></div>
													<div class="div2 label pd-l-20">Name</div>
													<div class="div2"><input type="text" name="txt_payslip_name" id="txt_payslip_name" class="tboxsmclass" value="@if(isset($EmpName)){{$EmpName}}@endif" readonly></div>
													<div class="div2 label pd-l-20">Designation</div>
													<div class="div2"><input type="text" name="txt_designation" id="txt_designation" class="tboxsmclass" value="@if(isset($Desig)){{$Desig}}@endif" readonly></div>
													<div class="div2 label">Date of Birth</div>
													<div class="div2"><input type="text" name="txt_dob" id="txt_dob" class="tboxsmclass" value="@if(isset($EmpDOB)){{Helper::DisplayDateFormat($EmpDOB)}}@endif" readonly></div>
													<div class="div2 label pd-l-20">Date of Joining</div>
													<div class="div2"><input type="text" name="txt_doj" id="txt_doj" class="tboxsmclass" value="@if(isset($EmpDOJ)){{Helper::DisplayDateFormat($EmpDOJ)}}@endif" readonly></div>
													<div class="div2 label pd-l-20">Date of Retirement</div>
													<div class="div2"><input type="text" name="txt_date_retire" id="txt_date_retire" class="tboxsmclass" value="@if(isset($EmpDOJ)){{Helper::DisplayDateFormat($EmpDOJ)}}@endif" readonly></div>
													<div class="div2 label label">Group</div>
													<div class="div2"><input type="text" name="txt_group" id="txt_group" class="tboxsmclass" value="@if(isset($GroupId)){{$GroupId}}@endif" readonly></div>
													<div class="div2 label pd-l-20">Divison</div>
													<div class="div2"><input type="text" name="txt_div" id="txt_div" class="tboxsmclass" value="@if(isset($DivId)){{$DivId}}@endif" readonly></div>
													<div class="div2 label pd-l-20">Section</div>
													<div class="div2"><input type="text" name="txt_sec" id="txt_sec" class="tboxsmclass" value="@if(isset($SecId)){{$SecId}}@endif" readonly></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
												</div>
											</fieldset>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											<fieldset class="fieldbox">
												<legend class="fieldbox-legend"> Existing Family Member Information</legend>
												<div class="fieldbox-div">
													<div class="div12">                                                                        											
												<table class="formtable" align="center" id="" width="100%">
													<thead>
														<tr>
															<th style="width:250px">Sno.</th>
															<th style="width:250px">Dependent Name</th>
															<th style="width:250px">Relationship Name</th>
															<th>Name</th>
															<th>Date of Birth</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															@if(isset($data['Familydata']))
																@foreach($data['Familydata'] as $Familydata)
																<tr>
																	<td align="center">{{ $loop->iteration }} </td>
																	<td align="left">{{ $Familydata->dependant_name }}</td>
																	<td align="left">{{ $Familydata->relationship_name }}</td>
																	<td align="left">{{ $Familydata->fam_member_name }}</td>
																	<td align="left">{{ Helper::DisplayDateFormat($Familydata->fam_member_dob) }}</td>
																	<td align="center"><input type="button" class="backbutton" name="btn_edit" id="btn_edit" value=" Edit" /></td>
																</tr>
																@endforeach
															@endif
														</tr>
													</tbody>
													</table>
												</div>
												<div class="row smclearrow"></div>
												<div class="row smclearrow"></div>
												<div class="row smclearrow"></div>
												</div>
											</fieldset>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											<fieldset class="fieldbox">
												<legend class="fieldbox-legend"> New Family Member  Information</legend>
												<div class="fieldbox-div">
													<div class="div12">                                                                        											
												<table class="formtable" align="center" id="RelationshipTable" width="100%">
													<thead>
														<tr>
															<th style="width:250px">Dependent Name</th>
															<th style="width:250px">Relationship Name</th>
															<th>Name</th>
															<th>Date of Birth</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td>
																<select name="cmb_dependent_0" id="cmb_dependent_0" class="tboxsmclass ChosenInput"> 
																	<option value=""> ---- Select ---- </option> 
																	@if(isset($data['DependentData']))
																		@foreach($data['DependentData'] as $DependentData)
																			<option value="{{ $DependentData->dependant_id }}">{{ $DependentData->dependant_name }}</option> 
																		@endforeach
																	@endif
																</select>		
															</td>
															<td>
																<select name="cmb_relationship_0" id="cmb_relationship_0" class="tboxsmclass ChosenInput"> 
																	<option value=""> ---- Select ---- </option>
																</select>
															</td>
															<td>
																<input type="text" name="txt_rel_name_0" id="txt_rel_name_0" class="tboxsmclass" value="">
															</td>
															<td>
																<input type="text" name="txt_dob_rel_0" id="txt_dob_rel_0" class="tboxsmclass datepicker" value="">
															</td>
															<td align='center'>
																<i class="fa fa-plus-square sqadd ptr inp disable" id="AddTechRec" style="font-size:24px;"></i>
															</td>
														</tr> 
														 @if(isset($NewFamilyMembData))
															@foreach($NewFamilyMembData as $NewFamilyDtKey => $NewFamilyData)
																<tr>
																	<td><input type='hidden' name='hid_dependant_id[]' id='hid_dependant_id_{{$RelIndex}}' class='tboxsmclass' value='{{ $NewFamilyData->dependant_id }}'><input type='text' name='txt_dependant_name[]' id='txt_dependant_name' class='tboxsmclass' value='{{ $NewFamilyData->dependant_name }}'></td>
																	<td><input type='hidden' name='txt_relationship[]' id='txt_relationship_{{$RelIndex}}'class='tboxsmclass' value='{{ $NewFamilyData->relationship_id }}'><input type='text' name='txt_relationship_name[]' id='txt_relationship_name' class='tboxsmclass' value='{{ $NewFamilyData->relationship_name }}'></td>
																	<td><input type='text' name='txt_rel_name[]' id='txt_rel_name_{{$RelIndex}}' class='tboxsmclass' value='{{ $NewFamilyData->rel_name }}'></td>
																	<td><input type='text' name='txt_dob_rel[]' id='txt_dob_rel_{{$RelIndex}}' class='tboxsmclass datepicker' value='{{ $NewFamilyData->dob_rel }}'></td>
																	<td align='center'><i class='fa fa-times-circle sqdel ptr disable DeleteRow' id='DelRelationshipDetails' style='font-size:24px'></i></i></td>
																</tr>
															@php $RelIndex++; @endphp
															@endforeach
														@endif
													</tbody>
													</table>
												</div>
												<div class="row smclearrow"></div>
												<div class="row smclearrow"></div>
												<div class="row smclearrow"></div>
												</div>
											</fieldset>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
										</div>
										@php 
										if($Page == 'ALLREQ'){
											$BackUrl = 'all-request-update.family-members-update'; 
										}else{
											$BackUrl = 'request-updates.family-members-update'; 
										}
										@endphp
									<div class="row" align="center">
										<input type="button" class="backbutton" name="btn_view" id="btn_view" value=" Back " onClick="window.location='{{route($BackUrl)}}'" />
										<button type="submit" id="btn_save" name="btn_save" class="step-btn" value="Save">SAVE</button> 
										<input type  ="hidden" name="hid_change_id" id="hid_change_id" value="@if(isset($ChangeRequestId)){{$ChangeRequestId}}@endif" />
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="div12" align="center">
							<input type="hidden" name="txt_tab" id="txt_tab" value="1" />
							<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
						</div>
					</div>
               				                      
				</blockquote>
			</div>
		</div>
	</div>
</form>
<script>
$(".ChosenInput").chosen();	
/* $("body").on("change", "#txt_emp_icno", function (event) {
	//alert();
    var EmpNo = $(this).val();
    if ((EmpNo!='') && (EmpNo!=null)) {

        $.ajax({
            type: 'POST',
            url: "{{ route('employee.GetEmployeeData') }}",
            data: { "_token": "{{ csrf_token() }}", 'EmpNo': EmpNo },
            // dataType: 'json',
            success: function (data) {
                if (data != '') {
                    let EmpData = data['EmpData']; console.log(EmpData);
                    if ((EmpData != '') && (EmpData != null)) {
                        //$("#section_name").empty();
                        $.each(EmpData, function (index, element) {
						   var Dob = GlobalFormatDateDDMMYYYY(element.emp_dob);
						   var Doj = GlobalFormatDateDDMMYYYY(element.emp_doj);
						   var Dor = GlobalFormatDateDDMMYYYY(element.emp_retirement_dt);
						   $("#txt_icno").val(element.emp_no);
                           $("#txt_payslip_name").val(element.emp_name_payslip);
                           $("#txt_designation").val(element.designation_name);
                           $("#txt_dob").val(Dob);         
                           $("#txt_doj").val(Doj);
                           $("#txt_date_retire").val(Dor);
                           $("#txt_group").val(element.group);
                           $("#txt_div").val(element.division_short_name);
                           $("#txt_sec").val(element.section);
                           
                        });
                    }else{
						BootstrapDialog.alert("Please Enter the Correct Employee Number");
						$("#txt_emp_no").val(''); 
					}
                }
            }
        });
    }
	
}); */
$("body").on("change","#cmb_dependent_0", function(event){
		let Dependent = $(this).val();
		$("#cmb_relationship_0").chosen('destroy'); 
		$('#cmb_relationship_0').children('option:not(:first)').remove();
		$.ajax({
			type: 'POST',
			url: '{{ route("relationship.get-relationship") }}',
			data: { "_token": "{{ csrf_token() }}", Dependent: Dependent },
			dataType: 'json',
			success: function (data) {
				if(data) {
					$.each(data, function(key, value){
						$("#cmb_relationship_0").append('<option value="' + value.relationship_id + '">' + value.relationship_name + '</option>');
					});
				}
				$("#cmb_relationship_0").chosen(); 
			}
		});
	});
	var RelIndex = {{ $RelIndex }};
	$(document).on('click','#AddTechRec',function(){
		var DependentName   = $('#cmb_dependent_0 option:selected').text();
		var DependentId     = $('#cmb_dependent_0 option:selected').val();
		var RelationshipName = $('#cmb_relationship_0 option:selected').text();
		var RelationshipId = $('#cmb_relationship_0 option:selected').val();
		var RelName = $('#txt_rel_name_0').val();
		var RelDob = $('#txt_dob_rel_0').val();
		let tablestr = "";
		tablestr += "<tr>";
		tablestr += "<td><input type='hidden' name='hid_dependant_id[]' id='hid_dependant_id_"+RelIndex+"' class='tboxsmclass' value='" +DependentId+ "'><input type='text' name='txt_dependant_name[]' id='txt_dependant_name' class='tboxsmclass' value='"+DependentName+"'></td>";
		tablestr += "<td><input type='hidden' name='txt_relationship[]' id='txt_relationship_"+RelIndex+"'class='tboxsmclass' value='" +RelationshipId+ "'><input type='text' name='txt_relationship_name[]' id='txt_relationship_name' class='tboxsmclass' value='"+RelationshipName+"'></td>";
		tablestr += "<td><input type='text' name='txt_rel_name[]' id='txt_rel_name_"+RelIndex+"' class='tboxsmclass' value='"+RelName+"'></td>";
		tablestr += "<td><input type='text' name='txt_dob_rel[]' id='txt_dob_rel_"+RelIndex+"' class='tboxsmclass datepicker' value='"+RelDob+"'></td>";
		tablestr += "<td align='center'><i class='fa fa-times-circle sqdel ptr disable DeleteRow' id='DelRelationshipDetails' style='font-size:24px'></i></i></td>";
		tablestr += "</tr>";
		$("#RelationshipTable").append(tablestr);
		$('#cmb_dependent_0').chosen('destroy');
		$('#cmb_dependent_0').val('');
		$('#cmb_dependent_0').chosen();
		$('#cmb_relationship_0').chosen('destroy');
		$('#cmb_relationship_0').val('');
		$('#cmb_relationship_0').chosen();
		$('#txt_rel_name_0').val('');
		$('#txt_dob_rel_0').val('');
		RelIndex++;
	});
	$(document).on('click','.DeleteRow',function(){
		$(this).closest("tr").remove();
	}); 
</script>
@endsection
