<?php
class formGeneratorController extends Controller{
    function createForm(){
        $this->render("createForm");
    }

    function create(){

        if (!empty($_POST["title"])){
            mkdir("1/test/", 0777, true);
            require(ROOT . 'Models/Form.php');

            $form= new Form();
            
            if ($form->create($_POST["title"], $_POST["description"])){
                header("Location: " . WEBROOT . "forms/index");
            }
        }else{
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

    // function update($id){
    //     require(ROOT . 'Models/Form.php');
    //     $form= new Form();

    //     if (isset($_POST["title"]))
    //     {
    //         if ($form->edit($id, $_POST["title"], $_POST["description"]))
    //         {
    //             header("Location: " . WEBROOT . "forms/index");
    //         }
    //     }
    //     $this->render("edit");
    // }
}
?>