<?php
    function getDirContents($dir, &$results = array()) {
        $files = scandir($dir);
        
        foreach ($files as $key => $value) {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path)) {
                $results[] = $path;
                
            } else if ($value != "." && $value != "..") {
                getDirContents($path, $results);
                $results[] = $path;
            }
        }
        return $results;
    }

    if (isset($_GET['form'])) {
        // $form_status = 'form-status=synchronize';
        // print_r( $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'].'&'.$form_status);
        $firstDirectory = "data/". strtolower(str_replace('-', '_', $_GET['form-project'])) ."/". strtolower(str_replace(' ', '_', $_GET['status'])) ."/";
        if(is_dir($firstDirectory) != null){
            $formDir = array_slice(scandir($firstDirectory), 2);

            foreach($formDir as $folder){
                if(strpos($folder, str_replace('-', '_', $_GET['form'])) !== FALSE){
                    // print_r($firstDirectory . $folder);
                    // exit();
                    $lastDir = array_slice(scandir($firstDirectory . $folder), 2);
                    $lastDir = explode('_', end($lastDir));
                    $lastFoldDatetime = new DateTime(str_replace(';', ':', reset($lastDir)));
                    $las_time = new DateTimeZone('Etc/GMT+6');
                    $lastFoldDatetime->setTimezone($las_time);
                    
                    $json_data = array();
                    foreach(getDirContents($firstDirectory . $folder) as $num => $dir){
                        if(!is_dir($dir)){
                            $ext = pathinfo($dir, PATHINFO_EXTENSION);
                            if(strpos(basename(dirname($dir)), "Attachment") !== FALSE){
                                // echo basename(dirname($dir)) . PHP_EOL . "<br>";  
                                // Read image path, convert to base64 encoding
                                $imageData = base64_encode(file_get_contents($dir));
                    
                                // Format the image SRC:  data:{mime};base64,{data};
                                $src[] = 'data: '.mime_content_type($dir).';base64,'.$imageData;
                                // Echo out a sample image
                                
                                // echo '<img src=/data/Sistem_Pegawai/form_data_pegawai/2021-01-18 11;00;24.506000_form_data_pegawai/2021-01-18 11;00;25.535000_Attachment/2021-01-18 11;00;29017000_foto_pegawai.jpg>';
                                // echo '/data/Sistem_Pegawai/form_data_pegawai/2021-01-18%2011;00;24.506000_form_data_pegawai/2021-01-18 11;00;25.535000_Attachment/' . basename($dir) . "<br>";
                                // echo '<img src=data/Sistem_Pegawai/form_data_pegawai/2021-01-18%2011;00;24.506000_form_data_pegawai/2021-01-18%2011;00;25.535000_Attachment/'.str_replace(" ", "%20", basename($dir)).'>';
                                // echo strpos(basename(dirname($dir)), "Attachment") . "<br>";
                                $str = $dir;
                                $arr = array_filter(explode('\\',$str));
                                $out = array('\\'.implode('\\',$arr).'\\');
                                while((array_shift($arr) and !empty($arr))){
                                    $out[] = '\\'.implode('\\',$arr).'\\';
                                };
    
                                // $example = array('An example','Another example','\data example');
                                // $searchword = '\Data';
                                // $matches = array_filter($out, function($var) use ($searchword) { return preg_match("/\b$searchword\b/", $var); });
                                // print_r($matches);
                                // echo '<img src='.substr(str_replace(" ", "%20", $out[5]), 1, -1).'>';
    
                                // print_r($out[5]);
                                // $key = array_search('\data\Sistem_Pegawai\form_data_pegawai\2021-01-18 11;00;24.506000_form_data_pegawai\2021-01-18 11;00;25.535000_Attachment\2021-01-18 11;00;29017000_foto_pegawai.jpg\\', $out);
                                // $key = preg_grep('/^data\s.*/', $out);
                                // echo $key;
                                // if (in_array("\data", $out)) {
                                //     echo "Got Irix";
                                // }
                                // echo $src;
                            }else{
                                // echo $dir ."<br><br>";
                                $json_data[] = json_decode(file_get_contents($dir), true);
                            }
                        }
                    }
                }
            }
        }
    }else{
        header('Location:index.php');
    }

    $oauth_credentials = __DIR__ . "../../google/secret/oauth.json";
    include_once __DIR__ . '../../google/autoload.php';
    $folderName = "Sistem_Pegawai";
    $folderFormName = "form_data_pegawai";
    session_start();
    $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] ;
    $client = new Google_Client();
    $client->setAuthConfig($oauth_credentials);
    $client->setAccessType('offline');
    $client->setRedirectUri($redirect_uri);
    $client->addScope("https://www.googleapis.com/auth/drive");
    $service = new Google_Service_Drive($client);
    if (isset($_REQUEST['logout'])) {
        unset($_SESSION['upload_token_admin']);
        unset($_SESSION['email_login_admin']);
        header("Location: " . $_SERVER["PHP_SELF"]);
        exit;
    }
    else if (isset($_POST["password"])) {
        $password = $_POST["password"];
        $logged_in = false;
        $auth_file = file_get_contents($auth_file);
        $auths = json_decode($auth_file);
        $auth_keys = array_keys((array)$auths[0]);
        foreach ($auth_keys as $i => $auth_key) {
            if ($i == 0) $username_key = $auth_key;
            else $password_key = $auth_key;
        }
        foreach ($auths as $auth) {
            $auth = (array)$auth;
            if ($password == $auth[$password_key]) {
                $logged_in = true;
                $username = $auth[$username_key];
            }
        }
        if ($logged_in) {
            $authUrl = $client->createAuthUrl();
            $_SESSION["display_name_key"] = $username_key;
            $_SESSION["display_name"] = $username;
        }
    }
    else if (isset($_GET['code'])) {
        
        $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
        // print_r($token);
        $client->setAccessToken($token);
        $_SESSION['upload_token_admin'] = $token;
        header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    }
    else if (!empty($_SESSION['upload_token_admin'])) {
        $client->setAccessToken($_SESSION['upload_token_admin']);
        echo "<script> if (window.opener != null){ opener.location.reload(); close(); }</script>";
        $status = true;
        if ($client->isAccessTokenExpired()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
        }
        if ($status !== false) {
            $about = $service->about->get(array('fields' => '*'));
            $_SESSION["email_login_admin"] = $about->user->emailAddress;
            $_SESSION["name_login_admin"] = $about->user->displayName;
        }
    }
    if (empty($_SESSION['upload_token_admin'])) {
        $authUrl = $client->createAuthUrl();
        include "../google/login.php";
        $status = false;
    }

    if ($status) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $project_form_name = $_GET['form-project'];
            $form_name = $_GET['form'];
            $status_sync = $_GET['status'];

            $list_sync_status = $service->files->listFiles([
                'q' => "name='". $status_sync ."'"
            ]);
            
            $list_project_form = $service->files->listFiles([
                'q' => "'". $list_sync_status[0]['id'] ."' in parents and name='". str_replace('-', '_', $project_form_name) ."'"
            ]);
            $list_form = $service->files->listFiles([
                'q' => "'". $list_project_form[0]['id'] ."' in parents and name='". str_replace('-', '_', $form_name) ."'"
            ]);
            
            $http = $client->authorize();
            $parent_folder = $service->files->get($list_form[0]['id'], array("fields" => "name, createdTime"));
            $parent_folder_id= $list_form[0]['id'];
            
            $parent_folder_dir = 'Sistem_Pegawai/'.strtolower(str_replace(' ', '_', $_GET['status'])).'/'.$parent_folder['name'].'/';           
        
            $file_dict = array();
            $folder_queue[] = $parent_folder_id;
            $dir_queue[] = $parent_folder_dir;
            $cnt=0;
            
            while(count($folder_queue) != 0){
                $current_folder_id = array_shift($folder_queue);
                
                $file_list = $service->files->listFiles([
                    'orderBy' => 'createdTime',
                    'fields' => "files(id,name, createdTime, modifiedTime, mimeType, size)",
                    'q' => (empty($lastDir) || isset($lastDir)) ? "'".$current_folder_id."' in parents" : "'".$current_folder_id."' in parents and createdTime > '" . str_replace(' ', 'T', $lastFoldDatetime->format('Y-m-d H:i:s.u')) ."'", 
                ]);
                
                $current_parent = array_shift($dir_queue);
                foreach($file_list as $file){
                    echo '<br>'; print_r($file['createdTime']); echo '<br>';
                    $tmp = array_filter(explode(".", $file['name']));
                    $datetime = new DateTime($file['createdTime']);
                    $la_time = new DateTimeZone('Asia/Makassar');
                    $datetime->setTimezone($la_time);
                
                    $file_dict[$cnt]['id'] = $file['id'];
                    $file_dict[$cnt]['title'] = $file['name'];
                    $file_dict[$cnt]['size'] = $file['size'];
                    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
                    
                    if($file['mimeType'] == 'application/vnd.google-apps.folder'){
                        $file_dict[$cnt]['dir'] = $current_parent . $datetime->format('Y-m-d H;i;s.u') . '_' . $file['name'];
                        $file_dict[$cnt]['type'] = 'folder';
                        $file_dict[$cnt]['dir'] .= '/';
                        array_push($folder_queue, $file['id']);
                        array_push($dir_queue, $file_dict[$cnt]['dir']);
                    }else{
                        $file_dict[$cnt]['dir'] = $current_parent . $datetime->format('Y-m-d H;i;su') . '_' . $file['name'];
                        $file_dict[$cnt]['type'] = 'file';
                    }
                    $cnt++;
                }      
            }
            
            foreach($file_dict as $file){
                if($file['type'] == 'folder'){
                    $directory = "data/".$file['dir'];
                    // echo $file['dir'];echo '<br><br>';
                    mkdir($directory, 0777, true);
                }else{
                    // print_r($file['type'] . $file['id'] . $file['title']);echo '<br>'; echo '<br>';
                    $fileId = $file['id'];
                    $fileSize = intval($file['size']);
                    $http = $client->authorize();
                    $fp = fopen('data/'.$file['dir'], 'w');
                
                    // Download in 1 MB chunks
                    $chunkSizeBytes = 1 * 1024 * 1024;
                    $chunkStart = 0;
                
                    // Iterate over each chunk and write it to our file
                    while ($chunkStart < $fileSize) {
                        $chunkEnd = $chunkStart + $chunkSizeBytes;
                        $response = $http->request(
                        'GET',
                        sprintf('/drive/v3/files/%s', $fileId),[
                            'query' => ['alt' => 'media'],
                            'headers' => [
                                'Range' => sprintf('bytes=%s-%s', $chunkStart, $chunkEnd)
                            ]
                        ]
                        );
                        $chunkStart = $chunkEnd + 1;
                        fwrite($fp, $response->getBody()->getContents());
                    }
                    // close the file pointer
                    fclose($fp);
                }
            }
            header('Location: ' . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'],  true,  301 );
        }
