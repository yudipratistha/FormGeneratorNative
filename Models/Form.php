<?php
class Form extends Model{
    public function showAllForms($id){
        $sql = "SELECT * FROM forms INNER JOIN form_projects ON forms.`form_projects_id` = form_projects.`id` WHERE form_projects.`id` =". $id;
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }
    
    public function projectName($id){
        $sql = "SELECT id, nama_project FROM form_projects WHERE id =". $id;
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }

    public function getProject($id){
        $sql = "SELECT * FROM form_projects WHERE id =". $id;
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetch();
    }

    public function getForm($query){
        $sql = "SELECT * FROM forms WHERE ". $query;
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }

    public function create($form_title, $form_name, $convert_php, $attr_form, $form_type, $form_projects_id){
        $sql = "INSERT INTO forms (form_title, form_name, form_export, form_attr, form_type, form_projects_id, created_at, updated_at) VALUES (:form_title, :form_name, :convert_php, :attr_form, :form_type, :form_projects_id, :created_at, :updated_at)";

        $req = Database::getBdd()->prepare($sql);

        return $req->execute([
            'form_title' => $form_title,
            'form_name' => $form_name,
            'convert_php' => $convert_php,
            'attr_form' => $attr_form,
            'form_type' => $form_type,
            'form_projects_id' => $form_projects_id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function showForm($id){
        $sql = "SELECT * FROM forms WHERE id =" . $id;
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetch();
    }


    public function update($id, $form_title, $form_name, $convert_php, $attr_form, $form_type){
        $sql = "UPDATE forms SET form_title = :form_title, form_name = :form_name, form_export = :form_export, form_attr = :form_attr, form_type = :form_type, updated_at = :updated_at WHERE id = :id";

        $req = Database::getBdd()->prepare($sql);

        return $req->execute([
            'id' => $id,
            'form_title' => $form_title,
            'form_name' => $form_name,
            'form_export' => $convert_php,
            'form_attr' => $attr_form,
            'form_type' => $form_type,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function delete($id){
        $sql = 'DELETE FROM forms WHERE id = ?';
        $req = Database::getBdd()->prepare($sql);
        return $req->execute([$id]);
    }
}
?>