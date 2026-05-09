@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

<form action="{{ route('admin.StaffDetailsGenerate') }}" method="post" enctype="multipart/form-data" name="form">
	<div class="content">
		<div class="title">Staff Details Upload</div>
		<div class="container_12">
			<div class="grid_12">
				<blockquote class="bq1" style="overflow:auto">
					<div class="container">
						<div class="row ">
							<div class="div2">&nbsp;</div>
							<div class="div8 mbtable">
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Staff Details Upoad</div></div></div>
								<div class="row innerdiv">																		
									<div class="row">
										<div class="div4">
											<label for="fname">Sheet Name</label>
										</div>
										<div class="div3">
											<input type="text" name='txt_sheetname' id='txt_sheetname' class="tboxclass" required>
										</div>
										<div class="div5" align="left">
											&nbsp;&nbsp;<i class="fa fa-info-circle" aria-hidden="true" style="padding-top:3px; color:#0078F0; cursor:pointer; font-size:25px;" id="sheet_name_info" title="Click here to View Sample"></i>
										</div>
									</div>
									<div class="row">
										<div class="div4">
											<label for="fname">Starting Row</label>
										</div>
										<div class="div3">
											<input type="text" name='txt_start_row' id='txt_start_row'  class="tboxclass"> </input>
										</div>
										<div class="div5" align="left">&nbsp;</div>
									</div>
									<div class="row">
										<div class="div4">
											<label for="fname">Ending Row</label>
										</div>
										<div class="div3">
											<input type="text" name='txt_end_row' id='txt_end_row' class="tboxclass" required>
										</div>
										<div class="div5" align="left">&nbsp;</div>
									</div>
									<div class="row">
										<div class="div4">
											<label for="fname">Upload File</label>
										</div>
										<div class="div8">
											<input type="file" class="text" name="file" id="file" size="44" style="height:23px;" required/>
										</div>
									</div>
									<div class="row">
										<div class="div4">&nbsp;</div>
										<div class="div8 smalllabcss">
											File should be in the formats of : .xls , .xlsx
										</div>
									</div>
									<div class="smediv">&nbsp;</div>
								</div>
								<div class="smediv">&nbsp;</div>
							</div>
							<div class="div2">&nbsp;</div>
						</div>
						<div class="row">
							<div class="div12" align="center">
								<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"/>
								<input type="submit" class="btn" data-type="submit" name="btn_upload" id="btn_upload" value="Upload File" />
								<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />								
								<!--<input type="button" class="backbutton" name="View" id="View" value="View" onClick="View_page();"/>-->
							</div>
						</div>                           
					</div>
				</blockquote>
			</div>
		</div>
	</div>
</form>
<script>
	$(document).on('click','#sheet_name_info',function(){
		$imgUrl = "{{ asset('images/sheet_name.png') }}";
		$messaage = '<img src="'+$imgUrl+'">';
		BootstrapDialog.show({
			message: $messaage,
			title: 'Upload excel sheet information',
			buttons: [{
				label: 'OK',
				cssClass: 'btn-primary',
				action: function(dialogRef) {
					dialogRef.close();
				}
			}]
		});
	});	

		$('#btn_upload').click(function(event){					
				var Sheetname = $("#txt_sheetname").val(); //alert(TenNo);
				var RowStart = $("#txt_start_row").val(); 
				var RowNo = $("#txt_end_row").val(); 						
				if(Sheetname == ''){
					BootstrapDialog.alert("Please Enter the sheet Name");
					event.preventDefault();
					event.returnValue = false;
				}else if(RowStart == ''){
					BootstrapDialog.alert("Please Enter the Row Start Value");
					event.preventDefault();
					event.returnValue = false;
				}else if(RowNo == ''){
					BootstrapDialog.alert("Please Enter the Row End Value");
					event.preventDefault();
					event.returnValue = false;
				}			
		});
</script>
@endsection 
