@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
@php
if(isset($data['EmpData'])){
    $EmpData  = $data['EmpData'];  
    $ICNo     = collect($EmpData)->pluck('emp_no')->first(); 
    $EmpName  = collect($EmpData)->pluck('emp_first_name')->first();
    $Desig    = collect($EmpData)->pluck('designation_name')->first();
    $EmpGroup   = collect($EmpData)->pluck('employee_group_type')->first();
    $Mobile   = collect($EmpData)->pluck('emp_mobile')->first();
    $EMail   = collect($EmpData)->pluck('emp_off_email')->first();
    $SectionShortName   = collect($EmpData)->pluck('section_short_name')->first();
    $OfficeShortName   = collect($EmpData)->pluck('office_short_name')->first();
    $EmpPayslipName  = collect($EmpData)->pluck('emp_name_payslip')->first();

    $GroupName  = collect($EmpData)->pluck('group')->first();
    $DivisionName  = collect($EmpData)->pluck('division')->first();
    $SectionName  = collect($EmpData)->pluck('section')->first();
    if($GroupName != NULL){
      $OfficeName = $GroupName;
    }else if($DivisionName != NULL){
      $OfficeName = $DivisionName;
    }else if($SectionName != NULL){
      $OfficeName = $SectionName;
    }else{
      $OfficeName = '';
    }
}
if(((session('WcmsRoleGroupCode') == "ADMUSER")||(session('WcmsRoleGroupCode') == "SUPUSER"))){
    $IsAdmin = 1;
}else{
    $IsAdmin = 0;
}
if(isset($data['DashboardContentData'])){
    $DashboardContentData = $data['DashboardContentData'];
}else{
    $DashboardContentData = [];
}
@endphp

<script type="text/javascript">
	window.history.forward();
	function noBack() { window.history.forward(); }
</script>

