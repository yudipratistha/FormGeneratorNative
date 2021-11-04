<?php

class formsController extends Controller{
    public function __construct(){
        require(ROOT . 'Models/Form.php');
        require(ROOT . 'Models/FormProject.php');
        require(ROOT . 'Models/SubForm.php');
        require __DIR__ . '../../vendor/autoload.php';
        session_start();
        if(!isset($_SESSION["user"])) header("Location: /formgeneratornative/auth/login");
    }

    function showAllForms($id){
        $forms = new Form();
        $d['forms'] = array_merge($forms->showAllForms($id), $forms->projectName($id));
        // header('Content-Type: application/json');
        //     echo json_encode($allForms);
        $this->set($d);
        $this->render("index");
    }

    function previewForm($id){
        $forms = new Form();

        $d['form'] = $forms->showForm($id);
        $this->set($d);
        $this->render("previewForm");
    }

    function updateProjectMenu(){
        $form = new form();

        foreach($_POST['form_menu_id'] as $i => $id){
            $form->updateprojectMenu($id, $_POST['form_menu_index'][$i]);
        }
        header("Location: " . WEBROOT . "formProject/index");
    }

    function delete($id){
        $form = new Form();
        if ($form->delete($id)){
            echo "success";
        }
    }

    public function createMysql($project_name, $forms){
        $sql = "";

        $sql = $sql."create DATABASE `".$project_name."`; ".PHP_EOL;
        $sql = $sql."USE `".$project_name."`; ".PHP_EOL;

        foreach($forms as $i => $form){
            $sql = $sql."DROP TABLE IF EXISTS `".str_replace(' ', '_', $form['form_name'])."`; ".PHP_EOL;
            $sql = $sql."create TABLE `".$form['form_name']."` ( ".PHP_EOL;
            $sql = $sql."`id` int(12) NOT NULL AUTO_INCREMENT, ".PHP_EOL;
            foreach(explode(',', $form['form_attr']) as $form_attr){
                $sql = $sql."`".$form_attr."` varchar(255) DEFAULT NULL, ".PHP_EOL;
            }
            $sql = $sql."PRIMARY KEY (`id`) ".PHP_EOL;
            $sql = $sql.") ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1; ".PHP_EOL;
        }
        return $sql;
    }

    function deleteDirectory($dir){
        $it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
        $files = new RecursiveIteratorIterator($it,
                    RecursiveIteratorIterator::CHILD_FIRST);
        foreach($files as $file) {
            if ($file->isDir()){
                rmdir($file->getRealPath());
            } else {
                unlink($file->getRealPath());
            }
        }
    }

    function copyDirectory($source, $dest, $permissions = 0777){
        $sourceHash = $this->hashDirectory($source);
        if (is_link($source)) {
            return symlink(readlink($source), $dest);
        }
        if (is_file($source)) {
            return copy($source, $dest);
        }
        if (!is_dir($dest)) {
            mkdir($dest, $permissions);
        }

        $dir = dir($source);
        while (false !== $entry = $dir->read()) {
            if ($entry == '.' || $entry == '..') {
                continue;
            }
            if($sourceHash != $this->hashDirectory($source."/".$entry)){
                 $this->copyDirectory("$source/$entry", "$dest/$entry", $permissions);
            }
        }
        $dir->close();
        return true;
    }
        
    function hashDirectory($directory){
        if (!is_dir($directory)){ return false; }
    
        $files = array();
        $dir = dir($directory);
    
        while (false !== ($file = $dir->read())){
            if ($file != '.' and $file != '..') {
                if (is_dir($directory . '/' . $file)) { $files[] = $this->hashDirectory($directory . '/' . $file); }
                else { $files[] = md5_file($directory . '/' . $file); }
            }
        }
    
        $dir->close();
    
        return md5(implode('', $files));
    }

