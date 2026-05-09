@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
	<form action="{{route('admin.ItemUnitUpdateMaster')}}" method="post" name="form">
		<div class="content">
			<div class="title"></div>
			<div class="container_12">
				<div class="grid_12">
					<blockquote class="bq1" style="overflow:auto">
						<div class="container">
							<div class="row ">
								<div class="div2">&nbsp;</div>
								<div class="div8 mbtable">
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Work Item Unit Update</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
																	
											<div class="row smclearrow"></div>                                                                                											
											<div class="div3 label">Work Name <span class="reqindi">*</span></div>											
											<div class="div9">
											<select name="cmb_work_name" id="cmb_work_name" class="textboxdisplay cmb_work_name" style="width:90%;height:30px">
												<option value="">--------------- Select ---------------</option>
                                                @if(isset($data['WorkData']))
                                                    @foreach($data['WorkData'] as $Key=>$value)
														@if($value->ts_no != NULL && $value->tr_no != NULL && $value->work_order_no != NULL)
												        	<option value="{{$value->works_globid}}" data-sheet="{{encrypt($value->sheetid)}}">{{$value->work_order_no}} - {{$value->short_name}}</option>
														@elseif($value->ts_no != NULL && $value->tr_no != NULL && $value->work_order_no == NULL)											                                                   
															<option value="{{$value->works_globid}}" data-tr="{{encrypt($value->tr_id)}}">{{$value->tr_no}} - {{$value->tr_work_name}}</option>
														@elseif($value->ts_no != NULL && $value->tr_no == NULL && $value->work_order_no == NULL)
															<option value="{{$value->works_globid}}" data-ts="{{encrypt($value->ts_id)}}">{{$value->ts_no}} - {{$value->ts_work_name}}</option>											                                                   
														@elseif($value->ts_no == NULL && $value->tr_no == NULL && $value->work_order_no == NULL)
															<option value="{{$value->works_globid}}">{{$value->ref_no}} - {{$value->work_name}}</option>	
														@endif									                                                   
													@endforeach
                                                @endif
											</select>
											</div>
											
											<div class="div3 label">Work No. <span class="reqindi">*</span> </div>											
											<div class="div9"><textarea maxlength="11" name="txt_work_no" id="txt_work_no" maxlength="50" class="tboxclass alphanumeric" value="" style="width:90%"></textarea></div>

											<div class="div3 label">Item No. <span class="reqindi">*</span></div>											
											<div class="div9">
											<select name="cmb_item_no" id="cmb_item_no" class="textboxdisplay" style="width:350px;height:30px">
												<option>--------------- Select ---------------</option>
											</select>
											</div>
                                            <input type="hidden" name="hid_sheetid" id="hid_sheetid" value=""/>																														
											<input type="hidden" name="work_partb_id" id="work_partb_id" value=""/>																														
											<input type="hidden" name="work_partab_id" id="work_partab_id" value=""/>																														
											<input type="hidden" name="item_no" id="item_no" value=""/>																														
											<div class="row smclearrow"></div>
											<div class="row">
												<div class="div12" align="center">
												<input type="submit" class="backbutton" name="btn_next" id="btn_next" value=" Next "/>								
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
		$("#cmb_item_no").chosen();
		$("#cmb_work_name").chosen();

	});
    $("body").on("change", ".cmb_work_name", function(event){ // Find the selected option
		var selectedOption = $(this).find("option:selected");
    	var GlobId = $(selectedOption).val();
        var selt = [];
		var SheetId = selectedOption.data('sheet');
		$("#hid_sheetid").val(SheetId);
		var WorkName = selectedOption.text();
		$("#txt_work_no").val(WorkName);		
        $("#cmb_item_no").chosen("destroy");
        $("#cmb_item_no").find('option:not(:first)').remove();
		$.ajax({
			type: 'POST', 
			url: "{{ route('ajax.FindEstTsTrName') }}",
			data: { "_token": "{{ csrf_token() }}", 'Id': GlobId, 'Page':"EST" },
			success: function (data) {
                if(data != null){
                    var EstDetails = data['estdetails'];
					$.each(EstDetails, function(key, value) {
					    selt += '<option value="' + value.partabdetid + '" data-itemno = "'+ value.est_item_no +'" data-mastid = "'+value.mastid+'">' + value.est_item_no + '</option>';
					});
                    $("#cmb_item_no").append(selt);
                }
                $("#cmb_item_no").chosen();
			}
		});
	});

	$("body").on("change", "#cmb_item_no", function(event){ 
		var selectedOption = $('#cmb_item_no option:selected');
    	var PartABDetId = selectedOption.val();
		var PartABMastId = selectedOption.data('mastid');
		var PartAItemNo = selectedOption.data('itemno');
		$("#work_partb_id").val(PartABDetId);
		$("#work_partab_id").val(PartABMastId);
		$("#item_no").val(PartAItemNo);
	});

    $("body").on("click","#btn_next", function(event){
    	var WorkName = $('#cmb_work_name').val();
    	var ItemNo = $('#cmb_item_no').val();
    	if(WorkName == ""){
    		BootstrapDialog.alert("Please select the Name of Work..!");
    		event.preventDefault();
    		event.returnValue = false;
    	}else if(ItemNo == "--------------- Select ---------------"){
    		BootstrapDialog.alert("Please select the Item No..!");
    		event.preventDefault();
    		event.returnValue = false;
    	}
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
    $('body').on('keypress', ".alphanumeric", function(evt){
        var charCode = (evt.which) ? evt.which : event.keyCode;
        if (!((charCode >= 48 && charCode <= 57) ||   
              (charCode >= 65 && charCode <= 90) ||   
              (charCode >= 97 && charCode <= 122))) {  
            return false;
        } else {
            return true;
        }
    });




</script>

@endsection