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
							<div class="row plr">
								<!-- <div class="div2">&nbsp;</div> -->
								<div class="div5 mbtable">
									<!-- <div class="form-box"> -->
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Research Level</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
																	
											<div class="row smclearrow"></div>                                                                                											
											<div class="div3 label">Research Level Code <span class="reqindi">*</span></div>
											<div class="div9"><input type="text" name="txt_level_code" id="txt_level_code" class="tboxclass" value=""></div>
											<div class="row smclearrow"></div>

											<div class="row smclearrow"></div>                                                                                											
											<div class="div3 label">Research Level Short Name <span class="reqindi">*</span></div>
											<div class="div9"><input type="text" name="txt_level_shortName" id="txt_level_shortName" class="tboxclass" value=""></div>
											<div class="row smclearrow"></div>

											<div class="row smclearrow"></div>                                                                                											
											<div class="div3 label">Research Level Name <span class="reqindi">*</span></div>
											<div class="div9"><input type="text" name="txt_level_Name" id="txt_level_Name" class="tboxclass" value=""></div>
											<div class="row smclearrow"></div>

											<div class="row smclearrow"></div>                                                                                											
											<div class="div3 label">Tenure <span class="reqindi">*</span></div>
											<div class="div9"><input type="text" name="txt_tenure" id="txt_tenure" class="tboxclass" value=""></div>
											<div class="row smclearrow"></div>
											
											
											
											@php $AddUrl = 'roles.ViewRoleMaster'; @endphp										
											<div class="row">
												<div class="div12" align="center">
													<input type="submit" class="backbutton" name="btn_save" id="btn_save" value=" Save " />									
													<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
												</div>		
											</div>
											<div class="row smclearrow"></div>  
										</div>
									</div>
									<!-- </div>	-->
								</div>
								<!--  -->
								<div class="div7">
									<div class="table-box">
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row table-divhead" align="center">Research Level List</div></div></div>
										<div class="card-body padding-1 ChartCard" id="CourseChart">
											<div class="divrowbox innerdiv pt-2">
																		
												<div class="row smclearrow"></div>                                                                                											
												<table class="table-bordered table1" width="99%" align="center" id="dataTable">
													<thead>
														<tr class="note heading">
															<th  style="text-align:center">SNo.</th>
															<th  style="text-align:center">Research Level Code</th>
															<th  style="text-align:center">Research Level Short Name</th>
															<th  style="text-align:center">Research Level Name</th>
															<th  style="text-align:center">Tenure </th>
															<th  style="text-align:center">Action</th>
														</tr>
													</thead>
													<tbody>
													@if(isset($data['ResearchData']))
														@foreach($data['ResearchData'] as $Row)
															<tr>
																<td align="center">{{ $loop->iteration }} </td>
																<td align="left">{{ $Row->research_level_code }}</td>
																<td align="left">{{ $Row->research_level_short_name }}</td>
																<td align="left">{{ $Row->research_level_name }}</td>
																<td align="left">{{ $Row->tenure }}</td>
																<td>
																	<!-- <input type="button" class="backbutton" name="btn_edit" id="btn_edit" value=" Edit" onclick="window.location='{{ route('bank.BankBranch',['id'=>encrypt($Row->research_level_code)]) }}'"/>	 -->
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
								<!--  -->
							</div>                           
						</div>
					</blockquote>
				</div>
			</div>
		</div>
	</form>
</body>	
<script type="text/javascript" language="javascript">
	$("#txt_division").chosen();
	$("#txt_role_group").chosen();
	$('#dataTable').DataTable({
		responsive: true,
		paging: true, 
	});
	var KillEvent = 0;
	$("body").on("click","#btn_save", function(event){
		if(KillEvent == 0){
			var LevelCode   		= $("#txt_level_code").val();
			var LevelShortName   	= $("#txt_level_shortName").val();
			var LevelName 		= $("#txt_level_Name").val();
			var Tenure 		= $("#txt_tenure").val();

			if(LevelCode == ""){
				BootstrapDialog.alert("Level Code should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(LevelShortName == ""){
				BootstrapDialog.alert("Level Short Name should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(LevelName == ""){
				BootstrapDialog.alert("Level Name should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}
			else if(Tenure == ""){
				BootstrapDialog.alert("Tenure should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}
			
			else{
				event.preventDefault();
				BootstrapDialog.confirm({
					title: 'Confirmation Message',
					message: 'Are you sure want to save Research Level ?',
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
