@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
   
	<!--==============================Content=================================-->
	<div class="content">
		<div class="title"></div>
		<div class="container_12">
				<blockquote class="bq1" style="overflow:auto"> 
				<div align="right"><a href=a href="{{ route ('admin.staffallotmentedit') }}">Over All View</a></div>
					<form name="form" method="post" action="{{ route('admin.savembookallotment') }}">
						<div class="container">
							<div class="row ">
								<div class="div2">&nbsp;</div>
								<div class="div8 mbtable">
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Staff-Wise General / Steel / Abstract / Escalation MBook Allotment</div></div></div>
									<div class="row innerdiv">
										<div class="row">
											<div class="div4">
												<label for="fname">Work Short Name</label>
											</div>
											<div class="div8">
												<select id="workorderno" name="workorderno" class="tboxclass" required>
													<option value="">--------------- Select ---------------</option>
													@foreach($data['works'] as $work)
															<option value="{{ $work['sheetid'] }}">{{ $work['short_name'] }}</option>
													@endforeach
												</select>
											</div>
										</div>
										<div class="row">
											<div class="div4">
												<label for="fname">Work Order No.</label>
											</div>
											<div class="div8">
												<input type="text" name='txt_workorder_no' id='txt_workorder_no' class="tboxclass" readonly="" value="" required>
											</div>
										</div>
										<div class="row">
											<div class="div4">
												<label for="fname">Name of Work</label>
											</div>
											<div class="div8">
												<textarea name='txt_workname' id='txt_workname' class="tboxclass" readonly="" rows="2" required></textarea>
											</div>
										</div>
										<div class="row">
											<div class="div4">
												<label for="fname">Staff Name</label>
											</div>
											<div class="div8">
												<select id="staffname" name="staffname" class="tboxclass" required>
													<option value="">--------------- Select ---------------</option>
													@foreach($data['StaffData'] as $Staffs)
															<option value="{{ $Staffs['staffid'] }}">{{ $Staffs['staffname'] }}</option>
													@endforeach
													<!-- <option value="1">Ramu</option>
													<option value="2">Raju</option>
													<option value="3">Somu</option> -->
												</select>
											</div>
										</div>
										
										<div class="row">
											<div class="div3" align="center">
												<div class="innerdiv2">
													<div class="row divhead" align="center">General</div>
													<div class="row innerdiv" align="center">
														<select id="mbookG" name="mbookG[]" class="tboxclass mbno" multiple="multiple">
														</select>
													</div>
												</div>
											</div>
											<div class="div3" align="center">
												<div class="innerdiv2">
													<div class="row divhead" align="center">Steel</div>
													<div class="row innerdiv" align="center">
														<select id="mbookS" name="mbookS[]" class="tboxclass mbno" multiple="multiple">
														</select>
													</div>
												</div>
											</div>
											<div class="div3" align="center">
												<div class="innerdiv2">
													<div class="row divhead" align="center">Abstract</div>
													<div class="row innerdiv" align="center">
														<select id="mbookA" name="mbookA[]" class="tboxclass mbno" multiple="multiple">
														</select>
													</div>
												</div>
											</div>
											<div class="div3" align="center">
												<div class="innerdiv2">
													<div class="row divhead" align="center">Escalation</div>
													<div class="row innerdiv" align="center">
														<select id="mbookE" name="mbookE[]" class="tboxclass mbno" multiple="multiple">
														</select>
													</div>
												</div>
											</div>
										</div>
									</div>				
								</div>
								<div class="div2">&nbsp;</div>
							</div>
						</div>
						<div class="smediv"></div>
						<div class="row">
						@php $AddUrl = 'admin.staffallotmentedit'; @endphp
							<div class="div12" align="center">
							    <input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
							    <input type="submit" data-type="submit" value=" Submit " name="Submit" id="Submit" onClick=""/>
								<!-- <input type="button" class="backbutton" name="btn_view" id="btn_view" value="View" data-url="{{ route($AddUrl) }}"/> -->
								<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
							</div>
						</div>
					</form>
				</blockquote>
		</div>
	</div>
