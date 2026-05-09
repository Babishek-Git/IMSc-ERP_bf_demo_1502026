@include('layouts.library.config')
@include('layouts.library.functions') 
@include('layouts.library.common')
@include('layouts.header')
<link rel="stylesheet" type="text/css" media="screen" href="css/fancybox.css" />
 <script type="text/javascript" src="js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="js/jquery-migrate-1.2.1.js"></script>
<script type="text/javascript" src="js/image_enlarge_style_js.js"></script>
    <body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
        <!--==============================header=================================-->
        <form action="" method="post" enctype="multipart/form-data" name="form">
             @include('admin.menu')
            <!--==============================Content=================================-->
				<div class="content">
				  <div class="title">Users List - Accounts Section</div>
					<div class="container_12">
						<div class="grid_12">
							<blockquote class="bq1" style="overflow:auto">
								<div class="container" align="center" >
									<table class="table-bordered table1" align="center" id="dataTable">
									<thead>
										<tr>
											<th>&nbsp;</th>
											<th>IC No.</th>
											<th>Staff Name</th>
											<th>User Name</th>
											<th>Designation</th>
											<th>Is Admin</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
								   <!--<div class="heading">
								   		<div class="col label" style="width:30px;"></div>
										<div class="col label" style="color:#025fa4" align="center">IC No.</div>
										<div class="col label" style="color:#025fa4">Staff Name</div>
										<div class="col label" style="color:#025fa4">User ID</div>
										<div class="col label" style="color:#025fa4">Designation</div>
										<div class="col label" style="color:#025fa4">Intercom No.</div>
										<div class="col label" style="color:#025fa4">Is Admin</div>
										<div class="col label" style="color:#025fa4; width:210px">Actions</div>
								   </div>-->
								   	<input type="hidden" name="hid_delete_flag" id="hid_delete_flag">
									  <tr>
											<td align="center">
											<img class="fancybox" title="" src="uploads/" width="30px" height="25px"/>
											</td>
											<td align="center"></td>
											<td align="left"></td>
											<td align="left"></td>
											<td align="center"></td>
											<td align="center"></td>
											<td align="center">
												&nbsp;&nbsp;
												<a href='CreateUser_Accounts.php?userid=' class="oval-btn-edit">
													Edit
												</a>
												&nbsp;|&nbsp;
												<a href="javascript:Delete()" class="oval-btn-delete">
													Delete
											   	</a>
											   &nbsp;|&nbsp;
											   <a href="javascript:ResetUser()" class="oval-btn-edit">
													Reset
											   </a>
											</td>
										</tr>
									<!--<div class="table-row">
									 	<div class="col"><img class="fancybox" title="" src="uploads/ width="30px" height="25px"  /> </div>
										<div class="col label" align="center"></div>
										<div class="col label">&nbsp;&nbsp;</div>
										<div class="col label">&nbsp;&nbsp;</div>
										<div class="col label">&nbsp;&nbsp;</div>
										<div class="col label" align="center"></div>
										<div class="col label" align="center"></div>
										<div class="col">
										&nbsp;&nbsp;
										<a href='CreateUser_Accounts.php?userid='>
											Edit
										</a>
                                      	 &nbsp;|&nbsp;&nbsp;
									   <a href="javascript:Delete()">
									   		Delete
									   </a>
									   &nbsp;|&nbsp;&nbsp;
									   <a href="javascript:ResetUser()">
									   		Reset
									   </a>
									   </div>
									</div>-->
									</tbody>
								</table>
									</div>
									<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
										<div class="buttonsection"><input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/></div>
										<div class="buttonsection"><input type="button" class="backbutton" name="AddNew" id="AddNew" value="AddNew" onClick="Add_New();"/></div>
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