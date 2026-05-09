<header class="mm-header"> 
		<!-- <a href="#" class="logo">LOGO</a> -->
		<nav>
			<h1>
				<a>
					<img src="{{asset('images/BARCLogo.png')}}" alt="logo">
				</a>
			</h1>
			<h4>
				<a>
					<div class="titleHead">IMSc Office Automation System</div>
					<div class="sub-titleHead">Taramani, Chennai.</div>
				</a>
			</h4>
			<div align="right">

				

				<div class="topmenu-link logout" style="background:#ff336c; font-weight:600; border:1px solid #ff336c;">
					<a href="{{ url('/logout') }}" title="Logout"> <i class="fa fa-power-off topmenu-icon"></i> Logout</a>
				</div>
				<div class="topmenu-link">
					<a href="{{ route('dashboard.index') }}" title="Home"> <i class="fa fa-home topmenu-icon" style="padding-top:3px"></i> Home</a>
				</div>
				<div class="topmenu-link">
					<a href="" title="User Manual"> <i class="fa fa-download topmenu-icon"></i> User Manual </a>
				</div>
				@if (session()->has('WcmsEmpRoles'))
				@if((session('WcmsEmpRoles') != NULL)&&(count(session('WcmsEmpRoles'))>1))
				<div class="topmenu-link">
					<a id='switch_role' title="Switch User Role"> <i class="fa fa-exchange topmenu-icon" style="padding-top:3px;"></i> &nbsp;Switch Role</a>
				</div>
				@endif
				@endif
				<!-- <div class="topmenu-text">
					Last login : {{ date('d/m/Y H:i:s') }} 
				</div> 
				<div class="topmenu-text">|</div>-->
				<div class="topmenu-text" style="padding-top:10px;line-height: 1.4;"> 
					<div class="tooltip-l" style="width:100%">
						Logged in as @if(session()->has('WcmsEmpRoleName')){{ session('WcmsEmpRoleName') }}@endif <br>
						<!-- <span class="showdiv_admin" data-id="@if(session('WcmsRoleGroupCode') == 'ENDUSER' || session('WcmsRoleGroupCode') == 'ADMUSER' || session('WcmsRoleGroupCode') == 'SUPUSER'){{encrypt(21)}} @elseif(session('WcmsRoleGroupCode') == 'ACCUSER' || session('WcmsRoleGroupCode') == 'ACCADMUSER'){{encrypt(22)}}@endif">
							@if(session()->has('EmpDivShName'))( {{ trim(session('EmpDivShName')) }} @if(session()->has('EmpSecShName'))/ {{trim(session('EmpSecShName'))}}@endif )@endif						
						</span> -->
						<!-- <span class="tooltiptext adminlist" data-html="true" style="text-align:justify; z-index:9999; font-weight:bold; width:220px; font-family:verdana; font-size:10px; padding:10px;">
						@if(session('WcmsRoleGroupCode') == 'ENDUSER' || session('WcmsRoleGroupCode') == 'ADMUSER')
							<div class="row" align="center" style="font-size:11px;"><u>@if(session()->has('EmpDivShName')){{ trim(session('EmpDivShName')) }}@endif Division Administrator</u></div>
						@elseif(session('WcmsRoleGroupCode') == 'ACCUSER' || session('WcmsRoleGroupCode') == 'ACCADMUSER')
							<div class="row" align="center" ><u>@if(session()->has('EmpSecShName')){{ trim(session('EmpSecShName')) }}@endif Finance Administrator</u></div>
						@elseif(session('WcmsRoleGroupCode') == 'SUPUSER')
							<div class="row" align="center" style="font-size:11px;"><u>Division Administrator</u></div>
						@endif		
						</span> -->
					</div>
				</div>
				<div class="topmenu-text">|</div>
				<div class="topmenu-text">
					Welcome ! @if(session()->has('WcmsEmpName')){{ session('WcmsEmpName') }}@endif 
					@php
					if(session()->has('WcmsEmpName')){
						$menu = session('Menus');
					}else{
						$menu = array();
					} 
					
					function buildCategory($parent, $category,$MenuType) {
						$html = ""; 
						if (isset($category['parent_cats'][$parent])) { 
							$FirstChild = true; $LFirstChild = true;
							foreach ($category['parent_cats'][$parent] as $cat_id) { 
								$ModuleName = $category['categories'][$cat_id]['module_name']; 
								$ModuleId = $category['categories'][$cat_id]['moduleid']; 
								$MenuUrl = $category['categories'][$cat_id]['menu_url']; if($MenuUrl == "##"){ $MenuUrl = ""; }
								$PageCode = $category['categories'][$cat_id]['page_code'];
								if(($MenuUrl != '#')&&($MenuUrl != NULL)){
									$MenuUrl = route($MenuUrl);
								}
								if(($PageCode != '')&&($PageCode != NULL)){
									$MenuPageCode = encrypt($PageCode);
								}else{
									$MenuPageCode = '';
								}
								
								
								if (!isset($category['parent_cats'][$cat_id])) { 
									if($MenuType == 'CHILD'){ 
										if($MenuPageCode != ''){ 
                  							$html .= '<a class="mega-item" href="'.$MenuUrl.'">';
											$html .= '<div class="mi-text">';
											$html .= '<div class="mi-title">'.$ModuleName.'</div>';
											//$html .= '<div class="mi-desc">Monitoring &amp; APM</div>';
											$html .= '</div>';
											$html .= '<span class="mi-arrow">›</span>';
											$html .= '</a>';
										}else{ 
											$html .= '<a class="mega-item" href="'.$MenuUrl.'">';
											$html .= '<div class="mi-text">';
											$html .= '<div class="mi-title">'.$ModuleName.'</div>';
											//$html .= '<div class="mi-desc">Monitoring &amp; APM</div>';
											$html .= '</div>';
											$html .= '<span class="mi-arrow">›</span>';
											$html .= '</a>';
										}
									}
								}
								if(isset($category['parent_cats'][$cat_id])) {  
									
									if($MenuType == 'TCHILD1'){ 
										$html .= '<div>';
										$html .= '<div class="mega-col-label">'.$ModuleName.'</div>';
										$html .= buildCategory($cat_id, $category,"CHILD");
										$html .= "</div>";
									}
									if(($category['categories'][$cat_id]['menu_type'] == 'LMMENU')||($MenuType == "LMMENU")){
										$IsTabMenu = 1;
									}else if(($category['categories'][$cat_id]['menu_type'] == 'MMENU')||($MenuType == "MMENU")){
										$IsTabMenu = 1;
									}else{
										$IsTabMenu = 0;
									}
									

									if($IsTabMenu == 1){
										if($category['categories'][$cat_id]['parentid'] == 0){
											$html .= '<li class="nav-item" data-menu="menu-'.$ModuleId.'">';
											$html .= '<button class="nav-btn">⚡'.$ModuleName;
											$html .= '<svg width="12" height="12" viewBox="0 0 12 12" fill="currentColor"><path d="M2 4l4 4 4-4"/></svg>';
											$html .= '</button>';
											$html .= '<div class="mega-panel" id="menu-'.$ModuleId.'">';
											$html .= '<div class="mega-inner">';
											if(isset($category['parent_cats'][$cat_id])){ 
												$html .= '<div class="mkt-tabs-bar">';
												$x = 0;
												foreach($category['parent_cats'][$cat_id] as $tab_id) {
													if($x == 0){
														$ActiveClass = " mega-first-child active";
													}else{
														$ActiveClass = "";
													}
													$TabModuleName = $category['categories'][$tab_id]['module_name']; 
													$TabModuleId = $category['categories'][$tab_id]['moduleid']; 
													$html .= '<button class="mkt-tab-btn'.$ActiveClass.'" data-mkt-tab="mega-menu-tab-'.$TabModuleId.'"><span class="mkt-tab-icon">⚡</span> '.$TabModuleName.'</button>';
													$x++;
												}
												$html .= '</div>';
												$x = 0;
												foreach($category['parent_cats'][$cat_id] as $tab_id) {
													if($x == 0){
														$ActiveClass = " mega-first-child active";
													}else{
														$ActiveClass = "";
													}
													$TabChildModuleName = $category['categories'][$tab_id]['module_name']; 
													$TabChildModuleId = $category['categories'][$tab_id]['moduleid']; 
													$html .= '<div class="mkt-tab-pane'.$ActiveClass.'" id="mega-menu-tab-'.$TabChildModuleId.'">';
													$html .= '<div class="mega-cols mega-cols-6">';
													$html .= buildCategory($tab_id, $category,"TCHILD1");
													$html .= '</div>';
													$html .= '</div>';
													$x++;
												}



											}
											$html .= '</div>';
											$html .= '</div>';
											$html .= '</li>';

										}
									}
									
								}
							}
						}
						return $html;
					}
					
					@endphp
				</div>
				<div>&nbsp;</div>
				<div>&nbsp;</div>
			</div>

			<ul class="nav-list">
				@php echo buildCategory(0, $menu,"X"); @endphp
			</ul>
			
			
		</nav>
	</header>


