@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@php
$RegEmpData = $data['RegEmpData'];
$EmpGroupId = $RegEmpData->employee_group_type;
$EmpPay     = $data['paydetail'];
$selectedPay     = $data['selectedPay'] ?? [];

@endphp
<style>
    .checkbox{
		margin-top: 5px;
  		margin-bottom: 5px;
	}
	
	.checkbox-group h2 {
		color: #667eea;
		margin-bottom: 15px;
		font-weight: 600;
	}
	input[type="checkbox"] {
		display: none;
	}
	.checkbox-wrapper-2 {
		display: flex;
		align-items: center;
		perspective: 1000px;
	}

	.checkbox-wrapper-2 label {
		display: flex;
		align-items: center;
		cursor: pointer;
		font-size: 12px;
		color: #0000CD;
		font-weight: bold;
	}

	.checkbox-wrapper-2 .checkbox {
		width: 25px;
		height: 25px;
		margin-right: 15px;
		position: relative;
		transform-style: preserve-3d;
		transition: transform 0.6s;
	}

	.checkbox-wrapper-2 .checkbox-front,
	.checkbox-wrapper-2 .checkbox-back {
		width: 100%;
		height: 100%;
		position: absolute;
		backface-visibility: hidden;
		border-radius: 12px;
		display: flex;
		align-items: center;
		justify-content: center;
		font-size: 15px;
		font-weight: bold;
	}

	.checkbox-wrapper-2 .checkbox-front {
		background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
		color: white;
	}

	.checkbox-wrapper-2 .checkbox-back {
		background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
		transform: rotateY(180deg);
		color: white;
	}

	.checkbox-wrapper-2 input:checked + label .checkbox {
		transform: rotateY(180deg);
	}
	.bottom-border {
		position: relative;
		padding: 1px 0;
		margin-bottom: 10px;
	}

	.bottom-border::after {
		content: '';
		position: absolute;
		bottom: 0;
		left: 50%;
		transform: translateX(-50%);
		width: 100%;
		height: 1px;
		background: linear-gradient(90deg, 
			transparent 0%, 
			#ccc 20%, 
			#ccc 50%, 
			#ccc 80%, 
			transparent 100%
		);
	}