    public function exportPhpProject($request){
        parse_str($request, $data);
        $formQuery = new Form();
        
        if(empty($data['checkform'])) return header("Location: " . WEBROOT . 'forms/show-All-Forms/'.strtok($request, '?'));
        foreach($data['checkform'] as $i => $checkform_id){          
            // $checkform_id = json_encode($checkform_id);
            if($i==0)$form = 'forms.`id` = '. $checkform_id;
            else$form = $form.' OR forms.`id` = '. $checkform_id;
        }
        $forms = $formQuery->getForm($form);

        $project = $formQuery->getProject(strtok($request, '?'));
        $user_path = $_SESSION['user']['id'].'/';
        

        $client = new Google_Client();
        $service = new Google_Service_Drive($client);
        // header('Content-Type: application/json');
        // print_r($project);
        $oauth_file = json_decode(file_get_contents(__DIR__ . '../../public/'.$project['project_oauth_file']), true);
        $token_file = json_decode(file_get_contents(__DIR__ . '../../public/'.$project['project_token_file']), true);
        
        $client->setAuthConfig($oauth_file);
        $client->setAccessType('offline');
        $client->setApprovalPrompt('force');

        $client->setAccessToken($token_file);
        
        if ($client->isAccessTokenExpired()) {
            if ($client->getRefreshToken()) {
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            }
            $project_token_file = $project['project_token_file'];
            $project_token_file = substr($project_token_file, 0, -11);
            $f=fopen($project_token_file.'/token.json','w+');
            fwrite($f,json_encode($client->getAccessToken()));
            fclose($f);
        }
        
        
        if (!file_exists('../public/zip_file/'.$user_path)) mkdir('../public/zip_file/'.$user_path, 0777, true); $this->deleteDirectory('../public/zip_file/'.$user_path);
        $project_path = $user_path.'/'.str_replace(' ', '_', $project['nama_project']).'/';
        $share_path = $user_path.'/'.str_replace(' ', '_', $project['nama_project']).'_share';
        if (!file_exists('../public/zip_file/'.$project_path)) mkdir('../public/zip_file/'.$project_path, 0777, true);
        if (!file_exists('../public/zip_file/'.$share_path)) mkdir('../public/zip_file/'.$share_path, 0777, true);
        if (!file_exists('../public/zip_file/'.$project_path."/google/secret/")) mkdir('../public/zip_file/'.$project_path."/google/secret/", 0777, true);
        if (!file_exists('../public/zip_file/'.$share_path."/google/secret/")) mkdir('../public/zip_file/'.$share_path."/google/secret/", 0777, true);
        if (!file_exists('../public/zip_file/'.$project_path."/google/secret/synchronize")) mkdir('../public/zip_file/'.$project_path."/google/secret/synchronize", 0777, true);
        // 
        $storage_path1 = '../public/google/';
        $storage_path3 = '../public/synchronize/';
        $storage_path2 = '../public/zip_file/' . $project_path;
        $storage_path4 = '../public/zip_file/' . $share_path;
        $storage_path5 = '../public/zip_file/' . $user_path;

        $this->copyDirectory($storage_path1, $storage_path2);
        $this->copyDirectory($storage_path1, $storage_path4);

        copy($project['project_oauth_file'], "../public/zip_file/".$project_path."/google/secret/oauth.json");
        copy($project['project_oauth_file'], "../public/zip_file/".$share_path."/google/secret/oauth.json");

        $project_name = str_replace(' ', '_', $project['nama_project']);
        foreach($forms as $i => $form){
            $this->export($form['form_id'], $share_path, $project_path);
        } 

        $create_admin_sidebar = $this->create_admin_sidebar($forms, $project['nama_project']);
        $filename_sidebar_admin = "sidebar-admin.php";
        $f=fopen("../public/zip_file/".$project_path."/".$filename_sidebar_admin,'w+');
        fwrite($f, $create_admin_sidebar);
        fclose($f);
        
        $sidebar = $this->create_sidebar($forms, $project['nama_project']);
        $filename = "sidebar.php";
        $f=fopen("../public/zip_file/".$share_path."/".$filename,'w+');
        fwrite($f, $sidebar);
        fclose($f);
        // $f=fopen("../public/zip_file/".$project_path.$filename,'w+');
        // fwrite($f, $sidebar);
        // fclose($f);
        
        $index = '<?php header("Location: '.$forms[0]['form_name'].'.php"); ?>';
        $filename = "index.php";
        $f=fopen("../public/zip_file/".$share_path."/".$filename,'w+');
        fwrite($f, $index);
        fclose($f);

        if(!empty($data['inputCheckbox'])){
            $sql = $this->createMysql(str_replace(' ', '_', $project['nama_project']), $forms);
            $sql_file_name = str_replace(' ', '_', $project['nama_project']).".sql";
            $f=fopen('../public/zip_file/'.$project_path.$sql_file_name, 'w+');
            fwrite($f, $sql);
            fclose($f);
        }
        
        $zip_file = str_replace(' ', '_', $project['nama_project']).'_share.zip';
        
        $zip = new \ZipArchive();
        $zip->open($storage_path2.$zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        $path = realpath('../public/zip_file/'.$share_path);
        $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
        
        foreach ($files as $name => $file){
            if (!$file->isDir()) {
                $filePath     = $file->getRealPath();
                $relativePath = str_replace(' ', '_', $project['nama_project']).'/'. substr($filePath, strlen($path));
                $zip->addFile($filePath, $relativePath);
            }
        }
        $zip->close();

        $this->copyDirectory($storage_path3, $storage_path2);
        copy($project['project_token_file'], "../public/zip_file/".$project_path."/google/secret/synchronize/token.json");

        $prepend = '<?php ';

        $prepend = $prepend.'$project_name="'.str_replace(' ', '_', $project['nama_project']).'"; ';
        $prepend = $prepend.'$tokenPath ="../google/secret/synchronize/token.json";';

        $i=0;
        foreach($forms as $form){
            $prepend = $prepend.'$form_attr["data"]['.$i.']["folder"]["name"] = "'.str_replace(' ', '_', $form['form_name']).'";';
            $prepend = $prepend.'$form_attr["data"]['.$i.']["folder"]["type"] = 0;';
            $formInputs = explode(',', $form['form_attr']);
            foreach($formInputs as $j => $forminput){
                $prepend = $prepend.'$form_attr["data"]['.$i.']["attribute"]['.$j.'] = "'.$forminput.'";';
            }
            $i++;
        }
        foreach($forms as $form){
            $prepend = $prepend.'$form_attr["data"]['.$i.']["folder"]["name"] = "'.str_replace(' ', '_', $form['sub_form_name']).'";';
            $prepend = $prepend.'$form_attr["data"]['.$i.']["folder"]["type"] = "'.str_replace(' ', '_', $form['form_name']).'";';
            $subFormInputs= explode(',', $form['sub_form_attr']);
            // header('Content-type: application/json');
            // echo json_encode($subFormInputs);
            foreach($subFormInputs as $j => $subFormInput){
                $prepend = $prepend.'$form_attr["data"]['.$i.']["attribute"]['.$j.'] = "'.$subFormInput.'";';
            }
            $prepend = $prepend.'$form_attr["data"]['.$i.']["attribute"]['.++$j.'] = "'.$form['form_name'].'_id";';
            $i++;
        }
        $prepend = $prepend.'if(!isset($_POST["server_name"])){ ?>';
        $prepend = $prepend.'<script>var form_attr = <?php echo json_encode($form_attr); ?>;</script> <?php } ?>';
        $file = '../public/zip_file/'.$project_path.'synchronize/engine_synchronize_set.php';
        $fileContents = file_get_contents($file);
        file_put_contents($file, $prepend . $fileContents);

        $zip_file = '../public/zip_file/'.$project_path.str_replace(' ', '_', $project['nama_project'].'.zip');
        $zip = new \ZipArchive();
        $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        $path = realpath('../public/zip_file/'.$project_path);
        $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
        
        foreach ($files as $name => $file){
            $filePath     = $file->getRealPath();
            $relativePath = str_replace(' ', '_', $project['nama_project']).'/'. substr($filePath, strlen($path));
            if (!$file->isDir()) {
                $zip->addFile($filePath, $relativePath);
            }
        }
        $zip->close();

        header('Content-Description: File Transfer');
        header('Content-Type: application/force-download');
        header("Content-Disposition: attachment; filename=\"" . basename($zip_file) . "\";");
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize(realpath($zip_file)));
        ob_clean();
        flush();
        readfile(realpath($zip_file));

        // Search Folder Sync
        $folderNameSync = "Sync";
        $optParams = array(
            'pageSize' => 1,
            'fields' => 'nextPageToken, files',
            'q' => "name = '".$folderNameSync."' and mimeType = 'application/vnd.google-apps.folder'"
        );
        $Sync = $service->files->listFiles($optParams);
        foreach ($Sync->getFiles() as $file) {
            $idFoldSync = $file->getId();
            $namaFoldSync = $file->getName();
        }

        if(empty($namaFoldSync)){
            $file = new Google_Service_Drive_DriveFile();
            $file->setName('Sync');
            $file->setMimeType('application/vnd.google-apps.folder');
            $folderSync = $service->files->create($file);
            $optParams = array(
                'pageSize' => 1,
                'fields' => 'nextPageToken, files',
                'q' => "name = '".$folderNameSync."' and mimeType = 'application/vnd.google-apps.folder'"
            );
            $Sync = $service->files->listFiles($optParams);
            foreach ($Sync->getFiles() as $file) {
                $idFoldSync = $file->getId();
                $namaFoldSync = $file->getName();
            }
        }
        // Search Project Folder 
        $optParams = array(
            'pageSize' => 1,
            'fields' => 'nextPageToken, files',
            'q' => "parents = '".$idFoldSync."' and name = '".$project_name."' and mimeType = 'application/vnd.google-apps.folder'"
        );
        $searchFolder = $service->files->listFiles($optParams);
        foreach ($searchFolder->getFiles() as $file) {
            $idProjFold = $file->getId();
            $folderNameSearch = $file->getName();
        }
        if(empty($folderNameSearch)){
            $file = new Google_Service_Drive_DriveFile();
            $file->setParents([$idFoldSync]);
            $file->setName($project_name);
            $file->setMimeType('application/vnd.google-apps.folder');
            $service->files->create($file);
            $optParams = array(
                'pageSize' => 1,
                'fields' => 'nextPageToken, files',
                'q' => "parents = '".$idFoldSync."' and name = '".$project_name."' and mimeType = 'application/vnd.google-apps.folder'"
            );
            $searchFolder = $service->files->listFiles($optParams);
            foreach ($searchFolder->getFiles() as $file) {
                $idProjFold = $file->getId();
                $folderNameSearch = $file->getName();
            }
        }

        //search out of sync
        $optParams = array(
            'pageSize' => 1,
            'fields' => 'nextPageToken, files',
            'q' => "name = 'Out of Sync' and mimeType = 'application/vnd.google-apps.folder'"
        );
        $OutofSync = $service->files->listFiles($optParams);
        foreach ($OutofSync->getFiles() as $file) {
            $idFoldOutOfSync = $file->getId();
            $namaFoldOutofSync = $file->getName();
        }
        if(empty($namaFoldOutofSync)){
            $file = new Google_Service_Drive_DriveFile();
            $file->setName('Out of Sync');
            $file->setMimeType('application/vnd.google-apps.folder');
            $folderOutofSync = $service->files->create($file);
            // print("Folder Sukses");
            $optParams = array(
                'pageSize' => 1,
                'fields' => 'nextPageToken, files',
                'q' => "name = 'Out of Sync' and mimeType = 'application/vnd.google-apps.folder'"
            );
            $OutofSync = $service->files->listFiles($optParams);
            foreach ($OutofSync->getFiles() as $file) {
                $idFoldOutOfSync = $file->getId();
                $namaFoldOutofSync = $file->getName();
            }
        }
      
        // Search Project Folder 
        $optParams = array(
            'pageSize' => 1,
            'fields' => 'nextPageToken, files',
            'q' => "parents = '".$idFoldOutOfSync."' and name = '".$project_name."' and mimeType = 'application/vnd.google-apps.folder'"
        );
        $searchFolder = $service->files->listFiles($optParams);
        foreach ($searchFolder->getFiles() as $file) {
            // printf("%s (%s)\n", $file->getName(), $file->getId());
            $idProjFoldOut = $file->getId();
            $folderNameOutSearch = $file->getName();
        }
        
        if(empty($folderNameOutSearch)){
            // return response()->json($project_name);
            $file = new Google_Service_Drive_DriveFile();
            $file->setParents([$idFoldOutOfSync]);
            $file->setName($project_name);
            $file->setMimeType('application/vnd.google-apps.folder');
            $service->files->create($file);
            $optParams = array(
                'pageSize' => 1,
                'fields' => 'nextPageToken, files',
                'q' => "parents = '".$idFoldOutOfSync."' and name = '".$project_name."' and mimeType = 'application/vnd.google-apps.folder'"
            );
            $searchFolder = $service->files->listFiles($optParams);
            foreach ($searchFolder->getFiles() as $file) {
                // printf("%s (%s)\n", $file->getName(), $file->getId());
                $idProjFoldOut = $file->getId();
                $folderNameOutSearch = $file->getName();
            }
        }

        foreach($forms as $i => $form){
            $form_name = str_replace(' ', '_', $form['form_name']);
          
            $optParams = array(
                'pageSize' => 1,
                'fields' => 'nextPageToken, files',
                'q' => "parents = '".$idProjFold."' and name = '".$form_name."' and mimeType = 'application/vnd.google-apps.folder'"
            );
            $searchFolder = $service->files->listFiles($optParams);
            foreach ($searchFolder->getFiles() as $file) {
                // printf("%s (%s)\n", $file->getName(), $file->getId());
                $formNameSearch = $file->getName();
            }
            if(empty($formNameSearch)){
                $file = new Google_Service_Drive_DriveFile();
                $file->setParents([$idProjFold]);
                $file->setName($form_name);
                $file->setMimeType('application/vnd.google-apps.folder');
                $service->files->create($file);
            }

            $optParams = array(
                'pageSize' => 1,
                'fields' => 'nextPageToken, files',
                'q' => "parents = '".$idProjFoldOut."' and name = '".$form_name."' and mimeType = 'application/vnd.google-apps.folder'"
            );
            $searchFolder = $service->files->listFiles($optParams);
            foreach ($searchFolder->getFiles() as $file) {
                // printf("%s (%s)\n", $file->getName(), $file->getId());
                $formNameOutSearch = $file->getName();
            }
            if(empty($formNameOutSearch)){
                $file = new Google_Service_Drive_DriveFile();
                $file->setParents([$idProjFoldOut]);
                $file->setName($form_name);
                $file->setMimeType('application/vnd.google-apps.folder');
                $service->files->create($file);
            }
        }
        exit;
    }

