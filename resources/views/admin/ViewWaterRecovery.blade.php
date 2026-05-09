
@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
<!-- $staffid = $_SESSION['sid'];
$userid = $_SESSION['userid']; -->

<SCRIPT type="text/javascript">
	window.history.forward();
	function noBack() { window.history.forward(); }
</SCRIPT>
<body class="page1" id="top">
	<form name="form" method="get" action="{{ route('admin.ViewWaterRecoveryList') }}">
		<div class="content">
			<div class="title"></div>
			<div class="container_12">
				<div class="grid_12">
					<blockquote class="bq1" style="overflow:auto">
						<div class="container">
							<div class="row ">
								<div class="div2">&nbsp;</div>
								<div class="div8 mbtable">
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center"> View Water Recovery </div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
											<table width="100%"  bgcolor="#E8E8E8" border="0" cellpadding="0" cellspacing="0" align="center" >
												<tr><td width="22%">&nbsp;</td></tr>
												<tr>
													<td>&nbsp;</td> 
													<td  class="label">Work Short Name</td>
													<td  class="labeldisplay">
														<select name="cmb_shortname" id="cmb_shortname"  class="textboxdisplay" style="width:400px;height:22px;" tabindex="7">
															<option value="">---------------------- Select ----------------------</option>
															@foreach($data1 as $work)
																<option value="{{ $work['sheetid'] }}">{{ $work['short_name'] }}</option>
															@endforeach
														</select>
													</td>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
												</tr>
												<tr><td>&nbsp;</td><td></td><td id="val_work" style="color:red"></td></tr>
												<tr>
													<td>&nbsp;</td>
													<td  class="label">Work Order No.</td>
													<td  class="labeldisplay">
													<input type="text" name="txt_workorder_no" id="txt_workorder_no" class="textboxdisplay" style="width:397px;" disabled="disabled">
													</td>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
												</tr>
												<tr><td>&nbsp;</td><td></td><td id="val_workorder" style="color:red"></td></tr>
												<tr>
													<td>&nbsp;</td>
													<td  class="label">Name of the Work </td>
													<td  class="labeldisplay">
													<textarea name="workname" id="workname" class="textboxdisplay txtarea_style" style="width: 400px;" rows="5" disabled="disabled"></textarea>
													</td>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
												</tr>
												<tr><td>&nbsp;</td><td></td><td id="val_workorder" style="color:red"></td></tr>
												<tr>
													<td>&nbsp;</td>
													<td  class="label">RAB </td>
													<td  class="labeldisplay">
													<select class="textboxdisplay" name="cmb_rbn" id="cmb_rbn" style="width:150px;" >
														<option value="">--- Select ---</option>
													</select>
													</td>
													<td>&nbsp;</td>
													<td>&nbsp;</td>
												</tr>
												<tr><td>&nbsp;</td><td></td><td id="val_work" style="color:red"></td></tr>
												<tr>
												<td colspan="6">
													<center>
														<input type="hidden" class="text" name="submit" value="true" />
														<input  type="hidden" class="text" name="runningbilltext" id="runningbilltext" value=""/>
													<!-- <input type="submit" class="btn" data-type="submit" value=" View " name="submit" id="submit"   />&nbsp;&nbsp;&nbsp;
														<input type="button" name="back" value="Back" id="back" class="backbutton" onClick="goBack();" />--> 
													</center>	    
													</td>
												</tr>
												<tr><td></td></tr>
											</table>
											<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
												<div class="buttonsection">
													<input type="button" name="back" value="Back" id="back" class="backbutton" onClick="goBack();" /> 
												</div>
												<div class="buttonsection">
													<input type="submit" class="btn" value=" View " name="btn_view" id="btn_view"   />
												</div>
											</div>                 
										</div>
									</div>
								</div>
								<div class="div3">&nbsp;</div>
							</div>
						</div>
					</blockquote>
				</div>
			</div>
		</div>
	</form>
</body>
<!--==============================footer=================================-->
<script src="js/jquery.hoverdir.js"></script> 
<script src="js/CommonJSLibrary.js"></script>
<script>
	/* $("#cmb_shortname").chosen();
	$("#cmb_rbn").chosen();
    $(function() {
		$.fn.validatembooktype = function(event) {	
			if($("#cmb_mbook_type").val()==""){ 
				var a="Please select the Measurement Type";
				$('#val_mbooktype').text(a);
				event.preventDefault();
				event.returnValue = false;
					//return false;
			}else{
				var a="";
				$('#val_mbooktype').text(a);
			}
		}
		$.fn.validateworkorder = function(event) { 
			if($("#cmb_shortname").val()==""){ 
				var a="Please select the work order number";
				$('#val_work').text(a);
				event.preventDefault();
				event.returnValue = false;
				//return false;
			}else{
				var a="";
				$('#val_work').text(a);
			}
		}
		$("#top").submit(function(event){
        	$(this).validatembooktype(event);
			$(this).validateworkorder(event);
        });
		$("#cmb_shortname").change(function(event){
           	$(this).validateworkorder(event);
        });
    	$("#cmb_mbook_type").change(function(event){
           	$(this).validatembooktype(event);
        });
	 	$("#cmb_shortname").change(function(event){
			var sheetid = $(this).val();
			$.ajax({ 
				type: 'POST', 
				url: 'FindWERecRAB.php', 
				data: { sheetid: sheetid, page: 'WBR' }, 
				dataType: 'json',
				success: function (data) {  
					$('#cmb_rbn').chosen('destroy');
					$('#cmb_rbn').children('option:not(:first)').remove();
					if(data != null){
						$.each(data, function(index, element) { 
							$("#cmb_rbn").append('<option value="'+element.rbn+'">'+element.rbn+'</option>');
						});
					}
					$("#cmb_rbn").chosen();
				}
			});
		}); 
		
	}); */
	$('body').on("change","#cmb_shortname", function(e){ 
	 	var Id = $(this).val();   
		$("#cmb_rbn").val('');
	 	$.ajax({ 
	 		type: 'GET', 
	 		url: "{{ route('ajax.FindAllRAB') }}", 
	 		data: { 'Id': Id, 'Page': 'RAB'},   
	 		success: function (data) {          
				if(data != null){
					var RbnData = data['rbndata'];  
					$("#cmb_rbn").attr('disabled', false);
					$.each(RbnData, function(key, value) { 
						$("#cmb_rbn").append('<option value="' +value.rbn+ '">' +value.rbn+ '</option>');
					});
				}
	 		}
	 	});
	 });

	$('body').on("change","#cmb_shortname", function(e){ 
	 	var Id = $(this).val();
		$("#txt_workorder_no").val('');
		$("#workname").val('');
	 	$.ajax({ 
	 		type: 'GET', 
	 		url: "{{ route('ajax.FindWorkName') }}", 
	 		data: { 'Id': Id, 'Page': 'WORK'}, 
	 		success: function (data) { 
				if(data != null){
					var SheetData = data['sheetdata'];
					$.each(SheetData, function(key, value) { 
						$("#txt_workorder_no").val(value.work_order_no);
						$("#workname").val(value.work_name); 	
					});
				}
	 		}
	 	});
	 });

</script>
@endsection