</style>
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
    <form action="" method="post" enctype="multipart/form-data" name="form">
        <div class="content">
		    <div class="title"></div>
		        <div class="container_12">
			        <div class="grid_12">
				        <blockquote class="bq1" style="overflow:auto">
					        <div class="container">
						        <div class="row plr">
							        <div class="div12 mbtable">
                                        <div class="row">
                                            <div class="div12" style="margin-top:0px;">
                                                <div class="row divhead" align="center">Employee Pay Registration</div>
                                            </div>
                                        </div>
								        <div class="row innerdiv"> 
                                            <div class="card-body padding-3 ChartCard" id="CourseChart">
                                                <div class="row smclearrow"></div> 
                                                <fieldset class="fieldbox">
                                                    <div class="row">
                                                        @php $AddUrl = 'employee.view-pay';  @endphp
                                                        <div class="div12" align="right">
                                                            <input type="button" class="backbutton" name="btn_view" id="btn_view" value=" Back " onClick="window.location='{{route($AddUrl)}}'" />
                                                            <input type="submit" class="backbutton" name="btn_save" id="btn_save" value=" Save " />									
                                                            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                                        </div>		
                                                    </div>
                                                    <legend class="fieldbox-legend">Basic information</legend>
                                                    <div class="fieldbox-div">
                                                        <div class="div2 label">Employee Group <span class="reqindi">*</span></div>
                                                        <div class="div2">
                                                            <select name="cmb_employment_group" id="cmb_employment_group" class="tboxsmclass ChosenInput">
                                                                @if(isset($data['employeeGroupMaster']))
                                                                    @foreach($data['employeeGroupMaster'] as $EmployeeGroupMasterList)
                                                                        <option value="{{$EmployeeGroupMasterList->emp_group_id}}">{{$EmployeeGroupMasterList->emp_group_name}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                        <div class="div2 label label pd-l-20">IC No <span class="reqindi">*</span></div>
                                                        <div class="div2"><input type="text" name="txt_emp_icno" id="txt_emp_icno" class="tboxsmclass" value="{{$RegEmpData->emp_no}}"></div>	
                                                        <div class="row smclearrow"></div>
                                                        <div class="div2 label">Name in Payslip <span class="reqindi">*</span></div>
                                                        <div class="div6"><input type="text" name="txt_payslip_name" id="txt_payslip_name" class="tboxsmclass" value="{{$RegEmpData->emp_name_payslip}}"></div>
                                                        <div class="row smclearrow"></div>
                                                        <div class="row smclearrow"></div>
                                                    </div>
                                                </fieldset>
                                                <div class="row smclearrow"></div>
                                                <div class="row smclearrow"></div>
                                                <fieldset class="fieldbox">
                                                    <legend class="fieldbox-legend">Pay Information</legend>
                                                    @if(!in_array('EPROJECT', $data['menuCodes']))
                                                    <div class="fieldbox-div">
                                                        <div class="div2 label pd-l-20">Level <span class="reqindi">*</span></div>
                                                        <div class="div2"> 
                                                            <select name="cmb_pay_level" id="cmb_pay_level" class="tboxsmclass ChosenInput">
                                                                <option value="">------ Select ------</option>
                                                                @if(isset($data['PayLevelData']))
                                                                @foreach($data['PayLevelData'] as $PayLevelDt)
                                                                    <option value="{{$PayLevelDt->pay_level}}" {{ isset($EmpPay->pay_level) && $EmpPay->pay_level == $PayLevelDt->pay_level ? 'selected' : '' }}>{{$PayLevelDt->pay_level_name}}</option>
                                                                @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                        <div class="div2 label pd-l-20">Pay In Level <span class="reqindi">*</span></div>
                                                        <div class="div2"><input type="text" name="txt_basic_pay" id="txt_basic_pay" class="tboxsmclass" value="{{ $EmpPay->basic_salary ?? '' }}"></div>
                                                        <div class="div2 label pd-l-20">Date of Next Increment <span class="reqindi">*</span></div>
                                                        <div class="div2"><input type="text" name="txt_next_incr_dt" id="txt_next_incr_dt" class="tboxsmclass datepicker" 
                                                            value="{{ isset($EmpPay->next_increment_dt) ? \Carbon\Carbon::parse($EmpPay->next_increment_dt)->format('d/m/Y') : '' }}"></div>
                                                        <div class="row smclearrow"></div>
                                                        <div class="row smclearrow"></div>
                                                        <div class="row smclearrow"></div>
                                                    </div>
                                                    @else
                                                    <div class="fieldbox-div">
                                                        <div class="div2 label pd-l-20">Pay <span class="reqindi">*</span></div>
                                                        <div class="div2"><input type="text" name="txt_basic_pay" id="txt_basic_pay" class="tboxsmclass" value="{{ $EmpPay->basic_salary ?? '' }}"></div>
                                                        <div class="row smclearrow"></div>
                                                        <div class="row smclearrow"></div>
                                                        <div class="row smclearrow"></div>
                                                    </div>
                                                    @endif
                                                </fieldset>
                                                <div class="row smclearrow"></div>
                                                <div class="row smclearrow"></div>
                                                <div class="row smclearrow"></div>
                                                <div class="row smclearrow"></div>
                                                <fieldset class="fieldbox">
                                                    <legend class="fieldbox-legend">Pay Structure Information</legend>
                                                    <div class="fieldbox-div">
                                                        @if(isset($data['payComponents']))
                                                        @foreach($data['payComponents'] as $payComponents)
                                                            @php 
                                                            $ShowComponent = 0;
                                                            $ApplicableEmpGroup = $payComponents->applicable_emp_group;
                                                            if($ApplicableEmpGroup != NULL){
                                                                $ApplicableEmpGroupArr = explode(',',$ApplicableEmpGroup);
                                                                if (in_array($EmpGroupId, $ApplicableEmpGroupArr)) {
                                                                    $ShowComponent = 1;
                                                                }
                                                            }
                                                            @endphp
                                                            @if($ShowComponent == 1)
                                                            <div class="div4 label pd-l-20 no-margin">
                                                                <div class="checkbox-group">
                                                                    <div class="checkbox-wrapper-2">
                                                                        @php 
                                                                        if(in_array($EmpGroupId,[9,10]) && ($payComponents->component_name == 'DA')){
                                                                            $CheckedStr 	= 'checked="checked"';
                                                                            $ChActiveClass 	= 'readonly-checkbox';
                                                                        }else{
                                                                            $CheckedStr 	= '';
                                                                            $ChActiveClass 	= '';
                                                                        }
                                                                        @endphp
                                                                        <input type="checkbox" class="{{$payComponents->component_code}}{{ $ChActiveClass }} PayComponent" data-code="{{$payComponents->component_code}}" name="ch_pay_components[{{$payComponents->component_id}}]" id="{{$payComponents->component_id}}" 
                                                                            value="{{$payComponents->component_code}}" {{ $CheckedStr }} 
                                                                             @if(isset($selectedPay) && in_array($payComponents->component_id, $selectedPay)) checked="checked" @endif>
   
                                                                            

                                                                        <label for="{{$payComponents->component_id}}">
                                                                            <span class="checkbox">
                                                                                <div class="checkbox-front">?</div>
                                                                                <div class="checkbox-back">✓</div>
                                                                            </span>
                                                                                Is&nbsp;<lable style="">{{$payComponents->component_name}}</lable>&nbsp;Applicable ?
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @if($payComponents->component_code == 'HRA')
                                                            <!-- <div class="div1 no-margin label pd-l-20 HraBox">House </div>
                                                            <div class="div3 no-margin HraBox"><input type="text" name="txt_house_no" id="txt_house_no" class="tboxsmclass" value=""></div>
                                                            <div class="div2 no-margin rboxlabel pd-l-20 HraBox">Occupied Date </div>
                                                            <div class="div2 no-margin HraBox"><input type="text" name="txt_occupied_date" id="txt_occupied_date" class="tboxsmclass" value=""></div> -->
                                                            @endif
                                                            @if($payComponents->component_code == 'ESI')
                                                            <div class="div1 no-margin label pd-l-20 EsiBox hide">ESI No. <span class="reqindi">*</span></div>
                                                            <div class="div3 no-margin EsiBox hide"><input type="text" name="txt_esi_no" id="txt_esi_no" class="tboxsmclass" value="{{$RegEmpData->esi_number ?? ''}}"></div>
                                                            @endif 
                                                            @if($payComponents->component_code == 'GPF')
                                                                <div class="div1 no-margin label pd-l-20 GpfBox hide">PF No. <span class="reqindi">*</span></div>
                                                                <div class="div3 no-margin GpfBox hide"><input type="text" name="txt_pf_no" id="txt_pf_no" class="tboxsmclass" value="{{$RegEmpData->pf_number ?? ''}}"></div>
                                                            @endif
                                                            @if($payComponents->component_code == 'NPS')
                                                            <div class="div1 no-margin label pd-l-20 NpsBox hide">PRAN No. <span class="reqindi">*</span></div>
                                                            <div class="div3 no-margin NpsBox hide"><input type="text" name="txt_pran_no" id="txt_pran_no" class="tboxsmclass" value="{{$RegEmpData->pran_number ?? ''}}"></div>
                                                            @endif

                                                            <div class="row smclearrow bottom-border"></div>
                                                            <div class="row smclearrow"></div>
                                                            @endif
                                                        @endforeach
                                                        @endif
                                                        <div class="row smclearrow"></div>
                                                        <div class="row smclearrow"></div>
                                                        <div class="row smclearrow"></div>
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <!-- <div class="row">
                                                @php $AddUrl = 'employee.view-pay';  @endphp
                                                <div class="div12" align="center">
                                                    <input type="button" class="backbutton" name="btn_view" id="btn_view" value=" Back " onClick="window.location='{{route($AddUrl)}}'" />
                                                    <input type="submit" class="backbutton" name="btn_save" id="btn_save" value=" Save " />									
                                                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                                </div>		
                                            </div> -->
										</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </blockquote>
                    </div>
                </div>
            </div>                                
        </div>
    </form>
</body>
<script>
    $('body').on('click', '.readonly-checkbox', function(e){
		e.preventDefault();
		e.stopPropagation();
		return false;
	});
    $(document).ready(function () {
        $('input[name^="ch_pay_components["]:checked').trigger('change');
    });

    
    $('body').on('change', 'input[name^="ch_pay_components["]', function(event){
		let componentCode = $(this).attr("data-code"); 
		
		// Prevent change if readonly
		if($(this).hasClass('readonly-checkbox')){
			event.preventDefault();
			return false;
		}
		
		if(componentCode == "HRA"){
			if($(this).is(':checked')){
				$(".HraBox").addClass("hide");
			}else{
				$(".HraBox").removeClass("hide");
			}
		}

		if(componentCode == "ESI"){
			if($(this).is(':checked')){
				$(".EsiBox").removeClass("hide");
			}else{
				$(".EsiBox").addClass("hide");
			}
		}
		
		if(componentCode == "GPF"){
			if($(this).is(':checked')){
				$(".GpfBox").removeClass("hide");
				
				// Find and uncheck NPS checkbox
				$('input[name^="ch_pay_components["][data-code="NPS"]').each(function(){
					$(this).prop('checked', false);
					$(this).addClass("readonly-checkbox");
				});
				$(".NpsBox").addClass("hide");
			}else{
				$(".GpfBox").addClass("hide");
				
				// Enable NPS checkbox
				$('input[name^="ch_pay_components["][data-code="NPS"]').each(function(){
					$(this).removeClass("readonly-checkbox");
				});
			}
		}
		
		if(componentCode == "NPS"){
			if($(this).is(':checked')){
				$(".NpsBox").removeClass("hide");
				
				// Find and uncheck GPF checkbox
				$('input[name^="ch_pay_components["][data-code="GPF"]').each(function(){
					$(this).prop('checked', false);
					$(this).addClass("readonly-checkbox");
				});
				$(".GpfBox").addClass("hide");
			}else{
				$(".NpsBox").addClass("hide");
				
				// Enable GPF checkbox
				$('input[name^="ch_pay_components["][data-code="GPF"]').each(function(){
					$(this).removeClass("readonly-checkbox");
				});
			}
		}
	});
</script>
@endsection