    public function export($id, $share_path, $project_path){
        $formQuery = new Form();
        $projects = new FormProject();
        $form = $formQuery->getForm('forms.`id` = '.$id);
        $project = $projects->showFormProject($form[0]['form_projects_id']);
        // print_r($form[0]['form_projects_id']);
        $client = new Google_Client();
        $service = new Google_Service_Drive($client);
        $oauth_file = json_decode(file_get_contents(__DIR__ . '../../public/'.$project['project_oauth_file']), true);
        $token_file = json_decode(file_get_contents(__DIR__ . '../../public/'.$project['project_token_file']), true);
        $client->setAuthConfig($oauth_file);
        $client->setAccessType('offline');
        $client->setApprovalPrompt('force');
        $client->setAccessToken($token_file);
        if ($client->isAccessTokenExpired()) {
            if ($client->getRefreshToken()) {
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            } 
            $project_token_file = $project['project_token_file'];
            $project_token_file = substr($project_token_file, 0, -11);
            $f=fopen($project_token_file.'/token.json','w+');
            fwrite($f,json_encode($client->getAccessToken()));
            fclose($f);
        }

        //var subform
        $about = $service->about->get(array('fields' => '*'));
        $project_email = $about->user->emailAddress;
        $request = (array)$form;
        $request['project_email'] = $project_email;
        $request['project_name'] = $project['nama_project'];
        $request['form_name'] = $form[0]['form_name'];
        $request['form_export'] = $form[0]['form_export'];
        $request['form_id'] = $id;
        $request['project_auth_type'] = $project['project_auth_type'];
        $request['project_auth_path'] = $project['project_auth_path'];
        $request = (object)$request;
        
        if($request->project_auth_type == 'Without Auth Google Drive'){
            if (!file_exists("../public/zip_file/".$project_path."/google/secret/".str_replace(' ', '_', $form[0]['form_name']))) mkdir("../public/zip_file/".$project_path."/google/secret/".str_replace(' ', '_', $form[0]['form_name']), 0777, true);
            if (!file_exists("../public/zip_file/".$share_path."/google/secret/".str_replace(' ', '_', $form[0]['form_name']))) mkdir("../public/zip_file/".$share_path."/google/secret/".str_replace(' ', '_', $form[0]['form_name']), 0777, true);
            copy($project['project_token_file'], "../public/zip_file/".$project_path."/google/secret/".str_replace(' ', '_', $form[0]['form_name'])."/token.json");
            copy($project['project_token_file'], "../public/zip_file/".$share_path."/google/secret/".str_replace(' ', '_', $form[0]['form_name'])."/token.json");
        }
        if(!empty($request->project_auth_path)){
            if (!file_exists("../public/zip_file/".$project_path."/google/secret/auth/".str_replace(' ', '_', $form[0]['form_name']))) mkdir("../public/zip_file/".$project_path."/google/secret/auth/".str_replace(' ', '_', $form[0]['form_name']), 0777, true);
            if (!file_exists("../public/zip_file/".$share_path."/google/secret/auth/".str_replace(' ', '_', $form[0]['form_name']))) mkdir("../public/zip_file/".$share_path."/google/secret/auth/".str_replace(' ', '_', $form[0]['form_name']), 0777, true);
            copy($form[0]['project_auth_path'], "../public/zip_file/".$project_path."/google/secret/auth/".str_replace(' ', '_', $form[0]['form_name'])."/auth.json");
            copy($form[0]['project_auth_path'], "../public/zip_file/".$share_path."/google/secret/auth/".str_replace(' ', '_', $form[0]['form_name'])."/auth.json");
        }
        $layout = $this->create_layout($request);
        $filename = str_replace(' ', '_',$form[0]['form_name']).".php";
        $f=fopen("../public/zip_file/".$share_path."/".$filename,'w+');
        fwrite($f, $layout);
        fclose($f);
        // $f=fopen("../public/zip_file/".$project_path.$filename,'w+');
        // fwrite($f, $layout);
        // fclose($f);
    }

