<?php
class formProjectsController extends Controller{
    public function __construct(){
        session_start();
        if(empty($_SESSION["user"])) header("Location: /formgeneratornative/auth/login");
    }

    function index(){
        require(ROOT . 'Models/FormProject.php');

        $formProjects = new FormProject();

        $d['formProjects'] = $formProjects->showAllFormProjects($_SESSION["user"]['id']);
        $this->set($d);
        $this->render("index");
    }

    function create(){
        if (!empty($_POST["nama_project"])){
            require(ROOT . 'Models/FormProject.php');
            $formProject= new FormProject();
            $projectPath = "../public/file/".$_SESSION['user']['id']."/".$_POST["nama_project"]."/";

            mkdir($projectPath, 0777, true);
            $oauthFile = file_get_contents($_FILES["oauth"]['tmp_name']);
            file_put_contents($projectPath."/oauth.json", $oauthFile);

            $tokenFile = array("access_token"=> $_POST["access_token"], "expires_in"=>$_POST["expires_in"], "refresh_token"=>$_POST["refresh_token"], 
                "scope"=>$_POST["scope"], "token_type"=>$_POST["token_type"], "created"=>$_POST["created"]);
            file_put_contents($projectPath."/token.json", json_encode($tokenFile));

            $projectAuthPath = "../public/file/".$_SESSION['user']['id']."/".$_POST["nama_project"]."/auth"."/";

            // mkdir("1/test/", 0777, true);
            if(!empty($_FILES["json_identifier"]['tmp_name'])){
                mkdir($projectAuthPath, 0777, true);
                $jsonIdentifierFile = file_get_contents($_FILES["json_identifier"]['tmp_name']);
                file_put_contents($projectAuthPath."/auth.json", json_encode($jsonIdentifierFile));
                header('Content-Type: application/json');
                
                $form_auth_path = $projectAuthPath."auth.json";
                print_r($form_auth_path);
            }
            $formProject->create($_POST["nama_project"], $projectPath.'oauth.json', $projectPath.'token.json', $_POST["form_type"], $form_auth_path, $_SESSION['user']['id']);
            header("Location: " . WEBROOT . "formProject/index");
        }else{
            header('Input Empty!', true, 500);
            die("Input Empty!");
        }
    }

    function getMenu($id){
        // session_start();
        require(ROOT . 'Models/Form.php');
        $form= new Form();
        $d["formProject"] = $form->getMenu($id);;
        $_SESSION['edit_id_project'] = $id;
        echo json_encode($d);
    }

    function edit($id){
        // session_start();
        require(ROOT . 'Models/FormProject.php');
        $formProject= new FormProject();
        $tokenPath["formProject"] = $formProject->getToken($id);
        $token_file = __DIR__ . '../../public/'.$tokenPath["formProject"]["project_token_file"];
        $token_file = file_get_contents($token_file);
        $token = json_decode($token_file, true);
        $d["formProject"] = $formProject->showFormProject($id) + $token;
        $_SESSION['edit_id_project'] = $id;
        echo json_encode($d);
    }

    function update($id){
        require(ROOT . 'Models/FormProject.php');
        $formProject= new FormProject();
        $projectPath = "../public/file/".$_SESSION['user']['id']."/".$_POST["nama_project_edit"]."/";

        if (!empty($_POST["nama_project_edit"])){
            $tokenPath["formProject"] = $formProject->getToken($id);
            $showAllFormProjects = $formProject->showAllFormProjects($id);
            rename("../public/".substr($tokenPath["formProject"]["project_oauth_file"], 0, -11), $projectPath);

            if(!empty($_FILES["oauth_edit"]['tmp_name'])){
                $oauthFile = file_get_contents($_FILES["oauth_edit"]['tmp_name']);
                file_put_contents($projectPath."/oauth.json", $oauthFile);
            }
            $tokenFile = array("access_token"=> $_POST["access_token_edit"], "expires_in"=>$_POST["expires_in_edit"], "refresh_token"=>$_POST["refresh_token_edit"], 
                "scope"=>$_POST["scope_edit"], "token_type"=>$_POST["token_type_edit"], "created"=>$_POST["created_edit"]);
            $f=fopen($projectPath."/token.json",'w+');
            fwrite($f,json_encode($tokenFile));
            fclose($f);
            // file_put_contents($projectPath."/token.json", json_encode($tokenFile));

            $projectAuthPath = $projectPath."auth";

            // mkdir("1/test/", 0777, true);
            if(!empty($_FILES["json_identifier"]['tmp_name'])){
                mkdir($projectAuthPath, 0777, true);
                $jsonIdentifierFile = file_get_contents($_FILES["json_identifier"]['tmp_name']);
                file_put_contents($projectAuthPath."/auth.json", $jsonIdentifierFile);
                
                $form_auth_path = $projectAuthPath."/auth.json";
            }else if($_POST["form_type_edit"] == 'With Auth Google Drive API and Identifier'){
                $form_auth_path = $projectAuthPath."/auth.json";
            }

            $formProject->edit($id, $_POST["nama_project_edit"], $projectPath.'oauth.json', $projectPath.'token.json', $_POST["form_type_edit"], $form_auth_path);
            header("Location: " . WEBROOT . "formProjects/index");
            // echo json_encode($tokenPath["formProject"]["project_oauth_file"]);
        }else{
            header('Input Empty!', true, 500);
            die("Input Empty!");
        }
    }