<script>
	$('#workorderno').chosen();
	$('#mbookG').chosen();
	$('#mbookS').chosen();
	$('#mbookA').chosen();
	$('#mbookE').chosen();

	$('#workorderno').change(function() {
		var work = $(this).val();
		$("#txt_workorder_no").val('');
		$("#txt_workname").val('');
		$("#staffname").val('');
		$.ajax({
			type:'POST',
			url:"{{ route('posts.getwork') }}",
			data:{'_token': '{{ csrf_token() }}','work':work},
			success:function(data){ 
				if(data){ 
					$.each(data, function(key, value) { 
						$("#txt_workorder_no").val(value.work_order_no);
						$("#txt_workname").val(value.work_name);
					});
				}
			}
		});
	});
	$('#workorderno').change(function() { 
		var work = $(this).val(); 
		$("#mbookG").chosen('destroy');
		$("#mbookS").chosen('destroy');
		$("#mbookA").chosen('destroy');
		$("#mbookE").chosen('destroy');
		$('#mbookG').empty();
		$('#mbookS').empty();
		$('#mbookA').empty();
		$('#mbookE').empty();
		$.ajax({
			type:'POST',
			url:"{{ route('ajax.GetAllMbook') }}",
			data:{'_token": "{{ csrf_token() }}','work':work },
			success:function(data){ //console.log(data);
				if(data){ 
					$.each(data, function(index, element) { //data- is the inbuilt syntax like date should not change it. data-imr_date="'+element.imr_date+'"(name from database table)
						if(index == "G"){
							$.each(element, function(Gindex, Gelement) { //alert(Gelement.mballotmentid);
								$("#mbookG").append('<option value="'+Gelement.mballotmentid+'" data-mbno="'+Gelement.mbno+'" data-mbooktype="'+Gelement.mbooktype+'">'+Gelement.mbno+'</option>');
							});
						}
						if(index == "S"){
							$.each(element, function(Sindex, Selement) { 
								$("#mbookS").append('<option value="'+Selement.mballotmentid+'" data-mbno="'+Selement.mbno+'" data-mbooktype="'+Selement.mbooktype+'">'+Selement.mbno+'</option>');
							});
						}
						if(index == "A"){
							$.each(element, function(Aindex, Aelement) { 
								$("#mbookA").append('<option value="'+Aelement.mballotmentid+'" data-mbno="'+Aelement.mbno+'" data-mbooktype="'+Aelement.mbooktype+'">'+Aelement.mbno+'</option>');
							});
						}
						if(index == "E"){ 
							$.each(element, function(Eindex, Eelement) { 
								$("#mbookE").append('<option value="'+Eelement.mballotmentid+'" data-mbno="'+Eelement.mbno+'" data-mbooktype="'+Eelement.mbooktype+'">'+Eelement.mbno+'</option>');
							});
						}
					});
					$('#mbookG').chosen();
					$('#mbookS').chosen();
					$('#mbookA').chosen();
					$('#mbookE').chosen();
				}
			}
		});
	});
	$("body").on("click", "#btn_view", function(event) {
		var workorder = $("#workorderno").val();
		if(workorder == ''){
			BootstrapDialog.alert("Please Select Work Short Name");
			event.preventDefault;
			return false;
		}else{
			var Url = $(this).attr("data-url");
			window.location = Url;
		}
		
		
	});
	$("body").on("click", "#Submit", function(event) {
		var workorder = $("#workorderno").val();
		if(workorder == ''){
			BootstrapDialog.alert("Please Select Work Short Name");
			event.preventDefault;
			return false;
		}else{
			var Url = $(this).attr("data-url");
			window.location = Url;
		}
		
		
	});

</script>
@endsection	
