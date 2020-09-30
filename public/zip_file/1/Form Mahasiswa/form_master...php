


<?php $oauth_credentials = __DIR__ ."/google/secret/oauth.json";include_once __DIR__ . '/google/autoload.php';$folderFormName = "form_master.."; session_start();$redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];$client = new Google_Client();$client->setAuthConfig($oauth_credentials);$client->setRedirectUri($redirect_uri);$client->addScope("https://www.googleapis.com/auth/drive");$service = new Google_Service_Drive($client);if (isset($_REQUEST['logout'])) {    unset($_SESSION['upload_token']);    unset($_SESSION['email_login']);    header("Location: " . $_SERVER["PHP_SELF"]);    exit;}else if(isset($_POST["password"]) ){        $password = $_POST["password"];     $logged_in = false;     $auth_file = file_get_contents($auth_file);     $auths = json_decode($auth_file);     $auth_keys = array_keys((array)$auths[0]);     foreach($auth_keys as $i => $auth_key){         if($i == 0) $username_key = $auth_key;         else  $password_key = $auth_key;     }     foreach($auths as $auth){         $auth = (array)$auth;         if($password == $auth[$password_key]) {             $logged_in = true;             $username =  $auth[$username_key];         }     }     if($logged_in){         $authUrl = $client->createAuthUrl();        echo "<script>window.open('$authUrl', 'targetWindow', 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=600')</script>";        $_SESSION["display_name_key"] = $username_key;         $_SESSION["display_name"] = $username;     }     else{         $_SESSION["login_error"] = "Login Fail Wrong Key";         header("Location: ".$_SERVER["PHP_SELF"]);         exit;     } } else if (isset($_GET['code'])) {    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);    $client->setAccessToken($token);    $_SESSION['upload_token'] = $token;    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));    }else if (!empty($_SESSION['upload_token'])) {    $client->setAccessToken($_SESSION['upload_token']);    echo "<script>  if (window.opener != null){ opener.location.href = '".$_SERVER["PHP_SELF"]."'; close();}</script>";    $status= true;    if ($client->isAccessTokenExpired()) {        unset($_SESSION['upload_token']);        $status= false;    }    if($status !== false){        $about = $service->about->get(array('fields' => '*'));        $_SESSION["email_login"] = $email_login = $about->user->emailAddress;    }}if(empty($_SESSION['upload_token'])){      $authUrl = $client->createAuthUrl();   include "google/login.php";      $status= false;} if($status){    if ($_SERVER['REQUEST_METHOD'] == 'POST' && $client->getAccessToken() ) {        if (!file_exists('files')) {          mkdir('files', 0777, true);        }        $labels = $_POST["values"];        $row = array();        $j=0;        $file_names = $_FILES["values"]["name"];        $file_keys = array_keys($file_names);        foreach($file_names as $file_name){        $tmp = explode(".", $file_name);        $ext = end($tmp);        $new_value = array($file_keys[$j] => $file_keys[$j].".".$ext);        $labels = $labels + $new_value;        print_r($ext);        $j++;    }    $keys = array_keys($labels);    if(isset($server)){         $conn = new PDO("mysql:host=$server;dbname=$db", $user, $pass);         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);         $direct_attributes = "";         $direct_values = "";         $excepted_attrs = array();         if(isset($auth_file)){             $attr = array($_SESSION["display_name_key"] => $_SESSION["display_name"]);             $row = $row + $attr;         }         foreach($direct_to_db_folder as $j => $attr){             $direct_attributes = $direct_attributes.$direct_to_db_table[$j];             $value_index = array_search($attr, $labels);             $data = str_replace('"', '\"', $values[$value_index]);             $direct_values = $direct_values.'"'.$data.'"';              array_push($excepted_attrs,$labels[$value_index]);             if($j < count($direct_to_db_folder)-1) {                 $direct_attributes = $direct_attributes.",";                 $direct_values = $direct_values.",";             }         }         $query = "INSERT INTO ".$table_name."(".$direct_attributes.") VALUES(".$direct_values.")";         $sql = $conn->prepare($query);         $sql->execute();         $lastInsertId = $conn->lastInsertId();          $query ="SHOW KEYS FROM ".$table_name." WHERE Key_name = 'PRIMARY'";         $sql = $conn->prepare($query);         $sql->execute();         $result = $sql->fetchAll();         foreach( $result as $baris ) {             $primary_column = $baris["Column_name"];          }         $attr = array($primary_column => $lastInsertId);          $row = $row + $attr;          $json_name = "update.json";         $i = 0;         foreach($values as $value){             $is_value = true;             foreach($excepted_attrs as $excepted_attr){                 if($labels[$i] == $excepted_attr) $is_value = false;             }             if($is_value){                 if(is_array($value)) $attr = array($labels[$keys[$i]] => implode(", ",$value));                  else $attr = array($labels[$keys[$i]] => $value);                 $row = $row + $attr;             }         $i++;         }     }     else{         $json_name = "insert.json";        $i = 0;        foreach($labels as $value){            if(is_array($value)){                $attr = array($keys[$i] => implode(", ",$value));            }else $attr = array($keys[$i] => $value);            $row = $row + $attr; $i++;        }        $myJSON = json_encode($row);        $fp = fopen("files/".$json_name, "w");        fwrite($fp, $myJSON);        fclose($fp);        $folderName = $folderFormName;        $namaFoldSync = "";        $optParams = array(            'pageSize' => 20,            'orderBy' => 'modifiedTime asc',            'fields' => 'nextPageToken, files',            'q' => "name = '".$folderName."' and 'me' in owners and mimeType = 'application/vnd.google-apps.folder'"        );        $results = $service->files->listFiles($optParams);        foreach ($results->getFiles() as $files) {            $idFoldSync = $files->getId();            $namaFoldSync = $files->getName();        }        if($folderFormName === $namaFoldSync);        else{            $file = new Google_Service_Drive_DriveFile();            $file->setName($folderFormName);            $file->setMimeType('application/vnd.google-apps.folder');            $folderSync = $service->files->create($file);        }        $optParams = array(            'pageSize' => 1,            'orderBy' => 'modifiedTime asc',            'fields' => 'nextPageToken, files',            'q' => "name = '".$folderName."' and mimeType = 'application/vnd.google-apps.folder'"        );        $results = $service->files->listFiles($optParams);        foreach ($results->getFiles() as $files) {            $idFoldSync = $files->getId();            $namaFoldSync = $files->getName();        }        $fileMetadata = new Google_Service_Drive_DriveFile(array(            'name' => "$folderFormName",            'parents' => array($idFoldSync),            'mimeType' => 'application/vnd.google-apps.folder'));        $file = $service->files->create($fileMetadata, array('fields' => 'id'));        $folderIdSave = $file->id;        $userPermission = new Google_Service_Drive_Permission(array(            'type' => 'user',            'role' => 'writer',            'emailAddress' => 'yudipratistha@gmail.com'        ));        $request = $service->permissions->create($folderIdSave, $userPermission, array('fields' => 'id'));        $k = 0;        $file_names = $_FILES["values"]["name"];        $file_keys = array_keys($file_names);        $files = $_FILES["values"]["tmp_name"];        $file = new Google_Service_Drive_DriveFile();        $file->setParents([$folderIdSave]);        $file->setName('insert.json');        $content = file_get_contents('files/insert.json');        $result2 = $service->files->create($file,array('data' => $content, 'mimeType' => 'application/json', 'uploadType' => 'multipart'));        $file = new Google_Service_Drive_DriveFile();        $file->setName("Attachment");        $file->setParents([$folderIdSave]);        $file->setMimeType('application/vnd.google-apps.folder');        $folderAttachment = $service->files->create($file, array('fields' => 'id'));        $folderAttachmentId = $folderAttachment->id;        foreach ($files as $file){            $file_name = basename($_FILES["values"]["name"][$file_keys[$k]]);            $tmp = explode(".", $file_name);            $ext = end($tmp);            $target_file = "files/" . $file_keys[$k] . "." . $ext;            move_uploaded_file($file, $target_file);            $file = new Google_Service_Drive_DriveFile();            $file->setName($file_keys[$k] . "." . $ext);            $file->setParents([$folderAttachmentId]);            $content = file_get_contents("files/" .$file_keys[$k] . "." . $ext);            $result2 = $service->files->create($file, array(                'data' => $content,                'mimeType' => "image/'".$ext."'",                'uploadType' => 'multipart'            ));        $k++;        unlink($target_file);        }    }    header("Location: " . $_SERVER["PHP_SELF"]);    exit;}?> <html>    <head>        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.11/dist/js/select2.min.js"></script>        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.11/dist/css/select2.min.css">        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>        <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>    </head>    <body>        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">            <div class="container">                <a class="navbar-brand" href="<?php $link = $_SERVER["PHP_SELF"];$link = substr($link, 1);$link = substr($link, 0, strpos($link, "/")); echo "/" . $link; ?>">Form Builder</a>                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">                    <span class="navbar-toggler-icon"></span>                </button>                <div class="collapse navbar-collapse" id="navbarSupportedContent">                    <ul class="navbar-nav ml-auto">                        <li class="nav-item dropdown">                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>                                <?php echo $_SESSION["email_login"]; ?>                            </a>                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">                                <a class="dropdown-item" href="?logout=yes">Logout</a>                            </div>                        </li>                    </ul>                </div>            </div>        </nav>        <div class="container border border-top-0 mt-5 shadow-sm"><form class="form-border form-horizontal" method="POST" enctype="multipart/form-data"><fieldset><div id="legend" class=""><legend class="legend-border-title">Untitled</legend></div><div class="form-group"><label class="col-md-6 control-label">Inline radios</label><div class="col-md-6"><!-- Inline Radios --><div class="form-check-inline"><label class="radio inline"><input class="form-check-input" type="radio" value="1" name="values[attr][]" checked="checked">1</label></div></div></div></fieldset></form>        </div>    </body>    <?php } ?></html>