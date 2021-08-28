<?php

class subFormGeneratorController extends Controller{
    public function __construct(){
        require(ROOT . 'Models/Form.php');
        require(ROOT . 'Models/SubForm.php');
        session_start();
        if(!isset($_SESSION["user"])) header("Location: /formgeneratornative/auth/login");
    }

    function createSubForm($id){
        $form= new Form();
        $d["form_data"] = $form->getMainFormConvert($id);
        
        $this->set($d);
        $this->render("createSubForm");
    }

    function create(){
        if (!empty($_POST["sub_form_title"])){
            $sub_form= new SubForm();
            $sub_form->create($_POST["sub_form_title"], $_POST["sub_form_name"], $_POST["convert_php"], $_POST["attr_form"], $_POST['form_id']);

            $form = new Form();
            $form->updateMainFormSubForm($_POST['form_id'], $_POST["main_form"], $_POST["main_form_attr"]);

        }else{
            header('Content-Type: application/json');
            echo 'Error!';
            header('Input Empty!', true, 500);
            die("Input Empty!");
        }
    }

    function editSubForm($id){
        $sub_form= new SubForm();
        $form = new Form();
        $d["sub_form"] = array_merge($sub_form->showSubForm($id), $form->getMainFormConvert($id));

        $this->set($d);
        $this->render("editSubForm");
    }

    function update($id){
        if (!empty($_POST["sub_form_title"])){
            $sub_form= new SubForm();
            $sub_form->update($id, $_POST["sub_form_title"], $_POST["sub_form_name"], $_POST["convert_php"], $_POST["attr_form"]);

            $form = new Form();
            $form->updateMainFormSubForm($_POST['form_id'], $_POST["main_form_update"], $_POST["main_form_attr_update"]);

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