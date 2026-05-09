@extends('layouts.dashboard-master')
@section('content')
@include('layouts.partials.messages')

<style>
/* ── category block ── */
.lom-cat-block{
  background:#fff;border-radius:10px;
  box-shadow:0 3px 10px rgba(15,45,94,.08),0 1px 3px rgba(15,45,94,.05);
  border:1px solid #d4dce8;margin-bottom:20px;overflow:hidden;
}

/* ── category header ── */
.lom-cat-hdr{
  padding:12px 18px;display:flex;align-items:center;gap:10px;
  border-bottom:2px solid #e8eef6;
}
<<<<<<< Updated upstream
.lom-cat-hdr--reg{background:linear-gradient(90deg,#fdf1f0 0%,#fff9f9 100%);border-left:5px solid #c0392b}
.lom-cat-hdr--sal{background:linear-gradient(90deg,#fef6ec 0%,#fffdf9 100%);border-left:5px solid #e67e22}
.lom-cat-hdr--cra{background:linear-gradient(90deg,#eaf6ef 0%,#f7fdf9 100%);border-left:5px solid #1a7a4a}

.lom-cat-dot{width:10px;height:10px;border-radius:50%;flex-shrink:0}
.lom-cat-hdr--reg .lom-cat-dot{background:#c0392b}
.lom-cat-hdr--sal .lom-cat-dot{background:#e67e22}
.lom-cat-hdr--cra .lom-cat-dot{background:#1a7a4a}

.lom-cat-title{font-size:14px;font-weight:700;letter-spacing:.1px}
.lom-cat-hdr--reg .lom-cat-title{color:#c0392b}
.lom-cat-hdr--sal .lom-cat-title{color:#e67e22}
.lom-cat-hdr--cra .lom-cat-title{color:#1a7a4a}
=======
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
>>>>>>> Stashed changes

/* ── project sub-header ── */
.lom-proj-hdr{
  background:linear-gradient(90deg,#0e7a8c 0%,#1a9aad 100%);
  padding:8px 18px;display:flex;align-items:center;gap:9px;margin-top:1px;
}
.lom-proj-name{
  font-size:12px;font-weight:700;color:#fff;
  letter-spacing:.45px;text-transform:uppercase;font-family:monospace;
}

/* ── table ── */
.lom-table-wrap{overflow-x:auto}
.lom-tbl{width:100%;border-collapse:collapse;font-size:13px}
.lom-tbl col.c-sno{width:68px}
.lom-tbl col.c-obj{width:36%}
.lom-tbl col.c-led{width:auto}

.lom-tbl thead tr th{
<<<<<<< Updated upstream
  background:#0f2d5e;color:rgba(255,255,255,.86);
=======
  background:#DCDFE3;color:#000;
>>>>>>> Stashed changes
  font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.7px;
  padding:9px 14px;text-align:left;
  border-right:1px solid rgba(255,255,255,.1);
}
.lom-tbl thead tr th:first-child{text-align:center}
.lom-tbl thead tr th:last-child{border-right:none}

.lom-tbl tbody tr{border-bottom:1px solid #e8eef6;transition:background .13s}
.lom-tbl tbody tr:last-child{border-bottom:none}
.lom-tbl tbody tr:hover{background:#f5f8fd}
.lom-tbl tbody tr.lom-tr-grp{background:#f3f7fd}
<<<<<<< Updated upstream
.lom-tbl tbody tr.lom-tr-grp td{font-weight:700;color:#1a4080}

.lom-td-sno{text-align:center;padding:9px 6px;vertical-align:middle}
.lom-td-obj{padding:9px 14px;vertical-align:middle;font-weight:500;color:#1a2a42}
.lom-td-obj--sub{padding-left:32px;font-weight:500;color:#374560}
=======
.lom-tbl tbody tr.lom-tr-grp td{font-weight:700;color:#0000CD}

.lom-td-sno{text-align:center;padding:9px 6px;vertical-align:middle}
.lom-td-obj{padding:9px 14px;vertical-align:middle;font-weight:500;color:#0000CD}
.lom-td-obj--sub{padding-left:32px;font-weight:500;color:#0000CD}
>>>>>>> Stashed changes
.lom-td-led{padding:7px 14px;vertical-align:middle}

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
<<<<<<< Updated upstream
  background:#e4ecf7;color:#1a4080;border:1px solid #b8cce8;
=======
  background:#fff;color:#0000CD;border:1px solid #9FBAE0;
>>>>>>> Stashed changes
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
</style>

<body class="page1" id="top" oncontextmenu="return false" onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
  <div class="content">
    <div class="title"></div>
    <div class="container_12">
      <div class="grid_12">
        <blockquote class="bq1" style="overflow:auto">
          <div class="container">
            <div class="row">
              <div class="div12">
                <div class="form-box">

                  <div class="row">
                    <div class="div12" style="margin-top:0px;">
                      <div class="row divhead" align="center">Ledger - Object Head Mapping</div>
                    </div>
                  </div>

                  <div class="card-body padding-1 ChartCard" id="CourseChart" style="padding:4px 4px;">

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

                          <div class="lom-cat-hdr lom-cat-hdr--{{ $CssKey }}">
                            <span class="lom-cat-dot"></span>
                            <span class="lom-cat-title">{{ $Gia->gia_name }}</span>
                          </div>

                          {{-- ── BRANCH A : PROJECT-BASED ── --}}
                          @if($ApplicableTo == 'PROJECT')

                            @if(isset($ParentProjectData) && filled($ParentProjectData))
                              @foreach($ParentProjectData as $ParentProject)
                                @php $Sno = 1; @endphp

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
                                        <th>S.No.</th><th>Object Head</th><th>Ledger Name</th>
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
                                                  $LedgerIdList = [];
                                                  if(isset($OBHLegerMappData)){
                                                    $LedgerMapData = $OBHLegerMappData
                                                      ->where('gia_id', $Gia->gia_id)
                                                      ->where('object_head_id', $ObjectHead->object_head_id)
                                                      ->where('object_head_sub_cata_id', $ObjectHeadSubCata->oh_sub_cata_id)
                                                      ->where('project_id', $ParentProject->project_id);
                                                    if(filled($LedgerMapData)){
                                                      $LedgerIdList = collect($LedgerMapData)->pluck('ledger_id')->toArray();
                                                    }
                                                  }
                                                @endphp
                                                <tr class="lom-tr-sub">
                                                  <td class="lom-td-sno"><span class="lom-sno-rom">({{ Helper::toRoman($i) }})</span></td>
                                                  <td class="lom-td-obj lom-td-obj--sub">{{ $ObjectHeadSubCata->oh_sub_cata_name }}</td>
                                                  <td class="lom-td-led">
                                                    @if(filled($LedgerIdList) && isset($Ledger))
                                                      <div class="lom-tags">
                                                        @foreach($Ledger as $AllLedgers)
                                                          @if(in_array($AllLedgers->ledger_id, $LedgerIdList))
                                                            <span class="lom-tag">{{ $AllLedgers->ledger_acc_name }}</span>
                                                          @endif
                                                        @endforeach
                                                      </div>
                                                    @else
                                                      <span class="lom-none">— Not mapped —</span>
                                                    @endif
                                                  </td>
                                                </tr>
                                                @php $i++; @endphp
                                              @endforeach
                                            @else
                                              @php
                                                $LedgerIdList = [];
                                                if(isset($OBHLegerMappData)){
                                                  $LedgerMapData = $OBHLegerMappData
                                                    ->where('gia_id', $Gia->gia_id)
                                                    ->where('object_head_id', $ObjectHead->object_head_id)
                                                    ->where('project_id', $ParentProject->project_id);
                                                  if(filled($LedgerMapData)){
                                                    $LedgerIdList = collect($LedgerMapData)->pluck('ledger_id')->toArray();
                                                  }
                                                }
                                              @endphp
                                              <tr>
                                                <td class="lom-td-sno"><span class="lom-sno-num">{{ $Sno }}</span></td>
                                                <td class="lom-td-obj">{{ $ObjectHead->object_head_name }}</td>
                                                <td class="lom-td-led">
                                                  @if(filled($LedgerIdList) && isset($Ledger))
                                                    <div class="lom-tags">
                                                      @foreach($Ledger as $AllLedgers)
                                                        @if(in_array($AllLedgers->ledger_id, $LedgerIdList))
                                                          <span class="lom-tag">{{ $AllLedgers->ledger_acc_name }}</span>
                                                        @endif
                                                      @endforeach
                                                    </div>
                                                  @else
                                                    <span class="lom-none">— Not mapped —</span>
                                                  @endif
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
                          @else

                            <div class="lom-table-wrap">
                              <table class="lom-tbl">
                                <colgroup>
                                  <col class="c-sno"/><col class="c-obj"/><col class="c-led"/>
                                </colgroup>
                                <thead>
                                  <tr>
                                    <th>S.No.</th><th>Object Head</th><th>Ledger Name</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @php $Sno2 = 1; @endphp
                                  @if(isset($ObjectHeadData) && filled($ObjectHeadData))
                                    @foreach($ObjectHeadData as $ObjectHead)
                                      @php
                                        $IsMapped = 0; $IsSubCataApplicable = false; $GiaObjectHeadMapId = '';
                                        if(isset($GiaObjectHeadGrpData[$ObjectHead->object_head_id])){
                                          $GiaObjectHeadMapDataB = $GiaObjectHeadGrpData[$ObjectHead->object_head_id];
                                          if(filled($GiaObjectHeadMapDataB)){
                                            $IsSubCataApplicable = collect($GiaObjectHeadMapDataB)->pluck('is_sup_cata_applicable')->first();
                                            $GiaObjectHeadMapId  = collect($GiaObjectHeadMapDataB)->pluck('oh_gia_mapp_id')->first();
                                          }
                                          $IsMapped = 1;
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
                                            <td class="lom-td-sno"><span class="lom-sno-sq">{{ $Sno2 }}</span></td>
                                            <td class="lom-td-obj" colspan="2">{{ $ObjectHead->object_head_name }}</td>
                                          </tr>
                                          @php $i = 1; @endphp
                                          @foreach($SubCataData as $ObjectHeadSubCata)
                                            @php
                                              $LedgerIdList = [];
                                              if(isset($OBHLegerMappData)){
                                                $LedgerMapData = $OBHLegerMappData
                                                  ->where('gia_id', $Gia->gia_id)
                                                  ->where('object_head_id', $ObjectHead->object_head_id)
                                                  ->where('object_head_sub_cata_id', $ObjectHeadSubCata->oh_sub_cata_id);
                                                if(filled($LedgerMapData)){
                                                  $LedgerIdList = collect($LedgerMapData)->pluck('ledger_id')->toArray();
                                                }
                                              }
                                            @endphp
                                            <tr class="lom-tr-sub">
                                              <td class="lom-td-sno"><span class="lom-sno-rom">({{ Helper::toRoman($i) }})</span></td>
                                              <td class="lom-td-obj lom-td-obj--sub">{{ $ObjectHeadSubCata->oh_sub_cata_name }}</td>
                                              <td class="lom-td-led">
                                                @if(filled($LedgerIdList) && isset($Ledger))
                                                  <div class="lom-tags">
                                                    @foreach($Ledger as $AllLedgers)
                                                      @if(in_array($AllLedgers->ledger_id, $LedgerIdList))
                                                        <span class="lom-tag">{{ $AllLedgers->ledger_acc_name }}</span>
                                                      @endif
                                                    @endforeach
                                                  </div>
                                                @else
                                                  <span class="lom-none">— Not mapped —</span>
                                                @endif
                                              </td>
                                            </tr>
                                            @php $i++; @endphp
                                          @endforeach
                                        @else
                                          @php
                                            $LedgerIdList = [];
                                            if(isset($OBHLegerMappData)){
                                              $LedgerMapData = $OBHLegerMappData
                                                ->where('gia_id', $Gia->gia_id)
                                                ->where('object_head_id', $ObjectHead->object_head_id);
                                              if(filled($LedgerMapData)){
                                                $LedgerIdList = collect($LedgerMapData)->pluck('ledger_id')->toArray();
                                              }
                                            }
                                          @endphp
                                          <tr>
                                            <td class="lom-td-sno"><span class="lom-sno-num">{{ $Sno2 }}</span></td>
                                            <td class="lom-td-obj">{{ $ObjectHead->object_head_name }}</td>
                                            <td class="lom-td-led">
                                              @if(filled($LedgerIdList) && isset($Ledger))
                                                <div class="lom-tags">
                                                  @foreach($Ledger as $AllLedgers)
                                                    @if(in_array($AllLedgers->ledger_id, $LedgerIdList))
                                                      <span class="lom-tag">{{ $AllLedgers->ledger_acc_name }}</span>
                                                    @endif
                                                  @endforeach
                                                </div>
                                              @else
                                                <span class="lom-none">— Not mapped —</span>
                                              @endif
                                            </td>
                                          </tr>
                                        @endif
                                        @php $Sno2++; @endphp
                                      @endif
                                    @endforeach
                                  @else
                                    <tr><td colspan="3" class="lom-empty-state">No object heads found.</td></tr>
                                  @endif
                                </tbody>
                              </table>
                            </div>{{-- /lom-table-wrap --}}

                          @endif {{-- /ApplicableTo branch --}}

                          {{-- Legend — once, after the last GIA block --}}
                          @if($loop->last)
                            <div id="lom-legend">
                              <span class="lom-legend-lbl">Legend:</span>
                              <span class="lom-legend-item">
                                <span class="lom-sno-num" style="width:22px;height:22px;font-size:10px">N</span>&nbsp;Direct object head
                              </span>
                              <span class="lom-legend-item">
                                <span class="lom-sno-sq" style="width:22px;height:22px;font-size:10px">N</span>&nbsp;Group / parent head
                              </span>
                              <span class="lom-legend-item">
                                <span class="lom-sno-rom">(i)</span>&nbsp;Sub-item under group
                              </span>
                              <span class="lom-legend-item">
                                <span class="lom-tag" style="font-size:11px">Ledger</span>&nbsp;Mapped ledger account
                              </span>
                              <span class="lom-legend-item">
                                <em class="lom-none">— Not mapped —</em>&nbsp;No ledger assigned
                              </span>
                            </div>
                          @endif

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
            </div>{{-- /row --}}
          </div>{{-- /container --}}
        </blockquote>
      </div>{{-- /grid_12 --}}
    </div>{{-- /container_12 --}}
  </div>{{-- /content --}}
</body>

@endsection