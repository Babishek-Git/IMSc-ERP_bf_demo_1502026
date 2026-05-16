@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@php

 if(isset($data['EditSDData'])){
	$EditSDData    = $data['EditSDData'];
    $SDPO          = collect($EditSDData)->pluck('sd_po')->first();
    $POId          = collect($EditSDData)->pluck('po_id')->first();
	$SDPercentage  = collect($EditSDData)->pluck('sd_po_percentage')->first();
	$SDAmount      = collect($EditSDData)->pluck('sd_po_amount')->first();
	$SDMode        = collect($EditSDData)->pluck('sd_po_mode')->first();
	$Instrumentdate= collect($EditSDData)->pluck('instrument_date')->first();
    $InstrumentNo  = collect($EditSDData)->pluck('instrument_no')->first();
    $InstrumentAmt = collect($EditSDData)->pluck('instrument_amount')->first();
    $InstrumentBank= collect($EditSDData)->pluck('instrument_bank')->first();
    $InstrumentVal = collect($EditSDData)->pluck('instrument_validity')->first();
    $SDRevDate     = collect($EditSDData)->pluck('sdpo_received_date')->first();
    $POName        = collect($EditSDData)->pluck('work_name')->first();
    $PODate        = collect($EditSDData)->pluck('work_order_date')->first();
    $POCost        = collect($EditSDData)->pluck('work_order_cost')->first();
}
if(isset($data['PODetails'])){
	$EditSDData    = $data['PODetails'];
    $POId          = collect($EditSDData)->pluck('work_order_id')->first();
    $POName        = collect($EditSDData)->pluck('work_name')->first();
    $PODate        = collect($EditSDData)->pluck('work_order_date')->first();
    $POCost        = collect($EditSDData)->pluck('work_order_cost')->first();
}
@endphp

<form action="" method="post" enctype="multipart/form-data" name="form">
	<div class="content">
		<div class="title"></div>
		<div class="container_12">
			<div class="grid_12">
				<blockquote class="bq1" style="overflow:auto">
					<div class="container">
						<div class="row plr">
              				<!-- <div class="div1"></div> -->
							<div class="div12 mbtable">
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">SD Entry Form</div></div></div>
								<div class="row innerdiv">
									<div class="row"> 
										<!-- Form Steps --> 
                                        <div class="row smclearrow"></div>
                                        <div class="row smclearrow"></div>
                                        <div class="row" align="right">
                                            <button type="submit" id="btn_save" name="btn_save" class="step-btn" value="Save">Save</button>
                                            <input type="button" class="backbutton" name="btn_back" id="btn_back" value="Back " onclick="window.location='{{ route('sdpo-entry.view-sd') }}'" />
                                        </div>
                                        <div class="row smclearrow"></div>
                                        <div class="row smclearrow"></div>
										<div class="form-step active"> 
                                            <fieldset class="fieldbox">
                                                <input type="hidden" name="sd_po" id="sd_po" value="{{ isset($SDPO) ? $SDPO : 'SD' }}">
												<div class="fieldbox-div">
													<div class="div2 label label">PO Name</div>
													<div class="div2">
														<select name="cmb_po_id" id="cmb_po_id" class="tboxsmclass ChosenInput">
															<option value="">-------- Select------</option>
                                                            @if(isset($data['PODatas']))
															@foreach($data['PODatas'] as $POData)
																<option value="{{$POData->work_order_id}}" {{ $POData->work_order_id == ($POId ?? null) ? 'selected' : '' }}
                                                                    data-date="{{\Carbon\Carbon::parse($POData->work_order_date)->format('d/m/Y')}}" 
                                                                    data-amount="{{$POData->work_order_cost}}">
                                                                    {{$POData->work_name}}
                                                                </option>
															@endforeach
															@endif
															<!-- @if(isset($PODetails))
                                                                @foreach($PODetails as $POData) 
                                                                    <option value="{{$POData->work_order_id}}" {{ $POData->work_order_id == ($POId ?? null) ? 'selected' : '' }}> {{$POData->work_name}}</option>
                                                                @endforeach
															@endif -->
														</select>
													</div>
                                                    <div class="div2 label pd-l-20">PO Date</div>
													<div class="div2"><input type="text" name="txt_po_date" id="txt_po_date" class="tboxsmclass disable" value="@if(isset($PODate)){{Helper::DisplayDateFormat($PODate)}}@endif"></div>
                                                    <div class="div2 label pd-l-20">PO Amount</div>
													<div class="div2"><input type="text" name="txt_po_amount" id="txt_po_amount" class="tboxsmclass disable" value="@if(isset($POCost)){{$POCost}}@endif"></div>                                                                              											
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
                                                    <div class="div2 label">SD %</div>
                                                    <div class="div2"><input type="text" name="txt_sd_percentage" id="txt_sd_percentage" class="tboxsmclass" value="@if(isset($SDPercentage)){{$SDPercentage}}@endif"></div> 
                                                    <div class="div2 label pd-l-20">SD Amount</div>
                                                    <div class="div2"><input type="text" name="txt_sd_amount" id="txt_sd_amount" class="tboxsmclass" value="@if(isset($SDAmount)){{$SDAmount}}@endif"></div> 
                                                    <div class="div2 label pd-l-20">SD Recieved Date</div>
													<div class="div2"><input type="text" name="txt_sd_date" id="txt_sd_date" class="tboxsmclass  datepicker" value="@if(isset($SDRevDate)){{Helper::DisplayDateFormat($SDRevDate)}}@endif"></div>
                                                    <div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
                                                    <div class="div2 label">SD Recieved Mode</div>
													<div class="div2">
														<select name="cmb_sd_mode" id="cmb_sd_mode" class="tboxsmclass ChosenInput">
															<option value="">-------- Select------</option>
															<option value="FD" {{isset($SDMode) && $SDMode == 'FD' ? 'selected' : '' }}>FD</option>
															<option value="BG" {{isset($SDMode) && $SDMode == 'BG' ? 'selected' : '' }}>BG</option>
                                                            <option value="DD" {{isset($SDMode) && $SDMode == 'DD' ? 'selected' : '' }}>DD</option>
                                                            <option value="Bank Cheque"  {{isset($SDMode) && $SDMode == 'Bank Cheque' ? 'selected' : '' }}>Bank Cheque</option>
														</select>
													</div>
                                                    <div class="div2 label pd-l-20" id="instrument_date_label">Instrument Date</div>
													<div class="div2"><input type="text" name="txt_instrument_date" id="txt_instrument_date" class="tboxsmclass datepicker" value="@if(isset($Instrumentdate)){{Helper::DisplayDateFormat($Instrumentdate)}}@endif"></div>
													<div class="div2 label pd-l-20" id="instrument_num_label">Instrument No.</div>
													<div class="div2"><input type="text" name="txt_instrument_no" id="txt_instrument_no" class="tboxsmclass" value="@if(isset($InstrumentNo)){{$InstrumentNo}}@endif"></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
                                                    <div class="div2 label" id="instrument_amt_label">Instrument Amount</div>
													<div class="div2"><input type="text" name="txt_instrument_amount" id="txt_instrument_amount" class="tboxsmclass" value="@if(isset($InstrumentAmt)){{$InstrumentAmt}}@endif"></div>
                                                    <div class="div2 label pd-l-20" id="instrument_bank_label">Instrument Bank</div>
													<div class="div2"><input type="text" name="txt_instrument_bank" id="txt_instrument_bank" class="tboxsmclass" value="@if(isset($InstrumentBank)){{$InstrumentBank}}@endif"></div>
                                                    <div class="div2 label pd-l-20" id="instrument_validity_label">Instrument Valid Date</div>
													<div class="div2"><input type="text" name="txt_instrument_date" id="txt_instrument_date" class="tboxsmclass datepicker" value="@if(isset($InstrumentVal)){{Helper::DisplayDateFormat($InstrumentVal)}}@endif"></div>
                                                    <div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
												</div>
											</fieldset>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
											<div class="row smclearrow"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
						<div class="div12" align="center">
							<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
						</div>
					</div>
                </blockquote>
            </div>
        </div>
    </div>
