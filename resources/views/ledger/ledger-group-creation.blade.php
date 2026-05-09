@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
	<form action="" method="post" enctype="multipart/form-data" name="form">
		<div class="content">
			<div class="title"></div>
			<div class="container_12">
				<div class="grid_12">
					<blockquote class="bq1" style="overflow:auto">
						<div class="container">
							<div class="row ">
								<div class="div3">&nbsp;</div>
								<div class="div6 mbtable">
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Ledger Group Creation</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
																	
											<div class="row smclearrow"></div>                                                                                											
											<div class="div3 label">Main Category</div>
                                            <input type="hidden" name="max_group" id="max_group" value="1" />
											<div class="div9">                                                
                                                <div class = "GR1">
                                                    <select class="group tboxclass" name="cmb_group[]" id="cmb_group1" data-group = "1">
                                                        <option value=""> ------ Select ------ </option>
                                                        <option value="NEW">ADD NEW MAIN CATEGORY </option>
                                                        @if(isset($data['ShowGrandParent']))
                                                            @foreach($data['ShowGrandParent'] as $List)
                                                                <option value="{{ $List->ledger_group_id }}">{{ $List->ledger_group_name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>                                            
											<div class = "GR1"><div class="row smclearrow"></div></div>  										
											<div class="row">
												<div class="div12" align="center">
                                                    <!-- <input type="button" name="btn_back" id="btn_back" class="backbutton" value=" Back "> -->
													<input type="submit" class="step-btn" name="btn_save" id="btn_save" value=" Save " />				
													<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
												</div>		
											</div>
											<div class="row smclearrow"></div>  
										</div>
									</div>										
								</div>
								<div class="div3">&nbsp;</div>
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
		var MaxLevel = $("#max_group").val(); //alert(level); alert(nextLevel); alert(MaxLevel);
		for(var i = nextLevel; i <= MaxLevel; i++){
			$('.GR'+i).remove();
		} //alert(groupid);
		if(groupid != ""){
			/*if(groupid == "NEWL"){
				let GrpApp = '<div class="div3 label">Ledger Name <span class="reqindi">*</span></div><div class="div9"><input type="text" class="tboxclass newgroup"  name="txt_new_group" id="txt_new_group'+level+'" data-group="'+level+'" autocomplete="off" /><input type="hidden" class="tboxclass newgroup"  name="txt_type" id="txt_type'+level+'" data-group="'+level+'" value="L" /></div><div class="row smclearrow"></div>';
				//GrpApp += '<div class="div3 label">Ledger Group Type <span class="reqindi">*</span></div><div class="div9"><input type="text" class="tboxclass url"  name="txt_ledger_group_type" id="txt_ledger_group_type'+level+'" data-group="'+level+'" autocomplete="off" /></div><div class="row smclearrow"></div>';
				//GrpApp += '<div class="div3 label">Credit / Debit <span class="reqindi">*</span></div><div class="div9 label"><input type="radio" class="CreditDebit"  name="rad_credit_debit" id="rad_credit_'+level+'" data-group="'+level+'" value="C" /> Credit &emsp;&emsp;<input type="radio" class="CreditDebit"  name="rad_credit_debit" id="rad_credit_'+level+'" data-group="'+level+'" value="D" /> Debit</div><div class="row smclearrow"></div>';
				//GrpApp += '<div class="div3 label">DP Order <span class="reqindi">*</span></div><div class="div9"><input type="text" class="tboxclass order numberonly"  name="txt_dp_order" id="txt_dp_order'+level+'" data-group="'+level+'" autocomplete="off" /></div><div class="row smclearrow"></div>';
				$('.GR'+level).last().after('<div class = "GR'+nextLevel+'"><div class="row smclearrow">'+GrpApp+'<div class = "GR'+nextLevel+'"><div class="row smclearrow"></div><div class="row smclearrow"></div>');
			}else */if(groupid == "NEW"){
				let GrpApp = '<div class="div3 label">Category Name <span class="reqindi">*</span></div><div class="div9"><input type="text" class="tboxclass newgroup"  name="txt_new_group" id="txt_new_group'+level+'" data-group="'+level+'" autocomplete="off" /><input type="hidden" class="tboxclass newgroup"  name="txt_type" id="txt_type'+level+'" data-group="'+level+'" value="C" /></div><div class="row smclearrow"></div>';
				$('.GR'+level).last().after('<div class = "GR'+nextLevel+'"><div class="row smclearrow">'+GrpApp+'<div class = "GR'+nextLevel+'"><div class="row smclearrow"></div><div class="row smclearrow"></div>');
			}else{
				$.ajax({ 
					type: 'POST', 
					url: '{{ route("ledger.LedgerGroupFind") }}', 
					data: { "_token": "{{ csrf_token() }}", groupid: groupid, level: level }, 
					dataType: 'json',
					success: function (data) {  
						if(data != null){
							var OptionList = '<option value=""> ----- Select ----- </option>';
								OptionList += '<option value="NEW">ADD NEW CATEGORY '+nextLevel+'</option>';
								//OptionList += '<option value="NEWL">ADD NEW LEDGER</option>';
							$.each(data, function(index, element) {
								OptionList += '<option data-id="'+element.ledger_group_id+'" data-parid="'+element.ledger_group_parentid+'" value="'+element.ledger_group_id+'">'+element.ledger_group_name+'</option>';
							});
							$('.GR'+level).last().after('<div class = "GR'+nextLevel+'"><div class="row smclearrow"><div class="div3 label">Category '+nextLevel+'</div><div class="div9"><select class="group tboxclass" name="cmb_group[]" id="cmb_group'+nextLevel+'" data-group="'+nextLevel+'">'+OptionList+'</select></div><div class = "GR'+nextLevel+'"><div class="row smclearrow"></div>');
							$("#cmb_group"+nextLevel).chosen();
						}else{
							$('.GR'+level).last().after('<div class = "GR'+nextLevel+'"><div class="row smclearrow"><div class="div3 label">New Category '+level+'</div><div class="div9"><input type="text" class="tboxclass"  name="new_group[]" id="new_group'+nextLevel+'" data-group="'+nextLevel+'" required autocomplete="off"/></div><div class = "GR'+nextLevel+'"><div class="row smclearrow"></div>');
						}
					}
				});
			}
		}
		$("#max_group").val(nextLevel);
	});
	$('body').on("input", "input[name^='txt_is_navbar']", function() {
        $(this).val($(this).val().toUpperCase());
		var orgCode = $(this).val();
		var pattern = /^[A-Za-z\s]+$/;
		if (!pattern.test(orgCode)) {
			BootstrapDialog.alert(" Is Navbar should contain only letters");
			$(this).val("")
		}
    });
	$('body').on('keypress', ".numberonly",function(evt){
		var result = $(this).val();	
		var charCode = (evt.which) ? evt.which : event.keyCode;
		var dot1 	 = result.indexOf('.');
		var dot2 	 = result.lastIndexOf('.'); 
		var val 	 = result;
		var SplitVal = val.split(".");
		var len 	 = SplitVal.length;
		var Fraction = SplitVal[1];
		if(Fraction){
			var fractLen = Fraction.length;
		}else{
			var fractLen = 0;
		}
		if(charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)){
			return false;
		}else if (charCode == 46 && (dot1 == dot2) && dot1 != -1 && dot2 != -1){
			return false;
		}else if(isNaN(SplitVal[0])){
			//Recovery = 'x';
			return false;
		}else if(isNaN(SplitVal[1]) && Number(fractLen) > 0){
			//Recovery = 'x';
			return false;
		}else if (fractLen > 1){
			return false;
		}else{
			return true;
		}
	});
	$('body').on("click","#btn_save", function(event){ 
		var GrpCnt = 0;
		$(".group").each(function() {
			var Grp = $(this).val();
			if(Grp == ""){
				GrpCnt++;
			}
		}); 
		var CodeErr 	= $("#txt_code_err").val();
		var GroupName 	= $(".newgroup").val(); 
    	var Url 		= $(".url").val();
		var Navbar 		= $(".nbar").val(); 
    	var Order 		= $(".order").val();

		if(GrpCnt > 0){
			BootstrapDialog.alert("Error : Group Name in drop down box should not be empty");
			event.preventDefault();
			event.returnValue = false;
		}else if(CodeErr == 1){
			BootstrapDialog.alert("Error : Group Code already exists. please enter different code.");
			event.preventDefault();
			event.returnValue = false;
		}else if(GroupName == "") {
			BootstrapDialog.alert("Error : New Group Name should not be empty.!");
			event.preventDefault();
			event.returnValue = false;
		}else if(Url == "") {
			BootstrapDialog.alert("Error : URL should not be empty.!");
			event.preventDefault();
			event.returnValue = false;
		}else if(Navbar == "") {
			BootstrapDialog.alert("Error : Navbar should not be empty.!");
			event.preventDefault();
			event.returnValue = false;
		}else if(Order == "") {
			BootstrapDialog.alert("Error : Order should not be empty.!");
			event.preventDefault();
			event.returnValue = false;
		}
	});
});
// if(window.history.replaceState ) {
// 	window.history.replaceState( null, null, window.location.href );
// }
</script>
@endsection
