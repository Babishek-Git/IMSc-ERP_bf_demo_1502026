@include('layouts.library.config')
@include('layouts.library.functions')
@include('layouts.library.binddata')
@include('layouts.library.common')
@include('layouts.header')
    <body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
        <!--==============================header=================================-->
        <form action="" method="post" enctype="multipart/form-data" name="phuploader">
            @include('admin.menu')
            <!--==============================Content=================================-->
            <div class="content"> 
                <div class="title">Consolidated Work List</div>
                <div class="container_12"> 
                    <div class="grid_12" align="center">
                        <blockquote class="bq1" style="height:1px; overflow:auto;">
                            <div class="container" >
							<!--<i class='fa fa-info-circle' style='font-size:18px;color: #F4AE0B'>Final Bill</i> &nbsp; &nbsp;
							<i class='fa fa-check-circle' style='font-size:18px;color:#37bd64'>Work Under Processing</i>&nbsp; &nbsp;
							<i class='fa fa-times-circle' style='font-size:18px;color: red'>Work Expried</i>-->
							<br/>
								<table width="200%" class="table1 table2" >
									<tr class="heading">
										<th class="colhead" nowrap="nowrap">S.No.</th>
										<th class="colhead" style="width:10%">Name Of Work</th>
										<th class="colhead" style="text-align:left">Computer Code</th>
										<th class="colhead" style="text-align:left">Head Of Account</th>
										<th class="colhead" style="text-align:center">Technical<br/>Sanction No.</th>
										<th class="colhead" style="text-align:center">Name of </br>contractor</th>
										<th class="colhead" style="text-align:center">Agreement <br/>No.</th>
										<th class="colhead" style="text-align:center">Work Order Value</th>
										<th class="colhead" style="text-align:center">Work Order<br/> No /Date </th>
										<th class="colhead" style="text-align:center">Period Of <br/>Contract</th>
										<th class="colhead" style="text-align:center" nowrap="nowrap">Sch.Date of<br/> Commence.</th>
										<th class="colhead" style="text-align:center" nowrap="nowrap">Sch.Date of<br/> Completion</th>
										<th class="colhead" style="text-align:center">MBook Nos.</th>
										<th class="colhead" style="text-align:center">Total Value Work Done</th>
										<th class="colhead" style="text-align:center" nowrap="nowrap">Act.Date of<br/> Completion</th>
									    <th class="colhead" style="text-align:center">PG Released Date</th>
										<th class="colhead" style="text-align:center">SD Released Date</th>
										<th class="colhead" style="text-align:center">Remarks</th>
									</tr>
									<tr class="table-row">
										<td class="col" align="center"><font class="">&nbsp;</font></td>
										<td class="col" align="justify"></td>
										<td class="col" align="center" nowrap="nowrap"></td>
										<td class="col" align="center"></td>
										<td class="col" align="center"></td>
										<td class="col" align="center"></td>
										<td class="col" align="center"></td>
										<td class="col" align="center" nowrap="nowrap"></td>
										<td class="col" align="center"> <br/> </td>
										<td class="col" align="center" nowrap="nowrap">&nbsp;months</td>
										<td class="col" align="center" nowrap="nowrap"></td>
									    <td class="col" align="center" nowrap="nowrap"></td>
										<td class="col" align="justify"></td>
										<td class="col" align="right" nowrap="nowrap"></td>
										<td class="col" align="center" nowrap="nowrap"></td>
									    <td class="col" align="center">&nbsp;</td>
										<td class="col" align="center">&nbsp;</td>
										<td class="col"> 
									    </td>
									</tr>
		 							
									<tr>
										<td align="center" colspan="10">No Records Found</td>
									</tr>
									
								</table>
                            </div>
							<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
								<div class="buttonsection">
								<input type="button" name="back" class="backbutton" value=" Back " onClick="goBack()">
								</div>
							</div>
                        </blockquote>
                    </div>
                </div>
            </div>
             <!--==============================footer=================================-->
          @include('layouts.footer')
        </form>
    </body>
</html>
