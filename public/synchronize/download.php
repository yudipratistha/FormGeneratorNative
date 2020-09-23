<?php 
$oauth_credentials = __DIR__ ."/google/oauth-credentials.json";
include_once __DIR__ . '/google/autoload.php';
$folderFormName = "Form Data Mahasiswa"; 
session_start();
$redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
$client = new Google_Client();
$client->setAuthConfig($oauth_credentials);
$client->setRedirectUri($redirect_uri);
$client->addScope("https://www.googleapis.com/auth/drive");
$service = new Google_Service_Drive($client);
if (isset($_REQUEST['logout'])) {
  unset($_SESSION['upload_token']);
}
  if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token);
    $_SESSION['upload_token'] = $token;header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
  }if (!empty($_SESSION['upload_token'])) {
    $client->setAccessToken($_SESSION['upload_token']);
    if ($client->isAccessTokenExpired()) {
      unset($_SESSION['upload_token']);
    }
  }else {
    $authUrl = $client->createAuthUrl();
  }


if ($_SERVER['REQUEST_METHOD'] == 'POST' && $client->getAccessToken() ) {
  $labels = $_POST["values"];
  $row = array();
  $j=0;
$file_names = $_FILES["values"]["name"];

$file_keys = array_keys($file_names);
// print_r($file_keys);   

foreach($file_names as $file_name){  
    $tmp = explode(".", $file_name);
    $ext = end($tmp);
    $new_value = array($file_keys[$j] => $file_keys[$j].".".$ext);
    $labels = $labels + $new_value;    
    // print_r(array($file_keys[$j] => $file_keys)); 
    print_r($ext);
    $j++;
  }
    $keys = array_keys($labels);
    // print_r($keys);
  $json_name = "insert.json";
          $i = 0;
          foreach($labels as $value){
              if(is_array($value)){
                $attr = array($keys[$i] => implode(", ",$value));
                // print_r($attr);
              }else $attr = array(
                $keys[$i] => $value
            );
              $row = $row + $attr; $i++;
              // print_r($attr);
          }
          $myJSON = json_encode($row); 
      $fp = fopen("files/".$json_name, "w"); 
      fwrite($fp, $myJSON); 
      fclose($fp);

  $folderName = $folderFormName;
  $namaFoldSync = '';
  $optParams = array(
    'pageSize' => 20,
    'orderBy' => 'modifiedTime asc',
    'fields' => 'nextPageToken, files',
    'q' => "name = '".$folderName."' and 'me' in owners and mimeType = 'application/vnd.google-apps.folder'"
    // 'q' => "name = '".$folderName."' and sharedWithMe and mimeType = 'application/vnd.google-apps.folder'"
  );

  $results = $service->files->listFiles($optParams);
  foreach ($results->getFiles() as $files) {
      $idFoldSync = $files->getId();
      $namaFoldSync = $files->getName();
      // $namaFoldSync = $files->getName();
      // print($idFoldSync);
      // print_r($namaFoldSync);
  }
  if($folderFormName === $namaFoldSync){
    // print($idFoldSync);
  }else{
    $file = new Google_Service_Drive_DriveFile();
    $file->setName($folderFormName);
    $file->setMimeType('application/vnd.google-apps.folder');
    $folderSync = $service->files->create($file);
    
  }
  
   $optParams = array(
    'pageSize' => 1,
    'orderBy' => 'modifiedTime asc',
    'fields' => 'nextPageToken, files',
    'q' => "name = '".$folderName."' and mimeType = 'application/vnd.google-apps.folder'"
  );

  $results = $service->files->listFiles($optParams);
  foreach ($results->getFiles() as $files) {
      $idFoldSync = $files->getId();
      $namaFoldSync = $files->getName();
      // $namaFoldSync = $files->getName();
      // print($idFoldSync);
      // print_r($files->getParents());
  }

  $fileMetadata = new Google_Service_Drive_DriveFile(array(
    'name' => "$folderFormName",
    'parents' => array($idFoldSync),
    'mimeType' => 'application/vnd.google-apps.folder'));
  $file = $service->files->create($fileMetadata, array(
      'fields' => 'id',
  )); 
  $folderIdSave = $file->id;
  $userPermission = new Google_Service_Drive_Permission(array(
    'type' => 'user',
    'role' => 'writer',
    'emailAddress' => 'yudipratistha@gmail.com'
  ));
  $request = $service->permissions->create(
    $folderIdSave, $userPermission, array('fields' => 'id')
  );

  // }
  //  $file_name = "data".".json"; 
  //  $values = $_POST["value"]; 
  //  $att = $_POST["input_att"]; 
  //  $keys = array_keys($values); 
  //  $i = 0; 
  //  $row = array(); 
  //  foreach($values as $value){ 
  //    if(is_array($value)) 
  //    $attr = array($labels[$keys[$i]] => array_values($value)); 
  //    else $attr = array($labels[$keys[$i]] => $value); 
  //    $row = $row + $attr; $i++; 
  //   } 
  // $myJSON = json_encode($row); 
  // $fp = fopen($file_name, "w"); 
  // fwrite($fp, $myJSON); 
  // fclose($fp); 


  // $optParams = array('pageSize' => 1,'fields' => 'nextPageToken, files','q' => "name = '".$folderFormName."' and mimeType = 'application/vnd.google-apps.folder'");
  // $searchFolder = $service->files->listFiles($optParams);
  // foreach ($searchFolder->getFiles() as $file) {
  //   $folderSearchId = $file->getId();
  // }
  $k = 0;
  $file_names = $_FILES["values"]["name"];
  $file_keys = array_keys($file_names);
  $files = $_FILES["values"]["tmp_name"];
  // print_r($file_keys);
    $file = new Google_Service_Drive_DriveFile();
    $file->setParents([$folderIdSave]);
    $file->setName('insert.json'); 
    $content = file_get_contents('files/insert.json');
    $result2 = $service->files->create($file,array('data' => $content, 'mimeType' => 'application/json', 'uploadType' => 'multipart'));

    $file = new Google_Service_Drive_DriveFile();
    $file->setName("Attachment");
    $file->setParents([$folderIdSave]);
    $file->setMimeType('application/vnd.google-apps.folder');
    $folderAttachment = $service->files->create($file, array(
      'fields' => 'id',
  ));
  $folderAttachmentId = $folderAttachment->id;
    foreach ($files as $file){
      $file_name = basename($_FILES["values"]["name"][$file_keys[$k]]);
      $tmp = explode(".", $file_name);
      $ext = end($tmp);
      // print_r($file_keys[$k]);
      $target_file = "files/" . $file_keys[$k] . "." . $ext;
      move_uploaded_file($file, $target_file);
      $file = new Google_Service_Drive_DriveFile();
      $file->setName($file_keys[$k] . "." . $ext);
      $file->setParents([$folderAttachmentId]);
      $content = file_get_contents("files/" .$file_keys[$k] . "." . $ext);
      $result2 = $service->files->create(
          $file,
          array(
            'data' => $content,
            'mimeType' => "image/'".$ext."'",
            'uploadType' => 'multipart'
          )
      );
      $k++;
      unlink($target_file);
    }
  }

    ?> 
    <html>
    <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script><body>
    
      <div class="box">
