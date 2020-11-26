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
            $formMenuCount = $form->countIndexMenu($_POST['form_projects_id']);
            $form->create($_POST["form_title"], $_POST["form_name"], $_POST["convert_php"], $_POST["attr_form"], $formMenuCount['count_index'] + 1, $_POST['form_projects_id']);
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
            $data_form_project = $form->getProject($showForm["form_projects_id"]);

            $form->update($id, $_POST["form_title"], $_POST["form_name"], $_POST["convert_php"], $_POST["attr_form"], $_POST['form_projects_id']);

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