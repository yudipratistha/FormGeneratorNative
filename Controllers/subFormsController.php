<?php
class subFormsController extends Controller{
    public function __construct(){
        require(ROOT . 'Models/SubForm.php');
        require(ROOT . 'Models/Form.php');
        require(ROOT . 'Models/FormProject.php');
        require __DIR__ . '../../vendor/autoload.php';
        session_start();
        if(!isset($_SESSION["user"])) header("Location: /formgeneratornative/auth/login");
    }

    function showAllSubForms($id){
        $sub_forms = new SubForm();
        $d['sub_forms'] = $sub_forms->showAllSubForms($id);
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
       if ($sub_form->delete($id)){
           echo "success";
       }
   }
//
//    public function create_layout($request){
//        $layout = $this->createPhpSubmit($request);
//
//
//        return $layout;
//    }
//
//    public function createPhpSubmit($request){
//        $php = "\n\n\n";
//
//        return $php;
//    }
}
?>