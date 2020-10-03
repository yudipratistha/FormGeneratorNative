<?php 
class authController extends controller{
    function login(){
        session_start();
        if(empty($_SESSION['user'])){
            require(ROOT . 'Models/User.php');
            $user = new User();

            if(!empty($_POST['email'])){
                $user_login  = $user->login($_POST['email'], $_POST['password']);
                if (password_verify($_POST['password'], $user_login['password'])) {
                    echo 'Password is valid!';
                    $_SESSION['user'] = $user->getUserData($user_login['id']);
                } else {
                    echo 'Invalid password.';
                }
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
        session_start();
        if(empty($_SESSION['user'])){
            require(ROOT . 'Models/User.php');
            $user = new User();

            if(!empty($_POST['email']) && $_POST['password'] == $_POST['password_confirmation']){
                $user->register($_POST['name'], $_POST['email'], password_hash($_POST['password'], PASSWORD_BCRYPT));
                header("Location: " . WEBROOT . "auth/login" );
            }else{
                $this->render("register");
            }
        }else{
            // header('Input Empty!', true, 500);
            die("404 Not Found.");
        }
    }
}
?>