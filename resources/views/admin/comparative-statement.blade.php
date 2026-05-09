@include('layouts.library.config')
@include('layouts.library.functions')
@include('layouts.library.binddata') 
@include('layouts.header')
    <body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
        <!--==============================header=================================-->
        <form action="" method="post" enctype="multipart/form-data" name="phuploader">
            @include('layouts.header')
            <div class="content">  
                <div class="title">Comparative Statement</div>
                <div class="container_12">  
                    <div class="grid_12" align="center"> 
                        <blockquote class="bq1" id="bq1" style="overflow:auto;">
                            <div class="container" align="center">
								<div class="smediv">&nbsp;</div>
								<table class="DispTable" width="100%">
									<thead>
										<tr>
											<th rowspan="2">Item No.</th>
											<th rowspan="2">Item Description</th>
											<th rowspan="2">Item Qty</th>
											<th rowspan="2">Item Unit</th>
											<th colspan="2">Department Estimate</th>
												
										</tr>
										<tr>
											<th nowrap="nowrap">Rate <br/>( &#8377; )</th>
											<th nowrap="nowrap">Amount <br/>( &#8377; )</th>
										</tr>
									</thead>
									<tbody>
									
										<tr>
											<td>&nbsp;</td>
											<td align="right" nowrap="nowrap"><b>Total Amount ( &#8377; )</b></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td align="right"><b></b></td>
											
										</tr>
										<!--<tr>
											<td>&nbsp;</td>
											<td align="right"><b>Rebate ( % )</b></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td align="right">&nbsp;</td>
											
										</tr>
										<tr>
											<td>&nbsp;</td>
											<td align="right"><b>Rebate Amount ( &#8377; )</b></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td align="right">&nbsp;</td>
											
										</tr>
										<tr>
											<td>&nbsp;</td>
											<td align="right" nowrap="nowrap"><b>Total Amount After Rebate ( &#8377; )</b></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td align="right">&nbsp;</td>
											
										</tr>-->
										<tr>
											<td>&nbsp;</td>
											<td align="right" nowrap="nowrap"><b>Variation Amount ( &#8377; )</b></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td align="right">&nbsp;</td>
											
										</tr>
										<tr>
											<td>&nbsp;</td>
											<td align="right" nowrap="nowrap"><b>Variation ( % )</b></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td align="right">&nbsp;</td>
											
										</tr>
										<tr>
											<td>&nbsp;</td>
											<td align="right"><b>Excess / Less</b></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td align="right">&nbsp;</td>
											
										</tr>
									</tbody>
								</table>
                            </div>
							<div style="text-align:center; height:30px; line-height:30px;" class="printbutton">
								<div class="buttonsection">
									<input type="submit" name="back" value="Back">
								</div>
								<div class="buttonsection">
									<input type="button" name="exportToExcel" id="exportToExcel" value="Export To Excel" class="backbutton">
								</div>
							</div>
                        </blockquote>
                    </div> 

                </div> 
                
            </div> 
            
           @include('layouts.footer')
        </form>
    </body>
</html>
