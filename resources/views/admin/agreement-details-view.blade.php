@include('layouts.library.config')
@include('layouts.library.functions')
@include('layouts.header')
    <body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
        <!--==============================header=================================-->
        <form action="" method="post" enctype="multipart/form-data" name="phuploader">
            @include('admin.menu')
            <!--==============================Content=================================-->
            <div class="content">
                <div class="title">Work Orders - View</div>
                <div class="container_12">
                    <div class="grid_12">
                        <blockquote class="bq1" style="overflow:auto">
							<div class="container" align="center">

								<table border="0" align="center" class="table1 table2" id="example">
									<thead>
										<tr class="note" style="background-color:#E5E5E5;">
											<th colspan="8" align="center">List of Works </th>
										</tr>
										<tr class="note heading">
											<th align="center" valign="middle">SNo.</th>
											<th align="center" valign="middle" nowrap="nowrap">Work Order No.</th>
											<th align="center" valign="middle">Work ShortName</th>
											<th align="center" valign="middle">T.S. No.</th>
											<th align="center" valign="middle">Name of Contractor</th>
											<th align="center" valign="middle">Agreement No.</th>
											<th align="center" valign="middle">C.C.No.</th>
											<th align="center" valign="middle">W.O.Date</th>
										</tr>
									</thead>
									<tbody>
								 	<tr>
										<td align="center"></td>
										<td>
											<a href="AgreementDetailsEdit.php?sheetid="><u></u></a>
											<a class="tooltipwarning" title="Already Measurements Entered for this work order. Unable to Edit."></a>	
										</td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
								</tbody>
							</table>
							<table width="100%">
								<tr>
									<td align="center">&nbsp;</td>
								</tr>
								<tr>
									<td align="center">
										<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
									</td>
								</tr>
							</table>
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

