@extends('layouts.dashboard-master')
@section('content')
@include('layouts.partials.messages')

<style>
/* ── category block ── */
.lom-cat-block{
  background:#fff;border-radius:25px 25px 0px 0px;
  box-shadow:0 3px 10px rgba(15,45,94,.08),0 1px 3px rgba(15,45,94,.05);
  border:1px solid #d4dce8;margin-bottom:20px;overflow:hidden;
}

/* ── category header ── */
.lom-cat-hdr{
  padding:12px 18px;display:flex;align-items:center;gap:10px;
  border-bottom:2px solid #e8eef6;
}
.lom-cat-hdr--reg{background:linear-gradient(90deg,#fdf1f0 0%,#fff9f9 100%);border-left:5px solid #F5226F}
.lom-cat-hdr--sal{background:linear-gradient(90deg,#fef6ec 0%,#fffdf9 100%);border-left:5px solid #029999}
.lom-cat-hdr--cra{background:linear-gradient(90deg,#eaf6ef 0%,#f7fdf9 100%);border-left:5px solid #D4A800}

.lom-cat-dot{width:10px;height:10px;border-radius:50%;flex-shrink:0}
.lom-cat-hdr--reg .lom-cat-dot{background:#F5226F}
.lom-cat-hdr--sal .lom-cat-dot{background:#029999}
.lom-cat-hdr--cra .lom-cat-dot{background:#D4A800}

.lom-cat-title{font-size:14px;font-weight:700;letter-spacing:.1px}
.lom-cat-hdr--reg .lom-cat-title{color:#F5226F}
.lom-cat-hdr--sal .lom-cat-title{color:#029999}
.lom-cat-hdr--cra .lom-cat-title{color:#D4A800}

/* ── project sub-header ── */
.lom-proj-hdr{
  background:#1babd3;
  padding:3px 18px;display:flex;align-items:center;gap:9px;margin-top:1px;
  border-radius:25px 25px 0px 0px;
}
.lom-proj-name{
  font-size:12px;font-weight:700;color:#fff;
  text-transform:uppercase;
}

/* ── table ── */
.lom-table-wrap{overflow-x:auto}
.lom-tbl{width:100%;border-collapse:collapse;font-size:13px}
.lom-tbl col.c-sno{width:100px}
.lom-tbl col.c-obj{width:auto}
.lom-tbl col.c-led{width:250px}

.lom-tbl thead tr th{
  background:#DCDFE3;color:#000;
  font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.7px;
  padding:3px 14px;text-align:left;
  border-right:1px solid rgba(255,255,255,.1);
}
.lom-tbl thead tr th:first-child{text-align:center}
.lom-tbl thead tr th:last-child{border-right:none}

.lom-tbl tbody tr{border-bottom:1px solid #d6dce2;transition:background .13s}
.lom-tbl tbody tr:last-child{border-bottom:none}
.lom-tbl tbody tr:hover{background:#f5f8fd}
.lom-tbl tbody tr.lom-tr-grp{background:#f3f7fd}
.lom-tbl tbody tr.lom-tr-grp td{font-weight:700;color:#0000CD}

.lom-td-sno{text-align:center;padding:3px 6px;vertical-align:middle}
.lom-td-obj{padding:3px 14px;vertical-align:middle;font-weight:500;color:#0000CD}
.lom-td-obj--sub{padding-left:32px;font-weight:500;color:#0000CD}
.lom-td-led{padding:3px 14px;vertical-align:middle}

/* serial badges */
.lom-sno-num{
  display:inline-flex;align-items:center;justify-content:center;
  width:24px;height:24px;background:#2456a4;color:#fff;
  border-radius:50%;font-size:11px;font-weight:700;font-family:monospace;
}
.lom-sno-sq{
  display:inline-flex;align-items:center;justify-content:center;
  width:24px;height:24px;background:#1a4080;color:#fff;
  border-radius:4px;font-size:11px;font-weight:700;font-family:monospace;
}
.lom-sno-rom{
  display:inline-block;padding:2px 6px;
  background:#d0eef2;color:#0e7a8c;
  border-radius:20px;font-size:11px;font-weight:600;font-family:monospace;
}

/* tag chips */
.lom-tags{display:flex;flex-wrap:wrap;gap:5px;align-items:center}
.lom-tag{
  display:inline-flex;align-items:center;gap:4px;
  background:#fff;color:#0000CD;border:1px solid #9FBAE0;
  padding:3px 9px;border-radius:20px;font-size:11.5px;font-weight:500;white-space:nowrap;
}
.lom-tag::before{
  content:'';width:5px;height:5px;background:#2456a4;
  border-radius:50%;flex-shrink:0;
}
.lom-none{color:#9aa8bf;font-size:12px;font-style:italic}

/* legend */
#lom-legend{
  display:flex;flex-wrap:wrap;gap:16px;align-items:center;
  padding:10px 18px;background:#f8fafd;border-top:1px solid #e8eef6;
}
.lom-legend-lbl{
  font-size:10px;font-weight:700;color:#9aa8bf;
  text-transform:uppercase;letter-spacing:.5px;margin-right:2px;
}
.lom-legend-item{display:flex;align-items:center;gap:6px;font-size:11.5px;color:#374560}

.lom-empty-state{
  padding:28px;text-align:center;
  color:#9aa8bf;font-size:13px;font-style:italic;
}
.tboxsmclass{
  border: 1px solid #7C7CFF;
}
.c-case{
  text-transform: capitalize !important;
}
</style>

<body class="page1" id="top" oncontextmenu="return false" onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
  <form action="" method="post" enctype="multipart/form-data" name="form">
  <div class="content">
    <div class="title"></div>
    <div class="container_12">
      <div class="grid_12">
        <blockquote class="bq1" style="overflow:auto">
          <div class="container">
            <div class="row">
              <div class="div2"></div>
              <div class="div8">
                <div class="form-box">

                  <div class="row">
                    <div class="div12" style="margin-top:0px;">
                      <div class="row divhead" align="center">APEX Project Overall Sanctioned Cost</div>
                    </div>
                  </div>
                  <div class="row innerdiv no-padding" style="padding-top:4px; padding-bottom: 0px;">
                    <div class="row" align="right">
                      @php $BackUrl = "budget.project-budget-sanction-initiate"; @endphp
                      <button type="button" id="Back" name="Back" onclick="window.location='{{ route($BackUrl)}}'" class="backbutton">Back</button>
                      <button type="submit" id="btnSave" name="btnSave" class="step-btn" value="Save">Save</button>
                    </div>
                  </div>
                  <div class="card-body padding-1 ChartCard" id="CourseChart" style="padding:4px 4px;">
                    @php $Index = 0; @endphp
                    @if(isset($GiaData) && filled($GiaData))

                      @foreach($GiaData as $Gia)

                        @php
                          $CssKey = 'reg';
                          if($Gia->gia_code == 'RES') $CssKey = 'sal';
                          if($Gia->gia_code == 'CRA') $CssKey = 'cra';

                          $GiaObjectHeadGrpData = [];
                          if(isset($ObjectHeadGiaMapgrpData[$Gia->gia_id])){
                            $GiaObjectHeadData = $ObjectHeadGiaMapgrpData[$Gia->gia_id];
                            if(filled($GiaObjectHeadData)){
                              $GiaObjectHeadGrpData = collect($GiaObjectHeadData)->groupBy('object_head_id');
                            }
                          }
                          $ApplicableTo = $Gia->applicable_to;
                        @endphp

                        <div class="lom-cat-block">

                          <!-- <div class="lom-cat-hdr lom-cat-hdr--{{ $CssKey }}">
                            <span class="lom-cat-dot"></span>
                            <span class="lom-cat-title">{{ $Gia->gia_name }}</span>
                          </div> -->

                          {{-- ── BRANCH A : PROJECT-BASED ── --}}
                          @if($ApplicableTo == 'PROJECT')

                            @if(isset($ParentProjectData) && filled($ParentProjectData))
                              @foreach($ParentProjectData as $ParentProject)
                                @php 
                                $Sno = 1; $ProjectGrantparentId = $ParentProject->project_id; 
                                if(isset($ApexSanctionGrpData)){
                                  if(isset($ApexSanctionGrpData[$ProjectGrantparentId])){
                                    $ExistingApexData = $ApexSanctionGrpData[$ProjectGrantparentId];
                                    if(filled($ExistingApexData)){
                                      $ApexSanctionNo = $ExistingApexData->pluck('budget_sanction_no')->first();
                                      $ApexSanctionAmt = $ExistingApexData->pluck('budget_sanction_amt')->first();
                                      $ApexSanctionDate = $ExistingApexData->pluck('budget_sanction_date')->first();
                                    }
                                  }
                                }
                                @endphp

                                <div class="lom-proj-hdr">
                                  <span style="font-size:13px;color:rgba(255,255,255,.7)">📁</span>
                                  <span class="lom-proj-name">{{ $ParentProject->project_name }}</span>
                                </div>

                                <div class="lom-table-wrap">
                                  <table class="lom-tbl">
                                    <colgroup>
                                      <col class="c-sno"/><col class="c-obj"/><col class="c-led"/>
                                    </colgroup>
                                    <thead>
                                      
                                      <tr>
                                        <th colspan="3">
                                          <div class="row">
                                            <div class="div4 no-margin pd-lr-1">
                                              <div class="lboxlabel c-case">Sanction No.</div>
                                              <input type="text" name="txt_sanction_no[]" id="txt_sanction_no" class="tboxsmclass" value="{{ isset($ApexSanctionNo) ? $ApexSanctionNo : '' }}">
                                              <input type="hidden" name="txt_apex_project_id[]" id="txt_apex_project_id_{{ $ProjectGrantparentId }}" class="tboxsmclass" value="{{ $ProjectGrantparentId }}">
                                            </div>
                                            <div class="div4 no-margin pd-lr-1">
                                              <div class="lboxlabel c-case">Sanction Date</div>
                                              <input type="text" name="txt_sanction_date[]" id="txt_sanction_date_{{ $ProjectGrantparentId }}" class="tboxsmclass datepicker" value="{{ isset($ApexSanctionDate) ? Helper::DisplayDateFormat($ApexSanctionDate) : '' }}">
                                            </div>
                                            <div class="div4 no-margin pd-lr-1">
                                              <div class="lboxlabel c-case">Sanction Amount ( &#8377; In Lakhs )</div>
                                              <input type="number" name="txt_sanction_amount[]" id="txt_sanction_amount_{{ $ProjectGrantparentId }}" class="tboxsmclass" value="{{ isset($ApexSanctionAmt) ? $ApexSanctionAmt : '' }}">
                                            </div>
                                          </div>
                                        </th>
                                      </tr>
                                      <tr>
                                        <th>S.No.</th><th>Object Head</th><th>Over All Sanction Amount ( &#8377; )</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @if(isset($ObjectHeadData) && filled($ObjectHeadData))
                                        @foreach($ObjectHeadData as $ObjectHead)
                                          @php
                                            $IsMapped = 0; $IsSubCataApplicable = false; $GiaObjectHeadMapId = '';
                                            if(isset($GiaObjectHeadGrpData[$ObjectHead->object_head_id])){
                                              $GiaObjectHeadMapData = collect($GiaObjectHeadGrpData[$ObjectHead->object_head_id])
                                                                        ->where('project_id', $ParentProject->project_id);
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
                                                <td class="lom-td-obj" colspan="2">{{ $ObjectHead->object_head_name }}</td>
                                              </tr>
                                              @php $i = 1; @endphp
                                              @foreach($SubCataData as $ObjectHeadSubCata)
                                                @php
                                                  $ObjectHeadSanctionAmt = '';
                                                  if(isset($ApexObjectHeadSanctionData)){
                                                    $ObjeadHeadSancData = $ApexObjectHeadSanctionData
                                                      ->where('gia_id', $Gia->gia_id)
                                                      ->where('object_head_id', $ObjectHead->object_head_id)
                                                      ->where('object_head_sub_cata_id', $ObjectHeadSubCata->oh_sub_cata_id)
                                                      ->where('apex_project_id', $ParentProject->project_id);
                                                    if(filled($ObjeadHeadSancData)){
                                                      $ObjectHeadSanctionAmt = collect($ObjeadHeadSancData)->pluck('oh_sanctioned_amount')->first();
                                                    }
                                                  }
                                                  $Index++;
                                                @endphp
                                                <tr class="lom-tr-sub">
                                                  <td class="lom-td-sno"><span class="lom-sno-rom">({{ Helper::toRoman($i) }})</span></td>
                                                  <td class="lom-td-obj lom-td-obj--sub">{{ $ObjectHeadSubCata->oh_sub_cata_name }}</td>
                                                  <td class="lom-td-led">
                                                    <input type="number" class="tboxsmclass SanctionAmount" name="txt_oh_sanction_amount[]" id="txt_oh_sanction_amount_{{ $Index }}" value="{{ isset($ObjectHeadSanctionAmt) ? $ObjectHeadSanctionAmt : '' }}">
                                                    <input type="hidden" class="tboxsmclass" name="txt_project_grant_parent_id_{{ $ProjectGrantparentId }}[]" id="txt_project_grant_parent_id_{{ $Index }}" value="{{ $ProjectGrantparentId }}">
                                                    <input type="hidden" class="tboxsmclass" name="txt_gia_id_{{ $ProjectGrantparentId }}[]" id="txt_gia_id_{{ $Index }}" value="{{ $Gia->gia_id }}">
                                                    <input type="hidden" class="tboxsmclass" name="txt_object_head_id_{{ $ProjectGrantparentId }}[]" id="txt_object_head_id_{{ $Index }}" value="{{ $ObjectHead->object_head_id }}">
                                                    <input type="hidden" class="tboxsmclass" name="txt_object_head_subcata_id_{{ $ProjectGrantparentId }}[]" id="txt_object_head_subcata_id_{{ $Index }}" value="{{ $ObjectHeadSubCata->oh_sub_cata_id }}">
                                                  </td>
                                                </tr>
                                                @php $i++; @endphp
                                              @endforeach
                                            @else
                                              @php
                                                $ObjectHeadSanctionAmt = '';
                                                if(isset($ApexObjectHeadSanctionData)){
                                                  $ObjeadHeadSancData = $ApexObjectHeadSanctionData
                                                    ->where('gia_id', $Gia->gia_id)
                                                    ->where('object_head_id', $ObjectHead->object_head_id)
                                                    ->where('apex_project_id', $ParentProject->project_id);
                                                  if(filled($ObjeadHeadSancData)){
                                                    $ObjectHeadSanctionAmt = collect($ObjeadHeadSancData)->pluck('oh_sanctioned_amount')->first();
                                                  }
                                                }
                                                $Index++;
                                              @endphp
                                              <tr>
                                                <td class="lom-td-sno"><span class="lom-sno-num">{{ $Sno }}</span></td>
                                                <td class="lom-td-obj">{{ $ObjectHead->object_head_name }}</td>
                                                <td class="lom-td-led">
                                                    <input type="number" class="tboxsmclass SanctionAmount" name="txt_oh_sanction_amount_{{ $ProjectGrantparentId }}[]" id="txt_oh_sanction_amount_{{ $Index }}" value="{{ isset($ObjectHeadSanctionAmt) ? $ObjectHeadSanctionAmt : '' }}">
                                                    <input type="hidden" class="tboxsmclass" name="txt_project_grant_parent_id_{{ $ProjectGrantparentId }}[]" id="txt_project_grant_parent_id_{{ $Index  }}" value="{{ $ProjectGrantparentId }}">
                                                    <input type="hidden" class="tboxsmclass" name="txt_gia_id_{{ $ProjectGrantparentId }}[]" id="txt_gia_id_{{ $Index  }}" value="{{ $Gia->gia_id }}">
                                                    <input type="hidden" class="tboxsmclass" name="txt_object_head_id_{{ $ProjectGrantparentId }}[]" id="txt_object_head_id_{{ $Index  }}" value="{{ $ObjectHead->object_head_id }}">
                                                    <input type="hidden" class="tboxsmclass" name="txt_object_head_subcata_id_{{ $ProjectGrantparentId }}[]" id="txt_object_head_subcata_id_{{ $Index  }}" value="">
                                                </td>
                                              </tr>
                                            @endif
                                            @php $Sno++; @endphp
                                          @endif
                                        @endforeach
                                      @else
                                        <tr><td colspan="3" class="lom-empty-state">No object heads found.</td></tr>
                                      @endif
                                    </tbody>
                                  </table>
                                </div>{{-- /lom-table-wrap --}}

                              @endforeach {{-- /ParentProjectData --}}
                            @else
                              <div class="lom-empty-state">No projects configured for this category.</div>
                            @endif

                          {{-- ── BRANCH B : NON-PROJECT ── --}}

                            

                          @endif {{-- /ApplicableTo branch --}}

                          

                        </div>{{-- /lom-cat-block --}}

                      @endforeach {{-- /GiaData --}}

                    @else
                      <div class="lom-cat-block">
                        <div class="lom-empty-state">No GIA categories configured.</div>
                      </div>
                    @endif

                  </div>{{-- /card-body padding-1 ChartCard --}}

                </div>{{-- /form-box --}}
              </div>{{-- /div12 --}}
              <div class="2"></div>
              <div class="row smclearrow"></div>
              <div class="row smclearrow"></div>
							<div class="row smclearrow"></div>
              <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
            </div>{{-- /row --}}
          </div>{{-- /container --}}
        </blockquote>
      </div>{{-- /grid_12 --}}
    </div>{{-- /container_12 --}}
  </div>{{-- /content --}}
  </form>
</body>
<script>
// ─────────────────────────────────────────────────────────────────────────────
// Init
// ─────────────────────────────────────────────────────────────────────────────
$(".ChosenInput").chosen();
var KillEvent = 0;
$("body").on("click", "#btnSave", function () {
	if(KillEvent == 0){
		let AmountErr = 0; let NegativeAmountErr = 0;
		$(".SanctionAmount").each(function () {
			let Amount  = $(this).val();
			if(Amount !== "") {
				AmountErr++;
			}
      if(parseFloat(Amount) < 0) {
				NegativeAmountErr++;
			}
		});

		
		if(AmountErr == 0){
			BootstrapDialog.alert("Please enter atleast one amount to proceed");
			event.preventDefault();
			event.returnValue = false;
		}else if(NegativeAmountErr > 0){
			BootstrapDialog.alert("Please enter valid amount to proceed");
			event.preventDefault();
			event.returnValue = false;
		}else{
			event.preventDefault();
			BootstrapDialog.confirm({
				title: 'Confirmation Message',
				message: 'Are you sure want to save ?',
				closable: false, // <-- Default value is false
				draggable: false, // <-- Default value is false
				btnCancelLabel: 'Cancel', // <-- Default value is 'Cancel',
				btnOKLabel: 'Ok', // <-- Default value is 'OK',
				callback: function(result) {
					if(result){
						KillEvent = 1;
						$("#btnSave").trigger( "click" );
					}else {
						KillEvent = 0;
					}
				}
			});
		}
		
	}
});
</script>

@endsection