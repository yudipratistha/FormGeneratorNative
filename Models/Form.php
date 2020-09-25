<?php
class Form extends Model{
    public function showAllForms($id){
        $sql = "SELECT * FROM forms INNER JOIN form_projects ON forms.`form_projects_id` = form_projects.`id` WHERE form_projects.`id` =". $id;
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }
    public function projectName($id){
        $sql = "SELECT nama_project FROM form_projects WHERE id =". $id;
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }

    // public function create($nama_project){
    //     $sql = "INSERT INTO form_projects (nama_project, created_at, updated_at) VALUES (:nama_project, :created_at, :updated_at)";

    //     $req = Database::getBdd()->prepare($sql);

    //     return $req->execute([
    //         'nama_project' => $nama_project,
    //         'created_at' => date('Y-m-d H:i:s'),
    //         'updated_at' => date('Y-m-d H:i:s')

    //     ]);
    // }

    public function showForm($id){
        $sql = "SELECT * FROM forms WHERE id =" . $id;
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetch();
    }


    // public function edit($id, $title, $description){
    //     $sql = "UPDATE tasks SET title = :title, description = :description , updated_at = :updated_at WHERE id = :id";

    //     $req = Database::getBdd()->prepare($sql);

    //     return $req->execute([
    //         'id' => $id,
    //         'title' => $title,
    //         'description' => $description,
    //         'updated_at' => date('Y-m-d H:i:s')

    //     ]);
    // }

    public function delete($id){
        $sql = 'DELETE FROM forms WHERE id = ?';
        $req = Database::getBdd()->prepare($sql);
        return $req->execute([$id]);
    }
}
?>