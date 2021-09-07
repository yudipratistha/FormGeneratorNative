<?php
class subFormsController extends Controller{
    public function __construct(){
        require(ROOT . 'Models/SubForm.php');
        require(ROOT . 'Models/Form.php');
        session_start();
        if(!isset($_SESSION["user"])) header("Location: /formgeneratornative/auth/login");
    }

    function showAllSubForms($id){
        $sub_forms = new SubForm();
        $d['sub_forms'] = $sub_forms->getSubForms($id);
        $this->set($d);
        $this->render("index");
    }

   function previewSubForm($id){
       $sub_form = new SubForm();

       $d['sub_form'] = $sub_form->showSubForm($id);
       $this->set($d);
       $this->render("previewSubForm");
   }

   function delete($id){
       $sub_form = new SubForm();
       $form = new Form();
       if ($sub_form->delete($id) && $form->updateMainFormSubForm($_POST["main_form_id"], $_POST["delete_main_form_sub_form"], $_POST["delete_main_form_attr_sub_form"])){
           echo "success";
       }else{
           echo "Error";
       }
   }
}
?>