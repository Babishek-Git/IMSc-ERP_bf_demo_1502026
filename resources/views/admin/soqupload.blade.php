@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
<form name="form" method="post" enctype="multipart/form-data" action="{{ route('admin.Soq') }}">
	<div class="content">
		<div class="title"></div>
		<div class="container_12">
			<div class="grid_12">
				<blockquote class="bq1" style="overflow-y:scroll">
					<div class="container">
						<div class="row">
							<div class="div2">&nbsp;</div>
							<div class="div8 mbtable">
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">SOQ Upload</div></div></div>
								<div align="right">
									<font style="font-size:12px; font-weight:bold; color:#0066FF">
										Upload File Format :&nbsp;&nbsp;&nbsp;&nbsp;
										<a href="" onClick="OpenInNewTabWinBrowser('AgreementUpload_File_Sample.php');"><u>Agreement Sheet</u>&nbsp;&nbsp;&nbsp;&nbsp;</a>
									</font>
								</div>
								<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="color1">
									<tr><td width="21%">&nbsp;</td></tr>
									<tr>
										<td>&nbsp;</td>
										<td class="label">Work Short Name</td> 
										<td class="labeldisplay">
											<!-- <select name="cmb_work_no" id="cmb_work_no" class="textboxdisplay" style="width:437px;" onChange="workorderdetail();"> -->
											<select name="cmb_work_no" id="cmb_work_no" class="textboxdisplay" style="width:437px;">
												<option value=""> --------------- Select --------------- </option>
															@foreach($data as $work)
													<option value="{{ $work['sheetid'] }}">{{ $work['short_name'] }}</option>
												@endforeach
											</select>
										</td>
									</tr>
									<tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="val_woredrno" style="color:red" colspan="">&nbsp;</td></tr>
									<tr>
										<td>&nbsp;</td>
										<td class="label">Work Order No.</td>
										<td><input type="text" name='txt_workorder_no' id='txt_workorder_no' readonly="" class="textboxdisplay" style="width:435px;"></td>
									</tr>
									<tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="" style="color:red" colspan="">&nbsp;</td></tr>
									<tr>
										<td>&nbsp;</td>
										<td class="label">Work Name</td>
										<td><textarea name='txt_workname' id='txt_workname' readonly="" class="textboxdisplay" value="" rows="6" style="width:434px"></textarea></td>
									</tr>
									<tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="" style="color:red" colspan="">&nbsp;</td></tr>
									<tr>
										<td>&nbsp;</td>
										<td class="label">Sheet Name</td>
										<td><input type="text" name='txt_sheetname' id='txt_sheetname' class="textboxdisplay" style="width:410px">&nbsp;<i class="fa fa-info-circle" aria-hidden="true" style="padding-top:1px; color:#0078F0; cursor:pointer; font-size:22px" id="sheet_name_info" title="Click here to View Sample"></i></td>
									</tr>
									<tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="val_sheetname" style="color:red" colspan="">&nbsp;</td></tr>
									<tr>
										<td>&nbsp;</td>
										<td class="label">Upload File</td>
										<td><input type="file" class="text" name="file" id="file" size="44" style="height:23px;" /></td>
									</tr>
									<tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="val_file" style="color:red" colspan="">&nbsp;</td></tr>
									<tr>
										<td colspan="3" align="center" class="smalllabcss">Upload files allow the file formats of : .xls  , .xlsx</td>
									</tr>
								</table>
								<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
									<div class="buttonsection">
										<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
									</div>
									<!--	<div class="buttonsection">
										<input type="button" class="backbutton" name="View" id="View" value="View" onClick="View_page();"/>
									</div>	-->
									<div class="buttonsection" style="width:115px">
										<input type="submit" class="btn" data-type="submit" name="action" id="save" value="Upload File" />
										<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
									</div>
								</div>
							</div>
							<div class="div2">&nbsp;</div>
						</div>
					</div>
				</blockquote>
			</div>
		</div>
	</div>
</form>
<script>
	$('#cmb_work_no').chosen();
	$('#cmb_work_no').change(function() {
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
</script>
@endsection	