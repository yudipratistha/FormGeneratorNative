<?php

class subFormGeneratorController extends Controller{
    public function __construct(){
        require(ROOT . 'Models/SubForm.php');
        session_start();
        if(!isset($_SESSION["user"])) header("Location: /formgeneratornative/auth/login");
    }

    function createSubForm($id){
        $d["form_id"] = $id;
        
        $this->set($d);
        $this->render("createSubForm");
    }

    function create(){
        if (!empty($_POST["sub_form_title"])){
            require(ROOT . 'Models/Form.php');
            $form= new SubForm();
            $form->create($_POST["sub_form_title"], $_POST["sub_form_name"], $_POST["attr_form"], $_POST["convert_php"], $_POST['form_id']);
        }else{
            header('Content-Type: application/json');
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