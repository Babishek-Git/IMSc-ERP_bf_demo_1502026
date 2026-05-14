@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

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
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">PG Entry Form</div></div></div>
								<div class="row innerdiv">
									<div class="row"> 
										<!-- Form Steps --> 
                                        <div class="row smclearrow"></div>
                                        <div class="row smclearrow"></div>
                                        <div class="row" align="right">
                                            <button type="submit" id="btn_save" name="btn_save" class="step-btn" value="Save">SAVE</button>
                                            <input type="button" class="backbutton" name="btn_back" id="btn_back" value="Back" onclick="window.location='{{ route('sdpo-entry.view-pg') }}'" />
                                        </div>
                                        <div class="row smclearrow"></div>
                                        <div class="row smclearrow"></div>
										<div class="form-step active"> 
                                            <fieldset class="fieldbox">
                                                <input type="hidden" name="sd_po" id="sd_po" value="PG">
												<div class="fieldbox-div">
													<div class="div2 label label">PO Name</div>
													<div class="div2">
														<select name="cmb_po_id" id="cmb_po_id" class="tboxsmclass ChosenInput">
															<option value="">-------- Select------</option>
															@if(isset($data['PODatas']))
															@foreach($data['PODatas'] as $POData)
																<option value="{{$POData->work_order_id}}" 
                                                                    data-date="{{\Carbon\Carbon::parse($POData->work_order_date)->format('d/m/Y')}}" 
                                                                    data-amount="{{$POData->work_order_cost}}">
                                                                    {{$POData->work_name}}
                                                                </option>
															@endforeach
															@endif
														</select>
													</div>
                                                    <div class="div2 label pd-l-20">PO Date</div>
													<div class="div2"><input type="text" name="txt_po_date" id="txt_po_date" class="tboxsmclass disable" value=""></div>
                                                    <div class="div2 label pd-l-20">PO Amount</div>
													<div class="div2"><input type="text" name="txt_po_amount" id="txt_po_amount" class="tboxsmclass disable" value=""></div>                                                                              											
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
                                                    <div class="div2 label">PG %</div>
                                                    <div class="div2"><input type="text" name="txt_pg_percentage" id="txt_pg_percentage" class="tboxsmclass" value=""></div> 
                                                    <div class="div2 label pd-l-20">PG Amount</div>
                                                    <div class="div2"><input type="text" name="txt_pg_amount" id="txt_pg_amount" class="tboxsmclass" value=""></div> 
                                                    <div class="div2 label pd-l-20">PG Received Date</div>
													<div class="div2"><input type="text" name="txt_pg_date" id="txt_pg_date" class="tboxsmclass  datepicker" value=""></div>
                                                    <div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
                                                    <div class="div2 label">PG Recieved Mode</div>
													<div class="div2">
														<select name="cmb_pg_mode" id="cmb_pg_mode" class="tboxsmclass ChosenInput">
															<option value="">-------- Select------</option>
															<option value="FD">FD</option>
															<option value="BG">BG</option>
                                                            <option value="DD">DD</option>
                                                            <option value="Bank Cheque">Bank Cheque</option>
														</select>
													</div>
                                                    <div class="div2 label pd-l-20" id="instrument_date_label">Instrument Date</div>
													<div class="div2"><input type="text" name="txt_instrument_date" id="txt_instrument_date" class="tboxsmclass datepicker" value=""></div>
													<div class="div2 label pd-l-20" id="instrument_num_label">Instrument No.</div>
													<div class="div2"><input type="text" name="txt_instrument_no" id="txt_instrument_no" class="tboxsmclass" value=""></div>
													<div class="row smclearrow"></div>
													<div class="row smclearrow"></div>
                                                    <div class="div2 label" id="instrument_amt_label">Instrument Amount</div>
													<div class="div2"><input type="text" name="txt_instrument_amount" id="txt_instrument_amount" class="tboxsmclass" value=""></div>
                                                    <div class="div2 label pd-l-20" id="instrument_bank_label">Instrument Bank</div>
													<div class="div2"><input type="text" name="txt_instrument_bank" id="txt_instrument_bank" class="tboxsmclass" value=""></div>
                                                    <div class="div2 label pd-l-20" id="instrument_validity_label">Instrument Valid Date</div>
													<div class="div2"><input type="text" name="txt_instrument_date" id="txt_instrument_date" class="tboxsmclass datepicker" value=""></div>
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
                    SDrPO: 'PG'
                },
                success: function (response) {
                    $('#txt_pg_percentage').val(response.percentage || '');
                    var sdAmount = (parseFloat(poAmount) * parseFloat(response.percentage )) / 100;
                    $('#txt_pg_amount').val(sdAmount.toFixed(2));

                }
            });
        } else {
            $('#txt_pg_percentage').val('');
        }
    });

    $('#cmb_pg_mode').on('change', function () {
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