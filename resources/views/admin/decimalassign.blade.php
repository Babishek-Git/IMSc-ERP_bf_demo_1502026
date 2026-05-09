@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
     <!--==============================Content=================================-->
     <div class="content">
         <div class="title">SOQ View</div>
         <div class="container_12">
             <div class="grid_12">
                 <blockquote class="bq1">
                    <form name="form" method="post" action="{{ route('admin.viewsheet') }}">
                           <div class="container">  </div>
							<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
								<div class="buttonsection">
									<input type="button" class="backbutton" name="back" id="back" value="Back" onClick="goBack();"  />
								</div>
								<div class="buttonsection">
								@php $AddUrl = 'admin.agreemententryview'; @endphp 
									<input type="submit" data-type="submit" value=" View " name="submit" id="submit"/>
								</div>
							</div>
                        </form>
                    </blockquote>
                </div>

            </div>
        </div>
         
<script>
	$('#cmb_work_no').chosen();
	$('#cmb_work_no').change(function() {
		var work = $(this).val();
		$("#txt_workorder_no").val('');
		$("#workname").val('');
		$.ajax({
			type:'POST',
			url:"{{ route('posts.getwork') }}",
			data:{'_token': '{{ csrf_token() }}','work':work},
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

