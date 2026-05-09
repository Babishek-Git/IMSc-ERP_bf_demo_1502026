@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

@php
 	if(isset($data)){
		foreach($data as $sdata){
			$ContractorName = $sdata->name_contractor;
            $ContractorAddress = $sdata->addr_contractor;
			$PANNo = $sdata->pan_no;
			$GSTNo = $sdata->gst_no;
			$ContactNo = $sdata->contact_no;
            $AlternateNo = $sdata->contact_no_alt;
			$ContId = $sdata->contid;
		}
	}
@endphp
<!--==============================header=================================-->
<form action="{{ route('admin.savebidderentry') }}" method="post" enctype="multipart/form-data" name="form">
	 <div class="content">
		 <div class="title">Bidder's / Contractor's Details Entry</div>
		 <div class="container_12">
			<div class="grid_12">
				<blockquote class="bq1" style="overflow-y:auto">
					<input type="hidden" name="hid_sheetid" id="hid_sheetid" value="">
					<div class="div1"></div>
					<div class="div10 mbtable">
						     <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="color1">
							   <tr><td width="18%">&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
							   <tr>
								  <td>&nbsp;</td>
								  <td class="label"><label for="fname">Contractor Name</label></td> 
								  <td>
								  <input type="text" style="width:437px;" name='txt_cont_name' id='txt_cont_name' class="textboxdisplay" style="width:465px" tabindex="1"  value="@if(isset($ContractorName)){{ ($ContractorName); }}@endif"  required>
								 </td>
							  </tr>
							  <!-- <tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="val_contname" style="color:red" colspan="">&nbsp;</td></tr> -->
							  <tr>
								 <td>&nbsp;</td>
								 <td class="label"><label for="fname">Contractor Address</label></td> 
								 <td><textarea name='txt_cont_addr' style="width:437px;" id='txt_cont_addr'  class="textboxdisplay" rows="4" required style="width:465px">@if(isset($ContractorAddress)){{ $ContractorAddress; }}@endif</textarea></td>
							 </tr>
							  <!-- <tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_wname" style="color:red" colspan="">&nbsp;</td></tr> -->
							 <tr>
								 <td>&nbsp;</td>
								 <td class="label"><label for="fname">Contractor PAN No</label></td> 
								 <td>
								 <input type="text" style="width:437px;" name='txt_pan_no' id='txt_pan_no' class="textboxdisplay" size="35" required value="@if(isset($PANNo)){{ ($PANNo); }}@endif">
								 </td>
							 </tr>
							 <!-- <tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="val_contname" style="color:red" colspan="">&nbsp;</td></tr> -->
							 <tr>
								 <td>&nbsp;</td>
								 <td class="label"><label for="fname">Contractor GST No</label></td> 
								 <td>
								 <input type="text" style="width:437px;" name='txt_gst_no' id='txt_gst_no' class="textboxdisplay" size="35" required value="@if(isset($GSTNo)){{ ($GSTNo); }}@endif" >
								 </td>
							 </tr>
							 <!-- <tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="val_contname" style="color:red" colspan="">&nbsp;</td></tr> -->
							 <tr>
								 <td>&nbsp;</td>
								 <td class="label"><label for="fname">Contact No</label></td> 
								 <td>
								 <input type="text" style="width:437px;" name='txt_contactno' id='txt_contactno' class="textboxdisplay" size="35" onKeyPress="return isNumberKey(event,this)" required value="@if(isset($ContactNo)){{ ($ContactNo); }}@endif">
								 </td>
							 </tr>
							 <!-- <tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="val_contname" style="color:red" colspan="">&nbsp;</td></tr> -->
							 <tr>
								 <td>&nbsp;</td>
								 <td class="label"><label for="fname">Alternate No</label></td> 
								 <td>
								 <input type="text" style="width:437px;" name='txt_alternateno' id='txt_alternateno' class="textboxdisplay" size="35" onKeyPress="return isNumberKey(event,this)" required  value="@if(isset($AlternateNo)){{ ($AlternateNo); }}@endif"> 
								 </td>
							 </tr>
							 <tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="val_contname" style="color:red" colspan="">&nbsp;</td></tr>
							 <tr>
							   <td colspan="5" align="center">
							   <div class="label gradientbg" style="color:white" align="left">&nbsp;Contractor Bank Details</div>
									<div style="width:90%; height:auto;" align="center">
										<table width="100%" class="table1 mbtable" id="table1" align="center">
											<tr class="label" style="background-color:#EAEAEA">
												<td align="center" class="label">Account No</td>
												<td align="center">Bank Name</td>
												<td align="center">Branch Name</td>
												<td align="center">Ifsc Code</td>
												<td align="center" colspan="2">Action</td>
											</tr>
											<!-- for creation - 1st page -->
											<tr>
												<td align="center"><input type="text" class="textbox-new" name="txt_bank_accno" id="txt_bank_accno" onKeyPress="return isNumberKey(event,this)"  value="" ></td>
												<td align="center"><input type="text" class="textbox-new" name="txt_bank_name" id="txt_bank_name"  value=""></td>
												<td align="center"><input type="text" class="textbox-new" name="txt_bank_branch" id="txt_bank_branch"  value=""></td>
												<td align="center"><input type="text" class="textbox-new" name="txt_bank_ifsc" id="txt_bank_ifsc"  value=""></td>
												<td align="center">
													<input type="button"  class="backbutton" name="b_add" id="b_add" value="ADD" />
												</td>
												<!-- for upadte portion -->
											</tr>
											@if(isset($data1))
											@foreach($data1 as $BankList)
											<tr>
												<td align="center"><input type="text" class="textbox-new" name="txt_bank_accno[]" id="txt_bank_accno" onKeyPress="return isNumberKey(event,this)"  value="{{ $BankList->acc_no }}" ></td>
												<td align="center"><input type="text" class="textbox-new" name="txt_bank_name[]" id="txt_bank_name"  value="{{ $BankList->bank_name }}"></td>
												<td align="center"><input type="text" class="textbox-new" name="txt_bank_branch[]" id="txt_bank_branch"  value="{{ $BankList->branch_name }}"></td>
												<td align="center"><input type="text" class="textbox-new" name="txt_bank_ifsc[]" id="txt_bank_ifsc"  value="{{ $BankList->ifsc_code }}"></td>
												<td align="center">
													<input type="button"  class="backbutton delete" name="b_delete" id="b_delete" value="DELETE" />
													<input type="hidden" name='bkid[]' id='bkid' class="textboxdisplay"  value="{{ $BankList->bkid; }}" size="40" >
												</td>
												
											</tr>
											<tr></tr>
											@endforeach
											@endif
							             </table>
										</div>
					                    <div class="div1 "></div>
				                     </div>
									</td>
							    </tr>
						    </table>
									<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
										 @php $AddUrl = 'admin.bidderentryview'; @endphp	
										   <div class="buttonsection"> <input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/></div>
										   <div class="buttonsection"><input type="submit" name="submit" id="submit" data-type="submit" value="Save"/></div>
										   <div class="buttonsection"><input type="button" class="backbutton" name="View" id="View" value="View" onClick="window.location='{{ route($AddUrl) }}'"/></div>
										   <input type="hidden" name='contid' id='contid' class="textboxdisplay"  value="@if(isset($ContId)){{ $ContId; }}@endif" size="40" >
										   <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
										</div>
									</div>
                        </blockquote>
				  </div>
        	 </div>
        </div>
