@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

@php
//dd($data['WorkApproveStatus']);
if(isset($data['WorkStage'])){ 
	$WorkStage = $data['WorkStage'];
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
						<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center"> State List - View </div></div></div>
						<div class="row innerdiv">
							<div class="row">
								
								<div class="row">
									<div class="div3 label">
										Work Name <span class="reqindi">*</span>
									</div>
									<div class="div5">
										<select name="work_name" id="work_name" class="tboxclass" style="height: 30px;" tabindex="1" >
											<option value="">--------------- Select --------------- </option>
											@if(isset ($data['WorkApproveStatus']))
												@if(isset($WorkStage) && $WorkStage == 'BDES')
													@foreach($data['WorkApproveStatus'] as $key => $value)
														<option value="{{ encrypt($value->desid) }}">{{ $value->work_name }} - {{$value->ext_dev_sub_item_created_at}}</option>
													@endforeach
												@else
													@foreach($data['WorkApproveStatus'] as $key => $value)
														<option value="{{ encrypt($value->globid) }}">{{ $value->work_name }}</option>
													@endforeach
												@endif												
											@endif
										</select>
									</div>
								</div>
								<div class="row">
									<div class="div3 label">
										Remarks<span class="reqindi">*</span>
									</div>
									<div class="div5">
									<input type="text" name="txt_remarks" id="txt_remarks" maxlength="50" class="tboxclass">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="div1 "></div>
					</div>
					<div class="div12" align="center">
						@php $AddUrl = 'admin.PreApprovedFiles'; @endphp
						<input type="submit" class="backbutton" data-type="submit" name="btn_save" id="btn_save" value="Approve" />
						<input type="button" class="backbutton" name="Back" id="Back" value="Back" onClick="window.location='{{ route($AddUrl) }}'"/>
						<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
						@if(isset ($data['WorkStage']))
							<input type="hidden" name="work_stage" id="work_stage" value="@if(isset($data['WorkStage'])){{ $data['WorkStage']}}@endif" />
						@endif

               		</div>
				</blockquote>
			</div>
		</div>
	</div>
</form>
<script>
	$('#work_name').chosen();

	function edit(url) {
		window.location.href = url;
	}
</script>

@endsection	

