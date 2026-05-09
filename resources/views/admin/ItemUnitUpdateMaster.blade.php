@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@php
    if(isset($data['WorkData'])){
        $WorkData = $data['WorkData'];
        foreach($WorkData as $List){
            $WorkName = $List->work_name;
            if($List->ts_no != NULL && $List->tr_no != NULL && $List->work_order_no != NULL){
                $WorkNo = $List->work_order_no;
                $Data = "Work Order No.";
            }
            else if($List->ts_no != NULL && $List->tr_no != NULL && $List->work_order_no == NULL){
                $WorkNo = $List->tr_no;
                $Data = "Tender No.";
            }
            else if($List->ts_no != NULL && $List->tr_no == NULL && $List->work_order_no == NULL){
                $WorkNo = $List->ts_no;
                $Data = "Technical Sanction No.";
            }
            else{
                $WorkNo = $List->ref_no;
                $Data = "Reference No.";
            }
        }
    }
    if(isset($data['ESTDetail'])){
        $ESTDetails = $data['ESTDetail'];
    }
    if(isset($data['BidderData'])){
        $BidderData = $data['BidderData'];
    }
    if(isset($data['ScheduleData'])){
        $ScheduleData = $data['ScheduleData'];
    }
    if(isset($data['UnitArr'])){
        $UnitArr = $data['UnitArr'];
    }
    if(isset($data['ContArr'])){
        $ContArr = $data['ContArr'];
    }
@endphp
<style>
    .tooltip-l {
		position: relative;
		display: inline;
	}
    .rbadge1{
		margin-right:2px;
	}