<style>

    :root {
      --empl-navy:        #0a1f4e;
      --empl-navy-mid:    #122866;
      --empl-blue:        #2563eb;
      --empl-green:       #059669;
      --empl-amber:       #d97706;
      --empl-red:         #dc2626;
      --empl-purple:      #7c3aed;
      --empl-teal:        #0891b2;
      --empl-pink:        #db2777;
      --empl-indigo:      #4338ca;
      --empl-bg:          #eef2fb;
      --empl-white:       #ffffff;
      --empl-grey:        #CBCED1;
      --empl-radius:      14px;
      --empl-shadow:      0 4px 24px rgba(10,31,78,0.09);
      --empl-shadow-h:    0 8px 32px rgba(10,31,78,0.17);
    }

    /* ── WRAPPER ── */
    .empl-wrap {
      font-family: 'DM Sans', sans-serif;
      background: var(--empl-bg);
      min-height: 100vh;
    }

    /* ── HEADER ── */
    .empl-header {
      background: var(--empl-navy);
      height: 64px;
      padding: 0 32px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: sticky;
      top: 0;
      z-index: 200;
      box-shadow: 0 2px 14px rgba(10,31,78,0.28);
    }
    .empl-header-brand { display: flex; align-items: center; gap: 13px; }
    .empl-header-logo {
      width: 42px; height: 42px;
      background: linear-gradient(135deg,#f59e0b,#fbbf24);
      border-radius: 10px;
      display: flex; align-items: center; justify-content: center;
      font-family: 'Rajdhani', sans-serif;
      font-size: 20px; font-weight: 800;
      color: var(--empl-navy);
    }
    .empl-header-title {
      font-family: 'Rajdhani', sans-serif;
      font-size: 20px; font-weight: 700;
      color: #fff; letter-spacing: .4px; line-height: 1.1;
    }
    .empl-header-sub {
      color: #93c5fd; font-size: 11px;
      font-weight: 500; letter-spacing: 1.4px; text-transform: uppercase;
    }
    .empl-header-right { display: flex; align-items: center; gap: 18px; }
    .empl-header-date  { color: #bfdbfe; font-size: 13px; }
    .empl-notif-btn {
      position: relative; color: #bfdbfe;
      font-size: 18px; cursor: pointer;
      background: none; border: none; padding: 0;
    }
    .empl-notif-badge {
      position: absolute; top: -4px; right: -5px;
      background: #ef4444; color: #fff;
      border-radius: 50%; font-size: 9px;
      width: 16px; height: 16px;
      display: flex; align-items: center; justify-content: center;
      font-weight: 700;
    }
    .empl-avatar-btn {
      width: 38px; height: 38px; border-radius: 50%;
      background: linear-gradient(135deg,#3b82f6,#6366f1);
      display: flex; align-items: center; justify-content: center;
      color: #fff; font-weight: 700; font-size: 14px;
      cursor: pointer; border: 2px solid #3b82f6;
    }

    /* ── BREADCRUMB BAR ── */
    .empl-breadbar {
      background: #fff;
      border-bottom: 1px solid #e2e8f0;
      padding: 10px 32px;
      display: flex; align-items: center; gap: 8px;
      font-size: 12.5px; color: #64748b;
    }
    .empl-breadbar a { color: var(--empl-blue); text-decoration: none; font-weight: 500; }
    .empl-breadbar span { color: #cbd5e1; }

    /* ── CONTENT ── */
    .empl-content { padding: 10px 2px; max-width: 1430px; margin: 0 0; }

    /* ── HERO PROFILE CARD ── */
    .empl-profile-hero {
      background: linear-gradient(120deg, #ffffff 0%, #f4f6f6 55%, #ffffff 100%);
      border-radius: 18px;
      padding: 10px 32px;
      display: flex;
      align-items: center;
      gap: 28px;
      margin-bottom: 24px;
      position: relative;
      overflow: hidden;
      box-shadow: 0 8px 32px rgba(10,31,78,0.22);
    }
    .empl-profile-hero::before {
      content: '';
      position: absolute; right: -40px; top: -40px;
      width: 220px; height: 220px;
      background: rgba(255,255,255,0.04);
      border-radius: 50%;
    }
    .empl-profile-hero::after {
      content: '';
      position: absolute; right: 60px; bottom: -60px;
      width: 160px; height: 160px;
      background: rgba(255,255,255,0.03);
      border-radius: 50%;
    }
    .empl-profile-avatar {
      width: 90px; height: 90px; border-radius: 50%;
      background: linear-gradient(135deg,#f59e0b,#fbbf24);
      display: flex; align-items: center; justify-content: center;
      font-family: 'Rajdhani', sans-serif;
      font-size: 36px; font-weight: 700;
      color: var(--empl-navy);
      border: 4px solid rgba(255,255,255,0.3);
      flex-shrink: 0;
      position: relative; z-index: 1;
    }
    .empl-profile-info { flex: 1; position: relative; z-index: 1; }
    .empl-profile-name {
      font-family: 'Rajdhani', sans-serif;
      font-size: 22px; font-weight: 700;
      color: #000; margin: 0 0 4px;
    }
    .empl-profile-role { color: #93c5fd; font-size: 13.5px; font-weight: 500; margin-bottom: 12px; }
    .empl-profile-tags { display: flex; gap: 8px; flex-wrap: wrap; }
    .empl-ptag {
      background: rgba(0,0,255,0.12);
      color: #03447a; font-size: 11.5px; font-weight: 600;
      padding: 4px 12px; border-radius: 20px;
      display: flex; align-items: center; gap: 5px;
      backdrop-filter: blur(4px);
    }
    .empl-profile-stats {
      display: flex; gap: 28px;
      position: relative; z-index: 1;
    }
    .empl-pstat { text-align: center; }
    .empl-pstat-val {
      font-family: 'Rajdhani', sans-serif;
      font-size: 20px; font-weight: 700; color: #000;
      display: block; line-height: 1;
    }
    .empl-pstat-lbl { color: #145094; font-size: 11px; font-weight: 600; margin-top: 2px; }
    .empl-pstat-divider { width: 1px; background: rgba(255,255,255,0.15); }
    .empl-profile-actions { display: flex; flex-direction: column; gap: 10px; position: relative; z-index: 1; }
    .empl-pro-btn {
      padding: 9px 20px; border-radius: 9px; border: none;
      font-size: 13px; font-weight: 600; cursor: pointer;
      display: flex; align-items: center; gap: 7px;
      transition: all .2s; white-space: nowrap;
    }
    .empl-pro-btn-solid {
      background: linear-gradient(135deg,#f59e0b,#fbbf24);
      color: var(--empl-navy);
    }
    .empl-pro-btn-solid:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(251,191,36,.5); }
    .empl-pro-btn-outline {
      background: rgba(0,0,255,0.1);
      color: #03447a; border: 1.5px solid rgba(0,0,255,0.25);
    }
    .empl-pro-btn-outline:hover { background: rgba(255,255,255,0.2); }

    /* ── QUICK STAT CARDS ── */
    .empl-quick-grid {
      display: grid;
      grid-template-columns: repeat(5, 1fr);
      gap: 16px;
      margin-bottom: 24px;
    }
    .empl-qcard {
      background: #fff;
      border-radius: var(--empl-radius);
      padding: 18px 20px;
      box-shadow: var(--empl-shadow);
      border-left: 4px solid transparent;
      display: flex; align-items: center; gap: 14px;
      cursor: pointer; transition: all .22s;
      animation: empl-fadein .4s ease both;
    }
    .empl-qcard:hover { transform: translateY(-3px); box-shadow: var(--empl-shadow-h); }
    .empl-qcard:nth-child(1) { animation-delay:.05s; border-left-color: var(--empl-blue); }
    .empl-qcard:nth-child(2) { animation-delay:.10s; border-left-color: var(--empl-green); }
    .empl-qcard:nth-child(3) { animation-delay:.15s; border-left-color: var(--empl-amber); }
    .empl-qcard:nth-child(4) { animation-delay:.20s; border-left-color: var(--empl-purple); }
    .empl-qcard:nth-child(5) { animation-delay:.25s; border-left-color: var(--empl-pink); }

    .empl-qcard-icon {
      width: 44px; height: 44px; border-radius: 11px;
      display: flex; align-items: center; justify-content: center;
      font-size: 19px; flex-shrink: 0;
    }
    .empl-qi-blue   { background: var(--empl-blue); color: #fff; }
    .empl-qi-green  { background: var(--empl-green); color: #fff; }
    .empl-qi-amber  { background: var(--empl-amber); color: #fff; }
    .empl-qi-purple { background: var(--empl-purple); color: #fff; }
    .empl-qi-pink   { background: var(--empl-pink); color: #fff; }
    .empl-qi-teal   { background: var(--empl-teal); color: #fff; }
    .empl-qi-red    { background: var(--empl-red); color: #fff; }

    .empl-qcard-val {
      font-family: 'Rajdhani', sans-serif;
      font-size: 17px; font-weight: 700; color: #0f172a; line-height: 1;
    }
    .empl-qcard-lbl { font-size: 11.5px; color: #57595a; font-weight: 600; margin-top: 2px; }
    .empl-qcard-sub { font-size: 10.5px; color: #57595a; font-weight: 600; margin-top: 1px; }

    /* ── MAIN GRID ── */
    .empl-main-grid {
      display: grid;
      grid-template-columns: 1.5fr 1fr;
      gap: 20px;
      margin-bottom: 20px;
    }
    .empl-main-grid-3 {
      display: grid;
      grid-template-columns: 1fr 1fr 1fr;
      gap: 20px;
      margin-bottom: 20px;
    }

    /* ── PANEL CARD ── */
    .empl-panel {
      background: #fff;
      border-radius: var(--empl-radius);
      padding: 22px 24px;
      box-shadow: var(--empl-shadow);
      animation: empl-fadein .5s ease .3s both;
    }
    .empl-panel-head {
      display: flex; align-items: center; justify-content: space-between;
      margin-bottom: 4px;
    }
    .empl-panel-title {
      font-family: 'Rajdhani', sans-serif;
      font-size: 17px; font-weight: 700;
      color: var(--empl-navy); margin: 0;
    }
    .empl-panel-sub { font-size: 12px; color: #94a3b8; margin-bottom: 16px; }
    .empl-divider { height: 1px; background: #f1f5f9; margin-bottom: 16px; }
    .empl-view-all {
      font-size: 12px; font-weight: 600; color: var(--empl-blue);
      text-decoration: none; display: flex; align-items: center; gap: 4px;
    }
    .empl-view-all:hover { color: var(--empl-navy); }

    /* ── ATTENDANCE HEATMAP ── */
    .empl-att-legend { display: flex; gap: 10px; align-items: center; margin-bottom: 12px; flex-wrap: wrap; }
    .empl-att-dot { width: 12px; height: 12px; border-radius: 3px; }
    .empl-att-lbl-sm { font-size: 11px; color: #64748b; }
    .empl-att-grid {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      gap: 5px;
    }
    .empl-att-day-hdr {
      font-size: 10px; font-weight: 700; color: #94a3b8;
      text-align: center; padding-bottom: 4px;
    }
    .empl-att-cell {
      aspect-ratio: 1;
      border-radius: 5px;
      display: flex; align-items: center; justify-content: center;
      font-size: 10px; font-weight: 600;
      cursor: pointer; transition: transform .15s;
      position: relative;
    }
    .empl-att-cell:hover { transform: scale(1.15); z-index: 2; }
    .empl-att-present { background: #dcfce7; color: #15803d; }
    .empl-att-absent  { background: #fee2e2; color: #b91c1c; }
    .empl-att-leave   { background: #fef3c7; color: #92400e; }
    .empl-att-holiday { background: #f5f3ff; color: #6d28d9; }
    .empl-att-half    { background: #dbeafe; color: #1d4ed8; }
    .empl-att-future  { background: #f8fafc; color: #cbd5e1; }
    .empl-att-today   { background: var(--empl-navy); color: #fff !important; }

    /* Attendance summary bar */
    .empl-att-summary {
      display: flex; gap: 0; margin-top: 14px;
      border-radius: 8px; overflow: hidden; height: 10px;
    }
    .empl-att-bar-seg { height: 100%; transition: width 1s ease; }

    .empl-att-stat-row {
      display: grid; grid-template-columns: repeat(4,1fr); gap: 8px; margin-top: 14px;
    }
    .empl-att-stat-box {
      background: #f8fafc; border-radius: 9px;
      padding: 10px; text-align: center;
    }
    .empl-att-stat-num {
      font-family: 'Rajdhani', sans-serif;
      font-size: 20px; font-weight: 700; color: #0f172a; display: block;
    }
    .empl-att-stat-lbl { font-size: 10px; color: #94a3b8; font-weight: 500; }

    /* ── PAYSLIP / SALARY CARD ── */
    .empl-salary-hero {
      background: linear-gradient(135deg, #059669, #10b981);
      border-radius: 12px; padding: 20px; margin-bottom: 16px;
      display: flex; align-items: center; justify-content: space-between;
    }
    .empl-salary-amt {
      font-family: 'Rajdhani', sans-serif;
      font-size: 34px; font-weight: 700; color: #fff; line-height: 1;
    }
    .empl-salary-lbl { color: #a7f3d0; font-size: 12px; margin-top: 4px; }
    .empl-salary-status {
      background: rgba(255,255,255,0.2);
      color: #fff; font-size: 12px; font-weight: 700;
      padding: 6px 14px; border-radius: 20px;
      border: 1.5px solid rgba(255,255,255,0.3);
    }
    .empl-salary-row {
      display: flex; justify-content: space-between;
      padding: 9px 0; border-bottom: 1px solid #f1f5f9;
      font-size: 13px; color: #475569;
    }
    .empl-salary-row:last-child { border-bottom: none; }
    .empl-salary-row strong { color: #1e293b; font-weight: 600; }
    .empl-salary-row .empl-cr  { color: var(--empl-green); font-weight: 600; }
    .empl-salary-row .empl-dr  { color: var(--empl-red); font-weight: 600; }
    .empl-payslip-btn {
      width: 100%; margin-top: 14px;
      background: var(--empl-navy); color: #fff;
      border: none; border-radius: 9px;
      padding: 10px; font-size: 13px; font-weight: 600;
      cursor: pointer; display: flex; align-items: center;
      justify-content: center; gap: 7px; transition: all .2s;
    }
    .empl-payslip-btn:hover { background: #1e3a8a; }

    /* ── LEAVE BALANCE ── */
    .empl-leave-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 14px; }
    .empl-leave-card {
      border-radius: 11px; padding: 14px;
      display: flex; align-items: center; gap: 12px;
    }
    .empl-lv-cl  { background: #eff6ff; }
    .empl-lv-el  { background: #ecfdf5; }
    .empl-lv-ml  { background: #fff7ed; }
    .empl-lv-rh  { background: #f5f3ff; }
    .empl-leave-icon {
      width: 40px; height: 40px; border-radius: 10px;
      display: flex; align-items: center; justify-content: center;
      font-size: 18px;
    }
    .empl-lv-cl .empl-leave-icon  { background: #dbeafe; color: #1d4ed8; }
    .empl-lv-el .empl-leave-icon  { background: #dcfce7; color: #15803d; }
    .empl-lv-ml .empl-leave-icon  { background: #ffedd5; color: #c2410c; }
    .empl-lv-rh .empl-leave-icon  { background: #ede9fe; color: #6d28d9; }
    .empl-leave-name { font-size: 11px; color: #64748b; font-weight: 500; }
    .empl-leave-count {
      font-family: 'Rajdhani', sans-serif;
      font-size: 24px; font-weight: 700; color: #0f172a; line-height: 1;
    }
    .empl-leave-taken { font-size: 10.5px; color: #94a3b8; }
    .empl-leave-progress { margin-top: 4px; height: 4px; background: #e2e8f0; border-radius: 9px; overflow: hidden; }
    .empl-leave-fill { height: 100%; border-radius: 9px; }
    .empl-apply-leave-btn {
      width: 100%; background: linear-gradient(90deg,#7c3aed,#4338ca);
      color: #fff; border: none; border-radius: 9px;
      padding: 10px; font-size: 13px; font-weight: 600;
      cursor: pointer; display: flex; align-items: center;
      justify-content: center; gap: 7px; transition: all .2s;
    }
    .empl-apply-leave-btn:hover { opacity: .88; }

    /* ── NOTICE / TASKS ── */
    .empl-task-item {
      display: flex; align-items: flex-start; gap: 12px;
      padding: 11px 0; border-bottom: 1px solid #f8fafc;
    }
    .empl-task-item:last-child { border-bottom: none; }
    .empl-task-chk {
      width: 20px; height: 20px; border-radius: 5px;
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0; margin-top: 2px; font-size: 11px; cursor: pointer;
    }
    .empl-chk-done { background: #dcfce7; color: #15803d; }
    .empl-chk-todo { background: #f1f5f9; color: #94a3b8; border: 1.5px solid #e2e8f0; }
    .empl-task-text { font-size: 13px; color: #334155; font-weight: 500; line-height: 1.4; }
    .empl-task-date { font-size: 11px; color: #94a3b8; margin-top: 2px; }
    .empl-task-priority {
      font-size: 10px; font-weight: 700; padding: 2px 8px;
      border-radius: 20px; margin-top: 3px; display: inline-block;
    }
    .empl-pri-high   { background: #fee2e2; color: #b91c1c; }
    .empl-pri-medium { background: #fef3c7; color: #92400e; }
    .empl-pri-low    { background: #dcfce7; color: #15803d; }

    /* ── SERVICE HISTORY TIMELINE ── */
    .empl-timeline { position: relative; padding-left: 20px; }
    .empl-timeline::before {
      content: ''; position: absolute; left: 6px; top: 6px;
      bottom: 6px; width: 2px; background: #e2e8f0; border-radius: 2px;
    }
    .empl-tl-item { position: relative; margin-bottom: 18px; }
    .empl-tl-item:last-child { margin-bottom: 0; }
    .empl-tl-dot {
      position: absolute; left: -18px; top: 4px;
      width: 12px; height: 12px; border-radius: 50%;
      border: 2.5px solid #fff; box-shadow: 0 0 0 2px var(--empl-navy);
      background: var(--empl-navy);
    }
    .empl-tl-dot-green  { background: var(--empl-green); box-shadow: 0 0 0 2px var(--empl-green); }
    .empl-tl-dot-blue   { background: var(--empl-blue);  box-shadow: 0 0 0 2px var(--empl-blue); }
    .empl-tl-dot-amber  { background: var(--empl-amber); box-shadow: 0 0 0 2px var(--empl-amber); }
    .empl-tl-dot-purple { background: var(--empl-purple);box-shadow: 0 0 0 2px var(--empl-purple); }
    .empl-tl-year { font-size: 10.5px; font-weight: 700; color: #94a3b8; margin-bottom: 2px; }
    .empl-tl-title { font-size: 13px; font-weight: 600; color: #1e293b; }
    .empl-tl-sub   { font-size: 11.5px; color: #64748b; margin-top: 1px; }

    /* ── SERVICE INFO TABLE ── */
    .empl-info-row {
      display: flex; padding: 9px 0;
      border-bottom: 1px solid #f8fafc; font-size: 13px;
    }
    .empl-info-row:last-child { border-bottom: none; }
    .empl-info-key   { color: #64748b; font-weight: 500; width: 48%; flex-shrink: 0; text-align: left; }
    .empl-info-val   { color: #1e293b; font-weight: 600; }
    .empl-info-badge {
      font-size: 11px; font-weight: 700; padding: 2px 10px;
      border-radius: 20px; display: inline-block;
    }
    .empl-badge-active  { background: #dcfce7; color: #15803d; }
    .empl-badge-pending { background: #fef3c7; color: #92400e; }
    .empl-badge-closed  { background: #f1f5f9; color: #475569; }

    /* ── UPCOMING EVENTS ── */
    .empl-event-item {
      display: flex; gap: 12px; padding: 10px 0;
      border-bottom: 1px solid #f8fafc; align-items: flex-start;
    }
    .empl-event-item:last-child { border-bottom: none; }
    .empl-event-date {
      min-width: 44px; height: 44px; border-radius: 10px;
      display: flex; flex-direction: column;
      align-items: center; justify-content: center;
      flex-shrink: 0;
    }
    .empl-event-d { font-family: 'Rajdhani', sans-serif; font-size: 12px; font-weight: 600; line-height: 1; }
    .empl-event-m { font-size: 9.5px; font-weight: 600; text-transform: uppercase; letter-spacing: .5px; }
    .empl-event-blue   { background: #dbeafe; color: #1d4ed8; }
    .empl-event-green  { background: #dcfce7; color: #15803d; }
    .empl-event-amber  { background: #fef3c7; color: #92400e; }
    .empl-event-red    { background: #fee2e2; color: #b91c1c; }
    .empl-event-purple { background: #ede9fe; color: #6d28d9; }
    .empl-event-white { background: #fff; color: #03447a; }
    .empl-event-title  { font-size: 13px; font-weight: 600; color: #1e293b; padding-top: 10px; }
    .empl-event-sub    { font-size: 11.5px; color: #94a3b8; margin-top: 2px; }

    /* ── QUICK ACTIONS ── */
    .empl-action-grid {
      display: grid; grid-template-columns: repeat(4,1fr); gap: 10px;
    }
    .empl-action-btn {
      background: #fff; border: 1.5px solid #225B94;
      border-radius: 11px; padding: 14px 10px;
      text-align: center; cursor: pointer;
      transition: all .2s; text-decoration: none; display: block;
    }
    .empl-action-btn:hover { background: var(--empl-navy); border-color: var(--empl-navy); }
    .empl-action-btn:hover .empl-action-icon,
    .empl-action-btn:hover .empl-action-lbl { color: #fff !important; }
    .empl-action-icon { font-size: 24px; margin-bottom: 7px; display: block; }
    .empl-action-lbl { font-size: 11.5px; font-weight: 600; color: #334155; display: block; }

    /* ── FOOTER ── */
    .empl-footer {
      background: var(--empl-navy); color: #93c5fd;
      text-align: center; padding: 14px 32px;
      font-size: 12px; letter-spacing: .3px; margin-top: 10px;
    }
    .empl-footer span { color: #fbbf24; font-weight: 600; }

    /* ── BADGE CHIP ── */
    .empl-chip {
      display: inline-flex; align-items: center; gap: 5px;
      font-size: 11px; font-weight: 700; padding: 3px 10px;
      border-radius: 20px;
    }
    .empl-chip-blue   { background: #dbeafe; color: #1d4ed8; }
    .empl-chip-green  { background: #dcfce7; color: #15803d; }
    .empl-chip-amber  { background: #fef3c7; color: #92400e; }
    .empl-chip-red    { background: #fee2e2; color: #b91c1c; }

    /* ── ANIMATIONS ── */
    @keyframes empl-fadein {
      from { opacity: 0; transform: translateY(16px); }
      to   { opacity: 1; transform: translateY(0); }
    }
    .empl-profile-hero { animation: empl-fadein .4s ease both; }
    .empl-panel { animation: empl-fadein .45s ease .25s both; }

    /* ── RESPONSIVE ── */
    @media(max-width:1100px) {
      .empl-quick-grid { grid-template-columns: repeat(3,1fr); }
      .empl-main-grid  { grid-template-columns: 1fr; }
      .empl-main-grid-3 { grid-template-columns: 1fr; }
    }
    @media(max-width:640px) {
      .empl-content { padding: 16px 14px; }
      .empl-header  { padding: 0 16px; }
      .empl-quick-grid { grid-template-columns: repeat(2,1fr); }
      .empl-profile-hero { flex-direction: column; text-align: center; }
      .empl-profile-stats { justify-content: center; }
      .empl-profile-actions { flex-direction: row; }
      .empl-leave-grid { grid-template-columns: 1fr; }
    }
	.page1 h2 {
		padding-top: 5px;
		margin-bottom: 18px;
	}
</style>


        <!--==============================header=================================-->
        <form action="" method="post" enctype="multipart/form-data" name="form">
            <!--==============================Content=================================-->
			<div class="content">
				<div class="title"></div>
				<div class="container_12">
					<div class="grid_12" align="center">
						<blockquote class="bq1" style="overflow:auto">
							
						<div class="empl-wrap">

  <!-- ── HEADER ── -->
  

  <!-- ── BREADCRUMB ── -->
  <div class="empl-breadbar">
    <a href="#">🏠 Home</a>
    <span>›</span>
    <a href="#">Payroll</a>
    <span>›</span>
    <span style="color:#334155;font-weight:600;">Employee Dashboard</span>
  </div>

  <!-- ── CONTENT ── -->
  <div class="empl-content">

    <!-- PROFILE HERO -->
    <div class="empl-profile-hero">
      <div class="empl-profile-avatar empl-pro-btn empl-pro-btn-outline" style="border-radius: 50%;">Photo</div>
      <div class="empl-profile-info">
        <div align="left"><h2 class="empl-profile-name">@if(isset($EmpName)){{ $EmpName }}@endif</h2></div>
        
        <div class="empl-profile-tags">
          <span class="empl-ptag"><i class="fa fa-id-badge"></i>ICNO. : @if(isset($ICNo)){{ $ICNo }}@endif</span>
          <span class="empl-ptag"><i class="fa fa-building"></i> @if(isset($Desig)){{ $Desig }}@endif</span>
          <span class="empl-ptag"><i class="fa fa-layer-group"></i> @if(isset($OfficeName)){{ $OfficeName }}@endif</span>
          <span class="empl-ptag"><i class="fa fa-circle" style="color:#4ade80;font-size:8px;"></i> Active</span>
        </div>
      </div>
      <div class="empl-profile-stats">
        <div class="empl-pstat">
          <span class="empl-pstat-val">8</span>
          <div class="empl-pstat-lbl">Years of Service</div>
        </div>
        <div class="empl-pstat-divider"></div>
        <!-- <div class="empl-pstat">
          <span class="empl-pstat-val">94%</span>
          <div class="empl-pstat-lbl">Attendance (Feb)</div>
        </div>
        <div class="empl-pstat-divider"></div> -->
        <!-- <div class="empl-pstat">
          <span class="empl-pstat-val">12</span>
          <div class="empl-pstat-lbl">Leaves Balance</div>
        </div>
        <div class="empl-pstat-divider"></div>
        <div class="empl-pstat">
          <span class="empl-pstat-val">3</span>
          <div class="empl-pstat-lbl">Pending Tasks</div>
        </div> -->
        <button class="empl-pro-btn empl-pro-btn-outline"><i class="fa fa-user" style="font-size:15px"></i> View My Profile</button>
        <button class="empl-pro-btn empl-pro-btn-outline"><i class="fa fa-inr" style="font-size:15px"></i> View Payslip</button>
      </div>
      <!-- <div class="empl-profile-actions">
        <button class="empl-pro-btn empl-pro-btn-solid"><i class="fa fa-file-invoice"></i> View Payslip</button>
        <button class="empl-pro-btn empl-pro-btn-outline"><i class="fa fa-edit"></i> View Service Book</button>
        
      </div> -->
    </div>

    <!-- QUICK STAT CARDS -->
    <div class="empl-quick-grid">
      <div class="empl-qcard">
        <div class="empl-qcard-icon empl-qi-green"><i class="fa fa-angle-double-up"></i></div>
        <div>
          <div class="empl-qcard-val">10</div>
          <div class="empl-qcard-lbl">My Pending Requests</div>
        </div>
      </div>
      <div class="empl-qcard">
        <div class="empl-qcard-icon empl-qi-blue"><i class="fa fa-arrow-circle-o-down"></i></div>
        <div>
          <div class="empl-qcard-val">5</div>
          <div class="empl-qcard-lbl">My Inbox (Request from Other)</div>
        </div>
      </div>
      <div class="empl-qcard">
        <div class="empl-qcard-icon empl-qi-amber"><i class="fa fa-calendar-check-o"></i></div>
        <div>
          <div class="empl-qcard-val">12 Days</div>
          <div class="empl-qcard-lbl">Leave Taken this Month</div>
        </div>
      </div>
      <div class="empl-qcard">
        <div class="empl-qcard-icon empl-qi-purple"><i class="fa fa-tasks"></i></div>
        <div>
          <div class="empl-qcard-val"></div>
          <div class="empl-qcard-lbl">My Recent Activity</div>
          <div class="empl-qcard-sub">(Requests raised)</div>
        </div>
      </div>
      <div class="empl-qcard">
        <div class="empl-qcard-icon empl-qi-pink"><i class="fa fa-bell"></i></div>
        <div>
          <div class="empl-qcard-val">5 </div>
          <div class="empl-qcard-lbl">Reminders (To do list)</div>
        </div>
      </div>
    </div>

    <!-- MAIN GRID: Attendance + Salary -->
    <div class="empl-main-grid">


      <div class="empl-panel">
        <!-- <h3 class="empl-panel-title" style="margin-bottom:4px; padding-top:1px;">⚡ My Pending Actions (Forward / Recommend / Approval)</h3> -->
        <!-- <div class="empl-divider"></div> -->

        <!-- TAB BUTTONS -->
        <div style="display:flex; gap:0; margin-bottom:14px; border-radius:9px; overflow:hidden; border:1.5px solid #e2e8f0;">
          <button type="button" id="pa-tab-sent" onclick="switchPATab('sent')"
            style="flex:1; padding:9px 0; font-size:12.5px; font-weight:700; border:none; cursor:pointer;
                  background: #C5C7C9; color:#03447a; transition:all .2s;">
            <i class="fa fa-paper-plane"></i>&nbsp; My Requests Sent
          </button>
          <button type="button" id="pa-tab-inbox" onclick="switchPATab('inbox')"
            style="flex:1; padding:9px 0; font-size:12.5px; font-weight:700; border:none; cursor:pointer;
                  background:#fff; color:#03447a; transition:all .2s;">
            <i class="fa fa-inbox" style="font-size:16px"></i>&nbsp; My Inbox (Request From Others)
          </button>
        </div>

        <!-- TAB CONTENT: MY REQUESTS SENT -->
        <div id="pa-panel-sent">
          <div style="margin-bottom:10px; font-size:11.5px; color:#64748b; font-weight:600;">
            <i class="fa fa-info-circle" style="color:#3b82f6; font-size:23px;"></i>&nbsp; Requests you have raised — awaiting forward / recommendation / approval
          </div>
          <div class="empl-action-grid">
            @if(isset($DashboardContentData['MY_REQ'])) 
            @foreach($DashboardContentData['MY_REQ'] as $DashboardContent)
            <a href="@if(isset($DashboardContent->redirect_url)){{ route($DashboardContent->redirect_url) }}@endif" class="empl-action-btn" style="border: 1px solid #AFBDC7; position:relative;">
              <span class="empl-action-icon" style="color:#{{ $DashboardContent->font_color }};">{!! $DashboardContent->fa_icon !!} </span>
              <span class="empl-action-lbl">{{ $DashboardContent->content_name }}</span>
              <!-- <span style="position:absolute;top:6px;right:6px;background:#ef4444;color:#fff;font-size:9px;font-weight:700;padding:1px 6px;border-radius:20px;">3</span> -->
            </a>
            @endforeach
            @endif

            <!--<a href="#" class="empl-action-btn" style="border: 1px solid #AFBDC7; position:relative;">
              <span class="empl-action-icon" style="color:#7c3aed;"><i class="fa fa-plus-square"></i></span>
              <span class="empl-action-lbl">Medical Reimbursement</span>
              <div class="empl-event-date empl-event-white"><span class="empl-event-d">8</span></div>
            </a>
            <a href="#" class="empl-action-btn" style="border: 1px solid #AFBDC7;">
              <span class="empl-action-icon" style="color:#059669;"><i class="fa fa-id-card-o"></i></span>
              <span class="empl-action-lbl">ID Card</span>
              <div class="empl-event-date empl-event-white"><span class="empl-event-d">0</span></div>
            </a>
            <a href="#" class="empl-action-btn" style="border: 1px solid #AFBDC7;">
              <span class="empl-action-icon" style="color:#d97706;"><i class="fa fa-hospital-o"></i></span>
              <span class="empl-action-lbl">Medical Card</span>
              <div class="empl-event-date empl-event-white"><span class="empl-event-d">1</span></div>
            </a>
            <a href="#" class="empl-action-btn" style="border: 1px solid #AFBDC7; position:relative;">
              <span class="empl-action-icon" style="color:#0891b2;"><i class="fa fa-plane"></i></span>
              <span class="empl-action-lbl">LTC Advance</span>
              <div class="empl-event-date empl-event-white"><span class="empl-event-d">2</span></div>
            </a>
            <a href="#" class="empl-action-btn" style="border: 1px solid #AFBDC7;">
              <span class="empl-action-icon" style="color:#db2777;"><i class="fa fa-plane"></i></span>
              <span class="empl-action-lbl">LTC Claim</span>
              <div class="empl-event-date empl-event-white"><span class="empl-event-d">6</span></div>
            </a>
            <a href="#" class="empl-action-btn" style="border: 1px solid #AFBDC7;">
              <span class="empl-action-icon" style="color:#dc2626;"><i class="fa fa-taxi"></i></span>
              <span class="empl-action-lbl">TA</span>
              <div class="empl-event-date empl-event-white"><span class="empl-event-d">3</span></div>
            </a>
            <a href="#" class="empl-action-btn" style="border: 1px solid #AFBDC7; position:relative;">
              <span class="empl-action-icon" style="color:#4338ca;"><i class="fa fa-mobile"></i></span>
              <span class="empl-action-lbl">Data Card / Mobile Claim</span>
              <div class="empl-event-date empl-event-white"><span class="empl-event-d">1</span></div>
            </a>
            <a href="#" class="empl-action-btn" style="border: 1px solid #AFBDC7;">
              <span class="empl-action-icon" style="color:#2563eb;"><i class="fa fa-file-o"></i></span>
              <span class="empl-action-lbl">Indent</span>
              <div class="empl-event-date empl-event-white"><span class="empl-event-d">10</span></div>
            </a>
            <a href="#" class="empl-action-btn" style="border: 1px solid #AFBDC7;">
              <span class="empl-action-icon" style="color:#7c3aed;"><i class="fa fa-edit"></i></span>
              <span class="empl-action-lbl">Purchase Order</span>
              <div class="empl-event-date empl-event-white"><span class="empl-event-d">10</span></div>
            </a>
            <a href="#" class="empl-action-btn" style="border: 1px solid #AFBDC7;">
              <span class="empl-action-icon" style="color:#059669;"><i class="fa fa-id-card-o"></i></span>
              <span class="empl-action-lbl">Attendance</span>
              <div class="empl-event-date empl-event-white"><span class="empl-event-d">3</span></div>
            </a>
            <a href="#" class="empl-action-btn" style="border: 1px solid #AFBDC7;">
              <span class="empl-action-icon" style="color:#d97706;"><i class="fa fa-inr"></i></span>
              <span class="empl-action-lbl">Payroll</span>
              <div class="empl-event-date empl-event-white"><span class="empl-event-d">6</span></div>
            </a>-->
          </div>
        </div>

        <!-- TAB CONTENT: MY INBOX (FROM OTHERS) -->
        <div id="pa-panel-inbox" style="display:none;">
          <div style="margin-bottom:10px; font-size:11.5px; color:#64748b; font-weight:600;">
            <i class="fa fa-info-circle" style="color:#f59e0b; font-size:23px;"></i>&nbsp; Requests from others pending your forward / recommendation / approval
          </div>
          <div class="empl-action-grid">
            @if(isset($DashboardContentData['REQ_FROM_OTHER'])) 
            @foreach($DashboardContentData['REQ_FROM_OTHER'] as $DashboardContent)
            <a href="@if(isset($DashboardContent->redirect_url)){{ route($DashboardContent->redirect_url) }}@endif" class="empl-action-btn" style="border: 1px solid #AFBDC7; position:relative;">
              <span class="empl-action-icon" style="color:#{{ $DashboardContent->font_color }};">{!! $DashboardContent->fa_icon !!}</span>
              <span class="empl-action-lbl">{{ $DashboardContent->content_name }}</span>
              <!-- <span style="position:absolute;top:6px;right:6px;background:#ef4444;color:#fff;font-size:9px;font-weight:700;padding:1px 6px;border-radius:20px;">5</span> -->
            </a>
            @endforeach
            @endif

            <!--<a href="#" class="empl-action-btn" style="border: 1px solid #AFBDC7; position:relative;">
              <span class="empl-action-icon" style="color:#7c3aed;"><i class="fa fa-plus-square"></i></span>
              <span class="empl-action-lbl">Medical Reimbursement</span>
            </a>
            <a href="#" class="empl-action-btn" style="border: 1px solid #AFBDC7;">
              <span class="empl-action-icon" style="color:#059669;"><i class="fa fa-id-card-o"></i></span>
              <span class="empl-action-lbl">ID Card</span>
            </a>
            <a href="#" class="empl-action-btn" style="border: 1px solid #AFBDC7; position:relative;">
              <span class="empl-action-icon" style="color:#d97706;"><i class="fa fa-hospital-o"></i></span>
              <span class="empl-action-lbl">Medical Card</span>
            </a>
            <a href="#" class="empl-action-btn" style="border: 1px solid #AFBDC7;">
              <span class="empl-action-icon" style="color:#0891b2;"><i class="fa fa-plane"></i></span>
              <span class="empl-action-lbl">LTC Advance</span>
            </a>
            <a href="#" class="empl-action-btn" style="border: 1px solid #AFBDC7; position:relative;">
              <span class="empl-action-icon" style="color:#db2777;"><i class="fa fa-plane"></i></span>
              <span class="empl-action-lbl">LTC Claim</span>
            </a>
            <a href="#" class="empl-action-btn" style="border: 1px solid #AFBDC7; position:relative;">
              <span class="empl-action-icon" style="color:#dc2626;"><i class="fa fa-taxi"></i></span>
              <span class="empl-action-lbl">TA</span>
            </a>
            <a href="#" class="empl-action-btn" style="border: 1px solid #AFBDC7;">
              <span class="empl-action-icon" style="color:#4338ca;"><i class="fa fa-mobile"></i></span>
              <span class="empl-action-lbl">Data Card / Mobile Claim</span>
            </a>
            <a href="#" class="empl-action-btn" style="border: 1px solid #AFBDC7; position:relative;">
              <span class="empl-action-icon" style="color:#2563eb;"><i class="fa fa-file-o"></i></span>
              <span class="empl-action-lbl">Indent</span>
            </a>
            <a href="#" class="empl-action-btn" style="border: 1px solid #AFBDC7;">
              <span class="empl-action-icon" style="color:#7c3aed;"><i class="fa fa-edit"></i></span>
              <span class="empl-action-lbl">Purchase Order</span>
            </a>
            <a href="#" class="empl-action-btn" style="border: 1px solid #AFBDC7; position:relative;">
              <span class="empl-action-icon" style="color:#059669;"><i class="fa fa-id-card-o"></i></span>
              <span class="empl-action-lbl">Attendance</span>
            </a>
            <a href="#" class="empl-action-btn" style="border: 1px solid #AFBDC7; position:relative;">
              <span class="empl-action-icon" style="color:#d97706;"><i class="fa fa-inr"></i></span>
              <span class="empl-action-lbl">Payroll</span>
            </a>-->
          </div>
        </div>

      </div>

      <!-- ATTENDANCE PANEL -->
      <!-- <div class="empl-panel">
        <div class="empl-panel-head">
          <h3 class="empl-panel-title">📅 Attendance — February 2026</h3>
          <a href="#" class="empl-view-all">Full Log <i class="fa fa-arrow-right"></i></a>
        </div>
        <div class="empl-panel-sub">Monthly attendance overview with daily status</div>
        <div class="empl-divider"></div>


        <div class="empl-att-legend">
          <div class="empl-att-dot" style="background:#dcfce7;"></div><span class="empl-att-lbl-sm">Present</span>
          <div class="empl-att-dot" style="background:#fee2e2;"></div><span class="empl-att-lbl-sm">Absent</span>
          <div class="empl-att-dot" style="background:#fef3c7;"></div><span class="empl-att-lbl-sm">Leave</span>
          <div class="empl-att-dot" style="background:#f5f3ff;"></div><span class="empl-att-lbl-sm">Holiday</span>
          <div class="empl-att-dot" style="background:#dbeafe;"></div><span class="empl-att-lbl-sm">Half Day</span>
          <div class="empl-att-dot" style="background:var(--empl-navy);border-radius:3px;"></div><span class="empl-att-lbl-sm">Today</span>
        </div>


        <div class="empl-att-grid">
          <div class="empl-att-day-hdr">SUN</div>
          <div class="empl-att-day-hdr">MON</div>
          <div class="empl-att-day-hdr">TUE</div>
          <div class="empl-att-day-hdr">WED</div>
          <div class="empl-att-day-hdr">THU</div>
          <div class="empl-att-day-hdr">FRI</div>
          <div class="empl-att-day-hdr">SAT</div>


          <div class="empl-att-cell empl-att-holiday" title="Republic Day Holiday">1<br><span style="font-size:8px">HOL</span></div>
          <div class="empl-att-cell empl-att-present" title="Present">2</div>
          <div class="empl-att-cell empl-att-present" title="Present">3</div>
          <div class="empl-att-cell empl-att-present" title="Present">4</div>
          <div class="empl-att-cell empl-att-present" title="Present">5</div>
          <div class="empl-att-cell empl-att-present" title="Present">6</div>
          <div class="empl-att-cell empl-att-holiday" title="Saturday Holiday">7</div>

          <div class="empl-att-cell empl-att-holiday" title="Sunday">8</div>
          <div class="empl-att-cell empl-att-present" title="Present">9</div>
          <div class="empl-att-cell empl-att-present" title="Present">10</div>
          <div class="empl-att-cell empl-att-present" title="Present">11</div>
          <div class="empl-att-cell empl-att-leave" title="CL Leave">12<br><span style="font-size:8px">CL</span></div>
          <div class="empl-att-cell empl-att-leave" title="CL Leave">13<br><span style="font-size:8px">CL</span></div>
          <div class="empl-att-cell empl-att-holiday" title="Saturday">14</div>

          <div class="empl-att-cell empl-att-holiday" title="Sunday">15</div>
          <div class="empl-att-cell empl-att-present" title="Present">16</div>
          <div class="empl-att-cell empl-att-present" title="Present">17</div>
          <div class="empl-att-cell empl-att-present" title="Present">18</div>
          <div class="empl-att-cell empl-att-present" title="Present">19</div>
          <div class="empl-att-cell empl-att-half" title="Half Day">20<br><span style="font-size:8px">HD</span></div>
          <div class="empl-att-cell empl-att-holiday" title="Saturday">21</div>

          <div class="empl-att-cell empl-att-holiday" title="Sunday">22</div>
          <div class="empl-att-cell empl-att-present" title="Present">23</div>
          <div class="empl-att-cell empl-att-present" title="Present">24</div>
          <div class="empl-att-cell empl-att-today" title="Today">25</div>
          <div class="empl-att-cell empl-att-future" title="Upcoming">26</div>
          <div class="empl-att-cell empl-att-future" title="Upcoming">27</div>
          <div class="empl-att-cell empl-att-holiday" title="Saturday">28</div>
        </div>

        <div class="empl-att-summary">
          <div class="empl-att-bar-seg" style="width:71%;background:#22c55e;" title="Present"></div>
          <div class="empl-att-bar-seg" style="width:8%; background:#f59e0b;" title="Leave"></div>
          <div class="empl-att-bar-seg" style="width:4%; background:#3b82f6;" title="Half Day"></div>
          <div class="empl-att-bar-seg" style="width:17%;background:#e2e8f0;" title="Holiday/Weekend"></div>
        </div>

        <div class="empl-att-stat-row">
          <div class="empl-att-stat-box">
            <span class="empl-att-stat-num" style="color:#15803d;">22</span>
            <span class="empl-att-stat-lbl">Present</span>
          </div>
          <div class="empl-att-stat-box">
            <span class="empl-att-stat-num" style="color:#d97706;">2</span>
            <span class="empl-att-stat-lbl">On Leave</span>
          </div>
          <div class="empl-att-stat-box">
            <span class="empl-att-stat-num" style="color:#1d4ed8;">1</span>
            <span class="empl-att-stat-lbl">Half Day</span>
          </div>
          <div class="empl-att-stat-box">
            <span class="empl-att-stat-num" style="color:#6d28d9;">3</span>
            <span class="empl-att-stat-lbl">Pending</span>
          </div>
        </div>
      </div> -->

      <!-- SALARY PANEL -->
      



      <!-- SALARY PANEL -->
      <div class="empl-panel">
        <div class="empl-panel-head">
          <h3 class="empl-panel-title" style="padding-top:2px">🗓️ Change Request (Self Service)</h3>
        </div>
        <div class="empl-divider"></div>

        <!-- TAB BUTTONS -->
        <div style="display:flex; gap:0; margin-bottom:14px; border-radius:9px; overflow:hidden; border:1.5px solid #e2e8f0;">
          <button type="button" id="cr-tab-sent" onclick="switchCRTab('sent')"
            style="flex:1; padding:9px 0; font-size:12.5px; font-weight:700; border:none; cursor:pointer;
                  background: #C5C7C9; color:#03447a; transition:all .2s;">
            <i class="fa fa-paper-plane"></i>&nbsp; My Requests
          </button>
          <button type="button" id="cr-tab-inbox" onclick="switchCRTab('inbox')"
            style="flex:1; padding:9px 0; font-size:12.5px; font-weight:700; border:none; cursor:pointer;
                  background:#fff; color:#03447a; transition:all .2s;">
            <i class="fa fa-inbox"></i>&nbsp; My Inbox
          </button>
        </div>

        <!-- TAB CONTENT: MY REQUESTS -->
        <div id="cr-panel-sent">
            @if(isset($DashboardContentData['MY_CH_REQ'])) 
            @foreach($DashboardContentData['MY_CH_REQ'] as $DashboardContent)
            <div class="empl-event-item" style="cursor: pointer;" @if(isset($DashboardContent->redirect_url)) onclick="window.location='{{ route($DashboardContent->redirect_url)}}'" @endif>
              <div class="empl-event-date {{ $DashboardContent->fa_icon }}"><span class="empl-event-d">-</span></div>
              <div><div class="empl-event-title">{{ $DashboardContent->content_name }}</div>
              </div>
            </div>
            @endforeach
            @endif
          <!-- <div class="empl-event-item">
            <div class="empl-event-date empl-event-amber"><span class="empl-event-d">03</span></div>
            <div><div class="empl-event-title">Contact No. Update</div>
            </div>
          </div>
          <div class="empl-event-item">
            <div class="empl-event-date empl-event-purple"><span class="empl-event-d">08</span></div>
            <div><div class="empl-event-title">Family Member Update</div>
            </div>
          </div>
          <div class="empl-event-item">
            <div class="empl-event-date empl-event-red"><span class="empl-event-d">10</span></div>
            <div><div class="empl-event-title">Marital Status Update</div>
            </div>
          </div>
          <div class="empl-event-item">
            <div class="empl-event-date empl-event-green"><span class="empl-event-d">14</span></div>
            <div><div class="empl-event-title">Nominee Update</div>
            </div>
          </div>
          <div class="empl-event-item">
            <div class="empl-event-date empl-event-blue"><span class="empl-event-d">28</span></div>
            <div><div class="empl-event-title">Physical Disability Update</div>
            </div>
          </div>
          <div class="empl-event-item">
            <div class="empl-event-date empl-event-amber"><span class="empl-event-d">03</span></div>
            <div><div class="empl-event-title">Home Town Update</div>
            </div>
          </div> -->
        </div>

        <!-- TAB CONTENT: MY INBOX -->
        <div id="cr-panel-inbox" style="display:none;">
          @if(isset($DashboardContentData['CH_REQ_FROM_OTHER'])) 
          @foreach($DashboardContentData['CH_REQ_FROM_OTHER'] as $DashboardContent)
          <div class="empl-event-item" style="cursor: pointer;" @if(isset($DashboardContent->redirect_url)) onclick="window.location='{{ route($DashboardContent->redirect_url)}}'" @endif>
            <div class="empl-event-date {{ $DashboardContent->fa_icon }}"><span class="empl-event-d">-</span></div>
            <div><div class="empl-event-title">{{ $DashboardContent->content_name }}</div>
            </div>
          </div>
          @endforeach
          @endif
          <!-- <div class="empl-event-item">
            <div class="empl-event-date empl-event-amber"><span class="empl-event-d">11</span></div>
            <div><div class="empl-event-title">Contact No. Update</div>
            </div>
          </div>
          <div class="empl-event-item">
            <div class="empl-event-date empl-event-purple"><span class="empl-event-d">05</span></div>
            <div><div class="empl-event-title">Family Member Update</div>
            </div>
          </div>
          <div class="empl-event-item">
            <div class="empl-event-date empl-event-red"><span class="empl-event-d">06</span></div>
            <div><div class="empl-event-title">Marital Status Update</div>
            </div>
          </div>
          <div class="empl-event-item">
            <div class="empl-event-date empl-event-green"><span class="empl-event-d">07</span></div>
            <div><div class="empl-event-title">Nominee Update</div>
            </div>
          </div>
          <div class="empl-event-item">
            <div class="empl-event-date empl-event-blue"><span class="empl-event-d">08</span></div>
            <div><div class="empl-event-title">Physical Disability Update</div>
            </div>
          </div>
          <div class="empl-event-item">
            <div class="empl-event-date empl-event-amber"><span class="empl-event-d">02</span></div>
            <div><div class="empl-event-title">Home Town Update</div>
            </div>
          </div> -->
        </div>

      </div>

    </div>
    <!-- END MAIN GRID -->

    <!-- 3-COLUMN GRID: Leave + Service Info + Events -->
    <div class="empl-main-grid-3">

      <!-- <div class="empl-panel">
        <div class="empl-panel-head">
          <h3 class="empl-panel-title">🏖️ Leave Balance</h3>
          <a href="#" class="empl-view-all">Apply <i class="fa fa-plus"></i></a>
        </div>
        <div class="empl-panel-sub">Current year leave entitlement &amp; usage</div>
        <div class="empl-divider"></div>
        <div class="empl-leave-grid">
          <div class="empl-leave-card empl-lv-cl">
            <div class="empl-leave-icon"><i class="fa fa-coffee"></i></div>
            <div style="flex:1;">
              <div class="empl-leave-name">Casual Leave</div>
              <div class="empl-leave-count">6 <span style="font-size:13px;color:#94a3b8;font-family:'DM Sans'">/ 8</span></div>
              <div class="empl-leave-taken">Used: 2 days</div>
              <div class="empl-leave-progress">
                <div class="empl-leave-fill" style="width:75%;background:#3b82f6;"></div>
              </div>
            </div>
          </div>
          <div class="empl-leave-card empl-lv-el">
            <div class="empl-leave-icon"><i class="fa fa-sun"></i></div>
            <div style="flex:1;">
              <div class="empl-leave-name">Earned Leave</div>
              <div class="empl-leave-count">18 <span style="font-size:13px;color:#94a3b8;font-family:'DM Sans'">/ 30</span></div>
              <div class="empl-leave-taken">Used: 12 days</div>
              <div class="empl-leave-progress">
                <div class="empl-leave-fill" style="width:60%;background:#10b981;"></div>
              </div>
            </div>
          </div>
          <div class="empl-leave-card empl-lv-ml">
            <div class="empl-leave-icon"><i class="fa fa-briefcase-medical"></i></div>
            <div style="flex:1;">
              <div class="empl-leave-name">Medical Leave</div>
              <div class="empl-leave-count">20 <span style="font-size:13px;color:#94a3b8;font-family:'DM Sans'">/ 20</span></div>
              <div class="empl-leave-taken">Used: 0 days</div>
              <div class="empl-leave-progress">
                <div class="empl-leave-fill" style="width:100%;background:#f59e0b;"></div>
              </div>
            </div>
          </div>
          <div class="empl-leave-card empl-lv-rh">
            <div class="empl-leave-icon"><i class="fa fa-flag"></i></div>
            <div style="flex:1;">
              <div class="empl-leave-name">Restricted Holiday</div>
              <div class="empl-leave-count">1 <span style="font-size:13px;color:#94a3b8;font-family:'DM Sans'">/ 2</span></div>
              <div class="empl-leave-taken">Used: 1 day</div>
              <div class="empl-leave-progress">
                <div class="empl-leave-fill" style="width:50%;background:#7c3aed;"></div>
              </div>
            </div>
          </div>
        </div>
        <button class="empl-apply-leave-btn"><i class="fa fa-calendar-plus"></i> Apply for Leave</button>
      </div> -->

      <!-- SERVICE INFO -->
      <!-- <div class="empl-panel">
        <div class="empl-panel">
          <div class="empl-panel-head">
            <h3 class="empl-panel-title">📜 Service History</h3>
          </div>
          <div class="empl-panel-sub">Career progression at IMSC</div>
          <div class="empl-divider"></div>
          <div class="empl-timeline">
            <div class="empl-tl-item">
              <div class="empl-tl-dot empl-tl-dot-green"></div>
              <div class="empl-tl-year">2024 – Present</div>
              <div class="empl-tl-title">Senior Technical Officer – I (STO-I)</div>
              <div class="empl-tl-sub">Promoted — Level 10 · Computer Division</div>
            </div>
            <div class="empl-tl-item">
              <div class="empl-tl-dot empl-tl-dot-blue"></div>
              <div class="empl-tl-year">2021 – 2024</div>
              <div class="empl-tl-title">Technical Officer (TO)</div>
              <div class="empl-tl-sub">Promoted — Level 7 · Computer Division</div>
            </div>
            <div class="empl-tl-item">
              <div class="empl-tl-dot empl-tl-dot-amber"></div>
              <div class="empl-tl-year">2018 – 2021</div>
              <div class="empl-tl-title">Technical Assistant (TA)</div>
              <div class="empl-tl-sub">Initial appointment — Level 6 · Library</div>
            </div>
          </div>
        </div>
      </div> -->

      <!-- UPCOMING EVENTS -->
      <!-- <div class="empl-panel">
        <div class="empl-panel-head">
          <h3 class="empl-panel-title">🗓️ Upcoming Events</h3>
          <a href="#" class="empl-view-all">Calendar <i class="fa fa-arrow-right"></i></a>
        </div>
        <div class="empl-panel-sub">Holidays, deadlines &amp; announcements</div>
        <div class="empl-divider"></div>

        <div class="empl-event-item">
          <div class="empl-event-date empl-event-blue"><span class="empl-event-d">28</span><span class="empl-event-m">Feb</span></div>
          <div>
            <div class="empl-event-title">Salary Disbursement</div>
            <div class="empl-event-sub">February 2026 net salary credit</div>
            <span class="empl-chip empl-chip-green" style="margin-top:4px;"><i class="fa fa-check-circle"></i> Credited</span>
          </div>
        </div>
        <div class="empl-event-item">
          <div class="empl-event-date empl-event-amber"><span class="empl-event-d">03</span><span class="empl-event-m">Mar</span></div>
          <div>
            <div class="empl-event-title">Stores Stock Audit</div>
            <div class="empl-event-sub">Submit dept. stock count report</div>
            <span class="empl-chip empl-chip-amber" style="margin-top:4px;"><i class="fa fa-clock"></i> Upcoming</span>
          </div>
        </div>
        <div class="empl-event-item">
          <div class="empl-event-date empl-event-purple"><span class="empl-event-d">08</span><span class="empl-event-m">Mar</span></div>
          <div>
            <div class="empl-event-title">International Women's Day</div>
            <div class="empl-event-sub">Optional Restricted Holiday (RH)</div>
            <span class="empl-chip empl-chip-blue" style="margin-top:4px;"><i class="fa fa-flag"></i> RH</span>
          </div>
        </div>
        <div class="empl-event-item">
          <div class="empl-event-date empl-event-red"><span class="empl-event-d">10</span><span class="empl-event-m">Mar</span></div>
          <div>
            <div class="empl-event-title">APAR Submission Deadline</div>
            <div class="empl-event-sub">Self-appraisal report due FY 25-26</div>
            <span class="empl-chip empl-chip-red" style="margin-top:4px;"><i class="fa fa-exclamation-circle"></i> Action Needed</span>
          </div>
        </div>
        <div class="empl-event-item">
          <div class="empl-event-date empl-event-green"><span class="empl-event-d">14</span><span class="empl-event-m">Mar</span></div>
          <div>
            <div class="empl-event-title">Holi</div>
            <div class="empl-event-sub">Gazetted Holiday — Office closed</div>
            <span class="empl-chip empl-chip-green" style="margin-top:4px;"><i class="fa fa-umbrella-beach"></i> Holiday</span>
          </div>
        </div>
      </div> -->

    </div>
    <!-- END 3-COL GRID -->

    <!-- BOTTOM GRID: Tasks + Timeline + Quick Actions -->
    <!--<div class="empl-main-grid">

      <div class="empl-panel">
        <div class="empl-panel-head">
          <h3 class="empl-panel-title">✅ My Tasks &amp; Pending Actions</h3>
          <a href="#" class="empl-view-all">View All <i class="fa fa-arrow-right"></i></a>
        </div>
        <div class="empl-panel-sub">Official to-dos and pending submissions</div>
        <div class="empl-divider"></div>

        <div class="empl-task-item">
          <div class="empl-task-chk empl-chk-todo"><i class="fa fa-check"></i></div>
          <div>
            <div class="empl-task-text">Submit APAR Self-Appraisal Report (FY 2025-26)</div>
            <div class="empl-task-date">Deadline: 10-Mar-2026</div>
            <span class="empl-task-priority empl-pri-high">High Priority</span>
          </div>
        </div>
        <div class="empl-task-item">
          <div class="empl-task-chk empl-chk-todo"><i class="fa fa-check"></i></div>
          <div>
            <div class="empl-task-text">Update Property Return Statement (Annual Return)</div>
            <div class="empl-task-date">Deadline: 31-Mar-2026</div>
            <span class="empl-task-priority empl-pri-high">High Priority</span>
          </div>
        </div>
        <div class="empl-task-item">
          <div class="empl-task-chk empl-chk-todo"><i class="fa fa-check"></i></div>
          <div>
            <div class="empl-task-text">Submit Investment Proof Documents (IT Section)</div>
            <div class="empl-task-date">Deadline: 15-Mar-2026</div>
            <span class="empl-task-priority empl-pri-medium">Medium Priority</span>
          </div>
        </div>
        <div class="empl-task-item">
          <div class="empl-task-chk empl-chk-done"><i class="fa fa-check"></i></div>
          <div>
            <div class="empl-task-text" style="text-decoration:line-through;color:#94a3b8;">Biometric Attendance Registration (new system)</div>
            <div class="empl-task-date">Completed: 15-Feb-2026</div>
            <span class="empl-task-priority empl-pri-low">Done</span>
          </div>
        </div>
        <div class="empl-task-item">
          <div class="empl-task-chk empl-chk-done"><i class="fa fa-check"></i></div>
          <div>
            <div class="empl-task-text" style="text-decoration:line-through;color:#94a3b8;">Submit bank account details for revised salary</div>
            <div class="empl-task-date">Completed: 02-Feb-2026</div>
            <span class="empl-task-priority empl-pri-low">Done</span>
          </div>
        </div>
      </div>

      <div style="display:flex;flex-direction:column;gap:20px;">

        <div class="empl-panel">
          <div class="empl-panel-head">
            <h3 class="empl-panel-title">📜 Service History</h3>
          </div>
          <div class="empl-panel-sub">Career progression at IMSC</div>
          <div class="empl-divider"></div>
          <div class="empl-timeline">
            <div class="empl-tl-item">
              <div class="empl-tl-dot empl-tl-dot-green"></div>
              <div class="empl-tl-year">2024 – Present</div>
              <div class="empl-tl-title">Senior Technical Officer – I (STO-I)</div>
              <div class="empl-tl-sub">Promoted — Level 10 · Computer Division</div>
            </div>
            <div class="empl-tl-item">
              <div class="empl-tl-dot empl-tl-dot-blue"></div>
              <div class="empl-tl-year">2021 – 2024</div>
              <div class="empl-tl-title">Technical Officer (TO)</div>
              <div class="empl-tl-sub">Promoted — Level 7 · Computer Division</div>
            </div>
            <div class="empl-tl-item">
              <div class="empl-tl-dot empl-tl-dot-amber"></div>
              <div class="empl-tl-year">2018 – 2021</div>
              <div class="empl-tl-title">Technical Assistant (TA)</div>
              <div class="empl-tl-sub">Initial appointment — Level 6 · Library</div>
            </div>
          </div>
        </div>

        <div class="empl-panel">
          <h3 class="empl-panel-title" style="margin-bottom:4px;">⚡ Quick Actions</h3>
          <div class="empl-panel-sub">Frequently used shortcuts</div>
          <div class="empl-divider"></div>
          <div class="empl-action-grid">
            <a href="#" class="empl-action-btn">
              <span class="empl-action-icon" style="color:#2563eb;"><i class="fa fa-file-invoice"></i></span>
              <span class="empl-action-lbl">Payslip</span>
            </a>
            <a href="#" class="empl-action-btn">
              <span class="empl-action-icon" style="color:#7c3aed;"><i class="fa fa-calendar-plus"></i></span>
              <span class="empl-action-lbl">Apply Leave</span>
            </a>
            <a href="#" class="empl-action-btn">
              <span class="empl-action-icon" style="color:#059669;"><i class="fa fa-clock"></i></span>
              <span class="empl-action-lbl">OD Entry</span>
            </a>
            <a href="#" class="empl-action-btn">
              <span class="empl-action-icon" style="color:#d97706;"><i class="fa fa-receipt"></i></span>
              <span class="empl-action-lbl">TA Bill</span>
            </a>
            <a href="#" class="empl-action-btn">
              <span class="empl-action-icon" style="color:#0891b2;"><i class="fa fa-print"></i></span>
              <span class="empl-action-lbl">Print Form</span>
            </a>
            <a href="#" class="empl-action-btn">
              <span class="empl-action-icon" style="color:#db2777;"><i class="fa fa-star"></i></span>
              <span class="empl-action-lbl">APAR</span>
            </a>
            <a href="#" class="empl-action-btn">
              <span class="empl-action-icon" style="color:#dc2626;"><i class="fa fa-headset"></i></span>
              <span class="empl-action-lbl">Help Desk</span>
            </a>
            <a href="#" class="empl-action-btn">
              <span class="empl-action-icon" style="color:#4338ca;"><i class="fa fa-lock"></i></span>
              <span class="empl-action-lbl">Change PIN</span>
            </a>
          </div>
        </div>

      </div> 

    </div>-->
    <!-- END BOTTOM GRID -->

  </div>
  <!-- END CONTENT -->

  

</div>
<!-- END EMPLOYEE DASHBOARD WRAP -->

<script>
  // Animate bars on load
  window.addEventListener('load', () => {
    document.querySelectorAll('.empl-att-bar-seg, .empl-leave-fill').forEach(el => {
      const w = el.style.width;
      el.style.width = '0%';
      setTimeout(() => { el.style.width = w; }, 300);
    });
  });

  // Task checkbox toggle
  document.querySelectorAll('.empl-task-chk').forEach(chk => {
    chk.addEventListener('click', function() {
      const isDone = this.classList.contains('empl-chk-done');
      const txt = this.closest('.empl-task-item').querySelector('.empl-task-text');
      if (isDone) {
        this.classList.replace('empl-chk-done', 'empl-chk-todo');
        txt.style.textDecoration = 'none';
        txt.style.color = '#334155';
      } else {
        this.classList.replace('empl-chk-todo', 'empl-chk-done');
        txt.style.textDecoration = 'line-through';
        txt.style.color = '#94a3b8';
      }
    });
  });

  // Download payslip button
  document.querySelector('.empl-payslip-btn').addEventListener('click', function() {
    this.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Generating...';
    setTimeout(() => {
      this.innerHTML = '<i class="fa fa-check-circle"></i> Downloaded!';
      setTimeout(() => {
        this.innerHTML = '<i class="fa fa-download"></i> Download Payslip (PDF)';
      }, 2000);
    }, 1500);
  });

  // Pro buttons feedback
  document.querySelectorAll('.empl-pro-btn-solid').forEach(btn => {
    btn.addEventListener('click', function() {
      const orig = this.innerHTML;
      this.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Loading...';
      setTimeout(() => { this.innerHTML = orig; }, 1500);
    });
  });


  function switchCRTab(tab) {
    const sentPanel  = document.getElementById('cr-panel-sent');
    const inboxPanel = document.getElementById('cr-panel-inbox');
    const sentBtn    = document.getElementById('cr-tab-sent');
    const inboxBtn   = document.getElementById('cr-tab-inbox');

    if (tab === 'sent') {
      sentPanel.style.display  = 'block';
      inboxPanel.style.display = 'none';
      sentBtn.style.background  = '#C5C7C9';
      sentBtn.style.color       = '#03447a';
      inboxBtn.style.background = '#f8fafc';
      inboxBtn.style.color      = '#03447a';
    } else {
      sentPanel.style.display  = 'none';
      inboxPanel.style.display = 'block';
      inboxBtn.style.background  = '#C5C7C9';
      inboxBtn.style.color       = '#03447a';
      sentBtn.style.background = '#f8fafc';
      sentBtn.style.color      = '#03447a';
    }
  }
  function switchPATab(tab) {
    const sentPanel  = document.getElementById('pa-panel-sent');
    const inboxPanel = document.getElementById('pa-panel-inbox');
    const sentBtn    = document.getElementById('pa-tab-sent');
    const inboxBtn   = document.getElementById('pa-tab-inbox');

    if (tab === 'sent') {
      sentPanel.style.display   = 'block';
      inboxPanel.style.display  = 'none';
      sentBtn.style.background  = '#C5C7C9';
      sentBtn.style.color       = '#03447a';
      inboxBtn.style.background = '#f8fafc';
      inboxBtn.style.color      = '#03447a';
    } else {
      sentPanel.style.display   = 'none';
      inboxPanel.style.display  = 'block';
      inboxBtn.style.background = '#C5C7C9';
      inboxBtn.style.color      = '#03447a';
      sentBtn.style.background  = '#f8fafc';
      sentBtn.style.color       = '#03447a';
    }
  }
</script>



						</blockquote>
					</div>
				</div>
			</div>
			
			
			
			
            <!--==============================footer=================================-->
        </form>

@endsection