<title>Form Project</title>
<div class="container">
    <div class="row">
        <div class="col-md-12">	
            <h2 class="text-center">Form Project</h2>
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Project Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    foreach ($formProjects as $number => $formProject){
                        echo '<tr>';    
                        echo '    <td>'.++$number.'</td>';
                        echo '    <td>'.$formProject['nama_project'].'</td>';
                        echo '    <td>';
                        echo '        <center>';
                        echo '            <span data-tooltip="tooltip" data-placement="top" title="" data-original-title="View Data Form"><a class="icon-green" href="forms/showAllForms/'. $formProject["id"] .'"><i class="fe fe fe-eye"></i></a></span>';                                
                        echo '            <span data-tooltip="tooltip" data-placement="top" title="" data-original-title="Edit Project"><a class="icon-green" href="javascript:get_form_project('. $formProject["id"] .')"><i class="fe fe-edit"></i></a></span>';
                        echo '           <span data-tooltip="tooltip" data-placement="top" title="" data-original-title="Delete Project"><a class="icon-red" href="javascript:delete_form_project('. $formProject["id"] .', '."'$formProject[nama_project]'".')"><i class="fe fe-trash-2"></i></a></span>';
                        echo '        </center>';
                        echo '    </td>';
                        echo '</tr>';
                    }
                ?>
                </tbody>
            </table>
            <button type="button" class="float btn btn-icon btn-add btn-info mt-1 mb-1" data-toggle="modal" data-target="#createFormProject" data-tooltip="tooltip" data-placement="left" title="" data-original-title="Create New Project">
                <span class="btn-inner--icon"><i class="fe fe-plus"></i></span>
            </button>
        </div>
    </div>
</div>

