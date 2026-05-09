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
    $RolePosition = $data['WorkMovement']->role_po; //dd($RolePosition);
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
                                    <div class="row divhead" align="center">Work Flow -- Work Based</div>
                                </div>
                            </div>
                            <div class="divrowbox innerdiv pt-2">
                                <div class="row">
                                    <div class="div3 label" style="color:#000000;">
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
                                    <div class="div3 label" style="color:#000000;">
                                        Work Stage.
                                    </div>
                                    <div class="div9">
                                        <label name="work_stage" id="work_stage">@if(isset($WorkStage)){{Helper::GetWorkStage($WorkStage);}}@endif</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="div3 label" style="color:#000000;">
                                       Action To Do
                                    </div>
                                    <div class="radio-input">
                                        <label>
                                            <input value="DEL" name="action_to_do" class="actiondo" id="rad_delete" type="radio" checked />
                                            <span>Delete</span>
                                        </label>
                                        <label>
                                            <input value="CHRO" name="action_to_do" class="actiondo" id="rad_change" type="radio" />
                                            <span>Change Role</span>
                                        </label>
                                        <span class="selection"></span>
                                    </div>
                                </div>
                                <div class="row smclearrow"></div> 
                                <div class="row smclearrow"></div> 
                                <div class="row smclearrow"></div> 
                                <div class="row">
                                    <div class="div3 label" style="color:#000000;">
                                        Assigned Roles.<span class="reqindi">*</span>
                                    </div>
                                    <div class="div9">
                                        @if(isset($data['Roles'])) 
                                            @foreach($data['Roles'] as $index => $Role)
                                                @if(isset($data['ApproveRole']) && $data['ApproveRole'] == $Role)
                                                <div class="row smclearrow"></div>
                                                    <div class="assigned-role">    
                                                    <span class='blink' style="color:green;"><span style="font-size:40px;">&#9997;</span></span>                                                                   
                                                        <div class="inputGroup paddlr2 div4">                                                        
												    		<input id="assigned_roles_{{ $index }}" class="role_checkbox" name="assigned_roles[]" type="checkbox" data-appr='1' checked value="{{$Role}}"/>
												    		<label for="assigned_roles_{{ $index }}" style="padding:3px 0px; width: 90%;"> &nbsp;{{$Role}}</label>
												    	</div>  
                                                        @php
                                                        if(isset($data['toRole']) && $data['toRole'] == $Role && $index == $RolePosition){
                                                            $EmpnoClass = 'changeempno';
                                                        }                                                        
                                                        else{
                                                            $EmpnoClass ='';
                                                        } 
                                                        @endphp                                                         
                                                        <div class="change_role_part">
                                                            <select name="change_role_name[]" id="change_role_name" data-pos="{{$RolePosition}}" class="tboxclass {{$EmpnoClass}} change_rol" >
                                                                <option value="">---------------- Select -----------------</option>
                                                                @foreach($data['RoleData'] as $roleData) 
                                                                @php
                                                                    $Str 	= ""; 
                                                                    if(trim($roleData->role_name) == trim($Role)){
                                                                        $Str 	= "selected='selected'"; @endphp
                                                                        <option value="{{ $roleData->role_name }}" {{$Str}}>{{ $roleData->role_name }}</option>
                                                                @php																
                                                                    }else{   
                                                                @endphp
                                                                <option value="{{ $roleData->role_name }}" {{$Str}}>{{ $roleData->role_name }}</option>
                                                                @php }@endphp
                                                                @endforeach
                                                            </select>
                                                        </div> 
                                                        &nbsp;&nbsp;&nbsp;
                                                        @if($data['toRole'] == $Role && $index == $RolePosition )
                                                        <div class="change_emp_name" style="width:170px">
                                                            <select style="width:170px"name="cmb_change_emp_no" id="cmb_change_emp_no" data-pos="{{$RolePosition}}" class="tboxclass changeemp change_rol" >
                                                                <option value="">------ Select ------</option>                                                            
                                                            </select>
                                                        </div> 
                                                        @endif                                                                                                                                                                                                                  
                                                    </div>
                                                @else
                                                <div class="row smclearrow"></div>
                                                    <div class="assigned-role">                                                                                                        
                                                        <div class="inputGroup paddlr2 div4">                                                        
												    		<input id="assigned_roles_{{ $index }}" class="role_checkbox" name="assigned_roles[]" type="checkbox" data-appr='0' checked value="{{$Role}}"/>
												    		<label for="assigned_roles_{{ $index }}" style="padding:3px 0px; width: 90%;"> &nbsp;{{$Role}}</label>
												    	</div> 
                                                        @php
                                                        if(isset($data['toRole']) && $data['toRole'] == $Role && $index == $RolePosition){
                                                            $EmpnoClass = 'changeempno';
                                                        }                                                        
                                                        else{
                                                            $EmpnoClass ='';
                                                        } 
                                                        @endphp                                           
                                                        <div class="change_role_part">
                                                            <select name="change_role_name[]" id="change_role_name" data-pos="{{$RolePosition}}" class="tboxclass change_rol {{$EmpnoClass}}" >
                                                                <option value="">---------------- Select -----------------</option>
                                                                @foreach($data['RoleData'] as $roleData) 
                                                                <option value="{{ $roleData->role_name }}" {{ trim($roleData->role_name) == trim($Role) ? 'selected' : '' }}>
                                                                    {{ $roleData->role_name }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div> 
                                                        &nbsp;&nbsp;&nbsp;
                                                        @if($data['toRole'] == $Role && $index == $RolePosition)
                                                        <div class="change_emp_name" style="width:170px">
                                                            <select name="cmb_change_emp_no" id="cmb_change_emp_no"  class="tboxclass changeemp change_rol" >
                                                                <option value="">------ Select ------</option>                                                            
                                                            </select>
                                                        </div> 
                                                        @endif                                                 
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="row smclearrow"></div> 
                                <div class="row smclearrow"></div> 
                                <div class="row smclearrow"></div> 
                                <div class="row">
                                    <div class="div3 label" style="color:#000000;">
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
                                    <div class="div3 label" style="color:#000000;">
                                        Works Waiting In.
                                    </div>
                                    <div  class="div9">
                                        <label name="to_role" id="to_role">
                                            @if(isset($data['toRole']))
                                                {{$data['toRole']}}
                                            @endif
                                        </label>
                                        <input type="hidden" name="to_role" value="{{$data['toRole']}}">
                                        <input type="hidden" id="to_role_po" name="to_role_po" value="@if(isset($RolePosition)){{$RolePosition}}@endif">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="div3 label" style="color:#000000;">
                                        Last Action.
                                    </div>
                                    <div class="div9">
                                        <label name="last_action" id="last_action">
                                            @if(isset($data['WorkMovement']))
                                                @if($data['WorkMovement']->action_flag == 'FW')
                                                    FORWARD
                                                @elseif($data['WorkMovement']->action_flag == 'BW')
                                                    BACKWARD                                            
                                                @endif
                                                @if(isset($data['WorkMovement']->alas_status) && ($data['WorkMovement']->alas_status == 'FW'))
                                                    FORWARD
                                                @elseif(isset($data['WorkMovement']->alas_status) && ($data['WorkMovement']->alas_status == 'BW'))
                                                    BACKWARD
                                                @endif
                                            @endif
                                        </label>
                                    </div>
                                </div>                        
                                <div class="role_change_part">
                                    <div class="row">
                                        <div class="div3 label" style="color:#000000;">
                                            Action.<span class="reqindi">*</span>
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
                                        <div class="div3 label" style="color:#000000;">
                                            Change Role.<span class="reqindi">*</span>
                                        </div>
                                        <div class="div9">                                        
                                            @if(isset($WorkStage))
                                            <input type="hidden" name="workstage" id="workstage" value="{{ $WorkStage }}" />
                                            @endif
                                            <select name="change_role" id="change_role" class="tboxclass" style="height: 30px; width:50%;" tabindex="6">
                                                <option value="">---------------- Select -----------------</option>
                                                @foreach($data['UniqueRoles'] as $UniqueRoles)
                                                <option value="{{ $UniqueRoles }}">{{ $UniqueRoles }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="div3 label" style="color:#000000;">
                                            Employee No.<span class="reqindi">*</span>
                                        </div>
                                        <div class="div9">
                                            <select name="txt_emp_no" id="txt_emp_no" class="tboxclass" style="height: 30px; width:50%;" tabindex="6">
                                                <option value="">---------------- Select -----------------</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                @php $AddUrl = 'workflow.workFlowAssignWorkBased'; @endphp
                                <div class="row">
                                    <div class="div12" align="center">
                                        <input type="button" class="backbutton" name="back" id="back" value=" Back " onClick="window.location='{{route($AddUrl)}}'" />
                                        @if (($data['status'] !== 'FZ')&&($data['status'] !== 'C'))
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
    .assigned-role {
        display: flex;
        flex-direction: row;
    }
    .role_checkbox{
        width:100%;
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
    .radio-input input {
      display: none;
    }

    .radio-input {
      margin-top:10px;
      --container_width: 300px;
      position: relative;
      display: flex;
      align-items: center;
      border-radius: 5px;
      background-color: #fff;
      color: #000000;
      width: var(--container_width);
      overflow: hidden;
      border: 1px solid rgba(53, 52, 52, 0.226);
      height: 30px;
    }

    .radio-input label {
      width: 100%;
      padding: 10px;
      cursor: pointer;
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 1;
      font-weight: 600;
      letter-spacing: -1px;
      font-size: 14px;
    }

    .selection {
      display: none;
      position: absolute;
      height: 100%;
      width: calc(var(--container_width) / 2);
      z-index: 0;
      left: 0;
      top: 0;
      transition: 0.15s ease;
    }

    .radio-input label:has(input:checked) {
      color: #fff;
    }

    .radio-input label:has(input:checked) ~ .selection {
      background-color: #092F66;
      display: inline-block;
    }

    .radio-input label:nth-child(1):has(input:checked) ~ .selection {
      transform: translateX(calc(var(--container_width) * 0 / 2));
    }

    .radio-input label:nth-child(2):has(input:checked) ~ .selection {
      transform: translateX(calc(var(--container_width) * 1 / 2));
    }
  
    
</style>
<script>
$(document).ready(function() {
    $('.change_rol').chosen();
    $(".role_change_part").hide();
    $(".change_role_part").hide();
    $('.change_emp_name').hide();
    $('.actiondo').on('change',function(){
        var Action = $(this).val();
        if(Action == 'DEL'){
            $(".change_role_part").hide();
            $(".role_checkbox").prop('disabled', false);
            $('.change_emp_name').hide();

        }else{
            $(".change_role_part").show();
            $(".role_checkbox").prop('disabled', true);
            $(".role_checkbox").each(function(){
                $(".role_checkbox").prop('checked', true);
            });
            $(".role_change_part").hide();
        }
    });
    $('#role_action').on('change', function() {
        updateRoles();
    });
    var Flag = 1;
    var ForAlert ;
    $('.role_checkbox').on('click', function() {
        var isChecked = $(this).is(':checked');
        var RolName = $(this).val();
        var toRole = $('#to_role').text().trim();
        var ApporvalRole = $(this).data('appr');
        if(ApporvalRole == 1){
            BootstrapDialog.alert("Unable to Remove Approving Authority...!");
            event.preventDefault();
            event.returnValue = false;
        }else{
            if (!isChecked) {
                if (RolName === toRole && Flag === 1) {
                    $(".role_change_part").show(); 
                    $(".role_checkbox").each(function(){
                        if(toRole != $(this).val()){ 
                            $(".role_checkbox").prop('checked', true);
                        }
                    });
                    $(this).prop('checked', false);
                    Flag = 0;
                    ForAlert = 1;
                }else if (Flag === 0) {
                    $(".role_change_part").hide(); 
                    $(".role_checkbox").each(function(){
                        if(toRole === $(this).val()){ 
                            $(".role_checkbox").prop('checked', true);
                        }
                    });   
                    $(this).prop('checked', false);                 
                    Flag = 1;
                    ForAlert = 0;
                }
            } else {
                if (RolName === toRole) { 
                    $(".role_change_part").hide();
                    $(".role_checkbox").each(function(){
                        if(toRole === $(this).val()){ 
                            $(".role_checkbox").prop('checked', true);
                        }
                    });
                    Flag = 1;
                    ForAlert = 0;
                }
            }
        }
    });

    function updateRoles() {
        var action = $('#role_action').val();
        var toRole = $('#to_role').text().trim();
        var changeRoleSelect = $('#change_role');
        var assignedRoles = @json($data['Roles']);
        changeRoleSelect.empty().append('<option value="">---------------- Select -----------------</option>');
        if (action === 'FW') {
        var toRoleFound = false;
        var uniqueRoleAdded = false;

            $.each(assignedRoles, function(index, role) {
                if (uniqueRoleAdded) {
                    return false;
                }

                if (action === 'FW' && toRoleFound && role !== toRole){
                    changeRoleSelect.append('<option value="' + role + '">' + role + '</option>');
                    uniqueRoleAdded = true;
                }

                if (role === toRole) {
                    toRoleFound = true;
                }
            });
        }else if(action === 'BW') {
            var toRoleFound = false;
            var foundRole = null;

            $.each(assignedRoles, function(index, role) {
                if (role === toRole) {
                    toRoleFound = true;
                }
            
                if (!toRoleFound) {
                    foundRole = role;
                }
            });
    
            if (foundRole) {
                changeRoleSelect.append('<option value="' + foundRole + '">' + foundRole + '</option>');
            }
        }
        // if (action === 'FW') {
        // var toRoleFound = false;
        //     $.each(assignedRoles, function(index, role) {
        //         if (toRoleFound && role !== toRole) {
        //             changeRoleSelect.append('<option value="' + role + '">' + role + '</option>');
        //             return false; // Break the loop after adding the first valid role
        //         }
        //         if (role === toRole) {
        //             toRoleFound = true;
        //         }
        //     });
        // } else if (action === 'BW') {
        //     for (var i = assignedRoles.length - 1; i >= 0; i--) {
        //         var role = assignedRoles[i];
        //         if (role === toRole) {
        //             break; // Stop iterating once toRole is found
        //         }
        //         if (role !== toRole) {
        //             changeRoleSelect.append('<option value="' + role + '">' + role + '</option>');
        //             break; // Break the loop after adding the first valid role from the backward direction
        //         }
        //     }
        // }
    }
    $("body").on("click","#btn_change", function(event){
        var Action = $('#role_action').val();
        var ChangeRole = $('#change_role').val();
        var EmpNo = $('#txt_emp_no').val();
        var Checkboxes = $('.role_checkbox');
        if(ForAlert == 1){
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
        }
        var ActionToDo = $('input[name="action_to_do"]:checked').val();
        var AllChecked = Checkboxes.length === Checkboxes.filter(':checked').length;
        if(AllChecked && ActionToDo =='Delete'){
            BootstrapDialog.alert("Please Uncheck any one Role !!!");
            event.preventDefault();
            event.returnValue = false;
        }
        
    });
    
    $('#change_role').change(function() {
        var RoleName    =  $(this).val();
        var GlobId      = $('#txt_globid').val();
        var Stage       = $('#workstage').val();
        $.ajax({
	    	type:'POST',
	    	url:"{{ route('ajax.FindActiveEmployeeByRole') }}",
	    	data:{'Stage':Stage,'RoleName':RoleName ,'GlobId':GlobId, '_token': '{{ csrf_token() }}'},
	    	success:function(data){ 
	    		if(data != null){  
                    $('#txt_emp_no').empty();
                    var optionList = '<option value="">---------------- Select -----------------</option>';
                    $.each(data, function(index, employee) {
                        optionList += '<option value="' + employee.employee_no + '">' + employee.employee_no + ' - ' + employee.emp_known_as + '</option>';
                    });
                    $('#txt_emp_no').append(optionList);
                }
	    	}
	    });
    });
    $('.changeempno').change(function() {
        var RoleName    =  $(this).val();
        var GlobId      = $('#txt_globid').val();
        var Stage       = $('#workstage').val();
        var ThisRolePo  = $(this).data('pos');
        var RolePo      = $('#to_role_po').val();
        if(ThisRolePo == RolePo){
            $.ajax({
	        	type:'POST',
	        	url:"{{ route('ajax.FindActiveEmployeeByRole') }}",
	        	data:{'Stage':Stage,'RoleName':RoleName ,'GlobId':GlobId, '_token': '{{ csrf_token() }}'},
	        	success:function(data){ 
	        		if(data != null){  
                        $('.change_rol').chosen("destroy");
                        $('#cmb_change_emp_no').empty();
                        var optionList = '<option value="">------- Select -------</option>';
                        $.each(data, function(index, employee) {
                            optionList += '<option value="' + employee.employee_no + '">' + employee.employee_no + ' - ' + employee.emp_known_as + '</option>';
                        }); 
                        $('#cmb_change_emp_no').append(optionList); 
                    }
                    $('.change_emp_name').show();
                    $('.change_rol').chosen();

	        	}
	        });
        }        
    });
    $('.role_checkbox').change(function() {
        var roleValue = $(this).val();
        var isChecked = $(this).prop('checked');

        $('.role_checkbox').each(function() {
            if ($(this).val() === roleValue) {
                $(this).prop('checked', isChecked);
            }
        });
    });
});
</script>

@endsection
