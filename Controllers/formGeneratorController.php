<?php

class formGeneratorController extends Controller{
    public function __construct(){
        session_start();
        if(!isset($_SESSION["user"])) header("Location: /formgeneratornative/auth/login");
    }

    function createForm($id){
        
        $d["form_projects_id"] = $id;

        $this->set($d);
        $this->render("createForm");
    }

    function create(){

        if (!empty($_POST["form_title"])){
            require(ROOT . 'Models/Form.php');
            $form= new Form();
            $data_form_project = $form->getProject($_POST["form_projects_id"]);
            $projectPath = "../public/file/".$_SESSION['user']['id']."/".$data_form_project["nama_project"]."/".$_POST["form_name"]."/";

            // mkdir("1/test/", 0777, true);
            if(!empty($_FILES["json_identifier"]['tmp_name'])){
                mkdir($projectPath, 0777, true);
                $jsonIdentifierFile = file_get_contents($_FILES["json_identifier"]['tmp_name']);
                file_put_contents($projectPath."/auth.json", json_encode($jsonIdentifierFile));
                header('Content-Type: application/json');
                print_r($jsonIdentifierFile);
                $form_auth_path = $projectPath."auth.json";
            }
            $form->create($_POST["form_title"], $_POST["form_name"], $_POST["convert_php"], $_POST["attr_form"], $_POST["form_type"], $form_auth_path, $_POST['form_projects_id']);
            header("Location: " . WEBROOT . "forms/index");
        }else{
            header('Content-Type: application/json');
                // print_r($jsonIdentifierFile);
            echo 'Error!';
            header('Input Empty!', true, 500);
            die("Input Empty!");
        }
    }

    function editForm($id){
        require(ROOT . 'Models/Form.php');
        $form= new Form();
        $d["form"] = $form->showForm($id);

        $this->set($d);
        $this->render("editForm");
    }

    function update($id){
        if (!empty($_POST["form_title"])){
            require(ROOT . 'Models/Form.php');
            $form= new Form();
            $showForm = $form->showForm($id);
            print_r($project_name["form_projects_id"]);
            $data_form_project = $form->getProject($showForm["form_projects_id"]);

            $projectPath = "../public/file/".$_SESSION['user']['id']."/".$data_form_project["nama_project"]."/".$_POST["form_name"];

            // mkdir("1/test/", 0777, true);
            if(!empty($_FILES["json_identifier"]['tmp_name'])){
                mkdir($projectPath, 0777, true);
                $jsonIdentifierFile = file_get_contents($_FILES["json_identifier"]['tmp_name']);
                file_put_contents($projectPath."/auth.json", $jsonIdentifierFile);
                
                $form_auth_path = $projectPath."/auth.json";
            }else if($_POST["form_type"] == 'With Auth Google Drive API and Identifier'){
                $form_auth_path = $showForm['form_auth_path'];
            }

            $form->update($id, $_POST["form_title"], $_POST["form_name"], $_POST["convert_php"], $_POST["attr_form"], $_POST["form_type"], $form_auth_path, $_POST['form_projects_id']);
            header("Location: " . WEBROOT . "forms/index");
        }else{
            header('Content-Type: application/json');
            echo 'Error!';
            header('Input Empty!', true, 500);
            die("Input Empty!");
        }
    }
}
?>