<div class="mega-overlay" id="menu-overlay"></div>

<script>
$('body').on("click", "#switch_role", function (event) {
    $.ajax({
        type: 'POST',
        url: "{{ route('rolemapping.SwitchEmployeeRole') }}",
		data: {"_token": "{{ Session::token() }}"},
        dataType: 'json',
        success: function (response) {
            var EmpData = response.EmpData;
			var EmpName = response.EmpName;
			var EmpRoleMapId = response.EmpRoleMapId;
            if (EmpData && EmpData.length > 0) {
                var TableStr = '';
                TableStr += '<table class="table dataTable rtable table2excel example" id="StmtTable" border="1" width="100%" align="center">';
                TableStr += '<thead><tr><th>Employee Details</th></tr></thead>';
                TableStr += '<tbody>';                
                TableStr += '<tr><td style="text-align:left">Employee No: ' + EmpData[0].employee_no + '</td></tr>';
				TableStr += '<tr><td style="text-align:left">Employee Name: ' + EmpName + '</td></tr>';
				TableStr += '</tbody>';
                TableStr += '</table>';
				TableStr += '<table class="table dataTable rtable table2excel example" id="StmtTable" border="1" width="100%" align="center">';
                TableStr += '<thead><tr><th>Roles</th><th>Group</th><th>Division</th><th>Section</th><th>Action</th></tr></thead>';
				TableStr += '<tbody>';

				$.each(EmpData, function(index, element) {
				var RoleName = element.role_name || '';
				var Group = element.group || '';
				var Division = element.division || '';
				var Section = element.section || '';
				var RoleMapId = element.role_mapping_id || '';

				TableStr += '<tr>';
				TableStr += '<td>' + RoleName + '</td>';
				TableStr += '<td>' + Group + '</td>';
				TableStr += '<td>' + Division + '</td>';
				TableStr += '<td>' + Section + '</td>';
				if(RoleMapId == EmpRoleMapId){
					TableStr += '<td><input type="button" class="mbt role_name" disabled  id="' + RoleMapId + '"data-employee="' + element.employee_no + '" value="Click here to switch role"></td>';
				}else{
					TableStr += '<td><input type="button" class="spanbtn mbt role_name"  id="' + RoleMapId + '"data-employee="' + element.employee_no + '" value="Click here to switch role"></td>';
				}
				
				TableStr += '</tr>';
			});
				TableStr += '</tbody>';
                TableStr += '</table>';
                BootstrapDialog.show({
                    message: TableStr,
                    title: 'Employee Details',
                    size: 'large',
                    onshown: function (dialogRef) {
                    }
                });
            } 
        },
    });
});


