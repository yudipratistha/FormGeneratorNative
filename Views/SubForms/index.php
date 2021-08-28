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
                                    echo '            <span data-tooltip="tooltip" data-placement="top" title="" data-original-title="Delete Sub Form"><a class="icon-red" href="javascript:delete_sub_form('.$sub_form[0].', '."'$sub_form[sub_form_title]'".', '."'$sub_form[sub_form_name]'".')"><i class="fe fe-trash-2"></i></a></span>';
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

<script>

    //delete data
    function delete_sub_form(sub_form_id, sub_form_title, sub_form_name){
		swal.fire({
			title: "Delete "+sub_form_title+"?",
			text: "",
			type: "warning",
            html: '<p>'+sub_form_title+' will deleted on your sub form list!</p>\
              <form id="delete_sub_form" action="" method="POST" enctype="multipart/form-data">\
                <input type="hidden" value="<?php echo array_column($sub_forms, 'id')[0];?>" name="main_form_id" id="main_form_id">\
                <input type="hidden" value="" name="delete_main_form_sub_form" id="delete_main_form_sub_form">\
                <input type="hidden" value="" name="delete_main_form_attr_sub_form" id="delete_main_form_attr_sub_form">\
             </form>',
			showCancelButton: true,
			confirmButtonClass: "btn-danger",
			confirmButtonText: "Delete",
            // closeOnConfirm: true,
            showLoaderOnConfirm: true,
            onOpen: function() {
                deleteSubFormMainForm('<?php echo $sub_forms[0]["form_export"] ?>', sub_form_name, '<?php echo $sub_forms[0]["form_attr"] ?>');
            },
            preConfirm: (login) => {
                var form = $("#delete_sub_form").get(0);
                $.ajax({
                    type: "POST", 
                    url: "/formgeneratornative/subForms/delete/"+ sub_form_id,
                    processData: false,
                    contentType: false,
                    cache: false,
                    data:new FormData(form),
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