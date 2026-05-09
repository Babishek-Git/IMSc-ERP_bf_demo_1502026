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
		<div class="title">Water Recovery List</div>
           <div class="container_12">
				<div class="grid_12">
					<blockquote class="bq1" id="bq1" style="overflow:auto">
					<div class="container" align="center">
						<table width="99%" class="table1 table2" id="example">
							<thead>
								<tr>
									<th>Slno.</th>
									<th nowrap="nowrap">Bill Value</th>
									<th nowrap="nowrap">[%] of Bill Value</th>
									<th nowrap="nowrap">Amount</th>
									<th nowrap="nowrap">Date of Created</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr>
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
									<button type="button" class="btn4 btn4-default btn4-sm" data-did="" disabled="disabled">
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
		<link rel="stylesheet" type="text/css" media="screen" href="dataTable/jquery.dataTables.min.css" />
		<script type="text/javascript" src="dataTable/jquery.dataTables.min.js"></script>
        </form>
    </body>
</html>
