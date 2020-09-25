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
                      <div class="input-type" for="input01" data-valtype='label'>Text input</div>
                    </div>
                    <div id="number" class="form-group component input-field">
                      <div class="input-type"  data-valtype="label">Number</div>
                    </div>
                    <div id="checkboxes" class="form-group component input-field">
                      <div class="input-type"  data-valtype="label">Checkboxes</div>
                    </div>

                    <div id="radio-buttons" class="form-group component input-field">
                      <div class="input-type"  data-valtype="label">Radio buttons</div>
                    </div>
                    <div id="select-basic" class="form-group component input-field">
                      <div class="input-type"  data-valtype="label">Select Basic</div>
                    </div>
                    <div id="file-upload" class="form-group component input-field">
                      <div class="input-type"  for="input01" data-valtype='label'>File Upload</div>
                    </div>
                  </fieldset>
                </form>
              </div>
              <div class="col-md-6">
                <form class="form-horizontal" id="components">
                  <fieldset>
                    <div id="table-modal" class="form-group component input-field">
                      <div class="input-type"  for="input01" data-valtype='label'>Table Modal</div>
                    </div>
                    <div id="date" class="form-group component input-field">
                      <div class="input-type"  data-valtype="label">Date</div>
                    </div>
                    <div id="time" class="form-group component input-field">
                      <div class="input-type"  data-valtype="label">Time</div>
                    </div>
                    <div id="date-time" class="form-group component input-field">
                      <div class="input-type"  data-valtype="label">Date Time</div>
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
      <button type="button" onclick="tambah_data_form()" class="btn btn-info">Save</button>
  </div>
</div>

<script>

  //create form project
	function tambah_data_form(){
    swal.fire({
      title: "Create this form?",
      text: "Apakah ",
      type: "warning",
      html: '<form id="tambahFormOption" action="" method="POST" enctype="multipart/form-data">\
                <input type="hidden" value="" name="form_title" id="form_title">\
                <input type="hidden" value="" name="form_name" id="form_name">\
                <input type="hidden" value="" name="attr_form" id="attr_form">\
                <input type="hidden" value="" name="convert_php" id="convert_php">\
                <input type="hidden" value="{{$form_projects_id}}" name="form_projects_id" id="form_projects_id">\
                <select class="swal2-select" id="form-type" name="form_type"> \
                  <option value="" selected="selected" disabled="">Select an option</option>\
                  <option value="With Auth Google Drive API">With Auth Google Drive API</option> \
                  <option value="With Auth Google Drive API and Identifier">With Auth Google Drive API and Identifier</option>\
                  <option value="Without Auth Google Drive">Without Auth Google Drive</option>\
                </select>\
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
        $('#form-type').change(function() {
          // console.log("tes ",$('#form-type :selected').val())
          // if(!$('#form-type').find(":selected").text()){
            $('#json-identifier-upload').remove();
            $('#swal2-validation-message').remove();
            if($('#form-type').val() == 'With Auth Google Drive API and Identifier'){
              $('#tambahFormOption').append('\
                  <input id="json-identifier-upload" type="file" name="json_identifier"\
                  aria-label="Upload your profile picture" class="swal2-file" \
                  style="display: flex;" placeholder="">'
              );
            }
        });
      },
      preConfirm: (login) => {  
        let selected = $('#form-type :selected').val() !== '';
        var form = $("#tambahFormOption").get(0);

        if (!selected) {
            swal.showValidationMessage('Please select an option!');
        }else{
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          return $.ajax({
            type: "POST", 
            url: "{{route('formgenerator-create.store')}}",
            // datatype : "json", 
            processData: false,
            contentType: false,
            cache: false,
            // data: $("#tambahForm, #tambahFormOption").serialize(), 
            data: new FormData(form), 
            success: function(data) {
              var request = 'success';
            },
              error: function(xhr, status, error){
                  swal.fire({title:"Form Project Gagal Di Tambah!", text: xhr.responseText, type:"error"});
              }
          });
        }                
      }          
    }).then((result) => {
      console.log("sadsa ", result.value)
        if(result.value){
          swal.fire({title:"Form Project Di Tambah!", text:"Form Project berhasil di tambahkan", type:"success"})
          .then(function(){ 
              window.location.href = "{{ url('/form', $form_projects_id)}}";
          });
        }
    })
  }
  
</script>
@endsection
