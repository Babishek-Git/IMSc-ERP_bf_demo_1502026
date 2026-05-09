@extends('layouts.dashboard-master')
	
@section('content')
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
        <div class="content">
            <div class="title">RAB Generate</div>
            <div class="container_12">
                <div class="grid_12">
                    <blockquote class="bq1" style="overflow:auto">
                        <form name="form" method="post" action="RABGenerateInitiate.php">
                            <div class="container" align="center">
								<br/>
								<div class="page">
								  <div class="page__demo">
									<div class="main-container page__container">
									  <div class="timeline">
										<div class="timeline__group">
										  <span class="timeline__year">STEPS</span>
										   <div class="timeline__box">
											<div class="timeline__date">
											  <span class="timeline__day">1</span>
											  <span class="timeline__month">&emsp;MBook</span>
											</div>
											<div class="timeline__post">
											  <div class="timeline__content">
												<p>
													General MBook and Steel MBook Generate
												</p>
											  </div>
											</div>
										  </div>
										  <div class="timeline__box">
											<div class="timeline__date">
											  <span class="timeline__day">2</span>
											  <span class="timeline__month">Sub-Abstract</span>
											</div>
											<div class="timeline__post">
											  <div class="timeline__content">
												<p>
													Sub-Abstract Generate
												</p>
											  </div>
											</div>
										  </div>
										  <div class="timeline__box">
											<div class="timeline__date">
											  <span class="timeline__day">3</span>
											  <span class="timeline__month">Abstract&nbsp;</span>
											</div>
											<div class="timeline__post">
											  <div class="timeline__content">
												<p>
													Abstract Generate
												</p>
											  </div>
											</div>
										  </div>
										</div>
									  </div>
									</div>
								  </div>
								</div>
							</div>
						<div style="text-align:center; height:45px; line-height:45px;" class="printbutton">
							<div class="buttonsection">
							<input type="button" name="back" value="Back" id="back" class="backbutton" onClick="goBack();" />
							</div>
							<div class="buttonsection" id="view_btn_section">
							<input type="submit" class="btn" value=" GO " name="btn_view" id="btn_view"/>
							</div>
						</div>
       				</form>
      			</blockquote>
    		</div>
   		</div>
	</div>
	<link rel="stylesheet" href="css/timeline.css">
</body>
</html>
@endsection
