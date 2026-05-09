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
							<div class="row">
								<div class="div12">
									<div class="form-box">
<<<<<<< Updated upstream
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">PFMR - Employee Entry Form</div></div></div>
=======
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">PFMR - Employee View Form</div></div></div>
>>>>>>> Stashed changes
										<div class="card-body padding-1 ChartCard" id="CourseChart">
											<div class="divrowbox innerdiv pt-2">
												<div class="table-container">
                                                <div class="table-wrapper">
                                                    {{-- Leave entry row (row 0 — the input row) --}}
                                                    <table class="formtable"  align="center" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Employee IC No</th>
                                                                <th>Employee Name</th>
																<th>Designation</th>
																<th>PFMR Unique Id</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody> 
                                                            @if(isset($data['EmpData']))
                                                            @foreach($data['EmpData'] as $EmpData)
                                                            <tr>
                                                                <td align="center" style="width:80px">{{ $EmpData->emp_no }}
																	<input type="hidden" id ='hidden_emp_id' name ='hidden_emp_id[]' value = '{{ $EmpData->emp_no }}'>
																</td>
																<td>{{ $EmpData->emp_name_payslip }}</td>
																<td>{{ $EmpData->designation_name }}</td>
																<td>{{ $EmpData->pfmr_id }}</td>
                                                            </tr>
                                                            @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>

                                                    {{-- Eligibility warning panel --}}
                                                    <div id="eligibilityWarning"
                                                         style="display:none; color:#c0392b; padding:8px; margin-top:6px; background:#fdecea; border-radius:4px;">
                                                    </div>

                                                </div>
                                            </div>
												@php $AddUrl = 'pfmr_unique_id.pfmr_unique_id'; @endphp										
												<div class="row">
													<div class="div12" align="center">
														<input type="button" class="backbutton" name="btn_view" id="btn_view" value=" Back " onClick="window.location='{{route($AddUrl)}}'" />
<<<<<<< Updated upstream
														<input type="submit" class="backbutton" name="btn_save" id="btn_save" value=" Save " />									
=======
														<!-- <input type="submit" class="backbutton" name="btn_save" id="btn_save" value=" Save " />									 -->
>>>>>>> Stashed changes
														<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
														<input type="hidden" name="hid_roleid" id="hid_roleid" value="@if(isset($data['RoleData'])){{ encrypt($data['RoleData']->roleid) }}@endif" />
													</div>		
												</div>
												<div class="row smclearrow"></div>  
											</div>
										</div>										
									</div>
								</div>
								
							</div>                           
						</div>
					</blockquote>
				</div>
			</div>
		</div>
	</form>
</body>	
<script type="text/javascript" language="javascript">
	$(document).on('input', '.price, .gst', function () {

    let row = $(this).closest('tr');

    let price = parseFloat(row.find('.price').val()) || 0;
    let gst   = parseFloat(row.find('.gst').val()) || 0;

    // GST calculation
    let gstAmount = price * gst / 100;

    // Total price
    let total = price + gstAmount;

    // set total
    row.find('.total').val(total.toFixed(2));
});
	$(".ChosenInput").chosen();
	var KillEvent = 0;
	$("body").on("click","#btn_save", function(event){
		if(KillEvent == 0){
			var RoleName   		= $("#txt_role_name").val();
			var RoleGroup 		= $("#txt_role_group").val();

			if(RoleName == ""){
				BootstrapDialog.alert("Role Name should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(RoleGroup == ""){
				BootstrapDialog.alert("User Group Name should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else{
				event.preventDefault();
				BootstrapDialog.confirm({
					title: 'Confirmation Message',
					message: 'Are you sure want to save ?',
					closable: false, // <-- Default value is false
					draggable: false, // <-- Default value is false
					btnCancelLabel: 'Cancel', // <-- Default value is 'Cancel',
					btnOKLabel: 'Ok', // <-- Default value is 'OK',
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
