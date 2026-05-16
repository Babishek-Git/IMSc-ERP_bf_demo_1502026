@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

<body class="page1" id="top" oncontextmenu="return false" onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
	<form action="" method="post" enctype="multipart/form-data" name="form">
		<div class="content">
			<div class="title"></div>
			<div class="container_12">
				<div class="grid_12">
					<blockquote class="bq1" style="overflow:auto">
						<div class="container">
							<div class="row">
								<div class="row smclearrow"></div>  
								<div class="row smclearrow"></div>
								<div class="row smclearrow"></div>  
								<div class="row smclearrow"></div>
								<div class="div2">&nbsp;</div>
								<div class="div8 mbtable">
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Budget Reports - Revenue & Object Head Consolidated</div></div></div>
									<div class="div12">
										<div class="row innerdiv">
											
										@if(isset($GiaData))
											@foreach($GiaData as $Gia)
												@php 
												$ApplicableTo = $Gia->applicable_to;
												$GiaObjectHeadGrpData = [];
												if(isset($ObjectHeadGiaMapgrpData[$Gia->gia_id])){
													$GiaObjectHeadData = $ObjectHeadGiaMapgrpData[$Gia->gia_id];
													if(filled($GiaObjectHeadData)){
														$GiaObjectHeadGrpData = collect($GiaObjectHeadData)->groupBy('object_head_id');
													}
												}
												$GiaSanctionedTotal = 0; $GiaExpenditureTotal = 0; $Sno = 1;
												@endphp
												@if($ApplicableTo != 'PROJECT') 
													
														
															
															<table class="attTable">
																<thead>
																	<tr><th colspan="5">{{ $Gia->gia_name }} - Object Head Wise Expenditure Upto {{ isset($ToDate) ? Helper::DisplayDateFormat($ToDate) : '' }}</th></tr>
																	<tr>
																		<th>S.No.</th>
																		<th style="text-align:center">Object Head</th>
																		<th style="text-align:center">Total Sanctioned <br/>( &#8377; )</th>
																		<th style="text-align:center">Total Expenditure <br/>( &#8377; )</th>
																		<th style="text-align:center">Overall Balance Available w.r.t. Total Sanctioned</br>( &#8377; )</th>
																	</tr>
																</thead>
																<tbody>
																	@if(isset($ObjectHeadData) && filled($ObjectHeadData))
																		@foreach($ObjectHeadData as $ObjectHead)
																			@php
																			$IsMapped = 0; $IsSubCataApplicable = false; $GiaObjectHeadMapId = '';
																			if(isset($GiaObjectHeadGrpData[$ObjectHead->object_head_id])){
																				$GiaObjectHeadMapData = $GiaObjectHeadGrpData[$ObjectHead->object_head_id];
																				if(filled($GiaObjectHeadMapData)){
																					$IsSubCataApplicable = $GiaObjectHeadMapData->pluck('is_sup_cata_applicable')->first();
																					$GiaObjectHeadMapId  = $GiaObjectHeadMapData->pluck('oh_gia_mapp_id')->first();
																					$IsMapped = 1;
																				}
																			}
																			$SubCataDataCount = 0; $SubCataData = [];
																			if($IsMapped == 1 && isset($ObjectHeadSubCataGrpData[$ObjectHead->object_head_id])){
																				$SubCataData      = $ObjectHeadSubCataGrpData[$ObjectHead->object_head_id];
																				$SubCataDataCount = count($SubCataData);
																			}
																			@endphp
																			@if($IsMapped == 1)
																				@if(($SubCataDataCount > 0) && ($IsSubCataApplicable == true))
																				
																					<tr class="lom-tr-grp">
																						<td class="lom-td-sno"><span class="lom-sno-sq">{{ $Sno }}</span></td>
																						<td class="lom-td-obj" colspan="4">{{ $ObjectHead->object_head_name }}</td>
																					</tr>
																					@php $i = 1; @endphp
																					@foreach($SubCataData as $ObjectHeadSubCata)
																						@php
																						$ObjectHeadSanctionAmt = 0;
																						if(isset($RevenueObjectHeadSanctionData)){ 
																							$ObjeadHeadSancData = $RevenueObjectHeadSanctionData
																							->where('gia_id', $Gia->gia_id)
																							->where('object_head_id', $ObjectHead->object_head_id)
																							->where('oh_sub_cata_id', $ObjectHeadSubCata->oh_sub_cata_id);
																							if(filled($ObjeadHeadSancData)){
																								$ObjectHeadSanctionAmt = collect($ObjeadHeadSancData)->pluck('sanctioned_amount')->first();
																							}
																						}
																						if($ObjectHeadSanctionAmt != NULL){
																							$ObjectHeadSanctionAmt = $ObjectHeadSanctionAmt * 100000;
																						}
																						$ExpenditureAmount = 0;
																						if(isset($PaymentData)){
																							$ExpenditureData = $PaymentData
																							->where('gia_id', $Gia->gia_id)
																							->where('object_head_id', $ObjectHead->object_head_id)
																							->where('object_head_sub_cata_id', $ObjectHeadSubCata->oh_sub_cata_id);
																							if(filled($ExpenditureData)){
																								$ExpenditureAmount = collect($ExpenditureData)->pluck('total_amount')->first();
																							}
																						}
																						$BalanceAmount = $ObjectHeadSanctionAmt - $ExpenditureAmount;

																						$GiaSanctionedTotal = $GiaSanctionedTotal + $ObjectHeadSanctionAmt;
																						$GiaExpenditureTotal = $GiaExpenditureTotal + $ExpenditureAmount;


																						
																						@endphp
																						<tr class="lom-tr-sub">
																							<td class="lom-td-sno" align="center"><span class="lom-sno-rom">({{ Helper::toRoman($i) }})</span></td>
																							<td class="lom-td-obj lom-td-obj--sub">{{ $ObjectHeadSubCata->oh_sub_cata_name }}</td>
																							<td class="lom-td-led" align="right">{{ isset($ObjectHeadSanctionAmt) ? Helper::IndianMoneyFormat($ObjectHeadSanctionAmt) : '' }}</td>
																							<td class="lom-td-led" align="right">{{ Helper::IndianMoneyFormat($ExpenditureAmount) }}</td>
																							<td class="lom-td-led" align="right">{{ Helper::IndianMoneyFormat($BalanceAmount) }}</td>
																						</tr>
																						@php $i++; @endphp
																					@endforeach
																				@else
																					@php
																					$ObjectHeadSanctionAmt = 0;
																					if(isset($RevenueObjectHeadSanctionData)){
																						$ObjeadHeadSancData = $RevenueObjectHeadSanctionData
																							->where('gia_id', $Gia->gia_id)
																							->where('object_head_id', $ObjectHead->object_head_id); 
																						if(filled($ObjeadHeadSancData)){
																							$ObjectHeadSanctionAmt = collect($ObjeadHeadSancData)->pluck('sanctioned_amount')->first();
																						}
																					}
																					if($ObjectHeadSanctionAmt != NULL){
																						$ObjectHeadSanctionAmt = $ObjectHeadSanctionAmt * 100000;
																					}
																					$ExpenditureAmount = 0;
																					if(isset($PaymentData)){
																						$ExpenditureData = $PaymentData
																						->where('gia_id', $Gia->gia_id)
																						->where('object_head_id', $ObjectHead->object_head_id);
																						if(filled($ExpenditureData)){
																							$ExpenditureAmount = collect($ExpenditureData)->pluck('total_amount')->first();
																						}
																					}
																					$BalanceAmount = $ObjectHeadSanctionAmt - $ExpenditureAmount;
																					$GiaSanctionedTotal = $GiaSanctionedTotal + $ObjectHeadSanctionAmt;
																					$GiaExpenditureTotal = $GiaExpenditureTotal + $ExpenditureAmount;
																					@endphp
																					<tr>
																						<td class="lom-td-sno" align="center"><span class="lom-sno-num">{{ $Sno }}</span></td>
																						<td class="lom-td-obj">{{ $ObjectHead->object_head_name }}</td>
																						<td class="lom-td-led" align="right">{{ isset($ObjectHeadSanctionAmt) ? Helper::IndianMoneyFormat($ObjectHeadSanctionAmt) : '' }}</td>
																						<td class="lom-td-led" align="right">{{ Helper::IndianMoneyFormat($ExpenditureAmount) }}</td>
																						<td class="lom-td-led" align="right">{{ Helper::IndianMoneyFormat($BalanceAmount) }}</td>
																						</tr>
																					</tr>
																				@endif
																				@php $Sno++; @endphp
																			@endif
																		@endforeach
																	@endif
																</tbody>
																@php 
																$GiaBalanceTotal = $GiaSanctionedTotal - $GiaExpenditureTotal;
																@endphp
																<tfoot>
																	<tr>
																		<th style="text-align:right" colspan="2">Total ( &#8377; )</th>
																		<th style="text-align:right">{{ Helper::IndianMoneyFormat($GiaSanctionedTotal) }}</th>
																		<th style="text-align:right">{{ Helper::IndianMoneyFormat($GiaExpenditureTotal) }}</th>
																		<th style="text-align:right">{{ Helper::IndianMoneyFormat($GiaBalanceTotal) }}</th>
																	</tr>
																</tfoot>
															</table>
															<div class="row smclearrow"></div> 
															<div class="row smclearrow"></div> 
															<div class="row smclearrow"></div>  
														
													
												@endif

											@endforeach
										@endif
											
											
										</div>
										<div class="row smclearrow"></div>  
										<div class="row smclearrow"></div>  
										<div class="row smclearrow"></div>  
										<div class="row smclearrow"></div>
									</div>
								</div>	
								<div class="div2">&nbsp;</div>
								<div class="row smclearrow"></div>  
								<div class="row smclearrow"></div>  
								<div class="row" align="center">
									@php $BackUrl = "budget-reports.budget-reports"; @endphp
									<button type="button" id="Back" name="Back" onclick="window.location='{{ route($BackUrl)}}'" class="backbutton">Back</button>
								</div>
								<div class="row smclearrow"></div>  
								<div class="row smclearrow"></div>
							</div>                           
						</div>
					</blockquote>
				</div>
			</div>
		</div>
	</form>
</body>	
@endsection
