@include('layouts.library.config')
@include('layouts.library.functions') 
@include('layouts.library.binddata') 
@include('layouts.library.common')
@include('layouts.header')
    <body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
        <!--==============================header=================================-->
        <form action="" method="post" enctype="multipart/form-data" name="phuploader">
           @include('admin.menu')
            <!--==============================Content=================================-->
            <div class="content">
                <div class="container_12">
                    <div class="grid_12"> 
                        <blockquote class="bq1"  style="height:520px; overflow:scroll;">
                            <div class="title">View Agreement Sheet</div>
                            <div class="container" >
                                <div class="heading">
                                    <div class="col" style="width:50px;">SNo</div>
                                    <div class="col">Description</div>
                                    <div class="col">Rate </div>
                                    <div class="col">Total Quantity</div>
                                    <div class="col">Total Amt </div>
                                    <div class="col">Per </div>
                                </div>
                             <div class="table-row">
								 <div class="col"></div>
								<!-- <div class="col"></div>-->
								 <div class="col"></div>
								 <div class="col"></div>
								 <div class="col"></div>
								 <div class="col"></div></div>
							  			<div class="table-row">
	                                    <div class="col labelhead" style="width:50px;"></div>
    	                                <div class="col labelhead">&nbsp; </div>
        	                            <div class="col labelhead"></div>
            	                        <div class="col labelhead"></div>
                	                    <div class="col labelhead"></div>
                    	                <div class="col labelhead"></div>
		                                </div>
									</div>
                            <div class="col2">
						</div>
                        </blockquote>
                        <div>&nbsp;</div>
                        <div>
							<center>
								<table align="centre">
								   <tr><td>
									  <input type="submit" name="submit" value="Back">
								   </td></tr>
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
