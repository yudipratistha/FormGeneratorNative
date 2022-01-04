<?php
class SubForm extends Model{
    public function showSubForm($id){
        $sql = "SELECT sub_forms.`id` AS sub_form_id, sub_forms.`sub_form_name`, sub_forms.`sub_form_title`, sub_forms.`sub_form_export`, sub_forms.`sub_form_attr`, sub_forms.`form_id`, forms.`form_export`, forms.`form_attr` FROM sub_forms RIGHT JOIN forms ON sub_forms.`form_id` = forms.`id` WHERE sub_forms.`id` = " . $id;
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetch();
    }
    
    public function getSubForms($id){
        $sql = "SELECT sub_forms.`id` AS sub_form_id, sub_forms.`sub_form_name`, sub_forms.`sub_form_title`, sub_forms.`sub_form_export`, sub_forms.`sub_form_attr`, forms.`id` AS form_id, forms.`form_title`, forms.`form_export`, forms.`form_attr`  FROM sub_forms RIGHT JOIN forms ON sub_forms.`form_id` = forms.`id` WHERE forms.`id` = ". $id;
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

    


    public function update($id, $sub_form_title, $sub_form_name, $convert_php, $attr_form){
        $sql = "UPDATE sub_forms SET sub_form_title = :sub_form_title, sub_form_name = :sub_form_name, sub_form_export = :sub_form_export, sub_form_attr = :sub_form_attr, updated_at = :updated_at WHERE id = :id";
        $req = Database::getBdd()->prepare($sql);

        return $req->execute([
            'id' => $id,
            'sub_form_title' => $sub_form_title,
            'sub_form_name' => $sub_form_name,
            'sub_form_export' => $convert_php,
            'sub_form_attr' => $attr_form,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function delete($id){
        $sql = 'DELETE FROM sub_forms WHERE id = ?';
        $req = Database::getBdd()->prepare($sql);
        return $req->execute([$id]);
    }
}
?>