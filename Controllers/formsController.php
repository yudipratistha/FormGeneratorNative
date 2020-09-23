<?php
class formsController extends Controller{
    function showAllForms($id){
        require(ROOT . 'Models/Form.php');

        $forms = new Form();

        $d['forms'] = $forms->showAllForms($id);
        $this->set($d);
        $this->render("index");
    }

    // function create(){
    //     if (!empty($_POST["nama_"])){
    //         require(ROOT . 'Models/Form.php');
    //         $form= new Form();
    //         if ($form->create($_POST["nama_"]))
    //         {
    //             header("Location: " . WEBROOT . "form/index");
    //         }
    //     }else{
    //         header('Input Empty!', true, 500);
    //         die("Input Empty!");
    //     }
    // }

    // function edit($id){
    //     require(ROOT . 'Models/Form.php');
    //     $form= new Form();
    //     $d["form"] = $form->showForm($id);
    //     echo json_encode($d);
    // }

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

    function delete($id){
        require(ROOT . 'Models/Form.php');

        $form = new Form();
        if ($form->delete($id))
        {
            echo "success";
        }
    }
}
?>