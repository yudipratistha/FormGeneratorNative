<?php
class FormProject extends Model{
    public function showAllFormProjects($id){
        $sql = "SELECT * FROM form_projects WHERE users_id=$id";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }

    public function create($nama_project, $project_oauth_file, $project_token_file, $project_auth_type, $project_auth_path, $users_id){
        $sql = "INSERT INTO form_projects (nama_project, project_oauth_file, project_token_file, project_auth_type, project_auth_path, users_id, created_at, updated_at) VALUES (:nama_project, :project_oauth_file, :project_token_file, :project_auth_type, :project_auth_path, :users_id, :created_at, :updated_at)";

        $req = Database::getBdd()->prepare($sql);

        return $req->execute([
            'nama_project' => $nama_project,
            'project_oauth_file' => $project_oauth_file,
            'project_token_file' => $project_token_file,
            'project_auth_type' => $project_auth_type,
            'project_auth_path' => $project_auth_path,
            'users_id' => $users_id,
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

    public function edit($id, $nama_project_edit, $project_oauth_file, $project_token_file, $project_auth_type, $project_auth_path){
        $sql = "UPDATE form_projects SET nama_project = :nama_project_edit, project_oauth_file = :project_oauth_file, project_token_file = :project_token_file, project_auth_type = :project_auth_type, project_auth_path = :project_auth_path, updated_at = :updated_at WHERE id = :id";

        $req = Database::getBdd()->prepare($sql);

        return $req->execute([
            'id' => $id,
            'nama_project_edit' => $nama_project_edit,
            'project_oauth_file' => $project_oauth_file,
            'project_token_file' => $project_token_file,
            'project_auth_type' => $project_auth_type, 
            'project_auth_path' => $project_auth_path,
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
        $sql = 'DELETE form_projects, forms FROM form_projects LEFT JOIN forms ON form_projects.`id` = forms.`form_projects_id` WHERE form_projects.`id` = ?';
        $req = Database::getBdd()->prepare($sql);
        return $req->execute([$id]);
    }
}
?>