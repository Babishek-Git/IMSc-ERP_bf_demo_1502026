@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
	<form action="{{ route('admin.ExecuteByWork') }}" method="post" enctype="multipart/form-data" name="form">
		<div class="content">
			<div class="title"></div>
			<div class="container_12">
				<div class="grid_12">
					<blockquote class="bq1" style="overflow:auto">
						<div class="container">
							<div class="row ">
								<div class="div2">&nbsp;</div>
								<div class="div8 mbtable">
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Executed By</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
											<div class="row smclearrow"></div>                                                                                											
											<div class="div3 label">Name of Work <span class="reqindi">*</span></div>											
											<div class="div9">
											<select name="sel_name_of_works" id="sel_name_of_works" class="tboxclass nameofwork" style="height: 30px; width: 67%;" tabindex="1" >
												<option value="">--------------- Select ---------------</option>
												@if(isset($data['Works']))
													@foreach($data['Works'] as $key=>$value)
														<option value="{{ $value->globid }}" data-id="{{ encrypt($value->globid) }}">{{ $value->work_name }}</option>
													@endforeach
												@endif
											</select>
											</div>
											<div class="row smclearrow"></div>
											<div id="work_no"></div>
											<div class="row">
											</div>
											<div class="row smclearrow"></div> 
											<div class="row">
												<div class="div12" align="center">
												<input type="submit" class="backbutton" name="btn_update" id="btn_update" value=" GET WORK " />									
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
$(document).ready(function() {
	$("#sel_name_of_works").chosen();

	$("body").on("change", "#sel_name_of_works", function(event){
		var selectedOption = $(this).find('option:selected'); // Find the selected option
    	var GlobId = selectedOption.data('id');console.log(GlobId);
		$("work_no").html('');
		$.ajax({
			type: 'POST', 
			url: "{{ route('admin.FindEstTsTrWONo') }}",
			data: { "_token": "{{ csrf_token() }}", 'Id': GlobId },
			success: function (data) {
				var WorkName = data['WorkName'];
				var ReferenceNo = data['ReferenceNo'];
				var TsNo = data['TsNo'];
				var TrNo = data['TrNo'];
				var WorkOrderNo = data['WorkOrderNo'];
				var DataArr = '';
				DataArr += '<div class="row smclearrow"></div>';
                DataArr += '<div class="div3 label">Work Name. <span class="reqindi">*</span></div>';
                DataArr += '<div class="div9">';
                DataArr += '<textarea type="text" readonly="" name="txt_work_name" id="txt_work_name" maxlength="50" class="tboxclass disable estchange" value="" style="width:500px">'+ WorkName +'</textarea>';
                DataArr += '</div>';
                DataArr += '<div class="row smclearrow"></div>';
				if (TsNo != null && TrNo != null && WorkOrderNo != null) {
                	DataArr += '<div class="row smclearrow"></div>';
                	DataArr += '<div class="div3 label">Work Order No. <span class="reqindi">*</span></div>';
                	DataArr += '<div class="div9">';
                	DataArr += '<input type="text" readonly="" name="txt_work_order_no" id="txt_work_order_no" maxlength="50" class="tboxclass disable estchange" value="'+ WorkOrderNo +'" style="width:500px">';
                	DataArr += '</div>';
                	DataArr += '<div class="row smclearrow"></div>';
				}
				else if (TsNo != null && TrNo != null && WorkOrderNo == null) {
                	DataArr += '<div class="row smclearrow"></div>';
                	DataArr += '<div class="div3 label">Tender No. <span class="reqindi">*</span></div>';
                	DataArr += '<div class="div9">';
                	DataArr += '<input type="text" readonly="" name="txt_tr_no" id="txt_tr_no" maxlength="50" class="tboxclass disable estchange" value="'+ TrNo +'" style="width:500px">';
                	DataArr += '</div>';
                	DataArr += '<div class="row smclearrow"></div>';
				}
				else if (TsNo != null && TrNo == null && WorkOrderNo == null) {
                	DataArr += '<div class="row smclearrow"></div>';
                	DataArr += '<div class="div3 label">Technical Sanction No. <span class="reqindi">*</span></div>';
                	DataArr += '<div class="div9">';
                	DataArr += '<input type="text" readonly="" name="txt_ts_no" id="txt_ts_no" maxlength="50" class="tboxclass disable estchange" value="'+ TsNo +'" style="width:500px">';
                	DataArr += '</div>';
                	DataArr += '<div class="row smclearrow"></div>';
				}
				else{
					RefNoLen = ReferenceNo.length;
					if(RefNoLen >= 60){
						DataArr += '<div class="row smclearrow"></div>';
                		DataArr += '<div class="div3 label">Reference No. <span class="reqindi">*</span></div>';
                		DataArr += '<div class="div9">';
                		DataArr += '<textarea type="text" readonly="" name="txt_ref_no" id="txt_ref_no" maxlength="50" class="tboxclass disable estchange" value="" style="width:500px">'+ ReferenceNo +'</textarea>';
                		DataArr += '</div>';
                		DataArr += '<div class="row smclearrow"></div>';
					}
					else{
						DataArr += '<div class="row smclearrow"></div>';
                		DataArr += '<div class="div3 label">Reference No. <span class="reqindi">*</span></div>';
                		DataArr += '<div class="div9">';
                		DataArr += '<input type="text" readonly="" name="txt_ref_no" id="txt_ref_no" maxlength="50" class="tboxclass disable estchange" value="'+ ReferenceNo +'" style="width:500px">';
                		DataArr += '</div>';
                		DataArr += '<div class="row smclearrow"></div>';
					}
				}
				$('#work_no').html(DataArr);
			}
		});
	});

	$("body").on("click","#btn_update", function(event){
		var WorkName = $('#sel_name_of_works').val();
		if(WorkName == ""){
			BootstrapDialog.alert("Please select the Name of Work!");
			event.preventDefault();
			event.returnValue = false;
		}
	});
});



</script>

@endsection