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

//    function previewForm($id){
//        $forms = new Form();
//
//        $d['form'] = $forms->showForm($id);
//        $this->set($d);
//        $this->render("previewForm");
//    }
//
//    function updateProjectMenu(){
//        $form = new form();
//
//        foreach($_POST['form_menu_id'] as $i => $id){
//            $form->updateprojectMenu($id, $_POST['form_menu_index'][$i]);
//        }
//        header("Location: " . WEBROOT . "formProject/index");
//    }
//
//    function delete($id){
//        $form = new Form();
//        if ($form->delete($id)){
//            echo "success";
//        }
//    }
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