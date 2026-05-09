@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

@php
 	if(isset($data)){
		foreach($data as $rdata){
			$RecId          	  	= $rdata->rid;
			$Reccgst          	= $rdata->cgst;
			$Recsgst          	= $rdata->sgst;
			$Recwct_noncivil 		= $rdata->wct_noncivil;
			$Recwct_civil 			= $rdata->wct_civil;
			$Recvat_noncivil 		= $rdata->vat_noncivil;
			$Recvat_civil			= $rdata->vat_civil;
			$Recmob_advance		= $rdata->mob_advance;
			$Reclabour_welfare	= $rdata->labour_welfare;
			$Recincometax 			= $rdata->incometax;
			$Recit_cess 			= $rdata->it_cess;
			$Recit_edu_cess		= $rdata->it_edu_cess;
			$Recsd					= $rdata->sd;
			$Recsd_rbn				= $rdata->sd_rbn;
			$Recwater_charge		= $rdata->water_charge;
			$Recwater_maxlevel 	= $rdata->water_maxlevel;
			$Recelectricity_charge 	= $rdata->electricity_charge;
			$Recland_rent 			= $rdata->land_rent;
			$Recliquid_damage 	= $rdata->liquid_damage;
			$Recinterest_ma 		= $rdata->interest_ma;
			$Recother_recovery	= $rdata->other_recovery;
			$Recuserid 				= $rdata->userid;
			$Recmodifieddate 		= $rdata->modifieddate;
			$Recwater_charge 		= $rdata->water_charge;
		}
	}
