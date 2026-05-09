@extends('layouts.dashboard-master')

@section('content')
    <body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
        <form action="" method="post" enctype="multipart/form-data" name="phuploader">
            <div class="content">  
                <div class="title">Short Notes Creation</div>
                <div class="container_12">  
                    <div class="grid_12" align="center"> 
                        <blockquote class="bq1" id="bq1" style="overflow:auto;">
                            <div class="container">
								<div align="left" style="width:90%; font-family:Verdana, Arial, Helvetica, sans-serif; color:#007BB7; font-size:11px; font-weight:bold;">
								  	<!--<span class="general">&nbsp;&nbsp;&nbsp;&nbsp;</span> General &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
									<span class="steel">&nbsp;&nbsp;&nbsp;&nbsp;</span> Steel &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<span class="st-steel">&nbsp;&nbsp;&nbsp;&nbsp;</span> Structural Steel 
								</div>
								<div class="titlesec" style="width:89%">
									<b>Name of Work</b> :  <font style="color:#DF0979; font-weight:bold; background:#edeaea; border-radius:7px; padding:2px;">CCNo. </font>
								</div>
								<div class="smediv">&nbsp;</div>
								<table width="90%" class="table1 table2">
									<tr class="heading">
										<th class="colhead" nowrap="nowrap">Item No.</th>
										<th class="colhead">Description</th>
										<th class="colhead" nowrap="nowrap">Total Qty.</th>
										<th class="colhead">Unit</th>
										<th class="colhead">Rate <i class="fa fa-inr" style="padding-top:7px;"></i></th>
										<th class="colhead" nowrap="nowrap">Total Amt <i class="fa fa-inr" style="padding-top:7px;"></i></th>
									</tr>
										<tr>
											<td class="col" align="center" nowrap="nowrap">
											<span class="">
											</span>
											</td>
											<td class="col labelprint"></td>
											<td class="col" align="right">&nbsp;</td>
											<td class="col">&nbsp;&nbsp;</td>
											<td class="col" align="right">&nbsp;</td>
											<td class="col" align="right">&nbsp;</td>
										</tr>
										<tr>
											<td colspan="6">
											<textarea name="txt_snotes_" class="textboxdisplay" style="width:100%"></textarea>
											<input type="hidden" name="txt_schid[]" value="">
											</td>
										</tr>
										<tr>
											<td class="col"></td>
											<td class="col label" align="right">Over All Total Amount&nbsp;&nbsp;</td>
											<td class="col"></td>
											<td class="col"></td>
											<td class="col"></td>
											<td class="col label" nowrap="nowrap" align="right">&nbsp;&nbsp;</td>
										</tr>
										<tr>
											<td class="col"></td>
											<td class="col label" align="right">Over All Rebate&nbsp;&nbsp;(%)&nbsp;&nbsp;</td>
											<td class="col"></td>
											<td class="col"></td>
											<td class="col"></td>
											<td class="col label" nowrap="nowrap" align="right"> &nbsp;&nbsp;</td>
										</tr>
										<tr>
											<td class="col"></td>
											<td class="col label" align="right">Net Amount&nbsp;&nbsp;</td>
											<td class="col"></td>
											<td class="col"></td>
											<td class="col"></td>
											<td class="col label" nowrap="nowrap" align="right"> &nbsp;&nbsp;</td>
										</tr>
									</table>
                            </div>
							<div class="row">
								<div class="div12" align="center">
									<input type="submit" name="submit" value="Back">
									<input type="submit" name="save" value="Save">
								</div>
							</div>
							<div class="smediv"></div>
                        </blockquote>
                    </div> 
                </div> 
            </div> 
        </form>
    </body>
</html>
@endsection