@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
 <body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
    <form action="" method="post" enctype="multipart/form-data" name="phuploader">
		<div class="content">
		 <div class="title">Work - Wise MBook Allotment List</div>
           <div class="container_12">
				<div class="grid_12">
                   	<!--<div align="right"><a href="AgreementMBookAllotment.php?page=engineer" >AddNew</a></div>-->
					<blockquote class="bq1" id="bq1" style="overflow:auto">
					<div class="container" align="center">
					<div class="div1"></div>
					<div class="div10 mbtable">
					<table width="98%" class="table1 table2" id="example">
						<thead>
							<tr>
								<th nowrap="nowrap">&nbsp;Slno.&nbsp;</th>
								<th align="left">Name of Work</th>
								<th align="left">Work Order No.</th>
								<th nowrap="nowrap">General MBook Nos.</th>
								<th nowrap="nowrap">Steel MBook Nos.</th>
								<th nowrap="nowrap">Abstract MBook Nos.</th>
								<th nowrap="nowrap">Escalation MBook Nos.</th>
								<th nowrap="nowrap">Created On</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<tr>
							@foreach($data as $MBList)
								<td align="center">{{ $loop->iteration }}</td>
								<td align="center">{{ $MBList->work_name }}</td>
								<td align="center">{{ $MBList->work_order_no }}
								<td align="center">{{ $MBList->mbooktype }}</td>
								<td align="center">{{ $MBList->mbooktype }}</td>
								<td align="center">{{ $MBList->mbooktype }}</td>
								<td align="center">{{ $MBList->mbooktype }}</td>
								<td align="center">{{ $MBList->createddate }}</td>
								<td>
									<!--<a class="btn3 btn3-default btn3-sm Edit" href='AgreementMBookAllotmentEditPage.php?sheetid=' <>
										<i class="fa fa-edit" style="font-size:17px"></i>EDIT
									</a>-->
									<a class="btn3 btn3-default btn3-sm Delete" href='AgreementMBookAllotmentEditPage.php?sheetid='>
										<i class="fa fa-times" style="font-size:17px"></i> Remove
									</a>
									<!-- <a class="btn3 btn3-default btn3-sm Delete" style="pointer-events:none; color:#666666">
										<i class="fa fa-times" style="font-size:17px"></i> Remove
									</a> -->
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					</div>
					<div class="div2"></div>
					</div>
					<table width="100%">
						<tr>
							<td align="center">&nbsp;
								
							</td>
						</tr>
						<tr>
							<td align="center">
								<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
								<!-- <input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBackUser();"> -->
								<input type="submit" data-type="submit" value=" Submit " name="Submit" id="Submit" onClick="return validation()"/>
							</td>
						</tr>
					</table>
					<div class="smediv"></div>
                 	</blockquote>
				</div>
            </div>
		</div>
		<link rel="stylesheet" type="text/css" media="screen" href="dataTable/jquery.dataTables.min.css" />
		<script type="text/javascript" src="dataTable/jquery.dataTables.min.js"></script>
        </form>
    </body>
</html>
@endsection