    public function create_admin_sidebar($forms, $project_name){
        $admin_sidebar = '';
        $admin_sidebar = $admin_sidebar.'<php>';
        $admin_sidebar = $admin_sidebar.'    <head>';
        $admin_sidebar = $admin_sidebar.'        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">';
        $admin_sidebar = $admin_sidebar.'        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">';
        $admin_sidebar = $admin_sidebar.'        <link rel="stylesheet" href="google/css/admin_sidebar.css">';
        $admin_sidebar = $admin_sidebar.'        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.11/dist/css/select2.min.css">';
        $admin_sidebar = $admin_sidebar.'        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">';
        $admin_sidebar = $admin_sidebar.'        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>';
        $admin_sidebar = $admin_sidebar.'        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>';
        $admin_sidebar = $admin_sidebar.'        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.11/dist/js/select2.min.js"></script>';
        $admin_sidebar = $admin_sidebar.'        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>';
        $admin_sidebar = $admin_sidebar.'        <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>';
        $admin_sidebar = $admin_sidebar.'    </head>';
        $admin_sidebar = $admin_sidebar.'    <body>';
        $admin_sidebar = $admin_sidebar.'        <div class="page-wrapper chiller-theme toggled">';
        $admin_sidebar = $admin_sidebar.'            <a id="show-admin_sidebar" class="btn btn-sm btn-light"><i class="fa fa-bars"></i></a>';
        $admin_sidebar = $admin_sidebar.'            <nav id="admin_sidebar" class="admin_sidebar-wrapper">';
        $admin_sidebar = $admin_sidebar.'                <div class="admin_sidebar-content">';
        $admin_sidebar = $admin_sidebar.'                    <div class="admin_sidebar-brand">';
        $admin_sidebar = $admin_sidebar.'                        <a href="#">'.$project_name.'</a>';
        $admin_sidebar = $admin_sidebar.'                        <div id="close-admin_sidebar">';
        $admin_sidebar = $admin_sidebar.'                            <i class="fa fa-times"></i>';
        $admin_sidebar = $admin_sidebar.'                        </div>';
        $admin_sidebar = $admin_sidebar.'                    </div>';
        $admin_sidebar = $admin_sidebar.'                    <div class="admin_sidebar-header">';
        $admin_sidebar = $admin_sidebar.'                        <div class="user-info">';
        $admin_sidebar = $admin_sidebar.'                            <span class="user-name"><?php echo $_SESSION["name_login"]; ?></span>';
        $admin_sidebar = $admin_sidebar.'                            <span class="user-role"><?php echo $_SESSION["email_login"]; ?></span>';
        $admin_sidebar = $admin_sidebar.'                        </div>';
        $admin_sidebar = $admin_sidebar.'                    </div>';
        $admin_sidebar = $admin_sidebar.'                    <div class="admin_sidebar-menu">';
        $admin_sidebar = $admin_sidebar.'                        <ul>';
        $admin_sidebar = $admin_sidebar.'                            <li class="header-menu">';
        $admin_sidebar = $admin_sidebar.'                                <span>Menu View Data</span>';
        $admin_sidebar = $admin_sidebar.'                            </li>';
        foreach($forms as $form){
            $admin_sidebar = $admin_sidebar.'                            <li class="admin_sidebar-content">';
            $admin_sidebar = $admin_sidebar.'                                <a class="active" href="../view_data/view_data.php?form-project='.strtolower(str_replace(' ', '-', $project_name)).'&form='.strtolower(str_replace('_', '-', $form['form_name'])).'&status=Sync">';
            $admin_sidebar = $admin_sidebar.'                                    <i class="fa fa-folder"></i>';
            $admin_sidebar = $admin_sidebar.'                                    <span>'.$form['form_title'].'</span>';
            $admin_sidebar = $admin_sidebar.'                                </a>';
            $admin_sidebar = $admin_sidebar.'                            </li>';
        }
        $admin_sidebar = $admin_sidebar.'                            </li>';
        $admin_sidebar = $admin_sidebar.'                            <li class="header-menu">';
        $admin_sidebar = $admin_sidebar.'                                <span>Menu Synchronize</span>';
        $admin_sidebar = $admin_sidebar.'                            </li>';
        $admin_sidebar = $admin_sidebar.'                            <li class="admin_sidebar-content">';
        $admin_sidebar = $admin_sidebar.'                                <a class=" href="../synchronize/engine_synchronize_set.php">';
        $admin_sidebar = $admin_sidebar.'                                    <i class="fa fa-folder"></i>';
        $admin_sidebar = $admin_sidebar.'                                    <span>Syncronize Setter</span>';
        $admin_sidebar = $admin_sidebar.'                                </a>';
        $admin_sidebar = $admin_sidebar.'                            </li>';
        $admin_sidebar = $admin_sidebar.'                        </ul>';
        $admin_sidebar = $admin_sidebar.'                    </div>';
        $admin_sidebar = $admin_sidebar.'                </div>';
        $admin_sidebar = $admin_sidebar.'                <div class="admin_sidebar-footer">';
        $admin_sidebar = $admin_sidebar.'                    <a href="?logout=yes"><i class="fa fa-power-off"></i></a>';
        $admin_sidebar = $admin_sidebar.'                </div>';
        $admin_sidebar = $admin_sidebar.'            </nav>';
        $admin_sidebar = $admin_sidebar.'            <main class="page-content">';
        $admin_sidebar = $admin_sidebar.'                <div class="container-fluid">';

        return $admin_sidebar;
    }

    public function create_sidebar($forms, $project_name){
        $sidebar = '';
        $sidebar = $sidebar.'<php>';
        $sidebar = $sidebar.'    <head>';
        $sidebar = $sidebar.'        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">';
        $sidebar = $sidebar.'        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">';
        $sidebar = $sidebar.'        <link rel="stylesheet" href="google/css/sidebar.css">';
        $sidebar = $sidebar.'        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.11/dist/css/select2.min.css">';
        $sidebar = $sidebar.'        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">';
        $sidebar = $sidebar.'        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>';
        $sidebar = $sidebar.'        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>';
        $sidebar = $sidebar.'        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.11/dist/js/select2.min.js"></script>';
        $sidebar = $sidebar.'        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>';
        $sidebar = $sidebar.'        <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>';
        $sidebar = $sidebar.'    </head>';
        $sidebar = $sidebar.'    <body>';
        $sidebar = $sidebar.'        <div class="page-wrapper chiller-theme toggled">';
        $sidebar = $sidebar.'            <a id="show-sidebar" class="btn btn-sm btn-light"><i class="fa fa-bars"></i></a>';
        $sidebar = $sidebar.'            <nav id="sidebar" class="sidebar-wrapper">';
        $sidebar = $sidebar.'                <div class="sidebar-content">';
        $sidebar = $sidebar.'                    <div class="sidebar-brand">';
        $sidebar = $sidebar.'                        <a href="#">'.$project_name.'</a>';
        $sidebar = $sidebar.'                        <div id="close-sidebar">';
        $sidebar = $sidebar.'                            <i class="fa fa-times"></i>';
        $sidebar = $sidebar.'                        </div>';
        $sidebar = $sidebar.'                    </div>';
        $sidebar = $sidebar.'                    <div class="sidebar-header">';
        $sidebar = $sidebar.'                        <div class="user-info">';
        $sidebar = $sidebar.'                            <span class="user-name"><?php echo $_SESSION["name_login"]; ?></span>';
        $sidebar = $sidebar.'                            <span class="user-role"><?php echo $_SESSION["email_login"]; ?></span>';
        $sidebar = $sidebar.'                        </div>';
        $sidebar = $sidebar.'                    </div>';
        $sidebar = $sidebar.'                    <div class="sidebar-menu">';
        $sidebar = $sidebar.'                        <ul>';
        $sidebar = $sidebar.'                            <li class="header-menu">';
        $sidebar = $sidebar.'                                <span>Menu</span>';
        $sidebar = $sidebar.'                            </li>';
        foreach($forms as $form){
            $sidebar = $sidebar.'                            <li class="sidebar-content">';
            $sidebar = $sidebar.'                                <a class="active" href="'.$form['form_name'].'.php">';
            $sidebar = $sidebar.'                                    <i class="fa fa-folder"></i>';
            $sidebar = $sidebar.'                                    <span>'.$form['form_title'].'</span>';
            $sidebar = $sidebar.'                                </a>';
            $sidebar = $sidebar.'                            </li>';
        }
        $sidebar = $sidebar.'                        </ul>';
        $sidebar = $sidebar.'                    </div>';
        $sidebar = $sidebar.'                </div>';
        $sidebar = $sidebar.'                <div class="sidebar-footer">';
        $sidebar = $sidebar.'                    <a href="?logout=yes"><i class="fa fa-power-off"></i></a>';
        $sidebar = $sidebar.'                </div>';
        $sidebar = $sidebar.'            </nav>';
        $sidebar = $sidebar.'            <main class="page-content">';
        $sidebar = $sidebar.'                <div class="container-fluid">';

        return $sidebar;
    }

