@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
	<form action="" method="post" enctype="multipart/form-data" name="form">
		<div class="content">
			<div class="title"></div>
			<div class="container_12">
				<div class="grid_12">
					<blockquote class="bq1" style="overflow:auto">
						<div class="container">
							<div class="row ">
								<div class="div2">&nbsp;</div>
								<div class="div8 mbtable">
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Deligate Assign</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
											<div class="div3 label">Employee Name <span class="reqindi">*</span></div>											
											<div class="div9">
											<select name="cmb_from_employee" id="cmb_from_employee" class="textboxdisplay" style="width:500px;height:30px" data-status="0">
												<option value="">--------------- Select ---------------</option>
												@if(isset($data['EmpData']))
													@foreach($data['EmpData'] as $key => $value)
														@if($value->active == 1)
															@php 
															   $SelStr = "";
															@endphp
															<option value="{{encrypt($value->emp_no)}}" {{$SelStr}}>{{$value->emp_no}} - {{$value->emp_known_as}}</option>
														@endif
													@endforeach
												@endif
											</select>
											</div>
											<div class="row smclearrow"></div>
											<div class="div3 label">Employee Role <span class="reqindi">*</span></div>											
											<div class="div9">
                                    <select name="cmb_from_emp_role" id="cmb_from_emp_role" class="textboxdisplay" style="width:500px;height:30px">
                                       <option value="">--------------- Select ---------------</option>
                                       @if(isset ($data['OfficeList']))
                                          @foreach($data['OfficeList'] as $key => $value)
                                             @if($value->active == 1)
                                                @php 
                                                $SelStr = "";
                                                if(isset($data['OfficeMappingData'])){
                                                   if($data['OfficeMappingData']->office_map_to == $value->office_id){
                                                      $SelStr = 'selected="selected"';
                                                   } 
                                                }
                                                @endphp
                                                <option value="{{$value->office_id}}" {{$SelStr}}>{{$value->office_name}}</option>
                                             @endif
                                          @endforeach
                                       @endif
                                    </select>
											</div>
                                 <div class="row smclearrow"></div>
											<div class="div3 label">Modules <span class="reqindi">*</span></div>											
											<div class="div9">
                                    <select name="cmb_from_modules" id="cmb_from_modules" class="textboxdisplay" style="width:500px;height:30px">
                                       <option value="">--------------- Select ---------------</option>
                                    </select>
											</div>
										</div>
									</div>
								   <div class="div1">&nbsp;</div>
								   <div class="div10">
                              <div class="row delassign" id="div_delassign" align="center"></div>
                           </div>
								   <div class="div1">&nbsp;</div>
                           <div class="row">
                              <div class="div12" align="center">
                              <input type="submit" class="backbutton" name="btn_save" id="btn_save" value=" Save " />									
                              <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                              </div>		
                           </div>
                           <div class="row clearrow"></div>  
								</div>
								<div class="div2">&nbsp;</div>
							</div>
						</div>
					</blockquote>
				</div>
			</div>
		</div>
	</form>
</body>

