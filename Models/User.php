<?php
class User extends Model{
    public function login($email, $password){
        $sql = "SELECT id, email, password FROM users WHERE email =:email OR password=:password";
        $req = Database::getBdd()->prepare($sql);
        // $req->execute();
        $req->execute([
            'email' => $email,
            'password' => $password
        ]);
        // foreach($req as $row) {
        //     echo $row['name'];
        // }
        return $req->fetch();
    }

    public function getUserData($id){
        $sql = "SELECT id, email, name FROM users WHERE id = :id";
        $req = Database::getBdd()->prepare($sql);
        // $req->execute();
        $req->execute([
            'id' => $id,
        ]);
        // foreach($req as $row) {
        //     echo $row['name'];
        // }
        return $req->fetch();
    }

    public function getLoginData($id){
        $sql = "SELECT id, email, name FROM form_projects WHERE id =". $id;
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }

    public function register($name, $email, $password){
        $sql = "INSERT INTO users (name, email, password, created_at, updated_at) VALUES (:name, :email, :password, :created_at, :updated_at)";

        $req = Database::getBdd()->prepare($sql);

        return $req->execute([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
?>