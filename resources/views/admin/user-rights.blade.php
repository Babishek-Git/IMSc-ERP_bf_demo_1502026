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
                        <blockquote class="bq1">
                            <div class="title">Module Rights</div>
							<!--<a href="index.php">Logout</a>-->
                            <table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr><td>&nbsp;</td></tr>
								<tr>
								    <td>&nbsp;</td>
								    <td>User Name</td>
									 <td align="right">
										<select name="userid" id="userid" class="" style="width:268px;height:22px;">
										<option value="">---------- Select Username ----------</option>
										</select>
									</td>
								</tr>
								<tr><td>&nbsp;</td></tr>
								<tr> 
								    <td>&nbsp;</td>
									<td colspan="2">
									    <table border="0" width="100%" cellpadding="0" cellspacing="0" id="tableid">
									        <tr>
												<td align="left">Pages</td>
											    <td align="left">Add</td>
												<td align="left">Edit</td>
												<td align="left">Delete</td>
												<td align="left">View</td>
												<td align="left">Upload</td>
											</tr>
											<tr><td>&nbsp;</td></tr>
											<input type="hidden" name="tot_pages" id="tot_pages" value=""/>
								            <tr>
												<td colspan="10">
													<center>
													  <input type="submit" class="btn" data-type="submit" value="Submit" name="submit" id="submit" />&nbsp;&nbsp;&nbsp;
													  <input type="reset" name="btn_clear" id="btn_clear" value="Clear"/>&nbsp;&nbsp;&nbsp;
													  <!--<a href="userrightslist.php">View</a>-->
													</center>
												</td>
											</tr>
										</table>
									  </td>
									</tr>
                            </table>
                          <div class="col2"></div>
                        </blockquote>
                    </div>
                </div>
            </div>
            <!--==============================footer=================================-->
            <footer>
                <div class="container_12">
                    <div class="grid_12">
                        <div class="copy">
                            &copy; 2015 | <a href="#">Privacy Policy</a> <br><a href="#" rel="nofollow">lashron.com</a>
                        </div>
                    </div>
                </div>
            </footer>
            <script src="js/jquery.hoverdir.js"></script>
        </form>
    </body>
</html>
