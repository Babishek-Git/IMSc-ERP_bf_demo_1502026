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
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Test Check Settings</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
                                    <div class="row smclearrow"></div>
										<div class="divrowbox innerdiv pt-2">
                                            <div class="row smclearrow"></div>
                                            <div class="row smclearrow"></div>
                                            <div class="formbox">
											<div class="row">
											<div class="row smclearrow"></div>
											<div class="div3 label">Division Name <span class="reqindi">*</span></div>											
											<div class="div8" align="left">
												<select id="cmb_division" name="cmb_division" class="tboxclass" required>
													<option value="">-------- Selsect --------</option>
                                                    @if(isset($data['Divisions']))
                                                        @foreach($data['Divisions'] as $key=>$value)
                                                            <option value="{{$value->office_id}}" >{{ $value->office_name }}</option>
														@endforeach
                                                    @endif				
												</select>
											</div>
											<div class="row smclearrow"></div>
											<div class="row clearrow"></div>
											<div id="RoleDatas"></div>
											<div class="row clearrow"></div>
											<div class="row">
												<div class="div12" align="center">
                                                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}"/>
												<input type="submit" class="backbutton" name="btn_save" id="btn_save" value=" Save " />									
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
<style>
	.ftable table, .ftable td{
		border:1px solid #C6CCD0;
		border-collapse:collapse;
	}
	.ftable td{
		padding:2px 4px;
	}
</style>

<script type="text/javascript" language="javascript">
$(document).ready(function () {
    $("#cmb_division").chosen();
    
    $("#cmb_division").bind("change", function(){
		let DivId = $(this).val();
		$("RoleDatas").html('');
        $.ajax({
			type: 'POST',
			url: "{{ route('ajax.FindDivisionRole') }}",
			data: { '_token': '{{ csrf_token() }}', 'DivId': DivId},
			dataType: 'json',
			success: function (data) {
				if(data != null){
					let RoleData = data['RoleName'];
					let TcData = data['TestChLimit'];
					let snorem = 1;
					let TableStr = "";
					TableStr += '<table class="div12 ftable dataTable" width="99%"><thead>';
					TableStr += '<tr><th class="lboxlabel" style="text-align:center;">S No.</th><th class="cboxlabel" style="text-align:center;">Role Name</th><th class="cboxlabel" style="text-align:center;">Test Check %</th></tr>';
					TableStr += '</thead>';
					$.each(RoleData, function(key, value){
		                TableStr += '<tbody><tr><th class="lboxlabel" style="text-align:center;background-color:white">'+snorem+'</th><th style="background-color:white">'+value+'</th>';
						let TestChId = false;
						$.each(TcData, function(keys, values){
							if(key == values.role_id){
								TestChId = true;
								TableStr += '<th style="text-align:center;background-color:white"><input type="text" name="txt_testcheckpercent[]" id="txt_testcheckpercentset" maxlength="10" class="tboxclass perclimit restrictpaste numberonly" value="'+values.test_check_perc+'" style="width:80px"><input type="hidden" name="hid_roleid[]" id="hid_roleid" value="'+values.tclid+'"><input type="hidden" name="hid_role_id[]" id="hid_role_id" value="'+key+'">%</th></tr></tbody>';
							}
						});
						if(TestChId == false){
							TableStr += '<th style="text-align:center;background-color:white"><input type="text" name="txt_testcheckpercent[]" id="txt_testcheckpercentset" maxlength="10" class="tboxclass perclimit restrictpaste numberonly" value="" style="width:80px"><input type="hidden" name="hid_role_id[]" id="hid_role_id" value="'+key+'">%</th></tr></tbody>';
						}
						snorem++;
                    });
					TableStr += '</table>';
					$("#RoleDatas").html(TableStr);

					// Restrict copy-paste after the table is generated
					$("input.restrictpaste").on("paste", function(e) {
                    	e.preventDefault();  // Prevent paste event
                	}).on("copy", function(e) {
                	    e.preventDefault();  // Prevent copy event
                	});
				}
			}
		});    
    });

	
	$("body").on("click","#btn_save", function(event){
		var DivName = $('#cmb_division').val();
		if(DivName == ""){
			BootstrapDialog.alert("Please select the Division Name!");
			event.preventDefault();
			event.returnValue = false;
		}
    });

	$('body').on('keypress', ".numberonly",function(evt){
		var result = $(this).val();	
		var charCode = (evt.which) ? evt.which : event.keyCode;
		var dot1 	 = result.indexOf('.');
		var dot2 	 = result.lastIndexOf('.'); 
		var val 	 = result;
		var SplitVal = val.split(".");
		var len 	 = SplitVal.length;
		var Fraction = SplitVal[1];
		if(Fraction){
			var fractLen = Fraction.length;
		}else{
			var fractLen = 0;
		}
		if(charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)){
			return false;
		}else if (charCode == 46 && (dot1 == dot2) && dot1 != -1 && dot2 != -1){
			return false;
		}else if(isNaN(SplitVal[0])){
			//Recovery = 'x';
			return false;
		}else if(isNaN(SplitVal[1]) && Number(fractLen) > 0){
			//Recovery = 'x';
			return false;
		}else if (fractLen > 1){
			return false;
		}else{
			return true;
		}
	});

	$('body').on('change', ".perclimit",function(event){
		var Result = $(this).val();
		if(Number(Result) > 100){
			BootstrapDialog.alert('Invalid Percentage');
			$(this).val('');
		}
	});



});
	



</script>
@endsection