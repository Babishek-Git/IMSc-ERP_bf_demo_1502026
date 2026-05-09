@extends('layouts.dashboard-master')
@section('content') 
@include('layouts.partials.messages')
<link href="{!! url('assets/TreeView/jstree.style.min.css') !!}" type="text/css" rel="stylesheet" media="all">
<script src="{!! url('assets/TreeView/jstree.min.js') !!}"></script> 

<body class="page1" id="top" oncontextmenu="return false" onload="noBack();" onpageshow="if (event.persisted) noBack();" onUnload="">
    <form action="" method="post" enctype="multipart/form-data" name="form">
        @csrf 
        <div class="content">
            <div class="title"></div>
            <div class="container_12">
                <div class="grid_12">
                    <blockquote class="bq1" style="overflow:auto">
                        <div class="container">
                            <div class="row">
                                <div class="div2">&nbsp;</div>
                                <div class="div8 mbtable">
                                    <div class="row">
                                        <div class="div12" style="margin-top:0px;">
                                            <div class="row divhead" align="center">Role Mapping</div>
                                        </div>
                                    </div>
                                    <div class="card-body padding-1 ChartCard" id="CourseChart">
                                        <div class="divrowbox innerdiv pt-2">
                                            <div class="row smclearrow"></div>
                                            <div class="div3">
                                                <label for="fname">Role</label>
                                            </div>
                                            <div class="div6">
                                                <select name="role_type" id="role_type" style="width:100%;" class="textboxdisplay">
                                                    <option value="">---------- Select ----------</option>
                                                    @if(isset($data['RoleList']))
                                                    @foreach($data['RoleList'] as $key => $value)
                                                    <option value="{{$value->roleid}}">{{$value->role_name}}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="row smclearrow"></div>
                                            <div class="row">
                                                <div id="tree">
                                                    {!! $data['tree'] !!}
                                                </div>
                                                <!-- Add hidden input field to store selected modules -->
                                                <input type="hidden" name="selected_modules" id="selected_modules" value="">
                                            </div>
                                            <div class="row">
                                                <div class="div12" align="center">
                                                    <input type="submit" class="backbutton" name="btn_save" id="btn_save" value=" Save " />
                                                    <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                                                </div>
                                            </div>
                                            <div class="row smclearrow"></div>
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

	<script>
		$(document).ready(function () {
            $("#role_type").chosen();
			$('#tree').jstree({
				plugins: ["checkbox"],
				checkbox: {
					three_state: false
				}
			});

			$('#tree').on('changed.jstree', function (e, data) {
				var selectedNodes = data.instance.get_selected();
				var numericIds = [];
				for (var i = 0; i < selectedNodes.length; i++) {
					var nodeId = selectedNodes[i];
					var numericId = parseInt(nodeId.substring(3));
					numericIds.push(numericId);
				}
				$('#selected_modules').val(numericIds.join(','));
				data.instance.toggle_node(data.node);
			});

			$('#tree').on('check_node.jstree', function (e, data) {
				data.instance.open_node(data.node);
			});
			
			$('#tree').on('uncheck_node.jstree', function (e, data) {
				data.instance.close_node(data.node);
			});
            $('body').on("change", "#role_type" ,function(event){
                var selectedRoleName = $('#role_type').val();
                console.log(selectedRoleName);
                var treeInstance = $('#tree').jstree(true);
                    treeInstance.uncheck_all();
                $.ajax({
                    type: 'POST',
                    url: "{{ route('ajax.getModuleAccess') }}",
                    data: { '_token': '{{ csrf_token() }}', 'selectedRoleName': selectedRoleName},
                    dataType:'text',
                    success: function(moduleAccessText){ 
                        var moduleIds = moduleAccessText.split(',');
                        moduleIds.forEach(function (moduleId) {
                            moduleId = moduleId.trim();
                            treeInstance.check_node("j1_"+moduleId); 
                        });
                    }
                });
            });
		});
        var KillEvent = 0;
	$("body").on("click","#btn_save", function(event){
		if(KillEvent == 0){
			var RoleName   = $("#role_type").val();
			if(RoleName == ''){
				BootstrapDialog.alert("Please Select the Role Name");
				event.preventDefault();
				event.returnValue = false;
			}else{
				event.preventDefault();
				BootstrapDialog.confirm({
					title: 'Confirmation Message',
					message: 'Are you sure want to save Role & Menu  Mapping ?',
					closable: false, 
					draggable: false,
					btnCancelLabel: 'Cancel', 
					btnOKLabel: 'Ok', 
					callback: function(result) {
						if(result){
							KillEvent = 1;
							$("#btn_save").trigger( "click" );
						}else {
							KillEvent = 0;
						}
					}
				});
			}
		}
	});
	</script>



</body>

@endsection