@endphp
<form action="{{ route('admin.saverecoveries') }}" method="post" enctype="multipart/form-data" name="form">
	<div class="content">
		<div class="title"></div>
		<div class="container_12">
			<div class="grid_12">
				<blockquote class="bq1" style="overflow:auto">
					<div class="container">
						<div class="row ">
							<div class="div1">&nbsp;</div>
							<div class="div10 mbtable">
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center"> Recoveries </div></div></div>
								<div class="row innerdiv">
									<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="color1">
										</br>
										<tr>
											<td colspan="4" class="label" style="background-color:#D4D4D4">GST</td>
										</tr>
										<tr><td colspan="4" class="label">&nbsp;</td></tr>
										<tr>
											<td class="label">CGST </td>
											<td>
												<input type="text" class="textboxdisplay" name="txt_cgst" id="txt_cgst" style="width:70px" value="@if(isset($Reccgst)){{ $Reccgst }}@endif">
												<label class="label labledescription">&nbsp;% of Total Bill Value&nbsp;</label>
											</td>
											<td class="label">SGST</td>
											<td>
												<input type="text" class="textboxdisplay" name="txt_sgst" id="txt_sgst" style="width:70px" value="@if(isset($Recsgst)){{ $Recsgst }}@endif">
												<label class="label labledescription">&nbsp; % of Total Bill Value&nbsp;</label>
											</td>
										</tr>
										<tr>
											<td>&nbsp;</td>
											<td align="center" class="labeldisplay" id="val_cgst" style="color:red" colspan="">&nbsp;</td>
											<td>&nbsp;</td>
											<td align="center" class="labeldisplay" id="val_sgst" style="color:red" colspan="">&nbsp;</td>
										</tr>
										
										<tr>
											<td colspan="4" class="label" style="background-color:#D4D4D4">Under 8 (a)</td>
										</tr>
										<tr><td colspan="4" class="label">&nbsp;</td></tr>
										<tr>
											<td class="label">WCT (Non Civil)</td>
											<td>
												<input type="text" class="textboxdisplay" name="txt_wct_noncivil" id="txt_wct_noncivil" style="width:70px" value="@if(isset($Recwct_noncivil)){{ $Recwct_noncivil }}@endif">
												<label class="label labledescription">&nbsp;% of Total Bill Value&nbsp;</label>
											</td>
											<td class="label">WCT (Civil)</td>
											<td>
												<input type="text" class="textboxdisplay" name="txt_wct_civil" id="txt_wct_civil" style="width:70px" value="@if(isset($Recwct_civil)){{ $Recwct_civil }}@endif">
												<label class="label labledescription">&nbsp; % of Total Bill Value&nbsp;</label>
											</td>
										</tr>
										<tr>
											<td>&nbsp;</td>
											<td align="center" class="labeldisplay" id="val_wct_noncivil" style="color:red" colspan="">&nbsp;</td>
											<td>&nbsp;</td>
											<td align="center" class="labeldisplay" id="val_wct_civil" style="color:red" colspan="">&nbsp;</td>
										</tr>
										<tr>
											<td class="label">VAT (Non Civil)</td>
											<td>
												<input type="text" class="textboxdisplay" name="txt_vat_noncivil" id="txt_vat_noncivil" style="width:70px" value="@if(isset($Recvat_noncivil)){{ $Recvat_noncivil }}@endif">
												<label class="label labledescription">&nbsp;% of Total Bill Value&nbsp;</label>
											</td>
											<td class="label">VAT (Civil)</td>
											<td>
												<input type="text" class="textboxdisplay" name="txt_vat_civil" id="txt_vat_civil" style="width:70px" value="@if(isset($Recvat_civil)){{ $Recvat_civil }}@endif">
												<label class="label labledescription">&nbsp; % of Total Bill Value&nbsp;</label>
											</td>
										</tr>
										<tr>
											<td>&nbsp;</td>
											<td align="center" class="labeldisplay" id="val_vat_noncivil" style="color:red" colspan="">&nbsp;</td>
											<td>&nbsp;</td>
											<td align="center" class="labeldisplay" id="val_vat_civil" style="color:red" colspan="">&nbsp;</td>
										</tr>
										<tr>
											<td class="label">Mobilization Advance</td>
											<td>
												<input type="text" class="textboxdisplay" name="txt_mob_advance" id="txt_mob_advance" style="width:70px" value="@if(isset($Recmob_advance)){{ $Recmob_advance }}@endif">
												<label class="label labledescription">&nbsp;% of Total Bill Value&nbsp;</label>
											</td>
											<td class="label">Labour Welfare Cess</td>
											<td>
												<input type="text" class="textboxdisplay" name="txt_labour_welfare" id="txt_labour_welfare" style="width:70px" value="@if(isset($Reclabour_welfare)){{ $Reclabour_welfare }}@endif">
												<label class="label labledescription">&nbsp; % of Total Bill Value &nbsp;</label>
											</td>
										</tr>
										<tr>
											<td>&nbsp;</td>
											<td align="center" class="labeldisplay" id="val_mob_advance" style="color:red" colspan="">&nbsp;</td>
											<td>&nbsp;</td>
											<td align="center" class="labeldisplay" id="val_labour_welfare" style="color:red" colspan="">&nbsp;</td>
										</tr>
										<tr>
											<td colspan="4" class="label" style="background-color:#D4D4D4">Under 8 (b)</td>
										</tr>
										<tr><td colspan="4" class="label">&nbsp;</td></tr>
										<tr>
											<td class="label">Security Deposit in <br/>Total Work Order Cost</td>
											<td>
												<input type="text" class="textboxdisplay" name="txt_sd" id="txt_sd" style="width:70px" value="@if(isset($Recsd)){{ $Recsd }}@endif">
												<label class="label labledescription">&nbsp;% of Total work order cost&nbsp;</label>
											</td>
											<td class="label">Security Deposit in <br/>Every RBN</td>
											<td>
												<input type="text" class="textboxdisplay" name="txt_sd_rbn" id="txt_sd_rbn" style="width:70px" value="@if(isset($Recsd_rbn)){{ $Recsd_rbn }}@endif">
												<label class="label labledescription">&nbsp; % of Total Bill Value&nbsp;</label>
											</td>
										</tr>
										<tr>
											<td>&nbsp;</td>
											<td align="center" class="labeldisplay" id="val_sd" style="color:red" colspan="">&nbsp;</td>
											<td>&nbsp;</td>
											<td align="center" class="labeldisplay" id="val_sd_rbn" style="color:red" colspan="">&nbsp;</td>
										</tr>
										<tr>
											<td class="label">Income Tax</td>
											<td>
												<input type="text" class="textboxdisplay" name="txt_incometax" id="txt_incometax" style="width:70px" value="@if(isset($Recincometax)){{ $Recincometax }}@endif">
												<label class="label labledescription">&nbsp;% of Total Bill Value&nbsp;</label>
											</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td>&nbsp;</td>
											<td align="center" class="labeldisplay" id="val_incometax" style="color:red" colspan="">&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td class="label">IT Cess</td>
											<td>
												<input type="text" class="textboxdisplay" name="txt_itcess" id="txt_itcess" style="width:70px" value="@if(isset($Recit_cess)){{ $Recit_cess }}@endif">
												<label class="label labledescription">&nbsp;% of Total Income Tax&nbsp;</label>
											</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td>&nbsp;</td>
											<td align="center" class="labeldisplay" id="val_itcess" style="color:red" colspan="">&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td class="label">IT Educational Cess</td>
											<td>
												<input type="text" class="textboxdisplay" name="txt_edu_cess" id="txt_edu_cess" style="width:70px" value="@if(isset($Recit_edu_cess)){{ $Recit_edu_cess }}@endif">
												<label class="label labledescription">&nbsp;% of Total Income Tax&nbsp;</label>
											</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td>&nbsp;</td>
											<td align="center" class="labeldisplay" id="val_edu_cess" style="color:red" colspan="">&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td class="label">Water Charges (Rs.)</td>
											<td colspan="3">
												<input type="text" class="textboxdisplay" name="txt_water_charge" id="txt_water_charge" style="width:150px" value="@if(isset($Recwater_charge)){{ $Recwater_charge }}@endif">
												<label class="label">&nbsp;&nbsp;/&nbsp;&nbsp;</label>
												<input type="text" class="textboxdisplay" name="txt_water_maxlevel" id="txt_water_maxlevel" style="width:150px" value="@if(isset($Recwater_maxlevel)){{ $Recwater_maxlevel }}@endif">
												<label class="label">&nbsp;&nbsp;Litres&nbsp;&nbsp;</label>
											</td>
										</tr>
										<tr>
											<td>&nbsp;</td>
											<td align="center" class="labeldisplay" id="val_water_charge" style="color:red" colspan="">&nbsp;</td>
											<td align="center" class="labeldisplay" id="val_water_maxlevel" style="color:red" colspan="">&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td class="label">Electricity Charges (Rs.)</td>
											<td colspan="3">
												<input type="text" class="textboxdisplay" name="txt_electricity_charge" id="txt_electricity_charge" style="width:150px" value="@if(isset($Recelectricity_charge)){{ $Recelectricity_charge }}@endif">
												<label class="label">&nbsp;&nbsp;/ unit&nbsp;&nbsp;</label>
											</td>
										</tr>
										<tr>
											<td>&nbsp;</td>
											<td align="center" class="labeldisplay" id="val_electricity_charge" style="color:red" colspan="3">&nbsp;</td>
										</tr>
									</table>
								</div>
								<div class="smediv">&nbsp;</div>
							</div>
							<div class="div1">&nbsp;</div>
						</div>
						<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
						<div class="buttonsection">
							<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
						</div>
						<div class="buttonsection">
							<input type="hidden" name="txt_rid" id="txt_rid" value="@if(isset($RecId)){{ $RecId }}@endif" />
							<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
							<input type="submit" name="submit" id="submit" value=" Save " />
						</div>
					</div>
				</blockquote>
			</div>
		</div>
	</div>
</form>
@endsection