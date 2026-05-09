@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

<div class="content">
 <div class="title"></div>
	<div class="container_12">
		<div class="grid_12">
			<blockquote class="bq1" style="overflow:auto">
				<form name="form" method="post" action="">
					<div class="container">
						<div class="row ">
							<div class="div3">&nbsp;</div>
							<div class="div6 mbtable">
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center"> SOQ Status </div></div></div>
								<div class="row innerdiv"> 
									<div class="row" align="center" style="margin-top:0px;">
									    <div class="div2">&nbsp;</div>
										<div class="div2 label" align="center">
											CC No.
										</div>
										<div class="div3" align="left" style="width:150px;">
											<input type="text" name='txt_cc_no' id='txt_cc_no' class="tboxclass" value="" autocomplete="off">
										</div>
										<div class="div2" align="left" style ="padding-left: 10px ">
											<input type="submit" class="btn" data-type="submit" value=" View " name="submit" id="submit" />
										</div>
										<div class="div2" align="left" style="height:0px; color:red;" id="val_ccno"></div>
										<!--<label align="left" style="height:0px; color:red;" id="val_ccno"> </label>-->
										<!--<div class="div12" align="center" style="height:0px; color:red;" id="val_ccno"></div>-->
									</div>
									<div class="div12" style="height:0px;">&nbsp;</div>
								</div>
								<div class="row" style="display:none"  ?>>
									<div class="smediv">&nbsp;</div>
									<div class="div4">&nbsp;</div>
									<div class="div4">
										<div class="col-md-2 well-A level rspanwhite" align="left"><i class='fa fa-check-circle' style='font-size:20px; color:#10A465'></i>&nbsp;&nbsp;SOQ Uploaded </div> <br/>
										<div class="col-md-2 well-A level rspanred" align="left"><i class='fa fa-times-circle' style='font-size:20px; color:#F13059'></i>&nbsp;&nbsp;SOQ Not Uploaded</div> <br/>
										<div class="col-md-2 well-A level rspanwhite" align="left"><i class='fa fa-check-circle' style='font-size:20px; color:#10A465'></i>&nbsp;&nbsp;Staff  Assigned</div> <br/>
										<div class="col-md-2 well-A level rspanred" align="left"><i class='fa fa-times-circle' style='font-size:20px; color:#F13059'></i>&nbsp;&nbsp;Staff Not Assigned</div> <br/>
										<div class="col-md-2 well-A level rspanwhite" align="left"><i class='fa fa-check-circle' style='font-size:20px; color:#10A465'></i>&nbsp;&nbsp;Mbook Assigned </div> <br/>
										<div class="col-md-2 well-A level rspanred" align="left"><i class='fa fa-times-circle' style='font-size:20px; color:#F13059'></i>&nbsp;&nbsp;Mbook Not Assigned </div> <br/>
									</div>
									<div class="div4">&nbsp;</div>
								</div>
							</div>
							<div class="div3">&nbsp;</div>
						</div>
					</div>
					<!--<div style="text-align:center; height:30px; line-height:30px;" class="printbutton">
						<div class="buttonsection">
							<input type="submit" class="btn" data-type="submit" value=" View " name="submit" id="submit" style ="padding: 3px 10px; " />
							<input type="hidden" id="hidde_ccno" name="hidde_ccno" value="
							">
						</div>
					</div>-->
					
					<!--<div style="text-align:center; height:30px; line-height:30px;" class="printbutton">
						<div class="buttonsection">
							<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
						</div>
					</div> -->
				</form>
			</blockquote>
		</div>
	</div>
</div>
@endsection
