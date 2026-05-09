<header class="mm-header">
		<!-- <a href="#" class="logo">LOGO</a> -->
		<nav>
			<h1>
				<a href="">
					<img src="{{asset('images/BARCLogo.png')}}" alt="logo">
				</a>
			</h1>
			<h4>
				<a href="">
					<div class="titleHead">IMSc Office Automation Software</div>
					<div class="sub-titleHead">IMSc, Taramani, Chennai.</div>
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
							foreach ($category['parent_cats'][$parent] as $cat_id) { 
								$ModuleName = $category['categories'][$cat_id]['module_name']; 
								$MenuUrl = $category['categories'][$cat_id]['menu_url'];
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
									if($MenuPageCode != ''){
										if($MenuUrl == "#"){
											$html .= '<li><a class="mm-menu-item">' . $ModuleName . '</a></li>';
										}else{
											$html .= '<li><a href="'.$MenuUrl.'" class="mm-menu-item" >' . $ModuleName . '</a></li>';
										}
									}else{
										if($MenuUrl == "#"){
											$html .= '<li style="background:#1babd3; cursor:default;"><a class="mm-menu-item">' . $ModuleName . ' &nbsp;<i class="fa fa-angle-down down-arrow"></i></a></li>';
										}else{
											$html .= '<li><a href="'.$MenuUrl.'" class="mm-menu-item">' . $ModuleName . '</a></li>';
										}
									}
								}
								if(isset($category['parent_cats'][$cat_id])) {  
									if($category['categories'][$cat_id]['menu_type'] == 'DMENU'){ 
										if($category['categories'][$cat_id]['parentid'] == 0){
											if($MenuUrl == "#"){
												$html .= "<li class='mm-dropdown ToggleMenu' data-menu='DMENU'> <a class='mm-menu-item'>".$ModuleName." <i class='fa fa-angle-down down-arrow'></i></a>";
											}else{
												$html .= "<li class='mm-dropdown'> <a href='".$ModuleName."' class='mm-menu-item'>".$ModuleName." <i class='fa fa-angle-down down-arrow'></i></a>";
											}
											$html .= "<ul class='mm-dropdown-menu'>";
											$html .= buildCategory($cat_id, $category,"X");
											$html .= "</ul>";
											$html .= "</li>";
										}
									}
									if(($category['categories'][$cat_id]['menu_type'] == 'MMENU')||($MenuType == "MMENU")){
										if($category['categories'][$cat_id]['parentid'] == 0){
											if($MenuUrl == "#"){
												$html .= "<li class='ToggleMenu' data-menu='MMENU'><a class='mm-menu-item'>".$ModuleName." <i class='fa fa-angle-down down-arrow'></i></a>";
											}else{
												$html .= "<li><a href='".$ModuleName."' class='mm-menu-item'>".$ModuleName." <i class='fa fa-angle-down down-arrow'></i></a>";
											}
											$html .= "<div class='mm-mega-menu'>";
											$html .= "<div class='mm-content'>";
											$html .= buildCategory($cat_id, $category,"MMENU");
											$html .= "</div>";
											$html .= "</div>";
											$html .= "</li>";
										}
										if($category['categories'][$cat_id]['parentid'] != 0){
											$html .= "<div class='mm-col div2'>";
											$html .= "<section>";
											$html .= "<div class='mm-mega-submenu'>".$ModuleName."</div>";
											$html .= "<ul class='mm-mega-links'>";
											$html .= buildCategory($cat_id, $category,"X");
											$html .= "</ul>";
											$html .= "</section>";
											$html .= "</div>";
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
			<!-- <ul class="mm-menu-items"> -->



				<!-- START: RUBY DEMO HEADER -->
				<div class="ruby-menu-demo-header">
				<!-- ########################### -->
				<!-- START: RUBY HORIZONTAL MENU -->
				<div class="ruby-wrapper">
					<button class="c-hamburger c-hamburger--htx visible-xs">
					<span>toggle menu</span>
					</button>
					<ul class="ruby-menu">
					<!-- <li class="ruby-active-menu-item"><a href="#">Home</a></li> -->
					<!-- <li><a href="#">Classic</a>
						<ul class="">
						<li><a href="#">2nd Level #1</a></li>
						<li><a href="#">2nd Level #2</a></li>
						<li><a href="#">2nd Level #3</a>
							<ul>
							<li><a href="#"><i class="fa fa-university" aria-hidden="true"></i>3rd Level #1</a>
								<ul>
								<li><a href="#">4th Level #1</a></li>
								<li><a href="#">4th Level #2</a></li>
								</ul>
								<span class="ruby-dropdown-toggle"></span>
							</li>
							<li><a href="#"><i class="fa fa-thumbs-up" aria-hidden="true"></i>3rd Level #2</a></li>
							<li><a href="#"><i class="fa fa-users" aria-hidden="true"></i>3rd Level #3</a>
								<ul>
								<li><a href="#"><i class="fa fa-paper-plane" aria-hidden="true"></i>4th Level #1</a></li>
								<li><a href="#"><i class="fa fa-print" aria-hidden="true"></i>4th Level #2</a></li>
								<li><a href="#"><i class="fa fa-shopping-bag" aria-hidden="true"></i>4th Level #3</a></li>
								</ul>
								<span class="ruby-dropdown-toggle"></span>
							</li>
							</ul>
							<span class="ruby-dropdown-toggle"></span>
						</li>
						<li class="ruby-open-to-left"><a href="#">2nd Level #4</a>
							<ul>
							<li><a href="#">3rd Level #1</a></li>
							<li><a href="#">3rd Level #2</a></li>
							<li><a href="#">3rd Level #3</a></li>
							</ul>
							<span class="ruby-dropdown-toggle"></span>
						</li>
						<li><a href="#">2nd Level #5</a></li>
						</ul>
						<span class="ruby-dropdown-toggle"></span>
					</li> -->

					<!-- <li class="ruby-menu-mega"><a href="#">Mega</a>
						<div class="ruby-grid ruby-grid-lined">
						<div class="ruby-row">
							<div class="ruby-col-2">
							<h3 class="ruby-list-heading">Normal List</h3>
							<ul>
								<li><a href="#">Menu Item #1</a></li>
								<li><a href="#">Menu Item #2</a></li>
								<li><a href="#">Menu Item #3</a></li>
								<li><a href="#">Menu Item #4</a></li>
								<li><a href="#">Menu Item #5</a></li>
							</ul>
							</div>
							<div class="ruby-col-2 hidden-md">
							<h3 class="ruby-list-heading">List with Icons</h3>
							<ul>
								<li><a href="#"><i class="fa fa-motorcycle" aria-hidden="true"></i>Menu Item #1</a></li>
								<li><a href="#"><i class="fa fa-music" aria-hidden="true"></i>Menu Item #2</a></li>
								<li><a href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Menu Item #3</a></li>
								<li><a href="#"><i class="fa fa-sliders" aria-hidden="true"></i>Menu Item #4</a></li>
								<li><a href="#"><i class="fa fa-search" aria-hidden="true"></i>Menu Item #5</a></li>
							</ul>
							</div>
							<div class="ruby-col-3 ruby-col-4-md">
							<h3 class="ruby-list-heading">List with Images + Desc</h3>
							<ul class="ruby-list-with-images">
								<li><a href="#"><img src="img/c-1.png">Menu Item #1</a><span class="ruby-list-desc">Lorem ipsum dolor sit</span></li>
								<li><a href="#"><img src="img/c-2.png">Menu Item #2</a><span class="ruby-list-desc">Lorem ipsum dolor sit</span></li>
								<li><a href="#"><img src="img/c-3.png">Menu Item #3</a><span class="ruby-list-desc">Lorem ipsum dolor sit</span></li>
							</ul>
							</div>
							<div class="ruby-col-5">
							<h3 class="ruby-list-heading">Multiple Lists with Icons</h3>
							<div class="ruby-row">
								<div class="ruby-col-4 ruby-col-6-md">
								<ul>
									<li><a href="#"><i class="fa fa-star" aria-hidden="true"></i>Menu Item</a></li>
									<li><a href="#"><i class="fa fa-signal" aria-hidden="true"></i>Menu Item</a></li>
									<li><a href="#"><i class="fa fa-send" aria-hidden="true"></i>Menu Item</a></li>
									<li><a href="#"><i class="fa fa-user" aria-hidden="true"></i>Menu Item</a></li>
									<li><a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>Menu Item</a></li>
								</ul>
								</div>
								<div class="ruby-col-4 ruby-col-6-md" style="padding-left:10px">
								<ul>
									<li><a href="#"><i class="fa fa-rocket" aria-hidden="true"></i>Menu Item</a></li>
									<li><a href="#"><i class="fa fa-warning" aria-hidden="true"></i>Menu Item</a></li>
									<li><a href="#"><i class="fa fa-upload" aria-hidden="true"></i>Menu Item</a></li>
									<li><a href="#"><i class="fa fa-umbrella" aria-hidden="true"></i>Menu Item</a></li>
									<li><a href="#"><i class="fa fa-trophy" aria-hidden="true"></i>Menu Item</a></li>
								</ul>
								</div>
								<div class="ruby-col-4 hidden-md" style="padding-left:15px">
								<ul>
									<li><a href="#"><i class="fa fa-map-o" aria-hidden="true"></i>Menu Item</a></li>
									<li><a href="#"><i class="fa fa-image" aria-hidden="true"></i>Menu Item</a></li>
									<li><a href="#"><i class="fa fa-legal" aria-hidden="true"></i>Menu Item</a></li>
									<li><a href="#"><i class="fa fa-paint-brush" aria-hidden="true"></i>Menu Item</a></li>
									<li><a href="#"><i class="fa fa-heart" aria-hidden="true"></i>Menu Item</a></li>
								</ul>
								</div>
							</div>
							</div>
						</div>
						</div>
						<span class="ruby-dropdown-toggle"></span>
					</li> -->

					<li class="ruby-menu-mega-blog"><a href="#">Employees Self Service</a>
						<div style="height: 269.359px;" class="">
						<ul class="ruby-menu-mega-blog-nav">

							<li class="ruby-active-menu-item"><a href="#">Blog-4-Column</a>
							<div class="ruby-grid ruby-grid-lined" style="height: 264.359px;">
								<div class="ruby-row">
								<div class="ruby-col-3">
									<img src="http://brienlabs.com/ruby-mega-menu/img/travel-1.jpg">
									<div class="ruby-c-inline">
									<span class="ruby-c-category"><a href="#">News / Travel</a></span>
									<span class="ruby-c-date"><a href="#">05/01/2017</a></span>
									</div>
									<span class="ruby-c-title ruby-margin-10"><a href="#">Vacation Proved To Increase Productivity</a></span>
									<span class="ruby-c-content">The primary research for the study was based on an online survey that was...</span>
								</div>
								<div class="ruby-col-3">
									<img src="http://brienlabs.com/ruby-mega-menu/img/health-3.jpg">
									<div class="ruby-c-inline">
									<span class="ruby-c-category"><a href="#">News / Health</a></span>
									<span class="ruby-c-date"><a href="#">05/01/2017</a></span>
									</div>
									<span class="ruby-c-title ruby-margin-10"><a href="#">Stereotype Idioms By The Smokers</a></span>
									<span class="ruby-c-content">If you have ever said some of below idioms you are for sure a smoking...</span>
								</div>
								<div class="ruby-col-3">
									<img src="http://brienlabs.com/ruby-mega-menu/img/culture-2.jpg">
									<div class="ruby-c-inline">
									<span class="ruby-c-category"><a href="#">News / Culture</a></span>
									<span class="ruby-c-date"><a href="#">05/01/2017</a></span>
									</div>
									<span class="ruby-c-title ruby-margin-10"><a href="#">10 Facts About The Philosophers</a></span>
									<span class="ruby-c-content">When we think “philosopher,” a certain image comes to mind—most often a wise...</span>
								</div>
								<div class="ruby-col-3">
									<img src="http://brienlabs.com/ruby-mega-menu/img/health-2.jpg">
									<div class="ruby-c-inline">
									<span class="ruby-c-category"><a href="#">News / Tech</a></span>
									<span class="ruby-c-date"><a href="#">05/01/2017</a></span>
									</div>
									<span class="ruby-c-title ruby-margin-10"><a href="#">In 2016, 10 People Died While Taking Selfie</a></span>
									<span class="ruby-c-content">This is a list of serious injuries and deaths in which the victim or a member of...</span>
								</div>
								</div>
							</div>
							<span class="ruby-dropdown-toggle"></span>
							</li>

							<li class="hidden-md"><a href="#">Blog-3-Column</a>
							<div class="ruby-grid ruby-grid-lined" style="height: 264.359px;">
								<div class="ruby-row">
								<div class="ruby-col-4">
									<div class="ruby-col-5">
									<img src="http://brienlabs.com/ruby-mega-menu/img/blog-1.jpg">
									</div>
									<div class="ruby-col-7">
									<span class="ruby-c-title"><a href="#">An Erupting Volcano And A Meteor</a></span>
									<span class="ruby-c-category"><a href="#">News / Science</a></span>
									<span class="ruby-c-date"><a href="#">05/01/2017</a></span>
									</div>
								</div>
								<div class="ruby-col-4">
									<div class="ruby-col-5">
									<img src="http://brienlabs.com/ruby-mega-menu/img/blog-2.jpg">
									</div>
									<div class="ruby-col-7">
									<span class="ruby-c-title"><a href="#">Bottle Labels: Short Stories To Read</a></span>
									<span class="ruby-c-category"><a href="#">News / Culture</a></span>
									<span class="ruby-c-date"><a href="#">05/01/2017</a></span>
									</div>
								</div>
								<div class="ruby-col-4">
									<div class="ruby-col-5">
									<img src="http://brienlabs.com/ruby-mega-menu/img/blog-3.jpg">
									</div>
									<div class="ruby-col-7">
									<span class="ruby-c-title"><a href="#">10+ Stunning Animal Portraits By Polyushko</a></span>
									<span class="ruby-c-category"><a href="#">News / Photography</a></span>
									<span class="ruby-c-date"><a href="#">05/01/2017</a></span>
									</div>
								</div>
								</div>
								<div class="ruby-row">
								<div class="ruby-col-4">
									<div class="ruby-col-5">
									<img src="http://brienlabs.com/ruby-mega-menu/img/blog-8.jpg">
									</div>
									<div class="ruby-col-7">
									<span class="ruby-c-title"><a href="#">Photographing The Beauty Of Fall</a></span>
									<span class="ruby-c-category"><a href="#">News / Photography</a></span>
									<span class="ruby-c-date"><a href="#">05/01/2017</a></span>
									</div>
								</div>
								<div class="ruby-col-4">
									<div class="ruby-col-5">
									<img src="http://brienlabs.com/ruby-mega-menu/img/blog-9.jpg">
									</div>
									<div class="ruby-col-7">
									<span class="ruby-c-title"><a href="#">10 Freaking Facts About Being A Pilot</a></span>
									<span class="ruby-c-category"><a href="#">News / Life</a></span>
									<span class="ruby-c-date"><a href="#">05/01/2017</a></span>
									</div>
								</div>
								<div class="ruby-col-4">
									<div class="ruby-col-5">
									<img src="http://brienlabs.com/ruby-mega-menu/img/blog-10.jpg">
									</div>
									<div class="ruby-col-7">
									<span class="ruby-c-title"><a href="#">Health Benefits Of A Glass Of Whiskey</a></span>
									<span class="ruby-c-category"><a href="#">News / Health</a></span>
									<span class="ruby-c-date"><a href="#">05/01/2017</a></span>
									</div>
								</div>
								</div>
							</div>
							<span class="ruby-dropdown-toggle"></span>
							</li>

							<li><a href="#">Blog-2-Column</a>
							<div class="ruby-grid ruby-grid-lined" style="height: 264.359px;">
								<div class="ruby-row">
								<div class="ruby-col-6">
									<div class="ruby-col-4">
									<img src="http://brienlabs.com/ruby-mega-menu/img/blog-4.jpg">
									</div>
									<div class="ruby-col-8">
									<span class="ruby-c-title"><a href="#">Nexo Created New Airless Bike Tires That Will Never Get Flat</a></span>
									<div class="ruby-c-inline">
										<span class="ruby-c-category"><a href="#"><i class="fa fa-tag" aria-hidden="true"></i> News / Tech</a></span>
										<span class="ruby-c-date"><a href="#"><i class="fa fa-calendar" aria-hidden="true"></i> 05/01/2017</a></span>
									</div>
									</div>
								</div>
								<div class="ruby-col-6">
									<div class="ruby-col-4">
									<img src="http://brienlabs.com/ruby-mega-menu/img/blog-5.jpg">
									</div>
									<div class="ruby-col-8">
									<span class="ruby-c-title"><a href="#">Illustrator Creates Stunning Dresses From Everyday Objects</a></span>
									<div class="ruby-c-inline">
										<span class="ruby-c-category"><a href="#"><i class="fa fa-tag" aria-hidden="true"></i> News / Tech</a></span>
										<span class="ruby-c-date"><a href="#"><i class="fa fa-calendar" aria-hidden="true"></i> 05/01/2017</a></span>
									</div>
									</div>
								</div>
								</div>
								<div class="ruby-row">
								<div class="ruby-col-6">
									<div class="ruby-col-4">
									<img src="http://brienlabs.com/ruby-mega-menu/img/blog-6.jpg">
									</div>
									<div class="ruby-col-8">
									<span class="ruby-c-title"><a href="#">Italian Pastry Chef Creates Miniature Worlds With Desserts</a></span>
									<div class="ruby-c-inline">
										<span class="ruby-c-category"><a href="#"><i class="fa fa-tag" aria-hidden="true"></i> News / Tech</a></span>
										<span class="ruby-c-date"><a href="#"><i class="fa fa-calendar" aria-hidden="true"></i> 05/01/2017</a></span>
									</div>
									</div>
								</div>
								<div class="ruby-col-6">
									<div class="ruby-col-4">
									<img src="http://brienlabs.com/ruby-mega-menu/img/blog-7.jpg">
									</div>
									<div class="ruby-col-8">
									<span class="ruby-c-title"><a href="#">Dogs Brought To The Lavender Gardens To Capture Their Joy</a></span>
									<div class="ruby-c-inline">
										<span class="ruby-c-category"><a href="#"><i class="fa fa-tag" aria-hidden="true"></i> News / Tech</a></span>
										<span class="ruby-c-date"><a href="#"><i class="fa fa-calendar" aria-hidden="true"></i> 05/01/2017</a></span>
									</div>
									</div>
								</div>
								</div>
							</div>
							<span class="ruby-dropdown-toggle"></span>
							</li>

							<li><a href="#">Blog-Article-List</a>
							<div class="ruby-grid ruby-grid-lined" style="height: 264.359px;">
								<div class="ruby-row">
								<div class="ruby-col-6">
									<span class="ruby-c-title" style="margin-bottom:15px">POPULAR THREADS</span>
									<div class="ruby-row">
									<div class="ruby-col-1"><img src="img/blog-1.jpg"></div>
									<div class="ruby-col-11"><span class="ruby-c-title"><a href="#">An Erupting Volcano And A Meteor Has Created A Fantastic View</a></span></div>
									</div>
									<div class="ruby-row">
									<div class="ruby-col-1"><img src="img/blog-2.jpg"></div>
									<div class="ruby-col-11"><span class="ruby-c-title"><a href="#">Bottle Labels With Short Stories To Be Read Is The New Marketing Era</a></span></div>
									</div>
									<div class="ruby-row">
									<div class="ruby-col-1"><img src="img/blog-3.jpg"></div>
									<div class="ruby-col-11"><span class="ruby-c-title"><a href="#">10+ Stunning Animal Portraits That Has Been Filmed By Polyushko</a></span></div>
									</div>
									<div class="ruby-row">
									<div class="ruby-col-1"><img src="img/blog-10.jpg"></div>
									<div class="ruby-col-11"><span class="ruby-c-title"><a href="#">10 Freaking Facts About Being An airline pilot</a></span></div>
									</div>
								</div>
								<div class="ruby-col-6">
									<span class="ruby-c-title" style="margin-bottom:15px">MOST COMMENTED</span>
									<div class="ruby-row">
									<div class="ruby-col-1"><img src="img/blog-1.jpg"></div>
									<div class="ruby-col-11"><span class="ruby-c-title"><a href="#">An Erupting Volcano And A Meteor Has Created A Fantastic View</a></span></div>
									</div>
									<div class="ruby-row">
									<div class="ruby-col-1"><img src="img/blog-2.jpg"></div>
									<div class="ruby-col-11"><span class="ruby-c-title"><a href="#">Bottle Labels With Short Stories To Be Read Is The New Marketing Era</a></span></div>
									</div>
									<div class="ruby-row">
									<div class="ruby-col-1"><img src="img/blog-3.jpg"></div>
									<div class="ruby-col-11"><span class="ruby-c-title"><a href="#">10+ Stunning Animal Portraits That Has Been Filmed By Polyushko</a></span></div>
									</div>
									<div class="ruby-row">
									<div class="ruby-col-1"><img src="img/blog-10.jpg"></div>
									<div class="ruby-col-11"><span class="ruby-c-title"><a href="#">10 Freaking Facts About Being An airline pilot</a></span></div>
									</div>
								</div>
								</div>
							</div>
							<span class="ruby-dropdown-toggle"></span>
							</li>
						</ul>
						</div>
						<span class="ruby-dropdown-toggle"></span>
					</li>

					<li class="ruby-menu-mega-shop"><a href="#">Admin Management</a>
						<div style="" class="ruby-mega-content">
						<ul>
							<li class="ruby-active-menu-item"><a href="#">Payroll Management</a>
							<div class="ruby-grid ruby-grid-lined">
								<div class="ruby-row">
									<div class="ruby-col-2">
										<h3 class="ruby-list-heading">Masters</h3>
										<ul>
											<li><a href="#">Employee Master</a></li>
											<li><a href="#">Department Master</a></li>
											<li><a href="#">Designation Master</a></li>
											<li><a href="#">Grade / Pay Scale</a></li>
											<li><a href="#">Earning & Deduction Heads</a></li>
											<li><a href="#">Bank Master</a></li>
											<li><a href="#">Leave Type Master</a></li>
											<li><a href="#">Shift / Working Hours</a></li>
											<li><a href="{{ route('payroll.SamplePage') }}">Sample Page</a></li>
										</ul>
									</div>
									<div class="ruby-col-2">
										<h3 class="ruby-list-heading">Attendance & Leave</h3>
										<ul>
											<li><a href="#">Attendance Entry</a></li>
											<li><a href="#">Biometric / Attendance Import</a></li>
											<li><a href="#">Leave Application</a></li>
											<li><a href="#">Leave Approval</a></li>
											<li><a href="#">Leave Balance</a></li>
										</ul>
									</div>
									<div class="ruby-col-2">
										<h3 class="ruby-list-heading">Payroll Processing</h3>
										<ul>
											<li><a href="#">Salary Structure</a></li>
											<li><a href="#">Monthly Payroll Processing</a></li>
											<li><a href="#">Overtime Calculation</a></li>
											<li><a href="#">Arrears Processing</a></li>
											<li><a href="#">Bonus / Incentives</a></li>
										</ul>
									</div>
									<div class="ruby-col-2">
										<h3 class="ruby-list-heading">Statutory</h3>
										<ul>
											<li><a href="#">PF Calculation</a></li>
											<li><a href="#">ESI Calculation</a></li>
											<li><a href="#">Professional Tax</a></li>
											<li><a href="#">Income Tax (TDS)</a></li>
											<li><a href="#">Statutory Returns</a></li>
										</ul>
									</div>
									<div class="ruby-col-2">
										<h3 class="ruby-list-heading">Payments</h3>
										<ul>
											<li><a href="#">Salary Disbursement</a></li>
											<li><a href="#">Bank Transfer File</a></li>
											<li><a href="#">Cash / Cheque Payment</a></li>
										</ul>
									</div>
									<div class="ruby-col-2">
										<h3 class="ruby-list-heading">Reports</h3>
										<ul>
											<li><a href="#">Salary Sheet</a></li>
											<li><a href="#">Payslip</a></li>
											<li><a href="#">Employee Payroll Register</a></li>
											<li><a href="#">Department-wise Salary Report</a></li>
											<li><a href="#">PF / ESI / TDS Reports</a></li>
											<li><a href="#">Leave Report</a></li>
											<li><a href="#">Attendance Report</a></li>
										</ul>
									</div>
								</div>
							</div>
							<span class="ruby-dropdown-toggle"></span>
							</li>
							<li><a href="#">Stores & Purchase</a>
							<div class="ruby-grid ruby-grid-lined">
								<div class="ruby-row">
								
								<div class="ruby-col-2">
									<h3 class="ruby-list-heading">Masters</h3>
									<ul>
										<li><a href="#">Item Master</a></li>
										<li><a href="#">Item Category / Group</a></li>
										<li><a href="#">Unit of Measure (UOM)</a></li>
										<li><a href="#">Supplier / Vendor Master</a></li>
										<li><a href="#">Warehouse / Store Location</a></li>
										<li><a href="#">Tax Master (GST / VAT / Other)</a></li>
										<li><a href="#">Price List</a></li>
										<li><a href="#">Reorder Level Settings</a></li>
									</ul>
								</div>
								<div class="ruby-col-2">
									<h3 class="ruby-list-heading">Purchase</h3>
									<ul>
										<li><a href="#">Purchase Requisition</a></li>
										<li><a href="#">Request for Quotation (RFQ)</a></li>
										<li><a href="#">Supplier Quotation Comparison</a></li>
										<li><a href="#">Purchase Order (PO)</a></li>
										<li><a href="#">PO Approval</a></li>
										<li><a href="#">PO Amendment / Cancellation</a></li>
									</ul>
								</div>
								<div class="ruby-col-2">
									<h3 class="ruby-list-heading">Goods Receipt</h3>
									<ul>
										<li><a href="#">Goods Receipt Note (GRN)</a></li>
										<li><a href="#">Quality Inspection</a></li>
										<li><a href="#">Rejected / Returned Materials</a></li>
										<li><a href="#">Material Inward Register</a></li>
									</ul>
								</div>
								<div class="ruby-col-2">
									<h3 class="ruby-list-heading">Stores / Inventory</h3>
									<ul>
										<li><a href="#">Stock Issue</a></li>
										<li><a href="#">Stock Transfer (Inter-Store)</a></li>
										<li><a href="#">Stock Adjustment</a></li>
										<li><a href="#">Opening Stock</a></li>
										<li><a href="#">Batch / Serial Number Tracking</a></li>
									</ul>
								</div>
								<div class="ruby-col-2">
									<h3 class="ruby-list-heading">Returns</h3>
									<ul>
										<li><a href="#">Purchase Return</a></li>
										<li><a href="#">Supplier Debit Note</a></li>
									</ul>
								</div>
								<div class="ruby-col-2">
									<h3 class="ruby-list-heading">Reports</h3>
									<ul>
										<li><a href="#">Stock Summary</a></li>
										<li><a href="#">Stock Ledger</a></li>
										<li><a href="#">Item-wise Stock Report</a></li>
										<li><a href="#">Supplier-wise Purchase Report</a></li>
										<li><a href="#">Purchase Order Status</a></li>
										<li><a href="#">GRN Report</a></li>
										<li><a href="#">Slow / Fast Moving Items</a></li>
									</ul>
								</div>
								</div>
							</div>
							<span class="ruby-dropdown-toggle"></span>
							</li>
							<li><a href="#">Student Management</a>
							<div class="ruby-grid ruby-grid-lined">
								<div class="ruby-row">
								<div class="ruby-col-3">
									<img src="img/bags.jpg">
								</div>
								<div class="ruby-col-3">
									<h3 class="ruby-list-heading">BAGS</h3>
									<ul>
									<li><a href="#">Menu Item #1</a></li>
										<li><a href="#">Menu Item #2</a></li>
										<li><a href="#">Menu Item #3</a></li>
										<li><a href="#">Menu Item #4</a></li>
										<li><a href="#">Menu Item #5</a></li>
									</ul>
								</div>
								<div class="ruby-col-3">
									<h3 class="ruby-list-heading">SHOES</h3>
									<ul>
										<li><a href="#">Menu Item #1</a></li>
										<li><a href="#">Menu Item #2</a></li>
										<li><a href="#">Menu Item #3</a></li>
										<li><a href="#">Menu Item #4</a></li>
										<li><a href="#">Menu Item #5</a></li>
									</ul>
								</div>
								<div class="ruby-col-3">
									<img src="img/shoes.jpg">
								</div>
								</div>
							</div>
							<span class="ruby-dropdown-toggle"></span>
							</li>
							<li><a href="#">Accessories</a>
							<div class="ruby-grid ruby-grid-lined">
								<div class="ruby-row">
								<div class="ruby-col-3">
									<img src="img/eyewear.jpg">
									<h3 class="ruby-list-heading" style="margin-top: 16px;">EYEWEAR</h3>
									<ul>
										<li><a href="#">Menu Item #1</a></li>
										<li><a href="#">Menu Item #2</a></li>
										<li><a href="#">Menu Item #3</a></li>
										<li><a href="#">Menu Item #4</a></li>
									</ul>
								</div>
								<div class="ruby-col-3">
									<img src="img/jewellery.jpg">
									<h3 class="ruby-list-heading" style="margin-top: 16px;">JEWELLERY</h3>
									<ul>
										<li><a href="#">Menu Item #1</a></li>
										<li><a href="#">Menu Item #2</a></li>
										<li><a href="#">Menu Item #3</a></li>
										<li><a href="#">Menu Item #4</a></li>
									</ul>
								</div>
								<div class="ruby-col-3">
									<img src="img/watches.jpg">
									<h3 class="ruby-list-heading" style="margin-top: 16px;">WATCHES</h3>
									<ul>
										<li><a href="#">Menu Item #1</a></li>
										<li><a href="#">Menu Item #2</a></li>
										<li><a href="#">Menu Item #3</a></li>
										<li><a href="#">Menu Item #4</a></li>
									</ul>
								</div>
								<div class="ruby-col-3">
									<img src="img/textile.jpg">
									<h3 class="ruby-list-heading" style="margin-top: 16px;">OTHERS</h3>
									<ul>
										<li><a href="#">Menu Item #1</a></li>
										<li><a href="#">Menu Item #2</a></li>
										<li><a href="#">Menu Item #3</a></li>
										<li><a href="#">Menu Item #4</a></li>
									</ul>
								</div>
								</div>
							</div>
							<span class="ruby-dropdown-toggle"></span>
							</li>
							<li><a href="#">Collections</a>
							<div class="ruby-grid ruby-grid-lined">
								<div class="ruby-row">
								<div class="ruby-col-3">
									<img src="img/collection-accessori.jpg">
								</div>
								<div class="ruby-col-3">
									<img src="img/collection-bridal.jpg">
								</div>
								<div class="ruby-col-3">
									<img src="img/collection-cube.jpg">
								</div>
								<div class="ruby-col-3">
									<img src="img/collection-elegante.jpg">
								</div>
								</div>
								<div class="ruby-row">
								<div class="ruby-col-3">
									<img src="img/collection-maxmara.jpg">
								</div>
								<div class="ruby-col-3">
									<img src="img/collection-sfilata.jpg">
								</div>
								<div class="ruby-col-3">
									<img src="img/collection-shine.jpg">
								</div>
								<div class="ruby-col-3">
									<img src="img/collection-s-maxmara.jpg">
								</div>
								</div>
							</div>
							<span class="ruby-dropdown-toggle"></span>
							</li>
						</ul>
						</div>
						<span class="ruby-dropdown-toggle"></span>
					</li>

					<!-- <li class="ruby-menu-right"><a href="#">Right</a>
						<ul>
						<li><a href="#">2nd Level #1</a></li>
						<li><a href="#">2nd Level #2</a></li>
						<li class="ruby-open-to-left"><a href="#">2nd Level #3</a>
							<ul>
							<li class="ruby-open-to-left"><a href="#"><i class="fa fa-university" aria-hidden="true"></i>3rd Level #1</a>
								<ul>
								<li><a href="#">4th Level #1</a></li>
								<li><a href="#">4th Level #2</a></li>
								</ul>
								<span class="ruby-dropdown-toggle"></span>
							</li>
							<li><a href="#"><i class="fa fa-thumbs-up" aria-hidden="true"></i>3rd Level #2</a></li>
							<li><a href="#"><i class="fa fa-users" aria-hidden="true"></i>3rd Level #3</a>
							</li>
							<li><a href="#"><i class="fa fa-file" aria-hidden="true"></i>3rd Level #4</a>
								<ul>
								<li><a href="#"><i class="fa fa-paper-plane" aria-hidden="true"></i>4th Level #1</a></li>
								<li><a href="#"><i class="fa fa-print" aria-hidden="true"></i>4th Level #2</a></li>
								<li><a href="#"><i class="fa fa-shopping-bag" aria-hidden="true"></i>4th Level #3</a></li>
								</ul>
								<span class="ruby-dropdown-toggle"></span>
							</li>
							</ul>
							<span class="ruby-dropdown-toggle"></span>
						</li>
						<li class="ruby-open-to-left"><a href="#">2nd Level #4</a>
							<ul>
							<li><a href="#">3rd Level #1</a></li>
							<li><a href="#">3rd Level #2</a></li>
							<li><a href="#">3rd Level #3</a></li>
							</ul>
							<span class="ruby-dropdown-toggle"></span>
						</li>
						<li><a href="#">2nd Level #5</a></li>
						</ul>
						<span class="ruby-dropdown-toggle"></span>
					</li> -->

					</ul>
				</div>
				<!-- END:   RUBY HORIZONTAL MENU -->
				<!-- ########################### -->

				</div>
				<!-- END: RUBY DEMO HEADER -->



			<!-- </ul> -->
		</nav>
	</header>




<script>
$('body').on("click", "#switch_role", function (event) {
    $.ajax({
        type: 'POST',
        url: "{{ route('ajax.switchEmployeeRole') }}",
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
                TableStr += '<thead><tr><th>Roles</th><th>Group</th><th>Division</th><th>Section</th><th>Sub-Section</th><th>Action</th></tr></thead>';
				TableStr += '<tbody>';

				$.each(EmpData, function(index, element) {
				var RoleName = element.role_name || '';
				var Group = element.group || '';
				var Division = element.division || '';
				var Section = element.section || '';
				var SubSection = element.subsection || '';
				var RoleMapId = element.role_mapping_id || '';

				TableStr += '<tr>';
				TableStr += '<td>' + RoleName + '</td>';
				TableStr += '<td>' + Group + '</td>';
				TableStr += '<td>' + Division + '</td>';
				TableStr += '<td>' + Section + '</td>';
				TableStr += '<td>' + SubSection + '</td>';
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
        url: "{{ route('roles.switchRole') }}", 
        data: { RoleMapId: RoleMapId, EmpNo: EmpNo, "_token": "{{ Session::token() }}" },
        success: function (response) {
			window.location.href = "{{ route('dashboard.index')}}";
        },
    });
});
$(document).ready(function () {
	var AdminRoleId = $(".showdiv_admin").attr('data-id');
	if(AdminRoleId !=''){
		$.ajax({
    	    type: 'POST',
    	    url: "{{ route('ajax.GetAdminName') }}", 
    	    data: {roleid: AdminRoleId, "_token": "{{ Session::token() }}" },
    	    success: function (data) { 
				var Datalength = data.length; 
				if(Datalength == 0){ 
					$('.adminlist').hide();
				}
				RowStr = '';
				$.each(data, function(index, element) {
					RowStr += '<div class="row">'+element.emp_known_as+' ( '+element.emp_no+' )</div>';
				});
				$(".adminlist").append(RowStr);
    	    },
    	});
	} 
});

// $("body").on("click", ".mm-menu-item", function(event){
// 	var Href = $(this).attr("href");
// 	if((Href !== "undefined")&&(Href != '#')&&(Href != '')){
// 		$('.overlay, body').css('display','block');
// 		$('.overlay, body').removeClass('loaded');
// 	}
// });
//var ModuleElment = document.querySelectorAll(".ModuleMenu");
/*$("body").on("click", ".ModuleMenu", function(event){
    event.preventDefault();
  	var MenuUrl = $(this).attr('data-menuurl');
	var form = document.createElement("form");
	form.method = "POST"; 
	form.action = MenuUrl;
	form.name = "menuform"; 
	document.body.appendChild(form); 

	var MenuPage = $(this).attr('data-page'); 
	var MenuPageInput = document.createElement("input");
	MenuPageInput.type = "hidden";
	MenuPageInput.name = "menu_page";
	MenuPageInput.value = MenuPage; 
	form.appendChild(MenuPageInput);

	var csrfToken = document.createElement("input"); 
	csrfToken.type = "hidden";
	csrfToken.name = "_token"; 
	csrfToken.value = "{{ Session::token() }}"; 
	form.appendChild(csrfToken); 


	document.forms["menuform"].submit();
});*/
$(document).click( function(event){
	if (!$(event.target).closest('.ToggleMenu').length) {
		$(".mm-mega-menu").removeClass("showmmenu");
		$(".mm-dropdown-menu").removeClass("showdmenu");
	}
});
$(".ToggleMenu").click(function(){
	var MenuType = $(this).attr("data-menu");
	$(".mm-mega-menu").removeClass("showmmenu");
	$(".mm-dropdown-menu").removeClass("showdmenu");
	if(MenuType == "MMENU"){
		$(this).find(".mm-mega-menu").addClass("showmmenu");
	}
	if(MenuType == "DMENU"){
		$(this).find(".mm-dropdown-menu").addClass("showdmenu");
	}
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
<div id="mySidenav" class="sidenav">
	<!--<a data-url="Tendering" id="Tendering"><i class="fa fa-table"style="font-size:17px; padding-right:2px;padding-left:2px;"></i><label class="menuLable">Instrument Entry</label></a>-->
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
</div>
