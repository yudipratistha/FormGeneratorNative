<title>Form</title>
<div class="container">
    <div class="row">
        <div class="col-md-12">	
            <h2 class="text-center">Sub Form <?php echo array_column($sub_forms, 'form_name')[0]; ?></h2>
            <form id="check-export-form">
                <table id="formTable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Sub Form</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        // print_r($forms );
                            foreach ($sub_forms as $number => $sub_form){
                                if(isset($sub_form['sub_form_title'])){
                                    echo '<tr>';
                                    echo '    <td>'.++$number.'</td>';
                                    echo '    <td>'.$sub_form['sub_form_title'].'</td>';
                                    echo '    <td>';
                                    echo '        <center>';
                                    echo '            <span data-tooltip="tooltip" data-placement="top" title="" data-original-title="Preview Sub Form"><a class="icon-green" href="/formgeneratornative/forms/previewSubForm/'.$sub_form[0].'"><i class="fe fe fe-eye"></i></a></span>';
                                    echo '            <span data-tooltip="tooltip" data-placement="top" title="" data-original-title="Edit Sub Form"><a class="icon-green" href="/formgeneratornative/formGenerator/editSubForm/'.$sub_form[0].'"><i class="fe fe-edit"></i></a></span>';
                                    echo '            <span data-tooltip="tooltip" data-placement="top" title="" data-original-title="Delete Sub Form"><a class="icon-red" href="javascript:delete_sub_form('.$sub_form[0].', '."'$sub_form[sub_form_title]'".')"><i class="fe fe-trash-2"></i></a></span>';
                                    echo '        </center>';
                                    echo '    </td>';
                                    echo '</tr>';  
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </form>
            <a href="/formgeneratornative/subFormGenerator/createSubForm/<?php echo array_column($sub_forms, 'id')[0];?>">
                <button  class="float btn btn-icon btn-add btn-info mt-1 mb-1" data-tooltip="tooltip" data-placement="left" title="" data-original-title="Build Sub Form">
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

    //delete data
    function delete_form(form_id, form_title){
        link = "{{route('form.destroy', ':id')}}";
        link = link.replace(':id', form_id);
        
		swal.fire({
			title: "Delete "+form_title+"?",
			text: ""+form_title+" will deleted on your form list!",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-danger",
			confirmButtonText: "Delete",
            closeOnConfirm: true,
            preConfirm: (login) => {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
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