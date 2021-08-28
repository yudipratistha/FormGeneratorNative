<title>Form</title>
<div class="container">
    <div class="row">
        <div class="col-md-12">	
            <h2 class="text-center">Form Project <?php echo array_column($forms, 'nama_project')[0]; ?></h2>

            <form id="check-export-form">
                <table id="formTable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th ><input name="select_all" value="1" id="select_all" type="checkbox"> Export</th>
                            <th>Form Name</th>
                            <th>Sub Form</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            foreach ($forms as $number => $form){
                                if(isset($form['form_title'])){
                                    echo '<tr>';
                                    echo '    <td>'.++$number.'</td>';
                                    echo '    <td><input name="checkform[]" value="'.$form[0].'" type="checkbox"> </td>';
                                    echo '    <td>'.$form['form_title'].'</td>';
                                    echo '    <td>';
                                    echo '        <center>';
                                    echo              $form['sub_forms_count'];
                                    echo '            <span data-tooltip="tooltip" data-placement="top" title="" data-original-title="Sub Form"><a class="icon-green" href="/formgeneratornative/subForms/showAllSubForms/'.$form[0].'"><i class="fe fe fe-eye"></i></a></span>';
                                    echo '        </center>';
                                    echo '    </td>';
                                    echo '    <td>';
                                    echo '        <center>';
                                    echo '            <span data-tooltip="tooltip" data-placement="top" title="" data-original-title="Preview Form"><a class="icon-green" href="/formgeneratornative/forms/previewForm/'.$form[0].'"><i class="fe fe fe-eye"></i></a></span>';
                                    echo '            <span data-tooltip="tooltip" data-placement="top" title="" data-original-title="Edit Form"><a class="icon-green" href="/formgeneratornative/formGenerator/editForm/'.$form[0].'"><i class="fe fe-edit"></i></a></span>';
                                    echo '            <span data-tooltip="tooltip" data-placement="top" title="" data-original-title="Delete Form"><a class="icon-red" href="javascript:delete_form('.$form[0].', '."'$form[form_title]'".')"><i class="fe fe-trash-2"></i></a></span>';
                                    echo '        </center>';
                                    echo '    </td>';
                                    echo '</tr>';  
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </form>
            <a href="/formgeneratornative/formGenerator/createForm/<?php echo array_column($forms, 'id')[0];?>">
                <button  class="float btn btn-icon btn-add btn-info mt-1 mb-1" data-tooltip="tooltip" data-placement="left" title="" data-original-title="Build Form">
                    <span class="btn-inner--icon"><i class="fe fe-plus"></i></span>
                </button>
            </a>
        </div>
    </div>
</div>
 <!-- Export Modal -->
<div class="modal" id="export-modal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Export Project</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>     
            <div class="modal-body">
                Export this project?
            </div>   
            <div class="modal-footer">
                <button id="btn-export" type="button" class="btn btn-danger" onClick="document.getElementById('check-export-form').submit();">Export</button>
            </div>  
        </div>
    </div>
</div> 
<script>
    $("#select_all").click(function(){
        $('input:checkbox').not(this).prop('checked', this.checked);
    });

    //export form
    function export_form(formProjName){
        exportid = $("#check-export-form").serialize();
        console.log(exportid)

        swal.fire({
            title: "Export Form?",
            text: "Do you want to export this project?",
            type: "warning",
            input: 'checkbox',
            inputValue: 0,
            inputPlaceholder: 'Export with SQL Dump',
            showCancelButton: true,
            Text: "Tambah",
            showLoaderOnConfirm: true,
            preConfirm: (inputCheckbox) => {
                return $.ajax({
                    type: "get",
                    url: '/formgeneratornative/forms/exportPhpProject/'+<?php echo array_column($forms, 'project_id')[0];?>+"?"+exportid,
                    data:{inputCheckbox:`${inputCheckbox}`},
                    // dataType: "zip",
                    xhrFields: {
                        responseType: 'blob'
                    },
                    success: function (data) {
                        var a = document.createElement('a');
                        var url = window.URL.createObjectURL(data);
                        a.href = url;
                        a.download = ""+formProjName.replace(/ /gi,'_')+".zip";
                        document.body.append(a);
                        a.click();
                        a.remove();
                        window.URL.revokeObjectURL(url);
                    },
                    error: function(data){
                        Swal.showValidationMessage(
                        `Request failed: ${error}`
                        )
                    }
                })
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.value) {
                Swal.fire({title:"Form Export Success!", text:"The form is ready to download", type:"success"})
            }
        })     
	}

    //delete data
    function delete_form(form_id, form_title){
        
		swal.fire({
			title: "Delete "+form_title+"?",
			text: ""+form_title+" will deleted on your form list!",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-danger",
			confirmButtonText: "Delete",
            closeOnConfirm: true,
            preConfirm: (login) => {
                $.ajax({
                    type: "DELETE", 
                    url: "/formgeneratornative/forms/delete/"+ form_id,
                    datatype : "json", 
                    data:{id:form_id},
                    success: function(data) {
                        console.log("test result ",data)
                        if(data=="success"){
                            swal.fire({title:"Form Deleted!", text:"This form has been deleted on your form list", type:"success"})
                            .then(function(){ 
                                location.reload();
                            });
                        $('.confirm').addClass('sweet-alert-success');
                        }else{
                            swal.fire("Form Failed to Deleted!", "This form was not deleted successfully", "error");		
                        }
                    }
                }); 
            } 
		})
    }

    //export to php file
    function exportPhp(form_projects_id){
        link = "{{route('form.exportPhpProject', ':id')}}";
        link = link.replace(':id', form_projects_id);
        alert(link);
		swal({
			title: "Export php",
			text: "Apakah ingin melakukan export php?",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-danger",
			confirmButtonText: "Export",
			closeOnConfirm: false
		}, function(){
		   $.ajax({
                type: "GET",
				url: '/formgeneratornative/forms/exportPhpProject/'+form_projects_id,
				datatype : "json", 
				data:{id:form_id},
				success: function(data) {
                        swal({title:"Export PHP", text:"Export PHP Sukses!", type:"success"},
                        function(){ 
                            location.reload();
                        }
                    );
                    $('.confirm').addClass('sweet-alert-success');
					
                },
                error: function(data){
            swal({title:"Export PHP", text:"Export PHP Gagal!", type:"error"});
        }
			 }); 
			
		});
    }

    $(document).ready(function() {
        $('#formTable').dataTable( {
            "dom": '<"row"<"top float-left col-sm-12 col-md-6"l><"top float-right col-sm-12 col-md-6"f>>rt<"row"<"bottom col-sm-12 col-md-5"i><"bottom col-sm-12 col-md-7"p>>',
            "columns": [
                { "width": "5%" },
                { "orderable": false, "width": "10%" },
                null,
                { "orderable": false, "width": "13%" },
                { "orderable": false, "width": "13%" }
            ]
        } );
        $("div.dataTables_length").append('  <span onclick="export_form(\'<?php echo array_column($forms, 'nama_project')[0]; ?>\')" class="btn btn-danger">Export to PHP</span>');
    });
    
</script>