    function delete($id){
        require(ROOT . 'Models/FormProject.php');

        $formProject = new FormProject();
        $oauthPath["formProject"] = $formProject->getToken($id);
        if ($formProject->delete($id)){
            $dir = substr($oauthPath["formProject"]["project_oauth_file"], 0, -11);
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
            rmdir($dir);
        }
        header("Location: " . WEBROOT . "formProjects/index");
    }

    function getOAuth(){
        // session_start();
        unset($_SESSION['oauth_credentials']);
        unset($_SESSION['upload_token']);
        if(!empty($_FILES["oauth"])){
            $oauthPath = $_FILES["oauth"]; 
            $oauthPath = file_get_contents($oauthPath['tmp_name']);
            $_SESSION['get_token'] =  'create';
        }else{
            unset($_SESSION['get_token']);
            if(!empty($_FILES["oauth_edit"]['tmp_name'])){$_SESSION['oauth_edit'] = $_FILES["oauth_edit"]; $oauthPath = $_FILES["oauth_edit"]; $oauthPath = file_get_contents($oauthPath['tmp_name']);} 
            else{
                require(ROOT . 'Models/FormProject.php');
                $formProject= new FormProject();
                $oauthPath["formProject"] = $formProject->getToken($_SESSION['edit_id_project']);
                $oauthPath = __DIR__ . '../../public/'.$oauthPath["formProject"]["project_oauth_file"];
                $oauthPath = file_get_contents($oauthPath);
            }
                
        }
        
        $oauth = json_decode($oauthPath, true);
        $_SESSION['oauth_credentials'] =  $oauth;
    }

    public function callback()
    {
        require __DIR__ . '../../vendor/autoload.php';

        // session_start();
        // $oauth_credentials = storage_path('app\google\google\oauth-credentials.json');$_SERVER['PHP_SELF']
        $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . ('/formgeneratornative/formProjects/callback/');

        $client = new Google_Client();
        $client->setAuthConfig($_SESSION['oauth_credentials']);
        $client->setRedirectUri($redirect_uri);
        $client->addScope("https://www.googleapis.com/auth/drive");
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');
        $client->setApprovalPrompt('auto');
        $service = new Google_Service_Drive($client);

        if (isset($_GET['code'])) {
            $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
            $tokens = json_encode($token);
            $decode = json_decode($tokens);
            $client->setAccessToken($token);
            $config = array(
                'access_token'           => $decode->access_token,
                'expires_in'     => $decode->expires_in,
                'refresh_token'     => $decode->refresh_token,
                'scope' => $decode->scope,
                'token_type'   => $decode->token_type,
                'created'      => $decode->created,
              );
            // store in the session also
            $_SESSION['upload_token'] = $config;
            // redirect back to the example
            header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
            
          }else{
              if(isset($_SESSION['upload_token'])){
                  $client->setAccessToken($_SESSION['upload_token']);
              }
          }
          // set the access token as part of the client
          if (empty($_SESSION['upload_token'])) {
            $authUrl = $client->createAuthUrl();
            echo "<script type='text/javascript'> window.location.href = ' $authUrl ' </script>";
          } 
          $AccessToken = json_encode($client->getAccessToken());
        $decodeAccessToken = json_decode($AccessToken);
        if(isset($_SESSION['get_token'])){
            echo "<script>
                var access_token = '$decodeAccessToken->access_token'
                var expires_in = '$decodeAccessToken->expires_in'
                var refresh_token = '$decodeAccessToken->refresh_token'
                var scope = '$decodeAccessToken->scope'
                var token_type = '$decodeAccessToken->token_type'
                var created = '$decodeAccessToken->created'
                window.opener.document.getElementById('access_token').value = access_token 
                window.opener.document.getElementById('expires_in').value = expires_in 
                window.opener.document.getElementById('refresh_token').value = refresh_token 
                window.opener.document.getElementById('scope').value = scope 
                window.opener.document.getElementById('token_type').value = token_type 
                window.opener.document.getElementById('created').value = created 
                window.close()
            </script>";

        }else{
            echo "<script>
                var access_token = '$decodeAccessToken->access_token'
                var expires_in = '$decodeAccessToken->expires_in'
                var refresh_token = '$decodeAccessToken->refresh_token'
                var scope = '$decodeAccessToken->scope'
                var token_type = '$decodeAccessToken->token_type'
                var created = '$decodeAccessToken->created'
                window.opener.document.getElementById('access_token_edit').value = access_token 
                window.opener.document.getElementById('expires_in_edit').value = expires_in 
                window.opener.document.getElementById('refresh_token_edit').value = refresh_token 
                window.opener.document.getElementById('scope_edit').value = scope 
                window.opener.document.getElementById('token_type_edit').value = token_type 
                window.opener.document.getElementById('created_edit').value = created 
                window.close()
            </script>"; 
        }        
    }
}
?>