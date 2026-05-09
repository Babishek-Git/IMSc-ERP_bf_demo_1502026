@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@php

if((isset($data['RecoveyGst']))){
	$RecoveyGst = $data['RecoveyGst'];	
}
if(isset($data['RecoveyGst'])){
	foreach($data['RecoveyGst'] as $Key => $Recovery){
		//dd($Recovery);
	}
}
@endphp 
<form action="" method="post" enctype="multipart/form-data" name="form">
	<div class="content">
		<div class="title"></div>
		<div class="container_12">
			<div class="grid_12">
				<div align="right"></div>
				<blockquote class="bq1" style="overflow:auto">
				<div class="container" align="center">
					<div class="div1 "></div>
					<div class="div10 mbtable" align="center">
						<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center"> Unit - View </div></div></div>
						<div class="row innerdiv">
							<div class="row">
								<table class="table-bordered table1" width="99%" align="center" id="dataTable">
									<thead>
										<tr class="note heading">
											<th style="text-align:center">SNo.</th>
											<th style="text-align:center">Recovery Code</th>
											<th style="text-align:center">Recovery Description</th>
											<th style="text-align:center">Mode</th>
											<th style="text-align:center">Recovery Value</th>
										</tr>
									</thead>
									<tbody>
									@foreach($data['RecoveyGst'] as $Recovery)
										<tr>
											<td align="center">{{ $loop->iteration }}</td>
											<td align="center">{{ $Recovery->rec_code }}</td>
											<td align="center">{{ $Recovery->rec_desc }}</td>
											<td align="center">{{ $Recovery->mode }}</td>
											<td align="center"><input type="text" name="recovery_value[{{ $Recovery->rrmid }}]" id="recovery_value_{{ $Recovery->rrmid }}" class="tboxclass" style="width: 50px;" value="{{ $Recovery->rec_value }}" /></td>
										</tr>
									@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>

					<div class="div1 "></div>
					</div>
						@php $AddUrl = 'admin.Units'; @endphp
					<div class="row">
						<div class="div12" align="center">
							<input type="button" name="back" value="Back" class="backbutton" onClick="window.location='{{route($AddUrl)}}'" >
							<input type="submit" class="backbutton" name="btn_save" id="btn_save" value=" Save " />									
							<input type="hidden" name="rrmid" id="rrmid" value="@if(isset($Recovery)){{ encrypt($Recovery->rrmid) }}@endif"/>
							<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
						</div>		
					</div> 
				</blockquote>
			</div>
		</div>
	</div>
</form>


@endsection	

