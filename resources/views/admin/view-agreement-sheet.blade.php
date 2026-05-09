@extends('layouts.dashboard-master')

@section('content')
     <!--==============================Content=================================-->
     <div class="content">
         <div class="title">SOQ View</div>
         <div class="container_12">
             <div class="grid_12">
                 <blockquote class="bq1">
                    <form name="form" method="post" action="{{ route('admin.viewsheet') }}">
                           <div class="container">
								@include('layouts.forms.workform',['works' => $works])
                            </div>
							<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
								<div class="buttonsection">
									<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"  />
								</div>
								<div class="buttonsection">
									<input type="submit" data-type="submit" value=" View " name="submit" id="submit"/>
								</div>
							</div>
                        </form>
                    </blockquote>
                </div>

            </div>
        </div>
         <!--==============================footer=================================-->
          
    </body>
</html>
<script>
	$('#cmb_work_no').chosen();
	$('#cmb_work_no').change(function() {
		var work = $(this).val();
		$("#txt_workorder_no").val('');
		$("#workname").val('');
		$.ajax({
			type:'GET',
			url:"{{ route('posts.getwork') }}",
			data:{'work':work},
			success:function(data){ 
				if(data){ 
					$.each(data, function(key, value) {
						$("#txt_workorder_no").val(value.work_order_no);
						$("#workname").val(value.work_name);
					});
				}
			}
		});
	});
</script>

@endsection	