$('body').on("click", ".role_name", function (event) {
	var RoleMapId = $(this).attr('id');
	var EmpNo = $(this).data('employee');
	var RoleName = $(this).val();
    $.ajax({
        type: 'POST',
        url: "{{ route('rolemapping.SwitchRole') }}", 
        data: { RoleMapId: RoleMapId, EmpNo: EmpNo, "_token": "{{ Session::token() }}" },
        success: function (response) {
			window.location.href = "{{ route('dashboard.index')}}";
        },
    });
});


</script>
<style>
	#main_nav ul {
		background: #03BCD3;
		float: left;
		-webkit-transition: .5s;
		transition: .5s;
		padding-top: 0px;
		width:100%;
	}
	#main_nav > ul > li{
		border-right:1px solid #047EA9;
	}
	#main_nav li {
		float: right;
		position: relative;
		list-style: none;
		-webkit-transition: .1s;
		transition: .1s;
		padding-top: 0px;
		display:inline;
	}
	.navbar-inverse{
		background-color:#03BCD3;
	}
	#main_menu{
		background-color:#03BCD3;
	}
	.hide{
		display:none;
	}
	.navbar-collapse{
		padding-left:0px;
		padding-right:0px;
		color:#FFFFFF;
		font: 14px/20px 'Open Sans', sans-serif;
		font-size:12px;
		padding:3px;
		padding-bottom:3px !important;
		font-weight:600;
	}
	#mySidenav a {
		position: fixed;
		left: 30px;
		transition: 0.3s;
		padding: 10px;
		width: 40px;
		text-decoration: none;
		font-size: 20px;
		color: white;
		border-radius: 0 5px 5px 0;
		white-space:nowrap;
		/* z-index:5000 !important; */
	}
	#mySidenav a:hover {
		/*left: 0;*/
		width: 250px;
		z-index:2;
	}
	#mySidenav > a > .fa{
		line-height:18px;
	}
	#SMenuAdmin {
		/*top: 128px;*/
		background-color: #079ED5;
	}
	#SMenuPru {
		/*top: 178px;*/
		background-color: #1154A2;
	}
	#SMenuPrc {
		/*top: 228px;*/
		background-color: #674BA0;
	}
	#SMenuSor {
		/*top: 278px;*/
		background-color: #9750A0;
	}
	#SMenuSorc {
		/*top: 328px;*/
		background-color: #EA4679
	}
	#SMenuAbstract {
		/*top: 378px;*/
		background-color: #F54040
	}
	#SMenuCompare {
		/*top: 428px;*/
		background-color: #F16B24
	}
	#SMenuHistory {
		/*top: 478px;*/
		background-color: #DC9E04
	}
	#SMenuLCharge {
		/*top: 528px;*/
		background-color: #1AC498
	}
	#SMenuReports {
		/*top: 578px;*/
		background-color: #C70039
	}
	.menuLable{
		font-size:12px;
		padding-left:10px;
		cursor:pointer;
		visibility:hidden;
	}
	#SMenuAdmin:hover .menuLable,#SMenuPru:hover .menuLable,
	#SMenuPrc:hover .menuLable,#SMenuSor:hover .menuLable,
	#SMenuSorc:hover .menuLable,#SMenuAbstract:hover .menuLable,
	#SMenuCompare:hover .menuLable,#SMenuHistory:hover .menuLable,
	#SMenuLCharge:hover .menuLable,#SMenuReports:hover .menuLable{
		visibility:visible;
	}
