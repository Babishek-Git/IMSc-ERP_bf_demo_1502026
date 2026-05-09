@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
<style>
	.boxhead{
		background-color: #DCE0E3;
		padding: 5px;
	}
</style>
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
	<form action="" method="post" enctype="multipart/form-data" name="form">
		<div class="content">
			<div class="title"></div>
			<div class="container_12">
				<div class="grid_12">
					<blockquote class="bq1" style="overflow:auto">
						<div class="container">
							<div class="row plr">
								<div class="div12 mbtable">
									<div class="row"><div class="div12" style="margin-top:0px;"><div class="row divhead" align="center">Income Tax Calculation</div></div></div>
									<div class="card-body padding-1 ChartCard" id="CourseChart">
										<div class="divrowbox innerdiv pt-2">
																	
											<div class="row smclearrow"></div>                                                                                											
											<div class="div4" style="margin-top: 0px;">
												<div class="div12" style="padding:2px;margin-top: 0px;"><div class="div12 cboxlabel boxhead">Salary Inputs</div></div>
												<div class="row" style="padding:0px 10px;">
													<div class="div6 pd-lr-1 label">
														<div class="lboxlabel">Gross Salary Income</div>
													</div>
													<div class="div6 pd-lr-1 label">
														<input type="text" name="txt_salary" id="txt_salary" class="tboxsmclass TaxCalc" value="5601144">
													</div>
													<div class="div6 pd-lr-1 label">
														<div class="lboxlabel">Professional Tax</div>
													</div>
													<div class="div6 pd-lr-1 label">
														<input type="text" name="txt_prof_tax" id="txt_prof_tax" class="tboxsmclass TaxCalc" value="2500">
													</div>
													<!-- <div class="div6 pd-lr-1 label">
														<div class="lboxlabel">Net salary Income</div>
													</div>
													<div class="div6 pd-lr-1 label">
														<input type="text" name="txt_net_income" id="txt_net_income" class="tboxsmclass TaxCalc" >
													</div> -->
													<div class="div6 pd-lr-1 label">
														<div class="lboxlabel">Interest on Housing Loan</div>
													</div>
													<div class="div6 pd-lr-1 label">
														<input type="text" name="txt_home_loan_int" id="txt_home_loan_int" class="tboxsmclass TaxCalc" value="0">
													</div>
													<div class="div6 pd-lr-1 label">
														<div class="lboxlabel">Investment U/S 80C</div>
													</div>
													<div class="div6 pd-lr-1 label">
														<input type="text" name="txt_invest_us_80c_master" id="txt_invest_us_80c_master" class="tboxsmclass TaxCalc" value="0">
													</div>
													<div class="div6 pd-lr-1 label">
														<div class="lboxlabel">80 CCC</div>
													</div>
													<div class="div6 pd-lr-1 label">
														<input type="text" name="txt_invest_us_80ccc_master" id="txt_invest_us_80ccc_master" class="tboxsmclass TaxCalc" value="0">
													</div>
													<div class="div6 pd-lr-1 label">
														<div class="lboxlabel">NPS </div>
													</div>
													<div class="div6 pd-lr-1 label">
														<input type="text" name="txt_nps_master" id="txt_nps_master" class="tboxsmclass TaxCalc" value="0">
													</div>
													<div class="div6 pd-lr-1 label">
														<div class="lboxlabel">80 CCD(1)</div>
													</div>
													<div class="div6 pd-lr-1 label">
														<input type="text" name="txt_invest_us_80ccd_1_master" id="txt_invest_us_80ccd_1_master" class="tboxsmclass TaxCalc disable" readonly>
													</div>
													<div class="div6 pd-lr-1 label">
														<div class="lboxlabel">80 CCD(1B)</div>
													</div>
													<div class="div6 pd-lr-1 label">
														<input type="text" name="txt_invest_us_80ccd_1b_master" id="txt_invest_us_80ccd_1b_master" class="tboxsmclass TaxCalc disable" readonly>
													</div>
													<div class="div6 pd-lr-1 label">
														<div class="lboxlabel">NPS Employer Contribution</div>
													</div>
													<div class="div6 pd-lr-1 label">
														<input type="text" name="txt_nps_emp_contrib_master" id="txt_nps_emp_contrib_master" class="tboxsmclass TaxCalc disable" readonly>
													</div>
													<div class="div6 pd-lr-1 label">
														<div class="lboxlabel">Health Insurance U/S 80D</div>
													</div>
													<div class="div6 pd-lr-1 label">
														<input type="text" name="txt_health_ins_us_80d_master" id="txt_health_ins_us_80d_master" class="tboxsmclass TaxCalc" value="26892">
													</div>
													<div class="div6 pd-lr-1 label">
														<div class="lboxlabel">80D</div>
													</div>
													<div class="div6 pd-lr-1 label">
														<input type="text" name="txt_80d_master" id="txt_80d_master" class="tboxsmclass TaxCalc disable" readonly>
													</div>
													<div class="div6 pd-lr-1 label">
														<div class="lboxlabel">Physically Handicapped Self </div>
													</div>
													<div class="div6 pd-lr-1 label">
														<input type="radio" name="ch_phy_self_ch" id="ch_phy_self_ch_yes" value="Y"> YES &emsp;
														<input type="radio" name="ch_phy_self_ch" id="ch_phy_self_ch_yes" value="N"> NO
													</div>
													<div class="div6 pd-lr-1 label">
														<div class="lboxlabel">Phy. Challenged % Disability</div>
													</div>
													<div class="div6 pd-lr-1 label">
														<input type="text" name="txt_phy_ch_self_perc_master" id="txt_phy_ch_self_perc_master" class="tboxsmclass TaxCalc">
													</div>
													<div class="div6 pd-lr-1 label">
														<div class="lboxlabel">80U</div>
													</div>
													<div class="div6 pd-lr-1 label">
														<input type="text" name="txt_80u_master" id="txt_80u_master" class="tboxsmclass TaxCalc disable" readonly>
													</div>
													<div class="div6 pd-lr-1 label">
														<div class="lboxlabel">Phy. Handicapped Dependent ?</div>
													</div>
													<div class="div6 pd-lr-1 label">
														<input type="radio" name="ch_phy_depend_ch" id="ch_phy_depend_ch_yes" value="Y"> YES &emsp;
														<input type="radio" name="ch_phy_depend_ch" id="ch_phy_depend_ch_no" value="N"> NO
													</div>
													<div class="div6 pd-lr-1 label">
														<div class="lboxlabel">Phy. Challenged % Disability</div>
													</div>
													<div class="div6 pd-lr-1 label">
														<input type="text" name="txt_phy_ch_depend_perc_master" id="txt_phy_ch_depend_perc_master" class="tboxsmclass TaxCalc">
													</div>
													<div class="div6 pd-lr-1 label">
														<div class="lboxlabel">80DD</div>
													</div>
													<div class="div6 pd-lr-1 label">
														<input type="text" name="txt_80dd_master" id="txt_80dd_master" class="tboxsmclass TaxCalc disable" readonly>
													</div>
													<div class="div6 pd-lr-1 label">
														<div class="lboxlabel">80G</div>
													</div>
													<div class="div6 pd-lr-1 label">
														<input type="text" name="txt_80g_master" id="txt_80g_master" class="tboxsmclass TaxCalc" value="0">
													</div>
													<div class="div6 pd-lr-1 label">
														<div class="lboxlabel">Tax Paid</div>
													</div>
													<div class="div6 pd-lr-1 label">
														<input type="text" name="txt_tax_paid_master" id="txt_tax_paid_master" class="tboxsmclass TaxCalc" value="1148362">
													</div>
												</div>
											</div>
											<div class="div4" style="margin-top: 0px;">
												<div class="div12" style="padding:2px; margin-top: 0px;"><div class="div12 cboxlabel boxhead">Income Tax Calculation as per Old Regime</div></div>
												<div class="row" style="padding:0px 10px;">
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">Gross Salary Income</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_gross_salary" id="txt_gross_salary" class="tboxsmclass disable" disabled="disabled">
													</div>
													
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">Standard Deduction</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_std_ded_less" id="txt_std_ded_less" class="tboxsmclass disable" disabled="disabled">
													</div>
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">Professional Tax</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_prof_tax_less" id="txt_prof_tax_less" class="tboxsmclass disable" disabled="disabled">
													</div>
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">Less: Standard Deduction</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_less_std_ded_total" id="txt_less_std_ded_total" class="tboxsmclass disable" disabled="disabled">
													</div>
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">Net salary Income</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_net_income_salary" id="txt_net_income_salary" class="tboxsmclass disable" disabled="disabled">
													</div>


													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">Income from House Property</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_income_from_house_prop" id="txt_income_from_house_prop" class="tboxsmclass disable" disabled="disabled">
													</div>
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">Self Occupied - Int. on Loan</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_interest_on_home_loan" id="txt_interest_on_home_loan" class="tboxsmclass disable" disabled="disabled">
													</div>
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">Gross Total Income</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_gross_total_income" id="txt_gross_total_income" class="tboxsmclass disable" disabled="disabled">
													</div>
													
													
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">80 C</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_80_c" id="txt_80_c" class="tboxsmclass disable" disabled="disabled">
													</div>
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">80 CCC</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_80_ccc" id="txt_80_ccc" class="tboxsmclass disable" disabled="disabled">
													</div>
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">80 CCD(1)</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_80_ccd_1" id="txt_80_ccd_1" class="tboxsmclass disable" disabled="disabled">
													</div>
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">80 CCE</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_80_ee" id="txt_80_ee" class="tboxsmclass disable" disabled="disabled">
													</div>
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">80 CCD(1B)</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_80_ccd_1b" id="txt_80_ccd_1b" class="tboxsmclass disable" disabled="disabled">
													</div>
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">80 CCD(2)</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_80_ccd_2" id="txt_80_ccd_2" class="tboxsmclass disable" disabled="disabled">
													</div>
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">80 D</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_80_d" id="txt_80_d" class="tboxsmclass disable" disabled="disabled">
													</div>
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">80U</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_80_u" id="txt_80_u" class="tboxsmclass disable" disabled="disabled">
													</div>
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">80DD</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_80_dd" id="txt_80_dd" class="tboxsmclass disable" disabled="disabled">
													</div>
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">80G</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_80_g" id="txt_80_g" class="tboxsmclass disable" disabled="disabled">
													</div>
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">Deductions Under Chapter-VI A</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_ded_under_chap_vi_a" id="txt_ded_under_chap_vi_a" class="tboxsmclass disable" disabled="disabled">
													</div>
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">Net Taxable Salary Income</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_taxable_sal_income" id="txt_taxable_sal_income" class="tboxsmclass disable" disabled="disabled">
													</div>
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">Tax on Salary Income</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_tax_on_sal_income" id="txt_tax_on_sal_income" class="tboxsmclass disable" disabled="disabled">
													</div>
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">Less: Rebate u/s 87A</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_less_rebate_us_87a" id="txt_less_rebate_us_87a" class="tboxsmclass disable" disabled="disabled">
													</div>
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">Tax Payable after rebate</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_payable_after_rebate" id="txt_payable_after_rebate" class="tboxsmclass disable" disabled="disabled">
													</div>
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">Add: Surchage @10%</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_add_surcharge" id="txt_add_surcharge" class="tboxsmclass disable" disabled="disabled">
													</div>
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">Health & Education Cess 4%</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_health_edu_cess" id="txt_health_edu_cess" class="tboxsmclass disable" disabled="disabled">
													</div>
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">Tax plus cess</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_tax_plus_cess" id="txt_tax_plus_cess" class="tboxsmclass disable" disabled="disabled">
													</div>
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">Less: Tax Paid</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_less_tax_paid" id="txt_less_tax_paid" class="tboxsmclass disable" disabled="disabled">
													</div>
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">Balance Tax to be Paid</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_bal_to_be_paid" id="txt_bal_to_be_paid" class="tboxsmclass disable" disabled="disabled">
													</div>
													
												</div>
											</div>
											<div class="div4" style=" margin-top: 0px;">
												<div class="div12" style="padding:2px; margin-top: 0px;"><div class="div12 cboxlabel boxhead">Income Tax Calculation as per New Regime</div></div>
												<div class="row" style="padding:0px 10px;">
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">Gross Salary Income</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_gross_salary_new" id="txt_gross_salary_new" class="tboxsmclass disable" disabled="disabled">
													</div>
													
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">Standard Deduction</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_std_ded_less_new" id="txt_std_ded_less_new" class="tboxsmclass disable" disabled="disabled">
													</div>
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">Professional Tax</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_prof_tax_less_new" id="txt_prof_tax_less_new" class="tboxsmclass disable" disabled="disabled">
													</div>
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">Less: Standard Deduction</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_less_std_ded_total_new" id="txt_less_std_ded_total_new" class="tboxsmclass disable" disabled="disabled">
													</div>
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">Net salary Income</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_net_income_salary_new" id="txt_net_income_salary_new" class="tboxsmclass disable" disabled="disabled">
													</div>


													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">Income from House Property</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_income_from_house_prop_new" id="txt_income_from_house_prop_new" class="tboxsmclass disable" disabled="disabled">
													</div>
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">Self Occupied - Int. on Loan</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_interest_on_home_loan_new" id="txt_interest_on_home_loan_new" class="tboxsmclass disable" disabled="disabled">
													</div>
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">Gross Total Income</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_gross_total_income_new" id="txt_gross_total_income_new" class="tboxsmclass disable" disabled="disabled">
													</div>
													
													
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">80 C</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_80_c_new" id="txt_80_c_new" class="tboxsmclass disable" disabled="disabled">
													</div>
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">80 CCC</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_80_ccc_new" id="txt_80_ccc_new" class="tboxsmclass disable" disabled="disabled">
													</div>
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">80 CCD(1)</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_80_ccd_1_new" id="txt_80_ccd_1_new" class="tboxsmclass disable" disabled="disabled">
													</div>
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">80 CCE</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_80_ee_new" id="txt_80_ee_new" class="tboxsmclass disable" disabled="disabled">
													</div>
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">80 CCD(1B)</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_80_ccd_1b_new" id="txt_80_ccd_1b_new" class="tboxsmclass disable" disabled="disabled">
													</div>
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">80 CCD(2)</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_80_ccd_2_new" id="txt_80_ccd_2_new" class="tboxsmclass disable" disabled="disabled">
													</div>
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">80 D</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_80_d_new" id="txt_80_d_new" class="tboxsmclass disable" disabled="disabled">
													</div>
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">80U</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_80_u_new" id="txt_80_u_new" class="tboxsmclass disable" disabled="disabled">
													</div>
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">80DD</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_80_dd_new" id="txt_80_dd_new" class="tboxsmclass disable" disabled="disabled">
													</div>
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">80G</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_80_g_new" id="txt_80_g_new" class="tboxsmclass disable" disabled="disabled">
													</div>
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">Deductions Under Chapter-VI A</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_ded_under_chap_vi_a_new" id="txt_ded_under_chap_vi_a_new" class="tboxsmclass disable" disabled="disabled">
													</div>
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">Net Taxable Salary Income</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_taxable_sal_income_new" id="txt_taxable_sal_income_new" class="tboxsmclass disable" disabled="disabled">
													</div>
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">Tax on Salary Income</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_tax_on_sal_income_new" id="txt_tax_on_sal_income_new" class="tboxsmclass disable" disabled="disabled">
													</div>
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">Less: Rebate u/s 87A</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_less_rebate_us_87a_new" id="txt_less_rebate_us_87a_new" class="tboxsmclass disable" disabled="disabled">
													</div>
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">Tax Payable after rebate</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_payable_after_rebate_new" id="txt_payable_after_rebate_new" class="tboxsmclass disable" disabled="disabled">
													</div>
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">Add: Surchage @10%</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_add_surcharge_new" id="txt_add_surcharge_new" class="tboxsmclass disable" disabled="disabled">
													</div>
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">Health & Education Cess 4%</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_health_edu_cess_new" id="txt_health_edu_cess_new" class="tboxsmclass disable" disabled="disabled">
													</div>
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">Tax plus cess</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_tax_plus_cess_new" id="txt_tax_plus_cess_new" class="tboxsmclass disable" disabled="disabled">
													</div>
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">Less: Tax Paid</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_less_tax_paid_new" id="txt_less_tax_paid_new" class="tboxsmclass disable" disabled="disabled">
													</div>
													<div class="div7 pd-lr-1 label">
														<div class="lboxlabel">Balance Tax to be Paid</div>
													</div>
													<div class="div5 pd-lr-1 label">
														<input type="text" name="txt_bal_to_be_paid_new" id="txt_bal_to_be_paid_new" class="tboxsmclass disable" disabled="disabled">
													</div>
													
												</div>
											</div>
											@php $AddUrl = 'roles.ViewRoleMaster'; @endphp										
											<div class="row">
												<div class="div12" align="center">
													<!-- <input type="submit" class="backbutton" name="btn_save" id="btn_save" value=" Save " />									 -->
													<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
												</div>		
											</div>
											<div class="row smclearrow"></div>  
										</div>
									</div>										
								</div>
								<div class="row clearrow"></div>  
							</div>                           
						</div>
					</blockquote>
				</div>
			</div>
		</div>
	</form>
