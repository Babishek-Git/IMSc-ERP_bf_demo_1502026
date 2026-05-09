@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
<style>
	.select-width {
    width: 200px; /* Adjust the width as needed */
}
</style>
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
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
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Organization Creation</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
																	
											<div class="row smclearrow"></div>                                                                                											
											<div class="div3 label">Group 1</div>
                                            <input type="hidden" name="max_group" id="max_group" value="1" />
											<div class="div9">                                                
                                                <div class = "GR1">
                                                    <select class="group selectlgbox select-width " name="cmb_group[]" id="cmb_group1" data-group = "1">
                                                        <option value=""> --------- Select --------- </option>
                                                        <option value="NEW">ADD NEW GROUP 1</option>
                                                        @if(isset($data['ShowGrandParent']))
                                                            @foreach($data['ShowGrandParent'] as $List)
                                                                <option value="{{ $List->orgid }}">{{ $List->org_name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>                                            
											<div class = "GR1"><div class="row smclearrow"></div></div> 
											@php $AddUrl = 'admin.vieworganization'; @endphp 										
											<div class="row">
												<div class="div12" align="center">
													<input type="button" class="backbutton" name="btn_view" id="btn_view" value=" View " onClick="window.location='{{route($AddUrl)}}'" />
													<input type="submit" class="backbutton" name="btn_save" id="btn_save" value=" Save " />				
													<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
												</div>		
											</div>
											<div class="row smclearrow"></div>  
										</div>
									</div>										
								</div>
							</div>                           
						</div>
					</blockquote>
				</div>
			</div>
		</div>
	</form>
</body>	

<script>
$(function(){
	$("#cmb_group1").chosen();
	$('body').on("change",".group", function(e){ 
		var groupid = $(this).val();
		var level = $(this).attr('data-group');
		var nextLevel = Number(level)+1;
		var MaxLevel = $("#max_group").val();
		for(var i = nextLevel; i <= MaxLevel; i++){
			$('.GR'+i).remove();
		} 
		if (groupid != "") {
			if (groupid == "NEW") {
				let GrpApp = '<div class="div3 label">New Group ' + level + ' <span class="reqindi">*</span></div><div class="div9"><input type="text" class="tboxclass newgroup" name="new_group[]" id="new_group' + level + '" data-group="' + level + '" autocomplete="off" /></div>';
				GrpApp += '<div class="div3 label">Organization Code <span class="reqindi">*</span></div><div class="div9"><input type="text" class="tboxclass orgcode" name="txt_org_code[]" id="txt_org_code' + level + '" data-group="' + level + '" autocomplete="off" /></div>';
				$('.GR' + level).last().after('<div class = "GR' + nextLevel + '"><div class="row smclearrow">' + GrpApp + '<div class = "GR' + nextLevel + '"><div class="row smclearrow"></div>');
			} else {
				$.ajax({
					type: 'POST',
					url: '{{ route("ajax.OrganizationFind") }}',
					data: { "_token": "{{ csrf_token() }}", groupid: groupid, level: level },
					dataType: 'json',
					success: function (data) {
						if (data != null) {
							var OptionList = '<option value=""> --------- Select --------- </option>';
							if (data.length > 0) { 
								$.each(data, function (index, element) {
									OptionList += '<option data-id="' + element.orgid + '" data-parid="' + element.parent_id + '" value="' + element.orgid + '">' + element.org_name + '</option>';
								});
							} else {
								OptionList += '<option value="NEW">ADD NEW GROUP ' + nextLevel + '</option>';
							}
							$('.GR' + level).last().after('<div class = "GR' + nextLevel + '"><div class="row smclearrow"><div class="div3 label">Group ' + nextLevel + '</div><div class="div9"><select class="group select-width" name="cmb_group[]" id="cmb_group' + nextLevel + '" data-group="' + nextLevel + '">' + OptionList + '</select></div><div class = "GR' + nextLevel + '"><div class="row smclearrow"></div>');
							$("#cmb_group" + nextLevel).chosen();
						} else {
							$('.GR' + level).last().after('<div class = "GR' + nextLevel + '"><div class="row smclearrow"><div class="div3 label">New Group ' + level + '</div><div class="div9"><input type="text" class="tboxclass" name="new_group[]" id="new_group' + nextLevel + '" data-group="' + nextLevel + '" required autocomplete="off"/></div><div class = "GR' + nextLevel + '"><div class="row smclearrow"></div>');
						}
					}
				});
			}
		}

		$("#max_group").val(nextLevel);
	});
	/*$('body').on("input", "input[name^='txt_org_code']", function() {
        $(this).val($(this).val().toUpperCase());
		var orgCode = $(this).val();
		var pattern = /^[A-Za-z\s]+$/;
		if (!pattern.test(orgCode)) {
			BootstrapDialog.alert("Organization Code should contain only letters");
			$(this).val("")
		}
    });*/
	$('body').on("click","#btn_save", function(event){ 
		var GrpCnt = 0;
		var level = $(this).attr('data-group');
		$(".group").each(function() {
			var Grp = $(this).val();
			if(Grp == ""){
				GrpCnt++;
			}
		}); 
		var CodeErr = $("#txt_code_err").val();
		var OrgCode = $(".orgcode").val(); 
    	var Group 	= $(".newgroup").val();
		if(GrpCnt > 0){
			BootstrapDialog.alert("Error : Group Name in drop down box should not be empty");
			event.preventDefault();
			event.returnValue = false;
		}else if(CodeErr == 1){
			BootstrapDialog.alert("Error : Group Code already exists. please enter different code.");
			event.preventDefault();
			event.returnValue = false;
		}else if(Group == "") {
			BootstrapDialog.alert("Error : Group Name should not be empty.!!");
			event.preventDefault();
			event.returnValue = false;
		}else if(OrgCode == "") {
			BootstrapDialog.alert("Error : Organization Code should not be empty.!");
			event.preventDefault();
			event.returnValue = false;
		}
	});
	$("body").on("change", "input[name^='txt_org_code']", function (event) {
        var OrgCode = $(this).val();
        $.ajax({
            type: 'POST',
            url: "{{ route('ajax.GetOrgCode') }}",
            data: { '_token': '{{ csrf_token() }}','OrgCode': OrgCode },
            success: function (data) {
				if (data) {
					var TableStr   = '';
					TableStr += '<table border="1" width="100%" align="center">';
					TableStr += '<tbody>';
					TableStr += '<tr><td style="text-align:left">Organization code already present !!!</td></tr>';
					TableStr += '</tbody>';
					TableStr += '</table>';
					BootstrapDialog.show({ 
					message: TableStr,
					size:'LARGE',
				});
					$("input[name^='txt_org_code']").val('');
                }
            },
        });
    });

});

</script>
@endsection

