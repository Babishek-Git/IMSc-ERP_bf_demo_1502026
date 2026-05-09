@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
 
<script>
	function find_workname()
	{		
		
		var xmlHttp;
		var data;
		var i,j;
			
		if(window.XMLHttpRequest) // For Mozilla, Safari, ...
		{
			xmlHttp = new XMLHttpRequest();
		}
		else if(window.ActiveXObject) // For Internet Explorer
		{ 
			xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		strURL="find_workname.php?sheetid="+document.form.cmb_work_no.value;
		xmlHttp.open('POST', strURL, true);
		xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xmlHttp.onreadystatechange = function()
		{
			if (xmlHttp.readyState == 4)
			{
				data=xmlHttp.responseText
				//alert(data)
				var name=data.split("*");
				if(data=="")
				{
					alert("No Records Found");
					//document.form.workname.value='';	
				}
				else
				{	
					//document.form.workname.value		             =	name[0].trim();
					document.form.txt_workorder_no.value             =	name[2].trim();
					document.form.txt_workorder_no_supp.value        =	name[2].trim();
					document.form.txt_agment_no_supp.value           =	name[5].trim();
					document.form.txt_cc_no_supp.value               =	name[3].trim();
					document.form.txt_no_supp_agment.value           =	name[6].trim();
					document.form.txt_work_name_supp.value           =	name[7].trim();
					document.form.txt_no_short_name_supp.value       =	name[8].trim();
					document.form.txt_tech_sanction_supp.value       =	name[9].trim();
					document.form.txt_name_contractor_supp.value     =	name[10].trim();
					//document.form.txt_rebate_percent_supp.value      =	name[11].trim();
					document.form.txt_work_order_date_supp.value     =	name[12].trim();
					document.form.txt_worktype_supp.value            =	name[13].trim();
					document.form.txt_rbn_supp.value                 =	name[14].trim();
					document.form.txt_book_no1.value	=	Number(name[1]) + Number(1);
					document.form.txt_book_no.value		=	Number(name[1]) + Number(1);
					document.form.txt_bookpage_no1.value=	Number(name[2]) + Number(1);
					document.form.txt_bookpage_no.value	=	Number(name[2]) + Number(1);
					document.form.txt_rab_no1.value		=	Number(name[3]) + Number(1);
					document.form.txt_rab_no.value		=	Number(name[3]) + Number(1);
					
	
				}
			}
		}
		xmlHttp.send(strURL);	
	}
</script>

		<form action="{{ route('admin.supplementaryagreementSave') }}" method="post" name="form">
        	<div class="content">
            <div class="title">Supplementary Agreement View</div>
            <div class="container_12">
					<div class="grid_12">
						<blockquote class="bq1">
						   <div class="container">
								<div class="row ">
									<div class="div2">&nbsp;</div>
									
									<div class="div8">
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Supplementary Agreement Details</div></div></div>
										<div class="row innerdiv">
											<div class="row">
												<div class="div4">
													<label for="fname">Work Short Name</label>
												</div>
												<div class="div8">
													<select name="cmb_work_no" id="cmb_work_no" class="textboxdisplay" style="width:465px;" tabindex="7">
														<option value="">--------------- Select ---------------</option>
														@if(isset($data))
															@foreach($data as $work)
																<option value="{{ $work['sheetid'] }}">{{ $work['short_name'] }}</option>
															@endforeach
														@endif
													</select>
													<label id="val_work" style="color:#f10b0b"></label>
												</div>
											</div>
											<div class="row">
												<div class="div4">
													<label for="fname">Work Order No.</label>
												</div>
												<div class="div8">
													<input type="text" name="txt_workorder_no" id="txt_workorder_no" readonly="" rows="6" class="textboxdisplay workdetval" style="width: 465px;">
												</div>
											</div>
											<!--
											<div class="row">
												<div class="div4">
													<label for="fname">Name of Work</label>
												</div>
												<div class="div8">
													<textarea name="workname" readonly="" rows="6" class="textboxdisplay" style="width: 465px;"></textarea>
												</div>
											</div>
											
											<div class="row">
												<div class="div4">
													<label for="fname">Supplementary Work Short Name</label>
												</div>
												<div class="div8">
													<select id="workorderno_supp" name="workorderno_supp" onChange="GetSupplementaryWorkOrderDetails()" class="textboxdisplay" style="width:465px;height:22px;" tabindex="7">
                                                       <option value="">--------------- Select ---------------</option>
                                                    </select> 
													<label id="val_work_supp" style="color:#f10b0b"></label>
												</div>
											</div>
											<div class="row">
												<div class="div4">
													<label for="fname">Supplementary Work Order No.</label>
												</div>
												<div class="div8">
													<input type="text" name='txt_workorder_no_supp' id='txt_workorder_no_supp' class="textboxdisplay" value="" style="width:465px;" readonly=""/>
												</div>
											</div>
											-->
										</div>
									</div>
									<div class="div2">&nbsp;</div>
								</div>
								<div class="row ">
									<div class="div2">&nbsp;</div>
									<div class="div8">
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Supplementary Agreement Details</div></div></div>
										<div class="row innerdiv">
											<div class="row">
												<div class="div4">
													<label for="fname"> Supp.Agreement Work Order No. </label>
												</div>
												<div class="div8">
													<!--	<select name="cmb_work_no" id="cmb_work_no" onChange="find_workname();GetSupplementaryWorkOrder();" class="textboxdisplay" style="width:465px;height:22px;" tabindex="7">
														<option value="">--------------- Select ---------------</option>
													</select>
													<label id="val_work" style="color:#f10b0b"></label>	-->
													<input type="text" name="cmb_supp_work_no" id="cmb_supp_work_no" rows="6" class="textboxdisplay workdetval" style="width: 300px;">
												</div>
											</div>
											<div class="row">
												<div class="div4">
													<label for="fname">Supp.Agreement No.</label>
												</div>
												<div class="div8">
													<input type="text" name="txt_supp_aggre_no" id="txt_supp_aggre_no" rows="6" class="textboxdisplay workdetval" style="width: 300px;">
												</div>
											</div>
											<div class="row">
												<div class="div4">
													<label for="fname">CC No.</label>
												</div>
												<div class="div8">
													<input type="text" name="txt_ccno" id="txt_ccno" readonly="" rows="6" class="textboxdisplay workdetval" style="width: 300px;">
												</div>
											</div>
											<div class="row">
												<div class="div4">
													<label for="fname">No.of.Supp.Agreement</label>
												</div>
												<div class="div8">
													<input type="text" name="txt_nosof_supp_aggre" id="txt_nosof_supp_aggre" readonly="" rows="6" class="textboxdisplay workdetval" style="width: 300px;">
												</div>
											</div>
											<div class="row">
												<div class="div4">
													<label for="fname">Rebate Percentage</label>
												</div>
												<div class="div8">
													<input type="text" name="txt_rebate_perc" id="txt_rebate_perc" rows="6" class="textboxdisplay workdetval" style="width: 300px;">
												</div>
											</div>
											<input type="hidden" name="txt_work_name" id="txt_work_name" class="textboxdisplay workdetval" style="width: 300px;">
											<input type="hidden" name="txt_workshort_name" id="txt_workshort_name" class="textboxdisplay workdetval" style="width: 300px;">
											<input type="hidden" name="txt_techsanc_no" id="txt_techsanc_no" class="textboxdisplay workdetval" style="width: 300px;">
											<input type="hidden" name="txt_name_cont" id="txt_name_cont" class="textboxdisplay workdetval" style="width: 300px;">
											<input type="hidden" name="txt_workord_date" id="txt_workord_date" class="textboxdisplay workdetval" style="width: 300px;">
											<input type="hidden" name="txt_rbn" id="txt_rbn" class="textboxdisplay workdetval" style="width: 300px;">
											<input type="hidden" name="txt_worktype" id="txt_worktype" class="textboxdisplay workdetval" style="width: 300px;">

											<!--
											<div class="row">
												<div class="div4">
													<label for="fname">Name of Work</label>
												</div>
												<div class="div8">
													<textarea name="workname" readonly="" rows="6" class="textboxdisplay" style="width: 465px;"></textarea>
												</div>
											</div>
											
											<div class="row">
												<div class="div4">
													<label for="fname">Supplementary Work Short Name</label>
												</div>
												<div class="div8">
													<select id="workorderno_supp" name="workorderno_supp" onChange="GetSupplementaryWorkOrderDetails()" class="textboxdisplay" style="width:465px;height:22px;" tabindex="7">
                                                       <option value="">--------------- Select ---------------</option>
                                                    </select> 
													<label id="val_work_supp" style="color:#f10b0b"></label>
												</div>
											</div>
											<div class="row">
												<div class="div4">
													<label for="fname">Supplementary Work Order No.</label>
												</div>
												<div class="div8">
													<input type="text" name='txt_workorder_no_supp' id='txt_workorder_no_supp' class="textboxdisplay" value="" style="width:465px;" readonly=""/>
												</div>
											</div>
											-->
										</div>
									</div>
									<div class="div2">&nbsp;</div>
								</div>
						   </div>
						   <div class="div12">&nbsp;</div>
							<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
						   <div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
								<div class="buttonsection">
									<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
								</div>
								<div class="buttonsection">
									<input type="submit" data-type="submit" value=" Save " name="Save" id="Save"/>
								</div>
								<!--	<div class="buttonsection">
									<input type="button" class="backbutton" name="create" id="create" value="Create New" onClick="CreateNew();"/>
								</div>	-->
						   <div class="div12">&nbsp;</div>
						</div>
                    </blockquote>
                </div>
            </div>
        </div>
</form>
<script>
		$('#cmb_work_no').change(function() {
		var work = $(this).val();
		$(".workdetval").val('');
		$.ajax({
			type:'POST',
			url:"{{ route('ajax.GetSupplWorks') }}",
			data:{'_token': '{{ csrf_token() }}','work':work},
			success:function(data){ 
				if(data){ 	//alert(JSON.stringify(data['Sheetdata']));
					Sheetdata = data['Sheetdata'];
					SuppData = data['SuppData'];
					//alert(Shhet);
					//alert(SuppData);
					$.each(Sheetdata, function(key, value) {
						$("#txt_workorder_no").val(value.work_order_no);
						$("#cmb_supp_work_no").val(value.work_order_no);
						$("#txt_supp_aggre_no").val(value.agree_no);
						$("#txt_ccno").val(value.computer_code_no);
						$("#txt_nosof_supp_aggre").val(SuppData);
						$("#txt_rebate_perc").val(value.rebate_percent);
						$("#txt_work_name").val(value.work_name);
						$("#txt_workshort_name").val(value.short_name);
						$("#txt_techsanc_no").val(value.tech_sanction);
						$("#txt_name_cont").val(value.name_contractor);
						$("#txt_worktype").val(value.worktype);
						$("#txt_workord_date").val(value.work_order_date);
						$("#txt_rbn").val(value.rbn);
					});
				}
			}
		});
	});
</script>
@endsection