</form>
<script>
    $('#cmb_po_id').on('change', function () {
        var selectedOption = $(this).find(':selected');

        var poDate = selectedOption.data('date');
        var poAmount = selectedOption.data('amount');

        $('#txt_po_date').val(poDate || '');
        $('#txt_po_amount').val(poAmount || '');

        if (poAmount) {
            $.ajax({
                url: "{{route('SdAndPO.get-sd-percentage')}}",
                type: 'GET',
                data: {
                    amount: poAmount,
                    SDrPO: 'SD'
                },
                success: function (response) {
                    $('#txt_sd_percentage').val(response.percentage || '');
                    var sdAmount = (parseFloat(poAmount) * parseFloat(response.percentage )) / 100;
                    $('#txt_sd_amount').val(sdAmount.toFixed(2));

                }
            });
        } else {
            $('#txt_sd_percentage').val('');
        }
    });

    $('#cmb_sd_mode').on('change', function () {
        var sdMode   = $(this).val();
        var dateText = 'Instrument Date';
        var NumText  = 'Instrument No.';
        var AmtText  = 'Instrument Amount';
        var BankText = 'Instrument Bank';
        var Validity = 'Instrument Valid Date';

        if (sdMode === 'FD') {
            dateText = 'FD Date';
            NumText = 'FD No.';
            AmtText = 'FD Amount';
            BankText = 'FD Bank';
            Validity = 'FD Valid Date';
        } else if (sdMode === 'BG') {
            dateText = 'BG Date';
            NumText = 'BG No.';
            AmtText = 'BG Amount';
            BankText = 'BG Bank';
            Validity = 'BG Valid Date';
        } else if (sdMode === 'DD') {
            dateText = 'DD Date';
            NumText = 'DD No.';
            AmtText = 'DD Amount';
            BankText = 'DD Bank';
            Validity = 'DD Valid Date';
        } else if (sdMode === 'Bank Cheque') {
            dateText = 'Bank Cheque Date';
            NumText = 'Bank Cheque No.';
            AmtText = 'Bank Cheque Amount';
            BankText = 'Cheque Bank';
            Validity = 'Bank Cheque Valid Date';
        }

        $('#instrument_date_label').text(dateText);
        $('#instrument_num_label').text(NumText);
        $('#instrument_amt_label').text(AmtText);
        $('#instrument_bank_label').text(BankText);
        $('#instrument_validity_label').text(Validity);
    });

</script>     

@endsection