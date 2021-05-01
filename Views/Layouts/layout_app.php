<!doctype html>
<head>
    <meta charset="utf-8">

    <title>Form Generator</title>

    <link href="http://localhost/formgeneratornative/public/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://localhost/formgeneratornative/public/assets/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="http://localhost/formgeneratornative/public/assets/css/select2.min.css" rel="stylesheet">
    <!-- sweetalert css-->
    <link href="http://localhost/formgeneratornative/public/assets/css/sweetalert2.css" rel="stylesheet" />
    <link href="http://localhost/formgeneratornative/public/assets/css/feathericons/style.css" rel="stylesheet">
    <!-- <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"> -->
    <link href="http://localhost/formgeneratornative/public/assets/css/font-awesome.min.css" rel="stylesheet" />
    <link href="http://localhost/formgeneratornative/public/assets/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="http://localhost/formgeneratornative/public/assets/css/style.css" rel="stylesheet">

    <script src="http://localhost/formgeneratornative/public/assets/js/jquery-3.3.1.js"></script>
    <script src="http://localhost/formgeneratornative/public/assets/js/popper.min.js"></script>
    <script src="http://localhost/formgeneratornative/public/assets/js/bootstrap.min.js"></script>
    <script src="http://localhost/formgeneratornative/public/assets/js/select2.min.js"></script>
    <script src="http://localhost/formgeneratornative/public/assets/js/jquery.dataTables.min.js"></script>
    <script src="http://localhost/formgeneratornative/public/assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="http://localhost/formgeneratornative/public/assets/js/sweetalert2.min.js"></script>
    <script src="http://localhost/formgeneratornative/public/assets/js/form-generator.js"></script>
    <script src="http://localhost/formgeneratornative/public/assets/js/moment.min.js"></script>
    <script src="http://localhost/formgeneratornative/public/assets/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="http://localhost/formgeneratornative/public/assets/js/custom.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="/formgeneratornative">
                Form Builder
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    <?php 
                        if(empty($_SESSION['user'])){
                            echo' <li class="nav-item">';
                            echo'     <a class="nav-link" href="/formgeneratornative/auth/login">Login</a>';
                            echo" </li>";
                            echo' <li class="nav-item">';
                            echo'     <a class="nav-link" href="/formgeneratornative/auth/register">Register</a>';
                            echo" </li>";
                        }else{
                            echo' <li class="nav-item dropdown">';
                            echo'     <a id="navbarDropdown" class="nav-link dropdown-toggle" href="" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>';
                            echo      $_SESSION['user']['name']."<span class='caret'></span>";
                            echo"     </a>";
                            echo'     <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">';
                            echo'         <a class="dropdown-item" href="/formgeneratornative/auth/logout"';
                            echo'             onclick="event.preventDefault();';
                            echo'                             document.getElementById(\'logout-form\').submit();">';
                            echo"             Logout";
                            echo"         </a>";
                            echo'         <form id="logout-form" action="/formgeneratornative/auth/logout" method="POST" style="display: none;">';            
                            echo"         </form>";
                            echo"     </div>";
                            echo" </li>  ";
                        }
                    ?>
                        
                        
                    
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
    <?php
    echo $content_for_layout;
    ?>
    </main>
    <footer>

    </footer>    
    
</body>
</html>
