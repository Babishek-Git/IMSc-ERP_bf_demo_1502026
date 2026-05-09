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
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Employee Family Details</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
																	
												<div class="row">     
												<div class="div12">                                                                        											
													<table class="formtable" align="center" id="RelationshipTable" width="100%">
														<thead>
															<tr>
																<th class="colhead">Relationship Name</th>
																<th class="colhead">Relationship</th>
																<th class="colhead">Name</th>
																<th class="colhead">age</th>
																<th class="colhead">Action</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td>
																	<select name="drop_relation_name[]" id="drop_relation_name" class="form-control"> 
																		<option value="">--  Select Relation Name  --</option> 
																		@if(isset($data['RelationNameData']))
																		@foreach($data['RelationNameData'] as $Row)
																		<option value="{{ $Row->emp_dependant_id }}">{{ $Row->emp_dependant_name }}</option> 
																		@endforeach
																		@endif
																	</select>		
																</td>
																<td>
																	<select name="drop_relationship[]" id="drop_relationship" class="form-control"> 
																		<option value="">--   Select Relationship   --</option> 
																		@if(isset($data['FamilyMasterData']))
																		@foreach($data['FamilyMasterData'] as $Row)
																		<option value="{{ $Row->emp_dependant_id }}">{{ $Row->emp_depend_relationship }}</option> 
																		@endforeach
																		@endif
																	</select>
																</td>
																<td>
																	<input type="text" name="txt_Name[]" id="txt_name" class="tboxclass" value="">
																</td>
																<td>
																	<input type="date" name="txt_dob[]" id="txt_dob" class="tboxclass" value="">
																</td>
																<td>
																	<i class="fa fa-plus-square sqadd ptr inp disable" id="AddTechRec" style="font-size:24px;"></i>
																</td>
															</tr>
														
														</tbody>
													</table>
												</div>
											</div>
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
		
	$(document).on('click','#AddTechRec',function(){
		var DependentId = $('#drop_relation_name option:selected').val();
		var RelationName = $('#drop_relation_name option:selected').text();
		var Relationship = $('#drop_relationship option:selected').text();
		var Name = $('#txt_name').val();
		var Age = $('#txt_dob').val();
		let tablestr = "";
		tablestr += "<tr>";
		tablestr += "<td><input type='hidden' name='hid_emp_dependant_id[]' id='hid_emp_dependant_id'class='tboxclass' value='" +DependentId+ "' disabled>"
		tablestr += "<input type='text' name='drop_relation_name[]' id='drop_relation_name'class='tboxclass' value='" +RelationName+ "' disabled></td>";
		tablestr += "<td><input type='text' name='drop_relationship[]' id='drop_relationship'class='tboxclass' value='" +Relationship+ "' disabled></td>";
		tablestr += "<td><input type='text' name='txt_name[]' id='txt_relationship_code'class='tboxclass' value='" +Name+ "' disabled></td>";
		tablestr += "<td><input type='date' name='txt_dob[]' id='txt_dob'class='tboxclass' value='" +Age+ "' disabled></td>";
		tablestr += "<td><i class='fa fa-times-circle sqdel ptr disable DeleteRow' id='DelRelationshipDetails' style='font-size:24px'></i></i></td>";
		tablestr += "</tr>";
		$("#RelationshipTable").append(tablestr);
		$('#drop_relation_name').val('');
		$('#drop_relationship').val('');
		$('#txt_name').val('');
		$('#txt_dob').val('');
	});
	$(document).on('click','.DeleteRow',function(){
		$(this).closest("tr").remove();
	}); 

</script>
@endsection
