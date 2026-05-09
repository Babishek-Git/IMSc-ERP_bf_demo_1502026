@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

@php
if(isset($data['workedit'])){
    foreach($data['workedit'] as $sdata){
        $TechSacNo = $sdata->tr_id;
        $WorkName = $sdata->work_name;
        $ShortName = $sdata->short_name;
        $WorkOrderNo = $sdata->work_order_no;
        $TechsanctionNo = $sdata->tech_sanction;
        $ContractorName = $sdata->name_contractor;
        $ComputerCodeNo = $sdata->computer_code_no;
        $AgreementNo = $sdata->agree_no;
        $PIN = $sdata->pinid;
        $HOA = $sdata->hoa;
        $WorkType = $sdata->worktype;
        $WorkOrderDate = $sdata->work_order_date;
        $WorkCommenceDate = $sdata->work_commence_date;
        $DateOfCompletion = $sdata->date_of_completion;
        $Rebatepercent = $sdata->rebate_percent;
    }
}
@endphp

        <!--==============================header=================================-->
<form action="{{ route('admin.saveagreementsheetentry') }}" method="post" enctype="multipart/form-data" name="form">
<div class="content">
    <div class="title"></div>
    <div class="container_12">
        <div class="grid_12">
            <blockquote class="bq1" style="overflow-y:scroll">
                <div class="container">
                    <div class="row">
                        <div class="div2">&nbsp;</div>
                        <div class="div8 mbtable">
                            <div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Work Order Entry</div></div></div>
                            <input type="hidden" name="hid_sheetid" id="hid_sheetid" value="<?php //if($_GET['sheetid'] != ''){ echo $_GET['sheetid']; } ?>">
                            <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0" class="color1">
                                <tr><td width="18%">&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Tender No.</td>
                                    <td class="labeldisplay">
                                        <!--    <select id="cmb_tr_no" name="cmb_tr_no" class="tboxclass" required>
                                            <option value=""> ----- Select ----- </option>
                                            @if(isset($data['Tender'] ))
                                                @foreach($data['Tender'] as $TsNum)
                                                    @php
                                                    if((isset($TechSacNo))&&($TechSacNo== $TsNum->tr_id)){
                                                        $SelStr = 'selected="selected"';
                                                    }else{
                                                        $SelStr = '';
                                                    }
                                                    @endphp
                                                    <option value="{{ $TsNum->tr_id }}"{{$SelStr;}}> {{ $TsNum->tr_no }} </option>
                                                @endforeach
                                            @endif
                                        </select>   -->
                            <input type="text" name="cmb_tr_no" id="cmb_tr_no" class="tboxclass" required value="" style="width: 465px;">
									</td>
                                </tr>
                                <!-- <tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_wname" style="color:red" colspan="">&nbsp;</td></tr> -->
							    <tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Name of Work</td>
                                    <td><textarea name='txt_work_name' id='txt_work_name' required class="tboxclass" rows="6" style="width: 465px;">@if(isset($WorkName)){{ $WorkName; }}@endif</textarea></td>
                                </tr>
                                <!-- <tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_wname" style="color:red" colspan="">&nbsp;</td></tr> -->
                                <tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Short Name of Work</td>
                                    <td><input type="text" name='shortname' required id='shortname' class="tboxclass" value="@if(isset($ShortName)){{ ($ShortName); }}@endif" style="width: 465px;"></td>
                                </tr>
                                <!-- <tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="val_woredrno" style="color:red" colspan="">&nbsp;</td></tr> -->
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Technical Sanction No. </td>
                                    <td><input type="text" name='techsanctionno' required id='techsanctionno' class="tboxclass" value="@if(isset($TechsanctionNo)){{ ($TechsanctionNo); }}@endif" style="width: 465px;"></td>
                                    <input type="hidden" name='hid_tsid' required id='hid_tsid' class="tboxclass" value="@if(isset($TechsanctionNo)){{ ($TechsanctionNo); }}@endif" style="width: 465px;"></td>
                                </tr>
                                <!-- <tr><td>&nbsp;</td><td>&nbsp;</td><td align="center" class="labeldisplay" id="val_shortname" style="color:red" colspan="">&nbsp;</td></tr> -->
								<tr> 
                                    <td>&nbsp;</td>
                                    <td class="label">Work Order No.</td> 
                                    <td><input type="text"  name='workorderno' required id='workorderno' class="tboxclass" value="@if(isset($WorkOrderNo)){{ ($WorkOrderNo); }}@endif" style="width: 465px;"></td>
                                </tr>
                               
                                <!-- <tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="val_techsno" style="color:red" colspan="">&nbsp;</td></tr> -->
                                <tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Agreement No.</td>
                                    <td> <input type="text" name='agreementno' required id='agreementno' class="tboxclass"  value="@if(isset($AgreementNo)){{ ($AgreementNo); }}@endif" style="width: 465px;"></td>
                                </tr>
                                <!-- <tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="val_aggno" style="color:red" colspan="">&nbsp;</td></tr> -->
                                <tr> 
                                    <td>&nbsp;</td>
                                    <td class="label">Name of the contractor</td>
                                    <td>
									<!--<input type="text" name='contractorname' id='contractorname' class="textboxdisplay" value="" style="width:400px;">-->
									<select name='cmb_bidder' id='cmb_bidder' required class="tboxclass" style="width: 468px;" required>
                                    <option value> ------------ Select -----------</option>
									@if(isset($data['Bidder'] ))
                                        @foreach($data['Bidder'] as $Contractor)
											@php
											if((isset($ContractorName))&&($ContractorName == $Contractor->contid)){
												$SelStr = 'selected="selected"';
											}else{
												$SelStr = '';
											}
											@endphp
											<option value="{{ $Contractor->contid; }}" {{ $SelStr; }}> {{ $Contractor->name_contractor; }} </option>
										@endforeach
									@endif
                                    @php $AddUrl = 'admin.agreementsheetentry'; @endphp
									<!-- &nbsp;<input type="button" name="add_new_cont" id="add_new_cont" class="buttonstyle" value=" + New " onClick="window.location='{{ route($AddUrl) }}'"> -->
									</td>
                                </tr>
                                <!-- <tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="val_conname" style="color:red" colspan="">&nbsp;</td></tr> -->
                                <tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Computer Code No. </td>
                                    <td><input type="text" name='computercodeno' id='computercodeno' required class="tboxclass" value="@if(isset($ComputerCodeNo)){{ ($ComputerCodeNo); }}@endif" style="width: 465px;"></td>
                                </tr>
                                <!-- <tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="val_systemcodeno" style="color:red" colspan="">&nbsp;</td></tr> -->
							    <tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Pin Number </td>
                                    <td class="">
										<select name='cmb_pin[]' id='cmb_pin' class="tboxclass"  style="width: 400px;" multiple="multiple">
											<!-- <option value="">--------------- Select ---------------</option> -->
                                            @if(isset($data['PinEntry']))
                                                @foreach($data['PinEntry'] as $Pin)
                                                    @php
                                                    if((isset($PIN))&&($PIN == $Pin->pinid)){
                                                        $SelStr = 'selected="selected"';
                                                    }else{
                                                        $SelStr = '';
                                                    }
                                                    @endphp
                                                    <option value="{{ $Pin->pinid; }}" {{ $SelStr; }}> {{ $Pin->pin_no; }} </option>
                                                @endforeach
                                            @endif
										</select>
										<input type="button" name="add_new_pin" id="add_new_pin" class="buttonstyle" value=" + New ">
										<input type="hidden" name="txt_worktype" id="txt_worktype" value="<?php //if($worktype != ""){ echo $worktype;  } ?>">
									</td>
                                </tr>
								<!-- <tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="val_worktype" style="color:red" colspan="">&nbsp;</td></tr> -->
							   <tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Head of Account </td>
                                    <td class="">
										<select name='cmb_hoa[]' id='cmb_hoa' class="tboxclass"  style="width: 400px;" multiple="multiple">
											<!-- <option value="">--------------- Select ---------------</option> -->
                                            @if(isset($data['Hoa']))
                                                @foreach($data['Hoa'] as $Hoa)
                                                    @php
                                                    if((isset($Hoaname))&&($Hoaname == $Hoa->hoaid)){
                                                        $SelStr = 'selected="selected"';
                                                    }else{
                                                        $SelStr = '';
                                                    }
                                                    ($Hoa->old_hoa_no == "")? ($Hoanum = $Hoa->new_hoa_no):($Hoanum = $Hoa->old_hoa_no);
                                                    @endphp
                                                    <option value="{{ $Hoa->hoaid; }}" {{ $SelStr; }}> {{ $Hoanum; }} </option>
                                                @endforeach
                                            @endif
										</select>
										<input type="button" name="add_new_hoa" id="add_new_hoa" class="buttonstyle" value=" + New ">
										<input type="hidden" name="txt_worktype" id="txt_worktype" value="">
										<input type="hidden" name="txt_hoa_text" id="txt_hoa_text">
									</td>
                                </tr>
                                <!-- <tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="val_worktype" style="color:red" colspan="">&nbsp;</td></tr> -->
							    <tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Work Type </td>
                                    <td>
										<select name='worktype' id='worktype' class="tboxclass" required style="width: 468px;">
											<option value="">--------------- Select ---------------</option>
											<option value="1">Major Construction</option>
											<option value="2">Minor Construction</option>
											<option value="3">Major Maintenance</option>
											<option value="4">Minor Maintenance</option>
										</select>
										<input type="hidden" name="txt_worktype" id="txt_worktype" value="">
									</td>
                                </tr>
                                <!-- <tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="val_worktype" style="color:red" colspan="">&nbsp;</td></tr> -->
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Work Order Date </td>
                                    <td><input type="text" name='workorderdate' id='workorderdate' class="tboxclass date-picker" value="@if(isset($WorkOrderDate)){{ ($WorkOrderDate); }}@endif" size="15"><span id="workorderdate_format" style="color:red"></span></td>
                                </tr>
                                <!-- <tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="val_workorderdate" style="color:red" colspan="">&nbsp;</td></tr> -->
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Work Commencement Date </td>
                                    <td><input type="text" name='workcommencedate' id='workcommencedate' required class="tboxclass date-picker" value="@if(isset($WorkCommenceDate)){{ ($WorkCommenceDate); }}@endif" size="15"><span id="workcommencedate_format" style="color:red"></span></td>
                                </tr>
                                <!-- <tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="val_workcommencedate" style="color:red" colspan="">&nbsp;</td></tr> -->
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Work Duration </td>
                                    <td>
										<input type="text" name='workduration' id='workduration' required class="tboxclass" value="@if(isset($DateOfCompletion)){{ ($DateOfCompletion); }}@endif" size="15" onKeyPress="return isNumber(event)">&nbsp;( Months )
										<!--<input type="text" name='txt_year' id='txt_year' class="textboxdisplay" value="" style="width:50px; text-align:center" readonly="">&nbsp;( Years )&nbsp;&nbsp;&nbsp;
										<input type="text" name='txt_month' id='txt_month' class="textboxdisplay" value=" style="width:50px; text-align:center" readonly="">&nbsp;( Months )&nbsp;&nbsp;&nbsp;
										<input type="text" name='txt_days' id='txt_days' class="textboxdisplay" value="" style="width:50px; text-align:center" readonly="">&nbsp;( Days )-->
									</td>
                                </tr>
                                <!-- <tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="val_workduration" style="color:red" colspan="">&nbsp;</td></tr> -->
								
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Scheduled Date of Completion </td>
                                    <td><input type="text" name='dateofcompletion' id='dateofcompletion' required class="tboxclass " value="@if(isset($DateOfCompletion)){{ ($DateOfCompletion); }}@endif" size="15" ><span id="dateofcompletion_format" style="color:red"></span></td>
                                </tr>
                                <!-- <tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="val_dateofcompletion" style="color:red" colspan="">&nbsp;</td></tr> -->
								<tr>
                                    <td>&nbsp;</td>
                                    <td class="label">Rebate Percentage </td>
                                    <td><input type="text" name='rebatepercent' id='rebatepercent' class="tboxclass" value="@if(isset($Rebatepercent)){{ ($Rebatepercent); }}@endif" size="5" onKeyPress="return isNumber(event)">&nbsp;&nbsp;( % )</td>
                                </tr>
                                <!-- <tr><td>&nbsp;</td><td>&nbsp;</td><td  align="center" class="labeldisplay" id="val_rebatepercent" style="color:red" colspan="">&nbsp;</td></tr> -->
								<tr>
									<td colspan="3">&nbsp;</td>
								</tr>
								<!--<tr>
                                    <td colspan="3" height="50px;">
                                <center>
                                    
									
                                </center>
                                </td>
                                </tr>-->
                            
                            
                                <!--<tr><td colspan="3">&nbsp;</td></tr>-->
                                <!--    <tr><td width="500" colspan="5" class="green">
                                    </td></tr>
                                <tr><td colspan="4">&nbsp;</td></tr>
                                <tr class="labelcenter">
                                    <td colspan="5" align="center">&nbsp;

                                    </td>
                                </tr>
                                <tr><td colspan="5">&nbsp;</td></tr>    -->
                            </table>
                            @php $AddUrl = 'admin.agreemententryview'; @endphp
                            <div class="row div12">
                                <div style="text-align:center;" class="printbutton">
                                    <div class="buttonsection">
                                        <input type="submit" name="submit" id="submit" data-type="submit" value="Submit"/>
                                    </div>
                                    <div class="buttonsection">
                                        <input type="submit" name="update" id="update" value="Update"/>
                                    </div>
                                    <input type="hidden" name='sheetid' id='sheetid' class="textboxdisplay"  value="@if(isset($SheetId)){{ $SheetId; }}@endif" >
                                    <div class="buttonsection">
                                        <input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
                                    </div>
                                    <div class="buttonsection"><input type="button" class="backbutton" name="View" id="View" value="View" onClick="window.location='{{ route($AddUrl) }}'"/></div>
                                        <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                          
                    </div>
                </div>
                <div class="div2">&nbsp;</div>	 
                            <!--<div class="col2"></div>-->
            </blockquote>
        </div>
    </div>
