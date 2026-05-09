@include('layouts.library.config')
@include('layouts.library.functions')
@include('layouts.header')
<body class="page1" id="top">
        <!--==============================header=================================-->
    <form action="" method="post" enctype="multipart/form-data" name="phuploader">
            @include('admin.menu')
            <!--==============================Content=================================-->
            <div class="content"> 
                <div class="container_12"> 
                    <div class="grid_12">
                        <blockquote class="bq1" style="height:1px; overflow:scroll;">
                            <div class="title" style="position:fixed; width:1062px;">Rebate Offer</div>
                            <div class="container" >
                                <div class="heading" style="position:fixed; top:139px; width:1062px">
                                    <div class="col labelcontenthead" style="width:60px; height:35px;" align="center">Item No.</div>
                                    <div class="col labelcontenthead" style="padding-top:7px; width:877px;">Description</div>
                                    <div class="col labelcontenthead" style="padding-top:7px; width:71px">Rate </div>
									<div class="col labelcontenthead" style="padding-top:7px; width:70px">Rebate</br>( % ) </div>
                                </div>
                             	<div style=" padding-top:72px;"
									<div class="table-row">
									<div class="col labelhead" align="center" style="width:60px;"></div>
									<div class="col labelhead" style="width:882px;" align="left" id="">
									 </div>
									<div class="col labelhead" align="center" style="width:70px;">
									</div>
									<div class="col labelhead" align="right">
									<input type="text" class="textboxdisplay textboxstyle" style="color:#003399; width:65px" name="txt_rebate_percent" id="txt_rebate_percent" value="" onBlur="get_decimal_val(,,,,this.value);" >
									<input type="hidden" name="hide_result[]" id="hide_result" value="" >
									</div>
		                       </div>
								</div>
                            </div>
							<input type="hidden" name="hid_txtboxcount" id="hid_txtboxcount" value="" >
							<input type="hidden" name="hid_sheetid" id="hid_sheetid" value="" >
                        </blockquote>
                        <div style="width:1074px;">
							<center>
								<table align="centre" width="1074px">
								   <tr>
								   <td align="right" width="57%">
									  <input type="submit" name="back" value=" Back ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									  <input type="submit" name="update" value=" Update ">
								   </td>
								   <td align="right">
								   </td>
								   </tr>
								</table>
							</center>
						</div>
                        </form>
                    </div>

                </div>
                
            </div>
            
             <!--==============================footer=================================-->
           @include('layouts.footer')
        </form>
    </body>
</html>