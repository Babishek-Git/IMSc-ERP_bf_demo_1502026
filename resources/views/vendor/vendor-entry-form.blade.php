@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@php 
	/*if(isset($data['RoleData'])){
		$RoleEditData = $data['RoleData'];
		if(filled($RoleEditData)){
			$RoleName = $RoleEditData->role_name;
			$RoleId = $RoleEditData->roleid;
			$RoleGroupCode = $RoleEditData->role_group_code;
			$RoleSectionId = $RoleEditData->section_id;
		}
	}*/
@endphp

<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
	<form action="" method="post" enctype="multipart/form-data" name="form">
		<div class="content">
			<div class="title"></div>
			<div class="container_12">
				<div class="grid_12">
					<blockquote class="bq1" style="overflow:auto">
						<div class="container">
							<div class="row plr">
								<div class="div5">
									<div class="form-box">
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Vendor Entry Form</div></div></div>
										<div class="card-body padding-1 ChartCard" id="CourseChart">
											<div class="divrowbox innerdiv pt-2">
																		
												<div class="row smclearrow"></div>                                                                                											
												<div class="div3 label">Vendor Name <span class="reqindi">*</span></div>
												<div class="div9"><input type="text" name="txt_vendor_name" id="txt_vendor_name" class="tboxsmclass" value="@if(isset($data['RoleData'])){{ $data['RoleData']->role_name }}@endif"></div>
												<div class="div3 label"> Vendor Address<span class="reqindi">*</span></div>
												<div class="div9"><textarea name="txt_addr" id="txt_addr" class="tboxsmclass" value=""></textarea></div>
												<div class="div3 label">GST No.</div>
												<div class="div9"><input type="text" name="txt_gst_no" id="txt_gst_no" class="tboxsmclass" value="" ></div>
												<div class="div3 label">Pan No.</div>
												<div class="div9"><input type="text" name="txt_pan_no" id="txt_pan_no" class="tboxsmclass" value="" ></div>
												<div class="div3 label">Contact No.</div>
												<div class="div9"><input type="text" name="txt_contact_no" id="txt_contact_no" class="tboxsmclass" value="" ></div>
												<div class="div3 label">Bank Account No</br>(As of now)<span class="reqindi">*</span></div>
												<div class="div9"><input type="text" name="txt_bank_account_no" id="txt_bank_account_no" class="tboxsmclass" value="@if(isset($data['RoleData'])){{ $data['RoleData']->role_name }}@endif"></div>
												<div class="row smclearrow"></div>
												<div class="div3 label">IFSC Code <span class="reqindi">*</span></div>
												<div class="div9"><input type="text" name="txt_ifsc_code" id="txt_ifsc_code" class="tboxsmclass" value=""></div>
												<div class="div3 label">Bank Name</div>
												<div class="div9">
													<input type="text" name="txt_bank_name" id="txt_bank_name" class="tboxsmclass" value="" readonly>
													<input type="hidden" name="txt_bank_id" id="txt_bank_id" class="tboxsmclass" value="">
										    	</div>
												<div class="div3 label">Bank Branch Address</div>
												<div class="div9">
													<input type="text" name="txt_branch_address" id="txt_branch_address" class="tboxsmclass" value="" readonly>
													<input type="hidden" name="txt_branch_id" id="txt_branch_id" class="tboxsmclass" value="">
												</div>
												@php $AddUrl = 'roles.ViewRoleMaster'; @endphp										
												<div class="row">
													<div class="div12" align="center">
														<!-- <input type="button" class="backbutton" name="btn_view" id="btn_view" value=" View " onClick="window.location='{{route($AddUrl)}}'" /> -->
														<input type="submit" class="step-btn" name="btn_save" id="btn_save" value=" Save " />									
														<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
														<input type="hidden" name="hid_roleid" id="hid_roleid" value="@if(isset($data['RoleData'])){{ encrypt($data['RoleData']->roleid) }}@endif" />
													</div>		
												</div>
												<div class="row smclearrow"></div>  
											</div>
										</div>										
									</div>
								</div>

								<div class="div7">
									<div class="table-box">
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row table-divhead" align="center">Vendor List</div></div></div>
										<div class="card-body padding-1 ChartCard" id="CourseChart">
											<div class="divrowbox innerdiv pt-2">
												<div class="row smclearrow"></div>                                                                                											
												<table class="table-bordered table1" width="99%" align="center" id="dataTable">
													<thead>
														<tr class="note heading">
															<th  style="text-align:center">SNo.</th>
															<th  style="text-align:center">Vendor Name</th>
															<th  style="text-align:center">Vendor Address</th>
															<th  style="text-align:center">GST No.</th>
															<th  style="text-align:center">PAN No.</th>
															<th  style="text-align:center">Bank Account NO</th>
															<th  style="text-align:center">Ifsc Code</th>
															<th  style="text-align:center">Bank Name</th>
															<th  style="text-align:center">Bank Address Name</th>
															<th  style="text-align:center">Action</th>
														</tr>
													</thead>
													<tbody>
													@if(isset($data['RoleDataView']))
														@foreach($data['RoleDataView'] as $Role)
															<tr>
																<td align="center">{{$loop->iteration }} </td>
																<td align="left">{{ $Role->role_name }}</td>
																<td align="left">{{ $Role->role_group_name }}</td>
																<td align="center">
																	<button type="button" name="btn_edit" id="btn_edit" class="btn btn-default teditbtn estEdit" onclick="window.location='{{ route('roles.RoleMaster', ['id'=>encrypt($Role->roleid)])}}'" title="Click here to Edit" style="cursor: pointer;"><i class="fa fa-edit pt2"></i></button>
																</td>
															</tr>
														@endforeach
													@endif
													</tbody>
												</table>
												
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
	$(".ChosenInput").chosen();
	$("#txt_role_group").chosen();
	$("#cmb_section").chosen();
	$('#dataTable').DataTable({
		responsive: true,
		paging: true, 
	});														
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
					message: 'Are you sure want to Ventor Entry?',
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
	$("body").on("change","#txt_ifsc_code", function(event){
		$("#txt_bank_name").val('');
		$("#txt_bank_id").val('');
		$("#txt_branch_address").val('');
		$("#txt_branch_id").val('');
		let IfscCode = $(this).val();	
		var SelOption = $('#IfscList option[value="'+IfscCode+'"]');
		let BankId = SelOption.data('bankid');
		$.ajax({
			type: 'POST', 
			url: "{{ route('bank.GetBankData') }}",
			data: { "_token": "{{ csrf_token() }}", 'IfscCode':IfscCode}, 
			success: function (data) {  
				if(data != ''){ 
					let BankData = data['BankData'];
					$.each(BankData, function(key, value){
						let BankName  	= value.bank_name; 
						let BranchAddr  = value.branch_addr1;
						let BranchId 	= value.branch_id;
						let BankId 		= value.bank_id;
						$("#txt_bank_name").val(BankName);
						$("#txt_bank_id").val(BankId);
						$("#txt_branch_address").val(BranchAddr);
						$("#txt_branch_id").val(BranchId);
					});
				}
			}
		});
	});
	/* $("body").on("change", "#txt_ifsc_code", function (event) {
	//alert();
    var IfscCode = $(this).val();
    if ((IfscCode!='') && (IfscCode!=null)) {

        $.ajax({
            type: 'POST',
            url: "{{ route('bank.GetBankData') }}",
            data: { "_token": "{{ csrf_token() }}", 'IfscCode': IfscCode },
            // dataType: 'json',
            success: function (data) {
                if (data != '') {
                    let BankData = data['BankData']; console.log(BankData);
                    if ((BankData != '') && (BankData != null)) {
                        //$("#section_name").empty();
                        $.each(BankData, function (index, element) {
						   $("#txt_bank_name").val(element.bank_name);
                           $("#txt_branc_addr").val(element.branch_addr1);
                        });
                    }else{
						BootstrapDialog.alert("Please Enter the Correct IFSC Code");
						$("#txt_ifsc_code").val(''); 
					}
                }
            }
        });
    }
}); */

</script>
@endsection
