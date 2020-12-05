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
                        echo '            <span data-tooltip="tooltip" data-placement="top" title="" data-original-title="Edit Project Menu"><a class="icon-green" href="javascript:get_form_project_menu('. $formProject["id"] .')"><i class="fe fe-menu"></i></a></span>';
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
                            <div class="form-group" id="project-auth-type-group">
                                <label for="form_type">Select Authentication Type:</label>
                                <select class="form-control" id="project-auth-type" name="form_type">
                                    <option value="" selected="selected" disabled="">Select an option</option>
                                    <option value="With Auth Google Drive API">With Auth Google Drive API</option> 
                                    <!-- <option value="With Auth Google Drive API and Identifier">With Auth Google Drive API and Identifier</option> -->
                                    <option value="Without Auth Google Drive">Without Auth Google Drive</option>
                                </select>
                            </div> 
                            <div class="form-group form-alert">
                                <label class="form-label" >Upload OAuth</label>
                                <input type="file" value="" class="form-control input-md" name="oauth" id="oauth" accept="application/JSON">
                                <button type="button" class="form-control mt-1 btn btn-outline-info" onclick="window.open('https://console.developers.google.com', '_blank'); return false;">Get OAuth</button>
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
                    <!-- {{-- <a id="loggin" class='login' href="{{route('formProject.index')}}" target='popup' onclick=window.open(this.href,'popup','width=600,height=600'); return false;>Loggin</a> --}}
                    {{-- <button type="button" onclick="getOAuth()"><a id="loggin" href="{{route('formproject.getToken')}}" onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=600'); return false;" >Loggin</a></button> --}} -->
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
                            <div class="form-group" id="project-auth-type-group-edit">
                                <label for="project-auth-type-edit">Select Authentication Type:</label>
                                <select class="form-control" id="project-auth-type-edit" name="form_type_edit">
                                    <option value="" selected="selected" disabled="">Select an option</option>
                                    <option value="With Auth Google Drive API" >With Auth Google Drive API</option>
                                    <!-- <option value="With Auth Google Drive API and Identifier" >With Auth Google Drive API and Identifier</option> -->
                                    <option value="Without Auth Google Drive" >Without Auth Google Drive</option>
                                </select>
                            </div> 
                            <div class="form-group form-alert">
                                <label class="form-label" >Upload OAuth</label>
                                <input type="file" class="form-control input-md" name="oauth_edit" id="oauth_edit" accept="application/JSON">
                                <button type="button" class="form-control mt-1 btn btn-outline-info" onclick="window.open('https://console.developers.google.com', '_blank'); return false;">Get OAuth</button>
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

<!-- Modal Edit Project Menu-->
<div class="modal fade" id="editFormProjectMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header-blue">
                <h2 class="modal-title" id="largeModalLabel" style="color:white">Edit Project Menu</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:white">&times;</span>
                </button>
            </div>
            <form id="updateProjectMenu" enctype="multipart/form-data" action="" method="PUT">
                <div class="col-md-12 mt-2">
                    <table id="example" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Menu Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="project-menu">
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="update_project_menu()" class="btn btn-green-gradient">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#project-auth-type, #project-auth-type-edit').change(function() {
        $('#json-identifier-upload').remove();
        $('#swal2-validation-message').remove();
        if($('#project-auth-type').val() == 'With Auth Google Drive API and Identifier'){
            $('#project-auth-type-group').append('\
                <input id="json-identifier-upload" type="file" name="json_identifier"\
                aria-label="Upload your profile picture" class="swal2-file" \
                style="display: flex;" placeholder="">'
            );
        }else if($('#project-auth-type-edit').val() == 'With Auth Google Drive API and Identifier'){
            $('#project-auth-type-group-edit').append('\
                <input id="json-identifier-upload" type="file" name="json_identifier"\
                aria-label="Upload your profile picture" class="swal2-file" \
                style="display: flex;" placeholder="">'
            );
        }
    });

    
    function getOAuth(formId){
        if(formId == 'create'){
            var form = $("#formTambah").get(0);
        }else{
            var form = $("#updateProject").get(0); 
        }
		$.ajax({
			type: "POST", 
			url: "formProjects/getOAuth/",
			processData: false,
            contentType: false,
            cache: false, 
			data: new FormData(form), 
			success: function(data) {
                console.log(form)
                window.open("formProjects/callback/",'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=600'); return false;
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

    function get_form_project_menu(form_project_id){
        $.ajax({
            url: "formProjects/getMenu/" + form_project_id ,
            method: "GET",
			dataType: 'json',
			success: function(data){
                $('#project-menu').children().remove();
                Object.keys(data.formProject).forEach(function(key, index) {
                    $('#project-menu').append('<tr class="menu"><td>'+data.formProject[key].form_title+'</td>\
                    <td><center><span class="up" data-tooltip="tooltip" data-placement="top" title="" data-original-title="View Data Form"><button type="button" class="up-button"><i class="fe fe fe-arrow-up"></i></button></span>\
                    <span class="down" data-tooltip="tooltip" data-placement="top" title="" data-original-title="View Data Form"><button type="button" value="down" class="down-button"><i class="fe fe fe-arrow-down"></i></button></span>\
                    <input type="hidden" id="form_menu_index" name="form_menu_index[]" value="'+data.formProject[key].form_menu_index+'">\
                    <input type="hidden" id="form_menu_id" name="form_menu_id[]" value="'+data.formProject[key].id+'"></center></td></tr>');
                });
                
                if(data.formProject.length == 0) alert("Create Form First!");
                                    
                $('.menu:first').find('.up').remove();
                $('.menu:last').find('.down').remove();
                
                $('#project-menu').delegate('.up-button','click',function(e){
                    e.stopImmediatePropagation();
                    $(this).parents('.menu').find('input#form_menu_index').val(parseInt($(this).parents('.menu').find('input#form_menu_index').val()) - parseInt(1));
                    $(this).parents('.menu').prev().find('input#form_menu_index').val(parseInt($(this).parents('.menu').prev().find('input#form_menu_index').val()) + parseInt(1));
                    $(this).parents('.menu').insertBefore($(this).parents('.menu').prev());

                    if($(this).parents('.menu').next().find('.up').length == 0) $(this).parents('.menu').next().find("center").prepend('<span class="up" data-tooltip="tooltip" data-placement="top" title="" data-original-title="View Data Form"><button type="button" class="up-button"><i class="fe fe fe-arrow-up"></i></button></span>');
                    if($(this).parents('.menu').find('.down').length == 0) $(this).parents('.menu').find('input#form_menu_index').after('<span class="down" data-tooltip="tooltip" data-placement="top" title="" data-original-title="View Data Form"><button type="button" value="down" class="down-button"><i class="fe fe fe-arrow-down"></i></button></span>');

                    if($(this).parents('.menu').next().find('input#form_menu_index').val() == $('.menu').length) $(this).parents('.menu').next().find('.down').remove();
                    if($(this).parents('.menu').find('input#form_menu_index').val() == 1) $(this).parents('.menu').find('.up').remove();
                                        
                });

                $('#project-menu').delegate('.down-button','click',function(e){
                    e.stopImmediatePropagation();
                    $(this).parents('.menu').find('input#form_menu_index').val(parseInt($(this).parents('.menu').find('input#form_menu_index').val()) + parseInt(1));
                    $(this).parents('.menu').next().find('input#form_menu_index').val(parseInt($(this).parents('.menu').next().find('input#form_menu_index').val()) - parseInt(1));
                    $(this).parents('.menu').insertAfter($(this).parents('.menu').next());

                    if($(this).parents('.menu').find('.up').length == 0) $(this).parents('.menu').find("center").prepend('<span class="up" data-tooltip="tooltip" data-placement="top" title="" data-original-title="View Data Form"><button type="button" class="up-button"><i class="fe fe fe-arrow-up"></i></button></span>');
                    if($(this).parents('.menu').prev().find('.down').length == 0) $(this).parents('.menu').prev().find('input#form_menu_index').after('<span class="down" data-tooltip="tooltip" data-placement="top" title="" data-original-title="View Data Form"><button type="button" value="down" class="down-button"><i class="fe fe fe-arrow-down"></i></button></span>');
                    
                    if($(this).parents('.menu').prev().find('input#form_menu_index').val() == 1) $(this).parents('.menu').prev().find('.up').remove();
                    if($(this).parents('.menu').find('input#form_menu_index').val() == $('.menu').length) $(this).parents('.menu').find('.down').remove();                    

                });
                $('#editFormProjectMenu').modal('show');
            },
            error: function(data){
                // data_token = jQuery.parseJSON(data);
                console.log("asdsad", data)
            }
        });
    }
    function update_project_menu(){
        swal.fire({
        title: "Update "+$('#name_update').val()+"?",
        type: "warning",
        html: '<p>Do you will to update this project?</p>',
        showCancelButton: true,
        confirmButtonText: "Update",
        showLoaderOnConfirm: true,
        preConfirm: (login) => {  
            var form = $("#updateProjectMenu").get(0)
            return $.ajax({
                type: "POST", 
                url: "forms/updateProjectMenu/",
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
                // console.log(data[0])
                // console.log(data[])
                // data_token = jQuery.parseJSON(data.data_token);
                $('#form_project_id').val(data.formProject.id);
                $('#nama_project_edit').val(data.formProject.nama_project);
                $('#name_update').val(data.formProject.nama_project);
                $('#project-auth-type-edit').val(data.formProject.project_auth_type).change();
				$('#access_token_edit').val(data.formProject.access_token);
                $('#expires_in_edit').val(data.formProject.expires_in);
                $('#refresh_token_edit').val(data.formProject.refresh_token);
                $('#scope_edit').val(data.formProject.scope);
                $('#token_type_edit').val(data.formProject.token_type);
                $('#created_edit').val(data.formProject.created);
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
            var form = $("#updateProject").get(0);
            form_project_id = $('#form_project_id').val();
            link = "{{route('formproject.update', ':id')}}";
            link = link.replace(':id', form_project_id);
            return $.ajax({
                type: "POST", 
                url: "formProjects/update/" + form_project_id ,
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
                window.location.reload();
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