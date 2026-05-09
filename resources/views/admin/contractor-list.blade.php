@include('layouts.library.config')
@include('layouts.library.functions')
@include('layouts.library.binddata') 
@include('layouts.library.common')
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
    @include('layouts.header')
    <form action="" method="post" enctype="multipart/form-data" name="form">
        @include('admin.menu')
		<div class="content">
			<div class="title">Contractor List</div>
				<div class="container_12">
					<div class="grid_12">
						<blockquote class="bq1" style="overflow:auto">
							<div class="container" align="center">
								<table border="0" align="center" class="table1 table2" id="example">
									<thead>
										<tr class="note" style="background-color:#E5E5E5;">
											<th colspan="7" align="center">List of Contractors </th>
										</tr>
										<tr class="note heading">
											<th align="center" valign="middle">SNo.</th>
											<th align="center" valign="middle" nowrap="nowrap">Contractot Name</th>
											<th align="center" valign="middle">Bank Name</th>
											<th align="center" valign="middle">Bank Account No.</th>
											<th align="center" valign="middle">PAN No.</th>
											<th align="center" valign="middle">Edit</th>
											<th align="center" valign="middle">Delete</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td align="center"></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td>
												<a href='ContractorEntryEdit.php' class="oval-btn-edit">
													Edit
												</a>
											</td>
											<td>
												<a href="javascript:Delete()" class="oval-btn-delete">
													Delete
												</a>
											</td>
										</tr>
									</tbody>
								</table>
								<input type="hidden" name="hid_delete_flag" id="hid_delete_flag">
							</div>
							<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
								<div class="buttonsection"><input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/></div>
							</div>
						</blockquote>
					</div>
				</div>
			</div>
          @include('layouts.footer')
     </form>
 </body>
</html>
