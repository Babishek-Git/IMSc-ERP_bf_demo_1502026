@include('layouts.library.config')
@include('layouts.library.functions') 
@include('layouts.library.binddata') 
@include('layouts.library.common')
@include('layouts.header')
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
        <!--==============================header=================================-->
    <form action="" method="post" enctype="multipart/form-data" name="form">
    @include('admin.menu')
            <!--==============================Content=================================-->
		<div class="content">
			<div align="center" class="container_12">
				<table width='1087px' cellpadding='3' cellspacing='3' align='center' class='table1' bgcolor='#FFFFFF' id='table1'>
				</table>	
				<p style='page-break-after:always;'></p>
				<tr>
					<td align="center"></td>
					<td align="center"></td>
					<td align="center"></td>
					<td align="center"></td>
					<td align="center"></td>
					<td align="center"></td>
					<td align="center"></td>
				</tr>
				<tr>
					<td align="center">Total Consumption.</td>
					<td align="center"></td>
					<td align="center"></td>
					<td align="center"></td>
					<td align="center"></td>
					<td align="center"></td>
					<td align="center"></td>
				</tr>
					<input type="hidden" name="txt_consum_page" id="txt_consum_page" value="">
					<input type="hidden" name="txt_consum_mbook" id="txt_consum_mbook" value="">
					<input type="hidden" name="txt_sc_esc_id" id="txt_sc_esc_id" value="">
					<input type="hidden" name="txt_sc_esc_rbn" id="txt_sc_esc_rbn" value="">
					<input type="hidden" name="txt_start_page" id="txt_start_page" value="">
					<input type="hidden" name="txt_end_page" id="txt_end_page" value="">
					<input type="hidden" name="txt_scmbook" id="txt_scmbook" value="">
					<input type="hidden" name="txt_sc_quarter" id="txt_sc_quarter" value="">
						<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
							<div class="buttonsection">
								<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
							</div>
							<div class="buttonsection">
								<input type="submit" name="submit" id="submit" value=" Save "/>
							</div>
						</div>
				</div>
            <!--==============================footer=================================-->
          @include('layouts.footer')
			</div>
        </form>
    </body>
</html>
