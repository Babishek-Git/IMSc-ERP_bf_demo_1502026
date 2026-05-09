@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

@php
 if(isset($data['BankBranchData'])){
	
	$BankBranchData = $data['BankBranchData'];
	$BankName = collect($BankBranchData)->pluck('bank_id')->first();
	$IFFCCode = collect($BankBranchData)->pluck('ifsc_code')->first();
	$BranchAddr = collect($BankBranchData)->pluck('branch_addr1')->first();
	$StateId = collect($BankBranchData)->pluck('state_id')->first();
	$CityName = collect($BankBranchData)->pluck('branch_city')->first();
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
							<div class="row plr">
								<!-- <div class="div2">&nbsp;</div> -->
								<div class="div5 mbtable">
									<!-- <div class="form-box"> -->
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Ledger Creation</div></div></div>
										<div class="card-body padding-1 ChartCard" id="CourseChart">
											<div class="divrowbox innerdiv pt-2">
												
												<div class="div5 label">Ledger Account Name<span class="reqindi"> *</span></div>											
												<div class="div7"><input type="text" name="txt_led_acc_name" id="txt_led_acc_name"  class="tboxsmclass" value=""></div>																																																					
												<div class="div4 label hide">Parent Category<span class="reqindi">*</span></div>
												<div class="div8 hide">
													<select name="txt_para_cate" id="txt_para_cate" class="tboxsmclass ChosenInput">
													<option value="">-------- Select------</option>
														@if(isset($data['LeafNode']))
															@foreach($data['LeafNode'] as $LeafNode)
																<option value="{{$LeafNode->ledger_group_id}}" selected>{{$LeafNode->ledger_group_name}}</option>
															@endforeach
														@endif
													</select>
												</div>
												<div class="div4 label hide">Opening Balance<span class="reqindi"> *</span></div>											
												<div class="div8 hide"><input type="text" name="txt_open_bal" id="txt_open_bal"  class="tboxsmclass" value="0"></div>
												<div class="div5 label">Debit / Credit / Deduction<span class="reqindi">*</span></div>
												<div class="div2 lboxlabel"><input type="radio"name="rad_deb_crd" id="rad_debt" value="Debit">  &emsp; Debit</div>
											    <div class="div2 lboxlabel"><input type="radio" name="rad_deb_crd"  id="rad_crd" value="Credit"> &emsp; Credit</div>
												<div class="div2 lboxlabel"><input type="radio" name="rad_deb_crd"  id="rad_ded" value="Deduction"> &emsp; Deduction</div>
												<!-- <div class="row smclearrow"></div> 
												<div class="div4 label">As of Date <span class="reqindi"> *</span></div>
											    <div class="div8"><input type="text" name="txt_as_of_date" id="txt_as_of_date" class="tboxsmclass datepicker" value=""></div> -->
												<!-- <div class="div4 label">Associated Tax<span class="reqindi"> *</span></div>
												<div class="div8">
													<select name="txt_assoc_tax" id="txt_assoc_tax" class="tboxsmclass ChosenInput">
														<option value="">-------- Select------</option>
														<option value="NONE">None</option>
														@if(isset($data['TaxRate']))
															@foreach($data['TaxRate'] as $TaxRate)
																<option value="{{$TaxRate->tax_id}}">{{$TaxRate->tax_name}} {{$TaxRate->tax_prate}}%</option>
															@endforeach
														@endif
													</select>
												</div> -->
												<div class="row smclearrow"></div> 
												@php $AddUrl = 'bank.ViewBankBranchList'; @endphp
												<div class="row">
													<div class="div12" align="center">
													<!-- <input type="button" class="backbutton" name="btn_view" id="btn_view" value=" View " onClick="window.location='{{route($AddUrl)}}'" /> -->
													<button type="submit" class="step-btn" name="btn_save" id="btn_save" value="Save">Save</button>
													<input type="hidden" name="hid_bankbranch_id" id="csrf-hid_bankbranch_id" value="@if(isset($BankBranchId)){{$BankBranchId}}@endif" />
													<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
													</div>		
												</div>
												<div class="row smclearrow"></div>  
											</div>
										</div>
									</div>										
								<!-- </div> -->
								<div class="div7">
									<div class="table-box">
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row table-divhead" align="center">Ledger List</div></div></div>
										<div class="card-body padding-1 ChartCard" id="CourseChart">
											<div class="divrowbox innerdiv pt-2">
																		
												<div class="row smclearrow"></div>                                                                                											
												<table class="table-bordered table1" width="99%" align="center" id="dataTable">
													<thead>
														<tr class="note heading">
															<th  style="text-align:center">SNo.</th>
															<th  style="text-align:center">Ledger Creation</th>
															<!-- <th  style="text-align:center">Under Category</th>
															<th  style="text-align:center">Opening Balance</th> -->
															<th  style="text-align:center">Credit/Debit</th>
														    <!-- <th  style="text-align:center">As of Date</th>
															<th  style="text-align:center">Tax Rate</th> -->
															<th  style="text-align:center">Action</th>
														</tr>
													</thead>
													<tbody>
													@if(isset($data['Ledger']))
														@foreach($data['Ledger'] as $Ledger)
															<tr>
																<td align="center">{{ $loop->iteration }} </td>
																<td align="left">{{ $Ledger->ledger_acc_name }}</td>
																<!-- <td align="left">{{ $Ledger->ledger_group_name }}</td>
																<td align="left">{{ $Ledger->opening_balance }}</td> -->
																<td align="left">{{ $Ledger->debit_credit }}</td>
																<!-- <td align="left">{{ Helper::DisplayDateFormat($Ledger->ledger_date )}}</td>
																<td align="left">{{ $Ledger->tax_name }} {{ $Ledger->tax_prate }}&#37;</td> -->
															   
																<td><button type="button" name="btn_edit" class="btn btn-default tuploadbtn" id="btn_edit" value=" Edit" onclick="window.location='{{ route('ledger.ledger-creation',['id'=>encrypt($Ledger->ledger_id)]) }}'"> <i class='fa fa-edit'></i> Edit </button></td>

															</tr>
														@endforeach
													@endif
													</tbody>
												</table>
												
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


<script>
	$(".ChosenInput").chosen();
	$('#dataTable').DataTable({
		responsive: true,
		paging: true, 
	});

	var KillEvent = 0;
	$("body").on("click","#btn_save", function(event){
		if(KillEvent == 0){
			var LedgerName = $('#txt_led_acc_name').val();
			var CreditDebit  = $('input[name="rad_deb_crd"]:checked').length;
			if(LedgerName == ""){
				BootstrapDialog.alert("Please Enter Ledger Name!");
				event.preventDefault();
				event.returnValue = false;
			}else if(CreditDebit == 0) {
				BootstrapDialog.alert("Please select atleast one option (Credit/Debit/Deduction) to proceed");
				event.preventDefault();
				event.returnValue = false;
			}else{
				event.preventDefault();
				BootstrapDialog.confirm({
					title: 'Confirmation Message',
					message: 'Are you sure want to save ?',
					closable: false, // <-- Default value is false
					draggable: false, // <-- Default value is false
					btnCancelLabel: 'Cancel', // <-- Default value is 'Cancel',
					btnOKLabel: 'Ok', // <-- Default value is 'OK',
					callback: function(result) {
						if(result){
							KillEvent = 1;
							$("#btn_save").trigger( "click" );
						}else {
							KillEvent = 0;
						}
					}
				});
			}
		}
	});




</script>

@endsection