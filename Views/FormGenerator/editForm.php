<title>Form Generator</title>
<div class="container">
  <div class="clearfix">
    <div class="row">
      <div class="col-md-4 add-field">
        <div class="add-field-bg">
          <div class="clearfix">
            <h4 class="border-add-field">Add Field</h4>
            <div class="row">
            <div class="col-md-6">
                <form class="form-horizontal" id="components">
                  <fieldset>
                    <div id="text-input" class="form-group component input-field">
                      <!-- Text input-->
                      <div class="input-type" for="input01" data-valtype='label'><span class="fa fa-font"></span> Text input</div>
                    </div>
                    <div id="number" class="form-group component input-field">
                      <div class="input-type"  data-valtype="label"><strong>#</strong> Number</div>
                    </div>
                    <div id="checkboxes" class="form-group component input-field">
                      <div class="input-type"  data-valtype="label"><span class="fa fa-check-square-o"></span> Checkboxes</div>
                    </div>

                    <div id="radio-buttons" class="form-group component input-field">
                      <div class="input-type"  data-valtype="label"><span class="fa fa-circle-o"></span> Radio buttons</div>
                    </div>
                    <div id="select-basic" class="form-group component input-field">
                      <div class="input-type"  data-valtype="label"><span class="fa fa-list-ul"></span> Select Basic</div>
                    </div>
                    <div id="file-upload" class="form-group component input-field">
                      <div class="input-type"  for="input01" data-valtype='label'><span class="fa fa-upload"></span> File Upload</div>
                    </div>
                  </fieldset>
                </form>
              </div>
              <div class="col-md-6">
                <form class="form-horizontal" id="components">
                  <fieldset>
                    <div id="table-modal" class="form-group component input-field">
                      <div class="input-type"  for="input01" data-valtype='label'><span class="fa fa-list-alt" aria-hidden="true"></span> Table Modal</div>
                    </div>
                    <div id="date" class="form-group component input-field">
                      <div class="input-type"  data-valtype="label"><span class="fa fa-calendar"></span> Date</div>
                    </div>
                    <div id="time" class="form-group component input-field">
                      <div class="input-type"  data-valtype="label"><span class="fa fa-clock-o"></span> Time</div>
                    </div>
                    <div id="date-time" class="form-group component input-field">
                      <div class="input-type"  data-valtype="label"><span class="fa fa-calendar-clock-o"></span> Date Time</div>
                    </div>
                    <div id="button" class="form-group component input-field">
                      <div class="input-type"  for="input01" data-valtype='label'>Button</div>
                    </div>
                  </fieldset>
                </form>
              </div>
            </div>
          </div>
        </div>      
      </div>
      <!-- row -->
      <div class="col-md-8" style="position: static;/*! width: 100%; */">
        <div id="target">
          <div class="clearfix">
              <div id="build">
                    <?php echo $form['form_export']; ?>
              </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /container -->
  </div>
</div>

<div class="float-action-form">
  <div class="container item-right">
        <button type="button" onclick="update_form()" class="btn btn-info">Update</button>
  </div>
</div>

<script>
  add_class_input_form();
  var form_name = '<?php echo $form['form_name'];?>';
  // update data form project
  function update_form(){
    swal.fire({
      title: "Update Form?",
      type: "warning",
      html: '<p>Do you want to update the form?</p>\
              <form id="tambahFormOption" action="" method="POST" enctype="multipart/form-data">\
                <input type="hidden" value="<?php echo $form['id']; ?>" name="form_id" id="form_id">\
                <input type="hidden" value="" name="form_title" id="form_title">\
                <input type="hidden" value="" name="form_name" id="form_name">\
                <input type="hidden" value="" name="convert_php" id="convert_php">\
                <input type="hidden" value="" name="attr_form" id="attr_form">\
             </form>',
      showCancelButton: true,
      confirmButtonText: "Update",
      showLoaderOnConfirm: true,
      onOpen: function() {
        getTitle();
        getFormName();
        getTitle();
        getAttr();
        genPHP();        
      },
      preConfirm: (login) => {  
        let selected = $('#form-type :selected').val() !== '';
        var form = $("#tambahFormOption").get(0);
        console.log("tesss ", form)

        // form_id = $('#form_id').val();
        // link = ;
        // link = link.replace(':id', form_id);
        return $.ajax({
            type: "POST", 
            url: "/formgeneratornative/formGenerator/update/"+$('#form_id').val() ,
            processData: false,
            contentType: false,
            cache: false,
            // data: $("#tambahForm, #tambahFormOption").serialize(), 
            data: new FormData(form), 
            success: function(data) {
                // swal.fire({title:"Data Project Di Ubah!", text:"Form Project berhasil di Ubah", type:"success"})
                // .then(function(){ 
                //     window.location.href = "{{ url('/form', $form->form_projects_id)}}";
                // });
                // $('.confirm').addClass('sweet-alert-success');
            },
            error: function(data){
                swal.fire({title:"Form Project Gagal Di Ubah!", text:"Form Project gagal di Ubah", type:"error"});
            }
        });               
      }          
    }).then((result) => {
      console.log(result)
        if(result.value){
          swal.fire({title:"Update Form Success!", text:"Update form success running", type:"success"})
          .then(function(){ 
            window.location.href = '/formgeneratornative/forms/showAllForms/'+<?php echo $form['form_projects_id'] ?>;
          });
        }
      })
    }
</script>
