@include('layouts.library.config')
@include('layouts.library.functions') 
@include('layouts.library.common')
@include('layouts.header')
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
        <!--==============================header=================================-->
    <form action="" method="post" enctype="multipart/form-data" name="phuploader">
        @include('admin.menu')
            <!--==============================Content=================================-->
		<div class="content">
			<div class="title">Electricity Recovery List</div>
			<div class="container_12">
				<div class="grid_12">
					<blockquote class="bq1" id="bq1" style="overflow:auto">
						<div class="container" align="center">
							<table width="99%" class="table1 table2" id="example">
								<thead>
									<tr>
										<th>Slno.</th>
										<th>Bill No.</th>
										<th nowrap="nowrap">Meter No.</th>
										<th nowrap="nowrap">I.M.R</th>
										<th nowrap="nowrap">I.M.R. Date</th>
										<th nowrap="nowrap">F.M.R</th>
										<th nowrap="nowrap">F.M.R. Date</th>
										<th nowrap="nowrap">Unit Consumed</th>
										<th nowrap="nowrap">Rate</th>
										<th nowrap="nowrap">Meter Rent</th>
										<th nowrap="nowrap">Amount</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="center"></td>
										<td align="right"></td>
										<td align="right"></td>
										<td align="right"></td>
										<td align="right"></td>
										<td align="center">
											<button type="button" class="btn2 btn2-default btn2-sm Delete" data-did="">
												<i class="fa fa-times-circle" style="font-size:17px;"></i>
												Delete
											</button>
											<button type="button" class="btn4 btn4-default btn4-sm" data-did="<?php //echo $EBList->wid; ?>" disabled="disabled">
												<i class="fa fa-times-circle" style="font-size:17px;"></i>
												Delete
											</button>
										</td>
									</tr>
								</tbody>
							</table>
                    	</div>
						<table width="100%">
							<tr>
								<td align="center">&nbsp;	
								</td>
							</tr>
							<tr>
								<td align="center">
									<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
								</td>
							</tr>
						</table>
                 	</blockquote>
				</div>
            </div>
		</div>
<!--==============================footer=================================-->
@include('layouts.footer')
        </form>
    </body>
</html>
