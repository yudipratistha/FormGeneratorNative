<?php
class FormProject extends Model{
    public function showAllFormProjects(){
        $sql = "SELECT * FROM form_projects";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }

    public function create($nama_project, $project_oauth_file, $project_token_file){
        $sql = "INSERT INTO form_projects (nama_project, project_oauth_file, project_token_file, created_at, updated_at) VALUES (:nama_project, :project_oauth_file, :project_token_file, :created_at, :updated_at)";

        $req = Database::getBdd()->prepare($sql);

        return $req->execute([
            'nama_project' => $nama_project,
            'project_oauth_file' => $project_oauth_file,
            'project_token_file' => $project_token_file,
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


    public function edit($id, $nama_project_edit, $project_oauth_file){
        $sql = "UPDATE form_projects SET nama_project = :nama_project_edit, project_oauth_file = :project_oauth_file, updated_at = :updated_at WHERE id = :id";

        $req = Database::getBdd()->prepare($sql);

        return $req->execute([
            'id' => $id,
            'nama_project_edit' => $nama_project_edit,
            'project_oauth_file' => $project_oauth_file,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function getToken($id){
        $sql = "SELECT project_oauth_file, project_token_file FROM form_projects WHERE id =" . $id;
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetch();
    }

    public function delete($id){
        $sql = 'DELETE FROM form_projects WHERE id = ?';
        $req = Database::getBdd()->prepare($sql);
        return $req->execute([$id]);
    }
}
?>