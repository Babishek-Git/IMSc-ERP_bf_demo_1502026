@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

<div class="content">
	<div class="title"></div>
	<div class="container_12">
		<div class="grid_12">
			<blockquote class="bq1" style="overflow:auto"> 
				<div align="right"><a href="AgreementMBookAllotmentEdit.php?edit=new">Over All View</a></div>
				<form name="form" method="post" action="{{ route('admin.saveagreementmbookallotment') }}">
					<div class="container">
						<div class="row ">
							<div class="div2">&nbsp;</div>
							<div class="div8 mbtable">
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Work - Wise General / Steel / Abstract / Escalation MBook Allotment</div></div></div>
								<div class="row innerdiv">
									<div class="row">
										<div class="div4">
											<label for="fname">Work Short Name</label>
										</div>
										<div class="div8">
											<select id="workorderno" name="workorderno" style="width:80%;" class="tboxclass">
											<option value="">------------- Select Work Short Name --------------</option>
												@if(isset($data1))
													@foreach($data1 as $Pin)
														@php
														if((isset($WorkId))&&($WorkId== $Pin->sheetid)){
															$SelStr = 'selected="selected"';
														}else{
															$SelStr = '';
														}
														@endphp
											<option value="{{ $Pin->sheetid }}" {{ $SelStr }}> {{ $Pin->short_name }} </option>
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
											<input type="text" name='txt_workorder_no' id='txt_workorder_no' style="width:80%;" class="tboxclass" readonly="" value="">
										</div>
									</div>
									<div class="row">
										<div class="div4">
											<label for="fname">Name of Work</label>
										</div>
										<div class="div8">
											<textarea name='txt_workname' id='txt_workname' style="width:80%;" class="tboxclass" readonly="" rows="2"></textarea>
										</div>
									</div>
									
									<div class="row">
										<div class="div3" align="center">
											<div class="innerdiv2">
												<div class="row divhead" align="center">General</div>
												<div class="row innerdiv" align="center">
													<div class="boxdiv1 label boxtitle" align="left">
														<input type="radio" name="radbookGen" id="GENS" value="S" data-type="GEN" class="RAD" onClick="func_book();" data-index="1"/>
														Sequential
													</div>
													<div class="boxdiv1 label one-mar-top hide GEN" align="left" id="GENSROW">
														<div class="row">
															<div class="div6 no-mar-top boxlabel">&nbsp;Start No.</div>
															<div class="div6 no-mar-top">
																<input type="text" name="mbokstartGen" class="tboxsmclass mbno start1 GENS" id="mbokstartGen" value="" onBlur="findbookno()" onKeyPress=" return isNumber(event);"/>
															</div>
														</div>
														<div class="row">
															<div class="div6 boxlabel">&nbsp;End No.</div>
															<div class="div6">
																<input type="text" name="mbokendGen" class="tboxsmclass mbno end1 GENS" id="mbokendGen" value="" onBlur="findbookno()" onKeyPress=" return isNumber(event);"/>
															</div>
														</div>
													</div>
													<div class="boxdiv1 label boxtitle" align="left">
														<input type="radio" name="radbookGen" id="GENNS" value="NS" data-type="GEN" class="RAD" onClick="func_book();" data-index="1"/>
														Non-Sequential
													</div>
													<div class="boxdiv1 one-mar-top hide GEN" align="left" id="GENNSROW">
														<div class="row" id="GENNSADD">
															<div class="div10 no-mar-top">
																<input type="text" name="mbokGen[]" id="MBNO1" class="tboxsmclass mbno GENNS" onKeyPress="return isNumber(event);">
															</div>
															<div class="div2 no-mar-top" align="center">
																<i class="fa fa-plus-circle add" data-id="GENNS" data-type="mbokGen" style="font-size:25px; color:#109A60; cursor:pointer"></i>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="div3" align="center">
											<div class="innerdiv2">
												<div class="row divhead" align="center">Steel</div>
												<div class="row innerdiv" align="center">
													<div class="boxdiv1 label boxtitle" align="left">
														<input type="radio" name="radbookStl" id="STLS" value="S" data-type="STL" class="RAD" onClick="func_book();" data-index="2"/>
														Sequential
													</div>
													<div class="boxdiv1 label one-mar-top hide STL" align="left" id="STLSROW">
														<div class="row">
															<div class="div6 no-mar-top boxlabel">&nbsp;Start No.</div>
															<div class="div6 no-mar-top">
																<input type="text" name="mbokstartStl" class="tboxsmclass mbno start2 STLS" id="mbokstartStl" value="" onBlur="findbookno()" onKeyPress=" return isNumber(event);"/>
															</div>
														</div>
														<div class="row">
															<div class="div6 boxlabel">&nbsp;End No.</div>
															<div class="div6">
																<input type="text" name="mbokendStl" class="tboxsmclass mbno end2 STLS" id="mbokendStl" value="" onBlur="findbookno()" onKeyPress=" return isNumber(event);"/>
															</div>
														</div>
													</div>
													<div class="boxdiv1 label boxtitle" align="left">
														<input type="radio" name="radbookStl" id="STLNS" value="NS" data-type="STL" class="RAD" onClick="func_book();" data-index="2"/>
														Non-Sequential
													</div>
													<div class="boxdiv1 one-mar-top hide STL" align="left" id="STLNSROW">
														<div class="row" id="STLNSADD">
															<div class="div10 no-mar-top">
																<input type="text" name="mbokStl[]" id="MBNO2" class="tboxsmclass mbno STLNS" onKeyPress=" return isNumber(event);">
															</div>
															<div class="div2 no-mar-top" align="center">
																<i class="fa fa-plus-circle add" data-id="STLNS" data-type="mbokStl" style="font-size:25px; color:#109A60; cursor:pointer"></i>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="div3" align="center">
											<div class="innerdiv2">
												<div class="row divhead" align="center">Abstract</div>
												<div class="row innerdiv" align="center">
													<div class="boxdiv1 label boxtitle" align="left">
														<input type="radio" name="radbookAbs" id="ABSS" value="S" data-type="ABS" class="RAD" onClick="func_book();" data-index="3"/>
														Sequential
													</div>
													<div class="boxdiv1 label one-mar-top hide ABS" align="left" id="ABSSROW">
														<div class="row">
															<div class="div6 no-mar-top boxlabel">&nbsp;Start No.</div>
															<div class="div6 no-mar-top">
																<input type="text" name="mbokstartAbs" class="tboxsmclass mbno start3 ABSS" id="mbokstartAbs" value="" onBlur="findbookno()" onKeyPress="return isNumber(event);"/>
															</div>
														</div>
														<div class="row">
															<div class="div6 boxlabel">&nbsp;End No.</div>
															<div class="div6">
																<input type="text" name="mbokendAbs" class="tboxsmclass mbno end3 ABSS" id="mbokendAbs" value="" onBlur="findbookno()" onKeyPress="return isNumber(event);"/>
															</div>
														</div>
													</div>
													<div class="boxdiv1 label boxtitle" align="left">
														<input type="radio" name="radbookAbs" id="ABSNS" value="NS" data-type="ABS" class="RAD" onClick="func_book();" data-index="3"/>
														Non-Sequential
													</div>
													<div class="boxdiv1 one-mar-top hide ABS" align="left" id="ABSNSROW">
														<div class="row" id="ABSNSADD">
															<div class="div10 no-mar-top">
																<input type="text" name="mbokAbs[]" id="MBNO3" class="tboxsmclass mbno ABSNS" onKeyPress=" return isNumber(event);">
															</div>
															<div class="div2 no-mar-top" align="center">
																<i class="fa fa-plus-circle add" data-id="ABSNS" data-type="mbokAbs" style="font-size:25px; color:#109A60; cursor:pointer"></i>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="div3" align="center">
											<div class="innerdiv2">
												<div class="row divhead" align="center">Escalation</div>
												<div class="row innerdiv" align="center">
													<div class="boxdiv1 label boxtitle" align="left">
														<input type="radio" name="radbookEsc" id="ESCS" value="S" data-type="ESC" class="RAD" onClick="func_book();" data-index="4"/>
														Sequential
													</div>
													<div class="boxdiv1 label one-mar-top hide ESC" align="left" id="ESCSROW">
														<div class="row">
															<div class="div6 no-mar-top boxlabel">&nbsp;Start No.</div>
															<div class="div6 no-mar-top">
																<input type="text" name="mbokstartEsc" class="tboxsmclass mbno start4 ESCS" id="mbokstartEsc" value="" onBlur="findbookno()" onKeyPress="return isNumber(event);"/>
															</div>
														</div>
														<div class="row">
															<div class="div6 boxlabel">&nbsp;End No.</div>
															<div class="div6">
																<input type="text" name="mbokendEsc" class="tboxsmclass mbno end4 ESCS" id="mbokendEsc" value="" onBlur="findbookno()" onKeyPress="return isNumber(event);"/>
															</div>
														</div>
													</div>
													<div class="boxdiv1 label boxtitle" align="left">
														<input type="radio" name="radbookEsc" id="ESCNS" value="NS" data-type="ESC" class="RAD" onClick="func_book();" data-index="4"/>
														Non-Sequential
													</div>
													<div class="boxdiv1 one-mar-top hide ESC" align="left" id="ESCNSROW">
														<div class="row" id="ESCNSADD">
															<div class="div10 no-mar-top">
																<input type="text" name="mbokEsc[]" id="MBNO4" class="tboxsmclass mbno ESCNS" onKeyPress=" return isNumber(event);">
															</div>
															<div class="div2 no-mar-top" align="center">
																<i class="fa fa-plus-circle add" data-id="ESCNS" data-type="mbokEsc" style="font-size:25px; color:#109A60; cursor:pointer"></i>
															</div>
														</div>
													</div>
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
						<div class="div12" align="center">
							@php $AddUrl = 'admin.agreementmbookallotmentedit'; @endphp
							<!-- <input type="button" class="backbutton" name="btn_view" id="btn_view" value="View"  onclick="window.location='{{ route($AddUrl) }}'"/> -->
							<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
							<input type="submit" data-type="submit" value=" Submit " name="Submit" id="Submit" onClick="return validation()"/>
							<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
						</div>
					</div>
				</form>
			</blockquote>
		</div>
	</div>
