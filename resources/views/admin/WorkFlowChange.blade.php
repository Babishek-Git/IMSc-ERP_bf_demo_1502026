@extends('layouts.dashboard-master')
@section('content')
@include('layouts.partials.messages')
@php
foreach($data['EstCollection'] as $EsTC){
    $GlobId = $EsTC->globid;
    $WorkName = $EsTC->work_name;
    $WorkStage = $EsTC->work_stage;
}
if (isset($WorkMovement)) {
    $LstAction = $WorkMovement->action_flag; 
}
if((isset($data['WorkMovement']))){
	$WorkMovement = $data['WorkMovement'];	//dd($WorkMovement);
    $RolePosition = $WorkMovement->role_po;
}

@endphp
<div class="content">
    <div class="title"></div>
    <div class="container_12">
        <div class="grid_12">
            <blockquote class="bq1">
                <form name="form" method="POST" action="">
                    <div class="container">
                        <div class="div2">&nbsp;</div>
                        <div class="div8 mbtable">
                            <div class="row">
                                <div class="div12" style="margin-top:0px;">
                                    <div class="row divhead" align="center">Employee/Role Change - Work Flow</div>
                                </div>
                            </div>
                            <div class="divrowbox innerdiv pt-2">
                                <div class="row">
                                    <div class="div3 label">
                                        Work Name.
                                    </div>
                                    <div class="div9">
                                        <label for="">@if(isset($WorkName)){{ $WorkName }}@endif</label>
                                        @foreach($data['EstCollection'] as $EsTC)
                                            <input type="hidden" name="globid" value="{{ $EsTC->globid }}">
                                            <input type="hidden" name="work_stage" value="{{ $EsTC->work_stage }}">
                                        @endforeach
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="div3 label">
                                        Work Stage.
                                    </div>
                                    <div class="div9">
                                        <label name="work_stage" id="work_stage">@if(isset($WorkStage)){{ $WorkStage }}@endif</label>
                                    </div>
                                </div>
                                <div class="row smclearrow"></div> 
                                <div class="row smclearrow"></div> 
                                <div class="row smclearrow"></div> 
                                <div class="row">
                                    <div class="div3 label">
                                        Assigned Roles.
                                    </div>
                                    <div class="div9">
                                        @if(isset($data['Roles']))
                                            @foreach($data['Roles'] as $index => $Role)
                                                <div class="assigned-role label">                                                   
                                                    {{ $index + 1 }} - {{ $Role }}  @if(isset($RolePosition) && $RolePosition == $index)<i class="fa fa-hand-o-left blink_me" aria-hidden="true" style="padding-top:4px;color:red;"></i>@endif
                                                    <input type="hidden" name="assigned_roles[]" value="{{ $Role}}">
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="row smclearrow"></div> 
                                <div class="row smclearrow"></div> 
                                <div class="row smclearrow"></div> 
                                <div class="row">
                                    <div class="div3 label">
                                        Previous Action Done By.
                                    </div>
                                    <div class="div9">
                                        <label name="from_role" id="from_role">
                                            @if(isset($data['fromRole']))
                                                {{$data['fromRole']}}
                                            @endif
                                        </label>
                                        <input type="hidden" name="from_role" value="{{$data['fromRole']}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="div3 label">
                                        Works Waiting In.
                                    </div>
                                    <div  class="div9">
                                        <label name="to_role" id="to_role">
                                            @if(isset($data['toRole']))
                                                {{$data['toRole']}}
                                            @endif
                                        </label>
                                        <input type="hidden" name="to_role" value="{{$data['toRole']}}">
                                        <input type="hidden" name="to_role_po" id='to_role_po' value="@if(isset($RolePosition)){{$RolePosition}}@endif">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="div3 label">
                                        Last Action
                                    </div>
                                    <div class="div9">
                                        <label name="last_action" id="last_action">
                                            @if(isset($data['WorkMovement']))
                                                @if($data['WorkMovement']->action_flag == 'FW')
                                                    FORWARD
                                                @else($data['WorkMovement']->action_flag == 'BW')
                                                    BACKWARD
                                                @endif
                                            @endif
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="div3 label">
                                        Action
                                    </div>
                                    <div class="div9">
                                        <select name="role_action" id="role_action" class="tboxclass" style="height: 30px; width:50%;" tabindex="6">
                                            <option value="">---------------- Select -----------------</option>
                                            <option value="FW">FORWARD</option>
                                            <option value="BW">BACKWARD</option>
                                        </select>                                    
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="div3 label">
                                        Change Role.
                                    </div>
                                    <div class="div9">
                                        <select name="change_role" id="change_role" class="tboxclass" style="height: 30px; width:50%;" tabindex="6">
                                            <option value="">---------------- Select -----------------</option>
                                            @foreach($data['UniqueRoles'] as $UniqueRoles)
                                            <option value="{{ $UniqueRoles }}">{{ $UniqueRoles }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="div3 label">
                                        Employee No
                                    </div>
                                    <div class="div9">
                                        <select name="txt_emp_no" id="txt_emp_no" class="tboxclass" style="height: 30px; width:50%;" tabindex="6">
                                            <option value="">---------------- Select -----------------</option>
                                        </select>
                                    </div>
                                </div>
                                @php $AddUrl = 'admin.EmpRoleChangeWorkFlow'; @endphp
                                <div class="row">
                                    <div class="div12" align="center">
                                        <input type="button" class="backbutton" name="back" id="back" value=" Back " onClick="window.location='{{route($AddUrl)}}'" />
                                        @if (($data['status'] !== 'FZ') && ($data['status'] !== 'C'))
                                        <input type="submit" class="backbutton" name="btn_change" id="btn_change" value=" Change " />									
                                        @else
                                        <input type="button" class="backbutton" name="btn_change" id="btn_change" value="Change" disabled />
                                        <p style="color: red;">Status Freezed</p> 
                                        @endif
                                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                        <input type="hidden" name="txt_globid" id="txt_globid" value="@if(isset($GlobId)){{ encrypt($GlobId) }}@endif">
                                    </div>		
                                </div>
                                <div class="row smclearrow"></div>  
                                <div class="row smclearrow"></div>  
                           </div>
                        </div>
                        <div class="div2">&nbsp;</div>
                    </div>
                </form>
            </blockquote>
        </div>
    </div>
</div>
<style>
    .checkbox-group {
        display: flex;
        flex-direction: column;
    }

    .checkbox-label {
        margin-bottom: 5px;
    }
    .blink {
        margin-left:-30px;
		animation: blinker 1.5s linear infinite;
	}

	@keyframes blinker {
		50% {
			opacity: 0;
		}
	}
</style>
<script>
$(document).ready(function() {
    $('#role_action').chosen();
    $('#change_role').chosen();
    $('#txt_emp_no').chosen();
    $('#role_action').on('change', function() {
        updateRoles();
    });
    function updateRoles() {
        var action = $('#role_action').val();
        var toRole = $('#to_role').text().trim();
        var ToRolePo = $('#to_role_po').val();
        var changeRoleSelect = $('#change_role');
        var assignedRoles = @json($data['Roles']);
        changeRoleSelect.empty().append('<option value="">---------------- Select -----------------</option>');
        if (action === 'FW' || action === 'BW') {
            var toRoleFound = false;
            var uniqueRoles = [];
            $('#change_role').chosen("destroy");
            $.each(assignedRoles, function(index, role) {
                if (action === 'FW') {
                    if (role === toRole && index == ToRolePo) {
                        toRoleFound = true;
                    }
                    if (toRoleFound && index > ToRolePo) {
                        changeRoleSelect.append('<option value="'+ role + '/' + index +'">' + role + '</option>');
                    }
                }
                if (action === 'BW') {
                    if (role === toRole && index == ToRolePo) {
                        toRoleFound = true;
                    }
                    if (!toRoleFound || (role !== toRole && index < ToRolePo)) {
                        changeRoleSelect.append('<option value="'+ role + '/' + index +'">' + role + '</option>');
                    }
                }
            });
            $('#change_role').chosen();
        }
    }
    $("body").on("click","#btn_change", function(event){
        var Action = $('#role_action').val();
        var ChangeRole = $('#change_role').val();
        var EmpNo = $('#txt_emp_no').val();
        if(Action == ""){
            BootstrapDialog.alert("Please Select the Action !!!");
            event.preventDefault();
            event.returnValue = false;
        }
        else if(ChangeRole == ""){
            BootstrapDialog.alert("Please Select the Role to Change !!!");
            event.preventDefault();
            event.returnValue = false;
        }
        else if(EmpNo == ""){
            BootstrapDialog.alert("Please Select the Employee Number !!!");
            event.preventDefault();
            event.returnValue = false;
        } 
    });
    
    $('#change_role').change(function() {
        var RoleWithPo  = $(this).val();
        var RoleParts   = RoleWithPo.split('/'); 
        var RoleName    = RoleParts[0];
        var GlobId      = $('#txt_globid').val();
        $.ajax({
		type:'POST',
		url:"{{ route('ajax.FindActiveEmployeeByRole') }}",
		data:{'RoleName':RoleName ,'GlobId':GlobId, '_token': '{{ csrf_token() }}'},
		success:function(data){ 
			if(data != null){  
                $('#txt_emp_no').chosen("destroy");
                $('#txt_emp_no').empty();
                var optionList = '<option value="">---------------- Select -----------------</option>';
                $.each(data, function(index, employee) {
                    optionList += '<option value="' + employee.employee_no + '">' + employee.employee_no + ' - ' + employee.emp_known_as + '</option>';
                });
                $('#txt_emp_no').append(optionList);
                $('#txt_emp_no').chosen();
            }
		}
	});

    });
});
</script>

@endsection