    public function create_layout($request){
        $layout = $this->createPhpSubmit($request);
        $layout = $layout.'                    <?php include "sidebar.php"; ?>';
        $layout = $layout.'                    <div class="container border border-top-0 mt-5 shadow-sm">';
        $layout = $layout.'                         <div class="tab-content">';
        $layout = $layout.'                             <div role="tabpanel" class="tab-pane active" id="form-'.$request->form_name.'">';
        $layout = $layout.                          $request->form_export;
        $layout = $layout.'                    </div>';

        $subform = new SubForm();
        $subforms = $subform->getSubForms($request->form_id);
        
        foreach($subforms as $subform){
            $layout = $layout.$this->createSubForm($request, $subform);
        }
        $layout = $layout.'        </div>';
        $layout = $layout.'    </body>';
        $layout = $layout.'    <script type="text/javascript">';
        $layout = $layout.'        $(\'a[href="\' + window.location.pathname.split(\'/\').pop() + \'"]\').parent().addClass("active");';
        $layout = $layout.'        $(\'.sidebar-content > a\').click(function(){';
        $layout = $layout.'            $(\'.sidebar-content\').removeClass(\'active\');';
        $layout = $layout.'            $(this).parent().addClass("active");';
        $layout = $layout.'        });';
        $layout = $layout.'        $(".sidebar-dropdown > a").click(function() {';
        $layout = $layout.'            $(".sidebar-submenu").slideUp(200);';
        $layout = $layout.'            if ($(this).parent().hasClass("active")) {';
        $layout = $layout.'                $(".sidebar-dropdown").removeClass("active");';
        $layout = $layout.'                $(this).parent().removeClass("active");';
        $layout = $layout.'            } else {';
        $layout = $layout.'                $(".sidebar-dropdown").removeClass("active");';
        $layout = $layout.'                $(this).next(".sidebar-submenu").slideDown(200);';
        $layout = $layout.'                $(this).parent().addClass("active");';
        $layout = $layout.'            }';
        $layout = $layout.'        });';

        $layout = $layout.        '$("#close-sidebar").click(function() {';
        $layout = $layout.'            $(".page-wrapper").removeClass("toggled");';
        $layout = $layout.'        });';
        $layout = $layout.'        $("#show-sidebar").click(function() {';
        $layout = $layout.'            $(".page-wrapper").addClass("toggled");';
        $layout = $layout.'        });';
        $layout = $layout.'    </script>';
        $layout = $layout.'    <?php } ?>';
        $layout = $layout.'</php>';

        return $layout;
    }

