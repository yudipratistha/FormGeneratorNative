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
            if ($formProject->create($_POST["nama_project"]))
            {
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
        $d["formProject"] = $formProject->showFormProject($id);
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
}
?>