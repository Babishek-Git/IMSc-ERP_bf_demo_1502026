@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
<style>
	table{
		margin-top:15px;
		color:#0053A6;
	}
	.note{
		text-decoration: none;
		padding: 2px 14px;
		color: #fff;
		border: none;
		background-color: transparent;
		font-size: 13px;
		outline:none;
	}
	.col-status{
		float: left;
		position: relative;
		min-height: 1px;
		padding-right: 2px;
		padding-left: 2px;
		width:24%;
	}
	.well-A{
		background-color:#F4F5F7;/*#038BCF*/
		border: 2px solid #055DAB;/*038BCF*/
		color:#032FAD;
		font-family:Verdana, Arial, Helvetica, sans-serif;
		cursor:pointer;
		border-radius:8px;
		margin-right:2px;
		padding:8px 8px;
	}
	.well-A.active{
		background-color:#055DAB;
		border: 2px solid #055DAB;
		color:#fff;
	}
</style>  
<div class="content">
	<div class="title"></div>
	<div class="container_12">
    	<div class="grid_12">
			<blockquote class="bq1" style="overflow:auto">
				<form name="form" method="post" action="{{ route('admin.agreementstaffassign2update') }}">
					<div class="container">
						<div class="row ">
							<div class="div2">&nbsp;</div>
							<div class="div8 mbtable">
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Staff - Work Assign</div></div></div>
								<div class="row innerdiv">
									<div class="row">
										<div class="div4" >
											<label for="fname">Work Short Name</label>
										</div>
										<div class="div8">
											<select id="cmb_shortname" name="cmb_shortname" class="tboxclass"  style="width:540px;height:22px;"  >
												<option value="">--------------- Select --------------- </option>
												@if(isset($data1))
													@foreach($data1 as $wname)
														@php
															if((isset($PIN))&&($PIN == $wname->sheetid)){
																$SelStr = 'selected="selected"';
															}else{
																$SelStr = '';
															}
														@endphp
														<option value="{{ encrypt($wname->sheetid) }}" {{ $SelStr }}> {{ $wname->work_order_no }} - {{ $wname->short_name }} </option>
													@endforeach
												@endif
											</select>
										</div>
									</div>
									<div class="row">
										<div class="div4">
											<label for="fname">Work Order No.</label>
										</div>
										<div class="div8">
											<input type="text" name='txt_workorder' id='txt_workorder' class="tboxclass"  style="width:540px;height:22px;" readonly="" value="">
										</div>
									</div>
									<div class="row">
										<div class="div4">
											<label for="fname">Contractor Name</label>
										</div>
										<div class="div8">
											<input type="text" name='txt_contractorname' id='txt_contractorname' class="tboxclass"  style="width:540px;height:22px;" readonly="" value="">
										</div>
									</div>
									<div class="row">
										<div class="div4" >
											<label for="fname">Name of Work</label>
										</div>
										<div class="div8">
											<textarea name='txt_workname' id='txt_workname' class="tboxclass"  style="width:540px;"  readonly="" rows="2"></textarea>
										</div>
									</div>
									<div class="row" align="center">
										<div class="div4"></div>
										<div class="div4" align="center">
											<div class="well-A active" align="center" id="AssignStaff">Click here to assign staff for Works</div>
										</div>
										<div class="div4"></div>
									</div>
									<div class="smediv">&nbsp;</div>
									<div class="row" align="center">
										<div class="div12" align="center" id="stafflist">
										</div>
									</div>
									<div class="smediv">&nbsp;</div>
									
									<!-- <div class="row" align="center">
										<div class="div3" style="box-sizing:border-box; padding:1px;">
											<div class="col-md-12 well-A level" id="level_check1" data-level='1' data-check='N' align="left" style="margin-right:0px;box-sizing:border-box;"><i class='fa fa-check-circle' style='font-size:20px; color:#CACACA'></i> Scientific Assistant </div>
										</div>
										<div class="div2" style="box-sizing:border-box; padding:1px;">	
											<div class="col-md-12 well-A level" id="level_check2" data-level='2' data-check='N' align="left" style="margin-right:0px;box-sizing:border-box;"><i class='fa fa-check-circle' style='font-size:20px; color:#CACACA'></i> Site Engineer</div>
										</div>
										<div class="div3" style="box-sizing:border-box; padding:1px;">	
											<div class="col-md-12 well-A level" id="level_check3" data-level='3' data-check='N' align="left" style="margin-right:0px;box-sizing:border-box;"><i class='fa fa-check-circle' style='font-size:20px; color:#CACACA'></i> Engineer Incharge</div>
										</div>
										<div class="div4" style="box-sizing:border-box; padding:1px;">	
											<div class="col-md-12 well-A level" id="level_check4" data-level='4' data-check='N' align="left" style="margin-right:0px;box-sizing:border-box;"><i class='fa fa-check-circle' style='font-size:20px; color:#CACACA'></i> Superintendent Engineer</div>
										</div>
									</div> -->

									<div class="row">
										<div class="div12" align="center">
											<input type="submit" data-type="submit" value=" Save " name="submit" id="submit"/> 
											<!-- <input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/> -->
											<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
										</div>
									</div> 
									

								</div>
								<div class="smediv">&nbsp;</div>
							</div>
							<div class="div2">&nbsp;</div>
						</div>
					</div>
					<input type="hidden" name="txt_multi_staff" id="txt_multi_staff" value="">
					<input type="hidden" name="txt_multi_section" id="txt_multi_section" value="">
					<input type="hidden" name="txt_level" id="txt_level" value="">
				</form>
			</blockquote>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('#cmb_shortname').chosen();
	});
	$('#cmb_shortname').change(function() {
		var Id = $(this).val();
		$("#txt_workorder_no").val('');
		$("#txt_workname").val('');
		$("#txt_contractorname").val('');		
		$.ajax({
			type:'POST',
			url:"{{ route('ajax.FindWorkName') }}",
			data:{'_token': '{{ csrf_token() }}','Id':Id, 'Page':'WORK'},
			success:function(data){ 
				if(data != null){  
				var SheetData = data['sheetdata']; 
				var ContractorData = data['contData'];
				var AssignedStaff = data['AssignedStaff'];
					$.each(SheetData, function(key, value) { 
						$("#txt_workorder").val(value.work_order_no);
						$("#txt_workname").val(value.work_name);
					});
					$.each(ContractorData, function(key, value) { 
						$("#txt_contractorname").val(value.name_contractor);
					});
					var sels = []; var icno = [];
					if(AssignedStaff != null){console.log(AssignedStaff);
						EmployeeNo = AssignedStaff.split(',');
						$.ajax({
							'async': false,
							type:'POST',
							url:"{{ route('ajax.GetAllEmployee') }}",
							data:{"_token": "{{ csrf_token() }}",'Id':Id},
							success: function(data){
								if(data.EmpData){ 
									var staffNumbers = []; // store only numbers
									var sels = '';         // store HTML badges
									if(EmployeeNo.length > 0){
										for(var i = 0; i < EmployeeNo.length; i++){
											var icno = EmployeeNo[i];
											$.each(data.EmpData, function(index, element) { 
												if(element.emp_no == icno){
													staffNumbers.push(element.emp_no); // ✅ collect staff numbers
													sels += '<span class="staffbox" id="'+index+'"><i class="fa fa-check-circle" style="padding-top:4px;"></i> '+element.emp_known_as+' <br/> <i style="font-size:11px; color:white">'+element.emp_no+' </i><br><i style="font-size:10px; color:#9B9B9B">'+element.designation_name+'</i></span>&nbsp;';
												}						
											});
										}
									}
									if(sels !== ''){
										$('#txt_multi_staff').val(staffNumbers.join(',')); // ✅ now it's an array
										$('#stafflist').html(sels);
									}	
								}
							}
						});
					}
					else if(AssignedStaff == null){
						$('#stafflist').html(sels);
					}
				}
			}
		});
	});

    $(function() {
		$.fn.validateworkorder = function(event) { 
			if($("#cmb_shortname").val() == ""){ 
				BootstrapDialog.alert("Please select the work short name");
				event.preventDefault();
				event.returnValue = false;
			}else if($("#txt_multi_staff").val() == ""){ 
				BootstrapDialog.alert("Please assign atleast one staff to work");
				event.preventDefault();
				event.returnValue = false;
			}
			/*else if($("#txt_level").val() == ""){ 
				BootstrapDialog.alert("Please assign atleast one level to check measurements.");
				event.preventDefault();
				event.returnValue = false;
			}*/
		}
	});
	$("#top").submit(function(event){
		$(this).validateworkorder(event);
	});

