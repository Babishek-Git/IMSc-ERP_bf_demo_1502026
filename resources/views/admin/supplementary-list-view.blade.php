@include('layouts.library.config')
@include('layouts.library.functions')
@include('layouts.header')
 <body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
 <!--==============================header=================================-->
    <form action="" method="post" enctype="multipart/form-data" name="phuploader">
        @include('admin.menu')
        <!--==============================Content=================================-->
        <div class="content">
            <div class="title">View Supplementary Agreement </div>
            <div class="container_12">
                <div class="grid_12">
                    <blockquote class="bq1" style="overflow:auto">
						<div class="container">
						<!--<div class="heading">
								<div class="col labelcontenthead" align="center"></div>
								<div class="col labelcontenthead" align="center">SNo</div>
								<div class="col labelcontenthead">Work Order No.</div>
								<div class="col labelcontenthead">Work ShortName</div>
								<div class="col labelcontenthead">Name of Work</div>
								<div class="col labelcontenthead">Technical Sanction No.</div>
								<div class="col labelcontenthead">Name of Contractor</div>
								<div class="col labelcontenthead">Agreement No.</div>
								<div class="col labelcontenthead">C.C.No.</div>
								<div class="col labelcontenthead">W.O.Date</div>
							</div>-->
							<table class="table-bordered table1" width="100%" align="center" id="dataTable">
								<thead>
									<tr>
										<td align="left" valign="middle" colspan="9"> Main Agreement Work Name : <br/> Main Agreement W.O.No. : </td>
									<!--<td align="left" valign="middle" colspan="5">Supplementary Work Order No. : </td>-->
												
									</tr>
									<tr class="note heading">
										<th align="center" valign="middle">SNo.</th>
										<th align="center" valign="middle">Supp.W.O.No.</th>
										<th align="center" valign="middle" width="10%">Work ShortName</th>
										<th align="center" valign="middle" width="5%">T.S. No.</th>
										<th align="center" valign="middle" width="10%">Name of Contractor</th>
										<th align="center" valign="middle">Agreement No.</th>
										<th align="center" valign="middle">C.C.No.</th>
										<th align="center" valign="middle">W.O.Date</th>
										<th align="center">Action</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td align="center"></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td align="center">
											<a href="SupplementaryAgreementCreate.php?supp_sheetid=" class="oval-btn-edit">
												<i style="font-size:12px; padding-top:5px;" class="fa">&#xf044;</i> Edit	
											</a>
											&nbsp;
											<a href="javascript:Delete()"  class="oval-btn-delete">
												<i style="font-size:12px; padding-top:5px; font-weight:100" class="fa">&#xf00d;</i> Delete
											</a>
										</td>
									</tr>
								</tbody>
								</table>
								<input type="hidden" name="hid_delete_flag" id="hid_delete_flag">
                            </div>
								<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
									<div class="buttonsection">
									<input type="submit" name="back" value="Back">
									</div>	
									</div>
                        </blockquote>
                        <div>&nbsp;</div>
                        <div>
						</div>
                    </div>
                </div>   
            </div>
            <!--==============================footer=================================-->
           @include('layouts.footer')
        </form>
    </body>
</html>
<link rel="stylesheet" type="text/css" media="screen" href="dataTable/jquery.dataTables.min.css" />
<script type="text/javascript" src="dataTable/jquery.dataTables.min.js"></script>