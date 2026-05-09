@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

@php
if(isset($data['EmpData'])){
		foreach($data['EmpData'] as $emp){
			$EmpNo = $emp->emp_no;
		}
	}
@endphp

<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
	<form action="" method="post" enctype="multipart/form-data" name="form">
		<div class="content">
			<div class="title"></div>
			<div class="container_12">
				<div class="grid_12">
					<blockquote class="bq1" style="overflow:auto">
						<div class="container">
							<div class="row ">
								<div class="div4">&nbsp;</div>
								<div class="div4 mbtable">
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">User Creation</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
											<div class="row smclearrow"></div>                                                                                											
											<div class="div4 label">Employee No.</div>
											<div class="div8"><input type="text" name="txt_emp_no" id="txt_emp_no" class="tboxclass" autocomplete="off"></div>
											<div class="row smclearrow"></div> 
											<div class="div4 label">Employee Name</div>
											<div class="div8"><input type="text" name="txt_emp_name" id="txt_emp_name" class="tboxclass disable" disabled=""></div>
											<div class="row smclearrow"></div>
											<div class="div4 label">Designation</div>
											<div class="div8"><input type="text" name="txt_emp_design" id="txt_emp_design" class="tboxclass disable" disabled=""></div>
											<div class="row smclearrow"></div>
											<div class="row clearrow"></div>
											@php $AddUrl = 'user.ViewUser'; @endphp
											<div class="row">
												<div class="div12" align="center">
													<input type="button" class="backbutton" name="btn_view" id="btn_view" value=" View " onClick="window.location='{{route($AddUrl)}}'" />
													<input type="submit" class="backbutton" name="btn_save" id="btn_save" value="Save" />									
													<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
													<input type="hidden" name = "user_id" id = "user_id" value = "@if(isset($data['UserData'])){{ encrypt($data['UserData']->id) }}@endif">
												</div>		
											</div>
											<div class="row smclearrow"></div>  
										</div>
									</div>										
								</div>
								<div class="div4">&nbsp;</div>
							</div>                           
						</div>
					</blockquote>
				</div>
			</div>
		</div>
	</form>
</body>	
<script type="text/javascript" language="javascript">
		
var KillEvent = 0;
$("body").on("click","#btn_save", function(event){
	if(KillEvent == 0){
		var EMPNo   	= $("#txt_emp_no").val();
		if(EMPNo == ''){
			BootstrapDialog.alert("Please Enter the Employee No..!!");
			event.preventDefault();
			event.returnValue = false;
		}else{
			event.preventDefault();
			BootstrapDialog.confirm({
				title: 'Confirmation Message',
				message: 'Are you sure want to save the User ?',
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

$("body").on("change", "#txt_emp_no", function (event) {
    var EmpNo = $(this).val();
    if ((EmpNo != '') && (EmpNo != null)) {
        $.ajax({
            type: 'POST',
            url: "{{ route('employee.GetEmployeeRoles') }}",
            data: { "_token": "{{ csrf_token() }}", 'EmpNo': EmpNo },
            // dataType: 'json',
            success: function (data) {
                if (data != '') {
                    let EmpData = data['EmpData'];
                    if ((EmpData != '') && (EmpData != null)) {
                        $("#section_name").empty();
                        $.each(EmpData, function (index, element) {
                            $("#txt_emp_name").val(element.emp_name_payslip);
                            $("#txt_emp_design").val(element.designation_name);
                            if (element.section_code && element.section) {
                                $("#section_name").append($('<option>', {
                                    value: element.section_id,
                                    text: element.section
                                }));
                            }
                        });
                    }else{
						BootstrapDialog.alert("Please Enter the Correct Employee Number");
						$("#txt_emp_no").val(''); 
					}
                }
            }
        });
    }
});


</script>
@endsection
