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
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Organization View</div></div></div>
										<div class="card-body padding-1 ChartCard" id="CourseChart">
											<div class="divrowbox innerdiv pt-2">
												<div class="table-container">
                                                <div class="table-wrapper">
													<div class="rm-toolbar">
														<span class="rm-with-selected-btn" id="rm-withSelectedBtn">Organization List</span>
														<input type="number" id="rm-perPage" value="15" min="1" max="100">
														<select id="rm-filterStatus">
														<option value="all">All</option>
														<option value="active">Active</option>
														<option value="inactive">Inactive</option>
														</select>
														<input type="text" id="rm-searchInput" placeholder="🔍  Search…">
														<div class="rm-toolbar-right">
															<div class="rm-icon-btn" title="Print" onclick="window.print()">
																<i class="fa fa-print" style="font-size:15px; color:red; font-weight:600;"></i>
															</div>
															<div class="rm-icon-btn" title="Export CSV" onclick="exportCSV()">
																<i class="fa fa-file-excel-o" style="font-size:15px; color:#18D977; font-weight:600;"></i>
															</div>
															<div class="rm-icon-btn" title="Copy" onclick="copyTable()">
																<i class="fa fa-clone" style="font-size:15px; color:blue;; font-weight:600;"></i>
															</div>
															@php $AddUrl = 'organization.OfficeCreation'; @endphp 
															@php $BackUrl = 'organization.OfficeCreation'; @endphp 
															<button type="button" class="rm-new-emp-btn" onClick="window.location='{{route($AddUrl)}}'">+ NEW ORGANIZATION</button>
														</div>
													</div>
                                                    {{-- Leave entry row (row 0 — the input row) --}}
                                                    <table class="attTable">
                                                        <thead>
                                                            <tr>
                                                                <th>SNo.</th>
                                                                <th>Project Head</th>
																<!-- <th>Action</th> -->
                                                                <!-- <th>BE Proposed</th>
                                                                <th>BE Approved</th>
                                                                <th>RE Proposed</th>
                                                                <th>RE Approved</th> -->
                                                            </tr>
                                                        </thead>
                                                        <tbody> 
                                                            @if(isset($data['OfficeGroupData']))
                                                            @foreach($data['OfficeGroupData'] as $OfficeGroupData)
                                                            <tr>
                                                                <td align="center">{{ $loop->iteration }}</td>
                                                                <td>{{ $OfficeGroupData->full_heads }}
																	<input type="hidden" id ='hidden_oh_id' name ='hidden_oh_id[]' value = '{{ $OfficeGroupData->office_id }}'>
																	<!-- <td align="center"><button type="button" name="btn_edit" class="btn btn-default tuploadbtn" id="btn_edit" value=" Edit" onclick="window.location='{{ route('organization.OfficeCreation',['id'=>encrypt($OfficeGroupData->office_id)]) }}'"> <i class='fa fa-edit'></i> Edit</button></td> -->
																</td>
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
												@php $AddUrl = 'roles.ViewRoleMaster'; @endphp										
												<div class="row">
													<div class="div12" align="center">
														<input type="submit" class="backbutton" name="btn_save" id="btn_save" value=" Save " />									
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