</script>

<!-- <script src="../bootstrap-dialog/js/bootstrap.min.js"></script> 
<script src="../bootstrap-dialog/js/bootstrap-dialog.min.js"></script>
<script src="../bootstrap-dialog/js/run_prettify.min.js"></script> -->
<script>
	$(function(){
		$('#AssignStaff').click(function(){ 
			var DialogMsg = function () {
				var tmp = '';
				var Id = $('#cmb_shortname').val();
				$.ajax({
					'async': false,
					type:'POST',
					url:"{{ route('ajax.GetAllEmployee') }}",
					data:{"_token": "{{ csrf_token() }}",'Id':Id},
					success:function(data){
						if(data.EmpData){ 
							tmp += '<div class="col-md-12 padding-1" style="text-align:left">';
							const AlphaArr = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z",];
							for (let i = 0; i < AlphaArr.length; ++i) {
								tmp += '<span class="smallbox" id="'+AlphaArr[i]+'">'+AlphaArr[i]+'</span>&nbsp;';
							}
							tmp +='<input type="text" name="txt_search" id="txt_search" class="searchbox" placeholder=" Search Name here..." value=""/>';
							tmp +='<span style="height:10px; font-size:12px;">';
							tmp +='<span class="smallbox1">Search</span>';
							tmp +='<span class="smallbox2">Highlighted</span>';
							tmp +='</span>';
							tmp +='</div>';
							$.each(data.EmpData, function(index, element) { 
								if(	
									(data['WcmsRoleGroupCode'] == 'ADMUSER' && element.division_code == data['WcmsEmpDiv'] && element.active == 1) ||
									(data['WcmsRoleGroupCode'] == 'ACCUSER' && element.division_code == data['WcmsEmpDiv'] && element.active == 1) ||
									(data['WcmsRoleGroupCode'] == 'SUPUSER' && element.active == 1)
								)
								{
									tmp += '<div class="col-md-2 padding-1 multi-mark" align="left">';
									tmp += '<a class="list-group-item media d-flex justify-content-between align-items-center outer-w3-agile col no-box-shaddow font-1" style="padding:5px; margin:1px;">';
									tmp += '<div class="media-body d-flex justify-content-between align-items-center">';
									tmp += '<div class="lg-item-heading">';
									tmp += '<input type="checkbox" id="IC' + element.emp_no + '" class="staff_icno" value="' + element.emp_no + '" style="display:none" name="checkbox[]" data-section="' + element.section_code + '" data-sname="' + element.emp_known_as + ' "data-staffno="'+element.emp_no+' "data-desig="' + element.designation_name + '"/>';
									tmp += '<i style="font-size:16px; color:#E2E2E2; padding-top:3px; padding-right:5px;" class="fa">&#xf058;</i>';
									tmp +=  element.emp_known_as+'<br/><span class="role" style="font-size:10px; ">'+element.emp_no+'<br/><span class="role" style="font-size:10px; color:#9B9B9B">'+element.designation_name+'</span>';
									tmp += '</div>';
									tmp += '</div>';
									tmp += '</a>';
									tmp += '</div>';	
								}
							});
						}
					}
				});
				return tmp;
			}();

			BootstrapDialog.show({
				title: 'Work - Staff Assign',
				cssClass: 'login-dialog',
				closable: false,
				message: function(dialog) {
					var $content = $('<div id="modal-content"></div>').html('<div class="blank-page-content"><div class="outer-w3-agile mt-3 margin-t1"><p class="paragraph-agileits-w3layouts"><div class="card-body" align="right" style="padding-top:0px;"><div class="list-group"><div class="row staff_list">'+DialogMsg+'</div></div></p></div></div></div>');
					return $content;
				},
				buttons: [{
					label: 'CANCEL',
					id: 'modal_btn_cancel', 
					action: function(dialogRef){
					dialogRef.close();
					}
				},{
					label: 'OK',
					id: 'modal_btn_ok', 
					action: function(dialogRef){
					dialogRef.close();
					}
				}],
				onshown: function(dialogRef){
					$("input:checkbox[name='checkbox[]']").each(function(){   
						$(this).removeAttr('checked');
						$(this).parents(':eq(2)').css("background", "white");
						$(this).parents(':eq(2)').css("color", "#015BB6");
						$(this).find("a").css("background", "white");
						$(this).parents(':eq(1)').css("background", "white");
						$(this).parents(':eq(0)').css("background", "white");
					});
					var Stafflist = $('#txt_multi_staff').val();
					var SplitStafflist = Stafflist.split(",");
					var i;
					for(i=0; i<SplitStafflist.length; i++){
						var icno = SplitStafflist[i];  
						$("#IC"+icno).prop('checked','checked');
						$("#IC"+icno).parents(':eq(2)').css("background", "#E11069");
						$("#IC"+icno).parents(':eq(2)').css("color", "white");
						//$("#IC"+icno).find("span").css("color", "white");
						$("#IC"+icno).find("a").css("background", "#E11069");
						$("#IC"+icno).parents(':eq(1)').css("background", "#E11069");
						$("#IC"+icno).parents(':eq(0)').css("background", "#E11069");
						
					}
				}
			});
		});
		$('body').on('click','.multi-mark',function(){
			$('#txt_multi_staff').val(''); 
			var $checks = $(this).find('input:checkbox[class=staff_icno]');
			$checks.prop("checked", !$checks.is(":checked"));
			var selected = []; var section = [];
			$('#modal-content input:checked').each(function() {   
				if($(this).is(':checked')){
					selected.push($(this).val());
					var sec = $(this).attr('data-section');
					section.push(sec);
				}
			});
			$('#txt_multi_staff').val(selected.join(","));
			$('#txt_multi_section').val(section.join(","));
			if($checks.is(":checked")){ //alert("checked");
				$(this).find("div").css("background", "#E11069");
				$(this).find("a").css("background", "#E11069");
				$(this).find("div").css("color", "white");
				$(this).find("a").css("color", "white");
				$(this).find("span").css("color", "white");
			}else{ //alert("not checked");
				$(this).find("div").css("background", "white");
				$(this).find("a").css("background", "white");
				$(this).find("div").css("color", "#015BB6");
				$(this).find("a").css("color", "#015BB6");
				$(this).find("span").css("color", "#9B9B9B");
			}
		});
		$('body').on('click','#modal_btn_ok',function(){
			$('#stafflist').html('');
			var sels = '';
			var Selstaff = $('#txt_multi_staff').val();
			var SplitSelstaff = Selstaff.split(",");
			var i;
			if(SplitSelstaff.length > 0){
				for(i=0; i<SplitSelstaff.length; i++){
					var icno = SplitSelstaff[i];  
					if(icno != ''){
						var StaffName 		 = $("#IC"+icno).attr("data-sname");
						var StaffNo 		 = $("#IC"+icno).attr("data-staffno");
						var StaffDesignation = $("#IC"+icno).attr("data-desig");
						sels += '<span class="staffbox" id="'+icno+'"><i class="fa fa-check-circle" style="padding-top:4px;"></i> '+StaffName+' <br/> <i style="font-size:11px; color:white">'+StaffNo+' </i><br><i style="font-size:10px; color:#9B9B9B">'+StaffDesignation+'</i></span>&nbsp;';
					}
				}
				if(sels != ''){
					$('#stafflist').html(sels);
				}
			}
		});
		$('body').on('click','.smallbox',function(){
			var SelectAlpha = $(this).attr('id');
			$("input:checkbox[name='checkbox[]']").each(function(){   
				var StaffName = $(this).attr('data-sname');
					StaffName = $.trim(StaffName);
				var FirstAlpha = StaffName.charAt(0);
				var Designation = $(this).attr('data-desig');
					Designation = $.trim(Designation);
					
				var FirstAlpha2 = Designation.charAt(0);
				var BgColor = $(this).parents(':eq(2)').css("backgroundColor");
				if(SelectAlpha == FirstAlpha){
					if((BgColor != 'rgb(227, 196, 20)')&&(BgColor != 'rgb(225, 16, 105)')){
						$(this).parents(':eq(2)').css("background", "#E3C414");
						$(this).parents(':eq(1)').css("background", "#E3C414");
						$(this).parents(':eq(0)').css("background", "#E3C414");
						$(this).find("a").css("background", "#E3C414");
						$(this).parents(':eq(2)').css("color", "#222221");
						$(this).find("a").css("color", "#222221");
					}
				}else if(SelectAlpha == FirstAlpha2){
					if((BgColor != 'rgb(227, 196, 20)')&&(BgColor != 'rgb(225, 16, 105)')){
						$(this).parents(':eq(2)').css("background", "#E3C414");
						$(this).parents(':eq(1)').css("background", "#E3C414");
						$(this).parents(':eq(0)').css("background", "#E3C414");
						$(this).find("a").css("background", "#E3C414");
						$(this).parents(':eq(2)').css("color", "#222221");
						$(this).find("a").css("color", "#222221");
					}
				}else{
					if((BgColor == 'rgb(227, 196, 20)')||(BgColor == 'rgb(225, 16, 105')){
						$(this).parents(':eq(2)').css("background", "white");
						$(this).parents(':eq(1)').css("background", "white");
						$(this).parents(':eq(0)').css("background", "white");
						$(this).find("a").css("background", "white");
						$(this).parents(':eq(2)').css("color", "#015BB6");
						$(this).find("a").css("color", "#015BB6");
					}
				}
			});
		});
		
		var selectedStaff = [];
		$('body').on('click', '.smallbox1', function(){
		    var SearchName = $('#txt_search').val(); // Get the value from the input field
		    if(SearchName != ""){
		        SearchName = SearchName.toUpperCase();
		        SearchNo = SearchName;
		    }
		    $("input:checkbox[name='checkbox[]']").each(function(){ 
		        var BgColor = $(this).parents(':eq(2)').css("backgroundColor");
		        if(SearchName != ""){
		            var StaffName = $(this).attr('data-sname');
		            StaffName = $.trim(StaffName);
		            var StaffNo = $(this).attr('value');
		            StaffNo = $.trim(StaffNo);
		            var FirstAlpha3 = StaffNo;
		            var FirstAlpha = StaffName.toUpperCase();
		            var Designation = $(this).attr('data-desig');
		            Designation = $.trim(Designation);
		            var FirstAlpha2 = Designation.toUpperCase();
		            if(FirstAlpha.toUpperCase().indexOf(SearchName) > -1){
						if (!selectedStaff.some(s => s.StaffName === StaffName)) {
						    selectedStaff.push({
						        staffNo: StaffNo,
						        staffName: StaffName,
						        designation: Designation
						    });
						}
						$(this).prop('checked', 'checked');
                		$(this).parents(':eq(2)').css({
                		    "background": "#E11069",
                		    "color": "white"
                		});
                		$(this).find("a").css("background", "#E11069");
                		$(this).parents(':eq(1)').css("background", "#E11069");
                		$(this).parents(':eq(0)').css("background", "#E11069");
					}else if(FirstAlpha2.toUpperCase().indexOf(SearchName) > -1){
						if (!selectedStaff.some(s => s.Designation === Designation)) {
						    selectedStaff.push({
						        staffNo: StaffNo,
						        staffName: StaffName,
						        designation: Designation
						    });
						}
						$(this).prop('checked', 'checked');
                		$(this).parents(':eq(2)').css({
                		    "background": "#E11069",
                		    "color": "white"
                		});
                		$(this).find("a").css("background", "#E11069");
                		$(this).parents(':eq(1)').css("background", "#E11069");
                		$(this).parents(':eq(0)').css("background", "#E11069");
					}
					else if(FirstAlpha3 == SearchNo){
						if (!selectedStaff.some(s => s.StaffNo === StaffNo)) {
						    selectedStaff.push({
						        staffNo: StaffNo,
						        staffName: StaffName,
						        designation: Designation
						    });
						}
						$(this).prop('checked', 'checked');
                		$(this).parents(':eq(2)').css({
                		    "background": "#E11069",
                		    "color": "white"
                		});
                		$(this).find("a").css("background", "#E11069");
                		$(this).parents(':eq(1)').css("background", "#E11069");
                		$(this).parents(':eq(0)').css("background", "#E11069");
					}else{
						if((BgColor == 'rgb(227, 196, 20)')||(BgColor == 'rgb(225, 16, 105')){
							$(this).parents(':eq(2)').css("background", "white");
							$(this).parents(':eq(1)').css("background", "white");
							$(this).parents(':eq(0)').css("background", "white");
							$(this).find("a").css("background", "white");
							$(this).parents(':eq(2)').css("color", "#015BB6");
							$(this).find("a").css("color", "#015BB6");
						}
					}
				}else{ //alert(BgColor);
					if(BgColor == 'rgb(227, 196, 20)'){
						$(this).parents(':eq(2)').css("background", "white");
						$(this).parents(':eq(1)').css("background", "white");
						$(this).parents(':eq(0)').css("background", "white");
						$(this).find("a").css("background", "white");
						$(this).parents(':eq(2)').css("color", "#015BB6");
						$(this).find("a").css("color", "#015BB6");
					}
				}
			});
			var staffNos = selectedStaff.map(s => s.staffNo);
    		$('#txt_multi_staff').val(staffNos.join(","));
		});

		$('body').on('click', '.smallbox2', function(){
		    var SearchName = $('#txt_search').val(); // Get the value from the input field
		    if(SearchName != ""){
		        SearchName = SearchName.toUpperCase();
		        SearchNo = SearchName;
		    }
		
		    $("input:checkbox[name='checkbox[]']").each(function(){ 
		        var BgColor = $(this).parents(':eq(2)').css("backgroundColor");
		        if(SearchName != ""){
		            var StaffName = $(this).attr('data-sname');
		            StaffName = $.trim(StaffName);
		            var StaffNo = $(this).attr('value');
		            StaffNo1 = $.trim(StaffNo);
		            var FirstAlpha3 = StaffNo;
		            var FirstAlpha = StaffName.toUpperCase();
		            var Designation = $(this).attr('data-desig');
		            Designation = $.trim(Designation);
		            var FirstAlpha2 = Designation.toUpperCase();
				
		            if(FirstAlpha.toUpperCase().indexOf(SearchName) > -1){
						if((BgColor != 'rgb(227, 196, 20)')&&(BgColor != 'rgb(225, 16, 105)')){
							$(this).parents(':eq(2)').css("background", "#E3C414");
							$(this).parents(':eq(1)').css("background", "#E3C414");
							$(this).parents(':eq(0)').css("background", "#E3C414");
							$(this).find("a").css("background", "#E3C414");
							$(this).parents(':eq(2)').css("color", "#222221");
							$(this).find("a").css("color", "#222221");
						}
					}else if(FirstAlpha2.toUpperCase().indexOf(SearchName) > -1){
						if((BgColor != 'rgb(227, 196, 20)')&&(BgColor != 'rgb(225, 16, 105)')){
							$(this).parents(':eq(2)').css("background", "#E3C414");
							$(this).parents(':eq(1)').css("background", "#E3C414");
							$(this).parents(':eq(0)').css("background", "#E3C414");
							$(this).find("a").css("background", "#E3C414");
							$(this).parents(':eq(2)').css("color", "#222221");
							$(this).find("a").css("color", "#222221");
						}
					}
					else if(FirstAlpha3 == SearchNo){
						if((BgColor != 'rgb(227, 196, 20)')&&(BgColor != 'rgb(225, 16, 105)')){
							$(this).parents(':eq(2)').css("background", "#E3C414");
							$(this).parents(':eq(1)').css("background", "#E3C414");
							$(this).parents(':eq(0)').css("background", "#E3C414");
							$(this).find("a").css("background", "#E3C414");
							$(this).parents(':eq(2)').css("color", "#222221");
							$(this).find("a").css("color", "#222221");
						}
					
					}else{
						if((BgColor == 'rgb(227, 196, 20)')||(BgColor == 'rgb(225, 16, 105')){
							$(this).parents(':eq(2)').css("background", "white");
							$(this).parents(':eq(1)').css("background", "white");
							$(this).parents(':eq(0)').css("background", "white");
							$(this).find("a").css("background", "white");
							$(this).parents(':eq(2)').css("color", "#015BB6");
							$(this).find("a").css("color", "#015BB6");
						}
					}
				}else{ //alert(BgColor);
					if(BgColor == 'rgb(227, 196, 20)'){
						$(this).parents(':eq(2)').css("background", "white");
						$(this).parents(':eq(1)').css("background", "white");
						$(this).parents(':eq(0)').css("background", "white");
						$(this).find("a").css("background", "white");
						$(this).parents(':eq(2)').css("color", "#015BB6");
						$(this).find("a").css("color", "#015BB6");
					}
				}
			});
		});

		$('body').on('click','.searchbox',function(){
			var SearchName = $(this).val();
			if(SearchName != ""){
				SearchName = SearchName.toUpperCase();
				SearchNo = SearchName;
			}
			$("input:checkbox[name='checkbox[]']").each(function(){ 
				var BgColor = $(this).parents(':eq(2)').css("backgroundColor");
				if(SearchName != ""){
					var StaffName = $(this).attr('data-sname');
						StaffName = $.trim(StaffName);
					var StaffNo = $(this).attr('value');
						StaffNo1 = $.trim(StaffNo);
					var FirstAlpha3 = StaffNo;
					
					var FirstAlpha = StaffName.toUpperCase();
					var Designation = $(this).attr('data-desig');
						Designation = $.trim(Designation);
					var FirstAlpha2= Designation.toUpperCase();
					if(FirstAlpha.toUpperCase().indexOf(SearchName) > -1){
						if((BgColor != 'rgb(227, 196, 20)')&&(BgColor != 'rgb(225, 16, 105)')){
							$(this).parents(':eq(2)').css("background", "#E3C414");
							$(this).parents(':eq(1)').css("background", "#E3C414");
							$(this).parents(':eq(0)').css("background", "#E3C414");
							$(this).find("a").css("background", "#E3C414");
							$(this).parents(':eq(2)').css("color", "#222221");
							$(this).find("a").css("color", "#222221");
						}
					}else if(FirstAlpha2.toUpperCase().indexOf(SearchName) > -1){
						if((BgColor != 'rgb(227, 196, 20)')&&(BgColor != 'rgb(225, 16, 105)')){
							$(this).parents(':eq(2)').css("background", "#E3C414");
							$(this).parents(':eq(1)').css("background", "#E3C414");
							$(this).parents(':eq(0)').css("background", "#E3C414");
							$(this).find("a").css("background", "#E3C414");
							$(this).parents(':eq(2)').css("color", "#222221");
							$(this).find("a").css("color", "#222221");
						}
					}
					else if(FirstAlpha3 == SearchNo){
						if((BgColor != 'rgb(227, 196, 20)')&&(BgColor != 'rgb(225, 16, 105)')){
							$(this).parents(':eq(2)').css("background", "#E3C414");
							$(this).parents(':eq(1)').css("background", "#E3C414");
							$(this).parents(':eq(0)').css("background", "#E3C414");
							$(this).find("a").css("background", "#E3C414");
							$(this).parents(':eq(2)').css("color", "#222221");
							$(this).find("a").css("color", "#222221");
						}
					
					}else{
						if((BgColor == 'rgb(227, 196, 20)')||(BgColor == 'rgb(225, 16, 105')){
							$(this).parents(':eq(2)').css("background", "white");
							$(this).parents(':eq(1)').css("background", "white");
							$(this).parents(':eq(0)').css("background", "white");
							$(this).find("a").css("background", "white");
							$(this).parents(':eq(2)').css("color", "#015BB6");
							$(this).find("a").css("color", "#015BB6");
						}
					}
				}else{ //alert(BgColor);
					if(BgColor == 'rgb(227, 196, 20)'){
						$(this).parents(':eq(2)').css("background", "white");
						$(this).parents(':eq(1)').css("background", "white");
						$(this).parents(':eq(0)').css("background", "white");
						$(this).find("a").css("background", "white");
						$(this).parents(':eq(2)').css("color", "#015BB6");
						$(this).find("a").css("color", "#015BB6");
					}
				}
			});
		});



		$('body').on('click','.level',function(){
			var level = $(this).attr('data-level');
			var check = $(this).attr('data-check');
			if(check == 'N'){
				$(this).addClass("active");
				$(this).attr('data-check','Y');
			}else{
				$(this).removeClass("active");
				$(this).attr('data-check','N');
			}
			var Level = [];
			var check1 = $('#level_check1').attr('data-check');
			var check2 = $('#level_check2').attr('data-check');
			var check3 = $('#level_check3').attr('data-check');
			var check4 = $('#level_check4').attr('data-check');
			if(check1 == 'Y'){ Level.push(1); }
			if(check2 == 'Y'){ Level.push(2); }
			if(check3 == 'Y'){ Level.push(3); }
			if(check4 == 'Y'){ Level.push(4); }
			$('#txt_level').val(Level.join(","));
		});
	});