<!-- Modal Create Form Project-->
<div class="modal fade" id="createFormProject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header-blue">
                <h2 class="modal-title" id="largeModalLabel" style="color:white">Create New Project</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:white">&times;</span>
                </button>
            </div>
            <form id="formTambah" enctype="multipart/form-data" action="" method="POST">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">  
                            <div class="form-group">
                                <label class="form-label" >Project Name</label>
                                <input type="text" class="form-control" id="nama_project" name="nama_project" placeholder="Ex. Form Mahasiswa" >
                            </div>
                            <div class="form-group form-alert">
                                <label class="form-label" >Upload OAuth</label>
                                <input type="file" value="" class="form-control input-md" name="oauth" id="oauth" accept="application/JSON">
                            </div> 
                            <div class="form-group">
                                <label for="usr">access_token:</label>
                                <input type="text" class="form-control" id="access_token" name="access_token" value="" readonly>
                            </div>
                            <div class="form-group">
                                <label for="usr">expires_in:</label>
                                <input type="text" class="form-control" id="expires_in" name="expires_in" value="" readonly>
                            </div>
                            <div class="form-group">
                                <label for="usr">refresh_token:</label>
                                <input type="text" class="form-control" id="refresh_token" name="refresh_token" value="" readonly>
                            </div>
                            <div class="form-group">
                                <label for="usr">scope:</label>
                                <input type="text" class="form-control" id="scope" name="scope" value="" readonly>
                            </div>
                            <div class="form-group">
                                <label for="usr">token_type:</label>
                                <input type="text" class="form-control" id="token_type" name="token_type" value="" readonly>
                            </div>
                            <div class="form-group">
                                <label for="usr">created:</label>
                                <input type="text" class="form-control" id="created" name="created" value="" readonly>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <a id="loggin" class='login' href="{{route('formProject.index')}}" target='popup' onclick=window.open(this.href,'popup','width=600,height=600'); return false;>Loggin</a> --}}
                    {{-- <button type="button" onclick="getOAuth()"><a id="loggin" href="{{route('formproject.getToken')}}" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=600'); return false;" >Loggin</a></button> --}}
                    <button type="button" class="btn btn-blue-gradient" onclick="getOAuth('create')">Get Access Token</button>
                    <button type="button" class="btn btn-blue-gradient" data-dismiss="modal">Close</button>
                    <button type="button" onclick="tambah_data_form_project()" class="btn btn-green-gradient">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Form Project-->
<div class="modal fade" id="editFormProject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header-blue">
                    <h2 class="modal-title" id="largeModalLabel" style="color:white">Edit Project</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color:white">&times;</span>
                    </button>
                </div>
                <form id="updateProject" enctype="multipart/form-data" action="" method="PUT">
                    <input type="hidden" value="" name="form_project_id" id="form_project_id">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group form-alert">
                                    <label class="form-label" >Project Name</label>
                                    <input type="text" class="form-control" id="nama_project_edit" name="nama_project_edit" placeholder="Ex. Form Mahasiswa" >
                                </div>   
                                <div class="form-group form-alert">
                                    <label class="form-label" >Upload OAuth</label>
                                    <input type="file" value="" class="form-control input-md" name="oauth_edit" id="oauth_edit" accept="application/JSON">
                                </div> 
                                <div class="form-group">
                                    <label for="usr">access_token:</label>
                                    <input type="text" class="form-control" id="access_token_edit" name="access_token_edit" value="" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="usr">expires_in:</label>
                                    <input type="text" class="form-control" id="expires_in_edit" name="expires_in_edit" value="" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="usr">refresh_token:</label>
                                    <input type="text" class="form-control" id="refresh_token_edit" name="refresh_token_edit" value="" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="usr">scope:</label>
                                    <input type="text" class="form-control" id="scope_edit" name="scope_edit" value="" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="usr">token_type:</label>
                                    <input type="text" class="form-control" id="token_type_edit" name="token_type_edit" value="" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="usr">created:</label>
                                    <input type="text" class="form-control" id="created_edit" name="created_edit" value="" readonly>
                                </div>                          
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="name_update" name="name_update">
                        <button type="button" class="btn btn-blue-gradient" onclick="getOAuth('update')">Update Access Token</button>
                        <button type="button" class="btn btn-blue-gradient" data-dismiss="modal">Close</button>
                        <button type="button" onclick="update_form_project('{{$formproject->nama_project}}')" class="btn btn-green-gradient">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script>
    function getOAuth(formId){
        if(formId == 'create'){
            var form = $("#formTambah").get(0);
        }else{
            var form = $("#updateProject").get(0); 
        }
		$.ajax({
			type: "POST", 
			url: "{{route('formproject.getOAuth')}}",
			processData: false,
            contentType: false,
            cache: false, 
			data: new FormData(form), 
			success: function(data) {
                window.open("{{route('formproject.getToken')}}",'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=600'); return false;
			},
            error: function(xhr, status, error){
            }
		}); 
	}

    
    //create form project
	function tambah_data_form_project(){
        var form = $("#formTambah").get(0)
        console.log("test update ", form)
        swal.fire({
        title: "Create Project",
        text: "Add new data project? ",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Save",
        showLoaderOnConfirm: true,
        preConfirm: (login) => {  
            var form = $("#formTambah").get(0)
            return $.ajax({
                type: "POST", 
                url: "formProjects/create/",
                processData: false,
                contentType: false,
                cache: false,
                data: new FormData(form), 
                success: function(data) {
                var request = 'success';
                },
                error: function(xhr, status, error){
                    swal.fire({title:"Create Project Error!", text: xhr.responseText, type:"error"});
                    console.log(xhr)
                }
            });
        }                       
        }).then((result) => {
        console.log("sadsa ", result.value)
            if(result.value){
            swal.fire({title:"New Project Data Added", text:"Successfuly add new Project data!", type:"success"})
            .then(function(){ 
                window.location.reload();
            });
            }
        })

	}

    // get edit form project
    function get_form_project(form_project_id){
        $.ajax({
            url: "formProjects/edit/" + form_project_id ,
            method: "GET",
			dataType: 'json',
			success: function(data){
                console.log(data.formProject.id)
                // console.log(data[0])
                // console.log(data[])
                // data_token = jQuery.parseJSON(data.data_token);
                $('#form_project_id').val(data.formProject.id);
                $('#nama_project_edit').val(data.formProject.nama_project);
                // $('#name_update').val(data.data_project.nama_project);
				// $('#access_token_edit').val(data_token.access_token);
                // $('#expires_in_edit').val(data_token.expires_in);
                // $('#refresh_token_edit').val(data_token.refresh_token);
                // $('#scope_edit').val(data_token.scope);
                // $('#token_type_edit').val(data_token.token_type);
                // $('#created_edit').val(data_token.created);
				$('#editFormProject').modal('show');
            },
            error: function(data){
                // data_token = jQuery.parseJSON(data);
                console.log("asdsad", data)
            }
        });
        
    }
    function update_form_project(){
        var form = $("#updateProject").get(0);
        swal.fire({
        title: "Update "+$('#name_update').val()+"?",
        type: "warning",
        html: '<p>Do you will to update this project?</p>',
        showCancelButton: true,
        confirmButtonText: "Update",
        showLoaderOnConfirm: true,
        preConfirm: (login) => {  
            $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
            });
            var form = $("#updateProject").get(0);
            form_project_id = $('#form_project_id').val();
            link = "{{route('formproject.update', ':id')}}";
            link = link.replace(':id', form_project_id);
            return $.ajax({
                type: "POST", 
                url: link ,
                processData: false,
                contentType: false,
                cache: false,
                data: new FormData(form), 
                success: function(data) {
                    
                },
                error: function(data){
                    swal.fire({title:"Project failed Update!", text:"This project failed to updated", type:"error"});
                }
            }); 
                          
        }          
        }).then((result) => {
            if(result.value){
            swal.fire({title:"Update Project Success!", text:"Successfully updated this project", type:"success"})
            .then(function(){ 
                window.location.href = "{{ url('/')}}";
            });
            }
        })
    }
    

    //delete data

    function delete_form_project(form_project_id, nama_project){
		swal.fire({
			title: "Delete "+nama_project+"?",
			text: ""+nama_project+" will deleted on your project list!",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-danger",
			confirmButtonText: "Hapus",
            closeOnConfirm: true,
            preConfirm: (login) => {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                return $.ajax({
                    type: "DELETE", 
                    url: 'formProjects/delete/'+form_project_id,
                    datatype : "json", 
                    data:{id:form_project_id},
                    success: function(data) {
                    
                    },
                    error: function(data){
                        swal.fire({title:"Form Failed to Deleted!", text:"This project was not deleted successfully", type:"error"});
                    }
                }); 
            } 
		}).then((result) => {
            if(result.value){
                swal.fire({title:"Project Deleted!", text:"This form has been deleted on your project list", type:"success"})
                .then(function(){ 
                    window.location.reload();
                });
            }
        })
    }

</script>