</div>
<script>
	$('#workorderno').chosen();
	$('#workorderno').change(function() {
		var work = $(this).val();
		$("#txt_workorder_no").val('');
		$("#txt_workname").val('');
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
	// $("#GENS").click(function(){
	// 	// show the table as soon as the DOM is ready
	// 	$("#GENSROW").show();
	// 	// shows the table on clicking the noted link
	// 	$("#GENS").click(function() {
	// 	$("#GENSROW").show("slow");
	// 	});
	// 	// hides the table on clicking the noted link
	// 	$("#GENNS").click(function() {
	// 	$("#id_GENSROWdata").hide("fast");
	// 	});
	// });
	$(".RAD").click(function(event){
		var value = $(this).val();
		var id = $(this).attr('id');
		var type = $(this).attr('data-type');
		if(value == 'S'){
			$("."+type+"NS").val(''); //input type is concatinate with value
		}
		if(value == 'NS'){
			$("."+type+"S").val('');
		}
		$("."+type).removeClass("hide");
		$("."+type).addClass("hide");
			//alert("#"+id+value+"ROW");
		$("#"+id+"ROW").removeClass("hide");
		
	});
	var max_fields      = 10; //maximum input boxes allowed
	var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
	var add_button      = $(".add"); //Add button ID
	var del_button      = $(".delete");
	
	var x = 5; //initlal text box count
	$(add_button).click(function(e){ //on add input button click
		var appendrow = $(this).attr("data-id");
		var type = $(this).attr("data-type");
		e.preventDefault();
		//if(x < max_fields){ //max input box allowed
				//text box increment
			$('#'+appendrow+"ADD").append('<div class="row"><div class="div10"><input type="text" name="'+type+'[]" id="MBNO'+x+'" class="tboxsmclass mbno '+appendrow+'" onKeyPress="return isNumber(event);"></div><div class="div2" align="center"><i class="fa fa-times-circle delete" style="font-size:25px; color:red; cursor:pointer"></i></div></div>'); //add input box
			x++;
		//}
	});
	$('body').on("click",".delete", function(e){ //user click on remove text
		e.preventDefault(); 
		$(this).closest('.row').remove(); x--;
	});
	function StartEndMBNo(){
		var i = 1; var j = 4; //alert()
		for(var x = i; x<=j; x++){
			var Start = $('.start'+x).val();
			var End   = $('.end'+x).val();
			//alert();
			if(Start != '' && End != ''){
				if(Number(Start)>Number(End)){
					var AlertMsg = "Start MBook No. should be greater than End Mbook No.";
					BootstrapDialog.alert(AlertMsg);
					exit();
				}
			}
		}
	}
	$('body').on("change",".mbno", function(){ 
		var mbno = $(this).val();
		var id = $(this).attr("id"); 
		$.ajax({ 
			type: 'GET', 
			url: "{{ route('ajax.GetMBookAllotment') }}", 
			data: { mbno: mbno }, 
			success: function (data) {  
				if(data == 1){
					var AlertMsg = "MBook No. "+mbno+ " already alloted. Please try different MBook No. ";
					BootstrapDialog.alert(AlertMsg);
					$("#"+id).val('');
				}
			}
		});
	});
	function CurrentMBValidation(){
		var arr = [];
		$(".mbno").each(function(){
			var value = $(this).val();
			if(value != ''){
				if (arr.indexOf(value) == -1){
					arr.push(value);
				}else{
					var AlertMsg = "MBook No. "+value+ " already alloted in current process. Please try different MBook No. ";
					BootstrapDialog.alert(AlertMsg);
					$(this).val('');
					exit();
				}
			}
		});
	}
		
</script>
@endsection
