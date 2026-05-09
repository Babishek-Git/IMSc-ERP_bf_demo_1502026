@include('layouts.library.config')
@include('layouts.library.functions')
@include('layouts.library.binddata')
@include('layouts.library.common')
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
<!--==============================header=================================-->
@include('admin.menu')
<!--==============================Content=================================-->
<div class="content">
	<div class="title" style="text-align:center">Reports - Work Details </div>
	<div class="container_12">
		<div class="grid_12">
			<blockquote class="bq1" style="min-height:1040px">
				<div class="height">&nbsp;</div>
					<div class="leftsection">
					<div class="leftsectionheader">Work Details</div>
					<table align="center" class="table table-bordered" style="border:0px; margin:0%;">
		      <!--<thead>
			      <tr><th colspan="2" style="text-align:center">Work Details</th><tr> 
			  </thead>-->
						<tr><td>CCNO</td><td rowspan="1"></td><tr>
					<!--<tr><td>Ref.Id</td><td rowspan="1"></td><tr>-->
						<tr><td>Name Of Work</td><td></td></tr>
						<tr><td>Work Order No</td><td></td></tr>
						<tr><td>Agreement No</td><td></td></tr>
						<tr><td>Work Order Cost</td><td></td></tr>
						<tr><td>Work Order Date</td><td></td></tr>
						<tr><td>Schedule D.O.C.</td><td></td></tr>
						<tr><td>Contractor Name</td><td></td></tr>
						<tr><td>Assigned staff</td>
				  <td>
				 </td></tr>
				  <tr>
				     <td>CheckMeasurement <br/>Level</td><td>
				     </td>
				  </tr>
				  <tr><td>Work Type</td><td></td></tr>
				  <tr><td>Rebate % </td><td></td></tr>
				  <tr><td>Updated On</td><td></td></tr>
		    </table>
			<div class="bottomsectionheader"> Mbooks Details</div>
		    <table align="left" class="table table-bordered" style="border:0px; margin:0%;">
		      <thead>
			     <tr>
					<th style="text-align:left" rowspan="2">Staff Name</th>
					<th style="text-align:center" colspan="6"> Mbook Nos.</th>
			     </tr>
				 <tr>
					<th style="text-align:center" > General</th>
					<th style="text-align:center" > Steel</th>
					<th style="text-align:center" > Abtract</th>
					<th style="text-align:center" > Escalation</th>
				</tr>
			  </thead>
				<tr>
					<td rowspan="1" width="100%"><br/></td>
					<td></center></td>
					<td></center></td>
					<td></center></td>
					<td></td>
				</tr>
				<tr>
					<td colspan="5" style="text-align:center"> No Records Found </td>
				</tr>
		    </table>
       </div>
       <div class="contenttsection">
		 <div class="contenttopheader">Current RAB Details</div>
			 <table cellspacing="0" cellpadding="0" align="center" class="table table-bordered" style="border:0px; margin:0%;" >
				<tr style="border:0px !important">
					<td style="padding:0px; border:0px !important">
					    
						<table class="table table-bordered" style="margin-bottom: 0px;">
						<tr><td colspan="3" style="text-align:center; color:#D50752;"></td></tr>
						<tr><td width="30%">RAB</td><td colspan="2"></td><tr>
				        <tr><td>Upto Paid Amount</td><td colspan="2"></td></tr>
				        <tr><td> This Bill Value</td><td colspan="2"></td></tr>
				        <!--<tr><td>Current Status</td><td align="left"> 1. RAB Generate : 
								  2. Check Measurement : 
								  3. Accounts :</td></tr>-->
						<tr>
						   <td rowspan="" style="vertical-align:middle">Current Status</td>  
						   <td width="25%" style="color:#333333;vertical-align:middle">MBook No.</td>
						   <td style="text-align:center;color:#333333;">Status</td>
						</tr>
						<tr><td colspan="3" style="text-align:center"> </td></tr>
						
						</table>
						
					</td>
				</tr>
				
				<tr style="border:0px !important;">
					<td style="padding:0px; border:0px !important">
					<!--<div class="centersectionheader">Check Measurement Status RAB: </div>-->
						<table cellspacing="0" cellpadding="0" class="table table-bordered" style="margin-bottom: 0px;">
							<thead>
							    <tr><td colspan="3" style="text-align:center; background:#00BCD4; height:25px; vertical-align:middle; color:#fff; padding:0px;">Current RAB Check Measurement Status <?php if($RBN != ''){ echo "- RAB : ".$RBN; } ?></td></tr>
								<tr>
									<th>SNo.</th>
									<th style="text-align:center">Particulars</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
							  
							</tbody>
						</table>
					</td>
				</tr>		   
				<tr style="border:0px !important">
					<td style="padding:0px; border:0px !important">
						<table class="table table-bordered" style="margin-bottom: 0px;">
							<thead>
							    <tr><td colspan="7" style="text-align:center; background:#607D8B; height:25px; vertical-align:middle; color:#fff; padding:0px;">Current RAB Accounts Status <?php //if($RBN != ''){ echo "- RAB : ".$RBN; } ?></td></tr>
								<tr>
									<th rowspan="2">MBook No.</th>
									<th rowspan="2">MBook Type</th>
									<th colspan="1">Dealing Assistant</th>
									<th colspan="1">Accountant</th>
									<th colspan="1">AAO</th>
									<th colspan="1">AO</th>
									<th colspan="1">DCA</th>
								</tr>
								<tr>
									<th>Status</th>
									<th>Status</th>
									<th>Status</th>
									<th>Status</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</td>
				</tr>
			 </table>
			 <div class="centersectionheader">Completed RAB's List</div>
			 <table align="center" class="table table-bordered" style="border:0px; margin:0%;">
				<tr style="border:0px !important">
					<td style="padding:0px; border:0px !important">
						<table class="table table-bordered ctable">
							<thead>
								<tr>
									<th style="text-align:center; background:#DBDEDD;">RAB</th>
									<th style="text-align:center; background:#DBDEDD;">Upto Amount &#x20b9;</th>
									<th style="text-align:center; background:#DBDEDD;">Deduct Previous &#x20b9;</th>
									<th style="text-align:center; background:#DBDEDD;">Since Last &#x20b9;</th>
									<th style="text-align:center; background:#DBDEDD;">Esc Amount &#x20b9;</th>
									<th style="text-align:center; background:#DBDEDD;">Pass Order Date</th>
								</tr>
							</thead>
							<tbody>
							<tr>
								 <td align="center"></td>
								 <td style="text-align:right"></td>
								 <td style="text-align:right"></td>
								 <td style="text-align:right"></td>
								 <td style="text-align:right"></td>
								<td align="center"></td>
							</tr>
							 <tr>
								 <td style="text-align:center"colspan="6"> </td>
							 </tr>
							</tbody>
						</table>
					</td>
				</tr>
			 </table>
       </div>
	   <div class="rightsection">
		 <div class="rightsectionheader">Quantity Details</div>
			 <table align="center" class="table table-bordered" style="border:0px; margin:0%;">
				<tr style="border:0px !important">
					<td style="padding:0px; border:0px !important">
						<table class="table table-bordered ltable">
							<thead>
								<tr>
									<th>Item No.</th>
									<th style="text-align:center">Agmt. Qty</th>
									<th style="text-align:center">Used Qty</th>
									<th style="text-align:center">Deviate %</th>
								</tr>
							</thead>
							<tbody>
							<tr>
								<td align="center"> </td>
								<td style="text-align:right"></td>
								
								
								<td style="text-align:right">&nbsp;</td>
								<td style="text-align:right">
								
								</td>
							</tr>
							
							<tr>
								<td style="text-align:center" colspan="3"></td>
							</tr>
							</tbody>
						</table>
					</td>
				</tr>
			 </table>
	   </div>
	   <!--<div class="bottomsection">
		</div>
		<div class="centersection">
	   </div>-->
	   
	   <div style="text-align:center; height:45px;" class="printbutton">
			<div class="buttonsection">
			<input type="button" name="back" value="Back" id="back" class="backbutton" onClick="goBack();" />
			</div>
	   </div>
    </blockquote>
    </div>
  </div>
</div>
<!--==============================footer=================================-->
<footer>
	<div class="container_12" style="background:#035a85">
    	<div class="grid_12">
        	<div class="copy">
            	<a rel="nofollow" style="color:#C6C7C7; font-size:11px; font-weight:600; padding:2px 0px;">&copy; Lashron Technologies</a>
           	</div>
        </div>
   	</div>
</footer>
</body>
</html>