@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

@php
if(isset($data['Project'])){
	$Project = $data['Project'];
	foreach($Project as $Proj){
		$AgreeId = $Proj->agreeid;
		$WONo 	 = $Proj->work_order_no;
		$WorkName = $Proj->work_name;
		$AgmtNo = $Proj->agree_no;
	}
}
// Get the current value of upload_max_filesize
$upload_max_filesize = ini_get('upload_max_filesize');

// Get the current value of post_max_size
$post_max_size = ini_get('post_max_size');
@endphp
<form action="" method="post" enctype="multipart/form-data" name="form">
	<div class="content">
		<div class="title"></div>
		<div class="container_12">
			<div class="grid_12">
				<blockquote class="bq1" style="overflow:auto">
					<div class="container">
						<div class="row ">
							<div class="div2">&nbsp;</div>
							<div class="div8 mbtable">
								<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center"> User Manual - Upload Form </div></div></div>
								<div class="divrowbox innerdiv pt-2">
									<div class="row row-fluid line-control-menu-bar formtitlebar" style="border:none">
										<div class="btn-group floatr">
											<button type="submit" class="btn btn-default btninfo" title="Toggle Screen" style="cursor: pointer;" name="btn_upload" id="btn_upload" value=" Upload "><i class="fa fa-check pt2"></i> Upload</button>
										</div>
										<div class="btn-group floatr">
											<button type="button" class="btn btn-default btnprimary" onclick="window.location='{{ route('admin.ViewUserManualList') }}'" title="Toggle Screen" style="cursor: pointer;"></i> View</button>
										</div>
									</div>
									<div class="row">
										<div class="div4">
											<label for="fname" class="laboxlabel">Description</label>
										</div>
										<div class="div8">
											<input type="text" name="txt_um_desc" id="txt_um_desc" class="tboxsmclass" value="@if(isset($data['ShowUserManualData'])){{ $data['ShowUserManualData']->usma_desc }}@endif">
											<input type="hidden" name="hid_usma_id" id="hid_usma_id" class="tboxsmclass disable" value="@if(isset($data['ShowUserManualData'])){{ $data['ShowUserManualData']->usma_id }}@endif">
										</div>
									</div>
									<div class="row">
										<div class="div4">
											<label for="fname"> Upload File<span class="reqindi">*</span> <span style="color: gray; font-size: 11px;">(PDF file only)</span></label>
										</div>
										<div class="div3">
											<input type="file" name="user_manual" id="user_manual" class="tboxsmclass" value="">
										</div>
									</div>
									<div class="row">
										<div class="div4 label">
											PDF Preview
										</div>
										<div class="div3">
											<button class="btn btn-primary"  data-target="#mymodal" id="pdfPreviewBtn">PDF Preview</button>
											<div class="modal" id="mymodal">
												<div class="modal-dialog">
													<div class="modal-content">
														<div class="modal-header">
															PDF Preview
															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
														</div>
														<div class="modal-body">
															<div class="ExternalFiles">
																<iframe id="pdfPreviewFrame" src="" width="100%" height="500"></iframe>
															</div>
														</div>
														<div class="modal-footer">
															<button class="btn btn-danger" data-dismiss="modal" id="closeModalBtn">Close</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="div4">
											<label for="fname" class="laboxlabel">Upload Max Size</label>
										</div>
										<div class="div8">{{$upload_max_filesize}}</div>
									</div>
									<div class="row">
										<div class="div4">
											<label for="fname" class="laboxlabel">Post Max Size</label>
										</div>
										<div class="div8">{{$post_max_size}}</div>
									</div>
									<div class="div12" align="center">
										<!-- <input type="submit" class="btn btn-info" name="btn_upload" id="btn_upload" value="Upload"/> -->
										<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}"/>
									</div>
									<div class="clearrow"></div>
								</div>
							</div>
						</div>
					</div>
				</blockquote>
			</div>
		</div>
	</div>
</form>
<script>
$(document).ready(function() {
	var fileSelected = false;
	$('#user_manual').change(function() { 
		var fileInput = $(this);
		var filePath = fileInput.val();
		var allowedExtensions = /(\.pdf)$/i;

		if (!allowedExtensions.exec(filePath)) {
			BootstrapDialog.alert('Please upload only PDF files.');
			fileInput.val('');
			fileSelected = false; 
			return false;
		}else if(this.files[0].size > 314572800){ 
			$(this).val('');
			BootstrapDialog.alert("Upload file size should be less than 300MB!");
			event.preventDefault();
			event.returnValue = false;
		}
		$('#pdfPreviewFrame').attr('src', URL.createObjectURL(fileInput[0].files[0]));
		fileSelected = true;
	});

	var KillEvent = 0;
	$("body").on("click","#btn_upload", function(event){
		if(KillEvent == 0){
			let SignedTs = $("#user_manual").val();
			if(SignedTs == ""){
				BootstrapDialog.alert("Please Select File to Upload..!!");
				event.preventDefault();
				event.returnValue = false;
			}else{
				event.preventDefault();
				BootstrapDialog.confirm({
					title: 'Confirmation Message',
					message: 'Are you sure want to Upload this Document ?',
					closable: false, // <-- Default value is false
					draggable: false, // <-- Default value is false
					btnCancelLabel: 'Cancel', // <-- Default value is 'Cancel',
					btnOKLabel: 'Ok', // <-- Default value is 'OK',
					callback: function(result) {
						if(result){
							KillEvent = 1;
							$("#btn_upload").trigger( "click" );
						}else {
							KillEvent = 0;
						}
					}
				});
			}
		}
	});
	$("#pdfPreviewBtn").click(function(event) {
		event.preventDefault();
		var pdfPreviewButton = $('#pdfPreviewBtn');
		if (!fileSelected) {
			BootstrapDialog.alert("Please select a PDF file first.");
			pdfPreviewButton.removeAttr('data-toggle'); // Remove data-toggle attribute
		} else {
			$('#mymodal').modal('hide');
			pdfPreviewButton.attr('data-toggle', 'modal'); // Add data-toggle attribute
		}
	});
});
</script>
@endsection
