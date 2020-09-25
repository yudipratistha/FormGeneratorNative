<?php
class formProjectsController extends Controller{
    function index(){
        require(ROOT . 'Models/FormProject.php');

        $formProjects = new FormProject();

        $d['formProjects'] = $formProjects->showAllFormProjects();
        $this->set($d);
        $this->render("index");
    }

    function create(){
        if (!empty($_POST["nama_project"])){
            require(ROOT . 'Models/FormProject.php');
            $formProject= new FormProject();
            if ($formProject->create($_POST["nama_project"])){
                mkdir("../public/1/test2/", 0777, true);
                header("Location: " . WEBROOT . "formProject/index");
            }
        }else{
            header('Input Empty!', true, 500);
            die("Input Empty!");
        }
    }

    function edit($id){
        require(ROOT . 'Models/FormProject.php');
        $formProject= new FormProject();
        $token_file = __DIR__ . '../../public/google/token.json';
        $token_file = file_get_contents($token_file);
        $token = json_decode($token_file, true);
        $d["formProject"] = $formProject->showFormProject($id) + $token;
        echo json_encode($d);
    }

    function update($id){
        require(ROOT . 'Models/FormProject.php');
        $formProject= new FormProject();

        if (isset($_POST["title"]))
        {
            if ($formProject->edit($id, $_POST["title"], $_POST["description"]))
            {
                header("Location: " . WEBROOT . "formProjects/index");
            }
        }
        $this->render("edit");
    }

    function delete($id){
        require(ROOT . 'Models/FormProject.php');

        $formProject = new FormProject();
        if ($formProject->delete($id))
        {
            header("Location: " . WEBROOT . "formProjects/index");
        }
    }

    function getOAuth(){
        session_start();
        unset($_SESSION['oauth_credentials']);
        unset($_SESSION['upload_token']);
        print_r("sdfsd");
        if(!empty($_FILES["oauth"])){
            print_r("sdfsd");
            $auth_file = $_FILES["oauth"]; 
            $auth_file = file_get_contents($auth_file['tmp_name']);
            $_SESSION['get_token'] =  'create';
        }else{
            unset($_SESSION['get_token']);
            if(!empty($_FILES["oauth_edit"]['tmp_name'])){$_SESSION['oauth_edit'] = $_FILES["oauth_edit"]; $auth_file = $_FILES["oauth_edit"]; $auth_file = file_get_contents($auth_file['tmp_name']);} 
            else{
                // $formprojects = FormProject::find($_SESSION['edit_id_project']);
                $auth_file = __DIR__ . '../../public/google/oauth.json';
                $auth_file = file_get_contents($auth_file);
            }
                
        }
        
        $oauth = json_decode($auth_file, true);
        $_SESSION['oauth_credentials'] =  $oauth;
    }

    public function callback()
    {
        require __DIR__ . '../../vendor/autoload.php';

        session_start();
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