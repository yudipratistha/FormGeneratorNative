<php>    <head>        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">        <link rel="stylesheet" href="google/css/sidebar.css">        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.11/dist/css/select2.min.css">        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.11/dist/js/select2.min.js"></script>        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>        <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>    </head>    <body>        <div class="page-wrapper chiller-theme toggled">            <a id="show-sidebar" class="btn btn-sm btn-light"><i class="fa fa-bars"></i></a>            <nav id="sidebar" class="sidebar-wrapper">                <div class="sidebar-content">                    <div class="sidebar-brand">                        <a href="#">Form Data Pegawai</a>                        <div id="close-sidebar">                            <i class="fa fa-times"></i>                        </div>                    </div>                    <div class="sidebar-header">                        <div class="user-info">                            <span class="user-name"><?php echo $_SESSION["name_login"]; ?></span>                            <span class="user-role"><?php echo $_SESSION["email_login"]; ?></span>                        </div>                    </div>                    <div class="sidebar-menu">                        <ul>                            <li class="header-menu">                                <span>Menu</span>                            </li>                            <li class="sidebar-content">                                <a class="active" href="form_data_pegawai.php">                                    <i class="fa fa-folder"></i>                                    <span>Form Data Pegawai</span>                                </a>                            </li>                        </ul>                    </div>                </div>                <div class="sidebar-footer">                    <a href="?logout=yes"><i class="fa fa-power-off"></i></a>                </div>            </nav>            <main class="page-content">                <div class="container-fluid">