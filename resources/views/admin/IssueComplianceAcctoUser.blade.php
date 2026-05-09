@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@php
if(isset($data['ShowWorkOrder'])){
    foreach($data['ShowWorkOrder'] as $List){
		$SheetId = $List->sheetid;
        $WorkOrderno = $List->work_order_no;
        $ReturnFor = $List->bill_returned_for;
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
								<div class="div2">&nbsp;</div>
								<div class="div8 mbtable">
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Issue or Compliance</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
                                            <div class="row smclearrow"></div>                                                                                											
											<div class="div3 label">Name of work <span class="reqindi">*</span></div>											
											<div class="div9">
											<select name="cmb_work_name" id="cmb_work_name" class="textboxdisplay" style="width:100%;height:30%">
												<option value="">--------------- Select ---------------</option>
												@if(isset ($data['ShowWorkOrder']))
													@foreach($data['ShowWorkOrder'] as $key => $value)
														<option value="{{$value->sheetid}}" data-id="{{$value->work_order_no}}">{{ $value->work_order_no }} - {{$value->work_name}}</option>
													@endforeach
												@endif
											</select>
											</div>	
                                            <div class="row smclearrow"></div>                                                                                											
											<div class="div3 label">Work Name. <span class="reqindi">*</span></div>											
											<div class="div9">
                                                <textarea name="workorder_no" id="workorder_no" maxlength="50" class="tboxclass disable" readonly="" value="@if(isset($WorkOrderNo)){{ $WorkOrderno }}@endif"></textarea>
                                            </div>
                                            <div class="row">
												<div class="div3 lboxlabel">
													Issue / Compliance <span class="reqindi">*</span>&nbsp;
												</div>
												<div class="div6" align="left">
													<input type="radio" name="rad_issue_or_compliance" id="rad_issue" value="ISSUE"> <span class="lboxlabel">Issue</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													<input type="radio" name="rad_issue_or_compliance" id="rad_compliance" value="COMPL"> <span class="lboxlabel">Compliance</span> &nbsp;&nbsp;&nbsp;
												</div>
											</div>
											<input type="hidden" name = "hid_iscompliacc_id" id = "hid_iscompliacc_id" value = "">
											<input type="hidden" name = "current_rbn" id = "current_rbn" value = "">
											<div class="row smclearrow"></div>  
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


<script>
    $(document).ready(function(){ 
        $('#cmb_work_name').chosen();
        $('#cmb_work_name').change(function() {
        	var WorkName = $('#cmb_work_name option:selected').text();
            var Id = $("#cmb_work_name").val();
			$("#workorder_no").val(WorkName);
			$("#hid_iscompliacc_id").val(Id);
            $.ajax({  
		    	type: 'POST', 
		    	url: "{{ route('ajax.FindBillRegister') }}",
		    	data: { '_token': '{{ csrf_token() }}', 'Id': Id}, 
		    	success: function (data) { 
					var WorkOrderNo = '';
					var IssueOrCompliance = '';
					var Rbn = '';
					if(data != null){
						WorkOrderNo = data['WORKORDERNO'];
						IssueOrCompliance = data['COMPLIORISSUE'];
						CurrentRbn = data['Rbn'];
						if(IssueOrCompliance == "COMPL"){
							$("#rad_compliance").prop('checked', true);
						}
						else if(IssueOrCompliance == "ISSUE"){
							$("#rad_issue").prop('checked', true);
						}
						$("#current_rbn").val(CurrentRbn);
					}
                }
            });
        }); 
        $('body').on('keypress', ".textonly", function(evt){
            var charCode = (evt.which) ? evt.which : event.keyCode;
            if (!(charCode >= 65 && charCode <= 90) &&   
                !(charCode >= 97 && charCode <= 122) && 
                charCode !== 32) {                     
                return false;
            } else {
                return true;
            }
        });
		var KillSaveEvent = 0;
		$("body").on("click","#btn_save", function(event){
			if(KillSaveEvent == 0){
				var WorkName = $('#cmb_work_name').val();
				var msg = "";
				var selectedValue = $("input[name='rad_issue_or_compliance']:checked").val();
				var msg = "";
				if (selectedValue === "ISSUE") {
				    msg = "Issue";
				} else if (selectedValue === "COMPL") {
				    msg = "Compliance";
				}
				if(WorkName == ""){
					BootstrapDialog.alert("Please select the name of work..!");
					event.preventDefault();
					event.returnValue = false;
				}
				else{
					event.preventDefault();
					BootstrapDialog.confirm({
						title: 'Confirmation Message',
						message: 'Are you sure want to update '+msg+'?',
						closable: false, // <-- Default value is false
						draggable: false, // <-- Default value is false
						btnCancelLabel: 'Cancel', // <-- Default value is 'Cancel',
						btnOKLabel: 'Ok', // <-- Default value is 'OK',
						callback: function(result) {
							if(result){
								KillSaveEvent = 1;
								$("#btn_save").trigger( "click" );
							}else {
								KillSaveEvent = 0;
							}
						}
					});
				}
			}
			
		});

    });


</script>

@endsection
