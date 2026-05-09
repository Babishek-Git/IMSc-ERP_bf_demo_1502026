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
            <div class="title">Material View</div>
                <div class="container_12">  
                    <div class="grid_12" align="center"> 
                        <blockquote class="bq1" id="bq1" style="overflow:auto;">
                            <div class="container" align="center">
								<div class="smediv">&nbsp;</div>
								<table class="DispTable" width="60%">
									<thead>
										<tr align="center">
											<th>Sno</th>
											<th>Description</th>
											<th>Category</th>
										</tr>
									</thead>
									<tbody>
								</tbody>
								</table>
                           </div>
							<div style="text-align:center; height:30px; line-height:30px;" class="printbutton">
								<div class="buttonsection">
									<input type="submit" name="back" value="Back">
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
