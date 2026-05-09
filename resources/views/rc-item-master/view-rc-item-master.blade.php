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
							<div class="row">
								<div class="div12">
									<div class="form-box">
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Rate Contractor Item List</div></div></div>
										<div class="card-body padding-1 ChartCard" id="CourseChart">
											<div class="divrowbox innerdiv pt-2">
												<div class="table-container">
                                                <div class="table-wrapper">
                                                    <fieldset class="fieldbox">
														<legend class="fieldbox-legend">Basic Details</legend>
														<div class="div2 label pd-l-20">With Effect From <span class="reqindi">*</span></div>
														<div class="div2"><input type="text" name="effect_from" id="effect_from" class="tboxsmclass datepicker" value="" ></div>
														<div class="div2 label pd-l-20">With Effect To <span class="reqindi">*</span></div>
														<div class="div2"><input type="text" name="effect_to" id="effect_to" class="tboxsmclass datepicker" value="" ></div>
															<div class="row smclearrow"></div>
															<div class="row smclearrow"></div>
															<div class="row smclearrow"></div>
														</div>
													</fieldset>   
                                                    {{-- Leave entry row (row 0 — the input row) --}}
                                                    <table class="formtable"  align="center" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th>SNo.</th>
                                                                <th>Item Details</th>
																<th>Unit Price &#8377;</th>
																<th>GST &#37;</th>
																<th>Total Price</br>[Including GST] &#8377;</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody> 
                                                            @if(isset($data['ItemGroupData']))
                                                            @foreach($data['ItemGroupData'] as $ItemGroupData)
                                                            <tr>
                                                                <td align="center">{{ $loop->iteration }}</td>
                                                                <td>{{ $ItemGroupData->full_heads }}
																	<input type="hidden" id ='hidden_rc_item_id_{{$ItemGroupData->rc_item_id}}' name ='hidden_rc_item_id[]' value = '{{ $ItemGroupData->rc_item_id }}'>
																</td>
																<td align="right"><input type="text" id ='txt_unit_price_{{$ItemGroupData->rc_item_id}}' name ='txt_unit_price[]' class="price tboxsmclass" value = '' align="left"></td>
																<td align="right"><input type="text" id ='txt_gst_{{$ItemGroupData->rc_item_id}}' name ='txt_gst[]' class="gst tboxsmclass" value ='' align="right"></td>
																<td align="right"><input type="text" id ='txt_total_price_{{$ItemGroupData->rc_item_id}}' name ='txt_total_price[]'class="total tboxsmclass" readonly value = '' align="right"></td>
                                                            </tr>
                                                            @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
												@php $AddUrl = 'roles.ViewRoleMaster'; @endphp										
												<div class="row">
													<div class="div12" align="center">
														<input type="button" class="backbutton " name="btn_view" id="btn_view" value=" Back " onClick="window.location='{{route($AddUrl)}}'" />
														<input type="submit" class="backbutton SaveRCRate" name="SaveDraft" id="SaveDraft" value=" Save " />									
														<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
													</div>		
												</div>
												<div class="row smclearrow"></div>  
											</div>
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
	$(document).on('input', '.price, .gst', function () {

		let row = $(this).closest('tr');

		let price = parseFloat(row.find('.price').val()) || 0;
		let gst   = parseFloat(row.find('.gst').val()) || 0;

		// GST calculation
		let gstAmount = price * gst / 100;

		// Total price
		let total = price + gstAmount;

		// set total
		row.find('.total').val(total.toFixed(2));
	});
	$(".ChosenInput").chosen();
	// var KillEvent = 0;
	// $("body").on("click","#btn_save", function(event){
	// 	if(KillEvent == 0){
	// 		var RoleName   		= $("#txt_role_name").val();
	// 		var RoleGroup 		= $("#txt_role_group").val();

	// 		if(RoleName == ""){
	// 			BootstrapDialog.alert("Role Name should not be empty..!!");
	// 			event.preventDefault();
	// 			event.returnValue = false;
	// 		}else if(RoleGroup == ""){
	// 			BootstrapDialog.alert("User Group Name should not be empty..!!");
	// 			event.preventDefault();
	// 			event.returnValue = false;
	// 		}else{
	// 			event.preventDefault();
	// 			BootstrapDialog.confirm({
	// 				title: 'Confirmation Message',
	// 				message: 'Are you sure want to save ?',
	// 				closable: false, // <-- Default value is false
	// 				draggable: false, // <-- Default value is false
	// 				btnCancelLabel: 'Cancel', // <-- Default value is 'Cancel',
	// 				btnOKLabel: 'Ok', // <-- Default value is 'OK',
	// 				callback: function(result) {
	// 					if(result){
	// 						KillEvent = 1;
	// 						$("#btn_save").trigger( "click" );
	// 					}else {
	// 						KillEvent = 0;
	// 					}
	// 				}
	// 			});
	// 		}
	// 	}
	// });
	var KillEvent = 0;
	$("body").on("click", "#SaveDraft", function(event){
		if(KillEvent == 0){
			var EffectFrom 		= $("#effect_from").val();
			var EffectTo 		= $("#effect_to").val();
			if(EffectFrom == ""){
				BootstrapDialog.alert("With Effect From should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;
			}else if(EffectTo == ""){
				BootstrapDialog.alert("With Effect To should not be empty..!!");
				event.preventDefault();
				event.returnValue = false;	
			}else{
				event.preventDefault();
				BootstrapDialog.show({
					title: 'Confirmation Message',
					message: 'Are you sure want to save ?',
					closable: false, 				// <-- Default value is false,
					draggable: false, 				// <-- Default value is false,
					buttons: [
						{
							label: 'Ok',
							cssClass: 'btn-primary',
							action: function(dialog) {
								dialog.close();
								if($('form[name="rcitemrateform"]').length > 0) {
									$('form[name="rcitemrateform"]').remove();
								}
								let RcItemIdArr = []; 
								$('input[name="hidden_rc_item_id[]"]').each(function() {
									RcItemIdArr.push($(this).val());
								});
								if(RcItemIdArr.length === 0){
									var RcItemIdStr = "";
								}else{
									var RcItemIdStr = JSON.stringify(RcItemIdArr);
								} 
								console.log(RcItemIdStr);
								
								let SaveUnitpriceArr = []; 
								$('input[name="txt_unit_price[]"]').each(function() {
									SaveUnitpriceArr.push($(this).val());
								});
								if(SaveUnitpriceArr.length === 0){
									var SaveUnitPriceStr = "";
								}else{
									var SaveUnitPriceStr = JSON.stringify(SaveUnitpriceArr);
								}

								let SaveGstPrecArr = []; 
								$('input[name="txt_gst[]"]').each(function() {
									SaveGstPrecArr.push($(this).val());
								});
								if(SaveGstPrecArr.length === 0){
									var SaveGstPrecStr = "";
								}else{
									var SaveGstPrecStr = JSON.stringify(SaveGstPrecArr);
								}

								let SaveTotalPriceArr = []; 
								$('input[name="txt_total_price[]"]').each(function() {
									SaveTotalPriceArr.push($(this).val());
								});
								if(SaveTotalPriceArr.length === 0){
									var SaveTotalPriceStr = "";
								}else{
									var SaveTotalPriceStr = JSON.stringify(SaveTotalPriceArr);
								}
								var form = document.createElement("form");
									form.method = "POST"; 
									form.action = "{{ route('rc-item-master.view-rc-item-master') }}";
									form.name = "rcitemrateform"; 
									document.body.appendChild(form); 
								var csrfToken = document.createElement("input"); 
									csrfToken.type = "hidden";
									csrfToken.name = "_token"; 
									csrfToken.value = "{{ Session::token() }}"; 
									form.appendChild(csrfToken);
								
								var FloatingPageIp1 		= document.createElement("input");
									FloatingPageIp1.type 	= "hidden";
									FloatingPageIp1.name 	= "txt_unit_price";
									FloatingPageIp1.value 	= SaveUnitPriceStr; 
									form.appendChild(FloatingPageIp1);
								var FloatingPageIp2 		= document.createElement("input");
									FloatingPageIp2.type 	= "hidden";
									FloatingPageIp2.name 	= "txt_rc_item_id";
									FloatingPageIp2.value 	= RcItemIdStr; 
									form.appendChild(FloatingPageIp2);
								var FloatingPageIp3 		= document.createElement("input");
									FloatingPageIp3.type 	= "hidden";
									FloatingPageIp3.name 	= "txt_gst_prec";
									FloatingPageIp3.value 	= SaveGstPrecStr; 
									form.appendChild(FloatingPageIp3);
								var FloatingPageIp4 		= document.createElement("input");
									FloatingPageIp4.type 	= "hidden";
									FloatingPageIp4.name 	= "txt_total_price";
									FloatingPageIp4.value 	= SaveTotalPriceStr; 
									form.appendChild(FloatingPageIp4);
								var FloatingPageIp5 		= document.createElement("input");
									FloatingPageIp5.type 	= "hidden";
									FloatingPageIp5.name 	= "tx_effect_from_date";
									FloatingPageIp5.value 	= EffectFrom; 
									form.appendChild(FloatingPageIp5);
								var FloatingPageIp6 		= document.createElement("input");
									FloatingPageIp6.type 	= "hidden";
									FloatingPageIp6.name 	= "tx_effect_to_date";
									FloatingPageIp6.value 	= EffectTo; 
									form.appendChild(FloatingPageIp6);
								var FloatingSubmitBtn 		= document.createElement("input");
									FloatingSubmitBtn.type 	= "submit";
									FloatingSubmitBtn.name 	= "btn_save";
									FloatingSubmitBtn.id 	= "btn_save";
									form.appendChild(FloatingSubmitBtn);
									KillEvent = 1;
									$("#btn_save").trigger( "click" );
							}
						},
						{
							label: 'Cancel',
							cssClass: 'btn-secondary',
							action: function(dialog) {
								dialog.close();
								KillEvent = 0;
							}
						}
					]
				});
			}

		}
	});
	// $("body").on("click", "#SaveDraft", function(event){
	// 	let RcItemIdArr = []; 
	// 	$('input[name="hidden_rc_item_id[]"]').each(function() {
	// 		RcItemIdArr.push($(this).val());
	// 	});
	// 	if(RcItemIdArr.length === 0){
	// 		var RcItemIdStr = "";
	// 	}else{
	// 		var RcItemIdStr = JSON.stringify(RcItemIdArr);
	// 	} 

	// 	let SaveUnitpriceArr = []; 
	// 	$('input[name="txt_unit_price[]"]').each(function() {
	// 		SaveUnitpriceArr.push($(this).val());
	// 	});
	// 	if(SaveUnitpriceArr.length === 0){
	// 		var SaveUnitPriceStr = "";
	// 	}else{
	// 		var SaveUnitPriceStr = JSON.stringify(SaveUnitpriceArr);
	// 	}

	// 	let SaveGstPrecArr = []; 
	// 	$('input[name="txt_gst[]"]').each(function() {
	// 		SaveGstPrecArr.push($(this).val());
	// 	});
	// 	if(SaveGstPrecArr.length === 0){
	// 		var SaveGstPrecStr = "";
	// 	}else{
	// 		var SaveGstPrecStr = JSON.stringify(SaveGstPrecArr);
	// 	}

	// 	let SaveTotalPriceArr = []; 
	// 	$('input[name="txt_total_price[]"]').each(function() {
	// 		SaveTotalPriceArr.push($(this).val());
	// 	});
	// 	if(SaveTotalPriceArr.length === 0){
	// 		var SaveTotalPriceStr = "";
	// 	}else{
	// 		var SaveTotalPriceStr = JSON.stringify(SaveTotalPriceArr);
	// 	}

	// 	let EffectFrom   = $("#effect_from").val();
	// 	let EffectTo     = $("#effect_to").val(); 
	// 	var form = document.createElement("form");
	// 		form.method = "POST"; 
	// 		form.action = "{{ route('rc-item-master.view-rc-item-master') }}";
	// 		form.name = "rcitemrateform"; 
	// 		document.body.appendChild(form); 
	// 	var csrfToken = document.createElement("input"); 
	// 		csrfToken.type = "hidden";
	// 		csrfToken.name = "_token"; 
	// 		csrfToken.value = "{{ Session::token() }}"; 
	// 		form.appendChild(csrfToken);
		
	// 	var FloatingPageIp1 		= document.createElement("input");
	// 		FloatingPageIp1.type 	= "hidden";
	// 		FloatingPageIp1.name 	= "txt_unit_price";
	// 		FloatingPageIp1.value 	= SaveUnitPriceStr; 
	// 		form.appendChild(FloatingPageIp1);
	// 	var FloatingPageIp2 		= document.createElement("input");
	// 		FloatingPageIp2.type 	= "hidden";
	// 		FloatingPageIp2.name 	= "txt_rc_item_id";
	// 		FloatingPageIp2.value 	= RcItemIdStr; 
	// 		form.appendChild(FloatingPageIp2);
	// 	var FloatingPageIp3 		= document.createElement("input");
	// 		FloatingPageIp3.type 	= "hidden";
	// 		FloatingPageIp3.name 	= "txt_gst_prec";
	// 		FloatingPageIp3.value 	= SaveGstPrecStr; 
	// 		form.appendChild(FloatingPageIp3);
	// 	var FloatingPageIp4 		= document.createElement("input");
	// 		FloatingPageIp4.type 	= "hidden";
	// 		FloatingPageIp4.name 	= "txt_total_price";
	// 		FloatingPageIp4.value 	= SaveTotalPriceStr; 
	// 		form.appendChild(FloatingPageIp4);
	// 	var FloatingPageIp5 		= document.createElement("input");
	// 		FloatingPageIp5.type 	= "hidden";
	// 		FloatingPageIp5.name 	= "tx_effect_from_date";
	// 		FloatingPageIp5.value 	= EffectFrom; 
	// 		form.appendChild(FloatingPageIp5);
	// 	var FloatingPageIp6 		= document.createElement("input");
	// 		FloatingPageIp6.type 	= "hidden";
	// 		FloatingPageIp6.name 	= "tx_effect_to_date";
	// 		FloatingPageIp6.value 	= EffectTo; 
	// 		form.appendChild(FloatingPageIp6);
	// 	var FloatingSubmitBtn 		= document.createElement("input");
	// 		FloatingSubmitBtn.type 	= "submit";
	// 		FloatingSubmitBtn.name 	= "btn_save";
	// 		FloatingSubmitBtn.id 	= "btn_save";
	// 		form.appendChild(FloatingSubmitBtn);

	// 		$("#btn_save").trigger("click");
	// });

</script>
@endsection
