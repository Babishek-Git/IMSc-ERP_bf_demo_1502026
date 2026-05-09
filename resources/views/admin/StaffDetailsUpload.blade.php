@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

        <form name="form" method="post" action="{{ route('admin.StaffDetailsGenerate') }}">
            <!--==============================Content=================================-->
            <div class="content">  
                <div class="title">Staff Details- View</div>
                <div class="container_12">  
                    <div class="grid_12"> 
					 <div align="right">&nbsp;&nbsp;</div>
                        <blockquote class="bq1" id="bq1" style="overflow:auto;">
                        <div class="container" align="center">
								<div class="div1 "></div>
								<div align="right" ></div>
							<div class="div10 mbtable" align="center">
								`<table class="table-bordered  dataTable no-footer " align="center" id="dataTable">
									<thead>
										<tr>
											<th class="colhead">Staff ICNO</th>
											<th class="colhead">Employee No</th>
											<th class="colhead">Staff Name</th>
											<th class="colhead">Section</th>
											<th class="colhead">Designation</th>
											<th class="colhead">Email ID</th>
											<th class="colhead">Intercom No</th>
											<th class="colhead" >Mobile No</th>
											<th class="colhead">Staff Role</th>
										</tr>										
										</thead>
							
									@php
									$AllItemArr = array(); $TotalAmount = 0;
									if(isset($data['StaffData'])){
									foreach($data['StaffData'] as $StaffDataKey => $StaffDataValue){
										$StaffICNO  = $StaffDataValue['staff_icno'];
										$StaffEmpNo  = $StaffDataValue['staff_empno'];
										$StaffName  = $StaffDataValue['staff_name'];
										$StaffSection  = $StaffDataValue['staff_sec'];
										$StaffDesignation  = $StaffDataValue['staff_desig'];
										$StaffEmailId  = $StaffDataValue['staff_mail'];
										$StaffIntercomNo  = $StaffDataValue['staff_intercomno'];
										$StaffMobileNo  = $StaffDataValue['staff_mob'];
										$StaffRole  = $StaffDataValue['staff_role'];
										if(($StaffRole == "")||($StaffRole == NULL)){
											$StaffRole = 0;
										}
										
										if(in_array($StaffICNO,$AllItemArr)){
											$DuplicateItem 	= 1;
											$DupTdStyle 	= "background-color:#DA0532; color:#ffffffAllItemArr; font-weight:bold;";
										}else{
											$DuplicateItem 	= 0;
											$DupTdStyle 	= "";
										}

									@endphp
							
									<tr>
											<td tyle="text-align:center" align="center">@if(isset($StaffICNO)){{ $StaffICNO; }}@endif<input type="hidden" name="txt_icno[]" value="@if(isset($StaffICNO)){{ $StaffICNO; }}@endif"></td>
											<td tyle="text-align:left" align="left">@if(isset($StaffEmpNo)){{ $StaffEmpNo; }}@endif<input type="hidden" name="txt_empno[]" value="@if(isset($StaffEmpNo)){{ $StaffEmpNo; }}@endif"></td>
											<td class="col">@if(isset($StaffName)){{ $StaffName; }}@endif<input type="hidden" name="txt_staff_name[]" value="@if(isset($StaffName)){{ $StaffName; }}@endif"></td>
											<td class="col" align="left">@if(isset($StaffSection)){{ $StaffSection; }}@endif<input type="hidden" name="txt_sec[]" value="@if(isset($StaffSection)){{ $StaffSection; }}@endif"></td>
											<td class="col" align="left">@if(isset($StaffDesignation)){{ $StaffDesignation; }}@endif<input type="hidden" name="txt_desig[]" value="@if(isset($StaffDesignation)){{ $StaffDesignation; }}@endif"></td>
											<td class="col" align="left">@if(isset($StaffEmailId)){{ $StaffEmailId; }}@endif<input type="hidden" name="txt_mail[]" value="@if(isset($StaffEmailId)){{ $StaffEmailId; }}@endif"></td>
											<td class="col" align="left">@if(isset($StaffIntercomNo)){{ $StaffIntercomNo; }}@endif<input type="hidden" name="txt_intercom[]" value="@if(isset($StaffIntercomNo)){{ $StaffIntercomNo; }}@endif"></td>
											<td class="col" align="left">@if(isset($StaffMobileNo)){{ $StaffMobileNo; }}@endif<input type="hidden" name="txt_mob[]" value="@if(isset($StaffMobileNo)){{ $StaffMobileNo; }}@endif"></td>
										    <td class="col" align="left">@if(isset($StaffRole)){{ $StaffRole; }}@endif<input type="hidden" name="txt_role[]" value="@if(isset($StaffRole)){{ $StaffRole; }}@endif"></td>
										</tr>

										@php
										
									   }									 }
								
									@endphp
									</tbody>
								</table>
						   </div>
						
						   <div style="text-align:center; height:30px; line-height:30px;" class="printbutton">
								<div class="div12">
								
								
										
										<input type="hidden" name="hid_esd" id="hid_esd"  value="@if(isset($Esdid)){{ $Esdid; }}@endif">
										<input type="button" class="backbutton" name="back" id="back" value=" BACK " onClick="goBack();"/>
										<input type="submit" class="backbutton" name="btn_upload" id="btn_upload" value=" CONFIRM "/>
										<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
								</div>
								<div class="div12">&nbsp;</div>
							</div>
                        </blockquote>
                    </div>
                </div>    
            </div> 

         <!--==============================footer=================================-->

	<script>
		


	</script>
    </body>
</html>
@endsection	

