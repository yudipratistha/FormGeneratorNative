<?php
class FormProject extends Model{
    public function showAllFormProjects(){
        $sql = "SELECT * FROM form_projects";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }

    public function create($nama_project){
        $sql = "INSERT INTO form_projects (nama_project, created_at, updated_at) VALUES (:nama_project, :created_at, :updated_at)";

        $req = Database::getBdd()->prepare($sql);

        return $req->execute([
            'nama_project' => $nama_project,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')

        ]);
    }

    public function showFormProject($id){
        $sql = "SELECT * FROM form_projects WHERE id =" . $id;
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetch();
    }


    public function edit($id, $title, $description){
        $sql = "UPDATE tasks SET title = :title, description = :description , updated_at = :updated_at WHERE id = :id";

        $req = Database::getBdd()->prepare($sql);

        return $req->execute([
            'id' => $id,
            'title' => $title,
            'description' => $description,
            'updated_at' => date('Y-m-d H:i:s')

        ]);
    }

    public function delete($id){
        $sql = 'DELETE FROM form_projects WHERE id = ?';
        $req = Database::getBdd()->prepare($sql);
        return $req->execute([$id]);
    }
}
?>