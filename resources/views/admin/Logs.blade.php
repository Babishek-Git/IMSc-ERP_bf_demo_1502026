@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

<body class="page1" id="top" oncontextmenu="return false" onload="noBack();" onpageshow="if (event.persisted) noBack();" onunload="">
    <form action="{{ route('admin.ViewLogs') }}" method="post" enctype="multipart/form-data" name="form">
        <div class="content">
            <div class="container_12">
                <div class="grid_12">
                    <blockquote class="bq1" style="overflow:auto">
                        <div class="container">
                            <div class="row plr">
								<div class="div2">&nbsp;</div>
                                <div class="div8 mbtable">
                                    <div class="row">
                                        <div class="div12" style="margin-top:0px;">
                                            <div class="row divhead" align="center">Log Reports</div>
                                        </div>
                                    </div>
                                        <div class="div12 card-body padding-1 ChartCard" id="CourseChart">
                                            <div class="divrowbox innerdiv pt-2">
											<div class="row smclearrow"></div>  
                                                <div class="div3 label">Date <span class="reqindi">*</span></div>											
                                                <div class="div4">
                                                    <input type="text" readonly="" name="txt_date" id="txt_date" maxlength="50" class="tboxclass datepicker">
                                                </div>
                                                
												<div class="row">
													<div class="div12" align="center">
													<input type="submit" class="backbutton" name="btn_view" id="btn_view" value=" View "/>
													<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
													</div>		
												</div>
                                                <div class="row clearrow">&nbsp;</div>
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

<script type="text/javascript" language="javascript">
    $("body").on("click","#btn_view", function(event){
        var Date     = $("#txt_date").val();
		if(Date == ""){
			BootstrapDialog.alert("Please Select the Date to view Logs!");
			event.preventDefault();
			event.returnValue = false;
		}
    });
</script>
@endsection
