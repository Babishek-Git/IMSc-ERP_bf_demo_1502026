@extends('layouts.dashboard-master')

@section('content')
    <body class="page1" id="top">
        <div class="content">
            <div class="title">Quantity Deviation Percentage</div>
            <div class="container_12">
                <div class="grid_12">
                    <blockquote class="bq1">
                        <form name="form" method="post" action="{{ route('admin.viewsheet') }}">
                       
                            <div class="container">

                                <table width="100%"  bgcolor="#E8E8E8" border="0" cellpadding="0" cellspacing="0" align="center" >
                                    <tr>
										<td width="19%">&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td>&nbsp;</td> 
									 	<td  class="label">Work Short Name </td>
									 	<td  class="labeldisplay">
											<select name="cmb_work_no" id="cmb_work_no" onChange="find_workname()" class="textboxdisplay" style="width:470px;height:22px;" tabindex="7">
												 <option value="">--------------- Select ---------------</option>
												 @foreach($works as $work)
										 		<option value="{{ $work['sheetid'] }}">{{ $work['short_name'] }}</option>
												 @endforeach
												
											</select>
										</td>
									 	<td>&nbsp;</td>
										<td>&nbsp;</td>
								 	</tr>
								 	<tr>
										<td>&nbsp;</td>
										<td></td>
										<td id="val_work" style="color:red" colspan="3"></td>
									</tr>
									<tr>
										<td>&nbsp;</td>
										<td  class="label">Work Order No. </td>
										<td  class="labeldisplay"><input type="text" name="txt_workorder_no" id="txt_workorder_no" readonly="" rows="6" class="textboxdisplay" style="width: 465px;"></textarea></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
                                    <tr>
										<td>&nbsp;</td>
										<td></td>
										<td id="val_workorder" style="color:red" colspan="3"></td>
									</tr>
								 	<tr>
										<td>&nbsp;</td>
										<td  class="label">Name of the Work </td>
										<td  class="labeldisplay"><textarea name="workname" id="workname" readonly="" rows="6" class="textboxdisplay" style="width: 465px;"></textarea></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
                                    <tr>
										<td>&nbsp;</td>
										<td></td>
										<td id="val_workname" style="color:red" colspan="3"></td>
									</tr>
									<tr>
										<td>&nbsp;&nbsp;</td>
										<td width="" class="label"></td>
										<td id="val_rbn" style="color:red" colspan="3"></td>
									</tr>
                                    <tr>
                                        <td colspan="6">
											<center>
											  <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
											  <input type="hidden" name="req_page" id="req_page" value="DEV" />
											<!--<input type="image" src="Buttons/View_Normal.png" onmouseover="this.src='Buttons/View_Over.png';" onmouseout="this.src='Buttons/View_Normal.png';" class="btn" data-type="submit" value="View" name="submit" id="submit"   />-->
											<!--<input type="submit" data-type="submit" value=" View " name="submit" id="submit"/>-->
											</center>	    
										</td>
                                    </tr>
                                </table>
									<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
										<div class="buttonsection">
											<input type="submit" data-type="submit" value=" View " name="submit" id="submit"/>
										</div>
									</div>
							</form>
                    </blockquote>
                </div>

            </div>
        </div>
    </body>
</html>
<script>
	$('#cmb_work_no').chosen();
	$('#cmb_work_no').change(function() {
		var work = $(this).val();
		$("#txt_workorder_no").val('');
		$("#workname").val('');
		$.ajax({
			type:'POST',
			url:"{{ route('posts.getwork') }}",
			data:{'_token': '{{ csrf_token() }}','work':work},
			success:function(data){ 
				if(data){ 
					$.each(data, function(key, value) {
						$("#txt_workorder_no").val(value.work_order_no);
						$("#workname").val(value.work_name);
					});
				}
			}
		});
	});
</script>
@endsection	
