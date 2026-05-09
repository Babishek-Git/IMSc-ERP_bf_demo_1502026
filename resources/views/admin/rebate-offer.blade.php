@include('layouts.library.config')
@include('layouts.library.functions') 
@include('layouts.library.spellnumber')
@include('layouts.header')
    <body class="page1" id="top">
        <!--==============================header=================================-->

         @include('admin.menu')
        <!--==============================Content=================================-->
        <div class="content">
            <div class="container_12">
                <div class="grid_12">
                    <blockquote class="bq1">
                        <div class="title">Rebate Offer</div>
                        <form name="form" method="post" action="">
                       
                            <div class="container">

                                <table width="1078px"  bgcolor="#E8E8E8" border="0" cellpadding="0" cellspacing="0" align="center" >
                                    <tr><td width="19%">&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
									<tr>
									<td>&nbsp;</td> 
									 <td  class="label">Work Order No </td>
									 <td  class="labeldisplay">
									   <select name="cmb_work_no" id="cmb_work_no" onChange="find_workname()" class="textboxdisplay" style="width:470px;height:22px;" tabindex="7">
										 <option value="">--------------------------------Select Work Order--------------------------------</option>
										 <option value=""></option>
									   </select></td>
									 <td>&nbsp;</td>
										 <td>&nbsp;</td>
								 </tr>
								 <tr><td>&nbsp;</td><td></td><td id="val_work" style="color:red"></td></tr>
								 <tr>
								   <td>&nbsp;</td>
								   <td  class="label">Name of the Work </td>
								   <td  class="labeldisplay"><textarea name="workname" rows="6" class="textboxdisplay" style="width: 465px;"></textarea></td>
								   <td>&nbsp;</td>
								   <td>&nbsp;</td>
									</tr>
                                  	  <tr><td>&nbsp;</td><td></td><td id="val_work" style="color:red"></td></tr>
                                   
									<tr><td>&nbsp;&nbsp;<td width="" class="label">
                                                </td><td id="val_rbn" style="color:red"></tr>
                                    <tr>
                                        <td colspan="6">
                                    <center>
                                        <input type="hidden" class="text" name="submit" value="true" />
										<input  type="hidden" class="text" name="runningbilltext" id="runningbilltext" value=""/>
                                        <!--<input type="image" src="Buttons/View_Normal.png" onmouseover="this.src='Buttons/View_Over.png';" onmouseout="this.src='Buttons/View_Normal.png';" class="btn" data-type="submit" value="View" name="submit" id="submit"   />-->
                                        <input type="submit" data-type="submit" value=" View " name="submit" id="submit"/>
                                    </center>	    </td>
                                    </tr>
                                    <tr><td></td></tr>
                                </table>                             
                            </div>
                            <div class="col2">
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

