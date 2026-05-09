@extends('layouts.dashboard-master')
@section('content')
<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
        <div class="content">
            <div class="title">10 CA Index Assign</div>
            <div class="container_12">
                <div class="grid_12">
                    <blockquote class="bq1" style="overflow:auto">
                        <form name="form" method="post" action="">
						 	<div class="container">
								<div>&nbsp;</div>
								<table width="100%"  bgcolor="#E8E8E8" border="0" cellpadding="0" cellspacing="0" align="center" class="table1" id="IndexAssign">
									<tr class="hRow">
										<td>YEAR</td>
										<td>DESCRIPTION</td>
										<td>JAN</td>
										<td>FEB</td>
										<td>MAR</td>
										<td>APR</td>
										<td>MAY</td>
										<td>JUN</td>
										<td>JUL</td>
										<td>AUG</td>
										<td>SEP</td>
										<td>OCT</td>
										<td>NOV</td>
										<td>DEC</td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td  class="labeldisplay">
											<select name="cmb_year0" id="cmb_year0" class="TextBoxDy">
												<option value="">----Select----</option>
												<!---option value="2021">2021</option>
												<option value="2022">2022</option-->
											</select>
										</td>
										<td  class="labeldisplay">
											<select name="cmb_description0" id="cmb_description0" class="TextBoxDy">
												<!---option value="">----Select----</option>
												<option value="1">Cement</option>
												<option value="2">Steel</option-->
											</select>
										</td>
										<td  class="labeldisplay" align="center"><input type="text" name="jan0" id="jan0" class="TextBoxDy" size="3px"></td>
										<td  class="labeldisplay"><input type="text" name="feb0" id="feb0"  class="TextBoxDy" size="3px"></td>
										<td  class="labeldisplay"><input type="text" name="mar0" id="mar0" class="TextBoxDy"  size="3px"></td>
										<td  class="labeldisplay"><input type="text" name="apr0" id="apr0" class="TextBoxDy" size="3px"></td>
										<td  class="labeldisplay"><input type="text" name="may0" id="may0" class="TextBoxDy" size="3px"></td>
										<td  class="labeldisplay"><input type="text" name="jun0" id="jun0" class="TextBoxDy" size="3px"></td>
										<td  class="labeldisplay"><input type="text" name="jul0" id="jul0" class="TextBoxDy" size="3px"></td>
										<td  class="labeldisplay"><input type="text" name="aug0" id="aug0"  class="TextBoxDy" size="3px"></td>
										<td  class="labeldisplay"><input type="text" name="sep0" id="sep0" class="TextBoxDy" size="3px"></td>
										<td  class="labeldisplay"><input type="text" name="oct0" id="oct0" class="TextBoxDy" size="3px"></td>
										<td  class="labeldisplay"><input type="text" name="nov0" id="nov0" class="TextBoxDy"  size="3px"></td>
										<td  class="labeldisplay"><input type="text" name="dec0" id="dec0"  class="TextBoxDy" size="3px"></td>
										<td align="center"><input type="button" class="buttonstyle" name="btn_add" id="btn_add" value=" + " /></td>
									</tr>
								</table>
								<div>&nbsp;</div>
								<div align="center">
									<input type="submit" data-type="submit" value=" Save " name="submit" id="submit"/>
								</div>
							</div>
                        </form>
                    </blockquote>
                </div>
            </div>
        </div>
	</body>
</html>
@endsection
