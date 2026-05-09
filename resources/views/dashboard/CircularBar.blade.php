<style>
.vertical-marquee-container {
    width: 100%;
    height: 23px; 
    overflow: hidden;
    position: relative;
    box-sizing: border-box;
    margin-bottom:-14px;
	border-bottom:1px solid #F5F5F5;
	/* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1) inset; */
}

.vertical-marquee-content {
    display: block;
    position: absolute;
    color:#FF0000;
	  white-space: nowrap;
    width: 100%;
    font-family:verdana;
    animation: vertical-marquee 33s linear infinite;
}
.paperclip{
  font-size:16px;
  padding-top:3px;
  font-weight:bold;
}
.circular-box{
  cursor: pointer;
}
.circular-box:hover{
  cursor: pointer;
  color:#092F66;
}
.vertical-marquee-content:hover {
    animation-play-state: paused; /* Pause animation on hover */
}
@keyframes vertical-marquee {
    0% {
      transform: translateX(50%); /* Start closer to the visible area */
    }
    100% {
      transform: translateX(-100%);
    }
}

</style>
									
                
<div class="vertical-marquee-container">
	<div class="vertical-marquee-content">
	@php 
	$CircularDescArr = array();  
	if(isset($data['Circular'])){ 
		foreach($data['Circular'] as $Key => $Data){
			if($Data->circular_disp_div != NULL){
				$OfficeArr = explode(',',$Data->circular_disp_div); 
			}else{
				$OfficeArr =array(); 
			}
			
			$Val = 0;
			if(in_array(session('WcmsEmpDiv'),$OfficeArr)){
				if($Data->active == 1 && $Data->circular_disp_dt >= NOW()->toDateString()){
					$CircularDesc = $Data->circular_desc;
					
					if($Data->circular_file != NULL){
			@endphp
						<span class="circular-box ViewCircular" onclick="window.location='{{ route('circular.ViewCircularInfo', ['CirId'=>encrypt($Data->circular_id)]) }}'"> <i class="fa fa-caret-right" style="font-size:20px; padding-top:1px; color:#092F66;"></i> {{$CircularDesc}} <i class="fa fa-paperclip paperclip" id="CostDtBox"></i></span>&emsp;
			@php          
					}else{
			@endphp
						<span class="circular-box ViewCircular" onclick="window.location='{{ route('circular.ViewCircularInfo', ['CirId'=>encrypt($Data->circular_id)]) }}'"><i class="fa fa-caret-right" style="font-size:20px; padding-top:1px; color:#092F66;"></i> {{$CircularDesc}}</span>&emsp;
			@php
					}
				}
			}
		} 
		$CircularDescList = implode(' , ',$CircularDescArr);
	}
	@endphp
	</div>
</div>



									