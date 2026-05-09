document.onmousedown=disableclick;
//status="Right Click Disabled";
function disableclick(event)
{
  if(event.button==2)
   {
     //swal("You are not allowed to right click...!", "", "error");
     //return false;    
   }
}

function startTime() {
	var months = new Array(12);
		months[0] = "Jan";
		months[1] = "Feb";
		months[2] = "Mar";
		months[3] = "Apr";
		months[4] = "May";
		months[5] = "Jun";
		months[6] = "Jul";
		months[7] = "Aug";
		months[8] = "Sep";
		months[9] = "Oct";
		months[10] = "Nov"; 
		months[11] = "Dec";
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
	month_value 	= 	today.getMonth();
	day_value	 	= 	today.getDate();
	year_value 		= 	today.getFullYear();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('showclock').innerHTML =
    "<font style='font-size:15px;'>"+months[month_value]+" "+day_value+", "+year_value+"</font><br/> &nbsp;&nbsp;&nbsp;"+h + ":" + m + ":" + s+" &nbsp;&nbsp;";
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers color:#c70592 < 10
    return i;
}
