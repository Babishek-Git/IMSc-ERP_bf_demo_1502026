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
		<td class="label">Work Short Name </td>
		<td class="labeldisplay">
			<select name="cmb_work_no" id="cmb_work_no" class="textboxdisplay" style="width:470px;height:22px;">
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
		<td  class="labeldisplay"><input type="text" name="txt_workorder_no" id="txt_workorder_no" readonly="" class="textboxdisplay" style="width: 465px;"></td>
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
		<td class="label">Name of the Work </td>
		<td  class="labeldisplay"><textarea name="workname" id="workname" readonly="" rows="6" class="textboxdisplay" style="width: 465px;"></textarea></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
    <tr>
		<td>&nbsp;</td>
		<td></td>
		<td id="val_work" style="color:red" colspan="3"></td>
	</tr>
                                   
	<tr>
		<td>&nbsp;&nbsp;</td>
		<td width="" class="label"></td>
		<td id="val_rbn" style="color:red" colspan="3"></td>
	</tr>
    <tr>
		<td colspan="5">
        	<center>
            	<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
				<input type="hidden" name="req_page" id="req_page" value="SOQ" />
            </center>	    
		</td>
	</tr>
	<tr>
		<td colspan="5"></td>
	</tr>
</table>

