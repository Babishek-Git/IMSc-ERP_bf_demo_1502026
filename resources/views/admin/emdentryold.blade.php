@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

@php
 	if(isset($data1)){
		foreach($data1 as $sdata){
			$EmdId = $sdata->emdid;
			$EmdAmt = $sdata->emd_amt;
			$SheetId = $sdata->sheetid;
			$WorkName = $sdata->work_name;
		}
	}
@endphp
 <!--==============================header=================================-->
    <form action="{{ route('admin.emdsave') }}" method="post" enctype="multipart/form-data" name="form">
            <!--==============================Content=================================-->
        <div class="content">
            <div class="title">EMD Entry</div>
                <div class="container_12">
                    <div class="grid_12">
						<!--<div align="right"><a href="AgreementEntryView.php">View</a>&nbsp;&nbsp;&nbsp;</div>-->
                        <blockquote class="bq1" style="overflow-y:auto">
							<input type="hidden" name="hid_sheetid" id="hid_sheetid" value="">
							<div class="div1"></div>
							<div class="div10 mbtable">
							<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="color1">
                                <tr><td width="18%">&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Work Short Name</td> 
                                    <td>
										<select name="cmb_work_sname" id="cmb_work_sname" class="textboxdisplay" style="width:467px;">
											<option value="">--------------- Select ---------------</option>
												@if(isset($data2))
													@foreach($data2 as $Pin)
														@php
														if((isset($SheetId))&&($SheetId == $Pin->sheetid)){
															$SelStr = 'selected="selected"';
														}else{
															$SelStr = '';
														}
														@endphp
														<option value="{{ $Pin->sheetid; }}" {{ $SelStr; }}> {{ $Pin->work_name; }} </option>
													@endforeach
													@endif
										</select>

									</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Work Name</td>
                                    <td><textarea name='txt_workname' id='txt_workname' readonly="" class="textboxdisplay" rows="6" style="width: 465px;">@if(isset($WorkName)) {{ $WorkName; }} @endif</textarea></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td class="label">EMD Amount</td>
                                    <td><input type="text" name='txt_emdamount' id='txt_emdamount'  class="textboxdisplay" value="@if(isset($EmdAmt)) {{ $EmdAmt; }} @endif" style="width: 465px;"></td>
                                </tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_workorder" style="color:red" colspan="">&nbsp;</td></tr>
								<tr>
									<td colspan="5" align="center">
										<div class="label gradientbg" style="color:white" align="center">Contractor EMD Details</div>
										<div style="width:90%; height:auto;" align="center">
											<table width="100%" class="table1" id="table1">
												<tr class="label" style="background-color:#EAEAEA">
													<td align="center" class="label">Contractor Name</td>
													<td align="center">Instrument Type</td>
													<td align="center">Instrument Number</td>
													<td align="center"> Bank Name </td>
													<td align="center">Branch Address</td>
													<td align="center">Date of Issued</td>
													<td align="center">Expiry Date</td>
													<td align="center">Action</td>
												</tr>
												<tr>
												    <td align="center">
														<select name="cmb_contractor_0" id="cmb_contractor_0" class="textbox-new" style="width:240px;">
																<option value="">---- Select ----</option>
																	@if(isset($data3))
																		@foreach($data3 as $Con)
																			@php
																			if((isset($CON))&&($CON == $Con->contid)){
																				$SelStr = 'selected="selected"';
																			}else{
																				$SelStr = '';
																			}
																			@endphp
																			<option value="{{ $Con->contid; }}" {{ $SelStr; }}> {{ $Con->name_contractor; }} </option>
																		@endforeach
																	@endif
														</select>
													</td>
													<td align="center">
														<select name="cmd_instype_0" id ="cmd_instype_0" class="textbox-new">  
															<option value="">---- Select ---- </option>
															<option value="DD">DD</option>
															<option value="PG">PG</option>
															<option value="FDR">FDR</option>
														</select>
													</td>
													<td align="center">
														<input type="text" name="instrunum_0" id ="instrunum_0" class="textbox-new" style="width:110px;">
													</td>
													<td align="center"><input type="text" class="textbox-new" style="width:100px;" name="txt_bankname_pg_0" id="txt_bankname_pg_0"></td>
													<td align="center"><input type="text" class="textbox-new" style="width:100px;" name="txt_sno_pg_0" id="txt_sno_pg_0"></td>
													<td align="center"><input type="text" placeholder="DD/MM/YYYY" class="textbox-new" style="width:100px;" name="txt_date_pg_0" id="txt_date_pg_0"></td>
													<td align="center"><input type="text" placeholder="DD/MM/YYYY" class="textbox-new" style="width:100px;" name="txt_expir_date_pg_0" id="txt_expir_date_pg_0"></td>
													<td><input type="button"  name="emp_add" id="emp_add"  value="ADD" class="fa"></td>
														<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
												</tr>
												<!-- For Update Function -->
												@if(isset($data4))
												@foreach($data4 as $BankDetails)
												<tr>
												    <td align="center">
														<select name="cmb_contractor[]" id="cmb_contractor" class="textbox-new" style="width:240px;">
																<option value="">---- Select ----</option>
																	@if(isset($data3))
																		@foreach($data3 as $Con)
																			@php
																			if((isset($BankDetails->contid))&&($BankDetails->contid == $Con->contid)){
																				$SelStr = 'selected="selected"';
																			}else{
																				$SelStr = '';
																			}
																			@endphp
																			<option value="{{ $Con->contid; }}" {{ $SelStr; }}> {{ $Con->name_contractor; }} </option>
																		@endforeach
																	@endif
														</select>
														<input type="hidden" name="cmd_contid[]" class="textbox-new" value="@if(isset($BankDetails->contid)){{ $BankDetails->contid }}@endif">
													</td>
													<td align="center">
														<select name="cmd_instype[]" id ="cmd_instype" class="textbox-new">  
																<option value="">---- Select ---- </option>
																<option value="DD" @php if((isset($BankDetails->emd_mode ))&&($BankDetails->emd_mode == 'DD')){ echo 'selected="selected"'; } @endphp>DD</option>
																<option value="PG" @php if((isset($BankDetails->emd_mode ))&&($BankDetails->emd_mode == 'PG')){ echo 'selected="selected"'; } @endphp>PG</option>
																<option value="FDR" @php if((isset($BankDetails->emd_mode ))&&($BankDetails->emd_mode == 'FDR')){ echo 'selected="selected"'; } @endphp>FDR</option>
														</select>
													</td>
													<td align="center">
														<input type="text" name="instrunum[]" id ="instrunum" value="{{ $BankDetails->emd_no }}" class="textbox-new">
													</td>
													<td align="center"><input type="text" class="textbox-new" name="txt_bankname_pg[]" id="txt_bankname_pg" value="{{ $BankDetails->emd_bank_name }}"></td>
													<td align="center"><input type="text" class="textbox-new" name="txt_sno_pg[]" id="txt_sno_pg" value="{{ $BankDetails->emd_bank_branch }}"></td>
													<td align="center"><input type="text" placeholder="DD/MM/YYYY" class="textbox-new" name="txt_date_pg[]" id="txt_date_pg" value="{{ $BankDetails->emd_dt }}"></td>
													<td align="center"><input type="text" placeholder="DD/MM/YYYY" class="textbox-new" name="txt_expir_date_pg[]" id="txt_expir_date_pg" value="{{ $BankDetails->emd_mat_dt }}"></td>
													<td><input type="button"  class="backbutton delete" name="b_delete" id="b_delete" value="DELETE" />
												</tr>
												@endforeach
												@endif
												<!-- End for Update Function -->

											</table>
											</div>
							<div class="div1"></div>
                                             	<input type="hidden" value="" name="add_set_a1" id="add_set_a1"/>
										</div>
									</td>
								</tr>
							</table>

								<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
									<div class="buttonsection">
										<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
									</div>
									<div class="buttonsection">
										<input type="submit" name="btn_save" id="btn_save" value=" Save "/>
									</div>
									@php $AddUrl ='admin.emdentryview'; @endphp
									<div class="buttonsection">
										<input type="button" class="backbutton"  name="btn_view" id="btn_view" value=" View " onclick="window.location='{{ route($AddUrl) }}'"/>
										<input type="hidden" name='emdid' id='emdid' class="textboxdisplay"  value="@if(isset($EmdId)){{ $EmdId; }}@endif" size="40" >
										<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
									</div>
								</div>
                        </blockquote>
                    </div>
                </div>
        </div>
            <!--==============================footer=================================-->         
        </form>
		<script>
  	    // $(document).ready(function() {
	    	// $('#dataTable').DataTable({
	    	// 	responsive: true,
	    	// 	paging: true, 
	    	// });
	      // });

        $(document).ready(function(){
          	$("body").on("click", "#emp_add", function(event){ 
              	var ContName 	 = $("#cmb_contractor_0 option:selected").text();
				var ContId 		 = $("#cmb_contractor_0").val();
              	var InstType 	 = $("#cmd_instype_0").val(); 
				var InstNum 	 = $("#instrunum_0").val();
				var BankName   	 = $("#txt_bankname_pg_0").val();
				var BankAddress  = $("#txt_sno_pg_0").val();
				var DateofIssue  = $("#txt_date_pg_0").val();  
				var DateofExpiry = $("#txt_expir_date_pg_0").val(); 
				var RowStr = '<tr><td><input type="hidden" name="cmd_contid[]" class="textbox-new" value="'+ContId+'"><input type="text" name="cmb_contractor[]" class="textbox-new" value="'+ContName+'"></td><td><input type="text" name="cmd_instype[]" class="textbox-new" value="'+InstType+'"></td><td><input type="text" name="instrunum[]" class="textbox-new" value="'+InstNum+'"></td><td><input type="text" name="txt_bankname_pg[]" class="textbox-new" value="'+BankName+'"></td><td><input type="text" name="txt_sno_pg[]" class="textbox-new" value="'+BankAddress+'"></td><td><input type="text" name="txt_date_pg[]" class="textbox-new" value="'+DateofIssue+'"></td><td><input type="text" name="txt_expir_date_pg[]" class="textbox-new" value="'+DateofExpiry+'"></td><td><input type="button" class="delete fa" name="emp_delete" id="emp_delete" value="DELETE"></td></tr>'; 
				if(ContId == 0){
					alert("Name should not be empty");
					return false;
				}else if(InstType == 0){
					alert("Bank Address should not be empty");
					return false;
				}else if(InstNum == 0){
					alert("Instrument Number should not be empty");
					return false;
				}else if(BankName == 0){
					alert("Bank Name should not be empty");
					return false;
				}else if(BankAddress == 0){
					alert("Bank Address should not be empty");
					return false;
				}else if(DateofIssue == 0){
					alert("Date of Issue should not be empty");
					return false;
				}else if(DateofExpiry == 0){
					alert("Date of Expiry should not be empty");
					return false;
				}else{
					$("#table1").append(RowStr);
					$("#cmb_contractor_0").val('');
					$("#cmd_instype_0").val('');
					$("#instrunum_0").val('');
					$("#txt_bankname_pg_0").val('');
					$("#txt_sno_pg_0").val('');
					$("#txt_date_pg_0").val('');
					$("#txt_expir_date_pg_0").val('');
				}
          	});
			$("body").on("click", ".delete", function() {
				$(this).closest("tr").remove();
			});
        });
		$('#cmb_work_sname').chosen();
		$('#cmb_work_sname').change(function() {
			var work = $(this).val();
			$("#txt_workorder_no").val('');
			$("#txt_workname").val('');
			$.ajax({
				type:'GET',
				url:"{{ route('posts.getwork') }}",
				data:{'work':work},
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
	</script>
	@endsection
