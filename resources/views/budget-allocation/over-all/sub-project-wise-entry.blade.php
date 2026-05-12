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
  padding:3px 18px;
  align-items:center;
  gap:9px;
  margin-top:1px;
  border-radius:25px 25px 0px 0px;
}
.lom-proj-name{
  font-size:12px;font-weight:700;color:#fff;
  text-transform:uppercase;
}

/* ── table ── */
.lom-table-wrap{overflow-x:auto}
.lom-tbl{width:100%;border-collapse:collapse;font-size:13px;}
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
.lom-tbl tbody tr td:first-child{border-left: 1px solid #d6dce2;}
.lom-tbl tbody tr td:last-child{border-right: 1px solid #d6dce2; }

.lom-tbl tbody tr{border-bottom:1px solid #d6dce2;transition:background .13s;}
.lom-tbl tbody tr:last-child{border-bottom:1px solid #d6dce2;}
/*.lom-tbl tbody tr:hover{background:#f5f8fd}*/
.lom-tbl tbody tr.lom-tr-grp{background:#f3f7fd}
.lom-tbl tbody tr.lom-tr-grp td{font-weight:700;color:#0000CD}

.lom-td-sno{text-align:center;padding:3px 6px;vertical-align:middle}
.lom-td-obj{padding:1px 2px; padding-top: 2px !important; padding-bottom: 2px !important; vertical-align:middle;font-weight:500;color:#0000CD;font-size: 12px;}
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
.lom-step{
  /* padding:2px 8px 2px 8px;
  background-color: red;
  color: #fff;
  margin-right:5px;
  border-radius: 50px;
  font-weight: 600;
  font-size: 14px; */

  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 24px;
  height: 24px;
  background: #2456a4;
  color: #fff;
  border-radius: 50%;
  font-size: 14px;
  font-weight: 700;
  margin-right:5px;
}
.hideText{
  max-width : 650px; 
  white-space : nowrap;
  overflow : hidden;
  text-overflow: ellipsis;
}

.oh-title{
  border:1px solid #d6dce2 !important; 
  font-weight:600;
  padding-left: 4px !important; 
  padding-right: 4px !important; 
  background-color: #F0F2F5 !important;
  border-radius: 0px !important;
}


  .rtable-container {
		height: 500px;
		overflow-y: auto;
	}
	.rtable thead tr th {
		position: sticky;
		top: 0;
		z-index: 2;
		box-shadow: 0 2px 2px rgba(0, 0, 0, 0.2);
	}

	
  .rtable th:first-child,
  .rtable td:first-child{
      position: sticky;
      left: 0;
      z-index: 1;
  }
  .rtable tbody tr:first-child td:first-child{
      background: #F0F2F5;
  }
  .rtable tbody tr:nth-child(2) td:first-child{
      background: #1babd3;
      color: #fff;
  }
  .rtable tbody tr:nth-child(n+3) td:first-child{
      background: #fff;
  }



</style>
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
	<form action="" method="post" enctype="multipart/form-data" name="form" autocomplete="off">
		<div class="content">
			<div class="title"></div>
			<div class="container_12">
				<div class="grid_12">
					<blockquote class="bq1" style="overflow:auto">
						<div class="container">
							<div class="row" style="padding:4px">
								<div class="div12 mbtable">
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Apex Sub-Project Sanction Cost</div></div></div>
									<div class="row innerdiv no-padding" style="padding-top:4px; padding-bottom: 0px;">
                    <div class="row" align="right">
                      @php $BackUrl = "budget.project-budget-sanction-initiate"; @endphp
                      <button type="button" id="Back" name="Back" onclick="window.location='{{ route($BackUrl)}}'" class="backbutton">Back</button>
                      <button type="submit" id="btnSave" name="btnSave" class="step-btn" value="Save">Save</button>
                    </div>
                  </div>
                  <div class="div12">
										<div class="row" style="padding:0px 6px 4px 6px">
											<div class="rtable-container">
                    
                      @php

                      $GroupedProjects = collect($Projects)->groupBy('project_parentid');

                      function renderTree($parentId, $GroupedProjects, $level = 0, $GrandParent = 0, $OtherParam)
                      {
                          if(isset($GroupedProjects[$parentId]))
                          {
                              foreach($GroupedProjects[$parentId] as $index => $project)
                              {

                                  $hasChildren = isset(
                                      $GroupedProjects[$project->project_id]
                                  );

                                  $isLeaf = !$hasChildren;

                                  $rowClass = ($level == 0)
                                      ? 'lom-proj-hdr'
                                      : '';

                                  // START TABLE FOR EACH ROOT PARENT
                                  if($level == 0)
                                  {
                                      echo '
                                      <table class="lom-tbl rtable" width="100%" style="margin-bottom:10px;">
                                          <tbody>
                                      ';
                                      $GrandParent = $project->project_id;

                                      if(isset($OtherParam['ObjectHeadGiaMapgrpData'])){
                                        $ObjectHeadGiaMapgrpData = $OtherParam['ObjectHeadGiaMapgrpData'];
                                        $ObjectHeadSubCataGrpData = $OtherParam['ObjectHeadSubCataGrpData'];
                                        $ObjectHeadGrpData = $OtherParam['ObjectHeadGrpData'];
                                        if(isset($ObjectHeadGiaMapgrpData[$GrandParent])){
                                          $ProjectObjectHead = $ObjectHeadGiaMapgrpData[$GrandParent];
                                          if(filled($ProjectObjectHead)){
                                            echo '<tr>';
                                            echo '<td class="lom-td-obj label oh-title" style="text-align:right;">Object Head &emsp;</td>';
                                            foreach($ProjectObjectHead as $ProjectObjectHeadKey=>$ProjectObjectHeadValue){
                                              $ObjectHeadId = $ProjectObjectHeadValue->object_head_id;
                                              $IsSubCataAvailable = $ProjectObjectHeadValue->is_sup_cata_applicable;
                                              if($IsSubCataAvailable == true){
                                                if(isset($ObjectHeadSubCataGrpData[$ObjectHeadId])){
                                                  $ObjectHeadSubCata = $ObjectHeadSubCataGrpData[$ObjectHeadId];
                                                  if(filled($ObjectHeadSubCata)){
                                                    foreach($ObjectHeadSubCata as $ObjectHeadSubCataValue){
                                                      echo '<td class="lom-td-obj oh-title" nowrap="">Title &nbsp;';
                                                      echo $ObjectHeadSubCataValue->oh_sub_cata_name;
                                                      echo ' (&#8377;)</td>';
                                                    }
                                                  }
                                                }
                                              }else{
                                                $ObjectHeadName = '';
                                                if(isset($ObjectHeadGrpData[$ObjectHeadId])){
                                                  $ObjectHeadData = $ObjectHeadGrpData[$ObjectHeadId];
                                                  $ObjectHeadName = $ObjectHeadData->object_head_name;
                                                }
                                                echo '<td class="lom-td-obj oh-title" nowrap="">';
                                                echo $ObjectHeadName;
                                                echo ' (&#8377;)</td>';
                                              }
                                              
                                            }
                                            echo '</tr>';
                                          }
                                        }
                                      }
                                      
                                  }

                                  echo '<tr class="'.$rowClass.'">';

                                      echo '<td class="lom-td-obj hideText"
                                              style="padding-left:'.($level * 30).'px;">';

                                          if($level == 0)
                                          {
                                              echo '
                                                  <span style="
                                                      font-size:13px;
                                                      color:rgba(255,255,255,.7)
                                                  ">📁</span>

                                                  <span class="lom-proj-name">'
                                                      .$project->project_name.
                                                  '</span>
                                              ';
                                          }
                                          else
                                          {
                                              echo '
                                                  <span class="lom-step">↳</span>
                                                  '.$project->project_name
                                              ;
                                          }

                                      echo '</td>';
                                      if(isset($OtherParam['ApexObjectHeadSanctionData'])){
                                        $SubprojectSanctionData = $OtherParam['ApexObjectHeadSanctionData'];
                                      }
                                      if(isset($OtherParam['SanctionIndexed'])){
                                        $SanctionIndexed = $OtherParam['SanctionIndexed'];
                                      } 
                                      
                                      if(isset($OtherParam['ObjectHeadGiaMapgrpData'])){
                                        $ObjectHeadGiaMapgrpData = $OtherParam['ObjectHeadGiaMapgrpData']; 
                                        if(isset($ObjectHeadGiaMapgrpData[$GrandParent])){
                                          $ProjectObjectHead = $ObjectHeadGiaMapgrpData[$GrandParent];
                                          if(filled($ProjectObjectHead)){
                                            foreach($ProjectObjectHead as $ProjectObjectHeadKey=>$ProjectObjectHeadValue){
                                              $ObjectHeadId = $ProjectObjectHeadValue->object_head_id;
                                              $GiaId = $ProjectObjectHeadValue->gia_id;
                                              $IsSubCataAvailable = $ProjectObjectHeadValue->is_sup_cata_applicable;

                                              if($IsSubCataAvailable == true){
                                                if(isset($ObjectHeadSubCataGrpData[$ObjectHeadId])){
                                                  $ObjectHeadSubCata = $ObjectHeadSubCataGrpData[$ObjectHeadId];
                                                  if(filled($ObjectHeadSubCata)){
                                                    foreach($ObjectHeadSubCata as $ObjectHeadSubCataValue){
                                                      
                                                      if($isLeaf){
                                                        $ObjectHeadSanctionAmt = '';
                                                        if(isset($SanctionIndexed)){
                                                          /*$ObjeadHeadSancData = $SubprojectSanctionData
                                                            ->where('gia_id', $ProjectObjectHeadValue->gia_id)
                                                            ->where('object_head_id', $ProjectObjectHeadValue->object_head_id)
                                                            ->where('object_head_sub_cata_id', $ObjectHeadSubCataValue->oh_sub_cata_id)
                                                            ->where('project_id', $project->project_id)
                                                            ->where('apex_project_id', $GrandParent);
                                                          if(filled($ObjeadHeadSancData)){
                                                            $ObjectHeadSanctionAmt = collect($ObjeadHeadSancData)->pluck('sub_proj_sanctioned_amount')->first();
                                                          }*/
                                                          $key  = ($ProjectObjectHeadValue->gia_id ?? 0) . '_' .
                                                                  ($ProjectObjectHeadValue->object_head_id ?? 0) . '_' .
                                                                  ($ObjectHeadSubCataValue->oh_sub_cata_id ?? 0) . '_' .
                                                                  ($project->project_id ?? 0) . '_' .
                                                                  ($GrandParent ?? 0);
                                                          $ObjectHeadSanctionAmt = $SanctionIndexed[$key] ?? '';

                                                        }
                                                        

                                                        echo '<td class="lom-td-obj">';
                                                        echo '<input class="tboxsmclass SanctionAmount" type="text" name="txt_oh_sanction_amount[]" value="'.$ObjectHeadSanctionAmt.'">';
                                                        echo '<input class="tboxsmclass" type="hidden" name="txt_gia_id[]" value="'.$GiaId.'">';
                                                        echo '<input class="tboxsmclass" type="hidden" name="txt_object_head_id[]" value="'.$ObjectHeadId.'">';
                                                        echo '<input class="tboxsmclass" type="hidden" name="txt_object_head_sub_cata_id[]" value="'.$ObjectHeadSubCataValue->oh_sub_cata_id.'">';
                                                        echo '<input class="tboxsmclass" type="hidden" name="txt_apex_project_id[]" value="'.$GrandParent.'">';
                                                        echo '<input class="tboxsmclass" type="hidden" name="txt_project_id[]" value="'.$project->project_id.'">';
                                                        echo '</td>';
                                                      }else{
                                                        echo '<td class="lom-td-obj">&nbsp;';
                                                        echo '</td>';
                                                      }
                                                      //echo '<td class="lom-td-obj oh-title" nowrap="">Title &nbsp;';
                                                      //echo $ObjectHeadSubCataValue->oh_sub_cata_name;
                                                      //echo '</td>';
                                                    }
                                                  }
                                                }
                                              }else{
                                                $ObjectHeadName = '';
                                                if(isset($ObjectHeadGrpData[$ObjectHeadId])){
                                                  $ObjectHeadData = $ObjectHeadGrpData[$ObjectHeadId];
                                                  $ObjectHeadName = $ObjectHeadData->object_head_name;
                                                }
                                                //echo '<td class="lom-td-obj oh-title" nowrap="">';
                                                //echo $ObjectHeadName;
                                                //echo '</td>';
                                                if($isLeaf){
                                                  $ObjectHeadSanctionAmt = '';
                                                  if(isset($SanctionIndexed)){
                                                    /*$ObjeadHeadSancData = $SubprojectSanctionData
                                                      ->where('gia_id', $GiaId)
                                                      ->where('object_head_id', $ObjectHeadId)
                                                      ->where('project_id', $project->project_id)
                                                      ->where('apex_project_id', $GrandParent);
                                                    if(filled($ObjeadHeadSancData)){ //dd($ObjeadHeadSancData);
                                                      $ObjectHeadSanctionAmt = collect($ObjeadHeadSancData)->pluck('sub_proj_sanctioned_amount')->first();
                                                    }*/
                                                    $key  = ($GiaId ?? 0) . '_' .
                                                            ($ObjectHeadId ?? 0) . '_' .
                                                            (0) . '_' .
                                                            ($project->project_id ?? 0) . '_' .
                                                            ($GrandParent ?? 0);
                                                    $ObjectHeadSanctionAmt = $SanctionIndexed[$key] ?? '';
                                                  }
                                                  echo '<td class="lom-td-obj">';
                                                  echo '<input class="tboxsmclass SanctionAmount" type="text" name="txt_oh_sanction_amount[]" value="'.$ObjectHeadSanctionAmt.'">';
                                                  echo '<input class="tboxsmclass" type="hidden" name="txt_gia_id[]" value="'.$GiaId.'">';
                                                  echo '<input class="tboxsmclass" type="hidden" name="txt_object_head_id[]" value="'.$ObjectHeadId.'">';
                                                  echo '<input class="tboxsmclass" type="hidden" name="txt_object_head_sub_cata_id[]" value="">';
                                                  echo '<input class="tboxsmclass" type="hidden" name="txt_apex_project_id[]" value="'.$GrandParent.'">';
                                                  echo '<input class="tboxsmclass" type="hidden" name="txt_project_id[]" value="'.$project->project_id.'">';
                                                  echo '</td>';
                                                }else{
                                                  echo '<td class="lom-td-obj">&nbsp;';
                                                  echo '</td>';
                                                }
                                              }
                                            }
                                          }
                                        }
                                      }

                                  echo '</tr>';

                                  // CHILD RECURSION
                                  renderTree(
                                      $project->project_id,
                                      $GroupedProjects,
                                      $level + 1,
                                      $GrandParent,
                                      $OtherParam
                                  );

                                  // END TABLE FOR EACH ROOT PARENT
                                  if($level == 0)
                                  {
                                      echo '
                                          </tbody>
                                      </table>
                                      ';
                                  }
                              }
                          }
                      }
                      $ObjectHeadGiaMapgrpData = $ObjectHeadGiaMapgrpData ?? [];
                      $ObjectHeadSubCataGrpData = $ObjectHeadSubCataGrpData ?? [];
                      $ObjectHeadGrpData = $ObjectHeadGrpData ?? [];
                      $ApexObjectHeadSanctionData = $ApexObjectHeadSanctionData ?? [];
                      $SanctionIndexed = $SanctionIndexed ?? [];
                      $OtherParam = ['ObjectHeadGiaMapgrpData'=>$ObjectHeadGiaMapgrpData,'ObjectHeadSubCataGrpData'=>$ObjectHeadSubCataGrpData,'ObjectHeadGrpData'=>$ObjectHeadGrpData,'ApexObjectHeadSanctionData'=>$ApexObjectHeadSanctionData,'SanctionIndexed'=>$SanctionIndexed];

                      renderTree(0, $GroupedProjects, 0, 0, $OtherParam);

                      @endphp
											
                      </div>
										</div>
										<div class="row smclearrow"></div>  
										<div class="row smclearrow"></div>  
										<div class="row smclearrow"></div>  
										<div class="row smclearrow"></div>
                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
									</div>
								</div>	
								<div class="div2">&nbsp;</div>
							</div>                           
						</div>
					</blockquote>
				</div>
			</div>
		</div>
	</form>
</body>	
<script>
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

            let SaveSanctionAmtArr = []; 
            $('input[name="txt_oh_sanction_amount[]"]').each(function() {
              SaveSanctionAmtArr.push($(this).val()); 
            });
            if(SaveSanctionAmtArr.length === 0){
              var SaveSanctionAmtStr = "";
            }else{
              var SaveSanctionAmtStr = JSON.stringify(SaveSanctionAmtArr);
            } 

            let SaveGiaIdArr = []; 
            $('input[name="txt_gia_id[]"]').each(function() {
              SaveGiaIdArr.push($(this).val());
            });
            if(SaveGiaIdArr.length === 0){
              var SaveGiaIdStr = "";
            }else{
              var SaveGiaIdStr = JSON.stringify(SaveGiaIdArr);
            } 

            let SaveObjectHeadIdArr = []; 
            $('input[name="txt_object_head_id[]"]').each(function() {
              SaveObjectHeadIdArr.push($(this).val());
            });
            if(SaveObjectHeadIdArr.length === 0){
              var SaveObjectHeadIdStr = "";
            }else{
              var SaveObjectHeadIdStr = JSON.stringify(SaveObjectHeadIdArr);
            } 

            let SaveObjectHeadSubCataIdArr = []; 
            $('input[name="txt_object_head_sub_cata_id[]"]').each(function() {
              SaveObjectHeadSubCataIdArr.push($(this).val());
            });
            if(SaveObjectHeadSubCataIdArr.length === 0){
              var SaveObjectHeadSubCataIdStr = "";
            }else{
              var SaveObjectHeadSubCataIdStr = JSON.stringify(SaveObjectHeadSubCataIdArr);
            } 

            let SaveApexProjectIdArr = []; 
            $('input[name="txt_apex_project_id[]"]').each(function() {
              SaveApexProjectIdArr.push($(this).val());
            });
            if(SaveApexProjectIdArr.length === 0){
              var SaveApexProjectIdStr = "";
            }else{
              var SaveApexProjectIdStr = JSON.stringify(SaveApexProjectIdArr);
            } 

            let SaveProjectIdArr = []; 
            $('input[name="txt_project_id[]"]').each(function() {
              SaveProjectIdArr.push($(this).val());
            });
            if(SaveProjectIdArr.length === 0){
              var SaveProjectIdStr = "";
            }else{
              var SaveProjectIdStr = JSON.stringify(SaveProjectIdArr);
            } 

            var form = document.createElement("form");
              form.method = "POST"; 
              form.action = "{{ route('budget.sub-project-sanction-entry') }}";
              form.name = "sanctionform"; 
              document.body.appendChild(form); 
            var csrfToken = document.createElement("input"); 
              csrfToken.type = "hidden";
              csrfToken.name = "_token"; 
              csrfToken.value = "{{ Session::token() }}"; 
              form.appendChild(csrfToken);

            var FloatingPageIp1 		  = document.createElement("input");
                FloatingPageIp1.type 	= "hidden";
                FloatingPageIp1.name 	= "txt_float_sanction_amt";
                FloatingPageIp1.value = SaveSanctionAmtStr; 
                form.appendChild(FloatingPageIp1);
            var FloatingPageIp1 		  = document.createElement("input");
                FloatingPageIp1.type 	= "hidden";
                FloatingPageIp1.name 	= "txt_float_gia";
                FloatingPageIp1.value = SaveGiaIdStr; 
                form.appendChild(FloatingPageIp1);
            var FloatingPageIp1 		  = document.createElement("input");
                FloatingPageIp1.type 	= "hidden";
                FloatingPageIp1.name 	= "txt_float_object_head";
                FloatingPageIp1.value = SaveObjectHeadIdStr; 
                form.appendChild(FloatingPageIp1);
            var FloatingPageIp1 		  = document.createElement("input");
                FloatingPageIp1.type 	= "hidden";
                FloatingPageIp1.name 	= "txt_float_object_head_sub_cata";
                FloatingPageIp1.value = SaveObjectHeadSubCataIdStr; 
                form.appendChild(FloatingPageIp1);
            var FloatingPageIp1 		  = document.createElement("input");
                FloatingPageIp1.type 	= "hidden";
                FloatingPageIp1.name 	= "txt_float_apex_project_id";
                FloatingPageIp1.value = SaveApexProjectIdStr; 
                form.appendChild(FloatingPageIp1);
            var FloatingPageIp1 		  = document.createElement("input");
                FloatingPageIp1.type 	= "hidden";
                FloatingPageIp1.name 	= "txt_float_project_id";
                FloatingPageIp1.value = SaveProjectIdStr; 
                form.appendChild(FloatingPageIp1);
            var FloatingSubmitBtn 		  = document.createElement("input");
                FloatingSubmitBtn.type 	= "submit";
                FloatingSubmitBtn.name 	= "btn_save_budget";
                FloatingSubmitBtn.id 	  = "btn_save_budget";
                form.appendChild(FloatingSubmitBtn);

            $("#btn_save_budget").trigger("click");

						//KillEvent = 1;
						//$("#btnSave").trigger( "click" );
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
