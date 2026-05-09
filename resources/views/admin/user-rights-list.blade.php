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
						  <div align="right"><a href="userrights.php?">AddNew</a></div>
							<blockquote class="bq1">
								<div class="title">User Modules List</div>
								<div class="container" align="center" >
								   <div class="heading">
										<div class="col">Staff Code</div>
										<div class="col">Staff Name</div>
										<div class="col">User Name</div>
										<div class="col">Module Name</div>
								   </div>
									<div class="table-row">
										<div class="col" align="center"></div>
										<div class="col">&nbsp;&nbsp;<a href="userrights_edit.php?staffid=&userid="></a> </div>									
										<div class="col">&nbsp;&nbsp;</div>
									<div class="col"></div>
									</div>
									</div>
									<div class="col2">
									</div>
							</blockquote>
						</div>
					</div>
				</div>
            <!--==============================footer=================================-->
            <footer>
                <div class="container_12">
                    <div class="grid_12">
                        <div class="copy">
                            &copy; 2015 | <a href="#">Privacy Policy</a> <br> 	 <a href="#" rel="nofollow">lashron.com</a>
                        </div>
                    </div>
                </div>
            </footer>
            <script src="js/jquery.hoverdir.js"></script>
        </form>
    </body>
</html>
