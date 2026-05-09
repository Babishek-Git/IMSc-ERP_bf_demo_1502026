@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

@php

if(isset($data['ShowOrganization'])){
	$ShowOrganizationData = $data['ShowOrganization'];
	foreach($ShowOrganizationData as $work){
		$OrgCode =  $work->org_code;//
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
								<div class="div3">&nbsp;</div>
								<div class="div6 mbtable">
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Organization Creation</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
																	
											<div class="row smclearrow"></div>                                                                                											
											<div class="div4 label">Organization Create For</div>
                                            <input type="hidden" name="max_group" id="max_group" value="1" />
											<div class="div8">                                                
                                                <div class = "GR1">
                                                    <select class="group selectlgbox" name="cmb_group[]" id="cmb_group1" data-group = "1" style="width:100%">
                                                        <option value=""> --- Select --- </option>
                                                        @if(isset($data['ShowOrganization']))
                                                            @foreach($data['ShowOrganization'] as $List)
															@if($List->active == 1)
                                                                <option value="{{ $List->orgid }}"  data-parent-id="{{ $List->parent_id }}" data-org-code="{{ $List->org_code }}" >{{ $List->org_name }}</option>
															@endif
															@endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>                                            
											<div class = "GR1"><div class="row smclearrow"></div></div> 
											@php $AddUrl = 'organization.ViewOffice'; @endphp 										
											<div class="row">
												<div class="div12" align="center">
													<input type="button" class="backbutton" name="btn_view" id="btn_view" value=" Back " onClick="window.location='{{route($AddUrl)}}'" />
													<input type="submit" class="step-btn" name="btn_save" id="btn_save" value=" Save " />				
													<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
													<input type="hidden" name="org_code" id="org_code" value="">
													<input type="hidden" name="officeNo" id="officeNo" value="">
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
	$(document).ready(function() {
		$("#cmb_group1").chosen();
		$('body').on("change",".group", function(e){ 
			var groupid = $(this).val();
			var level = $(this).attr('data-group');
			var nextLevel = Number(level)+1;
			var MaxLevel = $("#max_group").val();
			var parentID = $(this).find("option:selected").data('parent-id');
			for(var i = nextLevel; i <= MaxLevel; i++){
				$('.GR'+i).remove();
			} 
			let OfficeTypeName = "";
			var selectedOption = $(this).find('option:selected');
			if(selectedOption.val() !== "") {
				if(selectedOption.data('org-code')){
					if(selectedOption.data('org-code') == "G"){
						OfficeTypeName = "";
					}else if(selectedOption.data('org-code') == "D"){
						OfficeTypeName = "Group";
					}else if(selectedOption.data('org-code') == "S"){
						OfficeTypeName = "Divison";
					}else{
						OfficeTypeName = "";
					}
				}
			}
			
			if(groupid != ""){
				if (parentID == 0) {
					groupid = "NEW"; 
				}
				if(groupid == "NEW"){
					let GrpApp = '<div class="div4 label">Office Name  <span class="reqindi">*</span></div><div class="div8"><input type="text" class="tboxclass OffName"  name="new_group[]" id="new_group'+level+'" maxlength="100" data-group="'+level+'" autocomplete="off" /></div>';
				 		GrpApp += '<div class="div4 label">Office Short Name  <span class="reqindi">*</span></div><div class="div8"><input type="text" class="tboxclass Offshname"  name="txt_office_shortName[]" id="txt_office_shortName'+level+'" maxlength="40" data-group="'+level+'" autocomplete="off" /></div>';
					$('.GR'+level).last().after('<div class = "GR'+nextLevel+'"><div class="row smclearrow">'+GrpApp+'<div class = "GR'+nextLevel+'"><div class="row smclearrow"></div>');
				}else{
					$.ajax({ 
						type: 'POST', 
						url: '{{ route("organization.OfficeFind") }}', 
						data: { "_token": "{{ csrf_token() }}", groupid: groupid, level: level,parentID: parentID }, 
						dataType: 'json',
						success: function (data) { 
							if(data != null){
								var OptionList = '<option value=""> ----- Select ----- </option>';
									$.each(data, function(index, element) {	
		 								var officeId = element.office_id;
		 								OptionList += '<option value="NEW" data-id="'+ officeId +'"  name="officeId" id="officeId" data-parid="'+element.repoting_to_office+'" value="'+officeId+'">'+element.office_name+'</option>';
		 							});
								$('.GR'+level).last().after('<div class = "GR'+nextLevel+'"><div class="row smclearrow"><div class="div4 label">'+OfficeTypeName+' Name</div><div class="div8"><select class="group selectlgbox2" name="cmb_group[]" id="cmb_group'+nextLevel+'" data-group="'+nextLevel+'" style="width:100%;" >'+OptionList+'</select></div><div class = "GR'+nextLevel+'"><div class="row smclearrow"></div>');
								$("#cmb_group"+nextLevel).chosen();
							}else{
								$('.GR'+level).last().after('<div class = "GR'+nextLevel+'"><div class="row smclearrow"><div class="div4 label">New Group '+level+'</div><div class="div8"><input type="text" class="tboxclass"  name="new_group[]" id="new_group'+nextLevel+'" data-group="'+nextLevel+'" required autocomplete="off"/></div><div class = "GR'+nextLevel+'"><div class="row smclearrow"></div>');
							}
						}
					});
				}
			}
			$("#max_group").val(nextLevel);
		});

		/*$('body').on("input", "input[name^='txt_office_shortName']", function() {
			$(this).val($(this).val().toUpperCase());
			var officeShortName = $(this).val();
			var pattern = /^[A-Za-z\s]+$/;
			if (!pattern.test(officeShortName)) {
                BootstrapDialog.alert("Office Short Name should contain only letters");
				$(this).val("")
            }
		});*/

		$('body').on("click", "#btn_save", function (event) {
			var GrpCnt = 0;
			$(".group").each(function () {
				var Grp = $(this).val();
				if (Grp == "") {
					GrpCnt++;
				}
				var OffName = $(".OffName").val(); 
				var Offshname 	= $(".Offshname").val();
				if(OffName == ""){
					BootstrapDialog.alert("Please Enter the Office Name");
					event.preventDefault();
					event.returnValue = false;
				}else if(Offshname == "") {
					BootstrapDialog.alert("Please Enter the Office Short Name");
					event.preventDefault();
					event.returnValue = false;
				}
			});
			var CodeErr = $("#txt_code_err").val();
			if (GrpCnt > 0) {
				BootstrapDialog.alert("Error: Group Name in the drop-down box should not be empty");
				event.preventDefault();
				event.returnValue = false;
			} else if (CodeErr == 1) {
				BootstrapDialog.alert("Error: Group Code already exists. Please enter a different code.");
				event.preventDefault();
				event.returnValue = false;
			}
		});

		$('body').on("change","#cmb_group1", function(e){
			var selectedOption = $(this).find('option:selected');
			if (selectedOption.val() !== "") {
				$('#org_code').val(selectedOption.data('org-code'));
			} else {
				$('#org_code').val("");
			}
		});

		$('body').on("change","#cmb_group2", function(e){
			var selectedOption1 = $(this).find('option:selected').data('id');
			if (selectedOption1 !== "") {
				var OffID = selectedOption1;
				$('#officeNo').val(OffID);
			} else {
				$('#officeNo').val("");
			}
		});		

	});
	

</script>

@endsection