</style>
@php  
//$Top = 118; $TopIncr = 50;
@endphp 
@php  
$Top = 118; $TopIncr = 50;
@endphp 
<!-- <div id="mySidenav" class="sidenav">
	<a href="" id="SMenuAdmin" style=" @php  echo 'top:'.$Top.'px'; $Top = $Top + $TopIncr; @endphp "><i class="fa fa-cog" style="font-size:17px; padding-left:2px;"></i><label class="menuLable">My Profile</label></a>
	<a href="" id="SMenuPru" style=" @php  echo 'top:'.$Top.'px'; $Top = $Top + $TopIncr; @endphp "><i class="fa fa-user" style="font-size:17px; padding-right:2px;padding-left:2px;"></i><label class="menuLable">My Payslip</label></a>
	<a href="" id="SMenuPrc" style=" @php  echo 'top:'.$Top.'px'; $Top = $Top + $TopIncr; @endphp "><i class="fa fa-list" style="font-size:17px; padding-right:2px;padding-left:4px;"></i><label class="menuLable">My Leave</label></a>
	<a data-url="" id="SMenuSorc" style=" @php  echo 'top:'.$Top.'px'; $Top = $Top + $TopIncr; @endphp "><i class="fa fa-bell" style="font-size:17px; padding-left:2px;"></i><label class="menuLable">My LTA Advance History</label></a>
	<a data-url="" id="SMenuAbstract" style=" @php  echo 'top:'.$Top.'px'; $Top = $Top + $TopIncr; @endphp "><i class="fa fa-bell" style="font-size:17px; padding-left:2px;"></i><label class="menuLable">My LTA Settlement History</label></a>
	<a data-url="" id="SMenuHistory" style=" @php  echo 'top:'.$Top.'px'; $Top = $Top + $TopIncr; @endphp "><i class="fa fa-bell" style="font-size:17px; padding-left:2px;"></i><label class="menuLable">Staff Directory</label></a>
	<a href="" id="SMenuCompare" style=" @php  echo 'top:'.$Top.'px'; $Top = $Top + $TopIncr; @endphp "><i class="fa fa-bell" style="font-size:17px; padding-left:2px;"></i><label class="menuLable">My Holidays</label></a>	
	<a href="" id="SMenuLCharge" style=" @php  echo 'top:'.$Top.'px'; $Top = $Top + $TopIncr; @endphp "><i class="fa fa-bell" style="font-size:17px; padding-left:2px;"></i><label class="menuLable">IMSC Circulars</label></a>
	<a href="" id="SMenuAdmin" style=" @php  echo 'top:'.$Top.'px'; $Top = $Top + $TopIncr; @endphp "><i class="fa fa-exchange" style="font-size:17px; padding-left:2px;"></i><label class="menuLable">Organization Structure</label></a>
	<a href="" id="SMenuPrc" style=" @php  echo 'top:'.$Top.'px'; $Top = $Top + $TopIncr; @endphp "><i class="fa fa-exchange" style="font-size:17px; padding-left:2px;"></i><label class="menuLable">Event Calendar</label></a>
