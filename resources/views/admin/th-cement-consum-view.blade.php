@include('layouts.library.config')
@include('layouts.library.functions') 
@include('layouts.header')
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
        <!--==============================header=================================-->
    <form action="" method="post" enctype="multipart/form-data" name="phuploader">
        @include('admin.menu')
            <!--==============================Content=================================-->
        <div class="content"> 
            <div class="title">Theoritical Cement Value - View & Edit</div>
             <div class="container_12"> 
                <div class="grid_12" align="center">
                    <blockquote class="bq1" style="overflow:auto;">
                        <div class="container" >
							<div class="smediv">&nbsp;</div>
							<div class="titlesec" style="width:89%">
								<b>Name of Work</b> :  <font style="color:#DF0979; font-weight:bold; background:#edeaea; border-radius:7px; padding:2px;">CCNo. <?php echo $CCNO; ?></font>
							</div>
							<div class="smediv">&nbsp;</div>
							<table width="90%" class="table1 table2">
								<tr class="heading">
									<th class="colhead">
										<input type="checkbox" name="check_all" id="check_all">
									</th>
									<th class="colhead">Item No.</th>
									<th class="colhead">Description</th>
									<th class="colhead">Theoritical Cement<br/> in kg</th>
									<!--<th class="colhead">Rate <i class="fa fa-inr" style="padding-top:7px;"></i></th>
									<th class="colhead" nowrap="nowrap">Total Amt <i class="fa fa-inr" style="padding-top:7px;"></i></th>
									<th class="colhead">Theoritical Cement in kg</th>-->
								</tr>  
                                <!--<div class="heading" style="position:fixed; top:139px; width:1062px">
									<div class="col labelcontenthead" style="width:30px; height:35px; vertical-align:middle" align="center">
										<input type="checkbox" name="check_all" id="check_all">
									</div>
                                    <div class="col labelcontenthead" style="width:65px; height:35px; vertical-align:middle" align="center">Item No.</div>
                                    <div class="col labelcontenthead" style="width:800px; vertical-align:middle">Description</div>
                                    <div class="col labelcontenthead" style="width:163px; vertical-align:middle">Theoritical Cement<br/> in kg </div>
                                </div>-->
									<tr class="heading">
										<td class="colhead">
											<input type="checkbox" name="ch_edit[]" id="ch_edit" value="">
										</td>
										<td class="colhead">
											<a href="" class="tooltip" title="Click here to Edit.">
											</a>
										</td>
										<td class="colhead"></td>
										<td class="colhead">&nbsp;&nbsp;</td>
									</tr> 
								</table>
                            </div>
							<input type="hidden" name="hid_txtboxcount" id="hid_txtboxcount" value="" >
							<input type="hidden" name="hid_sheetid" id="hid_sheetid" value="" >
							<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
								<div class="buttonsection">
									<input type="submit" name="back" value=" Back ">
								</div>
									<div class="buttonsection">
								<input type="submit" name="edit" id="edit" value=" Edit " />
								</div>
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
