@extends('layouts.dashboard-master')
@section('content')
@include('layouts.partials.messages')


<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
	<div class="content">
		<div class="title"></div>
		<div class="container_12">
			<div class="grid_12">
				<blockquote class="bq1">
					<form name="form" method="post" action="">
						<div class="container">
							<div class="row ">
								<div class="div3">&nbsp;</div>
								<div class="div6 mbtable">
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Material Creation</div></div></div>
									<div class="row innerdiv">
										
										<div class="row">
											<div class="div2">&nbsp;</div>
											<div class="div4">
												<label for="fname">Material Description</label>
											</div>
											<div class="div4">
												<input type="text" name="txt_material" id="txt_material" style="width:100%;" class="textboxdisplay" >
											</div>
											<div class="div2">&nbsp;</div>
										</div>
										<div class="row">
											<div class="div2">&nbsp;</div>
											<div class="div4">
												<label for="fname">10CA / 10CC</label>
											</div>
											<div class="div4">
												<select name="cmb_index" id="cmb_index" style="width:100%;" class="textboxdisplay" >
													<option value="">-------- Select --------</option>
													<!--0option value="10CA">10CA</option>
													<option value='10CC'>10CC</option--->
												</select>
											</div>
											<div class="div2">&nbsp;</div>
										</div>
									</div> 
									<div class="smediv">&nbsp;</div>

									<div class="row">
										<div style="text-align:center; height:45px;" class="printbutton">
											<input type="submit" data-type="submit" value=" Save " name="save" id="save"/>
											<input type="submit"  value=" View " name="view" id="view"/>
										</div>
									</div> 
																			                          
								</div>
							</div>
							<div class="div3">&nbsp;</div>
						</div>
					</form>
				</blockquote>
			</div>
		</div>
	</div>
</body>

<script>
	$('#cmb_index').chosen();
</script>

@endsection