</script>
<style>
   	.modal-dialog {
		width: 90%;
	}
  	.small{
		font-weight:normal;
	}
	.pignose-calender {
		max-width: 450px;
	}
	.multi-mark{
		cursor:pointer;
	}
	.multi-mark .outer-w3-agile:hover{
		background:#DFDFDF;
	}
	.padding-1 {
   	 	padding: 1px 0px;
	}
  	.modal-dialog {
    	width: 90%;
	}
	.smallbox{
		background:#fff; 
		color:#FF061F; 
		padding-right:5px; 
		padding-left:5px; 
		font-weight:bold; 
		font-size:13px;
		border:1px solid #B5B5B5;
		cursor:pointer;
		border-radius:8px;
		font-family:Verdana, Arial, Helvetica, sans-serif;
	}
	.smallbox:hover{
		background:#FF061F; 
		color:#fff;
		border:1px solid #FF061F;
	}
	.smallbox1{
		background:#E11069; 
		color:#fff; 
		padding-right:5px; 
		padding-left:5px; 
		font-weight:bold; 
		font-size:12px;
		border:1px solid #E11069;
		cursor:pointer;
		border-radius:8px;
		font-family:Verdana, Arial, Helvetica, sans-serif;
	}
	.smallbox1:hover{
		background:#E11069; 
		color:#fff;
		border:1px solid #E11069;
	}
	.smallbox2{
		background:#E3C414; 
		color:#fff; 
		padding-right:5px; 
		padding-left:5px; 
		font-weight:bold; 
		font-size:12px;
		border:1px solid #E3C414;
		cursor:pointer;
		border-radius:8px;
		font-family:Verdana, Arial, Helvetica, sans-serif;
	}
	.smallbox2:hover{
		background:#E3C414; 
		color:#fff;
		border:1px solid #E3C414;
	}
	.searchbox{
		border:1px solid #359AFF;
		color:#004DFF;
		border-radius:5px;
	}
	.staffbox{
		background:rgb(225, 16, 105); 
		color:#fff;
		padding:6px 10px; 
		font-weight:bold; 
		font-size:13px;
		border:1px solid rgb(225, 16, 105);
		cursor:pointer;
		border-radius:10px;
		font-family:Verdana, Arial, Helvetica, sans-serif;
		display: inline-block;
	}
</style>
@endsection