</form>
	<script>
        $(document).ready(function() {
			$('#dataTable').DataTable({
				responsive: true,
				paging: true, 
			});
			
			$("body").on("click", "#b_add", function(event) {
				var AccountNo = $("#txt_bank_accno").val();
				var BankName = $("#txt_bank_name").val();
				var BranchName = $("#txt_bank_branch").val();
				var IfscCode = $("#txt_bank_ifsc").val();
				var RowStr = '<tr><td align="center"><input type="text" class="textbox-new" name="txt_bank_accno[]" id="txt_bank_accno" value="'+AccountNo+'"></td><td align="center"><input type="text" class="textbox-new" name="txt_bank_name[]" id="txt_bank_name" value="'+BankName+'"></td><td align="center"><input type="text" class="textbox-new" name="txt_bank_branch[]" id="txt_bank_branch" value="'+BranchName+'"></td><td align="center"><input type="text" class="textbox-new" name="txt_bank_ifsc[]" id="txt_bank_ifsc" value="'+IfscCode+'"></td><td align="center"><input type="button"  class="backbutton delete" name="b_delete" id="b_delete" value="DELETE" /></td></tr>';
				if(AccountNo == ""){
					BootstrapDialog.alert("Please enter AccountNo");
					event.preventDefault();
					return false;
				}else if(BankName ==""){
					BootstrapDialog.alert("Please enter BankName");
					event.preventDefault();
					return false;
				}else if(BranchName ==""){
					BootstrapDialog.alert("Please enter BranchName");
					event.preventDefault();
					return false;
				}else if(IfscCode ==""){
					BootstrapDialog.alert("Please enter IfscCode");
					event.preventDefault();
					return false;
				}else {
					$("#table1").append(RowStr);
					$("#txt_bank_accno").val('');
					$("#txt_bank_name").val('');
					$("#txt_bank_branch").val('');
					$("#txt_bank_ifsc").val('');
				}
			});
			$("body").on("click", ".delete", function() { 	
				$(this).closest("tr").remove();
    		});
	    	$("body").on("click", "#submit", function(event) {
				var count = $('#table1 tr').length;
				if (count < 3){
					BootstrapDialog.alert("Please Add Bankdetails");
					event.preventDefault();
					return false;
				}
			});
		});
</script>
@endsection
											
