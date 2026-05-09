@include('layouts.library.config')
@include('layouts.library.functions') 
@include('layouts.library.binddata')
@include('layouts.library.sysdate')
@include('layouts.header')
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
  <!--==============================header=================================-->
  @include('admin.menu')
  <!--==============================Content=================================-->
        <div class="content">
            <div class="title"> RAB Status </div>
            <div class="container_12">
                <div class="grid_12">
                    <blockquote class="bq1" style="overflow:auto">
                        <form name="form" method="post" action="RABMbookStatusTableAccounts.php">
                            <table width="100%"  bgcolor="#E8E8E8" border="0" cellpadding="0" cellspacing="0" align="center" >
                                <tr>
									<td width="19%">&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td>&nbsp;</td> 
									<td  class="label">Computer Code No.</td>
									<td  class="labeldisplay">
									   <select name="cmb_work_no" id="cmb_work_no" onChange="find_workname();find_rbn();" class="textboxdisplay" style="width:470px;height:22px;" tabindex="7">
										 <option value="">-------------- Select CCNO ----------------</option>
									   </select>
									</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td></td>
									<td id="val_cc" style="color:red" colspan="3"></td>
								</tr>
								
                               <tr>
							   		<td colspan="5"></td>
							   </tr>

                             </table>
							<div style="text-align:center; height:45px;" class="printbutton">
								<div class="buttonsection">
								<input type="button" name="back" value="Back" id="back" class="backbutton" onClick="goBack();" />
								</div>
								<div class="buttonsection" id="view_btn_section">
								<input type="submit" class="btn" value=" GO " name="btn_go" id="btn_go"/>
								</div>
							</div>
       				</form>
      			</blockquote>
    		</div>
   		</div>
	</div>
	<link rel="stylesheet" href="css/timeline.css">
<!--==============================footer=================================-->
@include('layouts.footer')
</body>
</html>

