@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@if(isset($data['StaffData']))
@php 
	$StaffData = $data['StaffData'];
@endphp
@endif

@if(isset($data['MBookData']))
@php 
	$MBookData = $data['MBookData'];
@endphp
@endif

 <body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
    <form action="" method="post" enctype="multipart/form-data" name="phuploader">
		<div class="content">
    		<div class="title"></div>
          	<div class="container_12">
				<div class="grid_12">
					<blockquote class="bq1" style="overflow:auto">
                    	<div class="container" align="center">
							<div class="row">
								<div class="div1 "></div>
								<div class="div10 mbtable" align="center">
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">My MBooks (General / Steel / Abstract / Escalation)</div></div></div>
									<div class="row innerdiv">								
										<table class="table1 table2" align="center" id="dataTable" width="98%">
											<thead>
												<tr>
													<th style="text-align:center">S.No</th>
													<th style="text-align:center">Work Name</th>
													<th style="text-align:center">Engineer Name</th>
													<th style="text-align:center">General MBook</th>
													<th style="text-align:center">Steel MBook</th>
													<th style="text-align:center">Abstract MBook</th>
													<th style="text-align:center">Escalation MBook</th>
												</tr>
											</thead>
											<tbody>
											@foreach($data['WorkData'] as $WorkData)
												<tr>
													<td align="center">{{ $loop->iteration }}</td>
													<td align="center">{{ $WorkData->work_name }}</td>
													<td align="center">
													@php 
													if($WorkData->staffid != NULL){
														$StaffName = $StaffData[$WorkData->staffid];
													}else{
														$StaffName = "";
													}
													$WorkMBookData = $MBookData[$WorkData->sheetid];
													@endphp
													{{ $StaffName }}
													</td>
													
													<td align="center">
														@if(isset($WorkMBookData['G']))
														@php 
														$GMBData = collect($WorkMBookData['G'])->pluck('mbno')->toArray();
														echo implode(", ",$GMBData); 
														@endphp 
														@endif
													</td>
													<td align="center">
														@if(isset($WorkMBookData['S']))
														@php 
														$SMBData = collect($WorkMBookData['S'])->pluck('mbno')->toArray();
														echo implode(", ",$SMBData); 
														@endphp 
														@endif
													</td>
													<td align="center">
														@if(isset($WorkMBookData['A']))
														@php 
														$AMBData = collect($WorkMBookData['A'])->pluck('mbno')->toArray();
														echo implode(", ",$AMBData); 
														@endphp 
														@endif
													</td>
													<td align="center">
														@if(isset($WorkMBookData['E']))
														@php 
														$EMBData = collect($WorkMBookData['E'])->pluck('mbno')->toArray();
														echo implode(", ",$EMBData); 
														@endphp 
														@endif
													</td>
													<!-- <td nowrap="nowrap"align="center">{{ $WorkData->staffid }}</td>
													<td align="center">@if($WorkData->mbooktype =="G"){{ $WorkData->mbno; }}@endif</td>
													<td align="center">@if($WorkData->mbooktype =="S"){{ $WorkData->mbno; }}@endif</td>
													<td align="center">@if($WorkData->mbooktype =="A"){{ $WorkData->mbno; }}@endif</td>
													<td align="center">@if($WorkData->mbooktype =="E"){{ $WorkData->mbno; }}@endif</td> -->
												</tr>
												@endforeach
											</tbody>
										</table>
									</div>
									<!-- <div class="row">
										<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
										<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
									</div> -->
									<div class="row clearrow"></div>
								</div>
					       		<div class="div1 "></div>
							</div>
							
						</div>
						
				  	</blockquote>
				</div>
			</div>
   		</div>
        </form>
    </body>
</html>
@endsection