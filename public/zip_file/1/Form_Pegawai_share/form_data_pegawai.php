


<?php $oauth_credentials = __DIR__ ."/google/secret/oauth.json";include_once __DIR__ . '/google/autoload.php';$folderName = "Form_Pegawai"; $folderFormName = "form_data_pegawai"; session_start();$redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];$client = new Google_Client();$client->setAuthConfig($oauth_credentials);$client->setRedirectUri($redirect_uri);$client->addScope("https://www.googleapis.com/auth/drive");$service = new Google_Service_Drive($client);if (isset($_REQUEST['logout'])) {    unset($_SESSION['upload_token']);    unset($_SESSION['email_login']);    header("Location: " . $_SERVER["PHP_SELF"]);    exit;}else if(isset($_POST["password"]) ){        $password = $_POST["password"];     $logged_in = false;     $auth_file = file_get_contents($auth_file);     $auths = json_decode($auth_file);     $auth_keys = array_keys((array)$auths[0]);     foreach($auth_keys as $i => $auth_key){         if($i == 0) $username_key = $auth_key;         else  $password_key = $auth_key;     }     foreach($auths as $auth){         $auth = (array)$auth;         if($password == $auth[$password_key]) {             $logged_in = true;             $username =  $auth[$username_key];         }     }     if($logged_in){         $authUrl = $client->createAuthUrl();        echo "<script>window.open('$authUrl', 'targetWindow', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=600')</script>";        $_SESSION["display_name_key"] = $username_key;         $_SESSION["display_name"] = $username;     }     else{         $_SESSION["login_error"] = "Login Fail Wrong Key";         header("Location: ".$_SERVER["PHP_SELF"]);         exit;     } } else if (isset($_GET['code'])) {    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);    $client->setAccessToken($token);    $_SESSION['upload_token'] = $token;    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));    }else if (!empty($_SESSION['upload_token'])) {    $client->setAccessToken($_SESSION['upload_token']);    echo "<script>  if (window.opener != null){ opener.location.href = '".$_SERVER["PHP_SELF"]."'; close();}</script>";    $status= true;    if ($client->isAccessTokenExpired()) {        unset($_SESSION['upload_token']);        $status= false;    }    if($status !== false){        $about = $service->about->get(array('fields' => '*'));        $_SESSION["email_login"] = $email_login = $about->user->emailAddress;        $_SESSION["name_login"] = $name_login = $about->user->displayName;    }}if(empty($_SESSION['upload_token'])){      $authUrl = $client->createAuthUrl();   include "google/login.php";      $status= false;} if($status){    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $client->getAccessToken() ) {        if (!file_exists('files')) {          mkdir('files', 0777, true);        }        $labels = $_POST["values"];        $row = array();        $j=0;        $file_names = $_FILES["values"]["name"];        $file_keys = array_keys($file_names);        foreach($file_names as $file_name){        $tmp = explode(".", $file_name);        $ext = end($tmp);        $new_value = array($file_keys[$j] => $file_keys[$j].".".$ext);        $labels = $labels + $new_value;        print_r($ext);        $j++;    }    $keys = array_keys($labels);    if(isset($server)){         $conn = new PDO("mysql:host=$server;dbname=$db", $user, $pass);         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);         $direct_attributes = "";         $direct_values = "";         $excepted_attrs = array();         if(isset($auth_file)){             $attr = array($_SESSION["display_name_key"] => $_SESSION["display_name"]);             $row = $row + $attr;         }         foreach($direct_to_db_folder as $j => $attr){             $direct_attributes = $direct_attributes.$direct_to_db_table[$j];             $value_index = array_search($attr, $labels);             $data = str_replace('"', '\"', $values[$value_index]);             $direct_values = $direct_values.'"'.$data.'"';              array_push($excepted_attrs,$labels[$value_index]);             if($j < count($direct_to_db_folder)-1) {                 $direct_attributes = $direct_attributes.",";                 $direct_values = $direct_values.",";             }         }         $query = "INSERT INTO ".$table_name."(".$direct_attributes.") VALUES(".$direct_values.")";         $sql = $conn->prepare($query);         $sql->execute();         $lastInsertId = $conn->lastInsertId();          $query ="SHOW KEYS FROM ".$table_name." WHERE Key_name = 'PRIMARY'";         $sql = $conn->prepare($query);         $sql->execute();         $result = $sql->fetchAll();         foreach( $result as $baris ) {             $primary_column = $baris["Column_name"];          }         $attr = array($primary_column => $lastInsertId);          $row = $row + $attr;          $json_name = "update.json";         $i = 0;         foreach($values as $value){             $is_value = true;             foreach($excepted_attrs as $excepted_attr){                 if($labels[$i] == $excepted_attr) $is_value = false;             }             if($is_value){                 if(is_array($value)) $attr = array($labels[$keys[$i]] => implode(", ",$value));                  else $attr = array($labels[$keys[$i]] => $value);                 $row = $row + $attr;             }         $i++;         }     }     else{         $json_name = "insert.json";        $i = 0;        foreach($labels as $value){            if(is_array($value)){                $attr = array($keys[$i] => implode(", ",$value));            }else $attr = array($keys[$i] => $value);            $row = $row + $attr; $i++;        }        $myJSON = json_encode($row);        $fp = fopen("files/".$json_name, "w");        fwrite($fp, $myJSON);        fclose($fp);        $namaFoldSync = "";        $optParams = array(            'pageSize' => 1,            'orderBy' => 'modifiedTime asc',            'fields' => 'nextPageToken, files',            'q' => "name = '".$folderFormName."' and mimeType = 'application/vnd.google-apps.folder'"        );        $searchFolder = $service->files->listFiles($optParams);        foreach ($searchFolder->getFiles() as $file) {            $idFold = $file->getId();        }        if(empty($idFold)){            $file = new Google_Service_Drive_DriveFile();            $file->setName($folderFormName);            $file->setMimeType('application/vnd.google-apps.folder');            $service->files->create($file);            $optParams = array(                'pageSize' => 1,                'fields' => 'nextPageToken, files',                'q' => "name = '".$folderFormName."' and mimeType = 'application/vnd.google-apps.folder'"            );            $searchFolder = $service->files->listFiles($optParams);            foreach ($searchFolder->getFiles() as $file) {                $idFold = $file->getId();            }        }        $fileMetadata = new Google_Service_Drive_DriveFile(array(            'name' => "$folderFormName",            'parents' => array($idFold),            'mimeType' => 'application/vnd.google-apps.folder'));        $file = $service->files->create($fileMetadata, array('fields' => 'id'));        $folderIdSave = $file->id;        $userPermission = new Google_Service_Drive_Permission(array(            'type' => 'user',            'role' => 'writer',            'emailAddress' => 'yudipratistha@gmail.com'        ));        $request = $service->permissions->create($folderIdSave, $userPermission, array('fields' => 'id'));        $k = 0;        $file_names = $_FILES["values"]["name"];        $file_keys = array_keys($file_names);        $files = $_FILES["values"]["tmp_name"];        $file = new Google_Service_Drive_DriveFile();        $file->setParents([$folderIdSave]);        $file->setName('insert.json');        $content = file_get_contents('files/insert.json');        $result2 = $service->files->create($file,array('data' => $content, 'mimeType' => 'application/json', 'uploadType' => 'multipart'));        $file = new Google_Service_Drive_DriveFile();        $file->setName("Attachment");        $file->setParents([$folderIdSave]);        $file->setMimeType('application/vnd.google-apps.folder');        $folderAttachment = $service->files->create($file, array('fields' => 'id'));        $folderAttachmentId = $folderAttachment->id;        foreach ($files as $file){            $file_name = basename($_FILES["values"]["name"][$file_keys[$k]]);            $tmp = explode(".", $file_name);            $ext = end($tmp);            $target_file = "files/" . $file_keys[$k] . "." . $ext;            move_uploaded_file($file, $target_file);            $file = new Google_Service_Drive_DriveFile();            $file->setName($file_keys[$k] . "." . $ext);            $file->setParents([$folderAttachmentId]);            $content = file_get_contents("files/" .$file_keys[$k] . "." . $ext);            $result2 = $service->files->create($file, array(                'data' => $content,                'mimeType' => "image/'".$ext."'",                'uploadType' => 'multipart'            ));        $k++;        unlink($target_file);        }    }    header("Location: " . $_SERVER["PHP_SELF"]);    exit;}?>                     <?php include "sidebar.php"; ?>                    <div class="container border border-top-0 mt-5 shadow-sm"><form class="form-border form-horizontal" method="POST" enctype="multipart/form-data"><fieldset><div id="legend" class=""><legend class="legend-border-title">Form Data Pegawai</legend></div><div class="form-group"><label class="col-md-6 control-label" for="input01">Nomor Induk Pegawai</label><div class="col-md-6"><input type="number" placeholder="NIP" class="form-control input-md" name="values[nomor_induk_pegawai]"><p class="help-block"></p></div></div><div class="form-group"><!-- Text input--><label class="col-md-6 control-label" for="input01">Nama Pegawai</label><div class="col-md-6"><input type="text" placeholder="nama pegawai" class="form-control input-md" name="values[nama_pegawai]"><p class="help-block"></p></div></div><div class="form-group"><label class="col-md-6 control-label">Jenis Kelamin</label><div class="col-md-6"><!-- Multiple Radios --><div class="form-check-inline"> <label class="radio"><input type="radio" class="form-check-input" value="Laki-laki" name="values[jenis_kelamin_pegawai][]" checked="checked">Laki-laki</label></div><div class="form-check-inline"> <label class="radio"><input type="radio" class="form-check-input" value="Perempuan" name="values[jenis_kelamin_pegawai][]">Perempuan</label></div></div></div><div class="form-group"><!-- Text input--><label class="col-md-6 control-label" for="input01">Foto Pegawai</label><div class="col-md-6"><input type="file" value="file_1" class="form-control input-md" name="values[foto_pegawai]"><p class="help-block"></p></div></div><div class="form-group"><!-- Table Modal--><label class="col-md-6 control-label" for="input01">Pilih Instansi</label><div class="col-md-6"><input data-toggle="modal" data-target="#table-modal-instansi_id" type="tablemodal" placeholder="instansi" class="form-control input-md" name="values[instansi_id]" id="tm-radio-instansi_id"><p class="help-block"></p></div><div class="col-md-6" id="table-modal"><div class="modal" id="table-modal-instansi_id"><div class="modal-dialog modal-xl modal-dialog-scrollable"><div class="modal-content"><div class="modal-header"><h4 class="modal-title">Select Data</h4><button type="button" class="close" data-dismiss="modal">×</button></div><div class="modal-body"><div class="table-responsive"><table id="example" class="table table-striped table-bordered dataTable no-footer"><thead><tr><th></th><th>nama_instansi</th></tr></thead><tbody><tr><td><center><input class="tm-radio-instansi_id" type="radio" name="values[instansi_id]" value="1"></center></td><td>Dinas Pendidikan</td></tr><tr><td><center><input class="tm-radio-instansi_id" type="radio" name="values[instansi_id]" value="2"></center></td><td>Dinas Kominfo</td></tr><tr><td><center><input class="tm-radio-instansi_id" type="radio" name="values[instansi_id]" value="3"></center></td><td>Dinas Peternakan dan Kesehatan Hewan</td></tr><tr><td><center><input class="tm-radio-instansi_id" type="radio" name="values[instansi_id]" value="4"></center></td><td>Dinas Perkebunan</td></tr><tr><td><center><input class="tm-radio-instansi_id" type="radio" name="values[instansi_id]" value="5"></center></td><td>Dinas Catatan Sipil</td></tr><tr><td><center><input class="tm-radio-instansi_id" type="radio" name="values[instansi_id]" value="6"></center></td><td>Dinas Kesehatan</td></tr><tr><td><center><input class="tm-radio-instansi_id" type="radio" name="values[instansi_id]" value="7"></center></td><td>Dinas Pariwisata</td></tr></tbody></table></div></div><div class="modal-footer"><button id="btn-delete-selected-instansi_id" type="button" class="btn btn-danger">Delete Selected</button><button data-dismiss="modal" type="button" class="btn btn-primary">Submit Selected</button></div></div></div></div><script>$('.table').DataTable();$('.tm-radio-instansi_id').on('click', function(event){var tds =new Array();var class_name = this.className;var row = $(this).parent().closest('tr');row.find('td').each (function() {var count = $(this).children().length;if(count == 0) tds.push($(this).html());});var tds_string = tds.join(', ');$('#'+class_name).val(tds_string);});$('.readonly').on('keydown paste', function(e){e.preventDefault();});$('#btn-delete-selected-instansi_id').click(function() {$('.tm-radio-instansi_id').prop('checked', false);$('#tm-radio-instansi_id').val('');});</script></div></div><div class="form-group"><!-- Button --><div class="col-md-6"><button class="btn btn-success">Submit</button></div></div></fieldset></form>                    </div>                </div>            </main>        </div>    </body>    <script type="text/javascript">        $('a[href="' + window.location.pathname.split('/').pop() + '"]').parent().addClass("active");        $('.sidebar-content > a').click(function(){            $('.sidebar-content').removeClass('active');            $(this).parent().addClass("active");        });        $(".sidebar-dropdown > a").click(function() {            $(".sidebar-submenu").slideUp(200);            if ($(this).parent().hasClass("active")) {                $(".sidebar-dropdown").removeClass("active");                $(this).parent().removeClass("active");            } else {                $(".sidebar-dropdown").removeClass("active");                $(this).next(".sidebar-submenu").slideDown(200);                $(this).parent().addClass("active");            }        });$("#close-sidebar").click(function() {            $(".page-wrapper").removeClass("toggled");        });        $("#show-sidebar").click(function() {            $(".page-wrapper").addClass("toggled");        });    </script>    <?php } ?></html>