</div> -->

<script>
  const navItems  = document.querySelectorAll('.nav-item[data-menu]');
  const overlay   = document.getElementById('menu-overlay');
  let   activeKey = null;

  function openMenu(key) {
    closeAll();
    const item  = document.querySelector(`.nav-item[data-menu="${key}"]`);
    const panel = document.getElementById(key);
    if (!item || !panel) return;
    item.classList.add('open');
    panel.classList.add('open');
    overlay.classList.add('show');
    activeKey = key;
  }

  function closeAll() {
    navItems.forEach(i => i.classList.remove('open'));
    document.querySelectorAll('.mega-panel').forEach(p => p.classList.remove('open'));
    overlay.classList.remove('show');
    activeKey = null;
  }

  navItems.forEach(item => {
    const key = item.dataset.menu;
    item.querySelector('.nav-btn').addEventListener('click', e => {
      e.stopPropagation();
      activeKey === key ? closeAll() : openMenu(key);
    });
  });

  overlay.addEventListener('click', closeAll);

  document.addEventListener('keydown', e => {
    if (e.key === 'Escape') closeAll();
  });

  // Prevent mega panel clicks from closing
  document.querySelectorAll('.mega-panel').forEach(p => {
    p.addEventListener('click', e => e.stopPropagation());
  });

  // ── MARKETPLACE HORIZONTAL TABS ──
  const mktTabBtns  = document.querySelectorAll('.mkt-tab-btn[data-mkt-tab]');
  const mktTabPanes = document.querySelectorAll('.mkt-tab-pane');

  mktTabBtns.forEach(btn => {
    btn.addEventListener('click', e => {
      e.stopPropagation();
      const target = btn.dataset.mktTab;

      mktTabBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');

      mktTabPanes.forEach(p => p.classList.remove('active'));
      const pane = document.getElementById(target);
      if (pane) pane.classList.add('active');
    });
  });
  const devTabBtns  = document.querySelectorAll('.mega-tab-btn[data-tab]');
  const devTabPanes = document.querySelectorAll('.mega-tab-pane');

  devTabBtns.forEach(btn => {
    btn.addEventListener('click', e => {
      e.stopPropagation();
      const target = btn.dataset.tab;

      // Update buttons
      devTabBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');

      // Update panes
      devTabPanes.forEach(p => p.classList.remove('active'));
      const pane = document.getElementById(target);
      if (pane) pane.classList.add('active');
    });
  });

	document.addEventListener("click", function (event) {
	const btn = event.target.closest(".nav-btn");
	if (!btn) return;

	//alert();
	document.querySelectorAll(".mkt-tab-btn").forEach(el => {
		el.classList.remove("active");
	});
	document.querySelectorAll(".mkt-tab-pane").forEach(el => {
		el.classList.remove("active");
	});
	
	document.querySelectorAll(".mega-first-child").forEach(el => {
		el.classList.add("active");
	});
	}, true);

	
</script>
