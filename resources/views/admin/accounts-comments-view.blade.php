@include('layouts.library.config')
@include('layouts.library.functions')
@include('layouts.header')
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
<!--==============================header=================================-->
	@include('admin.menu')
 <!--==============================Content=================================-->
	<div class="content">
        <div class="title">Accounts Comments</div>
		<div class="container_12">
			<div class="grid_12">
				<blockquote class="bq1">
					<form name="form" method="post" action="">
						<div class="container" style="text-align:center">
							<br/>
							<table width="100%"  bgcolor="#E8E8E8" border="0" cellpadding="4" cellspacing="4" align="center" class="label table1">
								<tr>
									<td colspan="5" align="left">&nbsp;&nbsp;&nbsp;Work Short Name : &nbsp;&nbsp;&nbsp;<?php //echo $short_name; ?></td>
								</tr>
								<tr>
									<td>Sl.No.</td><td>Date</td><td>Item No.</td><td>MBook No.</td><td>Accounts Comments</td>
								</tr>
								<tr>
									<td></td>
									<td>&nbsp;</td>
									<td></td>
									<td></td>
									<td align="left">&nbsp;</td>
								</tr>
								<tr>
									<td></td>
									<td>&nbsp;</td>
									<td></td>
									<td></td>
									<td align="left">&nbsp;</td>
								</tr>
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td align="left">&nbsp;</td>
								</tr>
							</table>
						</div>
						<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
							<div class="buttonsection">
								<input type="button" name="back" value="Back" id="back" class="backbutton" onClick="goBack();" /> 
							</div>
						</div>
					</form>
				</blockquote>
			</div>
		</div>
	</div>
         <!--==============================footer=================================-->
    @include('layouts.footer')
   </body>
</html>