</body>	
<script type="text/javascript" language="javascript">
	
	$("body").on("blur",".TaxCalc", function(event){
		var Salary = $("#txt_salary").val();
		var ProfTaxOld = $("#txt_prof_tax").val();
		//var NetIncome = $("#txt_net_income").val();
		var HomeLoanIntOld = $("#txt_home_loan_int").val();
		var HomeLoanIntNew = 0;
		var StdDedOld = 50000;
		var StdDedNew = 75000;
		if(ProfTaxOld == ""){
			ProfTaxOld = 0;
		}
		var ProfTaxNew = 0;

		$("#txt_gross_salary").val(Salary);
		$("#txt_gross_salary_new").val(Salary);

		$("#txt_std_ded_less").val(StdDedOld);
		$("#txt_std_ded_less_new").val(StdDedNew);

		$("#txt_prof_tax_less").val(ProfTaxOld);
		$("#txt_prof_tax_less_new").val('');

		var TotalStdDeductionOld = Number(StdDedOld) + Number(ProfTaxOld);
		var TotalStdDeductionNew = Number(StdDedNew) + Number(ProfTaxNew); 

		$("#txt_less_std_ded_total").val(TotalStdDeductionOld);
		$("#txt_less_std_ded_total_new").val(TotalStdDeductionNew);
		
		var NetSalaryIncomeOld = Number(Salary) - Number(TotalStdDeductionOld);
		var NetSalaryIncomeNew = Number(Salary) - Number(TotalStdDeductionNew);

		$("#txt_net_income_salary").val(NetSalaryIncomeOld);
		$("#txt_net_income_salary_new").val(NetSalaryIncomeNew);
		
		$("#txt_interest_on_home_loan").val(HomeLoanIntOld);
		$("#txt_interest_on_home_loan_new").val('');

		var GrossTotalIncomeOld = Number(NetSalaryIncomeOld) - Number(HomeLoanIntOld);
		var GrossTotalIncomeNew = Number(NetSalaryIncomeNew) - Number(HomeLoanIntNew);

		$("#txt_gross_total_income").val(GrossTotalIncomeOld);
		$("#txt_gross_total_income_new").val(GrossTotalIncomeNew);

		// 80C
		var InvestUnder80C = $("#txt_invest_us_80c_master").val();
		if(InvestUnder80C == ''){
			InvestUnder80C = 0;
		}
		$("#txt_80_c_new").val('');
		$("#txt_80_c").val(InvestUnder80C);
		// 80CCC
		var InvestUnder80CCC = $("#txt_invest_us_80ccc_master").val();
		if(InvestUnder80CCC == ''){
			InvestUnder80CCC = 0;
		}
		$("#txt_80_ccc_new").val('');
		$("#txt_80_ccc").val(InvestUnder80CCC);
		
		/// 80 CCD(1) Calculation
		var NpsTotal = $("#txt_nps_master").val();
		if(NpsTotal == ''){
			NpsTotal = 0;
		}
		
		var NpsLimit = 150000;
		if(NpsTotal == ""){
			NpsTotal = 0;
		}
		if(Number(NpsTotal) >= Number(NpsLimit)){
			var InvestUnder80CCD1 = NpsLimit;
		}else{
			var InvestUnder80CCD1 = NpsTotal;
		}
		$("#txt_80_ccd_1_new").val('');
		$("#txt_80_ccd_1").val(InvestUnder80CCD1);
		

		/// 80CCE
		var Total80CCE = Number(InvestUnder80C) + Number(InvestUnder80CCC) + Number(InvestUnder80CCD1);
		$("#txt_80_ee_new").val('');
		$("#txt_80_ee").val(Total80CCE);
		
		$("#txt_invest_us_80ccd_1_master").val(InvestUnder80CCD1);
		/// 80 CCD(1B) Calculation
		var CCD1BLimt = 50000;
		if(Number(NpsTotal) >= Number(NpsLimit)){
			var InvestUnder80CCD1B = Number(NpsTotal) - Number(NpsLimit);
		}else{
			var InvestUnder80CCD1B = 0;
		}
		$("#txt_invest_us_80ccd_1b_master").val(InvestUnder80CCD1B);
		if(Number(InvestUnder80CCD1B) > Number(CCD1BLimt)){
			var InvestUnder80CCD1BOld = CCD1BLimt;
		}else{
			var InvestUnder80CCD1BOld = InvestUnder80CCD1B;
		}
		var InvestUnder80CCD1BNew = 0;
		$("#txt_80_ccd_1b_new").val(InvestUnder80CCD1BNew);
		$("#txt_80_ccd_1b").val(InvestUnder80CCD1BOld);

		/// 80 CCD(2) Calculation
		var NpsEmpContribPerc = 1.2;
		var NpsEmpContribution = Number(NpsTotal) * Number(NpsEmpContribPerc);
		if(NpsEmpContribution != 0){
			NpsEmpContribution = Number(NpsEmpContribution).toFixed(2);
		}
		$("#txt_nps_emp_contrib_master").val(NpsEmpContribution);
		var InvestUnder80CCD2 = NpsEmpContribution;
		var InvestUnder80CCD2Old = InvestUnder80CCD2;
		var InvestUnder80CCD2New = NpsEmpContribution;
		$("#txt_80_ccd_2_new").val(InvestUnder80CCD2New);
		$("#txt_80_ccd_2").val(InvestUnder80CCD2Old);

		// 80D Calculation
		var D80Limit = 25000;
		var HealthInsTotal = $("#txt_health_ins_us_80d_master").val();
		var HealthIns80D = HealthInsTotal;
		$("#txt_80d_master").val(HealthIns80D);
		if(Number(HealthIns80D) >= Number(D80Limit)){
			var D80Old = D80Limit;
		}else{
			var D80Old = HealthIns80D;
		}
		$("#txt_80_d_new").val('');
		$("#txt_80_d").val(D80Old);

		// 80U Calculation
		var IsPhyHandiCapSelf = $('input[name="ch_phy_self_ch"]:checked').val();
		var IsPhyHandiCapSelfPerc = $("#txt_phy_ch_self_perc_master").val();
		var U80Amt = 0;
		if((IsPhyHandiCapSelf == "Y")&&(IsPhyHandiCapSelfPerc != '')){
			if(Number(IsPhyHandiCapSelfPerc) < 40){
				var U80Amt = 0;
			}else if(IsPhyHandiCapSelfPerc < 80){
				var U80Amt = 75000;
			}else{
				var U80Amt = 125000;
			}
		}
		$("#txt_80u_master").val(U80Amt);
		var U80AmtOld = U80Amt;
		var U80AmtNew = 0;
		$("#txt_80_u_new").val(U80AmtNew);
		$("#txt_80_u").val(U80AmtOld);

		// 80DD Calculation
		var IsPhyHandiCapDepend = $('input[name="ch_phy_depend_ch"]:checked').val();
		var IsPhyHandiCapDependPerc = $("#txt_phy_ch_depend_perc_master").val();
		var DD80Amt = 0;
		if((IsPhyHandiCapDepend == "Y")&&(IsPhyHandiCapDependPerc != '')){
			if(Number(IsPhyHandiCapDependPerc) < 40){
				var DD80Amt = 0;
			}else if(IsPhyHandiCapDependPerc < 80){
				var DD80Amt = 75000;
			}else{
				var DD80Amt = 125000;
			}
		}
		$("#txt_80dd_master").val(DD80Amt);
		var DD80AmtOld = DD80Amt;
		var DD80AmtNew = 0;
		$("#txt_80_dd_new").val(DD80AmtNew);
		$("#txt_80_dd").val(DD80AmtOld);

		// 80G
		var G80Master = $("#txt_80g_master").val();
		var G80Old = G80Master;
		var G80New = 0;

		$("#txt_80_g_new").val(G80New);
		$("#txt_80_g").val(G80Old);

		// Deductions Under Chapter-VI A
		var TotalDeductionUnderChapVIAOld = Number(Total80CCE) + Number(InvestUnder80CCD1BOld) + Number(InvestUnder80CCD2Old) + Number(D80Old) + Number(U80AmtOld) + Number(DD80AmtOld) + Number(G80Old);
		var TotalDeductionUnderChapVIANew = InvestUnder80CCD2New;

		$("#txt_ded_under_chap_vi_a").val(TotalDeductionUnderChapVIAOld);
		$("#txt_ded_under_chap_vi_a_new").val(TotalDeductionUnderChapVIANew);

		/*var NetTotalIncomeOld = Number(GrossTotalIncomeOld) - Number(TotalDeductionUnderChapVIAOld);
		var NetTotalIncomeNew = Number(GrossTotalIncomeNew) - Number(TotalDeductionUnderChapVIANew);
		if(NetTotalIncomeOld != 0){
			NetTotalIncomeOld = Number(NetTotalIncomeOld).toFixed();
		}
		if(NetTotalIncomeNew != 0){
			NetTotalIncomeNew = Number(NetTotalIncomeNew).toFixed();
		}*/

		let NetTotalIncomeOld = Number(GrossTotalIncomeOld) - Number(TotalDeductionUnderChapVIAOld);
		if (!isNaN(NetTotalIncomeOld) && NetTotalIncomeOld !== 0) {
			//NetTotalIncomeOld = Math.round(Number(NetTotalIncomeOld));
		}

		let NetTotalIncomeNew = Number(GrossTotalIncomeNew) - Number(TotalDeductionUnderChapVIANew);
		if (!isNaN(NetTotalIncomeNew) && NetTotalIncomeNew !== 0) {
			//NetTotalIncomeNew = Math.round(Number(NetTotalIncomeNew));
		}

		/////  Old Regime Tax Calculation ///////

		/*var TaxOnSalaryIncomeOld = 0;
		if(NetTotalIncomeOld <= 250000){
			$TaxOnSalaryIncomeOld = 0;
		}else if(NetTotalIncomeOld <= 500000){
			$TaxOnSalaryIncomeOld = (NetTotalIncomeOld - 250000) * 0.05;
		}else if($TaxOnSalaryIncomeOld <= 1000000){
			$TaxOnSalaryIncomeOld = (NetTotalIncomeOld - 500000) * 0.20 + 12500;
		}else{
			$TaxOnSalaryIncomeOld = (NetTotalIncomeOld - 1000000) * 0.30 + 112500;
		}*/ 

		let TaxOnSalaryIncomeOld = 0;
		// Slab 1: 0 – 2,50,000 (No tax)
		if(NetTotalIncomeOld > 250000) {
			TaxOnSalaryIncomeOld += 0;
		}

		// Slab 2: 2,50,001 – 5,00,000 (5%)
		if(NetTotalIncomeOld > 250000) {
			let slabAmount = Math.min(NetTotalIncomeOld, 500000) - 250000;
			TaxOnSalaryIncomeOld += slabAmount * 0.05;
		}

		// Slab 3: 5,00,001 – 10,00,000 (20%)
		if(NetTotalIncomeOld > 500000) {
			let slabAmount = Math.min(NetTotalIncomeOld, 1000000) - 500000;
			TaxOnSalaryIncomeOld += slabAmount * 0.20;
		}

		// Slab 4: Above 10,00,000 (30%)
		if(NetTotalIncomeOld > 1000000) {
			let slabAmount = NetTotalIncomeOld - 1000000;
			TaxOnSalaryIncomeOld += slabAmount * 0.30;
		}
		let LessRebateUnderUS87AOld = NetTotalIncomeOld > 500000 ? 0 : TaxOnSalaryIncomeOld;
		let TaxPayableAfterRebateOld = TaxOnSalaryIncomeOld - LessRebateUnderUS87AOld;
		let AddSurChargeOld = (NetTotalIncomeOld <= 5000000) ? 0 : (TaxPayableAfterRebateOld * 0.10);
		let HealthEduCessOld = ((AddSurChargeOld + TaxPayableAfterRebateOld) * 0.04);//Math.round((AddSurChargeOld + TaxPayableAfterRebateOld) * 0.04);
		let TaxPlusCessSurchargeOld = (TaxPayableAfterRebateOld + AddSurChargeOld + HealthEduCessOld);//Math.round(TaxPayableAfterRebateOld + AddSurChargeOld + HealthEduCessOld);
		let TaxAlreadyPaid = $("#txt_tax_paid_master").val();
		if(TaxAlreadyPaid == ''){
			TaxAlreadyPaid = 0;
		}
		let BalanceTaxToBePaidOld = (TaxPlusCessSurchargeOld - TaxAlreadyPaid);//Math.round(TaxPlusCessSurchargeOld - TaxAlreadyPaid);
		$("#txt_taxable_sal_income").val(NetTotalIncomeOld);
		$("#txt_tax_on_sal_income").val(TaxOnSalaryIncomeOld);
		$("#txt_less_rebate_us_87a").val(LessRebateUnderUS87AOld);
		$("#txt_payable_after_rebate").val(TaxPayableAfterRebateOld);
		$("#txt_add_surcharge").val(AddSurChargeOld);
		$("#txt_health_edu_cess").val(HealthEduCessOld);
		$("#txt_tax_plus_cess").val(TaxPlusCessSurchargeOld);
		$("#txt_less_tax_paid").val(TaxAlreadyPaid);
		$("#txt_bal_to_be_paid").val(BalanceTaxToBePaidOld);


		/// New Tax Regime

		let TaxOnSalaryIncomeNew = 0;

		// Slab 1: 0 – 4,00,000 (0%)
		if (NetTotalIncomeNew > 400000) {
			TaxOnSalaryIncomeNew += 0;
		}

		// Slab 2: 4,00,001 – 8,00,000 (5%)
		if (NetTotalIncomeNew > 400000) {
			let slabAmount = Math.min(NetTotalIncomeNew, 800000) - 400000;
			TaxOnSalaryIncomeNew += slabAmount * 0.05;
		}

		// Slab 3: 8,00,001 – 12,00,000 (10%)
		if (NetTotalIncomeNew > 800000) {
			let slabAmount = Math.min(NetTotalIncomeNew, 1200000) - 800000;
			TaxOnSalaryIncomeNew += slabAmount * 0.10;
		}

		// Slab 4: 12,00,001 – 16,00,000 (15%)
		if (NetTotalIncomeNew > 1200000) {
			let slabAmount = Math.min(NetTotalIncomeNew, 1600000) - 1200000;
			TaxOnSalaryIncomeNew += slabAmount * 0.15;
		}

		// Slab 5: 16,00,001 – 20,00,000 (20%)
		if (NetTotalIncomeNew > 1600000) {
			let slabAmount = Math.min(NetTotalIncomeNew, 2000000) - 1600000;
			TaxOnSalaryIncomeNew += slabAmount * 0.20;
		}

		// Slab 6: 20,00,001 – 24,00,000 (25%)
		if (NetTotalIncomeNew > 2000000) {
			let slabAmount = Math.min(NetTotalIncomeNew, 2400000) - 2000000;
			TaxOnSalaryIncomeNew += slabAmount * 0.25;
		}

		// Slab 7: Above 24,00,000 (30%)
		if (NetTotalIncomeNew > 2400000) {
			let slabAmount = NetTotalIncomeNew - 2400000;
			TaxOnSalaryIncomeNew += slabAmount * 0.30;
		}

		let LessRebateUnderUS87ANew = NetTotalIncomeNew > 1200000 ? 0 : TaxOnSalaryIncomeNew;
		let TaxPayableAfterRebateNew = TaxOnSalaryIncomeNew - LessRebateUnderUS87ANew;
		let AddSurChargeNew = (NetTotalIncomeNew <= 5000000) ? 0 : (TaxPayableAfterRebateNew * 0.10);
		let HealthEduCessNew = ((AddSurChargeNew + TaxPayableAfterRebateNew) * 0.04);//Math.round((AddSurChargeNew + TaxPayableAfterRebateNew) * 0.04);
		let TaxPlusCessSurchargeNew = (TaxPayableAfterRebateNew + AddSurChargeNew + HealthEduCessNew);//Math.round(TaxPayableAfterRebateNew + AddSurChargeNew + HealthEduCessNew);
	
		let BalanceTaxToBePaidNew = (TaxPlusCessSurchargeNew - TaxAlreadyPaid);//Math.round(TaxPlusCessSurchargeNew - TaxAlreadyPaid);
		$("#txt_taxable_sal_income_new").val(NetTotalIncomeNew);
		$("#txt_tax_on_sal_income_new").val(TaxOnSalaryIncomeNew);
		$("#txt_less_rebate_us_87a_new").val(LessRebateUnderUS87ANew);
		$("#txt_payable_after_rebate_new").val(TaxPayableAfterRebateNew);
		$("#txt_add_surcharge_new").val(AddSurChargeNew);
		$("#txt_health_edu_cess_new").val(HealthEduCessNew);
		$("#txt_tax_plus_cess_new").val(TaxPlusCessSurchargeNew);
		$("#txt_less_tax_paid_new").val(TaxAlreadyPaid);
		$("#txt_bal_to_be_paid_new").val(BalanceTaxToBePaidNew);

	});

</script>
@endsection
