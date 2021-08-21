<title>Form</title>
<div class="container">
    <div class="row">
        <div class="col-md-12">	
            <h2 class="text-center">Sub Form <?php echo array_column($sub_forms, 'form_title')[0]; ?></h2>
            <form id="check-export-form">
                <table id="formTable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Sub Form Title</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            foreach ($sub_forms as $number => $sub_form){
                                if(isset($sub_form['sub_form_title'])){
                                    echo '<tr>';
                                    echo '    <td>'.++$number.'</td>';
                                    echo '    <td>'.$sub_form['sub_form_title'].'</td>';
                                    echo '    <td>';
                                    echo '        <center>';
                                    echo '            <span data-tooltip="tooltip" data-placement="top" title="" data-original-title="Preview Sub Form"><a class="icon-green" href="/formgeneratornative/subForms/previewSubForm/'.$sub_form[0].'"><i class="fe fe fe-eye"></i></a></span>';
                                    echo '            <span data-tooltip="tooltip" data-placement="top" title="" data-original-title="Edit Sub Form"><a class="icon-green" href="/formgeneratornative/subFormGenerator/editSubForm/'.$sub_form[0].'"><i class="fe fe-edit"></i></a></span>';
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
    function delete_sub_form(sub_form_id, sub_form_title){
        
		swal.fire({
			title: "Delete "+sub_form_title+"?",
			text: ""+sub_form_title+" will deleted on your sub form list!",
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
                    url: "/formgeneratornative/subForms/delete/"+ sub_form_id,
                    datatype : "json", 
                    data:{id:sub_form_id},
                    success: function(data) {
                        if(data=="success"){
                            swal.fire({title:"Sub Form Deleted!", text:"This form has been deleted on your sub form list", type:"success"})
                            .then(function(){ 
                                location.reload();
                            });
                        $('.confirm').addClass('sweet-alert-success');
                        }else{
                            swal.fire("Sub Form Failed to Deleted!", "This sub form was not deleted successfully", "error");		
                        }
                    }
                }); 
            } 
		})
    }


    $(document).ready(function() {
        $('#formTable').dataTable( {
            "dom": '<"row"<"top float-left col-sm-12 col-md-6"l><"top float-right col-sm-12 col-md-6"f>>rt<"row"<"bottom col-sm-12 col-md-5"i><"bottom col-sm-12 col-md-7"p>>',
            "columns": [
                { "width": "5%" },
                null,
                { "orderable": false, "width": "13%" }
            ]
        } );
    });
    
</script>