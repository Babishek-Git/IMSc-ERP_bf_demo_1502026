<script type="text/javascript" src="{!! url('assets/js/Resize-Page-Auto.js') !!}"></script>	
<footer>
	<div class="container_12" style="background:#092F66">
    	<div class="grid_12">
			<div class="copy">
            	<a rel="nofollow" style="color:#C6C7C7; font-size:11px; font-weight:600; padding:2px 0px;">&copy; Designed & Developed by Jenissi Infotech</a>
			</div>
		</div>
	</div>
</footer>
<script>
$( document ).ready(function() {
	$('body').on('click', '#back', function(){
		var BackUrl = $(this).attr("data-backurl"); 
		if(BackUrl != ''){
			$(location).attr("href",BackUrl);
		}
	});
	/*$(".date-picker").datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: "dd/mm/yy",
		defaultDate: new Date,
	});*/
    $('.datepicker').datepicker({
        'format': 'dd/mm/yyyy',
        'autoclose': true,
		'todayHighlight': true
    });

	$('#dataTableP').DataTable({
		responsive: true,
		paging: true, 
	});
	if (window.history.replaceState ) {
		//window.history.replaceState( null, null, window.location.href );
	}
});
</script>

