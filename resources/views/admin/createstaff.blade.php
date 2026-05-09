@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
	<form action="" method="post" enctype="multipart/form-data" name="form">
		<div class="content">
			<div class="title"></div>
			<div class="container_12">
				<div class="grid_12">
					<blockquote class="bq1" style="overflow:auto">
						<div class="container">
							<div class="row ">
								<div class="div1">&nbsp;</div>
								<div class="div10 mbtable">
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Staff</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">													
											<input type="hidden" name="staffid" id="staffid" value=""> 
												<br/>
												<table width="80%"  bgcolor="#E8E8E8" border="1" cellpadding="0" cellspacing="0" align="center" style="border:1px solid #E7E8E9">
													<tr><td width="5%">&nbsp;</td><td colspan="5">&nbsp;</td></tr>	
													<input type="hidden" name="dummyicno" id="dummyicno" class="textboxdisplay" style="width:297px;" value=""/>
													<input type="hidden"  name='dummyemail' id='dummyemail' class="textboxdisplay" value="">
													<tr height="25px">
														<td>&nbsp;</td>
														<td class="label" nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Staff ICNO</td>
														<td class="labeldisplay">								
														<input type="text" name="txt_ic_no" id="txt_ic_no" class="textboxdisplay" style="width:297px;" value="" tabindex="1" maxlength="10"/>
														</td>
														<td width="5%">&nbsp;</td>    										
														<td  class="label">Staff Name</td>
														<td class="labeldisplay">													
														<input type="text" name='txt_staffname' id='txt_staffname' class="textboxdisplay" style="width:297px;" maxlength="40" tabindex="2" onKeyPress="return onlyAlphabets(event,this);">								
														</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td>&nbsp;</td>
														<td class="labeldisplay" id="val_icno" style="color:red">&nbsp;</td>
														<td>&nbsp;</td>
														<td>&nbsp;</td>
														<td class="labeldisplay" id="val_staffname" style="color:red">&nbsp;</td>
													</tr>
													<tr height="25px">
														<td>&nbsp;</td>
														<td class="label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Section</td>
														<td>
															<select id="cmb_section" name="cmb_section" class="textboxdisplay" style="width:297px;height:22px;" tabindex="3">
															<option value=""> ------------- Select ------------- </option>
																@php if(isset($SectionData)){ @endphp
																	@foreach($SectionData as $Projects)
																		@php
																		if((isset($TechProject))&&($TechProject== $Projects->secid)){
																			$SelStr = 'selected="selected"';
																		}else{
																			$SelStr = '';
																			}
																		@endphp
																			<option value="{{ $Projects->secid }}"{{$SelStr;}}> {{ $Projects->section_name }} </option>
																	@endforeach
																@php } @endphp	
															</select>    
														</td>
														<td>&nbsp;</td>
														<td class="label">Staff Role</td>
														<td class="labeldisplay">
															<select name="cmb_staff_role" id="cmb_staff_role" class="textboxdisplay" style="width:297px;" tabindex="4">
																<option value=""> ------------- Select ------------- </option>
																@php if(isset($levelData)){ @endphp
																	@foreach($levelData as $Projects)
																		@php
																		if((isset($TechProject))&&($TechProject== $Projects->sroleid)){
																			$SelStr = 'selected="selected"';
																		}else{
																			$SelStr = '';
																			}
																		@endphp
																			<option value="{{ $Projects->sroleid }}"{{$SelStr;}}> {{ $Projects->role_name }} </option>
																	@endforeach
																@php } @endphp
															</select>
															<input type="hidden" name="txt_level" id="txt_level" value="">
														</td>
														
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td>&nbsp;</td>
														<td class="labeldisplay" id="val_section_name" style="color:red">&nbsp;</td>
														<td>&nbsp;</td>
														<td>&nbsp;</td>
														<td class="labeldisplay" id="val_staff_role" style="color:red">&nbsp;</td>
													</tr>
													<tr height="25px">
														<td>&nbsp;</td>								
														<td class="label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Designation</td>
														<td>
															<select id="cmb_designation" name="cmb_designation" onChange="func_item_no()" class="textboxdisplay" style="width:297px;height:22px;" tabindex="5">
																<option value=""> ------------- Select ------------- </option>
																@php if(isset($DesignationData)){ @endphp
																	@foreach($DesignationData as $Projects)
																		@php
																		if((isset($TechProject))&&($TechProject== $Projects->designationid)){
																			$SelStr = 'selected="selected"';
																		}else{
																			$SelStr = '';
																			}
																		@endphp
																			<option value="{{ $Projects->designationid }}"{{$SelStr;}}> {{ $Projects->designationname }} </option>
																	@endforeach
																@php } @endphp
																
															</select>    
														</td>
														<td>&nbsp;</td>
														<td class="label">Email - ID</td> 
														<td class="labeldisplay">
															<input type="text"  name='txt_email' id='txt_email' class="textboxdisplay" value="" style="width:297px;" tabindex="6"  maxlength="30">
														</td>																					
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td>&nbsp;</td>
														<td class="labeldisplay" id="val_designation" style="color:red">&nbsp;</td>
														<td>&nbsp;</td>
														<td>&nbsp;</td>
														<td class="labeldisplay" id="val_emailid" style="color:red">&nbsp;</td>
													</tr>                                                             
													<tr>
														<td>&nbsp;</td>
														<td class="label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mobile No.</td> 
														<td class="labeldisplay">
															<input type="text" name='txt_mobile' id='txt_mobile' class="textboxdisplay" value="" style="width:297px;" maxlength="10" tabindex="7" onKeyPress="return isNumber(event)"/>
														</td>
														<td>&nbsp;</td>
														<!-- <td class="label">Photo Upload</td>						
														<td colspan="">
															<input type="file" id="image" name="image" style="width: 90px;" tabindex="7" size ="38" style="height:23px;" onChange="this.style.width = '100%';" onBlur="uploadfile()" >												
															<span id="dbimage" style="display:"></span></td>
														</td> -->																		
													<tr>
														<td>&nbsp;</td>
														<td>&nbsp;</td>
														<td class="labeldisplay" id="val_mobileno" style="color:red">&nbsp;</td>
														<td>&nbsp;</td>
														<td>&nbsp;</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td class="label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Intercom No.</td> 
														<td class="labeldisplay">
															<input type="text" name='txt_intercom' id='txt_intercom' class="textboxdisplay" value="" style="width:297px;" maxlength="8" tabindex="8" onKeyPress="return isNumber(event)"/>
														</td>
														<td>&nbsp;</td>
														<td>&nbsp;</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td>&nbsp;</td>
														<td>&nbsp;</td>
														<td class="labeldisplay" id="val_intercom" style="color:red">&nbsp;</td>
														<td>&nbsp;</td>
														<td>&nbsp;</td>
														<td>&nbsp;</td>
													</tr>                     
												</table>										
											@php $AddUrl = 'admin.viewstaff'; @endphp
											<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
												<div class="buttonsection"><input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/></div>
												<div class="buttonsection"><input type="button" class="backbutton" name="View" id="View" value="View" onClick="window.location='{{ route($AddUrl) }}'"/></div>
												<div class="buttonsection"><input type="submit" name="submit" id="submit" data-type="submit" value=" Save "/></div>
											</div>
										</div>
									</div>										
								</div>
								<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
								<div class="div1">&nbsp;</div>
							</div>                           
						</div>
					</blockquote>
				</div>
			</div>
		</div>
	</form>
</body>	
	@endsection