<?php if (isset($authUrl)): ?>
  <div class="request">
    <a class='login' href='<?= $authUrl ?>'>Loggin</a>
  </div>
<?php else: ?>
  <fieldset>
  <div id="legend" class="" data-toggle="popover" aria-describedby="popover930838">
      <legend class="legend-border-title">Form Data Mahasiswa</legend>
  </div>
          

    
  <form method="POST" enctype="multipart/form-data">
    <div class="form-group" data-toggle="popover" aria-describedby="popover764735">

      <!-- Text input-->
      <label class="col-md-6 control-label" for="input01">Text input</label>
      <div class="col-md-6">
        <input type="text" placeholder="Nama" class="form-control input-md" name="values[nama]" id="attr">
        <p class="help-block"></p>
      </div>
    </div><div class="form-group" data-toggle="popover" aria-describedby="popover747829">

      <!-- Text input-->
      <label class="col-md-6 control-label" for="input01">Text input</label>
      <div class="col-md-6">
        <input type="text" placeholder="alamat" class="form-control input-md" name="values[alamat]" id="attr">
        <p class="help-block"></p>
      </div>
    </div>
    <div class="form-group" data-toggle="popover" aria-describedby="popover497138">
      <label class="col-md-6 control-label">Checkboxes</label>
      <div class="col-md-6">
      <!-- Multiple Checkboxes -->
      <label class="checkbox">
        <input class="" type="checkbox" value="Option one" name="values[checkbox][]" id-attr="attr" id="attr">
        Option one
      </label>
      <label class="checkbox">
        <input class="" type="checkbox" value="gfhf" name="values[checkbox][]" id-attr="attr" id="attr">
        gfhf
      </label>
      <label class="checkbox">
        <input class="" type="checkbox" value="uijh" name="values[checkbox][]" id-attr="attr" id="attr">
        uijh
      </label>
  </div>
  <div class="form-group">
          <label class="col-md-4 control-label">File Button</label>

          <!-- File Upload -->
          <div class="col-md-4">
            <input class="input-file" id="fileInput" name="values[foto]" type="file">
          </div>
        </div> 
        <div class="form-group">
          <label class="col-md-4 control-label">File s</label>

          <!-- File Upload -->
          <div class="col-md-4">
            <input class="input-file" id="fileInput" name="values[foto2]" type="file">
          </div>
        </div> 
    <div class="form-group" aria-describedby="popover18588">
    <!-- Button -->
    <div class="col-md-4">
      <button type="submit" class="btn btn-primary">Button</button>
    </div>
  </div>

    </fieldset>
</form>

<?php endif ?>
</div>

          
</body></head></html>