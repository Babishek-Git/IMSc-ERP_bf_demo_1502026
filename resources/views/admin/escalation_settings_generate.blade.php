@extends('layouts.dashboard-master')
@section('content')
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
    <div class="content">
		<div class="title">Escalation Configuration</div>
        <div class="container_12">
            <div class="grid_12">
                <blockquote class="bq1">
                    <form name="form" method="post" action="EscalationSettings.php">
                        <div class="container">
							<div class="row ">
								<div class="div2">&nbsp;</div>
									<div class="div8">
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Escalation Item Settings</div></div></div>
										<div class="row innerdiv">
											<div class="row">
												<div class="div4">
													<label for="fname">Work Short Name</label>
												</div>
												<div class="div8">
													<select id="cmb_shortname" name="cmb_shortname" class="tboxclass" onchange='workorderdetail();'>
														<option value="">--------------- Select --------------- </option>
													</select>
												</div>
											</div>
											<div class="row">
												<div class="div4">
													<label for="fname">Work Order No.</label>
												</div>
												<div class="div8">
													<input type="text" name='txt_workorder' id='txt_workorder' class="tboxclass" readonly="" value="">
												</div>
											</div>
											<div class="row">
												<div class="div4">
													<label for="fname">Name of Work</label>
												</div>
												<div class="div8">
													<textarea name='txt_workname' id='txt_workname' class="tboxclass" readonly="" rows="2"></textarea>
												</div>
											</div>
											<div class="smediv">&nbsp;</div>
										</div>
										<div class="smediv">&nbsp;</div>
									</div>
									<div class="div2">&nbsp;</div>
								</div> 
								<div class="row">
									<div class="div12" align="center">
										<input type="submit" class="backbutton" name="next" id="next" value=" Next "/>
									</div>
								</div>                           
                            </div>
						</form>
                    </blockquote>
                </div>
            </div>
        </div>
    </body>
</html>
@endsection
