<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Work Contract Management System">
    <meta name="author" content="Lashron Technologies, Lashron.com">
    <meta name="generator" content="Lashron.com">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>WCMS :: BARC</title>
@include('layouts.partials.header')
</head>
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();">

<header class="mm-header">
	<nav>
		<h1>
			<a href="">
				<img src="{{asset('images/BARCLogo.png')}}" alt="logo">
			</a>
		</h1>
		<h4>
			<a href="">
				<div class="titleHead">Works Contract Management System</div>
				<div class="sub-titleHead">BARC, Trombay, Mumbai.</div>
			</a>
		</h4>
		<div align="right">
			<div class="topmenu-text">
				<!-- Logged in as Guest -->
			</div>

			<div class="topmenu-text">
				
			</div>
			<div>&nbsp;</div>
			<div>&nbsp;</div>
		</div>
		<ul class="mm-menu-items">
			
		</ul>
	</nav>
</header>
<style>
	th{
		background:#1babd3;
		color:#fff;
		font-size:13px;
	}
	.warn-msg{
		color:#DB0531;
		font-size:14px;
	}
</style>

<main class="container">
	<form action="{{ route('logout.perform') }}" method="post" enctype="multipart/form-data" name="form">
		<div class="content">
			<div class="title"></div>
			<div class="container_12">
				<div class="grid_12">
					<blockquote class="bq1" style="overflow:auto">
						<div class="container">
							<div class="row ">
								<div class="div2">&nbsp;</div>
								<div class="div8 mbtable">
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Access Restricted</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
											<div class="row smclearrow"></div>                                                                                											
											<div class="div12 label">
											<div class="row warn-msg">Sorry ! you are not a authorized user. Contact Administrator.</div>
												<div class="row smclearrow">&nbsp;</div> 
												@if(isset($data['AdminEmpData']))
													@if($data['AdminEmpData'] != NULL)
														@if(count($data['AdminEmpData']) > 0)
														<table class="table table-bordered">
															<thead>
																<tr>
																	<th>SNo.</th>
																	<th>Employee Name</th>
																	<th>Group / Division / Section</th>
																	<th>Email Id</th>
																	<th>Extension No.</th>
																</tr>
															</thead>
															<tbody>
																@foreach($data['AdminEmpData'] as $AdminEmpData)
																<tr>
																	<td>{{$loop->iteration}}</td>
																	<td>{{$AdminEmpData->emp_known_as}}</td>
																	<td>
																		@php 
																		$OffArr = array();
																		$GroupName = $AdminEmpData->group_short_name;
																		$DivName = $AdminEmpData->division_short_name;
																		$SecName = $AdminEmpData->sub_section_short_name;
																		if($GroupName != NULL){ $OffArr[] = $GroupName; }
																		if($DivName != NULL){ $OffArr[] = $DivName; }
																		if($SecName != NULL){ $OffArr[] = $SecName; }
																		if(count($OffArr) > 0){
																			$OffStr = implode(",",$OffArr);
																		}else{
																			$OffStr = "";
																		}
																		echo $OffStr;
																		@endphp
																	</td>
																	<td>{{$AdminEmpData->o_email}}</td>
																	<td>{{$AdminEmpData->o_ext_no}}</td>
																</tr>
																@endforeach
															</tbody>
														</table> 
														@endif
													@endif
												@endif
												@php $AddUrl = 'logout.perform'; @endphp
												
												<div class="div12" align="center">
												<input type="submit" class="backbutton" name="btn_back" id="btn_back" value=" Go Back " />
												</div>
												<input type="hidden" name="_token" value="{{ csrf_token() }}" />
											</div>
																					
											<div class="row smclearrow"></div>  
										</div>
									</div>										
								</div>
							</div>                           
						</div>
					</blockquote>
				</div>
			</div>
		</div>
	</form>
</main>
</body>
@include('layouts.partials.footer')
<script>
	$(document).ready(function() {

	})
</script>
</html>