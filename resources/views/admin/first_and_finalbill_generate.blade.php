@extends('layouts.dashboard-master')
	
@section('content')


<!-- route('admin.First_and_Final_Bill') -->
<form name="form" method="get" action="">
<div class="content">
	<div class="title"></div>
	<div class="container_12">
		<div class="grid_12">
			<blockquote class="bq1" style="overflow:auto">
				<div class="container">
					<div class="row ">
						<div class="div3"></div>
						<div class="div6 mbtable">
							<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">First And Final Bill Generate</div></div></div>
							<div class="card-body padding-1 ChartCard" id="CourseChart">
								<div class="divrowbox innerdiv pt-2">

										<div class="row">
											<div class="row">
												<div class="div3 label">	
													Work Short Name
												</div> 
												<div class="div9">
                                                    <select name="cmb_shortname" id="cmb_shortname" onChange="find_workname()" class="textboxdisplay" style="width:400px;height:22px;" tabindex="7">
                                                        <option value="">---------------------- Select ----------------------</option>
                                                    </select>
												</div>
											</div>
											
											<div class="row smclearrow"></div>
											<div class="row">
												<div class="div3 label">
													Work Order No.
												</div>
												<div class="div9">
                                                    <input type="text" name="txt_workorder_no" id="txt_workorder_no" class="textboxdisplay" style="width:397px;" disabled="disabled">
												</div>
											</div>
											<div class="row smclearrow"></div>
											<div class="row">
												<div class="div3 label">
													Name of Work
												</div>
												<div class="div9">
                                                    <textarea name="workname" class="textboxdisplay txtarea_style" style="width: 400px;" rows="5" disabled="disabled"></textarea>
												</div>
											</div>	
										</div>
										<input type="hidden" class="text" name="submit" value="true" />
						                <input  type="hidden" class="text" name="runningbilltext" id="runningbilltext" value=""/>
										<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
                                           <!--  <div class="buttonsection">
                                                <input type="button" name="back" value="Back" id="back" class="backbutton" onClick="goBack();" /> 
                                            </div> -->
                                            <div class="buttonsection">
                                                <input type="submit" class="btn" data-type="submit" value=" View " name="btn_view" id="btn_view"   />
                                                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                            </div>
                                        </div>       

								</div>
							</div>
						</div>
						<div class="div3"></div>
					</div>
                </div>
			</blockquote>
		</div>
	</div>
</div>
</form>          
<script>
	$('#cmb_shortname').chosen();
</script>
@endsection
