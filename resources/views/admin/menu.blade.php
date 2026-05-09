<header>
	<div class="container_13">
		<div class="grid_12">
			<!-- ====================== Logo and Title Section Starts=================== -->
			<h1>
				<a href="">
					<img src="images/igcar_logo_1.png">
				</a>
			</h1>
			<h4>
				<a href="">
					<div class="titleHead">Works Contract Management System</div>
					<div class="sub-titleHead">Civil Engineering Group, IGCAR, Kalpakkam.</div>
				</a>
			</h4>
			<!-- ====================== Top Left Menu Section Starts=================== -->
			<div class="menu_block ">
				<div class="dropdown">
					<button class="dropbtn">Welcome<i class="fa fa-caret-down" style="font-size:14px; padding-top:4px;"></i><!--<i class="fa fa-user" aria-hidden="true" style="padding-top:3px;"></i>--></button>
					<div class="dropdown-content">
						<a href="MyView.php" class="note awesome">My View</a>
						<a href="ChangePassword.php" class="note awesome">Change Password</a>
						<a href="logout.php" class="note awesome">Logout</a>
					</div>
				</div>
				<div style="float:right; padding-top:6px; color:#FFFFFF">
					&nbsp;&nbsp;
				</div>
				<!--<div style="float:right; padding-top:6px; color:#FFFFFF">
					<a href="Dashboard.php?sheetid=278&content=yes"><img src="images/signout.png" width="18" height="18" title="Dashboard" /></a></a>
				</div>  
				<div style="float:right; padding-top:6px; color:#FFFFFF">&nbsp;</div>
				<div style="float:right; padding-top:6px; color:#FFFFFF">&nbsp;</div>-->
				<!--<div style="float:right; padding-top:6px; color:#FFFFFF">
					<a href="Dashboard.php?sheetid=278&content=yes"><img src="images/chart.png" width="20" height="18" title="Dashboard" /></a>
				</div>
				<div style="float:right; padding-top:6px; color:#FFFFFF">&nbsp;</div>
				<div style="float:right; padding-top:6px; color:#FFFFFF">&nbsp;</div>-->
				<div style="float:right; padding-top:6px; color:#FFFFFF">
					<a href=""><img src="images/home.png" width="20" height="18" title="Home" /></a><!--<i class="fa fa-home" aria-hidden="true" style=" color:#FFFFFF; font-size:14px"></i>-->
				</div>
				<!--<a href="download.php?filename=User_Manual_EBMS.pdf" class="userlogin" title="User Manual - Click here to download" style="background-color:#FFFFFF;padding: 0px 7px 0px 0px;">
				<img src="images/book1.png" width="30" height="28">
				</a>
				<a href="download.php?filename=STEPS_TO_FOLLOW_EBMS.pdf" class="userlogin" title="Steps to follow - Click here to download" style="background-color:#FFFFFF;padding: 0px 7px 0px 0px;">
				<img src="images/steps_to_follow_icon.png" width="30" height="28"></a>-->
				<div class="clear"></div>
				
				<!-- ====================== Main Menu Section for ACCOUNTS Starts=================== -->
				<ul id="menu">
					<li><a href="" class="drop">Admin</a>
						<div class="dropdown_1column">
							<div class="col_1">
								<h3>Admin</h3>
								<ul class="greybox">
									<li><a href="EngineerList_Accounts.php">Staff Registration</a></li>
									<li><a href="UsersList_Accounts.php">Create User</a></li>
									<li><a href="MbookLockRelease.php">MB Lock Release</a></li>
									<li><a href="AccountsMBCheckLevelAssign.php">Level Assign</a></li>
									<li class="overLAY"><a href="Recoveries.php">Recoveries</a></li>
									<li class="overLAY"><a href="RABMbookStatusAccounts.php">Rab Status</a></li>
								</ul> 
							</div>
						</div>
					</li>							
					<li><a href="ViewAgreementSheet.php" class="drop">Agreement Sheet</a></li>
					<li><a href="MeasurementBookPrint_staff_Accounts.php" class="drop">Measurement Book</a></li>
					<li>
						<a href="" class="drop">Pass Order</a>
						<div class="dropdown_1column align_right">
							<div class="col_1">
								<h3>Statement</h3>
								<ul class="greybox">
									<li><a href="AccountsStatementSteps.php">Pass Order Statements</a></li>
								</ul>
							</div>
						</div>
					</li>
				</ul>
				<!-- ====================== Main Menu Section for MEASUREMENTS & MBOOK SECTION Starts=================== -->
				<ul id="menu">
					<li><a href="#" class="drop">Work Management <i class="fa fa-caret-down" style="font-size:22px; padding-top:1px;"></i></a>
						<div class="dropdown_4columns align_right">
							<div class="col_1">
								<h3>Bidding</h3>
								<ul class="greybox">
									<li><a href="BiddersCreation.php">Bidder Entry</a></li>
									<li><a href="PriceBidUploadGenerate.php">Price Bid Upload</a></li>
									<li><a href="PriceBidViewGenerate.php">Price Bid View</a></li>
									<li><a href="ComparativeStatementGenerate.php">Comparative Statement</a></li>
								</ul>   
							</div>
							<div class="col_1">
								<h3>Works</h3>
								<ul class="greybox">
									<li><a href="AgreementSheetEntry.php">WO Entry</a></li>
									<li><a href="sheet.php">SOQ Upload</a></li>
									<li><a href="ViewAgreementSheet.php">SOQ View</a></li>
									<li><a href="DeviationQuantity.php">Deviation Qty %</a></li>
									<li><a href="AgreementStaffAssign2.php">Staff & Level Assign to Work</a></li>
								</ul>   
							</div>
							<div class="col_1">
								<h3>Taxes & Others</h3>
								<ul class="greybox">
									<li><a href="Recoveries.php">Taxes & Recoveries</a></li>
									<li><a href="DecimalAssign.php">Decimal Assign</a></li>
									<li><a href="ItemTypeChange.php">Item Type Change</a></li>
									<li><a href="WorkExtensionList.php">Work Extension</a></li>
									<li><a href="PGEntry.php">PG Entry</a></li>
									<!--<li><a href="ContractorList.php">Contractor List</a></li>-->
								</ul>   
							</div>
							<div class="col_1">
								<h3>Supplementary</h3>
								<ul class="greybox">
									<li><a href="SupplementaryAgreementGenerate.php">Supp. Agreement</a></li>
									<li><a href="ExtraItemCreation.php">Additional qty beyond the deviation limit</a></li>
									<li><a href="ExtraItemGenerate.php">Extra Item</a></li>
									<li><a href="SubstituteItemGenerate.php">Substitute Item</a></li>
								</ul>   
							</div>
						</div>
					</li>
					
					<li><a href="#" class="drop">MBook Management <i class="fa fa-caret-down" style="font-size:22px; padding-top:1px;"></i></a>
						<div class="dropdown_5columns align_right">
							<div class="col_1">
								<h3>MBook Issue</h3>
								<ul class="greybox">
									<li><a href="AgreementMBookAllotment.php">MB Issue to Work</a></li>
									<li><a href="MBookAllotment.php">MB Issue to Staff</a></li>
									<li><a href="StaffWorkMigration.php">MB-Work Migration</a></li>
									<li><a href="MBookPageChange.php">MB Page Change</a></li>
								</ul>   
							</div>
							<div class="col_1">
								<h3>Check Measurement</h3>
								<ul class="greybox">
									<li><a href="CheckMeasurementSend.php">Approval</a></li>
									<li><a href="CheckMeasurementPrintGenerate.php" >View & Print</a></li>
								</ul>   
							</div>
							<div class="col_1">
								<h3>MBook Draft</h3>
								<ul class="greybox">
									<li><a href="MeasurementBookDraft_staff.php">MBook Draft</a></li>
									<li><a href="MeasurementBookDraft_composite.php">Sub-Abstract Draft</a></li>
									<li><a href="AbstractBookDraft_Common.php">Abstract Draft</a></li>
								</ul>  
							</div>
							<div class="col_1">
								<h3>MBook Print</h3>
								<ul class="greybox">
									<li><a href="MeasurementBookPrint_staff.php">MBook Print</a></li>
									<li><a href="MeasurementBookPrint_composite.php">Sub-Abstract Print</a></li>
									<li><a href="AbstractBookPrint_Common.php">Abstract Print</a></li>
								</ul> 
							</div>
							<div class="col_1">
								<h3>Accounts Section</h3>
								<ul class="greybox">
									<li><a href="Bill_Send_to_Accounts.php">Send to Accounts</a></li>
									<li><a href="AccountsComments.php">Accounts Comments</a></li>
									<li><a href="RABAccept.php">RAB Accept</a></li>
								</ul> 
							</div>
						</div>
					</li>
					
					<li><a href="#" class="drop">Status & Reports <i class="fa fa-caret-down" style="font-size:22px; padding-top:1px;"></i></a>
						<div class="dropdown_4columns align_right">
							<div class="col_1">
								<h3>MBook History</h3>
								<ul class="greybox">
									<li><a href="HistoryMBookGenerate.php">MBook</a></li>
									<li><a href="HistorySubAbstractGenerate.php">Sub-Abstract</a></li>
									<li><a href="HistoryAbstractGenerate.php">Abstract</a></li>
								</ul>
							</div>
							<div class="col_1">
								<h3>Status</h3>
								<ul class="greybox">
									<li><a href="SOQStatus.php">SOQ Status</a></li>
									<li><a href="RABStatus.php">Bill Status</a></li>
									<li><a href="WorkTransactionGenerate.php">Work Transaction</a></li>
								</ul>   
							</div>
							<div class="col_1">
								<h3>Reports</h3>
								<ul class="greybox">
									<li><a href="MyViewWorks.php">Total Works</a></li>
									<li><a href="CommanWorkDetails.php">Work Reports</a></li>
									<li><a href="ConsolidatedWorkListGenerate.php">Consolidated Report</a></li>
								</ul>   
							</div>
							<div class="col_1">
								<h3>Reports-Accounts</h3>
								<ul class="greybox">
									<li><a href="RABStatusTableCivil.php">Accounts Bill Status</a></li>
									<li><a href="RABStatusCivil.php">Accounts MB Status</a></li>
									<li><a href="PassOrderStatusCivil.php">Pass Order Notification</a></li>
								</ul>   
							</div>
						</div>
					</li>
					<li><a href="#" class="drop">User Management&nbsp;&nbsp;<i class="fa fa-caret-down" style="font-size:22px; padding-top:1px;"></i></a>
						<div class="dropdown_1column align_right">
							<div class="col_1">
								<h3></h3>
								<ul class="greybox">
									<li><a href="designationlist.php">Designation</a></li>
									<li><a href="EngineerList.php">Create Staff </a></li>
									<li><a href="UsersList.php">Create User</a></li>
									<!--<li><a href="ModuleRights.php">Module Rights</a></li>-->
									<li><a href="backup.php">Backup</a></li>
									<!--<li><a href="OrganizationalRoleMaster.php">Role Master</a></li>
									<li><a href="OrganizationalStructure.php">Org. Structure</a></li>
									<li><a href="OrganizationalStructureView.php">Org. Structure View</a></li>
									<li><a href="OrganizationalUserRoleStructure.php">Role Structure</a></li>
									<li><a href="OrganizationalUserRoleStructureView.php">Role Structure View</a></li>
									<li><a href="OrganizationalStaff.php">Org. Staff</a></li>
									<li><a href="OrganizationalStaffView.php">Org. Staff View</a></li>-->
								</ul>   
							</div>
						</div>
					</li>
					<li><q><a href="" class="drop" style="border-left:none">Works <i class="fa fa-caret-down" style="font-size:22px; padding-top:1px;"></i></a></q>
						<div class="dropdown_3columns align_right">
							<!--<div class="col_1">
								<h3>Bidding</h3>
								<ul class="greybox">
									<li><a href="BidderEnter.php">Bidder Entry</a></li>
									<li><a href="BidUploadGenerate.php">Bid Upload</a></li>
									<li><a href="BidderBidViewGenerate.php">Bidder Bid View</a></li>
									<li><a href="VariationStatementGenerate.php">Variation Statement</a></li>
								</ul>  
							</div>-->
							<div class="col_1">
								<h3>My Works</h3>
								<ul class="greybox">
									<li><a href="ViewAgreementSheet.php">SOQ View</a></li>
									<li><a href="DeviationQuantity.php">Deviation Qty %</a></li>
									<li><a href="ShortNotesGenerate.php">Short Notes Create</a></li>
									<li><a href="ElectricityBill_New.php">Electricity Meter</a></li>
								</ul>  
							</div>
							<div class="col_1">
								<h3>My Mbooks</h3>
								<ul class="greybox">
									<li><a href="AgreementMBookAllotmentEdit.php">My Work MBook</a></li>
									<li><a href="MBookAllotmentEdit.php">My MBook</a>
								</ul>   
							</div>
							<div class="col_1">
								<h3>Supplementary</h3>
								<ul class="greybox">
									<li><a href="SupplementaryAgreementGenerate.php">Supp. Agmt View</a></li>
									<li><a href="ExtraItemGenerate.php">Extra Item View</a></li>
									<li><a href="SubstituteItemGenerate.php">Substitute Item View</a></li>
								</ul>   
							</div>
						</div>
					</li>
					<li><a href="#" class="drop">Measurements <i class="fa fa-caret-down" style="font-size:22px; padding-top:1px;"></i></a>
						<div class="dropdown_5columns align_right">
							<div class="col_1">
								<h3>Measurements</h3>
								<ul class="greybox">
									<li><a href="MeasurementUpload.php">Upload</a></li>
									<!--<li><a href="MeasurementEntry.php">Entry</a></li>-->
									<li><a href="ViewMeasurementEntry.php">View & Edit</a></li>
									<li><a href="RABGenerateSteps.php">RAB Generate</a></li>
									<li><a href="CheckMeasurementSend.php">CheckMeasurement</a></li>
									<li><a href="AbstractBookBill_Confirm.php">Pass Order</a></li>
								</ul>  
							</div>
							<div class="col_1">
								<h3>MBook Draft</h3>
								<ul class="greybox">
									<li><a href="MeasurementBookDraft_staff.php">MBook Draft</a></li>
									<li><a href="MeasurementBookDraft_composite.php">Sub-Abstract Draft</a></li>
									<li><a href="AbstractBookDraft_Common.php">Abstract Draft</a></li>
									<!--<li><a href="RABAccept.php">RAB Accept</a></li>-->
								</ul>   
							</div>
							<div class="col_1">
								<h3>Mbook Print</h3>
								<ul class="greybox">
									<li><a href="MeasurementBookPrint_staff.php">MBook Print</a></li>
									<li><a href="MeasurementBookPrint_composite.php">Sub-Abstract Print</a></li>
									<li><a href="AbstractBookPrint_Common.php">Abstract Print</a></li>
									<li><a href="CheckMeasurementPrintGenerate.php" >CheckMeasurement</a></li>
									<li><a href="MemoOfPaymentPrintGenerate.php" >Memo of Payment</a></li>
									<li><a href="MbookFrontPage.php">MB Front Page</a></li>
								</ul>   
							</div>
							<div class="col_1">
								<h3>Recovery</h3>
								<ul class="greybox">
									<li><a href="Generate_ElectricityBill_New.php">Add Electricity Rec.</a></li>
									<li><a href="ViewElectricityRecovery.php">View Electricity Rec.</a></li>
									<li><a href="Generate_WaterBill_New.php">Add Water Rec.</a></li>
									<li><a href="ViewWaterRecovery.php">View Water rec</a></li>
									<li><a href="Generate_OtherRecovery.php">General Recovery</a></li>
									<li><a href="RecoveryRelease.php">Recovery Release</a></li>
								</ul>   
							</div>
							<div class="col_1">
								<h3>Bill Form/Statement</h3>
								<ul class="greybox">
									<li><a href="FirstandFinalBillGenerate.php">I<sup>st</sup> & Final Bill From</a></li>
									<li><a href="BillFormGenerate.php" >Bill Form</a></li>
									<li><a href="VariationStatementGenerate.php" >Variation Statement</a></li>
									<li><a href="AccountsComments.php">Accounts Comment</a></li>
									<li><a href="MeasurementBookPrint_composite_column.php" >Item Wise Report</a></li>
								</ul>   
							</div>
						</div>
					</li>
					<li><a href="#" class="drop">Status & Reports <i class="fa fa-caret-down" style="font-size:22px; padding-top:1px;"></i></a>
						<div class="dropdown_4columns align_right">
							<div class="col_1">
								<h3>Status</h3>
								<ul class="greybox">
									<li><a href="SOQStatus.php">SOQ Status</a></li>
									<li><a href="RABStatus.php">Bill Status</a></li>
									<li><a href="WorkTransactionGenerate.php">Work Transaction</a></li>
								</ul>   
							</div>
							<div class="col_1">
								<h3>MBook History</h3>
								<ul class="greybox">
									<li><a href="HistoryMBookGenerate.php">MBook</a></li>
									<li><a href="HistorySubAbstractGenerate.php">Sub-Abstract</a></li>
									<li><a href="HistoryAbstractGenerate.php">Abstract</a></li>
								</ul>   
							</div>
							<div class="col_1">
								<h3>Reports</h3>
								<ul class="greybox">
									<li><a href="ConsolidatedWorkListGenerate.php">Consolidated Report</a></li>
									<li><a href="MyViewWorks.php">Total Works</a></li>
									<li><a href="CommanWorkDetails.php">Work Reports</a></li>
								</ul>   
							</div>
							<div class="col_1">
								<h3>Reports - Accounts</h3>
								<ul class="greybox">
									<li><a href="RABStatusTableCivil.php">Accounts Bill Status</a></li>
									<li><a href="RABStatusCivil.php">Accounts MB Status</a></li>
									<li><a href="PassOrderStatusCivil.php">Pass Order Status</a></li>
								</ul>   
							</div>
						</div>
					</li>
					<li><a href="#" class="drop">Secured Advance <i class="fa fa-caret-down" style="font-size:22px; padding-top:1px;"></i></a>
						<div class="dropdown_1column align_right">
							<div class="col_1">
								<h3>Secured Advance</h3>
								<ul class="greybox">
									<li><a href="SecuredAdvance.php">Entry</a></li>
									<li><a href="SecuredAdvanceViewGenerate.php">View</a></li>
									<li><a href="SecuredAdvancePrintGenerate.php">Print</a></li>
									<!--<li><a href="SecuredAdvanceNew.php">Secured Advance</a></li>-->
								</ul>   
							</div>
						</div>
					</li>
					<li><a href="#" class="drop">Escalation <i class="fa fa-caret-down" style="font-size:22px; padding-top:1px;"></i></a>
						<div class="dropdown_5columns align_right">
							<div class="col_1">
								<h3>Configuration</h3>
								<ul class="greybox">
									<li><a href="Material.php">Material</a></li>
									<li><a href="MaterialBroughtToSite.php">Mat - Brought to site</a></li>
									<li><a href="EscalationSettingsGenerate.php">Escalation Settings</a></li>
									<li><a href="ItemIndexMonthMappingGenerate.php">Item & Index Month</a></li>
									<li><a href="ItemBaseRateAssign.php">Item Base Rate</a></li>
									<li><a href="EscalationItemAssign.php">Escalation Item Assign</a></li>
									<li><a href="Th_Cement_Consum_Assign.php">Theoritical Cement Assign</a></li>
									<li><a href="Th_Cement_Consum.php">Theoritical Cement View & Edit</a></li>
								</ul>  
							</div>
							<div class="col_1">
								<h3>Index Assign</h3>
								<ul class="greybox">
									<li><a href="10CAIndexAssign.php">10-CA Monthly Index</a></li>
									<li><a href="10CCIndexAssign.php">10-CC Monthly Index</a></li>
									<li><a href="BaseIndex_10CA.php">Base Index 10-CA</a></li>
									<li><a href="BaseIndex_10CC.php">Base Index 10-CC</a></li>
									<li><a href="PriceIndex_10CA.php">Price Index 10-CA</a></li>
									<li><a href="PriceIndex_10CC.php">Price Index 10-CC</a></li>
								</ul>   
							</div>
							<div class="col_1">
								<h3>10CA Consumption</h3>
								<ul class="greybox">
									<li><a href="10CAConsumptionGenerate.php">Material Consumption</a></li>
									<li><a href="Escalation_Cement_Consump_General.php">Cement</a></li>
									<li><a href="Escalation_Steel_Consump.php">Steel</a></li>
								</ul>   
							</div>
							<div class="col_1">
								<h3>Escalation</h3>
								<ul class="greybox">
									<li><a href="Escalation_10CA.php">Calculation-10 CA</a></li>
									<li><a href="EscalationAbstractGenerate.php">EscalationAbstract</a></li>
									<li><a href="Escalation_10CC.php">Calculation-10 CC</a></li>
									<li><a href="EscalationGenerate.php">EscalationGenerate</a></li>
								</ul>   
							</div>
							<div class="col_1">
								<h3>View & Print</h3>
								<ul class="greybox">
									<li><a href="Esc_Consump_10ca_Cement_Print.php">Cement Consumption</a></li>
									<li><a href="Esc_Consump_10ca_Steel_Print.php">Steel Consumption</a></li>
									<li><a href="EscalationAbstractPrintGenerate.php">Escalation Abstract</a></li>
									<li><a href="EscalationPrintGenerate.php">Escalation</a></li>
									<li><a href="EscalationReset.php">Reset Escalation</a></li>
								</ul>   
							</div>
							<!--<div class="col_1">
								<h3>Revised Escalation</h3>
								<ul class="greybox">
									<li><a href="PriceIndex_10CARevised.php">Revised Price Index 10-CA</a></li>
									<li><a href="PriceIndex_10CCRevised.php">Revised Price Index 10-CC</a></li>
									<li><a href="EscalationGenerateRevised.php">Revised EscalationGenerate</a></li>
								</ul>   
							</div>-->
						</div>
					</li>	
					<li><a href="#" class="drop">Work Management <i class="fa fa-caret-down" style="font-size:22px; padding-top:1px;"></i></a>
						<div class="dropdown_4columns align_right">
							<div class="col_1">
								<h3>Bidding</h3>
								<ul class="greybox">
									<li><a href="BiddersCreation.php">Bidder Entry</a></li>
									<li><a href="PriceBidUploadGenerate.php">Price Bid Upload</a></li>
									<li><a href="PriceBidViewGenerate.php">Price Bid View</a></li>
									<li><a href="ComparativeStatementGenerate.php">Comparative Statement</a></li>
								</ul>   
							</div>
							<div class="col_1">
								<h3>Works</h3>
								<ul class="greybox">
									<li><a href="AgreementSheetEntry.php">WO Entry</a></li>
									<li><a href="sheet.php">SOQ Upload</a></li>
									<li><a href="ViewAgreementSheet.php">SOQ View</a></li>
									<li><a href="DeviationQuantity.php">Deviation Qty %</a></li>
								</ul>   
							</div>
							<div class="col_1">
								<h3>Others</h3>
								<ul class="greybox">
									<li><a href="DecimalAssign.php">Decimal Assign</a></li>
									<li><a href="PGEntry.php">PG Entry</a></li>
									<!--<li><a href="ContractorList.php">Contractor List</a></li> -->
								</ul> 
							</div>
							<div class="col_1">
								<h3>Supplementary</h3>
								<ul class="greybox">
									<li><a href="SupplementaryAgreementGenerate.php">Supp. Agreement</a></li>
									<li><a href="ExtraItemCreation.php">Additional qty beyond the deviation limit</a></li>
									<li><a href="ExtraItemGenerate.php">Extra Item</a></li>
									<li><a href="SubstituteItemGenerate.php">Substitute Item</a></li>
								</ul>   
							</div>
						</div>
					</li>
				</ul> 
			</div>
		</div>
	</div>
</header> 
<div class="container_12">
	<!--<br/>-->
</div>