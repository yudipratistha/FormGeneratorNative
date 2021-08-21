<?php

class subFormGeneratorController extends Controller{
    public function __construct(){
        require(ROOT . 'Models/SubForm.php');
        session_start();
        if(!isset($_SESSION["user"])) header("Location: /formgeneratornative/auth/login");
    }

    function createSubForm($id){
        $sub_form= new SubForm();
        $d["form_data"] = $sub_form->getMainFormConvert($id);
        
        $this->set($d);
        $this->render("createSubForm");
    }

    function create(){
        if (!empty($_POST["sub_form_title"])){
            $sub_form= new SubForm();
            $sub_form->create($_POST["sub_form_title"], $_POST["sub_form_name"], $_POST["convert_php"], $_POST["attr_form"], $_POST['form_id']);

        }else{
            header('Content-Type: application/json');
            echo 'Error!';
            header('Input Empty!', true, 500);
            die("Input Empty!");
        }
    }

    function editSubForm($id){
        $sub_form= new SubForm();
        $d["sub_form"] = $sub_form->showSubForm($id);

        $this->set($d);
        $this->render("editSubForm");
    }

    function update($id){
        if (!empty($_POST["sub_form_title"])){
            $sub_form= new SubForm();
            // $showSubForm = $sub_form->showSubForm($id);
            // $data_form = $sub_form->getForm($showSubForm["form_projects_id"]);

            $sub_form->update($id, $_POST["sub_form_title"], $_POST["sub_form_name"], $_POST["convert_php"], $_POST["attr_form"], $_POST['sub_form_id']);

            header("Location: " . WEBROOT . "forms/index");
        }else{
            header('Content-Type: application/json');
            echo $id, $_POST["form_title"], $_POST["form_name"],  $_POST["attr_form"], $_POST['sub_form_id'];
            header('Input Empty!', true, 500);
            die("Input Empty!");
        }
    }
}
?>