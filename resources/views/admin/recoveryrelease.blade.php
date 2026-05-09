@extends('layouts.dashboard-master')
@section('content')


<form action="" method="post" enctype="multipart/form-data" name="form">


<div class="content">
	<div class="title"></div>
	<div class="container_12">
		<div class="grid_12">
			<blockquote class="bq1" style="overflow:auto">
				<div class="container">
					<div class="row ">
						<div class="div3"></div>
						<div class="div6 mbtable">
							<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center"> Recovery Release </div></div></div>
							<div class="card-body padding-1 ChartCard" id="CourseChart">
								<div class="divrowbox innerdiv pt-2">
									<input type="hidden" name="hid_sheetid" id="hid_sheetid" value="">
									<div class="row">
										<div class="row">
											<div class="div3 label">	
												Work Short Name
											</div> 
											<div class="div9">
												<select name="cmb_shortname" id="cmb_shortname" class="textboxdisplay" style="width:469px" onChange="workorderdetail();getrbn();recovery();">
													<option value="">--------------- Select ---------------</option>
												</select>
											</div>
										</div>
										<div class="row smclearrow"></div>
										<div class="row">
											<div class="div3 label">
												Name of Work
											</div>
											<div class="div9">
												<textarea name='txt_workname' id='txt_workname' class="textboxdisplay" rows="6" style="width: 465px;"></textarea>
											</div>
										</div>	
										<div class="row smclearrow"></div>
										<div class="row">
											<div class="div3 label">
												Work Order No.
											</div>
											<div class="div9">
												<input type="text" name='txt_workorder' id='txt_workorder' class="textboxdisplay" value="" style="width: 465px;">
											</div>
										</div>
										
										<div class="row smclearrow"></div>
										<div class="row">
											<div class="div3 label">
												RAB No.
											</div>
											<div class="div9">
												<input type="text" name='txt_rbn' id='txt_rbn' class="textboxdisplay" value="" style="width: 465px;">
											</div>
										</div>	
										<div class="row smclearrow"></div>
										<div class="row">
											<div class="div3 label">
												Description
											</div>
											<div class="div9">
												<input type="text" name='txt_rec_rel_desc' id='txt_rec_rel_desc' class="textboxdisplay" value="" style="width: 465px;">
											</div>
										</div>	
										<div class="row smclearrow"></div>
										<div class="row">
											<div class="div3 label">
												Amount (Rs.)
											</div>
											<div class="div9">
												<input type="text" name='txt_rec_rel_amt' id='txt_rec_rel_amt' class="textboxdisplay" value="" style="width: 465px;">
											</div>
										</div>	
									</div>
									<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
										<div class="buttonsection">
											<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
										</div>
										<div class="buttonsection">
											<input type="submit" name="update" id="update" value=" Update "/>
										</div>
										<div class="buttonsection">
											<input type="submit" name="submit" id="submit" value=" Submit "/>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="div3"></div>
				</div>
			</blockquote>
		</div>
	</div>
</div>
</form>

@endsection