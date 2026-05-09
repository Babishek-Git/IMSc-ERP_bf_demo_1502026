@include('layouts.library.config')
@include('layouts.library.functions')
@include('layouts.library.binddata') 
	<form name="form" method="post" action=">
         <div class="container">
			<div class="row ">
				<div class="div2">&nbsp;</div>			
					<div class="div8">
						<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center"> Bidder's / Contractor's Details Entry</div></div></div>
							<div class="row innerdiv">
								<div class="row">
									<div class="div4">
										<label for="fname">Contractor Name</label>
									</div>
									<div class="div8">
										<input type="text" name='txt_cont_name' id='txt_cont_name' class="tboxclass" >
									</div>
								</div>
								<div class="row">
									<div class="div4">
										<label for="fname">Contractor Address</label>
									</div>
									<div class="div8">
										<input type="text" name='txt_cont_addr' id='txt_cont_addr' class="tboxclass" >
									</div>
								</div>
								<div class="row">
									<div class="div4">
										<label for="fname">PAN No.</label>
									</div>
									<div class="div8">
										<input type="text" name='txt_pan_no' id='txt_pan_no' class="tboxclass" >
									</div>
									</div>
									<div class="row">
										<div class="div4">
											<label for="fname">GST No.</label>
										</div>
										<div class="div8">
											<input type="text" name='txt_gst_no' id='txt_gst_no' class="tboxclass" >
										</div>
									</div>
									<div class="row">
										<div class="div4">
											<label for="fname">Bank Account No.</label>
										</div>
										<div class="div8">
											<input type="text" name='txt_acc_no' id='txt_acc_no' class="tboxclass" >
										</div>
									</div>
									<div class="row">
										<div class="div4">
											<label for="fname">Bank Name</label>
											</div>
											<div class="div8">
												<input type="text" name='txt_bank_name' id='txt_bank_name' class="tboxclass" >
											</div>
										</div>
											<div class="row">
												<div class="div4">
													<label for="fname">Branch Name</label>
												</div>
												<div class="div8">
													<input type="text" name='txt_branch_name' id='txt_branch_name' class="tboxclass" >
												</div>
											</div>
											<div class="row">
												<div class="div4">
													<label for="fname">IFSC</label>
												</div>
												<div class="div8">
													<input type="text" name='txt_ifsc_no' id='txt_ifsc_no' class="tboxclass" >
												</div>
											</div>
											<div class="smediv">&nbsp;</div>
										</div>
										
									</div>
									<div class="div2">&nbsp;</div>
								</div>
										
								<div class="row">
									<div class="div12" align="center">
										<input type="button" class="backbutton" name="btn_view" id="btn_view" value="View" onClick="ViewBidder();"/>
										<input type="submit" data-type="submit" value=" Submit " name="Submit" id="Submit"/>
									</div>
								</div>		
                        	</form>
                    	</blockquote>
                	</div>
            	</div>
        	</div>
		</div> 
    </body>
</html>