?>
        <?php include "../sidebar-admin.php"; ?> 
        <title>View Data</title>
        <div class="container">
            <div class="row">   
                <div class="col-md-12">
                    <h2 class="text-center">View Data</h2>
                        <div class="form-group">
                            <label for="sel1">Select Sync Status:</label>
                            <select class="form-control" id="sync-status" name="status">
                                <option <?php if($_GET['status'] == 'Sync') echo 'selected="selected"' ;?>>Sync</option>
                                <option <?php if($_GET['status'] == 'Out of Sync') echo 'selected="selected"' ;?>>Out of Sync</option>
                            </select>
                        </div> 
                    <table id="example" class="display" cellspacing="0" width="100%">
                        <?php 
                        if(isset($json_data)){
                            echo '<thead>';
                            echo '  <tr>';
                            echo '      <th></th>';
                            echo '      <th>No.</th>';
                            foreach($json_data[0] as $coloumn => $value){
                                $coloumn = str_replace('_', ' ', $coloumn);
                                echo '      <th>'.ucwords($coloumn).'</th>';
                            }
                            echo '  </tr>';
                            echo '</thead>';
                            echo '<tbody>';
                            foreach($json_data as $num => $value){
                                echo '<tr>';   
                                echo '    <td></td>'; 
                                echo '    <td>'.++$num.'</td>';
                                foreach($value as $data){
                                    echo '    <td>'.$data.'</td>';
                                //     $ext = pathinfo($data, PATHINFO_EXTENSION);
                                //     if(isset($ext)){
                                //         echo '    <td>'.$data.'</td>';
                                //     }else if(isset($ext)){
                                //         echo '    <td>asdas</td>';
                                //     }
                                }
                                echo '</tr>';
                            }
                        }else{
                            echo '<center> Empty Data! </center>';
                        }
                        ?>
                        </tbody>
                    </table>
                    <form method="POST" enctype="multipart/form-data">
                        <button type="submit" class="float btn btn-icon btn-add btn-info mt-1 mb-1" data-tooltip="tooltip" data-placement="left" title="" data-original-title="Create New Project">
                            <span class="btn-inner--icon"><i class="fa fa-download"></i></span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <!-- left modal -->
        <div class="modal modal_outer right_modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" >
                <div class="modal-dialog" role="document">
                <form method="post"  id="get_quote_frm">
                    <div class="modal-content ">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                            </button>
                        <!-- <h2 class="modal-title">Information:</h2> -->
                            
                        </div>
                        <div class="modal-body get_quote_view_modal_body">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni numquam accusantium dolore ipsum! Aut distinctio maxime obcaecati, sapiente nisi laudantium dignissimos optio, ea ex quas laboriosam ab officia odit, sequi.</p><br><br>
                        </div>
                    </div><!-- modal-content -->
                </form>
                </div><!-- modal-dialog -->
        </div><!-- modal -->

    </body>
    <script type="text/javascript">

        var table;
        $(document).ready(function() {
            table = $('#example').DataTable({
                columnDefs: [{
                    orderable: false,
                    className: 'select-checkbox',
                    targets: 0
                }, {
                "targets": [2],
                "visible": false,
                "searchable": false
                }],
                select: {
                style: 'os',
                selector: 'td:first-child'
                },
                order: [
                [1, 'asc']
                ]
            });

            table.on('select', function ( e, dt, type, indexes ){
                var tblData = table.rows('.selected').data();
                var tmpData;
                $.each(tblData, function(i, val) {
                    tmpData = tblData[i];
                    // alert(tmpData);
                    $('#myModal2').modal({ backdrop: 'static', keyboard: false});
                    $('#myModal2').modal('show');
                    
                });
            });
            $('#example').on('click', 'tr', function () {
                var name = $('td', this).text();
                console.log(name);
                // $('#myModal2').modal("hide");
                $('#myModal2').modal("show");
                // $('#myModal2').modal("close");

            });
        });

        var params = new URLSearchParams(location.search.split('?')[1]);
        params.delete('status');
		$('a[href*="' + params.toString() + '"]').parent().addClass("active");
		$('.sidebar-content > a').click(function() {
			$('.sidebar-content').removeClass('active');
			$(this).parent().addClass("active");
		});
		$(".sidebar-dropdown > a").click(function() {
			$(".sidebar-submenu").slideUp(200);
			if($(this).parent().hasClass("active")) {
				$(".sidebar-dropdown").removeClass("active");
				$(this).parent().removeClass("active");
			} else {
				$(".sidebar-dropdown").removeClass("active");
				$(this).next(".sidebar-submenu").slideDown(200);
				$(this).parent().addClass("active");
			}
		});
		$("#close-sidebar").click(function() {
			$(".page-wrapper").removeClass("toggled");
		});
		$("#show-sidebar").click(function() {
			$(".page-wrapper").addClass("toggled");
		});

        $("#sync-status").on('change', function() {
            var urlQuery = new URL(window.location.href);
            urlQuery.searchParams.set('status', this.value);
            // alert( urlQuery );
            window.location.href = urlQuery;
        });
    </script>
</html>
<?php } ?>