@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
<script type="text/javascript" language="javascript">
	function goBack(){
		url = "ViewWaterRecovery.php";
		window.location.replace(url);
	}	
</script>

<style>
	.container{
		display:table;
		width:100%;
		border-collapse: collapse;
	}
		
	.table-row{  
		display:table-row;
		text-align: left;
	}
	.col{
		display:table-cell;
		border: 1px solid #CCC; word-break:break-all;
		font-size:12px;
	}
</style>
<SCRIPT type="text/javascript">
	window.history.forward();
	function noBack() { window.history.forward(); }
</SCRIPT>
<body class="page1" id="top">
	<form name="form" method="get" action="{{ route('admin.ViewWaterRecoveryList') }}">
		<div class="content">
			<div class="title"></div>
			<div class="container_12">
				<div class="grid_12">
					<blockquote class="bq1" style="overflow:auto">
						<div class="container">
							<div class="row ">
								<div class="div3">&nbsp;</div>
								<div class="div6 mbtable">
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center"> Water Recovery List </div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">		
											<table width="99%" class="table1 table2" id="example">
												<thead>
													<tr>
														<th>Slno.</th>
														<th nowrap="nowrap">Bill Value</th>
														<th nowrap="nowrap">[%] of Bill Value</th>
														<th nowrap="nowrap">Amount</th>
														<th nowrap="nowrap">Date of Created</th>
														<!--<th>Action</th>-->
													</tr>
												</thead>
												<tbody>
												@php $slno = 1; if($RowCount == 1){ foreach($SelectRecData as $EBList){ @endphp
													<tr>
														<td align="center">@php echo $slno; @endphp</td>
														<td align="right">@php echo $TotalAmount; @endphp</td>
														<td align="right">@php echo $EBList->water_cost_perc; @endphp</td>
														<td align="right">@php echo $EBList->water_cost; @endphp</td>
														<td align="right">@php echo Helper::DisplayDateFormat($EBList->wr_date); @endphp</td>
														<!-- <td align="center"> -->
														@php // if($Modify == 1){ @endphp
														<!-- <button type="button" class="btn2 btn2-default btn2-sm Delete" data-did="@php echo $EBList->wid; @endphp">
															<i class="fa fa-times-circle" style="font-size:17px;"></i>
															Delete
														</button> -->
														@php //}else{ @endphp
														<!-- <button type="button" class="btn4 btn4-default btn4-sm" data-did="@php echo $EBList->wid; @endphp" disabled="disabled">
															<i class="fa fa-times-circle" style="font-size:17px;"></i>
															Delete
														</button> -->
														@php // } @endphp
														<!-- </td> -->
													</tr>
												@php $slno++; } } @endphp
												</tbody>
											</table>
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
										</div>
									</div>
								</div>
								<div class="div3">&nbsp;</div>
							</div>
						</div>
					</blockquote>
				</div>
			</div>
		</div>
	</form>
</body>
<script type="text/javascript" src="dataTable/jquery.dataTables.min.js"></script>
<script>
	$(document).ready(function() { 
		$('#example').DataTable({ "paging":false, "info":false }); 
		$(".Delete").click(function(event){
			var id = $(this).attr("data-did");
			$.ajax({ 
				type: 'POST', 
				url: 'FindWERecDelete.php', 
				data: { id: id, page: 'WBR' }, 
				success: function (data) {  
					if(data != ""){
						if(data == 1){
							swal({
							  title: "",
							  text: "Water Recovery Deleted Sucessfully",
							  type: "success",
							  confirmButtonText: " OK ",
							},
							function(isConfirm){
								window.location.replace("ViewWaterRecoveryList.php");
							});
						}else{
							swal("Sorry unable to Delete. Please try again.", "", "");
						}
					}
				}
			});
		});
	});
</script>
            <!--==============================footer=================================-->
			<script>
				var msg = "@php// echo $msg; @endphp";
				var success = "@php// echo $success; @endphp";
				var titletext = "";
				document.querySelector('#top').onload = function(){
				if(msg != "")
				{
					if(success == 1)
					{
						swal("", msg, "success");
					}
					else
					{
						swal(msg, "", "");
					}
				}
				};
			</script>
        </form>
    </body>
</html>
@endsection