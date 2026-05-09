@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
	<form action="{{ route('admin.EmployeeRole') }}" method="post" enctype="multipart/form-data" name="form">
		<div class="content">
			<div class="title"></div>
			<div class="container_12">
				<div class="grid_12">
					<blockquote class="bq1" style="overflow:auto">
						<div class="container">
							<div class="row ">
								<div class="div2">&nbsp;</div>
								<div class="div8 mbtable">
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Employee Roles</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
                                        <div class="row smclearrow"></div>                                                                                											
											<div class="div3 label">Employee Role Name <span class="reqindi">*</span></div>											
											<div class="div9">
                                                <select name="txt_emp_rolename" id="emp_rolename" class="textboxdisplay" style="width:500px;height:28px">
												@if($data['RoleName'])
										        	<option>--------------- Select ---------------</option>
													@foreach($data['RoleName'] as $EmpRoleName)
										        		<option>{{$EmpRoleName -> role_name}}</option>
													@endforeach
												@endif	
											    </select>
											</div>    							
											<div class="row smclearrow"></div>                                                                                											
											<div class="row smclearrow"></div>
                                            <div class="row">
												<div class="div12" align="center">
												<input type="submit" class="backbutton" name="btn_save" id="btn_save" value=" View " />									
												<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
												</div>		
											</div>
											<div class="row smclearrow"></div>  
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
<script>

$('#emp_rolename').chosen();
$("body").on("click","#btn_save", function(event){
	var EmpRoleName = $('#emp_rolename').val();
	if(EmpRoleName == ""){
		BootstrapDialog.alert("Please select the Role Name!");
		event.preventDefault();
		event.returnValue = false;
	}

});
</script>

@endsection
