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
        <div  id="target">
          <div class="clearfix">
              <div id="build">
                  <form class="form-border form-horizontal" method="POST" enctype="multipart/form-data">
                      <fieldset>
                          <div id="legend">
                              <legend>Untitled</legend>
                          </div>
                      </fieldset>
                  </form>
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
      <button type="button" onclick="create_sub_form()" class="btn btn-info">Save</button>
  </div>
</div>

<script>

  //create form project
	function create_sub_form(){
    swal.fire({
      title: "Create this sub form?",
      text: "Apakah ",
      type: "warning",
      html: '<form id="tambahForm" action="" method="POST" enctype="multipart/form-data">\
                <input type="hidden" value="" name="sub_form_title" id="form_title">\
                <input type="hidden" value="" name="sub_form_name" id="form_name">\
                <input type="hidden" value="" name="attr_form" id="attr_form">\
                <input type="hidden" value="" name="convert_php" id="convert_php">\
                <input type="hidden" value="<?php echo $form_id ?>" name="form_id" id="form_id">\
             </form>',
      showCancelButton: true,
      confirmButtonText: "Save",
      showLoaderOnConfirm: true,
      onOpen: function() {
        getTitle();
        getFormName();
        getTitle();
        getAttr();
        genPHP();
      },
      preConfirm: () => {  
        var form = $("#tambahForm").get(0);

        return $.ajax({
          type: "POST", 
          url: "/formgeneratornative/subFormGenerator/create/",
          processData: false,
          contentType: false,
          cache: false,
          data: new FormData(form), 
          success: function(data) {
            var request = 'success';
            value = 'true';
          },
            error: function(xhr, status, error){
                swal.fire({title:"New Form Data Failed Added!", text: xhr.responseText, type:"error"});
            }
        });       
      }          
    }).then((result) => {
      console.log(result)
      if(value){
        swal.fire({title:"New Form Data Added!", text:"Successfuly add new Form data!", type:"success"})
        .then(function(){ 
            window.location.href = '/formgeneratornative/subforms/showAllSubForms/'+<?php echo $form_id ?>;
        });
      }
    })
  }
  
</script>
