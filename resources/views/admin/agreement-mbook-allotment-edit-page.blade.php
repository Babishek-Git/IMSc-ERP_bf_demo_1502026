@include('layouts.library.config')
@include('layouts.library.functions')
@include('layouts.library.binddata') 
@include('layouts.header')
<script language="javascript" type="text/javascript" src="script/validfn.js"></script>
    <body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
        <!--==============================header=================================-->
         @include('admin.menu')
        <!--==============================Content=================================-->
        <div class="content">
            <div class="title">Work - Wise MBook Allotment</div>
            <div class="container_12">
                <div class="grid_12">
                    <blockquote class="bq1" style="overflow:auto"> 
						<div align="right"><a href="AgreementMBookAllotment.php">Add New</a></div>
                        <form name="form" method="post" action="">
                            <div class="container">
								<div class="row ">
									<div class="div2">&nbsp;</div>
									<div class="div8">
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Work - Wise General / Steel / Abstract / Escalation MBook Allotment</div></div></div>
										<div class="row innerdiv">
											<div class="row">
												<div class="div4">
													<label for="fname">Work Short Name</label>
												</div>
												<div class="div8">
													<select id="workorderno" name="workorderno" class="tboxclass" onchange='workorderdetail();GetAllStaffList()'>
														<option value="" selected="selected"><?php echo $ShortName; ?></option>
														<option value=""> ------ Select Work Short Name ------ </option>
													</select>
												</div>
											</div>
											<div class="row">
												<div class="div4">
													<label for="fname">Work Order No.</label>
												</div>
												<div class="div8">
													<input type="text" name='txt_workorder_no' id='txt_workorder_no' class="tboxclass" readonly="" value="">
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
											
											<div class="row">
												<div class="div3" align="center">
													<div class="innerdiv2">
														<div class="row divhead" align="center">General</div>
														<div class="row innerdiv" align="center">
															<select id="mbookG" name="mbookG[]" class="tboxclass mbno" multiple="multiple">
															</select>
														</div>
													</div>
												</div>
												<div class="div3" align="center">
													<div class="innerdiv2">
														<div class="row divhead" align="center">Steel</div>
														<div class="row innerdiv" align="center">
															<select id="mbookS" name="mbookS[]" class="tboxclass mbno" multiple="multiple">
															</select>
														</div>
													</div>
												</div>
												<div class="div3" align="center">
													<div class="innerdiv2">
														<div class="row divhead" align="center">Abstract</div>
														<div class="row innerdiv" align="center">
															<select id="mbookA" name="mbookA[]" class="tboxclass mbno" multiple="multiple">
															</select>
														</div>
													</div>
												</div>
												<div class="div3" align="center">
													<div class="innerdiv2">
														<div class="row divhead" align="center">Escalation</div>
														<div class="row innerdiv" align="center">
															<select id="mbookE" name="mbookE[]" class="tboxclass mbno" multiple="multiple">
															</select>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row"><span style="color:#FA055B; font-weight:bold; font-size:11px;"> * Unused MBook only displayed in above list.</span></div>			
									</div>
									
								  	<div class="div2">&nbsp;</div>
								</div>
							</div>
							<input type="hidden" name="RemoveG" id="RemoveG" class="remove">
							<input type="hidden" name="RemoveS" id="RemoveS" class="remove">
							<input type="hidden" name="RemoveA" id="RemoveA" class="remove">
							<input type="hidden" name="RemoveE" id="RemoveE" class="remove">
							<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
								<!--<div class="buttonsection">
									<input type="submit" class="backbutton" name="btn_view" id="btn_view" value="View"/>
								</div>-->
								<div class="buttonsection">
									<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
								</div>
								<div class="buttonsection">
									<input type="submit" data-type="submit" value=" Submit " name="Submit" id="Submit" onClick="return validation()"/>
								</div>
							</div>           
                        </form>
                    </blockquote>
                </div>
            </div>
        </div>
         <!--==============================footer=================================-->
		  @include('layouts.footer') 
    </body>
</html>

