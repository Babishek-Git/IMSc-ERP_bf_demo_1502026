@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@php
	if(isset($data)){ 
		foreach($data as $Designation){
			$DesignationName =  $Designation['designationname'];
			$DesignationId =  $Designation['designationid'];
		}
	}
@endphp

<form name="form" method="post" action="{{ route('admin.savedesignation') }}">
<!--==============================Content=================================-->
    <div class="content">
        <div class="title">Designation</div>
        <div class="container_12">
            <div class="grid_12">
                <blockquote id="bq1" class="bq1">
                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="color1">
                        <tr>
							<td colspan="3">&nbsp;</td>
						</tr>
						<tr>
							<td width="19%">&nbsp;</td>
                            <td class="label">&nbsp;&nbsp;Designation Name</td>
							<td>
								<input type="text" name='designationname' id='designationname' class="textboxdisplay" onKeyPress="return onlyAlphabets(event,this);" value="@if(isset($DesignationName)){{ decrypt($DesignationName); }}@endif" size="60" required oninvalid="this.setCustomValidity('Please enter designation');">
								<input type="hidden" name='designationid' id='designationid' class="textboxdisplay" onKeyPress="return onlyAlphabets(event,this);" value="@if(isset($DesignationId)){{ encrypt($DesignationId); }}@endif" size="60">
							</td>									
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td class="labeldisplay" id="val_design" style="color:red">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="3"></td>
						</tr>
                        <tr>
                            <td colspan="3" height="50px">
								<div style="text-align:center">
									
									<!--<input type="image" src="Buttons/submit.png" onmouseover="this.src='Buttons/submit_hover.png';" onmouseout="this.src='Buttons/submit.png';" class="btn" name="submit" id="submit" data-type="submit" value="Submit" onClick="return validation()"/>&nbsp;&nbsp;&nbsp;&nbsp;-->
									<div class="buttonsection"><input type="submit" name="submit" id="submit" data-type="submit" value="Submit"/></div>
									<!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
									@php $AddUrl = 'admin.viewdesignation'; @endphp
									<div class="buttonsection"><input type="button" class="backbutton" name="View" id="View" value="View" onclick="window.location='{{ route($AddUrl) }}'"/></div>
									<div class="buttonsection"><input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/></div>
									<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
								</div>
							</td>
						</tr>
						<tr>
							<td colspan="3">&nbsp;</td>
						</tr>
                    </table>
                	<div class="col2"></div>
            	</blockquote>
        	</div>
        </div>
    </div>
</form>
@endsection	
