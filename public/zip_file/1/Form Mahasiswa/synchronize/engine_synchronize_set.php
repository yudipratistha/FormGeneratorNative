<?php $project_name="Form_Mahasiswa"; $tokenPath ="../google/secret/synchronize/token.json";$form_attr["data"][0]["folder"] = "form_biodata";$form_attr["data"][0]["attribute"][0] = "nama";$form_attr["data"][0]["attribute"][1] = "nim";$form_attr["data"][0]["attribute"][2] = "jk";$form_attr["data"][0]["attribute"][3] = "dates";$form_attr["data"][0]["attribute"][4] = "dattime";$form_attr["data"][0]["attribute"][5] = "data_barang";$form_attr["data"][0]["attribute"][6] = "foto1";$form_attr["data"][1]["folder"] = "form_test";$form_attr["data"][1]["attribute"][0] = "attr";if(!isset($_POST["server_name"])){ ?><script>var form_attr = <?php echo json_encode($form_attr); ?>;</script> <?php } ?>

<?php 
$token = json_decode(file_get_contents($tokenPath));

if(isset($_POST["folder"])){ 
    $folders = $_POST["folder"]; 
    $tables = $_POST["table"]; 
    $attributes = $_POST["attribute"]; 
    if(isset($_POST["direct_to_db"])) $direct_to_dbs = $_POST["direct_to_db"]; 
    $project_name = $_POST["project_folder_name"];  
    $server = $_POST["server_name"]; 
    $user = $_POST["username"]; 
    $pass = $_POST["password"]; 
    $db = $_POST["database_name"]; 
    $prependWithoutDirectDb = '<?php ';
    $prependWithoutDirectDb = $prependWithoutDirectDb.'$tokenPath=("'.$tokenPath.'"); ';
    $prependWithoutDirectDb = $prependWithoutDirectDb.'$project_name="'.$project_name.'"; ';
    $prependWithoutDirectDb = $prependWithoutDirectDb.'$server="'.$server.'"; ';
    $prependWithoutDirectDb = $prependWithoutDirectDb.'$user="'.$user.'"; ';
    $prependWithoutDirectDb = $prependWithoutDirectDb.'$pass="'.$pass.'"; ';
    $prependWithoutDirectDb = $prependWithoutDirectDb.'$db="'.$db.'"; ';
    foreach($folders as $i => $folder){
        $prependWithoutDirectDb = $prependWithoutDirectDb.'$syncs['.$i.']["folder"]="'.$folders[$i].'"; ';
        $prependWithoutDirectDb = $prependWithoutDirectDb.'$syncs['.$i.']["table"]="'.$tables[$i].'"; ';
        $isPrependDirectDb = false;
        $prependDirectDb = '<?php ';
        $prependDirectDb = $prependDirectDb.'$server="'.$server.'"; ';
        $prependDirectDb = $prependDirectDb.'$user="'.$user.'"; ';
        $prependDirectDb = $prependDirectDb.'$pass="'.$pass.'"; ';
        $prependDirectDb = $prependDirectDb.'$db="'.$db.'"; ';
        $prependDirectDb = $prependDirectDb.'$table_name="'.$tables[$i].'"; ';

        foreach($attributes[$tables[$i]] as $j => $attribute){
            $prependWithoutDirectDb = $prependWithoutDirectDb.'$syncs['.$i.']["table_attr"]['.$j.']="'.$attribute.'"; ';
        }
        foreach($attributes[$folders[$i]] as $j => $attribute){
            $prependWithoutDirectDb = $prependWithoutDirectDb.'$syncs['.$i.']["folder_attr"]['.$j.']="'.$attribute.'"; ';
        }
        foreach($attributes[$folders[$i]] as $j => $attribute){
            if(!isset($direct_to_dbs[$folders[$i]][$j])) $direct_to_dbs[$folders[$i]][$j] = "no";
            else{
                $prependDirectDb = $prependDirectDb.'$direct_to_db_folder['.$j.'] = "'.$attribute.'"; ';
                $prependDirectDb = $prependDirectDb.'$direct_to_db_table['.$j.'] = "'.$attributes[$tables[$i]][$j].'"; ';
                $isPrependDirectDb = true;
            }
            $prependWithoutDirectDb = $prependWithoutDirectDb.'$syncs['.$i.']["direct_to_db"]["'.$attribute.'"]="'.$direct_to_dbs[$folders[$i]][$j].'"; ';
        }
        
        if($isPrependDirectDb){
            
            $prependDirectDb = $prependDirectDb.' ?> ';
            $prependDirectDb = $prependDirectDb."\n";
            $file = '../'.$folder.'.php';
            $contents = file_get_contents($file);
            $new_contents = preg_replace('/^.+\n/', '', $contents);
            file_put_contents($file,$new_contents);
            $fileContents = file_get_contents($file);
            file_put_contents($file, $prependDirectDb . $fileContents);
        }
        else{
            $prependDirectDb = "";
            $file = '../'.$folder.'.php';
            $contents = file_get_contents($file);
            $new_contents = preg_replace('/^.+\n/', '', $contents);
            file_put_contents($file,$new_contents);
            $fileContents = file_get_contents($file);
            file_put_contents($file, $prependDirectDb . $fileContents);
        }
    }
    $prependWithoutDirectDb = $prependWithoutDirectDb.' ?> ';
    $prependWithoutDirectDb = $prependWithoutDirectDb."\n";
    $file = 'engine_synchronize.php';
    
    $contents = file_get_contents($file);
    $new_contents = preg_replace('/^.+\n/', '', $contents);
    file_put_contents($file,$new_contents);
    
    $fileContents = file_get_contents($file);
    file_put_contents($file, $prependWithoutDirectDb . $fileContents);
    echo "Save settings success";
    exit;
}
else if(isset($_POST["server_name"])){ 
    $server = $_POST["server_name"]; 
    $user = $_POST["username"]; 
    $pass = $_POST["password"]; 
    $db = $_POST["database_name"]; 
    try {
        $conn = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $conn->prepare("SELECT table_name, column_name
            FROM information_schema.columns 
            WHERE table_schema = '$db' AND column_key != 'PRI' ");
        $query->execute();
        $result['column'] = $query -> fetchAll(); 
        $query = $conn->prepare("SELECT table_name
        FROM information_schema.tables 
        WHERE table_schema = '$db'");
        $query->execute();
        $result['table'] = $query -> fetchAll();
        $result['message'] = "Connected to database: ".$db;
        $result['success'] = 1;
        echo json_encode($result);
    }
    catch(PDOException $e){
        $result['message'] = "Connection failed: " . $e->getMessage();
        $result['success'] = 0;
        echo json_encode($result);
    }
    exit;
} 
else{ 
?> 

<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </head>
    
    <body>
        <div class="container" style="padding-bottom:200px;">
            <div class="row">
                <div class="col-md-12" style="margin-top:20px;margin-bottom:20px">
                <center><h3>Synchronize Settings</h3></center>
                </div>
            </div>
            <div class="row" style="margin-top:0px;">
            <div class="col-md-12 ">
                <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" id="nav-mapping-attribute-tab" data-toggle="tab" href="#nav-mapping-attribute" role="tab" aria-controls="nav-mapping-attribute" aria-selected="false">Mapping Attribute</a>
                    </li>
                </ul>
				<div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
					<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <form id="form-database" action="#" method="POST">
                            <h4 class="modal-title">Connect to Database</h4>
                            <hr>
                            <div class="form-group">
                                <label for="usr">Server Name</label>
                                <input class="form-control required2 required3" type="text" name="server_name" placeholder="" required> 
                            </div>
                            <div class="form-group">
                                <label for="usr">Username</label>
                                <input class="form-control required2 required3" type="text" name="username" placeholder="" required> 
                            </div>
                            <div class="form-group">
                                <label for="usr">Password</label>
                                <input class="form-control" type="password" name="password" placeholder=""> 
                            </div>
                            <div class="form-group">
                                <label for="usr">Database Name</label>
                                <input class="form-control required2 required3" type="text" name="database_name" placeholder="" required> 
                            </div>
                            <input readonly="readonly" value="<?php echo $project_name ?>" type="hidden" name="project_folder_name"> 
                            <hr style="margin-top: 71px;">
                            <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#viewToken">View Token & Project Name</button> 
                            <button id="btn-database" type="button" class="btn btn-danger">Connect to Database</button> 
                        </form>	
                        <div class="modal fade" id="viewToken">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Google Drive Token & Project Name</h4>
                                    </div>    
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="usr">Google Drive Access Token</label>
                                            <input readonly="readonly" value="<?php echo $token->access_token ?>" class="form-control required" type="text" name="google_drive_access_token" placeholder="" required> 
                                        </div>
                                        <div class="form-group">
                                            <label for="usr">Google Drive Expires In</label>
                                            <input readonly="readonly" value="<?php echo $token->expires_in ?>" class="form-control required" type="text" name="google_drive_expires_in" placeholder="" required> 
                                        </div>
                                        <div class="form-group">
                                            <label for="usr">Google Drive Refresh Token</label>
                                            <input readonly="readonly" value="<?php echo $token->refresh_token ?>" class="form-control required" type="text" name="google_drive_refresh_token" placeholder="" required> 
                                        </div>
                                        <div class="form-group">
                                            <label for="usr">Google Drive Scope</label>
                                            <input readonly="readonly" value="<?php echo $token->scope ?>" class="form-control required" type="text" name="google_drive_scope" placeholder="" required> 
                                        </div>
                                        <div class="form-group">
                                            <label for="usr">Google Drive Token Type</label>
                                            <input readonly="readonly" value="<?php echo $token->token_type ?>" class="form-control required" type="text" name="google_drive_token_type" placeholder="" required> 
                                        </div>
                                        <div class="form-group">
                                            <label for="usr">Google Drive Created</label>
                                            <input readonly="readonly" value="<?php echo $token->created ?>" class="form-control required" type="text" name="google_drive_created" placeholder="" required> 
                                        </div>
                                        <div class="form-group">
                                            <label for="usr">Project Name</label>
                                            <input readonly="readonly" value="<?php echo $project_name ?>" class="form-control required" type="text" name="project_folder_name" placeholder="" required> 
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="tab-pane fade" id="nav-mapping-attribute" role="tabpanel" aria-labelledby="nav-mapping-attribute-tab">
                        <h4 id="mapping-NA" style="color:#ff0606">Mapping not available, please connect the database!</h4>
                        <form id="form-save-settings" action="#" style="display:none">
                            <h4>Mapping Attribute</h4>
                            <hr>
                            <div id="sync-wrap">
                                <div id="sync">
                                    <div class="card"  style="padding:10px; margin-bottom:15px;">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <select name="folder[]" class="form-control sync-from required3">
                                                    <option value="">-- Select Folder --</option>
                                                </select>
                                            </div>
                                            <div id="sync-center" class="col-md-1">
                                                <center>
                                                    <label  style="margin-top:4%;">Sync to</label>
                                                </center>
                                            </div>
                                            <div class="col-md-4">
                                                <select name="table[]"  class="form-control sync-to required3">
                                                    <option value="">-- Select Table --</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" data-toggle="modal" class="btn btn-success btn-block sync-modal-button">Set Attribute</button>
                                            </div>
                                            <div id="sync-delete" class="col-md-1">
                                                <label></label>
                                            </div>
                                        </div>
                                        <div class="modal sync-modal">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Set Attribute</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>     
                                                    <div class="modal-body">
                                                        <div class="sync-attr">
                                                            <div class="card"  style="padding:10px; margin-bottom:15px;">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <select class="form-control sync-attr-from required3">
                                                                            <option value="">-- Select Folder Attribute --</option>
                                                                        </select>
                                                                    </div>
                                                                    <div id="sync-center" class="col-md-1">
                                                                        <center>
                                                                            <label  style="margin-top:4%;">Sync to</label>
                                                                        </center>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <select class="form-control sync-attr-to required3">
                                                                            <option value="">-- Select Table Attribute --</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div class="card" style="padding:0px; padding-left:7px; display:block">
                                                                            <input style="margin-right:7px;" class="direct-to-database" type="checkbox" value="yes">Save to Database
                                                                            <br><label style="margin-left:20px;margin-bottom:0px;margin-top:-8px;" >without Google Drive</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-1 sync-delete-attr" >
                                                                        <label></label>
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                        </div>
                                                        <div class="sync-wrap-attr"></div>
                                                        <div class="row" style="margin-top:10px;">
                                                            <div class="col-md-2">
                                                                <div id="btn-add-sync-attr">
                                                                    <button  type="button" class="btn btn-info btn-add-sync-attr">Add Sync Attribute</button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>   
                                                    <div class="modal-footer">
                                                        <button id="btn-export" type="button" class="btn btn-success" data-dismiss="modal">Submit</button>
                                                    </div>  
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top:10px;">
                                <div class="col-md-2">
                                    <div id="btn-add-sync">
                                        <button type="button" class="btn btn-info btn-add-sync">Add Sync</button>
                                    </div>
                                </div>
                            </div>
                            <hr style="margin-top: 71px;">
                            <button id="btn-previous" type="button" class="btn btn-danger">Previous</button>
                            <button id="btn-save-settings" type="button" class="btn btn-primary">Save Settings</button> 
                        </form>
                    </div>
				</div>
			</div>
        </div>
    </body>

</html> 

<?php } ?>

<script>
    var append;

    append = updateOption();  

    $(document).ready(function(){
        $('body').delegate('#btn-next', 'click',function() {
            $('.nav-tabs .active').parent().next('li').find('a').trigger('click');
        });

        $('body').delegate('#btn-previous', 'click',function() {
            $('.nav-tabs .active').parent().prev('li').find('a').trigger('click');
        });
        
        $("#btn-save-settings").click(function () {
            if(validateEmptyField(".required3")) return;
            jQuery.ajax({
                type: "POST",
                data:  $("form").serialize(),
                success: function(message) {
                    alert(message);
                }
            });
        });

        $("#btn-database").click(function () {
            if(validateEmptyField(".required2")) return;
            jQuery.ajax({
                type: "POST",
                data:  $("#form-database").serialize(),
                success: function(data) {
                    data = JSON.parse(data);

                    if(data['success']){
                        alert(data['message']);
                        $('.disabled').removeClass('disabled');
                        $('#btn-database').parent().append('<button id="btn-next" type="button" class="btn btn-success btn-next">Next</button>')
                        $('.nav-tabs .active').parent().next('li').find('a').trigger('click');                        
                    }else{
                        alert(data['message']);
                    }
                    $('#database-table').empty();
                    $('.sync-to').empty();
                    $('.sync-to').append('<option value="">-- Select Table --</option>')
                    updateModalId(form_attr['data'], data)
                    addSyncModal(form_attr['data'], data)
                    $.each(data['table'], function(i, table) {
                        $('.sync-to').append('<option>'+ table["table_name"] + '</option>')
                    });

                    $('#dropbox-folder').empty();
                    $('.sync-from').empty();
                    $('.sync-from').append('<option value="">-- Select Folder --</option>')
                    
                    $.each(form_attr['data'], function(i, item) {
                        $('.sync-from').append('<option>'+ item["folder"] + '</option>')
                    });
                    append = updateOption();
                    $("#form-save-settings").show();
                    $("#mapping-NA").remove();
                }
            });
        });            

        function validateEmptyField(class_name){
            var isError = false;
            $(class_name).each(function(){
                if($(this).val() == "") isError = true;
            });
            if(isError){
                alert("Field can't be empty");
                return 1;
            }  
        }
    });

    function updateOption(){
        $('#sync').children().children().children('#sync-delete').children().prepend('<a href="#" class="remove_field"><button  type="button" class="btn btn-danger btn-block"><i class="fa fa-trash" style="color:white; font-size:20px;"></i></button></a>');
        new_append=$('#sync').html();
        $('#sync').children().children().children('#sync-delete').children().children('.remove_field').remove();
        return new_append;
    }

    function updateOptionAttr(id){
        $('#sync-attr-'+id).children().children().children('.sync-delete-attr').children().prepend('<a href="#" class="remove_field_attr"><button  type="button" class="btn btn-danger btn-block"><i class="fa fa-trash" style="color:white; font-size:20px;"></i></button></a>');
        new_append=$('#sync-attr-'+id).html();
        $('#sync-attr-'+id).children().children().children('.sync-delete-attr').children().children('.remove_field_attr').remove();
        return new_append;
    }
    
    function updateModalId(folder, database){
        var i=0;
        $(".sync-modal").each(function(){
            $(this).attr("id", "sync-modal-"+i);
            $(this).parent().find(".sync-modal-button").attr("id", "sync-modal-button-"+i);
            $(this).parent().find(".sync-wrap-attr").attr("id", "sync-wrap-attr-"+i);
            $(this).parent().find(".btn-add-sync-attr").attr("data-wrap-id", i);
            $(this).parent().find(".sync-attr").attr("id", "sync-attr-"+i);

            $(this).parent().find("#sync-modal-button-"+i).prop("onclick", null).off("click");
            $(this).parent().find("#sync-modal-button-"+i).click(function () {
                var clicked_button = $(this);
                var selected_folder = $(this).parent().parent().find(".sync-from").val();
                var selected_table = $(this).parent().parent().find(".sync-to").val();
                if(selected_folder!="" && selected_table!=""){
                    if($(this).parent().parent().parent().find(".sync-modal").attr("data-modal-folder") != selected_folder 
                        || $(this).parent().parent().parent().find(".sync-modal").attr("data-modal-table") != selected_table){
                        $(this).parent().parent().parent().find(".sync-wrap-attr").empty();
                        $(this).parent().parent().parent().find(".sync-attr-from").empty();
                        $(this).parent().parent().parent().find(".sync-attr-to").empty();
                        $(this).parent().parent().parent().find(".sync-attr-from").append('<option value="">-- Select Folder Attribute --</option>');
                        $(this).parent().parent().parent().find(".sync-attr-to").append('<option value="">-- Select Table Attribute --</option>');
                    }
                    
                    if(clicked_button.parent().parent().parent().find(".sync-attr-from").children().length == 1) {
                        $.each(database['column'], function(i, column) { 
                            if(selected_table == column["table_name"])
                            clicked_button.parent().parent().parent().find(".sync-attr-to").append('<option>'+ column["column_name"]+ '</option>');
                        });

                        $.each(folder, function(i, item) {
                            if(selected_folder == item['folder']){
                                $.each(item['attribute'], function(j, attribute) { 
                                    clicked_button.parent().parent().parent().find(".sync-attr-from").append('<option>'+ attribute+ '</option>');
                                }); 
                            }
                        });
                        $(this).parent().parent().parent().find(".sync-modal").attr("data-modal-folder",selected_folder);
                        $(this).parent().parent().parent().find(".sync-modal").attr("data-modal-table",selected_table);
                        $(this).parent().parent().parent().find(".sync-attr-from").attr("name",'attribute['+selected_folder+'][]' );
                        $(this).parent().parent().parent().find(".sync-attr-to").attr("name", 'attribute['+selected_table+'][]' );
                        $(this).parent().parent().parent().find(".direct-to-database").attr("name", 'direct_to_db['+selected_folder+'][]' );
                    }
                    $(this).parent().parent().parent().find(".sync-modal").modal('show');
                }
                else {
                    alert("Please select folder and table first"); return;
                }
            });
            i++;
        });
    }   

    function addSyncModal(folder, database){
        var max_fields      = 50; //maximum input boxes allowed
        var wrapper   		= $("#sync-wrap"); //Fields wrapper
        var add_button      = $("#btn-add-sync"); //Add button ID         
        var x = 1; //initlal text box count

        $(add_button).on("click", ".btn-add-sync", function(e){ //on add input button click
            e.preventDefault();
            if(x < max_fields){ //max input box allowed
                x++; //text box increment
                $(wrapper).append(append); //add input box
                updateModalId(folder, database);
            }
        });
        
        $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            e.preventDefault(); 
            $(this).parent().parent().parent().parent().remove(); 
            x--;
        })  
    }

    var max_fields2      = 50; //maximum input boxes allowed
    var wrapper2   		= "#sync-wrap-attr"; //Fields wrapper
    var add_button2      = $("#form-save-settings"); //Add button ID         
    var x2 = 1; //initlal text box count

    $(add_button2).on("click", ".btn-add-sync-attr", function(e){ //on add input button click
        e.preventDefault();
        if(x2 < max_fields2){ //max input box allowed
            x2++; //text box increment
            var wrap_id = $(this).attr("data-wrap-id");
            append_attr = updateOptionAttr(wrap_id);
            $(wrapper2+"-"+wrap_id).append(append_attr); //add input box

            $(wrapper2+"-"+wrap_id).on("click",".remove_field_attr", function(e){ //user click on remove text
                e.preventDefault(); 
                $(this).parent().parent().parent().parent().remove(); 
                x--;
            })  
        }
    });
    
</script>