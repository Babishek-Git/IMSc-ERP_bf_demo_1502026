	
@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')

<body class="page1" id="top" oncontextmenu="return false"onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
	<form action="" method="post" enctype="multipart/form-data" name="form">
		<div class="content">
			<div class="title"></div>
			<div class="container_12">
				<div class="grid_12">
					<blockquote class="bq1" style="overflow:auto">
						<div class="container">
							<div class="row ">
								<div class="div12">
									<div class="table-box">
										<div class="row"><div class="div12" style="margin-top:0px;"><div class="row table-divhead" align="center">Physical Stock List</div></div></div>
										<div class="card-body padding-1 ChartCard" id="CourseChart">
											<div class="divrowbox innerdiv pt-2">					
												<div class="row smclearrow"></div>                                                                                											
												<table class="table-bordered table1" width="99%" align="center" id="dataTable">
                                                    <thead>
                                                        <tr class="note heading">
                                                            <th>S.No</th>
                                                            <th>Description</th>
                                                            <th>Indentification</th>
                                                            <th>Room Nos/Staff Members</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if(isset($data['grouped'][0]))
                                                            @foreach($data['grouped'][0] as $parent)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}</td>
                                                                    <td>
                                                                        {{ $parent->material_group_name }}

                                                                        @foreach($data['grouped'][$parent->material_group_id] ?? [] as $child)
                                                                            @php
                                                                                $parts = explode('*', $child->material_group_name);
                                                                            @endphp
                                                                            <tr>
                                                                                <td></td>
                                                                                <td style="padding-left:15px;">
                                                                                    {{ $parts[0] }}
                                                                                </td>
                                                                                <td>
                                                                                    {{ $parts[1] ?? '' }}
                                                                                </td>
                                                                                <td></td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>
											    </table>										
											</div>
										</div>	
									</div>									
								</div>	
							</div>                           
						</div>
					</blockquote>
				</div>
			</div>
		</div>
	</form>
</body>	

<script>

</script>
@endsection	