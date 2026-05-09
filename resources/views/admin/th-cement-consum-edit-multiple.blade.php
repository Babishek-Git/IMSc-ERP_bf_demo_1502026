@include('layouts.library.config')
@include('layouts.library.functions') 
@include('layouts.header')
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
        <!--==============================header=================================-->
    @include('admin.menu')
        <!--==============================Content=================================-->
    <div class="content">
        <div class="title">Theoritical Cement Consumption - Edit</div>
        <div class="container_12">
             <div class="grid_12" align="center">
                 <blockquote class="bq1" style="overflow:scroll">
                    <form name="form" method="post" action="">
                       <div class="container">
						<br/>
						<table width="90%" class="table1 table2">
							<!--<tr><td colspan="8">&nbsp;</td></tr>-->
							<tr class="heading">
								<!--<td align="center">Date</td>-->
								<th align="center" width="10%" class="colhead">Item No.</th>
								<th align="center" width="70%" class="colhead">Item Description</th>
								<th align="center" width="20%" class="colhead">Theor. Cem. Consum.</th>
							</tr>
							<tr class="labelsmall">
								<td align="center" valign="middle"></td>
								<td align="left"></td>
								<td align="center" valign="middle">
								<input type="text" class="textboxnewl" tabindex="" name="txt_tc_unit_" id="txt_tc_unit_" value="" style="width:99%;">
								</td>
								</tr>
							</table>
							<input type="hidden" name="txt_id" id="txt_id" value="">
				 		</div>
						<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
							<div class="buttonsection">
								<input type="button" name="back" value="Back" id="back" class="backbutton" onClick="goBack();" />
							</div>
							<div class="buttonsection">
								<input type="submit" class="btn" data-type="submit" value=" Update " name="submit" id="submit"   />
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

