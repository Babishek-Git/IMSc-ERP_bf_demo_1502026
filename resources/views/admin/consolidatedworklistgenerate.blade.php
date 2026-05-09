@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')




<form name="form" method="get" action="ConsolidatedWorkList.php">
<div class="content">
	<div class="title"></div>
	<div class="container_12">
		<div class="grid_12">
			<blockquote class="bq1" style="overflow:auto">
				<div class="container">
					<div class="row ">
						<div class="div3"></div>
						<div class="div6 mbtable">
							<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center"> Consolidated Works Report Generate </div></div></div>
							<div class="card-body padding-1 ChartCard" id="CourseChart">
								<div class="divrowbox innerdiv pt-2">

										<div class="row">
											<div class="row">
												<div class="div1">&nbsp;</div>
												<div class="div5" style="text-align:center;">
													<span class="label">From Date</span>&nbsp;&nbsp;
													<input type="text" name='txt_from_date' id='txt_from_date' autocomplete='off' class="textboxdisplay" style="width:130px;">
													&emsp;&nbsp;&nbsp;
												</div>
												<div class="div4">
													<span class="label">To Date</span>&nbsp;&nbsp;
													<input type="text" name="txt_to_date" id="txt_to_date" autocomplete='off' class="textboxdisplay" style="width:130px;"/>
													&emsp;&emsp;
												</div>
											</div>
											<div class="row smclearrow"></div>
										</div>



								</div>
								<div style="text-align:center; height:55px; line-height:55px;" class="printbutton">
									<!-- <div class="buttonsection">
										<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
									</div> -->
									<div class="buttonsection">
										<input type="submit" data-type="submit" value=" View " name="submit" id="submit"/>
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
   
@endsection