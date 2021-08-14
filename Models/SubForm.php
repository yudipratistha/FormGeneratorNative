<?php
class SubForm extends Model{
    public function showAllSubForms($id){
        $sql = "SELECT * FROM sub_forms INNER JOIN forms ON sub_forms.`form_id` = forms.`id` WHERE forms.`id` =". $id;
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }

    public function getFormName($id){
        $sql = "SELECT id, form_name FROM forms WHERE id =". $id;
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }

    public function create($sub_form_title, $sub_form_name, $convert_php, $attr_form, $form_id){
        $sql = "INSERT INTO sub_forms (sub_form_title, sub_form_name, sub_form_export, sub_form_attr, form_id, created_at, updated_at) VALUES (:sub_form_title, :sub_form_name, :convert_php, :attr_form, :form_id, :created_at, :updated_at)";

        $req = Database::getBdd()->prepare($sql);

        return $req->execute([
            'sub_form_title' => $sub_form_title,
            'sub_form_name' => $sub_form_name,
            'convert_php' => $convert_php,
            'attr_form' => $attr_form,
            'form_id' => $form_id,
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


    public function update($id, $form_title, $form_name, $convert_php, $attr_form){
        $sql = "UPDATE forms SET form_title = :form_title, form_name = :form_name, form_export = :form_export, form_attr = :form_attr, updated_at = :updated_at WHERE id = :id";
        $req = Database::getBdd()->prepare($sql);

        return $req->execute([
            'id' => $id,
            'sub_form_title' => $sub_form_title,
            'sub_form_name' => $sub_form_name,
            'sub_form_export' => $sub_form_export,
            'sub_form_attr' => $sub_form_attr,
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