    public function createPhpSubmit($request){      
        $php = "\n\n\n";
        $php = $php.'<?php ';
        $php = $php.    '$oauth_credentials = __DIR__ ."/google/secret/oauth.json";';
        $php = $php.    "include_once __DIR__ . '/google/autoload.php';";
        $php = $php.    '$folderName = "'.str_replace(' ', '_', $request->project_name).'"; ';
        $php = $php.    '$folderFormName = "'.str_replace(' ', '_', $request->form_name).'"; ';
        if(!empty($request->project_auth_path)) $php = $php.    '$auth_file = "google/secret/auth/'.str_replace(' ', '_', $request->form_name).'/auth.json";  ';

        $php = $php.    "session_start();";
        $php = $php.    '$redirect_uri = \'http://\' . $_SERVER[\'HTTP_HOST\'] . $_SERVER[\'PHP_SELF\'];';
        $php = $php.    '$client = new Google_Client();';
        $php = $php.    '$client->setAuthConfig($oauth_credentials);';
        $php = $php.    '$client->setRedirectUri($redirect_uri);';
        $php = $php.    '$client->addScope("https://www.googleapis.com/auth/drive");';
        if($request->project_auth_type=='Without Auth Google Drive'){
            $php = $php.    '$client->setAccessType(\'offline\');';
            $php = $php.    '$client->setApprovalPrompt(\'force\');';
        }
        $php = $php.    '$service = new Google_Service_Drive($client);';
       
        $php = $php.    'if (isset($_REQUEST[\'logout\'])) {';
        $php = $php.    '    unset($_SESSION[\'upload_token\']);';
        $php = $php.    '    unset($_SESSION[\'email_login\']);';
        $php = $php.    '    header("Location: " . $_SERVER["PHP_SELF"]);';
        $php = $php.    '    exit;';
        $php = $php.    '}';
        $php = $php.    'else if(isset($_POST["password"]) ){    ';  
        $php = $php.    '    $password = $_POST["password"]; ';
        $php = $php.    '    $logged_in = false; ';
        
        $php = $php.    '    $auth_file = file_get_contents($auth_file); ';
        $php = $php.    '    $auths = json_decode($auth_file); ';
        $php = $php.    '    $auth_keys = array_keys((array)$auths[0]); ';
        $php = $php.    '    foreach($auth_keys as $i => $auth_key){ ';
        $php = $php.    '        if($i == 0) $username_key = $auth_key; ';
        $php = $php.    '        else  $password_key = $auth_key; ';
        $php = $php.    '    } ';
        $php = $php.    '    foreach($auths as $auth){ ';
        $php = $php.    '        $auth = (array)$auth; ';
        $php = $php.    '        if($password == $auth[$password_key]) { ';
        $php = $php.    '            $logged_in = true; ';
        $php = $php.    '            $username =  $auth[$username_key]; ';
        $php = $php.    '        } ';
        $php = $php.    '    } ';
        $php = $php.    '    if($logged_in){ ';
        $php = $php.    '        $authUrl = $client->createAuthUrl();';   
        $php = $php.    '        echo "<script>window.open(\'$authUrl\', \'targetWindow\', \'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=600\')</script>";';   
        $php = $php.    '        $_SESSION["display_name_key"] = $username_key; ';    
        $php = $php.    '        $_SESSION["display_name"] = $username; ';    
        $php = $php.    '    } ';
        $php = $php.    '    else{ ';
        $php = $php.    '        $_SESSION["login_error"] = "Login Fail Wrong Key"; ';        
        $php = $php.    '        header("Location: ".$_SERVER["PHP_SELF"]); ';         
        $php = $php.    '        exit; ';   
        $php = $php.    '    } ';
        $php = $php.    '} ';

        if($request->project_auth_type!='Without Auth Google Drive'){
            $php = $php.    'else if (isset($_GET[\'code\'])) {';
            $php = $php.    '    $token = $client->fetchAccessTokenWithAuthCode($_GET[\'code\']);';
            $php = $php.    '    $client->setAccessToken($token);';
            $php = $php.    '    $_SESSION[\'upload_token\'] = $token;';
            $php = $php.    '    header(\'Location: \' . filter_var($redirect_uri, FILTER_SANITIZE_URL));';
            $php = $php.    '    }';
            
            $php = $php.    'else if (!empty($_SESSION[\'upload_token\'])) {';
            $php = $php.    '    $client->setAccessToken($_SESSION[\'upload_token\']);';
            $php = $php.    '    echo "<script>  if (window.opener != null){ opener.location.href = \'".$_SERVER["PHP_SELF"]."\'; close();}</script>";';
            $php = $php.    '    $status= true;';
            $php = $php.    '    if ($client->isAccessTokenExpired()) {';
            $php = $php.    '        unset($_SESSION[\'upload_token\']);';
            $php = $php.    '        $status= false;';
            $php = $php.    '    }';
            $php = $php.    '    if($status !== false){';
            $php = $php.    '        $about = $service->about->get(array(\'fields\' => \'*\'));';
            $php = $php.    '        $_SESSION["email_login"] = $email_login = $about->user->emailAddress;';
            $php = $php.    '        $_SESSION["name_login"] = $name_login = $about->user->displayName;';
            $php = $php.    '    }';
            $php = $php.    '}';
            $php = $php.    'if(empty($_SESSION[\'upload_token\'])){ ';
            $php = $php.    '     $authUrl = $client->createAuthUrl();';
            if(!empty($request->project_auth_path)) $php = $php.        '   include "google/register.php";  ';
            else $php = $php.        '   include "google/login.php";  ';
            $php = $php.    '    $status= false;';
            $php = $php.    '} ';
        }
        
        if($request->project_auth_type=='Without Auth Google Drive') {
            $php = $php.    'else if (file_exists(__DIR__ ."/google/secret/'.$request->form_name.'/token.json")) {';
            $php = $php.    '$tokenPath = __DIR__ ."/google/secret/'.$request->form_name.'/token.json";';
            $php = $php.    '    $accessToken = json_decode(file_get_contents($tokenPath), true);';
            $php = $php.    '    $client->setAccessToken($accessToken);';
            $php = $php.    '    $status= true;';
            $php = $php.    '}';

            $php = $php.    'if ($client->isAccessTokenExpired()) {';
            $php = $php.    '    if ($client->getRefreshToken()) {';
            $php = $php.    '        $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());';
            $php = $php.    '    } ';
            $php = $php.    '    if (array_key_exists(\'error\', $accessToken)) {';
            $php = $php.    '        throw new Exception(join(\', \', $accessToken));';
            $php = $php.    '    }';
            $php = $php.    '    file_put_contents(__DIR__ ."/google/secret/'.$request->form_name.'/token.json", json_encode($client->getAccessToken()));';
            $php = $php.    '    $status= true;';
            $php = $php.    '}';
        }
        $php = $php.    'if($status){';
        $php = $php.    '    if ($_SERVER[\'REQUEST_METHOD\'] == \'POST\' && $client->getAccessToken() ) {';
        $php = $php.    '        if (!file_exists(\'files\')) {';
        $php = $php.    '          mkdir(\'files\', 0777, true);';
        $php = $php.    '        }';
        $php = $php.    '        $labels = $_POST["values"];';
        $php = $php.    '        $row = array();';
        $php = $php.    '        $j=0;';
        $php = $php.    '        $file_names = $_FILES["values"]["name"];';
      
        $php = $php.    '        $file_keys = array_keys($file_names);'; 
      
        $php = $php.    '        foreach($file_names as $file_name){';  
        $php = $php.    '        $tmp = explode(".", $file_name);';
        $php = $php.    '        $ext = end($tmp);';
        $php = $php.    '        $new_value = array($file_keys[$j] => $file_keys[$j].".".$ext);';
        $php = $php.    '        $labels = $labels + $new_value;';
        $php = $php.    '        $j++;';
        $php = $php.    '    }';
        $php = $php.    '    $keys = array_keys($labels);';

        $php = $php.    '    if(isset($server)){ ';
        $php = $php.    '        $conn = new PDO("mysql:host=$server;dbname=$db", $user, $pass); ';
        $php = $php.    '        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); ';
        $php = $php.    '        $direct_attributes = ""; ';
        $php = $php.    '        $direct_values = ""; ';
        $php = $php.    '        $excepted_attrs = array(); ';
        
        $php = $php.    '        if(isset($auth_file)){ ';
        $php = $php.    '            $attr = array($_SESSION["display_name_key"] => $_SESSION["display_name"]); ';
        $php = $php.    '            $row = $row + $attr; ';
        $php = $php.    '        } ';
        
        $php = $php.    '        foreach($direct_to_db_folder as $j => $attr){ ';
        $php = $php.    '            $direct_attributes = $direct_attributes.$direct_to_db_table[$j]; ';
        $php = $php.    '            $value_index = array_search($attr, $labels); ';
        $php = $php.    '            $data = str_replace(\'"\', \'\\"\', $values[$value_index]); ';
        $php = $php.    '            $direct_values = $direct_values.\'"\'.$data.\'"\';  ';
        
        $php = $php.    '            array_push($excepted_attrs,$labels[$value_index]); ';
        $php = $php.    '            if($j < count($direct_to_db_folder)-1) { ';
        $php = $php.    '                $direct_attributes = $direct_attributes.","; ';
        $php = $php.    '                $direct_values = $direct_values.","; ';
        $php = $php.    '            } ';
        $php = $php.    '        } ';
        $php = $php.    '        $query = "INSERT INTO ".$table_name."(".$direct_attributes.") VALUES(".$direct_values.")"; ';
        $php = $php.    '        $sql = $conn->prepare($query); ';
        $php = $php.    '        $sql->execute(); ';

        $php = $php.    '        $lastInsertId = $conn->lastInsertId();  ';
        $php = $php.    '        $query ="SHOW KEYS FROM ".$table_name." WHERE Key_name = \'PRIMARY\'"; ';
        $php = $php.    '        $sql = $conn->prepare($query); ';
        $php = $php.    '        $sql->execute(); ';
        $php = $php.    '        $result = $sql->fetchAll(); ';
        $php = $php.    '        foreach( $result as $baris ) { ';
        $php = $php.    '            $primary_column = $baris["Column_name"];  ';
        $php = $php.    '        } ';
        $php = $php.    '        $attr = array($primary_column => $lastInsertId);  ';
        $php = $php.    '        $row = $row + $attr;  ';

        $php = $php.    '        $json_name = "update.json"; ';
        $php = $php.    '        $i = 0; ';
        $php = $php.    '        foreach($values as $value){ ';   
        $php = $php.    '            $is_value = true; '; 
        $php = $php.    '            foreach($excepted_attrs as $excepted_attr){ ';  
        $php = $php.    '                if($labels[$i] == $excepted_attr) $is_value = false; ';    
        $php = $php.    '            } ';
        $php = $php.    '            if($is_value){ ';
        $php = $php.    '                if(is_array($value)) $attr = array($labels[$keys[$i]] => implode(", ",$value));  ';
        $php = $php.    '                else $attr = array($labels[$keys[$i]] => $value); ';
        $php = $php.    '                $row = $row + $attr; ';
        $php = $php.    '            } ';
        $php = $php.    '        $i++; ';
        $php = $php.    '        } ';
        $php = $php.    '    } ';

        $php = $php.    '    else{ ';
        $php = $php.    '       $json_name = "insert.json";';
        $php = $php.    '       $subforms_data = array();';
        $php = $php.    '$i = 0;';
        $php = $php.    'foreach ($labels as $value){';
        $php = $php.    '    if (is_array($value)){';
        $php = $php.    '        if (isset($value["main_form"])){';
        $php = $php.    '            $subform_values = array_slice($value, 1);';
        $php = $php.    '            for($subform_data_key= 0; $subform_data_key <= sizeof(reset($subform_values)) -1; $subform_data_key++) {';
        $php = $php.    '                $j = 0;';
        $php = $php.    '                 foreach ($subform_values as $subform_value){';
        $php = $php.    '                    $subform_data_array[array_keys($subform_values)[$j]] =  $subform_value[$subform_data_key];';
        $php = $php.    '                    $j++;';
        $php = $php.    '                }';
        $php = $php.    '                $subforms_data[$subform_data_key] = $subform_data_array;';
        $php = $php.    '            }';
        $php = $php.    '            $attr = array(';
        $php = $php.    '                $value["main_form"] => $subforms_data';
        $php = $php.    '            );';
        $php = $php.    '        }else $attr = array(';
        $php = $php.    '            $keys[$i] => implode(", ", $value)';
        $php = $php.    '        );';
        $php = $php.    '    }else $attr = array(';
        $php = $php.    '        $keys[$i] => $value';
        $php = $php.    '    );';
        $php = $php.    '    $row = $row + $attr;';             
        $php = $php.    '    $i++;';
        $php = $php.    '}';
        $php = $php.    '$myJSON = json_encode($row);';
        $php = $php.    '$fp = fopen("google/tmp/" . $json_name, "w");';
        $php = $php.    'fwrite($fp, $myJSON);';
        $php = $php.    'fclose($fp);';        
        
        $php = $php.    '        $namaFoldSync = "";';
        if($request->project_auth_type=='Without Auth Google Drive'){
            $php = $php.    '        $optParams = array(';
            $php = $php.    '            \'pageSize\' => 1,';
            $php = $php.    '            \'fields\' => \'nextPageToken, files\',';
            $php = $php.    '            \'q\' => "name = \'Out of Sync\' and mimeType = \'application/vnd.google-apps.folder\'"';
            $php = $php.    '        );';
            $php = $php.    '        $OutofSync = $service->files->listFiles($optParams);';
            $php = $php.    '        foreach ($OutofSync->getFiles() as $file) {';
            $php = $php.    '            $idFoldOutOfSync = $file->getId();';
            $php = $php.    '        }';
            $php = $php.    '        $optParams = array(';
            $php = $php.    '            \'pageSize\' => 1,';
            $php = $php.    '            \'fields\' => \'nextPageToken, files\',';
            $php = $php.    '            \'q\' => "parents = \'".$idFoldOutOfSync."\' and name = \'".$folderName."\' and mimeType = \'application/vnd.google-apps.folder\'"';
            $php = $php.    '        );';
            $php = $php.    '        $searchFolder = $service->files->listFiles($optParams);';
            $php = $php.    '        foreach ($searchFolder->getFiles() as $file) {';
            $php = $php.    '            $idProjFoldOut = $file->getId();';
            $php = $php.    '        }';
    
            $php = $php.    '        $optParams = array(';
            $php = $php.    '            \'pageSize\' => 1,';
            $php = $php.    '            \'orderBy\' => \'modifiedTime asc\',';
            $php = $php.    '            \'fields\' => \'nextPageToken, files\',';
            $php = $php.    '            \'q\' => "parents = \'".$idProjFoldOut."\' and name = \'" . $folderFormName . "\' and mimeType = \'application/vnd.google-apps.folder\'"';
            $php = $php.    '        );';
            $php = $php.    '        $results = $service->files->listFiles($optParams);';
            $php = $php.    '        foreach ($results->getFiles() as $files) {';
            $php = $php.    '            $idFold = $files->getId();';
            $php = $php.    '        }';
        }else{
            $php = $php.    '        $optParams = array(';
            $php = $php.    '            \'pageSize\' => 1,';
            $php = $php.    '            \'orderBy\' => \'modifiedTime asc\',';
            $php = $php.    '            \'fields\' => \'nextPageToken, files\',';
            $php = $php.    '            \'q\' => "name = \'".$folderFormName."\' and mimeType = \'application/vnd.google-apps.folder\'"';
            $php = $php.    '        );';
            $php = $php.    '        $searchFolder = $service->files->listFiles($optParams);';
            $php = $php.    '        foreach ($searchFolder->getFiles() as $file) {';
            $php = $php.    '            $idFold = $file->getId();';
            $php = $php.    '        }';
    
            $php = $php.    '        if(empty($idFold)){';
            $php = $php.    '            $file = new Google_Service_Drive_DriveFile();';
            $php = $php.    '            $file->setName($folderFormName);';
            $php = $php.    '            $file->setMimeType(\'application/vnd.google-apps.folder\');';
            $php = $php.    '            $service->files->create($file);';
            $php = $php.    '            $optParams = array(';
            $php = $php.    '                \'pageSize\' => 1,';
            $php = $php.    '                \'fields\' => \'nextPageToken, files\',';
            $php = $php.    '                \'q\' => "name = \'".$folderFormName."\' and mimeType = \'application/vnd.google-apps.folder\'"';
            $php = $php.    '            );';
            $php = $php.    '            $searchFolder = $service->files->listFiles($optParams);';
            $php = $php.    '            foreach ($searchFolder->getFiles() as $file) {';
            $php = $php.    '                $idFold = $file->getId();';
            $php = $php.    '            }';
            $php = $php.    '        }';
        }

        $php = $php.    '        $fileMetadata = new Google_Service_Drive_DriveFile(array(';
        $php = $php.    '            \'name\' => "$folderFormName",';
        $php = $php.    '            \'parents\' => array($idFold),';
        $php = $php.    '            \'mimeType\' => \'application/vnd.google-apps.folder\'));';
        $php = $php.    '        $file = $service->files->create($fileMetadata, array(\'fields\' => \'id\'));';
        $php = $php.    '        $folderIdSave = $file->id;';
        $php = $php.    '        $userPermission = new Google_Service_Drive_Permission(array(';
        $php = $php.    '            \'type\' => \'user\',';
        $php = $php.    '            \'role\' => \'writer\',';
        $php = $php.    '            \'emailAddress\' => \''.$request->project_email.'\'';
        $php = $php.    '        ));';
        $php = $php.    '        $request = $service->permissions->create($folderIdSave, $userPermission, array(\'fields\' => \'id\'));';

        $php = $php.    '        $key = 0;';
        $php = $php.    '        $file_names = $_FILES["values"]["name"];';
        $php = $php.    '        $file_keys = array_keys($file_names);';
        $php = $php.    '        $files = $_FILES["values"]["tmp_name"];';

        $php = $php.    '        $file = new Google_Service_Drive_DriveFile();';
        $php = $php.    '        $file->setParents([$folderIdSave]);';
        $php = $php.    '        $file->setName(\'insert.json\');';
        $php = $php.    '        $content = file_get_contents(\'google/tmp/insert.json\');';
        $php = $php.    '        $result2 = $service->files->create($file,array(\'data\' => $content, \'mimeType\' => \'application/json\', \'uploadType\' => \'multipart\'));';
    
        $php = $php.    '        $file = new Google_Service_Drive_DriveFile();';
        $php = $php.    '        $file->setName("Attachment");';
        $php = $php.    '        $file->setParents([$folderIdSave]);';
        $php = $php.    '        $file->setMimeType(\'application/vnd.google-apps.folder\');';
        $php = $php.    '        $folderAttachment = $service->files->create($file, array(\'fields\' => \'id\'));';
        $php = $php.    '        $folderAttachmentId = $folderAttachment->id;';

        $php = $php.    '        foreach ($files as $file){';
        $php = $php.    '            if (is_array($file)){';
        $php = $php.    '                $googleFile = new Google_Service_Drive_DriveFile();';
        $php = $php.    '                $googleFile->setName($labels[$file_keys[$key]]["main_form"]);';
        $php = $php.    '                $googleFile->setParents([$folderAttachmentId]);';
        $php = $php.    '                $googleFile->setMimeType(\'application/vnd.google-apps.folder\');';
        $php = $php.    '                $folderSubform = $service->files->create($googleFile, array(\'fields\' => \'id\'));';
        $php = $php.    '                if (!file_exists("google/tmp/attachment/". $labels[$file_keys[$key]]["main_form"])) mkdir("google/tmp/attachment/". $labels[$file_keys[$key]]["main_form"]);';
        $php = $php.    '                $subform_file_keys = array_keys($file);';
        $php = $php.    '                foreach($subform_file_keys as $subform_file_key){';
        $php = $php.    '                    $createSubformFoldAttch = new Google_Service_Drive_DriveFile();';
        $php = $php.    '                    $createSubformFoldAttch->setName($subform_file_key);';
        $php = $php.    '                    $createSubformFoldAttch->setParents([$folderSubform->id]);';
        $php = $php.    '                    $createSubformFoldAttch->setMimeType(\'application/vnd.google-apps.folder\');';
        $php = $php.    '                    $folderSubformAttachment = $service->files->create($createSubformFoldAttch, array(';
        $php = $php.    '                        \'fields\' => \'id\'';
        $php = $php.    '                    ));';
        $php = $php.    '                    $folderSubformAttachmentId = $folderSubformAttachment->id;';
                    
        $php = $php.    '                    $l = 0;';
        $php = $php.    '                    foreach ($file as $subform_file){';
        $php = $php.    '                        if (!file_exists("google/tmp/attachment/" . $labels[$file_keys[$key]]["main_form"] . "/" . $subform_file_keys[$l])) mkdir("google/tmp/attachment/" . $labels[$file_keys[$key]]["main_form"] . "/" . $subform_file_keys[$l]);';
        $php = $php.    '                        $m = 0;';
        $php = $php.    '                        foreach ($subform_file as $upload_file){';
        $php = $php.    '                           $file_name = basename($_FILES["values"]["name"][$file_keys[$key]][$subform_file_keys[$l]][$m]);';
        $php = $php.    '                           $tmp = explode(".", $file_name);';
        $php = $php.    '                           $ext = end($tmp);';
        $php = $php.    '                           $target_file = "google/tmp/attachment/" . $labels[$file_keys[$key]]["main_form"] . "/" . $subform_file_keys[$l] . "/" . $subform_file_keys[$l] . "-" . $m . "." . $ext;';
        $php = $php.    '                           move_uploaded_file($upload_file, $target_file);';
        $php = $php.    '                           $file = new Google_Service_Drive_DriveFile();';
        $php = $php.    '                           $file->setName($subform_file_keys[$l] . "-" . $m . "." . $ext);';
        $php = $php.    '                           $file->setParents([$folderSubformAttachmentId]);';
        $php = $php.    '                           $content = file_get_contents($target_file);';
        $php = $php.    '                           $result2 = $service->files ->create($file, array(';
        $php = $php.    '                               \'data\' => $content,';
        $php = $php.    '                               \'mimeType\' => "image/\'" . $ext . "\'",';
        $php = $php.    '                               \'uploadType\' => \'multipart\'';
        $php = $php.    '                           ));';
        $php = $php.    '                           unlink($target_file);';
        $php = $php.    '                           $m++;';
        $php = $php.    '                       }';
        $php = $php.    '                       rmdir("google/tmp/attachment/" . $labels[$file_keys[$key]]["main_form"] . "/" . $subform_file_keys[$l]);';
        $php = $php.    '                       $l++;';
        $php = $php.    '                   }';
        $php = $php.    '               }';
        $php = $php.    '               rmdir("google/tmp/attachment/" . $labels[$file_keys[$key]]["main_form"]);';
        $php = $php.    '           }else{';
        $php = $php.    '               $file_name = basename($_FILES["values"]["name"][$file_keys[$key]]);';
        $php = $php.    '               $tmp = explode(".", $file_name);';
        $php = $php.    '               $ext = end($tmp);';
        $php = $php.    '               $target_file = "google/tmp/attachment/" . $file_keys[$key] . "." . $ext;';
        $php = $php.    '               move_uploaded_file($file, $target_file);';
        $php = $php.    '               $file = new Google_Service_Drive_DriveFile();';
        $php = $php.    '               $file->setName($file_keys[$key] . "." . $ext);';
        $php = $php.    '               $file->setParents([$folderAttachmentId]);';
        $php = $php.    '               $content = file_get_contents($target_file);';
        $php = $php.    '               $result2 = $service->files->create($file, array(';
        $php = $php.    '                   \'data\' => $content,';
        $php = $php.    '                   \'mimeType\' => "image/\'" . $ext . "\'",';
        $php = $php.    '                   \'uploadType\' => \'multipart\'';
        $php = $php.    '               ));';
        $php = $php.    '               $key++;';
        $php = $php.    '               unlink($target_file);';
        $php = $php.    '           }';
        $php = $php.    '       }';
        $php = $php.    '       unlink("google/tmp/" . $json_name);';
        $php = $php.    '   }';
        $php = $php.    '   header("Location: " . $_SERVER["PHP_SELF"]);';
        $php = $php.    '   exit;';
        $php = $php.    '}';
        $php = $php.'?> ';
        return $php;
    }