</div>
</form>
        <script>
            $('#cmb_pin').chosen();
            $('#cmb_hoa').chosen();
            $( "#dateofcompletion" ).datepicker({  
			changeMonth: true,
			changeYear: true,
			dateFormat: "dd/mm/yy",
			yearRange: "2000:+25",
			defaultDate: new Date,
		});

        $('#cmb_tr_no').change(function() {
		var work = $(this).val(); //alert(work);
		var Tendno	  = $(this).val();
		$("#txt_work_name").val('');
		$("#cmb_bidder").val('');
		$("#techsanctionno").val('');
        $("#hid_tsid").val('');
		$.ajax({
			type:'POST',
			url:"{{ route('ajax.GetTenderDetailsForWork') }}",
			data:{'_token': '{{ csrf_token() }}','work':work, 'Page':'Tender'},
			success:function(data){ //alert(data);
				if(data){
					var TSData = data['Techsancdata'];
					$.each(TSData, function(key, value) { //alert(1);
						 $("#txt_work_name").val(value.work_name);
						 $("#techsanctionno").val(value.ts_no);
                         $("#hid_tsid").val(value.ts_id);
					});
				}
			}
		});
        $("#cmb_bidder").chosen('destroy'); //alert(3);
		$("#cmb_bidder").children('option:not(:first)').remove();
		$("#txt_work_name").val('');
		 //alert(4);
		$.ajax({
			type:'POST',
			url:"{{ route('ajax.GetBidderdetailsforPriceBid') }}",
			data:{'_token': '{{ csrf_token() }}','Tendno':Tendno, 'Page':'Tender'},
			success:function(data){ 
				if(data){
					var Bidderdetails = data['BidData']; //alert(Bidderdetails);
					$.each(Bidderdetails, function(key, value) {
						$("#cmb_bidder").append('<option value="'+value.contid+'">'+value.name_contractor+'</option>');
					});
				}
			}
		});
	});
        </script>
@endsection
