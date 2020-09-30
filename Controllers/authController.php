<?php 
class authController extends controller{
    function login(){
        session_start();
        if(empty($_SESSION['user'])){
            require(ROOT . 'Models/User.php');
            $user = new User();
            if(!empty($_POST['email'])){
                session_start();
                $_SESSION['user'] = $user->login($_POST['email'], $_POST['password']);
                header("Location: " . WEBROOT );
            }else{
                $this->render("login");
            }
        }else{
            // header('Input Empty!', true, 500);
            die("404 Not Found.");
        }
        
    }

    function logout(){
        session_start();
        unset($_SESSION['user']);
        session_destroy();
        header("Location: " . '/formgeneratornative/auth/login');
    }
    
    function register(){

    }
}
?>