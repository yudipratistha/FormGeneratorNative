


<?php $oauth_credentials = __DIR__ ."/google/secret/oauth.json";include_once __DIR__ . '/google/autoload.php';$folderName = "Sistem_Kependudukan"; $folderFormName = "form_kk"; session_start();$redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];$client = new Google_Client();$client->setAuthConfig($oauth_credentials);$client->setRedirectUri($redirect_uri);$client->addScope("https://www.googleapis.com/auth/drive");$service = new Google_Service_Drive($client);if (isset($_REQUEST['logout'])) {    unset($_SESSION['upload_token']);    unset($_SESSION['email_login']);    header("Location: " . $_SERVER["PHP_SELF"]);    exit;}else if(isset($_POST["password"]) ){        $password = $_POST["password"];     $logged_in = false;     $auth_file = file_get_contents($auth_file);     $auths = json_decode($auth_file);     $auth_keys = array_keys((array)$auths[0]);     foreach($auth_keys as $i => $auth_key){         if($i == 0) $username_key = $auth_key;         else  $password_key = $auth_key;     }     foreach($auths as $auth){         $auth = (array)$auth;         if($password == $auth[$password_key]) {             $logged_in = true;             $username =  $auth[$username_key];         }     }     if($logged_in){         $authUrl = $client->createAuthUrl();        echo "<script>window.open('$authUrl', 'targetWindow', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=600')</script>";        $_SESSION["display_name_key"] = $username_key;         $_SESSION["display_name"] = $username;     }     else{         $_SESSION["login_error"] = "Login Fail Wrong Key";         header("Location: ".$_SERVER["PHP_SELF"]);         exit;     } } else if (isset($_GET['code'])) {    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);    $client->setAccessToken($token);    $_SESSION['upload_token'] = $token;    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));    }else if (!empty($_SESSION['upload_token'])) {    $client->setAccessToken($_SESSION['upload_token']);    echo "<script>  if (window.opener != null){ opener.location.href = '".$_SERVER["PHP_SELF"]."'; close();}</script>";    $status= true;    if ($client->isAccessTokenExpired()) {        unset($_SESSION['upload_token']);        $status= false;    }    if($status !== false){        $about = $service->about->get(array('fields' => '*'));        $_SESSION["email_login"] = $email_login = $about->user->emailAddress;        $_SESSION["name_login"] = $name_login = $about->user->displayName;    }}if(empty($_SESSION['upload_token'])){      $authUrl = $client->createAuthUrl();   include "google/login.php";      $status= false;} if ($status){    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $client->getAccessToken()){        if (!file_exists('google/tmp')){            mkdir('google/tmp', 0777, true);        }        if (!file_exists('google/tmp/attachment')){            mkdir('google/tmp/attachment', 0777, true);        }        $labels = $_POST["values"];        $row = array();        $j = 0;        $file_names = $_FILES["values"]["name"];        $file_keys = array_keys($file_names);        foreach ($file_names as $file_name){            $new_value = array(                $file_keys[$j] => $file_name            );            $labels = $labels + $new_value;            $j++;        }        $keys = array_keys($labels);        if (isset($server)){            $conn = new PDO("mysql:host=$server;dbname=$db", $user, $pass);            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);            $direct_attributes = "";            $direct_values = "";            $excepted_attrs = array();            if (isset($auth_file)){                $attr = array(                    $_SESSION["display_name_key"] => $_SESSION["display_name"]                );                $row = $row + $attr;            }            foreach ($direct_to_db_folder as $j => $attr){                $direct_attributes = $direct_attributes . $direct_to_db_table[$j];                $value_index = array_search($attr, $labels);                $data = str_replace('"', '\"', $values[$value_index]);                $direct_values = $direct_values . '"' . $data . '"';                array_push($excepted_attrs, $labels[$value_index]);                if ($j < count($direct_to_db_folder) - 1){                    $direct_attributes = $direct_attributes . ",";                    $direct_values = $direct_values . ",";                }            }            $query = "INSERT INTO " . $table_name . "(" . $direct_attributes . ") VALUES(" . $direct_values . ")";            $sql = $conn->prepare($query);            $sql->execute();            $lastInsertId = $conn->lastInsertId();            $query = "SHOW KEYS FROM " . $table_name . " WHERE Key_name = 'PRIMARY'";            $sql = $conn->prepare($query);            $sql->execute();            $result = $sql->fetchAll();            foreach ($result as $baris){                $primary_column = $baris["Column_name"];            }            $attr = array(                $primary_column => $lastInsertId            );            $row = $row + $attr;            $json_name = "update.json";            $i = 0;            foreach ($values as $value){                $is_value = true;                foreach ($excepted_attrs as $excepted_attr){                    if ($labels[$i] == $excepted_attr) $is_value = false;                }                if ($is_value){                    if (is_array($value)) $attr = array(                            $labels[$keys[$i]] => implode(", ", $value)                    );                    else $attr = array(                        $labels[$keys[$i]] => $value                    );                    $row = $row + $attr;                }                $i++;            }        }        else{            $json_name = "insert.json";            $subforms_data = array();            $i = 0;            foreach ($labels as $value){                if (is_array($value)){                    if (isset($value["main_form"])){                        $subform_values = array_slice($value, 1);                        for ($subform_data_key = 0;$subform_data_key <= sizeof(reset($subform_values)) - 1;$subform_data_key++){                            $j = 0;                            foreach ($subform_values as $subform_value){                                $subform_data_array[array_keys($subform_values) [$j]] = $subform_value[$subform_data_key];                                $j++;                            }                            $subforms_data[$subform_data_key] = $subform_data_array;                        }                        $attr = array(                            $value["main_form"] => $subforms_data                        );                    }else $attr = array(                        $keys[$i] => implode(", ", $value)                    );                }else $attr = array(                    $keys[$i] => $value                );                $row = $row + $attr;                $i++;            }            $myJSON = json_encode($row);            $fp = fopen("google/tmp/" . $json_name, "w");            fwrite($fp, $myJSON);            fclose($fp);        $namaFoldSync = "";        $optParams = array(            'pageSize' => 1,            'orderBy' => 'modifiedTime asc',            'fields' => 'nextPageToken, files',            'q' => "name = '".$folderFormName."' and mimeType = 'application/vnd.google-apps.folder'"        );        $searchFolder = $service->files->listFiles($optParams);        foreach ($searchFolder->getFiles() as $file) {            $idFold = $file->getId();        }        if(empty($idFold)){            $file = new Google_Service_Drive_DriveFile();            $file->setName($folderFormName);            $file->setMimeType('application/vnd.google-apps.folder');            $service->files->create($file);            $optParams = array(                'pageSize' => 1,                'fields' => 'nextPageToken, files',                'q' => "name = '".$folderFormName."' and mimeType = 'application/vnd.google-apps.folder'"            );            $searchFolder = $service->files->listFiles($optParams);            foreach ($searchFolder->getFiles() as $file) {                $idFold = $file->getId();            }        }        $fileMetadata = new Google_Service_Drive_DriveFile(array(            'name' => "$folderFormName",            'parents' => array($idFold),            'mimeType' => 'application/vnd.google-apps.folder'));        $file = $service->files->create($fileMetadata, array('fields' => 'id'));        $folderIdSave = $file->id;        $userPermission = new Google_Service_Drive_Permission(array(            'type' => 'user',            'role' => 'writer',            'emailAddress' => 'yudipratistha@gmail.com'        ));        $request = $service->permissions->create($folderIdSave, $userPermission, array('fields' => 'id'));        $key = 0;        $file_names = $_FILES["values"]["name"];        $file_keys = array_keys($file_names);        $files = $_FILES["values"]["tmp_name"];        $file = new Google_Service_Drive_DriveFile();        $file->setParents([$folderIdSave]);        $file->setName('insert.json');        $content = file_get_contents('google/tmp/insert.json');        $result2 = $service->files->create($file,array('data' => $content, 'mimeType' => 'application/json', 'uploadType' => 'multipart'));        $file = new Google_Service_Drive_DriveFile();        $file->setName("Attachment");        $file->setParents([$folderIdSave]);        $file->setMimeType('application/vnd.google-apps.folder');        $folderAttachment = $service->files->create($file, array('fields' => 'id'));        $folderAttachmentId = $folderAttachment->id;        foreach ($files as $file){            if (is_array($file)){                $googleFile = new Google_Service_Drive_DriveFile();                $googleFile->setName($labels[$file_keys[$key]]["main_form"]);                $googleFile->setParents([$folderAttachmentId]);                $googleFile->setMimeType('application/vnd.google-apps.folder');                $folderSubform = $service->files->create($googleFile, array('fields' => 'id'));                if (!file_exists("google/tmp/attachment/". $labels[$file_keys[$key]]["main_form"])) mkdir("google/tmp/attachment/". $labels[$file_keys[$key]]["main_form"]);                $subform_file_keys = array_keys($file);                foreach($subform_file_keys as $subform_file_key){                    $createSubformFoldAttch = new Google_Service_Drive_DriveFile();                    $createSubformFoldAttch->setName($subform_file_key);                    $createSubformFoldAttch->setParents([$folderSubform->id]);                    $createSubformFoldAttch->setMimeType('application/vnd.google-apps.folder');                    $folderSubformAttachment = $service->files->create($createSubformFoldAttch, array(                        'fields' => 'id'                    ));                    $folderSubformAttachmentId = $folderSubformAttachment->id;                    $l = 0;                    foreach ($file as $subform_file){                        if (!file_exists("google/tmp/attachment/" . $labels[$file_keys[$key]]["main_form"] . "/" . $subform_file_keys[$l])) mkdir("google/tmp/attachment/" . $labels[$file_keys[$key]]["main_form"] . "/" . $subform_file_keys[$l]);                        $m = 0;                        foreach ($subform_file as $upload_file){                           $file_name = basename($_FILES["values"]["name"][$file_keys[$key]][$subform_file_keys[$l]][$m]);                           $tmp = explode(".", $file_name);                           $ext = end($tmp);                           $target_file = "google/tmp/attachment/" . $labels[$file_keys[$key]]["main_form"] . "/" . $subform_file_keys[$l] . "/" . $subform_file_keys[$l] . "-" . $m . "." . $ext;                           move_uploaded_file($upload_file, $target_file);                           $file = new Google_Service_Drive_DriveFile();                           $file->setName($subform_file_keys[$l] . "-" . $m . "." . $ext);                           $file->setParents([$folderSubformAttachmentId]);                           $content = file_get_contents($target_file);                           $result2 = $service->files ->create($file, array(                               'data' => $content,                               'mimeType' => "image/'" . $ext . "'",                               'uploadType' => 'multipart'                           ));                           unlink($target_file);                           $m++;                       }                       rmdir("google/tmp/attachment/" . $labels[$file_keys[$key]]["main_form"] . "/" . $subform_file_keys[$l]);                       $l++;                   }               }               rmdir("google/tmp/attachment/" . $labels[$file_keys[$key]]["main_form"]);           }else{               $file_name = basename($_FILES["values"]["name"][$file_keys[$key]]);               $tmp = explode(".", $file_name);               $ext = end($tmp);               $target_file = "google/tmp/attachment/" . $file_keys[$key] . "." . $ext;               move_uploaded_file($file, $target_file);               $file = new Google_Service_Drive_DriveFile();               $file->setName($file_keys[$key] . "." . $ext);               $file->setParents([$folderAttachmentId]);               $content = file_get_contents($target_file);               $result2 = $service->files->create($file, array(                   'data' => $content,                   'mimeType' => "image/'" . $ext . "'",                   'uploadType' => 'multipart'               ));               $key++;               unlink($target_file);           }       }       unlink("google/tmp/" . $json_name);   }   header("Location: " . $_SERVER["PHP_SELF"]);   exit;}?>                     <?php include "sidebar.php"; ?>                    <div class="container border border-top-0 mt-5 shadow-sm">                         <div class="tab-content">                             <div role="tabpanel" class="tab-pane active" id="form-form_kk"><form class="form-border form-horizontal" method="POST" enctype="multipart/form-data"><fieldset><div id="legend" class=""><legend class="legend-border-title">Form Kartu Keluarga</legend></div><div class="form-group component-click" aria-describedby="popover660319"><label class="col-md-6 control-label" for="input01">No. KK</label><div class="col-md-6"><input type="number" placeholder="01712....." class="form-control input-md" name="values[no_kk]" required="required"><p class="help-block"></p></div></div><div class="form-group component-click" aria-describedby="popover853127"><label class="col-md-6 control-label" for="input01">NIK</label><div class="col-md-6"><input type="number" placeholder="NIK..." class="form-control input-md" name="values[nik]"><p class="help-block"></p></div></div><div class="form-group component-click"><!-- Text input--><label class="col-md-6 control-label" for="input01">Nama Kepala keluarga</label><div class="col-md-6"><input type="text" placeholder="Nama....." class="form-control input-md" name="values[nama_kepala_keluarga]" required="required"><p class="help-block"></p></div></div><div class="form-group component-click"><label class="col-md-6 control-label" for="input01">RT/RW</label><div class="col-md-6"><input type="number" placeholder="RT/RW....." class="form-control input-md" name="values[rt_rw]" required="required"><p class="help-block"></p></div></div><div class="form-group component-click"><!-- Table Modal--><label class="col-md-6 control-label" for="input01">Desa</label><div class="col-md-6"><input data-toggle="modal" data-target="#table-modal-desa" type="tablemodal" placeholder="Input Desa" class="form-control input-md" name="values[desa]" id="tm-radio-desa" required="required"><p class="help-block"></p></div><div class="col-md-6" id="table-modal"></div></div><div class="form-group"><!-- Text input--><label class="col-md-6 control-label" for="input01">Foto Kartu Keluarga</label><div class="col-md-6"><input type="file" value="file_1" class="form-control input-md" name="values[foto_kk]" required="required"><p class="help-block"></p></div></div><div class="form-group"> <input type="hidden" class="valtype" name="values[subform-form_anggota_keluarga][main_form]" value="subform_form_anggota_keluarga"> <label class="col-md-6 control-label">Form Anggota Keluarga</label> <div class="col-md-6 table-responsive"> <table id="datatable-subform-form_anggota_keluarga" class="table table-bordered"> <thead class="thead-dark"> <tr><th>nik</th> <th>nama_anggota_kk</th> <th>jenis_kelamin_anggota_kk</th> <th>tanggal_lahir_anggota_kk</th> <th>agama_anggota_kk</th> <th>foto_kk</th> <th>action</th> </tr></thead> <tbody id="subform-form_anggota_keluarga"></tbody> </table> <button id="tab-subform-form_anggota_keluarga" type="button" class="btn btn-outline-primary btn-sm"><span class="btn-inner--icon"><i class="fa fa-plus"></i></span> Form Anggota Keluarga</button> </div> </div> <div class="form-group"><!-- Button --><div class="col-md-6"><button class="btn btn-success">Button</button></div></div></fieldset></form>                    </div><?php $sub_folder_name = 'form_anggota_keluarga'; ?> <div role="tabpanel" class="tab-pane subform" id=subform-form_anggota_keluarga> <form class="form-border form-horizontal" method="POST" enctype="multipart/form-data"><fieldset><div id="legend" class=""><legend class="legend-border-title">Form Anggota Keluarga</legend></div><div class="form-group component-click"><label class="col-md-6 control-label" for="input01">NIK</label><div class="col-md-6"><input type="number" placeholder="NIK...." class="form-control input-md" name="values[nik]" required="required"><p class="help-block"></p></div></div><div class="form-group component-click"><!-- Text input--><label class="col-md-6 control-label" for="input01">Nama Lengkap</label><div class="col-md-6"><input type="text" placeholder="Nama Lengkap....." class="form-control input-md" name="values[nama_anggota_kk]" required="required"><p class="help-block"></p></div></div><div class="form-group"><label class="col-md-6 control-label">Jenis Kelamin</label><div class="col-md-6"><!-- Multiple Radios --><div class="form-check"> <label class="radio"><input type="radio" class="form-check-input" value="Laki-laki" name="values[jenis_kelamin_anggota_kk][]" checked="checked" required="required">Laki-laki</label></div><div class="form-check"> <label class="radio"><input type="radio" class="form-check-input" value="Perempuan" name="values[jenis_kelamin_anggota_kk][]" required="required">Perempuan</label></div></div></div><div class="form-group" aria-describedby="popover15777"><label class="col-md-6 control-label">Tanggal Lahir</label><div class="col-md-6"><div class="input-group"><input type="date" class="form-control input-md" name="values[tanggal_lahir_anggota_kk]" required="required"><div class="input-group-append"><div class="input-group-text"><i class="fa fa-calendar"></i></div></div></div><p class="help-block"></p></div></div><div class="form-group"><label class="col-md-6 control-label">Agama</label><div class="col-md-6"><!-- Multiple Radios --><div class="form-check"> <label class="radio"><input type="radio" class="form-check-input" value="Hindu" name="values[agama_anggota_kk][]" checked="checked">Hindu</label></div><div class="form-check"> <label class="radio"><input type="radio" class="form-check-input" value="Islam" name="values[agama_anggota_kk][]">Islam</label></div><div class="form-check"> <label class="radio"><input type="radio" class="form-check-input" value="Kristen Katolik" name="values[agama_anggota_kk][]">Kristen Katolik</label></div><div class="form-check"> <label class="radio"><input type="radio" class="form-check-input" value="Kristen Protestan" name="values[agama_anggota_kk][]">Kristen Protestan</label></div><div class="form-check"> <label class="radio"><input type="radio" class="form-check-input" value="Budha" name="values[agama_anggota_kk][]">Budha</label></div><div class="form-check"> <label class="radio"><input type="radio" class="form-check-input" value="Konghucu" name="values[agama_anggota_kk][]">Konghucu</label></div></div></div><div class="form-group"><!-- Text input--><label class="col-md-6 control-label" for="input01">Foto</label><div class="col-md-6"><input type="file" value="file_1" class="form-control input-md" name="values[foto_kk]"><p class="help-block"></p></div></div></fieldset></form>        <button id=btn-submit-subform-form_anggota_keluarga class="col-md-12 btn btn-success btn-block">Submit</button>         <button id="tab-mainform-form_kk" type="button" class="col-md-12 btn btn-info btn-block"><a>Back to Main Form</a></button>        <script>           var subform_data = 0;           var prev_is_file = 0;           var attach = 0;           $("#btn-submit-subform-form_anggota_keluarga").click(function() {              $("#datatable-subform-form_anggota_keluarga").DataTable().destroy();              $('tbody[id="subform-form_anggota_keluarga"]').append("<tr id=subform-form_anggota_keluarga-" + subform_data + "></tr>");              var formData = new FormData($("div #"+$(this).parent().attr("id")).find("form").get(0));              for (var attr of formData) {                  let name = attr[0];                  let value = attr[1];                  if(value instanceof Object){                      $("#subform-form_anggota_keluarga-"+subform_data).append("<td>fl-" + (attach + 1) + "." + /[^.]+$/.exec(value.name) + "</td>");                      $("#subform-form_anggota_keluarga-"+subform_data).append("<input id=file-subform-form_anggota_keluarga-"+subform_data + " style='display:none;' type=file name='values[subform-form_anggota_keluarga]["+name.substring(7, name.length-1)+"][]'>");                      $("#subform-form_anggota_keluarga-"+subform_data).append("<input type=hidden name='values[subform-form_anggota_keluarga]["+name.substring(7, name.length-1)+"][]' value=fl-" + attach + "." + /[^.]+$/.exec(value.name) + ">");                      let fileInputElement = $("#file-subform-form_anggota_keluarga-"+subform_data)[0];                      let container = new DataTransfer();                      container.items.add(value);                      fileInputElement.files = container.files;                      attach++;                 }else{                      if(name.substring(name.length - 2) === "[]"){                           var attr_subform = name.substring(7, name.length-3)                      }else{                          attr_subform = name.substring(7, name.length - 1)                      }                      $("#subform-form_anggota_keluarga-"+subform_data).append("<td>" + value + "</td>");                      $("#subform-form_anggota_keluarga-"+subform_data).append("<input type=hidden name=values[subform-form_anggota_keluarga]["+ attr_subform +"][] value=" + value + ">");                 }              }              var delete_row_id = "delete-row-" + subform_data;              $("#subform-form_anggota_keluarga-"+subform_data).append("<td><center><button id="+ delete_row_id +" type='button' class='btn btn-outline-danger'><span class='btn-inner--icon'><i class='fa fa-trash'></i></span></button></center></td>");              $("#" + delete_row_id).click(function(){                  $("#datatable-subform-form_anggota_keluarga").DataTable().row($(this).parent().parent().parent()).remove().draw(false);                  $("td:contains('fl-')").each(function(i) {                      this.textContent = "fl-" + (i + 1)+ "." + /[^.]+$/.exec(this.textContent);                  });                  $("input[value*='fl-']").each(function(i) {                      this.value = "fl-" + i + "." + /[^.]+$/.exec(this.value);                  });                  $("tr[id*='subform-form_anggota_keluarga-']").each(function(i) {                      this.id = "subform-form_anggota_keluarga-" + i;                  });                  $("button[id*='delete-row-']").each(function(i) {                      this.id = "delete-row-" + i;                  });                  subform_data -= 1;                  attach -= 1;                  alert("Data Deleted");               });               subform_data++;               $("#subform-").val(subform_data + " Row Data");               $("#datatable-subform-form_anggota_keluarga").DataTable().draw();               alert("Data Added to Main Form");               $("div #"+$(this).parent().attr("id")).find("form")[0].reset();           });       </script>       <script>           $("#tab-subform-form_anggota_keluarga").click(function(e){               e.preventDefault();               $("#form-form_kk").removeClass("active");               $("div #subform-form_anggota_keluarga").addClass("active");           });           $("#tab-mainform-form_kk").click(function(e){               e.preventDefault();               $("div #subform-form_anggota_keluarga").removeClass("active");               $("#form-form_kk").addClass("active");           });       </script>    </div> </div>         </div>    </body>    <script type="text/javascript">        $('a[href="' + window.location.pathname.split('/').pop() + '"]').parent().addClass("active");        $('.sidebar-content > a').click(function(){            $('.sidebar-content').removeClass('active');            $(this).parent().addClass("active");        });        $(".sidebar-dropdown > a").click(function() {            $(".sidebar-submenu").slideUp(200);            if ($(this).parent().hasClass("active")) {                $(".sidebar-dropdown").removeClass("active");                $(this).parent().removeClass("active");            } else {                $(".sidebar-dropdown").removeClass("active");                $(this).next(".sidebar-submenu").slideDown(200);                $(this).parent().addClass("active");            }        });$("#close-sidebar").click(function() {            $(".page-wrapper").removeClass("toggled");        });        $("#show-sidebar").click(function() {            $(".page-wrapper").addClass("toggled");        });    </script>    <?php } ?></php>