    public function createSubForm($request, $subform){
        $php = '';
        $php = $php.'<?php $sub_folder_name = \''.$subform["sub_form_name"].'\'; ?> ';
        $php = $php.'<div role="tabpanel" class="tab-pane subform" id=subform-'.$subform["sub_form_name"].'> ';
        $php = $php. $subform['sub_form_export'];
        $php = $php.'        <button id=btn-submit-subform-'.$subform["sub_form_name"].' class="col-md-12 btn btn-success btn-block">Submit</button> ';
        $php = $php.'        <button id="tab-mainform-'.$request->form_name.'" type="button" class="col-md-12 btn btn-info btn-block"><a>Back to Main Form</a></button> ';

        $php = $php.'       <script>';
        $php = $php.'           var subform_data = 0;';
        $php = $php.'           var prev_is_file = 0;';
        $php = $php.'           var attach = 0;';
        $php = $php.'           $("#btn-submit-subform-'.$subform["sub_form_name"].'").click(function() {';
        $php = $php.'              $("#datatable-subform-'.$subform["sub_form_name"].'").DataTable().destroy();';
        $php = $php.'              $(\'tbody[id="subform-'.$subform["sub_form_name"].'"]\').append("<tr id=subform-'.$subform["sub_form_name"].'-" + subform_data + "></tr>");';
        $php = $php.'              var formData = new FormData($("div #"+$(this).parent().attr("id")).find("form").get(0));';
                
        $php = $php.'              for (var attr of formData) {';
        $php = $php.'                  let name = attr[0];';
        $php = $php.'                  let value = attr[1];';
        $php = $php.'                  if(value instanceof Object){';
        $php = $php.'                      $("#subform-'.$subform["sub_form_name"].'-"+subform_data).append("<td>fl-" + (attach + 1) + "." + /[^.]+$/.exec(value.name) + "</td>");';
        $php = $php.'                      $("#subform-'.$subform["sub_form_name"].'-"+subform_data).append("<input id=file-subform-'.$subform["sub_form_name"].'-"+subform_data + " style=\'display:none;\' type=file name=\'values[subform-'.$subform["sub_form_name"].']["+name.substring(7, name.length-1)+"][]\'>");';
        $php = $php.'                      $("#subform-'.$subform["sub_form_name"].'-"+subform_data).append("<input type=hidden name=\'values[subform-'.$subform["sub_form_name"].']["+name.substring(7, name.length-1)+"][]\' value=fl-" + attach + "." + /[^.]+$/.exec(value.name) + ">");';
        $php = $php.'                      let fileInputElement = $("#file-subform-'.$subform["sub_form_name"].'-"+subform_data)[0];';
        $php = $php.'                      let container = new DataTransfer();';
        $php = $php.'                      container.items.add(value);';
        $php = $php.'                      fileInputElement.files = container.files;';
        $php = $php.'                      attach++;';
        $php = $php.'                 }else{';
        $php = $php.'                      if(name.substring(name.length - 2) === "[]"){';
        $php = $php.'                           var attr_subform = name.substring(7, name.length-3)';
        $php = $php.'                      }else{';
        $php = $php.'                          attr_subform = name.substring(7, name.length - 1)';
        $php = $php.'                      }';
        $php = $php.'                      $("#subform-'.$subform["sub_form_name"].'-"+subform_data).append("<td>" + value + "</td>");';
        $php = $php.'                      $("#subform-'.$subform["sub_form_name"].'-"+subform_data).append("<input type=hidden name=values[subform-'.$subform["sub_form_name"].']["+ attr_subform +"][] value=" + value + ">");';
        $php = $php.'                 }';
        $php = $php.'              }';
                
        $php = $php.'              var delete_row_id = "delete-row-" + subform_data;';
        $php = $php.'              $("#subform-'.$subform["sub_form_name"].'-"+subform_data).append("<td><center><button id="+ delete_row_id +" type=\'button\' class=\'btn btn-outline-danger\'><span class=\'btn-inner--icon\'><i class=\'fa fa-trash\'></i></span></button></center></td>");';
        $php = $php.'              $("#" + delete_row_id).click(function(){';
        $php = $php.'                  $("#datatable-subform-'.$subform["sub_form_name"].'").DataTable().row($(this).parent().parent().parent()).remove().draw(false);';
        $php = $php.'                  $("td:contains(\'fl-\')").each(function(i) {';
        $php = $php.'                      this.textContent = "fl-" + (i + 1)+ "." + /[^.]+$/.exec(this.textContent);';
        $php = $php.'                  });';
        $php = $php.'                  $("input[value*=\'fl-\']").each(function(i) {';
        $php = $php.'                      this.value = "fl-" + i + "." + /[^.]+$/.exec(this.value);';
        $php = $php.'                  });';
        $php = $php.'                  $("tr[id*=\'subform-'.$subform["sub_form_name"].'-\']").each(function(i) {';
        $php = $php.'                      this.id = "subform-'.$subform["sub_form_name"].'-" + i;';
        $php = $php.'                  });';
        $php = $php.'                  $("button[id*=\'delete-row-\']").each(function(i) {';
        $php = $php.'                      this.id = "delete-row-" + i;';
        $php = $php.'                  });';
        $php = $php.'                  subform_data -= 1;';
        $php = $php.'                  attach -= 1;';
        $php = $php.'                  alert("Data Deleted");';
        $php = $php.'               });';
                
        $php = $php.'               subform_data++;';
        $php = $php.'               $("#subform-").val(subform_data + " Row Data");';
        $php = $php.'               $("#datatable-subform-'.$subform["sub_form_name"].'").DataTable().draw();';
        $php = $php.'               alert("Data Added to Main Form");';
        $php = $php.'               $("div #"+$(this).parent().attr("id")).find("form")[0].reset();';
        $php = $php.'           });';
        $php = $php.'       </script>';
        $php = $php.'       <script>';
        $php = $php.'           $("#tab-subform-'.$subform["sub_form_name"].'").click(function(e){';
        $php = $php.'               e.preventDefault();';
        $php = $php.'               $("#form-'.$request->form_name.'").removeClass("active");';
        $php = $php.'               $("div #subform-'.$subform["sub_form_name"].'").addClass("active");';
        $php = $php.'           });';
        $php = $php.'           $("#tab-mainform-'.$request->form_name.'").click(function(e){';
        $php = $php.'               e.preventDefault();';
        $php = $php.'               $("div #subform-'.$subform["sub_form_name"].'").removeClass("active");';
        $php = $php.'               $("#form-'.$request->form_name.'").addClass("active");';
        $php = $php.'           });';
        $php = $php.'       </script>';
        $php = $php.'    </div> ';
        $php = $php.'</div> ';

        return $php;
    }
}
?>