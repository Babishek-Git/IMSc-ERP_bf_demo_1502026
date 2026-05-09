@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')


@if(isset($data['RowCount']))
	@php
		$RowCount = $data['RowCount'];
	@endphp
@endif
@if(isset($data['PGDataArr']))
	@php
		$PGDataArr = $data['PGDataArr'];
	@endphp
@endif
@if(isset($data['RowSpanArr']))
	@php
		$RowSpanArr = $data['RowSpanArr'];
	@endphp
@endif
@if(isset($data['TrNumArr']))
	@php
		$TrNumArr = $data['TrNumArr'];
		//dd($TrNumArr);
	@endphp
@endif
@if(isset($data['WrkNameArr']))
	@php
		$WrkNameArr = $data['WrkNameArr'];
	@endphp
@endif

<link rel="stylesheet" href="dashboard/MyView/bootstrap.min.css">
<script src="dashboard/MyView/bootstrap.min.js"></script>
<script type="text/javascript" language="javascript"></script>
        <!--==============================header=================================-->
<form action="" method="post" enctype="multipart/form-data" name="form" id="form1">
            <!--==============================Content=================================-->
	<div class="content">
		<div class="title"></div>
		<div class="container_12">
			<div class="grid_12">
				<div align="right"></div>
				<blockquote class="bq1" style="overflow:auto">
					<div class="container" align="center">
						<div class="div1 "></div>
						<div class="div10 mbtable" align="center">
							<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center"> PG Details </div></div></div>
							<div class="row innerdiv">
								<div class="row">

									<table width="100%" align="center" class="dataTable table2excel mgtb-8">
										<thead>
											<tr>
												<th rowspan="2" valign="middle">SNo.</th>
												<th rowspan="2" valign="middle">Tender No.</th>
												<th rowspan="2" valign="middle">LOI No.</th>
												<th rowspan="2" valign="middle">Name of Work</th>
												<th rowspan="2" valign="middle">Contractor Name</th>
												<th colspan="5" valign="middle" style="text-align:center;">PG Detail</th>
												<!-- <th rowspan="2" valign="middle">Action</th> -->
											</tr>
											<tr>
												<th valign="middle">Instrument Type</th>
												<th valign="middle">Instrument No.</th>
												<th valign="middle">Date of Issue</th>
												<th valign="middle">Date of Expiry</th>
												<th valign="middle">Amount</th>
											</tr>
										</thead>
										<tbody>
											@php $SNO = 1; $PrevTrId=""; $PrevContId="";
											if($RowCount == 1){ foreach($PGDataArr as $PGkey => $PGValue){ 
												$ContRowSpan = $RowSpanArr[$PGValue->tr_id][$PGValue->contid];
												$RowSpanArr1 = $RowSpanArr[$PGValue->tr_id];
												$TrRowspan = array_sum($RowSpanArr1);
												if($PrevTrId != $PGValue->tr_id){
													$x = 0; $PrevContId = ""; $y = 0;
												}
												if($PrevContId != $PGValue->contid){
													$y = 0;
												}
												if($x == 0){ 
													
											@endphp
											<tr class='labeldisplay'>
												<td rowspan= '{{ $TrRowspan }}' class='tdrowbold' valign='middle' align='center'>@php echo $SNO; @endphp</td>
												@php
												$TrNoDisp = "";
												if((count($TrNumArr) != 0)&&(count($TrNumArr) > 0)){
													if(isset($TrNumArr[$PGValue->tr_id])){
														$TrNoDisp = $TrNumArr[$PGValue->tr_id];
													}
													else{
														$TrNoDisp = NULL;
													}
													
												}
												$WorkNameDisp = "";
												if((count($WrkNameArr) != 0)&&(count($WrkNameArr) > 0)){
													if(isset($WrkNameArr[$PGValue->tr_id])){
														$WorkNameDisp = $WrkNameArr[$PGValue->tr_id];
													}
													else{
														$WorkNameDisp = NULL;
													}
													
												}
												@endphp
												<td rowspan= '{{ $TrRowspan }}' valign='middle' class='tdrow' align = 'center'>
												{{ $TrNoDisp }}
												</td>
												<td rowspan= '{{ $TrRowspan }}' valign='middle' class='tdrow' align = 'justify'>@php echo $PGValue->loa_no; @endphp</td>

												<td rowspan= '{{ $TrRowspan }}' valign='middle' class='tdrow' align = 'justify'>
												{{ $WorkNameDisp }}
												</td>
												<td rowspan= '{{ $ContRowSpan }}' class='tdrow' align='left' valign='middle'>@php echo $PGValue->name_contractor; @endphp</td>
												<td class='tdrow' align='center' valign='middle'>@php echo $PGValue->inst_type; @endphp</td>
												<td class='tdrow' align='left' valign='middle'>@php echo $PGValue->inst_serial_no; @endphp</td>
												<td class='tdrow' align='center' valign='middle'>@php echo $PGValue->inst_date; @endphp</td>
												<td class='tdrow' align='center' valign='middle'>@php echo $PGValue->inst_exp_date; @endphp</td>
												<td class='tdrow' align='right' valign='middle'>@php echo $PGValue->inst_amt; @endphp</td>
												<!-- @php if(($PGValue->inst_status == 'ACC') || ($PGValue->inst_status == 'R')){ @endphp
													<td rowspan= '{{ $ContRowSpan }}' class='tdrow' align='right' valign='middle' nowrap='nowrap'>
														<a href = "#" id="btn_edit" name="btn_edit" class="btn btn-info"> EDIT </a>
													</td>
												@php }else{ @endphp
													<td rowspan= '{{ $ContRowSpan }}' class='tdrow' align='right' valign='middle' nowrap='nowrap'>
														<a href = "{{ route('admin.pgentry') }}" data-id="{{ $PGValue->master_id }}-{{ $PGValue->contid }}" id="btn_edit" name="btn_edit" class="btn btn-info"> EDIT </a>
													</td>
												@php } @endphp -->
											</tr>
											@php 
													$x++; $y++;  $SNO++;
												}else{
											@endphp
											<tr class='labeldisplay'>
												@php if($y == 0){ @endphp
													<td rowspan= '{{ $ContRowSpan }}' class='tdrow' align='left' valign='middle'>@php echo $PGValue->name_contractor; @endphp</td>
												@php } @endphp
												<td class='tdrow' align='center' valign='middle'>@php echo $PGValue->inst_type; @endphp</td>
												<td class='tdrow' align='left' valign='middle'>@php echo $PGValue->inst_serial_no; @endphp</td>
												<td class='tdrow' align='center' valign='middle'>@php echo $PGValue->inst_date; @endphp</td>
												<td class='tdrow' align='center' valign='middle'>@php echo $PGValue->inst_exp_date; @endphp</td>
												<td class='tdrow' align='right' valign='middle'>@php echo $PGValue->inst_amt; @endphp</td>
											</tr>
												@php 
													$x++; $y++;
												}
											@endphp
											@php $PrevTrId = $PGValue->tr_id; $PrevContId = $PGValue->contid; 
										} 
									}else{ 
											@endphp
											<tr class='labeldisplay'>
												<td colspan="10" class='tdrow' align='center' valign='middle'> No records found..!! </td>
											</tr>
									@php } @endphp
										</tbody>
									</table>

								</div>
							</div>
							<!-- <div align="center">
								<input type="button" class="btn btn-info" name="exportToExcel" id="exportToExcel" value="Export - Excel" />
								<a data-url="Home" class="btn btn-info" name="btn_back" id="btn_back"> Back </a>
							</div>
							<div class="div12 "></div> -->
						</div>
						<div class="div1 "></div>
					</div>
				</blockquote>
			</div>
		</div>
	</div>
</form>
<!--==============================footer=================================-->
<script src="js/jquery.hoverdir.js"></script>
<script>
$(document).ready(function(){ 

	$("#exportToExcel").click(function(e){ 
		var table = $('body').find('.table2excel');
		if(table.length){ 
			$(table).table2excel({
				exclude: ".noExl",
				name: "Excel Document Name",
				filename: "PG Details-" + new Date().toISOString().replace(/[\-\:\.]/g, "") + ".xls",
				fileext: ".xls",
				exclude_img: true,
				exclude_links: true,
				exclude_inputs: true
			});
		}
	});
});
</script>

@endsection