@extends('layouts.app-home')

@section('content')
    <div class="bg-light p-5 rounded">
       
        <div id="portfolio" class="portfolio">
		<div class="sap_tabs">			
			<div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
				<ul class="resp-tabs-list" style="color:white;border:none; padding-left:22px;">
					<li class="resp-tab-item" style="width:100%; padding:0px; cursor:default">
						<span style="color:white;">
							<div class="col-lg-1" style="text-align:left"><img src="{!! url('assets/images/igcar_logo_1.png') !!}" width="90" height="90"></div>
							<div class="col-lg-11" style=" text-align:left; top:10px;">
								<div class="col-lg-12" style="font-size:25px;">Works Contract Management System</div>
								<div class="col-lg-6" style="font-size:15px; font-style:italic; letter-spacing:1px;">Civil Engineering Group, IGCAR, Kalpakkam.</div>
								<div class="col-lg-6" style="font-size:15px; letter-spacing:1px; text-align:right; padding-right:32px;">
									<!--<span class="note awesome" data-toggle="modal" data-target="#modal14" style=" cursor:pointer" onClick="CircularNotification()">
										<a style="color:#EEEEEE; cursor:pointer"><span class="glyphicon glyphicon-bookmark awesome" style="top:3px;"></span></a>&nbsp;&nbsp; Notifications and Circulars
									</span>-->
								</div>
							</div>
						</span>
					</li>
				</ul>	
				<div class="clearfix"> </div>	
				<div class="resp-tabs-container">
					<div class="tab-1 resp-tab-content">
						<div class="tab_img">
							<div class="col-md-3 portfolio-grids grid" style="border:solid red 1px;">
								<div class="hover ehover14">
									<a class="swipebox" title="">
										<img src="{!! url('assets/images/g5.jpg') !!}" alt="" class="img-responsive" style="height:350px;"/>
										<div class="overlay" data-remodal-target="modal" id="TEND">
											<h4 style="font-size:16px">Estimate <br/> & <br/> CMS</h4>
											<button class="info nullbutton" data-toggle="modal" data-target="#modal13">Login
											</button>
										</div>
									</a>	
								</div>
							</div>
							<div class="col-md-3 portfolio-grids grid">
								<div class="hover ehover14">
									<a class="swipebox" title="">
										<img src="{!! url('assets/images/g6.jpg') !!}" alt="" class="img-responsive" style="height:350px;"/>
										<div class="overlay" data-remodal-target="modal" id="MBUK">
											<h4>BILLING</h4>
											<button class="info nullbutton" data-toggle="modal" data-target="#modal14">Login
											</button>
										</div>
									</a>	
								</div>
							</div>
							<div class="col-md-3 portfolio-grids grid">
								<div class="hover ehover14">
									<a class="swipebox" title="">
										<img src="{!! url('assets/images/g7.jpg') !!}" alt="" class="img-responsive" style="height:350px;"/>
										<div class="overlay" data-remodal-target="modal" id="BUDG">
											<h4>BUDGET</h4>
											<button class="info nullbutton" data-toggle="modal" data-target="#modal14">Login
											</button>
										</div>
									</a>	
								</div>
							</div>
							<div class="col-md-3 portfolio-grids grid">
								<div class="hover ehover14">
									<a class="swipebox" title="">
										<img src="{!! url('assets/images/g8.jpg') !!}" alt="" class="img-responsive" style="height:350px;"/>
										<div class="overlay" data-remodal-target="modal" id="TTS">
											<h4>TASK TRACK SYSTEM</h4>
											<button class="info nullbutton" data-toggle="modal" data-target="#modal14">Login
											</button>
										</div>
									</a>	
								</div>
							</div>	
							<div class="clearfix"> </div>
						</div>
					</div>
				</div>
			</div>
			@push('scripts')
			<!--ResponsiveTabs-->
			<script src="{!! url('assets/js/easyResponsiveTabs.js') !!}" type="text/javascript"></script>
			<script type="text/javascript">
				$(document).ready(function () {
					$('#horizontalTab').easyResponsiveTabs({
						type: 'default', //Types: default, vertical, accordion           
						width: 'auto', //auto or any width like 600px
						fit: true   // 100% fit in a container
					});
				});		
			</script>
			@endpush
		</div>
	</div>
	<div class="remodal modal-style" data-remodal-id="modal">
		<form method="post" action="{{ route('login.perform') }}">
			<div id="tendering" style="display:block;">
				<div class="col-md-6">
					<img src="{!! url('assets/images/g5.jpg') !!}" alt="" class="img-responsive" style="height:350px;"/>
				</div>
				<div class="col-md-6">
					<div class="col-sm-12">&nbsp;</div>
					<div class="col-sm-12 login-head">WCMS</div>
					<div class="col-sm-12 login-head2">Works Contract Management System</div>
					<div class="col-sm-12">&nbsp;</div>
					<div class="col-sm-12 login-title">Estimate & Contract Management System Login</div>
					<div class="col-sm-12">&nbsp;</div>
					<div class="col-sm-12"><input type="text" name="username" value="{{ old('username') }}" id="txt_tender_username" class="form-control" placeholder=" Enter User Name"></div>
					<div class="col-sm-12 ErrorMsg">&nbsp;<span id="val_tender_username"></span></div>
					<div class="col-sm-12"><input type="password" name="txt_tender_password" id="txt_tender_password" class="form-control" placeholder=" Enter Password"></div>
					<div class="col-sm-12 ErrorMsg">&nbsp;
					@if ($errors->has('username'))
                <span class="val_tender_password">{{ $errors->first('username') }}</span>
            @endif
			</div>
					<div class="col-sm-12">&nbsp;</div>
				</div>
			</div>
			<div id="embook" style="display:none">
				<div class="col-md-6">
					<img src="{!! url('assets/images/g6.jpg') !!}" alt="" class="img-responsive" style="height:350px;"/>
				</div>
				<div class="col-md-6">
					<div class="col-sm-12">&nbsp;</div>
					<div class="col-sm-12 login-head">WCMS</div>
					<div class="col-sm-12 login-head2">Works Contract Management System</div>
					<div class="col-sm-12">&nbsp;</div>
					<div class="col-sm-12 login-title">Billing Login</div>
					<div class="col-sm-12">&nbsp;</div>
					<div class="col-sm-12"><input type="text" name="txt_mbook_username" id="txt_mbook_username" class="form-control" placeholder=" Enter User Name"></div>
					<div class="col-sm-12 ErrorMsg">&nbsp;<span id="val_mbook_username"></span></div>
					<div class="col-sm-12"><input type="password" name="txt_mbook_password" id="txt_mbook_password" class="form-control" placeholder=" Enter Password"></div>
					<div class="col-sm-12 ErrorMsg">&nbsp;<span id="val_mbook_password">@php echo 1; @endphp</span></div>
					<div class="col-sm-12">&nbsp;</div>
				</div>
			</div>
			<div id="Budget" style="display:none">
				<div class="col-md-6">
					<img src="{!! url('assets/images/g7.jpg') !!}" alt="" class="img-responsive" style="height:350px;"/>
				</div>
				<div class="col-md-6">
					<div class="col-sm-12">&nbsp;</div>
					<div class="col-sm-12 login-head">WCMS</div>
					<div class="col-sm-12 login-head2">Works Contract Management System</div>
					<div class="col-sm-12">&nbsp;</div>
					<div class="col-sm-12 login-title">Budget Login</div>
					<div class="col-sm-12">&nbsp;</div>
					<div class="col-sm-12"><input type="text" name="txt_budget_username" id="txt_budget_username" class="form-control" placeholder=" Enter User Name"></div>
					<div class="col-sm-12 ErrorMsg">&nbsp;<span id="val_budget_username"></span></div>
					<div class="col-sm-12"><input type="password" name="txt_budget_password" id="txt_budget_password" class="form-control" placeholder=" Enter Password"></div>
					<div class="col-sm-12 ErrorMsg">&nbsp;<span id="val_budget_password">@php echo 1; @endphp</span></div>
					<div class="col-sm-12">&nbsp;</div>
				</div>
			</div>
			<div id="ttsystem" style="display:none">
				<div class="col-md-6">
					<img src="{!! url('assets/images/g8.jpg') !!}" alt="" class="img-responsive" style="height:350px;"/>
				</div>
				<div class="col-md-6">
					<div class="col-sm-12">&nbsp;</div>
					<div class="col-sm-12 login-head">WCMS</div>
					<div class="col-sm-12 login-head2">Works Contract Management System</div>
					<div class="col-sm-12"></div>
					<div class="col-sm-12 login-title">Task Track System Login</div>
					<div class="col-sm-12">&nbsp;</div>
					<div class="col-sm-12"><input type="text" name="txt_tts_username" id="txt_tts_username" class="form-control" placeholder=" Enter User Name"></div>
					<div class="col-sm-12 ErrorMsg">&nbsp;<span id="val_tts_username"></span></div>
					<div class="col-sm-12"><input type="password" name="txt_tts_password" id="txt_tts_password" class="form-control" placeholder=" Enter Password"></div>
					<div class="col-sm-12 ErrorMsg">&nbsp;<span id="val_tts_password">@php echo 1; @endphp</span></div>
					<div class="col-sm-12">&nbsp;</div>
				</div>
			</div>
			<input type="hidden" name="txt_login_section" id="txt_login_section">
			<a data-remodal-action="close" class="remodal-close"></a>
			
			<button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
			
			<button name="btn_cancel" id="btn_cancel" data-remodal-action="cancel" class="button-red">Cancel</button>
		</form>
	</div>
	
       
    </div>
@endsection
