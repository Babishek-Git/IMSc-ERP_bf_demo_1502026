@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

<script type="text/javascript">
	window.history.forward();
	function noBack() { window.history.forward(); }
</script>
<style>
.bboxdiv{
	box-sizing: border-box !important;
}
.3dCheck {
	opacity: 0;
	position: absolute;
}

.ChLable {
	position: relative;
	display: block;
	background: #fff;/*#f8f8f8;*/
	border: 1px solid #f0f0f0;
	border-radius: 2em;
	padding: 0.8em 1em 0.8em 1em;
	box-shadow: 0 1px 2px rgba(100, 100, 100, 0.5) inset, 0 0 10px rgba(100, 100, 100, 0.1) inset;
	cursor: pointer;
	text-shadow: 0 2px 2px #fff;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:13px;
	font-weight:500;
	box-shadow: 0 4px 7px 1px rgba(0, 0, 0, 0.2);
	border: 0.5px solid #00bcd4 !important;
	border-bottom: 2px solid #00bcd4 !important;
	}
.ChLable::before {
	/*content: "";
	position: absolute;
	top: 50%;
	right: 0.7em;
	width: 3em;
	height: 1.2em;
	border-radius: 0.6em;
	background: #eee;
	transform: translateY(-50%);
	box-shadow: 0 1px 3px rgba(100, 100, 100, 0.5) inset, 0 0 10px rgba(100, 100, 100, 0.2) inset;*/
}
.ChLable::after {
	/*content: "";
	position: absolute;
	top: 48%;
	right: 2.6em;
	width: 1.4em;
	height: 1.4em;
	border: 0.25em solid #fafafa;
	border-radius: 50%;
	box-sizing: border-box;
	background-color: #ddd;
	background-image: linear-gradient(to top, #fff 0%, #fff 40%, transparent 100%);
	transform: translateY(-50%);
	box-shadow: 0 3px 3px rgba(0, 0, 0, 0.5);*/
}
.ChLable, .ChLable::before, .ChLable::after {
  	transition: all 0.2s cubic-bezier(0.165, 0.84, 0.44, 1);
}

.ChLable:hover, input:focus + .ChLable {
  	color: black;
}
.ChLable:hover::after, input:focus + .ChLable::after {
	background-color: #ccc;
	box-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
}

input:checked {
  	counter-increment: total;
}
input:checked + .ChLable::before {
  	background: #1CE;
}
input:checked + .ChLable::after {
  	transform: translateX(2em) translateY(-50%);
}
.Btn-3Check{
	margin: 1em 0;
	/*font: 1.5em/1.4 "Open Sans Condensed", sans-serif;*/
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:17px;
	font-weight:400;
	color: #2F373E;
	width:100%;
	text-align:left;
}
	
</style>
	
    <body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
        <!--==============================header=================================-->
        <form action="" method="post" enctype="multipart/form-data" name="form">
     
            <!--==============================Content=================================-->
			<div class="content">
				<div class="title"></div>
				<div class="container_12">
					<div class="grid_12" align="center">
						<blockquote class="bq1" style="overflow:auto">
							<div style="padding-left:40px">
								<div class="div2 p-5 bboxdiv">&nbsp;</div>
								<div class="div8 p-5 bboxdiv">
									<div class="grid_12" align="center">
										<div class="Btn-3Check">
											<input name="PriorAppln" id="RouteError" type="checkbox" class="3dCheck" style="display:none" disabled="disabled" checked="checked"/>
											<label class="ChLable" for="RouteError">
											Error : Route "{{ $data }}" not found"
											</label>
										</div>
									</div>
								</div>
								<div class="div2 p-5 bboxdiv">&nbsp;</div>
							</div>
						</blockquote>
					</div>
				</div>
			</div>
        </form>

@endsection