<script>
   var KillEvent = 0;
	$(document).ready(function() {
      $("body").on("click","#btn_save", function(event){
         if(KillEvent == 0){
            var Status = $('#cmb_from_employee').attr('data-status');
            var FromEmployee = $('#cmb_from_employee').val();
            var FromMod = $('#cmb_from_modules').val();
            var FromEmployeeRole = $('#cmb_from_emp_role').val();
            if(Status == 0){
               if(FromEmployee == ""){
                  BootstrapDialog.alert("Please Select Employee Name..!!");
                  event.preventDefault();
                  event.returnValue = false;
               }else if(FromEmployeeRole == ""){
                  BootstrapDialog.alert("Please Select Employee Role..!!");
                  event.preventDefault();
                  event.returnValue = false;
               }else if(FromMod == ""){
                  BootstrapDialog.alert("Please Select Modules..!!");
                  event.preventDefault();
                  event.returnValue = false;
               }
            }else if(Status == 1){
               var ToWork = $('#cmb_to_work').val();
               var ToEmployee = $('#cmb_to_employee').val();   
               if(ToWork == ""){
                  BootstrapDialog.alert("Please Select Work Name..!!");
                  event.preventDefault();
                  event.returnValue = false;
               }else if(ToEmployee == ""){
                  BootstrapDialog.alert("Please Select Deligate Name..!!");
                  event.preventDefault();
                  event.returnValue = false;
               }else{
                  event.preventDefault();
                  BootstrapDialog.confirm({
                     title: 'Confirmation Message',
                     message: 'Are you sure want to Assign this deligate ?',
                     closable: false,           // <-- Default value is false
                     draggable: false,          // <-- Default value is false
                     btnCancelLabel: 'Cancel',  // <-- Default value is 'Cancel',
                     btnOKLabel: 'Ok',          // <-- Default value is 'OK',
                     callback: function(result) {
                        if(result){
                           KillEvent = 1;
                           $("#btn_save").trigger( "click" );
                        }else{
                           KillEvent = 0;
                        }
                     }
                  });
               }
            }else{
               BootstrapDialog.alert("Sorry, Unable to save..Please try again with all options selected..!!");
               event.preventDefault();
               event.returnValue = false;
            }
         }
      });

      $('body').on('change','#cmb_from_employee',function(event){
         var SelFromEmp = $(this).val();
         $('#cmb_from_emp_role').children('option:not(:first)').remove();
         $('#cmb_from_modules').children('option:not(:first)').remove();
         if (SelFromEmp != ''){
            $.ajax({
               type: 'POST',
               url:"{{ route('ajax.FindEmpRoleData') }}",
               data: { "_token": "{{ csrf_token() }}", SelFromEmp: SelFromEmp },
               dataType: 'json',
               success: function (data) {
                  if(data != null){
                     var EmpData = data.EmpData;
                     var RoleName = data.RoleName;
                     var WorkStage = data.WorkStage;
                     var AvailWrkDataArr = data.AvailWrkDataArr;
                     Object.entries(EmpData).forEach(([Index, Element]) => {
                        var RoleNameDisp = '';
                        if(RoleName[Element.role_id]){
                           var RoleNameDisp = RoleName[Element.role_id];
                        }
                        $("#cmb_from_emp_role").append('<option value="'+Element.role_id+'" data-grp="'+Element.group_code+'" data-div="'+Element.division_code+'" data-sec="'+Element.section_code+'">'+RoleNameDisp+'</option>');
                     });
                     Object.entries(AvailWrkDataArr).forEach(([ADIndex, ADElement]) => {
                        var WorkStageDisp = '';
                        if(WorkStage[ADElement]){
                           var WorkStageDisp = WorkStage[ADElement];
                        }
                        $("#cmb_from_modules").append('<option value="'+ADElement+'">'+WorkStageDisp+'</option>');
                     });
                  }
               }
            });
         }
      });
      $('body').on('change','#cmb_from_emp_role',function(event){
         $('#cmb_from_modules').val('');
         $('#div_delassign').html('');
      });
      $('body').on('change','#cmb_from_modules',function(event){
         var SelModule = $(this).val();
         var FromOffice = $('#cmb_from_employee option:selected').val();
         var FromOffRole = $('#cmb_from_emp_role option:selected').val();
         var FromOffRoleTxt = $('#cmb_from_emp_role option:selected').text();
         $('#div_delassign').html('');
         $('#cmb_from_employee').attr('data-status',0);
         if ((SelModule != '') && (FromOffice != '') && (FromOffRole != '')){
            $.ajax({
               type: 'POST',
               url:"{{ route('ajax.FindEmpRoleData') }}",
               data: { "_token": "{{ csrf_token() }}", SelFromEmp: FromOffice, FromOffRole: FromOffRole, SelModule: SelModule, Page: 'DELICROLE' },
               dataType: 'json',
               success: function (data) {
                  var RetData = data.RetData;
                  var RecEmpData = data.EmpData;
                  if(RecEmpData != null){
                     var AssignStr = '';
                     AssignStr += '<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="left">Deligate Assign</div></div></div>';
                     AssignStr += '<table class="dataTable etable " align="center" width="100%" id="RoleTable"><tr class="label" style="background-color:#FFF">';
                     AssignStr += '<th align="center" width="200px">Deligates Role</th><th align="center" width="200px">Work Name</th><th align="center" width="200px">Deligates</th></tr><tr id="secondRow">';
                     AssignStr += '<td align="center"><select class="group tboxclass" name="cmb_to_emp_role" id="cmb_to_emp_role"><option value="">'+FromOffRoleTxt+'</option>';
                     AssignStr += '</select></td><td align="center"><select class="group tboxclass" name="cmb_to_work" id="cmb_to_work">';
                     AssignStr += '<option value="">------- Select ------</option></select></td>';
                     AssignStr += '<td align="center"><select class="group tboxclass" name="cmb_to_employee" id="cmb_to_employee">';
                     AssignStr += '<option value="">------- Select ------</option></select></td>';
                     AssignStr += '</tr></table>';
                     $('#div_delassign').append(AssignStr);
                     Object.entries(RecEmpData).forEach(([RecEmpIndex, RecEmpElement]) => {
                        var RecEmpNo = RecEmpElement.emp_no;
                        var RecEmpKnAs = RecEmpElement.emp_known_as;
                        $("#cmb_to_employee").append('<option value="'+RecEmpNo+'">'+RecEmpNo+' - '+RecEmpKnAs+'</option>');
                     });
                     Object.entries(RetData).forEach(([RetIndex, RetElement]) => {
                        var GlobID = RetElement.globid;
                        var WorkName = RetElement.work_name;
                        $("#cmb_to_work").append('<option value="'+GlobID+'">'+WorkName+'</option>');
                     });
                     $('#cmb_from_employee').attr('data-status',1);
                     
                  }else{
                     BootstrapDialog.alert("Sorry, No delegates available to Assign.. please create employee and try again..!!");
                     event.preventDefault();
                     event.returnValue = false;
                  }
               }
            });
         }else{
            BootstrapDialog.alert("Please Select From Employee Name & Employee Role..!!");
            event.preventDefault();
            event.returnValue = false;
            $(this).val('');
         }
      });
   });
</script>

@endsection
