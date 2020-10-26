

<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.11/dist/js/select2.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.11/dist/css/select2.min.css">
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
        <style>
            #card {border-radius:5px;background-color:white;padding-top:30px;padding-bottom:0px;padding-right:0px;padding-left:0px;
            margin-bottom: 10px;}.card-title{padding-right: 30px;padding-left: 30px; }.card-input { padding-top:15px; padding-bottom:5px;
            padding-right: 30px;padding-left: 30px;}.select2-selection__arrow {margin-top:3px!important;}
            .select2-selection.select2-selection--single{height: 36px!important; padding:3px !important;}
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row" style="margin-top:50px;">
                <div class="col-md-2"></div>
                <div id="card" class="col-md-8 shadow-sm" style="margin-top:100px">
                    <div class="form-group card-title">
                        <center>
                            <h3>Login to Form</h3>
                        </center>
                    </div>
                    <div class="form-group card-title" style="text-align:center;margin-bottom:30px;">
                        <button type="submit" class="col-md-5 btn btn-outline-primary" onclick="window.open('<?php echo $authUrl; ?>','targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=600')">Get Access</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
