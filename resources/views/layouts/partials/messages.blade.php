@php 
$AlertMessageDp = NULL;
if(isset($ALertMesage)){
	$AlertMessageDp = $ALertMesage;
}else{
	$AlertMessageDp = session('ALertMesage');
	session()->forget('ALertMesage');
}
@endphp
@if(isset($AlertMessageDp))
@if($AlertMessageDp != NULL)
	<div id="id01" class="w3-modal" style='display:block'>
		<div class="w3-modal-content w3-animate-top w3-card-4"  style="border-radius:5px;">
			<div id="id01">
				<div class="col-sm-12" id="id01">
					<div class="alert fade alert-simple alert-primary alert-dismissible text-left font__family-montserrat font__size-16 font__weight-light brk-library-rendered rendered show" role="alert" data-brk-library="component__alert">
						<button type="button" class="close css-modal-close font__size-18" data-dismiss="alert" onclick="document.getElementById('id01').style.display='none'">
							<span aria-hidden="true"><i class="fa fa-times alertprimary" onclick="document.getElementById('id01').style.display='none'"></i></span>
							<span class="sr-only">Close</span>
						</button>
						<i class="start-icon fa fa-thumbs-up faa-bounce animated"></i>
						<strong class="font__weight-semibold"></strong> {!!$AlertMessageDp!!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endif
@endif