</style>
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
						<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center"> Item Unit Update Master - View </div></div></div>
						<div class="row innerdiv">
							<div class="row">
								<table class="table-bordered dataTable table1" align="center" id="dataTable">
									<thead>
                                        <tr>
											<th colspan="6" style="border:0px; font-size:10px">
											Work Name : {{$WorkName}}
											</th>
										</tr>
                                        <tr>
                                        @if(isset($WorkNo))
                                            @if(isset($Data))
                                            <th colspan="6" style="border:0px; font-size:10px">
										        {{$Data}} : {{$WorkNo}}
										    </th>
                                            @endif
                                        @endif
                                        </tr>
										<tr>
											<th class="colhead" style="text-align:center">Item No.</th>
											<th class="colhead" style="text-align:center">Description</th>
											<th class="colhead" style="text-align:center">Quantity</th>
											<th class="colhead" style="text-align:center">Unit</th>
											<th class="colhead" style="text-align:center">Rate</th>
											<th class="colhead" style="text-align:center">Amount</th>
										</tr>
									</thead>
									<tbody>
                                    @if(isset($ESTDetails))
                                        <tr>
                                            <td align="center" style='border-left: 1px solid white; border-right: 1px solid white; vertical-align: bottom;' colspan="6"><span class="rbadge1 rbadgeD tooltip-l"><b>Estimate </b></span></td>
                                        </tr>
                                        @foreach($ESTDetails as $key=>$value)
										<tr>
											<td align="center">{{$value->est_item_no}}</td>
											<td align="left">{{$value->est_item_desc}}</td>
                                            <td align="left">{{$value->est_item_qty}}</td>
                                            <td align="left">
                                                @php $common_item_id = $value->est_item_no; @endphp
                                                <select name="cmb_unit_list" class="textboxdisplay cmb_unit_list cmb_unit_est" data-commonitem="{{ $common_item_id }}" style="width:100px;height:30px">
												    <option>-- Select --</option>
                                                    @if(isset($data['AllUnitData']))
                                                        @foreach($data['AllUnitData'] as $key=>$unit)
                                                            @php
                                                            $SelStr = "";
                                                            if($value->est_item_unit == $unit->unitid){
                                                                $SelStr = 'selected="selected"';
                                                            }
                                                            @endphp
                                                            <option value="{{$unit->unitid}}" {{$SelStr}}>{{$unit->unit_name}}</option>
                                                        @endforeach
                                                    @endif
											    </select>
                                                <input type="hidden" name="hid_partaid" id="hid_partaid" value="{{encrypt($value->partabdetid)}}">     
                                            </td>
                                            <td align="left">{{$value->est_supply_rate}}</td>
                                            <td align="left">{{$value->est_item_amount}}</td>
										</tr>
                                        @endforeach
                                    @endif
                                    @if(isset($BidderData))
                                        @if($ScheduleData != NULL)
                                            <tr><td align="center" style="border-left: 1px solid white; border-right: 1px solid white; vertical-align: bottom;" colspan="6"><span class="rbadge1 rbadgeG tooltip-l"><b>Price Bid </b></span></td></tr>
                                        @endif
                                        @foreach($BidderData as $key=>$value)
                                        <tr>
                                            @if(isset($ContArr))
                                                <td align="left" colspan="6"><span class="rbadge1 rbadgeG tooltip-l"><b>{{$ContArr[$value->contid]}}</span><span class="rbadge1 rbadgeF tooltip-l">L{{$value->bidder_status}}</b></span></td>
                                            @endif
                                        </tr>
										<tr>
											<td align="center">{{$value->item_no}}</td>
											<td align="left">{{$value->item_desc}}</td>
                                            <td align="left">{{$value->item_qty}}</td>
                                            <td align="left">
                                                @php $common_item_id = $value->item_no; @endphp
                                                <select name="cmb_unit_boq" class="textboxdisplay cmb_unit_list" data-commonitem="{{ $common_item_id }}" style="width:100px;height:30px">
												    <option>-- Select --</option>
                                                    @if(isset($data['AllUnitData']))
                                                        @foreach($data['AllUnitData'] as $key=>$unit)
                                                            @php
                                                            $SelStr = "";
                                                            if($value->item_unit == $unit->unitid){
                                                                $SelStr = 'selected="selected"';
                                                            }
                                                            @endphp
                                                            <option value="{{$unit->unitid}}" {{$SelStr}}>{{$unit->unit_name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <input type="hidden" name="hid_bdid[]" id="hid_bdid" value="{{encrypt($value->bdid)}}">  
                                            </td>
                                            <td align="left">{{$value->item_rate}}</td>
                                            <td align="left">{{$value->item_amount}}</td>
										</tr>
                                        @endforeach
                                    @endif
                                    @if(isset($ScheduleData))
                                        @if($ScheduleData != NULL)
                                        <tr>
                                            <td align="center" style='border-left: 1px solid white; border-right: 1px solid white; vertical-align: bottom;' colspan="6"><span class="rbadge1 rbadgeL tooltip-l"><b> BoQ </b></span></td>
                                        </tr>
                                        @endif
                                        @foreach($ScheduleData as $key=>$value)
										<tr>
											<td align="center">{{$value->s_itemno}}</td>
											<td align="left">{{$value->description}}</td>
                                            <td align="left">{{$value->total_quantity}}</td>
                                            <td align="left">
                                            @php $common_item_id = $value->s_itemno; @endphp
                                                <select name="cmb_unit_schdule" class="textboxdisplay cmb_unit_list" data-commonitem="{{ $common_item_id }}" style="width:100px;height:30px">
												    <option>-- Select --</option>
                                                    @if(isset($data['AllUnitData']))
                                                        @foreach($data['AllUnitData'] as $key=>$unit)
                                                            @php
                                                            $SelStr = "";
                                                            if($value->unitid == $unit->unitid){
                                                                $SelStr = 'selected="selected"';
                                                            }
                                                            @endphp
                                                            <option value="{{$unit->unitid}}" {{$SelStr}}>{{$unit->unit_name}}</option>
                                                        @endforeach
                                                    @endif
											    </select>
                                                <input type="hidden" name="hid_itemid" id="hid_itemid" value="{{encrypt($value->s_itemid)}}">
                                            </td>
                                            <td align="left">{{$value->rate}}</td>
                                            <td align="left">{{$value->total_amt}}</td>
										</tr>
                                        @endforeach
                                    @endif

									</tbody>
								</table>
							</div>
						</div>
					</div>


					<div class="div1 "></div>
					</div>
						@php $AddUrl = 'admin.ItemUnitModifWork'; @endphp 
					<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
						<div class="buttonsection">
							<input type="button" name="back" value="Back" class="backbutton" onClick="window.location='{{route($AddUrl)}}'" >
						</div>
                        <div class="buttonsection">
                            <input type="submit" class="backbutton" name="btn_save" id="btn_save" value=" Save "/>																
						</div>
                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
						</div>
					</div>
				</blockquote>
			</div>
		</div>
	</div>
</form>
<script>
	function edit(url) {
		window.location.href = url;
	}

	$(document).ready(function() {
		$(".cmb_unit_list").chosen();

	});

    $("body").on("change", ".cmb_unit_list", function () {
        var selectedValue = $(this).val();
        var commonItemId = String($(this).data("commonitem"));

        $(".cmb_unit_list").each(function () {
            if (String($(this).data("commonitem")) === commonItemId) {
                $(this).val(selectedValue).trigger("chosen:updated"); // ✅ important!
            }
        });
    });
    var KillSaveEvent = 0;
    $("body").on("click","#btn_save", function(event){
        if(KillSaveEvent == 0){
            var UnitName = $(".cmb_unit_list").val();
            if(UnitName == "-- Select --"){
                BootstrapDialog.alert("Please select the Unit Name..!");
				event.preventDefault();
				event.returnValue = false;
            }
            else{
                event.preventDefault();
			    BootstrapDialog.confirm({
				    title: 'Confirmation Message',
				    message: 'Are you sure want to update unit name?',
				    closable: false, // <-- Default value is false
				    draggable: false, // <-- Default value is false
				    btnCancelLabel: 'Cancel', // <-- Default value is 'Cancel',
				    btnOKLabel: 'Ok', // <-- Default value is 'OK',
				    callback: function(result) {
				    	if(result){
				    		KillSaveEvent = 1;
				    		$("#btn_save").trigger( "click" );
				    	}else {
				    		KillSaveEvent = 0;
				    	}
				    }
			    });
            }
        }
    });
	
</script>

@endsection	

